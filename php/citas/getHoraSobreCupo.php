<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$servicio_id = $_POST['servicio_id'];
$tipo_sobrecupo = $_POST['tipo_sobrecupo'];
$expediente_valor = $_POST['expediente'];
$nueva_fecha = date("Y-m-d H:i:s", strtotime($fecha." ".$hora));
$fecha_cita_end = date('Y-m-d H:i:s', strtotime('+ 40 minute', strtotime($nueva_fecha)));
$colaborador_id  = $_POST['colaborador_id'];
$hora_h = date('H:i',strtotime($nueva_fecha));
$hora_ = date('H:i',strtotime($nueva_fecha)); 

//OBTENEMOS EL ESTATUS PARA ACTUALIZARLE LOS DATOS AL PACIENTE			 
$consultar_paciente = "SELECT pacientes_id, expediente
        FROM pacientes 
		WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_paciente);		
$consultar_paciente2 = $result->fetch_assoc();
$pacientes_id = $consultar_paciente2['pacientes_id'];
$expediente = $consultar_paciente2['expediente'];

//OBTENER PUESTO DE COLABORADOR
$consultar_puesto = "SELECT puesto_id 
   FROM colaboradores 
   WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_puesto) or die($mysqli->error);;
$consultar_puesto1 = $result->fetch_assoc();
$consultar_colaborador_puesto_id = $consultar_puesto1['puesto_id'];

//CONSULTAR DATOS DE LA JORNADA Y LA CANTIDAD DE NUEVOS Y SUBSIGUIENTES EN servicios_puestos
$consultarJornada = "SELECT j_colaborador_id, nuevos, subsiguientes, servicio_id 
   FROM servicios_puestos 
   WHERE colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consultarJornada) or die($mysqli->error);
$consultarJornada2 = $result->fetch_assoc();
$consultarJornadaJornada_id = $consultarJornada2['j_colaborador_id'];
$consultarJornadaNuevos = $consultarJornada2['nuevos'];
$consultarJornadaSubsiguientes = $consultarJornada2['subsiguientes'];
$consultarJornadaServicio_id = $consultarJornada2['servicio_id'];
$consultaJornadaTotal = $consultarJornadaNuevos + $consultarJornadaSubsiguientes;

$consultar_usuario = "SELECT agenda_id 
    FROM agenda 
	WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$nueva_fecha' AND fecha_cita_end = '$fecha_cita_end' AND status = 0 AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consultar_usuario) or die($mysqli->error);
$consultar_usuario1 = $result->fetch_assoc();

$consultar_medico = "SELECT agenda_id 
	FROM agenda 
	WHERE colaborador_id = '$colaborador_id' AND fecha_cita = '$nueva_fecha' AND fecha_cita_end = '$fecha_cita_end' AND status = 0 AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consultar_medico) or die($mysqli->error);			
$consultar_medico1 = $result->fetch_assoc();

//CONSULTAMOS EL PACIETE SI EXISTE EN LA ENTIDAD AGENDA
$query_agenda = "SELECT agenda_id
	FROM agenda
	WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND CAST(fecha_cita AS DATE) = '$fecha'";
$result_valores = $mysqli->query($query_agenda) or die($mysqli->error);			
					
