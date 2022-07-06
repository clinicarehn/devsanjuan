<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro_info_respuesta'];
$referencia_id = $_POST['referencia_info_respuesta'];
$expediente_valor = $_POST['expediente_info_respuesta'];
$fecha = $_POST['fecha_info_respuesta'];
$correo = $_POST['correo_info_respuesta'];
$telefono = $_POST['telefono_info_respuesta'];
$colaborador_id = $_POST['colaborador_id_info_respuesta'];
$servicio_id = $_POST['servicio_id_info_respuesta'];
$observacion = cleanStringStrtolower($_POST['observacion_info_respuesta']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAMOS EL EXPEDIENTE DEL USUARIO EN LA ENTIDAD PACIENTE
$consultar_expediente = "SELECT expediente, pacientes_id
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

//RESPUESTA A CONFIRMACION
if(isset($_POST['respuesta_info_respuesta'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['respuesta_info_respuesta'] == ""){
		$respuesta = 0;
	}else{
	    $respuesta = $_POST['respuesta_info_respuesta'];		
	}
}else{
	$respuesta = 0;
}

//CONSULTAR EXISTENCIA DE REGISTRO
$consultar_existencia = "SELECT respuesta_re_id 
      FROM respuesta_re 
	  WHERE expediente = '$expediente' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consultar_existencia);	  
	  	  	  
$consultar_existencia2 = $result->fetch_assoc();
$consulta_existencia_respuesta_referencia = $consultar_existencia2['respuesta_re_id'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(respuesta_re_id) AS max, COUNT(respuesta_re_id) AS count 
    FROM respuesta_re";
$result = $mysqli->query($correlativo);	
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

if ($proceso = 'Registro'){
  if($consulta_existencia_respuesta_referencia == ""){
	  if($referencia_id != 0 && $expediente != 0 && $colaborador_id != 0 && $servicio_id != 0 && $usuario != 0){	 
		  $insert = "INSERT INTO respuesta_re 
		     VALUES ('$numero','$referencia_id','$expediente','$colaborador_id','$servicio_id','$fecha', '$fecha_registro', '$correo','$telefono','$observacion','$respuesta','$usuario')";
		  $query = $mysqli->query($insert);
		  
          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
          $historial_numero = historial();
          $estado = "Agregar";
          $observacion = "Se ha agregado una respuesta a la referencia recibida";
          $modulo = "Respuesta Referencia Recibida";
          $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$referencia_id','$colaborador_id','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
          $mysqli->query($insert);
          /*****************************************************/		  
		  
		  if($respuesta == 1){
			  $update = "UPDATE referencia_enviada SET respuesta_recibida = 'Si' 
			      WHERE referenciar_id = '$referencia_id'";
			  $mysqli->query($update);
			  
             //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
             $historial_numero = historial();
             $estado = "Actualizar";
             $observacion = "Se ha cambiado el estado de la respuesta recibida en la entidad referencias recibidas";
             $modulo = "Referencia Enviada";
             $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$referencia_id','$colaborador_id','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
             /*****************************************************/				  
	      }
	  
	  if($query){
		  echo 1; //REGISTRO ALMACENADO CON EXITO
	  }else{
		  echo 2;//ERROR ALMACENANDO EL REGISTRO
	  }
    }else{
	   echo 3; //ERROR EN ALMACENAR EL REGISTRO, O HAY CAMPOS EN BLANCO
    }
  }else{
	  echo 4;//REGISTRO YA EXISTE
  }
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>