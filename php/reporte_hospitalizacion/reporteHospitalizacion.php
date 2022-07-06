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
$servicio = $_GET['servicio'];
$unidad = $_GET['unidad'];
$profesional = $_GET['profesional'];
$estado = $_GET['estado'];
$dato = $_GET['dato'];

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

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

$servicio_name = "";
$unidad_name = "";

$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_name = $consulta_servicio1['nombre'];
  
$unidad_name = "";  
//EJECUTAMOS LA CONSULTA DE BUSQUEDA

if($servicio != "" && $unidad == "" && $profesional == ""){		
    $where = "WHERE h.estado = '$estado' AND  h.fecha BETWEEN '$desde' AND '$hasta' AND h.servicio_id = '$servicio'";		
}else if($servicio != "" && $unidad != "" && $profesional == ""){	
	$consulta_unidad = "SELECT nombre 
	    FROM puesto_colaboradores 
		WHERE puesto_id = '$unidad'";
	$result = $mysqli->query($consulta_unidad);
    $consulta_unidad1 = $result->fetch_assoc();
    $unidad_name = $consulta_unidad1['nombre'];	
    $where = "WHERE h.estado = '$estado' AND  h.fecha BETWEEN '$desde' AND '$hasta' AND h.servicio_id = '$servicio' AND h.puesto_id = '$unidad'";		
}else if($servicio != "" && $unidad != "" && $profesional != ""){	
	$consulta_unidad = "SELECT nombre 
	    FROM puesto_colaboradores 
		WHERE puesto_id = '$unidad'";
	$result = $mysqli->query($consulta_unidad);
    $consulta_unidad1 = $result->fetch_assoc();
    $unidad_name = $consulta_unidad1['nombre'];	
    $where = "WHERE h.estado = '$estado' AND  h.fecha BETWEEN '$desde' AND '$hasta' AND h.servicio_id = '$servicio' AND h.puesto_id = '$unidad' AND h.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%')";		
}else if($servicio != "" && $unidad != "" && $profesional != ""){	
	$consulta_unidad = "SELECT nombre 
	    FROM puesto_colaboradores 
		WHERE puesto_id = '$unidad'";
	$result = $mysqli->query($consulta_unidad);
    $consulta_unidad1 = $result->fetch_assoc();
    $unidad_name = $consulta_unidad1['nombre'];	
    $where = "WHERE h.estado = '$estado' AND  h.fecha BETWEEN '$desde' AND '$hasta' AND h.servicio_id = '$servicio' AND h.puesto_id = '$unidad' AND h.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%')";
}	
	
