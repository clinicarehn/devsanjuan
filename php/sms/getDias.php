<?php
session_start();  
include('../funtions.php'); 

//CONEXION A DB
$mysqli = connect_mysqli();

$query = "SELECT dias
   FROM sms 
   GROUP BY dias";
$result = $mysqli->query($query);   
   
if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';
	while($consulta2 = $result->fetch_assoc()){
		if($consulta2['dias']==0){
			$dia_ = '';
			$dia = 'Envio manual';
		}else if($consulta2['dias']==1){
			$dia_ = 'Día';
			$dia = $consulta2['dias'];
		}else{
			$dia_ = 'Días';
			$dia = $consulta2['dias'];
		}
		
		echo '<option value="'.$consulta2['dias'].'">'.$dia.' '.$dia_.'</option>';
	}
}
?>