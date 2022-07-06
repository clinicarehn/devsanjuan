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
$color_porcentaje = '#087613';
	
if($servicio == ""){
    $where = "WHERE YEAR(a.fecha) = '$año'";
}else{
	if($servicio == 0 && $mes == 0){//CONSULTA EXTERNA GENERAL
		$where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
	}else{
		$where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
	}
}

$query = "SELECT gp.codigo AS 'codigo', gp.nombre AS 'enfermedad',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ene', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ene',
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.patologia_id END) AS 'enero',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 1 THEN a.años ELSE 0 END),0) AS 'edad_ene',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_feb', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_feb', 
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.patologia_id END) AS 'febrero', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 1 THEN a.años ELSE 0 END),0) AS 'edad_feb',
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_mar', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_mar', 
COUNT(CASE WHEN MONTH(a.fecha) = 3 THEN a.patologia_id END) AS 'marzo', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 3 THEN a.años ELSE 0 END),0) AS 'edad_mar',
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_abr', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_abr', 
COUNT(CASE WHEN MONTH(a.fecha) = 4 THEN a.patologia_id END) AS 'abril',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 4 THEN a.años ELSE 0 END),0) AS 'edad_abr',
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_may', 
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_may', 
COUNT(CASE WHEN MONTH(a.fecha) = 5 THEN a.patologia_id END) AS 'mayo', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 5 THEN a.años ELSE 0 END),0) AS 'edad_may',
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jun', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jun', 
COUNT(CASE WHEN MONTH(a.fecha) = 6 THEN a.patologia_id END) AS 'junio', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 6 THEN a.años ELSE 0 END),0) AS 'edad_jun',
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jul', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jul', 
COUNT(CASE WHEN MONTH(a.fecha) = 7 THEN a.patologia_id END) AS 'julio', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 7 THEN a.años ELSE 0 END),0) AS 'edad_jul',
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ago', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ago', 
COUNT(CASE WHEN MONTH(a.fecha) = 8 THEN a.patologia_id END) AS 'agosto',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 8 THEN a.años ELSE 0 END),0) AS 'edad_ago',
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_sep', 
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_sep', 
COUNT(CASE WHEN MONTH(a.fecha) = 9 THEN a.patologia_id END) AS 'septiembre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 9 THEN a.años ELSE 0 END),0) AS 'edad_sep',
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_oct', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_oct', 
COUNT(CASE WHEN MONTH(a.fecha) = 10 THEN a.patologia_id END) AS 'octubre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 10 THEN a.años ELSE 0 END),0) AS 'edad_oct',
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_nov', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_nov', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.patologia_id END) AS 'noviembre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 11 THEN a.años ELSE 0 END),0) AS 'edad_nov',
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_dic', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_dic', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.patologia_id END) AS 'diciembre',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 11 THEN a.años ELSE 0 END),0) AS 'edad_dic',
COUNT(a.patologia_id) AS 'total',
ROUND(AVG(a.años),0) AS 'promedio_edad'
FROM ata AS a
INNER JOIN patologia As pa
ON a.patologia_id = pa.id
INNER JOIN grupo_patologia AS gp
ON pa.grupo_id = gp.grupo_id
INNER JOIN pacientes AS p
ON a.expediente = p.expediente
".$where."
GROUP BY gp.grupo_id";

$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
		
$nroLotes = 25;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_sm03('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
  $lista = $lista.'<li><a href="javascript:pagination_sm03('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}
    
if($paginaActual < $nroPaginas){
   $lista = $lista.'<li><a href="javascript:pagination_sm03('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_sm03('.($nroPaginas).');">Ultima</a></li>';
 }
  
