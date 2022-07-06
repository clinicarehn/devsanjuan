<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');   

header('Content-Type: application/json');    

$queja_id = $_POST['queja_id'];
$fecha_registro = date("Y-m-d H:i:s");

//OBTENER DATOS DEL PACIENTE DESDE LA QUEJA
$consultar = "SELECT p.pacientes_id AS 'pacientes_id', p.expediente AS 'expediente', q.usuario AS 'usuario', q.servicio_id AS 'servicio_id', q.fecha AS 'fecha'
   FROM queja AS q
   INNER JOIN pacientes AS p
   ON q.pacientes_id = p.pacientes_id
   WHERE queja_id = '$queja_id'";

$result = $mysqli->query($consultar);
$consulta2  = $result->fetch_assoc();

$pacientes_id = ""; 
$expediente = "";   
$usuario = ""; 
$servicio_id = "";
$fecha = "";

if($result->num_rows>0){
	$pacientes_id = $consulta2['pacientes_id'];
	$expediente = $consulta2['expediente'];
	$usuario = $consulta2['usuario'];
	$servicio_id = $consulta2['servicio_id'];
	$fecha = $consulta2['fecha'];	
}

//CONSULTAMOS SI HAY VALOR EN LA QUEJA DE SEGUIMIENTO
$consulta_queja_seguimiento = "SELECT id 
   FROM queja_detalle
   WHERE queja_id = '$queja_id'";
$result_queja_seguimiento = $mysqli->query($consulta_queja_seguimiento);   
   
//ELIMINAR QUEJA
$delete = "DELETE FROM queja WHERE queja_id = '$queja_id'";

if($result_queja_seguimiento->num_rows==0){
	$query = $mysqli->query($delete);
	
	if($query){
		echo 1;//QUEJA ELIMINADA CORRECTAMENTE
		
		//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		$historial_numero = historial();
		$estado = "Eliminar";
		$observacion_historial = "Se ha eliminado la queja de este registro";
		$modulo = "Agenda";
		$insert = "INSERT INTO historial 
			VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$queja_id','$usuario','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";
		$mysqli->query($insert) or die($mysqli->error);
		/*****************************************************/		
	}else{
		echo 2;//ESTA QUEJA NO SE PUDO ELIMINAR
	}
}else{
	echo 3;//NO SE PUEDE ELIMINAR ESTA QUEJA YA QUE TIENE UN SEGUIMIENTO ALMACENADO
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>
