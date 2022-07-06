<?php
setlocale(LC_ALL,"es_ES");  
session_start(); 
set_include_path('../../fpdf/font');
require('../../fpdf/fpdf.php');
require('../../fpdf/phpqrcode/qrlib.php');  
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
header("Content-Type: text/html;charset=utf-8");

$pdf = new FPDF('P','mm',array(80,180));
#Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(6, 0.1 , 10); 

#Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true,0.5);
$pdf->AddPage();
$pdf->Image('../../img/logo.png' , 11,1, 45 , 10,'PNG');

$pdf->Ln(12);

//CONSULTA
$agenda_id = $_GET['agenda_id'];

//EVALUA EL CONTENIDO DE LA VARIABLE A BUSCAR
//CONSULTA DATOS DE LA AGENDA
$consulta_agenda = "SELECT usuario, DATE_FORMAT(CAST(fecha_cita AS DATE), '%d/%m/%Y') AS 'fecha_cita', CAST(fecha_cita AS DATE) AS 'fecha1', hora, DATE_FORMAT(fecha_registro, '%d/%m/%Y %h:%i:%s %p') AS 'fecha_registro', pacientes_id, colaborador_id, 
(CASE WHEN expediente = '0' THEN 'TEMP' ELSE expediente END) AS expediente, servicio_id, reprogramo, 
(CASE WHEN paciente = 'N' THEN 'Nuevo' ELSE 'Subsiguiente' END) AS paciente, fecha_cita AS 'fecha_cita_1'
    FROM agenda 
	WHERE agenda_id = '$agenda_id'";	
$result = $mysqli->query($consulta_agenda);
$consulta_agenda2 = $result->fetch_assoc();

$pacientes_id = "";
$colaborador_id  = "";
$expediente  = "";
$servicio_id  = "";
$usuario_sistema = "";
$fecha_registro = "";
$reprogramo = "";
$reprogramo_cita = "";
$fecha_cita = "";
$hora_cita = "";
$paciente = "";
$day = "";	
$month = "";
$year = "";
$fecha_completa = "";

if($result->num_rows>0){
	$pacientes_id = $consulta_agenda2['pacientes_id'];
	$colaborador_id  = $consulta_agenda2['colaborador_id'];
	$expediente  = $consulta_agenda2['expediente'];
	$servicio_id  = $consulta_agenda2['servicio_id'];
	$usuario_sistema = $consulta_agenda2['usuario'];
	$fecha_registro = $consulta_agenda2['fecha_registro'];
	$reprogramo = $consulta_agenda2['reprogramo'];
    $fecha_cita = $consulta_agenda2['fecha_cita'];	
	$hora_cita = $consulta_agenda2['hora'];
	$paciente = $consulta_agenda2['paciente'];
	
	$date = strtotime($consulta_agenda2['fecha_cita_1']);
	$year = date("Y", $date);
	$month = nombremes(date("m", $date));
	$day = date("d", $date);

	$fecha_completa = $day."-".$month."-".$year;
}

if($reprogramo == 1){
	$reprogramo_cita = "(Reprogramación)";
}else{
	$reprogramo_cita = "";
}

//CONSULTA DATOS DEL USUARIO
$consulta_usuario = "SELECT CONCAT(apellido,' ',nombre) AS 'nombre', identidad 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consulta_usuario);
$consulta_usuario2 = $result->fetch_assoc();

$nombre_usuario = "";
$identidad_usuario = "";
	
if($result->num_rows>0){
	$nombre_usuario = $consulta_usuario2['nombre'];
	$identidad_usuario = $consulta_usuario2['identidad'];
}
//CONSULTA DATOS DEL MEDICO
$consulta_medico = "SELECT CONCAT(apellido,' ',nombre) AS 'nombre', puesto_id 
   FROM colaboradores 
   WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_medico);
$consulta_medico2 = $result->fetch_assoc();

$puesto_id  = "";
$nombre_medico = "";

if($result->num_rows>0){
	$puesto_id  = $consulta_medico2['puesto_id'];
	$nombre_medico = $consulta_medico2['nombre'];
}
//CONSULTAR TIPO MEDICO
$consulta_tipo_medico = "SELECT nombre, puesto_id 
    FROM puesto_colaboradores 
	WHERE puesto_id = '$puesto_id'";
