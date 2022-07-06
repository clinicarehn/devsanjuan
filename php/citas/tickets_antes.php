<?php  
session_start();   
include('../funtions.php');
	
//CONEXION A DB
connect();
date_default_timezone_set('America/Tegucigalpa');
header("Content-Type: text/html;charset=utf-8");

$pdf = new FPDF('P','mm',array(80,115));
#Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(1, 0.6 , 25); 

#Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true,0.5);
$pdf->AddPage();
$pdf->Image('../../img/logo.png' , 11,2, 45 , 10,'PNG');

$pdf->Ln(12);

//CONSULTA
$agenda_id = $_GET['agenda_id'];

//EVALUA EL CONTENIDO DE LA VARIABLE A BUSCAR
//CONSULTA DATOS DE LA AGENDA
$consulta_agenda = mysql_query("SELECT usuario, CAST(fecha_cita AS DATE) AS 'fecha_cita', hora, fecha_registro, pacientes_id, colaborador_id, expediente, servicio_id FROM agenda WHERE agenda_id = '$agenda_id'");	
$consulta_agenda2 = mysql_fetch_array($consulta_agenda);
$pacientes_id = $consulta_agenda2['pacientes_id'];
$colaborador_id  = $consulta_agenda2['colaborador_id'];
$expediente  = $consulta_agenda2['expediente'];
$servicio_id  = $consulta_agenda2['servicio_id'];
$usuario_sistema = $consulta_agenda2['usuario'];
$fecha_registro = $consulta_agenda2['fecha_registro'];

if ($expediente == 0){
	$exp = "TEMP"; 
}else{
	$exp = $expediente;
}	

//CONSULTA DATOS DEL USUARIO
$consulta_usuario = mysql_query("SELECT CONCAT(nombre,' ',apellido) AS 'nombre', identidad FROM pacientes WHERE pacientes_id = '$pacientes_id'");
$consulta_usuario2 = mysql_fetch_array($consulta_usuario);

//CONSULTA DATOS DEL MEDICO
$consulta_medico = mysql_query("SELECT CONCAT(nombre,' ',apellido) AS 'nombre', puesto_id FROM colaboradores WHERE colaborador_id = '$colaborador_id'");
$consulta_medico2 = mysql_fetch_array($consulta_medico);
$puestoi_id  = $consulta_medico2['puesto_id'];

//CONSULTAR TIPO MEDICO
$consulta_tipo_medico = mysql_query("SELECT nombre FROM puesto_colaboradores WHERE puesto_id = '$puestoi_id'");
$consulta_tipo_medico2 = mysql_fetch_array($consulta_tipo_medico);
$puesto  = mb_convert_case($consulta_tipo_medico2['nombre'], MB_CASE_TITLE, "UTF-8");

//CONSULTAR SERVICIO
$consulta_servicio = mysql_query("SELECT nombre FROM servicios WHERE servicio_id = '$servicio_id'");
$consulta_servicio2 = mysql_fetch_array($consulta_servicio);
$servicio  = trim(ucwords(strtolower($consulta_servicio2['nombre']), " "));

//CONSULTAR NOMBRE DE USUARIO DEL SISTEMA
$consulta_usuario_sistema = mysql_query("SELECT CONCAT(nombre,' ',apellido) AS 'nombre' FROM colaboradores WHERE colaborador_id = '$usuario_sistema'");
$consulta_usuario_sistema2 = mysql_fetch_array($consulta_usuario_sistema);	
$usuario_sistema_nombre  = trim(ucwords(strtolower($consulta_usuario_sistema2['nombre']), " "));

//CONOCER EL TIPO DE USUARIO
if($expediente >=1 && $expediente < 13000){ //ESTO SE PUEDE REMOVER EN UN FUTURO
	$usuario = 'S'; 
}else{
   $consultar_expediente = mysql_query("SELECT ata_id FROM ata WHERE expediente = '$expediente'");
   $consultar_expediente1 = mysql_fetch_array($consultar_expediente);   
   if($consultar_expediente1['ata_id'] == ""){
	   $usuario = 'Nuevo'; 
   }else{
	   $usuario = 'Subsiguiente';
   }   
}

$hora = date('g:i a',strtotime($consulta_agenda2['hora']));	

//ENCABEZADO DEL CONTENIDO DEL REPORTE
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 3, utf8_decode('Cita N°:').' '.$agenda_id.'', 0);
$pdf->Ln(1);
$pdf->Cell(0, 8, 'Fecha Cita: '.$fecha_start = date("d-m-Y", strtotime($consulta_agenda2['fecha_cita'])).'  Hora: '.$hora, 0);
$pdf->Ln(1);
$pdf->Cell(0, 14, 'Tipo de Cita: '. $usuario, 0);
$pdf->Ln(1);
$pdf->Cell(0, 20, 'Nombre: '.utf8_decode($consulta_usuario2['nombre']), 0);
$pdf->Ln(1);
$pdf->Cell(0, 26, 'Identidad: '.$consulta_usuario2['identidad'].'  Exp: '.$exp, 0);
$pdf->Ln(1);
$pdf->Cell(0, 32, utf8_decode('Médico:').' '.utf8_decode($consulta_medico2['nombre']), 0);
$pdf->Ln(1);
$pdf->Cell(0, 37, 'Servicio: '.utf8_decode($servicio), 0);
$pdf->Ln(1);
$pdf->Cell(0, 43, 'Especialidad: '.utf8_decode($puesto), 0);
$pdf->Ln(1);
$pdf->Cell(0, 49, 'Usuario: '.utf8_decode($usuario_sistema_nombre), 0);

//LLENA EL CUEROP DEL REPORTE			  
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 45, utf8_decode('Nota:'), 0, 0,'C');
$pdf->Ln(3);
$pdf->Cell(0, 45, utf8_decode('Por favor estar 15 minutos antes de su cita.'),0,'C');
$pdf->Ln(3);
$pdf->Cell(0,47, utf8_decode("Haciendo el bien a los demas, nos hacemos,"),0,'C');
$pdf->Ln(3);
$pdf->Cell(0,47, utf8_decode("el bien a nosotros mismos."),0);

$pdf->SetFont('Arial', '', 10);
$pdf->Ln(3);
$pdf->Cell(0,53, utf8_decode("__________________________"), 0, 0,'C');
$pdf->Ln(2);
$pdf->Cell(0,54, utf8_decode("Firma y Sello"), 0, 0,'C');
$pdf->Ln(9);
$pdf->Cell(0,56, utf8_decode("Nos puede llamar al siguiente número"), 0, 0,'C');
$pdf->Ln(4);
$pdf->Cell(0,56, utf8_decode  ("PBX: 2512-0870"), 0, 0,'C');

$pdf->Ln(22);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0,21,'Fecha Registro: '.$fecha_registro, 0, 0,'C');

$pdf->Output('Citas.pdf','I');
?>