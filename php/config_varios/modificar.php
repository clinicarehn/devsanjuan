<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$entidad = $_POST['consulta_registro'];
$nombre = cleanStringStrtolower($_POST['nombre_registro']);
$id = $_POST['id_registro'];
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

//ACTUALIZAMOS EL REGISTRO
$update = "UPDATE ".$entidad." SET nombre = '$nombre' 
   WHERE ".$entidad."_id = '$id'";
$query = $mysqli->query($update);

if($query){
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL 
   $historial_numero = historial($db);
   $estado_historial = "Actualizar";
   $observacion_historial = "Se ha modificado el registro $nombre en la entidad $entidad con código $id";
   $modulo = cleanStringStrtolower($entidad);
   $insert = "INSERT INTO historial 
      VALUES('$historial_numero','0','0','$modulo','$id','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
   $mysqli->query($insert);	 
   /********************************************/ 	
	   
   echo 1;
}else{
   echo 2;
}

$mysqli->close();//CERRAR CONEXIÓN
?>