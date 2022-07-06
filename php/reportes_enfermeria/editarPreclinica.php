<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT pre.preclinica_id AS 'preclinica', CONCAT(p.nombre,' ',p.apellido) AS 'nombre', p.expediente AS expediente, pre.fecha AS 'fecha', p.identidad AS 'identidad', pre.pa AS 'pa', pre.fr AS 'fr', pre.fc AS 'fc', pre.t AS 'temperatura', pre.peso AS 'peso', pre.talla AS 'talla', pre.observacion AS 'observacion'
      FROM preclinica AS pre
      INNER JOIN pacientes AS p
      ON pre.expediente = p.expediente
      WHERE pre.preclinica_id = '$id'";
$result = $mysqli->query($valores);	  

$valores2 = $result->fetch_assoc();
 
$datos = array(
				0 => $valores2['expediente'], 
				1 => $valores2['fecha'], 
 				2 => $valores2['identidad'], 
				3 => $valores2['nombre'],  	
				4 => $valores2['pa'], 
				5 => $valores2['fr'],
				6 => $valores2['fc'], 
				7 => $valores2['temperatura'],   
				8 => $valores2['peso'], 
				9 => $valores2['talla'], 
 				10 => $valores2['observacion'],   				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>