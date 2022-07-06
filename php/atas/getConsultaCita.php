<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$agenda_id = $_POST['agenda_id'];

//CONSULTAR DATOS DE LA AGENDA DEL USUARIO
$puesto = getConsultaUnidadCita($db, $agenda_id);

echo $puesto;
?>