<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$referencia_id = $_POST['referencia_id'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT p.expediente AS 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS nombre, rr.centro AS 'centro'
     FROM referencia_recibida AS rr
     INNER JOIN pacientes AS p
     ON rr.expediente = p.expediente
     WHERE rr.referenciar_id = '$referencia_id'";
$result = $mysqli->query($valores);	 

$valores2 = $result->fetch_assoc();

$datos = array(
				0 => $valores2['expediente'], 
				1 => $valores2['identidad'], 
 				2 => $valores2['nombre'],
                3 => $valores2['centro'],				
				);
echo json_encode($datos);


$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>