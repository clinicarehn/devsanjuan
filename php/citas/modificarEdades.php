<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$edad = $_POST['edad'];

$update = "UPDATE config_edad SET edad = '$edad'";
$query = $mysqli->query($update);

if($query){
	echo 1;
}else{
	echo 2;
}

$mysqli->close();//CERRAR CONEXIÓN
?>