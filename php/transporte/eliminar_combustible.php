<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];

$query_utimo_registro = "SELECT combustible_id
      FROM combustible 
	  ORDER BY combustible_id 
	  DESC LIMIT 1";
$result = $mysqli->query($query_utimo_registro);
$conmsulta_utimo_registro = $result->fetch_assoc();
$ultimo = $conmsulta_utimo_registro['combustible_id'];

if($id == $ultimo){
	$delete = "DELETE FROM combustible
	   WHERE combustible_id = '$id'";
	$query = $mysqli->query($delete);
	
	if($query){
		echo 1;//REGISTRO ELIMINADO CORRECTAMENTE
	}else{
		echo 2;//ERROR AL ELIMINAR ESTE REGISTRO
	}
}else{
	echo 3;//NO SE PUEDE ELIMINAR EL REGISTRO YA QUE NO ES EL ULTIMO ALMACENADO EN SISTEMA
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>