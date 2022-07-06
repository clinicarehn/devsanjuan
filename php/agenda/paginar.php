<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$colaborador_id = $_SESSION['colaborador_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];
$dato = $_POST['dato'];
$estado = $_POST['estado'];
	
//CONSULTAR PUESTO_ID	
$consultar_puesto = "SELECT puesto_id 
	FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_puesto);

$consultar_puesto2 = $result->fetch_assoc();

$puesto_id = "";

if($result->num_rows>0){
	$puesto_id = $consultar_puesto2['puesto_id'];
}

//CONSULTAR SERVICIO
$consultar_servicio = "SELECT servicio_id 
	FROM servicios_puestos 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_servicio);
$consultar_servicio2 = $result->fetch_assoc();

$servicio_id = "";	

if($result->num_rows>0){
	$servicio_id = $consultar_servicio2['servicio_id'];	
}

if($puesto_id == 2){
	$where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fechai' AND '$fechaf' AND a.status = '$estado' AND a.colaborador_id = '$colaborador_id' AND a.preclinica IN (1,2) AND (p.expediente LIKE '%$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
}else{
	$where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fechai' AND '$fechaf' AND a.status = '$estado' AND a.colaborador_id = '$colaborador_id' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
}

$query = "SELECT a.agenda_id AS agenda, a.pacientes_id AS pacientes_id, p.expediente AS expediente, CONCAT(p.apellido, ' ', p.nombre) AS 'paciente_nombre', a.hora AS hora, s.nombre AS 'servicio', a.observacion AS 'observacion', p.identidad AS 'identidad', CAST(a.fecha_cita AS DATE) AS 'fecha', c.puesto_id AS 'puesto_id', a.servicio_id AS 'servicio_id', p.telefono AS 'telefono', a.status AS 'estado'
  FROM agenda AS a
  INNER JOIN pacientes AS p
  ON a.pacientes_id = p.pacientes_id
  INNER JOIN servicios AS s
  ON a.servicio_id = s.servicio_id
  INNER JOIN colaboradores AS c
  ON a.colaborador_id = c.colaborador_id
  ".$where."
  ORDER BY a.hora, a.pacientes_id ASC";
$result = $mysqli->query($query);

$nroLotes = 25;
$nroProductos = $result->num_rows;
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

$registro = "SELECT a.agenda_id AS agenda, p.expediente AS expediente, a.pacientes_id AS pacientes_id, CONCAT(p.apellido, ' ', p.nombre) AS 'paciente_nombre', a.hora AS hora, s.nombre AS 'servicio', a.observacion AS 'observacion', p.identidad AS 'identidad', CAST(a.fecha_cita AS DATE) AS 'fecha', c.puesto_id AS 'puesto_id', a.servicio_id AS 'servicio_id', p.telefono AS 'telefono', a.status AS 'estado', c.puesto_id AS 'puesto_id'
  FROM agenda AS a
  INNER JOIN pacientes AS p
  ON a.pacientes_id = p.pacientes_id
  INNER JOIN servicios AS s
  ON a.servicio_id = s.servicio_id
  INNER JOIN colaboradores AS c
  ON a.colaborador_id = c.colaborador_id	  
  ".$where."
  ORDER BY a.hora, a.pacientes_id ASC
  LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="2%">No.</th>
			<th width="6%">Expediente</th>
			<th width="10%">Identidad</th>				
			<th width="23%">Nombre</th>
			<th width="11%">Fecha</th>
			<th width="7%">Hora</th>
			<th width="10%">Servicio</th>
			<th width="5%">Teléfono</th>
			<th width="20%">Observación</th>
			<th width="6%">Opciones</th>
			</tr>';
$i = 1;				
while($registro2 = $result->fetch_assoc()){		
  if ($registro2['expediente'] == 0){
	  $expediente = "TEMP"; 
  }else{
	  $expediente = $registro2['expediente'];
  }
  
  if($registro2['observacion'] == ""){
	 $observacion = "No hay ninguna observación";
  }else{
	$observacion = $registro2['observacion'];
  }	  
  
  
  $estado = $registro2['estado'];
  $puesto = $registro2['puesto_id'];
  $servicio_id = $registro2['servicio_id'];
  
  $receta = "";
  $ata = "";
  $entrevistaTS = ""; 
  $seguimiento = "";
  $ausencia = "";
  $editar_receta = "";
  
  if($estado == 1){
	$receta = '<a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Receta Médica" href="javascript:showRecetaMedica('.$registro2['agenda'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-prescription-bottle-alt fa-lg"></a>'; 
	$editar_receta = '<a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Editar Receta Médica" href="javascript:showRecetaMedicaEdit('.$registro2['agenda'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-prescription fa-lg"></a>'; 	
  }else{	 
	 //SEGUIMIENTO
	 if($servicio_id == 12){
		 $ata = '<a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Agregar ATA del usuario" href="javascript:editarRegistro('.$registro2['pacientes_id'].','.$registro2['agenda'].','.$registro2['expediente'].');void(0);" class="fas fa-book-medical fa-lg"></a>'; 
		 $seguimiento = '<a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Agregar Seguimiento A Usuarios Nuevos" href="javascript:seguimientoUsuarios('.$registro2['pacientes_id'].','.$registro2['agenda'].');void(0);" class="fa fa-user-md fa-lg"></a>';		 
	 }else{
		 $ata = '<a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Agregar ATA del usuario" href="javascript:editarRegistro('.$registro2['pacientes_id'].','.$registro2['agenda'].','.$registro2['expediente'].');void(0);" class="fas fa-book-medical fa-lg"></a>'; 		 
	 }
	 
	 if($puesto != 2){
		$ausencia = '<a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Usuario no se presentó  a su cita" href="javascript:nosePresento('.$registro2['agenda'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-times-circle fa-lg"></a>';		 
	 }
  }
  
  $telefonousuario = '<a style="text-decoration:none" title = "Teléfono Usuario" href="tel:9'.$registro2['telefono'].'">'.$registro2['telefono'].'</a>'; 
  
  if($puesto_id == 11){
	$entrevistaTS = '<a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Entrevista Trabajo Social" href="javascript:agregarEntrevistaTS('.$registro2['pacientes_id'].','.$registro2['servicio_id'].','.$registro2['expediente'].');void(0);" class="fas fa-notes-medica fa-lg"></a>'; 	  
  }
  
	$tabla = $tabla.'<tr>
			<td>'.$i.'</td> 
			<td>'.$expediente.'</td>
			<td>'.$registro2['identidad'].'</td>	
			<td>'.$registro2['paciente_nombre'].'</td>
			<td>'.$registro2['fecha'].'</td>
			<td>'.date('g:i a',strtotime($registro2['hora'])).'</td>
			<td>'.$registro2['servicio'].'</td>
			<td>'.$telefonousuario.'</td>
			<td>'.$observacion.'</td>				
			<td>
			  '.$ata.'
			  '.$entrevistaTS.'
			  '.$receta.'
			  '.$editar_receta.'
			  '.$seguimiento.'		  
			  '.$ausencia.'
			</td>
			</tr>';	
			$i++;				
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