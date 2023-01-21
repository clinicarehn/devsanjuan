<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$nivel = $_POST['nivel'];

$query = "SELECT * 
   FROM niveles_grupos
   WHERE niveles_centros_id = '$nivel'";
$result = $mysqli->query($query);

if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['niveles_grupo_id'].'">'.$consulta2['nombre'].'</option>';
	}	
}
?>