<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";

//OBTENER NOMBRE DE EMPRESA
$usuario = $_SESSION['colaborador_id'];	

$mes="";
$mes1="";
$año="";
$año2="";
$año_consulta = 2019;

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$query_departamentos = "SELECT * FROM departamentos";
$result_departamentos = $mysqli->query($query_departamentos);
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("PROCEDENCIA USUARIO" ); //titulo
 
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

$titulo1 = new PHPExcel_Style(); //nuevo estilo
$titulo1->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false
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
$objPHPExcel->getActiveSheet()->setTitle("PROCEDENCIA USUARIOS"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('A9'); //INMOVILIZA PANELES 
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
$objDrawing->setCoordinates('C1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 8);

$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "PATLOGIAS DE USUARIOS POR PROCEDENCIA");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "SERVICIO: CONSULTA EXTERNA (ADULTOS Y NIÑOS), MAIDA Y SALÓN DEL HUÉSPED");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");
 
$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Desde: AÑO $año_consulta Hasta: AÑO $año_consulta");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "B$fila:C$fila");

$fila+=1;
$total_departamentos = 0;
//DEPARTAMENTOS DE HONDURAS
while($registro_departamentos1 = $result_departamentos->fetch_assoc()){
	$fila+=1;
	$departamento_id = $registro_departamentos1['departamento_id'];
	$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($registro_departamentos1['nombre']));
	$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:C$fila"); //establecer estilo
	$objPHPExcel->getActiveSheet()->mergeCells("A$fila:C$fila"); //unir celdas
	$objPHPExcel->getActiveSheet()->getStyle("A$fila:C$fila")->getFont()->setBold(true); //negrita	
	$fila+=1;
	
	//OBTENEMOS LAS CANTIDAD DE PATOLOGIAS POR EL DEPARTAMENTO CONSULTADO
	$registro_patologias_departamentos = "SELECT p.nombre AS 'patologia', COUNT(a.patologia_id) as 'total', p.patologia_id AS 'patologia_id'
		FROM ata AS a
		INNER JOIN patologia AS p
		ON a.patologia_id = p.id
		WHERE YEAR(a.fecha) = '$año_consulta' AND a.servicio_id IN(1,3,4,6) AND a.departamento_id = '$departamento_id'
		GROUP BY a.patologia_id
		ORDER BY COUNT(a.patologia_id) DESC LIMIT 5";
	$result_patologias_departamentos = $mysqli->query($registro_patologias_departamentos);

	$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'CODIGO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10); 
	$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'PATOLOGIA');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(150); 
	$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CANTIDAD');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
	$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:C$fila"); //establecer estilo
	$objPHPExcel->getActiveSheet()->getStyle("A$fila:D$fila")->getFont()->setBold(true); //negrita	

	while($registro_patologias_departamentos1 = $result_patologias_departamentos->fetch_assoc()){
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro_patologias_departamentos1['patologia_id']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro_patologias_departamentos1['patologia']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro_patologias_departamentos1['total']);
	   $objPHPExcel->getActiveSheet()->getStyle("A$fila:D$fila")->getFont()->setBold(true); //negrita	   
	   //Establecer estilo
	   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:C$fila");		
	   $total_departamentos = $total_departamentos + $registro_patologias_departamentos1['total'];
	}
}

$fila+=3;
$total_muni = 0;
//MUNICIPIOS DE CORTES
$registro_patologias_departamentos_municipios = "SELECT p.nombre AS 'patologia', COUNT(a.patologia_id) as 'total', p.patologia_id AS 'patologia_id'
	FROM ata AS a
	INNER JOIN patologia AS p
	ON a.patologia_id = p.id
	WHERE YEAR(a.fecha) = '$año_consulta' AND a.servicio_id IN(1,3,4,6) AND a.municipio_id IN(68,69,70,71,72,73,74,75,75,77,78,79)
	GROUP BY a.patologia_id
	ORDER BY COUNT(a.patologia_id) DESC LIMIT 5";	
$result_patologias_departamentos_municipios = $mysqli->query($registro_patologias_departamentos_municipios);

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "MUNICIPIOS DEL DEPARTAMENTO DE CORTES");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:C$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:C$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("A$fila:C$fila")->getFont()->setBold(true); //negrita
$fila+=1;	
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'PATOLOGIA');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(150); 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CANTIDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:C$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:D$fila")->getFont()->setBold(true); //negrita	

while($registro_patologias_departamentos_municipios1 = $result_patologias_departamentos_municipios->fetch_assoc()){
   $fila+=1;
   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro_patologias_departamentos_municipios1['patologia_id']);
   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro_patologias_departamentos_municipios1['patologia']);
   $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro_patologias_departamentos_municipios1['total']);
   $objPHPExcel->getActiveSheet()->getStyle("A$fila:D$fila")->getFont()->setBold(true); //negrita	   
   //Establecer estilo
   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:C$fila");		
   $total_muni = $total_muni + $registro_patologias_departamentos_municipios1['total'];
}
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
header('Content-Disposition: attachment; filename="PROCEDENCIA USUARIOS_AÑO_'.$año_consulta.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');


$result_departamentos->free();//LIMPIAR RESULTADO
$result_cortes->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>