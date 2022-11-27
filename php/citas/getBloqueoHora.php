<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();
 
date_default_timezone_set('America/Tegucigalpa');

$bloqueo_id = $_POST['bloqueo_id']; 

//OBTENER EXPEDIENTE DE USUARIO
$consulta_datos = "SELECT fecha_cita
   FROM bloqueo 
   WHERE bloqueo_id = '$bloqueo_id'";
$result = $mysqli->query($consulta_datos);
$consulta_datos1 = $result->fetch_assoc();
$fecha_cita = $consulta_datos1['fecha_cita'];

echo $fecha_cita;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>