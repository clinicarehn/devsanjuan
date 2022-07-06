<?php
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$servicio = $_GET['servicio'];
$desde = $_GET['fechai'];
$hasta = $_GET['fechaf'];

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

if($servicio == ""){
	$where = "WHERE t.fecha BETWEEN '$desde' AND '$hasta' AND t.asistira_triage = 1";
}else{
		//OBTENER NOMBRE SERVICIO
		$consulta_servicio = "SELECT nombre 
			FROM servicios 
			WHERE servicio_id = '$servicio'";
		$result = $mysqli->query($consulta_servicio);
		$consulta_servicio1 = $result->fetch_assoc();
		$servicio_name = $consulta_servicio1['nombre'];

	$where = "WHERE t.fecha BETWEEN '$desde' AND '$hasta' AND t.servicio_id = '$servicio' AND t.asistira_triage = 1";		
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
//CONSULTAR COLABORADORES
$query_colaboradores = "SELECT t.colaborador_id, CONCAT(c.nombre,' ',c.apellido) AS 'colaborador'
   FROM triage AS t
   INNER JOIN colaboradores AS c
   ON t.colaborador_id = c.colaborador_id
   ".$where."
   GROUP BY t.colaborador_id";  

$result_colaborador = $mysqli->query($query_colaboradores);
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Agenda"); //titulo
 
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
      'size' => 11
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
$objPHPExcel->getActiveSheet()->setTitle("Agenda"); //establecer titulo de hoja
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('E4'); //INMOVILIZA PANELES 
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
$objDrawing->setWidth(14); //altura
$objDrawing->setHeight(40); //altura
$objDrawing->setCoordinates('G1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setWidth(14); //altura
$objDrawing->setHeight(40); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A1:H1");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:H$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:H$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A2:H2");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Agenda Diaria $servicio_name");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:H$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:H$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:H3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:H$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:H$fila");
 
//rellenar con contenido
$valor = 1;

//CONSULTAR COLABORADOR
if($result_colaborador->num_rows>0){
	while($registro_colaborador = $result_colaborador->fetch_assoc()){
		$fila+=1;
		$colaborador_id = $registro_colaborador['colaborador_id'];
		$colaborador_nombre = $registro_colaborador['colaborador'];
		
		if($servicio == ""){
			$where = "WHERE t.fecha BETWEEN '$desde' AND '$hasta' AND t.colaborador_id = '$colaborador_id' AND t.asistira_triage = 1";
		}else{
			$where = "WHERE t.fecha BETWEEN '$desde' AND '$hasta' AND t.servicio_id = '$servicio' AND t.colaborador_id = '$colaborador_id' AND t.asistira_triage = 1";		
		}		
		//CONSULTAMOS AGENDA PARA CADA COLABORADOR	
		$registro = "SELECT p.expediente, p.identidad, CONCAT(p.nombre,' ',p.apellido) AS 'paciente', t.fecha AS 'fecha_cita', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', s.nombre AS 'servicio',
			(CASE WHEN t.tipo_id = 1 THEN '' ELSE tp.tipo END) AS 'tipo_atencion',
			(CASE WHEN t.atencion_id = 1 THEN '' ELSE ta.tipo END) AS 'enfermedad',
			(CASE WHEN t.estado_atencion = 1 THEN 'Sí' ELSE 'No' END) AS 'enfermo'
			FROM triage AS t
			INNER JOIN colaboradores AS c
			ON t.colaborador_id = c.colaborador_id
			INNER JOIN pacientes AS p
			ON t.pacientes_id = p.pacientes_id
			INNER JOIN servicios AS s
			ON t.servicio_id = s.servicio_id
			INNER JOIN triage_tipo_atencion as tp
			ON t.tipo_id = tp.tipo_id
			INNER JOIN triage_atencion ta
			ON t.atencion_id = ta.atencion_id
			".$where;
		$result = $mysqli->query($registro);
			
		$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Colaborador');
		$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->setSharedStyle($other, "A$fila:B$fila");
		
		$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $colaborador_nombre);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	
	
		$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Servicio');
		$objPHPExcel->getActiveSheet()->mergeCells("G$fila:G$fila"); //unir celdas
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->setSharedStyle($other, "G$fila:G$fila");
		
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $servicio_name);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);	
		
		$fila+=2;
		//MOSTRAMOS EL ENCABEZADO PARA LA AGENDA
		$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4); 
		$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Expediente');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Identidad');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nombre del Usuario');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40); 
		$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Fecha de Cita');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13); 
		$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Tipo Atención');
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Enfermedad');
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Enfermo');
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);			

		$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:H$fila"); //establecer estilo
		$objPHPExcel->getActiveSheet()->getStyle("A$fila:H$fila")->getFont()->setBold(true); //negrita		
		
		if($result->num_rows>0){
			while($registro_agenda = $result->fetch_assoc()){
				$fila+=1;
				
				if($registro_agenda['expediente'] == 0){
					$expediente = 'TEMP';
				}else{
					$expediente = $registro_agenda['expediente'];
				}
		
				$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
				$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $expediente);
				
				if( strlen($registro_agenda['identidad'])<10 ){
				   $objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
				 }else{
				   $objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", $registro_agenda['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
				}
				
				$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro_agenda['paciente']);
				$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro_agenda['fecha_cita']);
				$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro_agenda['tipo_atencion']);
				$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro_agenda['enfermedad']);
				$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro_agenda['enfermo']);				
				//Establecer estilo
				$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");	
				$valor++;
            }	
		}
		$fila+=1;
	}		
 }
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
$fila+=5; 
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
header('Content-Disposition: attachment; filename="Reporte de Agenda_Triage '.$servicio_name.' '.$mes.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');
exit();

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>