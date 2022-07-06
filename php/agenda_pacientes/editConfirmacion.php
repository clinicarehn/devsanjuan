<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$agenda_id = $_POST['agenda_id'];
$colaborador_id = $_POST['colaborador_id'];
$servicio_id = $_POST['servicio_id'];
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR FECHA_CITA
$consulta_fecha = "SELECT CAST(fecha_cita AS DATE) AS fecha_cita, pacientes_id, expediente, hora 
   FROM agenda 
   WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consulta_fecha) or die($mysqli->error);
$consulta_fecha2 = $result->fetch_assoc();

$fecha_cita = "";
$pacientes_id = "";
$expediente = "";
$hora = "";

if($result->num_rows>0){
	$fecha_cita = $consulta_fecha2['fecha_cita'];
	$pacientes_id = $consulta_fecha2['pacientes_id'];
	$expediente = $consulta_fecha2['expediente'];	
	$hora = date('g:i a',strtotime($consulta_fecha2['hora']));	
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
				12 => $hora,				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>