<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$ata_id = $_POST['ata_id'];
//CONSULTAMOS FECHA DE REGISTRO
$consulta = "SELECT fecha 
    FROM ata 
	WHERE ata_id = '$ata_id'";
$result = $mysqli->query($consulta);
$consulta1 = $result->fetch_assoc();
$fecha = $consulta1['fecha'];

echo $fecha;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>