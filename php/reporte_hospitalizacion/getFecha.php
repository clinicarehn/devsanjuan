<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$hosp_id = $_POST['hosp_id'];

$consulta = "SELECT fecha 
    FROM hospitalizacion 
	WHERE hosp_id = '$hosp_id'";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$fecha = $consulta2['fecha'];

echo $fecha;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>