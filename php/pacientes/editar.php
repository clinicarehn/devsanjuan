<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$id = $_POST['id'];
date_default_timezone_set('America/Tegucigalpa');

//CONSULTA EN LA ENTIDAD CORPORACION		 
$query = "SELECT DISTINCT p.pacientes_id AS pacientes_id, p.expediente AS expediente, p.nombre AS nombre, p.apellido AS apellido, 
	         p.identidad AS identidad, p.sexo AS sexo, p.fecha_nacimiento AS fecha_nacimiento, p.telefono AS telefono,
			 p.telefono1 AS telefono1, d.departamento_id AS departamento, m.municipio_id AS municipio, p.localidad AS localidad, p.responsable AS responsable, 
			 p.parentesco AS parentesco, p.telefonoresp AS telefonoresp, p.telefonoresp1 AS telefonoresp1, CAST(p.fecha AS DATE) AS fecha, p.pais AS 'pais',
			 p.estado_civil AS 'estado_civil', p.raza AS 'raza', p.religion AS 'religion', p.profesion AS 'profesion', p.lugar_nacimiento AS 'lugar_nacimiento',
			 p.email AS 'email', p.escolaridad AS 'escolaridad', p.tipo AS 'paciente_tipo'
             FROM pacientes AS p
             LEFT JOIN departamentos AS d
             ON p.departamento_id = d.departamento_id
             LEFT JOIN municipios AS m
             ON p.municipio_id = m.municipio_id 
			 LEFT JOIN pacientes_tipo AS pt
			 ON p.tipo = pt.pacientes_tipo_id
			 WHERE p.pacientes_id = '$id'";
			 
$result = $mysqli->query($query);			 

$valores2 = $result->fetch_assoc();

$nombres = $valores2['apellido'].' '.$valores2['nombre'];
$fecha_de_nacimiento = $valores2['fecha_nacimiento'];

//OBTENER LA EDAD DEL USUARIO 
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
				0 => $valores2['nombre'], 
 				1 => $valores2['apellido'],
				2 => $valores2['identidad'], 
				3 => $valores2['sexo'], 
				4 => $valores2['fecha_nacimiento'], 	
                5 => $valores2['telefono'], 
				6 => $valores2['telefono1'],
				7 => $valores2['departamento'],
				8 => $valores2['municipio'],
				9 => $valores2['localidad'],
				10 => $valores2['responsable'],	
				11 => $valores2['parentesco'],
				12 => $valores2['telefonoresp'],
				13 => $valores2['telefonoresp1'],
                14 => $valores2['fecha'],	
                15 => $expediente,	
                16 => $anos." ".$palabra_anos.", ".$meses." ".$palabra_mes." y ".$dias." ".$palabra_dia,	
                17 => $bloqueo,
                18 => $valores2['pais'],
                19 => $valores2['estado_civil'],
                20 => $valores2['raza'],
                21 => $valores2['religion'],
                22 => $valores2['profesion'],
                23 => $valores2['lugar_nacimiento'],
                24 => $valores2['email'],
                25 => $valores2['escolaridad'],
                26 => $nombres,	
                27 => $valores2['paciente_tipo'],				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>