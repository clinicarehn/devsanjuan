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
$profesional = $_POST['medico_general'];
$desde = $_POST['fechai'];
$hasta = $_POST['fechaf'];
$dato = $_POST['dato'];	
	
if($servicio != "" && $unidad == "" && $profesional == ""){
	$where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND color = '#824CC8' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}else if ($servicio != "" && $unidad != "" && $profesional == ""){
   $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND color = '#824CC8' AND c.puesto_id = '$unidad' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";				
}else{
   $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND color = '#824CC8' AND c.puesto_id = '$unidad' AND c.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}

$query = "SELECT CAST(a.fecha_registro AS DATE) AS 'fecha_registro', p.expediente As 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS 'paciente', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', pc.nombre AS 'puesto', s.nombre AS 'servicio', CAST(a.fecha_cita AS DATE) AS 'fecha_cita', a.hora AS 'hora', CONCAT(u.nombre,' ',u.apellido) AS 'usuario'
	 FROM agenda AS a
	 INNER JOIN pacientes AS p
	 ON a.pacientes_id = p.pacientes_id
	 INNER JOIN colaboradores AS c
	 ON a.colaborador_id = c.colaborador_id
	 INNER JOIN servicios AS s
	 ON a.servicio_id = s.servicio_id
	 INNER JOIN puesto_colaboradores As pc
	 ON c.puesto_id = pc.puesto_id
	 INNER JOIN colaboradores AS u
	 ON a.usuario = u.colaborador_id
	 ".$where." 
	 ORDER BY c.puesto_id, a.fecha_registro ASC";		
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
 
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_busqueda_reportes('.(1).');void(0);">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_busqueda_reportes('.($paginaActual-1).');void(0);">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_busqueda_reportes('.($paginaActual+1).');void(0);">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_busqueda_reportes('.($nroPaginas).');void(0);">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

$registro = "SELECT CAST(a.fecha_registro AS DATE) AS 'fecha_registro', p.expediente As 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS 'paciente', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', pc.nombre AS 'puesto', s.nombre AS 'servicio', CAST(a.fecha_cita AS DATE) AS 'fecha_cita', a.hora AS 'hora', CONCAT(u.nombre,' ',u.apellido) AS 'usuario'
	 FROM agenda AS a
	 INNER JOIN pacientes AS p
	 ON a.pacientes_id = p.pacientes_id
	 INNER JOIN colaboradores AS c
	 ON a.colaborador_id = c.colaborador_id
	 INNER JOIN servicios AS s
	 ON a.servicio_id = s.servicio_id
	 INNER JOIN puesto_colaboradores As pc
	 ON c.puesto_id = pc.puesto_id
	 INNER JOIN colaboradores AS u
	 ON a.usuario = u.colaborador_id
	 ".$where." 
	 ORDER BY c.puesto_id, a.fecha_registro ASC
	 LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);		 


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="8%">Fecha Registro</th>
			<th width="20%">Nombre</th>				
			<th width="4%">Expediente</th>
			<th width="9%">Identidad</th>				
			<th width="14%">Colaborador</th>
			<th width="5%">Puesto</th>
			<th width="16%">Servicio</th>
			<th width="8%">Fecha Cita</th>				
			<th width="4%">Hora</th>
			<th width="12%">Usuario</th>	
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){	

	if($registro2['expediente'] == 0){
		$expediente = 'TEMP';
	}else{
		$expediente = $registro2['expediente'];
	}
	
	$tabla = $tabla.'<tr>
	   <td>'.$registro2['fecha_registro'].'</a></td>   
	   <td>'.$registro2['paciente'].'</td>
	   <td>'.$expediente.'</td>
	   <td>'.$registro2['identidad'].'</td>		   
	   <td>'.$registro2['colaborador'].'</td>
	   <td>'.$registro2['puesto'].'</td>
	   <td>'.$registro2['servicio'].'</td>
	   <td>'.$registro2['fecha_cita'].'</td>
	   <td>'.$registro2['hora'].'</td>
	   <td>'.$registro2['usuario'].'</td>	
	</tr>';	        
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="10" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="10"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>