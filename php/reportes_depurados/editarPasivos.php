<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$id = $_POST['id'];
date_default_timezone_set('America/Tegucigalpa');

//CONSULTA EN LA ENTIDAD CORPORACION		 
$query = "SELECT CONCAT(p.nombre,' ',p.apellido) AS 'paciente', CAST(d.fecha AS DATE) AS 'fecha', d.pacientes_id AS 'pacientes_id', d.expediente AS 'expediente', d.diagnostico AS 'diagnostico', d.fecha_ultima AS 'fecha_ultima', d.usuario AS 'usuario', d.colaborador_id AS 'colaborador_id', d.colaborador_id1 AS 'colaborador_id1', d.servicio_id AS 'servicio_id', d.comentario AS 'comentario'
          FROM depurados AS d
		  INNER JOIN pacientes AS p
		  ON d.pacientes_id = p.pacientes_id
		  WHERE d.depurado_id = '$id'";
	
$result = $mysqli->query($query);			 
$valores2 = $result->fetch_assoc();

$pacientes_id = $valores2['pacientes_id'];
$expediente = $valores2['expediente'];
	
$datos = array(
				0 => $expediente, 
 				1 => $valores2['fecha'],
				2 => $valores2['fecha_ultima'], 
				3 => $valores2['paciente'], 
				4 => $valores2['servicio_id'], 	
                5 => $valores2['colaborador_id'], 
				6 => $valores2['colaborador_id1'],
				7 => $valores2['diagnostico'],
				8 => $valores2['comentario'],				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>