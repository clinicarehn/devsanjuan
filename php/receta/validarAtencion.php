<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$servicio_id = $_POST['servicio_id'];
$fecha = $_POST['fecha'];
$pacientes_id = $_POST['pacientes_id'];
$colaborador_id = $_POST['colaborador_id'];

$query = "SELECT p.pacientes_id AS 'pacientes_id', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS 'nombre'
FROM ata AS a
INNER JOIN pacientes as p
ON a.expediente = p.expediente
WHERE a.fecha = '$fecha' AND p.pacientes_id = '$pacientes_id' AND a.colaborador_id = '$colaborador_id' AND a.servicio_id = '$servicio_id'";
$result = $mysqli->query($query);

if($result->num_rows == 0){
	echo 1;//ESTE USUARIO NO TIENE ATENCIÓN
}else{
	echo 2;//ESTE USUARIO CUENTA CON ATENCION PRESENTE
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>