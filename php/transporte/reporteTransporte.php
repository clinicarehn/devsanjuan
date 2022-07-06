<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";

$dato = $_GET['dato'];
$fechai = $_GET['fechai'];
$fechaf = $_GET['fechaf'];
$vehiculo_id = $_GET['vehiculo_id'];

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
$año2=date("Y", strtotime($fechaf));

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

if($dato == ""){
	$where = "WHERE t.fecha BETWEEN '$fechai' AND '$fechaf' AND t.vehiculo_id = '$vehiculo_id'";
}else{
	$where = "WHERE t.fecha BETWEEN '$fechai' AND '$fechaf' AND t.vehiculo_id = '$vehiculo_id' AND (t.motivo_viaje LIKE '$dato%' OR CONCAT(c.nombre, ' ', c.apellido) LIKE '$dato%' OR CONCAT(c1.nombre, ' ', c1.apellido) LIKE '$dato%')";
}

//REGISTROS
$registro = "SELECT t.*, CONCAT(c.nombre, ' ', c.apellido) AS 'nombre_transportista', CONCAT(c1.nombre, ' ', c1.apellido) AS 'nombre_usuario',    timediff(t.hora_f,t.hora_i) AS 'total_horas', v.nombre AS 'vehiculo'
    FROM transporte_usuarios AS t
    INNER JOIN colaboradores AS c
    ON t.transportista = c.colaborador_id
    INNER JOIN colaboradores AS c1
    ON t.usuario = c1.colaborador_id
	INNER JOIN vehiculo AS v
	ON t.vehiculo_id = v.vehiculo_id
	".$where." 
	ORDER BY t.transporte_usuarios_id ASC";			
$result = $mysqli->query($registro);	

$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("REPORTE TRANSPORTE"); //titulo
 
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
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )	
));

 
$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
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
    )
));
//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("REPORTE TRANSPORTE"); //establecer titulo de hoja
 
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
//fin: establecer margenes
 
//incluir imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 7);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "CONTROL DE USO VEHICULAR. Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:P$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13); 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Motivo del Viaje');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(75);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Usuarios Transportados');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(28); 
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Hora Inicio');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Hora Fin');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Total Horas');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Kilometraje Inicial');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Kilometraje Final');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Kilometraje Recorridos');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Vehículo');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Transportista');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Uusario');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);

//UNIR CELDAS
$objPHPExcel->getActiveSheet()->mergeCells("A4:A6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("B4:B6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("C4:C6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("H4:H6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("I4:I6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("J4:J6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("K4:K6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("L4:L6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("M4:M6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("N4:N6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("O4:O6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("P4:P6"); //unir celdas

$objPHPExcel->getActiveSheet()->mergeCells("F5:F6"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("G5:G6"); //unir celdas


$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:P$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:P$fila")->getFont()->setBold(true); //negrita

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Adultos');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Niños');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:P$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:P$fila")->getFont()->setBold(true); //negrita

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:P$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:P$fila")->getFont()->setBold(true); //negrita

$valor = 1;
$total_h = 0; $total_m = 0; $total_niño = 0; $total_total = 0;
if($result->num_rows>0){
	while($registro1 = $result->fetch_assoc()){ 
	       $fila+=1;
           $horas_transcurridas = 	$registro1['total_horas'];
		   $horas = date('H',strtotime($horas_transcurridas));
           $minutos = date('i',strtotime($horas_transcurridas));
		   $total = $horas.' horas y '.$minutos.' minutos';
		
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro1['fecha']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro1['motivo_viaje']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro1['adult_h']);
		   $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro1['adult_m']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro1['niños']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro1['total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", date('g:i a',strtotime($registro1['hora_i'])));
		   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", date('g:i a',strtotime($registro1['hora_f'])));
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $total);   
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro1['km_i']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro1['km_f']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro1['km_total']); 

           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro1['vehiculo']); 
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro1['nombre_transportista']); 
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro1['nombre_usuario']); 		   
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:P$fila");	

           $total_h += $registro1['adult_h']; 
		   $total_m += $registro1['adult_m']; 
		   $total_niño += $registro1['niños']; 
		   $total_total += $registro1['total'];            		   
		   $valor++;
     }		
 }	
 
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "TOTAL GENERAL");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:C$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "A$fila:C$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $total_h);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $total_m);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $total_niño);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $total_total);
$objPHPExcel->getActiveSheet()->mergeCells("H$fila:P$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($totales, "D$fila:P$fila");
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
header('Content-Disposition: attachment; filename="CONTROL DE USO DE VEHÍCULOS '.' '.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>