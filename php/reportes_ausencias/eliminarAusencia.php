<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
$id = $_POST['id']; //AUCENCIA_ID
$comentario = $_POST['comentario'];
date_default_timezone_set('America/Tegucigalpa');

//CONSULTAMOS DATOS EN LA ENTIDAD AUSENCIA
$consulta = "SELECT agenda_id, servicio_id, expediente, fecha, colaborador_id
    FROM ausencias 
	WHERE ausencia_id = '$id'";
$result = $mysqli->query($consulta);
$consulta1 = $result->fetch_assoc();
$agenda_id = $consulta1['agenda_id'];
$servicio_id = $consulta1['servicio_id'];
$colaborador_id = $consulta1['colaborador_id'];
$expediente = $consulta1['expediente'];
$fecha = $consulta1['fecha'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//OBTENER PACIENTE_ID
$query_paciente = "SELECT pacientes_id, CONCAT(apellido,' ',nombre) AS 'paciente'
    FROM pacientes
    WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc();
$pacientes_id = $consulta_paciente['pacientes_id'];  
$nombre_paciente = $consulta_paciente['paciente']; 

//OBTENER EL CODIGO DE HOSPITALIZACION
$query_hospitalizacion = "SELECT hosp_id
   FROM hospitalizacion
   WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($query_hospitalizacion);
$consulta_hospitalizacion = $result->fetch_assoc();
$hosp_id = $consulta_hospitalizacion['hosp_id'];   

//OBTENER EL CODIGO DE HISTORIAL DE CAMAS
$query_hospitalizacion = "SELECT historial_id
   FROM historial_camas
   WHERE expediente = '$expediente' AND fecha > '$fecha' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($query_hospitalizacion);
$consulta_historial_hospitalizacion = $result->fetch_assoc();
$historial_id = $consulta_historial_hospitalizacion['historial_id'];   

//ACTUALIZAMOS LA AGENDA DEL USUARIO
$update = "UPDATE agenda SET status = 0, preclinica = 0 
     WHERE agenda_id = '$agenda_id'";
$mysqli->query($update);
   
//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado_historial = "Actualizar";
$observacion_historial = "Se ha actualizado el estado de la atencion y el estado de la preclinica en pedniente para este usuario: $nombre_paciente con expediente n° $expediente. Comentario: $comentario";
$modulo = "Agenda";
$insert = "INSERT INTO historial 
   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
 $mysqli->query($insert);
   /*****************************************************/    

//ELIMINAMOS EL REGISTRO
$delete = "DELETE FROM ausencias 
    WHERE ausencia_id = '$id'";
$dato = $mysqli->query($delete);

if($dato){
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Eliminar";
   $observacion_historial = "Se ha eliminado la ausencia para este este usuario: $nombre_paciente con expediente n° $expediente";
   $modulo = "Ausencia";
   $insert = "INSERT INTO historial 
      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
   $mysqli->query($insert);
   /*****************************************************/  	   
	   
   echo 1;
}else{
   echo 2;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN   
?>