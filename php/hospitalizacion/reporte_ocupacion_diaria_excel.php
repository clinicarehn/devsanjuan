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

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$registro = "SELECT s.nombre AS 'concepto', 
   SUM(CASE WHEN DAY(hc.fecha) = 1 THEN hc.porcentaje END) AS '1',  
   SUM(CASE WHEN DAY(hc.fecha) = 2 THEN hc.porcentaje END) AS '2',
   SUM(CASE WHEN DAY(hc.fecha) = 3 THEN hc.porcentaje END) AS '3',
   SUM(CASE WHEN DAY(hc.fecha) = 4 THEN hc.porcentaje END) AS '4',
   SUM(CASE WHEN DAY(hc.fecha) = 5 THEN hc.porcentaje END) AS '5',
   SUM(CASE WHEN DAY(hc.fecha) = 6 THEN hc.porcentaje END) AS '6',
   SUM(CASE WHEN DAY(hc.fecha) = 7 THEN hc.porcentaje END) AS '7',
   SUM(CASE WHEN DAY(hc.fecha) = 8  THEN hc.porcentaje END) AS '8',
   SUM(CASE WHEN DAY(hc.fecha) = 9 THEN hc.porcentaje END) AS '9',
   SUM(CASE WHEN DAY(hc.fecha) = 10 THEN hc.porcentaje END) AS '10',
   SUM(CASE WHEN DAY(hc.fecha) = 11 THEN hc.porcentaje END) AS '11',
   SUM(CASE WHEN DAY(hc.fecha) = 12 THEN hc.porcentaje END) AS '12',
   SUM(CASE WHEN DAY(hc.fecha) = 13 THEN hc.porcentaje END) AS '13',
   SUM(CASE WHEN DAY(hc.fecha) = 14 THEN hc.porcentaje END) AS '14',
   SUM(CASE WHEN DAY(hc.fecha) = 15 THEN hc.porcentaje END) AS '15',
   SUM(CASE WHEN DAY(hc.fecha) = 16 THEN hc.porcentaje END) AS '16',
   SUM(CASE WHEN DAY(hc.fecha) = 17 THEN hc.porcentaje END) AS '17',
   SUM(CASE WHEN DAY(hc.fecha) = 18 THEN hc.porcentaje END) AS '18',
   SUM(CASE WHEN DAY(hc.fecha) = 19 THEN hc.porcentaje END) AS '19',
   SUM(CASE WHEN DAY(hc.fecha) = 20 THEN hc.porcentaje END) AS '20',
   SUM(CASE WHEN DAY(hc.fecha) = 21 THEN hc.porcentaje END) AS '21',
   SUM(CASE WHEN DAY(hc.fecha) = 22 THEN hc.porcentaje END) AS '22',
   SUM(CASE WHEN DAY(hc.fecha) = 23 THEN hc.porcentaje END) AS '23',
   SUM(CASE WHEN DAY(hc.fecha) = 24 THEN hc.porcentaje END) AS '24',
   SUM(CASE WHEN DAY(hc.fecha) = 25 THEN hc.porcentaje END) AS '25',
   SUM(CASE WHEN DAY(hc.fecha) = 26 THEN hc.porcentaje END) AS '26',
   SUM(CASE WHEN DAY(hc.fecha) = 27 THEN hc.porcentaje END) AS '27',
   SUM(CASE WHEN DAY(hc.fecha) = 28 THEN hc.porcentaje END) AS '28',
   SUM(CASE WHEN DAY(hc.fecha) = 29 THEN hc.porcentaje END) AS '29',
   SUM(CASE WHEN DAY(hc.fecha) = 30 THEN hc.porcentaje END) AS '30',
   SUM(CASE WHEN DAY(hc.fecha) = 31 THEN hc.porcentaje END) AS '31',
   (SUM(hc.porcentaje))/22 AS 'total'
   FROM historial_camas AS hc
   INNER JOIN hospitalizacion AS h
   ON hc.historial_id = h.historial_id
   INNER JOIN camas AS c
   ON hc.cama_id = c.cama_id
   INNER JOIN sala AS s
   ON c.sala_id = s.sala_id
   WHERE h.estado = 1 AND h.puesto_id = 2 AND hc.fecha BETWEEN '$desde' AND '$hasta'   
   GROUP BY 1";
