<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];

$query = "SELECT CONCAT(p.nombre,' ',p.apellido) AS 'paciente', p.identidad AS 'identidad', p.expediente AS 'expediente', 
    p.telefono AS 'telefono', p.telefono1 AS 'telefono1', p.sexo AS 'sexo', p.fecha_nacimiento AS 'fecha_nacimiento', DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS 'fecha_nacimiento1', p.responsable AS 'responsable',
    p.telefonoresp AS 'telefonoresp', p.parentesco AS 'parentesco', d.nombre AS 'departamento', m.nombre AS 'municipio', p.localidad AS 'localidad',
    p.telefonoresp1 AS 'telefonoresp1', p.status AS 'estatus', es.nombre AS 'estado_civil', r.nombre AS 'raza', re.nombre AS 'religion',
	pro.nombre AS 'profesion', p.email AS 'email', pais.nombre AS 'pais', esco.nombre AS 'escolaridad', p.lugar_nacimiento AS 'lugar_nacimiento', CONCAT(c.nombre,' ',c.apellido) AS 'creado_por', DATE_FORMAT(p.fecha, '%d/%m/%Y %H:%i:%s %p') AS 'fecha_registro'
    FROM pacientes AS p
    INNER JOIN departamentos AS d
    ON d.departamento_id = p.departamento_id
    INNER JOIN municipios AS m
    ON p.municipio_id = m.municipio_id
    LEFT JOIN estado_civil AS es
    ON p.estado_civil = es.estado_civil_id
    LEFT JOIN raza AS r
    ON p.raza = r.raza_id
    LEFT JOIN religion AS re
    ON p.religion = re.religion_id
    LEFT JOIN profesion AS pro
    ON p.profesion = pro.profesion_id
	LEFT JOIN pais AS pais
	ON p.pais = pais.pais_id
	LEFT JOIN escolaridad AS esco
	ON p.escolaridad = esco.escolaridad_id
	INNER JOIN colaboradores AS c
	ON p.usuario = c.colaborador_id
    WHERE pacientes_id = '$pacientes_id'";
    $result = $mysqli->query($query);
     
    $consulta1=$result->fetch_assoc(); 


