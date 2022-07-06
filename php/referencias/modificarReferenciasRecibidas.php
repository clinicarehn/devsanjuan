<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];
$referencia = $_POST['referencia_id'];
$ata_id = $_POST['ata_id'];
$motivo = $_POST['motivo'];
$centros_nivel = $_POST['centros_nivel'];
$centro = $_POST['centro'];
$expediente = $_POST['expediente'];
$recibidade = $_POST['recibidade'];
$colaborador_id = $_SESSION['colaborador_id'];
$patologia = $_POST['patologia'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//OBTENER NOMBRE COLABORADOR
$consulta_colaborador = "SELECT CONCAT(nombre, ' ', apellido) AS 'nombre' 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_colaborador);
$consulta_colaborador2 = $result->fetch_assoc();
$colaborador_nombre = $consulta_colaborador2['nombre'];

//CONSULTAR PACIENTES_ID DE LA ENTIDAD PACIENTES_ID
$query_paciente = "SELECT pacientes_id
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc();
$pacientes_id = $consulta_paciente['pacientes_id'];  

//CONSULTAR DATOS DE LA ENTIDAD REFERENCIA
$query_referencia = "SELECT servicio_id, colaborador_id, fecha
   FROM referencia_recibida
   WHERE referenciar_id = '$referencia'";
$result = $mysqli->query($query_referencia);
$consulta_referencia = $result->fetch_assoc();
$servicio_id = $consulta_referencia['servicio_id']; 
$medico = $consulta_referencia['colaborador_id'];     
$fecha = $consulta_referencia['fecha']; 

if(isset($_POST['motivo1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['motivo1'] == ""){
	   $motivo = 0;
   }else{
	   $motivo = $_POST['motivo1'];
   }
}else{
	$motivo = 0;
}

//CONSULTAR MOTIVO REFERENCIA RECIBIDA
if($motivo != 0){
    $consulta_motivo_ref_recibida = "SELECT nombre 
	    FROM motivo_traslado 
		WHERE motivo_traslado_id = '$motivo'";	
	$result = $mysqli->query($consulta_motivo_ref_recibida);
    $consulta_motivo_ref_recibida1 = $result->fetch_assoc();
    $motivo_referencia_recibida = $consulta_motivo_ref_recibida1['nombre'];	
}

if(isset($_POST['motivo_otro1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['motivo_otro1'] == ""){
	   $motivo_ref_recibida = 0;
   }else{
	   $motivo_ref_recibida = $_POST['motivo_otro1'];
   }
}else{
	$motivo_ref_recibida = 0;
}

if($motivo_ref_recibida != 0){
    $consulta_motivo_ref_recibida_otros = "SELECT nombre FROM motivo_traslado WHERE motivo_traslado_id = '$motivo_ref_recibida'";	
	$result = $mysqli->query($consulta_motivo_ref_recibida_otros);
    $consulta_motivo_ref_recibida_otros1 = $result->fetch_assoc();
    $motivo_referencia_recibida_otro = $consulta_motivo_ref_recibida_otros1['nombre'];
	
	if($motivo_referencia_recibida != ""){
		$motivo_referencia_recibida .= ", ".$motivo_referencia_recibida_otro;
	}else{
		$motivo_referencia_recibida = $motivo_referencia_recibida_otro;
	}
}

if ($proceso = 'Edición'){
	$dato_referencia = "UPDATE referencia_recibida 
	     SET motivo_referencia = '$motivo_referencia_recibida', unidad_envia = '$recibidade', unidad_respuesta = '$recibidade', nivel = '$centros_nivel', centro = '$centro', patologia_id = '$patologia', motivo_traslado = '$motivo', motivo_traslado_otros = '$motivo_ref_recibida'
		 WHERE referenciar_id = '$referencia'";
		 $result = $mysqli->query($dato_referencia);
		 
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado = "Actualizar";
    $observacion = "Se ha modificado la información de la referencia enviada";
    $modulo = "Referencia Enviada";
    $insert = "INSERT INTO historial 
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$referencia','$medico','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
    $mysqli->query($insert);
    /*****************************************************/			 
	
	//OBTENER NOMBRE DEL CENTRO
	$consulta_nombre_centro = "SELECT centro_nombre 
	    FROM centros_hospitalarios 
		WHERE centros_id = '$recibidade'";
	$result = $mysqli->query($consulta_nombre_centro);
    $consulta_nombre_centro2 = $result->fetch_assoc();
    $centro_nombre = $consulta_nombre_centro2['centro_nombre'];	
	
    if($centros_nivel==1){
	   $respuesta1 = $centro_nombre;
	   $respuesta2 = "";
	   $referencia_mayor = "";
    }else if($centros_nivel==2){
	   $respuesta2 = $centro_nombre;
       $respuesta1 = "";
	   $referencia_mayor = "";
    }else if($centros_nivel==3){
	   $respuesta1 = "";
	   $respuesta2 = "";	
	   $referencia_mayor = $centro_nombre;
    }else{
	   $respuesta1 = "";
	   $respuesta2 = "";	
	   $referencia_mayor = "";
    }
	
    //CONSULTAR EXISTENCIA PATOLOGIA
    /*1ER PATOLOGIA*/
    $consultar_patologia1 = "SELECT expediente 
	    FROM ata 
		WHERE patologia_id = '$patologia' AND expediente = '$expediente'";
	$result = $mysqli->query($consultar_patologia1);
    $consultar_patologia1_1 = $result->num_rows;

    if ($consultar_patologia1_1==0){
	  $patologiaid_tipo1 = 'N';
    }else{
	  $patologiaid_tipo1 = 'S';
    }
	
	$dato_ata = "UPDATE ata 
	     SET recibidade = '$centro_nombre', respuesta1 = '$respuesta1', respuesta2 = '$respuesta2', referencia_mayor = '$referencia_mayor', patologia_id = '$patologia', patologiaid_tipo1 = '$patologiaid_tipo1' 
	     WHERE ata_id = '$ata_id'";
	$mysqli->query($dato_ata);
	
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado = "Actualizar";
    $observacion = "Se ha modificado la información de la referencia enviada en el ATA del usuario";
    $modulo = "ATA";
    $insert = "INSERT INTO historial 
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$ata_id','$medico','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
    $mysqli->query($insert);
    /*****************************************************/		
	
    if($dato_referencia == true){
		echo 1;//REGISTRO ALMACENADO CORRECTAMENTE 
	}else{
        echo 2;//ERROR AL GUARDAR EL REGISTRO
	}// && $dato_ata == true		
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>