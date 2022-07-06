<?php
date_default_timezone_set('America/Tegucigalpa');

$fecha = $_POST['fecha']; 
$hora = $_POST['hora']; 
$nueva_fecha = date("Y-m-d H:i:s", strtotime($fecha." ".$hora));
$fecha_cita_end = date('Y-m-d H:i:s', strtotime('+ 40 minute', strtotime($nueva_fecha)));

$datos = array(
	0 => $nueva_fecha, 
	1 => $fecha_cita_end,    				
);
				
echo json_encode($datos);				
?>