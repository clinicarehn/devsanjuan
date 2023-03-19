<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 


date_default_timezone_set('America/Tegucigalpa');

$id = $_POST['id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT departamento_id, nombre
    FROM municipios 
	WHERE departamento_id = '$id' ORDER BY nombre";
$result = $mysqli->query($consulta);

if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';	
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['municipio_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>