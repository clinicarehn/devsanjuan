<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$id = $_POST['id'];
$usuario = $_SESSION['colaborador_id'];
date_default_timezone_set('America/Tegucigalpa');

//ELIMINAMOS EL REGISTRO

   //CONSULTAR EXPEDIENTE
   $query = "SELECT * 
       FROM pacientes 
	   WHERE pacientes_id = '$id'"; 
   $result = $mysqli->query($query);
   $consulta_expediente1 = $result->fetch_assoc();
   
   $pacientes_id = $consulta_expediente1['pacientes_id'];
   $expediente = $consulta_expediente1['expediente'];      
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
   $query_correlativo_historial= "SELECT DISTINCT MAX(id) AS max, COUNT(id) AS count 
       FROM historial_pacientes";
   $result = $mysqli->query($query_correlativo_historial);
   $correlativo_historial2 = $result->fetch_assoc();

   $numero_historial = $correlativo_historial2['max'];
   $cantidad_historial = $correlativo_historial2['count'];

   if ( $cantidad_historial == 0 )
	  $numero_historial = 1;
   else
      $numero_historial = $numero_historial + 1;   
  
  $flag = false;
  
  //CONSULTAR ATA DE USUARIO
  $consulta_existencia_ata = "SELECT ata_id FROM ata 
      WHERE expediente = '$expediente'";
  $result = $mysqli->query($consulta_existencia_ata);
  $consulta_existencia_ata2 = $result->fetch_assoc();
  
  $consulta_ata_id = ""; 
  
  if($result->num_rows>0){
	 $consulta_ata_id = $consulta_existencia_ata2['ata_id'];   
  }

  //CONSULTAR AGENDA DE USUARIO
  $consulta_existencia_agenda = "SELECT agenda_id 
      FROM agenda WHERE pacientes_id = '$pacientes_id'";
  $result = $mysqli->query($consulta_existencia_agenda);
  $consulta_existencia_agenda2 = $result->fetch_assoc();
  
  $consulta_agenda_id = "";

  if($result->num_rows>0){
	 $consulta_agenda_id = $consulta_existencia_agenda2['agenda_id'];
  }
  
  //CONSULTAR HOSPITALIZACION DE USUARIO
  $consulta_existencia_hospitalizacion = "SELECT hosp_id 
     FROM hospitalizacion WHERE expediente = '$expediente'";
  $result = $mysqli->query($consulta_existencia_hospitalizacion);
  $consulta_existencia_hospitalizacion2 = $result->fetch_assoc();
  
  $consulta_hospo_id = ""; 
  
  if($result->num_rows>0){
	 $consulta_hospo_id = $consulta_existencia_hospitalizacion2['hosp_id']; 
  }  
  
   if($consulta_ata_id != "" || $consulta_hospo_id !="" ){
	   $flag = true;
   }elseif($consulta_agenda_id != "" || $consulta_hospo_id !=""){
	   $flag = true;
   }else{
	  $flag = false; 
   }
  
   if($flag == false){
      $insert = "INSERT INTO historial_pacientes (id, pacientes_id, expediente, nombre, apellido, identidad, sexo, fecha_nacimiento, telefono, telefono1, 
		   departamento_id, municipio_id, localidad, responsable, parentesco, telefonoresp, telefonoresp1, fecha, usuario, observacion) 
		   VALUES('$numero_historial', '$id', '$expediente', '$nombre', '$apellido', '$identidad', '$sexo', '$fecha_nacimiento','$telefono', '$telefono1','$departamento',
		   '$municipio','$localidad','$responsable','$parentesco', '$telefonoresp', '$telefonoresp1' ,'$fecha_eliminacion', '$usuario', 'Se elimino el registro')";	   
	  $mysqli->query($insert);
		   
      $delete = "DELETE FROM pacientes WHERE pacientes_id = '$id'";
	  $mysqli->query($delete);
	  
      //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
      $historial_numero = historial();
      $estado = "Eliminar";
      $observacion = "Se elimino este registro";
      $modulo = "Pacientes";
      $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','0','0','0','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
      $mysqli->query($insert);
      /*****************************************************/   
		
      echo 1;	  
   }else{
	   echo 2;//ESTE REGISTRO TIENE INFORMACION ALMACENADA
   }
   
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN   
?>