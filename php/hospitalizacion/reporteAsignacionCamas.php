<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$fecha = $_GET['fecha'];
$fechaf = $_GET['fechaf'];
$dato = $_GET['dato'];
$sala = $_GET['sala'];

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

if($sala == ""){
	$where = "WHERE hm.estado IN(1,2) AND hm.fecha BETWEEN '$fecha' AND '$fechaf' AND hm.puesto_id IN (2,4) AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
    $sala_nombre = "";
}else{
	$where = "WHERE hm.sala_id = '$sala' AND c.estado IN(1,2) AND hm.puesto_id IN(2,4) AND hm.fecha BETWEEN '$fecha' AND '$fechaf' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
	
    //CONSULTAR NOMBRE DE LA SALA
    $consulta_sala = "SELECT nombre 
	    FROM sala 
		WHERE sala_id = '$sala'";
	$result = $mysqli->query($consulta_sala);
    $consulta_sala2 = $result->fetch_assoc();
    $sala_nombre = $consulta_sala2['nombre'];	
}			
$mes=nombremes(date("m", strtotime($fecha)));
$mes1=nombremes(date("m", strtotime($fechaf)));
$año=date("Y", strtotime($fecha));
$año2=date("Y", strtotime($fechaf));

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT hm.historial_id as 'historial_id', hm.fecha As 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'paciente', p.expediente, p.identidad, s.nombre As 'sala', c.codigo AS 'cama', hm.color AS 'color', hm.estado AS 'estado', c.cama_id AS 'cama_id', CONCAT(c1.apellido, ' ', c1.nombre) As usuario, s.nombre AS 'sala_nombre', hm.color AS 'color'
       FROM historial_camas AS hm
       INNER JOIN camas AS c
       on hm.cama_id = c.cama_id
       INNER JOIN pacientes AS p
       ON hm.expediente = p.expediente
       INNER JOIN sala AS s
       ON c.sala_id = s.sala_id
	   INNER JOIN colaboradores AS c1
	   ON hm.usuario = c1.colaborador_id		   
	   ".$where."
       ORDER BY c.cama_id, p.expediente ASC";
$result = $mysqli->query($registro);	   
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Asignación de Camas"); //titulo
 
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

$color_rojo = new PHPExcel_Style(); //nuevo estilo 
$color_rojo->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DF0101')
    ),
	'borders' => array( //bordes
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$color_amarillo = new PHPExcel_Style(); //nuevo estilo
 
$color_amarillo->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'FAF03C')
    ),
	'borders' => array( //bordes
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));
//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Asignación Camas"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('D4'); //INMOVILIZA PANELES
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
$objDrawing->setHeight(300); //altura
$objDrawing->setWidth(180); //Anchura
$objDrawing->setCoordinates('J1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(300); //altura
$objDrawing->setWidth(180); //Anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A1:J1");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:J$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A2:J2");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Registro de Camas $sala_nombre");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:J$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:J3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:J$fila");

$fila=4;
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13); 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Nombre Completo del Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40); 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Identidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Expediente');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Sala');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Cama');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Estado');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Color');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(28);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:J$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:J$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   $fila+=1;
	   if($registro2['estado'] == 1){
		   $estado_cama = 'Ocupada';
	   }else if($registro2['estado'] == 2){
		   $estado_cama = 'Alta-Ocupada';		   
	   }else{
		   $estado_cama = "";
	   }
		   
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['fecha']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['paciente']);
	   
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	   	    			
       $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['expediente']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['sala_nombre']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['cama']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $estado_cama);	

	   if($registro2['estado'] == 1){
            $objPHPExcel->getActiveSheet()->setSharedStyle($color_rojo, "I$fila:I$fila");
	   }else if($registro2['estado'] == 2){
		   	 $objPHPExcel->getActiveSheet()->setSharedStyle($color_amarillo, "I$fila:I$fila");	   
	   }else{
		   $estado_cama = "";
	   }	   
       $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['usuario']);
	   $valor++;
   }	
}
 
$fila+=5; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "HSJD_".strtoupper($mes)."_$año");
$fila+=1; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Nombre y Firma del Responsable __________________________________________________________________________________"); 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setDifferentOddEven(false);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('Página &P / &N'); 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Registro de Camas '.$sala_nombre.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>