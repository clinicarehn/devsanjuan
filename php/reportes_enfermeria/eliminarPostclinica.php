<?php
session_start();   
include('../funtions.php');

date_default_timezone_set('America/Tegucigalpa');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$id = $_POST['id'];
$comentario_ = mb_convert_case(trim($_POST['comentario']), MB_CASE_TITLE, "UTF-8");
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

   //OBTENEMOS LOS DATOS
   $consulta = "SELECT expediente, colaborador_id, servicio_id, CAST(fecha AS DATE) AS 'fecha' 
       FROM postclinica 
	   WHERE postclinica_id = '$id'";
   $result = $mysqli->query($consulta);
   $consulta1 = $result->fetch_assoc();
   $expediente = $consulta1['expediente'];
   $colaborador_id = $consulta1['colaborador_id'];
   $servicio_id = $consulta1['servicio_id'];
   $fecha = $consulta1['fecha'];
   $fecha_registro = date("Y-m-d H:i:s");
   $usuario = $_SESSION['colaborador_id'];
   
   //VERIFICAMOS SI EXISTE ATENCIÓN DEL USUARIO EN EL ATA
   $consulta_ata = "SELECT ata_id 
        FROM ata 
		WHERE fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND expediente = '$expediente'";
   $result = $mysqli->query($consulta_ata);
   $consulta_ata1 = $result->fetch_assoc();
   $ata_id = $consulta_ata1['ata_id'];
   
   //CONSULTAR AGENDA_ID
   $query_agenda = "SELECT agenda_id
       FROM agenda
       WHERE CAST(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND expediente = '$expediente'";
   $result = $mysqli->query($query_agenda);	   
   $consulta_agenda = $result->fetch_assoc();
   $agenda_id = $consulta_agenda['agenda_id']; 
   
   //OBTENER PACIENTE_ID
   $query_paciente = "SELECT pacientes_id, CONCAT(apellido,' ',nombre) AS 'paciente'
      FROM pacientes
      WHERE expediente = '$expediente'";
   $result = $mysqli->query($query_paciente);
   $consulta_paciente = $result->fetch_assoc();
   $pacientes_id = $consulta_paciente['pacientes_id'];  
   $nombre_paciente = $consulta_paciente['paciente'];   

   if($ata_id == ""){   
      //ACTUALIZAMOS LA AGENDA
      $update = "UPDATE agenda SET postclinica = 1 
	      WHERE CAST(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND expediente = '$expediente'";
	  $mysqli->query($update);
	  
      //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
      $historial_numero = historial();
      $estado_historial = "Actualizar";
      $observacion_historial = "Se ha actualizado el campo postclinica en la agenda para este usuario: $nombre_paciente con expediente n° $expediente";
      $modulo = "Agenda";
      $insert = "INSERT INTO historial 
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
      $mysqli->query($insert);
      /*****************************************************/	  

     //ELIMINAMOS EL REGISTRO	
     $delete = "DELETE FROM postclinica
   	    WHERE postclinica_id = '$id'";
     $dato = $mysqli->query($delete);

      //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
      $historial_numero = historial();
      $estado_historial = "Eliminar";
      $observacion_historial = "Se ha actualizado el campo postclinica en la agenda para este usuario: $nombre_paciente con expediente n° $expediente";
      $modulo = "Postclinica";
      $insert = "INSERT INTO historial 
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
      $mysqli->query($insert);
      /*****************************************************/	 

	 if($dato){
	   //ELIMINAMOS EL DETALLE DE LA POSTCLINICA	
	      $consulta_detalle = "SELECT id
		       FROM postclinica_detalle
			   WHERE postclinica_id = '$id'";
		   $result_postclinica = $mysqli->query($consulta_detalle);
		   
		   if($result_postclinica->num_rows > 0){
			   while($registro2 = $result_postclinica->fetch_assoc()){
			       $postclinica_detalle_id = $registro2['id'];
                   //ELIMINAMOS EL DETALLE DE LA POSTCLINICA
			       $delete = "DELETE FROM postclinica_detalle
			            WHERE id = '$postclinica_detalle_id'" ;
                   $mysqli->query($delete);	
				   				   
				   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                   $historial_numero = historial();
                   $estado_historial = "Eliminar";
                   $observacion_historial = "Se ha eliminado el detalle de la postclinica para este usuario: $nombre_paciente con expediente n° $expediente.con el comentario: $comentario_";
                   $modulo = "Postclinica Detalle";
                   $insert = "INSERT INTO historial 
                        VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$postclinica_detalle_id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                   $mysqli->query($insert);
                   /*****************************************************/				   
		       }   
		   }			  
 	   echo 1;
     }else{
	    echo 2;
     }
  }else{
	  echo 3;
  }	 
  
$result->free();//LIMPIAR RESULTADO
$result_postclinica->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN  
?>