<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_SESSION['colaborador_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$fecha = $_POST['fecha'];
$dato = $_POST['dato'];
$sala = $_POST['sala'];

if($sala == ""){
	$where = "WHERE  c.estado = 0 ";
}else{
	$where = "WHERE c.sala_id = '$sala' AND c.estado = 0 ";
}

$query = "SELECT s.nombre AS 'sala', c.codigo AS 'cama', c.estado AS 'estado'
  FROM camas AS c
  INNER JOIN sala AS s
  ON c.sala_id = s.sala_id
  ".$where." 
  ORDER BY s.sala_id ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
  
$nroLotes = 15;
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

$registro = "SELECT s.nombre AS 'sala', c.codigo AS 'cama', c.estado AS 'estado'
  FROM camas AS c
  INNER JOIN sala AS s
  ON c.sala_id = s.sala_id
  ".$where." 
  ORDER BY s.sala_id ASC
  LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);	


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="41.33%">Sala</th>
			<th width="25.33%">Cama</th>
			<th width="33.33%">Estado</th>
			</tr>';
			
while($registro2 = $result->fetch_assoc()){	
	$color = "#27B604"; //COLOR VERDE
	$tabla = $tabla.'<tr>
			<td>'.$registro2['sala'].'</td>	
			<td>'.$registro2['cama'].'</td>			
			<td bgcolor = '.$color.'></td>					
		</tr>';					
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