$result = $mysqli->query($registro);

$registro_conteo = "SELECT s.nombre AS 'concepto', 
   COUNT(CASE WHEN DAY(hc.fecha) = 1 THEN hc.porcentaje END) AS '1',  
   COUNT(CASE WHEN DAY(hc.fecha) = 2 THEN hc.porcentaje END) AS '2',
   COUNT(CASE WHEN DAY(hc.fecha) = 3 THEN hc.porcentaje END) AS '3',
   COUNT(CASE WHEN DAY(hc.fecha) = 4 THEN hc.porcentaje END) AS '4',
   COUNT(CASE WHEN DAY(hc.fecha) = 5 THEN hc.porcentaje END) AS '5',
   COUNT(CASE WHEN DAY(hc.fecha) = 6 THEN hc.porcentaje END) AS '6',
   COUNT(CASE WHEN DAY(hc.fecha) = 7 THEN hc.porcentaje END) AS '7',
   COUNT(CASE WHEN DAY(hc.fecha) = 8  THEN hc.porcentaje END) AS '8',
   COUNT(CASE WHEN DAY(hc.fecha) = 9 THEN hc.porcentaje END) AS '9',
   COUNT(CASE WHEN DAY(hc.fecha) = 10 THEN hc.porcentaje END) AS '10',
   COUNT(CASE WHEN DAY(hc.fecha) = 11 THEN hc.porcentaje END) AS '11',
   COUNT(CASE WHEN DAY(hc.fecha) = 12 THEN hc.porcentaje END) AS '12',
   COUNT(CASE WHEN DAY(hc.fecha) = 13 THEN hc.porcentaje END) AS '13',
   COUNT(CASE WHEN DAY(hc.fecha) = 14 THEN hc.porcentaje END) AS '14',
   COUNT(CASE WHEN DAY(hc.fecha) = 15 THEN hc.porcentaje END) AS '15',
   COUNT(CASE WHEN DAY(hc.fecha) = 16 THEN hc.porcentaje END) AS '16',
   COUNT(CASE WHEN DAY(hc.fecha) = 17 THEN hc.porcentaje END) AS '17',
   COUNT(CASE WHEN DAY(hc.fecha) = 18 THEN hc.porcentaje END) AS '18',
   COUNT(CASE WHEN DAY(hc.fecha) = 19 THEN hc.porcentaje END) AS '19',
   COUNT(CASE WHEN DAY(hc.fecha) = 20 THEN hc.porcentaje END) AS '20',
   COUNT(CASE WHEN DAY(hc.fecha) = 21 THEN hc.porcentaje END) AS '21',
   COUNT(CASE WHEN DAY(hc.fecha) = 22 THEN hc.porcentaje END) AS '22',
   COUNT(CASE WHEN DAY(hc.fecha) = 23 THEN hc.porcentaje END) AS '23',
   COUNT(CASE WHEN DAY(hc.fecha) = 24 THEN hc.porcentaje END) AS '24',
   COUNT(CASE WHEN DAY(hc.fecha) = 25 THEN hc.porcentaje END) AS '25',
   COUNT(CASE WHEN DAY(hc.fecha) = 26 THEN hc.porcentaje END) AS '26',
   COUNT(CASE WHEN DAY(hc.fecha) = 27 THEN hc.porcentaje END) AS '27',
   COUNT(CASE WHEN DAY(hc.fecha) = 28 THEN hc.porcentaje END) AS '28',
   COUNT(CASE WHEN DAY(hc.fecha) = 29 THEN hc.porcentaje END) AS '29',
   COUNT(CASE WHEN DAY(hc.fecha) = 30 THEN hc.porcentaje END) AS '30',
   COUNT(CASE WHEN DAY(hc.fecha) = 31 THEN hc.porcentaje END) AS '31'
   FROM historial_camas AS hc
   INNER JOIN hospitalizacion AS h
   ON hc.historial_id = h.historial_id
   INNER JOIN camas AS c
   ON hc.cama_id = c.cama_id
   INNER JOIN sala AS s
   ON c.sala_id = s.sala_id
   WHERE h.estado = 1 AND h.puesto_id = 2 AND hc.fecha BETWEEN '$desde' AND '$hasta'
   GROUP BY 1";
