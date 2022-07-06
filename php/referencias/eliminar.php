<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$id = $_POST['id'];
$usuario = $_SESSION['colaborador_id'];
$fecha = date("Y-m-d");
$fecha_registro = date("Y-m-d H:i:s");

//ELIMINAMOS EL REGISTRO
$consulta_centros = "SELECT COUNT(referenciar_id) AS 'referenciar_id' 
    FROM referencia_recibida 
	WHERE unidad_envia = '$id'";
$result = $mysqli->query($consulta_centros);
$consulta_centros2 = $result->fetch_assoc();
$total = $consulta_centros2['referenciar_id'];

//CONSULTAR NOMBRE DE CENTRO Hospitalarios
$query = "SELECT centro_nombre
   FROM centros_hospitalarios
   WHERE centros_id = '$id'";
$result = $mysqli->query($query);
$consulta_centro = $result->fetch_assoc();  
$nombre_centro = $consulta_centro['centro_nombre'];

if($total == 0){
   $delete = "DELETE FROM centros_hospitalarios 
      WHERE centros_id = '$id'";
   $dato = $mysqli->query($delete); 
   
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado = "Eliminar";
   $observacion = "Se ha eliminado el siguiente Centro Hospitalario: $nombre_centro";
   $modulo = "Centros Hospitalarios";
   $insert = "INSERT INTO historial 
      VALUES('$historial_numero','0','0','$modulo','$id','0','0','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
   $mysqli->query($insert);
   /*****************************************************/	 
   
   if($dato){
	   echo 1;//ELIMINADO CON EXITO
   }else{
	   echo 2;//ERROR AL ELIMINAR EL REGISTRO
   }   	
}else{
	echo 3;//EXISTEN DATOS ALMACENADOS NO SE PUEDE CONTINUAR
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>