<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT fecha_nacimiento 
   FROM pacientes 
   WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query);
$consulta_fecha1 = $result->fetch_assoc();
$fecha_nacimiento = $consulta_fecha1['fecha_nacimiento'];

//OBTENER LA EDAD DEL USUARIO 
/*********************************************************************************/
$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/  

$array = array(0 => $anos,
    		   1 => $meses,
			   2 => $dias);			  			  
			   
echo json_encode($array);	

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN		   
?>