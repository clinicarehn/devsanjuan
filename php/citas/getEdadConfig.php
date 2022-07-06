<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$consulta = "SELECT edad 
   FROM config_edad";
$result = $mysqli->query($consulta);
$consulta2 =  $result->fetch_assoc();
$edad = $consulta2['edad'];

echo $edad;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>