if($paginaActual <= 1){
   $limit = 0;
}else{
   $limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT gp.codigo AS 'codigo', gp.nombre AS 'enfermedad',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ene', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ene',
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.patologia_id END) AS 'enero',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 1 THEN a.años ELSE 0 END),0) AS 'edad_ene',
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_feb', 
COUNT(CASE WHEN (MONTH(a.fecha) = 1 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_feb', 
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.patologia_id END) AS 'febrero', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 1 THEN a.años ELSE 0 END),0) AS 'edad_feb',
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_mar', 
COUNT(CASE WHEN (MONTH(a.fecha) = 3 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_mar', 
COUNT(CASE WHEN MONTH(a.fecha) = 3 THEN a.patologia_id END) AS 'marzo', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 3 THEN a.años ELSE 0 END),0) AS 'edad_mar',
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_abr', 
COUNT(CASE WHEN (MONTH(a.fecha) = 4 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_abr', 
COUNT(CASE WHEN MONTH(a.fecha) = 4 THEN a.patologia_id END) AS 'abril',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 4 THEN a.años ELSE 0 END),0) AS 'edad_abr',
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_may', 
COUNT(CASE WHEN (MONTH(a.fecha) = 5 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_may', 
COUNT(CASE WHEN MONTH(a.fecha) = 5 THEN a.patologia_id END) AS 'mayo', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 5 THEN a.años ELSE 0 END),0) AS 'edad_may',
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jun', 
COUNT(CASE WHEN (MONTH(a.fecha) = 6 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jun', 
COUNT(CASE WHEN MONTH(a.fecha) = 6 THEN a.patologia_id END) AS 'junio', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 6 THEN a.años ELSE 0 END),0) AS 'edad_jun',
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_jul', 
COUNT(CASE WHEN (MONTH(a.fecha) = 7 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_jul', 
COUNT(CASE WHEN MONTH(a.fecha) = 7 THEN a.patologia_id END) AS 'julio', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 7 THEN a.años ELSE 0 END),0) AS 'edad_jul',
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_ago', 
COUNT(CASE WHEN (MONTH(a.fecha) = 8 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_ago', 
COUNT(CASE WHEN MONTH(a.fecha) = 8 THEN a.patologia_id END) AS 'agosto',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 8 THEN a.años ELSE 0 END),0) AS 'edad_ago',
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_sep', 
COUNT(CASE WHEN (MONTH(a.fecha) = 9 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_sep', 
COUNT(CASE WHEN MONTH(a.fecha) = 9 THEN a.patologia_id END) AS 'septiembre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 9 THEN a.años ELSE 0 END),0) AS 'edad_sep',
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_oct', 
COUNT(CASE WHEN (MONTH(a.fecha) = 10 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_oct', 
COUNT(CASE WHEN MONTH(a.fecha) = 10 THEN a.patologia_id END) AS 'octubre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 10 THEN a.años ELSE 0 END),0) AS 'edad_oct',
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_nov', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_nov', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.patologia_id END) AS 'noviembre', 
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 11 THEN a.años ELSE 0 END),0) AS 'edad_nov',
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'N') THEN a.paciente END) AS 'nuevo_dic', 
COUNT(CASE WHEN (MONTH(a.fecha) = 11 AND a.paciente = 'S') THEN a.paciente END) AS 'sub_dic', 
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.patologia_id END) AS 'diciembre',
ROUND(AVG(CASE WHEN MONTH(a.fecha) = 11 THEN a.años ELSE 0 END),0) AS 'edad_dic',
COUNT(a.patologia_id) AS 'total',
ROUND(AVG(a.años),0) AS 'promedio_edad'
FROM ata AS a
INNER JOIN patologia As pa
ON a.patologia_id = pa.id
INNER JOIN grupo_patologia AS gp
ON pa.grupo_id = gp.grupo_id
INNER JOIN pacientes AS p
ON a.expediente = p.expediente
".$where."
GROUP BY gp.grupo_id LIMIT $limit, $nroLotes";

