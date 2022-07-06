<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$id = $_POST['id']; //TRANSITO ENVIADA
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//OBTENER EXPEDIENTE DE TRANSITO ENVIADA
$query_transito = "SELECT expediente, colaborador_id, servicio_id, fecha
   FROM transito_enviada
   WHERE transito_id = '$id'";
$result = $mysqli->query($query_transito);
$consulta_transito = $result->fetch_assoc();
$expediente = $consulta_transito['expediente']; 
$colaborador_id = $consulta_transito['colaborador_id']; 
$servicio_id = $consulta_transito['servicio_id']; 
$fecha = $consulta_transito['fecha'];    

//OBTENER PACIENTE_ID
$query_paciente = "SELECT pacientes_id, CONCAT(apellido,' ',nombre) AS 'paciente'
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc();
$pacientes_id = $consulta_paciente['pacientes_id'];  
$nombre_paciente = $consulta_paciente['paciente']; 

//ELIMINAMOS EL REGISTRO
   $delete = "DELETE FROM transito_enviada 
      WHERE transito_id = '$id'";
   $dato = $mysqli->query($delete);
   
if($dato){
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Eliminar";
   $observacion_historial = "Se ha eliminado el transito enviado para este usuario: $nombre_paciente con expediente n° $expediente";
   $modulo = "transito_enviada";
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