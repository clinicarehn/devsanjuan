<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$fecha_consulta = date('Y-m-d');
$ata_id = $_POST['ata_id'];

$where = "WHERE a.ata_id = '$ata_id'";

//CONSULTAR VALORES ATA SEGUIMIENTO
$query = "SELECT CONCAT(p.nombre,' ',p.apellido) AS 'usuario', p.identidad As 'identidad', p.expediente, d.nombre AS 'departamento', m.nombre AS 'municipio', a.localidad AS 'localidad', 
(CASE WHEN a.paciente = 'Nuevo' THEN 'N' ELSE 'Subsiguiente' END) AS 'paciente',
(CASE WHEN p.sexo = 'H' THEN 'Hombre' ELSE 'Mujer' END) AS 'genero',
CONCAT(c.nombre,' ',c.apellido) AS 'profesional', s.nombre AS 'servicio', pa1.patologia_id AS 'patologia_id1', pa2.patologia_id AS 'patologia_id2', pa3.patologia_id AS 'patologia_id3', a.observaciones AS 'observaciones'
   FROM ata AS a
   INNER JOIN pacientes AS p
   ON a.expediente = p.expediente
   INNER JOIN colaboradores AS c
   ON a.colaborador_id = c.colaborador_id
   INNER JOIN patologia AS pa1
   ON a.patologia_id = pa1.id
   LEFT JOIN patologia AS pa2
   ON a.patologia_id1 = pa2.id
   LEFT JOIN patologia AS pa3
   ON a.patologia_id2 = pa3.id  
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id
   INNER JOIN departamentos AS d
   ON a.departamento_id = d.departamento_id
   INNER JOIN municipios AS m
   ON a.municipio_id = m.municipio_id
   ".$where;
$result = $mysqli->query($query);	
$registro2 = $result->fetch_assoc();

$usuario = '';
$identidad = '';
$expediente = '';
$departamento = '';
$municipio = '';
$localidad = '';
$paciente = '';
$profesional = '';
$servicio = '';
$patologia_id1 = '';
$patologia_id2 = '';
$patologia_id3 = '';
$observaciones = '';
$genero = '';
$mensaje = '';

if($result->num_rows>0){
	$usuario = $registro2['usuario'];
	$identidad = $registro2['identidad'];
	$expediente = $registro2['expediente'];
	$departamento = $registro2['departamento'];
	$servicio = $registro2['servicio'];
	$municipio = $registro2['municipio'];
	$localidad = $registro2['localidad'];
	$paciente = $registro2['paciente'];
	$profesional = $registro2['profesional'];
	$patologia_id1 = $registro2['patologia_id1'];
	$patologia_id2 = $registro2['patologia_id2'];
	$patologia_id3 = $registro2['patologia_id3'];
	$observaciones = $registro2['observaciones'];
	$genero = $registro2['genero'];
	
	//INICIO DATOS DEL USUARIO	
	$mensaje_datos_usuario = "
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p style='color: #483D8B;' align='center'><b>Datos del Usuario</b></p>
			</div>					
		</div>		
		<div class='form-row'>
			<div class='col-md-6 mb-6 sm-3'>
			  <p><b>Usuario:</b> $usuario</p>
			</div>				
			<div class='col-md-6 mb-6 sm-3'>
			  <p><b>Genero:</b> $genero</p>
			</div>	
		</div>
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Identidad:</b> $identidad</p>
			</div>	
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Departamento:</b> $departamento</p>
			</div>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Municipio:</b> $municipio</p>
			</div>					
		</div>							
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Localidad:</b> $localidad</p>
			</div>	
		</div>					
		 ";	 
	//FIN DATOS DEL USUARIO

	$mensaje_atencion = "
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p style='color: #483D8B;' align='center'><b>Seguimiento Telefónico</b></p>
			</div>					
		</div>		
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Usuario:</b> $paciente</p>
			</div>				
			<div class='col-md-4 mb-4 sm-3'>
			  <p><b>Profesional:</b> $profesional</p>
			</div>	
			<div class='col-md-4 mb-4 sm-3'>
			  <p><b>Servicio:</b> $servicio</p>
			</div>				
		</div>
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p><b>Patología 1:</b> $patologia_id1</p>
			</div>				
		</div>	
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p><b>Patología 2:</b> $patologia_id2</p>
			</div>				
		</div>			
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p><b>Patología 3:</b> $patologia_id3</p>
			</div>				
		</div>	
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p><b>Observaciones 3:</b> $observaciones</p>
			</div>				
		</div>				
	";	
	
	$mensaje .= $mensaje_datos_usuario.' '.$mensaje_atencion;
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