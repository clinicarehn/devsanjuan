<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$servicio = $_GET['servicio'];	

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

if($servicio !=0){
	$where = "WHERE rc.fecha BETWEEN '$desde' AND '$hasta' AND rc.servicio_id = '$servicio'";
	$where1 = "WHERE rc.fecha BETWEEN '$desde' AND '$hasta' AND d.departamento_id = 5 AND rc.servicio_id = '$servicio'";
}else{
	$where = "WHERE rc.fecha BETWEEN '$desde' AND '$hasta'";
	$where1 = "WHERE rc.fecha BETWEEN '$desde' AND '$hasta' AND d.departamento_id = 5";
}	

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$registro_departamentos = "SELECT d.nombre as departamento, COUNT(p.departamento_id) as total
    FROM referencia_recibida AS rc 
    INNER JOIN pacientes AS p 
    on rc.expediente = p.expediente 
    INNER JOIN municipios AS m 
    ON p.municipio_id = m.municipio_id 
    INNER JOIN departamentos AS d 
    ON p.departamento_id = d.departamento_id 
    ".$where."
    GROUP BY d.departamento_id 
	ORDER BY total DESC";
$result_departamentos = $mysqli->query($registro_departamentos); 

//MUNICIPIOS DE CORTES
$registro_cortes = "SELECT m.nombre as municipios, COUNT(p.municipio_id) as total
   FROM referencia_recibida AS rc
   INNER JOIN pacientes AS p
   ON rc.expediente = p.expediente
   INNER JOIN municipios AS m
   ON p.municipio_id = m.municipio_id
   INNER JOIN departamentos AS d
   ON p.departamento_id = d.departamento_id
   ".$where1."
   GROUP BY m.municipio_id
   ORDER BY total DESC";
$result_cortes = $mysqli->query($registro_cortes); 

 
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

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($empresa_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "PROCEDENCIA DE USUARIOS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "REFERENCIAS RECIBIDAS Y RESPUESTAS ENVIADAS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");

$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "B$fila:C$fila");

$fila=8;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'DEPARTAMENTOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40); 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CANTIDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:C$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("C$fila:D$fila")->getFont()->setBold(true); //negrita

//rellenar con contenido
$valor = 1;
$total = 0; $totalnh = 0; $totalnm = 0; $totalsh = 0; $totalsm = 0; $totalt = 0; $totalm = 0;
if($result_departamentos->num_rows>0){
	//DEPARTAMENTOS
	if($result_departamentos->num_rows>0){
		while($registro_departamentos1 = $result_departamentos->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro_departamentos1['departamento']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro_departamentos1['total']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:C$fila");		
	       $valor++;
		   $total = $total + $registro_departamentos1['total'];
     }	
   }	
   
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $total);
$objPHPExcel->getActiveSheet()->setSharedStyle($totales, "B$fila:C$fila"); //establecer estilo	

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'MUNICIPIOS DE CORTES');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($totales, "B$fila:C$fila"); //establecer estilo

if($result_cortes->num_rows>0){
	if($result_cortes->num_rows>0){
		while($registro_cortes1 = $result_cortes->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro_cortes1['municipios']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro_cortes1['total']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:C$fila");	
	       $valor++;
		   $totalm = $totalm + $registro_cortes1['total'];
     }	
   }
}
}
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TOTAL MUNICIPIOS DE CORTES');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $totalm);
$objPHPExcel->getActiveSheet()->setSharedStyle($totales, "B$fila:C$fila"); //establecer estilo	
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
header('Content-Disposition: attachment; filename="PROCEDENCIA USUARIOS RR '.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$result_departamentos->free();//LIMPIAR RESULTADO
$result_cortes->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>