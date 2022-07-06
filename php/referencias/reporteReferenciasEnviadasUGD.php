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

if($servicio !=0){
	$consultar_servicio = "SELECT nombre 
	    FROM servicios 
		WHERE servicio_id = '$servicio'";
	$result = $mysqli->query($consultar_servicio);
	$consultar_servicio1 = $result->fetch_assoc();
	$nombre_servicio = $consultar_servicio1['nombre'];
	
	$where = "WHERE re.servicio_id = '$servicio' AND re.fecha BETWEEN '$desde' AND '$hasta'";
}else{	
	$where = "WHERE re.fecha BETWEEN '$desde' AND '$hasta'";
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

$registro = "SELECT re.expediente AS 'expediente', CONCAT(p.apellido, ' ', p.nombre) AS 'usuario',
(CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h',
(CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm',
a.años AS 'edad', mt.nombre AS 'causa', ch.centro_nombre AS 'centro_refiere', re.fecha AS 'fecha_referencia', rp_re.correo AS 'correo', rp_re.telefono AS 'telefono', 
rp_re.fecha AS 'fecha_respuesta', p.identidad AS 'identidad'
FROM referencia_enviada AS re
INNER JOIN pacientes AS p
ON re.expediente = p.expediente
INNER JOIN ata AS a
ON re.ata_id = a.ata_id
LEFT JOIN motivo_traslado AS mt
ON re.motivo_traslado = mt.motivo_traslado_id
INNER JOIN centros_hospitalarios AS ch
ON re.unidad_envia = ch.centros_id
LEFT JOIN respuesta_re AS rp_re
ON re.referenciar_id = rp_re.referencia_id
".$where."
ORDER BY re.fecha, re.expediente";
$result = $mysqli->query($registro);
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Referencias Enviadas"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Referencias Enviadas"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('D6'); //INMOVILIZA PANELES
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
$objDrawing->setWidth(138); //anchura
$objDrawing->setCoordinates('K1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(160); //altura
$objDrawing->setWidth(138); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:K3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:K$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:K$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:K4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Registro Diario de Referencias Enviadas y Respuestas Recibidas $nombre_servicio");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:K$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:K$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:K5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:K$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:K$fila");

$fila=4;
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("A4:A5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'N° de Expediente o Identidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); 
$objPHPExcel->getActiveSheet()->mergeCells("B4:B5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Nombre Completo del Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45); 
$objPHPExcel->getActiveSheet()->mergeCells("C4:C5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Sexo');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
$objPHPExcel->getActiveSheet()->mergeCells("D4:E4"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("F4:F5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Causa de Referencia');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("G4:G5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'UPSS/ES a la que se refiere (enviadas)');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$objPHPExcel->getActiveSheet()->mergeCells("H4:H5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Fecha de Referencia Enviada');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("I4:I5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'TIC Utilizada');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$objPHPExcel->getActiveSheet()->mergeCells("J4:J5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Fecha de Respuesta Recibida');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("K4:K5"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:K$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:K$fila")->getFont()->setBold(true); //negrita

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(4);
$objPHPExcel->getActiveSheet()->mergeCells("D5:D5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(4);
$objPHPExcel->getActiveSheet()->mergeCells("E5:E5"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:K$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:J$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
	   	   
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", $registro2['expediente'], PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	   
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['usuario']);	   
	   	   
       $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['h']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['m']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['edad']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['causa']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['centro_refiere']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['fecha_referencia']);
	   
	   $tic = "";
	   
	   if ($registro2['correo'] == "" && $registro2['telefono'] != ""){
            $tic = 	$registro2['telefono'];	   
	   }else if ($registro2['correo'] != "" && $registro2['telefono'] == ""){
            $tic = 	$registro2['correo'];	   
	   }else if ($registro2['correo'] != "" && $registro2['telefono'] != ""){
            $tic = 	$registro2['correo'].", ".$registro2['telefono'];	   
	   }else{
		   $tic = "";
	   }
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $tic);	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['fecha_respuesta']);
	   
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:K$fila");	
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
header('Content-Disposition: attachment; filename="Referencias Enviadas UGD '.$nombre_servicio.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>