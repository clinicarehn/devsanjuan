<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT raza 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query);
$consulta2 = $result->fetch_assoc();


if($consulta2['raza'] == ""){
	$raza = 0;
}else{
   $raza = $consulta2['raza'];	
}

echo $raza;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>