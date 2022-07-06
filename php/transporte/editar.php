<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL REGISTRO
$valores = "SELECT * 
   FROM transporte_usuarios
   WHERE transporte_usuarios_id = '$id'";
$result = $mysqli->query($valores);	

$valores2 = $result->fetch_assoc();

$datos = array(
				0 => $valores2['motivo_viaje'], 
				1 => $valores2['adult_h'], 
 				2 => $valores2['adult_m'],
				3 => $valores2['niños'],
				4 => $valores2['hora_i'],
				5 => $valores2['hora_f'],	
				6 => $valores2['km_i'],	
				7 => $valores2['km_f'],	
				8 => $valores2['transportista'],
                9 => $valores2['vehiculo_id'],
                10 => $valores2['fecha'],				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>