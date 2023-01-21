<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
 
date_default_timezone_set('America/Tegucigalpa');

$nivel = $_POST['nivel'];
$centro_id = $_POST['centro'];

$consulta = "SELECT centros_id, centro_nombre 
    FROM centros_hospitalarios 
	WHERE niveles_centros_id = '$nivel' AND niveles_grupo_id = '$centro_id'";
$result = $mysqli->query($consulta);

if($result->num_rows>0){	
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['centros_id'].'">'.$consulta2['centro_nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>