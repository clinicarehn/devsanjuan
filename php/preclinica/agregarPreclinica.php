<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$proceso = $_POST['pro'];
$id = $_POST['id-registro'];
$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$pa = $_POST['pa'];
$fr = $_POST['fr'];
$fc = $_POST['fc'];
$temperatura = $_POST['temperatura'];
$peso = $_POST['peso'];
$talla = $_POST['talla'];
$servicio = $_POST['servicio'];
$medico = $_POST['medico'];
$glucometria = $_POST['glucometria'];
$fecha_registro = date("Y-m-d H:i:s");
$observaciones = cleanStringStrtolower($_POST['observaciones']);
$usuario = $_SESSION['colaborador_id'];
$postclinica = 0;
$resp = 0;
$fecha_sistema = date("Y-m-d H:i:s");

if($servicio == 7){
	$postclinica = 0;
}else{
	$postclinica = 1;
}

$consultar_expediente = "SELECT expediente 
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];

if(isset($_POST['visita'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	$visita = $_POST['visita'];
}else{
	$visita = "";
}

if($pa == "" && $fr == "" && $fc == "" && $temperatura == "" && $peso == "" && $talla == ""){//SI LOS CAMPOS ESTAN VACIOS VIENE SOLO POR MEDICAMENTO
	$resp = 1;
}else{
	$resp = 0; //VIENE A SE ATENDIDO COMO UN USUARIO EXTEMPORANEOS
}

//CONSULTAR SERVICIO NOMBRE
$consultar_servicio = "SELECT nombre 
   FROM servicios
   WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consultar_servicio);
$consultar_servicio2 = $result->fetch_assoc();
$servicio_name = $consultar_servicio2['nombre'];

//CONSULTAR PACIENTE
$consulta_paciente = "SELECT pacientes_id
    FROM pacientes 
	WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_paciente);
$consulta_paciente2 = $result->fetch_assoc();
$pacientes_id = $consulta_paciente2['pacientes_id'];

//CONSULTAR PUESTO COLABORADOR
$consulta_puesto = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$medico'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc(); 
$puesto_colaborador = $consulta_puesto1['puesto_id'];
			   
//CONSULTAR AGENDA SI HAY VALORES
$consultar_agenda = "SELECT a.agenda_id 
   FROM agenda AS a
   INNER JOIN colaboradores AS c
   ON a.colaborador_id = c.colaborador_id
   WHERE a.expediente = '$expediente' AND cast(a.fecha_cita AS DATE) = '$fecha' AND c.puesto_id = '$puesto_colaborador' AND servicio_id = '$servicio'";
$result = $mysqli->query($consultar_agenda);
     
