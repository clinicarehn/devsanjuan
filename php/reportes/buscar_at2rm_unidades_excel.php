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
$unidad = $_GET['unidad'];
$servicio = $_GET['servicio'];
$colaborador = $_GET['colaborador'];

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

if ($colaborador == ""){
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años >= 1";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 1 AND 4";
	$where2 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 5 AND 9";
	$where3 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 10 AND 14";
	$where4 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 15 AND 19";
	$where5 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 20 AND 49";
	$where6 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 50 AND 59";
	$where7 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años>=60";
	$where8 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND p.sexo IN('H','M')";
}else{
   //OBTENER NOMBRE DEL COLABORADOR
    $consulta_colaborador_nombre = "SELECT CONCAT(nombre,' ',apellido) as 'nombre' 
	    FROM colaboradores 
		WHERE colaborador_id = '$colaborador'";
	$result = $mysqli->query($consulta_colaborador_nombre);
    $consulta_colaborador_nombre1 = $result->fetch_assoc();
    $colaborador_name = strtoupper($consulta_colaborador_nombre1['nombre']);
	
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años >= 1 AND c.colaborador_id = '$colaborador'";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 1 AND 4 AND c.colaborador_id = '$colaborador'";
	$where2 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 5 AND 9 AND c.colaborador_id = '$colaborador'";
	$where3 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 10 AND 14 AND c.colaborador_id = '$colaborador'";
	$where4 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 15 AND 19 AND c.colaborador_id = '$colaborador'";
	$where5 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 20 AND 49 AND c.colaborador_id = '$colaborador' ";
	$where6 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 50 AND 59 AND c.colaborador_id = '$colaborador'";
	$where7 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años>=60 AND c.colaborador_id = '$colaborador'";	
	$where8 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND p.sexo IN('H','M') AND c.colaborador_id = '$colaborador'";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where."
   GROUP BY 1";
$result = $mysqli->query($registro); 

//DE 1 - 4 AÑOS 
 $registro1_4 = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where1."   
   GROUP BY 1";
$result1_4 = $mysqli->query($registro1_4);  
 
 //DE 5 - 9 AÑOS
 $registro5_9 = "SELECT DISTINCT 
   CONCAT('5 - 9 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where2."   
   GROUP BY 1";
$result5_9 = $mysqli->query($registro5_9);  
 
 //DE 10 - 14 AÑOS
 $registro10_14 = "SELECT DISTINCT 
   CONCAT('10 - 14 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where3."   
   GROUP BY 1";
$result10_14 = $mysqli->query($registro10_14);  
 
 //DE 15 - 19 AÑOS
  $registro15_19 = "SELECT DISTINCT 
   CONCAT('15 - 19 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where4."   
   GROUP BY 1";
$result15_19 = $mysqli->query($registro15_19);  

 //DE 20 - 49 AÑOS
  $registro20_49 = "SELECT DISTINCT 
   CONCAT('20 - 49 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where5."   
   GROUP BY 1";
$result20_49 = $mysqli->query($registro20_49);  

 
 //DE 50 - 59 AÑOS
  $registro50_59 = "SELECT DISTINCT 
   CONCAT('50 - 59 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where6."   
   GROUP BY 1";
$result50_59 = $mysqli->query($registro50_59); 
 
 //60 AÑOS
 $registro60 = "SELECT DISTINCT 
   CONCAT('60 Y + años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where7."   
   GROUP BY 1";
$result60 = $mysqli->query($registro60);  
 
//CONSULTA SEXO USUARIOS
 $sexo = "SELECT DISTINCT 
   CONCAT('', (CASE WHEN p.sexo = 'M' THEN 'No. Atenciones Mujeres' ELSE 'No. Atenciones Hombres' END)) AS 'Concepto', 
   COUNT(CASE WHEN c.puesto_id = '$unidad' THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where8."   
   GROUP BY 1";
$resultSexo = $mysqli->query($sexo);    
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("AT2R MENSUAL ".strtoupper($unidad_name)); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("AT2R MENSUAL ".strtoupper($unidad_name)); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('C13'); //INMOVILIZA PANELES
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
$objDrawing->setPath('../../img/escudo.jpg'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal.jpg'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('G1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 12);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Secretaría de Salud");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:G$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "ÁREA DE SISTEMAS DE INFORMACIÓN");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:G$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "INFORME MENSUAL DE ATENCIONES");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:G$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "AT2-R");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "G$fila");

$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Región Salud: Número 5");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Nivel: 2");
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "Establecimiento: ".$empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "A$fila:G$fila");

$fila=8;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Director del Establecimiento: Gudiel Sanchez Chacon");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "A$fila:G$fila");

$fila=9;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Servicio: ".strtoupper($servicio_name).' '.strtoupper($unidad_name));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", " Código: 85499");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "A$fila:G$fila");

$fila=11;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->mergeCells("A11:A12"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Concepto');;
$objPHPExcel->getActiveSheet()->mergeCells("B11:B12"); //unir celdas
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Enfermera');
$objPHPExcel->getActiveSheet()->mergeCells("C11:D11"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C12", 'Auxiliar');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("D12", 'Profesional');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Médico');
$objPHPExcel->getActiveSheet()->mergeCells("E11:F11"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E12", 'General');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("F12", 'Especialista');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Total');
$objPHPExcel->getActiveSheet()->mergeCells("G11:G12"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A11:G12"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A11:G12")->getFont()->setBold(true); //negrita

$fila=13;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "1");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Menores de 1 Mes de 1a. Vez");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");		

$fila=14;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "2");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Menores de 1 Mes Subsiguiente");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");		

$fila=15;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "3");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "1 mes a 1 año de 1a. Vez");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");		

$fila=16;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "4");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "1 mes a 1 año Subsiguiente");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	

