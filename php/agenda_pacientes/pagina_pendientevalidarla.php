<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 	

date_default_timezone_set('America/Tegucigalpa');
$paginaActual = $_POST['partida'];
$status = $_POST['atencion'];
$dato = $_POST['dato'];
$fecha = $_POST['fecha'];
$fechaf = $_POST['fechaf'];

$servicio = '';
$unidad = '';
$colaborador = '';
$fecha_actual = date("Y-m-d");

if($_POST['servicio'] != '' || $_POST['servicio'] != 0){
	$servicio = "AND a.servicio_id = '".$_POST['servicio']."'";
}

if($_POST['unidad'] != '' || $_POST['unidad'] != 0){
	$unidad =  "AND c.puesto_id = '".$_POST['unidad']."'";
}

if($_POST['medico_general'] != '' || $_POST['medico_general'] != 0){
	$colaborador =  "AND a.colaborador_id = '".$_POST['medico_general']."'";
}

if($status == 5){//AGENDA
	$status = "AND a.status IN(0,1,2) AND a.color IN('#0071c5','#008000')";
}

if($status >= 0 || $status < 5){//AGENDA
	$status = "AND a.status = '".$status."'";
}
	
/*
if($servicio != 0 && $unidad == 0 && $medico_general == 0 && $status != ""){
   if($status == 3){
	  $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND a.hora <> '00:00' AND a.color <> '#824CC8' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }else if($status == 5){
	  $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND a.color IN('#0071c5','#008000','#B7950B') AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }else{
	  $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }
   
}else if($servicio != 0 && $unidad != 0 && $medico_general == 0 && $status != ""){		
   if($status == 3){
	  $where = " WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.hora <> '00:00' AND a.color <> '#824CC8' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }else if($status == 5){
	  $where = " WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.color IN('#0071c5','#008000','#B7950B') AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }else{
	  $where = " WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }
   
}else if($servicio != 0 && $unidad != 0 && $medico_general != 0 && $status != ""){
   if($status == 3){
	  $where = " WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.colaborador_id = '$medico_general' AND a.hora <> '00:00' AND a.color <> '#824CC8' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";			   
   }else if($status == 5){
	  $where = " WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.colaborador_id = '$medico_general' AND a.color IN('#0071c5','#008000','#B7950B') AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";			   
   }else{
	  $where = " WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.colaborador_id = '$medico_general' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";			   
   }
   
}else{	   
   if($status == 3){
	   $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND a.hora <> '00:00' AND a.color <> '#824CC8' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }else if($status == 5){
	   $where = "WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND a.color IN('#0071c5','#008000','#B7950B') AND (p.expediente LIKE '%$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }else{
	   $where = " WHERE cast(a.fecha_cita as date) BETWEEN '$fecha' AND '$fechaf' AND a.status $in AND a.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		   
   }	   
}
*/

	$query = "SELECT DISTINCT a.servicio_id AS 'servicio_id', a.agenda_id as 'agenda_id', a.pacientes_id AS 'pacientes_id', (CASE WHEN a.expediente = '0' THEN 'TEMP' ELSE a.expediente END) AS 'expediente', CONCAT(p.apellido, ' ', p.nombre) AS 'paciente_nombre', a.hora AS 'hora', DATE_FORMAT(CAST(a.fecha_cita AS DATE ), '%d/%m/%Y') AS 'fecha_cita',
	CONCAT(c.nombre, ' ', c.apellido) As doctor, p.telefono AS 'telefono', p.telefono1 AS 'telefono1', p.telefonoresp AS 'telefonoresp',
	p.telefonoresp1 AS 'telefonoresp1', c.colaborador_id AS 'colaborador_id', (CASE WHEN a.observacion = '' THEN 'No hay ninguna observacion' ELSE a.observacion END) AS 'observacion', (CASE WHEN a.comentario = '' THEN 'No hay ningún comentario' ELSE a.comentario END) AS 'comentario', CONCAT(c1.apellido, ' ', c1.nombre) As usuario, p.identidad AS 'identidad', a.expediente AS 'expediente', a.servicio_id AS 'servicio_id', CAST(a.fecha_cita AS DATE) AS 'fecha_cita_consulta', c.puesto_id AS 'puesto_id', CAST(a.fecha_cita AS DATE) AS 'fecha', a.servicio_id AS 'servicio_id', (CASE WHEN a.paciente = 'N' THEN 'N' ELSE 'S' END) AS paciente
	FROM agenda AS a 
	INNER JOIN pacientes AS p 
	ON a.pacientes_id = p.pacientes_id 
	INNER JOIN colaboradores AS c 
	ON a.colaborador_id = c.colaborador_id
	INNER JOIN colaboradores AS c1
	ON a.usuario = c1.colaborador_id
   WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fecha' AND '$fechaf'
   $servicio
   $unidad
   $colaborador
   $status
   ORDER BY a.hora, a.pacientes_id ASC";

