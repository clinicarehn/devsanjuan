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

if($dato == ""){
	$where = "WHERE t.fecha BETWEEN '$fechai' AND '$fechaf' AND t.vehiculo_id = '$vehiculo_id'";
}else{
	$where = "WHERE t.fecha BETWEEN '$fechai' AND '$fechaf' AND t.vehiculo_id = '$vehiculo_id' AND (t.motivo_viaje LIKE '$dato%' OR CONCAT(c.nombre, ' ', c.apellido) LIKE '$dato%' OR CONCAT(c1.nombre, ' ', c1.apellido) LIKE '$dato%')";
}

$query = "SELECT t.*, CONCAT(c.nombre, ' ', c.apellido) AS 'nombre_transportista', CONCAT(c1.nombre, ' ', c1.apellido) AS 'nombre_usuario',    timediff(t.hora_f,t.hora_i) AS 'total_horas', v.nombre AS 'vehiculo', t.transporte_usuarios_id AS '	transporte_usuarios_id'
    FROM transporte_usuarios AS t
    INNER JOIN colaboradores AS c
    ON t.transportista = c.colaborador_id
    INNER JOIN colaboradores AS c1
    ON t.usuario = c1.colaborador_id
	INNER JOIN vehiculo AS v
	ON t.vehiculo_id = v.vehiculo_id
	".$where." 
	ORDER BY t.transporte_usuarios_id ASC";
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
	  
$registro = "SELECT t.*, CONCAT(c.nombre, ' ', c.apellido) AS 'nombre_transportista', CONCAT(c1.nombre, ' ', c1.apellido) AS 'nombre_usuario',    timediff(t.hora_f,t.hora_i) AS 'total_horas', v.nombre AS 'vehiculo', t.transporte_usuarios_id AS '	transporte_usuarios_id'
       FROM transporte_usuarios AS t
       INNER JOIN colaboradores AS c
       ON t.transportista = c.colaborador_id
       INNER JOIN colaboradores AS c1
       ON t.usuario = c1.colaborador_id
	   INNER JOIN vehiculo AS v
	   ON t.vehiculo_id = v.vehiculo_id	   
	   ".$where." 
	   ORDER BY t.transporte_usuarios_id ASC LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);	   
	  	  
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			  <tr>
                 <th width="7.25%">Fecha</th>
                 <th width="11.25%">Motivo Viaje</th>
                 <th width="4.25%">Adultos Hombres</th>
                 <th width="4.25%">Adultos Mujeres</th>
                 <th width="2.25%">Niños</th>
                 <th width="4.25%">Total</th>
                 <th width="6.25%">Hora Inicial</th>
                 <th width="6.25%">Hora Final</th>
				 <th width="6.25%">Total Horas</th>
                 <th width="5.25%">KM Inicial</th>	
                 <th width="5.25%">KM Final</th>
				 <th width="6.25%">Total KM</th>
				 <th width="6.25%">Vehículo</th>
                 <th width="6.25%">Transportista</th>	
                 <th width="6.25%">Usuario</th>
				 <th width="4.25%">Opciones</th>
			  </tr>';
				
$total_h = 0; $total_m = 0; $total_niño = 0; $total_total = 0;				
if($result->num_rows>0){	
	while($registro2 = $result->fetch_assoc()){	
        $horas_transcurridas = 	$registro2['total_horas'];
		$horas = date('H',strtotime($horas_transcurridas));
        $minutos = date('i',strtotime($horas_transcurridas));
		$tabla = $tabla.'<tr>
		         <td>'.$registro2['fecha'].'</td>
				 <td>'.$registro2['motivo_viaje'].'</td>
		         <td>'.number_format($registro2['adult_h']).'</td>
		         <td>'.number_format($registro2['adult_m']).'</td>	
		         <td>'.number_format($registro2['niños']).'</td>
				 <td>'.number_format($registro2['total']).'</td>
		         <td>'.date('g:i a',strtotime($registro2['hora_i'])).'</td>
		         <td>'.date('g:i a',strtotime($registro2['hora_f'])).'</td>	
				 <td>'.$horas.' horas y '.$minutos.' minutos'.'</td>	
		         <td>'.number_format($registro2['km_i']).'</td>
		         <td>'.number_format($registro2['km_f']).'</td>
		         <td>'.number_format($registro2['km_total']).'</td>
				 <td>'.$registro2['vehiculo'].'</td>
		         <td>'.$registro2['nombre_transportista'].'</td>
		         <td>'.$registro2['nombre_usuario'].'</td>	
			     <td>
				    <a style="text-decoration:none;" href="javascript:editarRegistroTransporte('.$registro2['transporte_usuarios_id'].');void(0);" class="fas fa-edit fa-lg"></a>
					<a style="text-decoration:none; "href="javascript:modal_eliminar('.$registro2['transporte_usuarios_id'].');void(0);" class="fas fa-trash fa-lg"></a>
			     </td> 						 
	  </tr>';  
	             $total_h += $registro2['adult_h']; 
		         $total_m += $registro2['adult_m']; 
		         $total_niño += $registro2['niños']; 
		         $total_total += $registro2['total'];   
	}
	
		$tabla = $tabla.'<tr>
		         <td colspan="2"><b>TOTAL GENERAL</b></td>
		         <td><b>'.$total_h.'</b></td>
		         <td><b>'.$total_m.'</b></td>
		         <td><b>'.$total_niño.'</b></td>
		         <td><b>'.$total_total.'</b></td>
                 <td colspan="16"></td>			 
	  </tr>';  	
}else{
    $tabla = $tabla.'<tr>
	   <td colspan="16" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}      
	
    $tabla = $tabla.'</table>';

    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>