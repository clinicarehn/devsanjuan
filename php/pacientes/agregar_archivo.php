<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();
include('../conexion-postgresql.php');

$pacientes_id = $_POST['pacientes_id'];
$estado = $_POST['estado'];
$usuario_sesion = $_SESSION['colaborador_id'];
date_default_timezone_set('America/Tegucigalpa');
$fecha = date("Y-m-d H:i:s");
$estado_ = "";

if($estado == "Activo"){
	$estado_ = 1;
}else if($estado = "Pasivo"){
	$estado_ = 2;
}

//ACTUALIZAMOS EL ESTADO DEL USUARIO EN LA ENTIDAD PACIENTES
/*
1. ACTIVO
2. PASIVO
3. FALLECIDO
4. DEPURADO
*/
   
//OBTENER CORRELATIVO EN LA ENTIDAD DEPURADOS
$query = "SELECT DISTINCT MAX(depurado_id) AS max, COUNT(depurado_id) AS count 
   FROM depurados";
$result = $mysqli->query($query);   
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

//CONSULTAMOS DATOS DEL PACIENTES
$query_consulta_paciente = "SELECT expediente, identidad, CONCAT(nombre,' ',apellido) AS 'usuario', nombre, apellido, fecha_nacimiento, telefono, telefono1, telefonoresp, 
    telefonoresp1, sexo, localidad, departamento_id, email, status, municipio_id, responsable, parentesco, estado_civil, tipo
	FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($query_consulta_paciente); 		
$consulta_paciente2 = $result->fetch_assoc();

$expediente = $consulta_paciente2['expediente'];
$identidad = $consulta_paciente2['identidad'];
$usuario = $consulta_paciente2['usuario'];
$nombre = $consulta_paciente2['nombre'];
$apellido = $consulta_paciente2['apellido'];
$fecha_nacimiento = $consulta_paciente2['fecha_nacimiento'];
$telefono = $consulta_paciente2['telefono'];
$telefono1 = $consulta_paciente2['telefono1'];
$telefonoresp = $consulta_paciente2['telefonoresp'];
$telefonoresp1 = $consulta_paciente2['telefonoresp1'];
$sexo = $consulta_paciente2['sexo'];
$localidades = $consulta_paciente2['localidad'];
$departamento = $consulta_paciente2['departamento_id'];
$municipio = $consulta_paciente2['municipio_id'];
$responsable = $consulta_paciente2['responsable'];
$parentesco = $consulta_paciente2['parentesco'];
$correo = $consulta_paciente2['email'];
$tipo = "";
$consulta_paciente_status = "";
$estado_civil = "";
$fecha_registro = date("Y-m-d H:i:s");
$estado_paciente_ = ""; 

if($result->num_rows>0){
	$expediente = $consulta_paciente2['expediente'];
	$identidad = $consulta_paciente2['identidad'];
	$usuario = $consulta_paciente2['usuario'];
	$nombre = $consulta_paciente2['nombre'];
	$apellido = $consulta_paciente2['apellido'];
	$fecha_nacimiento = $consulta_paciente2['fecha_nacimiento'];
	$telefono = $consulta_paciente2['telefono'];
	$telefono1 = $consulta_paciente2['telefono1'];
	$telefonoresp = $consulta_paciente2['telefonoresp'];
	$telefonoresp1 = $consulta_paciente2['telefonoresp1'];
	$sexo = $consulta_paciente2['sexo'];
	$localidades = $consulta_paciente2['localidad'];
	$departamento = $consulta_paciente2['departamento_id'];
	$municipio = $consulta_paciente2['municipio_id'];
	$responsable = $consulta_paciente2['responsable'];
	$parentesco = $consulta_paciente2['parentesco'];
	$correo = $consulta_paciente2['email'];
	$tipo = $consulta_paciente2['tipo'];
	$consulta_paciente_status = $consulta_paciente2['status'];
	$estado_civil = $consulta_paciente2['estado_civil'];

	if($consulta_paciente_status == 1){
	   $estado_paciente_ = "Activo";
	}else if($consulta_paciente_status == 2 || $consulta_paciente_status == 4){
	   $estado_paciente_ = "Pasivo";
	}else if($consulta_paciente_status == 3){
	   $estado_paciente_ = "Fallecido";
	}   	
}
   
$update = "UPDATE pacientes SET status = '$estado_' WHERE pacientes_id = '$pacientes_id'";
$mysqli->query($update);

//CONSULTAR DIAGNOSTICO DEL PACIENTES
$consulta_diagnostico = "SELECT a.colaborador_id AS 'colaborador_id', a.servicio_id AS 'servicio_id', a.fecha, p1.patologia_id AS 'patologia1', p2.patologia_id AS 'patologia2', p3.patologia_id AS 'patologia3'
     FROM ata AS a
     LEFT JOIN patologia AS p1
     ON a.patologia_id = p1.id
     LEFT JOIN patologia AS p2
     ON a.patologia_id1 = p2.id
     LEFT JOIN patologia AS p3
     ON a.patologia_id2 = p3.id
     WHERE a.expediente = 12606 
     ORDER BY a.ata_id DESC LIMIT 1";
