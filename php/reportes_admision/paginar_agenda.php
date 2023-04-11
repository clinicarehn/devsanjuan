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
	$where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}else if ($servicio != "" && $unidad != "" && $profesional == ""){
   $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND c.puesto_id = '$unidad' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";				
}else{
   $where = "WHERE CAST(a.fecha_registro AS DATE) BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND a.hora <> 0 AND c.puesto_id = '$unidad' AND c.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}

$query = "SELECT a.pacientes_id AS 'pacientes_id', CAST(a.fecha_registro AS DATE) AS 'fecha_registro', p.expediente As 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS 'paciente', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', pc.nombre AS 'puesto', s.nombre AS 'servicio', CAST(a.fecha_cita AS DATE) AS 'fecha_cita', a.hora AS 'hora', CONCAT(u.nombre,' ',u.apellido) AS 'usuario', c.puesto_id AS 'puesto_id', a.servicio_id AS 'servicio_id'
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

$registro = "SELECT a.pacientes_id AS 'pacientes_id', CAST(a.fecha_registro AS DATE) AS 'fecha_registro', p.expediente As 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS 'paciente', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', pc.nombre AS 'puesto', s.nombre AS 'servicio', CAST(a.fecha_cita AS DATE) AS 'fecha_cita', a.hora AS 'hora', CONCAT(u.nombre,' ',u.apellido) AS 'usuario', c.puesto_id AS 'puesto_id', a.servicio_id AS 'servicio_id'
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
			<th width="8.09%">Fecha Registro</th>
			<th width="21.09%">Nombre</th>				
			<th width="6.09%">Expediente</th>
			<th width="9.09%">Identidad</th>				
			<th width="11.09%">Colaborador</th>
			<th width="5.09%">Puesto</th>
			<th width="9.09%">Servicio</th>
			<th width="8.09%">Fecha Cita</th>				
			<th width="4.09%">Hora</th>
			<th width="4.09%">Paciente</th>
			<th width="12.09%">Usuario</th>	
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){	

	if($registro2['expediente'] == 0){
		$expediente = 'TEMP';
	}else{
		$expediente = $registro2['expediente'];
	}
	
   $busq_paciente_id = $registro2['pacientes_id'];
   $busq_servicio = $registro2['servicio_id'];
   $busq_puesto = $registro2['puesto_id'];
	   
   $consultar_expediente = "SELECT a.agenda_id AS 'agenda_id'
		 FROM agenda AS a
		 INNER JOIN colaboradores AS c
		 ON a.colaborador_id = c.colaborador_id
		 WHERE pacientes_id = '$busq_paciente_id' AND a.servicio_id = '$busq_servicio' AND c.puesto_id = '$busq_puesto' AND a.status = 1";
   $result_expediente = $mysqli->query($consultar_expediente);			 

   $consultar_expediente1 = $result_expediente->fetch_assoc();  
   $paciente_consultar_expediente1 = $consultar_expediente1['agenda_id'];
   
   if($paciente_consultar_expediente1 == ""){
	   $paciente = 'N';
   }else{
	   $paciente = 'S';
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
	   <td>'.$paciente.'</td>
	   <td>'.$registro2['usuario'].'</td>	
	</tr>';	        
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="11" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="11"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>