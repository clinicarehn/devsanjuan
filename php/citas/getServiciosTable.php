<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
$usuario = $_SESSION['colaborador_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT s.servicio_id AS 'servicio_id', s.nombre AS 'nombre'
    FROM colaboradores AS c
    INNER JOIN servicios_puestos AS sp
    ON c.colaborador_id = sp.colaborador_id
    INNER JOIN servicios AS s
    ON sp.servicio_id = s.servicio_id
    WHERE c.colaborador_id = '$usuario'";
$result = $mysqli->query($consulta);	

$arreglo = array();

while($data = $result->fetch_assoc()){				
	$arreglo["data"][] = $data;		
}

echo json_encode($arreglo);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>