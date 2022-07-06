<?php
session_start();   
include('../funtions.php');

date_default_timezone_set('America/Tegucigalpa');

	echo '<option value=0>Todo el año</option>';
	
for($i = 1; $i<=12; $i++){
	$mes = nombremes($i);
	echo '<option value='.$i.'>'.$mes.'</option>';
}
?>


               
			   
               