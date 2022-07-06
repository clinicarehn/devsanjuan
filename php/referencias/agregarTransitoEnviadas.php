<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$proceso = $_POST['pro'];
$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$colaborador_id = $_SESSION['colaborador_id'];
$enviada = $_POST['enviada'];
$unidad = $_POST['unidad'];
$servicio = $_POST['servicio'];
$motivo = cleanStringStrtolower($_POST['motivo']);
$año = date("Y", strtotime(date('Y-m-d')));
$fecha_inical = date("Y-m-d", strtotime($año."-01-01"));
$fecha_final = date("Y-m-d", strtotime($año."-12-31"));
$profesional_transito_enviada = $_POST['profesional_enviadas'];
$tipo_atencion_trabajosocial = $_POST['tipo_atencion_enviadas'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

$consultar_expediente = "SELECT expediente, pacientes_id
   FROM pacientes 
   WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

//CONSULTAR PUESTO
$consulta_puesto = "SELECT puesto_id 
   FROM colaboradores 
   WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc();
$puesto_id = $consulta_puesto1['puesto_id'];	  

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(transito_id) AS max, COUNT(transito_id) AS count 
   FROM transito_enviada";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

//CONSULTAR FECHA DE NACIMIENTO
$consulta_nacimiento = "SELECT fecha_nacimiento, departamento_id, municipio_id 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_nacimiento);
$consulta_nacimiento2 =$result->fetch_assoc();;
$fecha_de_nacimiento = $consulta_nacimiento2['fecha_nacimiento'];
$departamento_id = $consulta_nacimiento2['departamento_id'];
$municipio_id = $consulta_nacimiento2['municipio_id'];

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
	
   //CONSULTAR REGISTRO	 
   $consultar_registro = "SELECT t.transito_id 
         FROM transito_enviada AS t
		 INNER JOIN colaboradores AS c
		 ON t.colaborador_id = c.colaborador_id
         WHERE t.expediente = '$expediente' AND t.fecha = '$fecha' AND t.servicio_id = '$servicio' AND t.enviada_a = '$enviada' AND c.puesto_id = '$puesto_id'";
   $result = $mysqli->query($consultar_registro);		 

   if($result->num_rows>0){
	   echo 2; //REGISTRO YA EXISTE
   }else{
	   //CONSULTAR ATA ID
	   $consultar_ata = "SELECT a.ata_id 
	         FROM ata AS a
			 INNER JOIN colaboradores AS c
			 ON a.colaborador_id = c.colaborador_id
	         WHERE c.puesto_id = '$puesto_id' AND a.expediente = '$expediente' AND a.fecha = '$fecha' AND a.servicio_id = '$enviada'";
	   $result = $mysqli->query($consultar_ata);
	   
	   if($result->num_rows>0){//SI REGISTRO FUE ENCONTRADO, SE ALMACENA EL ATA_ID
		  $consultar_ata2 = $result->fetch_assoc(); 
		  $ata_id = $consultar_ata2['ata_id'];
	   }else{//DE LO CONTRARIO SE GUARDA EN CERO
		  $ata_id = 0;
	   }
	   	   
       //CONSULTA EN LA ENTIDAD ATA
       $valores = "SELECT a.ata_id
          FROM ata AS a
          INNER JOIN colaboradores AS c
          ON a.colaborador_id = c.colaborador_id
          WHERE a.expediente = '$expediente' AND a.fecha BETWEEN '$fecha_inical' AND '$fecha_final' AND a.servicio_id = '$enviada' AND c.puesto_id = '$puesto_id'";
	  $result = $mysqli->query($valores);
	 
      $valores2 = $result->fetch_assoc();

      if($result->num_rows>0){
	     $paciente = "S";
      }else{
	     $paciente = "N";	
      }		
	 
	   if($ata_id != 0 && $servicio != 0 && $expediente != 0 && $colaborador_id != 0 && $departamento_id != 0 && $municipio_id != 0){
		   $insert = "INSERT INTO transito_enviada VALUES('$numero', '$fecha', '$ata_id', '$expediente', '$colaborador_id', '$anos', '$paciente', '$departamento_id', '$municipio_id', '$enviada', '$unidad', '$servicio', '$motivo','$fecha_registro')";
		   $mysqli->query($insert);
		   
           //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado = "Agregar";
           $observacion = "Se ha agregado el transito para este usuario";
           $modulo = "Transito Enviada";
           $insert = "INSERT INTO historial 
               VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
           $mysqli->query($insert);
           /*****************************************************/			   
		    
		   if($enviada == 8 && $profesional_transito_enviada != 0){
		      $fecha_registro = date("Y-m-d H:i:s");
		      $fecha_cita = date("Y-m-d H:i:s", strtotime($fecha));
				   
		      //CONSULTAMOS SI EL USUARIO ES NUEVO EN EL SERVICIO
	          $consultar_expediente = "SELECT a.agenda_id 
			      FROM agenda AS a
                  INNER JOIN colaboradores AS c
                  ON a.colaborador_id = c.colaborador_id				  
				  WHERE a.pacientes_id = '$pacientes_id' AND a.servicio_id = '$enviada' AND c.puesto_id = '$puesto_id' AND status = 1";
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

			  if($tipo_atencion_trabajosocial == "" && $motivo != ""){
				  $observacion = "Usuario enviado a Trabajo social. ".$motivo;  
			  }
			  
			  if($tipo_atencion_trabajosocial != "" && $motivo == ""){
				  //CONSULTAR TIPO DE ATENCION
				  $consulta_tipo_atencion = "SELECT nombre 
				      FROM tipos_atencion 
					  WHERE tipos_atencion_id = '$tipo_atencion_trabajosocial'";
				  $result = $mysqli->query($consulta_tipo_atencion);
                  $consulta_tipo_atencion1 = $result->fetch_assoc();
                  $consulta_tipo_atencion_nombre = $consulta_tipo_atencion1['nombre'];				  
				  $observacion = "Usuario enviado a Trabajo social. Tipo de Atención: ".$consulta_tipo_atencion_nombre.".";  
			  }
			  
			  if($tipo_atencion_trabajosocial != "" && $motivo != ""){
				  //CONSULTAR TIPO DE ATENCION
				  $consulta_tipo_atencion = "SELECT nombre 
				       FROM tipos_atencion 
					   WHERE tipos_atencion_id = '$tipo_atencion_trabajosocial'";
				  $result = $mysqli->query($consulta_tipo_atencion);
                  $consulta_tipo_atencion1 = $result->fetch_assoc();
                  $consulta_tipo_atencion_nombre = $consulta_tipo_atencion1['nombre'];				  
				  $observacion = "Usuario enviado a Trabajo social. ".$motivo.". Tipo de Atención: ".$consulta_tipo_atencion_nombre.".";  
			  }				  
			  			
	          //CONSULTAR AGENDA SI HAY VALORES
              $consultar_agenda = "SELECT agenda_id 
			       FROM agenda AS a
				   INNER JOIN colaboradores AS c
				   ON a.colaborador_id = c.colaborador_id
			       WHERE a.expediente = '$expediente' AND cast(a.fecha_cita AS DATE) = '$fecha_cita' AND c.colaborador_id = '$profesional_transito_enviada' AND a.servicio_id = '$enviada'";
			  $result = $mysqli->query($consultar_agenda);
              $consultar_agenda1 = $result->fetch_assoc();
              $agenda_id = $consultar_agenda1['agenda_id'];
			  
			  //AGREGAMOS LOS DATOS EN LA AGENDA PARA TRABAJO SOCIAL*/
			  if($agenda_id == ""){
                  $insert = "INSERT INTO agenda 
				     VALUES('$numero_agenda', '$pacientes_id', '$expediente', '$profesional_transito_enviada', '$hora', 
			          '$fecha_cita', '$fecha_cita', '$fecha_registro', '0', '$color', '$observacion','$colaborador_id','$enviada',
			          '','0','0','2','$paciente','0')";
                  $mysqli->query($insert);	

                  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                  $historial_numero = historial();
                  $estado = "Agregar";
                  $observacion = "Se ha agregado este usuario en la agenda de Trabajo Social";
                  $modulo = "Agenda";
                  $insert = "INSERT INTO historial 
                       VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$profesional_transito_enviada','$enviada','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
                  $mysqli->query($insert);
                  /*****************************************************/					  
			  }			  
		    }  
	   }
       echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
   }  
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>