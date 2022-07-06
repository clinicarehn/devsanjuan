<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$desde = '2017-01-01';
$hasta = '2017-07-31';
$unidad = 2;
$servicio = 1;
$colaborador = '';

//OBTENER NOMBRE SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_name = $consulta_servicio1['nombre'];

//OBTENER NOMBRE UNIDAD
$consulta_unidad = "SELECT nombre 
       FROM puesto_colaboradores 
	   WHERE puesto_id = '$unidad'";
$result = $mysqli->query($consulta_unidad);
$consulta_unidad1 = $result->fetch_assoc();
$unidad_name = $consulta_unidad1['nombre'];

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

$colaborador_name = "";
	
if ($servicio != "" && $unidad !="" && $colaborador == ""){
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad'";
}else if ($servicio != "" && $unidad !="" && $colaborador !=""){
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND c.colaborador_id = '$colaborador'";	
   //OBTENER NOMBRE UNIDAD
    $consulta_colaborador_nombre = "SELECT CONCAT(nombre,' ',apellido) as 'nombre' 
	     FROM colaboradores 
		 WHERE colaborador_id = '$colaborador'";
	$result = $mysqli->query($consulta_colaborador_nombre);
    $consulta_colaborador_nombre1 = $result->fetch_assoc();
    $colaborador_name = strtoupper($consulta_colaborador_nombre1['nombre']);   
}else{
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio'";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT DISTINCT CONCAT(p.apellido,' ',p.nombre) AS 'Nombre', p.expediente AS 'Expediente', p.identidad AS 'Identidad', a.años AS 'Edad',
     p.sexo AS 'sexo',
     a.paciente AS 'paciente',
     d.nombre AS 'Procedencia',
     pa.patologia_id AS 'Codigo_CIE-10', pa1.patologia_id AS 'Codigo_CIE-101', pa2.patologia_id AS 'Codigo_CIE-102', 
     pa.nombre AS 'Diagnostico_CIE-10', a.referencia_mayor AS 'referencia_mayor', a.respuesta1 AS 'respuesta1', a.respuesta2 AS 'respuesta2', tiempo_estancia
     FROM ata AS a
     LEFT JOIN pacientes AS p
     ON a.expediente = p.expediente
     LEFT JOIN departamentos AS d
     ON a.departamento_id = d.departamento_id
     LEFT JOIN patologia AS pa
     ON a.patologia_id = pa.id
     LEFT JOIN patologia AS pa1
     ON a.patologia_id1 = pa1.id 
     LEFT JOIN patologia AS pa2
     ON a.patologia_id2 = pa2.id 	 
     LEFT JOIN colaboradores AS c
     ON a.colaborador_id = c.colaborador_id
     LEFT JOIN servicios AS s
     ON a.servicio_id = s.servicio_id	 
     ".$where."
     ORDER BY p.expediente";
$result = $mysqli->query($registro);
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("CONSOLIDADO ".strtoupper($unidad_name)); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("CONSOLIDADO ".strtoupper($unidad_name)); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
 
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
$objDrawing->setHeight(40); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/SJD.jpg'); //ruta
$objDrawing->setHeight(40); //altura
$objDrawing->setCoordinates('M1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 9);
 
$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:N3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Lic. Glenda Melissa Garcia Zelaya");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:N$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:N$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:N4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "GESTOR: HOSPITAL SAN JUAN DE DIOS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:N$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:N$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:N5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "FORMATO 2 Atenciones en ".$servicio_name." $unidad_name Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:N$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:N$fila");

$fila=6;
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'NOMBRE COMPLETO DEL (LA) PACIENTE');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30); 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'No de Expediente');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'NUMERO DE IDENTIDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(28);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'EDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Sexo');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Paciente');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Procedencia');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(13);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Tiempo estancia');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Código CIE-10');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(18);
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Diagnostico Completo según CIE-10');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(29);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Referencia a nivel de mayor complejidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Respuesta a referencia de Primer Nivel');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Respuesta a referencia de Segundo Nivel');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:N$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:N$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
		
	   $patologia = $registro2['Codigo_CIE-10'];
       /*	   
       if($registro2['Codigo_CIE-101']==""){
	      $patologia = $registro2['Codigo_CIE-10'];
	   }else if($registro2['Codigo_CIE-101']!="" && $registro2['Codigo_CIE-102']==""){
		   $patologia = $registro2['Codigo_CIE-10'].'/'.$registro2['Codigo_CIE-101'];		   
	   }else{
	      $patologia = $registro2['Codigo_CIE-10'].'/'.$registro2['Codigo_CIE-101'].'/'.$registro2['Codigo_CIE-102'];
	   }
	   */
	   
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['Nombre']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['Expediente']);
	   
	   if( strlen($registro2['Identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", $registro2['Identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	   	   
       $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['Edad']);
       $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['sexo']);
       $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['paciente']);
       $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['Procedencia']);
       $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['tiempo_estancia']);
       $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $patologia);
       $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['Diagnostico_CIE-10']); 
       $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['referencia_mayor']); 	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['respuesta1']); 
	   $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['respuesta2']); 
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:N$fila");	
	   $valor++;
   }	
}

$fila+=3; 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "Lic. Glenda Melissa Garcia Zelaya");
$objPHPExcel->getActiveSheet()->mergeCells("E$fila:I$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($texto, "E$fila:I$fila");
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
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="CONSOLIDADO '.strtoupper($servicio_name).' '.strtoupper($unidad_name).' '.$colaborador_name.' '.strtoupper($mes).'_'.$año.'.xls"');
//**********************************************************************
 
//****************Guardar como excel 2007*******************************
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //Escribir archivo
//
//// Establecer formado de Excel 2007
//header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//
//// nombre del archivo
//header('Content-Disposition: attachment; filename="kiuvox.xlsx"');
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>