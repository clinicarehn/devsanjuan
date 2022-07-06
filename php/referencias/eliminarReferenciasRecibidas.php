<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$ata_id = $_POST['ata_id'];
$expediente = $_POST['expediente'];
$referencia = $_POST['referencia'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAR DATOS DEL PACIENTE
$query = "SELECT pacientes_id
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query("$query");
$consulta_paciente = $result->fetch_assoc();
$pacientes_id = $consulta_paciente['pacientes_id']; 

//CONSULTAR VALORES EN LA REFERENCIA RECIBIDAS
$query_referencia = "SELECT servicio_id, colaborador_id, fecha
   FROM referencia_recibida
   WHERE referenciar_id = '$referencia'";
$result = $mysqli->query($query_referencia);
$consulta_referencia = $result->fetch_assoc();
$servicio_id = $consulta_referencia['servicio_id']; 
$colaborador_id = $consulta_referencia['colaborador_id']; 
$fecha = $consulta_referencia['fecha'];  

//CONSULTAR SI EXISTE EL REGISTRO EN EL ATA
if($ata_id != 0){
	$consultar_ata = "SELECT ata_id 
	    FROM ata 
		WHERE ata_id = '$ata_id'";
	$result = $mysqli->query($consultar_ata);
	$conteo = $result->num_rows;
	
	//SI ENCUENTRA REGISTROS EN LAS REFERENCIAS RECIBIDAS LIMPIAMOS LOS VALORES EN EL ATA
	if($conteo > 0){	
	    $update = "UPDATE ata SET recibidade = '', respuesta1 = '', respuesta2 = '', referencia_mayor = '', recibidade = '' 
		    WHERE ata_id = '$ata_id'";
		$dato_ata = $mysqli->query($update);
		
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado = "Actualizar";
        $observacion = "Se ha amodificado la información de la referencia recibida en el ATA del usuario, limpiando los valores";
        $modulo = "ATA";
        $insert = "INSERT INTO historial 
           VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$ata_id','$colaborador_id','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
        $mysqli->query($insert);
        /*****************************************************/		
	}
} 

//ELIMINAMOS EL REGISTRO
   $delete = "DELETE FROM referencia_recibida 
      WHERE referenciar_id = '$referencia'";
   $dato = $mysqli->query($delete);
   
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado = "Eliminar";
   $observacion = "Se ha eliminado la referencia recibida";
   $modulo = "Referencia Recibida";
   $insert = "INSERT INTO historial 
      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$referencia','$colaborador_id','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
   $mysqli->query($insert);
   /*****************************************************/	   
   
   if($dato){
	   echo 1;
   }else{
	   echo 2;
   }  
   
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN   
?>