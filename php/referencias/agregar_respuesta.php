<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$id_registro = $_POST['id'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

$update = "UPDATE referencia_enviada SET respuesta_recibida = 'Si' 
    WHERE referenciar_id = '$id_registro'";
$dato = $mysqli->query($update);

//CONSULTAR DATOS DE LA REFERENCIA ENVIADA
$query_referencias = "SELECT expediente, servicio_id, colaborador_id, fecha
   FROM referencia_enviada
   WHERE referenciar_id = 'id_registro'";
$result = $mysqli->query($query_referencias);
$consulta_referencia = $result->fetch_assoc();
$expediente = $consulta_referencia['expediente'];
$servicio_id = $consulta_referencia['servicio_id'];
$colaborador_id = $consulta_referencia['colaborador_id'];
$fecha = $consulta_referencia['fecha'];

//CONSULTA PACIENTES_ID
$query_pacientes = "SELECT pacientes_id
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($query_pacientes);
$consulta_pacientes = $result->fetch_assoc();
$pacientes_id = $consulta_referencia['pacientes_id'];   
 
//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado = "Actualizar";
$observacion = "Se ha cambiado el estado de la respuesta recibida en la entidad referencias enviadas";
$modulo = "Referencia Enviada";
$insert = "INSERT INTO historial 
   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$id_registro','$colaborador_id','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
$mysqli->query($insert);
/*****************************************************/	

if($dato){
	echo 1;
}else{
	echo 2;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>