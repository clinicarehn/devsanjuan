<?php
error_reporting(E_ALL); 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];
$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$fecha_cita = $_POST['fecha_cita'];
$servicio = $_POST['servicio'];
$diagnostico = $_POST['diagnostico'];
$comentario = mb_convert_case($_POST['motivo'], MB_CASE_TITLE, "UTF-8");
$usuario = $_SESSION['colaborador_id'];
$status = 3;
$hora = date('H:i:s');		
$fecha_fallecidos = date("Y-m-d H:i:s", strtotime($fecha." ".$hora));
$fecha_registro = date("Y-m-d H:i:s");
$año_actual = date("Y");

//OBTENER VALORES DE LA FECHA DE CITA
$fecha_cita_ = date("Y-m-d", strtotime($fecha_cita));

if(isset($_POST['medico_general'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medico_general'] == ""){
		$colaborador = 0;
	}else{
		$colaborador = $_POST['medico_general'];
	}
}else{
	$colaborador = 0;
}

if(isset($_POST['medico_general1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medico_general1'] == ""){
		$colaborador1 = 0;
	}else{
		$colaborador1 = $_POST['medico_general1'];
	}
}else{
	$colaborador1 = 0;
}

$consultar_expediente = "SELECT expediente 
    FROM pacientes 
	WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];

$consultar_nombre = "SELECT CONCAT(nombre,' ',apellido) AS 'nombre' 
   FROM colaboradores 
   WHERE colaborador_id = '$usuario'";
$result = $mysqli->query($consultar_nombre);
$consultar_nombre = $result->fetch_assoc();
$nombre_colaborador = $consultar_nombre['nombre'];

//CONSULTAR PACIENTE
$consultar_paciente = "SELECT pacientes_id 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consultar_paciente);
$consultar_paciente2 = $result->fetch_assoc();
$pacientes_id = $consultar_paciente2['pacientes_id'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(depurado_id) AS max, COUNT(depurado_id) AS count 
   FROM depurados";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	

//CONSULTAR Registro
$consultar_registro = "SELECT depurado_id 
   FROM depurados 
   WHERE fecha = '$fecha' and expediente = '$expediente'"; 
$result = $mysqli->query($consultar_registro);

if($result->num_rows>0){
   echo 2; //REGISTRO YA EXISTE
}else{
 if($servicio != 0 && $colaborador != 0 && $usuario != 0 && $status != 0 && $expediente != 0){  
	if($fecha_cita_ != "" || $fecha_cita_ == "0000-00-00"){
	   //CONSULTAR REGISTROS EN EL AÑO ACTUAL
	   $query_registros = "SELECT depurado_id
		  FROM depurados
		  WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND YEAR(fecha) = '$año_actual' AND status = '3'";
	   $result_registros = $mysqli->query($query_registros); 
	  
	   if($result_registros->num_rows == 0){
		 $insert = "INSERT INTO depurados 
			  VALUES('$numero', '$fecha_fallecidos ', '$pacientes_id', '$expediente', '$diagnostico', '$fecha_cita', '$status', '$usuario', '$colaborador', '$colaborador1', '$servicio','$comentario','$fecha_registro')";
		 $query_insert = $mysqli->query($insert);
	 
		 if($query_insert){			   
			echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
			
			//VERIFICAMOS SI EXISTE UNA CITA PARA ESTE PACIENTE
			$query_cita = "SELECT agenda_id
				FROM agenda
				WHERE pacientes_id = '$pacientes_id' AND status = 0";
			$result_cita = $mysqli->query($query_cita);
			
			while($registro2 = $result_cita->fetch_assoc()){
				$agenda_id = $registro2['agenda_id'];
				
				$update_cita = "UPDATE agenda SET comentario = 'Este paciente ha fallecido' WHERE agenda_id = '$agenda_id'";
				$query_insert = $mysqli->query($update_cita);
			}
			
			//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
			$historial_numero = historial();
			$estado = "Agregar";
			$observacion = "Usuario Fallecido";
			$modulo = "Depurados";
		   
			$insert = "INSERT INTO historial 
				VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador','$servicio','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
			$mysqli->query($insert);				
		   
			$update = "UPDATE pacientes SET status = '$status' 
			   WHERE pacientes_id = '$pacientes_id'";
			$mysqli->query($update);
			
			//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
			$historial_numero = historial();
			$estado = "Modificar";
			$observacion = "Edicion del estado del usuario";
			$modulo = "Pacientes";
		   
			$insert = "INSERT INTO historial 
				VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$pacientes_id','$colaborador','$servicio','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
			$mysqli->query($insert);				
			
			//REVISAR SI EL USUARIO TIENE CITA
			$consulta_cita = "SELECT agenda_id, colaborador_id, fecha_cita, usuario 
			   FROM agenda 
			   WHERE expediente = '$expediente' AND status = '0'";
			$result = $mysqli->query($consulta_cita);
   
			while($consulta_cita2 = $result->fetch_assoc()){
			   $agenda_id = $consulta_cita2['agenda_id'];
			   $colaborador_id = $consulta_cita2['colaborador_id'];
			   $fecha_cita = $consulta_cita2['fecha_cita'];
			   $usuario_agenda = $consulta_cita2['usuario'];
	   
			   $correlativo_agenda_id= "SELECT MAX(agenda_id) AS max, COUNT(agenda_id) AS count 
				  FROM agenda_cambio";
			   $result_agenda_id = $mysqli->query($correlativo_agenda_id);
			   $correlativo_agenda_id2 = $result_agenda_id->fetch_assoc();

			   $numero_agenda_id = $correlativo_agenda_id2['max'];
			   $cantidad_agenda_id = $correlativo_agenda_id2['count'];

			   if ( $cantidad_agenda_id == 0 )
				  $numero_agenda_id = 1;
			   else
				  $numero_agenda_id = $numero_agenda_id + 1;	

			   $insert = "INSERT INTO agenda_cambio 
				   VALUES('$numero_agenda_id','$colaborador_id','$expediente','$fecha_cita','$fecha_cita','$fecha','$usuario_agenda','Usuario ha fallecido se elimino de la agenda, acción realizada por: $nombre_colaborador')";
			   $cambio_agenda = $mysqli->query($insert);
	   
			   if($cambio_agenda){
				   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
				   $historial_numero = historial();
				   $estado = "Eliminar";
				   $observacion = "Se elimino la fecha de cita para este usuario";
				   $modulo = "Agenda";
		   
				   $insert = "INSERT INTO historial 
					   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda_id','$colaborador','$servicio','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
				   $mysqli->query($insert);
				   
				   $delete = "DELETE FROM agenda 
					 WHERE agenda_id = '$agenda_id'";
				   $mysqli->query($delete);
				   
				   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
				   $historial_numero = historial();
				   $estado = "Eliminar";
				   $observacion = "Se elimino la fecha de cita para este usuario";
				   $modulo = "Agenda";
		   
				   $insert = "INSERT INTO historial 
					   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$agenda_id','$colaborador','$servicio','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
				   $mysqli->query($insert);					   
			   }
			}				
		}else{
			echo 6;//ERROR AL COMPLETAR EL REGISTROS
		}			
	  }else{
		  echo 4;//REGISTRO YA HA SIDO ALMACENADO ANTERIORMENTE
	  }	
	}else{
		  echo 5;//FECHA CITA NO VALIDA
	}
  }else{
	 echo 3;//NO SE PUEDE ALMACDNAR EL RESITRO HAY VALORES EN BLANCO
  }
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>