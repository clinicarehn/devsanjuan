<?php
//REPORTE DE USUARIOS DEPURADOS 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];
$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha']; //FECHA DE LA DEPURACIÓN
$fecha_cita = $_POST['fecha_cita'];
$servicio = $_POST['servicio'];
$diagnostico = $_POST['diagnostico'];
$comentario = mb_convert_case($_POST['motivo'], MB_CASE_TITLE, "UTF-8");
$usuario = $_SESSION['colaborador_id'];
$status = 4;//Usuarios depurados	
$hora_actual = date("H:i:s");
$fecha_depuracion = date('Y-m-d H:i:s',strtotime($fecha." ".$hora_actual));
$fecha_registro = date("Y-m-d H:i:s");
$año_actual = date("Y");

//OBTENER VALORES DE LA FECHA DE CITA
$fecha_cita_ = date("Y-m-d", strtotime($fecha_cita));

if(isset($_POST['medico_general'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medico_general'] == ""){
		$colaborador = 0;
	}else{
		$colaborador = $_POST['medico_general'];
	}
}else{
	$colaborador = 0;
}

if(isset($_POST['medico_general1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medico_general1'] == ""){
		$colaborador1 = 0;
	}else{
		$colaborador1 = $_POST['medico_general1'];
	}
}else{
	$colaborador1 = 0;
}

$consultar_expediente = "SELECT expediente, pacientes_id
    FROM pacientes 
	WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

$consultar_nombre = "SELECT CONCAT(nombre,' ',apellido) AS 'nombre' 
   FROM colaboradores 
   WHERE colaborador_id = '$usuario'";
$result = $mysqli->query($consultar_nombre);
$consultar_nombre = $result->fetch_assoc();
$nombre_colaborador = $consultar_nombre['nombre'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(depurado_id) AS max, COUNT(depurado_id) AS count 
  FROM depurados";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	
//VERIFICAMOS EL PROCESO

//CONSULTAR Registro
$consultar_registro = "SELECT depurado_id 
    FROM depurados 
    WHERE fecha = '$fecha' and expediente = '$expediente'";
$result = $mysqli->query($consultar_registro);   

if($result->num_rows>0){
   echo 2; //REGISTRO YA EXISTE
}else{
  if ($servicio != 0 && $expediente != 0 && $colaborador != 0 && $usuario != 0 && $status != 0){
	  if($fecha_cita_ != "" || $fecha_cita_ == "0000-00-00"){
	     //CONSULTAR REGISTROS EN EL AÑO ACTUAL
	     $query_registros = "SELECT depurado_id
	       FROM depurados
		   WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND YEAR(fecha) = '$año_actual' AND status = '$status'";
         $result_registros = $mysqli->query($query_registros); 
		  
		 if($result_registros->num_rows == 0){
	         $insert = "INSERT INTO depurados 
		        VALUES('$numero', '$fecha_depuracion', '$pacientes_id', '$expediente', '$diagnostico', '$fecha_cita', '$status', '$usuario', '$colaborador', '$colaborador1', '$servicio','$comentario','$fecha_registro')";
		     $query_insert = $mysqli->query($insert);
				
             if($query_insert){	
			    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
			    $historial_numero = historial();
			    $estado = "Agregar";
			    $observacion = "Usuario Depurado";
			    $modulo = "Depurados";
			   
			    $insert = "INSERT INTO historial 
			        VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador','$servicio','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
			    $mysqli->query($insert);		
				
	            $update = "UPDATE pacientes SET status = '$status' 
		           WHERE pacientes_id = '$pacientes_id'";
		        $mysqli->query($update);
				
			    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
			    $historial_numero = historial();
			    $estado = "Modificar";
			    $observacion = "Edicion del estado del usuario";
			    $modulo = "Pacientes";
			   
			    $insert = "INSERT INTO historial 
			        VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','0','$colaborador','$servicio','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
			    $mysqli->query($insert);				
				   
				echo 1;//REGISTRO ALMACENADO CORRECTAMENTE				
			}else{
				echo 6;//ERROR AL COMPLETAR EL REGISTROS
			}			 
		 }else{
			echo 4;//REGISTRO YA HA SIDO ALMACENADO ANTERIORMENTE
		 }  	
      }else{
		echo 5;//LA FECHA DE CITA NO DEBE SER CERO
	  }
	}else{
	   echo 3;//NO SE PUEDE ALMACENAR EL RESITRO HAY VALORES EN BLANCO
	}
}  

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>