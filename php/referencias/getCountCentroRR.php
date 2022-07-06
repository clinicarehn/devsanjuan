<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['centro_id'];
date_default_timezone_set('America/Tegucigalpa');

//ELIMINAMOS EL REGISTRO
$consulta_centros = "SELECT COUNT(referenciar_id) AS 'referenciar_id' 
    FROM referencia_recibida 
	WHERE centro = '$id'";
$result = $mysqli->query($consulta_centros);
$consulta_centros2 = $result->fetch_assoc();
$total = $consulta_centros2['referenciar_id'];

echo $total;


$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>