$result_conteo = $mysqli->query($registro_conteo);

$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("CAMAS"); //titulo
 
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
    )
));
//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("OCPACION DE CAMAS DIARIA"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('C5'); //INMOVILIZA PANELES
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
$objDrawing->setHeight(190); //altura
$objDrawing->setWidth(190); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(190); //altura
$objDrawing->setWidth(190); //anchura
$objDrawing->setCoordinates('AC1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 4);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AH$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AH$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Informe Diario Ocupación de Camas");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AH$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AH$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AH$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AH$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Concepto');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30); 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '1');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(4);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '2');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '3');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '4');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '5');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '6');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '7');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '8');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '9');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '10');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '11');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '12');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '13');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '14');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '15');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '16');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '17');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", '18');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", '19');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", '20');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", '21');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", '22');
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", '23');
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", '24');
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", '25');
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", '26');
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", '27');
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", '28');
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", '29');
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", '30');
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", '31');
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(4); 
$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(8);  

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:AH$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:AH$fila")->getFont()->setBold(true); //negrita

//rellenar con contenido
$valor = 1;
$total = 0; $total1 = 0; $total2 = 0; $total3 = 0; $total4 = 0; $total5 = 0; $total6 = 0; $total7 = 0; $total8 = 0;
$total9 = 0; $total10 = 0; $total11 = 0; $total12 = 0; $total13 = 0; $total14 = 0; $total15 = 0; $total16 = 0; $total17 = 0; 
$total18 = 0; $total19 = 0; $total20 = 0; $total21 = 0; $total22 = 0; $total23 = 0; $total24 = 0; $total25 = 0; $total26 = 0;
$total27 = 0; $total28 = 0; $total29 = 0; $total30 = 0; $total31 = 0; $total_total = 0;

