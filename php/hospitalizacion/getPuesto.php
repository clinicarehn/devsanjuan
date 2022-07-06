<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$usuario = $_SESSION['colaborador_id'];
$consulta = "SELECT puesto_id 
   FROM colaboradores 
   WHERE colaborador_id = '$usuario'"; 
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$puesto_id = $consulta2['puesto_id'];

echo $puesto_id;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>