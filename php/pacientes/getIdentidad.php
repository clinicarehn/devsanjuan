<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT identidad 
     FROM pacientes 
	 WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query); 
$consulta2 = $result->fetch_assoc(); 

$identidad = $consulta2['identidad'];

echo $identidad;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>