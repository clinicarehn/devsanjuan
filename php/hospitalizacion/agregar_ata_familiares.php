<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];

$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$fecha_registro = date("Y-m-d H:i:s");
$obs = cleanStringStrtolower($_POST['obs']);
$paciente = $_POST['paciente'];
$colaborador_id = $_SESSION['colaborador_id'];
$servicio = $_POST['servicio'];

$consultar_expediente = "SELECT expediente, pacientes_id, tipo
       FROM pacientes 
	   WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 2";
$result = $mysqli->query($consultar_expediente);	   
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];
$tipo = $consultar_expediente2['tipo'];

//CONSULTAR EL NOMBRE DEL SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio2['nombre'];

/*********************************************************************************/
//CONSULTA AÑO, MES y DIA DEL PACIENTE
$nacimiento = "SELECT fecha_nacimiento AS fecha, localidad, departamento_id, municipio_id 
	 FROM pacientes 
	 WHERE expediente = '$expediente'";
$result = $mysqli->query($nacimiento);
$nacimiento2 = $result->fetch_assoc();
$fecha_nacimiento = $nacimiento2['fecha'];
$departamento_id = $nacimiento2['departamento_id'];
$municipio_id = $nacimiento2['municipio_id'];
$localidad = $nacimiento2['localidad'];

$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/

//CONSULTAR EXISTENCIA DE REGISTRO
$consulta = "SELECT ata_familiares_id
    FROM ata_familiares
	WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio' AND fecha = '$fecha'";
$result = $mysqli->query($consulta);	
$consulta2 = $result->fetch_assoc();
$familiares_ata_id = $consulta2['ata_familiares_id'];
	
$numero_atenciones = correlativo("ata_familiares_id", "ata_familiares");

if($tipo == 2){
  if($familiares_ata_id == ""){
    if($colaborador_id != 0){
      $insert = "INSERT INTO ata_familiares 
           VALUES('$numero_atenciones','$pacientes_id','$expediente','$colaborador_id','$servicio', '$paciente', '$anos', '$meses', '$dias', '$fecha', '$obs','$fecha_registro')";
	  $query = $mysqli->query($insert);
	  
     //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
      $historial_numero = historial();
      $estado = "Agregar";
      $observacion_historial = "Se ha agregado un nuevo registro en el ATA de Familiares para el servicio: $servicio_nombre";
      $modulo = "ATA Familiares";
      $insert = "INSERT INTO historial 
          VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_atenciones','$colaborador_id','$servicio','$fecha','$estado','$observacion_historial','$colaborador_id','$fecha_registro')";	 
      $mysqli->query($insert);
      /*****************************************************/		  
		   
      if($query){
	      echo 2;//REGISTRO ALMACENADO CORRECTAMENTE	  		  
      }else{
	      echo 3;//ERROR EN ALMACENAR EL REGISTRO
      }	   
   }else{
	  echo 1;//SU SESIÓN HA VENCIDO, POR FAVOR INICIAR SESIÓN NUEVAMENTE
   }
  }else{
	echo 4;//ESTE REGISTRO YA HA SIDO ALMACENADO ANTERIORMENTE
  }
}else{
	echo 5;//NO SE PUEDE AGREGAR USUARIOS, SOLO FAMILIARES.
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>