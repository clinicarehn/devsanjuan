<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();
include('../conexion-postgresql.php');
date_default_timezone_set('America/Tegucigalpa');

$profesional = cleanStringStrtolower($_POST['profesionales_buscar']);
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];
$fecha = date('Y-m-d');

//OBTENER CORRELATIVO PACIENTES
$correlativo= "SELECT DISTINCT MAX(profesion_id) AS max, COUNT(profesion_id) AS count 
    FROM profesion";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

$consultar = "SELECT profesion_id 
     FROM profesion 
	 WHERE nombre = '$profesional'";
$result = $mysqli->query($consultar);
$consultar2 = $result->fetch_assoc();
$profesional_id = $consultar2['profesion_id'];

if($profesional != ""){
  if($profesional_id == ""){
	 $insert = "INSERT INTO profesion VALUES('$numero', '$profesional', '$fecha','$usuario')";
	 $query = $mysqli->query($insert);
	 if($query){
          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		  $historial_numero = historial();
		  $estado = "Agregar";
		  $observacion_historial = "Se ha agregado una nueva profesión: $profesional";
		  $modulo_historial = "Profesional";
		  $insert = "INSERT INTO historial 
		      VALUES('$historial_numero','$numero','0','$modulo_historial','0','0','0','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";
		  $mysqli->query($insert);
		  /*****************************************************/
		
		 echo 1;//EL REGISTRO SE HA GUARDARDADO CORRECTAMENTE
	 }else{
		 echo 2;//NO SE PUEDO GUARDAR EL REGISTRO
	 }
  }else{
	  echo 4;//ESTE REGISTRO YA EXISTE
  }
}else{
  echo 3;//EXISTEN CAMPOS VACIOS NO SE PUEDE PROCEDER
}
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>