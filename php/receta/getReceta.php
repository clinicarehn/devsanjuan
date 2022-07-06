<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$receta_id = $_POST['receta_id'];

//CONSULTAR DETALLES DE LA RECETA
$query = "SELECT r.fecha AS 'fecha', p.identidad AS 'identidad', p.expediente AS 'expediente', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', s.servicio_id AS 'servicio_id', r.observaciones AS 'observaciones'
	FROM receta AS r
	INNER JOIN pacientes AS p
	ON r.pacientes_id = p.pacientes_id
	INNER JOIN servicios AS s
	ON r.servicio_id = s.servicio_id
	WHERE r.receta_id = '$receta_id'
	ORDER BY r.fecha DESC";
$result_receta = $mysqli->query($query);

if($result_receta->num_rows>0){
	$valores2 = $result_receta->fetch_assoc();
    $datos = array(
			0 => $valores2['expediente'], 			
			1 => $valores2['fecha'],
			2 => $valores2['identidad'], 			
			3 => $valores2['nombre'],	
			4 => $valores2['servicio_id'],
			5 => $valores2['observaciones'],
    );	
}	

echo json_encode($datos);
?>