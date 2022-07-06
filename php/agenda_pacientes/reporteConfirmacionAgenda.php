<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 
date_default_timezone_set('America/Tegucigalpa');

include "../../PHPExcel/Classes/PHPExcel.php";

$id = $_GET['id'];
$dato = $_GET['dato'];
$fecha = $_GET['fecha'];
$fechaf = $_GET['fechaf'];
$servicio = $_GET['servicio'];
$unidad = $_GET['unidad'];
$medico_general = $_GET['medico_general'];
$atencion_nombre = "";
$status = "";

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

$dia=date("d", strtotime($fecha));
$mes=date("F", strtotime($fecha));
$año=date("Y", strtotime($fecha));

$dia1=date("d", strtotime($fechaf));
$mes1=date("F", strtotime($fechaf));
$año1=date("Y", strtotime($fechaf));
$colaborador_nombre = "";

//CONSULTAR SERVICIO
$consulta_servicio = "SELECT nombre 
   FROM servicios 
   WHERE servicio_id = '$servicio'";
$result_servicio = $mysqli->query($consulta_servicio) or die($mysqli->error);

$servicio_nombre = "";

if($result_servicio->num_rows>0){
  $consulta_servicio = $result_servicio->fetch_assoc();
  $servicio_nombre = $consulta_servicio['nombre'];
}

//CONSULTAR NOMBRE PUESTO
$consulta_servicio = "SELECT nombre 
   FROM puesto_colaboradores 
   WHERE puesto_id = '$unidad'";
$result_servicio = $mysqli->query($consulta_servicio) or die($mysqli->error);

$puesto_nombre = "";

if($result_servicio->num_rows>0){
  $consulta_servicio = $result_servicio->fetch_assoc();
  $puesto_nombre = $consulta_servicio['nombre'];
}

if($servicio != "" && $unidad == "" && $medico_general == ""){
  $where = "WHERE ca.servicio_id = '$servicio' AND CAST(ca.fecha_registro AS DATE) BETWEEN '$fecha' AND '$fechaf'";
}else if($unidad != "" && $medico_general == ""){
  $where = "WHERE ca.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND CAST(ca.fecha_registro AS DATE) BETWEEN '$fecha' AND '$fechaf'"; 
}else if($servicio != "" && $unidad != "" && $medico_general != ""){
  $where = "WHERE ca.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND ca.colaborador_id = '$medico_general' AND CAST(ca.fecha_registro AS DATE) BETWEEN '$fecha' AND '$fechaf'"; 
}else{
  $where = "WHERE CAST(ca.fecha_registro AS DATE) BETWEEN '$fecha' AND '$fechaf'";  
}

$registro = "SELECT ca.confirmacion_agenda_id AS 'confirmacion_agenda_id', CONCAT(p.apellido, ' ' ,p.nombre) AS 'paciente', (CASE WHEN p.expediente = 0 THEN 'TEMP' ELSE p.expediente END) AS 'expediente', p.identidad AS 'identidad', ca.fecha_cita AS 'fecha_cita', ca.fecha_registro AS 'fecha_registro', ca.observacion AS 'observacion', (CASE WHEN ca.confirmo = 1 THEN 'Sí' ELSE 'No' END) AS 'confirmo', ca.telefono AS 'telefono_confirmacion', CONCAT(c.apellido, ' ', c.nombre) AS 'profesional', s.nombre AS 'servicio', CONCAT(c1.apellido, ' ', c1.nombre) AS 'usuario', ca.agenda_id AS 'agenda_id'
  FROM confirmacion_agenda AS ca
  INNER JOIN pacientes AS p
  ON ca.pacientes_id = p.pacientes_id
  INNER JOIN colaboradores AS c
  ON ca.colaborador_id = c.colaborador_id
  INNER JOIN servicios AS s
  ON ca.servicio_id = s.servicio_id
  INNER JOIN colaboradores AS c1
  ON ca.usuario = c1.colaborador_id
  ".$where."
  ORDER BY ca.fecha_registro";
$result = $mysqli->query($registro) or die($mysqli->error);	   

$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("AGENDA DIARIA USUARIOS"); //titulo
 
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
    )
));

$subtitulo1 = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo1->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
      'size' => 12
    ),	
	'alignment' => array( //alineacion
      'wrap' => true
    )
));

$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
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

$totales = new PHPExcel_Style(); //nuevo estilo
$totales->applyFromArray(
  array('font' => array( //fuente
      'bold' => true,
      'size' => 12
    ),
	'borders' => array(
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

$style = new PHPExcel_Style(); //nuevo estilo
$style->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => false,
      'size' => 10
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
$objPHPExcel->getActiveSheet()->setTitle("CONFIRMACION AGENDA"); //establecer titulo de hoja
 
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
//fin: establecer margenes
 
//incluir imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(160); //altura
$objDrawing->setWidth(160); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//incluir la imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(160); //altura
$objDrawing->setWidth(160); //anchura
$objDrawing->setCoordinates('L1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($empresa_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "REPORTE CONFIRMACION AGENDA DE USUARIOS. ".strtoupper($servicio_nombre).", UNIDAD: ".strtoupper($puesto_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "PROFESIONAL: ".strtoupper($colaborador_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "USUARIOS ".strtoupper($atencion_nombre)." ".strtoupper($mes)." $dia, $año Hasta".strtoupper($mes1)." $dia1, $año1");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila");

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha Registro');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Expediente');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Paciente');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(45); 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Fecha Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12); 
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Observación');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45); 
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Confirmo');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Teléfono Confirmación');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20); 
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Profesional');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20); 
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Servicio');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20); 
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:L$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:L$fila")->getFont()->setBold(true); //negrita

$valor = 1;
if($result->num_rows>0){
	while($registro1 = $result->fetch_assoc()){ 
    $fila+=1;
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro1['fecha_registro']);

    if( strlen($registro1['identidad'])<10 ){
      $objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
    }else{
      $objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", $registro1['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
    }		
			   
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro1['expediente']);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro1['paciente']);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro1['fecha_cita']);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro1['observacion']);		   
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro1['confirmo']);
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro1['telefono_confirmacion']);
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro1['profesional']);
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro1['servicio']);
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro1['usuario']);	   
    $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:L$fila");			   
    $valor++;
  }		
}	

$objPHPExcel->removeSheetByIndex(
  $objPHPExcel->getIndex(
      $objPHPExcel->getSheetByName('Worksheet')
  )
);
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setDifferentOddEven(false);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('Página &P / &N'); 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="REPORTE AGENDA DIARIA '.strtoupper($servicio_nombre).' '.strtoupper($puesto_nombre).' '.strtoupper($colaborador_nombre).'_'.strtoupper($mes).' '.$dia.', '.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>