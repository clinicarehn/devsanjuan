<?php
session_start();
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT *
              FROM vehiculo";
$result = $mysqli->query($consulta);			  

if($result->num_rows>0){
	echo '<option value="">Vehículo</option>';
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['vehiculo_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>


               
			   
               