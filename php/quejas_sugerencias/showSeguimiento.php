<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$queja_id = $_POST['queja_id'];
$mensaje = ''; 

//CONSULTAR DATOS DEL USUARIO
$consultar = "SELECT CONCAT(p.apellido,' ',p.nombre) AS 'paciente', p.expediente AS 'expediente', p.identidad AS 'identidad', CONCAT(c.nombre,' ',c.apellido) AS 'usuario_sistema', q.descripcion AS 'descripcion', q.descripcion1 AS 'descripcion1'
   FROM queja AS q
   INNER JOIN pacientes AS p
   ON q.pacientes_id = p.pacientes_id
   INNER JOIN colaboradores AS c
   ON q.usuario = c.colaborador_id
   WHERE q.queja_id = '$queja_id'";
$result = $mysqli->query($consultar);
$consulta_2  = $result->fetch_assoc();   

$paciente = '';
$expediente = '';
$identdad = '';
$usuario_sistema = '';
$descripcion = '';
$descripcion1 = '';

if($result->num_rows>0){
	$paciente = $consulta_2['paciente'];	
	$expediente = $consulta_2['expediente'];	
	$identidad = $consulta_2['identidad'];
	$usuario_sistema = $consulta_2['usuario_sistema'];
	$descripcion = $consulta_2['descripcion'];
	$descripcion1 = $consulta_2['descripcion1'];	
}
    
$mensaje_datos_usuario = "
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p style='color: #FF0000;' align='center'><p style='color: #483D8B;' align='center'><b>Datos del Usuario</b></p></p>
		</div>					
	</div>
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Usuario:</b> $paciente</p>
		</div>				
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Expediente:</b> $expediente</p>
		</div>	
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Identidad:</b> $identidad</p>
		</div>			
	</div>
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <b>Usuario Sistema:</b> $usuario_sistema</p>
		</div>						
	</div>		
";

$mensaje .= $mensaje_datos_usuario;

//DESCRIPCION DE LA QUEJA
$mensaje_descripcion_queja = "
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p style='color: #483D8B;' align='center'><b>Descripción de la Queja</b></p>
		</div>					
	</div>
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p><b>Descripción 1:</b> $descripcion</p>
		</div>		
	</div>	
	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p><b>Descripción 2:</b> $descripcion1</p>
		</div>		
	</div>	
";

$mensaje .= $mensaje_descripcion_queja;
//CONSULTAR DATOS DEL SEGUIMIENTO DE LA QUEJA
$consulta_seguimiento = "SELECT qd.seguimiento AS 'seguimiento', DATE_FORMAT(CAST(qd.fecha_registro AS date), '%d/%m/%Y') AS 'fecha',
  (CASE WHEN qd.solucion = '1' THEN 'Sí' ELSE 'No' END) AS 'solucion'
   FROM queja_detalle AS qd
   INNER JOIN queja AS q
   ON qd.queja_id = q.queja_id
   WHERE q.queja_id = '$queja_id'";
$result = $mysqli->query($consulta_seguimiento);
$consulta_2  = $result->fetch_assoc(); 

$seguimiento = '';
$solucion = '';
$fecha = '';

if($result->num_rows>0){
	$seguimiento = $consulta_2['seguimiento'];	
	$solucion = $consulta_2['solucion'];
	$fecha = $consulta_2['fecha'];	
	
	$mensaje_seguimiento_queja = "
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p style='color: #483D8B;' align='center'><b>Datos del Seguimiento</b></p>
			</div>					
		</div>	
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Seguimiento:</b> $seguimiento</p>
			</div>				
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Fecha Seguimiento:</b> $fecha</p>
			</div>	
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Solución:</b> $solucion</p>
			</div>			
		</div>			
	";	
}else{
	$mensaje_seguimiento_queja = "
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p style='color: #FF0000;' align='center'><b>No hay datos que mostrar</b></p>
			</div>					
		</div>
	";
}

$mensaje .= $mensaje_seguimiento_queja;

echo $mensaje;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>