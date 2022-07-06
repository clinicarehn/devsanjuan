<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$dato = $_POST['dato'];
$paginaActual = $_POST['partida'];

if($dato == ""){
	$where = "WHERE ps.transferir = '2'";
}else{
	$where = "WHERE ps.transferir = '2' AND (CONCAT(ps.apellidos,' ',ps.nombres) LIKE '$dato%' OR ps.identidad LIKE '$dato%' OR ps.telefono LIKE '$dato%')";
}
	
$query = "SELECT pacientes_seg_id AS 'pacientes_seg_id', CONCAT(ps.apellidos,' ',ps.nombres) AS 'paciente', ps.genero, ps.identidad, ps.fecha_nacimiento, ps.telefono, d.nombre AS 'departamento', m.nombre AS 'municipio', ps.localidad, CONCAT(c.apellido,' ',c.nombre) AS 'usuario', ps.fecha_registro
FROM pacientes_seguimiento AS ps
INNER JOIN departamentos AS d
ON ps.departamento_id = d.departamento_id
INNER JOIN municipios AS m
ON ps.municipio_id = m.municipio_id 
INNER JOIN colaboradores AS c
ON ps.usuario = c.colaborador_id
".$where."
ORDER BY ps.pacientes_seg_id ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
  
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:paginationPacientes('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:paginationPacientes('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li><a href="javascript:paginationPacientes('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:paginationPacientes('.($nroPaginas).');">Ultima</a></li>';
}	

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

$registro = "SELECT pacientes_seg_id AS 'pacientes_seg_id', CONCAT(ps.apellidos,' ',ps.nombres) AS 'paciente', 
(CASE WHEN ps.genero = 'H' THEN 'Hombre' ELSE 'Mujer' END) AS 'genero',
ps.identidad AS 'identidad', 
ps.fecha_nacimiento AS 'fecha_nacimiento', ps.telefono AS 'telefono', d.nombre AS 'departamento', m.nombre AS 'municipio', ps.localidad, 
CONCAT(c.apellido,' ',c.nombre) AS 'usuario', ps.fecha_registro AS 'fecha_registro'
FROM pacientes_seguimiento AS ps
INNER JOIN departamentos AS d
ON ps.departamento_id = d.departamento_id
INNER JOIN municipios AS m
ON ps.municipio_id = m.municipio_id 
INNER JOIN colaboradores AS c
ON ps.usuario = c.colaborador_id
".$where."
ORDER BY ps.pacientes_seg_id ASC LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
	<tr>
		   <th width="2%">No.</th>
		   <th width="26%">Paciente</th>
		   <th width="2%">Genero</th>
		   <th width="8%">Identidad</th>
		   <th width="13%">Fecha Nacimiento</th>
		   <th width="10%">Teléfono</th>
		   <th width="10%">Departamento</th>
		   <th width="16%">Municipio</th>
		   <th width="13%">Usuario</th>
		   <th width="4%">Opciones</th>
	</tr>';			
	
$valor = 1;
	
while($registro2 = $result->fetch_assoc()){	
	$tabla = $tabla.'<tr>
		   <td>'.$valor.'</td>
		   <td><a style="text-decoration:none" title = "Información de Usuario" href="javascript:showDetailsPacientes('.$registro2['pacientes_seg_id'].');">'.$registro2['paciente'].'</a></td>
		   <td>'.$registro2['genero'].'</td>
	  	   <td>'.$registro2['identidad'].'</td>	
           <td>'.$registro2['fecha_nacimiento'].'</td>
           <td>'.$registro2['telefono'].'</td>			   
		   <td>'.$registro2['departamento'].'</td>			
		   <td>'.$registro2['municipio'].'</td>							
		   <td>'.$registro2['usuario'].'</td>		
		   <td>
			  <a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Transferir Usuario" href="javascript:transferirUsuario('.$registro2['pacientes_seg_id'].');void(0);" class="fas fa-exchange-alt fa-lg"></a>
		   </td>		   
	</tr>';	
    $valor ++;	
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="13" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="13"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>