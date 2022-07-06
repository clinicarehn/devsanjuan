<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT lugar_nacimiento 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query);
$consulta2 = $result->fetch_assoc();

if($consulta2['lugar_nacimiento'] == ""){
	$lugar_naciemiento = 0;
}else{
	$lugar_naciemiento = $consulta2['lugar_nacimiento'];
}

echo $lugar_naciemiento;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>