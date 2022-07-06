<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$agenda_id = $_POST['agenda_id'];
$comentario = $_POST['comentario'];

date_default_timezone_set('America/Tegucigalpa');

//CONSULTAR DATOS DEL PACIENTE EN LA ENTIDAD AGENDA
$consulta_usuario = "SELECT CAST(fecha_cita AS DATE) AS 'fecha' ,pacientes_id, expediente, colaborador_id, servicio_id 
    FROM agenda 
	WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consulta_usuario);
$consulta_usuario1 = $result->fetch_assoc();
$expediente = $consulta_usuario1['expediente'];
$colaborador_id = $consulta_usuario1['colaborador_id'];
$servicio_id = $consulta_usuario1['servicio_id'];
$pacientes_id = $consulta_usuario1['pacientes_id'];
$fecha = $consulta_usuario1['fecha'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAMOS DATOS EN LA ENTIDAD PRECLINICA
$consulta = "SELECT preclinica_id 
   FROM preclinica 
   WHERE expediente = '$expediente' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta);   
   
$consulta1 = $result->fetch_assoc();
$preclinica_id = $consulta1['preclinica_id'];

//OBTENER PACIENTE_ID
$query_paciente = "SELECT pacientes_id, CONCAT(apellido,' ',nombre) AS 'paciente'
    FROM pacientes
    WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc(); 
$nombre_paciente = $consulta_paciente['paciente']; 

//OBTENER EL NUMERO DE LA LISTA DE ESPERA
   $query_referencia = "SELECT id
       FROM lista_espera
	   WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio = '$servicio_id'";
   $result = $mysqli->query($query_referencia);	   
   $consulta_lista_espera = $result->fetch_assoc();
   $lista_espera_id = $consulta_lista_espera['id'];
   
if($preclinica_id == ""){
	//ELIMINAMOS LOS DATOS DE LA AGENDA DE USUARIOS
	$delete = "DELETE FROM agenda 
	   WHERE agenda_id = '$agenda_id'";
	$dato = $mysqli->query($delete);
	
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado_historial = "Eliminar";
    $observacion_historial = "Se ha eliminado la agenda para este usuario: $nombre_paciente con expediente n° $expediente. Comentario: $comentario";
    $modulo = "Agenda";
    $insert = "INSERT INTO historial 
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
    $mysqli->query($insert);
    /*****************************************************/	

    //VERIFICAMOS SI EXISTE EL USUARIO PRIORIZADO
    $query_registro_priorizado = "SELECT priorizado_id
    FROM priorizado
    WHERE agenda_id = '$agenda_id'";
    $result_priorizado = $mysqli->query($query_registro_priorizado);
    
    if($result_priorizado->num_rows>0){
        $delete = "DELETE FROM priorizado WHERE agenda_id = '$agenda_id'";
        $mysqli->query($delete);
    }

	//CONSULTAMOS SI EL REGISTRO ESTA ALMACENADO EN LA LISTA DE ESPERA
	$consulta_espera = "SELECT id
	    FROM lista_espera
		WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio = '$servicio_id'";
    $result = $mysqli->query($consulta_espera);		
									
    $consulta_espera1 = $result->fetch_assoc();
    $espera_id = $consulta_espera1['id'];

}		
/*	if($espera_id != ""){
	    //ELIMINAMOS LOS DATOS DE LA LISTA DE ESPERA
	    $delete = "DELETE FROM lista_espera 
		    WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio = '$servicio_id'";
        $dato = $mysqli->query($delete);

        if($dato){
            //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
            $historial_numero = historial();
            $estado_historial = "Eliminar";
            $observacion_historial = "Se ha eliminado de la lista de espera el siguiente usuario: $nombre_paciente con expediente n° $expediente";
            $modulo = "Lista Espera";
            $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
            $mysqli->query($insert);
            /*****************************************************/					
		
	/*}*/
		
if($dato){
  echo 1;
}else{
  echo 2;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>