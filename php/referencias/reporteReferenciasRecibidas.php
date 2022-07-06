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
$servicio = $_GET['servicio'];
$nombre_servicio = "";	

if($servicio != 0){
	$consultar_servicio = "SELECT nombre 
	    FROM servicios 
		WHERE servicio_id = '$servicio'";
	$result = $mysqli->query($consultar_servicio);
	$consultar_servicio1 = $result->fetch_assoc();
	$nombre_servicio = $consultar_servicio1['nombre'];	
	$where = "WHERE rr.servicio_id = '$servicio' AND rr.fecha BETWEEN '$desde' AND '$hasta'";
}else{
	$where = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta'";
}		

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

$registro = "SELECT DATE_FORMAT(rr.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.identidad AS 'identidad', rr.expediente AS 'expediente', d.nombre AS 'departamento', m.nombre AS 'municipio', rr.clinico AS 'clinico', pa.patologia_id AS 'patologia_id', pa.nombre AS 'patologia', CONCAT(s.nombre,' ',pc.nombre) AS 'especialidad', rr.motivo_referencia AS 'motivo', ch.centro_nombre AS 'unidad_envia', CONCAT(c.apellido,' ',c.nombre) AS 'colaborador', (CASE WHEN rr.respuesta = 'Sí' THEN 'X' ELSE '' END) AS 'si',
(CASE WHEN rr.respuesta = 'No' THEN 'X' ELSE '' END) AS 'no', ch.centro_nombre AS 'unidad_respuesta', p.sexo AS 'sexo', rr.edad AS 'edad'
FROM referencia_recibida AS rr
INNER JOIN pacientes AS p
ON rr.expediente = p.expediente
INNER JOIN departamentos AS d
ON p.departamento_id = d.departamento_id
INNER JOIN municipios AS m
ON p.municipio_id = m.municipio_id
INNER JOIN patologia AS pa
ON rr.patologia_id = pa.id
INNER JOIN servicios AS s
ON rr.servicio_id = s.servicio_id
INNER JOIN colaboradores AS c
ON rr.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
INNER JOIN centros_hospitalarios AS ch
ON rr.unidad_envia = ch.centros_id
INNER JOIN colaboradores AS c1
ON rr.usuario = c1.colaborador_id
".$where."
ORDER BY rr.fecha, rr.servicio_id";
$result = $mysqli->query($registro);
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Referencias Recibidas"); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 12
    )
));
 
$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
      'size' => 11
    ),	
	'alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'bfbfbf')
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
$objPHPExcel->getActiveSheet()->setTitle("Referencias Recibidas"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('F7'); //INMOVILIZA PANELES
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

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('Q1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:S3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:S$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:S$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:R4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Registro de Referencias Recibidas y Respuestas Enviadas $nombre_servicio");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:S$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:S$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:R5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:S$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:S$fila");

$fila=4;
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("A4:A6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13); 
$objPHPExcel->getActiveSheet()->mergeCells("B4:B6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Nombre Completo del Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35); 
$objPHPExcel->getActiveSheet()->mergeCells("C4:C6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("D4:D6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Expediente');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->mergeCells("E4:E6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Procedencia');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("F4:G5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->mergeCells("H4:H6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Sexo');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
$objPHPExcel->getActiveSheet()->mergeCells("I4:I6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Diagnostico');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("J4:L5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Especialidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("M4:M6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Motivo de la Referencia');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(24);
$objPHPExcel->getActiveSheet()->mergeCells("N4:N6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Unidad que Envía la Referencia');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(18);
$objPHPExcel->getActiveSheet()->mergeCells("O4:O6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Persona que Registra');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(18);
$objPHPExcel->getActiveSheet()->mergeCells("P4:P6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Se brinda respuesta');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("Q4:R5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'Unidad donde se envía la Respuesta');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(24);
$objPHPExcel->getActiveSheet()->mergeCells("S4:S6"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:S$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:S$fila")->getFont()->setBold(true); //negrita

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Departamento');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Municipio');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Clínico');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'CIE-10');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Diagnostico Completo CIE-10');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(23);
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Sí');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'No');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(5);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:S$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:S$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['fecha']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['nombre']);
	   
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	   	   
	   if ($registro2['sexo'] == 'H'){
		   $sexo = 'Hombre';
	   }else{
		   $sexo = 'Mujer';
	   }	  
	   
       $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['expediente']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['departamento']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['municipio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['edad']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $sexo);
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['clinico']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['patologia_id']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['patologia']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['especialidad']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['motivo']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro2['unidad_envia']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro2['usuario']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro2['si']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro2['no']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro2['unidad_respuesta']);
	   
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:S$fila");	
	   $valor++;
   }	
}
 
$fila+=5; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "HSJD_".strtoupper($mes)."_$año");
$fila+=1; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Nombre y Firma del Responsable __________________________________________________________________________________"); 
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
header('Content-Disposition: attachment; filename="Referencias Recibidas '.$nombre_servicio.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>