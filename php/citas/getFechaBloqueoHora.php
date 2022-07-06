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
$consulta = "SELECT bloqueo_id 
   FROM bloqueo 
   WHERE fecha_cita = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta);

if($result->num_rows==0){
	echo 1; //LA HORA NO SE ENCUENTRA BLOQUEADA
}else{
	echo 2; //HORA BLOQUEADA
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
