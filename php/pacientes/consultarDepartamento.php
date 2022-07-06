<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT departamento_id 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query);

$consulta2 = $result->fetch_assoc();

if($consulta2['departamento_id'] == ""){
	$departamento_id = 0;
}else{
	$departamento_id = $consulta2['departamento_id'];
}
echo $departamento_id;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>