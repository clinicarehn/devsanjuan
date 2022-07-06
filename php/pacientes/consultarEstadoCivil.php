<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT estado_civil 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query);
$consulta2 = $result->fetch_assoc();

if($consulta2['estado_civil'] == ""){
	$estado_civil = 0;
}else{
    $estado_civil = $consulta2['estado_civil'];	
}
echo $estado_civil;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>