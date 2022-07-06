<?php
include('../funtions.php');
session_start(); 
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
$tipo = $consultar_expediente2['tipo'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT CONCAT(nombre,' ',apellido) AS 'nombre', identidad, sexo, departamento_id, municipio_id, pacientes_id, telefono
     FROM pacientes
     WHERE expediente = '$expediente'";
$result = $mysqli->query($valores);	 

$valores2 = $result->fetch_assoc();
$fecha = date('Y-m-d');

if($tipo == 1){
if($result->num_rows>0){	
	if($valores2['departamento_id'] == ""){
		$departamento = 0;
	}else{
		$departamento = $valores2['departamento_id'];
	}
	
	if($valores2['municipio_id'] == ""){
		$municipio = 0;
	}else{
		$municipio = $valores2['municipio_id'];
	}
	
	if($valores2['identidad'] == ""){
		$identidad = 0;
	}else{
		$identidad = $valores2['identidad'];
	}
	
	if($valores2['telefono'] == ""){
		$telefono = 0;
	}else{
		$telefono = $valores2['telefono'];
	}
	
	if($departamento == 0 || $municipio == 0 || $identidad == 0 || $telefono == 0){
	   $datos = array(
				0 => 'Actualizar', 
				1 => '',  
				2 => '', 
                3 => '', 				
	   );			
	}else{
	   $datos = array(
				0 => $valores2['identidad'],  	
                1 => $valores2['nombre'],
                2 => $valores2['sexo'],	
                3 => $valores2['pacientes_id'],					
	   );		
	}
}else{
	$datos = array(
				0 => 'Error', 
				1 => '',  
				2 => '', 
                3 => '', 				
	);	
}
}else{
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