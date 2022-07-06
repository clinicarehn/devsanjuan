<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$expediente = $_POST['expediente']; //Recibe la identidad del usuario o el numero de expediente del mismo
$servicio = $_POST['servicio_id'];
$colaborador_id = $_POST['colaborador_id'];
$unidad = $_POST['unidad'];
$start = $_POST['start'];
$end = $_POST['end'];
$fecha = date('Y-m-d');
$año = date("Y", strtotime($fecha));
$fecha_cita = date("Y-m-d", strtotime($start));
$fecha_inical = $año."-01-01";
$fecha_final = $año."-12-31";
$hora_ = date('H:i',strtotime($start)); 
$hora_h = date('H:i',strtotime($start));

//CONSULTAR PUESTO COLABORADOR			  
$consultar_puesto = "SELECT puesto_id 
   FROM colaboradores 
   WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_puesto);
$consultar_puesto1 = $result->fetch_assoc();
$consultar_colaborador_puesto_id = $consultar_puesto1['puesto_id'];

//OBTENEMOS EL ESTATUS PARA ACTUALIZARLE LOS DATOS AL PACIENTE			 
$consultar_paciente = "SELECT pacientes_id, actualizar_datos, expediente, tipo
        FROM pacientes 
		WHERE expediente = '$expediente' OR identidad = '$expediente' AND tipo = 1";
$result = $mysqli->query($consultar_paciente);
$consultar_paciente2 = $result->fetch_assoc();
$pacientes_id = $consultar_paciente2['pacientes_id'];
$expediente_consulta = $consultar_paciente2['expediente'];
$tipo_paciente = $consultar_paciente2['tipo'];
$actualizar_datos = $consultar_paciente2['actualizar_datos'];

//CONSULTAMOS LA EDAD, LA CUAL SE USARÁ PARA LA AGENDA DEL PACIENTE (BLOQUEO DE EDADES)
$consultar_edad_permitida = "SELECT edad 
   FROM config_edad";
$result = $mysqli->query($consultar_edad_permitida);
$consultar_edad_permitida2 = $result->fetch_assoc();
$edad_permitida = $consultar_edad_permitida2['edad'];

//CONSULTAR DATOS DE LA JORNADA Y LA CANTIDAD DE NUEVOS Y SUBSIGUIENTES EN servicios_puestos
$consultarJornada = "SELECT j_colaborador_id, nuevos, subsiguientes, servicio_id 
    FROM servicios_puestos 
    WHERE colaborador_id = '$colaborador_id' AND servicio_id = '$servicio'";
$result = $mysqli->query($consultarJornada);
$consultarJornada2 = $result->fetch_assoc();
$consultarJornadaJornada_id = $consultarJornada2['j_colaborador_id'];
$consultarJornadaNuevos = $consultarJornada2['nuevos'];
$consultarJornadaSubsiguientes = $consultarJornada2['subsiguientes'];
$consultarJornadaServicio_id = $consultarJornada2['servicio_id'];
$consultaJornadaTotal = $consultarJornadaNuevos + $consultarJornadaSubsiguientes;

//CONSULTAR LA ULTIMA FECHA DE LA DEPURACIÓN DEL USUARIO
//$consulta_ultima_fecha_depuracion = mysql_query("SELECT ");

//CONSULTAR ULTIMA ULTIMA ATENCIÓN DEL USUARIO POR EL PROFESIONAL ENCARGADO
$consulta_ultima_cita = "SELECT a.agenda_id AS 'agenda_id'
       FROM agenda AS a
	   INNER JOIN colaboradores AS c
	   ON a.colaborador_id = c.colaborador_id
	   WHERE a.pacientes_id = '$pacientes_id' AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.servicio_id = '$servicio' AND a.paciente = 'N' AND a.status = 0
	   ORDER BY a.fecha_cita DESC";
$result = $mysqli->query($consulta_ultima_cita);	   
	  	   	   	   
$consulta_ultima_cita2 = $result->fetch_assoc();
$consulta_ultima_cita_agenda_id = $consulta_ultima_cita2['agenda_id'];

//CONSULTAR EXISTENCIA DE USUARIO EN AGENDA
$consulta_existencia_usuario = "SELECT a.agenda_id 
     FROM agenda AS a
	 INNER JOIN colaboradores As c
	 ON a.colaborador_id = c.colaborador_id
	 WHERE a.pacientes_id = '$pacientes_id'AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.servicio_id = '$servicio' AND a.status = 0";
$result = $mysqli->query($consulta_existencia_usuario);	 
$consulta_existencia_usuario2 = $result->fetch_assoc();
$consulta_existencia_usuario_agenda_id = $consulta_existencia_usuario2['agenda_id'];

