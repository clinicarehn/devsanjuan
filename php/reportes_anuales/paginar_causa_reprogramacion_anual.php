<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$servicio = $_POST['servicio'];
$año = $_POST['año'];
$mes = $_POST['mes'];
$color_neto = '#083BF7';
$color_porcentaje = '#083BF7';
	
if($servicio == ""){
    $where = "WHERE YEAR(a.fecha_cita) = '$año' AND a.status_id NOT IN(0)";	
}else{
	if($servicio == 0 && $mes == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE YEAR(a.fecha_cita) = '$año' AND a.servicio_id IN(1,6) AND a.status_id NOT IN(0)";
    }else{
	    $where = "WHERE YEAR(a.fecha_cita) = '$año' AND a.servicio_id = '$servicio' AND a.status_id NOT IN(0)";	
	}
}

$query = "SELECT sr.descripcion AS 'causa',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 1 THEN a.status_id END) AS 'enero',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 2 THEN a.status_id END) AS 'febrero',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 3 THEN a.status_id END) AS 'marzo',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 4 THEN a.status_id END) AS 'abril',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 5 THEN a.status_id END) AS 'mayo',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 6 THEN a.status_id END) AS 'junio',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 7 THEN a.status_id END) AS 'julio',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 8 THEN a.status_id END) AS 'agosto',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 9 THEN a.status_id END) AS 'septiembre',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 10 THEN a.status_id END) AS 'octubre',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 11 THEN a.status_id END) AS 'noviembre',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 12 THEN a.status_id END) AS 'diciembre',
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
		
$nroLotes = 20;
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
COUNT(CASE WHEN MONTH(a.fecha_cita) = 1 THEN a.status_id END) AS 'enero',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 2 THEN a.status_id END) AS 'febrero',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 3 THEN a.status_id END) AS 'marzo',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 4 THEN a.status_id END) AS 'abril',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 5 THEN a.status_id END) AS 'mayo',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 6 THEN a.status_id END) AS 'junio',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 7 THEN a.status_id END) AS 'julio',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 8 THEN a.status_id END) AS 'agosto',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 9 THEN a.status_id END) AS 'septiembre',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 10 THEN a.status_id END) AS 'octubre',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 11 THEN a.status_id END) AS 'noviembre',
COUNT(CASE WHEN MONTH(a.fecha_cita) = 12 THEN a.status_id END) AS 'diciembre',
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
      	<th width="23.14%">Causa</th>
		<th width="5.14%">Enero</th>		
		<th width="5.14%">Febrero</th>
		<th width="5.14%">Marzo</th>
		<th width="5.14%">Abril</th>
		<th width="5.14%">Mayo</th>		
		<th width="5.14%">Junio</th>
		<th width="5.14%">Julio</th>
		<th width="7.14%">Agosto</th>
		<th width="7.14%">Septiembre</th>
		<th width="7.14%">Octubre</th>
		<th width="7.14%">Noviembre</th>
		<th width="7.14%">Diciembre</th>
        <th width="7.14%">Total</th>		
	</tr>';			
	
$total_ene = 0; $total_feb = 0; $total_mar = 0; $total_abr = 0; $total_may = 0; $total_jun = 0; $total_jul = 0; $total_ago = 0; $total_sep = 0; $total_oct = 0; $total_nov = 0; $total_dic = 0;	 $total = 0;
if($nroProductos>0){
  while($registro2 = $result->fetch_assoc()){
	 $tabla = $tabla.'<tr>	       	 
		<td>'.$registro2['causa'].'</td>	
		<td>'.number_format($registro2['enero']).'</td>
		<td>'.number_format($registro2['febrero']).'</td>
		<td>'.number_format($registro2['marzo']).'</td>
		<td>'.number_format($registro2['abril']).'</td>
		<td>'.number_format($registro2['mayo']).'</td>		
		<td>'.number_format($registro2['junio']).'</td>
		<td>'.number_format($registro2['julio']).'</td>
		<td>'.number_format($registro2['agosto']).'</td>
		<td>'.number_format($registro2['septiembre']).'</td>
		<td>'.number_format($registro2['octubre']).'</td>
		<td>'.number_format($registro2['noviembre']).'</td>
		<td>'.number_format($registro2['diciembre']).'</td>
        <td style="color: '.$color_porcentaje.';"><b>'.number_format($registro2['total']).'</b></td>
	 </tr>';

     $total_ene +=$registro2['enero'];
     $total_feb +=$registro2['febrero'];
     $total_mar +=$registro2['marzo'];
     $total_abr +=$registro2['abril'];
     $total_may +=$registro2['mayo'];
     $total_jun +=$registro2['junio'];
     $total_jul +=$registro2['julio'];
     $total_ago +=$registro2['agosto'];
     $total_sep +=$registro2['septiembre'];
     $total_oct +=$registro2['octubre'];
     $total_nov +=$registro2['noviembre'];
     $total_dic +=$registro2['diciembre'];
     $total +=$registro2['total'];	 
  }	
	$tabla = $tabla.'<tr>	       	 
		<td><b>Total</b></td>	
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_ene).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_feb).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_mar).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_abr).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_may).'</b></td>
        <td style="color: '.$color_porcentaje.';"><b>'.number_format($total_jun).'</b></td>		
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_jul).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_ago).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_sep).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_oct).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_nov).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($total_dic).'</b></td>
        <td style="color: '.$color_porcentaje.';"><b>'.number_format($total).'</b></td>
	</tr>';  
}else{
	$tabla = $tabla.'<tr>
	   <td colspan="38" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';	
}	
   
$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
 			   1 => $lista);

echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>