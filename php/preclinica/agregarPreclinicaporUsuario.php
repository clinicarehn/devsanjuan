<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
header("Content-Type: text/html;charset=utf-8");
$proceso = $_POST['pro'];
$id = $_POST['id-registro'];
$expediente = $_POST['expediente'];
$fecha = $_POST['fecha'];
$pa = $_POST['pa'];
$fr = $_POST['fr'];
$fc = $_POST['fc'];
$temperatura = $_POST['temperatura'];
$peso = $_POST['peso'];
$talla = $_POST['talla'];
$glucometria = $_POST['glucometria'];
$fecha_registro = date("Y-m-d H:i:s");
$observaciones = cleanStringStrtolower($_POST['observaciones']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAR SERVICIO
$consulta_servicio = "SELECT a.servicio_id, a.pacientes_id, a.colaborador_id, c.puesto_id
   FROM agenda AS a
   INNER JOIN colaboradores AS c
   ON a.colaborador_id = c.colaborador_id
   WHERE a.agenda_id = '$id'";
$result = $mysqli->query($consulta_servicio);   
$consulta_servicio2 = $result->fetch_assoc();
$servicio = $consulta_servicio2['servicio_id'];
$pacientes_id = $consulta_servicio2['pacientes_id'];
$medico = $consulta_servicio2['colaborador_id'];
$puesto_id = $consulta_servicio2['puesto_id'];
$postclinica = 0;

if($servicio == 7){
	$postclinica = 0;
}else{
	$postclinica = 1;
}

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(preclinica_id) AS max, COUNT(preclinica_id) AS count 
  FROM preclinica";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	
//CONSULTAR FECHA DE NACIMIENTO
$consulta_nacimiento = "SELECT fecha_nacimiento 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_nacimiento);
$consulta_nacimiento2 = $result->fetch_assoc();
$fecha_de_nacimiento = $consulta_nacimiento2['fecha_nacimiento'];

/*********************************************************************************/
//CONSULTA AÑO, MES y DIA DEL PACIENTE
$nacimiento = "SELECT fecha_nacimiento AS fecha 
	FROM pacientes 
	WHERE expediente = '$expediente'";
$result = $mysqli->query($nacimiento);
$nacimiento2 = $result->fetch_assoc();
$fecha_nacimiento = $nacimiento2['fecha'];

$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/
if($expediente >=1 && $expediente < 13000){//Esta condicion de mayor que 1 y menor que trece mil se puede eliminar en un futuro
	$paciente = 'S';
}else{
	$consultar_paciente = "SELECT ata_id
         FROM ata
         WHERE expediente = '$expediente' AND servicio_id = '$servicio'";
	$result = $mysqli->query($consultar_paciente);
	if($result->num_rows>0){
	   $paciente = 'S';
	}else{
		$paciente = 'N';
	}
}
//CONSULTAR AGENDA SI HAY VALORES
$consultar_agenda = "SELECT a.agenda_id 
FROM agenda AS a
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
WHERE a.expediente = '$expediente' AND cast(a.fecha_cita AS DATE) = '$fecha' AND c.puesto_id = '$puesto_id' AND a.servicio_id = '$servicio'";
$result = $mysqli->query($consultar_agenda);
$consultar_agenda1 = $result->fetch_assoc();
$consultar_agenda2 = $result->num_rows;
$agenda_id = $consultar_agenda1['agenda_id'];


//VERIFICAMOS EL PROCESO
if ($proceso = 'Registro'){
	
   //CONSULTAR Registro
   $consultar_registro = "SELECT p.preclinica_id 
       FROM preclinica AS p
       WHERE p.expediente = '$expediente' AND p.fecha = '$fecha' AND p.servicio_id = '$servicio' AND p.colaborador_id = '$medico'"; 
	$result = $mysqli->query($consultar_registro);

   if($result->num_rows>0){
	   echo 2; //REGISTRO YA EXISTE
   }else{

	   //GUARDAR LA GLUCOMETRÍA	   
	   if($glucometria != "" && $expediente != "" && $medico != "" && $servicio != "" && $id != "" && $numero !=""){
           //OBTENER CORRELATIVO
           $correlativo_gluco= "SELECT MAX(preclinica_gluco_id) AS max, COUNT(preclinica_gluco_id) AS count 
		      FROM preclinica_gluco";
		   $result = $mysqli->query($correlativo_gluco);
           $correlativo_gluco2 = $result->fetch_assoc();

           $numero_gluco = $correlativo_gluco2['max'];
           $cantidad_gluco = $correlativo_gluco2['count'];

           if ( $cantidad_gluco == 0 )
	           $numero_gluco = 1;
           else
               $numero_gluco = $numero_gluco + 1;			   
		   	   	 			 
		  $insert = "INSERT INTO preclinica_gluco 
		      VALUES('$numero_gluco', '$numero', '$id','$fecha','$fecha_registro','$expediente','$medico', '$servicio', '$glucometria','$observaciones','$usuario')";
		  $mysqli->query($insert);
		   
          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
          $historial_numero = historial();
          $estado = "Agregar";
          $observacion = "Se realizó un valor para la glucometria de este usuario en la precliníca";
          $modulo = "Preclinica";
          $insert = "INSERT INTO historial 
               VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
          $mysqli->query($insert);
         /*****************************************************/		   
	   }
	   /******************************************************************************************************************************/	
	   
	   $insert = "INSERT INTO preclinica 
	       VALUES('$numero', '$pacientes_id', '$expediente', '$medico', '$anos', '$fecha', '$pa', '$fr', '$fc', '$temperatura', '$peso', '$talla', '$servicio', '$observaciones', '$usuario','$paciente','$fecha_registro')";
       $query = $mysqli->query($insert);
	   
       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado = "Agregar";
       $observacion = "Se realizó la preclínica para este usuario";
       $modulo = "Preclinica";
       $insert = "INSERT INTO historial 
           VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/
	   
       if($query){
		   if ($consultar_agenda2 > 0){
			   $update = "UPDATE agenda SET preclinica = 1 
			       WHERE agenda_id = '$agenda_id' AND CAST(fecha_cita AS DATE) = '$fecha'";
			   $mysqli->query($update);
			   
               //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
               $historial_numero = historial();
               $estado = "Actualizar";
               $observacion = "Se actualiza el campo preclínica en la entidad agenda, desde preclínica";
               $modulo = "Agenda";
               $insert = "INSERT INTO historial 
                   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
               $mysqli->query($insert);
               /*****************************************************/			   
		   }
    	
		   if($paciente == 'N'){
				$update = "UPDATE agenda SET postclinica = $postclinica 
				   WHERE agenda_id = '$agenda_id' AND CAST(fecha_cita AS DATE) = '$fecha'";
				$mysqli->query($update);
				
               //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
               $historial_numero = historial();
               $estado = "Actualizar";
               $observacion = "Se actualiza el campo postclínica en la entidad agenda, desde preclínica";
               $modulo = "Agenda";
               $insert = "INSERT INTO historial 
                   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
               $mysqli->query($insert);
               /*****************************************************/					
		   }
			
		   echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
	   }else{
		   echo 3; //ERROR AL ALMACENAR EL REGISTRO;
	   }
   }  
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>