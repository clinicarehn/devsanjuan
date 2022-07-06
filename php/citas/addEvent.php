<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

header('Content-Type: application/json');   
date_default_timezone_set('America/Tegucigalpa');
$usuario = $_SESSION['colaborador_id'];   

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$numero = correlativo("agenda_id", "agenda");

$pacientes_id = $_POST['paciente_id'];	
$color = $_POST['color'];
$fecha_cita = $_POST['fecha_cita'];
$fecha_start = date("Y-m-d", strtotime($fecha_cita));
$fecha_cita_end = $_POST['fecha_cita_end'];	
$hora = $_POST['hora'];	
$medico = $_POST['medico'];	
$unidad = $_POST['unidad'];		
$observacion = ucwords(strtolower($_POST['obs']), " ");	
$fecha_sistema = date("Y-m-d H:i:s");
$fecha_registro = date("Y-m-d H:i:s");
$colaborador_id = $_POST['medico'];	
$fecha_consulta = date('Y-m-d');	
$servicio = $_POST['serv'];
$factura = $_POST['factura'];
$preclinica = 1;

//CONSULTAMOS SI EL USUARIO ES NUEVO O SUBSIGUIENTE	
//CONSULTAR PUESTO COLABORADOR
$consulta_puesto = "SELECT puesto_id 
  FROM colaboradores 
  WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc(); 
$puesto_colaborador = $consulta_puesto1['puesto_id'];

$priorizado = 2;
			  
/*INICIO PROGRAMAR CITA*/
if(isset($_POST['checkPriorizado'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['checkPriorizado'] == ""){
		$color = $color;
		$priorizado = 2;
	}else{
		$color = "#FF8F00";//COLOR NARANJA
		$priorizado = 1;
	}
}else{
	$color = $color;
	$priorizado = 2;
}
	
$consultar_expediente= "SELECT expediente, CONCAT(nombre,' ',apellido) AS nombre 
	FROM pacientes 
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente1 = $result->fetch_assoc();

$expediente = $consultar_expediente1['expediente'];
$nombre = $consultar_expediente1['nombre'];	

//CONSULTA SI EL USUARIO TIENE CITA EN ESE DIA, PARA NO VOLVERLO A AGENDAR
$consultar_usuario = "SELECT a.agenda_id 
FROM agenda AS a
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
WHERE a.pacientes_id = '$pacientes_id' AND cast(a.fecha_cita as DATE) = '$fecha_start' AND c.puesto_id = '$unidad' AND a.servicio_id = '$servicio'";
$result = $mysqli->query($consultar_usuario);
	
$consultar_usuario1 = $result->fetch_assoc();

//CONSULTAR ESTADO DE USUSARIO 1. ACTIVO 2. PASIVO
$consulta_estado_usuario = "SELECT status 
	FROM pacientes
	WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consulta_estado_usuario);
$consulta_estado_usuario2 = $result->fetch_assoc();

$estado_usuario = $consulta_estado_usuario2['status'];

//CONSULTAR EL TIEMPO DESDE LA ULTIMA CITA HASTA LA ACTUALIDAD
$consulta_tiempo = "SELECT depurado_id, expediente, fecha_ultima AS 'fecha', DATEDIFF(now(), fecha_ultima) / 365 AS 'year' 
	FROM depurados 
	WHERE expediente = '$expediente' AND status = 2
	ORDER BY fecha DESC LIMIT 1";
$result = $mysqli->query($consulta_tiempo);
$consulta_tiempo2 = $result->fetch_assoc();
$tiempo_utlima_cita = $consulta_tiempo2['year'];
$tiempo_utlima_cita_fecha = $consulta_tiempo2['fecha'];	

//CONSULTAMOS LA ULTIMA ATENCION DEL USUARIO ALMACENADA EN EL ATA PARA COMPARARLA CON LA ULTIMA DEPURACIÓN
$consulta_ultima_atencion = "SELECT ata_id, expediente, fecha
	FROM ata 
	WHERE expediente = '$expediente'
	ORDER BY fecha DESC LIMIT 1";
