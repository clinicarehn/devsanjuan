<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$fecha = date("Y-m-d");

//CONSULTAR LOS MEDICAMENTOS
$query = "SELECT co.colas_id AS 'colas_id', co.cola_numero AS 'cola_numero', co.fecha AS 'fecha', p.identidad AS 'identidad', p.expediente AS 'expediente', CONCAT(p.apellido,' ',p.nombre) as 'usuario', s.nombre AS 'servicio', pc.nombre AS 'puesto', CONCAT(c.apellido,' ',c.nombre) as 'profesional',  co.receta_id AS 'receta_id', co.programar_cita_id AS 'programar_cita_id', co.transito_id AS 'transito_id', p.telefono AS 'telefono1', p.telefono1 AS 'telefono2'
FROM colas AS co
INNER JOIN pacientes AS p
ON co.pacientes_id = p.pacientes_id
INNER JOIN colaboradores AS c
ON co.colaborador_id = c.colaborador_id
INNER JOIN servicios AS s
ON co.servicio_id = s.servicio_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
INNER JOIN admision_servicios AS ads
ON ads.puesto_id = c.puesto_id
WHERE co.fecha = '$fecha' AND co.admision = 2 AND co.farmacia = 1  AND pc.puesto_id = 2 AND co.receta_id != 0
GROUP BY co.colas_id
ORDER BY co.cola_numero, co.servicio_id";
$result = $mysqli->query($query);

$arreglo = array();

while( $data = $result->fetch_assoc()){
	$arreglo["data"][] = eliminar_acentos($data);
}

echo json_encode($arreglo);
?>