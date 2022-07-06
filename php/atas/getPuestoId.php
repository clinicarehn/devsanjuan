<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$medico = $_SESSION['colaborador_id'];

//CONSULTAR PUESTO ID
$consultar_puesto = "SELECT puesto_id 
   FROM colaboradores 
   WHERE colaborador_id = '$medico'";
$result = $mysqli->query($consultar_puesto);

$consultar_puest2 = $result->fetch_assoc();
$puesto_id = $consultar_puest2['puesto_id'];

echo $puesto_id;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>