//CONSULTAR EL TIEMPO DESDE LA ULTIMA CITA HASTA LA ACTUALIDAD ALMACENADA EN LAS DEPURACIONES DE USUARIO
$consulta_tiempo = "SELECT depurado_id, expediente, fecha_ultima AS 'fecha', DATEDIFF(now(), fecha_ultima) / 365 AS 'year' 
     FROM depurados 
     WHERE expediente = '$expediente_consulta' AND status = 2
     ORDER BY fecha DESC LIMIT 1";
$result = $mysqli->query($consulta_tiempo);	 
	 
$consulta_tiempo2 = $result->fetch_assoc();
$tiempo_utlima_cita = $consulta_tiempo2['year'];
$tiempo_utlima_cita_fecha = $consulta_tiempo2['fecha'];	

//CONSULTAMOS LA ULTIMA ATENCION DEL USUARIO ALMACENADA EN EL ATA PARA COMPARARLA CON LA ULTIMA DEPURACIÓN
$consulta_ultima_atencion = "SELECT a.ata_id, a.expediente, a.fecha
     FROM ata AS a
	 INNER JOIN colaboradores AS c
	 ON a.colaborador_id = c.colaborador_id
	 WHERE a.expediente = '$expediente_consulta' AND a.colaborador_id = '$colaborador_id' AND a.servicio_id = '$servicio'
	 ORDER BY a.fecha DESC LIMIT 1
	 ";
 
$result = $mysqli->query($consulta_ultima_atencion);	 
$consulta_ultima_atencion2 = $result->fetch_assoc();	 
$consulta_ultima_atencion_fecha = $consulta_ultima_atencion2['fecha'];
//VERIFICAMOS SI pacientes_id ESTA VACIO, SI ES ASI LE DAMOS VALOR CERO
if ($pacientes_id == ""){
	$pacientes_id = 0;
}

//CONSULTAR PROXIMA CITA DE USUASARIO SI EL SERVICIO ES ANATENSOL
$dato_registro_cita = "";

if($servicio == 2){
     $consulta_registro_cita = "SELECT DATE_FORMAT(CAST(ag.fecha_cita AS DATE), '%d/%m/%Y') AS 'fecha', s.nombre AS 'servicio'
	      FROM agenda AS ag
		  INNER JOIN colaboradores AS c
		  ON ag.colaborador_id = c.colaborador_id
		  INNER JOIN servicios s
		  ON ag.servicio_id = s.servicio_id
		  WHERE ag.pacientes_id = '$pacientes_id' AND ag.servicio_id = 1 AND status = 0 AND c.puesto_id = '2'";
    $result_registro_cita = $mysqli->query($consulta_registro_cita);	 
    $consulta_result_registro_cita2 = $result_registro_cita->fetch_assoc();	 
    $consulta_result_registro_cita_fecha = $consulta_result_registro_cita2['fecha'];
	$consulta_result_registro_cita_servicio = $consulta_result_registro_cita2['servicio'];
	$dato_registro_cita = "=> Próxima Cita en C.E ".$consulta_result_registro_cita_fecha;
}