$result = $mysqli->query($query);
   
$nroLotes = 20;
$nroProductos = $result->num_rows;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.(1).');void(0);">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual-1).');void(0);">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual+1).');void(0);">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($nroPaginas).');void(0);">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

	$registro = "SELECT DISTINCT a.servicio_id AS 'servicio_id', a.agenda_id as 'agenda_id', a.pacientes_id AS 'pacientes_id', (CASE WHEN a.expediente = '0' THEN 'TEMP' ELSE a.expediente END) AS 'expediente', CONCAT(p.apellido, ' ', p.nombre) AS 'paciente_nombre', a.hora AS 'hora', DATE_FORMAT(CAST(a.fecha_cita AS DATE ), '%d/%m/%Y') AS 'fecha_cita',
	CONCAT(c.nombre, ' ', c.apellido) As doctor, p.telefono AS 'telefono', p.telefono1 AS 'telefono1', p.telefonoresp AS 'telefonoresp',
	p.telefonoresp1 AS 'telefonoresp1', c.colaborador_id AS 'colaborador_id', (CASE WHEN a.observacion = '' THEN 'No hay ninguna observacion' ELSE a.observacion END) AS 'observacion', (CASE WHEN a.comentario = '' THEN 'No hay ningún comentario' ELSE a.comentario END) AS 'comentario', CONCAT(c1.apellido, ' ', c1.nombre) As usuario, p.identidad AS 'identidad', a.expediente AS 'expediente', a.servicio_id AS 'servicio_id', CAST(a.fecha_cita AS DATE) AS 'fecha_cita_consulta', c.puesto_id AS 'puesto_id', CAST(a.fecha_cita AS DATE) AS 'fecha', a.servicio_id AS 'servicio_id', (CASE WHEN a.paciente = 'N' THEN 'N' ELSE 'S' END) AS paciente
	FROM agenda AS a 
	INNER JOIN pacientes AS p 
	ON a.pacientes_id = p.pacientes_id 
	INNER JOIN colaboradores AS c 
	ON a.colaborador_id = c.colaborador_id
	INNER JOIN colaboradores AS c1
	ON a.usuario = c1.colaborador_id  
   WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fecha' AND '$fechaf'
   $servicio
   $unidad
   $colaborador
   $status
   ORDER BY a.hora, a.pacientes_id ASC LIMIT $limit, $nroLotes";
  
$result = $mysqli->query($registro);

/*
	<th>
	   <input type="checkbox" name="seleccionar" class="form-control" id="checkAll">
	</th>	
*/
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
		  <tr>	  
			<th width="1.14%">N°</th>
			<th width="3.14%">Expediente</th>
			<th width="7.14%">Identidad</th>
			<th width="21.28%">Nombre</th>
			<th width="7.14%">Fecha Cita</th>
			<th width="10.14%">Hora</th>	
			<th width="3.14%">Paciente</th>				
			<th width="7.14%">Profesional</th>
			<th width="13.28%">Observación</th>
			<th width="9.14%">Comentario</th>	
			<th width="7.14%">Usuario</th>				
			<th width="10.14%">Opciones</th>
		   </tr>';
			
