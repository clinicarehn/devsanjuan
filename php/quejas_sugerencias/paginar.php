<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$servicio = $_POST['servicio'];
$dato = $_POST['dato'];
$paginaActual = $_POST['partida'];

if($dato != ""){
	$where = "WHERE q.servicio_id = '$servicio' AND fecha BETWEEN '$desde' AND '$hasta' AND (p.expediente LIKE '$dato%' OR p.nombre LIKE '$dato%' OR p.apellido LIKE '$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.telefono LIKE '$dato%' OR p.localidad LIKE '%$dato%')";	
}else{
	$where = "WHERE q.servicio_id = '$servicio' AND q.fecha BETWEEN '$desde' AND '$hasta'";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$query = "SELECT q.pacientes_id AS 'pacientes_id', q.queja_id AS 'queja_id', q.fecha AS 'fecha', p.expediente AS 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS 'paciente', p.email AS 'correo', p.telefono AS 'telefono', 
	(CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h',
	(CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', 
	(CASE WHEN q.gestion = '1' THEN 'Queja' 
		  WHEN q.gestion = '2' THEN 'Sugerencia' 
		  WHEN q.gestion = '3' THEN 'Felicitación' 
		  WHEN q.gestion = '4' THEN 'Reclamo' 
		  ELSE '' END) AS 'gestion',
	(CASE WHEN q.calidez = '1' THEN 'X' ELSE '' END) AS 'calidez',
	(CASE WHEN q.competencia = '1' THEN 'X' ELSE '' END) AS 'competencia',
	(CASE WHEN q.estructura = '1' THEN 'X' ELSE '' END) AS 'estructura',
	(CASE WHEN q.organizacion = '1' THEN 'X' ELSE '' END) AS 'organizacion',
	(CASE WHEN q.otros = '1' THEN 'X' ELSE '' END) AS 'otros',
	q.especifique AS 'especifique', q.descripcion AS 'descripcion',
	CONCAT(c.nombre,' ',c.apellido) AS 'usuario',
	s.nombre AS 'servicio'
	FROM queja AS q
	INNER JOIN pacientes AS p
	ON q.pacientes_id = p.pacientes_id
	INNER JOIN servicios AS s
	ON q.servicio_id = s.servicio_id
	INNER JOIN colaboradores AS c
	ON q.usuario = c.colaborador_id
	".$where."
	ORDER BY q.fecha ASC";
$result = $mysqli->query($query);	
$nroProductos = $result->num_rows;

    $nroLotes = 15;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';

	if($paginaActual > 1){
        $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.(1).');">Inicio</a></li>';
    }
	
    if($paginaActual > 1){
        $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
    }
    
    if($paginaActual < $nroPaginas){
        $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
    }
	
	if($paginaActual > 1){
        $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($nroPaginas).');">Ultima</a></li>';
    }
  
  	if($paginaActual <= 1){
  		$limit = 0;
  	}else{
  		$limit = $nroLotes*($paginaActual-1);
  	}
  
$registro = "SELECT q.pacientes_id AS 'pacientes_id', q.queja_id AS 'queja_id', q.fecha AS 'fecha', p.expediente AS 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS 'paciente', p.email AS 'correo', p.telefono AS 'telefono', 
	(CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h',
	(CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', 
	(CASE WHEN q.gestion = '1' THEN 'Queja' 
		  WHEN q.gestion = '2' THEN 'Sugerencia' 
		  WHEN q.gestion = '3' THEN 'Felicitación' 
		  WHEN q.gestion = '4' THEN 'Reclamo' 
		  ELSE '' END) AS 'gestion',
	(CASE WHEN q.calidez = '1' THEN 'X' ELSE '' END) AS 'calidez',
	(CASE WHEN q.competencia = '1' THEN 'X' ELSE '' END) AS 'competencia',
	(CASE WHEN q.estructura = '1' THEN 'X' ELSE '' END) AS 'estructura',
	(CASE WHEN q.organizacion = '1' THEN 'X' ELSE '' END) AS 'organizacion',
	(CASE WHEN q.otros = '1' THEN 'X' ELSE '' END) AS 'otros',
	q.especifique AS 'especifique', q.descripcion AS 'descripcion',
	CONCAT(c.nombre,' ',c.apellido) AS 'usuario',
	s.nombre AS 'servicio'
	FROM queja AS q
	INNER JOIN pacientes AS p
	ON q.pacientes_id = p.pacientes_id
	INNER JOIN servicios AS s
	ON q.servicio_id = s.servicio_id
	INNER JOIN colaboradores AS c
	ON q.usuario = c.colaborador_id
	".$where."
	ORDER BY q.fecha ASC LIMIT $limit, $nroLotes";	

$result = $mysqli->query($query);	 
  
  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			            <tr>
			               <th width="3.14%">No.</th>
            	           <th width="9.14%">Fecha</th>
                           <th width="7.14%">Expediente</th>
				           <th width="7.14%">Identidad</th>
				           <th width="20.14%">Paciente</th>
						   <th width="5.14%">Gestión</th>
						   <th width="5.14%">Calidez</th>
						   <th width="7.14%">Compentencia</th>
						   <th width="5.14%">Estructura</th>
						   <th width="7.14%">Organización</th>
						   <th width="5.14%">Otros</th>
						   <th width="7.14%">Especifique</th>
						   <th width="7.14%">Servicio</th>
						   <th width="5.14%">Opciones</th>
			            </tr>';				
	$valor = 1;

if($nroProductos>0){	
	while($registro2 = $result->fetch_assoc()){	
		if ($registro2['expediente'] == 0){
		  $expediente = "TEMP"; 
		}else{
		  $expediente = $registro2['expediente'];
		}
	  
		$tabla = $tabla.'<tr>
		   <td>'.$valor.'</td>
		   <td><a style="text-decoration:none" title = "Detalle de Seguimiento" href="javascript:showSeguimiento('.$registro2['queja_id'].');">'.$registro2['fecha'].'</a></td>	
		   <td>'.$expediente.'</td>			   
	  	   <td>'.$registro2['identidad'].'</td>	
           <td>'.$registro2['paciente'].'</td>				
		   <td>'.$registro2['gestion'].'</td>
           <td>'.$registro2['calidez'].'</td>
           <td>'.$registro2['competencia'].'</td>
           <td>'.$registro2['estructura'].'</td>
		   <td>'.$registro2['organizacion'].'</td>
           <td>'.$registro2['otros'].'</td>
		   <td>'.$registro2['especifique'].'</td>
           <td>'.$registro2['servicio'].'</td>	
		   <td>
			  <a style="text-decoration:none;" data-toggle="tooltip" data-placement="right" title = "Agregar Seguimiento" href="javascript:modal_seguimiento('.$registro2['queja_id'].');void(0);" class="fas fa-edit fa-lg"></a>
			  <a style="text-decoration:none;" title = "Eliminar Queja" href="javascript:modal_eliminar('.$registro2['queja_id'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-trash fa-lg"></a>
		   </td>					   
	  </tr>';
	$valor++;	  
	}
        
    $tabla = $tabla.'<tr>
	   <td colspan="18"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
	</tr>';
	
    $tabla = $tabla.'</table>';
}else{
	$tabla = $tabla.'<tr>
				<td colspan="13" style="color:#C7030D">No se encontraron resultados</td>
			</tr>';		
}

    $array = array(0 => $tabla,
    			   1 => $lista);
				   
    echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>