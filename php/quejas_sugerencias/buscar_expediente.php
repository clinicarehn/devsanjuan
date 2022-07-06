<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$expediente_valor = $_POST['expediente'];

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT CONCAT(nombre,' ',apellido) AS 'nombre', identidad
    FROM pacientes 
	WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($valores);	 
$valores2 = $result->fetch_assoc();

$nombre = "";
if($result->num_rows>0){
	$nombre = $valores2['nombre'];
	$identidad = $valores2['identidad'];
}

$datos = array(
	0 => $nombre, 
	1 => $identidad, 
);		
				
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>