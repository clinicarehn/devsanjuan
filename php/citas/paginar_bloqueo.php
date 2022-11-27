<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$paginaActual = $_POST['partida'];
$unidad = $_POST['unidad'];
$medico = $_POST['medico'];
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];

$fecha = date('Y-m-d');

if($unidad != ""){
    $where = "WHERE c.puesto_id = '$unidad' AND CAST(a.fecha_cita AS DATE) BETWEEN '$fechai' AND '$fechaf'";
}else if($unidad != "" || $medico !== ""){
    $where = "WHERE c.puesto_id = '$unidad' AND c.colaborador_id = '$medico' AND CAST(a.fecha_cita AS DATE) BETWEEN '$fechai' AND '$fechaf'";
}else{
    $where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fechai' AND '$fechaf'";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$query = "SELECT a.bloqueo_id AS 'bloqueo_id', CONCAT(c.nombre, ' ', c.apellido) AS 'profesional', a.fecha_cita AS 'fecha', s.nombre AS 'servicio', a.observacion AS 'comentario'
    FROM bloqueo AS a
    INNER JOIN colaboradores AS c
    ON a.colaborador_id = c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id
    ".$where."
    ORDER BY a.fecha_cita, a.colaborador_id DESC";

    $result = $mysqli->query($query);
	$nroProductos = $result->num_rows;
	
    $nroLotes = 3;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';

	if($paginaActual > 1){
        $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_ausencias('.(1).');">Inicio</a></li>';
    }
	
    if($paginaActual > 1){
        $lista = $lista.'<l class="page-item"i><a class="page-link" href="javascript:pagination_ausencias('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
    }
    
    if($paginaActual < $nroPaginas){
        $lista = $lista.'<liclass="page-item"><a class="page-link" href="javascript:pagination_ausencias('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
    }
	
	if($paginaActual > 1){
        $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_ausencias('.($nroPaginas).');">Ultima</a></li>';
    }
  
  	if($paginaActual <= 1){
  		$limit = 0;
  	}else{
  		$limit = $nroLotes*($paginaActual-1);
  	}		  
	   
$registro = "SELECT a.bloqueo_id AS 'bloqueo_id',  CONCAT(c.nombre, ' ', c.apellido) AS 'profesional', a.fecha_cita AS 'fecha', s.nombre AS 'servicio', a.observacion AS 'comentario', a.colaborador_id AS 'colaborador_id'
    FROM bloqueo AS a
    INNER JOIN colaboradores AS c
    ON a.colaborador_id = c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id
    ".$where."
    ORDER BY a.fecha_cita, a.colaborador_id LIMIT $limit, $nroLotes";

$result = $mysqli->query($registro);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			  <tr>
                <th width="2.66%">N°</th>  
                <th width="20.66%">Servicio</th>
                <th width="20.66%">Colaborador</th>					
                <th width="22.66%">Fecha</th>
				<th width="30.66%">Comentario</th>
				<th width="2.66%">Opciones</th>
			   </tr>';
$i = 1;					
if($result->num_rows>0){	
	while($registro2 = $result->fetch_assoc()){
		$tabla = $tabla.'<tr>	
           <td>'.$i.'</td>	
           <td>'.$registro2['servicio'].'</td>		   
       	   <td>'.$registro2['profesional'].'</td>
		   <td>'.$registro2['fecha'].'</td>	
           <td>'.$registro2['comentario'].'</td>
           <td>
            <a style="text-decoration:none;" title = "Asignar Expediente a Usuario de Forma Manual" href="javascript:modal_eliminarRegistroBloqueo('.$registro2['bloqueo_id'].','.$registro2['colaborador_id'].');void(0);" class="fas fa-trash fa-lg"></a>
           </td>	   
	  </tr>';	  
	}
      $tabla = $tabla.'<tr>
	   <td colspan="6"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
	  </tr>';		
}else{
    $tabla = $tabla.'<tr>
	   <td colspan="6" style="color:#C7030D">No se encontraron resultados.</td>
	</tr>';		
}      
	
    $tabla = $tabla.'</table>';

    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>