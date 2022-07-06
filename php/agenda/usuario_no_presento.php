<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['id'];
$fecha = $_POST['fecha'];
$comentario = mb_convert_case(trim($_POST['comentario']), MB_CASE_TITLE, "UTF-8");
$colaborador_id = $_SESSION['colaborador_id'];
$usuario = $_SESSION['colaborador_id'];
date_default_timezone_set('America/Tegucigalpa');

//ELIMINAMOS EL REGISTRO

$update = "UPDATE agenda 
    SET status = 2, preclinica = 3 
	WHERE agenda_id = '$id'";
$mysqli->query($update);

//CONSULTAR PACIENTES_ID DE LA ENTIDAD PACIENTES
$query = = "SELECT expediente, pacientes_id, colaborador_id, servicio_id 
    FROM agenda WHERE agenda_id = '$id'";
$result = $mysqli->query($query);
$consultar2 = $result->fetch_assoc();

$pacientes_id = "";
$colaborador_id = "";
$servicio_id = "";
$expediente = "";

if($result->num_rows>0){
	$pacientes_id = $consultar2['pacientes_id'];
	$colaborador_id = $consultar2['colaborador_id'];
	$servicio_id = $consultar2['servicio_id'];
	$expediente = $consultar2['expediente'];	
}

$fecha_registro = date("Y-m-d H:i:s");

//ACTUALIZAMOS EL STATUS DEL USUARIO
/*
1. USUARIO PENDIENTE DE ATENDER
2. USUARIO NO SE PRESENTO A SU CITA
*/
$update = "UPDATE agenda 
   SET status = 2, preclinica = 2 
   WHERE agenda_id = '$id'";
$mysqli->query($update);

/*********************************************************************************/
if($expediente >=1 && $expediente < 13000){//Esta condicion de mayor que 1 y menor que trece mil se puede eliminar en un futuro
	$paciente = 'S';
}else{
	$consultar_paciente = "SELECT ata_id
         FROM ata
         WHERE expediente = '$expediente' AND servicio_id = '$servicio_id'";
    $result = $mysqli->query($consultar_paciente);
	
	if($result->num_rows>0){
	   $paciente = 'S';
	}else{
		$paciente = 'N';
	}
}

//AGREGAMOS DATOS DEL USUARIO EN LA TABLA AUSENCIAS
//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(ausencia_id) AS max, COUNT(ausencia_id) AS count 
    FROM ausencias");
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if($result->num_rows>0){
	$numero = 0;
    $cantidad = 0;
}

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

$insert = "INSERT INTO ausencias 
    VALUES('$numero','$pacientes_id', '$expediente', '$id','$fecha','$comentario','$usuario','$colaborador_id','$servicio_id','$paciente')";
$mysqli->query($insert);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = "SELECT a.agenda_id AS agenda, a.pacientes_id AS pacientes_id, p.expediente AS expediente, p.nombre AS nombre, p.apellido AS apellido, a.hora AS hora, s.nombre AS 'servicio', a.observacion AS 'observacion'
      FROM agenda AS a
	  INNER JOIN pacientes AS p
      ON a.pacientes_id = p.pacientes_id
	  INNER JOIN servicios AS s
      ON a.servicio_id = s.servicio_id
      WHERE cast(a.fecha_cita as date) = '$fecha' AND a.colaborador_id = '$colaborador_id' AND a.status = 0
      ORDER BY a.hora ASC LIMIT 25";
$result = $mysqli->query($registro);	  

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
			<tr>
			    <th width="6.5%">No.</th>
            	<th width="12.5%">Expediente</th>
                <th width="18.5%">Nombre</th>
				<th width="18.5%">Apellido</th>
				<th width="6.5%">Hora</th>
				<th width="12.5%">Servicio</th>
				<th width="18.5%">Observación</th>
			   	<th width="6.5%">Opciones</th>
			</tr>';
    $i = 1;			
	while($registro2 = $result->fetch_assoc()){
	  if ($registro2['expediente'] == 0){
		  $expediente = "TEMP"; 
	  }else{
		  $expediente = $registro2['expediente'];
	  }
	  
	  if ($registro2['observacion'] == ""){
		 $observacion = "No hay ninguna observación";
	  }else{
		$observacion = $registro2['observacion'];
	  }	 
	  
		echo '<tr>
		        <td>'.$i.'</td>
				<td>'.$expediente.'</td>	
				<td>'.$registro2['nombre'].'</td>	
				<td>'.$registro2['apellido'].'</td>
				<td>'.$registro2['hora'].'</td>
                <td>'.$registro2['servicio'].'</td>
                <td>'.$observacion.'</td>			
				<td>
                  <a title = "Agregar ATA del usuario" href="javascript:editarRegistro('.$registro2['pacientes_id'].','.$registro2['agenda'].','.$registro2['expediente'].');" class="glyphicon glyphicon-book"></a>
				  <a title = "Usuario no se presentó  a su cita" href="javascript:nosePresntoRegistro('.$registro2['agenda'].');" class="glyphicon glyphicon-remove-sign"></a> 
				</td>
				</tr>';
				$i++;
	}
echo '</table>';

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>