<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$receta_id = $_POST['receta_id'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");
$estado = 1;//ACTIVO
$admision = 2;
$estado_receta = 2;//INACTIVO

//VERIFICAMOS LA RECETA EN LA ENTIDAD COLA, Y VALIDAMOS SI AUN ESTA EN BORRADOR
$consulta = "SELECT colas_id
	FROM colas
	WHERE receta_id = '$receta_id' AND admision = '$admision'";
$result_receta = $mysqli->query($consulta);

if($result_receta->num_rows==0){
	//CAMBIAMOS EL ESTADO DE LA RECETA
	$update = "UPDATE receta
		SET
			estado = '$estado_receta'
		WHERE receta_id = '$receta_id'";
	$query = $mysqli->query($update);
	
	if($query){
		$datos = array(
			0 => "Eiminado", 
			1 => "Registro Eliminado Correctamente", 
			2 => "success",
			3 => "btn-primary",
			4 => "formulario_receta_medica",
			5 => "Registro",
			6 => "ReporteRecetaMedica",
		);		
	}else{
		$datos = array(
			0 => "Error", 
			1 => "No se puedo almacenar este registro, los datos son incorrectos por favor corregir", 
			2 => "error",
			3 => "btn-danger",
			4 => "",
			5 => "",			
		);		
	}
}else{
	$datos = array(
		0 => "Error", 
		1 => "Lo sentimos esta receta ya fue despachada por el área de facturación y/o admisión", 
		2 => "error",
		3 => "btn-danger",
		4 => "",
		5 => "",			
	);		
}

echo json_encode($datos);
?>