<?php
session_start();
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$clasificacion_diagnostica_id = $_POST['clasificacion_diagnostica_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT *
			 FROM tipologia
			 WHERE clasificacion_diagnostica_id = '$clasificacion_diagnostica_id'";		 
$result = $mysqli->query($consulta);			  

if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['tipologia_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>          