<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$fecha = date("Y-m-d");
$colas_id = $_POST['colas_id'];
$horaf = date("H:m:s");

$update = "UPDATE colas
			SET
				farmacia = 2
			WHERE colas_id = '$colas_id'";		
$query = $mysqli->query($update);	

if($query){
	echo 1;//REGISTRO REMOVIDO CORRECTAMENTE
}else{
	echo 2;
}		
?>