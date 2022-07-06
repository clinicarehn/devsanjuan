<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();
header('Content-Type: application/json');   
date_default_timezone_set('America/Tegucigalpa');
$usuario = $_SESSION['colaborador_id']; 

$valor = $_POST['sobrecupo_expediente'];
$fecha_registro = $_POST['sobrecupo_fecha'];
$servicio_id = $_POST['sobrecupo_servicio'];
$puesto_id = $_POST['sobrecupo_unidad'];
$colaborador_id = $_POST['sobrecupo_medico'];
$fecha_cita = $_POST['sobrecupo_fecha_cita'];
$hora_cita = $_POST['hora_sobrecupo'];
$fecha_start = date("Y-m-d H:i:s", strtotime($fecha_cita." ".$hora_cita));
$fecha_sistema = date("Y-m-d H:i:s");
$color = "";
$observacion = cleanStringStrtolower($_POST['sobrecupo_obsevacion']);
$status = 0;
$preclinica = 0;
$postclinicca = 0;
$reprogramo = 2;
$comentario = "";

if(isset($_POST['tipo_sobrecupo'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['tipo_sobrecupo'] == ""){
		$tipo_sobrecupo = 0;
	}else{
		$tipo_sobrecupo = $_POST['tipo_sobrecupo'];
	}
}else{
	$tipo_sobrecupo = 0;
}

//OBTENER EL PUESTO DEL COLABORADOR
$consultar_puesto = "SELECT puesto_id    
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_puesto);
$consultar_puesto1 = $result->fetch_assoc();
$consultar_colaborador_puesto_id = $consultar_puesto1['puesto_id'];

if($consultar_colaborador_puesto_id == 1 ){
    if(date('H:i',strtotime($fecha_start )) >= '13:20'){
	   $fecha_nueva_ = date('Y-m-d H:i:s', strtotime('- 20 minute', strtotime($fecha_start)));
       $fecha_nueva = date('Y-m-d H:i:s', strtotime('+ 40 minute', strtotime($fecha_nueva_)));	
    }else{
      $fecha_nueva = date('Y-m-d H:i:s', strtotime('+ 40 minute', strtotime($fecha_start)));	
    }	
}else{
	$fecha_nueva = date('Y-m-d H:i:s', strtotime('+ 40 minute', strtotime($fecha_start)));	
}
$fecha_end = date("Y-m-d H:i:s", strtotime($fecha_nueva));

$consultar_pacientes_id = "SELECT pacientes_id, expediente 
	FROM pacientes 
	WHERE expediente = '$valor' OR identidad = '$valor'";
$result = $mysqli->query($consultar_pacientes_id);
$consultar_pacientes_id1 = $result->fetch_assoc();
$pacientes_id = $consultar_pacientes_id1['pacientes_id'];
$expediente = $consultar_pacientes_id1['expediente'];
	
$consultar_edad_permitida = "SELECT edad 
   FROM config_edad";
$result = $mysqli->query($consultar_edad_permitida);
$consultar_edad_permitida2 = $result->fetch_assoc();
$edad_permitida = $consultar_edad_permitida2['edad'];
/*********************************************************************************/
//CONSULTA AÑO, MES y DIA DEL PACIENTE
$nacimiento ="SELECT fecha_nacimiento AS fecha 
   FROM pacientes 
   WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($nacimiento);
$nacimiento2 = $result->fetch_assoc();
$fecha_de_nacimiento = $nacimiento2['fecha'];

$fecha_actual = date ("Y-m-d"); 

