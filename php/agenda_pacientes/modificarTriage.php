<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$triage_id = $_POST['triage_id'];
$agenda_id = $_POST['agenda_id_triage'];
$colaborador_id = $_POST['colaborador_id_triage'];
$servicio_id = $_POST['servicio_id_triage'];
$tipoUsuario = $_POST['tipo_usuario'];

$expediente = $_POST['expediente_triage'];
$pacientes_id = $_POST['pacientes_id'];
$fecha = $_POST['fecha_triage'];

if(isset($_POST['atencion_triage'])){
   if($_POST['atencion_triage'] == ""){
       $atencion_triage = 0;
   }else{
	   $atencion_triage = $_POST['atencion_triage'];
   }
}

if(isset($_POST['respuesta_triage'])){
   if($_POST['respuesta_triage'] == ""){
       $respuesta_triage = 0;
   }else{
	   $respuesta_triage = $_POST['respuesta_triage'];
   }
}

if(isset($_POST['observacion_triage'])){
   if($_POST['observacion_triage'] == ""){
       $observacion_triage = 0;
   }else{
	   $observacion_triage = $_POST['observacion_triage'];
   }
}

if(isset($_POST['informacion_triage'])){
   if($_POST['informacion_triage'] == ""){
       $informacion_triage = 0;
   }else{
	   $informacion_triage = $_POST['informacion_triage'];
   }
}

if(isset($_POST['tipo_triage'])){
   if($_POST['tipo_triage'] == ""){
       $tipo_triage = 0;
   }else{
	   $tipo_triage = $_POST['tipo_triage'];//TIPO DE ATENCION
   }
}

if(isset($_POST['asistira_triage'])){
   if($_POST['asistira_triage'] == ""){
       $asistira_triage = 2;
   }else{
	   $asistira_triage = $_POST['asistira_triage'];//TIPO DE ATENCION
   }
}

$comentario = cleanStringStrtolower($_POST['comentario_triage']);
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//OBTENER CORRELATIVO ENTIDAD AGENDA
$correlativo_agenda= "SELECT MAX(triage_id ) AS max, COUNT(triage_id ) AS count 
  FROM triage";
$result = $mysqli->query($correlativo_agenda);
$correlativo_agenda2 = $result->fetch_assoc();

$numero = 0;
$cantidad = 0;

if($result->num_rows>0){
 $numero = $correlativo_agenda2['max'];
 $cantidad = $correlativo_agenda2['count'];
}

if ( $cantidad == 0 )
	$numero = 1;
else
	$numero = $numero + 1;
		

$update = "UPDATE triage SET atencion_id = '$atencion_triage', estado_atencion = '$respuesta_triage', observacion = '$observacion_triage', informacion = '$informacion_triage', tipo_id = '$tipo_triage', asistira_triage = '$asistira_triage', comentario = '$comentario'
   WHERE triage_id = '$triage_id'"; 
 
$sql = $mysqli->query($update);

if($sql){
	echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
	
	//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
	$historial_numero = historial();
	$estado = "Actualizar";
	$observacion_historial = "Se ha modificado el Triage para este registro";
	$modulo = "Agenda";
	$insert = "INSERT INTO historial 
		 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha_registro','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
	$mysqli->query($insert);	
}else{
	echo 2;//ERROR AL ALMACENAR ESTE REGISTRO
}
/*****************************************************/		

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>