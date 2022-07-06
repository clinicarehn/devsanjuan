<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$pacientes_id = $_POST['pacientes_seg_id'];

//CONSULTAR NOMBRE PACIENTE
$consultar_expediente = "SELECT CONCAT(nombres,' ',apellidos) AS 'nombre'
     FROM pacientes_seguimiento 
	 WHERE pacientes_seg_id = '$pacientes_id'";
$result = $mysqli->query($consultar_expediente);
	 
$consultar_expediente2 = $result->fetch_assoc();

$nombre = "";
if($result->num_rows>0){
	$nombre = $consultar_expediente2['nombre'];
}

$datos = array(
	0 => $pacientes_id, 
	1 => $nombre, 
);		
				
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>