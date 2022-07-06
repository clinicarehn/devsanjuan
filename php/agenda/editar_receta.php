<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['agenda_id'];
$agenda_id = $_POST['agenda_id'];

//OBTENER DATOS DEL USUARIO
$query = "SELECT CONCAT(p.nombre,' ',p.apellido) AS 'usuario', p.identidad AS 'identidad', p.expediente AS 'expediente', a.servicio_id
  FROM agenda AS a
  INNER JOIN pacientes AS p
  ON a.pacientes_id = p.pacientes_id
  WHERE a.agenda_id = '$agenda_id'";
  
$result = $mysqli->query($query);
$consulta = $result->fetch_assoc();

$usuario = "";
$identidad = "";
$expediente = "";
$servicio_id = "";

if($result->num_rows>0){
	$usuario = $consulta['usuario'];
	$identidad = $consulta['identidad'];
	$expediente = $consulta['expediente'];
	$servicio_id = $consulta['servicio_id'];
}

$datos = array(
				0 => $usuario, 
				1 => $identidad, 
 				2 => $expediente,
 				3 => $servicio_id,				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>