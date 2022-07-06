<?php
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$servicio = $_GET['servicio'];
$desde = $_GET['fechai'];
$hasta = $_GET['fechaf'];

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

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

if($servicio == ""){
	$where = "WHERE t.fecha BETWEEN '$desde' AND '$hasta'";
}else{
		//OBTENER NOMBRE SERVICIO
		$consulta_servicio = "SELECT nombre 
			FROM servicios 
			WHERE servicio_id = '$servicio'";
		$result_servicio = $mysqli->query($consulta_servicio);
		$consulta_servicio1 = $result_servicio->fetch_assoc();
		$servicio_name = $consulta_servicio1['nombre'];

	$where = "WHERE t.fecha BETWEEN '$desde' AND '$hasta' AND t.servicio_id = '$servicio'";		
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
//CONSULTAR COLABORADORES
$query = "SELECT t.fecha AS 'fecha_cita', p.expediente, p.identidad, CONCAT(p.nombre,' ',p.apellido) AS 'nombre_usuario', 
	(CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h',
	(CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm',
	(CASE WHEN t.tipo_id = '1' THEN 'X' ELSE '' END) AS 'no_asiste',
	(CASE WHEN t.tipo_id = '2' THEN 'X' ELSE '' END) AS 'receta',
	(CASE WHEN t.tipo_id = '3' THEN 'X' ELSE '' END) AS 'atencion',
	(CASE WHEN t.observacion = '1' THEN 'X' ELSE '' END) AS 'no_contesto',
	(CASE WHEN t.observacion = '2' THEN 'X' ELSE '' END) AS 'no_asistira',
	(CASE WHEN t.observacion = '3' THEN 'X' ELSE '' END) AS 'asistira_familiar',
	(CASE WHEN t.observacion = '4' THEN 'X' ELSE '' END) AS 'asistira_usuario',
	(CASE WHEN t.informacion = '1' THEN 'X' ELSE '' END) AS 'nadie',	
	(CASE WHEN t.informacion = '2' THEN 'X' ELSE '' END) AS 'familiar',
	(CASE WHEN t.informacion = '3' THEN 'X' ELSE '' END) AS 'usuario',
	t.comentario AS 'comentario'
	FROM triage AS t
	INNER JOIN pacientes AS p
	ON t.pacientes_id = p.pacientes_id
	".$where."
	ORDER BY t.fecha"; 
		
$result = $mysqli->query($query);
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Agenda"); //titulo
 
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
      'size' => 11
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
$objPHPExcel->getActiveSheet()->setTitle("Agenda"); //establecer titulo de hoja
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
$objDrawing->setWidth(14); //altura
$objDrawing->setHeight(40); //altura
$objDrawing->setCoordinates('R1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setWidth(14); //altura
$objDrawing->setHeight(40); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A1:R1");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:R$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:R$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A2:R2");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Instrumento de Llenado telefónico $servicio_name");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:R$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:R$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:R3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:R$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:R$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("A5:A6"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha de Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B6"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Expediente');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("C5:C6"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("D5:D6"); //unir celdas  
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Nombre de Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(45);
$objPHPExcel->getActiveSheet()->mergeCells("E5:E6"); //unir celdas  
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Sexo');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("F5:G5"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Usuario Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(29);
$objPHPExcel->getActiveSheet()->mergeCells("H5:J5"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Observaciones');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(38);
$objPHPExcel->getActiveSheet()->mergeCells("K5:N5"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Quien Brinda Información');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
$objPHPExcel->getActiveSheet()->mergeCells("O5:Q5"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'Comentario');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(35);
$objPHPExcel->getActiveSheet()->mergeCells("R5:R6"); //unir celdas 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:R$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:R$fila")->getFont()->setBold(true); //negrita
 
$fila=6; 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'No contesto');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(11); 
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Receta');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(7); 
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Atención Médica');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(11); 

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'No contesto');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'No asistira');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8); 
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Asistira Familiar');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Asistira Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10); 

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Nadie');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(7); 
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Familiar');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(9);
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(9); 

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:R$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:R$fila")->getFont()->setBold(true); //negrita
//rellenar con contenido
$valor = 1;

if($result->num_rows>0){
	while($registro1 = $result->fetch_assoc()){
		$fila+=1;
		
		if($registro1['expediente'] == 0){
			$expediente = 'TEMP';
		}else{
			$expediente = $registro1['expediente'];
		}

		$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
		$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro1['fecha_cita']);
		$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $expediente);
		
		if( strlen($registro1['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
		 }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", $registro1['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
		}
		
		$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro1['nombre_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro1['h']);
		$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro1['m']);
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro1['no_asiste']);		
		$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro1['receta']);
		$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro1['atencion']);
		$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro1['no_contesto']);
		$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro1['no_asistira']);
		$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro1['asistira_familiar']);
		$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro1['asistira_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro1['nadie']);		
		$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro1['familiar']);
		$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro1['usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro1['comentario']);
		//Establecer estilo
		$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:R$fila");	
		$valor++;		
	}
}
/************Guardar como excel 2003*********************************/
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
header('Content-Disposition: attachment; filename="Reporte de Triage '.$servicio_name.' '.$mes.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************

//forzar a descarga por el navegador
$objWriter->save('php://output');
exit();

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>