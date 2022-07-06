<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_POST['colaborador_id'];
$servicio_id = $_POST['servicio_id'];
$fecha_cita = $_POST['bloqueo_fecha'];
$observaciones = cleanString($_POST['bloqueo_obs']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

$consultar_bloqueo = "SELECT bloqueo_id
      FROM bloqueo 
	  WHERE fecha_cita = '$fecha_cita' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consultar_bloqueo);

if($result->num_rows==0){
	$bloqueo_id = correlativo("bloqueo_id","bloqueo");
	$insert = "INSERT INTO bloqueo 
		VALUES('$bloqueo_id','$fecha_cita','$colaborador_id','$servicio_id','$usuario','$observaciones','$fecha_registro')";
	$query = $mysqli->query($insert);

	if($query){
		$datos = array(
			0 => "Almacenado", 
			1 => "Registro Almacenado Correctamente", 
			2 => "success",
			3 => "btn-primary",
			4 => "formBloqueoHora",
			5 => "Registro",
			6 => "BloqueoHora",
			7 => "modalBloqueoHoras"
		);
	}else{
		$datos = array(
			0 => "Error", 
			1 => "No se puedo almacenar este registro, ya existe un bloqueo para esta hora", 
			2 => "error",
			3 => "btn-danger",
			4 => "",
			5 => "",			
		);
	}
}else{
	$datos = array(
		0 => "Error", 
		1 => "No se puede almacenar este regsitro, los datos son incorrectos por favor corregir", 
		2 => "error",
		3 => "btn-danger",
		4 => "",
		5 => "",			
	);	
}

echo json_encode($datos);
?>