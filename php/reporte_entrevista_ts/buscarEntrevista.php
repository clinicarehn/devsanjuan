<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$entrevista_id = $_POST['entrevista_id'];

$query = "SELECT p.expediente AS 'expediente', e.fecha AS 'fecha', e.entrevista_modalidad_id AS 'modalidad_id', CONCAT(p.nombre,' ',p.apellido) AS 'paciente', e.entrevistado AS 'entrevistado', e.relacion_paciente AS 'relacion', e.solicitado AS 'solicitado', e.entrevista_intervencion_id AS 'intervencion_id', e.agenda AS 'agenda', e.servicio_id AS 'servicio_id', e.motivo AS 'motivo', e.desarollo AS 'desarollo', e.valoracion AS 'valoracion', e.observacion AS 'observacion', e.clasificacion1 AS 'clasificacion1', e.tipologia1 AS 'tipologia1', e.clasificacion2 AS 'clasificacion2', e.tipologia2 AS 'tipologia2', e.clasificacion3 AS 'clasificacion3', e.tipologia3 AS 'tipologia3'
	FROM entrevista AS e
	INNER JOIN pacientes AS p
	ON e.pacientes_id = p.pacientes_id
	WHERE e.entrevista_id = '$entrevista_id'";
$result = $mysqli->query($query);

if($result->num_rows>0){
	$consultar = $result->fetch_assoc();	
	
	$datos = array(
		0 => $consultar['expediente'], 
		1 => $consultar['fecha'], 
		2 => $consultar['modalidad_id'],
		3 => $consultar['paciente'],
		4 => $consultar['entrevistado'], 
		5 => $consultar['relacion'],
		6 => $consultar['solicitado'],
		7 => $consultar['intervencion_id'], 
		8 => $consultar['agenda'],
		9 => $consultar['servicio_id'],
		10 => $consultar['motivo'], 
		11 => $consultar['desarollo'],
		12 => $consultar['valoracion'], 
		13 => $consultar['observacion'],
		14 => $consultar['clasificacion1'],
		15 => $consultar['tipologia1'], 
		16 => $consultar['clasificacion2'],
		17 => $consultar['tipologia2'],
		18 => $consultar['clasificacion3'],	
		19 => $consultar['tipologia3'],			
	);
}
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>