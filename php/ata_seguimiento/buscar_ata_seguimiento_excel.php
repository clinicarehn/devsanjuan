<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$dato = $_GET['dato'];

$encargado = "Dr. Victor Borjas";

//OBTENER NOMBRE DE EMPRESA
$usuario = $_SESSION['colaborador_id'];	

$query_empresa = "SELECT e.nombre AS 'empresa'
FROM users AS u
INNER JOIN empresa AS e
ON u.empresa_id = e.empresa_id
WHERE u.colaborador_id = '$usuario'";
$result_empresa = $mysqli->query($query_empresa) or die($mysqli->error);;
$consulta_empresa = $result_empresa->fetch_assoc();

$empresa_nombre = '';

if($result_empresa->num_rows>0){
   $empresa_nombre = $consulta_empresa['empresa'];	
}

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if($dato == ""){
	$where = "WHERE ase.fecha BETWEEN '$desde' AND '$hasta'";
}else if($dato != ""){
	$where = "WHERE CONCAT(pseg.nombres,' ',pseg.apellidos) LIKE '$dato%' OR pseg.identidad LIKE '$dato%' OR pseg.telefono LIKE '$dato%'";
}else{
	$where = "WHERE ase.fecha BETWEEN '$desde' AND '$hasta' AND (CONCAT(pseg.nombres,' ',pseg.apellidos) LIKE '$dato%' OR pseg.identidad LIKE '$dato%' OR pseg.telefono LIKE '$dato%')";
}

$registro = "SELECT CONCAT(pseg.nombres,' ',pseg.apellidos) AS 'paciente', ase.fecha, 
    (CASE WHEN pseg.genero = 'H' THEN 'X' ELSE '' END) AS 'h',
    (CASE WHEN pseg.genero = 'M' THEN 'X' ELSE '' END) AS 'm', 
	pseg.identidad, d.nombre AS 'departamento', m.nombre AS 'municipio', pseg.telefono,
	(CASE WHEN ase.ansioso = '1' THEN 'Sí' ELSE 'No' END) AS 'ansioso',
	(CASE WHEN ase.depresivo = '1' THEN 'Sí' ELSE 'No' END) AS 'depresivo',
	(CASE WHEN ase.psicotico = '1' THEN 'Sí' ELSE 'No' END) AS 'psicotico',
	(CASE WHEN ase.agitacion = '1' THEN 'Sí' ELSE 'No' END) AS 'agitacion',
	(CASE WHEN ase.insomnio = '1' THEN 'Sí' ELSE 'No' END) AS 'insomnio',
	(CASE WHEN ase.abandono_medicamento = '1' THEN 'Sí' ELSE 'No' END) AS 'abondono_medicamento',
	(CASE WHEN ase.otros_sitomas = '1' THEN 'Sí' ELSE 'No' END) AS 'otros_sintomas',
	ase.otros_especifique AS 'otros_especifique',
	(CASE WHEN ase.conducta_riesgo = '1' THEN 'Sí' ELSE 'No' END) AS 'conducta_riesgo',
	ase.conducta_especifique AS 'conducta_especifique', at_seg.nombre AS 'atencion',
	ase.comentario, CONCAT(c.apellido,' ',c.nombre) AS 'colaborador', ase.fecha_registro
	FROM ata_seguimiento AS ase
	INNER JOIN colaboradores AS c
	ON ase.usuario = c.colaborador_id
	INNER JOIN pacientes_seguimiento AS pseg
	ON ase.pacientes_seg_id = pseg.pacientes_seg_id
	INNER JOIN departamentos AS d
	ON pseg.departamento_id = d.departamento_id
	INNER JOIN municipios AS m
	ON pseg.municipio_id = m.municipio_id
	INNER JOIN atencion_seguimiento AS at_seg
	ON ase.atencion = at_seg.atencion_seguimiento_id
	".$where."
	ORDER BY ase.fecha";
$result = $mysqli->query($registro);	 
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("CONSOLIDADO"); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 13
    ), 
	'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DAEEF3')
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));
 
$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'E6B8B7')
    ),  
	'font' => array( //fuente
      'arial' => true,
      'size' => 12
    ),	
	'alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$texto = new PHPExcel_Style(); //nuevo estilo
$texto->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 10
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));
 
$other = new PHPExcel_Style(); //nuevo estilo
$other->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));
 
$bordes = new PHPExcel_Style(); //nuevo estilo
 
$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
	'alignment' => array( //alineacion
      'wrap' => true
    ),
));

//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("CONSOLIDADO"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('D8'); //INMOVILIZA PANELES
//establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
//fin: establecer impresion a pagina completa
 
