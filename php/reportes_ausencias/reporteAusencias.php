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
$colaborador_usuario = $_GET['colaborador_usuario'];

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

//INICIO CONSULTA DE FECHAS PARA EVALUAR EL PRIEMR DIA DEL AÑO PARA ENERO Y EL ULTIMO DIA DEL AÑO PARA DICIEMBRE
$año_actual = date("Y", strtotime($desde));
$mes_actual = date("m", strtotime($desde));
$dia = date("d", mktime(0,0,0, $mes_actual+1, 0, $año_actual));

$dia1 = date('d', mktime(0,0,0, $mes_actual, 1, $año_actual)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes_actual, $dia, $año_actual)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año_actual."-".$mes_actual."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año_actual."-".$mes_actual."-".$dia2));
//FIN CONSULTA DE FECHAS PARA EVALUAR EL PRIEMR DIA DEL AÑO PARA ENERO Y EL ULTIMO DIA DEL AÑO PARA DICIEMBRE

//OBTENER NOMBRE SERVICIO
$consulta_servicio = "SELECT nombre 
     FROM servicios 
	 WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio) or die($mysqli->error);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_name = $consulta_servicio1['nombre'];

$colaborador_name = "";
$atencion = "";

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if($servicio != "" && $unidad == "" && $profesional == "" && $colaborador_usuario == ""){
    $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio'";		
}else if ($servicio != "" && $unidad != "" && $profesional == "" && $colaborador_usuario == ""){
    $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad'";				
}else if ($servicio != "" && $unidad != "" && $profesional != "" && $colaborador_usuario == ""){
    $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.colaborador_id = '$profesional'";
}else{
	//OBTENERR NOMBRE COLABORADOR/USUARIO DEL SISTEMA
    $consulta_colaborador_nombre = "SELECT CONCAT(apellido,' ',nombre) AS 'usuario' 
	     FROM colaboradores 
	     WHERE colaborador_id = '$colaborador_usuario'";
	$result = $mysqli->query($consulta_colaborador_nombre);
    $consulta_colaborador_nombre2 = $result->fetch_assoc();
    $colaborador_name = $consulta_colaborador_nombre2['usuario'];
	
	$atencion = " Realizado por: ".$colaborador_name;
	
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.usuario = '$colaborador_usuario'";
}
	
$registro = "SELECT p.pacientes_id AS 'pacientes_id', a.ausencia_id AS 'ausencia_id', (CASE WHEN a.paciente = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', a.fecha AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.identidad AS 'identidad', a.expediente AS 'expediente', a.comentario AS 'comentario', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', CONCAT(c1.nombre,' ',c1.apellido) AS 'usuario', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', p.telefono AS 'telefono', s.servicio_id AS 'servicio_id', c.colaborador_id AS 'colaborador_id', a.fecha AS 'fecha_ausencia', d.nombre AS 'departamento', m.nombre AS 'municipio', a.paciente AS 'paciente'
      FROM ausencias AS a
      INNER JOIN pacientes AS p
      ON a.pacientes_id = p.pacientes_id
      INNER JOIN colaboradores AS c
      ON a.colaborador_id = c.colaborador_id
      INNER JOIN colaboradores AS c1
      ON a.usuario = c1.colaborador_id
      INNER JOIN servicios AS s
	  ON a.servicio_id = s.servicio_id
      INNER JOIN departamentos AS d
      ON p.departamento_id = d.departamento_id
      INNER JOIN municipios AS m
      ON p.municipio_id = m.municipio_id  
      ".$where."
      ORDER BY a.fecha ASC";
$result = $mysqli->query($registro) or die($mysqli->error);	  

