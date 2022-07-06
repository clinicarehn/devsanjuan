<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['id']; //EXTEMPORANEOS
$comentario = $_POST['comentario'];
date_default_timezone_set('America/Tegucigalpa');

//CONSULTAMOS DATOS EN LA ENTIDAD EXTEPORANEOS
$consulta = "SELECT fecha, expediente, colaborador_id, servicio_id, pacientes_id
    FROM extemporaneos 
	WHERE extem_id = '$id'";
$result = $mysqli->query($consulta);
$consulta1 = $result->fetch_assoc();
$fecha = $consulta1['fecha'];
$expediente = $consulta1['expediente'];
$colaborador_id = $consulta1['colaborador_id'];
$servicio_id = $consulta1['servicio_id'];
$pacientes_id = $consulta1['pacientes_id'];  
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAMOS LA EXISTENCIA EN LAS ATENCIONES DEL USUARIO (ATA)
$consulta_ata = "SELECT ata_id 
    FROM ata 
	WHERE expediente = '$expediente' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_ata);
$consulta_ata1 = $result->num_rows;
$ata_id = $consulta_ata1['ata_id'];

//OBTENER PACIENTE_ID
$query_paciente = "SELECT pacientes_id, CONCAT(apellido,' ',nombre) AS 'paciente'
    FROM pacientes
    WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc();
$nombre_paciente = $consulta_paciente['paciente']; 

//OBTENER EL NUMERO DE LA PRECLINICA
$query_preclinica = "SELECT preclinica_id
   FROM preclinica
   WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
$result = $mysqli->query($query_preclinica);
$consulta_preclinica = $result->fetch_assoc();
$preclinica_id = $consulta_preclinica['preclinica_id'];

if($ata_id == ""){  
	//ELIMINAMOS EL REGISTRO DE EXTEMPORANEOS
   $delete = "DELETE FROM extemporaneos 
      WHERE extem_id = '$id'";
   $dato = $mysqli->query($delete);   
   
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Eliminar";
   $observacion_historial = "Se ha eliminado este registro extemporaneos para este usuario: $nombre_paciente con expediente n° $expediente";
   $modulo = "Extemporaneo";
   $insert = "INSERT INTO historial 
      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
   $mysqli->query($insert);
   /*****************************************************/    
   
   //ELIMINAMOS LA PRECLINICA DEL USUARIO
   $delete = "DELETE FROM preclinica 
       WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
   $query_preclinica = $mysqli->query($delete);
   
   if($query_preclinica){
       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado_historial = "Eliminar";
       $observacion_historial = "Se ha eliminado la preclinica de este usuario: $nombre_paciente con expediente n° $expediente";
       $modulo = "Preclinica";
       $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$preclinica_id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/  	   
   }
   
   //OBTENER EL NUMERO DE LA AGENDA
   $query_agenda = "SELECT agenda_id
       FROM agenda
	   WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND CAST(fecha_cita AS DATE) = '$fecha'";
   $result = $mysqli->query($query_agenda);
   $consulta_agenda = $result->fetch_assoc();
   $agenda_id = $consulta_agenda['agenda_id'];
   
   //ELIMINAMOS EL REGISTRO DE LA AGENDA
   $delete = "DELETE FROM agenda 
      WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND CAST(fecha_cita AS DATE) = '$fecha'";
   $query_agenda = $mysqli->query($delete);   
   
   if($query_agenda){
       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado_historial = "Eliminar";
       $observacion_historial = "Se ha eliminado la agenda de este usuario extemporaneo: $nombre_paciente con expediente n° $expediente. Comentario: $comentario";
       $modulo = "Agenda";
       $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/  	   
   }
   
   if($dato){
     echo 1;
   }else{
     echo 2;
   }     
}else{
	echo 3;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>