//establecer margenes
$margin = 0.5 / 2.54; // 0.5 centimetros
$marginBottom = 1.2 / 2.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes
 
//incluir imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(164); //altura
$objDrawing->setWidth(138); //anchura
$objDrawing->setCoordinates('P1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/SJD.jpg'); //ruta
$objDrawing->setHeight(164); //altura
$objDrawing->setWidth(138); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 7);
 
$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:W3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $encargado);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:W$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:W4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "GESTOR: ".strtoupper($empresa_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:W$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:W5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "ATA Seguimiento Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:W$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila");

$fila=6;
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("A6:A7"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("B6:B7"); //unir celdas  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Paciente');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->mergeCells("C6:C7"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Genero');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("D6:E6"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->mergeCells("F6:F7"); //unir celdas 
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Departamento');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
$objPHPExcel->getActiveSheet()->mergeCells("G6:G7"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Municipio');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17);
$objPHPExcel->getActiveSheet()->mergeCells("H6:H7"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Teléfono');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(13);
$objPHPExcel->getActiveSheet()->mergeCells("I6:I7"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Síndrome');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(66);
$objPHPExcel->getActiveSheet()->mergeCells("J6:O6"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Otros Sintomas');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(18);
$objPHPExcel->getActiveSheet()->mergeCells("P6:Q6"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'Conducta de Riesgo');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(29);
$objPHPExcel->getActiveSheet()->mergeCells("R6:S6"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'Atención');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(13);
$objPHPExcel->getActiveSheet()->mergeCells("T6:T7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'Comentario');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(40);
$objPHPExcel->getActiveSheet()->mergeCells("U6:U7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("V6:V7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'Fecha Registro');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("W6:W7"); //unir celdas 

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A6:W7"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A6:W7")->getFont()->setBold(true); //negrita
 
$fila=7;
//GENERO
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("D7:D7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("E7:E7"); //unir celdas 

//SINDROMES
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Ansioso');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(11);
$objPHPExcel->getActiveSheet()->mergeCells("J7:J7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Depresivo');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(11);
$objPHPExcel->getActiveSheet()->mergeCells("K7:K7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Psicotico');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(11);
$objPHPExcel->getActiveSheet()->mergeCells("L7:L7"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Agitación');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(11);
$objPHPExcel->getActiveSheet()->mergeCells("M7:M7"); //unir celdas  

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Insomnio');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(11);
$objPHPExcel->getActiveSheet()->mergeCells("N7:N7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Abandono Medicamento');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(11);
$objPHPExcel->getActiveSheet()->mergeCells("O7:O7"); //unir celdas 

//OTROS Sintomas
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Otros Sintomas');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12);
$objPHPExcel->getActiveSheet()->mergeCells("P7:P7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Especifique');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12);
$objPHPExcel->getActiveSheet()->mergeCells("Q7:Q7"); //unir celdas 

//CONDUCTA DE RIESGO
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'Otros Sintomas');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(12);
$objPHPExcel->getActiveSheet()->mergeCells("R7:R7"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'Especifique');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(12);
$objPHPExcel->getActiveSheet()->mergeCells("S7:S7"); //unir celdas 

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A7:W7"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A7:W7")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){	   
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
	   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['fecha']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['paciente']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['h']);
       $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['m']);
	   	   
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("F$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("F$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	   	   
       $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['departamento']);
       $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['municipio']);
       $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['telefono']);
	   
       $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['ansioso']);
       $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['depresivo']);
       $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['psicotico']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['agitacion']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['insomnio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro2['abondono_medicamento']);
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro2['otros_sintomas']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro2['otros_especifique']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro2['conducta_riesgo']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro2['conducta_especifique']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro2['atencion']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro2['comentario']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro2['colaborador']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro2['fecha_registro']);  
	     
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:W$fila");	
	   $valor++;
   }	
}

$fila+=3; 
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $encargado);
$objPHPExcel->getActiveSheet()->mergeCells("E$fila:I$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($other, "E$fila:I$fila");
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "Nombre, Firma y sello del Director del Hospital");
$objPHPExcel->getActiveSheet()->mergeCells("E$fila:I$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($other, "E$fila:I$fila");
//recorrer las columnas
/*
foreach (range('A', 'Q') as $columnID) {
  //autodimensionar las columnas
  $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}*/
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setDifferentOddEven(false);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('Página &P / &N');

$objPHPExcel->removeSheetByIndex(
    $objPHPExcel->getIndex(
        $objPHPExcel->getSheetByName('Worksheet')
    )
);
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="CONSOLIDADO ATA SEGUIMIENTO'.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>