$result = $mysqli->query($consulta_ultima_atencion);
$consulta_ultima_atencion2 = $result->fetch_assoc();	 
$consulta_ultima_atencion_fecha = $consulta_ultima_atencion2['fecha'];	

//CONSULTA SI EL MEDICO TIENE ESPACIO EN ESE DIA Y EN ESA HORA EN ESPECIFICO PARA PODERLO AGENDAR
$consultar_medico = "SELECT agenda_id 
	 FROM agenda 
	 WHERE colaborador_id = '$medico' AND fecha_cita = '$fecha_cita' AND fecha_cita_end = '$fecha_cita_end' AND status = 0 AND servicio_id = '$servicio'";
$result = $mysqli->query($consultar_medico);
$consultar_medico1 = $result->fetch_assoc();	
	
//CONSULTAR NOMBRE DE PROFESIONAL
$consulta_nombre_profesional = "SELECT CONCAT(nombre,' ',apellido) AS nombre 
	FROM colaboradores 
	WHERE colaborador_id = '$medico'";
$result = $mysqli->query($consulta_nombre_profesional);
$consulta_nombre_profesional2 = $result->fetch_assoc();	
$nombre_colaborador = $consulta_nombre_profesional2['nombre'];		

//CONSULTRA NOMBRE DE SERVICIO
$consulta_nombre_servicio = "SELECT nombre 
	FROM servicios 
	WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_nombre_servicio);
$consulta_nombre_servicio2 = $result->fetch_assoc();	
$nombre_servicio = $consulta_nombre_servicio2['nombre'];

//CONSULTAMOS SI HAY UNA AUSENCIA DEL USUARIO PARA ESTE DIA
$query_ausencia = "SELECT a.agenda_id AS 'agenda_id'
	FROM agenda AS a
	INNER JOIN colaboradores AS c
	ON a.colaborador_id = c.colaborador_id
	WHERE a.pacientes_id = '$pacientes_id' AND c.puesto_id = '$puesto_colaborador' AND a.servicio_id = '$servicio' AND a.status = 2 AND CAST(a.fecha_cita AS DATE) = '$fecha_cita'";
$result_ausencias = $mysqli->query($query_ausencia);

