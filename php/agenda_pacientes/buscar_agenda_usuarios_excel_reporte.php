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
$atencion = $_GET['atencion'];
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

if($status == 0){//PENDIENTES
	$in = "IN(0)";
}else if($status == 1){//ATENDIDOS
	$in = "IN(1)";		
}else if($status == 2){//AUSENCIAS
	$in = "IN(2)";		
}else if($status == 3){//ELIMINADOS
	$in = "IN(3)";		
}else if($status == 4){//SEGUIMIENTO
	$in = "IN(4)";		
}else if($status == 5){//AGENDA
	$in = "IN(0,1,2)";		
}

if($atencion == 0){
   $atencion_nombre = "Pendientes.";
}

if($atencion == 1){
   $atencion_nombre = "Atendidos.";
}

if($atencion == 2){
   $atencion_nombre = "Ausentes.";
}

if($atencion == 3){
   $atencion_nombre = "Agenda.";
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
$result = $mysqli->query($consulta_servicio) or die($mysqli->error);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_nombre = "";

if($result->num_rows>0){
   $servicio_nombre = $consulta_servicio1['nombre'];
}

//CONSULTAR PUESTO
$consulta_puesto = "SELECT nombre 
    FROM puesto_colaboradores 
	WHERE puesto_id = '$unidad'";
$result = $mysqli->query($consulta_puesto) or die($mysqli->error);
$consulta_puesto1 = $result->fetch_assoc();
$puesto_nombre = "";

if($result->num_rows>0){
	$puesto_nombre = $consulta_puesto1['nombre'];
}
	
//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if($unidad == ""){
	$where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.servicio_id = '$servicio' AND a.status $in";
	
	if ($atencion == 1){
		$where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.servicio_id = '$servicio' AND a.status $in AND hora <> '00:00'";
	}
	
	if ($atencion == 3){
		$where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.servicio_id = '$servicio' AND a.status $in AND hora <> '00:00'";
	}
}else if($medico_general == "" && $unidad != ""){
	$where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.servicio_id = '$servicio' AND pc.puesto_id = '$unidad' AND a.status $in AND hora <> '00:00'";

	if ($atencion == 1){
	    $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.servicio_id = '$servicio' AND pc.puesto_id = '$unidad' AND a.status $in AND hora <> '00:00'";		
	}	
	
	if ($atencion == 3){
	    $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.servicio_id = '$servicio' AND pc.puesto_id = '$unidad' AND a.status $in AND hora <> '00:00'";		
	}	
}else{
    //CONSULTAR NOMBRE COLABORADOR
    $consulta_colaborador = "SELECT CONCAT(nombre,' ',apellido) AS 'nombre' 
	    FROM colaboradores 
		WHERE colaborador_id = '$id'";
	$result = $mysqli->query($consulta_colaborador) or die($mysqli->error);
    $consulta_colaborador1 = $result->fetch_assoc();
	
	$colaborador_nombre = "";
	
	if($result->num_rows>0){
		$colaborador_nombre = $consulta_colaborador1['nombre'];
	}
		
	$where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND c.colaborador_id = '$medico_general' AND a.servicio_id = '$servicio' AND a.status $in'";
	
	if ($atencion == 1){
	    $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND c.colaborador_id = '$medico_general' AND a.servicio_id = '$servicio' AND a.status $in AND hora <> '00:00''";
	}	
	
	if ($atencion == 3){
	    $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND c.colaborador_id = '$medico_general' AND a.servicio_id = '$servicio' AND a.status $in AND hora <> '00:00''";
	}	
}
//REGISTROS

$registro = "SELECT DISTINCT p.identidad AS 'identidad', a.expediente AS 'expediente', p.nombre AS 'nombre', p.apellido AS 'apellido', a.hora AS 'hora', DATE_FORMAT(a.fecha_cita, '%d/%m/%Y') AS 'fecha',
	   CONCAT(c.nombre, ' ', c.apellido) As doctor, p.telefono AS 'telefono', p.telefono1 AS 'telefono1', p.telefonoresp AS 'telefonoresp',
	   p.telefonoresp1 AS 'telefonoresp1', c.colaborador_id AS 'colaborador_id', a.observacion as 'observacion', a.comentario as 'comentario', conf_agenda.confirmo AS 'confirmo_resp', conf_agenda.observacion AS 'confirmo_observacion'
       FROM agenda AS a 
       INNER JOIN pacientes AS p 
       ON a.pacientes_id = p.pacientes_id 
       INNER JOIN colaboradores AS c 
       ON a.colaborador_id = c.colaborador_id
	   INNER JOIN puesto_colaboradores AS pc
	   ON c.puesto_id = pc.puesto_id
       LEFT JOIN confirmacion_agenda AS conf_agenda
       ON a.agenda_id = conf_agenda.agenda_id  	   
       ".$where."
       ORDER BY a.fecha_cita, c.colaborador_id ASC";
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
$objPHPExcel->getActiveSheet()->setTitle("AGENDA DIARIA USUARIOS"); //establecer titulo de hoja
 
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
$objDrawing->setCoordinates('P1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($empresa_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "REPORTE AGENDA DE USUARIOS. ".strtoupper($servicio_nombre).", UNIDAD: ".strtoupper($puesto_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "PROFESIONAL: ".strtoupper($colaborador_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "USUARIOS ".strtoupper($atencion_nombre)." ".strtoupper($mes)." $dia, $año Hasta".strtoupper($mes1)." $dia1, $año1");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Expediente');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nombre');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Apellido');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Fecha Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12); 
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Hora');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8); 
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Medico');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Teléfono1');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Teléfono2');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Teléfono3');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Teléfono4');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Observación');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(70);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Comentario');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(70);
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Confirmo');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Confirmación Observación');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);	
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:P$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:P$fila")->getFont()->setBold(true); //negrita

$valor = 1;
if($result->num_rows>0){
	while($registro1 = $result->fetch_assoc()){
      if ($registro1['telefono']=="" || $registro1['telefono']==0)
		  $telefono = "";
	  else
		  $telefono = $registro1['telefono'];
	  
      if ($registro1['telefono1']=="")
		  $telefono1 = "";
	  else
		  $telefono1 = $registro1['telefono1'];	  
	  
	  
      if ($registro1['telefonoresp']=="" || $registro1['telefonoresp']==0)
		  $telefonoresponsable = "";
	  else
	     $telefonoresponsable = $registro1['telefonoresp'];
	 
      if ($registro1['telefonoresp1']=="" || $registro1['telefonoresp1']==0)
		  $telefonoresponsable1 = "";
	  else
	     $telefonoresponsable1 = $registro1['telefonoresp1'];	 
	  
	  if ($registro1['expediente'] == 0){
		  $expediente = "TEMP"; 
	  }else{
		  $expediente = $registro1['expediente'];
	  }		  

	  $fecha = date('Y-m-d',strtotime($registro1['fecha']));	  
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
	   
	       if( strlen($registro1['identidad'])<10 ){
		      $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
    	   }else{
		      $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", $registro1['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	       }		   
           
	       if($registro1['confirmo_resp'] == 1){
		       $resp = "Sí";
	       }else if($registro1['confirmo_resp'] == 2){
		       $resp = "No";
	       }else{
			  $resp = ""; 
		   }
			   
		   $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $expediente);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro1['nombre']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro1['apellido']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro1['fecha']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro1['hora']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro1['doctor']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $telefono);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $telefono1);
		   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $telefonoresponsable);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $telefonoresponsable1);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro1['observacion']);
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro1['comentario']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $resp);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro1['confirmo_observacion']);		   
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:P$fila");			   
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