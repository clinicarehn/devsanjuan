	<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$fecha_consulta = date('Y-m-d');
$pacientes_seg_id = $_POST['pacientes_seg_id'];

//COSULTAR DETALLE DE PACIENTES
$query = "SELECT CONCAT(ps.apellidos,' ',ps.nombres) AS 'paciente',
  (CASE WHEN ps.genero = 'H' THEN 'Hombre' ELSE 'Mujer' END) AS 'genero',
   ps.identidad AS 'identidad', ps.fecha_nacimiento AS 'fecha_nacimiento', ps.telefono AS 'telefono', d.nombre AS 'departamento', m.nombre AS 'municipio', 
   ps.localidad, ps.fecha_registro AS 'fecha_registro',
   (CASE WHEN ps.	transferir = '1' THEN 'Transferido' ELSE 'Sin Transferir' END) AS 'transferir'
   FROM pacientes_seguimiento AS ps
   INNER JOIN departamentos AS d
   ON ps.departamento_id = d.departamento_id
   INNER JOIN municipios AS m
   ON ps.municipio_id = m.municipio_id
   WHERE pacientes_seg_id = '$pacientes_seg_id'";
 
$result = $mysqli->query($query);	
$registro2 = $result->fetch_assoc();

$paciente = '';
$genero = '';
$identidad = '';
$fecha_nacimiento = '';
$telefono = '';
$departamento = '';
$municipio = '';
$localidad = '';
$fecha_registro = '';
$transferir = '';
$mensaje = '';
$error = '';

if($result->num_rows>0){
	$paciente = $registro2['paciente'];
	$genero = $registro2['genero'];
	$identidad = $registro2['identidad'];
	$fecha_nacimiento = $registro2['fecha_nacimiento'];
	$telefono = $registro2['telefono'];
	$departamento = $registro2['departamento'];
	$municipio = $registro2['municipio'];
	$localidad = $registro2['localidad'];
	$fecha_registro = date('Y-m-d g:i a',strtotime($registro2['fecha_registro'])); 
	$transferir = $registro2['transferir'];
	
	//INICIO DATOS DEL USUARIO	
	$mensaje_datos_usuario = "
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p style='color: #483D8B;' align='center'><b>Datos del Usuario</b></p>
			</div>					
		</div>			
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Paciente:</b> $paciente</p>
			</div>				
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Genero:</b> $genero</p>
			</div>	
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Identidad:</b> $identidad</p>
			</div>				
		</div>	
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Departamento:</b> $departamento</p>
			</div>				
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Municipio:</b> $municipio</p>
			</div>	
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Localidad:</b> $localidad</p>
			</div>				
		</div>	
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Teléfono:</b> $telefono</p>
			</div>				
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>¿Transferido?:</b> $transferir</p>
			</div>	
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Fecha Registro:</b> $fecha_registro</p>
			</div>				
		</div>
	";
	//FIN DATOS DEL USUARIO	
	
	$mensaje .= $mensaje_datos_usuario;
}else{
	$error = "
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p style='color: #FF0000;' align='center'><b>No hay datos que mostrar</b></p>
			</div>					
		</div>   
	";	
	
	$mensaje .= $error;
}	
	
echo $mensaje;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>