// separamos en partes las fechas 
$valores_array = getEdad($fecha_de_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/			 

//CONSULTAMOS LA ULTIMA ATENCION DEL USUARIO ALMACENADA EN EL ATA PARA COMPARARLA CON LA ULTIMA DEPURACIÓN
$consulta_ultima_atencion = "SELECT a.ata_id, a.expediente, a.fecha
     FROM ata AS a
	 INNER JOIN colaboradores AS c
	 ON a.colaborador_id = c.colaborador_id
	 WHERE a.expediente = '$expediente' AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.servicio_id = '$servicio_id'
	 ORDER BY a.fecha DESC LIMIT 1";
$result = $mysqli->query($consulta_ultima_atencion);	 
$consulta_ultima_atencion2 = $result->fetch_assoc();	 
$consulta_ultima_atencion_fecha = $consulta_ultima_atencion2['fecha'];

//CONSULTAR EL TIEMPO DESDE LA ULTIMA CITA HASTA LA ACTUALIDAD ALMACENADA EN LAS DEPURACIONES DE USUARIO
$consulta_tiempo = "SELECT depurado_id, expediente, fecha_ultima AS 'fecha', DATEDIFF(now(), fecha_ultima) / 365 AS 'year' 
     FROM depurados 
     WHERE expediente = '$expediente' AND status = 2
     ORDER BY fecha DESC LIMIT 1";
$result = $mysqli->query($consulta_tiempo);	 
$consulta_tiempo2 = $result->fetch_assoc();
$tiempo_utlima_cita = $consulta_tiempo2['year'];
$tiempo_utlima_cita_fecha = $consulta_tiempo2['fecha'];

//EVALUAR SI EL USUARIO ES NUEVO O SUBSIGUIENTE	
$consultar_expediente = "SELECT a.agenda_id AS 'agenda_id'
	FROM agenda AS a
	INNER JOIN colaboradores AS c
	ON a.colaborador_id = c.colaborador_id
	WHERE pacientes_id = '$pacientes_id' AND a.servicio_id = '$servicio_id' AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.status = 1";
$result_expediente = $mysqli->query($consultar_expediente);
$consultar_expediente1 = $result->fetch_assoc();  
$paciente = "";

if($result_expediente->num_rows==0){
	$paciente = 'N';
}else{
  $paciente = 'S';	
}
	
$consulta_agenda_id = $consultar_expediente1['agenda_id'];
  
//AGREGARMOS EL USUARIO COMO SI FUERA UN USUARIO NUEVO
if($consulta_ultima_atencion_fecha != ""){
	if($consulta_ultima_atencion_fecha > $tiempo_utlima_cita_fecha){
		$consulta_agenda_id = "Valores_encontrados";//AGREGAMOS TEMPORALMENTE UN CONTENIDO AL ARREGLO, PARA INDICAR QUE HAY VALORES. ES SUBSIGUIEBNTE					
	}else{
	  if($tiempo_utlima_cita > 5){
		 $consulta_agenda_id = ""; 
	  }						
	}
}else{
   if($tiempo_utlima_cita > 5){
	  $consulta_agenda_id = ""; 
   }				
}	

//CONSULTAMOS LA CANTIDAD DE USUARIOS NUEVOS AGENDADOS
$consulta_nuevos = "SELECT COUNT(agenda_id) AS 'total_nuevos' 
	 FROM agenda 
	 WHERE CAST(fecha_cita AS DATE) = '$fecha_cita' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND paciente = 'N' AND status != 2";
$result = $mysqli->query($consulta_nuevos);
$consulta_nuevos1 = $result->fetch_assoc();
$consulta_nuevos_devuelto = $consulta_nuevos1['total_nuevos'];

if($consultar_expediente1['agenda_id']== ""){
	$consulta_nuevos_devuelto = $consulta_nuevos_devuelto + 1;
}
	
//CONSULTAMOS LA CANTIDAD DE USUARIOS SUBSIGUIENTES AGENDADOS
$consulta_subsiguientes = "SELECT COUNT(agenda_id) AS 'total_subsiguientes' 
	FROM agenda 
	WHERE CAST(fecha_cita AS DATE) = '$fecha_cita' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND paciente = 'S'  AND status != 2";
$result = $mysqli->query($consulta_subsiguientes);
$consulta_subsiguientes1 = $result->fetch_assoc();
$consulta_subsiguientes_devuelto = $consulta_subsiguientes1['total_subsiguientes'];		  

if($consultar_expediente1['agenda_id'] != ""){
   $consulta_subsiguientes_devuelto = $consulta_subsiguientes_devuelto + 1;
}
			
//CONSULTAR DATOS DE LA JORNADA Y LA CANTIDAD DE NUEVOS Y SUBSIGUIENTES EN servicios_puestos
$consultarJornada = "SELECT j_colaborador_id, nuevos, subsiguientes, servicio_id 
    FROM servicios_puestos 
    WHERE colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consultarJornada);
