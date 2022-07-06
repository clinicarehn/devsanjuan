<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$proceso = $_POST['pro'];
$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$colaborador_id = $_SESSION['colaborador_id'];
$recibida = $_POST['recibida'];
$unidad = $_POST['unidad'];
$servicio = $_POST['servicio'];
$motivo = cleanStringStrtolower($_POST['motivo']);
$año = date("Y", strtotime(date('Y-m-d')));
$fecha_inical = date("Y-m-d", strtotime($año."-01-01"));
$fecha_final = date("Y-m-d", strtotime($año."-12-31"));
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

$consultar_expediente = "SELECT expediente, pacientes_id
    FROM pacientes 
	WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

//CONSULTAR PUESTO
$consulta_puesto = "SELECT puesto_id 
   FROM colaboradores 
   WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc();
$puesto_id = $consulta_puesto1['puesto_id'];	 

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(transito_id) AS max, COUNT(transito_id) AS count 
   FROM transito_recibida";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

//CONSULTAR FECHA DE NACIMIENTO
$consulta_nacimiento = "SELECT fecha_nacimiento, departamento_id, municipio_id 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_nacimiento);
$consulta_nacimiento2 = $result->fetch_assoc();
$fecha_de_nacimiento = $consulta_nacimiento2['fecha_nacimiento'];
$departamento_id = $consulta_nacimiento2['departamento_id'];
$municipio_id = $consulta_nacimiento2['municipio_id'];

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
	
//VERIFICAMOS EL PROCESO

if ($proceso = 'Registro'){
	
   //CONSULTAR REGISTRO
   $consultar_registro = "SELECT transito_id 
         FROM transito_recibida AS t
		 INNER JOIN colaboradores AS c
		 ON t.colaborador_id = c.colaborador_id
         WHERE t.expediente = '$expediente' AND t.fecha = '$fecha' AND t.servicio_id = '$servicio' AND c.puesto_id = '$puesto_id '"; 
   $result = $mysqli->query($consultar_registro);

   if($result->num_rows>0){
	   echo 2; //REGISTRO YA EXISTE
   }else{
	   //CONSULTAR ATA ID
	   $consultar_ata = "SELECT a.ata_id 
	         FROM ata AS a
			 INNER JOIN colaboradores AS c
			 ON a.colaborador_id = c.colaborador_id
	         WHERE c.puesto_id = '$puesto_id ' AND a.expediente = '$expediente' AND a.fecha = '$fecha' AND a.servicio_id = '$servicio'";
	   $result = $mysqli->query($consultar_ata);
	   
	   if($result->num_rows>0){//SI REGISTRO FUE ENCONTRADO, SE ALMACENA EL ATA_ID
		  $consultar_ata2 = $result->fetch_assoc(); 
		  $ata_id = $consultar_ata2['ata_id'];
	   }else{//DE LO CONTRARIO SE GUARDA EN CERO
		  $ata_id = 0;
	   }
	   
       //CONSULTA EN LA ENTIDAD ATA
       $valores = "SELECT a.ata_id
          FROM ata AS a
          INNER JOIN colaboradores AS c
          ON a.colaborador_id = c.colaborador_id
          WHERE a.expediente = '$expediente' AND a.fecha BETWEEN '$fecha_inical' AND '$fecha_final' AND a.servicio_id = '$servicio' AND c.puesto_id = '$puesto_id'";
	  $result = $mysqli->query($valores);
	 
      $valores2 = $result->fetch_assoc();

      if($result->num_rows>0){
	     $paciente = "S";
      }else{
	     $paciente = "N";	
      }		
	 
	   if($ata_id != 0 && $servicio != 0 && $colaborador_id != 0 && $expediente != 0 && $departamento_id != 0 && $municipio_id != 0){
		   $insert = "INSERT INTO transito_recibida 
		      VALUES('$numero', '$fecha', '$ata_id', '$expediente', '$colaborador_id', '$anos', '$paciente', '$departamento_id', '$municipio_id', '$recibida', '$unidad', '$servicio', '$motivo','$fecha_registro')";
		   $mysqli->query($insert);
		   
           //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado = "Agregar";
           $observacion = "Se ha agregado el transito para este usuario";
           $modulo = "Transito Recibida";
           $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
           $mysqli->query($insert);
           /*****************************************************/		   
	   }
       echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
   }  
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>