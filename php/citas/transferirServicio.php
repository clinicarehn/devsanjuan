<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$agenda_id = $_POST['agenda_id'];
$pacientes_id = $_POST['pacientes_id'];
$fecha = $_POST['fecha'];
$servicio_id = $_POST['servicio_id'];
$servicio_anterior = $_POST['servicio_anterior'];

if(isset($_POST['servicio_nuevo'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['servicio_nuevo'] == ""){
		$servicio_nuevo = 0;
	}else{
		$servicio_nuevo = $_POST['servicio_nuevo'];
	}
}else{
	$servicio_nuevo = 0;
}

$observaciones = cleanStringStrtolower($_POST['observaciones']);
$usuario_sistema = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");
$estado = 1;//ACTIVO

//CONSULTRA NOMBRE DE SERVICIO
$consulta_nombre_servicio = "SELECT nombre 
	FROM servicios 
	WHERE servicio_id = '$servicio_nuevo'";
$result_nombre_servicio = $mysqli->query($consulta_nombre_servicio);

$nombre_servicio_nuevo = "";

if($result_nombre_servicio->num_rows==0){
	$consulta_nombre_servicio_nuevo = $result_nombre_servicio->fetch_assoc();
	$nombre_servicio_nuevo = $consulta_nombre_servicio_nuevo['nombre'];
}

//CONSULTAR DATOS DE LA AGENDA DEL PACIENTE
$query_agenda = "SELECT *
	FROM agenda
	WHERE agenda_id = '$agenda_id'";
$result_agenda = $mysqli->query($query_agenda);

$expediente = "";
$pacientes_id = "";
$colaborador_id = "";
$hora =  "";
$fecha_cita = "";
$fecha_cita_end = "";
$status = "";
$color = "";
$observacion = "";	
$usuario = "";
$comentario = "";
$preclinica = "";
$postclinica = "";
$reprogramo = "";
$paciente = "";
$status_id = "";

if($result_agenda->num_rows>0){
	$consulta_agenda = $result_agenda->fetch_assoc();
	
	$expediente = $consulta_agenda['expediente'];
	$pacientes_id = $consulta_agenda['pacientes_id'];
	$colaborador_id = $consulta_agenda['colaborador_id'];
	$fecha_cita = $consulta_agenda['fecha_cita'];
	$fecha_cita_end = $consulta_agenda['fecha_cita_end'];
	$status = $consulta_agenda['status'];
	$color = $consulta_agenda['color'];
	$hora = $consulta_agenda['hora'];
	$observacion = $consulta_agenda['observacion'];	
	$usuario = $consulta_agenda['usuario'];
	$comentario = $consulta_agenda['comentario'];
	$preclinica = $consulta_agenda['preclinica'];
	$postclinica = $consulta_agenda['postclinica'];
	$reprogramo = $consulta_agenda['reprogramo'];
	$paciente = $consulta_agenda['paciente'];
	$status_id = $consulta_agenda['status_id'];	
}

//VERIFICAMOS QUE EL SERVICIO NUEVO NO SEA IGUAL AL ANTERIOR
if($servicio_id == $servicio_nuevo){
	$datos = array(
		0 => "Error", 
		1 => "Lo sentimos es el mismo servicio, no se puede mover el usuario, debe buscar un servicio distinto", 
		2 => "error",
		3 => "btn-danger",
		4 => "",
		5 => "",			
	);
}else{
	//VERIFICAMOS QUE EL REGISTRO NO EXISTA
	$query = "SELECT agenda_id
		FROM agenda
		WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_nuevo' AND CAST(fecha_cita AS DATE) = '$fecha'";
	$result = $mysqli->query($query);
	
	if($result->num_rows==0){
		//ELIMINAR LA CITA
		$delete = "DELETE FROM agenda WHERE agenda_id = '$agenda_id'";
		$mysqli->query($delete);

		//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		$historial_numero = historial();
		$estado = "Eliminar";
		$observacion_historial = "Se elimino la cita para este registro, fue transferido de $servicio_anterior a $nombre_servicio_nuevo";
		$modulo = "Citas";
		$insert = "INSERT INTO historial 
				VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador_id','$servicio_id','$fecha_cita','$estado','$observacion_historial','$usuario_sistema','$fecha_registro')";
		$mysqli->query($insert);
		/*****************************************************/	

		//ALMACENAMOS LA NUEVACITA PARA EL PACIENTE
		$agenda_id_nuevo = correlativo("agenda_id", "agenda");

		$insert = "INSERT INTO agenda 
		VALUES('$agenda_id_nuevo', '$pacientes_id', '$expediente', '$colaborador_id', '$hora', '$fecha_cita', '$fecha_cita_end', '$fecha_registro', '0', '$color', '$observacion','$usuario_sistema','$servicio_nuevo','','$preclinica','0','2','$paciente','0')";
  		$query = $mysqli->query($insert);
		  
		  if($query){
			//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
			$historial_numero = historial();
			$estado = "Agenda";
			$observacion_historial = "Se ha transferido la cita para este registro, fue transferido de $servicio_anterior a $nombre_servicio_nuevo";
			$modulo = "Citas";
			$insert = "INSERT INTO historial 
					VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id_nuevo','$colaborador_id','$servicio_id','$fecha_cita','$estado','$observacion_historial','$usuario_sistema','$fecha_registro')";
			$mysqli->query($insert);
			/*****************************************************/	

			$datos = array(
				0 => "Almacenado", 
				1 => "Registro Transferido Correctamente", 
				2 => "success",
				3 => "btn-primary",
				4 => "formTransferirServicio",
				5 => "Registro",
				6 => "TransferiraServicio",
				7 => "modalMoverServicioCitas",
			);
		  }else{
			$datos = array(
				0 => "Error", 
				1 => "No se puedo transferir este registro, los datos son incorrectos por favor corregir", 
				2 => "error",
				3 => "btn-danger",
				4 => "",
				5 => "",			
			);
		  }
	}else{
		$datos = array(
			0 => "Error", 
			1 => "No se puedo transferir el usuario, ya existe en otro servicio, por favor validar", 
			2 => "error",
			3 => "btn-danger",
			4 => "",
			5 => "",			
		);		
	}
}

echo json_encode($datos);
?>