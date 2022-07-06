<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$expediente = $_POST['expediente'];
$fecha = $_POST['fecha'];
$servicio_id = $_POST['servicio_id'];
$colaborador_id = $_POST['colaborador_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT agenda_id 
   FROM agenda 
   WHERE expediente = '$expediente' AND CAST(fecha_cita AS DATE) = '$fecha' AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
echo $consulta2['agenda_id'];

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>