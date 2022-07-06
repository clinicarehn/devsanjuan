<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$nivel = $_POST['nivel'];
$centro_id = $_POST['centro_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT centros_id, centro_nombre 
    FROM centros_hospitalarios 
	WHERE niveles_centros_id = '$nivel' AND niveles_grupo_id = '$centro_id'";
$result = $mysqli->query($consulta);	

$arreglo = array();

while($data = $result->fetch_assoc()){				
	$arreglo["data"][] = $data;		
}

echo json_encode($arreglo);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>