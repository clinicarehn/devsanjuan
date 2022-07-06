<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];

$consulta = "SELECT nombre 
   FROM municipios 
   WHERE departamento_id = '$departamento' AND municipio_id = '$municipio'"; 
$result = $mysqli->query($consulta);
  
if($result->num_rows>0){
	echo 2;
}else{
	echo 1;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>