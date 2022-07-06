<?php
session_start();
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$vehiculo_id = $_POST['vehiculo_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT * 
      FROM combustible
      WHERE vehiculo_id = '$vehiculo_id'	  
	  ORDER BY combustible_id DESC LIMIT 1";
$result = $mysqli->query($consulta);	  
$consulta2 = $result->fetch_assoc();
$datos = "";
if($result->num_rows>0){
	$datos = array(
		0 => $consulta2['total_tanque'], 			
	);	
}

echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>


               
			   
               