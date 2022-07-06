<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT e.entrevista_id AS 'entrevista_id', CONCAT(p.nombre,' ',p.apellido) AS 'usuario', p.identidad AS 'identidad', p.expediente AS 'expediente', em.nombre AS 'modalidad', e.entrevistado AS 'entrevistado', r.nombre AS 'relacion', CONCAT(c.nombre,' ',c.apellido) AS 'trabajador_social', CONCAT(c1.nombre,' ',c1.apellido) AS 'solicitado_por', e.agenda AS 'agenda', s.nombre AS 'servicio'
FROM entrevista AS e
INNER JOIN pacientes AS p
ON e.pacientes_id = p.pacientes_id
INNER JOIN colaboradores AS c
ON e.colaborador_id = c.colaborador_id
INNER JOIN servicios AS s
ON e.servicio_id = s.servicio_id
INNER JOIN entrevista_modalidad AS em
ON e.entrevista_modalidad_id = em.entrevista_modalidad_id
INNER JOIN relacion AS r
ON e.relacion_paciente = r.relacion_id
INNER JOIN colaboradores AS c1
ON e.solicitado = c1.colaborador_id
ORDER BY e.fecha DESC";
$result = $mysqli->query($consulta);	

$arreglo = array();

while($data = $result->fetch_assoc()){				
	$arreglo["data"][] = $data;		
}

echo json_encode($arreglo);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>