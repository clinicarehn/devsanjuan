<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$hosp_id = $_POST['hosp_id'];
$fecha = $_POST['fecha'];
$servicio_id = $_POST['servicio_id'];
$expediente = $_POST['expediente'];
$colaborador_id = $_SESSION['colaborador_id'];
$usuario_sistema = $_SESSION['colaborador_id'];
$comentario = cleanStringStrtolower($_POST['comentario']);
$estado = 2;
$color = "#FAF03C"; //COLOR AMARILLO
$fecha_registro = date("Y-m-d H:i:s");

//SI EL SIGUIENTE DIA SUMA ES IGUAL A SABADO SE SUMAN DOS DIAS MAS A LA FECHA, DE LO CONTRARIO SOLO SE SUMA UN DIA
if(date("D", strtotime ( '+1 day' , strtotime ( $fecha ) )) == 'Sat' ){
	$nuevafecha =  date("Y-m-d", strtotime ( '+3 day' , strtotime ( $fecha )));
}else{
	$nuevafecha = date("Y-m-d", strtotime ( '+1 day' , strtotime ( $fecha )));
}

$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));

//CONSULTAR EL NOMBRE DEL SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio2['nombre'];

//OBTENER PUESTO_ID
$consulta_puesto = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$usuario_sistema'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc();
$puesto_id = $consulta_puesto1['puesto_id'];

//CONSULTAR ATA_ID DE LA ENTIDAD HOSPITALIZACION
$consulta_ata_hospitalizacion = "SELECT * 
    FROM hospitalizacion
	WHERE hosp_id = '$hosp_id'";
$result = $mysqli->query($consulta_ata_hospitalizacion);
$consulta_ata_hospitalizacion2 = $result->fetch_assoc();
$historial_id = $consulta_ata_hospitalizacion2['historial_id'];
$ata_id = $consulta_ata_hospitalizacion2['ata_id'];	
$paciente = $consulta_ata_hospitalizacion2['paciente'];
$patologia_id1 = $consulta_ata_hospitalizacion2['patologia_id'];
$patologiaid_tipo1 = $consulta_ata_hospitalizacion2['patologiaid_tipo1'];
$patologia_id2 = $consulta_ata_hospitalizacion2['patologia_id1'];
$patologiaid_tipo2 = $consulta_ata_hospitalizacion2['patologiaid_tipo2'];
$patologia_id3 = $consulta_ata_hospitalizacion2['patologia_id2'];
$patologiaid_tipo3 = $consulta_ata_hospitalizacion2['patologiaid_tipo3'];
$enfermedad = $consulta_ata_hospitalizacion2['enfermedad_id'];
$motivo_traslado = $consulta_ata_hospitalizacion2['motivo_traslado_id'];
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAR VALORES EN LA ENTIDAD PACIENTES
$consulta_pacientes = "SELECT pacientes_id
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_pacientes);
$consulta_pacientes2 = $result->fetch_assoc();
$pacientes_id = $consulta_pacientes2['pacientes_id']; 

$consultar_cama_id = "SELECT cama_id 
    FROM historial_camas 
	WHERE historial_id = '$historial_id'";
$result = $mysqli->query($consultar_cama_id);
$consultar_cama_id2 = $result->fetch_assoc();
$cama_id = $consultar_cama_id2['cama_id'];

$update = "UPDATE hospitalizacion SET estado = '$estado' 
   WHERE historial_id = '$historial_id'";
$mysqli->query($update);

//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado = "Actualizar";
$observacion = "Se ha actualizado el estado de la cama en el area de Hospitalización para el servicio: $servicio_nombre";
$modulo = "Hospitalizacion";
$insert = "INSERT INTO historial 
     VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$historial_id','0','$servicio_id','$fecha','$estado','$observacion','$usuario_sistema','$fecha_registro')";	 
$mysqli->query($insert);
/*****************************************************/	

$update = "UPDATE historial_camas SET estado = '$estado', color = '$color' 
   WHERE historial_id = '$historial_id'";
$mysqli->query($update);

//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado = "Actualizar";
$observacion = "Se ha actualizado el estado de la cama en el Historial de Camas para el area de Hospitalización en el servicio: $servicio_nombre";
$modulo = "Historial de Camas";
$insert = "INSERT INTO historial 
     VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$historial_id','0','$servicio_id','$fecha','$estado','$observacion','$usuario_sistema','$fecha_registro')";	 
$mysqli->query($insert);
/*****************************************************/

$update = "UPDATE camas SET estado = '$estado' 
   WHERE cama_id = '$cama_id'";
$mysqli->query($update);

//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado = "Actualizar";
$observacion = "Se ha actualizado el estado de la cama en el area de Hospitalización en el servicio: $servicio_nombre";
$modulo = "Camas";
$insert = "INSERT INTO historial 
     VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$cama_id','0','$servicio_id','$fecha','$estado','$observacion','$usuario_sistema','$fecha_registro')";	 
$mysqli->query($insert);
/*****************************************************/

//CORRELATIVO HOSPITALIZACION
$correlativo_hospitalizacion = "SELECT MAX(hosp_id) AS max, COUNT(hosp_id) AS count 
    FROM hospitalizacion";
$result = $mysqli->query($correlativo_hospitalizacion);
$correlativo_hospitalizacion2 = $result->fetch_assoc();

$numero_hospitalizacion = $correlativo_hospitalizacion2['max'];
$cantidad_hospitalizacion = $correlativo_hospitalizacion2['count'];

