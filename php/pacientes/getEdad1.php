<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$expediente_valor = $_POST['expediente'];

$consultar_expediente = "SELECT expediente, tipo 
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];

$query = "SELECT fecha_nacimiento 
    FROM pacientes 
	WHERE expediente = '$expediente'";
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