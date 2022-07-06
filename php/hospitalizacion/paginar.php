<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_SESSION['colaborador_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$fecha = $_POST['fecha'];
$fechaf = $_POST['fechaf'];
$dato = $_POST['dato'];
$sala = $_POST['sala'];
$unidad = $_POST['unidad'];

if($sala == ""){
	$where = "WHERE hm.estado IN(1,2) AND hm.fecha BETWEEN '$fecha' AND '$fechaf' AND hm.puesto_id = $unidad AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
}else{
	$where = "WHERE c.sala_id = '$sala' AND c.estado IN(1,2) AND hm.puesto_id = $unidad AND hm.fecha BETWEEN '$fecha' AND '$fechaf' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
}
	
$query = "SELECT hm.historial_id as 'historial_id', DATE_FORMAT(CAST(hm.fecha AS DATE ), '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'paciente', p.expediente, p.identidad, s.nombre As 'sala', c.codigo AS 'cama', hm.color AS 'color', hm.estado AS 'estado', c.cama_id AS 'cama_id', c1.apellido AS 'apellido', c1.nombre AS 'nombre'
   FROM historial_camas AS hm
   INNER JOIN camas AS c
   on hm.cama_id = c.cama_id
   INNER JOIN pacientes AS p
   ON hm.expediente = p.expediente
   INNER JOIN sala AS s
   ON c.sala_id = s.sala_id
   INNER JOIN colaboradores AS c1
   ON hm.usuario = c1.colaborador_id		   
   ".$where."
   ORDER BY c.cama_id, p.expediente ASC";
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

$registro = "SELECT hm.historial_id as 'historial_id', DATE_FORMAT(CAST(hm.fecha AS DATE ), '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'paciente', p.expediente, p.identidad, s.nombre As 'sala', c.codigo AS 'cama', hm.color AS 'color', hm.estado AS 'estado', c.cama_id AS 'cama_id', c1.apellido AS 'apellido', c1.nombre AS 'nombre'
   FROM historial_camas AS hm
   INNER JOIN camas AS c
   on hm.cama_id = c.cama_id
   INNER JOIN pacientes AS p
   ON hm.expediente = p.expediente
   INNER JOIN sala AS s
   ON c.sala_id = s.sala_id
   INNER JOIN colaboradores AS c1
   ON hm.usuario = c1.colaborador_id
   ".$where."
   ORDER BY c.cama_id, p.expediente ASC
   LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="8.11%">Fecha</th>
			<th width="24.11%">Nombre</th>
			<th width="6.11%">Expediente</th>
			<th width="11.11%">Identidad</th>
			<th width="12.11%">Sala</th>					
			<th width="2.11%">Cama</th>
			<th width="15.11%">Usuario</th>					
			<th width="15.11%">Estado</th>
			<th width="6.11%">Opciones</th>
			</tr>';
			
while($registro2 = $result->fetch_assoc()){	
	$historial_id = $registro2['historial_id'];
	
	//CONSULTAR ALTA HOSPITALIZACION
	$consulta = "SELECT alta 
		 FROM hospitalizacion 
		 WHERE historial_id = '$historial_id'";
	$result_consulta = $mysqli->query($consulta);
	$consulta2 = $result_consulta->fetch_assoc();
	$alta = $consulta2['alta'];
	
	$nombre_ = explode(" ", trim(ucwords(strtolower($registro2['nombre']), " ")));
	$nombre_usuario = $nombre_[0];
	$apellido_ = explode(" ", trim(ucwords(strtolower($registro2['apellido']), " ")));	
	$nombre_apellido = $apellido_[0];

	$usuario_sistema_nombre = $nombre_usuario." ".$nombre_apellido;		
		
	$color = $registro2['color'];
	$tabla = $tabla.'<tr>
			<td>'.$registro2['fecha'].'</td>	
			<td>'.$registro2['paciente'].'</td>
			<td>'.$registro2['expediente'].'</td>
			<td>'.$registro2['identidad'].'</td>
			<td>'.$registro2['sala'].'</td>
			 <td>'.$registro2['cama'].'</td>	
			<td>'.$usuario_sistema_nombre.'</td>				
			<td align = "center" bgcolor = '.$color.'></td>
			<td>                  				  
			  <a title = "Cama Ocupada" href="javascript:camaOcupada('.$registro2['historial_id'].','.$registro2['estado'].','.$registro2['cama_id'].','.$registro2['expediente'].','.$alta.');void(0);" class="fas fa-check-circle fa-lg" style="text-decoration:none;"></a> 
			  <a title = "Cama Alta-Ocupada" href="javascript:camaAltaOcupada('.$registro2['historial_id'].','.$registro2['estado'].','.$registro2['cama_id'].','.$registro2['expediente'].','.$alta.');void(0);" class="fas fa-times-circle fa-lg" style="text-decoration:none;"></a> 				 
			  <a title = "Eliminar Usuario" href="javascript:modal_eliminar('.$registro2['historial_id'].','.$registro2['cama_id'].','.$registro2['expediente'].','.$alta.');void(0);" class="fas fa-trash fa-lg" style="text-decoration:none;"></a>				  
			</td>					
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