<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

//CAMBIAR EL NUMERO QUE SE GUARDA EN EL MOTIVO DE REFERENCIA EL CUAL DEBE SER EL NOMBRE DEL MOTIVO NO EL NUMERO
$fechai = '2019-04-01';
$fechaf = '2019-04-30';

//REFERENCIA RECIBIDA
$consulta = "SELECT referenciar_id, motivo_referencia 
      FROM referencia_recibida
      WHERE fecha BETWEEN '$fechai' AND '$fechaf'";
$result = $mysqli->query($consulta);	  
	  
while($consulta2 = $result->fetch_assoc()){
	$motivo_referencia_recibida_id = $consulta2['motivo_referencia'];
    $referenciar_id = $consulta2['referenciar_id'];

   if(is_numeric($motivo_referencia_recibida_id)){
       $consulta_motivo_ref_recibida = "SELECT nombre 
	      FROM motivo_traslado 
		  WHERE motivo_traslado_id = '$motivo_referencia_recibida_id'";
       $result_motivo_ref_recibida = $mysqli->query($consulta_motivo_ref_recibida);	   
       $consulta_motivo_ref_recibida1 = $result_motivo_ref_recibida->fetch_assoc();
       $motivo_referencia_recibida = $consulta_motivo_ref_recibida1['nombre'];	

       $update = "UPDATE referencia_recibida SET motivo_referencia = '$motivo_referencia_recibida'
	        WHERE referenciar_id = '$referenciar_id'";
       $mysqli->query($update);			
   }	
}

//REFERENCIA ENVIADA
$consulta_re = "SELECT referenciar_id, motivo_referencia 
      FROM referencia_enviada
      WHERE fecha BETWEEN '$fechai' AND '$fechaf'";
$result = $mysqli->query($consulta_re);	  
	  
while($consulta_re2 = $result->fetch_assoc()){
	$motivo_referencia_enviada_id = $consulta_re2['motivo_referencia'];
    $referenciar_id = $consulta_re2['referenciar_id'];

   if(is_numeric($motivo_referencia_enviada_id)){
       $consulta_motivo_ref_enviada = "SELECT nombre 
	       FROM motivo_traslado 
		   WHERE motivo_traslado_id = '$motivo_referencia_enviada_id'";	
	   $result_motivo_ref_enviada = $mysqli->query($query);
       $consulta_motivo_ref_enviada1 = $result_motivo_ref_enviada->fetch_assoc();
       $motivo_referencia_enviada = $consulta_motivo_ref_enviada1['nombre'];	

       $update = "UPDATE referencia_enviada SET motivo_referencia = '$motivo_referencia_enviada'
	        WHERE referenciar_id = '$referenciar_id'";	
       $mysqli->query($update);				
   }	
} 

$result->free();//LIMPIAR RESULTADO
$result_motivo_ref_recibida->free();//LIMPIAR RESULTADO
$result_motivo_ref_enviada->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>