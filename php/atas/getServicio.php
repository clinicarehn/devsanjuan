<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$agenda_id = $_POST['agenda_id'];
//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT servicio_id 
   FROM agenda 
   WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
echo $consulta2['servicio_id'];

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>