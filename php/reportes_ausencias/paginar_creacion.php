<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');

$paginaActual = $_POST['partida'];
$servicio = $_POST['servicio'];
$unidad = $_POST['unidad'];
$profesional = $_POST['profesional'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$dato = $_POST['dato'];	
$dato = $_POST['dato'];	
$reporte = $_POST['reporte'];
$colaborador_usuario = $_POST['colaborador_usuario'];	
	
if($servicio != "" && $unidad == "" && $profesional == "" && $colaborador_usuario == ""){
	$where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}else if ($servicio != "" && $unidad != "" && $profesional == "" && $colaborador_usuario == ""){
   $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";				
}else if ($servicio != "" && $unidad != "" && $profesional != "" && $colaborador_usuario == ""){
   $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND c.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}else{
   $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.usuario = '$colaborador_usuario' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}

$query = "SELECT a.agenda_id AS 'agenda_id', CAST(a.fecha_cita AS DATE) AS 'fecha_cita', CAST(a.fecha_registro AS DATE) AS 'fecha_registro', p.identidad AS 'identidad', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', a.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', a.observacion AS 'observacion', a.comentario AS 'comentario', (CASE WHEN a.paciente = 'N' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', a.status AS 'status'
   FROM agenda AS a
   INNER JOIN pacientes AS p
   ON a.pacientes_id = p.pacientes_id
   INNER JOIN colaboradores AS c
   ON a.colaborador_id = c.colaborador_id
   INNER JOIN servicios s
   ON a.servicio_id = s.servicio_id 
   INNER JOIN colaboradores AS c1
   ON a.usuario = c1.colaborador_id	 	   
   ".$where."
   ORDER BY a.fecha_cita ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
 
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_ausencias('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_ausencias('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li><a href="javascript:pagination_ausencias('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_ausencias('.($nroPaginas).');">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT a.agenda_id AS 'agenda_id', CAST(a.fecha_cita AS DATE) AS 'fecha_cita', CAST(a.fecha_registro AS DATE) AS 'fecha_registro', p.identidad AS 'identidad', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', a.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', a.observacion AS 'observacion', a.comentario AS 'comentario', (CASE WHEN a.paciente = 'N' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', a.status AS 'status'
   FROM agenda AS a
   INNER JOIN pacientes AS p
   ON a.pacientes_id = p.pacientes_id
   INNER JOIN colaboradores AS c
   ON a.colaborador_id = c.colaborador_id
   INNER JOIN servicios s
   ON a.servicio_id = s.servicio_id
   INNER JOIN colaboradores AS c1
   ON a.usuario = c1.colaborador_id	 
   ".$where."	   
   ORDER BY a.fecha_cita ASC
   LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="8.66%">Fecha Registro</th>
			<th width="8.66%">Fecha Cita</th>				
			<th width="10.66%">Nombre</th>				
			<th width="6.66%">Expediente</th>
			<th width="6.66%">Identidad</th>				
			<th width="2.66%">H</th>
			<th width="2.66%">M</th>	
			<th width="2.66%">N</th>
			<th width="2.66%">S</th>
			<th width="6.66%">Estatus</th>				
			<th width="8.66%">Servicio</th>
			<th width="8.66%">Profesional</th>				
			<th width="8.66%">Observación</th>
			<th width="8.66%">Comentario</th>
			<th width="6.66%">Usuario</th>								
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){			

	if($registro2['expediente'] == 0){
		$expediente = 'TEMP';
	}else{
		$expediente = $registro2['expediente'];
	}
	
	if($registro2['status'] == 0){
		$status = 'Pendiente';
	}else if($registro2['status'] == 1){
		$status = 'Atendido';
	}if($registro2['status'] == 2){
		$status = 'Ausente';
	}
	
	$tabla = $tabla.'<tr>
	   <td>'.$registro2['fecha_registro'].'</a></td>  		
	   <td>'.$registro2['fecha_cita'].'</a></td>    		   
	   <td>'.$registro2['nombre'].'</td>
	   <td>'.$expediente .'</td>
	   <td>'.$registro2['identidad'].'</td>		   
	   <td>'.$registro2['h'].'</td>
	   <td>'.$registro2['m'].'</td>
	   <td>'.$registro2['nuevo'].'</td>
	   <td>'.$registro2['subsiguiente'].'</td>	
	   <td>'.$status.'</td>		   
	   <td>'.$registro2['servicio'].'</td>
	   <td>'.$registro2['medico'].'</td>
	   <td>'.$registro2['observacion'].'</td>
	   <td>'.$registro2['comentario'].'</td>
	   <td>'.$registro2['usuario'].'</td>		   
	</tr>';	        
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="14" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="15"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>