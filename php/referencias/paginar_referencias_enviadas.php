<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_SESSION['colaborador_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$dato = $_POST['dato'];
$fechai = $_POST['fecha_i'];
$fechaf = $_POST['fecha_f'];
$consolidado = "";
$servicio = $_POST['servicio'];

if($servicio !=0){
	$where = "WHERE re.servicio_id = '$servicio' AND re.fecha BETWEEN '$fechai' AND '$fechaf' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
	$where1 = "WHERE re.servicio_id = '$servicio' AND re.fecha BETWEEN '$fechai' AND '$fechaf' AND respuesta_recibida = 'Si' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";		
}else{
	$where = "WHERE re.fecha BETWEEN '$fechai' AND '$fechaf' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
	$where1 = "WHERE re.fecha BETWEEN '$fechai' AND '$fechaf' AND respuesta_recibida = 'Si' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";			
}	

$query = "SELECT CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', re.ata_id AS 'ata_id', re.referenciar_id AS 'referenciar_id' , DATE_FORMAT(re.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido, ' ', p.nombre) AS 'nombre', p.identidad AS 'identidad', re.expediente AS 'expediente', re.clinico AS 'clinico', re.patologia1 AS 'patologia1', re.patologia2 AS 'patologia2', re.patologia3 AS 'patologia3', re.motivo_referencia AS 'motivo', re.unidad_envia AS 'unidad_envia', CONCAT(c.nombre, ' ', c.apellido) AS 'colaborador', re.respuesta_recibida AS 'respuesta_recibida', ch.centro_nombre AS 'centro', re.servicio_id AS 'servicio_id', re.colaborador_id AS 'colaborador_id', re.unidad_envia AS 'enviadaa', p.pacientes_id AS 'pacientes_id'
	 FROM referencia_enviada AS re
	 INNER JOIN pacientes AS p
	 ON re.expediente = p.expediente
	 LEFT JOIN ata AS at
	 ON re.ata_id = at.ata_id
	 INNER JOIN colaboradores AS c
	 ON re.colaborador_id = c.colaborador_id 
	 INNER JOIN centros_hospitalarios AS ch
	 ON re.unidad_envia = ch.centros_id	
	 INNER JOIN colaboradores AS c1
	 ON re.usuario = c1.colaborador_id			 
	 ".$where."
	 ORDER BY re.fecha ASC
";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
	
$consulta_respuesta = "SELECT COUNT(referenciar_id) AS 'total'
	FROM referencia_enviada AS re
	INNER JOIN pacientes AS p
	ON re.expediente = p.expediente
	LEFT JOIN ata AS at
	ON re.ata_id = at.ata_id
	INNER JOIN colaboradores AS c
	ON re.colaborador_id = c.colaborador_id 
	INNER JOIN centros_hospitalarios AS ch
	ON re.unidad_envia = ch.centros_id	
	INNER JOIN colaboradores AS c1
	ON re.usuario = c1.colaborador_id			
	".$where1;
$result_respuesta = $mysqli->query($consulta_respuesta);
	
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_referencias_enviadas('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_referencias_enviadas('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_referencias_enviadas('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_referencias_enviadas('.($nroPaginas).');">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', re.ata_id AS 'ata_id', DATE_FORMAT(re.fecha, '%d/%m/%Y') AS 'fecha', re.referenciar_id AS 'referenciar_id', CONCAT(p.apellido, ' ', p.nombre) AS 'nombre', p.identidad AS 'identidad', re.expediente AS 'expediente', re.clinico AS 'clinico', re.patologia1 AS 'patologia1', re.patologia2 AS 'patologia2', re.patologia3 AS 'patologia3', re.motivo_referencia AS 'motivo', re.unidad_envia AS 'unidad_envia', CONCAT(c.nombre, ' ', c.apellido) AS 'colaborador', re.respuesta_recibida AS 'respuesta_recibida', ch.centro_nombre AS 'centro', re.servicio_id AS 'servicio_id', re.colaborador_id AS 'colaborador_id', re.unidad_envia AS 'enviadaa', p.pacientes_id AS 'pacientes_id'
	 FROM referencia_enviada AS re
	 INNER JOIN pacientes AS p
	 ON re.expediente = p.expediente
	 LEFT JOIN ata AS at
	 ON re.ata_id = at.ata_id
	 INNER JOIN colaboradores AS c
	 ON re.colaborador_id = c.colaborador_id 	
	 INNER JOIN centros_hospitalarios AS ch
	 ON re.unidad_envia = ch.centros_id	
	 INNER JOIN colaboradores AS c1
	 ON re.usuario = c1.colaborador_id			 
	 ".$where."
	 ORDER BY re.fecha
	 LIMIT $limit, $nroLotes 
";
$result = $mysqli->query($registro);
	
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="8.11%">Fecha</th>
			<th width="20.11%">Nombre</th>
			<th width="4.11%">Identidad</th>
			<th width="5.11%">Expediente</th>
			<th width="17.11%">Motivo Ref.</th>
			<th width="20.11%">Ref Enviada a.</th>
			<th width="13.11%">Persona que registra</th>		
			<th width="5.11%">Respuesta Recibida</th>
			<th width="7.11%">Opciones</th>
			</tr>';			

if($nroProductos>0){
$consulta_respuesta2 = $result_respuesta->fetch_assoc();
$total_respuesta = $consulta_respuesta2['total'];

while($registro2 = $result->fetch_assoc()){	

   $repuesta = $registro2['respuesta_recibida'];	
	$tabla = $tabla.'<tr>
			<td><a style="text-decoration:none" title = "Información de Usuario" href="javascript:showDatosReferenciasEnviadas('.$registro2['ata_id'].');">'.$registro2['fecha'].'</a></td>			
			<td>'.$registro2['nombre'].'</td>
			<td>'.$registro2['identidad'].'</td>
			<td>'.$registro2['expediente'].'</td>		
			<td>'.$registro2['motivo'].'</td>
			<td>'.$registro2['centro'].'</td>
			<td>'.$registro2['usuario'].'</td>
			<td>'.$repuesta.'</td>
			<td>				
			  <a style="text-decoration:none;" href="javascript:modal_agregar_confirmacion_referencia_enviada('.$registro2['referenciar_id'].','.$registro2['colaborador_id'].','.$registro2['servicio_id'].');void(0);" title="Agregar Información a Respuesta Recibida" class="fas fa-plus fa-lg"></a>			
			  <a style="text-decoration:none;" href="javascript:editarReferenciasEnviadas('.$registro2['referenciar_id'].','.$registro2['ata_id'].');void(0);" title="Editar Referencia Enviada" class="fas fa-edit fa-lg"></a>
			  <a style="text-decoration:none;" title = "Eliminar Registro" href="javascript:modal_eliminarEnviadas('.$registro2['ata_id'].','.$registro2['expediente'].','.$registro2['referenciar_id'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-trash fa-lg"></a>				                    
			</td>				
	  </tr>';					
}
	
$tabla = $tabla.'<tr>
   <td colspan="13"><b><p ALIGN="center">Total de Registros Encontrados (Referencias Enviadas y Respuestas Recibidas): '.$nroProductos.'</p></b>
</tr>';
$tabla = $tabla.'<tr>
   <td colspan="13"><b><p ALIGN="center">Total de Respuestas Recibidas: '.$total_respuesta.'</p></b>
</tr>';	
}else{
$tabla = $tabla.'<tr>
			<td colspan="13" style="color:#C7030D">No se encontraron resultados</td>
		</tr>';	
}	
$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$result_respuesta->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>