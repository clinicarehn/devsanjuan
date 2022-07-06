<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$servicio = $_POST['servicio'];
$mes = $_POST['mes'];
$año = $_POST['año'];
$color_neto = '#083BF7';
$color_porcentaje = '#087613';

if($servicio == ""){
	$where = "WHERE MONTH(a.fecha_cita) = '$mes' AND YEAR(a.fecha_cita) = '$año' AND a.servicio_id NOT IN(12) AND a.status_id NOT IN(0)";
    $group_by = "GROUP BY a.servicio_id, pc.puesto_id";		
}else{
	if($servicio == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE MONTH(a.fecha_cita) = '$mes' AND YEAR(a.fecha_cita) = '$año' AND a.servicio_id IN(1,6) AND a.status_id NOT IN(0)";
        $group_by = "GROUP BY pc.puesto_id";		
    }else{
		$where = "WHERE MONTH(a.fecha_cita) = '$mes' AND YEAR(a.fecha_cita) = '$año' AND a.servicio_id = '$servicio' AND a.status_id NOT IN(0)";
		$group_by = "GROUP BY a.servicio_id, pc.puesto_id";	
	}
}
	
$query = "SELECT sr.descripcion AS 'causa',
COUNT(CASE WHEN p.sexo = 'H' THEN a.paciente END) AS 'h',
COUNT(CASE WHEN p.sexo = 'M' THEN a.paciente END) AS 'm',
COUNT(a.status_id) AS 'total'
FROM agenda AS a
INNER JOIN status_repro AS sr
ON a.status_id = sr.status_id
INNER JOIN pacientes AS p
ON a.pacientes_id = p.pacientes_id
".$where." 
GROUP BY a.status_id
ORDER BY sr.descripcion";

$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
		
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_causa_reprogramcion('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
  $lista = $lista.'<li><a href="javascript:pagination_causa_reprogramcion('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}
    
if($paginaActual < $nroPaginas){
   $lista = $lista.'<li><a href="javascript:pagination_causa_reprogramcion('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_causa_reprogramcion('.($nroPaginas).');">Ultima</a></li>';
 }
  
if($paginaActual <= 1){
   $limit = 0;
}else{
   $limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT sr.descripcion AS 'causa',
COUNT(CASE WHEN p.sexo = 'H' THEN a.paciente END) AS 'h',
COUNT(CASE WHEN p.sexo = 'M' THEN a.paciente END) AS 'm',
COUNT(a.status_id) AS 'total'
FROM agenda AS a
INNER JOIN status_repro AS sr
ON a.status_id = sr.status_id
INNER JOIN pacientes AS p
ON a.pacientes_id = p.pacientes_id
".$where." 
GROUP BY a.status_id
ORDER BY sr.descripcion LIMIT $limit, $nroLotes";

$result = $mysqli->query($registro);
		
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
    <tr>
      	<th width="25%">Causa</th>	
		<th width="25%">Hombres</th>	
		<th width="25%">Mujeres</th>	
		<th width="25%">Total</th>	
	</tr>';			

$total_h = 0; $total_m = 0; $total = 0;	
if($nroProductos>0){	
  while($registro2 = $result->fetch_assoc()){
	 $total_h  += $registro2['h'];
	 $total_m  += $registro2['m'];
	 $total  += $registro2['total'];
	 
	 $tabla = $tabla.'<tr>			
		<td>'.$registro2['causa'].'</td>
		<td>'.number_format($registro2['h']).'</td>		
		<td>'.number_format($registro2['m']).'</td>
        <td style="color: '.$color_neto.';"><b>'.number_format($registro2['total']).'</b></td>			
	 </tr>';					
  }	
  $tabla = $tabla.'<tr>		
        <td><b>Total</b></td>  
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_h).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_m).'</b></td>		
        <td style="color: '.$color_porcentaje.';"><b>'.number_format($total).'</b></td>			
  </tr>';  
}else{
	$tabla = $tabla.'<tr>
	   <td colspan="4" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';	
}	
   
$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
 			   1 => $lista);

echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>