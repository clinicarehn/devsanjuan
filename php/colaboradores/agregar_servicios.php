<?php
session_start();   
include('../funtions.php');
	
date_default_timezone_set('America/Tegucigalpa');
//CONEXION A DB
$mysqli = connect_mysqli(); 

$proceso = $_POST['pro'];
$id = $_POST['id-registro'];
$nombre = $_POST['servicios'];
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

$nombres = cleanStringStrtolower($nombre);
//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(servicio_id) AS max, COUNT(servicio_id) AS count 
   FROM servicios";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	
//VERIFICAMOS EL PROCESO
//CONSULTAMOS QUE EL REGISTRO EXISTA
$consulta = "SELECT servicio_id 
      FROM servicios 
	  WHERE nombre = '$nombre'";
$result = $mysqli->query($consulta);	  
$consulta2 = $result->fetch_assoc();
$consulta_nombre = $consulta2['servicio_id'];

if($consulta_nombre == ""){
	$insert = "INSERT INTO servicios 
	   VALUES('$numero', '$nombres')";
	$query = $mysqli->query($insert);
	
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Agregar";
   $observacion_historial = "Se ha agregado un nuevo servicio: $nombre";
   $modulo = "Servicios";
   $insert = "INSERT INTO historial 
       VALUES('$historial_numero','0','0','$modulo','$numero','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
   $mysqli->query($insert);	   
   /********************************************/		
	
	if($query){
		echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
	}else{
		echo 2;//NO SE PUEDO ALMACENAR EL REGISTRO
	}	
}else{
	echo 3;//ESTE REGISTRO YA EXISTE NO SE PUEDE ALMACENAR	
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>