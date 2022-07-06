<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$queja_id = $_POST['queja_id']; 

//OBTENER EXPEDIENTE DE USUAIRO
$get_pacientes_id = "SELECT pacientes_id
   FROM queja
   WHERE queja_id = '$queja_id'";
$result = $mysqli->query($get_pacientes_id);
$consulta_get_pacientes_id  = $result->fetch_assoc();

$pacientes_id = "";

if($result->num_rows>0){
	$pacientes_id = $consulta_get_pacientes_id['pacientes_id'];
}

//CONSULTAR NOMBRE USUARIO
$consulta_nombre = "SELECT CONCAT(nombre,' ',apellido) AS 'nombre' 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consulta_nombre);
$consulta_nombre1 = $result->fetch_assoc();

$nombre = "";

if($result->num_rows>0){
    $nombre = $consulta_nombre1['nombre'];	
}

echo $nombre;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>