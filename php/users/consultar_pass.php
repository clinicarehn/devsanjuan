<?php
session_start();   
header('Content-Type: text/html; charset=utf-8');
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$contraseña_anterior = $_POST['contranaterior'];
$id = $_POST['id'];

date_default_timezone_set('America/Tegucigalpa');

$consultar = "SELECT * 
   FROM users 
   WHERE colaborador_id = '$id' AND password = MD5('$contraseña_anterior')";
$result = $mysqli->query($consultar);

if($result->num_rows==0){
	echo 0;
}else
	echo 1;
?>