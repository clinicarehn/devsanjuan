<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();
include('../conexion-postgresql.php');
date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['id-registro'];
$expediente = cleanStringStrtolower($_POST['expediente_usuario_manual']);
$identidad = cleanStringStrtolower($_POST['identidad_ususario_manual']);

//DATOS ANTERIORES
$expediente_anterior = $_POST['expediente_manual'];
$identidad_anterior = $_POST['identidad_manual'];

$fecha_registro = $_POST['fecha_re_manual'];
$fecha_edicion = date('Y-m-d'); 

//CONSULTAR DATOS DEL USUARIO
$consulta = "SELECT * 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();

$nombre = $consulta2['nombre'];
$apellido = $consulta2['apellido'];
$nombre_completo = $nombre.' '.$apellido;
$sexo = $consulta2['sexo'];
$fecha_nacimiento = $consulta2['fecha_nacimiento'];
$telefono = $consulta2['telefono'];
$telefono1 = $consulta2['telefono1'];
$departamento = $consulta2['departamento_id'];
$municipio = $consulta2['municipio_id'];
$localidades = $consulta2['localidad'];
$responsables = $consulta2['responsable'];
$parentescos = $consulta2['parentesco'];
$telefonoresp = $consulta2['telefonoresp'];
$telefonoresp1 = $consulta2['telefonoresp1'];
$estado_civil = $consulta2['estado_civil'];
$correo = cleanString($consulta2['email']);
$tipo = $consulta2['tipo'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAR EXPEDIENTE DEL USUARIO
$consulta_expediente = "SELECT expediente 
    FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consulta_expediente);
$consulta_expediente2 = $result->fetch_assoc();
$consulta_expediente_sistema = $consulta_expediente2['expediente'];

if($expediente == ""){
	$expediente = $consulta_expediente_sistema;
}
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

if($expediente != "" && $identidad == ""){
	$update = "UPDATE pacientes SET expediente = '$expediente' 
	     WHERE pacientes_id = '$pacientes_id'";
    $query = $mysqli->query($update);	
}else if($identidad != "" && $expediente == ""){
	$update = "UPDATE pacientes SET identidad = '$identidad' 
	     WHERE pacientes_id = '$pacientes_id'";
	$query = $mysqli->query($update);
}else if($expediente != "" && $identidad != ""){
	$update = "UPDATE pacientes SET identidad = '$identidad', expediente = '$expediente' 
	    WHERE pacientes_id = '$pacientes_id'";
	$query = $mysqli->query($update);
}else{
	echo 4;
}
	
if($query){	
    $insert = "INSERT INTO historial_pacientes VALUES('$numero_historial', '$pacientes_id', '$expediente', '$nombre', '$apellido', '$identidad', '$sexo', '$fecha_nacimiento','$telefono', '$telefono1','$departamento','$municipio','$localidades','$responsables','$parentescos', '$telefonoresp', '$telefonoresp1' ,'$fecha_edicion', '$usuario', 'Se edito el registro, agregando una nueva identidad de forma Manual','$fecha_registro')";	
	
	$mysqli->query($insert);
				 
	if($query){
		//ACTUAIZAMOS EL EXPEDIENTE EN LA ENTIDAD AGENDA
		$update_agenda = "UPDATE agenda 
		    SET expediente = '$expediente' 
			WHERE pacientes_id = '$pacientes_id'";
        $mysqli->query($update_agenda);
		
		if($expediente_anterior != 0){
			//ACTUAIZAMOS EL EXPEDIENTE EN LA ENTIDAD RECLINICA
			$update_preclinica = "UPDATE preclinica 
				SET expediente = '$expediente' 
				WHERE pacientes_id = '$pacientes_id'";
			$mysqli->query($update_preclinica);
		
			//ACTUAIZAMOS EL EXPEDIENTE EN LA ENTIDAD ATA			
			$update_ata = "UPDATE ata
				SET expediente = '$expediente'
				expediente = '$expediente_anterior'";
			$mysqli->query($update_agenda);
			
			//ACTUAIZAMOS EL EXPEDIENTE EN LA ENTIDAD REFERENCIAS RECIBIDAS	
			$update_rc = "UPDATE referencia_recibida
				SET expediente = '$expediente'
				WHERE expediente = '$expediente_anterior'";
			$mysqli->query($update_rc);			

			//ACTUAIZAMOS EL EXPEDIENTE EN LA ENTIDAD REFERENCIAS ENVIADAS
			$update_re = "UPDATE referencia_enviada
				SET expediente = '$expediente'
				WHERE expediente = '$expediente_anterior'";
			$mysqli->query($update_re);	
			
			//ACTUAIZAMOS EL EXPEDIENTE EN LA ENTIDAD TRANSITO RECIBIDA
			$update_tr = "UPDATE transito_recibida
				SET expediente = '$expediente'
				WHERE expediente = '$expediente_anterior'";
			$mysqli->query($update_tr);	
			
			//ACTUAIZAMOS EL EXPEDIENTE EN LA ENTIDAD TRANSITO ENVIADA
			$update_te = "UPDATE transito_enviada
				SET expediente = '$expediente'
				WHERE expediente = '$expediente_anterior'";
			$mysqli->query($update_te);	
			
			//ACTUAIZAMOS EL EXPEDIENTE EN LA ENTIDAD EXTEMPORANEOS			
			$update_extemporaneos = "UPDATE extemporaneos
				SET expediente = '$expediente'
				WHERE pacientes_id = '$pacientes_id'";
			$mysqli->query($update_extemporaneos);				
		}

        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        if($expediente_anterior == 0){
			$expediente_anterior_consulta = 'TEMP';
		}else{
			$expediente_anterior_consulta = $expediente_anterior;
		}
	    
		if($expediente == 0){
			$expediente_consulta = 'TEMP';
		}else{
			$expediente_consulta = $expediente;
		}
		
        $historial_numero = historial();
        $estado = "Actualizar";
        $observacion = "Actualizado el usuario: $nombre_completo de Exp: $expediente_anterior_consulta, ID: $identidad_anterior a: Exp: $expediente_consulta, ID: $identidad";
        $modulo = "Pacientes";
        $insert = "INSERT INTO historial 
			   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','0','0','0','$fecha_registro','$estado','$observacion','$usuario','$fecha_registro')";
        $mysqli->query($insert);
        /*****************************************************/   		
		echo 1; //REGISTRO ALMACENADO CORRECTAMENTE
	}else{
		echo 2; //ERRROR AL ALMACENAR EL REGISTRO
	}

    //AGREGAR/EDITAR DATOS EN TABLA ODOO
	$nombre_completo = $apellido." ".$nombre;	
    $pais = 97;//HONDURAS
		
    if($expediente>0 && $tipo == 1){
	    if(isExistUsuario($expediente) == ""){//EL REGISTRO NO EXISTE, SE PROCEDE A ALMACENAR TODOS LOS DATOS DEL MISMO
			insertOdoo($expediente, $identidad, $nombre_completo, $fecha_nacimiento, $telefono, $telefono1, $telefonoresp, $telefonoresp1, $sexo, $localidades, $pacientes_id, $departamento, $pais, $correo, $estado_civil);
		}else{//SI EL REGISTRO EXISTE, SOLO SE ACTUALIZA LA INFORMACIÓN
			updateOdoo($expediente, $identidad, $nombre_completo, $fecha_nacimiento, $telefono, $telefono1, $telefonoresp, $telefonoresp1, $sexo, $localidades, $pacientes_id, $departamento, $pais, $correo, $estado_civil);
	    }
	}
}else{
	echo 3;//ERROR AL EJECUTAR ESETA ACCIÓN
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>