$result = $mysqli->query($registro);
		
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
    <tr>
      	<th width="1.91%">Código</th>
        <th width="1.91%">Enfermedad</th>
		
    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Enero</th>
        <th width="1.91%">Promedio Edad Enero</th>		

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Febrero</th>
        <th width="1.91%">Promedio Edad Enero</th>			

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Marzo</th>
        <th width="1.91%">Promedio Edad Enero</th>			
		
    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Abril</th>
        <th width="1.91%">Promedio Edad Enero</th>			

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Mayo</th>	
		<th width="1.91%">Promedio Edad Enero</th>	

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Junio</th>
        <th width="1.91%">Promedio Edad Enero</th>			

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Julio</th>
        <th width="1.91%">Promedio Edad Enero</th>		

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Agosto</th>
        <th width="1.91%">Promedio Edad Enero</th>		

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Septiembre</th>
        <th width="1.91%">Promedio Edad Enero</th>		

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Octubre</th>
        <th width="1.91%">Promedio Edad Enero</th>		

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Noviembre</th>
        <th width="1.91%">Promedio Edad Enero</th>		

    	<th width="1.91%">Nuevo</th>
		<th width="1.91%">Subsiguiente</th>
		<th width="1.91%">Diciembre</th>
        <th width="1.91%">Promedio Edad Enero</th>		

        <th width="1.91%">Total</th>
        <th width="1.91%">Promedio de Edad</th>		
	</tr>';			
	
$total = 0;

if($nroProductos>0){
  while($registro1 = $result->fetch_assoc()){
	 $total += $registro1['total'];
	 
	 $tabla = $tabla.'<tr>			
		<td>'.$registro1['codigo'].'</td>
		<td>'.$registro1['enfermedad'].'</td>
		
		<td>'.number_format($registro1['nuevo_ene']).'</td>		
		<td>'.number_format($registro1['sub_ene']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['enero']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_ene']).'</b></td>

		<td>'.number_format($registro1['nuevo_feb']).'</td>		
		<td>'.number_format($registro1['sub_feb']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['febrero']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_feb']).'</b></td>

		<td>'.number_format($registro1['nuevo_mar']).'</td>		
		<td>'.number_format($registro1['sub_mar']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['marzo']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_mar']).'</b></td>

		<td>'.number_format($registro1['nuevo_abr']).'</td>		
		<td>'.number_format($registro1['sub_abr']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['abril']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_abr']).'</b></td>
		
		<td>'.number_format($registro1['nuevo_may']).'</td>		
		<td>'.number_format($registro1['sub_may']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['mayo']).'</b></td>
        <td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_may']).'</b></td>		

		<td>'.number_format($registro1['nuevo_jun']).'</td>		
		<td>'.number_format($registro1['sub_jun']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['junio']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_jun']).'</b></td>

		<td>'.number_format($registro1['nuevo_jul']).'</td>		
		<td>'.number_format($registro1['sub_jul']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['julio']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_jul']).'</b></td>

		<td>'.number_format($registro1['nuevo_ago']).'</td>		
		<td>'.number_format($registro1['sub_ago']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['agosto']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_ago']).'</b></td>

		<td>'.number_format($registro1['nuevo_sep']).'</td>		
		<td>'.number_format($registro1['sub_sep']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['septiembre']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_sep']).'</b></td>

		<td>'.number_format($registro1['nuevo_oct']).'</td>		
		<td>'.number_format($registro1['sub_oct']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['octubre']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_oct']).'</b></td>

		<td>'.number_format($registro1['nuevo_nov']).'</td>		
		<td>'.number_format($registro1['sub_nov']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['noviembre']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_nov']).'</b></td>

		<td>'.number_format($registro1['nuevo_dic']).'</td>		
		<td>'.number_format($registro1['sub_dic']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro1['diciembre']).'</b></td>
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['edad_dic']).'</b></td>

        <td style="color: '.$color_neto.';"><b>'.number_format($registro1['total']).'</b></td>
        <td style="color: '.$color_porcentaje.';"><b>'.number_format($registro1['promedio_edad']).'</b></td>		
	
	 </tr>';					
  }	

    $tabla = $tabla.'
	    <tr>
	        <td colspan="17"></b></td>
		</tr>	
	     <tr>
	         <td colspan="17"><b><p ALIGN="center">ANALISIS</p></b></td>			
		</tr>	
        <tr>
	        <td colspan="7"><p ALIGN="right">Total Pacientes:</p></td>
			<td colspan="10"><p ALIGN="left"><b>'.number_format($total).'</b></p></td>			
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