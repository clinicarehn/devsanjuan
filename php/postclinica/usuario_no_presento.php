<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$agenda_id = $_POST['id'];
$fecha = date("Y-m-d");
$usuario_sistema = $_SESSION['colaborador_id'];
date_default_timezone_set('America/Tegucigalpa');

//CONSULTAR PACIENTES_ID DE LA ENTIDAD PACIENTES
$consultar = "SELECT expediente, pacientes_id, colaborador_id, servicio_id 
    FROM agenda 
	WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consultar);
$consultar2 = $result->fetch_assoc();
$pacientes_id = $consultar2['pacientes_id'];
$colaborador_id = $consultar2['colaborador_id'];
$servicio_id = $consultar2['servicio_id'];
$expediente = $consultar2['expediente'];
$fecha_registro = date("Y-m-d H:i:s");

//ACTUALIZAMOS EL STATUS DEL USUARIO
/*
1. USUARIO PENDIENTE DE ATENDER
2. USUARIO NO SE PRESENTO A SU CITA
*/
$update = "UPDATE agenda SET postclinica = 3 
   WHERE agenda_id = '$agenda_id'";
$query = $mysqli->query($update);

//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado = "Actualizar";
$modulo = "Postclinica";
$observacion = "Se ha actualizado el campo postclinica en la entidad agenda";
$insert = "INSERT INTO historial 
     VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado','$observacion','$usuario_sistema','$fecha_registro')";	 
$mysqli->query($insert);
/*****************************************************/	

if($query){
	echo 1;
}else{
	echo 2;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>