<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$sala = $_POST['sala'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT cama_id, codigo 
   FROM camas 
   WHERE sala_id = '$sala' AND estado = 0 AND visible = 1 
   ORDER BY codigo";
$result = $mysqli->query($consulta);

if($result->num_rows>0){	
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['cama_id'].'">'.$consulta2['codigo'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>