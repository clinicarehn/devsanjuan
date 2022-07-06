<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['id'];

//CONSULTA EN LA ENTIDAD AGENDA
$valores = "SELECT CONCAT(p.nombre,' ',p.apellido) AS 'nombre', p.expediente AS 'expediente', hc.cama_id AS 'cama', 
hc.paciente AS 'paciente', hc.puesto_id AS 'puesto_id', h.patologia_id AS 'patologia_id', h.patologia_id1 AS 'patologia_id1', 
h.patologia_id2 AS 'patologia_id2', h.enfermedad_id AS 'enfermedad_id', h.fecha AS 'fecha'
FROM hospitalizacion AS h
INNER JOIN pacientes AS p
ON h.expediente = p.expediente
INNER JOIN historial_camas AS hc
ON h.historial_id = hc.historial_id
WHERE h.hosp_id = '$id'";
$result = $mysqli->query($valores);

$valores2 = $result->fetch_assoc();

$datos = array(
				0 => $valores2['nombre'], 
				1 => $valores2['expediente'], 
 				2 => $valores2['paciente'], 
				3 => $valores2['cama'],
				4=> $valores2['puesto_id'],
				5 => $valores2['patologia_id'],
				6 => $valores2['patologia_id1'],
				7 => $valores2['patologia_id2'],
				8 => $valores2['enfermedad_id'],
                9 => $valores2['fecha'],				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>