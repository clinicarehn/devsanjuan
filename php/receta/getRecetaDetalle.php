<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$receta_id = $_POST['receta_id'];

//CONSULTAR DETALLES DE LA RECETA
$query = "SELECT p.productos_id AS 'product_template_id', p.nombre AS 'producto', p.concentracion AS 'concentracion', p.unidad AS 'unidad', rd.via AS 'via', rd.cantidad AS 'cantidad', rd.manana AS 'manana', rd.mediodia AS 'mediodia', rd.tarde AS 'tarde', rd.noche AS 'noche'
FROM receta_detalle AS rd
INNER JOIN productos AS p
ON rd.productos_id = p.productos_id
WHERE receta_id = '$receta_id'";
$result_receta = $mysqli->query($query);

$arreglo = array();

while( $row = $result_receta->fetch_assoc()){
  $arreglo[] = $row;  
}	

echo json_encode($arreglo);
?>