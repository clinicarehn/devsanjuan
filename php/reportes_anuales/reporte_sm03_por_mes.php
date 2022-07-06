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
	$where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año'";
    $dato_servicio = "Reporte de Servicios. $mes_nombre, $año";	
	$group_by = "GROUP BY a.servicio_id, pc.puesto_id";
}else{
    if($servicio == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
        $group_by = "GROUP BY pc.puesto_id";
        $servicio_name = "Consulta Externa General";
    }else{
		$where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
		$group_by = "GROUP BY a.servicio_id, pc.puesto_id";	
		
        //OBTENER NOMBRE SERVICIO
        $consulta_servicio = "SELECT nombre 
          FROM servicios 
	      WHERE servicio_id = '$servicio'";
        $result = $mysqli->query($consulta_servicio);

        $consulta_servicio1 = $result->fetch_assoc();
        $servicio_name = $consulta_servicio1['nombre'];			
	}
	
	$dato_servicio = "Reporte de Servicios. $mes_nombre, $año. $servicio_name";	
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$registro = "SELECT gp.codigo AS 'codigo', gp.nombre AS 'enfermedad',
COUNT(CASE WHEN a.paciente = 'N' THEN a.paciente END) AS 'nuevos',
COUNT(CASE WHEN a.paciente = 'S' THEN a.paciente END) AS 'subsiguientes',
COUNT(CASE WHEN p.sexo = 'H' THEN a.paciente END) AS 'H',
COUNT(CASE WHEN p.sexo = 'M' THEN a.paciente END) AS 'M',
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
$objDrawing->setWidth(170); //anchura
$objDrawing->setCoordinates('H1');
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
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Hospital San Juan de Dios");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:I$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:I$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $dato_servicio );
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:I$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:I$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Fecha de Impresión: '.$fecha_sistema );
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:I$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:I$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Código');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Enfermedad');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(85); 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nuevos');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Subsiguientes');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14); 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Hombres');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Mujeres');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Promedio Edad');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(16); 

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:I$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:I$fila")->getFont()->setBold(true); //negrita

 
//rellenar con contenido
$valor = 1; $total = 0;	$nuevos = 0; $subsiguientes = 0; $total_nuevos_consulta = 0;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   $fila+=1;
	   $total += $registro2['total'];
	   $nuevos += $registro2['nuevos'];
	   $subsiguientes += $registro2['subsiguientes'];	

  	   if ($total!=0){
          $total_nuevos_consulta = ($nuevos / $total )*100;		
	   }else{
	      $total_nuevos_consulta = 0;
	   }
	 
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['codigo']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['enfermedad']);
       $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['nuevos']);	
       $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['subsiguientes']);
       $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['H']);		   
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['M']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['total']);	   
       $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['promedio_edad']);
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:I$fila");	
	   $valor++;
   }	
}

$fila+=1;
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Analisis");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:I$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("C$fila:I$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "1. Total Pacientes");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", number_format($total));
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "2. Enfermedades mas comunes (según %)");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "3. Cantidad de Nuevos");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", number_format($nuevos));

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "4. % Nuevos conforme la consulta");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", number_format($total_nuevos_consulta));
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