<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro_confirmacion'];
$agenda_id = $_POST['agenda_id_confirmacion'];
$fecha = $_POST['fecha_confirmacion'];
$correo = $_POST['correo_confirmacion'];
$telefono = $_POST['telefono_confirmacion'];
$colaborador_id = $_POST['colaborador_id_confirmacion'];
$servicio_id = $_POST['servicio_id_confirmacion'];
$observacion = cleanStringStrtolower($_POST['observacion_confirmacion']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

//RESPUESTA A CONFIRMACION
if(isset($_POST['respuesta_confirmacion'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['respuesta_confirmacion'] == ""){
		$respuesta = 0;
	}else{
	    $respuesta = $_POST['respuesta_confirmacion'];		
	}
}else{
	$respuesta = 0;
}

//CONFIRMACIONES
if(isset($_POST['confirmo_no'])){
   if($_POST['confirmo_no'] == ""){
       $confirmo = 0;
   }else{
	   $confirmo = $_POST['confirmo_no'];
   }
}

//ACTUALIZACION DE DATOS
if(isset($_POST['actualizar_datos'])){
   if($_POST['actualizar_datos'] == ""){
       $actualizacion = 0;
   }else{
	   $actualizacion = $_POST['actualizar_datos'];
   }
}

//CONSULTAR FECHA_CITA
$consulta_fecha = "SELECT CAST(fecha_cita AS DATE) AS 'fecha_cita', pacientes_id, expediente, colaborador_id 
    FROM agenda 
	WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consulta_fecha) or die($mysqli->error);
$consulta_fecha2 = $result->fetch_assoc();

$fecha_cita = "";
$pacientes_id = "";
$expediente = "";
$colaborador_id = "";

if($result->num_rows>0){
	$fecha_cita = $consulta_fecha2['fecha_cita'];
	$pacientes_id = $consulta_fecha2['pacientes_id'];
	$expediente = $consulta_fecha2['expediente'];
	$colaborador_id = $consulta_fecha2['colaborador_id'];	
}

//CONSULTAR EXISTENCIA DE REGISTRO
$consultar_existencia = "SELECT confirmacion_agenda_id 
      FROM confirmacion_agenda 
      WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consultar_existencia) or die($mysqli->error);	  
$consultar_existencia2 = $result->fetch_assoc();

$consulta_existencia_cofirmacion = "";

if($result->num_rows>0){
    $consulta_existencia_cofirmacion = $consultar_existencia2['confirmacion_agenda_id'];	
}

$consultar_puesto_colaborador = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_puesto_colaborador) or die($mysqli->error);
$consultar_puesto_colaborador2 = $result->fetch_assoc();

$puesto_id = "";

if($result->num_rows>0){
	$puesto_id = $consultar_puesto_colaborador2['puesto_id'];
}

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(confirmacion_agenda_id) AS max, COUNT(confirmacion_agenda_id) AS count 
   FROM confirmacion_agenda";
$result = $mysqli->query($correlativo) or die($mysqli->error);
$correlativo2 = $result->fetch_assoc();

$numero = "";
$cantidad = "";

if($result->num_rows>0){
	$numero = $correlativo2['max'];
	$cantidad = $correlativo2['count'];	
}

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

