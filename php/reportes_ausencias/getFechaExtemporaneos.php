<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$extem_id = $_POST['extem_id'];
//CONSULTAMOS FECHA DE REGISTRO
$consulta = "SELECT fecha 
     FROM extemporaneos 
	 WHERE extem_id = '$extem_id'";
$result = $mysqli->query($consulta);
$consulta1 = $result->fetch_assoc();
$fecha = $consulta1['fecha'];

echo $fecha;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>