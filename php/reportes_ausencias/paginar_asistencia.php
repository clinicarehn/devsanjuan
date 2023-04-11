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
	
if($servicio != "" && $unidad == "" && $profesional == ""){
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}else if ($servicio != "" && $unidad != "" && $profesional == ""){
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";				
}else{
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND c.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}

$query = "SELECT c.colaborador_id AS 'colaborador_id', s.servicio_id AS 'servicio_id', a.fecha AS 'fecha_cita1', p.expediente AS 'expediente', a.ata_id AS 'ata_id',  a.fecha AS 'fecha', p.identidad AS 'identidad', (CASE WHEN a.paciente = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', a.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', a.ata_id As 'ata_id'
  FROM ata AS a
  INNER JOIN pacientes AS p
  ON a.expediente = p.expediente
  INNER JOIN colaboradores AS c
  ON a.colaborador_id = c.colaborador_id
  INNER JOIN servicios As s
  ON a.servicio_id = s.servicio_id
  ".$where."
  ORDER BY a.fecha ASC";
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

$registro = "SELECT c.colaborador_id AS 'colaborador_id', s.servicio_id AS 'servicio_id', a.fecha AS 'fecha_cita1', p.expediente AS 'expediente', a.ata_id AS 'ata_id', a.fecha AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.identidad AS 'identidad', (CASE WHEN a.paciente = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', a.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', a.ata_id As 'ata_id'
  FROM ata AS a
  INNER JOIN pacientes AS p
  ON a.expediente = p.expediente
  INNER JOIN colaboradores AS c
  ON a.colaborador_id = c.colaborador_id
  INNER JOIN servicios As s
  ON a.servicio_id = s.servicio_id
  ".$where."
  ORDER BY a.fecha
  LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="7.69%">Fecha Registro</th>
			<th width="7.69%">Fecha Cita</th>
			<th width="24.69%">Nombre</th>				
			<th width="7.69%">Expediente</th>
			<th width="7.69%">Identidad</th>				
			<th width="2.69%">H</th>
			<th width="2.69%">M</th>				
			<th width="2.69%" title="Esto es según la clasificación de SESAL">N</th>
			<th width="2.69%" title="Esto es según la clasificación de SESAL">S</th>				
			<th width="9.69%">Servicio</th>
			<th width="10.69%">Profesional</th>	
			<th width="7.69%">Reprogramo</th>	
			<th width="5.69%">Opciones</th>				
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){	
	//CONSULTAR PACIENTE EN LA AGENDA
	$expediente_ = $registro2['expediente'];
	$servicio_id = $registro2['servicio_id'];
	$colaborador_id = $registro2['colaborador_id'];
	$fecha_cita1 = $registro2['fecha_cita1'];
	
	$consultar_agenda_paciente = "SELECT DATE_FORMAT(fecha_registro, '%d/%m/%Y') AS 'fecha_registro', (CASE WHEN reprogramo = 1 THEN 'Reprogramo' ELSE '' END) AS 'reprogramo'
		FROM agenda
		WHERE expediente ='$expediente_' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND status = 1 AND CAST(fecha_cita AS DATE) = '$fecha_cita1'";

	$result_agenda_paciente = $mysqli->query($consultar_agenda_paciente);
	$registro2_agenda_paciente = $result_agenda_paciente->fetch_assoc();
	
	$fecha_registro = "";
	$reprogramo  = "";
	
	if($result_agenda_paciente->num_rows>0){
		$fecha_registro = $registro2_agenda_paciente['fecha_registro']; 
		$reprogramo = $registro2_agenda_paciente['reprogramo']; 
	}

	if($registro2['expediente'] == 0){
		$expediente = 'TEMP';
	}else{
		$expediente = $registro2['expediente'];
	}
	
	$tabla = $tabla.'<tr>
	   <td><a style="text-decoration:none" title = "Información de Usuario" href="javascript:showDetailsATA('.$registro2['ata_id'].');">'.$fecha_registro.'</a></td>
	   <td>'.$registro2['fecha'].'</a></td>   
	   <td>'.$registro2['nombre'].'</td>
	   <td>'.$expediente.'</td>
	   <td>'.$registro2['identidad'].'</td>		   
	   <td>'.$registro2['h'].'</td>
	   <td>'.$registro2['m'].'</td>
	   <td>'.$registro2['nuevo'].'</td>
	   <td>'.$registro2['subsiguiente'].'</td>
	   <td>'.$registro2['servicio'].'</td>
	   <td>'.$registro2['medico'].'</td>
	   <td>'.$reprogramo.'</td>		   
	   <td>
		   <a title = "Eliminar Registro" href="javascript:modal_eliminarAsistencia('.$registro2['ata_id'].','.$registro2['expediente'].');" class="fas fa-trash fa-lg" style="text-decoration:none;"></a>
	   </td>
	</tr>';	        
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="15" style="color:#C7030D">No se encontraron resultados</td>
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