if($result->num_rows>0){
		while($registro1 = $result->fetch_assoc()){
		   $total1 += $registro1['1'];
		   $total2 += $registro1['2'];
		   $total3 += $registro1['3'];
		   $total4 += $registro1['4'];
		   $total5 += $registro1['5'];
		   $total6 += $registro1['6'];
		   $total7 += $registro1['7'];
		   $total8 += $registro1['8'];
		   $total9 += $registro1['9'];
		   $total10 += $registro1['10'];
		   $total11 += $registro1['11'];
		   $total12 += $registro1['12'];
		   $total13 += $registro1['13'];
		   $total14 += $registro1['14'];
		   $total15 += $registro1['15'];
		   $total16 += $registro1['16'];
		   $total17 += $registro1['17'];
		   $total18 += $registro1['18'];
		   $total19 += $registro1['19'];
		   $total20 += $registro1['20'];
		   $total21 += $registro1['21'];
		   $total22 += $registro1['22'];
		   $total23 += $registro1['23'];
		   $total24 += $registro1['24'];
		   $total25 += $registro1['25'];
		   $total26 += $registro1['26'];
		   $total27 += $registro1['27'];
		   $total28 += $registro1['28'];
		   $total29 += $registro1['29'];
		   $total30 += $registro1['30'];
		   $total31 += $registro1['31'];	
		   $total_total += $registro1['total'];
		   
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro1['concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", round(number_format($registro1['1'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", round(number_format($registro1['2'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", round(number_format($registro1['3'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", round(number_format($registro1['4'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", round(number_format($registro1['5'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", round(number_format($registro1['6'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", round(number_format($registro1['7'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", round(number_format($registro1['8'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", round(number_format($registro1['9'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", round(number_format($registro1['10'], 1, '.', ''),2));
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", round(number_format($registro1['11'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", round(number_format($registro1['12'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", round(number_format($registro1['13'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", round(number_format($registro1['14'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", round(number_format($registro1['15'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", round(number_format($registro1['16'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", round(number_format($registro1['17'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", round(number_format($registro1['18'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", round(number_format($registro1['19'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", round(number_format($registro1['20'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", round(number_format($registro1['21'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", round(number_format($registro1['22'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", round(number_format($registro1['23'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", round(number_format($registro1['24'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", round(number_format($registro1['25'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", round(number_format($registro1['26'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", round(number_format($registro1['27'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", round(number_format($registro1['28'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", round(number_format($registro1['29'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", round(number_format($registro1['30'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", round(number_format($registro1['31'], 1, '.', ''),2));  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", round(number_format($registro1['total'], 1, '.', ''),2));
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
     }	
	 
     $prom1 = 0; $prom2 = 0; $prom3 = 0; $prom4 = 0; $prom5 = 0; $prom6 = 0; $prom7 = 0; $prom8 = 0; $prom9 = 0; $prom10 = 0; $prom11 = 0; $prom12 = 0;
	 $prom13 = 0; $prom14 = 0; $prom15 = 0; $prom16 = 0; $prom17 = 0; $prom18 = 0; $prom19 = 0; $prom20 = 0; $prom21 = 0; $prom22 = 0; $prom123 = 0;
	 $prom24 = 0; $prom25 = 0; $prom26 = 0; $prom27 = 0; $prom28 = 0; $prom29 = 0; $prom30 = 0; $prom31 = 0; $prom = 0; $prom_total = 0;
	 
	 $prom1 = $total1 / 3;
	 $prom2 = $total2 / 3;
	 $prom3 = $total3 / 3;
	 $prom4 = $total4 / 3;
	 $prom5 = $total5 / 3;
	 $prom6 = $total6 / 3;
	 $prom7 = $total7 / 3;
	 $prom8 = $total8 / 3;
	 $prom9 = $total9 / 3;
	 $prom10 = $total10 / 3;
	 $prom11 = $total11 / 3;
	 $prom12 = $total12 / 3;
	 $prom13 = $total13 / 3;
	 $prom14 = $total14 / 3;
	 $prom15 = $total15 / 3;
	 $prom16 = $total16 / 3;
	 $prom17 = $total17 / 3;
	 $prom18 = $total18 / 3;
	 $prom19 = $total19 / 3;
	 $prom20 = $total20 / 3;
	 $prom21 = $total21 / 3;
	 $prom22 = $total22 / 3;
	 $prom23 = $total23 / 3;
	 $prom24 = $total24 / 3;
	 $prom25 = $total25 / 3;
	 $prom26 = $total26 / 3;
	 $prom27 = $total27 / 3;
	 $prom28 = $total28 / 3;
	 $prom29 = $total29 / 3;
	 $prom30 = $total30 / 3;
	 $prom31 = $total31 / 3;
     $prom_total = $total_total / 3;  
	 $fila++;
	 
	 $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
     $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Total Ocupación');
     $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", round(number_format($prom1, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", round(number_format($prom2, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", round(number_format($prom3, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", round(number_format($prom4, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", round(number_format($prom5, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", round(number_format($prom6, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", round(number_format($prom7, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", round(number_format($prom8, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", round(number_format($prom9, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", round(number_format($prom10, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", round(number_format($prom11, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", round(number_format($prom12, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", round(number_format($prom13, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", round(number_format($prom14, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", round(number_format($prom15, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", round(number_format($prom16, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", round(number_format($prom17, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", round(number_format($prom18, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", round(number_format($prom19, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", round(number_format($prom20, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", round(number_format($prom21, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", round(number_format($prom22, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", round(number_format($prom23, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", round(number_format($prom24, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", round(number_format($prom25, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", round(number_format($prom26, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", round(number_format($prom27, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", round(number_format($prom28, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", round(number_format($prom29, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", round(number_format($prom30, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", round(number_format($prom31, 1, '.', ''),2));
	 $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", round(number_format($prom_total, 1, '.', ''),2));
     //Establecer estilo
     $objPHPExcel->getActiveSheet()->setSharedStyle($totales, "A$fila:AH$fila");		 
     $valor ++; 	 
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
header('Content-Disposition: attachment; filename="Ocupacion de Camas Diaria,'.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>