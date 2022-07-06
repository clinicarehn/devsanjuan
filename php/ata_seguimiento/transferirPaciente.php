<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$pacientes_seg_id = $_POST['pacientes_id'];
$comentario = $_POST['comentario'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR DATOS DEL PACIENTES_SEGUIMIENTO
$consultar_expediente = "SELECT nombres, apellidos, genero, identidad, fecha_nacimiento, telefono, departamento_id, municipio_id, localidad
     FROM pacientes_seguimiento 
	 WHERE pacientes_seg_id = '$pacientes_seg_id' AND transferir = 2";
	 	 
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();

$nombre = "";
$apellido = "";
$sexo = "";
$identidad = "";
$fecha_nacimiento = "";
$telefono = "";
$departamento_id = "";
$municipio_id = "";
$localidad = "";
$telefono1 = "";
$responsables = "";
$telefonoresp = "";
$telefonoresp1 = "";
$parentescos = "";
$status = 1;
$pais = 1;
$estado_civil = 1;
$raza  = 1;
$religion = 2;
$profesion = 19;
$lugar_nacimiento = '';
$correo = '';
$escolaridad = 4;
$actualizar_datos = 0;
$tipo_paciente = 1;
$expediente = 0;

if($result->num_rows>0){
	$nombre = $consultar_expediente2['nombres'];
	$apellido = $consultar_expediente2['apellidos'];	
	$sexo = $consultar_expediente2['genero'];
	$identidad = $consultar_expediente2['identidad'];	
	$fecha_nacimiento = $consultar_expediente2['fecha_nacimiento'];
	$telefono = $consultar_expediente2['telefono'];	
	$departamento_id = $consultar_expediente2['departamento_id'];
	$municipio_id = $consultar_expediente2['municipio_id'];	
    $localidad = $consultar_expediente2['localidad'];		
}

//VERIFICAR SI EXISTE EL REGISTRO
$existencia = "SELECT pacientes_id
    FROM pacientes
	WHERE identidad = '$identidad'";
		
$result_existencia = $mysqli->query($existencia);

if($result_existencia->num_rows==0){
	//OBTENER CORRELATIVO PACIENTES_SEGUIMIENTO
	$correlativo_pacientes = correlativo("pacientes_id","pacientes");

	//TRANSFERIR LOS DATOS
	$insert = "INSERT INTO pacientes VALUES('$correlativo_pacientes', '$expediente', '$nombre', '$apellido', '$identidad', '$sexo', '$fecha_nacimiento','$telefono',
				'$telefono1','$departamento_id','$municipio_id','$localidad','$responsables', '$telefonoresp', '$telefonoresp1', '$parentescos',
				'$fecha_registro','$usuario','$status','$pais','$estado_civil','$raza','$religion','$profesion', '$lugar_nacimiento','$correo','$escolaridad','$actualizar_datos','$tipo_paciente')";
				
	$query = $mysqli->query($insert);

	if($query){
		echo 1;//REGISTRO TRANSFERIDO CORRECTAMENTE
		
		//ACTUALIZAMOS EL REGISTRO DE PACIENTES DE SEGUIMIENTO
		$update = "UPDATE pacientes_seguimiento SET transferir = '1' 
		    WHERE pacientes_seg_id = '$pacientes_seg_id'";
		$mysqli->query($update);
		
		//GUARDAR HISTORIAL PACIENTE SEGUIMIENTO
		$correlativo_pacientes_seguimiento = correlativo("id","paciente_seguimiento_transferir");
		$insert_pacientes= "INSERT INTO paciente_seguimiento_transferir VALUES('$correlativo_pacientes_seguimiento','$pacientes_seg_id','$comentario','$usuario','$fecha_registro')";
		$mysqli->query($insert_pacientes);
		/***************************************************************************************************************************************************************************/
		
		//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		$historial_numero = historial();
		$estado = "Agregar";
		$observacion = "Se ha transferido un usuario de seguimiento";
		$modulo = "Pacientes";
		$insert = "INSERT INTO historial 
		   VALUES('$historial_numero','$correlativo_pacientes','$pacientes_seg_id','$modulo','0','0','0','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
		$mysqli->query($insert);		
		/***************************************************************************************************************************************************************************/
	}else{
		echo 2;//NO SE PUDO ALMACENAR EL REGISTRO
	}	
}else{
	echo 3;//ESTE REGISTRO YA EXISTE EN NUESTRO SISTEMA
}

$mysqli->close();//CERRAR CONEXIÓN
?>