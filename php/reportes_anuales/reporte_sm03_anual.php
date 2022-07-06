<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$servicio = $_GET['servicio'];
$año = $_GET['año'];
$mes = $_GET['mes'];

if($mes != ''){
   $mes_nombre = nombremes($mes);	
}else{
   $mes_nombre = '';	
}

$servicio_name = '';
$fecha_sistema = date("d/m/Y g:i:s a");

if($servicio == ""){
    $where = "WHERE YEAR(a.fecha) = '$año'";
    $dato_servicio = "Reporte SM03, $año";	
	$group_by = "GROUP BY gp.grupo_id";
}else{
    if($servicio == 0){//CONSULTA EXTERNA GENERAL
	    	$where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
        $group_by = "";
        $servicio_name = "Consulta Externa General";
		$dato_servicio = "Reporte SM03, $año. $servicio_name";
    }else{
			$where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
		$group_by = "GROUP BY gp.grupo_id";	
		
        //OBTENER NOMBRE SERVICIO
        $consulta_servicio = "SELECT nombre 
          FROM servicios 
	      WHERE servicio_id = '$servicio'";
        $result = $mysqli->query($consulta_servicio);

        $consulta_servicio1 = $result->fetch_assoc();
        $servicio_name = $consulta_servicio1['nombre'];			
	}	
	
	$dato_servicio = "Reporte SM03, $año. $servicio_name";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT gp.codigo AS 'codigo', gp.nombre AS 'enfermedad',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ene', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ene',
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.patologia_id END) AS 'enero',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 1 THEN a.años ELSE 0 END),0) AS 'edad_ene',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_feb', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_feb', 
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.patologia_id END) AS 'febrero', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 1 THEN a.años ELSE 0 END),0) AS 'edad_feb',
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_mar', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_mar', 
COUNT(CASE WHEN MONTH(a.fecha) = 3 THEN a.patologia_id END) AS 'marzo', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 3 THEN a.años ELSE 0 END),0) AS 'edad_mar',
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_abr', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_abr', 
COUNT(CASE WHEN MONTH(a.fecha) = 4 THEN a.patologia_id END) AS 'abril',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 4 THEN a.años ELSE 0 END),0) AS 'edad_abr',
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_may', 
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_may', 
COUNT(CASE WHEN MONTH(a.fecha) = 5 THEN a.patologia_id END) AS 'mayo', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 5 THEN a.años ELSE 0 END),0) AS 'edad_may',
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jun', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jun', 
COUNT(CASE WHEN MONTH(a.fecha) = 6 THEN a.patologia_id END) AS 'junio', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 6 THEN a.años ELSE 0 END),0) AS 'edad_jun',
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jul', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jul', 
COUNT(CASE WHEN MONTH(a.fecha) = 7 THEN a.patologia_id END) AS 'julio', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 7 THEN a.años ELSE 0 END),0) AS 'edad_jul',
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ago', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ago', 
COUNT(CASE WHEN MONTH(a.fecha) = 8 THEN a.patologia_id END) AS 'agosto',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 8 THEN a.años ELSE 0 END),0) AS 'edad_ago',
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_sep', 
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_sep', 
COUNT(CASE WHEN MONTH(a.fecha) = 9 THEN a.patologia_id END) AS 'septiembre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 9 THEN a.años ELSE 0 END),0) AS 'edad_sep',
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_oct', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_oct', 
COUNT(CASE WHEN MONTH(a.fecha) = 10 THEN a.patologia_id END) AS 'octubre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 10 THEN a.años ELSE 0 END),0) AS 'edad_oct',
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_nov', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_nov', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.patologia_id END) AS 'noviembre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 11 THEN a.años ELSE 0 END),0) AS 'edad_nov',
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_dic', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_dic', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.patologia_id END) AS 'diciembre',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 11 THEN a.años ELSE 0 END),0) AS 'edad_dic',
COUNT(a.patologia_id) AS 'total',
ROUND(AVG(a.años),0) AS 'promedio_edad'
FROM ata AS a
INNER JOIN patologia As pa
ON a.patologia_id = pa.id
INNER JOIN grupo_patologia AS gp
ON pa.grupo_id = gp.grupo_id
INNER JOIN pacientes AS p
ON a.expediente = p.expediente
".$where."
GROUP BY gp.grupo_id";

