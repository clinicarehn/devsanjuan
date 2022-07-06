<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$fecha_consulta = date('Y-m-d');
$pacientes_id = $_POST['pacientes_id'];
$mensaje = "";
$mensaje_datos_usuario = "";
$mensaje_programacion_cita = "";
$mensaje_transito_usuarios = "";
$error;
$expediente_ = "";

//INICIO DATOS DEL USUARIO
$query_datos_usuario = "SELECT CONCAT(apellido,' ',nombre) AS 'usuario', expediente AS 'expediente', identidad AS 'identidad'
   FROM pacientes
   WHERE pacientes_id = '$pacientes_id'";
$result_datos_usuario = $mysqli->query($query_datos_usuario);
$consulta_datos_usuario = $result_datos_usuario->fetch_assoc();
$usuario = $consulta_datos_usuario['usuario'];
$expediente = $consulta_datos_usuario['expediente'];
$identidad = $consulta_datos_usuario['identidad'];

if($expediente == 0){
	$expediente_ = "TEMP";
}else{
	$expediente_ = $expediente;
}
$mensaje_datos_usuario = "
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p style='color: #483D8B;' align='center'><b>Datos del Usuario</b></p>
		</div>
	</div>
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Usuario:</b> $usuario</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Expediente:</b> $expediente_</p>
		</div>
		<div class='col-md-4 mb-6 sm-'>
		  <p><b>Identidad:</b> $identidad</p>
		</div>
	</div>
";
//FIN DATOS DEL USUARIO

//INICION CONSULTA HOJA DE CITA
//CONSULTA DATOS DE PROGRAMACION DE CITA
$query_programacion = "SELECT tc.nombre AS 'tipo_cita', pc.descripcion AS 'descripcion', s.nombre AS 'servicio', CONCAT(c.apellido,' ',c.nombre) AS 'profesional', pcolaboradores.nombre AS 'puesto', DATE_FORMAT(pc.fecha_cita, '%d/%m/%Y') AS 'fecha_cita'
    FROM programar_cita AS pc
	INNER JOIN servicios AS s
	ON pc.servicio_id = s.servicio_id
	INNER JOIN colaboradores AS c
	ON pc.colaborador_id = c.colaborador_id
	INNER JOIN tipo_cita AS tc
	ON pc.tipo_cita = tc.tipo_cita_id
	INNER JOIN puesto_colaboradores AS pcolaboradores
	ON c.puesto_id = pcolaboradores.puesto_id
	WHERE pc.pacientes_id = '$pacientes_id' AND pc.fecha_cita = '$fecha_consulta' AND c.puesto_id IN(1,2)
	ORDER BY pc.pacientes_id";

$result_programacion = $mysqli->query($query_programacion);

$mensaje_programacion_cita = "
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p style='color: #008000;' align='center'><b>Cita Seguimiento</b></p>
		</div>
	</div>
";


while($consulta_programacion = $result_programacion->fetch_assoc()){
  $tipo_cita = $consulta_programacion['tipo_cita'];
  $descripcion = $consulta_programacion['descripcion'];
  $servicio = $consulta_programacion['servicio'];
  $profesional = $consulta_programacion['profesional'];
  $puesto = $consulta_programacion['puesto'];
  $fecha_cita = $consulta_programacion['fecha_cita'];

	$mensaje_programacion_cita .= "
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Tipo de Cita:</b> $tipo_cita</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Solicitado por:</b> $profesional</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Servicio:</b> $servicio</p>
		</div>
	</div>
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Unidad:</b> $puesto</p>
		</div>
	</div>
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p><b>Comentario:</b> $descripcion</p>
		</div>
	</div>
	";
}
//FIN CONSULTA HOJA DE CITA

//INICION CONSULTA TRANSITO ENVIADA
$query_consulta_transito = "SELECT s.nombre AS 'servicio', pc.nombre AS 'puesto', CONCAT(c.apellido,' ',c.nombre) AS 'profesional', te.observacion As 'observacion', DATE_FORMAT(te.fecha, '%d/%m/%Y') AS 'fecha'
     FROM transito_enviada AS te
     INNER JOIN colaboradores AS c
     ON te.colaborador_id = c.colaborador_id
     INNER JOIN servicios AS s
     ON te.servicio_id = s.servicio_id
     INNER JOIN puesto_colaboradores AS pc
     ON te.enviada_a_unidad = pc.puesto_id
     WHERE te.expediente = '$expediente' AND te.fecha = '$fecha_consulta'
     ORDER BY te.expediente DESC";

$result_consulta_transito = $mysqli->query($query_consulta_transito);

$mensaje_transito_usuarios = "
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p style='color: #8B008B;' align='center'><b>Transito Usuarios</b></p>
		</div>
	</div>
";

while($consulta_consulta_transito = $result_consulta_transito->fetch_assoc()){
   $servicio_trasito = $consulta_consulta_transito['servicio'];
   $puesto_trasito = $consulta_consulta_transito['puesto'];
   $profesional_trasito = $consulta_consulta_transito['profesional'];
   $observacion_trasito = $consulta_consulta_transito['observacion'];
   $fecha_transito = $consulta_consulta_transito['fecha'];

	$mensaje_transito_usuarios .= "
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Profesional que envía:</b> $profesional_trasito</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Servicio:</b> $servicio_trasito</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Unidad:</b> $puesto_trasito</p>
		</div>
	</div>
	<div class='form-row'>
		<div class='col-md-8 mb-6 sm-3'>
		  <p><b>Observación:</b> $observacion_trasito</p>
		</div>
	</div>
	";
}
//FIN CONSULTA TRANSITO ENVIADA

$error = "
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p style='color: #FF0000;' align='center'><b>No hay datos que mostrar</b></p>
		</div>
	</div>
";

$mensaje .= $mensaje_datos_usuario;


if($result_programacion->num_rows>0 && $result_consulta_transito->num_rows>0){
    $mensaje .= $mensaje_programacion_cita.$mensaje_transito_usuarios;
}else if($result_programacion->num_rows > 0){
    $mensaje .= $mensaje_programacion_cita;
}else if($result_consulta_transito->num_rows >0){
    $mensaje .= $mensaje_transito_usuarios;
}else{
    $mensaje .= $error;
}

echo $mensaje;

$result_datos_usuario->free();//LIMPIAR RESULTADO
$result_programacion->free();//LIMPIAR RESULTADO
$result_consulta_transito->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
