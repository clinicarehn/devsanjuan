<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT entrevista_intervencion_id , nombre 
    FROM entrevista_intervencion";
$result = $mysqli->query($consulta);	

if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['entrevista_intervencion_id'].'">'.$consulta2['nombre'].'</option>';
	}
}


$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>