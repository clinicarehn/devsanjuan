<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$entrevista_id = $_POST['entrevista_id'];

//ELIMINARMOS LA ENTREVISTA
$delete = "DELETE FROM entrevista
	WHERE entrevista_id = '$entrevista_id'";
$query = $mysqli->query($delete);

if($query){//REGISTRO ALMACENADO CORRECTAMENTE
	$datos = array(
		0 => "Eliminado", 
		1 => "Registro Eliminado Correctamente", 
		2 => "success",
		3 => "btn-primary",
		4 => "formulario_entrevista_trabajo_social",
		5 => "Registro",
		6 => "EntrevistaTS",		
	);
}else{//NO SE PUEDO ALMACENAR ESTE REGISTRO
	$datos = array(
		0 => "Error", 
		1 => "No se puedo modificar este registro, los datos son incorrectos por favor corregir", 
		2 => "error",
		3 => "btn-danger",
		4 => "",
		5 => "",			
	);
}	

echo json_encode($datos);
?>