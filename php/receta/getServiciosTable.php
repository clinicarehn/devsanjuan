<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT s.servicio_id AS 'servicio_id', s.nombre AS 'nombre'
FROM servicios_puestos AS sp
INNER JOIN servicios AS s
ON sp.servicio_id = s.servicio_id
GROUP BY s.servicio_id
ORDER BY s.nombre";
$result = $mysqli->query($consulta);	

$arreglo = array();

while($data = $result->fetch_assoc()){				
	$arreglo["data"][] = $data;		
}

echo json_encode($arreglo);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>