$consultar_agenda1 = $result->fetch_assoc();
$consultar_agenda2 = $result->num_rows;
$agenda_id = $consultar_agenda1['agenda_id'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(preclinica_id) AS max, COUNT(preclinica_id) AS count 
   FROM preclinica";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;

//CONSULTAMOS EL CORRELATIVO DE EXTEMPORANEOS
 $correlativo_extemporaneo = "SELECT MAX(extem_id) AS max, COUNT(extem_id) AS count 
    FROM extemporaneos";
 $result_correlativo_extemporaneo = $mysqli->query($correlativo_extemporaneo);
 $correlativo_extemporaneo2 = $result_correlativo_extemporaneo->fetch_assoc();
			   
 $numero_extemporaneo = $correlativo_extemporaneo2['max'];
 $cantidad_extemporaneo = $correlativo_extemporaneo2['count'];

if ( $numero_extemporaneo == 0 )
   $numero_extemporaneo = 1;
else
   $numero_extemporaneo = $numero_extemporaneo + 1;

//CONSULTAR EXISTENCIA EXTEMPORANEOS
$consulta_extemporaneo = "SELECT extem_id 
      FROM extemporaneos 
	  WHERE expediente = '$expediente' AND colaborador_id = '$medico' AND servicio_id = '$servicio' AND fecha = '$fecha'";	  
$result_consulta_extemporaneo = $mysqli->query($consulta_extemporaneo);
$extem_id = $result_consulta_extemporaneo->num_rows;	  
	
//CONSULTAR FECHA DE NACIMIENTO
$consulta_nacimiento = "SELECT fecha_nacimiento 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result_consulta_nacimiento = $mysqli->query($consulta_nacimiento);
$consulta_nacimiento2 = $result_consulta_nacimiento->fetch_assoc();
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

//EVALUAMOS LA EDAD DEL PACIENTE
//CONSULTAMOS LA EDAD, LA CUAL SE USARÁ PARA LA AGENDA DEL PACIENTE (BLOQUEO DE EDADES)
$consultar_edad_permitida = "SELECT edad 
   FROM config_edad";
$result = $mysqli->query($consultar_edad_permitida);
$consultar_edad_permitida2 = $result->fetch_assoc();
$edad_permitida = $consultar_edad_permitida2['edad'];


//CONSULTAR PACIENTE EN AGENDA SI ES PRIMERA VEZ O SUBSIGUIENTE

if($expediente >=1 && $expediente < 13000){//Esta condicion de mayor que 1 y menor que trece mil se puede eliminar en un futuro
	$paciente = 'S';
}else{	 
	$consultar_paciente = "SELECT ata_id
         FROM ata
         WHERE expediente = '$expediente' AND servicio_id = '$servicio'";
	$result = $mysqli->query($consultar_paciente);
	
	if($result->num_rows>0){
	   $paciente = 'S';
	}else{
		$paciente = 'N';
	}
}
//VERIFICAMOS EL PROCESO
//CONSULTAR Registro
//CONSULTAMOS QUE EL REGISTRO NO TENGA CITA DESPUES DE LA FECHA ACTUAL
$consulta_fecha_registro = "SELECT agenda_id
   FROM agenda AS a
   INNER JOIN colaboradores AS c
   ON a.colaborador_id = c.colaborador_id
   WHERE a.expediente = '$expediente' AND CAST(a.fecha_cita AS DATE) >= '$fecha' AND a.servicio_id = '$servicio' AND c.puesto_id = '$puesto_colaborador'";
$result_consulta_fecha_registro = $mysqli->query($consulta_fecha_registro);

//CONSULTAMOS SI HAY UNA AUSENCIA DEL USUARIO PARA ESTE DIA
$query_ausencia = "SELECT a.agenda_id AS 'agenda_id'
	FROM agenda AS a
	INNER JOIN colaboradores AS c
	ON a.colaborador_id = c.colaborador_id
	WHERE a.pacientes_id = '$pacientes_id' AND c.puesto_id = '$puesto_colaborador' AND a.servicio_id = '$servicio' AND a.status = 2 AND CAST(a.fecha_cita AS DATE) = '$fecha'";
$result_ausencias = $mysqli->query($query_ausencia);

if($result_ausencias->num_rows==0){
	//if($result_consulta_fecha_registro->num_rows==0){//SI NO TIENE FECHA DESPUES DE LA FECHA ACTUAL, SE PROCEDE A GUARDAR EL REGISTRO COMO EXTEMPORANEO
		if($servicio == 6 && $anos >= $edad_permitida){
			echo 5; //ESTE ES UN USUARIO ADULTO
		}else if($servicio == 1 && $anos < $edad_permitida){
			echo 6; //ESTE ES UN USUARIO NIÑO
		}else{
			if($consultar_agenda2 == 0){//EVALUAMOS SI EXISTE INFORMACION DEL REIGSTRO EN LA AGENDA, DE NO EXISTIR SE PROCEDE A ALMACENAR LOS DATOS
				$consultar_registro = "SELECT p.preclinica_id 
				   FROM preclinica AS p
				   INNER JOIN colaboradores AS c
				   ON p.colaborador_id = c.colaborador_id
				   WHERE p.expediente = '$expediente' AND p.fecha = '$fecha' AND p.servicio_id = '$servicio' AND c.puesto_id = '$puesto_colaborador'"; 
				$result = $mysqli->query($consultar_registro);
				   
				if($result->num_rows>0){//EVALUA QUE EL REGISTRO YA FUE PRECLINEADO EL REGISTRO EXISTE
				   echo 2; //REGISTRO YA EXISTE
				}else{
				   $insert = "INSERT INTO preclinica 
					   VALUES('$numero', '$pacientes_id', '$expediente', '$medico', '$anos', '$fecha', '$pa', '$fr', '$fc', '$temperatura', '$peso', '$talla', '$servicio', '$observaciones', '$usuario','$paciente','$fecha_registro')";    
				   $query = $mysqli->query($insert);

				   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
				   $historial_numero = historial();
				   $estado = "Agregar";
				   $observacion = "Se realizó la preclínica para este usuario";
				   $modulo = "Preclinica";
				   $insert = "INSERT INTO historial 
					   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
				   $mysqli->query($insert);
				   /*****************************************************/	   
					   
				   if($query){	 
					   if ($consultar_agenda2 > 0){//EVALUAMOS EL REGISTRO EN LA AGENDA, EN ESTE CASO EXISTE, SOLO SE ACTUALIZAN ALGUNOS DATOS
						  $update = "UPDATE agenda SET preclinica = '1' 
							 WHERE agenda_id = '$agenda_id' AND CAST(fecha_cita AS DATE) = '$fecha'";
						  $mysqli->query($update);
						  
						  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
						  $historial_numero = historial();
						  $estado = "Actualizar";
						  $observacion = "Se actualiza el campo preclínica en la entidad agenda, desde preclínica";
						  $modulo = "Preclinica";
						  $insert = "INSERT INTO historial 
								VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
						  $mysqli->query($insert);
						  /*****************************************************/	   
					   }else{//DE NO EXISTIR ES AGREGADO EN LA AGENDA PARA SER INGRESADO POSTERIORMENTE POR EL PROFESIONAL
						   $correlativo_agenda = "SELECT MAX(agenda_id) AS max, COUNT(agenda_id) AS count 
							  FROM agenda";
						   $result = $mysqli->query($correlativo_agenda);
						   $correlativo_agenda2 = $result->fetch_assoc();

						   $numero_agenda = $correlativo_agenda2['max'];
						   $cantidad_agenda = $correlativo_agenda2['count'];

						   if ( $cantidad_agenda == 0 )
							  $numero_agenda = 1;
						   else
							  $numero_agenda = $numero_agenda + 1;	

						   //GUARDAR LA GLUCOMETRÍA
						   if($glucometria != "" && $expediente != "" && $medico != "" && $servicio != "" && $numero_agenda != "" && $numero != ""){
							  //OBTENER CORRELATIVO
							  $correlativo_gluco= "SELECT MAX(preclinica_gluco_id) AS max, COUNT(preclinica_gluco_id) AS count 
								 FROM preclinica_gluco";
							  $result = $mysqli->query($correlativo_gluco);
							  $correlativo_gluco2 = $result->fetch_assoc();

							  $numero_gluco = $correlativo_gluco2['max'];
							  $cantidad_gluco = $correlativo_gluco2['count'];

							  if ( $cantidad_gluco == 0 )
								 $numero_gluco = 1;
							   else
								  $numero_gluco = $numero_gluco + 1;			   
											
							   $insert = "INSERT INTO preclinica_gluco 
								  VALUES('$numero_gluco', '$numero', '$numero_agenda','$fecha','$fecha_registro','$expediente','$medico', '$servicio', '$glucometria','$observaciones','$usuario')";
							   $mysqli->query($insert);
							   
							   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
							   $historial_numero = historial();
							   $estado = "Actualizar";
							   $observacion = "Se actualiza el campo preclínica en la entidad agenda, desde preclínica";
							   $modulo = "Agenda";
							   $insert = "INSERT INTO historial 
									VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
							   $mysqli->query($insert);
							   /*****************************************************/				   
						   }
						   /******************************************************************************************************************************/			  
					  
						   $fecha_cita =  date("Y-m-d H:i:s", strtotime($fecha));
						   $fecha_cita_end =  date("Y-m-d H:i:s", strtotime($fecha));
						   $fecha_registro = date("Y-m-d H:i:s");
						   $color = "#8D6E63";//COLOR CAFE
									   
						   //CONSULTAMOS SI EL USUARIO ES NUEVO O SUBSIGUIENTE	
						   $consultar_expediente = "SELECT a.agenda_id 
							   FROM agenda AS a 
							   INNER JOIN colaboradores AS c
							   ON a.colaborador_id = c.colaborador_id
							   WHERE a.pacientes_id = '$pacientes_id' AND c.puesto_id = '$puesto_colaborador' AND a.servicio_id = '$servicio' AND a.status = 1";
						   $result = $mysqli->query($consultar_expediente);				   
						   $consultar_expediente1 = $result->fetch_assoc();  
						   
						   if ($consultar_expediente1['agenda_id']== ""){
							  $paciente_consult = 'N';
						   }else{ 
							  $paciente_consult = 'S';
						   }
						   
						  if($resp == 0 && $visita == ""){				 
							 $insert = "INSERT INTO agenda 
							   VALUES('$numero_agenda', '$pacientes_id', '$expediente', '$medico', '00:00', '$fecha_cita', '$fecha_cita_end', '$fecha_registro', '0', '$color', 'Se registro, fuera de admisión, Hecho en preclinica. $servicio_name.','$usuario','$servicio','Hecho en preclinica. $servicio_name.','1','$postclinica','2','$paciente_consult','0')";  
							 $mysqli->query($insert);

							 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
							 $historial_numero = historial();
							 $estado = "Agregar";
							 $observacion = "Se ha agregado este usuario en la agenda";
							 $modulo = "Agenda";
							 $insert = "INSERT INTO historial 
								  VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$medico','$servicio','$fecha_cita','$estado','$observacion','$usuario','$fecha_registro')";	 
							 $mysqli->query($insert);
							 /*****************************************************/					 
																  
								  if($extem_id == 0){
									 $insert = "INSERT INTO extemporaneos 
										 VALUES ('$numero_extemporaneo','$fecha','$expediente', '$pacientes_id', '$medico','$servicio','$paciente','Usuario Extemporáneo','$usuario', '$fecha_sistema')"; 
									 $mysqli->query($insert);

									 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
									 $historial_numero = historial();
									 $estado = "Agregar";
									 $observacion = "Se ha agregado este usuario como extemporaneo";
									 $modulo = "Agenda";
									 $insert = "INSERT INTO historial 
										   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$medico','$servicio','$fecha_cita','$estado','$observacion','$usuario','$fecha_registro')";	 
									 $mysqli->query($insert);
									  /*****************************************************/						 
								  }				      
						  }		

						  if($resp == 1 && $visita == ""){
							  
							   $insert = "INSERT INTO agenda 
								  VALUES('$numero_agenda', '$pacientes_id', '$expediente', '$medico', '00:00', '$fecha_cita', '$fecha_cita_end', '$fecha_registro', '0', '$color', 'Se registro, fuera de admisión. Este usuario viene solo por medicamentos, Hecho en preclinica. $servicio_name.','$usuario','$servicio','Hecho en preclinica. $servicio_name.','1','$postclinica','2','$paciente_consult','0')";
							   $mysqli->query($insert);
							   
							   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
							   $historial_numero = historial();
							   $estado = "Agregar";
							   $observacion = "Se ha agregado este usuario en la agenda";
							   $modulo = "Agenda";
							   $insert = "INSERT INTO historial 
									VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$medico','$servicio','$fecha_cita','$estado','$observacion','$usuario','$fecha_registro')";	 
							   $mysqli->query($insert);
							   /*****************************************************/
								  
								  if($extem_id == 0){
									 $insert = "INSERT INTO extemporaneos 
										VALUES ('$numero_extemporaneo','$fecha','$expediente', '$pacientes_id', '$medico','$servicio','$paciente','Usuario Extemporáneo','$usuario', '$fecha_sistema')";
									 $mysqli->query($insert);

									 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
									 $historial_numero = historial();
									 $estado = "Agregar";
									 $observacion = "Se ha agregado este usuario como extemporaneo";
									 $modulo = "Agenda";
									 $insert = "INSERT INTO historial 
										   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$medico','$servicio','$fecha_cita','$estado','$observacion','$usuario','$fecha_registro')";	 
									 $mysqli->query($insert);
									  /*****************************************************/							 
								  }					   
						  }					  
						  
						  if( ($resp == 1 || $resp == 0) && $visita == "visita"){				  				 
							  $insert = "INSERT INTO agenda 
								 VALUES('$numero_agenda', '$pacientes_id', '$expediente', '$medico', '00:00', '$fecha_cita', '$fecha_cita_end', '$fecha_registro', '0', '$color', 'Se registro, fuera de admisión. Este usuario ha sido una visita por el médico, Hecho en preclinica. $servicio_name.','$usuario','$servicio','Hecho en preclinica. $servicio_name.','1','0','2','$paciente_consult','0')"; 
							  $mysqli->query($insert);
							  
							  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
							  $historial_numero = historial();
							  $estado = "Agregar";
							  $observacion = "Se ha agregado este usuario en la agenda";
							  $modulo = "Agenda";
							  $insert = "INSERT INTO historial 
								   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$medico','$servicio','$fecha_cita','$estado','$observacion','$usuario','$fecha_registro')";	 
							  $mysqli->query($insert);
							  /*****************************************************/				  
								  
								  if($extem_id == 0){
									 $insert = "INSERT INTO extemporaneos 
										 VALUES ('$numero_extemporaneo','$fecha','$expediente', '$pacientes_id', '$medico','$servicio','$paciente','Usuario Extemporáneo','$usuario', '$fecha_sistema')"; 
									 $mysqli->query($insert);	

									 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
									 $historial_numero = historial();
									 $estado = "Agregar";
									 $observacion = "Se ha agregado este usuario como extemporaneo";
									 $modulo = "Agenda";
									 $insert = "INSERT INTO historial 
										   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$medico','$servicio','$fecha_cita','$estado','$observacion','$usuario','$fecha_registro')";	 
									 $mysqli->query($insert);
									  /*****************************************************/							 
								  }					  
						  }			   
						}		   
						
						if($paciente == 'N'){
							//CONSULTAR AGENDA SI HAY VALORES
							$consultar_agenda = "SELECT agenda_id 
								FROM agenda 
								WHERE expediente = '$expediente' AND cast(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$medico' AND servicio_id = '$servicio'";
							$result = $mysqli->query($consultar_agenda);
							$consultar_agenda1 = $result->fetch_assoc();
							$consultar_agenda2 = $result->num_rows;
							$agenda_id = $consultar_agenda1['agenda_id'];				
							$update = "UPDATE agenda SET postclinica = $postclinica 
							   WHERE agenda_id = '$agenda_id' AND CAST(fecha_cita AS DATE) = '$fecha'";
							$mysqli->query($update);
							
						   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
						   $historial_numero = historial();
						   $estado = "Actualizar";
						   $observacion = "Se actualiza el campo postclínica en la entidad agenda, desde preclínica";
						   $modulo = "Agenda";
						   $insert = "INSERT INTO historial 
							   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
						   $mysqli->query($insert);
						   /*****************************************************/					
						}
						echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
				   }else{
					   echo 3; //ERROR AL ALMACENAR EL REGISTRO;
				   }
				}  	
			}else{
				echo 4; //ESTE REGISTRO YA EXISTE EN LA AGENDA POR FAVOR VERIFICAR LOS DATOS CON ADMISION ANTES DE CONTINUAR
			}
	   }
	//}else{//SI EXISTEN REGISTROS, MOSTRAMOS MENSJAE DE ERROR PARA QUE SE VALIDEN LOS DATOS
		//echo 7;//ESTE USUARIO YA TIENEN ATENCION PENDIENTE
	//}
}else{
	echo 8; //YA EXISTE UNA AUSENCIA PARA ESTE REGISTRO, NO SE PUEDE VOLVER A ALMACENAR, POR FAVOR CANCELE LA AUSENCIA ALMACENADA	
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>