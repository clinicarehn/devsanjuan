<?php
include('../funtions.php');
session_start();

//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$expediente_valor = $_POST['expediente'];

$consultar_expediente = "SELECT expediente, pacientes_id 
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

echo $expediente;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>