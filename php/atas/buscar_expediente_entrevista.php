<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$expediente_valor = $_POST['expediente'];

$consultar_expediente = "SELECT pacientes_id, expediente, CONCAT(apellido,' ',nombre) AS 'nombre'
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();
$pacientes_id = $consultar_expediente2['pacientes_id'];
$expediente = $consultar_expediente2['expediente'];
$nombre = $consultar_expediente2['nombre'];

$datos = array(
	0 => $pacientes_id,
	1 => $expediente,
	2 => $nombre,	
);	
			
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>