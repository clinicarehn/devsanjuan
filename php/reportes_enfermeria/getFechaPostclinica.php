<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$postclinica_id = $_POST['postclinica_id'];

//CONSULTAMOS FECHA DE REGISTRO
$consulta = "SELECT fecha 
    FROM postclinica 
	WHERE postclinica_id = '$postclinica_id'";
$result = $mysqli->query($consulta);
$consulta1 = $result->fetch_assoc();
$fecha = $consulta1['fecha'];

echo date("Y-m-d", strtotime($fecha));

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>