//rellenar con contenido
$valor = 5;
$total = 0;
if($result->num_rows>0){
	if($result1_4->num_rows>0){
		while($registro1_4_1 = $result1_4->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro1_4_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro1_4_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro1_4_1['Total']);	   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	
	       $valor++;
		   $total = $total + $registro1_4_1['Total'];
     }	
   }	

   	if($result5_9->num_rows>0){
		while($registro5_9_1 = $result5_9->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro5_9_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro5_9_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro5_9_1['Total']);	   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	
	       $valor++;
		   $total = $total + $registro5_9_1['Total'];
     }	
   }	
   
	if($result10_14->num_rows>0){
		while($registro10_14_1 = $result10_14->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro10_14_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro10_14_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro10_14_1['Total']);	   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	
	       $valor++;
		   $total = $total + $registro10_14_1['Total'];
     }	
   }	

	if($result15_19->num_rows>0){
		while($registro15_19_1 = $result15_19->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro15_19_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro15_19_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro15_19_1['Total']);	   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	
	       $valor++;
		   $total = $total + $registro15_19_1['Total'];
     }	
   }

	if($result20_49->num_rows>0){
		while($registro20_49_1 = $result20_49->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro20_49_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro20_49_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro20_49_1['Total']);	   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	
	       $valor++;
		   $total = $total + $registro20_49_1['Total'];
     }	
   }

	if($result50_59->num_rows>0){
		while($registro50_59_1 = $result50_59->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro50_59_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro50_59_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro50_59_1['Total']);	   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	
	       $valor++;
		   $total = $total + $registro50_59_1['Total'];
     }	
   }

	if($result60->num_rows>0){
		while($registro60_1 = $result60->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro60_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro60_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro60_1['Total']);	   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	
	       $valor++;
		   $total = $total + $registro60_1['Total'];
     }	
   }
}

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Total Pacientes Atendidos");
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $total);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $total);
$objPHPExcel->getActiveSheet()->setSharedStyle($totales, "A$fila:G$fila");

$valor++;

  if($resultSexo->num_rows>0){
		while($sexo_1 = $resultSexo->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $sexo_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $sexo_1['Especialista']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $sexo_1['Total']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");	
	       $valor++;
	  }		
   }	

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Consultas Expontaneas");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Consultas Referidas");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Detección de Sintomáticos Respiratorios");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Detección de Cancer Cervico Uterino");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Embarazadas Nuevas");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Embarazadas de Control");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Controles Puerperales");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Anticonceptivo Oral 1 Ciclo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Anticonceptivo Oral 3 Ciclo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Anticonceptivo Oral 6 Ciclo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Condones 10 Unidades");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Condones 30 Unidades");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Depo prevera Aplicadas");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DIU insertados");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Usuarias Utilizando el Metodo de Dias Fijos (Collar)");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Otras Actividades de PF");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Diarrea");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Diarrea que acuden a cita de seguimiento");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Deshidratación Rehidratados en la US");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con casos de Neumonia nuevos en el Año");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Neumonia que acuden a su sita de Seguimiento");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con algun grado de Síndrome Anémico Diagnosticado por Laboratorio");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Total de Niños/as Menores de 5 años Atendidos");
$objPHPExcel->getActiveSheet()->setSharedStyle($totales, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Crecimiento Adecuado");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Crecimiento Inadecuado");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Bajo Percentil 3");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Daño Nutritivo Severo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Discapacidad Nuevos en el Año");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Probable Alteración del Desarrollo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Atención prenatal nueva en las primeras 12 SG");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Atención puerperal nueva en los 10 primeros días");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:G$fila");
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
header('Content-Disposition: attachment; filename="AT2R MENSUAL '.strtoupper($servicio_name).' '.strtoupper($unidad_name).' '.$colaborador_name.' '.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$result1_4->free();
$result5_9->free();
$result10_14->free();
$result15_19->free();
$result20_49->free();
$result50_59->free();
$result60->free();
$resultSexo->free();
$mysqli->close();//CERRAR CONEXIÓN
?>