<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL REGISTRO
$valores = "SELECT * 
   FROM combustible
   WHERE combustible_id = '$id'";
$result = $mysqli->query($valores);	

$valores2 = $result->fetch_assoc();

$datos = array(
				0 => $valores2['fecha'], 
				1 => $valores2['tanque_inicio'],
				2 => $valores2['cantidad_litros'],
				3 => $valores2['valor_compra'], 				
				4 => $valores2['tanque_final'],
				5 => $valores2['transportista'],
				6 => $valores2['vehiculo_id'],							
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>