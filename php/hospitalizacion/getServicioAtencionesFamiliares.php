<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
date_default_timezone_set('America/Tegucigalpa');

$colaborador_id = $_SESSION['colaborador_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT servicio_id
FROM servicios_puestos
WHERE colaborador_id = '$colaborador_id' AND servicio_id = 13";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$servicio_id = $consulta2['servicio_id'];

echo $servicio_id;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>