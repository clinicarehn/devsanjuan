<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();
include('../conexion-postgresql.php');
date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];

$id = $_POST['id-registro'];
$hora = date('H:i:s');	
$fecha_re = date("Y-m-d H:i:s", strtotime($_POST['fecha_re']." ".$hora));
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
$tipo_paciente = $_POST['tipo'];
$fecha_registro = date("Y-m-d H:i:s");
$status = 1;
$expediente = 0;
$actualizarDatos = 2;

//OBTENER CORRELATIVO PACIENTES
$numero = correlativo("pacientes_id", "pacientes");

//OBTENER CORRELATIVO HISTORIAL PACIENTES
$numero_historial = correlativo("id", "historial_pacientes");

//CONSULTAR IDENTIDAD DEL USUARIO
if($identidad == 0){
	$flag_identidad = true;
	while($flag_identidad){
	   $d=rand(1,99999999);
	   $query_identidadRand = "SELECT pacientes_id 
	       FROM pacientes 
		   WHERE identidad = '$d'";
	   $result_identidad = $mysqli->query($query_identidadRand);
	   if($result_identidad->num_rows==0){
		  $identidad = $d;
		  $flag_identidad = false;
	   }else{
		  $flag_identidad = true;
	   }		
	}
}

//OBTENER LA EDAD DEL USUARIO 
/*********************************************************************************/
$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/  

//CONSULTAMOS LA IDENTIDAD
$query_consulta_identidad = "SELECT identidad 
     FROM pacientes 
	 WHERE identidad = '$identidad'";
$result_consulta_identidad = $mysqli->query($query_consulta_identidad);	 
$consultar_identidad1 = $result_consulta_identidad->fetch_assoc();
$identidad_consultada = "";

if($result_consulta_identidad->num_rows>0){
	$identidad_consultada = $consultar_identidad1['identidad'];
}

if($pais != 0 && $estado_civil != 0 && $raza != 0 && $religion != 0 && $profesion != 0 && $escolaridad != 0){
  if($anos >= 4 && $anos <= 120){
     if ($identidad_consultada == $identidad){
	    echo 4;//ESTA IDENTIDAD YA EXISTE
     }else{
	    $insert = "INSERT INTO pacientes VALUES('$numero', '$expediente', '$nombre', '$apellido', '$identidad', '$sexo', '$fecha_nacimiento','$telefono',
		 	'$telefono1','$departamento','$municipio','$localidades','$responsables', '$telefonoresp', '$telefonoresp1', '$parentescos',
		 	'$fecha_re','$usuario','$status','$pais','$estado_civil','$raza','$religion','$profesion', '$lugar_nacimiento','$correo','$escolaridad','$actualizarDatos','$tipo_paciente')";
			
			$query = $mysqli->query($insert);
			
	    if($query){
		    echo 1;//EL REGISTRO SE HA GUARDARDADO CORRECTAMENTE
			
			//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
			$historial_numero = historial();
			$estado = "Agregar";
			$observacion = "Se creo un nuevo registro";
			$modulo = "Pacientes";
			$insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$numero','0','$modulo','0','0','0','$fecha_edicion','$estado','$observacion','$usuario','$fecha_registro')";
			$mysqli->query($insert);
			
	    }else{
		    echo 2;//EL NO SE PUEDO GUARDAR EL REGISTRO
	    }
    } 	  
  }else{
	 echo 5; //EDAD NO PERMITIDA
  }
}else{
  echo 3;//EXISTEN CAMPOS VACIOS NO SE PUEDE PROCEDER
}

$mysqli->close();//CERRAR CONEXIÓN
?>