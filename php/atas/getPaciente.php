<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$db = $_SESSION['db'];
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$expediente = $_POST['expediente'];
$servicio = $_POST['servicio'];
$medico = $_SESSION['colaborador_id'];

//CONSULTAR PACIENTE
$consulta_paciente = "SELECT pacientes_id 
   FROM pacientes WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_paciente);
$consulta_paciente2 = $result->fetch_assoc();
$pacientes_id = $consulta_paciente2['pacientes_id'];


if($expediente >=1 && $expediente < 13000){//Esta condicion de mayor que 1 y menor que trece mil se puede eliminar en un futuro
	$paciente = 'S';
}else{
	$consultar_paciente = "SELECT ata_id
         FROM ata
         WHERE expediente = '$expediente' AND servicio_id = '$servicio'";
	$result = $mysqli->query($consultar_paciente);
		 
	if($result->num_rows>0){
	   $paciente = 'S';
	}else{
		$paciente = 'N';
	}
}

echo $paciente;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>