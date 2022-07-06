<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT post.fecha AS 'fecha', CONCAT(p.nombre,' ',p.apellido) AS 'nombre', p.expediente AS 'expediente', p.identidad AS 'identidad', post.diagnostico AS 'diagnostico', post.fecha_cita AS 'fecha_cita', post.hora AS 'hora', post.instrucciones AS 'instrucciones', post.precedimiento AS 'procedimiento'
       FROM postclinica AS post
       INNER JOIN pacientes AS p
       ON post.expediente = p.expediente
       WHERE post.postclinica_id = '$id'";
$result = $mysqli->query($valores);	   
	
$valores2 = $result->fetch_assoc();
	
$datos = array(
				0 => $valores2['expediente'], 
				1 => $valores2['fecha'],  	
				2 => $valores2['identidad'], 
				3 => $valores2['nombre'],
				4 => $valores2['diagnostico'], 
				5 => $valores2['fecha_cita'],  	
				6 => $valores2['hora'], 
				7 => $valores2['instrucciones'],
				8 => $valores2['procedimiento'],   				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>