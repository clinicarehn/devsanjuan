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

$registro = "SELECT pacientes_seg_id AS 'pacientes_seg_id', CONCAT(ps.apellidos,' ',ps.nombres) AS 'paciente', 
    (CASE WHEN ps.genero = 'H' THEN 'X' ELSE '' END) AS 'h',
    (CASE WHEN ps.genero = 'M' THEN 'X' ELSE '' END) AS 'm',
    ps.identidad, ps.fecha_nacimiento, ps.telefono, d.nombre AS 'departamento', m.nombre AS 'municipio', ps.localidad, CONCAT(c.apellido,' ',c.nombre) AS 'usuario', ps.fecha_registro
	FROM pacientes_seguimiento AS ps
	INNER JOIN departamentos AS d
	ON ps.departamento_id = d.departamento_id
	INNER JOIN municipios AS m
	ON ps.municipio_id = m.municipio_id 
	INNER JOIN colaboradores AS c
	ON ps.usuario = c.colaborador_id
	WHERE ps.transferir = '2'
	ORDER BY ps.pacientes_seg_id";
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
$objPHPExcel->getActiveSheet()->freezePane('D7'); //INMOVILIZA PANELES
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
$objDrawing->setCoordinates('L1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/SJD.jpg'); //ruta
$objDrawing->setHeight(164); //altura
$objDrawing->setWidth(138); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);
 
$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:L4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($empresa_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:L5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Pacientes Seguimiento");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila");

$fila=5;
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("A5:A6"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha Registro');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B6"); //unir celdas  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Paciente');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->mergeCells("C5:C6"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Genero');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("D5:E5"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->mergeCells("F5:F6"); //unir celdas 
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Fecha Nacimiento');
$objPHPExcel->getActiveSheet()->mergeCells("G5:G6"); //unir celdas 
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Teléfono');
$objPHPExcel->getActiveSheet()->mergeCells("H5:H6"); //unir celdas 
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Departamento');
$objPHPExcel->getActiveSheet()->mergeCells("I5:I6"); //unir celdas 
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Municipio');
$objPHPExcel->getActiveSheet()->mergeCells("J5:J6"); //unir celdas 
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Localidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
$objPHPExcel->getActiveSheet()->mergeCells("K5:K6"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("L5:L6"); //unir celdas 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A5:L6"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A5:L6")->getFont()->setBold(true); //negrita
 
$fila=6;
//GENERO
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("D6:D6"); //unir celdas 

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("E6:E6"); //unir celdas 

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A6:L6"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A6:L6")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){	   
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
	   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['fecha_registro']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['paciente']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['h']);
       $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['m']);
	   	   
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("F$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("F$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	   	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['fecha_nacimiento']);
       $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['telefono']);	   
       $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['departamento']);
       $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['municipio']);
       $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['localidad']);
       $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['usuario']); 
	     
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:L$fila");	
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
header('Content-Disposition: attachment; filename="PACIENTES SEGUIMIENTO '.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>