<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$expediente_valor = $_POST['expediente'];

$consultar_expediente = "SELECT expediente, tipo
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 2";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$tipo = $consultar_expediente2['tipo'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT CONCAT(nombre,' ',apellido) AS 'nombre', identidad, tipo
     FROM pacientes
     WHERE expediente = '$expediente' OR identidad = '$expediente' AND tipo = 2";
$result = $mysqli->query($valores);	 

$valores2 = $result->fetch_assoc();
$fecha = date('Y-m-d');

if($tipo == 2){
if($result->num_rows>0){
	if($expediente != 0){
	   $datos = array(
	        0 => 'Bien',
			1 => $valores2['nombre'],  	
            2 => $valores2['identidad'],						
	  );		
	}else{
	   $datos = array(
				0 => 'Error_Temporal', 
				1 => $fecha,																		
	  );			
	}
}else{
	$datos = array(
				0 => 'Error', 
				1 => $fecha,																		
	);	
}
}
else{
	   $datos = array(
				0 => 'Familiar', 
				1 => '', 
 				2 => '',
	    );		
} 				
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>