if($factura == "" && $color == "#008000"){
	echo 9;//LA FACTURA NO PUEDE QUEDAR EN BLANCO
}else{
	if($result_ausencias->num_rows==0){
		if($estado_usuario == 3){
			echo 7; //ESTE USUARIO YA FALLECIO
		}else if($estado_usuario == 2){
			echo 1; //ES UN USUARIO PASIVO DEBE CONVERTIRSE A USUARIO ACTIVO ANTES DE PROCEDER.
		}else if ($estado_usuario == 3){
			echo 6; //ES UN USUARIO FALLECIDO DEBE CONVERTIRSE A USUARIO ACTIVO ANTES DE PROCEDER.
		}else{
		  if($pacientes_id !=0 || $usuario != 0){
			if($consultar_medico1['agenda_id'] == ""){
			   if($consultar_usuario1['agenda_id'] == ""){			 
				  $consultar_expediente = "SELECT a.agenda_id 
					 FROM agenda AS a 
					 INNER JOIN colaboradores AS c
					 ON a.colaborador_id = c.colaborador_id
					 WHERE a.pacientes_id = '$pacientes_id' AND c.puesto_id = '$puesto_colaborador' AND a.servicio_id = '$servicio' AND a.status = 1";
				  $result = $mysqli->query($consultar_expediente);
				  $consultar_expediente1 = $result->fetch_assoc();  
					  
				  if ($consultar_expediente1['agenda_id']== ""){
					  $paciente = 'N';
				  }else{
					  $paciente = 'S';
				  }			
					
				  if($pacientes_id != 0 && $servicio != 0){
					if($servicio == 10){//SI EL SERVICIO DONDE SE AGENDA EL USUARIO ES EN FILTRO, ESTE NO NECESITA PASAR POR PRECLINICA, VA DIRECTAMENTE A LA AGENDA DEL PROFESIONAL
						 if($tiempo_utlima_cita > 5){
							$color = "#B7950B";
						 }	
						
						 if($consulta_ultima_atencion_fecha != ""){
							if($consulta_ultima_atencion_fecha > $tiempo_utlima_cita_fecha){
								$consultar_expediente1['agenda_id'] = "Valores_encontrados";//AGREGAMOS TEMPORALMENTE UN CONTENIDO AL ARREGLO, PARA INDICAR QUE HAY VALORES.
							}else{
								$color = $_POST['color'];
							}
						 }
						
						 $insert = "INSERT INTO agenda 
							   VALUES('$numero', '$pacientes_id', '$expediente', '$colaborador_id', '$hora', '$fecha_cita', '$fecha_cita_end', '$fecha_registro', '0', '$color', '$observacion','$usuario','$servicio','','$preclinica','0','2','$paciente','0')";
						 $query = $mysqli->query($insert);	
	
						//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
						$historial_numero = historial();
						$estado = "Agregar";
						$observacion = "Se agendo una cita para este registro";
						$modulo = "Citas";
						$insert = "INSERT INTO historial 
							 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio','$fecha_start','$estado','$observacion','$usuario','$fecha_registro')";
						$mysqli->query($insert);
						/*****************************************************/				 
						   
					}else{//SOLO SI EL SERVICIO NO ES FILTRO PASA DIRECTAMENTE A PRECLINICA Y CONTINUA TODO EL FILTRO
						if($tiempo_utlima_cita > 5){
						   $color = "#B7950B";//COLOR MOSTAZA
						}
	
						if($consulta_ultima_atencion_fecha != ""){
						   if($consulta_ultima_atencion_fecha > $tiempo_utlima_cita_fecha){
							   $color = $color;//AGREGAMOS TEMPORALMENTE UN CONTENIDO AL ARREGLO, PARA INDICAR QUE HAY VALORES. ES SUBSIGUIENTE
						   }else{
							   $color = "#B7950B";//COLOR MOSTAZA
						  }
						}
						 
						 $insert = "INSERT INTO agenda 
							  VALUES('$numero', '$pacientes_id', '$expediente', '$colaborador_id', '$hora', '$fecha_cita', '$fecha_cita_end', '$fecha_registro', '0', '$color', '$observacion','$usuario','$servicio','','0','0','2','$paciente','0')";
						 $query = $mysqli->query($insert);
	
						//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
						$historial_numero = historial();
						$estado = "Agregar";
						$observacion = "Se agendo una cita para este registro";
						$modulo = "Citas";
						$insert = "INSERT INTO historial 
							 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio','$fecha_start','$estado','$observacion','$usuario','$fecha_registro')";
						$mysqli->query($insert);
						/*****************************************************/						 
												  
					}
	
				}
			  /*********************************************************************************/
			  //CONSULTA AÑO, MES y DIA DEL PACIENTE
			  $nacimiento = "SELECT fecha_nacimiento AS fecha 
				  FROM pacientes 
				  WHERE pacientes_id = '$pacientes_id'";
			  $result = $mysqli->query($nacimiento);
			  $nacimiento2 = $result->fetch_assoc();
			  $fecha_nacimiento = $nacimiento2['fecha'];
	
			  $valores_array = getEdad($fecha_nacimiento);
			  $anos = $valores_array['anos'];
			  $meses = $valores_array['meses'];	  
			  $dias = $valores_array['dias'];	 
			/*********************************************************************************/	
				if ($query){	
					//AGREGAMOS LOS DATOS DE LA FACTURA
					if($factura !=""){
						$cobros_id = correlativo("cobros_id", "cobros");
						//VALIDAMOS QUE LA agenda_id NO ESTE ALMACENADA EN LA ENTIDAD
						$query_consulta_agenda_id = "SELECT cobros_id 
							FROM cobros 
							WHERE agenda_id = '$numero'";

						$result_consulta_agenda_id = $mysqli->query($query_consulta_agenda_id);	 
				   
						if($result_consulta_agenda_id->num_rows==0){
							$insert = "INSERT INTO cobros 
								VALUES('$cobros_id','$numero','$factura','$usuario','$fecha_registro')";
		
							$mysqli->query($insert);
						}						
					}

					/*LISTA DE PROGRAMACION DE CITAS*/		   
					$correlativo_listaespera = "SELECT MAX(id) AS max, COUNT(id) AS count 
						FROM  lista_espera";
					$result = $mysqli->query($correlativo_listaespera);
					$correlativo_listaespera2 = $result->fetch_assoc();
	
					$numero_listaespera = $correlativo_listaespera2['max'];
					$cantidad_listaespera = $correlativo_listaespera2['count'];
	
					if ( $cantidad_listaespera == 0 )
						$numero_listaespera = 1;
					else
						$numero_listaespera = $numero_listaespera + 1;	
	
					if(dias_transcurridos($fecha_registro,$fecha_cita)<=15 ){
						$prioridad = 'P';
					}else{
						$prioridad = 'N';
					}
					
					if($pacientes_id != 0 && $servicio != 0){
						$insert = "INSERT INTO lista_espera (id,fecha_solicitud,fecha_inclusion,pacientes_id,edad,colaborador_id,prioridad,fecha_cita,tipo_cita,reprogramo,usuario,servicio) VALUES('$numero_listaespera','$fecha_registro','$fecha_registro','$pacientes_id','$anos','$colaborador_id','$prioridad','$fecha_cita','$paciente','','$usuario','$servicio')";
						$mysqli->query($insert);  
	
						//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
						$historial_numero = historial();
						$estado = "Agregar";
						$observacion = "Se agrego registro de este usuario en la lista de espera";
						$modulo = "Citas";
						$insert = "INSERT INTO historial 
							VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio','$fecha_start','$estado','$observacion','$usuario','$fecha_registro')";
						$mysqli->query($insert);
						/*****************************************************/						  
					}
					/**********************************************************/											
					//GUARDAMOS EL REGISTRO PRIORIZADO
					if($priorizado == 1){
						$priorizado_id = correlativo("priorizado_id", "priorizado");
						$insert = "INSERT INTO priorizado 
						VALUES('$priorizado_id','$numero','$usuario','$fecha_registro')";
						$mysqli->query($insert);
		
						//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
						$historial_numero = historial();
						$estado = "Agregar";
						$observacion = "Se agrego un registro priorizado de este usuario segun agenda $numero";
						$modulo = "Citas";
						$insert = "INSERT INTO historial 
							VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$colaborador_id','$servicio','$fecha_start','$estado','$observacion','$usuario','$fecha_registro')";
						$mysqli->query($insert);				
						/**********************************************************/
					}
	
					if ($expediente == 0){
					$exp = "TEMP"; 
					}else{
						$exp = $expediente;
					}					  
					echo '{"id":"'.$numero.'","title":"'.$exp."-".$nombre.'","start":"'.$fecha_cita.'","end":"'.$fecha_cita_end.'","color":"'.$color.'"}';
				}else{
					echo 2;//NO SE PUEDO ALMACENAR EL REGISTRO
				}
			   }else{
				  echo 3; //ESTE USUARIO YA TIENE CITA AGENDADA EN ESE DIA
			   }			
			}else{
				 echo 4; //EL MÉDICO YA TIENE ESTA HORA OCUPADA
			}
		  }else{
			 echo 5; //NO SE PUEDE ALMACENAR EL REGISTRO YA QUE EL CAMBPO pacientes_id ESTA EN BLANCO POR QUE NO EXISTE EL REGISTRO
		  }
		}
	}else{
		echo 8;//YA EXISTE UNA AUSENCIA PARA ESTE REGISTRO, NO SE PUEDE VOLVER A ALMACENAR, POR FAVOR CANCELE LA AUSENCIA ALMACENADA
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>