$i=1;			
while($registro2 = $result->fetch_assoc()){
	$pacientes_id = $registro2['pacientes_id'];
	$expediente = $registro2['expediente'];
	$servicio_id = $registro2['servicio_id'];
	$colaborador_id = $registro2['colaborador_id'];
	$fecha_cita = $registro2['fecha_cita_consulta'];

	$telefonousuario = "";
	if($registro2['telefono'] != ""){
	 $telefonousuario = '<a style="text-decoration:none" title = "Teléfono Usuario" href="tel:9'.$registro2['telefono'].'">'.$registro2['telefono'].'</a>'; 
	 $telefonousuariosms = $registro2['telefono'];
	}

	if($registro2['telefono1'] != ""){
	 $telefonousuario1 = '<a style="text-decoration:none" title = "Teléfono Usuario" href="tel:9'.$registro2['telefono1'].'">'.$registro2['telefono1'].'</a>'; 
	 $telefonousuariosms .= ", ".$registro2['telefono1'];
	}else{
	 $telefonousuario1 = '';
	} 

	$observacion = $registro2['observacion'];
  
	/*
	//INICIO CONSULTAR MENSAJE CONFIRMACION AGENDA
	$query_confirmacion_agenda = "SELECT confirmacion_agenda_id, observacion, confirmo
	 FROM confirmacion_agenda AS conf_agenda
	 WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id'";
	$result_confirmacion_agenda = $mysqli->query($query_confirmacion_agenda) or die($mysqli->error);
	$registro_confirmacion_agenda2 = $result_confirmacion_agenda->fetch_assoc();		  

	if ($result_confirmacion_agenda->num_rows != 0){
	$observacion = $observacion."***".$registro_confirmacion_agenda2['observacion'];
	}	 	  
	//FIN CONSULTAR MENSAJE CONFIRMACION AGENDA

	//INICIO CONSULTAR MENSAJE CONFIRMACION DE AUSENCIA PARA LA REPROGRAMACIÓN
	$query_confirmacion = "SELECT confirmar_ausencias_repro_id, observacion, confirmo
	  FROM confirmar_ausencias_repro
	  WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id'"; 
	$result_confirmacion = $mysqli->query($query_confirmacion) or die($mysqli->error);
	$registro_confirmacion2 = $result_confirmacion->fetch_assoc();	  

	if ($result_confirmacion->num_rows != 0){
	$observacion = $observacion."***".$registro_confirmacion2['observacion'];
	}	

	//CONSULTAR PUESTO COLABORADOR			  
	$consultar_puesto = "SELECT puesto_id 
	   FROM colaboradores 
	   WHERE colaborador_id = '$colaborador_id'";
	$result_puesto_colaborador = $mysqli->query($consultar_puesto);
	$consultar_puesto1 = $result_puesto_colaborador->fetch_assoc();

	$consultar_colaborador_puesto_id = "";

	if($result_puesto_colaborador->num_rows>0){
		$consultar_colaborador_puesto_id = $consultar_puesto1['puesto_id'];
	}*/

  //FIN CONSULTAR MENSAJE CONFIRMACION DE AUSENCIA PARA LA REPROGRAMACIÓN	  
    /*
  	   <td>
		  <input type="checkbox" name="checkeliminar" class="itemRow form-control" id="checkeliminar">
	   </td>	
	*/
	$tabla = $tabla.'<tr>
	   <td>'.$i.'</td>
	   <td><a style="text-decoration:none" href="javascript:sendOneSMS('.$registro2['pacientes_id'].','.$registro2['agenda_id'].');">'.$registro2['expediente'].'</a></td>			
	   <td title='.$registro2['usuario'].'>'.$registro2['identidad'].'</td>
	   <td>'.$registro2['paciente_nombre'].'</td>
	   <td>'.$registro2['fecha_cita'].'</td>
	   <td>'.date('g:i a',strtotime($registro2['hora'])).'</td>	
	   <td>'.$registro2['paciente'].'</td>  
	   <td>'.$registro2['doctor'].'</td>	   
	   <td>'.$observacion.'</td>
	   <td>'.$registro2['comentario'].'</td>		   
	   <td>'.$registro2['usuario'].'</td>	   
	   <td>
		   <a style="text-decoration:none;" href="javascript:modal_triage('.$registro2['agenda_id'].','.$registro2['colaborador_id'].','.$registro2['servicio_id'].','.$registro2['pacientes_id'].','.$registro2['expediente'].');void(0);" title="Triage" class="fas fa-user-md fa-lg"></a>
		   <a style="text-decoration:none;" href="javascript:modal_agregar_confirmacion('.$registro2['agenda_id'].','.$registro2['colaborador_id'].','.$registro2['servicio_id'].');void(0);" title="Agregar Confirmación Agenda de Usuarios" class="fas fa-calendar-plus fa-lg"></a>		   
		   <a style="text-decoration:none;" title = "Reprogramar Usuarios" href="javascript:editarRegistro('.$registro2['agenda_id'].','.$registro2['colaborador_id'].','.$registro2['pacientes_id'].','.$registro2['servicio_id'].');void(0);" class="fas fa-calendar-check fa-lg"></a>
		   <a style="text-decoration:none;" title="Imprimir Ticket" href="javascript:reportePDF('.$registro2['agenda_id'].');void(0);" class="fas fa-print fa-lg"></a>
		   <a style="text-decoration:none;" title="Eliminar Cita a Usuario" href="javascript:modal_eliminar('.$registro2['agenda_id'].');void(0);" class="fas fa-trash fa-lg"></a>
		   <a style="text-decoration:none;" title = "Marcar Ausencia a Usuarios" href="javascript:nosePresentoRegistro('.$registro2['agenda_id'].','.$registro2['pacientes_id'].','.$registro2['fecha'].');void(0);" class="fas fa-times-circle fa-lg"></a>
	   </td>
  </tr>';		
  $i++;
}        	   

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="15" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="15"><b><p ALIGN="center">Total de Registros Encontrados '.number_format($nroProductos).'</p></b>
   </tr>';		
}

$tabla = $tabla.'</table>';	

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>