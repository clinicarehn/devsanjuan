<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$entrevista_id = $_POST['entrevista_id'];

$query = "SELECT e.entrevista_id AS 'entrevista_id', CONCAT(p.nombre,' ',p.apellido) AS 'usuario', p.identidad AS 'identidad', p.expediente AS 'expediente', em.nombre AS 'modalidad', e.entrevistado AS 'entrevistado', r.nombre AS 'relacion', CONCAT(c.nombre,' ',c.apellido) AS 'trabajador_social', CONCAT(c1.nombre,' ',c1.apellido) AS 'solicitado_por', e.agenda AS 'agenda', s.nombre AS 'servicio', cd2.nombre AS 'clasificacion1', cd2.nombre AS 'clasificacion2', cd3.nombre AS 'clasificacion3', tp1.nombre AS 'tipologia1', tp2.nombre AS 'tipologia2', tp3.nombre AS 'tipologia3', CONCAT(c2.nombre,' ',c2.apellido) AS 'usuario_sistema', e.fecha_registro AS 'fecha_registro'
	FROM entrevista AS e
	INNER JOIN pacientes AS p
	ON e.pacientes_id = p.pacientes_id
	INNER JOIN colaboradores AS c
	ON e.colaborador_id = c.colaborador_id
	INNER JOIN servicios AS s
	ON e.servicio_id = s.servicio_id
	INNER JOIN entrevista_modalidad AS em
	ON e.entrevista_modalidad_id = em.entrevista_modalidad_id
	INNER JOIN relacion AS r
	ON e.relacion_paciente = r.relacion_id
	INNER JOIN colaboradores AS c1
	ON e.solicitado = c1.colaborador_id
	LEFT JOIN clasificacion_diagnostica AS cd1
	ON e.clasificacion1 = cd1.clasificacion_diagnostica_id
	LEFT JOIN clasificacion_diagnostica AS cd2
	ON e.clasificacion2 = cd2.clasificacion_diagnostica_id
	LEFT JOIN clasificacion_diagnostica AS cd3
	ON e.clasificacion3 = cd3.clasificacion_diagnostica_id
	LEFT JOIN tipologia AS tp1
	ON e.tipologia1 = tp1.tipologia_id
	LEFT JOIN tipologia AS tp2
	ON e.tipologia2 = tp1.tipologia_id
	LEFT JOIN tipologia AS tp3
	ON e.tipologia3 = tp1.tipologia_id
	INNER JOIN colaboradores AS c2
	ON e.usuario = c2.colaborador_id
	WHERE e.entrevista_id = '$entrevista_id'";
	
$result = $mysqli->query($query);
 
$consulta1=$result->fetch_assoc(); 

if($result->num_rows>0){
	if($consulta1['expediente'] == 0){
		$expediente	= "TEMP";
	}else{
		$expediente = $consulta1['expediente'];
	}
	
	$usuario = $consulta1['usuario'];
	$identidad = $consulta1['identidad'];
	$modalidad = $consulta1['modalidad'];
	$entrevisatado = $consulta1['entrevistado'];
	$relacion = $consulta1['relacion'];
	$trabajador_social = $consulta1['trabajador_social'];
	$solicitado_por = $consulta1['solicitado_por'];
	$agenda = $consulta1['agenda'];
	$servicio = $consulta1['servicio'];
	$clasificacion1 = $consulta1['clasificacion1'];
	$tipologia1 = $consulta1['tipologia1'];
	$clasificacion2 = $consulta1['clasificacion2'];
	$tipologia2 = $consulta1['tipologia2'];
	$clasificacion3 = $consulta1['clasificacion3'];
	$tipologia3 = $consulta1['tipologia3'];	
	
	$mensaje_datos_usuario = "
		<div class='row'>
			  <div class='col-md-12'><p style='color: #483D8B;' align='center'><b>Datos del Usuario</b></p></div>               
		</div>
		<div class='row'>
			<div class='col-md-5'><p><b>Usuario:</b> $usuario</p></div>
			<div class='col-md-3'><p><b>Expediente:</b> $expediente</p></div>
			<div class='col-md-3'><p><b>Identidad:</b> $identidad</p></div>                
		</div> 		
		<div class='row'>
			 <div class='col-md-12'><p style='color: #008000;' align='center'><b>Entrevista Trabajo Social</b></p></div> 	   
		</div> 
		<div class='row'>
			<div class='col-md-5'><p><b>Modalidad:</b> $modalidad</p></div>
			<div class='col-md-3'><p><b>Entrevistado:</b> $entrevisatado</p></div>
			<div class='col-md-3'><p><b>Relacion:</b> $relacion</p></div>                
		</div> 
		<div class='row'>
			<div class='col-md-5'><p><b>Trabajador Social:</b> $trabajador_social</p></div>
			<div class='col-md-3'><p><b>Solicitado Por:</b> $solicitado_por</p></div>
			<div class='col-md-3'><p><b>Agenda:</b> $agenda</p></div>                
		</div> 	
		<div class='row'>
			<div class='col-md-5'><p><b>Servicio:</b> $servicio</p></div>              
		</div> 	
		<div class='row'>
				   
		</div>  		
		<div class='row'>
			<div class='col-md-6'><p><b>Clasificación 1:</b> $clasificacion1</p></div>
			<div class='col-md-6'><p><b>Tipología 1:</b> $tipologia1</p></div>                
		</div> 			
		<div class='row'>
			<div class='col-md-6'><p><b>Clasificación 2:</b> $clasificacion2</p></div>
			<div class='col-md-6'><p><b>Tipología 2:</b> $tipologia2</p></div>               
		</div> 	
		<div class='row'>
			<div class='col-md-6'><p><b>Clasificación 3:</b> $clasificacion3</p></div>
			<div class='col-md-6'><p><b>Tipología 3:</b> $tipologia3</p></div>              
		</div> 			
	";
}else{
	$mensaje_datos_usuario = "
		<div class='row'>
		   <div class='col-md-12'><p style='color: #FF0000;' align='center'><b>No hay datos que mostrar</b></p></div>                 
		</div>
		<div class='row'>
				   
		</div>   	
	";	
}

echo $mensaje_datos_usuario;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>