<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT profesion 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query);
$consulta2 = $result->fetch_assoc();
$profesion = $consulta2['profesion'];

if($consulta2['profesion'] == ""){
	$profesion = 0;
}else{
	$profesion = $consulta2['profesion'];
}

echo $profesion;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>