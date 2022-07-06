<?php
header("Content-Type: text/html;charset=utf-8");
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');	

$html = '';
$key = $_POST['key'];

$query = 'SELECT * 
   FROM pacientes 
   WHERE apellido LIKE "%'.strip_tags($key).'%"
   GROUP BY apellido
   ORDER BY apellido 
   DESC LIMIT 0,5';
$result = $mysqli->query($query);

if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<div><a style="text-decoration:none;" class="suggest-element_lastname" data="'.utf8_encode($row['apellido']).'" id="product'.$row['pacientes_id'].'">'.utf8_encode($row['apellido']).'</a></div>';
    }
}
echo $html;
?>