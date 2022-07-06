<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['id'];
$agenda_id = $_POST['agenda_id'];

//CONSULTAMOS EL TIPO DE USUARIO
//CONSULTAR AGENDA
$query = "SELECT pacientes_id, expediente, servicio_id, colaborador_id, CAST(fecha_cita AS DATE) AS 'fecha_cita'
    FROM agenda 
	WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($query);
$consultar_agenda2 = $result->fetch_assoc();

$pacientes_id = "";
$expediente = "";
$servicio = "";
$fecha_cita = "";

if($result->num_rows>0){
	$pacientes_id = $consultar_agenda2['pacientes_id'];
	$expediente = $consultar_agenda2['expediente'];
	$servicio = $consultar_agenda2['servicio_id'];
	$fecha_cita = $consultar_agenda2['fecha_cita'];	
}

$fecha = date('Y-m-d');
$año = date("Y", strtotime($fecha));
$fecha_inical = date("Y-m-d", strtotime($año."-01-01"));
$fecha_final = date("Y-m-d", strtotime($año."-12-31"));
$colaborador_id = $_SESSION['colaborador_id'];

//CONSULTAR PUESTO
$consulta_puesto = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc();

$puesto_id = "";

if($result->num_rows>0){
	$puesto_id = $consulta_puesto1['puesto_id'];	
}
//CONSULTA EN LA ENTIDAD CORPORACION

$valores = "SELECT a.ata_id
     FROM ata AS a
     INNER JOIN colaboradores AS c
     ON a.colaborador_id = c.colaborador_id
     WHERE a.expediente = '$expediente' AND a.fecha BETWEEN '$fecha_inical' AND '$fecha_final' AND a.servicio_id = '$servicio' AND c.puesto_id = '$puesto_id'";
$result = $mysqli->query($valores);	 

$valores2 = $result->fetch_assoc();

if($result->num_rows>0){
	$paciente = "S";
}else{
	$paciente = "N";
}				

if($expediente == 0){
    $patologia_id = 0;
    $patologia_id1 = 0;
    $patologia_id2 = 0;	
}else{
	$consultar_patologias = "SELECT patologia_id, patologia_id1, patologia_id2 
	     FROM ata 
	     WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio'
		 ORDER BY ata_id DESC LIMIT 1";
    $result = $mysqli->query($consultar_patologias);
    $consultar_patologias1 = $result->fetch_assoc();
	
    $patologia_id = "";
    $patologia_id1 = "";
    $patologia_id2 = "";	
	
	if($result->num_rows>0){
		$patologia_id = $consultar_patologias1['patologia_id'];
		$patologia_id1 = $consultar_patologias1['patologia_id1'];
		$patologia_id2 = $consultar_patologias1['patologia_id2'];			
	}	
}	

//CONSULTA EN LA ENTIDAD PACIENTES
$valores = "SELECT d.departamento_id AS departamento, m.municipio_id AS municipio, p.localidad, CONCAT(p.apellido,' ',p.nombre) AS nombre
              FROM pacientes AS p
              INNER JOIN departamentos AS d
              ON p.departamento_id = d.departamento_id
              INNER JOIN municipios AS m
              ON p.municipio_id = m.municipio_id
              WHERE p.pacientes_id ='$id'";
$result = $mysqli->query($valores);			  

$valores2 = $result->fetch_assoc();

//CONSULTAR GLUCOMETRIA
$consulta_gluco = "SELECT glucometria 
    FROM preclinica_gluco 
	WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consulta_gluco);
$consulta_gluco2 = $result->fetch_assoc();

$glucometria = "";

if($result->num_rows>0){
   $glucometria = $consulta_gluco2['glucometria'];	
}

$datos = array(
				0 => $valores2['departamento'], 
				1 => $valores2['municipio'], 
 				2 => $valores2['localidad'],
                3 => $valores2['nombre'],
                4 => $paciente,
                5 => $patologia_id,
                6 => $patologia_id1,
                7 => $patologia_id2,				
                8 => $glucometria,	
                9 => $fecha_cita				
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>