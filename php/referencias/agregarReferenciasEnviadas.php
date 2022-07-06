<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$proceso = $_POST['pro'];
$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$clinico = cleanStringStrtolower($_POST['diagnostico']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

$consultar_expediente = "SELECT expediente, pacientes_id 
      FROM pacientes 
	  WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";  
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

if(isset($_POST['motivo_traslado'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['motivo_traslado'] == ""){
		$motivo_traslado = 0;
	}else{
	    $motivo_traslado = $_POST['motivo_traslado'];		
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

if(isset($_POST['motivo'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['motivo'] == ""){
		$motivo_traslado_otro = 0;
	}else{
	    $motivo_traslado_otro = $_POST['motivo'];		
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

if(isset($_POST['patologia1'])){	
	if($_POST['patologia1'] == ""){
		$patologia1 = 0;
	}else{
		$patologia1 = $_POST['patologia1'];
	}
}else{
	$patologia1 = 0;
}

if(isset($_POST['patologia2'])){
	if($_POST['patologia2'] == ""){
		$patologia2 = 0;
	}else{
		$patologia2 = $_POST['patologia2'];
	}
}else{
	$patologia2 = 0;
}

if(isset($_POST['patologia3'])){
	if($_POST['patologia3'] == ""){
		$patologia3 = 0;
	}else{
		$patologia3 = $_POST['patologia3'];
	}
}else{
	$patologia3 = 0;
}

$servicio = $_POST['servicio'];
$medico = $_POST['medico_general'];
$unidad = $_POST['unidad'];
$motivo = cleanStringStrtolower($_POST['motivo']);
$enviada = $_POST['enviadaa'];
$nivel = $_POST['centros_nivel'];
$centro = $_POST['centro'];
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR PUESTO
$consulta_puesto = "SELECT puesto_id 
   FROM colaboradores WHERE colaborador_id = '$medico'";
$result = $mysqli->query($consulta_puesto);   
$consulta_puesto1 = $result->fetch_assoc();
$puesto_id = $consulta_puesto1['puesto_id'];	

//CONSULTAR EXISTENCIA DE ATENCIONES
$consultar_existencia = "SELECT ata_id, enviadaa 
    FROM ata 
	WHERE expediente = '$expediente' AND fecha = '$fecha' AND colaborador_id = '$medico' AND servicio_id = '$servicio'";
$result = $mysqli->query($consultar_existencia);
$consultar_existencia2 = $result->fetch_assoc();
$consulta_existencia_ata_id = $consultar_existencia2['ata_id'];
$consulta_existencia_enviadaa = $consultar_existencia2['enviadaa'];

$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(referenciar_id) AS max, COUNT(referenciar_id) AS count 
  FROM referencia_enviada";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

//CONSULTAR FECHA DE NACIMIENTO
$consulta_nacimiento = "SELECT fecha_nacimiento 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_nacimiento);
$consulta_nacimiento2 = $result->fetch_assoc();
$fecha_de_nacimiento = $consulta_nacimiento2['fecha_nacimiento'];

/*********************************************************************************/
//CONSULTA AÑO, MES y DIA DEL PACIENTE
$nacimiento = "SELECT fecha_nacimiento AS fecha 
	FROM pacientes 
	WHERE expediente = '$expediente'";
$result = $mysqli->query($nacimiento);
$nacimiento2 = $result->fetch_assoc();
$fecha_nacimiento = $nacimiento2['fecha'];

$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/
	
//VERIFICAMOS EL PROCESO

if ($proceso = 'Registro'){
 if($servicio == 3 || $servicio == 4 ){
      //OBTENER NOMBRE
      $consulta_repuesta_enviada = "SELECT centro_nombre 
	     FROM centros_hospitalarios 
		 WHERE centros_id = '$enviada'";
	  $result = $mysqli->query($consulta_repuesta_enviada);
      $consulta_repuesta_enviada2 = $result->fetch_assoc();
      $referencia_enviadaa = $consulta_repuesta_enviada2['centro_nombre'];
	   
	  if($consulta_existencia_enviadaa != ""){
		  $referencia_enviadaa = $referencia_enviadaa.", ".$consulta_existencia_enviadaa;
  	  }	 
      
      //CONUSLTAMOS EL ATA_ID DEL USUARIO  
	  
      $cosulta_ata = "SELECT ata_id 
           FROM ata AS a
           INNER JOIN colaboradores AS c
           ON a.colaborador_id = c.colaborador_id
           WHERE a.expediente = '$expediente' AND a.servicio_id = '$servicio' AND a.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND c.puesto_id = '$unidad'";  
      $result = $mysqli->query($cosulta_ata);		   

      $cosulta_ata2 = $result->fetch_assoc();
      $ata_id_consulta = $cosulta_ata2['ata_id'];
	  
	  if($ata_id_consulta != ""){
	     //MODIFICAMOS LOS VALORES EN LA REFERENCIA ENVIADA
	      $update = "UPDATE ata SET enviadaa = '$referencia_enviadaa' 
		      WHERE ata_id = '$ata_id_consulta'";	
          $mysqli->query($update);
		  
          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
          $historial_numero = historial();
          $estado = "Actualizar";
          $observacion = "Se ha actualizado la referencia enviada en el ATA del usuario desde Referencias Enviadas";
          $modulo = "ATA";
          $insert = "INSERT INTO historial 
              VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
          $mysqli->query($insert);
          /*****************************************************/			  
				
         if($enviada != 0 && $nivel != 0 && $centro != 0 && $ata_id_consulta != 0 && $motivo_traslado != 0 && $motivo_traslado_otro  != 0){
		     if($motivo_traslado != 0){
			    $update = "UPDATE ata SET motivo_traslado_id = '$motivo_traslado' 
				    WHERE ata_id = '$ata_id_consulta'"; 
				$mysqli->query($update);
				
               //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
               $historial_numero = historial();
               $estado = "Actualizar";
               $observacion = "Se ha agregado una motivo de traslado en la referencia enviada";
               $modulo = "Referencia Enviada";
               $insert = "INSERT INTO historial 
                  VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
               $mysqli->query($insert);
               /*****************************************************/				
		     }
		  
		     $insert = "INSERT INTO referencia_enviada 
			    VALUES('$numero', '$ata_id_consulta', '$fecha', '$expediente', '$anos','$clinico', '$patologia1', '$patologia2', '$patologia3', '$servicio', '$medico', '$motivo_referencia_enviada', '$enviada', '$nivel', '$centro', 'No','$medico','$fecha_registro', '$motivo_traslado', '$motivo_traslado_otro')";	   	 
			 
			 $query = $mysqli->query($insert);
			 
             //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
             $historial_numero = historial();
             $estado = "Agregar";
             $observacion = "Se ha agregado una nueva referencia enviada";
             $modulo = "Referencia Enviada";
             $insert = "INSERT INTO historial 
               VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
             /*****************************************************/				 
			 
	         if($query){
		        echo 1;//REGISTRO ALMACENADO CORRECTAMENTE   
	         }else{
   		        echo 3;//EL REGISTRO NO SE PUEDO ALMACENAR 
	        }  			 
		 }else{
			 echo 4; //ERROR AL INTENTAR GUARDAR EL REGISTRO EL CENTRO DE PROCEDENCIA NO DEBE QUEDAR EN BLANCO O SER CERO
		 }		  
	  }else{
		    echo 2;////NO EXISTEN ATENCIONES DEL USUARIO
	  }	  	  
 }else{	
    if($consulta_existencia_ata_id != ""){	  		  
         //OBTENER NOMBRE
         $consulta_repuesta_enviada = "SELECT centro_nombre 
		     FROM centros_hospitalarios 
			 WHERE centros_id = '$enviada'";
		 $result = $mysqli->query($consulta_repuesta_enviada);
         $consulta_repuesta_enviada2 = $result->fetch_assoc();
         $referencia_enviadaa = $consulta_repuesta_enviada2['centro_nombre'];
	   
	     if($consulta_existencia_enviadaa != ""){
		    $referencia_enviadaa = $referencia_enviadaa.", ".$consulta_existencia_enviadaa;
	     }
		  
	     //MODIFICAMOS LOS VALORES EN LA REFERENCIA ENVIADA
	     $update = "UPDATE ata SET enviadaa = '$referencia_enviadaa' 
		         WHERE ata_id = '$consulta_existencia_ata_id'";
         $mysqli->query($update);				 
	   	     
	     if($enviada != 0 && $nivel != 0 && $centro != 0 && $consulta_existencia_ata_id != 0 && $patologia1 != 0 && $servicio != 0 && $medico != 0 && $motivo_traslado != 0 && $motivo_traslado_otro  != 0){
		     if($motivo_traslado != 0){
			    $update = "UPDATE ata SET motivo_traslado_id = '$motivo_traslado' 
				    WHERE ata_id = '$consulta_existencia_ata_id'"; 
				$mysqli->query($update);
				
                //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                $historial_numero = historial();
                $estado = "Actualizar";
                $observacion = "Se ha agregado una motivo de traslado en la referencia enviada";
                $modulo = "Referencia Enviada";
                $insert = "INSERT INTO historial 
                   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$consulta_existencia_ata_id','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
                $mysqli->query($insert);
                /*****************************************************/					
		     }
			 
			 $insert = "INSERT INTO referencia_enviada 
			    VALUES('$numero', '$consulta_existencia_ata_id', '$fecha', '$expediente', '$anos','$clinico', '$patologia1', '$patologia2', '$patologia3', '$servicio', '$medico', '$motivo_referencia_enviada', '$enviada', '$nivel', '$centro', 'No','$medico','$fecha_registro', '$motivo_traslado', '$motivo_traslado_otro')";
			 $query = $mysqli->query($insert);
			 
             //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
             $historial_numero = historial();
             $estado = "Agregar";
             $observacion = "Se ha agregado una nueva referencia enviada";
             $modulo = "Referencia Enviada";
             $insert = "INSERT INTO historial 
               VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$consulta_existencia_ata_id','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
             /*****************************************************/			 
	     
		     if($query){
		         echo 1;//REGISTRO ALMACENADO CORRECTAMENTE   
	         }else{
		        echo 3;//EL REGISTRO NO SE PUEDO ALMACENAR 
	         }  	   
	    }else{
			echo 4; //ERROR AL INTENTAR GUARDAR EL REGISTRO EL CENTRO DE PROCEDENCIA NO DEBE QUEDAR EN BLANCO O SER CERO
		}
    }else{
	    echo 2;////NO EXISTEN ATENCIONES DEL USUARIO
    }	 
  }  
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>