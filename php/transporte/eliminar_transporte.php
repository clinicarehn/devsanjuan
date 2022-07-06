<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];

$query_utimo_registro = "SELECT transporte_usuarios_id
      FROM transporte_usuarios 
	  ORDER BY transporte_usuarios_id 
	  DESC LIMIT 1";
$result = $mysqli->query($query_utimo_registro);
$conmsulta_utimo_registro = $result->fetch_assoc();
$ultimo = $conmsulta_utimo_registro['transporte_usuarios_id'];

if($id == $ultimo){
	$delete = "DELETE FROM transporte_usuarios
	   WHERE transporte_usuarios_id = '$id'";
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