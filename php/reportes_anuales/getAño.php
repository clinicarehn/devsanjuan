<?php
session_start();   
include('../funtions.php');

date_default_timezone_set('America/Tegucigalpa');

$año_anterior = 2016;
$año_actual = date('Y');

for($i = $año_anterior; $i<=$año_actual; $i++){
	echo '<option value='.$i.'>'.$i.'</option>';
}
?>