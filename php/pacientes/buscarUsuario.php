<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$id = $_POST['id'];
date_default_timezone_set('America/Tegucigalpa');

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$query = "SELECT DISTINCT p.pacientes_id AS pacientes_id, p.expediente AS expediente, CONCAT(p.apellido, ' ', p.nombre) AS 'paciente_nombre', 
	         p.identidad AS identidad, p.sexo AS sexo, p.fecha_nacimiento AS fecha_nacimiento, p.telefono AS telefono,
			 p.telefono1 AS telefono1, d.departamento_id AS departamento, m.municipio_id AS municipio, p.localidad AS localidad, p.responsable AS responsable, 
			 p.parentesco AS parentesco, p.telefonoresp AS telefonoresp, p.telefonoresp1 AS telefonoresp1, p.fecha AS fecha
             FROM pacientes AS p
             LEFT JOIN departamentos AS d
             ON p.departamento_id = d.departamento_id
             LEFT JOIN municipios AS m
             ON p.municipio_id = m.municipio_id 
			 WHERE p.pacientes_id = '$id'";
			 
$result = $mysqli->query($query);			 

$valores2 = $result->fetch_assoc();

$fecha_de_nacimiento = $valores2['fecha_nacimiento'];

/*********************************************************************************/
$valores_array = getEdad($fecha_de_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/
if ($anos>1 ){
   $palabra_anos = "Años";
}else{
  $palabra_anos = "Año";
}

if ($meses>1 ){
   $palabra_mes = "Meses";
}else{
  $palabra_mes = "Mes";
}

if($dias>1){
	$palabra_dia = "Días";
}else{
	$palabra_dia = "Día";
}

if ($valores2['expediente'] == 0){
  $expediente = "TEMP"; 
}else{
  $expediente = $valores2['expediente'];
}
	 
if( strlen($valores2['identidad'])<10 ){
	$bloqueo = 2; //NO SE BLOQUEA	   	   
}else{
	$bloqueo = 1; //SI SE BLOQUEA	   
}	 
	 
$datos = array(
				0 => $valores2['paciente_nombre'], 
				1 => $valores2['identidad'], 
				2 => $valores2['sexo'], 
				3 => $valores2['fecha_nacimiento'], 	
                4 => $valores2['fecha'],	
                5 => $expediente,	
                6 => $anos." ".$palabra_anos.", ".$meses." ".$palabra_mes." y ".$dias." ".$palabra_dia			
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>