$consultarJornada2 = $result->fetch_assoc();
$consultarJornadaJornada_id = $consultarJornada2['j_colaborador_id'];
$consultarJornadaNuevos = $consultarJornada2['nuevos'];
$consultarJornadaSubsiguientes = $consultarJornada2['subsiguientes'];
$consultarJornadaServicio_id = $consultarJornada2['servicio_id'];
$consultaJornadaTotal = $consultarJornadaNuevos + $consultarJornadaSubsiguientes;

//EVALUAMOS QUE LA FECHA Y HORA NO ESTE OCUPADA POR EL PROFESIONAL
$query_agenda_paciente = "SELECT agenda_id
		FROM agenda
		WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND $servicio_id = '$servicio_id' AND status = 0 AND fecha_cita = '$fecha_start'";		
$result_agenda_paciente = $mysqli->query($query_agenda_paciente);

//CONSULTAMOS SI HAY UNA AUSENCIA DEL USUARIO PARA ESTE DIA
$query_ausencia = "SELECT a.agenda_id AS 'agenda_id'
	FROM agenda AS a
	INNER JOIN colaboradores AS c
	ON a.colaborador_id = c.colaborador_id
	WHERE a.pacientes_id = '$pacientes_id' AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.servicio_id = '$servicio_id' AND a.status = 2 AND CAST(a.fecha_cita AS DATE) = '$fecha_cita'";
$result_ausencias = $mysqli->query($query_ausencia);

