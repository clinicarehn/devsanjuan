<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$programar_cita_id = $_POST['programar_cita_id'];

//CONSULTAR DETALLES DE LA RECETA
$query = "SELECT pc.programar_cita_id  AS 'programar_cita_id ', CONCAT(p.nombre,' ',p.apellido) AS 'usuario', p.identidad AS 'identidad', p.expediente AS 'expediente', CONCAT(c.nombre,' ',c.apellido) AS 'profesional', s.nombre AS 'servicio', pc.fecha_cita AS 'fecha_cita', tp.nombre AS 'tipo_cita', pc.descripcion AS 'descripcion', CONCAT(c1.nombre,' ',c1.apellido) AS 'usuario_sistema',
(CASE WHEN pc.paciente = 'N' THEN 'Nuevo' ELSE 'Subsiguiente' END) AS 'paciente', pc1.nombre AS 'unidad', DATE_FORMAT(pc.fecha_cita, '%d/%m/%Y') AS 'fecha_cita'
FROM programar_cita AS pc
INNER JOIN pacientes AS p
ON pc.pacientes_id = p.pacientes_id
INNER JOIN colaboradores AS c
ON pc.colaborador_id = c.colaborador_id
INNER JOIN servicios AS s
ON pc.servicio_id = s.servicio_id
INNER JOIN tipo_cita AS tp
ON pc.tipo_cita = tp.tipo_cita_id
INNER JOIN colaboradores AS c1
ON pc.usuario = c1.colaborador_id
INNER JOIN puesto_colaboradores AS pc1
ON c.puesto_id = pc1.puesto_id
WHERE pc.programar_cita_id = '$programar_cita_id'
ORDER BY fecha_cita DESC";
$result = $mysqli->query($query);

$arreglo = array();

while( $row = $result->fetch_assoc()){
  $arreglo[] = $row;
}

echo json_encode($arreglo);
?>
