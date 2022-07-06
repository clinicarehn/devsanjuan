<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$dato = $_POST['dato'];
$estatus = $_POST['status_valor'];
$paginaActual = $_POST['partida'];
$tipo="";
//EJECUTAMOS LA CONSULTA DE BUSQUEDA

if ($dato == ""){
$query = "SELECT u.id AS id, CONCAT(c.nombre,' ',c.apellido) AS 'usuario', u.username AS username, u.email AS email, e.nombre AS empresa, 
       u.type AS tipo, tipo.nombre AS 'tipo_usuario',
	   CASE WHEN u.estatus = '1' THEN 'Activo' ELSE 'Inactivo' END AS 'estatus'
       FROM users AS u
       INNER JOIN colaboradores AS c
       ON u.colaborador_id = c.colaborador_id 
       INNER JOIN empresa AS e
       ON c.empresa_id = e.empresa_id
	   INNER JOIN tipo_user AS tipo
	   ON u.type = tipo.tipo_user_id
	   WHERE u.estatus = '$estatus'
	   ORDER BY u.id ASC";		   
}else{
$query = "SELECT u.id AS id, CONCAT(c.nombre,' ',c.apellido) AS 'usuario', u.username AS username, u.email AS email, e.nombre AS empresa, 
       u.type AS tipo, tipo.nombre AS 'tipo_usuario',
	   CASE WHEN u.estatus = '1' THEN 'Activo' ELSE 'Inactivo' END AS 'estatus'
       FROM users AS u
       INNER JOIN colaboradores AS c
       ON u.colaborador_id = c.colaborador_id 
       INNER JOIN empresa AS e
       ON c.empresa_id = e.empresa_id
	   INNER JOIN tipo_user AS tipo
	   ON u.type = tipo.tipo_user_id	   
	   WHERE u.estatus = '$estatus' AND (u.id LIKE '$dato%' OR CONCAT(c.nombre,' ',c.apellido) LIKE '$dato%' OR u.username LIKE '$dato%' OR tipo.nombre LIKE '$dato%' OR u.email LIKE '$dato%')
	   ORDER BY u.id ASC";   
}

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
	
if ($dato == ""){
	$registro = "SELECT u.id AS id, CONCAT(c.nombre,' ',c.apellido) AS 'usuario', u.username AS username, u.email AS email, e.nombre AS empresa, u.type AS tipo,
   	   tipo.nombre AS 'tipo_usuario',
	   CASE WHEN u.estatus = '1' THEN 'Activo' ELSE 'Inactivo' END AS 'estatus'
       FROM users AS u
       INNER JOIN colaboradores AS c
       ON u.colaborador_id = c.colaborador_id 
       INNER JOIN empresa AS e
       ON c.empresa_id = e.empresa_id
	   INNER JOIN tipo_user AS tipo
	   ON u.type = tipo.tipo_user_id	
	   WHERE u.estatus = '$estatus'	   
	   ORDER BY u.id ASC LIMIT $limit, $nroLotes";	
	
}else{
	$registro = "SELECT u.id AS id, CONCAT(c.nombre,' ',c.apellido) AS 'usuario', u.username AS username, u.email AS email, e.nombre AS empresa, u.type AS tipo, 
	   tipo.nombre AS 'tipo_usuario',
	   CASE WHEN u.estatus = '1' THEN 'Activo' ELSE 'Inactivo' END AS 'estatus'
       FROM users AS u
       INNER JOIN colaboradores AS c
       ON u.colaborador_id = c.colaborador_id 
       INNER JOIN empresa AS e
       ON c.empresa_id = e.empresa_id
	   INNER JOIN tipo_user AS tipo
	   ON u.type = tipo.tipo_user_id	   
	   WHERE u.estatus = '$estatus' AND (u.id LIKE '$dato%' OR CONCAT(c.nombre,' ',c.apellido) LIKE '$dato%' OR u.username LIKE '$dato%' OR tipo.nombre LIKE '$dato%')
	   ORDER BY u.id ASC LIMIT $limit, $nroLotes";	
}

$result = $mysqli->query($registro);


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			            <tr>
                  	      <th width="2%">Código</th>
                          <th width="13%">Usuario</th>
                          <th width="2%">Username</th>
                          <th width="16%">Email</th>	
                          <th width="33%">Empresa</th>	
                          <th width="21%">Tipo</th>	
						  <th width="3%">Estatus</th>									
             	          <th width="8%">Opciones</th>
			            </tr>';
				
	while($registro2 = $result->fetch_assoc()){					
		$tabla = $tabla.'<tr>
		   <td>'.$registro2['id'].'</td>		
       	   <td>'.$registro2['usuario'].'</td>
		   <td>'.$registro2['username'].'</td>
 		   <td>'.$registro2['email'].'</td>
		   <td>'.$registro2['empresa'].'</td>
		   <td>'.$registro2['tipo_usuario'].'</td>
		   <td>'.$registro2['estatus'].'</td>	   		   		   		   		   		   
		   <td>
               <a style="text-decoration:none;" href="javascript:editarRegistro('.$registro2['id'].');void(0);" class="fas fa-edit fa-lg" title="Editar Registro"></a>
			   <a style="text-decoration:none;" href="javascript:modificarContra('.$registro2['id'].');void(0);" class="fas fa-sync-alt fa-lg" title="Resetear Contraseña"></a>
               <a style="text-decoration:none;" href="javascript:modal_eliminar('.$registro2['id'].');void(0);" class="fas fa-trash fa-lg" title="Eliminar Registro"></a>
           </td>
	  </tr>';		
	}
    
	if($nroProductos == 0){
        $tabla = $tabla.'<tr>
	       <td colspan="13" style="color:#C7030D">No se encontraron resultados</td>
	    </tr>';		
	}else{
       $tabla = $tabla.'<tr>
	      <td colspan="9"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
	   </tr>';		
	}     

    $tabla = $tabla.'</table>';

    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>