<?php
//REPORTE DE USUARIOS DEPURADOS 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];
$depurado_id = $_POST['id-registro'];
$fecha = $_POST['fecha']; //FECHA DE LA DEPURACIÓN
$fecha_cita = $_POST['fecha_cita'];
$servicio_id = $_POST['servicio'];
$diagnostico = $_POST['diagnostico'];
$comentario = cleanStringStrtolower($_POST['motivo']);
$expediente_valor = $_POST['expediente1'];
$usuario = $_SESSION['colaborador_id'];
$status = 4;//Usuarios depurados		
$fecha_registro = date("Y-m-d H:i:s");
$año_actual = date("Y");

$consultar_expediente = "SELECT expediente, pacientes_id
    FROM pacientes 
	WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

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
	
if ($servicio_id != 0 && $expediente != 0 && $colaborador != 0 && $usuario != 0 && $status != 0){
  if($fecha_cita_ != "" || $fecha_cita_ == "0000-00-00"){
	 //CONSULTAR REGISTROS EN EL AÑO ACTUAL
	 $update = "UPDATE depurados 
	      SET diagnostico = '$diagnostico', fecha_ultima = '$fecha_cita', colaborador_id = '$colaborador', colaborador_id1 = '$colaborador1', servicio_id = '$servicio_id', comentario = '$comentario', fecha = '$fecha'
	      WHERE depurado_id = '$depurado_id'";
	 $query_insert = $mysqli->query($update);
	 
     if($query_insert){				   
		echo 1;//REGISTRO ALMACENADO CORRECTAMENTE	

		//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		$historial_numero = historial();
		$estado = "Modificar";
		$observacion = "Se modificaron los datos de este usuario Depurado";
		$modulo = "Depurados";
			   
		$insert = "INSERT INTO historial 
			VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$depurado_id','$colaborador1','$servicio_id','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
		$mysqli->query($insert);		
	 }else{
		echo 2;//ERROR AL COMPLETAR EL REGISTROS
	 }			  	
  }else{
	 echo 3;//LA FECHA DE CITA NO DEBE SER CERO
  }
}else{
  echo 4;//NO SE PUEDE ALMACENAR EL RESITRO HAY VALORES EN BLANCO
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>