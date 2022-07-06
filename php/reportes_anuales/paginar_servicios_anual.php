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
$color_porcentaje = '#087623';

if($año == null || $año == ""){
	$año = date("Y");
}

if($servicio == ""){
    $where = "WHERE YEAR(a.fecha) = '$año'";
    $group_by = "GROUP BY a.servicio_id, pc.puesto_id";		
}else{
	if($servicio == 0 && $mes == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
		$group_by = "GROUP BY pc.puesto_id";
    }else{
	    $where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
        $group_by = "GROUP BY a.servicio_id, pc.puesto_id";			
	}
}

$query = "SELECT s.nombre AS 'servicio', pc.nombre AS 'unidad',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ene', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ene', 
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.paciente END) AS 'enero', 
COUNT(CASE WHEN (MONTH(a.fecha) = 2 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_feb', 
COUNT(CASE WHEN (MONTH(a.fecha) = 2 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_feb', 
COUNT(CASE WHEN MONTH(a.fecha) = 2 THEN a.paciente END) AS 'febrero', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_mar', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_mar', 
COUNT(CASE WHEN MONTH(a.fecha) = 3 THEN a.paciente END) AS 'marzo', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_abr', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_abr', 
COUNT(CASE WHEN MONTH(a.fecha) = 4 THEN a.paciente END) AS 'abril',
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_may', 
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_may', 
COUNT(CASE WHEN MONTH(a.fecha) = 5 THEN a.paciente END) AS 'mayo', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jun', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jun', 
COUNT(CASE WHEN MONTH(a.fecha) = 6 THEN a.paciente END) AS 'junio', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jul', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jul', 
COUNT(CASE WHEN MONTH(a.fecha) = 7 THEN a.paciente END) AS 'julio', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ago', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ago', 
COUNT(CASE WHEN MONTH(a.fecha) = 8 THEN a.paciente END) AS 'agosto',
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_sep', 
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_sep', 
COUNT(CASE WHEN MONTH(a.fecha) = 9 THEN a.paciente END) AS 'septiembre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_oct', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_oct', 
COUNT(CASE WHEN MONTH(a.fecha) = 10 THEN a.paciente END) AS 'octubre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_nov', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_nov', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.paciente END) AS 'noviembre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 12 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_dic', 
COUNT(CASE WHEN (MONTH(a.fecha) = 12 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_dic', 
COUNT(CASE WHEN MONTH(a.fecha) = 12 THEN a.paciente END) AS 'diciembre',
COUNT(a.paciente) AS 'total'
FROM ata AS a
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
".$where." 
".$group_by."
ORDER BY s.nombre";

$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
		
$nroLotes = 20;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_detallado('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
  $lista = $lista.'<li><a href="javascript:pagination_detallado('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}
    
if($paginaActual < $nroPaginas){
   $lista = $lista.'<li><a href="javascript:pagination_detallado('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_detallado('.($nroPaginas).');">Ultima</a></li>';
 }
  
if($paginaActual <= 1){
   $limit = 0;
}else{
   $limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT s.nombre AS 'servicio', pc.nombre AS 'unidad',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ene', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ene', 
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.paciente END) AS 'enero', 
COUNT(CASE WHEN (MONTH(a.fecha) = 2 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_feb', 
COUNT(CASE WHEN (MONTH(a.fecha) = 2 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_feb', 
COUNT(CASE WHEN MONTH(a.fecha) = 2 THEN a.paciente END) AS 'febrero', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_mar', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_mar', 
COUNT(CASE WHEN MONTH(a.fecha) = 3 THEN a.paciente END) AS 'marzo', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_abr', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_abr', 
COUNT(CASE WHEN MONTH(a.fecha) = 4 THEN a.paciente END) AS 'abril',
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_may', 
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_may', 
COUNT(CASE WHEN MONTH(a.fecha) = 5 THEN a.paciente END) AS 'mayo', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jun', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jun', 
COUNT(CASE WHEN MONTH(a.fecha) = 6 THEN a.paciente END) AS 'junio', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jul', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jul', 
COUNT(CASE WHEN MONTH(a.fecha) = 7 THEN a.paciente END) AS 'julio', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ago', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ago', 
COUNT(CASE WHEN MONTH(a.fecha) = 8 THEN a.paciente END) AS 'agosto',
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_sep', 
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_sep', 
COUNT(CASE WHEN MONTH(a.fecha) = 9 THEN a.paciente END) AS 'septiembre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_oct', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_oct', 
COUNT(CASE WHEN MONTH(a.fecha) = 10 THEN a.paciente END) AS 'octubre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_nov', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_nov', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.paciente END) AS 'noviembre', 
COUNT(CASE WHEN (MONTH(a.fecha) = 12 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_dic', 
COUNT(CASE WHEN (MONTH(a.fecha) = 12 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_dic', 
COUNT(CASE WHEN MONTH(a.fecha) = 12 THEN a.paciente END) AS 'diciembre',
COUNT(a.paciente) AS 'total'
FROM ata AS a
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
".$where." 
".$group_by."
ORDER BY s.nombre LIMIT $limit, $nroLotes";

$result = $mysqli->query($registro);
		
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
    <tr>
      	<th width="2.56%">Servicio</th>
        <th width="2.56%">Unidad</th>
		
    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Enero</th>		

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Febrero</th>

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Marzo</th>
		
    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Abril</th>

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Mayo</th>		

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Junio</th>

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Julio</th>

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Agosto</th>

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Septiembre</th>

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Octubre</th>

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Noviembre</th>

    	<th width="2.56%">Nuevo</th>
		<th width="2.56%">Subsiguiente</th>
		<th width="2.56%">Diciembre</th>

        <th width="2.56%">Total</th>		
	</tr>';			
	
if($nroProductos>0){
  while($registro2 = $result->fetch_assoc()){
	 if($servicio == ""){
		 $servicio_ = $registro2['servicio'];
	 }else if($servicio != 0){
		 $servicio_ = $registro2['servicio'];
	 }else{
		 $servicio_ = "Consulta Externa General";		 
	 }
	 
	 $tabla = $tabla.'<tr>	       	 
		<td>'.$servicio_.'</td>
		<td>'.$registro2['unidad'].'</td>
		
		<td>'.number_format($registro2['nuevo_ene']).'</td>		
		<td>'.number_format($registro2['sub_ene']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['enero']).'</b></td>

		<td>'.number_format($registro2['nuevo_feb']).'</td>		
		<td>'.number_format($registro2['sub_feb']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['febrero']).'</b></td>

		<td>'.number_format($registro2['nuevo_mar']).'</td>		
		<td>'.number_format($registro2['sub_mar']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['marzo']).'</b></td>

		<td>'.number_format($registro2['nuevo_abr']).'</td>		
		<td>'.number_format($registro2['sub_abr']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['abril']).'</b></td>
		
		<td>'.number_format($registro2['nuevo_may']).'</td>		
		<td>'.number_format($registro2['sub_may']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['mayo']).'</b></td>		

		<td>'.number_format($registro2['nuevo_jun']).'</td>		
		<td>'.number_format($registro2['sub_jun']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['junio']).'</b></td>

		<td>'.number_format($registro2['nuevo_jul']).'</td>		
		<td>'.number_format($registro2['sub_jul']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['julio']).'</b></td>

		<td>'.number_format($registro2['nuevo_ago']).'</td>		
		<td>'.number_format($registro2['sub_ago']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['agosto']).'</b></td>

		<td>'.number_format($registro2['nuevo_sep']).'</td>		
		<td>'.number_format($registro2['sub_sep']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['septiembre']).'</b></td>

		<td>'.number_format($registro2['nuevo_oct']).'</td>		
		<td>'.number_format($registro2['sub_oct']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['octubre']).'</b></td>

		<td>'.number_format($registro2['nuevo_nov']).'</td>		
		<td>'.number_format($registro2['sub_nov']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['noviembre']).'</b></td>

		<td>'.number_format($registro2['nuevo_dic']).'</td>		
		<td>'.number_format($registro2['sub_dic']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['diciembre']).'</b></td>

        <td style="color: '.$color_porcentaje.';"><b>'.number_format($registro2['total']).'</b></td>		
	
	 </tr>';					
  }	
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