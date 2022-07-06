<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$clasificacion_diagnostica_id = $_POST['clasificacion_diagnostica_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT *
			 FROM tipologia
			 WHERE clasificacion_diagnostica_id = '$clasificacion_diagnostica_id'";
$result = $mysqli->query($consulta);	

$arreglo = array();

while($data = $result->fetch_assoc()){				
	$arreglo["data"][] = $data;		
}

echo json_encode($arreglo);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>