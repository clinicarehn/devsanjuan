<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$ata_id = $_POST['ata_id'];

$consulta = "SELECT CONCAT(p.nombre,' ',p.apellido) AS 'paciente', p.expediente AS 'expediente', p.identidad AS 'identidad', d.nombre AS 'departamento', m.nombre AS 'municipio', p.sexo AS 'sexo', at.años, pa.patologia_id AS 'patologia_id', pa.nombre AS 'patologia'
	FROM referencia_recibida AS rr
	INNER JOIN ata as at
	ON rr.ata_id = at.ata_id
	INNER JOIN pacientes AS p
	ON rr.expediente = p.expediente
	INNER JOIN departamentos AS d
	ON p.departamento_id = d.departamento_id
	INNER JOIN municipios AS m
	ON p.municipio_id = m.municipio_id
	INNER JOIN patologia AS pa
	ON rr.patologia_id = pa.id
	WHERE rr.ata_id = '$ata_id'";
$result = $mysqli->query($consulta);

$consulta1 = $result->fetch_assoc();

if($result->num_rows>0){
  $nombre = $consulta1['paciente'];
  $expediente = $consulta1['expediente'];
  $identidad = $consulta1['identidad'];
  
  if($consulta1['sexo'] == 'H'){
	  $sexo = 'Hombre';
  }else{
	  $sexo = 'Mujer';
  }
  
  $departamento = $consulta1['departamento'];
  $municipio = $consulta1['municipio'];
  
  $clinico = $consulta1['patologia'];
  
  $patologia = $consulta1['patologia_id'];   
echo " 
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Nombre:</b> $nombre</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Expediente:</b> $expediente</p>
		</div>
		<div class='col-md-4 mb-6 sm-'>
		  <p><b>Identidad:</b> $identidad</p>
		</div>		
	</div>
	
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Sexo:</b> $sexo</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Departamento:</b> $departamento</p>
		</div>
		<div class='col-md-4 mb-6 sm-'>
		  <p><b>Municipio:</b> $municipio</p>
		</div>		
	</div>	
	
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>CIE-10:</b> $patologia</p>
		</div>
		<div class='col-md-8 mb-6 sm-3'>
		  <p><b>Diagnostico Completo Segun CIE10:</b> $clinico</p>
		</div>	
	</div>
";  
}else{
	echo 1;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>