if ( $cantidad_hospitalizacion == 0 )
	$numero_hospitalizacion = 1;
else
    $numero_hospitalizacion = $numero_hospitalizacion + 1;

//CONSULTAR EXISTENCIA
$consulta = "SELECT ausencia_id 
     FROM ausencias 
     WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
$result = $mysqli->query($consulta);	 
$consulta2 = $result->fetch_assoc();
$ausencia_id = $consulta2['ausencia_id'];

if($ausencia_id == ""){
    //HISTORIAL DE CAMAS
    //CONSULTAR HISTORIAL DE CAMAS
    $consultar_historial_camas = "SELECT cama_id, usuario, color, paciente, observaciones, porcentaje
       FROM historial_camas 
       WHERE historial_id = '$historial_id'";
    $result = $mysqli->query($consultar_historial_camas);	   
		   
    $consultar_historial_camas2 = $result->fetch_assoc();
    $cama_id = $consultar_historial_camas2['cama_id'];
    $usuario = $consultar_historial_camas2['usuario'];    
    $paciente = $consultar_historial_camas2['paciente'];
    $observaciones = $consultar_historial_camas2['observaciones'];
	$porcentaje = $consultar_historial_camas2['porcentaje'];
    $estado1 = 2;
	
    //OBTENER CORRELATIVO
    $correlativo= "SELECT MAX(historial_id) AS max, COUNT(historial_id) AS count   
	    FROM historial_camas";
	$result = $mysqli->query($correlativo);
    $correlativo2 = $result->fetch_assoc();
 
    $numero = $correlativo2['max'];
    $cantidad = $correlativo2['count'];

    if ( $cantidad == 0 )
      $numero = 1;
    else
      $numero = $numero + 1;				     
	
    //AGREGAR HISTORIAL DE CAMAS
    $insert = "INSERT INTO historial_camas 
	     values('$numero','$nuevafecha','$expediente','$cama_id','$servicio_id','$puesto_id','$usuario','$color','$paciente','$observaciones','$estado1','$porcentaje','$fecha_registro')";
    $mysqli->query($insert);
	
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado = "Agregar";
    $observacion = "Se ha ingresado un nuevo registro Automáticamente en el Historial de Camas en el área de Hospitalización para el servicio: $servicio_nombre";
    $modulo = "Historial de Camas";
    $insert = "INSERT INTO historial 
        VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','0','$servicio_id','$fecha','$estado','$observacion','$usuario_sistema','$fecha_registro')";	 
    $mysqli->query($insert);
    /*****************************************************/	
	   
    //LLENA LOS REGISTROS DE HOSPITALIZACION PARA EL SIGUIENTE DIA HABIL
    $insert = "INSERT INTO hospitalizacion 
	         VALUES ('$numero_hospitalizacion','$numero', '$ata_id', '$nuevafecha','$expediente','$servicio_id', '$usuario', '$puesto_id', 
			         '$paciente', '3','','0','0','$patologia_id1', '$patologiaid_tipo1', '$patologia_id2', '$patologiaid_tipo2', 
			         '$patologia_id3', '$patologiaid_tipo3','$enfermedad','$motivo_traslado','$fecha_registro')";				
	$query = $mysqli->query($insert);
	
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado = "Agregar";
    $observacion = "Se ha ingresado un nuevo registro Automáticamente en el área de Hospitalización para el servicio: $servicio_nombre";
    $modulo = "Hospitalizacion";
    $insert = "INSERT INTO historial 
        VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_hospitalizacion','0','$servicio_id','$fecha','$estado','$observacion','$usuario_sistema','$fecha_registro')";	 
    $mysqli->query($insert);
    /*****************************************************/		

   if($query){	
       //OBTENER CORRELATIVO
       $correlativo_ausencias = "SELECT MAX(ausencia_id) AS max, COUNT(ausencia_id) AS count 
	       FROM ausencias";
	   $result = $mysqli->query($correlativo_ausencias);
       $correlativo_ausencias2 = $result->fetch_assoc();
   
       $numero_ausencias = $correlativo_ausencias2['max'];
       $cantidad_ausencias = $correlativo_ausencias2['count'];
   
      if ( $cantidad_ausencias == 0 )
	     $numero_ausencias = 1;
      else
         $numero_ausencias = $numero_ausencias + 1;
			
	  $insert = "INSERT INTO ausencias 
	       VALUES('$numero_ausencias','$pacientes_id', '$expediente', '0','$fecha','$comentario','$usuario_sistema','$colaborador_id','$servicio_id','$paciente','$fecha_registro')";
	  $mysqli->query($insert);
	
      //ACTUALIZAMOS EL ESTADO DE LAS CAMAS
      $update = "UPDATE camas SET estado = '$estado1' 
	     WHERE cama_id = '$cama_id'";
      $mysqli->query($update);	

	  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
      $historial_numero = historial();
      $estado = "Actualizar";
      $observacion = "Se ha actualizado el estado de la cama en el área de Hospitalización para el servicio: $servicio_nombre";
      $modulo = "Camas";
      $insert = "INSERT INTO historial 
          VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$cama_id','0','$servicio_id','$fecha','$estado','$observacion','$usuario_sistema','$fecha_registro')";	 
      $mysqli->query($insert);
      /*****************************************************/		
	  
	  echo 1;
  }else{
	 echo 2;
  }
}else{
	echo 3;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>