<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$dato = $_POST['dato'];
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];
$vehiculo_id = $_POST['vehiculo_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$query = "SELECT c.*, v.nombre AS 'vehiculo', CONCAT(co1.nombre, ' ', co1.apellido) AS 'nombre_transportista', CONCAT(co.nombre, ' ', co.apellido) AS 'nombre_usuario'
    FROM combustible AS c
    INNER JOIN vehiculo AS v
    ON c.vehiculo_id = v.vehiculo_id
	INNER JOIN colaboradores AS co
	ON c.usuario = co.colaborador_id
	INNER JOIN colaboradores AS co1
	ON c.transportista = co1.colaborador_id
	WHERE c.fecha BETWEEN '$fechai' AND '$fechaf' AND c.vehiculo_id = '$vehiculo_id'
	ORDER BY c.vehiculo_id ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;	
	  
    $nroLotes = 20;
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
	  
$registro = "SELECT c.*, v.nombre AS 'vehiculo', CONCAT(co1.nombre, ' ', co1.apellido) AS 'nombre_transportista', CONCAT(co.nombre, ' ', co.apellido) AS 'nombre_usuario'
    FROM combustible AS c
    INNER JOIN vehiculo AS v
    ON c.vehiculo_id = v.vehiculo_id
	INNER JOIN colaboradores AS co
	ON c.usuario = co.colaborador_id
	INNER JOIN colaboradores AS co1
	ON c.transportista = co1.colaborador_id
	WHERE c.fecha BETWEEN '$fechai' AND '$fechaf' AND c.vehiculo_id = '$vehiculo_id'
	ORDER BY c.vehiculo_id ASC LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);	
	  	  
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			  <tr>
                 <th width="10%">Fecha</th>
                 <th width="12%">Vehículo</th>
                 <th width="10%">Tanque Inicio</th>
                 <th width="10%">Cantidad Litros</th>
                 <th width="10%">Tanque Final</th>
                 <th width="10%">Valor de la Compra</th>
                 <th width="10%">Costo por Litro</th>
                 <th width="11%">Motorista</th>
				 <th width="12%">Usuario</th>
				 <th width="5%">Opciones</th>
			  </tr>';
						
if($result->num_rows>0){	
	while($registro2 = $result->fetch_assoc()){
		$tabla = $tabla.'<tr>
		         <td>'.$registro2['fecha'].'</td>
				 <td>'.$registro2['vehiculo'].'</td>
		         <td>'.$registro2['tanque_inicio'].'</td>
		         <td>'.$registro2['cantidad_litros'].'</td>	
		         <td>'.$registro2['tanque_final'].'</td>
				 <td>L. '.$registro2['valor_compra'].'</td>
		         <td>L. '.$registro2['costo_litro'].'</td>
		         <td>'.$registro2['nombre_transportista'].'</td>	
				 <td>'.$registro2['nombre_usuario'].'</td>
			     <td>
				    <a style="text-decoration:none;" href="javascript:editarRegistroCombustible('.$registro2['combustible_id'].');void(0);" class="fas fa-edit fa-lg"></a>
                    <a style="text-decoration:none; "href="javascript:modal_eliminar_combustible('.$registro2['combustible_id'].');void(0);" class="fas fa-trash fa-lg"></a>					
			     </td> 					 
	  </tr>';  
	}
}else{
    $tabla = $tabla.'<tr>
	   <td colspan="6" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}      
	
    $tabla = $tabla.'</table>';

    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>