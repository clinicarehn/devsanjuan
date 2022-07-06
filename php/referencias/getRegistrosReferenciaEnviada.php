<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$referencia_id = $_POST['referencia_id'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT re.fecha AS 'fecha', p.expediente AS 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS nombre, re.centro AS 'centro'
     FROM referencia_enviada AS re
     INNER JOIN pacientes AS p
     ON re.expediente = p.expediente
     WHERE re.referenciar_id = '$referencia_id'";
$result = $mysqli->query($valores);	 

$valores2 = $result->fetch_assoc();

$datos = array(
				0 => $valores2['expediente'], 
				1 => $valores2['identidad'], 
 				2 => $valores2['nombre'],
                3 => $valores2['centro'],
                4 => $valores2['fecha'],				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>