$result = $mysqli->query($consulta_tipo_medico);
$consulta_tipo_medico2 = $result->fetch_assoc();
$puesto  = cleanStringStrtolower($consulta_tipo_medico2['nombre']);

$consultar_colaborador = "";

if($result->num_rows>0){
	$consultar_colaborador = $consulta_tipo_medico2['puesto_id'];
}
//CONSULTAR SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio  = "";

if($result->num_rows>0){
	$servicio  = trim(ucwords(strtolower($consulta_servicio2['nombre']), " "));
}
//CONSULTAR NOMBRE DE USUARIO DEL SISTEMA
$consulta_usuario_sistema = "SELECT CONCAT(nombre,' ',apellido) AS 'nombre' 
     FROM colaboradores 
	 WHERE colaborador_id = '$usuario_sistema'";
$result = $mysqli->query($consulta_usuario_sistema);
$consulta_usuario_sistema2 = $result->fetch_assoc();	
$usuario_sistema_nombre  = "";

if($result->num_rows>0){
	$usuario_sistema_nombre  = trim(ucwords(strtolower($consulta_usuario_sistema2['nombre']), " "));
}

$hora = date('g:i a',strtotime($hora_cita));	

//ENCABEZADO DEL CONTENIDO DEL REPORTE
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(8, 8, 'No.: '.$agenda_id, 0);
$pdf->Ln(5);
$pdf->Cell(8, 8, 'Cita: '.$fecha_completa, 0);
$pdf->Ln(5);
$pdf->Cell(8, 8, 'Hora: '.$hora, 0);
$pdf->Ln(5);
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(8, 14, 'Tipo de Cita: '. $paciente.' '.utf8_decode($reprogramo_cita), 0);
$pdf->Ln(1);
$pdf->Cell(8, 20, 'Usuario: '.utf8_decode($nombre_usuario), 0);
$pdf->Ln(1);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(8, 26, 'Identidad: '.$identidad_usuario.'  Exp: '.$expediente, 0);
$pdf->Ln(1);
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(8, 32, utf8_decode('Profesional:').' '.utf8_decode($nombre_medico), 0);
$pdf->Ln(1);
$pdf->SetFont('helvetica', 'B', 9);	
$pdf->Cell(8, 37, 'Servicio: '.utf8_decode($servicio), 0);
$pdf->Ln(1);
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(8, 43, 'Especialidad: '.utf8_decode($puesto), 0);
$pdf->Ln(1);
$pdf->Cell(8, 49, 'Elaborado por: '.utf8_decode($usuario_sistema_nombre), 0);

//LLENA EL CUEROP DEL REPORTE			  
$pdf->Ln(7);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(8, 45, utf8_decode('Nota:'), 0);
$pdf->Ln(3);
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(8,47,utf8_decode("Por favor estar 15 minutos antes de su cita"), 0);
$pdf->Ln(3);
$pdf->Cell(8,49,utf8_decode("debe venir acompañado de un familiar"), 0);
$pdf->Ln(3);

$pdf->SetFont('helvetica', '', 8);
$pdf->Ln(3);
$pdf->Cell(8,77,utf8_decode("__________________________"), 0);
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(8,79,utf8_decode("Firma y Sello"), 0);
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(8,90,utf8_decode("Contáctanos"), 0);
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(8,96,utf8_decode  ("Información General PBX: +504 2512-0870"), 0);
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(8,99,utf8_decode  ("Aportación no Reembolsable"), 0);
$pdf->Ln(3);
$pdf->Cell(8,99,utf8_decode  ("si pierde su cita"), 0);
$pdf->Ln(7);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(8,100,utf8_decode  ("Haciendo el bien a los demas, nos hacemos"), 0, 'C');
$pdf->Ln(3);
$pdf->Cell(8,101,utf8_decode  ("el bien a nosotros mismos"), 0, 'C');
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(8,104,'Fecha Registro: '.$fecha_registro, 0);
$pdf->Ln(4);
$pdf->Cell(8,120,'');
//$link = 'https://api.whatsapp.com/send?phone=50494686195';
//$pdf->Image('http://chart.googleapis.com/chart?chs=40x40&cht=qr&chl='.$link.'&.png',20,115,40,40);

$pdf->Output('Citas.pdf','I');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>