if($consulta_existencia_cofirmacion == ""){
	  
	  if($agenda_id != 0 && $servicio_id != 0 && $pacientes_id != 0 && $colaborador_id != 0 && $usuario != 0){				
		  $insert = "INSERT INTO confirmacion_agenda 
		    VALUES ('$numero','$agenda_id','$expediente', '$pacientes_id', '$colaborador_id','$servicio_id','$fecha', '$fecha_registro', '$observacion','$respuesta','$confirmo', '$correo', '$telefono', '$usuario')";
            $query = $mysqli->query($insert) or die($mysqli->error);

	          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		      $historial_numero = historial();
		      $estado = "Agregar";
		      $observacion_historial = "Se agrego una nueva confirmación de la agenda para este registro";
		      $modulo = "Agenda";
		      $insert = "INSERT INTO historial 
		         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";
		      $mysqli->query($insert) or die($mysqli->error);
		      /*****************************************************/				

			//INICIO REVISAMOS SI SE CONFIRMO LA LLAMADA AL USUARIO Y SI LA CONFIRMACION ES DESDE PSIQUIATRIA
            if($respuesta == 1 && $puesto_id == 2){
			   //CONSULTAMOS SI TIENE CITA CON PSICOLOGÍA				   
			   $consulta_psicologia = "SELECT a.colaborador_id AS 'psicologo', a.agenda_id AS 'agenda_id_psicologo'
                       FROM agenda AS a
                       INNER JOIN colaboradores AS c
                       ON a.colaborador_id = c .colaborador_id
                       WHERE a.pacientes_id = '$pacientes_id' AND CAST(a.fecha_cita AS DATE) = '$fecha' AND c.puesto_id = 1";
			   $result = $mysqli->query($consulta_psicologia) or die($mysqli->error);
			   
			   $consulta_psicologia2 = $result->fetch_assoc();
               $colaborador_id_psicologo = $consulta_psicologia2['psicologo'];
			   $agenda_id_psicologo = $consulta_psicologia2['agenda_id_psicologo'];

			   if($colaborador_id_psicologo != ""){
                     //CONSULTAR EXISTENCIA DE REGISTRO	
                     $consultar_existencia = "SELECT confirmacion_agenda_id 
					      FROM confirmacion_agenda 
                          WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND colaborador_id = '$colaborador_id_psicologo' AND servicio_id = '$servicio_id'";
					 $result = $mysqli->query($consultar_existencia) or die($mysqli->error);
						  
                     $consultar_existencia2 = $result->fetch_assoc();
					 
                     $consulta_existencia_cofirmacion = "";

				     if($result->num_rows>0){
						 $consulta_existencia_cofirmacion = $consultar_existencia2['confirmacion_agenda_id'];
					 }
					 
					 //EVALUAMOS QUE NO EXISTA CONFIRMACIÓN PARA ESTE REGISTRO, DE NO EXISTIR SE ALMACENA LA CONFIRMACIÓN PARA EL MISMO
                     if($consulta_existencia_cofirmacion == ""){
                         //OBTENER CORRELATIVO
                         $correlativo= "SELECT MAX(confirmacion_agenda_id) AS max, COUNT(confirmacion_agenda_id) AS count 
						 FROM confirmacion_agenda";
						 $result = $mysqli->query($correlativo) or die($mysqli->error);
                         $correlativo2 = $result->fetch_assoc();

                         $numero = 0;
                         $cantidad = 0;
						 
						 if($result->num_rows>0){
							$numero = $correlativo2['max'];
                            $cantidad = $correlativo2['count']; 
						 }
    
                         if ( $cantidad == 0 )
	                         $numero = 1;
                         else
                             $numero = $numero + 1;	

		                  $insert = "INSERT INTO confirmacion_agenda 
		                     VALUES ('$numero','$agenda_id_psicologo','$expediente', '$pacientes_id', '$colaborador_id_psicologo','$servicio_id','$fecha', '$fecha_registro', '$observacion','$respuesta','$confirmo', '$correo', '$telefono', '$usuario')";	
                          $query = $mysqli->query($insert) or die($mysqli->error);	

	                      //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		                  $historial_numero = historial();
		                  $estado = "Agregar";
		                  $observacion_historial = "Se agrego una nueva confirmación de la agenda para este registro";
		                  $modulo = "Agenda";
		                  $insert = "INSERT INTO historial 
		                      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";
		                  $mysqli->query($insert) or die($mysqli->error);
		                  /*****************************************************/								  
					 }					 
			   }			
			}	
            //FIN REVISAMOS SI SE CONFIRMO LA LLAMADA AL USUARIO Y SI LA CONFIRMACION ES DESDE PSIQUIATRIA
			
			
			//INICIO REVISAMOS SI SE CONFIRMO LA LLAMADA AL USUARIO Y SI LA CONFIRMACION ES DESDE PSICOLOGÍA
            if($respuesta == 1 && $puesto_id == 1){
			   //CONSULTAMOS SI TIENE CITA CON PSIQUIATRIA						   
			   $consulta_psquiatra = "SELECT a.colaborador_id AS 'psquiatria', a.agenda_id AS 'agenda_id_psiquiatria'
                       FROM agenda AS a
                       INNER JOIN colaboradores AS c
                       ON a.colaborador_id = c .colaborador_id
                       WHERE a.pacientes_id = '$pacientes_id' AND CAST(a.fecha_cita AS DATE) = '$fecha' AND c.puesto_id = 2";
			   $result = $mysqli->query($consulta_psquiatra) or die($mysqli->error);
			   
			   $consulta_psquiatra2 = $result->fetch_assoc();
			   
               $colaborador_id_psquiatria = "";
			   $agenda_id_psiquiatria = "";

               if($result->num_rows>0){
				   $colaborador_id_psquiatria = $consulta_psquiatra2['psquiatria'];
			       $agenda_id_psiquiatria = $consulta_psquiatra2['agenda_id_psiquiatria'];
			   }
			   
			   if($colaborador_id_psquiatria != ""){
                     //CONSULTAR EXISTENCIA DE REGISTRO							  
                     $consultar_existencia = "SELECT confirmacion_agenda_id 
					      FROM confirmacion_agenda 
                          WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND colaborador_id = '$colaborador_id_psquiatria' AND servicio_id = '$servicio_id'";
					 $result = $mysqli->query($consultar_existencia) or die($mysqli->error);
						  
                     $consultar_existencia2 = $result->fetch_assoc();
					 
                     $consulta_existencia_cofirmacion = "";

                     if($result->num_rows>0){
						 $consulta_existencia_cofirmacion = $consultar_existencia2['confirmacion_agenda_id'];
					 }
					 
					 //EVALUAMOS QUE NO EXISTA CONFIRMACIÓN PARA ESTE REGISTRO, DE NO EXISTIR SE ALMACENA LA CONFIRMACIÓN PARA EL MISMO
                     if($consulta_existencia_cofirmacion == ""){
                         //OBTENER CORRELATIVO
                         $correlativo= "SELECT MAX(confirmacion_agenda_id) AS max, COUNT(confirmacion_agenda_id) AS count 
						     FROM confirmacion_agenda";
						 $result = $mysqli->query($correlativo) or die($mysqli->error);
                         $correlativo2 = $result->fetch_assoc();

                         $numero = 0;
                         $cantidad = 0;
						 
						 if($result->num_rows>0){
							 $numero = $correlativo2['max'];
                             $cantidad = $correlativo2['count'];
						 }
    
                         if ( $cantidad == 0 )
	                         $numero = 1;
                         else
                             $numero = $numero + 1;	
						 
		                  $insert = "INSERT INTO confirmacion_agenda 
		                     VALUES ('$numero','$agenda_id_psiquiatria','$expediente', '$pacientes_id', '$colaborador_id_psquiatria','$servicio_id','$fecha', '$fecha_registro', '$observacion','$respuesta','$confirmo', '$correo', '$telefono', '$usuario')";
                          $query = $mysqli->query($insert) or die($mysqli->error);							 
					 }					 
			   }			
			}	
            //FIN REVISAMOS SI SE CONFIRMO LA LLAMADA AL USUARIO Y SI LA CONFIRMACION ES DESDE PSICOLOGÍA			
			
	  }else{
		  echo 4;//ERROR AL GUARDAR EL REGISTRO HAY CAMPOS VACIOS
	  }
	  
	  if($query){
		  echo 1; //REGISTRO ALMACENADO CON EXITO
		  
	      //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		  $historial_numero = historial();
		  $estado = "Actualizar";
		  $observacion_historial = "Se agrego una confirmacion a este registro";
		  $modulo = "Agenda";
		  $insert = "INSERT INTO historial 
		      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio_id','$fecha_registro','$estado','$observacion_historial','$usuario','$fecha_registro')";
		  $mysqli->query($insert) or die($mysqli->error);
		  /*****************************************************/	
			
		  if($actualizacion == 1){
              //ACTUALIZAMOS LA ENTIDAD PACIENTES
		      $update = "UPDATE pacientes SET actualizar_datos = '$actualizacion' 
			      WHERE pacientes_id = '$pacientes_id'";	
			  $mysqli->query($update) or die($mysqli->error);	

	          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		      $historial_numero = historial();
		      $estado = "Enviar";
		      $observacion_historial = "Se envio solicitud para actualizar los datos de este registro";
		      $modulo = "Agenda";
		      $insert = "INSERT INTO historial 
		         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";
		      $mysqli->query($insert) or die($mysqli->error);
		      /*****************************************************/			  
		  }
	  }else{
		  echo 3;//ERROR ALMACENANDO EL REGISTRO
	  }
}else{
    echo 2; //REGISTRO YA EXISTE
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>