if ($consultar_medico1['agenda_id'] != ""){
	echo 2;
}else if ( $consultar_usuario1['agenda_id'] != ""){
	echo 3;
}else if($result_valores->num_rows==0){	
    echo $tipo_sobrecupo."***";
   	if($tipo_sobrecupo != 0){
		$consultar_puesto = "SELECT puesto_id 
		   FROM colaboradores 
		   WHERE colaborador_id = '$colaborador_id'";
		$result = $mysqli->query($consultar_puesto) or die($mysqli->error);
		$consultar_puesto1 = $result->fetch_assoc();
		$consultar_colaborador = $consultar_puesto1['puesto_id'];
			
	   $consultar_expediente = "SELECT a.agenda_id AS 'agenda_id'
			FROM agenda AS a
			INNER JOIN colaboradores AS c
			ON a.colaborador_id = c.colaborador_id
			WHERE pacientes_id = '$pacientes_id' AND a.servicio_id = '$servicio_id' AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.status = 1";
	  $result = $mysqli->query($consultar_expediente);
	  $consultar_expediente1 = $result->fetch_assoc();
	  $consulta_agenda_id = $consultar_expediente1['agenda_id']; 
	  
	  //CONSULTAMOS LA CANTIDAD DE USUARIOS NUEVOS AGENDADOS
		  $consulta_nuevos = "SELECT COUNT(agenda_id) AS 'total_nuevos' 
			  FROM agenda 
			  WHERE CAST(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND paciente = 'N' AND status != 2";
		  $result = $mysqli->query($consulta_nuevos) or die($mysqli->error);;
		  $consulta_nuevos1 = $result->fetch_assoc();
		  $consulta_nuevos_devuelto = $consulta_nuevos1['total_nuevos'];
			  
		if ($consulta_agenda_id == ""){
			$consulta_nuevos_devuelto = $consulta_nuevos_devuelto + 1;
		}

		//CONSULTAMOS LA CANTIDAD DE USUARIOS SUBSIGUIENTES AGENDADOS
		$consulta_subsiguientes = "SELECT COUNT(agenda_id) AS 'total_subsiguientes' 
			 FROM agenda 
			 WHERE CAST(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND paciente = 'S' AND status != 2";
		$result = $mysqli->query($consulta_subsiguientes) or die($mysqli->error);;
		$consulta_subsiguientes1 = $result->fetch_assoc();
		$consulta_subsiguientes_devuelto = $consulta_subsiguientes1['total_subsiguientes'];		  
		  
		if ($consulta_agenda_id != ""){
			$consulta_subsiguientes_devuelto = $consulta_subsiguientes_devuelto + 1;
		}
		
		//INICIO EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
		$valores_array = getAgendatimeSE($consultarJornadaJornada_id, $servicio_id, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $consulta_agenda_id, $hora_h, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto);
		$hora = $valores_array['hora'];
		$colores = $valores_array['colores'];
		//FIN EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
		
		echo $hora;
	}else{
		$consultar_puesto = "SELECT puesto_id 
		   FROM colaboradores 
		   WHERE colaborador_id = '$colaborador_id'";
		$result = $mysqli->query($consultar_puesto) or die($mysqli->error);
		$consultar_puesto1 = $result->fetch_assoc();
		$consultar_colaborador = $consultar_puesto1['puesto_id'];
			
	   $consultar_expediente = "SELECT a.agenda_id AS 'agenda_id'
			FROM agenda AS a
			INNER JOIN colaboradores AS c
			ON a.colaborador_id = c.colaborador_id
			WHERE pacientes_id = '$pacientes_id' AND a.servicio_id = '$servicio_id' AND c.puesto_id = '$consultar_colaborador_puesto_id' AND a.status = 1";
	  $result = $mysqli->query($consultar_expediente);
	  $consultar_expediente1 = $result->fetch_assoc();
	  $consulta_agenda_id = $consultar_expediente1['agenda_id']; 
	  
	  //CONSULTAMOS LA CANTIDAD DE USUARIOS NUEVOS AGENDADOS
		  $consulta_nuevos = "SELECT COUNT(agenda_id) AS 'total_nuevos' 
			  FROM agenda 
			  WHERE CAST(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND paciente = 'N' AND status != 2";
		  $result = $mysqli->query($consulta_nuevos) or die($mysqli->error);;
		  $consulta_nuevos1 = $result->fetch_assoc();
		  $consulta_nuevos_devuelto = $consulta_nuevos1['total_nuevos'];
			  
		if ($consulta_agenda_id == ""){
			$consulta_nuevos_devuelto = $consulta_nuevos_devuelto + 1;
		}

		//CONSULTAMOS LA CANTIDAD DE USUARIOS SUBSIGUIENTES AGENDADOS
		$consulta_subsiguientes = "SELECT COUNT(agenda_id) AS 'total_subsiguientes' 
			 FROM agenda 
			 WHERE CAST(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND paciente = 'S' AND status != 2";
		$result = $mysqli->query($consulta_subsiguientes) or die($mysqli->error);;
		$consulta_subsiguientes1 = $result->fetch_assoc();
		$consulta_subsiguientes_devuelto = $consulta_subsiguientes1['total_subsiguientes'];		  
		  
		if ($consulta_agenda_id != ""){
			$consulta_subsiguientes_devuelto = $consulta_subsiguientes_devuelto + 1;
		}
		
		//INICIO EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
		$valores_array = getAgendatimeExtemporaneo($consultarJornadaJornada_id, $servicio_id, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $consulta_agenda_id, $hora_h, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto);
		$hora = $valores_array['hora'];
		$colores = $valores_array['colores'];
		//FIN EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
		
		echo $hora;		
	}
}else{
	echo 1;//EL PACIENTE YA EXSTE NE LA ENTIDAD NO SE PUEDE CONTINUAR
}	

$result->free();//LIMPIAR RESULTADO
$result_valores->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN				
?>