if($tipo_paciente == 1){//ES UN PACIENTE
if($expediente_consulta != ""){
  if($consulta_ultima_cita_agenda_id == ""){
    if($pacientes_id != 0){
      /*********************************************************************************/
      //CONSULTA AÑO, MES y DIA DEL PACIENTE
      $nacimiento = "SELECT fecha_nacimiento AS fecha 
	     FROM pacientes 
		 WHERE pacientes_id = '$pacientes_id'";
	  $result = $mysqli->query($nacimiento);
      $nacimiento2 = $result->fetch_assoc();
      $fecha_de_nacimiento = $nacimiento2['fecha'];

      $valores_array = getEdad($fecha_de_nacimiento);
	  $anos = $valores_array['anos'];
	  $meses = $valores_array['meses'];	  
	  $dias = $valores_array['dias'];	
      /*********************************************************************************/
if($servicio == 6 && $anos >= $edad_permitida){
	echo 3; //ESTE ES UN USUARIO ADULTO
}else if($servicio == 1 && $anos < $edad_permitida){
	echo 4; //ESTE ES UN USUARIO NIÑO
}else{
  if($actualizar_datos == 2){
    if($consulta_existencia_usuario_agenda_id == ""){
		//VALIDAMOS QUE EL PROFESIONAL NO TENGA LA HORA OCUPADA EN CUALQUIER SERVICIO DE ATENCIÓN
		if(getDisponibilidadDiponibilidadHorarioColaborador($colaborador_id, $start) == 2){
		   //CONSULTA EN LA ENTIDAD PACIENTES
		   $valores = "SELECT pacientes_id, expediente, CONCAT(apellido,' ',nombre) AS nombre, identidad, departamento_id, municipio_id 
				  FROM pacientes 
				  WHERE pacientes_id = '$pacientes_id'";
		   $result = $mysqli->query($valores);
		   $valores2 = $result->fetch_assoc();
		   $exp = $valores2['expediente'];
		   $pacientes_id = $valores2['pacientes_id'];
		   $identidad = $valores2['identidad'];
		   $departamento = $valores2['departamento_id'];
		   $municipio = $valores2['municipio_id'];
			
		   if($result->num_rows>0){
			  if($identidad != "" && $departamento != 0 && $municipio != 0){ 
				/****USUARIO MENOR A 13000 QUE NO HA SIDO REGISTRADO EN EL SISTEMA******/     
		  
			  $consultar_expediente = "SELECT a.agenda_id AS 'agenda_id'
					FROM agenda AS a
					INNER JOIN colaboradores AS c
					ON a.colaborador_id = c.colaborador_id
					WHERE pacientes_id = '$pacientes_id' AND a.servicio_id = '$servicio' AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.status = 1";
			  $result = $mysqli->query($consultar_expediente);
			 
					
				$consultar_expediente1 = $result->fetch_assoc();
				$consulta_agenda_id = $consultar_expediente1['agenda_id'];
				  
				 /****USUARIO MENOR A 13000 QUE NO HA SIDO REGISTRADO EN EL SISTEMA******/	
			  /* if($exp >=1 && $exp < 13000){ //ESTO SE PUEDE REMOVER EN UN FUTURO
					$consultar_expediente1['agenda_id'] = $exp; 
				}else{
					$consultar_expediente = "SELECT a.agenda_id 
						FROM agenda AS a
						INNER JOIN colaboradores AS c
						ON a.colaborador_id = c.colaborador_id
						WHERE pacientes_id = '$pacientes_id' AND a.servicio_id = '$servicio' AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.status = 1";
					$result = $mysqli->query($consultar_expediente) or die($mysqli->error);
					$consultar_expediente1 = $result->fetch_assoc();
					$consulta_agenda_id = $consultar_expediente1['agenda_id'];
				 }	*/		 
		

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
				/*FIN PARA OBTENER LA ULTIMA FECHA DE CONSULTA PARA EL USUARIO*/
			  
				//CONSULTAMOS LA CANTIDAD DE USUARIOS NUEVOS AGENDADOS
				$consulta_nuevos = "SELECT COUNT(agenda_id) AS 'total_nuevos' 
					 FROM agenda 
					 WHERE CAST(fecha_cita AS DATE) = '$fecha_cita' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio' AND paciente = 'N' AND status != 2";
				$result = $mysqli->query($consulta_nuevos);
				$consulta_nuevos1 = $result->fetch_assoc();
				$consulta_nuevos_devuelto = $consulta_nuevos1['total_nuevos'];
			  
				if($consultar_expediente1['agenda_id']== ""){
					$consulta_nuevos_devuelto = $consulta_nuevos_devuelto + 1;
				}
			  
				//CONSULTAMOS LA CANTIDAD DE USUARIOS SUBSIGUIENTES AGENDADOS
				$consulta_subsiguientes = "SELECT COUNT(agenda_id) AS 'total_subsiguientes' 
					FROM agenda 
					WHERE CAST(fecha_cita AS DATE) = '$fecha_cita' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio' AND paciente = 'S'  AND status != 2";
				$result = $mysqli->query($consulta_subsiguientes);
				$consulta_subsiguientes1 = $result->fetch_assoc();
				$consulta_subsiguientes_devuelto = $consulta_subsiguientes1['total_subsiguientes'];		  
			  
				if($consultar_expediente1['agenda_id'] != ""){
				   $consulta_subsiguientes_devuelto = $consulta_subsiguientes_devuelto + 1;
				}
			
		   //INICIO EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
		   $valores_array = getAgendatime($consultarJornadaJornada_id, $servicio, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $consulta_agenda_id, $hora_h, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto);
		   $hora = $valores_array['hora'];
		   $colores = $valores_array['colores'];
		   //FIN EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
		
			$datos = array(
					0 => $valores2['pacientes_id'], 
					1 => $valores2['nombre']." ".$dato_registro_cita,
					2 => $colores,	
					3 => $hora,
					4 => $colaborador_id,				
			);
			echo json_encode($datos);
		  }else{
			 echo 2;
		  }
		}else{
		   echo 1;
		}
	}else{
		echo 11;//EL MEDIO TIENE ESTA HORA OCUPADA EN OTRO SERVICIO
	}
   }else{
	   echo 6;//ESTE USUARIO YA EXISTE NO SE PUEDE AGENDAR
   }
   }else{
	   echo 8;//ES NECESARIO ACTUALIZAR LOS DATOS DEL USUARIO   
   }
  }
 }else{
	echo 5;//REGISTRO NO ENCONTRADO
 }
}else{
	echo 7;//ESTE USUARIO NO HA SIDO ATENDIDO POR EL PROFESIONAL
}
}else{
	echo 9;//REGISTRO NO ENCONTRADO
}
}else{
	echo 10;//ES UN FAMILIAR
}	

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN		
?>