$result = $mysqli->query($consulta_diagnostico);
$consulta_diagnostico2 = $result->fetch_assoc();

$diagnostico1 = "";
$diagnostico2 = "";
$diagnostico3 = "";
$colaborador_id = "";
$servicio_id = "";
$diagnostico = "";

$comentario  = "";

if($result->num_rows>0){
	$diagnostico1 = $consulta_diagnostico2['patologia1'];
	$diagnostico2 = $consulta_diagnostico2['patologia2'];
	$diagnostico3 = $consulta_diagnostico2['patologia3'];
	$colaborador_id = $consulta_diagnostico2['colaborador_id'];
	$servicio_id = $consulta_diagnostico2['servicio_id'];

	if($diagnostico2 ==""){
		$diagnostico = $diagnostico1;
	}else if($diagnostico2 !="" && $diagnostico3 ==""){
		$diagnostico = $diagnostico1.'/'.$diagnostico2;		   
	}else{
		$diagnostico = $diagnostico1.'/'.$diagnostico2.'/'.$diagnostico3;
	}	
}

if($estado_ == 2){
	$estado_ = 4;
}

if($estado_ == 1){
	$comentario = "Usuario transferido a Activo";
	
    //AGREGAR/EDITAR DATOS EN TABLA ODOO		
    $pais = 97;//HONDURAS

	if($departamento != 0){	
      if($expediente>0 && $tipo == 1){
		  if(isExistUsuario($expediente) == ""){//EL REGISTRO NO EXISTE, SE PROCEDE A ALMACENAR TODOS LOS DATOS DEL MISMO
			 insertOdoo($expediente, $identidad, $usuario, $fecha_nacimiento, $telefono, $telefono1, $telefonoresp, $telefonoresp1, $sexo, $localidades, $pacientes_id, $departamento, $pais, $correo, $estado_civil);
		  }else{//SI EL REGISTRO EXISTE, SOLO SE ACTUALIZA LA INFORMACIÓN
			 updateOdoo($expediente, $identidad, $usuario, $fecha_nacimiento, $telefono, $telefono1, $telefonoresp, $telefonoresp1, $sexo, $localidades, $pacientes_id, $departamento, $pais, $correo, $estado_civil);
	      }
	  }
	}
		
}else if($estado_ == 2){
	$comentario = "Usuario transferido a Pasivo";
}else{
	$comentario = "Usuario transferido a Fallecido";
}
//CONSULTAR FECHA ULTIMA CITA
$consulta_fecha = "SELECT CAST(fecha_cita AS DATE) AS 'fecha_cita' 
    FROM agenda 
	WHERE expediente = '$expediente' AND status = 1 ORDER BY fecha_cita DESC LIMIT 1";
$result = $mysqli->query($consulta_fecha);
$consulta_fecha2 = $result->fetch_assoc();

$fecha_cita = "";

if($result->num_rows>0){
	$fecha_cita = $consulta_fecha2['fecha_cita'];
}

if($fecha_cita == ""){
	$fecha_cita = date("Y-m-d");
	$comentario = $comentario.', no contaba con una fecha de cita, se agrego la misma de la depuración';
}

//ACTUALIZAMOS LOS DATOS EN LA ENTIDAD 
$insert = "INSERT INTO depurados VALUES('$numero','$fecha','$pacientes_id','$expediente','$diagnostico','$fecha_cita','$estado','$usuario_sesion','$colaborador_id', '0', '$servicio_id','$comentario','$fecha_registro')";
$query = $mysqli->query($insert);

if($query){
	echo 1;
	
   //OBTENER CORRELATIVO HISTORIAL PACIENTES
   $correlativo_historial= "SELECT DISTINCT MAX(id) AS max, COUNT(id) AS count 
       FROM historial_pacientes";
   $result = $mysqli->query($correlativo_historial);	   
   $correlativo_historial2 = $result->fetch_assoc();
   
   $numero_historial = $correlativo_historial2['max'];
   $cantidad_historial = $correlativo_historial2['count'];

   if ( $cantidad_historial == 0 )
	  $numero_historial = 1;
   else
      $numero_historial = $numero_historial + 1;
    		
    $insert = "INSERT INTO historial_pacientes VALUES('$numero_historial', '$pacientes_id', '$expediente', '$nombre', '$apellido', '$identidad', '$sexo', '$fecha_nacimiento','$telefono', '$telefono1','$departamento','$municipio','$localidades','$responsable','$parentesco', '$telefonoresp', '$telefonoresp1' ,'$fecha', '$usuario_sesion', 'Estatus Cambiado de $estado_paciente_ a $estado_','$fecha_registro')"; 
	
	$query = $mysqli->query($insert);
	
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado = "Transferir";
    $observacion = "Se transfirio el registro a: $estado";
    $modulo = "Pacientes";
    $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','0','0','0','$fecha_registro','$estado','$observacion','$usuario_sesion','$fecha_registro')";
    $mysqli->query($insert);
    /*****************************************************/  
	
}else{
	echo 2;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>