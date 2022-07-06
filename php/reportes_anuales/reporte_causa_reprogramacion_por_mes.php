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

//OBTENER NOMBRE DE MES
$mes_nombre = nombremes($mes);

if($servicio == ""){
	$where = "WHERE MONTH(a.fecha_cita) = '$mes' AND YEAR(a.fecha_cita) = '$año' AND a.status_id NOT IN(0)";
    $dato_servicio = "Reporte Causa Reprogramacion. $mes_nombre, $año";	
}else{
    if($servicio == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE MONTH(a.fecha_cita) = '$mes' AND YEAR(a.fecha_cita) = '$año' AND a.servicio_id IN(1,6) AND a.status_id NOT IN(0)";
        $servicio_name = "Consulta Externa General";
    }else{
		$where = "WHERE MONTH(a.fecha_cita) = '$mes' AND YEAR(a.fecha_cita) = '$año' AND a.servicio_id = '$servicio' AND a.status_id NOT IN(0)";
		
        //OBTENER NOMBRE SERVICIO
        $consulta_servicio = "SELECT nombre 
          FROM servicios 
	      WHERE servicio_id = '$servicio'";
        $result = $mysqli->query($consulta_servicio);

        $consulta_servicio1 = $result->fetch_assoc();
        $servicio_name = $consulta_servicio1['nombre'];			
	}	

	$dato_servicio = "Reporte Causa Reprogramacion. $mes_nombre, $año. $servicio_name";	
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$registro = "SELECT sr.descripcion AS 'causa',
COUNT(CASE WHEN p.sexo = 'H' THEN a.paciente END) AS 'h',
COUNT(CASE WHEN p.sexo = 'M' THEN a.paciente END) AS 'm',
COUNT(a.status_id) AS 'total'
FROM agenda AS a
INNER JOIN status_repro AS sr
ON a.status_id = sr.status_id
INNER JOIN pacientes AS p
ON a.pacientes_id = p.pacientes_id
".$where." 
GROUP BY a.status_id
ORDER BY sr.descripcion";

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
$objPHPExcel->getActiveSheet()->freezePane('D5'); //INMOVILIZA PANELES
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
$objDrawing->setWidth(150); //anchura
$objDrawing->setCoordinates('D1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(170); //altura
$objDrawing->setWidth(150); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:E$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:E$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $dato_servicio );
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:E$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:E$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Fecha de Impresión: '.$fecha_sistema );
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:E$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:E$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("A5:A6"); //unir celdas 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Causa');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(65);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Genero');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30); 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
$objPHPExcel->getActiveSheet()->mergeCells("E5:E6"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:E$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:E$fila")->getFont()->setBold(true); //negrita

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Hombre');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Mujer');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:E$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:E$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['causa']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['h']);
       $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['m']);	   
       $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['total']);	
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:E$fila");	
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
header('Content-Disposition: attachment; filename="Reporte Enfermedades_'.$servicio_name.'_'.$mes_nombre.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>