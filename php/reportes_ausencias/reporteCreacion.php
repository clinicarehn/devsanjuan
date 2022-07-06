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
$unidad = $_GET['unidad'];
$profesional = $_GET['profesional'];
$reporte = $_GET['reporte'];
$colaborador_usuario = $_GET['colaborador_usuario'];

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

//OBTENER NOMBRE SERVICIO
$consulta_servicio = "SELECT nombre 
     FROM servicios 
	 WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_name = $consulta_servicio1['nombre'];

$colaborador_name = "";
$atencion = "";

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

if($servicio != "" && $unidad == "" && $profesional == "" && $reporte != "" && $colaborador_usuario == ""){
  $where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio'";		
}else if ($servicio != "" && $unidad != "" && $profesional == "" && $reporte != "" && $colaborador_usuario == ""){
  $where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad'";				
}else if ($servicio != "" && $unidad != "" && $profesional != "" && $reporte != "" && $colaborador_usuario == ""){
  $where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND c.colaborador_id = '$profesional'";
}else{
	//OBTENERR NOMBRE COLABORADOR/USUARIO DEL SISTEMA
    $consulta_colaborador_nombre = "SELECT CONCAT(apellido,' ',nombre) AS 'usuario' 
	     FROM colaboradores 
	     WHERE colaborador_id = '$colaborador_usuario'";
	$result = $mysqli->query($consulta_colaborador_nombre);
    $consulta_colaborador_nombre2 = $result->fetch_assoc();
    $colaborador_name = $consulta_colaborador_nombre2['usuario'];
	
	$atencion = " Realizado por: ".$colaborador_name;
	
    $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.usuario = '$colaborador_usuario'";	
}
	
$registro = "SELECT a.agenda_id AS 'agenda_id', DATE_FORMAT(CAST(a.fecha_cita AS DATE ), '%d/%m/%Y') AS 'fecha_cita', DATE_FORMAT(CAST(a.fecha_registro AS DATE ), '%d/%m/%Y') AS 'fecha_registro', p.identidad AS 'identidad', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', a.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', (CASE WHEN a.paciente = 'N' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', a.observacion AS 'observacion', a.comentario AS 'comentario', CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', a.status AS 'status'
       FROM agenda AS a
       INNER JOIN pacientes AS p
       ON a.pacientes_id = p.pacientes_id
       INNER JOIN colaboradores AS c
       ON a.colaborador_id = c.colaborador_id
       INNER JOIN servicios s
       ON a.servicio_id = s.servicio_id
	   INNER JOIN colaboradores AS c1
	   ON a.usuario = c1.colaborador_id		   
	   ".$where."
	   ORDER BY a.fecha_cita ASC";
$result = $mysqli->query($registro);	   
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Reporte Pendientes"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Reporte Pendientes"); //establecer titulo de hoja
 
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
$objDrawing->setHeight(160); //altura
$objDrawing->setWidth(160); //anchura
$objDrawing->setCoordinates('P1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(160); //altura
$objDrawing->setWidth(160); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:P3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Hospital San Juan de Dios");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:N4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Registro de Usuarios Pendientes $servicio_name");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:N5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:N5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $atencion);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->mergeCells("A5:A6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha Creación');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Fecha Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("C5:C6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nombre del Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(45); 
$objPHPExcel->getActiveSheet()->mergeCells("D5:D6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Expediente');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13); 
$objPHPExcel->getActiveSheet()->mergeCells("E5:E6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->mergeCells("F5:F6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Sexo');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(16);
$objPHPExcel->getActiveSheet()->mergeCells("G5:H5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Paciente');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$objPHPExcel->getActiveSheet()->mergeCells("I5:J5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Estatus');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("K5:K6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Servicio');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
$objPHPExcel->getActiveSheet()->mergeCells("L5:L6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Profesional');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(35);
$objPHPExcel->getActiveSheet()->mergeCells("M5:M6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Observacion');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
$objPHPExcel->getActiveSheet()->mergeCells("N5:N6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Comentario');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
$objPHPExcel->getActiveSheet()->mergeCells("O5:O6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
$objPHPExcel->getActiveSheet()->mergeCells("P5:P6"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:P$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:N$fila")->getFont()->setBold(true); //negrita

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Hombre');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Mujer');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:P$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:P$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   $fila+=1;
	    if($registro2['expediente'] == 0){
			$expediente = 'TEMP';
		}else{
			$expediente = $registro2['expediente'];
		}
		
		if($registro2['status'] == 0){
			$status = 'Pendiente';
		}else if($registro2['status'] == 1){
			$status = 'Atendido';
		}if($registro2['status'] == 2){
			$status = 'Ausente';
		}
		
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['fecha_registro']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['fecha_cita']);	   
       $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['nombre']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $expediente);
	   		
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("F$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("F$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	          
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['h']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['m']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['nuevo']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['subsiguiente']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $status);	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['servicio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['medico']);
       $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['observacion']);	
       $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro2['comentario']);
       $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro2['usuario']);	   
	   
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:P$fila");	
	   $valor++;
   }	
}
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
$fila+=5; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "HSJD_".strtoupper($mes)."_$año");
$fila+=1; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Nombre y Firma del Responsable __________________________________________________________________________________");
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
header('Content-Disposition: attachment; filename="Reporte de Usuarios Pendientes '.$servicio_name.' '.$mes.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>