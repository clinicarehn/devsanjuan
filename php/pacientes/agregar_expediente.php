<?php
session_start(); 
include('../funtions.php');
date_default_timezone_set('America/Tegucigalpa');	

//CONEXION A DB
$mysqli = connect_mysqli();
include('../conexion-postgresql.php');

$id_registro = $_POST['pacientes_id'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");
//CONSULTAR ID
$consulta_identidad = "SELECT identidad, CONCAT(apellido,' ',nombre) AS 'paciente'
     FROM pacientes 
     WHERE pacientes_id = '$id_registro'";
$result = $mysqli->query($consulta_identidad);
$consulta_identidad1 = $result->fetch_assoc();
$identidad = $consulta_identidad1['identidad'];
$paciente = $consulta_identidad1['paciente'];

//CONOCER SI LA IDENTIDAD DEL USUARIO YA CUENTA CON UN Expediente
$consulta_expediente = "SELECT expediente 
    FROM pacientes 
	WHERE identidad = '$identidad'";
$result = $mysqli->query($consulta_expediente);
$consulta_expediente1 = $result->fetch_assoc();
$expediente = $consulta_expediente1['expediente'];

if ($expediente != 0 || $expediente != "" && $identidad > 0){
     $correlativo_expediente = "SELECT DISTINCT MAX(expediente) AS max, COUNT(expediente) AS count 
	     FROM pacientes";
	 $result = $mysqli->query($correlativo_expediente);
     $correlativo_expediente2 = $result->fetch_assoc();

     $numero_expediente = $correlativo_expediente2['max'];
     $cantidad_expediente = $correlativo_expediente2['count'];
 
     if ( $cantidad_expediente == 0 )
	    $numero_expediente = 1;
     else
        $numero_expediente = $numero_expediente + 1;

	    //ACTUALIZAMOS EL EXPEDIENTE DEL USUARIO EN LA ENTIDAD PACIENTES
		$update = "UPDATE pacientes 
		    SET expediente = '$numero_expediente' 
			WHERE pacientes_id = '$id_registro'";
		$query_pacientes = $mysqli->query($update);
		
		if($query_pacientes){
		   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Actualizar";
           $observacion_historial = "Se ha actualizado el numero de expediente en la entidad Pacientes, para el usuario: $paciente con identidad n° $identidad nuevo expediente: $numero_expediente";
           $modulo = "Pacientes";
           $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$id_registro','$expediente','$modulo','$id_registro','0','0','$fecha_registro','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
           $mysqli->query($insert);   
           /*****************************************************/   			
		}
		
        //ACTUALIZAMOS EL EXPEDIENTE DEL USUARIO EN LA ENTIDAD AGENDA		
		$update = "UPDATE agenda 
		    SET expediente = '$numero_expediente' 
			WHERE pacientes_id = '$id_registro'";	
		$query_agenda = $mysqli->query($update);
		
		//ACTUALIZAMOS EL EXPEDIENTE EN EL TRIAGE
		$update = "UPDATE triage 
		    SET expediente = '$numero_expediente' 
			WHERE pacientes_id = '$id_registro'";	
		$query_triage = $mysqli->query($update);
		
		if($query_agenda){
		   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Actualizar";
           $observacion_historial = "Se ha actualizado el numero de expediente en la entidad Agenda, para el usuario: $paciente con identidad n° $identidad";
           $modulo = "Agenda";
           $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$id_registro','$expediente','$modulo','$id_registro','0','0','$fecha_registro','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
           $mysqli->query($insert);   
           /*****************************************************/   			
		}		
			
        //ACTUALIZAMOS EL EXPEDIENTE DEL USUARIO EN LA ENTIDAD AGENDA CAMBIO
		/*$update = "UPDATE agenda_cambio 
		    SET expediente = '$numero_expediente' 
			WHERE pacientes_id = '$id_registro'";	
        $query_agenda_cambio = $mysqli->query($update);*/
		
		/*if($query_agenda_cambio){
		   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Actualizar";
           $observacion_historial = "Se ha actualizado el numero de expediente en la entidad Agenda Cambio (Historial de Agenda), para el usuario: $paciente con identidad n° $identidad";
           $modulo = "Agenda Cambio";
           $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$id_registro','$expediente','$modulo','$id_registro','0','0','$fecha_registro','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
           $mysqli->query($insert);    			
		}*/	
		
        //ACTUALIZAMOS EL EXPEDIENTE DEL USUARIO EN LA ENTIDAD AUSENCIAS		
/*		$update = "UPDATE ausencias 
		    SET expediente = '$numero_expediente' 
			WHERE pacientes_id = '$id_registro'";
		$aquery_usencias = $mysqli->query($update);*/
		
/*		if($aquery_usencias){
		   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Actualizar";
           $observacion_historial = "Se ha actualizado el numero de expediente en la entidad Ausencias, para el usuario: $paciente con identidad n° $identidad";
           $modulo = "Ausencias";
           $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$id_registro','$expediente','$modulo','$id_registro','0','0','$fecha_registro','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
           $mysqli->query($insert);    			
		}*/		
					
		//ACTUALIZAMOS EL EXPEDIENTE DEL USUARIO EN LA ENTIDAD HISTORIAL PACIENTES
		/*$update = "UPDATE historial_pacientes 
		    SET expediente = '$numero_expediente' 
			WHERE pacientes_id = '$id_registro'";
		$query_historial_pacientes = $mysqli->query($update);
		
		if($query_historial_pacientes){
		   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Actualizar";
           $observacion_historial = "Se ha actualizado el numero de expediente en la entidad Historial Pacientes, para el usuario: $paciente con identidad n° $identidad";
           $modulo = "Historial Pacientes";
           $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$id_registro','$expediente','$modulo','$id_registro','0','0','$fecha_registro','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
           $mysqli->query($insert);   			
		}*/	

		//ACTUALIZAMOS EL EXPEDIENTE DEL USUARIO EN LA ENTIDAD EXTEMPORANEOS
	/*	$update = "UPDATE extemporaneos 
		    SET expediente = '$numero_expediente' 
			WHERE pacientes_id = '$id_registro'";
		$query_extemporaneos = $mysqli->query($update);		

		if($query_extemporaneos){
		   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Actualizar";
           $observacion_historial = "Se ha actualizado el numero de expediente en la entidad Extemporaneos, para el usuario: $paciente con identidad n° $identidad";
           $modulo = "Extemporaneos";
           $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$id_registro','$expediente','$modulo','$id_registro','0','0','$fecha_registro','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
           $mysqli->query($insert);     			
		}*/	
		
   //CONSULTAR EXPEDIENTE
   $consulta_expediente = "SELECT * 
        FROM pacientes 
		WHERE pacientes_id = '$id_registro'";
   $result = $mysqli->query($consulta_expediente);   
   $consulta_expediente1 = $result->fetch_assoc();
   
   $pacientes_id = $consulta_expediente1['pacientes_id'];
   $nombre = $consulta_expediente1['nombre'];   
   $apellido = $consulta_expediente1['apellido'];
   $identidad = $consulta_expediente1['identidad'];
   $sexo = $consulta_expediente1['sexo'];
   $fecha_nacimiento = $consulta_expediente1['fecha_nacimiento'];
   $telefono = $consulta_expediente1['telefono'];
   $telefono1 = $consulta_expediente1['telefono1'];
   $departamento = $consulta_expediente1['departamento_id'];
   $municipio = $consulta_expediente1['municipio_id'];
   $localidad = $consulta_expediente1['localidad'];
   $responsable = $consulta_expediente1['responsable'];
   $telefonoresp = $consulta_expediente1['telefonoresp'];
   $telefonoresp1 = $consulta_expediente1['telefonoresp1'];
   $parentesco = $consulta_expediente1['parentesco'];
   $correo = cleanString($consulta_expediente1['email']);
   $estado_civil = $consulta_expediente1['estado_civil'];
   $fecha_eliminacion = date('Y-m-d');	
   $fecha_registro = date("Y-m-d H:i:s");
   
   if ($consulta_expediente1['fecha'] == '0000-00-00'){
	   $fecha = date('Y-m-d');
   }else{
	   $fecha = $consulta_expediente1['fecha'];
   }
   
   if ($consulta_expediente1['expediente'] == ""){
	  $expediente = 0;
    }else{
	  $expediente = $consulta_expediente1['expediente'];
	}   
   
   //OBTENER CORRELATIVO HISTORIAL PACIENTES
   $correlativo_historial= "SELECT DISTINCT MAX(id) AS max, COUNT(id) AS count 
       FROM historial_pacientes";
   $result = $mysqli->query($correlativo_historial);
   $correlativo_historial2 = $result->fetch_assoc();

   $numero_historial = $correlativo_historial2['max'];
   $cantidad_historial = $correlativo_historial2['count'];

   if ( $cantidad_historial == 0 )
	  $numero_historial = 1;
   else
      $numero_historial = $numero_historial + 1;

   $insert = "INSERT INTO historial_pacientes VALUES('$numero_historial', '$id_registro', '$expediente', '$nombre', '$apellido', '$identidad', '$sexo', '$fecha_nacimiento','$telefono', '$telefono1','$departamento','$municipio','$localidad','$responsable','$parentesco', '$telefonoresp', '$telefonoresp1' ,'$fecha_eliminacion', '$usuario', 'Se asigno un nuevo expediente al usuario','fecha_registro')";  
   
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Actualizar";
   $observacion_historial = "Se agrego el registro en el historial de pacientes";
   $modulo = "Historial de Pacientes";
   $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','0','0','0','$fecha_registro','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
   $mysqli->query($insert);   
   /*****************************************************/   
   
   $mysqli->query($insert);
	
   //INSERTAR DATOS DEL USUARIO EN EL SISTEMA ODOO
   $nombre_completo = $apellido." ".$nombre;	
   $pais = 97;//HONDURAS
	
   insertOdoo($expediente, $identidad, $nombre_completo, $fecha_nacimiento, $telefono, $telefono1, $telefonoresp, $telefonoresp1, $sexo, $localidad, $pacientes_id, $departamento, $pais, $correo, $estado_civil);
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>