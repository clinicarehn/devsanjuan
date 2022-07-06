<?php
session_start();
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT problema_social_id, nombre 
   FROM problema_social
   ORDER BY nombre";
$result = $mysqli->query($consulta);

if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';	
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['problema_social_id'].'">'.$consulta2['nombre'].'</option>';
	}	
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>