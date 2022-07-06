<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$hosp_id = $_POST['hosp_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT estado 
   FROM hospitalizacion 
   WHERE hosp_id = '$hosp_id'";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$estado = $consulta2['estado'];

echo $estado;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>