|<?php
session_start();
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$agenda_id = $_POST['agenda_id'];


//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT status
   FROM agenda
   WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$status = $consulta2['status'];

echo $status;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>


               
			   
               