<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_SESSION['colaborador_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$dato = $_POST['dato'];
	
$query = "SELECT ch.centros_id AS 'centro_id', nc.nombre AS 'nivel_nombre', ng.nombre AS 'nivel_grupo', ch.centro_nombre AS 'centro_nombre', d.nombre AS 'departamento', m.nombre AS 'municipio', CAST(ch.fecha AS DATE) AS 'fecha', CONCAT(c.nombre,' ',c.apellido) AS 'user'
	FROM centros_hospitalarios AS ch
	INNER JOIN niveles_centros AS nc
	ON ch.niveles_centros_id = nc.niveles_centros_id
	INNER JOIN niveles_grupos AS ng
	ON ch.niveles_grupo_id = ng.niveles_grupo_id
	INNER JOIN departamentos AS d
	ON ch.departamento_id = d.departamento_id
	INNER JOIN municipios As m
	ON ch.municipio_id = m.municipio_id
	INNER JOIN colaboradores AS c
	ON ch.user = c.colaborador_id
	WHERE ch.centro_nombre like '%$dato%' AND ch.visible = 1
";

$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
	
$nroLotes = 3;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_centros('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_centros('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_centros('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_centros('.($nroPaginas).');">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT ch.centros_id AS 'centro_id', nc.nombre AS 'nivel_nombre', ng.nombre AS 'nivel_grupo', ch.centro_nombre AS 'centro_nombre', d.nombre AS 'departamento', m.nombre AS 'municipio', CAST(ch.fecha AS DATE) AS 'fecha', CONCAT(c.nombre,' ',c.apellido) AS 'user'
	FROM centros_hospitalarios AS ch
	INNER JOIN niveles_centros AS nc
	ON ch.niveles_centros_id = nc.niveles_centros_id
	INNER JOIN niveles_grupos AS ng
	ON ch.niveles_grupo_id = ng.niveles_grupo_id
	INNER JOIN departamentos AS d
	ON ch.departamento_id = d.departamento_id
	INNER JOIN municipios As m
	ON ch.municipio_id = m.municipio_id
	INNER JOIN colaboradores AS c
	ON ch.user = c.colaborador_id
	WHERE ch.centro_nombre like '%$dato%' AND ch.visible = 1
	LIMIT $limit, $nroLotes
";

$result = $mysqli->query($registro);


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="5.5%">Código</th>
			<th width="13.5%">Departamento</th>
			<th width="12.5%">Nivel</th>
			<th width="12.5%">Tipo</th>				
			<th width="19.5%">Nombre</th>
			<th width="10.5%">Fecha</th>
			<th width="16.5%">Usuario</th>
			<th width="8.5%">Opciones</th>
			</tr>';			
while($registro2 = $result->fetch_assoc()){	
				$tabla = $tabla.'<tr>	
			<td>'.$registro2['centro_id'].'</td>
			<td>'.$registro2['departamento'].'</td>
			<td>'.$registro2['nivel_nombre'].'</td>
			<td>'.$registro2['nivel_grupo'].'</td>
			<td>'.$registro2['centro_nombre'].'</td>
			<td>'.$registro2['fecha'].'</td>
			<td>'.$registro2['user'].'</td>
			<td>
			  <a style="text-decoration:none" title = "Eliminar Registro" href="javascript:eliminarRegistro('.$registro2['centro_id'].');void(0);" class="fas fa-trash fa-lg"></a>
			</td>
			</tr>';					
}
	
$tabla = $tabla.'<tr>
   <td colspan="13"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
</tr>';

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>