<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$query = "SELECT r.receta_id AS 'receta_id', r.fecha AS 'fecha', CONCAT(p.apellido,' ',p.nombre) as 'usuario', CONCAT(c.nombre,' ',c.apellido) as 'profesional', s.nombre AS 'servicio', p.expediente AS 'expediente', p.identidad AS 'identidad'
FROM receta AS r
INNER JOIN pacientes AS p
ON p.pacientes_id = r.pacientes_id
INNER JOIN colaboradores AS c
ON r.colaborador_id = c.colaborador_id
INNER JOIN servicios AS s
ON r.servicio_id = s.servicio_id
WHERE estado = 1
ORDER BY r.fecha DESC";
$result = $mysqli->query($query);

$arreglo = array();

while($data = $result->fetch_assoc()){
	$arreglo["data"][] = eliminar_acentos($data);
}

echo json_encode($arreglo);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
