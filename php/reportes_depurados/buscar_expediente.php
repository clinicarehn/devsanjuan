<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$expediente_valor = $_POST['expediente'];

$consultar_expediente = "SELECT expediente 
   FROM pacientes 
   WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];

//OBTENEMOS LOS VALORES DEL REGISTRO
if($expediente != ""){
    //CONSULTA EN LA ENTIDAD CORPORACION
    $valores = "SELECT p.expediente AS 'expediente', p.identidad AS 'identidad', ag.agenda_id AS 'agenda_id', c.colaborador_id AS 'medico', CAST(ag.fecha_cita AS DATE) AS 'fecha_cita',  CONCAT(p.nombre,' ',p.apellido) AS 'nombre', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', c.colaborador_id AS 'colaborador_id', ag.servicio_id AS 'servicio_id', pa1.patologia_id AS 'patologia1', pa2.patologia_id AS 'patologia2', pa3.patologia_id AS 'patologia3'
       FROM pacientes AS p 
       LEFT JOIN agenda AS ag
       ON p.expediente = ag.expediente
       LEFT JOIN ata AS a
       ON p.expediente = a.expediente
       LEFT JOIN colaboradores AS c
       ON ag.colaborador_id = c.colaborador_id
       LEFT JOIN patologia As pa1
       ON a.patologia_id = pa1.id
       LEFT JOIN patologia As pa2
       ON a.patologia_id1 = pa2.id
       LEFT JOIN patologia As pa3
       ON a.patologia_id2 = pa3.id
       WHERE p.expediente = '$expediente'
       ORDER BY ag.agenda_id DESC LIMIT 1";
	   //WHERE p.expediente = '$expediente' AND ag.status = 1	   
	   $result = $mysqli->query($valores);
	
       $valores2 = $result->fetch_assoc();
       $fecha = date('Y-m-d');

       $nroProductos = $result->num_rows;
   
       if($nroProductos>0){	
           $diagnostico1 = $valores2['patologia1'];
           $diagnostico2 = $valores2['patologia2'];
           $diagnostico3 = $valores2['patologia3'];
 
       if($diagnostico2 ==""){
           $diagnostico = $diagnostico1;
       }else if($diagnostico2 !="" && $diagnostico3 ==""){
          $diagnostico = $diagnostico1.'/'.$diagnostico2;		   
       }else{
          $diagnostico = $diagnostico1.'/'.$diagnostico2.'/'.$diagnostico3;
       }
   
	   $datos = array( 	
	            0 => 'bien',
                1 => $valores2['nombre'],					
				2 => $valores2['servicio_id'],	
				3 => $valores2['colaborador_id'],	
				4 => $diagnostico,	
				5 => $valores2['fecha_cita'],
				6 => $valores2['medico'],
				7 => $valores2['identidad'],
	  );
   }else{
	   $datos = array( 	
                0 => 'error_encontrar',
	  );	   
   }
  }else{
	   $datos = array( 	
             0 => 'error',
	   );
  }			
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>