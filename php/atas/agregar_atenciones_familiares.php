<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

include('../conexion-postgresql.php');
date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];

$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$fecha_registro = date("Y-m-d H:i:s");
$obs = mb_convert_case(trim($_POST['obs']), MB_CASE_TITLE, "UTF-8");
$colaborador_id = $_SESSION['colaborador_id'];
$servicio = $_POST['servicio'];
$usuario = $_SESSION['colaborador_id'];

$consultar_expediente = "SELECT expediente, pacientes_id 
       FROM pacientes 
	   WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_expediente);	   
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

//DETALLE ATENCIONES A FAMILIARES
//1ERA FILA
$identidad1 = $_POST['identidad1'];
$nombre1 = $_POST['nombre1'];
$responsable1 = $_POST['responsable1'];
$genero1 = $_POST['genero1'];
$observaciones1 = mb_convert_case(trim($_POST['observaciones1']), MB_CASE_TITLE, "UTF-8");

//2DA FILA
$identidad2 = $_POST['identidad2'];
$nombre2 = $_POST['nombre2'];
$responsable2 = $_POST['responsable2'];
$genero2 = $_POST['genero2'];
$observaciones2 = mb_convert_case(trim($_POST['observaciones2']), MB_CASE_TITLE, "UTF-8");

//3ERA FILA
$identidad3 = $_POST['identidad3'];
$nombre3 = $_POST['nombre3'];
$responsable3 = $_POST['responsable3'];
$genero3 = $_POST['genero3'];
$observaciones3 = mb_convert_case(trim($_POST['observaciones3']), MB_CASE_TITLE, "UTF-8");

//4TA FILA
$identidad4 = $_POST['identidad4'];
$nombre4 = $_POST['nombre4'];
$responsable4 = $_POST['responsable4'];
$genero4 = $_POST['genero4'];
$observaciones4 = mb_convert_case(trim($_POST['observaciones4']), MB_CASE_TITLE, "UTF-8");

//5TA FILA
$identidad5 = $_POST['identidad5'];
$nombre5 = $_POST['nombre5'];
$responsable5 = $_POST['responsable5'];
$genero5 = $_POST['genero5'];
$observaciones5 = mb_convert_case(trim($_POST['observaciones5']), MB_CASE_TITLE, "UTF-8");

//CONSULTAR EXISTENCIA DE REGISTRO
$consulta = "SELECT familiares_aten_id
    FROM familiares_aten
	WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio' AND fecha = '$fecha'";
$result = $mysqli->query($consulta);	
$consulta2 = $result->fetch_assoc();
$familiares_aten_id = $consulta2['familiares_aten_id'];	
	
$numero_atenciones = correlativo("familiares_aten_id", "familiares_aten");

//VERIFICAMOS QUE EXISTA ATENCION ALMACENADA DEL USUARIO
$atencion = "SELECT ata_id 
    FROM ata
	WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio' AND fecha = '$fecha'";
$result = $mysqli->query($atencion);	
$atencion2 = $result->fetch_assoc();
$atencion_devuelta = $atencion2['ata_id'];	

if($atencion_devuelta != ""){
  if($familiares_aten_id == ""){
    if($colaborador_id != 0){
      $insert = "INSERT INTO familiares_aten 
           VALUES('$numero_atenciones','$pacientes_id','$expediente','$colaborador_id','$servicio','$fecha','$obs','$fecha_registro')";
	  $query = $mysqli->query($insert);
	  
      //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
      $historial_numero = historial();
      $estado = "Agregar";
      $observacion = "Se ha agregado un nuevo registro de atencioens a familiares";
      $modulo = "Atenciones Familiares";
      $insert = "INSERT INTO historial 
          VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_atenciones','$colaborador_id','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
      $mysqli->query($insert);
      /*****************************************************/		  

      if($query){
	      echo 2;//REGISTRO ALMACENADO CORRECTAMENTE
	   
	      //ALMACENAMOS LOS DETALLES
          if($identidad1 != "" && $nombre1 != "" && $responsable1 != "" && $genero1 != "" && $observaciones1 != ""){
			  $numero_atenciones_detalles = correlativo("familiares_aten_detalles_id", "familiares_aten_detalles");
	   
	          $insert = "INSERT INTO familiares_aten_detalles 
	               VALUES('$numero_atenciones_detalles','$numero_atenciones','$identidad1','$nombre1','$responsable1','$genero1','$observaciones1')";
              $mysqli->query($insert);

              //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
              $historial_numero = historial();
              $estado = "Agregar";
              $observacion = "Se almacena los detalles de los familiares atendidos";
              $modulo = "Atenciones a Familiares";
              $insert = "INSERT INTO historial 
                   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_atenciones','$colaborador_id','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
              $mysqli->query($insert);
              /*****************************************************/				  
          }	  

          if($identidad2 != "" && $nombre2 != "" && $responsable2 != "" && $genero2 != "" && $observaciones2 != ""){;
			  $numero_atenciones_detalles = correlativo("familiares_aten_detalles_id", "familiares_aten_detalles");
	   
	          $insert = "INSERT INTO familiares_aten_detalles 
	               VALUES('$numero_atenciones_detalles','$numero_atenciones','$identidad2','$nombre2','$responsable2','$genero2','$observaciones2')";
              $mysqli->query($insert);				   
          }	  

          if($identidad3 != "" && $nombre3 != "" && $responsable3 != "" && $genero3 != "" && $observaciones3 != ""){
	          $numero_atenciones_detalles = correlativo("familiares_aten_detalles_id", "familiares_aten_detalles");
	   
	          $insert = "INSERT INTO familiares_aten_detalles 
	               VALUES('$numero_atenciones_detalles','$numero_atenciones','$identidad3','$nombre3','$responsable3','$genero3','$observaciones3')";	
              $mysqli->query($insert);				   
          }	  

          if($identidad4 != "" && $nombre4 != "" && $responsable4 != "" && $genero4 != "" && $observaciones4 != ""){
	          $numero_atenciones_detalles = correlativo("familiares_aten_detalles_id", "familiares_aten_detalles");
	   
	          $insert = "INSERT INTO familiares_aten_detalles 
	               VALUES('$numero_atenciones_detalles','$numero_atenciones','$identidad4','$nombre4','$responsable4','$genero4','$observaciones4')";	
              $mysqli->query($insert);				   
          }	  

          if($identidad5 != "" && $nombre5 != "" && $responsable5 != "" && $genero5 != "" && $observaciones5 != ""){
	          $numero_atenciones_detalles = correlativo("familiares_aten_detalles_id", "familiares_aten_detalles");
	   
	          $insert = "INSERT INTO familiares_aten_detalles 
	               VALUES('$numero_atenciones_detalles','$numero_atenciones','$identidad5','$nombre5','$responsable5','$genero5','$observaciones5')";
              $mysqli->query($insert);				   
          }	  		  
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
	echo 5;//NO EXISTE ATENCION ALMACENADA PARA ESTE USUARIO
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>