if($result_ausencias->num_rows==0){
	if($tipo_sobrecupo != 0){
		if($result_agenda_paciente->num_rows==0){
			if($servicio_id == 6 && $anos >= $edad_permitida){
				echo 1; //ESTE ES UN USUARIO ADULTO
			}else if($servicio_id == 1 && $anos < $edad_permitida){
				echo 2; //ESTE ES UN USUARIO NIÑO
			}else{
				if(getDisponibilidadDiponibilidadHorarioColaborador($colaborador_id, $fecha_start) == 2){
				   //INICIO EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
				   $valores_array = getAgendatimeSE($consultarJornadaJornada_id, $servicio_id, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $consulta_agenda_id, $hora_cita, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto);
				   $hora = $valores_array['hora'];	   
					
				   //FIN EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL		
					$numero = correlativo("agenda_id", "agenda");
					
					if($tipo_sobrecupo == 1){
						$color = "#DF0101";//ROJO USUARIO EXTEMPORAENO
					}else if($tipo_sobrecupo == 2){
						$color = "#824CC8";//MORADO USUARIO SOBRE CUPO
					}else{//AGENDA DE USUARIOS EXTEMPORANEOS
						$color = "#DF0101";//ROJO USUARIO EXTEMPORAENO
					}
					
					//EVALUAMOS QUE SE RECIBA UNA HORA CORRECTA PARA AGENDAR EL PACIENTE
					if($hora != 'NuevosExcede' || $hora != 'NulaSError' || $hora != 'NulaP' || $hora != 'SubsiguienteExcede'){
						$insert = "INSERT INTO agenda 
						VALUES('$numero', '$pacientes_id', '$expediente', '$colaborador_id', '$hora', '$fecha_start', '$fecha_end', '$fecha_sistema', '$status', '$color', '$observacion','$usuario','$servicio_id','$observacion','$preclinica','$postclinicca','$reprogramo','$paciente','0')"; 

						$query = $mysqli->query($insert);			
						
						if($query){
							echo 3;//REGISTRO COMPLETADO CON EXITO
							
							if($tipo_sobrecupo == 1){
								/*##############################################################################################################################################*/
								 //VERIFICAMOS QUE NO EXISTA ATENCION GUARDA EN SOBRE CUPO
								 $query_sobrecupo = "SELECT extem_id
									FROM extemporaneos
									WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha_cita'";
								 $result_sobrecupo = $mysqli->query($query_sobrecupo);
								 
								 if($result_sobrecupo->num_rows==0){
									 $numero_extemporaneo = correlativo("extem_id", "extemporaneos");
									 $comentario_extemporaneo = "Usuario Extemporáneo ".$observacion;
									 $insert = "INSERT INTO extemporaneos 
										 VALUES ('$numero_extemporaneo','$fecha_start','$expediente', '$pacientes_id', '$colaborador_id','$servicio_id','$paciente','$comentario_extemporaneo','$usuario', '$fecha_sistema')";  
									 $mysqli->query($insert);				 
								 }	
								 /*##############################################################################################################################################*/
								 
								 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
								 $historial_numero = historial();
								 $estado = "Agregar";
								 $observacion = "Se agrego un usuario a la lista de extemporaneos";
								 $modulo = "Citas";
								 $insert = "INSERT INTO historial 
										 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio_id','$fecha_cita','$estado','$observacion','$usuario','$fecha_sistema')";
								 $mysqli->query($insert);
								 /*****************************************************/				
							}else{
								/*##############################################################################################################################################*/
								 //VERIFICAMOS QUE NO EXISTA ATENCION GUARDA EN SOBRE CUPO
								 $query_sobrecupo = "SELECT sobrecupo_id
									FROM sobrecupo
									WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha_cita'";
								 $result_sobrecupo = $mysqli->query($query_sobrecupo);
								 
								 if($result_sobrecupo->num_rows==0){
									 $numero_extemporaneo = correlativo("sobrecupo_id", "sobrecupo");
									 $comentario_extemporaneo = "Usuario con Sobrecupo";
									 $insert = "INSERT INTO sobrecupo 
										 VALUES ('$numero_extemporaneo','$fecha_start','$expediente', '$pacientes_id', '$colaborador_id','$servicio_id','$paciente','$comentario_extemporaneo','$usuario', '$fecha_sistema')";  
									 $mysqli->query($insert);				 
								 }	
								 /*##############################################################################################################################################*/
								 
								 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
								 $historial_numero = historial();
								 $estado = "Agregar";
								 $observacion = "Se agrego un usuario a la lista de sobrecupos";
								 $modulo = "Citas";
								 $insert = "INSERT INTO historial 
										 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio_id','$fecha_cita','$estado','$observacion','$usuario','$fecha_sistema')";
								 $mysqli->query($insert);
								 /*****************************************************/				
							} 				
						}else{
							echo 4;//ERROR AL COMPLETAR EL REGISTRO
						}						
					}else{
						echo $hora; //IMPRIMIMOS EL VALOR QUE TRAE PARA LUEGO MOSTRAR EL ERROR SEGÚN SU RESULTADO
					}
				}else{
					echo 7;//ESTE USUARIO NO HA SIDO ATENDIDO POR EL PROFESIONAL
				}
			}	
		}else{
			echo 5;//EL PROFESIONAL TIENE LA HORA OCUPADA
		}
	}else{//AGENDA DE USUARIOS EXTEMPORANEOS
		if($result_agenda_paciente->num_rows==0){
			if($servicio_id == 6 && $anos >= $edad_permitida){
				echo 1; //ESTE ES UN USUARIO ADULTO
			}else if($servicio_id == 1 && $anos < $edad_permitida){
				echo 2; //ESTE ES UN USUARIO NIÑO
			}else{
				if(getDisponibilidadDiponibilidadHorarioColaborador($colaborador_id, $fecha_start) == 2){
				   //INICIO EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
				   $valores_array = getAgendatimeExtemporaneo($consultarJornadaJornada_id, $servicio_id, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $consulta_agenda_id, $hora_cita, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto);
				   $hora = $valores_array['hora'];	   
					
				   //FIN EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL		
					$numero = correlativo("agenda_id", "agenda");
					
					if($tipo_sobrecupo == 1){
						$color = "#DF0101";//ROJO USUARIO EXTEMPORAENO
					}else if($tipo_sobrecupo == 2){
						$color = "#824CC8";//MORADO USUARIO SOBRE CUPO
					}else{//AGENDA DE USUARIOS EXTEMPORANEOS
						$color = "#DF0101";//ROJO USUARIO EXTEMPORAENO
					}
					
					//EVALUAMOS QUE SE RECIBA UNA HORA CORRECTA PARA AGENDAR EL PACIENTE
					if($hora != 'NuevosExcede' || $hora != 'NulaSError' || $hora != 'NulaP' || $hora != 'SubsiguienteExcede'){
						$insert = "INSERT INTO agenda 
						VALUES('$numero', '$pacientes_id', '$expediente', '$colaborador_id', '$hora', '$fecha_start', '$fecha_end', '$fecha_registro', '$status', '$color', '$observacion','$usuario','$servicio_id','$observacion','$preclinica','$postclinicca','$reprogramo','$paciente','0')"; 
						$query = $mysqli->query($insert);	
						
						if($query){
							echo 3;//REGISTRO COMPLETADO CON EXITO
							
							if($tipo_sobrecupo == 1){
								/*##############################################################################################################################################*/
								 //VERIFICAMOS QUE NO EXISTA ATENCION GUARDA EN SOBRE CUPO
								 $query_sobrecupo = "SELECT extem_id
									FROM extemporaneos
									WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha_cita'";
								 $result_sobrecupo = $mysqli->query($query_sobrecupo);
								 
								 if($result_sobrecupo->num_rows==0){
									 $numero_extemporaneo = correlativo("extem_id", "extemporaneos");
									 $comentario_extemporaneo = "Usuario Extemporáneo ".$observacion;
									 $insert = "INSERT INTO extemporaneos 
										 VALUES ('$numero_extemporaneo','$fecha_start','$expediente', '$pacientes_id', '$colaborador_id','$servicio_id','$paciente','$comentario_extemporaneo','$usuario', '$fecha_registro')";  
									 $mysqli->query($insert);				 
								 }	
								 /*##############################################################################################################################################*/
								 
								 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
								 $historial_numero = historial();
								 $estado = "Agregar";
								 $observacion = "Se agrego un usuario a la lista de extemporaneos";
								 $modulo = "Citas";
								 $insert = "INSERT INTO historial 
										 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio_id','$fecha_cita','$estado','$observacion','$usuario','$fecha_registro')";
								 $mysqli->query($insert);
								 /*****************************************************/				
							}else{
								/*##############################################################################################################################################*/
								 //VERIFICAMOS QUE NO EXISTA ATENCION GUARDA EN SOBRE CUPO
								 $query_sobrecupo = "SELECT sobrecupo_id
									FROM sobrecupo
									WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha_cita'";
								 $result_sobrecupo = $mysqli->query($query_sobrecupo);
								 
								 if($result_sobrecupo->num_rows==0){
									 $numero_extemporaneo = correlativo("sobrecupo_id", "sobrecupo");
									 $comentario_extemporaneo = "Usuario con Sobrecupo";
									 $insert = "INSERT INTO sobrecupo 
										 VALUES ('$numero_extemporaneo','$fecha_start','$expediente', '$pacientes_id', '$colaborador_id','$servicio_id','$paciente','$comentario_extemporaneo','$usuario', '$fecha_registro')";  
									 $mysqli->query($insert);				 
								 }	
								 /*##############################################################################################################################################*/
								 
								 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
								 $historial_numero = historial();
								 $estado = "Agregar";
								 $observacion = "Se agrego un usuario a la lista de sobrecupos";
								 $modulo = "Citas";
								 $insert = "INSERT INTO historial 
										 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio_id','$fecha_cita','$estado','$observacion','$usuario','$fecha_registro')";
								 $mysqli->query($insert);
								 /*****************************************************/				
							} 				
						}else{
							echo 4;//ERROR AL COMPLETAR EL REGISTRO
						}						
					}else{
						echo $hora; //IMPRIMIMOS EL VALOR QUE TRAE PARA LUEGO MOSTRAR EL ERROR SEGÚN SU RESULTADO
					}
				}else{
					echo 7;//ESTE USUARIO NO HA SIDO ATENDIDO POR EL PROFESIONAL
				}
			}	
		}else{
			echo 5;//EL PROFESIONAL TIENE LA HORA OCUPADA
		}		
	}
}else{
	echo 6; //YA EXISTE UNA AUSENCIA PARA ESTE REGISTRO, NO SE PUEDE VOLVER A ALMACENAR, POR FAVOR CANCELE LA AUSENCIA ALMACENADA
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
