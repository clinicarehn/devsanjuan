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

$servicio_name = '';
$fecha_sistema = date("d/m/Y g:i:s a");

if($servicio == ""){
    $where = "WHERE YEAR(a.fecha) = '$año'";
	$group_by = "GROUP BY a.servicio_id, pc.puesto_id";
    $dato_servicio = "Reporte de Servicios, $año";	
}else{
    if($servicio == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
        $group_by = "GROUP BY pc.puesto_id";
        $servicio_name = "Consulta Externa General";
    }else{
		$where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
		$group_by = "GROUP BY a.servicio_id, pc.puesto_id";	
		
        //OBTENER NOMBRE SERVICIO
        $consulta_servicio = "SELECT nombre 
          FROM servicios 
	      WHERE servicio_id = '$servicio'";
        $result = $mysqli->query($consulta_servicio);

        $consulta_servicio1 = $result->fetch_assoc();
        $servicio_name = $consulta_servicio1['nombre'];			
	}
	
	$dato_servicio = "Reporte de Servicios, $año. $servicio_name";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT s.nombre AS 'servicio', pc.nombre AS 'unidad',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ene', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ene', 
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.paciente END) AS 'enero', 
COUNT(CASE WHEN (MONTH(a.fecha) = 2 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_feb', 
COUNT(CASE WHEN (MONTH(a.fecha) = 2 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_feb', 
COUNT(CASE WHEN MONTH(a.fecha) = 2 THEN a.paciente END) AS 'febrero', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_mar', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_mar', 
COUNT(CASE WHEN MONTH(a.fecha) = 3 THEN a.paciente END) AS 'marzo', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_abr', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_abr', 
COUNT(CASE WHEN MONTH(a.fecha) = 4 THEN a.paciente END) AS 'abril',
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_may', 
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_may', 
COUNT(CASE WHEN MONTH(a.fecha) = 5 THEN a.paciente END) AS 'mayo', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jun', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jun', 
COUNT(CASE WHEN MONTH(a.fecha) = 6 THEN a.paciente END) AS 'junio', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jul', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jul', 
COUNT(CASE WHEN MONTH(a.fecha) = 7 THEN a.paciente END) AS 'julio', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ago', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ago', 
COUNT(CASE WHEN MONTH(a.fecha) = 8 THEN a.paciente END) AS 'agosto',
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_sep', 
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_sep', 
COUNT(CASE WHEN MONTH(a.fecha) = 9 THEN a.paciente END) AS 'septiembre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_oct', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_oct', 
COUNT(CASE WHEN MONTH(a.fecha) = 10 THEN a.paciente END) AS 'octubre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_nov', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_nov', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.paciente END) AS 'noviembre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 12 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_dic', 
COUNT(CASE WHEN (MONTH(a.fecha) = 12 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_dic', 
COUNT(CASE WHEN MONTH(a.fecha) = 12 THEN a.paciente END) AS 'diciembre',
COUNT(a.paciente) AS 'total'
FROM ata AS a
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
".$where." 
".$group_by."
ORDER BY s.nombre";

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
$objDrawing->setWidth(170); //anchura
$objDrawing->setCoordinates('AL1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(170); //altura
$objDrawing->setWidth(170); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AN$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AN$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $dato_servicio );
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AN$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AN$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Fecha de Impresión: '.$fecha_sistema );
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AN$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AN$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->mergeCells("A5:A6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Servicio');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Unidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); 
$objPHPExcel->getActiveSheet()->mergeCells("C5:C6"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Enero');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("D5:F5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Febrero');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("G5:I5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Marzo');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("J5:L5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Abril');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("M5:O5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Mayo');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("P5:R5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'Junio');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("S5:U5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'Julio');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("V5:X5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", 'Agosto');
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("Y5:AA5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", 'Septiembre');
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("AB5:AD5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", 'Octubre');
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("AE5:AG5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'Noviembre');
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("AH5:AJ5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", 'Diciembre');
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(29); 
$objPHPExcel->getActiveSheet()->mergeCells("AK5:AM5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(12); 
$objPHPExcel->getActiveSheet()->mergeCells("AN5:AN6"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:AN$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:AN$fila")->getFont()->setBold(true); //negrita

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(7);

$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", 'Nuevo');
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(7);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:AN$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:AN$fila")->getFont()->setBold(true); //negrita

//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   if($servicio == ""){
		   $servicio_ = $registro2['servicio'];
	   }else if($servicio != 0){
		   $servicio_ = $registro2['servicio'];
	   }else{
		   $servicio_ = "Consulta Externa General";		 
	   }
	   
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $servicio_);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['unidad']);
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['nuevo_ene']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['sub_ene']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['enero']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['nuevo_feb']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['sub_feb']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['febrero']);
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['nuevo_mar']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['sub_mar']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['marzo']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['nuevo_abr']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['sub_abr']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro2['abril']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro2['nuevo_may']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro2['sub_may']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro2['mayo']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro2['nuevo_jun']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro2['sub_jun']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro2['junio']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro2['nuevo_jul']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro2['sub_jul']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro2['julio']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro2['nuevo_ago']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro2['sub_ago']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro2['agosto']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro2['nuevo_sep']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro2['sub_sep']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro2['septiembre']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro2['nuevo_oct']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro2['sub_oct']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro2['octubre']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro2['nuevo_nov']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registro2['sub_nov']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registro2['noviembre']);

	   $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registro2['nuevo_dic']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registro2['sub_dic']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registro2['diciembre']);   
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registro2['total']);   	   

       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AN$fila");	
	   $valor++;
   }	
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
header('Content-Disposition: attachment; filename="Reporte Servicios Anuales_'.$servicio_name.'_'.$mes_nombre.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>