<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['id']; //ATA_ID
$comentario = $_POST['comentario'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR DATOS DEL PACIENTE
//CONSULTAMOS DATOS DE LA TABLA AUSENCIA
$consulta = "SELECT colaborador_id, servicio_id, fecha, expediente 
    FROM ata 
	WHERE ata_id = '$id'";
$result = $mysqli->query($consulta);
$consulta1 = $result->fetch_assoc();
$colaborador_id = $consulta1['colaborador_id'];
$servicio_id = $consulta1['servicio_id'];
$expediente = $consulta1['expediente'];
$fecha = $consulta1['fecha'];

//OBTENER PACIENTE_ID
$query_paciente = "SELECT pacientes_id, CONCAT(apellido,' ',nombre) AS 'paciente'
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc();
$pacientes_id = $consulta_paciente['pacientes_id'];  
$nombre_paciente = $consulta_paciente['paciente']; 

//OBTENER CODIGO REFERENCIAS RECIBIDAS
$query_paciente = "SELECT pacientes_id, CONCAT(apellido,' ',nombre) AS 'paciente'
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc();
$pacientes_id = $consulta_paciente['pacientes_id'];  
$nombre_paciente = $consulta_paciente['paciente']; 

//CONSULTAR AGENDA_ID
$query_agenda = "SELECT agenda_id
   FROM agenda
   WHERE CAST(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND expediente = '$expediente'";
$result = $mysqli->query($query_agenda);	   
$consulta_agenda = $result->fetch_assoc();
$agenda_id = $consulta_agenda['agenda_id']; 

date_default_timezone_set('America/Tegucigalpa');

//CONSULTAR EXISTENCIA DE USUSARIO EN LA PRECLINICA
$query_preclinica = "SELECT preclinica_id
   FROM preclinica
   WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
$result = $mysqli->query($query_preclinica);
$consulta_preclinica = $result->fetch_assoc();
$preclinica_id = $consulta_preclinica['preclinica_id']; 

//if($preclinica_id == ""){
 //ACTUALIZAMOS LA AGENDA DEL USUARIO
$update = "UPDATE agenda SET status = 0 
   WHERE CAST(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND expediente = '$expediente'";
$mysqli->query($update);

//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado_historial = "Actualizar";
$observacion_historial = "Se actualiza el estado de la atencion de este registro en agenda, dejando su atención en pendiente para el usuario: $nombre_paciente con expediente n° $expediente. Comentario: $comentario";
$modulo = "Agenda";
$insert = "INSERT INTO historial 
	VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
$mysqli->query($insert);
/*****************************************************/	 	

//REVISAMOS SI EXISTEN REFERENCIAS DE ESE USUARIO PARA ESA FECHA DE EXISTIR SE ELIMINAN
//REFERENCIAS ENVIADAS

//OBTENER EL NUMERO DE LA REFERENCIA ENVIADA
$query_referencia = "SELECT referenciar_id
   FROM referencia_enviada
   WHERE ata_id = '$id'";
$result = $mysqli->query($query_referencia);	   
$consulta_agenda = $result->fetch_assoc();
$referenciar_id_enviada = $consulta_agenda['referenciar_id']; 
   
$delete = "DELETE FROM referencia_enviada 
	WHERE ata_id = '$id' AND fecha = '$fecha'";
$query_referencia_enviada = $mysqli->query($delete);

if($query_referencia_enviada){
	//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
	$historial_numero = historial();
	$estado_historial = "Eliminar";
	$observacion_historial = "Se ha eliminado la referencia enviada para este usuario: $nombre_paciente con expediente n° $expediente";
	$modulo = "Referencia Enviada";
	$insert = "INSERT INTO historial 
		VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$referenciar_id_enviada','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
	$mysqli->query($insert);
   /*****************************************************/	   	   
}

//OBTENER EL NUMERO DE LA REFERENCIA RECIBIDA
$query_referencia = "SELECT referenciar_id
	FROM referencia_recibida
	WHERE ata_id = '$id'";
$result = $mysqli->query($query_referencia);	   
$consulta_agenda = $result->fetch_assoc();
$referenciar_id_recibidda = $consulta_agenda['referenciar_id'];

//REFERENCIAS RECIBIDAS
$delete = "DELETE FROM referencia_recibida 
	  WHERE ata_id = '$id' AND fecha = '$fecha'";
$query_referencia_recibida = $mysqli->query($delete);

if($query_referencia_recibida){
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Eliminar";
   $observacion_historial = "Se ha eliminado la referencia recibida para este usuario: $nombre_paciente con expediente n° $expediente";
   $modulo = "Referencia Recibida";
   $insert = "INSERT INTO historial 
	  VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$referenciar_id_recibidda','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
  $mysqli->query($insert);
  /*****************************************************/	 
}

//OBTENER EL NUMERO DE LA DE TRANSITO ENVIADA
$query_referencia = "SELECT transito_id
   FROM transito_enviada
   WHERE ata_id = $id";
$result = $mysqli->query($query_referencia);	   
$consulta_agenda = $result->fetch_assoc();
$transito_id_enviada = $consulta_agenda['transito_id'];

//TRANSITO ENVIADAS
$delete = "DELETE FROM transito_enviada 
   WHERE ata_id = '$id' AND fecha = '$fecha'";
$query_transito_enviada = $mysqli->query($delete);	

if($query_transito_enviada){
 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
 $historial_numero = historial();
 $estado_historial = "Eliminar";
 $observacion_historial = "Se ha eliminado la transito enviada para este usuario: $nombre_paciente con expediente n° $expediente";
 $modulo = "Transito Enviada";
 $insert = "INSERT INTO historial 
	 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$transito_id_enviada','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
 $mysqli->query($insert);
 /*****************************************************/	
}

//OBTENER EL NUMERO DE LA DE TRANSITO RECIBIDA
$query_referencia = "SELECT transito_id
   FROM transito_recibida
   WHERE ata_id = '$id'";
$result = $mysqli->query($query_referencia);	   
$consulta_agenda = $result->fetch_assoc();
$transito_id_recibida = $consulta_agenda['transito_id'];

//TRANSITO RECIBIDA
$delete = "DELETE FROM transito_recibida 
   WHERE ata_id = '$id' AND fecha = '$fecha'";
$query_transito_recibida = $mysqli->query($delete);

if($query_transito_recibida){
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Eliminar";
   $observacion_historial = "Se ha eliminado la transito recibida para este usuario: $nombre_paciente con expediente n° $expediente";
   $modulo = "Transito Recibida";
   $insert = "INSERT INTO historial 
	   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$transito_id_recibida','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
   $mysqli->query($insert);
   /*****************************************************/		   
 }	
 
 //ELIMINAMOS EL REGISTRO
 $delete = "DELETE FROM ata 
 WHERE ata_id = '$id' AND fecha = '$fecha'";
 $dato = $mysqli->query($delete); 

 if($dato){
	echo 1;//REGISTRO ELIMINADO CORRECTAMENTE
 }else{
	echo 2;//NO SE PUEDO ELIMINAR EL REGISTRO
 } 	 
/*}else{
	echo 3;//REGISTRO CUENTA CON PRECLINICA ALMACENADA NO SE PUEDE PROCEDER CON LA ELIMINACION
}*/
   
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN   
?>