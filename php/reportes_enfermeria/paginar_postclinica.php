<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');

$paginaActual = $_POST['partida'];
$servicio = $_POST['servicio'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$dato = $_POST['dato'];
$colaborador_usuario = $_POST['colaborador_usuario'];

if($colaborador_usuario == ""){
	$where = "WHERE CAST(post.fecha AS DATE) BETWEEN '$desde' AND '$hasta' and post.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}else{
	$where = "WHERE CAST(post.fecha AS DATE) BETWEEN '$desde' AND '$hasta' and post.servicio_id = '$servicio' AND post.usuario = '$colaborador_usuario' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}	

$query = "SELECT post.pacientes_id 'pacientes_id', post.postclinica_id AS 'postclinica_id', DATE_FORMAT(CAST(post.fecha AS DATE), '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', post.expediente AS 'expediente', p.identidad AS 'identidad', post.edad AS 'edad', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h',
  (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', pa.patologia_id AS 'patologia', pa.nombre AS 'diagnostico', post.fecha_cita AS 'fecha_cita', post.hora AS 'hora', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', post.instrucciones AS 'instrucciones', post.precedimiento As 'procedimiento', CONCAT(c1.nombre,' ',c1.apellido) AS 'usuario'
  FROM postclinica AS post
  INNER JOIN pacientes AS p
  ON post.expediente = p.expediente
  INNER JOIN patologia AS pa
  ON post.diagnostico = pa.id
  INNER JOIN servicios AS s
  ON post.servicio_id = s.servicio_id	
  INNER JOIN colaboradores AS c
  ON post.colaborador_id = c.colaborador_id
  INNER JOIN colaboradores AS c1
  ON post.usuario = c1.colaborador_id
  ".$where."
  ORDER BY post.fecha, post.expediente ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
  
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_preclinica('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_preclinica('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li><a href="javascript:pagination_preclinica('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_preclinica('.($nroPaginas).');">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

$registro = "SELECT post.pacientes_id 'pacientes_id', post.postclinica_id AS 'postclinica_id', DATE_FORMAT(CAST(post.fecha AS DATE), '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', post.expediente AS 'expediente', p.identidad AS 'identidad', post.edad AS 'edad', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h',
  (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', pa.patologia_id AS 'patologia', pa.nombre AS 'diagnostico', post.fecha_cita AS 'fecha_cita', post.hora AS 'hora', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', post.instrucciones AS 'instrucciones', post.precedimiento As 'procedimiento', CONCAT(c1.nombre,' ',c1.apellido) AS 'usuario'
  FROM postclinica AS post
  INNER JOIN pacientes AS p
  ON post.expediente = p.expediente
  INNER JOIN patologia AS pa
  ON post.diagnostico = pa.id
  INNER JOIN servicios AS s
  ON post.servicio_id = s.servicio_id	
  INNER JOIN colaboradores AS c
  ON post.colaborador_id = c.colaborador_id
  INNER JOIN colaboradores AS c1
  ON post.usuario = c1.colaborador_id
  ".$where."
  ORDER BY post.fecha, post.expediente
  LIMIT $limit, $nroLotes";
$result = $mysqli->query($query);


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="19.88%">Fecha</th>
			<th width="8.88%">Nombre</th>				
			<th width="3.88%">Exp</th>
			<th width="5.88%">Identidad</th>
			<th width="1.88%">Edad</th>
			<th width="1.88%">H</th>
			<th width="1.88%">M</th>					
			<th width="3.88%">CIE</th>
			<th width="3.88%">CIE-10 Completo</th>
			<th width="17.88%">Fecha Cita</th>				
			<th width="1.88%">Hora</th>
			<th width="3.88%">Servicio</th>
			<th width="3.88%">Medico</th>				
			<th width="4.88%">Instrucciones</th>
			<th width="4.88%">Procedimiento</th>
			<th width="4.88%">Usuario</th>
			<th width="4.88%">Opciones</th>				
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){	
	$tabla = $tabla.'<tr>
	   <td><a style="text-decoration:none" title = "Tratamiento a Usuarios" href="javascript:showTratamiento('.$registro2['postclinica_id'].','.$registro2['expediente'].');">'.$registro2['fecha'].'</a></td>   
	   <td>'.$registro2['nombre'].'</td>
	   <td>'.$registro2['expediente'].'</td>	
	   <td>'.$registro2['identidad'].'</td>			   
	   <td>'.$registro2['edad'].'</td>
	   <td>'.$registro2['h'].'</td>		   
	   <td>'.$registro2['m'].'</td>
	   <td>'.$registro2['patologia'].'</td>
	   <td>'.$registro2['diagnostico'].'</td>
	   <td>'.$registro2['fecha_cita'].'</td>
	   <td>'. date('H:i',strtotime($registro2['hora'])).'</td>
	   <td>'.$registro2['servicio'].'</td>
	   <td>'.$registro2['medico'].'</td>
	   <td>'.$registro2['instrucciones'].'</td>	
	   <td>'.$registro2['procedimiento'].'</td>	
	   <td>'.$registro2['usuario'].'</td>	
	   <td>
		   <a href="javascript:editarPostclinica('.$registro2['postclinica_id'].');void(0);" title="Editar Registro" class="fas fa-edit fa-lg" style="text-decoration:none;"></a>
		   <a title = "Eliminar Registro" href="javascript:modal_eliminarPostClinica('.$registro2['postclinica_id'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-trash fa-lg" style="text-decoration:none;"></a>					  
	   </td>		   
	</tr>';	        
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="18" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="18"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>