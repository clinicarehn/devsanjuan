<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 
 

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT tipos_atencion_id, nombre 
   FROM tipos_atencion
   ORDER BY nombre";
$result = $mysqli->query($consulta);

if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['tipos_atencion_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>