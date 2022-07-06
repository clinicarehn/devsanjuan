<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
 
date_default_timezone_set('America/Tegucigalpa');
header("Content-Type: text/html;charset=utf-8");
$proceso = $_POST['pro1'];
$id = $_POST['id-registro1'];
$agenda_id = $_POST['id-registro1'];
$expediente = $_POST['user1'];
$fecha = $_POST['fecha1'];
$colaborador_id = $_SESSION['colaborador_id'];
$paciente = $_POST['paciente1'];
$profesional_transito_recibida = $_POST['transito_profesional_recibidas1'];
$profesional_transito_enviada = $_POST['transito_profesional_enviada1'];
$tipo_atencion_trabajosocial = $_POST['tipo_atencion_ata1'];
$tipo_atencion_trabajosocial = $_POST['tipo_atencion_ata1'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];


/*INICIO PROGRAMAR CITA*/
if(isset($_POST['programar_cita_1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['programar_cita_1'] == ""){
		$programar_cita = 0;
	}else{
		$programar_cita = $_POST['programar_cita_1'];
	}
}else{
	$programar_cita = 0;
}

if(isset($_POST['otros_programar_cita_1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['otros_programar_cita_1'] == ""){
		$programar_cita_comentario = '';
	}else{
		$programar_cita_comentario = $_POST['otros_programar_cita_1'];
	}
}else{
	$programar_cita_comentario = '';
}
/*FIN PROGRAMAR CITA*/

//CONSULTAR PUESTO COLABORADOR
$consulta_puesto = "SELECT puesto_id 
   FROM colaboradores 
   WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc(); 
$puesto_colaborador = $consulta_puesto1['puesto_id'];

//CONSULTA PACIENTE_ID
$consultar_expediente= "SELECT pacientes_id, localidad, municipio_id, departamento_id 
    FROM pacientes 
	WHERE expediente = '$expediente'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente1 = $result->fetch_assoc();
$pacientes_id = $consultar_expediente1['pacientes_id'];
$localidad = $consultar_expediente1['localidad'];
$municipio_id = $consultar_expediente1['municipio_id'];
$departamento_id = $consultar_expediente1['departamento_id'];

if(isset($_POST['cantidad_tipo_atencion1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['cantidad_tipo_atencion1'] == ""){
		$cantidad_tipo_atencion = 0;
	}else{
		$cantidad_tipo_atencion = $_POST['cantidad_tipo_atencion1'];
	}
}else{
	$cantidad_tipo_atencion = 0;
}

//REFERENCIAS ENVIADAS
if(isset($_POST['motivo_traslado1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['motivo_traslado1'] == ""){
		$motivo_traslado = 0;
	}else{
	    $motivo_traslado = $_POST['motivo_traslado1'];		
	}
}else{
	$motivo_traslado = 0;
}

//CONSULTAR MOTIVO REFERENCIA ENVIADA
if($motivo_traslado != 0){
    $consulta_motivo = "SELECT nombre 
	    FROM motivo_traslado 
		WHERE motivo_traslado_id = '$motivo_traslado'";
	$result = $mysqli->query($consulta_motivo);
    $consulta_motivo1 = $result->fetch_assoc();
    $motivo_referencia_enviada = $consulta_motivo1['nombre'];	
}

if(isset($_POST['motivo_e1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['motivo_e1'] == ""){
		$motivo_traslado_otro = 0;
	}else{
	    $motivo_traslado_otro = $_POST['motivo_e1'];		
	}
}else{
	$motivo_traslado_otro = 0;
}

//CONSULTAR MOTIVO REFERENCIA ENVIADA
if($motivo_traslado_otro != 0){
    $consulta_motivo_traslado_otro = "SELECT nombre 
	    FROM motivo_traslado 
		WHERE motivo_traslado_id = '$motivo_traslado_otro'";
	$result = $mysqli->query($consulta_motivo_traslado_otro);
    $consulta_motivo_traslado_otro1 = $result->fetch_assoc();
    $motivo_referencia_enviada_traslado_otro = $consulta_motivo_traslado_otro1['nombre'];
	
	if($motivo_referencia_enviada != ""){
		$motivo_referencia_enviada .= ", ".$motivo_referencia_enviada_traslado_otro;
	}else{
		$motivo_referencia_enviada = $motivo_referencia_enviada_traslado_otro;
	}
}
	
/*INICIO TRABAJO SOCIAL*/
if(isset($_POST['tipo_atencion1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['tipo_atencion1'] == ""){
		$tipo_atencion = 0;
	}else{
	    $tipo_atencion = $_POST['tipo_atencion1'];		
	}
}else{
	$tipo_atencion = 0;
}

if(isset($_POST['nivel_socioeconomico1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['nivel_socioeconomico1'] == ""){
  		$nivel_socioeconomico = 0;
   }else{
	   	$nivel_socioeconomico = $_POST['nivel_socioeconomico1'];
   }
}else{
	$nivel_socioeconomico = 0;
}

if(isset($_POST['problema_social1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['problema_social1'] == ""){
	   $problema_social = 0;
	}else{
	   $problema_social = $_POST['problema_social1'];		
	}

}else{
	$problema_social = 0;
}
/*FIN TRABAJO SOCIAL*/

if(isset($_POST['patologia_1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['patologia_1'] == ""){
	  $patologia_id1 = 0; 
   }else{
	 $patologia_id1 = $_POST['patologia_1'];  
   }	     
}else{
	$patologia_id1 = 0;
}

if(isset($_POST['patologia_2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['patologia_2'] == ""){
	  $patologia_id2 = 0; 
   }else{
	 $patologia_id2 = $_POST['patologia_2'];  
   }	     
}else{
	$patologia_id2 = 0;
}

if(isset($_POST['patologia_3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['patologia_3'] == ""){
	  $patologia_id3 = 0; 
   }else{
	 $patologia_id3 = $_POST['patologia_3'];  
   }	     
}else{
	$patologia_id3 = 0;
}

if(isset($_POST['enfermedad1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['enfermedad1'] == ""){
		$enfermedad = 0;
	}else{
	    $enfermedad = $_POST['enfermedad1'];
	}
}else{
	$enfermedad = 0;
}

$servicio = $_POST['servicio1'];
$asegurado = $_POST['ihss_ata'];
$observaciones = mb_convert_case($_POST['observaciones1'], MB_CASE_TITLE, "UTF-8");

//TAB Transito
//RECIBIDA
$transito_servicio_recibida = $_POST['transito_servicio_recibida1'];
$transito_unidad_recibida = $_POST['transito_unidad_recibida1'];
$transito_motivo_recibida = mb_convert_case($_POST['transito_motivo_recibida1'], MB_CASE_TITLE, "UTF-8");

//ENVIADAS
$transito_servicio_enviada = $_POST['transito_servicio_enviada1'];
$transito_unidad_enviada = $_POST['transito_unidad_enviada1'];
$transito_motivo_enviada = mb_convert_case($_POST['transito_motivo_enviada1'], MB_CASE_TITLE, "UTF-8");
$nivel = $_POST['nivel1'];
$centro = $_POST['centro1'];

$clinico1 = mb_convert_case($_POST['clinico1'], MB_CASE_TITLE, "UTF-8");

//REFERENCIAS RECIBIDAS
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

if(isset($_POST['motivo_re'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['motivo_re'] == ""){
	   $motivo_ref_recibida = 0;
   }else{
	   $motivo_ref_recibida = $_POST['motivo_re'];
   }
}else{
	$motivo_ref_recibida = 0;
}

if($motivo_ref_recibida != 0){
    $consulta_motivo_ref_recibida_otros = "SELECT nombre 
	    FROM motivo_traslado 
		WHERE motivo_traslado_id = '$motivo_ref_recibida'";
    $result = $mysqli->query($consulta_motivo_ref_recibida_otros);	
    $consulta_motivo_ref_recibida_otros1 = $result->fetch_assoc();
    $motivo_referencia_recibida_otro = $consulta_motivo_ref_recibida_otros1['nombre'];
	
	if($motivo_referencia_recibida != ""){
		$motivo_referencia_recibida .= ", ".$motivo_referencia_recibida_otro;
	}else{
		$motivo_referencia_recibida = $motivo_referencia_recibida_otro;
	}
}

$nivel_e = $_POST['nivel_e1'];
$centro_e = $_POST['centro_e1'];
$motivo_e = mb_convert_case($_POST['motivo_e1'], MB_CASE_TITLE, "UTF-8");
$clinico = mb_convert_case($_POST['diagnostico_clinico1'], MB_CASE_TITLE, "UTF-8");

$localidades = mb_convert_case($localidad, MB_CASE_TITLE, "UTF-8");

//EVALUA LA SELECCION DE LA PREGUNTA REFERENCIAS, PARA SABER SI EL USUARIO PORTA O NO REFERENCIA
if(isset($_POST['referencia1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	$porta_referencia = $_POST['referencia1'];
}else{
	$porta_referencia = "";
}

//EVALUA LA SELECCION DE LA PREGUNTA USUARIO CRONICO, PARA SABER SI EL USUARIO ES O NO CRONICO
if(isset($_POST['cronico1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	$user_cronico = $_POST['cronico1'];
}else{
	$user_cronico = "";
}

//OBTENER CENTRO
//RECIBIDA
$centroi = $_POST['centroi1'];	
//OBTENER NOMBRE
$consulta_respuesta_recibida = "SELECT centro_nombre 
    FROM centros_hospitalarios 
	WHERE centros_id = '$centroi'";
$result = $mysqli->query($consulta_respuesta_recibida);
$consulta_respuesta_recibida2 = $result->fetch_assoc();
$referencia_recibidade = $consulta_respuesta_recibida2['centro_nombre'];

//ENVIADAS
$centroi_e = $_POST['centroi_e1'];
//OBTENER NOMBRE
$consulta_repuesta_enviada = "SELECT centro_nombre 
   FROM centros_hospitalarios 
   WHERE centros_id = '$centroi_e'";
$result = $mysqli->query($consulta_repuesta_enviada);
$consulta_repuesta_enviada2 = $result->fetch_assoc();
$referencia_enviadaa = $consulta_repuesta_enviada2['centro_nombre'];


if ($patologia_id1 == ""){
	$patologia_id1 = 0;
}

if ($patologia_id2 == ""){
	$patologia_id2 = 0;
}

if ($patologia_id3 == ""){
	$patologia_id3 = 0;
}


/*INTENTO SUICIDA*/
if(isset($_POST['suicida1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['suicida1'] == ""){
		$suicida = 0;
	}else{
	    $suicida = $_POST['suicida1'];		
	}
}else{
	$suicida = 0;
}
/*********************************************************************************/
//CONSULTAR FECHA DE NACIMIENTO
$consulta_nacimiento = "SELECT fecha_nacimiento 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_nacimiento);
$consulta_nacimiento2 = $result->fetch_assoc();
$fecha_nacimiento = $consulta_nacimiento2['fecha_nacimiento'];

//CONSULTA AÑO, MES y DIA DEL PACIENTE
$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/
//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(ata_id) AS max, COUNT(ata_id) AS count 
   FROM ata";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;

/*********************************************************************************/
//VERIFICAMOS EL PROCESO
$consulta_depto = "SELECT nombre 
    FROM municipios 
	WHERE municipio_id = '$municipio_id' AND departamento_id = '$departamento_id'";
$result = $mysqli->query($consulta_depto);
$consulta_depto2 = $result->num_rows;


//CONSULTAR EXISTENCIA PATOLOGIA
/*1ER PATOLOGIA*/
$consultar_patologia1 = "SELECT expediente 
   FROM ata 
   WHERE patologia_id = '$patologia_id1' AND expediente = '$expediente'";
$result = $mysqli->query($consultar_patologia1);
$consultar_patologia1_1 = $result->num_rows;

if($consultar_patologia1_1>0){	
	$patologiaid_tipo1 = 'S';
}else{
	$patologiaid_tipo1 = 'N';
}

/*2DA PATOLOGIA*/
if($patologia_id2!=0){
   $consultar_patologia2 = "SELECT expediente 
      FROM ata 
	  WHERE patologia_id1 = '$patologia_id2' AND expediente = '$expediente'";
   $result = $mysqli->query($consultar_patologia2);

   if($result->num_rows>0){
	  $patologiaid_tipo2 = 'S';
   }else{
	  $patologiaid_tipo2 = 'N';
   }
}else{
	$patologiaid_tipo2 = '';
}

/*3ER PATOLOGIA*/
if($patologia_id3!=0){
  $consultar_patologia3 = "SELECT expediente 
      FROM ata 
	  WHERE patologia_id2 = '$patologia_id3' AND expediente = '$expediente'";
  $result = $mysqli->query($consultar_patologia3);

  if($result->num_rows>0){
	$patologiaid_tipo3 = 'S';
  }else{
	$patologiaid_tipo3 = 'N'; 
  }
}else{
	$patologiaid_tipo3 = '';
}

if($nivel==1){
	$respuesta1 = $referencia_recibidade;
	$respuesta2 = "";
	$referencia_mayor = "";
}else if($nivel==2){
	$respuesta2 = $referencia_recibidade;
	$respuesta1 = "";
	$referencia_mayor = "";
}else if($nivel==3){
	$respuesta2 = "";
	$respuesta1 = "";
	$referencia_mayor = $referencia_recibidade;
}else{
	$respuesta1 = "";
	$respuesta2 = "";
    $referencia_mayor = "";	
}

/*********************************************************************************/
//VERIFICAMOS SI SE HA GUARDADO EL REGISTRO EN EL ATA
$registro_guardado = "SELECT ata_id 
   FROM ata AS a
   INNER JOIN colaboradores AS c
   ON a.colaborador_id = c.colaborador_id
   WHERE a.colaborador_id = '$usuario' AND a.expediente = '$expediente' AND a.fecha = '$fecha' AND a.servicio_id = '$servicio'";
$result = $mysqli->query($registro_guardado);   
$registro_guardado2 = $result->num_rows;
		  
if($expediente==0 || $servicio == 0){
	echo 3;
}else{
  if ($consulta_depto2==0){
     echo 1;
  }else {
	if($registro_guardado2 == 0){		  
	     $insert = "INSERT INTO ata 
		      VALUES('$numero','$colaborador_id','$expediente', '$anos', '$meses', '$dias', '$departamento_id', 
		      '$municipio_id', '$localidades', '$paciente', '$patologia_id1', '$patologiaid_tipo1', '$patologia_id2', '$patologiaid_tipo2', 
			  '$patologia_id3', '$patologiaid_tipo3', '$servicio', '$referencia_enviadaa', '$referencia_recibidade', '$fecha', 
			  '$referencia_mayor', '$respuesta1', '$respuesta2','','$porta_referencia','$observaciones','$enfermedad','$tipo_atencion', '$cantidad_tipo_atencion',
			  '$nivel_socioeconomico','$problema_social','$motivo_traslado','$fecha_registro')";
         $mysqli->query($insert);	

        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado = "Agregar";
        $observacion_historial = "Se almacena el ATA del usuario";
        $modulo = "ATA";
        $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
        $mysqli->query($insert);
        /*****************************************************/			 
			  
   	  /******************************************************/
      //AGREGAR DATOS DE ASEGURADO
      //OBTENER CORRELATIVO
      $correlativo_asegurado= "SELECT MAX(ata_id) AS max, COUNT(ata_id) AS count 
	     FROM ata";
	  $result = $mysqli->query($correlativo_asegurado);
      $correlativo_asegurado2 = $result->fetch_assoc();
 
      $numero_asegurado = $correlativo_asegurado2['max'];
      $cantidad_asegurado = $correlativo_asegurado2['count'];

      if ( $cantidad_asegurado == 0 )
	     $numero_asegurado = 1;
      else
         $numero_asegurado = $numero_asegurado + 1;	
   
      if($asegurado!=""){
		  $insert = "INSERT INTO asegurado 
		     VALUES('$numero_asegurado','$expediente','$fecha','$servicio','$colaborador_id','$asegurado','$paciente')";
		  $mysqli->query($insert);
		  
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado = "Agregar";
        $observacion_historial = "Se ha registrado el usuario en la entidad asegurados";
        $modulo = "Asegurado";
        $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_asegurado','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
        $mysqli->query($insert);
        /*****************************************************/			  
	  }
      /******************************************************/	
	
		  $update = "UPDATE agenda 
		         SET status = 1 
				 WHERE expediente = '$expediente' AND cast(fecha_cita as date) = '$fecha' AND colaborador_id = '$colaborador_id'";	
		  $mysqli->query($update);
        //ACTUALIZAMOS DATOS DEL USUARIO	
		
	//TRANSITO
	//RECIBIDAS
	if($transito_servicio_recibida != "" && $transito_unidad_recibida != ""){
		//CONSULTAR REGISTRO
        $consultar_registro = "SELECT transito_id 
		    FROM transito_recibida 
            WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio' AND colaborador_id = '$colaborador_id'"; 
		$result = $mysqli->query($consultar_registro);
			
		if($result->num_rows==0){
           //OBTENER CORRELATIVO
           $correlativo_transito_recibida = "SELECT MAX(transito_id) AS max, COUNT(transito_id) AS count 
		      FROM transito_recibida";
		   $result = $mysqli->query($correlativo_transito_recibida);
           $correlativo_transito_recibida2 = $result->fetch_assoc();

           $numero_transito_recibida = $correlativo_transito_recibida2['max'];
           $cantidad_transito_recibida = $correlativo_transito_recibida2['count'];	
	   
           if ( $cantidad_transito_recibida == 0 )
	         $numero_transito_recibida = 1;
           else
              $numero_transito_recibida = $numero_transito_recibida + 1;	   	      	     
  	        
		    if($numero != 0 && $servicio != 0 && $departamento_id != 0 && $municipio_id != 0 && $colaborador_id != 0){
			   $insert = "INSERT INTO transito_recibida 
			       VALUES('$numero_transito_recibida','$fecha','$numero','$expediente','$colaborador_id', '$anos', '$paciente','$departamento_id','$municipio_id','$transito_servicio_recibida','$transito_unidad_recibida','$servicio','$transito_motivo_recibida','$fecha_registro')";
               $mysqli->query($insert);	

               //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
               $historial_numero = historial();
               $estado = "Agregar";
               $observacion_historial = "Se ha registrado el transito para este usuario";
               $modulo = "Transito Recibida";
               $insert = "INSERT INTO historial 
                    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_transito_recibida','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
               $mysqli->query($insert);
               /*****************************************************/				   
			}             
		}	 	   
	}
	
	//ENVIADAS
	if($transito_servicio_enviada != "" && $transito_unidad_enviada != ""){
		//CONSULTAR REGISTRO
        $consultar_registro = "SELECT transito_id 
		   FROM transito_enviada 
           WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio' AND colaborador_id = '$colaborador_id'";
        $result = $mysqli->query($consultar_registro);		   
	   
	   if($result->num_rows==0){
          //OBTENER CORRELATIVO
          $correlativo_transito_enviada = "SELECT MAX(transito_id) AS max, COUNT(transito_id) AS count 
		     FROM transito_enviada";
		  $result = $mysqli->query($correlativo_transito_enviada);
          $correlativo_transito_enviada2 = $result->fetch_assoc();

          $numero_transito_enviada = $correlativo_transito_enviada2['max'];
          $cantidad_transito_enviada = $correlativo_transito_enviada2['count'];	
	   
          if ( $cantidad_transito_enviada == 0 )
	         $numero_transito_enviada = 1;
          else
            $numero_transito_enviada = $numero_transito_enviada + 1;
		
  	      if($numero != 0 && $servicio != 0 && $departamento_id != 0 && $municipio_id != 0 && $colaborador_id != 0){
 			  $insert = "INSERT INTO transito_enviada 
			      VALUES('$numero_transito_enviada','$fecha','$numero','$expediente','$colaborador_id', '$anos', '$paciente','$departamento_id','$municipio_id','$transito_servicio_enviada','$transito_unidad_enviada','$servicio','$transito_motivo_enviada','$fecha_registro')";
              $mysqli->query($insert);	

               //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
               $historial_numero = historial();
               $estado = "Agregar";
               $observacion_historial = "Se ha registrado el transito para este usuario";
               $modulo = "Transito Enviada";
               $insert = "INSERT INTO historial 
                    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_transito_enviada','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
               $mysqli->query($insert);
               /*****************************************************/				  
		  }   

		  if($transito_servicio_enviada == 8 && $profesional_transito_enviada != 0){
		      $fecha_registro = date("Y-m-d H:i:s");
		      $fecha_cita = date("Y-m-d H:i:s", strtotime($fecha));
				   
		      //CONSULTAMOS SI EL USUARIO ES NUEVO EN EL SERVICIO
	          $consultar_expediente = "SELECT a.agenda_id 
			      FROM agenda AS a 
                  INNER JOIN colaboradores AS c
                  ON a.colaborador_id = c.colaborador_id
				  WHERE a.pacientes_id = '$pacientes_id' AND c.puesto_id = '$transito_unidad_enviada' AND a.servicio_id = '$transito_servicio_enviada' AND a.status = 1";
			  $result = $mysqli->query($consultar_expediente);

              $consultar_expediente1 = $result->fetch_assoc(); 
		  
		      if ($consultar_expediente1['agenda_id']== ""){
			     $paciente = 'N';
				 $color = '#008000'; //VERDE;
		      }else{ 
			     $paciente = 'S';
				 $color = '#0071c5'; //AZUL;
		      }			  
		      
			  //CORRELATIVO AGENDA
	          $correlativo= "SELECT MAX(agenda_id) AS max, COUNT(agenda_id) AS count 
			     FROM agenda";
			  $result = $mysqli->query($correlativo);
              $correlativo2 = $result->fetch_assoc();

              $numero_agenda = $correlativo2['max'];
              $cantidad_agenda = $correlativo2['count'];

              if ( $cantidad_agenda == 0 )
	             $numero_agenda = 1;
              else
                 $numero_agenda = $numero_agenda + 1;
		
			  $hora = date("H:i", strtotime('00:00'));
			  
			  if($tipo_atencion_trabajosocial == "" && $transito_motivo_enviada != ""){
				  $observacion = "Usuario enviado a Trabajo social. ".$transito_motivo_enviada;  
			  }
			  
			  if($tipo_atencion_trabajosocial != "" && $transito_motivo_enviada == ""){
				  //CONSULTAR TIPO DE ATENCION
				  $consulta_tipo_atencion = "SELECT nombre 
				     FROM tipos_atencion 
					 WHERE tipos_atencion_id = '$tipo_atencion_trabajosocial'";
				  $result = $mysqli->query($consulta_tipo_atencion);
                  $consulta_tipo_atencion1 = $result->fetch_assoc();
                  $consulta_tipo_atencion_nombre = $consulta_tipo_atencion1['nombre'];				  
				  $observacion = "Usuario enviado a Trabajo social. Tipo de Atención: ".$consulta_tipo_atencion_nombre.".";  
			  }
			  
			  if($tipo_atencion_trabajosocial != "" && $transito_motivo_enviada != ""){
				  //CONSULTAR TIPO DE ATENCION
				  $consulta_tipo_atencion = "SELECT nombre 
				     FROM tipos_atencion 
					 WHERE tipos_atencion_id = '$tipo_atencion_trabajosocial'";
				  $result = $mysqli->query($consulta_tipo_atencion);
                  $consulta_tipo_atencion1 = $result->fetch_assoc();
                  $consulta_tipo_atencion_nombre = $consulta_tipo_atencion1['nombre'];				  
				  $observacion = "Usuario enviado a Trabajo social. ".$transito_motivo_enviada.". Tipo de Atención: ".$consulta_tipo_atencion_nombre.".";  
			  }			  
			  			
	          //CONSULTAR AGENDA SI HAY VALORES
              $consultar_agenda = "SELECT a.agenda_id 
			       FROM agenda AS a
				   INNER JOIN colaboradores AS c
				   ON a.colaborador_id = c.colaborador_id
			       WHERE a.expediente = '$expediente' AND cast(a.fecha_cita AS DATE) = '$fecha_cita' AND c.puesto_id = '$transito_unidad_enviada' AND a.servicio_id = '$transito_servicio_enviada'";
			  $result = $mysqli->query($consultar_agenda);
				   				   
              $consultar_agenda1 = $result->fetch_assoc();
              $agenda_id = $consultar_agenda1['agenda_id'];
				   
			  //AGREGAMOS LOS DATOS EN LA AGENDA PARA TRABAJO SOCIAL*/
			  if($agenda_id == ""){			 
                 $insert = "INSERT INTO agenda VALUES('$numero_agenda', '$pacientes_id', '$expediente', '$profesional_transito_enviada', '$hora', 
			          '$fecha_cita', '$fecha_cita', '$fecha_registro', '0', '$color', '$observacion','$colaborador_id','$transito_servicio_enviada',
				      '','0','0','2','$paciente','0')";
                 $mysqli->query($insert);

               //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
               $historial_numero = historial();
               $estado = "Agregar";
               $observacion_historial = "Se ha agregado este registro para Trabajo Social";
               $modulo = "Agenda";
               $insert = "INSERT INTO historial 
                    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
               $mysqli->query($insert);
               /*****************************************************/					 
			  }				  
		  }  
	   }	   
	}			

	//REFERENCIAS RECIBIDAS
	if($nivel != 0){
         //CONSULTAR REGISTRO
         $consultar_registro = "SELECT referenciar_id 
		 FROM referencia_recibida 
         WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio' AND colaborador_id = '$colaborador_id'"; 
		 $result = $mysqli->query($consultar_registro);
	   
       if($result->num_rows==0){
           //OBTENER CORRELATIVO
           $correlativo_referencia_recibida = "SELECT MAX(referenciar_id) AS max, COUNT(referenciar_id) AS count 
		      FROM referencia_recibida";
		   $result = $mysqli->query($correlativo_referencia_recibida);
           $correlativo_referencia_recibida2 = $result->fetch_assoc();
 
          $numero_referencia_recibida = $correlativo_referencia_recibida2['max'];
          $cantidad_referencia_recibida = $correlativo_referencia_recibida2['count'];

          if ( $cantidad_referencia_recibida == 0 )
	         $numero_referencia_recibida = 1;
          else
             $numero_referencia_recibida = $numero_referencia_recibida + 1; 	   
      	  if($nivel != 0 && $centro != 0 && $centroi != 0 && $numero != 0 && $patologia_id1 != 0 && $servicio != 0 && $colaborador_id != 0 && $motivo != 0 && $motivo_ref_recibida != 0){	     
             $insert = "INSERT INTO referencia_recibida 
			    VALUES('$numero_referencia_recibida','$numero','$fecha','$expediente','$anos','$patologia_id1', '$clinico1', '$servicio','$colaborador_id','$motivo_referencia_recibida','$centroi','Sí','$centroi','$nivel','$centro','$colaborador_id','$fecha_registro','$motivo','$motivo_ref_recibida')";
             $mysqli->query($insert);	

             //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
             $historial_numero = historial();
             $estado = "Agregar";
             $observacion_historial = "Se ha agregado la referencia para este usuario";
             $modulo = "Referencias Recibidas";
             $insert = "INSERT INTO historial 
                   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_referencia_recibida','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
             /*****************************************************/				 
		  }
	   }	   
	}
	
		
	//REFERENCIAS ENVIADAS
	if($nivel_e != 0){	
       //CONSULTAR REGISTRO
       $consultar_registro = "SELECT referenciar_id 
	        FROM referencia_enviada 
            WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio' AND colaborador_id = '$colaborador_id' AND unidad_envia = '$centroi_e'";
	   $result = $mysqli->query($consultar_registro);

      if($result->num_rows==0){
         //OBTENER CORRELATIVO
         $correlativo_referencia_enviada = "SELECT MAX(referenciar_id) AS max, COUNT(referenciar_id) AS count 
		    FROM referencia_enviada";
		 $result = $mysqli->query($correlativo_referencia_enviada);
         $correlativo_referencia_enviada2 = $result->fetch_assoc();

         $numero_referencia_enviada = $correlativo_referencia_enviada2['max'];
         $cantidad_referencia_enviada = $correlativo_referencia_enviada2['count'];

         if ( $cantidad_referencia_enviada == 0 )
	         $numero_referencia_enviada = 1;
         else
             $numero_referencia_enviada = $numero_referencia_enviada + 1; 	
		 
   	   	 if($centroi_e != 0 && $nivel_e != 0 && $centro_e != 0 && $numero != 0 && $patologia_id1 != 0 && $servicio != 0 && $colaborador_id != 0 && $motivo_traslado != 0 && $motivo_traslado_otro != 0){
			$insert = "INSERT INTO referencia_enviada 
			    VALUES('$numero_referencia_enviada','$numero','$fecha','$expediente','$anos','$clinico','$patologia_id1','$patologia_id2','$patologia_id3','$servicio','$colaborador_id','$motivo_referencia_enviada','$centroi_e','$nivel_e','$centro_e','No','$colaborador_id','$fecha_registro', '$motivo_traslado', '$motivo_traslado_otro')";
            $mysqli->query($insert);

             //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
             $historial_numero = historial();
             $estado = "Agregar";
             $observacion_historial = "Se ha agregado la referencia para este usuario";
             $modulo = "Referencias Enviadas";
             $insert = "INSERT INTO historial 
                   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_referencia_enviada','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
             /*****************************************************/			
		 }          
	  }							  
	}	

     //ALMACENAR VALORES DE USUARIOS SUICIDAS
     if($suicida !=0 && $colaborador_id != 0 && $servicio != 0 && $expediente != 0 && $pacientes_id != 0){
		  //OBTENER CORRELATIVO
          $correlativo_suicida = "SELECT MAX(suicida_id) AS max, COUNT(suicida_id) AS count 
		     FROM suicida";
		  $result = $mysqli->query($correlativo_suicida);
          $correlativo_suicida2 = $result->fetch_assoc();

          $numero_suicida = $correlativo_suicida2['max'];
          $cantidad_suicida = $correlativo_suicida2['count'];

          if ( $cantidad_suicida == 0 )
	         $numero_suicida = 1;
          else
             $numero_suicida = $numero_suicida + 1; 
		 
		 
		  $insert = "INSERT INTO suicida 
		     VALUES('$numero_suicida','$pacientes_id','$expediente','$colaborador_id','$servicio','$suicida','$fecha','$fecha_registro','$paciente')";
		  $mysqli->query($insert);
		  
          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
          $historial_numero = historial();
          $estado = "Agregar";
          $observacion_historial = "Se ha agregado registro a los reportes de suicidios";
          $modulo = "Suicida";
          $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_suicida','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
          $mysqli->query($insert);
          /*****************************************************/			  		 
	 }	 
	
	//USUARIOS CRONICOS
	if($user_cronico == 1 || $user_cronico == 2){
         //OBTENER CORRELATIVO
         $correlativo_cronico = "SELECT MAX(user_cronico_id) AS max, COUNT(user_cronico_id) AS count 
		    FROM user_cronico";
		 $result = $mysqli->query($correlativo_cronico);
         $correlativo_cronico2 = $result->fetch_assoc();

         $numero_cronico = $correlativo_cronico2['max'];
         $cantidad_cronico = $correlativo_cronico2['count'];

         if ( $cantidad_cronico == 0 )
	         $numero_cronico = 1;
         else
             $numero_cronico = $numero_cronico + 1; 
		 
		 if($pacientes_id != 0 && $expediente != 0 && $colaborador_id != 0 && $servicio != 0){
            //EVALUAR EXISTENCIA USUARIO ATA
            $consulta = "SELECT user_cronico_id 
			     FROM user_cronico 
				 WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio' AND fecha = '$fecha'";
            $result = $mysqli->query($consulta);				 

            $consulta2 = $result->fetch_assoc();

            $user_cronico_id = $consulta2['user_cronico_id'];	
            if($user_cronico_id == ""){
			    $insert = "INSERT INTO user_cronico 
				   VALUES('$numero_cronico','$pacientes_id','$expediente','$colaborador_id','$servicio','$paciente','$user_cronico','$fecha','$fecha_registro')";
                $mysqli->query($insert);

                //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                $historial_numero = historial();
                $estado = "Agregar";
                $observacion_historial = "Se ha agregado registro a los reportes de usuarios cronicos";
                $modulo = "Cronicos";
                $insert = "INSERT INTO historial 
                    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_cronico','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
               $mysqli->query($insert);
               /*****************************************************/				
			}			
		 }
	}
	// FIN USUARIOS CRONICOS
	
	//INICIO ALMACENAR EN PROGRAMAR CITA A USUAR
	if($programar_cita != 0){
		//VERIFICAMOS SI NO EXISTE EL REGISTRO
		$query_programar = "SELECT programar_cita_id
			FROM programar_cita
			WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio' AND fecha_cita = '$fecha'";
		$result_programar_cita = $mysqli->query($query_programar);
			
		if($result_programar_cita->num_rows == 0){
			$numero_atenciones_programar_cita = correlativo("programar_cita_id", "programar_cita");		
			$insert_programar_cita = "INSERT INTO programar_cita 
				VALUES ('$numero_atenciones_programar_cita', '$pacientes_id', '$expediente', '$colaborador_id', '$servicio', '$fecha', '$programar_cita', '$programar_cita_comentario', '$usuario', '$paciente', '$fecha_registro')";
				
			$mysqli->query($insert_programar_cita);				
		}	
	}
	//FIN ALMACENAR EN PROGRAMAR CITA A USUAR

	//CONSULTAMOS QUE NO EXISTA EL REGISTRO EN LA ENTIDAD COLA
	$query_cola = "SELECT colas_id
		FROM colas
		WHERE pacientes_id = '$pacientes_id' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio'";
	$result_cola = $mysqli->query($query_cola);

	if($result_cola->num_rows==0){
		$colas_id = correlativo('colas_id', 'colas');
		$cola_numero = correlativo_diario($servicio);
		$horai = date("H:m:s");
		$horaf = 'Sin registro';
		
		//CONSULTAMOS EL CAMPO receta_id EN LA ENTIDAD receta
		$query_receta = "SELECT receta_id
			FROM receta
			WHERE pacientes_id = '$pacientes_id' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio'";
		$result_receta = $mysqli->query($query_receta);
		
		$receta_id = 0;
		
		if($result_receta->num_rows>0){
			$consulta_receta = $result_receta->fetch_assoc();
			$receta_id = $consulta_receta['receta_id'];
		}
		
		//CONSULTAMOS EL CAMPO programar_cita_id EN LA ENTIDAD programar_cita
		$query_programar = "SELECT programar_cita_id
			FROM programar_cita
			WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio'";
		$result_programar = $mysqli->query($query_programar);
		
		$programar_cita_id = 0;
		
		if($result_programar->num_rows>0){
			$consulta_programar = $result_programar->fetch_assoc();
			$programar_cita_id = $consulta_programar['programar_cita_id'];
		}
		
		//CONSULTAMOS EL CAMPO transito_id EN LA ENTIDAD transito_enviada
		$query_transito = "SELECT transito_id	
			FROM transito_enviada
			WHERE expediente = '$expediente' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio'";
		$result_transito = $mysqli->query($query_transito);
		
		$transito_id = 0;
		
		if($result_transito->num_rows>0){
			$consulta_transito = $result_transito->fetch_assoc();
			$transito_id = $consulta_transito['transito_id'];
		}
		
		$admision = 1;//1. Visible 2. Oculto
		$farmacia = 2; //1. Visible 2. Oculto
		
		$insert = "INSERT INTO colas 
			VALUES('$colas_id','$cola_numero','$pacientes_id','$fecha','$horai','$horaf','$colaborador_id','$servicio','$receta_id','$programar_cita_id','$transito_id','$admision','$farmacia','$fecha_registro')";
		$mysqli->query($insert);			
	}	
		
    echo 2;	//Registro se ha guardado correctamente	
  }else{
	  echo 3;
  }
 }
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
