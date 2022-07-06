<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$fecha_consulta = date('Y-m-d');
$ata_seguimiento_id = $_POST['ata_seguimiento_id'];


//CONSULTAR VALORES ATA SEGUIMIENTO
$query = "SELECT CONCAT(pseg.apellidos,' ',pseg.nombres) AS 'paciente', ase.fecha AS 'fecha', 
    (CASE WHEN pseg.genero = 'H' THEN 'Hombre' ELSE 'Mujer' END) AS 'genero', 
	pseg.identidad AS 'identidad', d.nombre AS 'departamento', m.nombre AS 'municipio', pseg.telefono AS 'telefono',
    (CASE WHEN ase.ansioso = '1' THEN 'Sí' ELSE 'No' END) AS 'ansioso',
	(CASE WHEN ase.depresivo = '1' THEN 'Sí' ELSE 'No' END) AS 'depresivo',
	(CASE WHEN ase.psicotico = '1' THEN 'Sí' ELSE 'No' END) AS 'psicotico',
	(CASE WHEN ase.agitacion = '1' THEN 'Sí' ELSE 'No' END) AS 'agitacion',
	(CASE WHEN ase.insomnio = '1' THEN 'Sí' ELSE 'No' END) AS 'insomnio',
	(CASE WHEN ase.abandono_medicamento = '1' THEN 'Sí' ELSE 'No' END) AS 'abondono_medicamento',
	(CASE WHEN ase.otros_sitomas = '1' THEN 'Sí' ELSE 'No' END) AS 'otros_sintomas',
	(CASE WHEN ase.conducta_riesgo = '1' THEN 'Sí' ELSE 'No' END) AS 'conducta_riesgo',
	ase.comentario AS 'comentario' , CONCAT(c.apellido,' ',c.nombre) AS 'colaborador', at_seg.nombre AS 'atencion'
	FROM ata_seguimiento AS ase
	INNER JOIN colaboradores AS c
	ON ase.usuario = c.colaborador_id
	INNER JOIN pacientes_seguimiento AS pseg
	ON ase.pacientes_seg_id = pseg.pacientes_seg_id
	INNER JOIN departamentos AS d
	ON pseg.departamento_id = d.departamento_id
	INNER JOIN municipios AS m
	ON pseg.municipio_id = m.municipio_id
	INNER JOIN atencion_seguimiento AS at_seg
	ON ase.atencion = at_seg.atencion_seguimiento_id
	WHERE ase.ata_seguimiento_id = '$ata_seguimiento_id'";
$result = $mysqli->query($query);	
$registro2 = $result->fetch_assoc();

$paciente = '';
$fecha = '';
$genero = '';
$identidad = '';
$departamento = '';
$nombre = '';
$telefono = '';
$ansioso = '';
$depresivo = '';
$psicotico = '';
$agitacion = '';
$insomnio = '';
$abondono_medicamento = '';
$otros_sintomas = '';
$conducta_riesgo = '';
$colaborador = '';
$comentario = '';
$atencion = '';
$mensaje = '';
$error = '';

if($result->num_rows>0){
	$paciente = $registro2['paciente'];
	$fecha = $registro2['fecha'];
	$genero = $registro2['genero'];
	$identidad = $registro2['identidad'];
	$departamento = $registro2['departamento'];
	$municipio = $registro2['municipio'];
	$telefono = $registro2['telefono'];
	$ansioso = $registro2['ansioso'];
	$depresivo = $registro2['depresivo'];
	$psicotico = $registro2['psicotico'];
	$agitacion = $registro2['agitacion'];
	$insomnio = $registro2['insomnio'];
	$abondono_medicamento = $registro2['abondono_medicamento'];
	$otros_sintomas = $registro2['otros_sintomas'];
	$conducta_riesgo = $registro2['conducta_riesgo'];
	$colaborador = $registro2['colaborador'];
    $comentario = $registro2['comentario'];	
	$atencion = $registro2['atencion'];	
	
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
			  <p><b>Teléfono:</b> $telefono</p>
			</div>				
		</div>	
	";
	//FIN DATOS DEL USUARIO

	$mensaje_seguimiento = "
		<div class='form-row'>
			<div class='col-md-12 mb-6 sm-3'>
			  <p style='color: #483D8B;' align='center'><b>Seguimiento Telefónico</b></p>
			</div>					
		</div>
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Ansioso:</b> $ansioso</p>
			</div>				
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Depresivo:</b> $depresivo</p>
			</div>	
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Psicotico:</b> $psicotico</p>
			</div>				
		</div>
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Agitación:</b> $agitacion</p>
			</div>				
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Insomnio:</b> $insomnio</p>
			</div>	
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Abondono Medicamento:</b> $abondono_medicamento</p>
			</div>				
		</div>	
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Otros Sintomas:</b> $otros_sintomas</p>
			</div>				
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Conducta de Riesgo:</b> $conducta_riesgo</p>
			</div>	
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Atención:</b> $atencion</p>
			</div>				
		</div>	
		<div class='form-row'>
			<div class='col-md-4 mb-6 sm-3'>
			  <p><b>Colaborador:</b> $colaborador</p>
			</div>								
		</div> 	
		<div class='form-row'>			
			<div class='col-md-12 mb-6 sm-3'>
			  <p><b>Comentario:</b> $comentario</p>
			</div>					
		</div> 			
	";	
	
	$mensaje .= $mensaje_datos_usuario.' '.$mensaje_seguimiento;
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