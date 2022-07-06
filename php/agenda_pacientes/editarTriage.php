<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$agenda_id = $_POST['agenda_id'];
$colaborador_id = $_POST['colaborador_id'];
$expediente = $_POST['expediente'];
$pacientes_id = $_POST['pacientes_id'];
$servicio_id = $_POST['servicio_id'];
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR FECHA_CITA
$consulta_fecha = "SELECT CAST(fecha_cita AS DATE) AS fecha_cita 
   FROM agenda 
   WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consulta_fecha) or die($mysqli->error);
$consulta_fecha2 = $result->fetch_assoc();

$fecha_cita = "";

if($result->num_rows>0){
	$fecha_cita = $consulta_fecha2['fecha_cita'];	
}

if($expediente == 0){
	$expediente = "TEMP";
}
//OBTENER NOMBRE DEL USUARIO
$consulta_nombre = "SELECT CONCAT(apellido, ' ', nombre) AS 'nombre', email, identidad, telefono 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consulta_nombre) or die($mysqli->error);
$consulta_nombre2 = $result->fetch_assoc();

$nombres = "";
$identidad = "";
$email = "";
$telefono = "";

if($result->num_rows>0){
	$nombres = $consulta_nombre2['nombre'];
	$identidad = $consulta_nombre2['identidad'];
	$email = $consulta_nombre2['email'];
	$telefono = $consulta_nombre2['telefono'];	
}

//CONSULTAR EXISTENCIA DE REGISTRO

$consultar_existencia = "SELECT confirmacion_agenda_id, observacion, confirmo, confirmo_status 
      FROM confirmacion_agenda 
      WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";  
$result = $mysqli->query($consultar_existencia) or die($mysqli->error);	  
	   
$consultar_existencia2 = $result->fetch_assoc();

$consulta_existencia_cofirmacion = "";
$consulta_existencia_observacion = "";
$consulta_existencia_confirmo = "";
$consulta_existencia_confirmo_status = "";

if($result->num_rows>0){
	$consulta_existencia_cofirmacion = $consultar_existencia2['confirmacion_agenda_id'];
    $consulta_existencia_observacion = $consultar_existencia2['observacion'];
	
	if($consultar_existencia2['confirmo'] == "" || $consultar_existencia2['confirmo'] == NULL){
		$consulta_existencia_confirmo = 2;
	}else{
		$consulta_existencia_confirmo = $consultar_existencia2['confirmo'];
	}

	if($consultar_existencia2['confirmo_status'] == "" || $consultar_existencia2['confirmo_status'] == NULL){
		$consulta_existencia_confirmo_status = 0;
	}else{
		$consulta_existencia_confirmo_status = $consultar_existencia2['confirmo_status'];
	}	
}


//Obtener datos del triage
$query_triage = "SELECT triage_id, atencion_id, estado_atencion, observacion, informacion, tipo_id, comentario, asistira_triage
  FROM triage
  WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha_cita'";
$result = $mysqli->query($query_triage) or die($mysqli->error);	  
	   
$consultar_triage = $result->fetch_assoc();
$atencion_id = "";
$estado_atencion = "";
$observacion = "";
$informacion = "";
$tipo_id = "";
$comentario = "";
$triage_id = "";
$asistira_triage = "";

if($result->num_rows>0){
	$atencion_id = $consultar_triage['atencion_id'];
	$estado_atencion = $consultar_triage['estado_atencion'];
	$observacion = $consultar_triage['observacion'];
	$informacion = $consultar_triage['informacion'];
	$tipo_id = $consultar_triage['tipo_id'];
	$comentario = $consultar_triage['comentario'];
	$triage_id = $consultar_triage['triage_id'];
	$asistira_triage = $consultar_triage['asistira_triage'];	
}

$datos = array(
				0 => $agenda_id, 
				1 => $colaborador_id, 
				2 => $servicio_id, 				
 				3 => $fecha_cita,
				4 => $expediente, 	
				5 => $nombres,
				6 => $identidad,				
				7 => $email,
				8 => $telefono,
				9 => $consulta_existencia_observacion,
				10 => $consulta_existencia_confirmo,
				11 => $consulta_existencia_confirmo_status,	
                12 => $atencion_id,					
                13 => $asistira_triage,					
                14 => $observacion,					
                15 => $informacion,	
                16 => $tipo_id,
                17 => $comentario,
                18 => $triage_id,
                19 => $estado_atencion,				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>