$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Reporte Ausencias"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Reporte Ausencias"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('F7'); //INMOVILIZA PANELES 
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
$objDrawing->setHeight(230); //altura
$objDrawing->setWidth(200); //anchura
$objDrawing->setCoordinates('P1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(230); //altura
$objDrawing->setWidth(200); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:Q3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Hospital San Juan de Dios");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:Q$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:Q$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:Q4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Registro de Ausencia de Usuarios $servicio_name");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:Q$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:Q$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:Q5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:Q$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:Q$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:Q5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $atencion);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:Q$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:Q$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->mergeCells("A5:A6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Fecha Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Nombre del Paciente');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45); 
$objPHPExcel->getActiveSheet()->mergeCells("C5:C6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Expediente Clínico');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
$objPHPExcel->getActiveSheet()->mergeCells("D5:D6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Tel./Cel');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
$objPHPExcel->getActiveSheet()->mergeCells("E5:E6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Renovación Fecha');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("F5:F6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Hora');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("G5:G6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Profesional');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
$objPHPExcel->getActiveSheet()->mergeCells("H5:H6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Confirmo');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
$objPHPExcel->getActiveSheet()->mergeCells("I5:J5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Causa');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(35);
$objPHPExcel->getActiveSheet()->mergeCells("K5:K6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Paciente');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("L5:L6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Procedencia');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$objPHPExcel->getActiveSheet()->mergeCells("M5:N5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Citas Perdidas');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("O5:O6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Citas Reprogramadas');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("P5:P6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Fecha Ultima Cita');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
$objPHPExcel->getActiveSheet()->mergeCells("Q5:Q6"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:Q$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:Q$fila")->getFont()->setBold(true); //negrita

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Si');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'No');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Departamento');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Municipio');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:Q$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:Q$fila")->getFont()->setBold(true); //negrita
 
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
		
	   //CONSULTAR CONFIRMACION
	   $pacientes_id = $registro2['pacientes_id'];
	   $fecha_cita = $registro2['fecha_ausencia'];
	   $servicio_id = $registro2['servicio_id'];
	   $colaborador_id = $registro2['colaborador_id'];
	   $confirmo_si = '';
	   $confirmo_no = '';
	   
	   //INICIO CONSULTAR EL TOTAL DE CITAS PERDIDAS
	   $query_citas_perdidas = "SELECT COUNT(a.ausencia_id) AS 'total'
           FROM ausencias AS a
           WHERE a.pacientes_id = '$pacientes_id' AND YEAR(a.fecha) = '$año' AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id'"; 
	   $result_citas_perdidas = $mysqli->query($query_citas_perdidas) or die($mysqli->error);
	   $registro_citas_perdidas = $result_citas_perdidas->fetch_assoc(); 	          	  
	   //FIN ONSULTAR EL TOTAL DE CITAS PERDIDASO
	   
	   //INICIO CONSULTAR EL TOTAL DE CITAS REPROGRAMADAS 
	   $query_citas_reprogramadas = "SELECT COUNT(a.agenda_id) AS 'total'
           FROM agenda AS a
           WHERE a.pacientes_id = '$pacientes_id' AND YEAR(a.fecha_cita) = '$año' AND a.reprogramo = 1 AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id'"; 
	   $result_citas_reprogramadas = $mysqli->query($query_citas_reprogramadas) or die($mysqli->error);
	   $registro_citas_reprogramadas = $result_citas_reprogramadas->fetch_assoc(); 	   
	   //FIN CONSULTAR EL TOTAL DE CITAS REPGORAMADAS
	   
	   //INCIO CONSULTAR FECHA ULTIMA REPROGRAMACION DE CITAS
	   $query_utltima_reprogramacion = "SELECT DATE_FORMAT(fecha_cita, '%d/%m/%Y') AS 'fecha_cita'
           FROM agenda AS a
           WHERE pacientes_id = '$pacientes_id' AND YEAR(a.fecha_cita) = '$año' AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id' AND a.reprogramo = 1
           ORDER BY a.expediente DESC";
	   $result_utltima_reprogramacion = $mysqli->query($query_utltima_reprogramacion) or die($mysqli->error);
	   $registro_utltima_reprogramacion = $result_utltima_reprogramacion->fetch_assoc();
	   //FIN CONSULTAR FECHA ULTIMA REPROGROGRAMACION DE CITAS
	   
	   //INICIO CONSULTAR CONFIRMACION DE LA REPROGRAMACION DE AUSENCIAS DE USUARIOS	      	   
	   $query_confirmacion = "SELECT confirmar_ausencias_repro_id, observacion, confirmo
	      FROM  confirmar_ausencias_repro
		  WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id'"; 
	   $result_confirmacion = $mysqli->query($query_confirmacion) or die($mysqli->error);
	   $registro_confirmacion2 = $result_confirmacion->fetch_assoc();

	   if($registro_confirmacion2['confirmo'] == 1){
		   $confirmo_si = 'X'; 
		   if($registro_confirmacion2['observacion'] == ''){
			   $observacion= $registro2['comentario'];     
		   }else{
			   $observacion = $registro2['comentario']."***".$registro_confirmacion2['observacion'];
		   }   	
	   }else{
		   $confirmo_no = 'X'; 
		   if($registro_confirmacion2['observacion'] == ''){
			   $observacion= $registro2['comentario'];     
		   }else{
			   $observacion = $registro2['comentario']."***".$registro_confirmacion2['observacion'];
		   }   		   
	   }	   
	   //FIN CONSULTAR CONFIRMACION DE LA REPROGRAMACION DE AUSENCIAS DE USUARIOS
	   
	   //INICIO CONSULTAR NUEVA FECHA DE CITA PARA EL USUARIO
	   $query_fecha_cita = "SELECT DATE_FORMAT(fecha_cita, '%d/%m/%Y') AS 'fecha_cita', hora
	      FROM agenda
		  WHERE pacientes_id = '$pacientes_id' AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id' AND status = 0";
	   $result_fecha_cita = $mysqli->query($query_fecha_cita) or die($mysqli->error);
	   $registro_fecha_cita = $result_fecha_cita->fetch_assoc();
	   $consulta_fecha_cita = $registro_fecha_cita['fecha_cita'];
	   $hora = $registro_fecha_cita['hora'];	   
	   //FIN CONSULTAR NUEVA FECHA DE CITA PARA EL USUARIO
	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['fecha']);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['nombre']);
	   		
	   if( strlen($registro2['identidad'])<10 ){
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	   }else{
		   $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	   }
	          
	   $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['telefono']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $consulta_fecha_cita);
	   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $hora);
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['medico']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $confirmo_si);
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $confirmo_no);
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $observacion);
	   $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['paciente']);
       $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['departamento']);	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['municipio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro_citas_perdidas['total']);
       $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro_citas_reprogramadas['total']);	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro_utltima_reprogramacion['fecha_cita']);
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:Q$fila");	
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

$objPHPExcel->removeSheetByIndex(
    $objPHPExcel->getIndex(
        $objPHPExcel->getSheetByName('Worksheet')
    )
);
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte de Ausencia de Usuarios '.$servicio_name.' '.$mes.'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>