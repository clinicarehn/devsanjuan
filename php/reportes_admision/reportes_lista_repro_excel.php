<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";

$servicio = $_GET['servicio'];
$unidad = $_GET['unidad'];
$medico_general = $_GET['medico_general'];
$reporte = $_GET['reporte'];
$fechai = $_GET['fechai'];
$fechaf = $_GET['fechaf'];

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

$mes=nombremes(date("m", strtotime($fechai)));
$mes1=nombremes(date("m", strtotime($fechaf)));
$año=date("Y", strtotime($fechai));

//OBTENER NOMBRE SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_name = $consulta_servicio1['nombre'];

$unidad_name = "";
$colaborador_name = "";

if($unidad == ""){
	$where = "WHERE le.servicio = '$servicio' AND CAST(fecha_inclusion as DATE) BETWEEN '$fechai' AND '$fechaf' AND le.reprogramo <> ''";
}else if($medico_general == "" && $unidad != ""){
    //OBTENER NOMBRE UNIDAD
    $consulta_unidad = "SELECT nombre 
	    FROM puesto_colaboradores 
		WHERE puesto_id = '$unidad'";
	$result = $mysqli->query($consulta_unidad);
    $consulta_unidad1 = $result->fetch_assoc();
    $unidad_name = $consulta_unidad1['nombre'];	
	
	$where = "WHERE le.servicio = '$servicio' AND CAST(fecha_inclusion as DATE) BETWEEN '$fechai' AND '$fechaf' AND le.reprogramo <> '' AND c.puesto_id = '$unidad'";	
}else{
   //OBTENER NOMBRE UNIDAD
    $consulta_colaborador_nombre = "SELECT CONCAT(nombre,' ',apellido) as 'nombre' 
	     FROM colaboradores 
		 WHERE colaborador_id = '$medico_general'";
	$result = $mysqli->query($consulta_colaborador_nombre);
    $consulta_colaborador_nombre1 = $result->fetch_assoc();
    $colaborador_name = strtoupper($consulta_colaborador_nombre1['nombre']);
	
	$where = "WHERE le.servicio = '$servicio' AND CAST(fecha_inclusion as DATE) BETWEEN '$fechai' AND '$fechaf' AND le.reprogramo <> '' AND c.colaborador_id = '$medico_general'";	
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$registro = "SELECT DATE_FORMAT(CAST(le.fecha_solicitud AS DATE), '%d/%m/%Y') AS 'fecha_solicitud', DATE_FORMAT(CAST(le.fecha_inclusion AS DATE), '%d/%m/%Y') AS 'fecha_registro', CONCAT(p.nombre,' ',p.apellido) AS 'nombre', le.edad AS 'edad', p.identidad AS 'identidad', CONCAT(p.localidad,', ',m.nombre) AS 'direccion', p.telefono AS 'telefono', pc.nombre AS 'especialidad', CONCAT(c.nombre,' ',c.apellido) AS 'medico',
(CASE WHEN le.prioridad = 'P' THEN 'X' ELSE '' END) AS 'preferente',
(CASE WHEN le.prioridad = 'N' THEN 'X' ELSE '' END) AS 'normal',
le.fecha_cita AS 'fecha_cita',
(CASE WHEN le.tipo_cita = 'N' THEN 'X' ELSE '' END) AS 'nuevo',
(CASE WHEN le.tipo_cita = 'S' THEN 'X' ELSE '' END) AS 'sub',
le.reprogramo AS 'reprogramacion',
le.reprogramo AS 'reprogramacion', DATEDIFF(le.fecha_cita,le.fecha_solicitud) AS 'dias_espera'
FROM lista_espera AS le
INNER JOIN agenda AS a
ON le.pacientes_id = a.pacientes_id
INNER JOIN pacientes AS p
ON le.pacientes_id = p.pacientes_id
INNER JOIN municipios AS m
ON p.municipio_id = m.municipio_id
INNER JOIN colaboradores AS c
ON le.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
INNER JOIN servicios AS s
ON le.servicio = s.servicio_id
".$where."
GROUP BY le.pacientes_id, le.fecha_solicitud
ORDER BY c.puesto_id, c.colaborador_id, le.fecha_solicitud ASC";
$result = $mysqli->query($registro);
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("LISTA DE ESPERA" ); //titulo
 
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

$titulo1 = new PHPExcel_Style(); //nuevo estilo
$titulo1->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 12
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$subtitulo1 = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo1->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
      'size' => 11
    ),
	'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID
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
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('G8'); //INMOVILIZA PANELES
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
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('M1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);

$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:Q$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:Q$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "LISTA DE ESPERA Y PROGRAMACION DE CITAS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:Q$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:Q$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes Hasta: $mes1, $año");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:Q$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:Q$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "SERVICIO:");
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", strtoupper($servicio_name));
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "C$fila:D$fila");

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("A6:A7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha de Solicitud de Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
$objPHPExcel->getActiveSheet()->mergeCells("B6:B7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Fecha de Inclusión a la Lista de Espera');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
$objPHPExcel->getActiveSheet()->mergeCells("C6:C7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nombre del Usuario');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
$objPHPExcel->getActiveSheet()->mergeCells("D6:D7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Edad (Años/Meses)');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14); 
$objPHPExcel->getActiveSheet()->mergeCells("E6:E7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Número de Identidad (O de expediente)');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15); 
$objPHPExcel->getActiveSheet()->mergeCells("F6:F7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Dirección');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40); 
$objPHPExcel->getActiveSheet()->mergeCells("G6:G7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'N° de Teléfono');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
$objPHPExcel->getActiveSheet()->mergeCells("H6:H7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Especialidad');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15); 
$objPHPExcel->getActiveSheet()->mergeCells("I6:I7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Nombre del Médico');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20); 
$objPHPExcel->getActiveSheet()->mergeCells("J6:J7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Días de Espera');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10); 
$objPHPExcel->getActiveSheet()->mergeCells("Q6:Q7"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A6:J7"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A6:J7")->getFont()->setBold(true); //negrita
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A6:Q7"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A6:Q7")->getFont()->setBold(true); //negrita

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Prioridad Clínica');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12); 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "K$fila:L$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("K$fila:Q$fila")->getFont()->setBold(true); //negrita

$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Preferente');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(6); 
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Normal');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(6);  
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "K$fila:L$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("K$fila:L$fila")->getFont()->setBold(true); //negrita

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Fecha de Programación de Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15); 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "M$fila:M$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->mergeCells("M6:M7"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("M$fila:M$fila")->getFont()->setBold(true); //negrita

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Tipo de Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12); 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "N$fila:P$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("N$fila:P$fila")->getFont()->setBold(true); //negrita
$objPHPExcel->getActiveSheet()->mergeCells("N$fila:P$fila"); //unir celdas

$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Nueva');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(4);
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Subsiguiente');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(4);
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Reprogramación');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(4);
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "N$fila:P$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("N$fila:P$fila")->getFont()->setBold(true); //negrita

$fila=7;
$i=1;
//rellenar con contenido
	if($result->num_rows>0){
		while($registro1 = $result->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $i);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro1['fecha_solicitud']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro1['fecha_registro']);	
	       $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro1['nombre']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro1['edad']);	
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("F$fila", $registro1['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro1['direccion']);	
	       $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro1['telefono']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro1['especialidad']);	
	       $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro1['medico']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro1['preferente']);	
	       $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro1['normal']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro1['fecha_cita']);	
	       $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro1['nuevo']);
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro1['sub']);	
	       $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro1['reprogramacion']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro1['dias_espera']);			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:Q$fila");
           $i++;		   
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
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="LISTA DE REPROGRAMACION DE CITAS '.strtoupper($servicio_name).' '.strtoupper($unidad_name).' '.$colaborador_name.' '.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>