if($result->num_rows>0){
  $nombre = $consulta1['paciente'];
  $identidad = $consulta1['identidad'];
  
  if ($consulta1['expediente'] == 0){
	  $expediente = 'TEMP';
  }else{
	  $expediente = $consulta1['expediente'];
  }

  $fecha_nacimiento = $consulta1['fecha_nacimiento'];
  $fecha_nacimiento1 = $consulta1['fecha_nacimiento1'];
  
  if($consulta1['sexo'] == 'H'){
	  $sexo = 'Hombre';
  }else{
	  $sexo = 'Mujer';
  }
  
  if($consulta1['telefono1'] == 0 || $consulta1['telefono1'] == ""){
	  $telefono1 = "";
  }else{
	  $telefono1 = $consulta1['telefono1'];  
  }
  
  if($consulta1['telefonoresp'] == 0 || $consulta1['telefonoresp'] == ""){
	  $telefonoresp = "";
  }else{
	  $telefonoresp = $consulta1['telefonoresp'];  
  }	  
  
  if($consulta1['telefonoresp1'] == 0 || $consulta1['telefonoresp1'] == ""){
	  $telefonoresp1 = "";
  }else{
	  $telefonoresp1 = $consulta1['telefonoresp1'];  
  }
  
  $departamento = $consulta1['departamento'];
  $municipio = $consulta1['municipio'];
  $localidad = $consulta1['localidad'];
  $responsable = $consulta1['responsable'];
  $parentesco = $consulta1['parentesco'];
  $telefono = $consulta1['telefono'];
  $estado_civil = $consulta1['estado_civil'];
  $raza = $consulta1['raza'];
  $religion = $consulta1['religion'];
  $profesion = $consulta1['profesion'];
  $email = $consulta1['email'];
  $pais = $consulta1['pais'];  
  $escolaridad = $consulta1['escolaridad'];  
  $lugar_nacimiento = $consulta1['lugar_nacimiento'];
  $creado_por = $consulta1['creado_por'];
  $fecha_registro = $consulta1['fecha_registro'];  
  
  if ($consulta1['estatus'] == 1){
	  $status = 'Activo';
  }else if ($consulta1['estatus'] == 2){
	  $status = 'Pasivo';
  }else if ($consulta1['estatus'] == 3){
	  $status = 'Fallecido';
  }else if ($consulta1['estatus'] == 4){
	  $status = 'Depurado';
  }else{
	  $status = 'N/A';
  }	  
  
  //CONSULTAR DATOS DEL USUARIO EN LA AGENDA 1ERA VEZ QUE VIENE AL HOSPITAL
  $query_datos = "SELECT a.agenda_id, fecha_registro as 'fecha_registro', DATE_FORMAT(a.fecha_registro, '%d/%m/%Y %h:%i:%s %p') as 'fecha_registro1', 
     CAST(a.fecha_cita AS DATE) AS 'fecha_cita',  DATE_FORMAT(CAST(a.fecha_cita AS DATE), '%d/%m/%Y') AS 'fecha_cita1', a.status , a.hora, 
	 CONCAT(c.nombre,' ',c.apellido) AS 'profesional', CONCAT(c1.nombre,' ',c1.apellido) AS 'usuario'
     FROM agenda AS a
	 INNER JOIN colaboradores AS c
	 ON a.colaborador_id = c.colaborador_id
	 INNER JOIN colaboradores AS c1
	 ON a.usuario = c1.colaborador_id	 
     WHERE a.pacientes_id = '$pacientes_id' 
     ORDER BY a.fecha_registro ASC";
	 
  $result = $mysqli->query($query_datos);
  $consultar_datos1=$result->fetch_assoc(); 
	
  $consulta_fecha_solicitud_cita = "";
  $consulta_fecha_cita = "";
  $consulta_hora = "";  
  $consulta_status = "";
  $consulta_profesional = "";
  $consulta_usuario = "";  
  $consulta_estado = "";
  
  if($result->num_rows>0){
    $consulta_fecha_solicitud_cita = $consultar_datos1['fecha_registro1'];
    $consulta_fecha_cita = $consultar_datos1['fecha_cita1'];
    $consulta_hora = $consultar_datos1['hora'];  
    $consulta_status = $consultar_datos1['status'];
    $consulta_profesional = $consultar_datos1['profesional'];
    $consulta_usuario = $consultar_datos1['usuario'];
  
     if($consulta_status == 0){
	     $consulta_estado = 'Pendiente';
     }else if($consulta_status == 1){
	    $consulta_estado = 'Atendido';
     }else if($consulta_status == 2){
	    $consulta_estado = 'Ausente';
     }
  
  }
  
  if($consulta_fecha_solicitud_cita != ""){
		$consulta_datos_cita_primera_vez = "
			<div class='form-row'>
				<div class='col-md-12 mb-6 sm-3'>
				  <p style='color: #FF0000;' align='center'><b>Datos de Cita</b></p>
				</div>					
			</div>
			<div class='form-row'>
				<div class='col-md-12 mb-6 sm-3'>
				  <p style='color: #FF0000;' align='center'><b>Primera vez que llego al Hospital</b></p>
				</div>					
			</div>			
			<div class='form-row'>
				<div class='col-md-6 mb-6 sm-3'>
				  <p><b>Fecha de Solicitud:</b> $consulta_fecha_solicitud_cita</p>
				</div>				
				<div class='col-md-6 mb-6 sm-3'>
				  <p><b>Fecha de Cita:</b> $consulta_fecha_cita</p>
				</div>	
			</div>
			<div class='form-row'>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Hora:</b> $consulta_hora</p>
				</div>	
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Creado por:</b> $consulta_usuario</p>
				</div>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Profesional:</b> $consulta_profesional</p>
				</div>					
			</div>							
			<div class='form-row'>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Estado:</b> $consulta_estado</p>
				</div>	
			</div>					
			 ";	  
  }else{
	  $consulta_datos_cita_primera_vez = "";
  }
  
  //CONSULTAR DATOS DEL USUARIO EN LA AGENDA ULTIMA CITA ENCONTRADA
  $query_datos_ultima = "SELECT a.agenda_id, fecha_registro as 'fecha_registro', DATE_FORMAT(a.fecha_registro, '%d/%m/%Y %h:%i:%s %p') as 'fecha_registro1', 
     CAST(a.fecha_cita AS DATE) AS 'fecha_cita',  DATE_FORMAT(CAST(a.fecha_cita AS DATE), '%d/%m/%Y') AS 'fecha_cita1', a.status , a.hora, 
	 CONCAT(c.nombre,' ',c.apellido) AS 'profesional', CONCAT(c1.nombre,' ',c1.apellido) AS 'usuario'
     FROM agenda AS a
	 INNER JOIN colaboradores AS c
	 ON a.colaborador_id = c.colaborador_id
	 INNER JOIN colaboradores AS c1
	 ON a.usuario = c1.colaborador_id	 
     WHERE a.pacientes_id = '$pacientes_id' 
     ORDER BY a.fecha_registro DESC";
	 
  $result = $mysqli->query($query_datos_ultima);
  $consultar_datos_ultima1=$result->fetch_assoc();
  
  $consulta_ultima_fecha_solicitud_cita = "";
  $consulta_ultima_fecha_cita = "";
  $consulta_utlima_hora = "";  
  $consulta_utltima_status = "";
  $consulta_ultima_profesional = "";
  $consulta_ultima_usuario = ""; 
  $consulta_ultima_estado = "";
  
  if($result->num_rows>0){
	  $consulta_ultima_fecha_solicitud_cita = $consultar_datos_ultima1['fecha_registro1'];
	  $consulta_ultima_fecha_cita = $consultar_datos_ultima1['fecha_cita1'];
	  $consulta_utlima_hora = $consultar_datos_ultima1['hora'];  
	  $consulta_utltima_status = $consultar_datos_ultima1['status'];
	  $consulta_ultima_profesional = $consultar_datos_ultima1['profesional'];
	  $consulta_ultima_usuario = $consultar_datos_ultima1['usuario'];
 	  
	  if($consulta_utltima_status == 0){
		  $consulta_ultima_estado = 'Pendiente';
	  }else if($consulta_utltima_status == 1){
		  $consulta_ultima_estado = 'Atendido';
	  }else if($consulta_utltima_status == 2){
		  $consulta_ultima_estado = 'Ausente';
	  }	  
  }
  
  if($consulta_fecha_solicitud_cita != ""){
		$consulta_datos_cita_ultima = "
			<div class='form-row'>
				<div class='col-md-12 mb-6 sm-3'>
				  <p style='color: #FF0000;' align='center'><b>Ultima Cita Encontrada</b></p>
				</div>					
			</div>			
			<div class='form-row'>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Fecha de Cita:</b> $consulta_ultima_fecha_cita</p>
				</div>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Fecha de Solicitud:</b> $consulta_ultima_fecha_solicitud_cita</p>
				</div>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Creado por:</b> $consulta_ultima_usuario</p>
				</div>		
			</div>
			<div class='form-row'>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Hora:</b> $consulta_utlima_hora</p>
				</div>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Estado:</b> $consulta_ultima_estado</p>
				</div>
				<div class='col-md-4 mb-6 sm-3'>
				  <p><b>Profesional:</b> $consulta_ultima_profesional</p>
				</div>		
			</div>
			 ";	  
  }else{
	  $consulta_datos_cita_ultima = "";
  }  
//OBTENER EL TIPO DE USUARIO POR TRABAJO SOCIAL
$trabajo_social = "";

if($expediente != 0){
     $query_trabajo_social = "SELECT nivel_socioeconomico_id FROM ata 
          WHERE expediente = '$expediente' and servicio_id = '8' ORDER BY ata_id DESC LIMIT 1"; 
     $result = $mysqli->query($query_trabajo_social);
     $consulta_trabajo_social2=$result->fetch_assoc();

     $nivel_socioeconomico_id = "";
	 
     if($result->num_rows>0){
		 $nivel_socioeconomico_id = $consulta_trabajo_social2['nivel_socioeconomico_id'];
	 }	 
     
	 if($nivel_socioeconomico_id != ""){
        $query_consultar_nivel = "SELECT nombre FROM nivel_socioeconomico 
		     WHERE nivel_socioeconomico_id = '$nivel_socioeconomico_id'";
        $result = $mysqli->query($query_consultar_nivel);
    	$consultar_nivel2=$result->fetch_assoc(); 
		
        $nombre_nivel_socioeconomico = "";
		
        if($result->num_rows>0){
		   $nombre_nivel_socioeconomico = $consultar_nivel2['nombre'];
	    }		
		
		$trabajo_social = "
			<div class='form-row'>
				<div class='col-md-12 mb-6 sm-3'>
				  ><p style='color: #FF0000';><b>Nivel Socioeconómico:</b> $nombre_nivel_socioeconomico</p></
				</div>					
			</div>	
			 ";
    }else{
		$trabajo_social = "";
	}
}
//OBTENER LA EDAD DEL USUARIO 
/*********************************************************************************/
$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/  

if ($anos>1 ){
   $palabra_anos = "Años";
}else{
  $palabra_anos = "Año";
}

if ($meses>1 ){
   $palabra_mes = "Meses";
}else{
  $palabra_mes = "Mes";
}

if($dias>1){
	$palabra_dia = "Días";
}else{
	$palabra_dia = "Día";
}

echo " 
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Nombre:</b> $nombre</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Expediente:</b> $expediente</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Identidad:</b> $identidad</p>
		</div>		
	</div>
	
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Sexo:</b> $sexo</p>
		</div>
		<div class='col-md-4 mb-6 sm-'>
		  <p><b>Fecha_nac:</b> $fecha_nacimiento1</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Teléfono:</b> $telefono</p>
		</div>		
	</div>	
	
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Depatamento:</b> $departamento</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Municipio:</b> $municipio</p>
		</div>	
	</div>

	<div class='form-row'>
		<div class='col-md-12 mb-6 sm-3'>
		  <p><b>Localidad:</b> $localidad</p>
		</div>		
	</div>	

	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Responsable:</b> $responsable</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Parentesco:</b> $parentesco</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Teléfono:</b> $telefonoresp</p>
		</div>		
	</div>
	
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Estado Civil:</b> $estado_civil</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Raza:</b> $raza</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Religión:</b> $religion</p>
		</div>		
	</div>	
	
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Escolaridad:</b> $escolaridad</p>
		</div>
		<div class='col-md-4 mb-6 sm-'>
		  <p><b>País:</b> $pais</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Estatus:</b> $status</p>
		</div>		
	</div>	

	<div class='form-row'>
		<div class='col-md-6 mb-6 sm-3'>
		  <p><b>Lugar de Nacimiento:</b> $lugar_nacimiento</p>
		</div>
		<div class='col-md-6 mb-6 sm-3'>
		  <p><b>Email:</b> $email</p>
		</div>	
	</div>		

	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Profesión:</b> $profesion</p>
		</div>
		<div class='col-md-8 mb-6 sm-3'>
		  <p><b>Edad:</b> $anos $palabra_anos, $meses $palabra_mes y $dias $palabra_dia</p>
		</div>	
	</div>	
	
	<div class='form-row'>
		<div class='col-md-4 mb-6 sm-3'>
		  <p><b>Creado por: <span style='color: #008F39;'>$creado_por</p>
		</div>
		<div class='col-md-4 mb-6 sm-3'>
		  <p>Fecha de Solicitud:</b> $fecha_registro</p>
		</div>				
	</div>		
".$trabajo_social." ".$consulta_datos_cita_primera_vez. " ".$consulta_datos_cita_ultima;  
}else{
	echo 1;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>