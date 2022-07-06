<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_SESSION['colaborador_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');

$paginaActual = $_POST['partida'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$status = $_POST['status'];
$reporte = $_POST['reporte'];
$dato = $_POST['dato'];

$fecha_consulta = "";

if($reporte == 1){
	$fecha_consulta = "";
}else if($reporte == 2){
	$fecha_consulta = "CAST(d.fecha AS date) BETWEEN '$desde' AND '$hasta' AND ";
}else if($reporte == 3){
	$fecha_consulta = "CAST(d.fecha_ultima AS date) BETWEEN '$desde' AND '$hasta' AND ";
}else{
	$fecha_consulta = "";
}

if($status != "" && $reporte == ""){
	$where = "WHERE d.status = '$status' AND CAST(d.fecha AS date) BETWEEN '$desde' AND '$hasta' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}else if($status != "" && $reporte != ""){
	$where = "WHERE ".$fecha_consulta." d.status = '$status' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}else{
	$where = "WHERE CAST(d.fecha AS date) BETWEEN '$desde' AND '$hasta' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}
	
$query = "SELECT DATE_FORMAT(d.fecha, '%d/%m/%Y') AS 'fecha_depuracion', CONCAT(p.nombre,' ',p.apellido) AS 'nombre', d.expediente As 'expediente', p.identidad AS 'identidad', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', d.diagnostico, DATE_FORMAT(d.fecha_ultima, '%d/%m/%Y') AS 'fecha_ultima', d.status AS 'status', CONCAT(c.nombre,' ',c.apellido) AS 'usuario', CONCAT(c1.nombre,' ',c1.apellido) AS 'colaborador', CONCAT(c2.nombre,' ',c2.apellido) AS 'colaborador1', s.nombre AS 'servicio', d.comentario AS 'comentario'
   FROM depurados AS d
   LEFT JOIN pacientes AS p
   ON d.pacientes_id = p.pacientes_id
   LEFT JOIN colaboradores	 AS c
   ON d.usuario = c.colaborador_id
   LEFT JOIN colaboradores AS c1
   ON d.colaborador_id = c1.colaborador_id
   LEFT JOIN colaboradores AS c2
   ON d.colaborador_id1 = c2.colaborador_id
   LEFT JOIN servicios AS s
   ON d.servicio_id = s.servicio_id   
   ".$where."
   ORDER BY d.fecha, p.expediente ASC";
$result = $mysqli->query($query);
	
$nroProductos = $result->num_rows;
  
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_depurados('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_depurados('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_depurados('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_depurados('.($nroPaginas).');">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

$registro = "SELECT d.depurado_id AS 'depurado_id', DATE_FORMAT(d.fecha, '%d/%m/%Y') AS 'fecha_depuracion', CONCAT(p.nombre,' ',p.apellido) AS 'nombre', d.expediente As 'expediente', p.identidad AS 'identidad', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', d.diagnostico, DATE_FORMAT(d.fecha_ultima, '%d/%m/%Y') AS 'fecha_ultima', d.status AS 'status', CONCAT(c.nombre,' ',c.apellido) AS 'usuario', CONCAT(c1.nombre,' ',c1.apellido) AS 'colaborador', CONCAT(c2.nombre,' ',c2.apellido) AS 'colaborador1', s.nombre AS 'servicio', d.comentario AS 'comentario'
   FROM depurados AS d
   LEFT JOIN pacientes AS p
   ON d.pacientes_id = p.pacientes_id
   LEFT JOIN colaboradores	 AS c
   ON d.usuario = c.colaborador_id	
   LEFT JOIN colaboradores AS c1
   ON d.colaborador_id = c1.colaborador_id
   LEFT JOIN colaboradores AS c2
   ON d.colaborador_id1 = c2.colaborador_id
   LEFT JOIN servicios AS s
   ON d.servicio_id = s.servicio_id
   ".$where."
   ORDER BY d.fecha
   LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="2.14%"><input id="checkAllDepurados" class="formcontrol" type="checkbox"></th>
			<th width="2.25%">N°</th>
			<th width="5.25%">Depuración</th>
			<th width="15.25%">Nombre</th>				
			<th width="6.25%">Expediente</th>
			<th width="6.25%">Identidad</th>	
			<th width="1.25%">H</th>
			<th width="1.25%">M</th>
			<th width="6.25%">Dx Principal</th>
			<th width="6.25%">Última Consulta</th>				
			<th width="7.25%">Profesional</th>
			<th width="7.25%">Profesional</th>
			<th width="7.25%">Servicio</th>				
			<th width="8.25%">Usuario</th>	
			<th width="7.25%">Motivo</th>	
			<th width="6.25%">Condición</th>
			<th width="6.25%">Opciones</th>				
			</tr>';			

$no = 1;	
while($registro2 = $result->fetch_assoc()){	
	if($registro2['status'] == 1){
		$status = 'Activo';
	}else if ($registro2['status'] == 2){
		$status = 'Pasivo';
	}else if ($registro2['status'] == 3){
		$status = 'Fallecido';
	}else if ($registro2['status'] == 4){
		$status = 'Depurados';
	}
	
	$tabla = $tabla.'<tr>
	   <td><input class="itemRowDepurados" type="checkbox" name="itemDepurados" id="itemDepurados_" value=""></td>
	   <td>'.$no.'</td>		   
	   <td>'.$registro2['fecha_depuracion'].'</td>		   
	   <td>'.$registro2['nombre'].'</td>
	   <td>'.$registro2['expediente'].'</td>
	   <td>'.$registro2['identidad'].'</td>		   
	   <td>'.$registro2['h'].'</td>
	   <td>'.$registro2['m'].'</td>		   
	   <td>'.$registro2['diagnostico'].'</td>
	   <td>'.$registro2['fecha_ultima'].'</td>
	   <td>'.$registro2['colaborador'].'</td>
	   <td>'.$registro2['colaborador1'].'</td>
	   <td>'.$registro2['servicio'].'</td>		   
	   <td>'.$registro2['usuario'].'</td>
	   <td>'.$registro2['comentario'].'</td>
	   <td>'.$status.'</td>	
	   <td>
		   <a style="text-decoration:none;" title = "Editar Usuario" href="javascript:editar('.$registro2['depurado_id'].');void(0);" class="fas fa-edit fa-lg"></a>		   
	   </td>	           
	</tr>';	

   $no++;       
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