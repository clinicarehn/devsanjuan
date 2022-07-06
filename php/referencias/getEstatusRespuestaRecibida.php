<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
 
date_default_timezone_set('America/Tegucigalpa');

$referenciar_id = $_POST['referenciar_id'];

$consulta = "SELECT respuesta_recibida 
    FROM referencia_enviada 
	WHERE referenciar_id= '$referenciar_id'"; 
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$respuesta = $consulta2['respuesta_recibida'];

echo $respuesta;


$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>