<?php
session_start();
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT fecha 
      FROM transporte_usuarios
      WHERE transporte_usuarios_id = '$id'";
$result = $mysqli->query($consulta);  
$consulta2 = $result->fetch_assoc();

$datos = array(
    0 => $consulta2['fecha'], 			
);

echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>


               
			   
               