$result = $mysqli->query($registro);	   
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Reportes Anuales"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Reportes Anuales"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('D7'); //INMOVILIZA PANELES
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
$objDrawing->setHeight(170); //altura
$objDrawing->setWidth(155); //anchura
$objDrawing->setCoordinates('AZ1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(170); //altura
$objDrawing->setWidth(155); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Hospital San Juan de Dios");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:BA$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:BA$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $dato_servicio );
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:BA$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:BA$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Fecha de Impresión: '.$fecha_sistema );
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:BA$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:BA$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->mergeCells("A5:A6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Codigo');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B6"); //unir celdas;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Enfermedad');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(55);
$objPHPExcel->getActiveSheet()->mergeCells("C5:C6"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Enero');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Febrero');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("H$fila:K$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Marzo');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("L$fila:O$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Abril');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("P$fila:S$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'Mayo');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("T$fila:W$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", 'Junio');
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("X$fila:AA$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", 'Julio');
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("AB$fila:AE$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", 'Agosto');
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("AF$fila:AI$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", 'Septiembre');
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("AJ$fila:AM$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", 'Octubre');
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("AN$fila:AQ$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", 'Noviembre');
$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("AR$fila:AU$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", 'Diciembre');
$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(43);
$objPHPExcel->getActiveSheet()->mergeCells("AV$fila:AY$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(23);
$objPHPExcel->getActiveSheet()->mergeCells("AZ$fila:BA$fila"); //unir celdas;

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:BA$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:BA$fila")->getFont()->setBold(true); //negrita

$fila=6;
//ENERO
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);

//FEBRERO
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);

//MARZO
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);

//ABRIL
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);

//MAYO
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);

//JUNIO
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(10);

//JULIO
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(10);

//AGOSTO
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(10);

//SEPTIEMBRE
$objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(10);

//OCTUBRE
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(10);

//NOVIEMBRE
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(10);

//DICIEMBRE
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(13);

$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(10);

$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(11);

$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(12);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:BA$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:BA$fila")->getFont()->setBold(true); //negrita

//rellenar con contenido
$valor = 1; $total = 0;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){	   
	   $fila+=1;
	   $total += $registro2['total'];
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
			  
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['codigo']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['enfermedad']);
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['nuevo_ene']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['sub_ene']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['enero']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['edad_ene']);
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['nuevo_feb']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['sub_feb']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['febrero']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['edad_feb']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['nuevo_mar']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['sub_mar']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['marzo']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro2['edad_mar']);
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro2['nuevo_abr']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro2['sub_abr']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro2['abril']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro2['edad_abr']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro2['nuevo_may']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro2['sub_may']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro2['mayo']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro2['edad_may']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro2['nuevo_jun']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro2['sub_jun']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro2['junio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro2['edad_jun']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro2['nuevo_jul']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro2['sub_jul']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro2['julio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro2['edad_jul']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro2['nuevo_ago']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro2['sub_ago']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro2['agosto']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registro2['edad_ago']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registro2['nuevo_sep']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registro2['sub_sep']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registro2['septiembre']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registro2['edad_sep']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registro2['nuevo_oct']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registro2['sub_oct']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registro2['octubre']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", $registro2['edad_oct']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", $registro2['nuevo_nov']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", $registro2['sub_nov']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", $registro2['noviembre']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", $registro2['edad_nov']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", $registro2['nuevo_dic']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", $registro2['sub_dic']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", $registro2['diciembre']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", $registro2['edad_dic']);	   

	   $objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", $registro2['total']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", $registro2['promedio_edad']); 	   

       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:BA$fila");	
	   $valor++;
   }	
}
 
$fila+=1;
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Analisis");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("C$fila:J$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "1. Total Pacientes");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", number_format($total));
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "2. Enfermedades mas comunes (según %)");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getFont()->setBold(true); //negrita 
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
header('Content-Disposition: attachment; filename="Reporte Servicios SM03_'.$servicio_name.'_'.$mes_nombre.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>