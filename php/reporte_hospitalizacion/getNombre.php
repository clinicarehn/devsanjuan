<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$id = $_POST['id']; 

//CONSULTAR NOMBRE
$consulta_nombre = "SELECT CONCAT(nombre, ' ', apellido) AS 'nombre' 
     FROM pacientes
	 WHERE expediente = '$id'";
$result = $mysqli->query($consulta_nombre);	 
$consulta_nombre1 = $result->fetch_assoc();
$nombre = $consulta_nombre1['nombre'];

echo $nombre;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>