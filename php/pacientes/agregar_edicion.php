<?php
include('../conexion-postgresql.php');
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();
date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];

$id = $_POST['id-registro'];
$fecha_re = $_POST['fecha_re'];
$nombres = $_POST['name'];
$apellidos = $_POST['lastname'];
$identidad = cleanStringStrtolower($_POST['identidad']);
$sexo = $_POST['sexo'];
$fecha_nacimiento = $_POST['fecha'];
$telefono = $_POST['telefono1'];
$telefono1 = $_POST['telefono2'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$localidad = $_POST['localidad'];
$responsable = $_POST['responsable'];
$parentesco = $_POST['parentesco'];
$telefonoresp = $_POST['telefonoresp'];
$telefonoresp1 = $_POST['telefonoresp1'];
$pais = $_POST['pais'];
$estado_civil = $_POST['estado_civil'];
$raza = $_POST['raza'];
$religion = $_POST['religion'];
$profesion = $_POST['profesion'];
$escolaridad = $_POST['escolaridad'];
$lugar_nacimiento = cleanStringStrtolower($_POST['lugar_nacimiento']);
$correo = cleanString($_POST['correo']);
$nombre = cleanStringStrtolower($nombres);
$apellido = cleanStringStrtolower($apellidos);
$localidades = cleanStringStrtolower($localidad);
$responsables = cleanStringStrtolower($responsable);
$parentescos = cleanStringStrtolower($parentesco); 
$usuario = $_SESSION['colaborador_id'];
$tipo_usuario = $_SESSION['type'];
$fecha_edicion = date('Y-m-d');
$fecha_registro = date("Y-m-d H:i:s");
$tipo_paciente = $_POST['tipo'];

//OBTENER CORRELATIVO PACIENTES
$correlativo= "SELECT DISTINCT MAX(pacientes_id) AS max, COUNT(pacientes_id) AS count 
   FROM pacientes";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

//OBTENER CORRELATIVO HISTORIAL PACIENTES
$correlativo_historial= "SELECT DISTINCT MAX(id) AS max, COUNT(id) AS count 
    FROM historial_pacientes";
$result = $mysqli->query($correlativo_historial);
$correlativo_historial2 = $result->fetch_assoc();

$numero_historial = $correlativo_historial2['max'];
$cantidad_historial = $correlativo_historial2['count'];

if ( $cantidad_historial == 0 )
	$numero_historial = 1;
else
    $numero_historial = $numero_historial + 1;

//CONSULTAR IDENTIDAD DEL USUARIO
if($identidad == 0){
	$flag_identidad = true;
	while($flag_identidad){
	   $d=rand(1,99999999);
	   $consultar_identidadRand = "SELECT pacientes_id 
	        FROM pacientes 
			WHERE identidad = '$d'";
	   $result = $mysqli->query($consultar_identidadRand);
	   if($result->num_rows==0){
		  $identidad = $d;
		  $flag_identidad = false;
	   }else{
		  $flag_identidad = true;
	   }		
	}
}

$consultar_identidad = "SELECT identidad 
     FROM pacientes 
	 WHERE identidad = '$identidad'";
$result = $mysqli->query($consultar_identidad);
$consultar_identidad1 = $result->fetch_assoc();

//OBTENER LA EDAD DEL USUARIO 
/*********************************************************************************/
$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/ 
 
if($pais != 0 && $estado_civil != 0 && $raza != 0 && $religion != 0 && $profesion != 0 && $escolaridad != 0){
  if($anos >= 4 && $anos <= 100){
      //CONSULTAR EXPEDIENTE
      $consulta_expediente = "SELECT expediente, tipo 
	       FROM pacientes 
		   WHERE pacientes_id = '$id'"; 
	  $result = $mysqli->query($consulta_expediente);
      $consulta_expediente1 = $result->fetch_assoc();
      
	  $expediente = 0;
	  
      if($result->num_rows>0){
		  $expediente = $consulta_expediente1['expediente'];
	  }	  
		
      $update = "UPDATE pacientes 
  	      SET nombre = '$nombre', apellido = '$apellido', sexo = '$sexo', fecha_nacimiento = '$fecha_nacimiento',
	      telefono = '$telefono', telefono1 = '$telefono1', departamento_id = '$departamento', municipio_id = '$municipio', localidad = '$localidades', 
	      responsable = '$responsables', parentesco = '$parentescos', telefonoresp = '$telefonoresp', telefonoresp1 = '$telefonoresp1',
	      pais = '$pais', estado_civil = '$estado_civil', raza = '$raza', religion = '$religion', profesion = '$profesion',
		  lugar_nacimiento = '$lugar_nacimiento', email = '$correo', escolaridad = '$escolaridad', actualizar_datos = 2, tipo = '$tipo_paciente'
		  WHERE pacientes_id = '$id'";
		  
	  $query = $mysqli->query($update);
		 
		  				
	  if($query){
		  $insert = "INSERT INTO historial_pacientes VALUES('$numero_historial', '$id', '$expediente', '$nombre', '$apellido', '$identidad', '$sexo', '$fecha_nacimiento','$telefono', '$telefono1','$departamento','$municipio','$localidades','$responsables','$parentescos', '$telefonoresp', '$telefonoresp1' ,'$fecha_edicion', '$usuario', 'Se edito el registro','$fecha_registro')";
		  $mysqli->query($insert);
		  
		  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		  $historial_numero = historial();
		  $estado = "Actualizar";
		  $observacion = "Se edito el registro";
		  $modulo = "Pacientes";
		  $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$id','$expediente','$modulo','0','0','0','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
		  $mysqli->query($insert);
		  /*****************************************************/
		  		  
          //AGREGAR/EDITAR DATOS EN TABLA ODOO
	      $nombre_completo = $apellido." ".$nombre;
		
          $pais = 97;//HONDURAS
          if($expediente>0 && $tipo_paciente == 1){
	          if(isExistUsuario($expediente) == ""){//EL REGISTRO NO EXISTE, SE PROCEDE A ALMACENAR TODOS LOS DATOS DEL MISMO
		         insertOdoo($expediente, $identidad, $nombre_completo, $fecha_nacimiento, $telefono, $telefono1, $telefonoresp, $telefonoresp1, $sexo, $localidades, $id, $departamento, $pais, $correo, $estado_civil);
	          }else{//SI EL REGISTRO EXISTE, SOLO SE ACTUALIZA LA INFORMACIÓN
	 	         updateOdoo($expediente, $identidad, $nombre_completo, $fecha_nacimiento, $telefono, $telefono1, $telefonoresp, $telefonoresp1, $sexo, $localidades, $id, $departamento, $pais, $correo, $estado_civil);
	          }
	       }
		   echo 1;//EL REGISTRO SE HA GUARDARDADO CORRECTAMENTE
      }else{
		 echo 2;//EL NO SE PUEDO GUARDAR EL REGISTRO
	  }
	}else{
		echo 4;//EDAD NO PERMITIDA
	}
  }else{
     echo 3;//EXISTEN CAMPOS VACIOS NO SE PUEDE PROCEDER
}	

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>