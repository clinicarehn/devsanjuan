<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();
 
date_default_timezone_set('America/Tegucigalpa');

$fecha = $_POST['fecha'];
$colaborador_id = $_POST['colaborador_id'];
$servicio_id = $_POST['servicio_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT observacion 
   FROM bloqueo 
   WHERE fecha_cita = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta);

$observacion = "";

if($result->num_rows>0){
   $consulta = $result->fetch_assoc();
   $observacion = $consulta['observacion'];
}

echo $observacion;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
