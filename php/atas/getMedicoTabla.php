<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
$servicio = $_POST['servicio'];
$puesto_id = $_POST['puesto_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT c.colaborador_id AS 'colaborador_id', CONCAT(c.nombre,' ',c.apellido) 'colaborador'
              FROM servicios_puestos AS sp
              INNER JOIN colaboradores AS c
              ON sp.colaborador_id = c.colaborador_id
              INNER JOIN puesto_colaboradores AS pc
              ON c.puesto_id = pc.puesto_id
              INNER JOIN users AS u
              ON sp.colaborador_id = u.colaborador_id
              WHERE c.puesto_id = '$puesto_id' AND sp.servicio_id = '$servicio' AND u.estatus = 1";
$result = $mysqli->query($consulta);	

$arreglo = array();

while($data = $result->fetch_assoc()){				
	$arreglo["data"][] = $data;		
}

echo json_encode($arreglo);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>