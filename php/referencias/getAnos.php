<?php
date_default_timezone_set('America/Tegucigalpa');

$año = 2019;
$fecha_consulta = date('Y-m-d');

echo '<option value="">Seleccione</option>';	
while( $año <= $fecha_consulta){
   echo '<option value='.$año.'>'.$año.'</option>';
   $año++;
}
?>