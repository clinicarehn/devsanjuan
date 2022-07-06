<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$agenda_id = $_POST['agenda_id']; 
$colaborador_id = $_POST['colaborador_id']; 
$servicio_id = $_POST['servicio_id']; 
$expediente = $_POST['expediente']; 
$pacientes_id = $_POST['pacientes_id'];

//CONSULTAR PACIENTE ID
$query = "SELECT CAST(fecha_cita AS DATE) AS 'fecha_cita' 
    FROM agenda 
	WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($query);
$consulta_paciente1 = $result->fetch_assoc();

$fecha_cita = 0;

if($result->num_rows>0){
	$fecha_cita = $consulta_paciente1['fecha_cita'];
}

//CONSULTAMOS EXISTENCIA DE ATENCION
$consuta_existencia = "SELECT triage_id
  FROM triage
  WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha_cita'";
$result = $mysqli->query($consuta_existencia);
$consuta_existencia1 = $result->fetch_assoc();

if($result->num_rows>0){
	echo 1; //EL RESGISTRO YA EXISTE
}else{
	echo 2; //ESTE REGISTRO NO EXISTE
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN 
?>