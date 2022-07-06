<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT parentesco 
   FROM pacientes 
   WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query);
$consulta2 = $result->fetch_assoc();

if($consulta2['parentesco'] == ""){
   $parentesco = 0;
}else{
   $parentesco = $consulta2['parentesco'];	
}

echo $parentesco;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>