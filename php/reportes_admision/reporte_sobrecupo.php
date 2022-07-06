<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$desde = $_GET['fechai'];
$hasta = $_GET['fechaf'];
$servicio = $_GET['servicio'];
$unidad = $_GET['unidad'];
$profesional = $_GET['medico_general'];

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

//OBTENER NOMBRE SERVICIO
$consulta_servicio = "SELECT nombre 
     FROM servicios 
	 WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_name = $consulta_servicio1['nombre'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

if($servicio != "" && $unidad == "" && $profesional == ""){
    $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND color = '#824CC8'";		
}else if ($servicio != "" && $unidad != "" && $profesional == ""){
    $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND c.puesto_id = '$unidad' AND color = '#824CC8'";				
}else{
    $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND c.puesto_id = '$unidad' AND c.colaborador_id = '$profesional' AND color = '#824CC8')";
}
	
$registro = "SELECT DATE_FORMAT(CAST(a.fecha_registro AS DATE), '%d/%m/%Y') AS 'fecha_registro', p.expediente As 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS 'paciente', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', pc.nombre AS 'puesto', s.nombre AS 'servicio', CAST(a.fecha_cita AS DATE) AS 'fecha_cita', a.hora AS 'hora', CONCAT(u.nombre,' ',u.apellido) AS 'usuario'
         FROM agenda AS a
         INNER JOIN pacientes AS p
         ON a.pacientes_id = p.pacientes_id
         INNER JOIN colaboradores AS c
         ON a.colaborador_id = c.colaborador_id
         INNER JOIN servicios AS s
         ON a.servicio_id = s.servicio_id
         INNER JOIN puesto_colaboradores As pc
         ON c.puesto_id = pc.puesto_id
         INNER JOIN colaboradores AS u
         ON a.usuario = u.colaborador_id
         ".$where." 
         ORDER BY c.puesto_id, a.fecha_registro"; 
$result = $mysqli->query($registro);		 
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Reporte Asistencias"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Reporte Asistencias"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('F5'); //INMOVILIZA PANELES
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
$objDrawing->setCoordinates('J1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 4);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:K3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Hospital San Juan de Dios");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:K$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:K$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:K4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Registro Sobre Cupo $servicio_name");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:K$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:K$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:K5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:K$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:K$fila");

$fila=4;

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha Registro');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Nombre del Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45); 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Expediente');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13); 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Colaborador');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Puesto');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Servicio');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Fecha Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Hora');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:K$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:K$fila")->getFont()->setBold(true); //negrita
 
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
		
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['fecha_registro']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['paciente']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $expediente);
	   		
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("E$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("E$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	          
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['colaborador']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['puesto']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['servicio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['fecha_cita']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['hora']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['usuario']);	   
	   
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:K$fila");	
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
header('Content-Disposition: attachment; filename="Reporte Sobre Cupo '.$servicio_name.' '.$mes.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>