$registro = "SELECT DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS 'fecha_nacimiento', h.hosp_id AS 'hosp_id', DATE_FORMAT(h.fecha, '%d/%m/%Y') AS 'fecha', p.expediente AS 'expediente', 
       CONCAT(p.nombre,' ',p.apellido) AS 'paciente_nombre', h.paciente AS 'paciente', 
	   CONCAT(c.nombre,' ',c.apellido) AS 'profesional', s.nombre AS 'servicio', h.observacion AS 'observacion', p.sexo AS 'sexo', 
	   (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', p.identidad AS 'identidad', d.nombre AS 'departamento', m.nombre AS 'municipio', 
	   p.localidad AS 'localidad', pa1.patologia_id AS 'patologia_id1', pa2.patologia_id AS 'patologia_id2', pa3.patologia_id AS 'patologia_id3',
	   a.años AS 'años', a.meses AS 'meses', a.dias AS 'dias', a.recibidade AS 'recibidade', a.enviadaa AS 'enviadaa'
       FROM hospitalizacion AS h
       INNER JOIN pacientes AS p
       ON h.expediente = p.expediente
       INNER JOIN colaboradores AS c
       ON h.colaborador_id = c.colaborador_id
       INNER JOIN servicios AS s
       ON h.servicio_id = s.servicio_id
	   INNER JOIN departamentos AS d
	   ON p.departamento_id = d.departamento_id
	   INNER JOIN municipios AS m
	   ON p.municipio_id = m.municipio_id
	   LEFT JOIN patologia AS pa1
	   ON h.patologia_id = pa1.id
	   LEFT JOIN patologia AS pa2
	   ON h.patologia_id1 = pa2.id
	   LEFT JOIN patologia AS pa3
	   ON h.patologia_id2 = pa3.id	
       INNER JOIN ata AS a
       ON h.ata_id = a.ata_id	   
	   ".$where."
       ORDER BY h.fecha, h.expediente";
$result = $mysqli->query($registro);	   
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Ambulatorias"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Atenciones Ambulatorias"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('F8'); //INMOVILIZA PANELES
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
$objDrawing->setHeight(70); //altura
$objDrawing->setWidth(205); //altura
$objDrawing->setCoordinates('W1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:W3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:W$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:W4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Atenciones Ambulatorias $servicio_name $unidad_name");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:W$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:W5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:W$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", "ATA");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila");

$fila=5;

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->mergeCells("A5:A7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'FECHA');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'NÚMERO DE HISTORIA CLÍNICA');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
$objPHPExcel->getActiveSheet()->mergeCells("C5:C7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'NOMBRE DEL USUARIO');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40); 
$objPHPExcel->getActiveSheet()->mergeCells("D5:D7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'IDENTIDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("E5:E7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'SEXO');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(6);
$objPHPExcel->getActiveSheet()->mergeCells("F5:F7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'FECHA DE NACIMIENTO');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
$objPHPExcel->getActiveSheet()->mergeCells("G5:G7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'EDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(21);
$objPHPExcel->getActiveSheet()->mergeCells("H5:J5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'PACIENTE');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("K5:K7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'PROCEDENCIA');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(70);
$objPHPExcel->getActiveSheet()->mergeCells("L5:N5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'DIAGNOSTICO / ACTIVIDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(69);
$objPHPExcel->getActiveSheet()->mergeCells("O5:T5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'REFERENCIA');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(60);
$objPHPExcel->getActiveSheet()->mergeCells("U5:V5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'PROFESIONAL');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
$objPHPExcel->getActiveSheet()->mergeCells("W5:W7"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A5:W7"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A5:W7")->getFont()->setBold(true); //negrita

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
$objPHPExcel->getActiveSheet()->mergeCells("H6:H7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'MESES');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(7);
$objPHPExcel->getActiveSheet()->mergeCells("I6:I7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'DIAS');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(7);
$objPHPExcel->getActiveSheet()->mergeCells("J6:J7"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'DEPARTAMENTO');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("L6:L7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'MUNICIPIO');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("M6:M7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'LOCALIDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
$objPHPExcel->getActiveSheet()->mergeCells("N6:N7"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '1');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(8);
$objPHPExcel->getActiveSheet()->mergeCells("O6:O7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'CONDICIÓN');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("P6:P7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '2');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(8);
$objPHPExcel->getActiveSheet()->mergeCells("Q6:Q7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'CONDICIÓN');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("R6:R7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '3');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(8);
$objPHPExcel->getActiveSheet()->mergeCells("S6:S7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'CONDICIÓN');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("T6:T7"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'ENVIADA A:');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
$objPHPExcel->getActiveSheet()->mergeCells("U6:U7"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'RECIBIDA DE:');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(30);
$objPHPExcel->getActiveSheet()->mergeCells("V6:V7"); //unir celdas

$fila=7; 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   $fila+=1;
	    if($registro2['expediente'] == 0){
			$expediente = 'TEMP';
		}else{
			$expediente = $registro2['expediente'];
		} 
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['fecha']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $expediente);
       $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['paciente_nombre']);
	   		
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("E$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("E$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	          		  
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['sexo']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['fecha_nacimiento']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['años']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['meses']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['dias']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['paciente']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['departamento']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['municipio']);	   
       $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['localidad']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro2['patologia_id1']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '');
	   $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro2['patologia_id2']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '');
	   $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro2['patologia_id3']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", '');
	   $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro2['enviadaa']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro2['recibidade']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro2['profesional']);
	   
	   
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:W$fila");	
	   $valor++;
   }	
}
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
$fila+=7; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "HSJD_".strtoupper($mes)."_$año");
$fila+=1; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Nombre y Firma del Responsable __________________________________________________________________________________");
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
header('Content-Disposition: attachment; filename="Atenciones Ambulatorias ATA '.$servicio_name.' '.$unidad_name.' '.$mes.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>