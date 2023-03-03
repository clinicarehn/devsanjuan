<?php
session_start(); 
include('../php/funtions.php');   
//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Atenciones Medicas";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Atenciones Medicas", MB_CASE_TITLE, "UTF-8");   

if($colaborador_id != "" || $colaborador_id != null){
   historial_acceso($comentario, $nombre_host, $colaborador_id);  
}  

//OBTENER NOMBRE DE EMPRESA
$usuario = $_SESSION['colaborador_id'];

$query_empresa = "SELECT e.nombre AS 'nombre'
	FROM users AS u
	INNER JOIN empresa AS e
	ON u.empresa_id = e.empresa_id
	WHERE u.colaborador_id = '$usuario'";
$result = $mysqli->query($query_empresa) or die($mysqli->error);
$consulta_registro = $result->fetch_assoc();

$empresa = '';

if($result->num_rows>0){
  $empresa = $consulta_registro['nombre'];
}

$mysqli->close();//CERRAR CONEXIÓN     
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta name="author" content="KIREDS" />
    <meta name="description" content="Responsive Websites Orden Hospitalaria de San Juan de Dios">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Atenciones Medicas :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?> 	
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?>    

<!--INICIO MODAL-->
<div class="modal fade" id="buscarHistorial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Historial de Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form id="form-buscarhistorial">		
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" placeholder="Buscar por: Expediente, Paciente o Identidad" id="bs-regis-historial" autofocus class="form-control"/>
					</div>					
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <div class="registros overflow-auto" id="agrega-registros_historial"></div>
					</div>					
				</div>	
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center" id="pagination_historial"></ul>
				</nav>															  
			</form>
      </div>	  
    </div>
  </div>
</div>

<div class="modal fade" id="agregar_referencias_recibidas">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Referencias Recibidas y Respuestas Enviadas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_referencias_recibidas">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="text" required readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente</label>
					 <input type="number" required id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha</label>
				     <input type="date" required id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Identidad</label>
					  <input type="text" required readonly id="identidad" name="identidad" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					  <input type="text" name="nombre" id="nombre" readonly class="form-control" readonly placeholder="Nombre" required readonly="readonly">
					</div>					
				</div>

				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="centros_nivel">Nivel</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="centros_nivel" name="centros_nivel" data-live-search="true" title="Nivel">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="centro">Centros</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="centro" name="centro" data-live-search="true" title="Centros">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="recibidade">Recibida de</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="recibidade" name="recibidade" data-live-search="true" title="Recibida de">			  
						</select>
						</div>
					</div>		
					<div class="col-md-3 mb-3">
						<label for="patologia1">Patología</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="patologia1" name="patologia1" data-live-search="true" title="Patología" required>			  
						</select>
						</div>
					</div>									
				</div>	

				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Diagnostico Clínico</label>
					  <input type="text" required id="clinico" placeholder="Diagnostico Clínico" name="clinico" data-toggle="tooltip" data-placement="top" title="Diagnostico Clínico" class="form-control"/>
					</div>							
				</div>					
				
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="motivo">Motivo</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="motivo" name="motivo" data-live-search="true" title="Motivo">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="motivo1">Otro Motivo</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="motivo1" name="motivo1" data-live-search="true" title="Otro Motivo">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="servicio">Servicio <span class="priority">*<span/> </label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="servicio" name="servicio" requiered data-live-search="true" title="Servicio">			  
						</select>
						</div>
					</div>						
				</div>			
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_referencias_recibidas" type="submit" id="reg_referencias_rc"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>				 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="agregar_referencias_enviadas">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Referencias Enviadas y Respuestras Recibidas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_referencias_enviadas">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="text" required readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente</label>
					 <input type="number" required id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha</label>
				     <input type="date" required id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Identidad</label>
					  <input type="text" required readonly id="identidad" name="identidad" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					  <input type="text" name="nombre" id="nombre" readonly class="form-control" readonly placeholder="Nombre" required readonly="readonly">
					</div>					
				</div>

				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="centros_nivel">Nivel</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="centros_nivel" name="centros_nivel" data-live-search="true" title="Nivel">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="centro">Centros</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="centro" name="centro" data-live-search="true" title="Centros">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="enviadaa">Enviada a</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="enviadaa" name="enviadaa" data-live-search="true" title="Enviada a">			  
						</select>
						</div>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="patologia1">Patología</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="patologia1" name="patologia1" data-live-search="true" title="Patología" required>			  
						</select>
						</div>
					</div>												
				</div>	

				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="patologia2">Patología</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="patologia2" name="patologia2" data-live-search="true" title="Patología">			  
						</select>
						</div>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="patologia3">Patología</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="patologia3" name="patologia3" data-live-search="true" title="Patología">			  
						</select>
						</div>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="motivo_traslado">Motivo Traslado</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="motivo_traslado" name="motivo_traslado" data-live-search="true" title="Motivo Traslado">			  
						</select>
						</div>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="motivo">Motivo</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="motivo" name="motivo" data-live-search="true" title="Motivo">			  
						</select>
						</div>
					</div>														
				</div>					
				
				<div class="form-row">	
					<div class="col-md-9 mb-3">
					  <label>Diagnostico Clínico</label>
					  <input type="text" required id="diagnostico" placeholder="Diagnostico Clínico" name="diagnostico" title="Motivo de la Referencia Enviada" class="form-control"/>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="servicio">Servicio <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="servicio" name="servicio" requiered data-live-search="true" title="Servicio">			  
						</select>
						</div>
					</div>														
				</div>	
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_referencias_enviadas" type="submit" id="reg_referencias_re"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>				 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar_transito_enviada">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Transito Enviadas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_transito_enviada">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="text" required readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente</label>
					 <input type="number" required id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha</label>
				     <input type="date" required id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Identidad</label>
					  <input type="text" required readonly id="identidad" name="identidad" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					  <input type="text" name="nombre" id="nombre" readonly class="form-control" readonly placeholder="Nombre" required readonly="readonly">
					</div>					
				</div>

				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="enviada">Enviada a</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="enviada" name="enviada" data-live-search="true" title="Enviada a">			  
						</select>
						</div>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="unidad">Unidad</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="unidad" name="unidad" data-live-search="true" title="Unidad">			  
						</select>
						</div>
					</div>						
					<div class="col-md-3 mb-3">
						<label for="profesional_enviadas">Profesional</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="profesional_enviadas" name="profesional_enviadas" data-live-search="true" title="Profesional">			  
						</select>
						</div>
					</div>						
					<div class="col-md-3 mb-3">
						<label for="tipo_atencion_enviadas">Tipo Atención</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="tipo_atencion_enviadas" name="tipo_atencion_enviadas" data-live-search="true" title="Tipo Atención">			  
						</select>
						</div>
					</div>						
				</div>	

				<div class="form-row">				
					<div class="col-md-9 mb-3">
					  <label>Motivo</label>
					  <input type="text" required name="motivo" placeholder="Motivo de la Referencia Enviada" id="motivo" maxlength="100" class="form-control"/>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="servicio">Servicio <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="servicio" name="servicio" required data-live-search="true" title="Servicio">			  
						</select>
						</div>
					</div>						
				</div>			
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_transito_enviada" type="submit" id="reg_transito_enviada"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>				 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar_transito_recibida">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Transito Recibida</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_transito_recibida">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="text" required readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente</label>
					 <input type="number" required id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha</label>
				     <input type="date" required id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Identidad</label>
					  <input type="text" required readonly id="identidad" name="identidad" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					  <input type="text" name="nombre" id="nombre" readonly class="form-control" readonly placeholder="Nombre" required readonly="readonly">
					</div>					
				</div>

				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="recibida">Recibida de</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="recibida" name="recibida" data-live-search="true" title="Recibida de">			  
						</select>
						</div>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="unidad">Unidad</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="unidad" name="unidad" data-live-search="true" title="Unidad">			  
						</select>
						</div>
					</div>	
					<div class="col-md-3 mb-3">
						<label for="profesional_recibida">Profesional</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="profesional_recibida" name="profesional_recibida" data-live-search="true" title="Profesional">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="servicio">Servicio <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="servicio" name="servicio" data-live-search="true" title="Servicio" required>			  
						</select>
						</div>
					</div>												
				</div>	

				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Motivo <span class="priority">*<span/></label>
					  <input type="text" required name="motivo" placeholder="Motivo de la Referencia Recibida" id="motivo" maxlength="100" class="form-control" required />
					</div>										
				</div>			
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_transito_recibida" type="submit" id="reg_transito_recibida"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>				 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar_ata_manual">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario ATA Usuarios</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_ata_manual">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="text" required readonly id="pro_ata" name="pro_ata" class="form-control"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente</label>
					  <input type="number" required name="expediente_ata" id="expediente_ata" placeholder="Expediente o Identidad" maxlength="100" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha</label>
				      <input type="date" required id="fecha_ata" name="fecha_ata" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Identidad</label>
					  <input type="text" required id="identidad_ata" name="identidad_ata" readonly class="form-control"/>
					  <input type="text" required id="paciente_ata" name="paciente_ata" readonly style="display: none;" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					  <input type="text" required name="nombre_ata" id="nombre_ata" maxlength="100" readonly class="form-control"/>
					</div>					
				</div>

				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="patologia_ata1">Patología</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="patologia_ata1" name="patologia_ata1" data-live-search="true" title="Patología" required>			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="patologia_ata2">Patología</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="patologia_ata2" name="patologia_ata2" data-live-search="true" title="Patología">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="patologia_ata3">Patología</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="patologia_ata3" name="patologia_ata3" data-live-search="true" title="Patología">			  
						</select>
						</div>
					</div>					
				</div>	

				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="servicio_ata">Servicio</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="servicio_ata" name="servicio_ata" data-live-search="true" title="Servicio">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="unidad_ata">Unidad</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="unidad_ata" name="unidad_ata" data-live-search="true" title="Unidad">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="colaborador_ata">Profesional</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="colaborador_ata" name="colaborador_ata" data-live-search="true" title="Profesional">			  
						</select>
						</div>
					</div>					
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Observaciones</label>
					  <input type="text" required name="observacion_ata" placeholder="Observaciones" id="observacion_ata" maxlength="100" class="form-control"/>
					</div>						
				</div>
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="form-check form-check-inline">
						  <label class="form-check-label">¿Primera vez? </label>
						</div>
						
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="primera_si" name="primera1" value="1">
						  <label class="form-check-label" for="primera_si">Sí</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="primera_no" name="primera1" value="2">
						  <label class="form-check-label" for="primera_no">No</label>
						</div>
					</div>
				</div>		
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_ata_manual" type="submit" id="reg_ata_manual"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>				 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="modal_seguimiento">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ficha Seguimiento Teléfonico Usuarios Nuevos y Subsiguientes</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_seguimiento">							
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home_seguimiento" role="tab" aria-controls="home_seguimiento" aria-selected="false">Datos del Usuario</a>
					</li>
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#menu1_Seguimiento" role="tab" aria-controls="menu1_Seguimiento" aria-selected="false">Seguimiento Telefónico</a>
					</li>
				</ul>	
				<br/>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="text" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				
				<div class="tab-content" id="myTabContent"><!-- INICIO TAB CONTENT-->
					<div class="tab-pane fade active show" id="home_seguimiento" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB HOME-->
						<div class="form-row">
							<div class="col-md-4 mb-3">
							  <label>Identidad</label>
							  <input type="number" id="identidad" name="identidad" placeholder="Identidad" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Nombres</label>
							  <input type="text" id="nombres" name="nombres" placeholder="Nombres" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Apellidos</label>
							  <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" class="form-control"/>
							</div>						
						</div>
						<div class="form-row">
							<div class="col-md-4 mb-3">
							  <label>Fecha de Registro</label>
							  <input type="date" id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Fecha de Nacimiento</label>
							  <input type="date" id="fecha_n" name="fecha_n" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="genero">Genero</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="genero" name="genero" data-live-search="true" title="Genero">			  
								</select>
								</div>
							</div>						
						</div>	
						<div class="form-row">
							<div class="col-md-4 mb-3">
							  <label>Teléfono</label>
							  <input type="number" id="telefono" name="telefono" placeholder="Teléfono" class="form-control"/>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="departamento">Departamentos</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="departamento" name="departamento" data-live-search="true" title="Departamentos">			  
								</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="municipio">Municipio</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="municipio" name="municipio" data-live-search="true" title="Municipio">			  
								</select>
								</div>
							</div>						
						</div>	
						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Dirección <span class="priority">*<span/></label>
							  <textarea id="localidad" name="localidad" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Dirección Exacta"></textarea>
							</div>					
						</div>					
					</div><!-- FIN TAB HOME-->
					<div class="tab-pane fade" id="menu1_Seguimiento" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB SEGUIMIENTO-->
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="form-check form-check-inline">
								  <label class="form-check-label">Sindrome: </label>
								</div>
								
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" id="ansioso" name="ansioso" value="1">
								  <label class="form-check-label" for="ansioso">Ansioso</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" id="depresivo" name="depresivo" value="1">
								  <label class="form-check-label" for="depresivo">Depresivo</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" id="psicotico" name="psicotico" value="1">
								  <label class="form-check-label" for="psicotico">Psicotico</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" id="agitacion" name="agitacion" value="1">
								  <label class="form-check-label" for="agitacion">Agitación</label>
								</div>								
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" id="insomnio" name="insomnio" value="1">
								  <label class="form-check-label" for="insomnio">Insomnio</label>
								</div>	
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" id="abandono_medicamento" name="abandono_medicamento" value="1">
								  <label class="form-check-label" for="abandono_medicamento">Abandono Medicamento</label>
								</div>									
							</div>
						</div>
						
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="form-check form-check-inline">
								  <label class="form-check-label">Otros Sindromes: </label>
								</div>					
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="otros_si" name="otros_sintomas" value="1">
								  <label class="form-check-label" for="otros_si">Sí</label>						  
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="otros_no" name="otros_sintomas" value="2">
								  <label class="form-check-label" for="otros_no">No</label>						  
								</div>
								<div class="form-check form-check-inline">
								   <label class="form-check-label mr-1" for="otros_especifique">Especifique </label>
								   <input type="text" id="otros_especifique" name="otros_especifique" placeholder="Especifique" class="form-control"/>					  
								</div>						
							</div>							
						</div>	

						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="form-check form-check-inline">
								  <label class="form-check-label">Conducta Riesgo: </label>
								</div>					
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="conducta_si" name="conducta_riegos" value="1">
								  <label class="form-check-label" for="conducta_si">Sí</label>						  
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="conducta_no" name="conducta_riegos" value="2">
								  <label class="form-check-label" for="conducta_no">No</label>						  
								</div>
								<div class="form-check form-check-inline">
								   <label class="form-check-label mr-1 mb-1" for="conducta_especifique">Especifique </label>
								   <input type="text" id="conducta_especifique" name="conducta_especifique" placeholder="Especifique" class="form-control"/>					  
								</div>	
								<div class="form-check form-check-inline">
								   <label class="form-check-label mr-1" for="atencion">Seguimiento </label>
								   <select class="selectpicker" id="seguimiento" name="seguimiento" required data-live-search="true" title="Seguimiento">			  
				 	 				</select>				  
								</div>									
							</div>							
						</div>	

						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Comentario <span class="priority">*<span/></label>
							  <textarea id="comentario_seguimiento" name="comentario_seguimiento" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Comentario"></textarea>
							</div>					
						</div>							
					</div><!-- FIN TAB SEGUIMIENTO-->					
				</div><!--FIN TAB CONTENT-->
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_seguimiento" type="submit" id="reg_seguimiento"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>				 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="agregar_cuestionario_maida">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cuestionario Para seguimiento de los usuarios egresados de MAIDA</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form class="invoice-form" id="formulario_cuestionario_maida">
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required readonly id="id-registro" name="id-registro" />
					  <input type="text" required readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home_cuestionario" role="tab" aria-controls="home_cuestionario" aria-selected="false">Datos Usuario</a>
					</li>
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#menu1" role="tab" aria-controls="menu1" aria-selected="false">Cuestionario</a>
					</li>
				</ul>
				
				<div class="tab-content" id="myTabContent"><!-- INICIO TAB CONTENT-->
					<div class="tab-pane fade active show" id="home_cuestionario" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB HOME-->
					
						<div class="form-row">
							<div class="col-md-4 mb-3">
							  <label>Expediente</label>
							  <input type="number" id="expediente" name="expediente" placeholder="Expediente" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Fecha</label>
							  <input type="date" required id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Identidad</label>
							  <input type="text" required readonly id="identidad" name="identidad" class="form-control"/>
							</div>						
						</div>
						
						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Nombre</label>
							  <input type="text" id="nombre" name="nombre" readonly placeholder="Nombre" class="form-control"/>
							</div>						
						</div>	
						
						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Observaciones <span class="priority">*<span/></label>
							  <textarea id="obs" name="obs" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Observaciones"></textarea>
							</div>					
						</div>	

						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="servicio">Servicio</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="servicio" name="servicio" data-live-search="true" title="Servicio">			  
								</select>
								</div>
							</div>					
						</div>						
						
					</div><!-- FIN TAB HOME-->				
					<div class="tab-pane fade" id="menu1" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB TRATAMIENTO-->
					
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="form-check form-check-inline">
								   <label class="form-check-label mr-1 mb-1" for="fecha_ingreso">Fecha de Ingreso </label>
								   <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo date ("Y-m-d");?>" class="form-control"/>					  
								</div>	
								
								<div class="form-check form-check-inline">
								   <label class="form-check-label mr-1 mb-1" id="cuestionario_maida_p1_label"></label>					  
								</div>									
								
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="maida_p1_si" name="maida_p1" value="1">
								  <label class="form-check-label" id="label_maida_p1_si"></label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="maida_p1_no" name="maida_p1" value="2" checked>
								  <label class="form-check-label" id="label_maida_p1_no"></label>
								</div>							
							</div>
						</div>	

						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="form-check form-check-inline" id="cuestionario_maida_p2" style="display: none;">
								   <label class="form-check-label mr-1 mb-1" id="cuestionario_maida_p2_label"></label>					  
								</div>	
								
								<div class="form-check form-check-inline" id="cuestionario_maida_p2" style="display: none;">
								  <input class="form-check-input" type="radio" id="maida_p2_1" name="maida_p2" value="1">
								  <label class="form-check-label" id="label_maida_p2_1"></label>
								</div>
								<div class="form-check form-check-inline" id="cuestionario_maida_p2" style="display: none;">
								  <input class="form-check-input" type="radio" id="maida_p2_2" name="maida_p2" value="2">
								  <label class="form-check-label" id="label_maida_p2_2"></label>
								</div>		
								<div class="form-check form-check-inline" id="cuestionario_maida_p2" style="display: none;">
								  <input class="form-check-input" type="radio" id="maida_p2_3" name="maida_p2" value="3">
								  <label class="form-check-label" id="label_maida_p2_3"></label>
								</div>
								<div class="form-check form-check-inline" id="cuestionario_maida_p2" style="display: none;">
								  <input class="form-check-input" type="radio" id="maida_p2_4" name="maida_p2" value="4">
								  <label class="form-check-label" id="label_maida_p2_4"></label>
								</div>								
							</div>
						</div>								
						
						<div class="form-row">
						    <div class="col-md-12 mb-3">
								<div class="form-check form-check-inline" id="cuestionario_maida_p3" style="display: none;">
								   <label class="form-check-label mr-1 mb-1" id="cuestionario_maida_p3_label"></label>					  
								</div>									
								
								<div class="form-check form-check-inline" id="cuestionario_maida_p3" style="display: none;">
								  <input class="form-check-input" type="radio" id="maida_p3_1" name="maida_p3" value="1">
								  <label class="form-check-label" id="label_maida_p3_1"></label>
								</div>
								<div class="form-check form-check-inline" id="cuestionario_maida_p3" style="display: none;">
								  <input class="form-check-input" type="radio" id="maida_p3_2" name="maida_p3" value="2">
								  <label class="form-check-label" id="label_maida_p3_2"></label>
								</div>		
								<div class="form-check form-check-inline" id="cuestionario_maida_p3" style="display: none;">
								  <input class="form-check-input" type="radio" id="maida_p3_3" name="maida_p3" value="3">
								  <label class="form-check-label" id="label_maida_p3_3"></label>
								</div>
								<div class="form-check form-check-inline" id="cuestionario_maida_p3" style="display: none;">
								  <input class="form-check-input" type="radio" id="maida_p3_4" name="maida_p3" value="4">
								  <label class="form-check-label" id="label_maida_p3_4"></label>
								</div>
							</div>
						</div>
						
						<div class="form-row">	
							<div class="col-md-12 mb-3">
								<div class="form-check form-check-inline" id="cuestionario_maida_p4">
								   <label class="form-check-label mr-1 mb-1" id="cuestionario_maida_p4_label"></label>					  
								</div>									
								
								<div class="form-check form-check-inline" id="cuestionario_maida_p4">
								  <input class="form-check-input" type="radio" id="maida_p4_1" name="maida_p4" value="1">
								  <label class="form-check-label" id="label_maida_p3_1"></label>
								</div>
								<div class="form-check form-check-inline" id="cuestionario_maida_p4">
								  <input class="form-check-input" type="radio" id="maida_p4_2" name="maida_p4" value="2">
								  <label class="form-check-label" id="label_maida_p4_3"></label>
								</div>		
								<div class="form-check form-check-inline" id="cuestionario_maida_p4">
								  <input class="form-check-input" type="radio" id="maida_p4_3" name="maida_p4" value="3">
								  <label class="form-check-label" id="label_maida_p4_3"></label>
								</div>
								<div class="form-check form-check-inline" id="cuestionario_maida_p4">
								  <input class="form-check-input" type="radio" id="maida_p4_4" name="maida_p4" value="4" checked>
								  <label class="form-check-label" id="label_maida_p4_4"></label>
								</div>
							</div>
						</div>		

						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="form-check form-check-inline" id="cuestionario_maida_p5">
								   <label class="form-check-label mr-1 mb-1" id="cuestionario_maida_p5_label"></label>					  
								</div>	
								
								<div class="form-check form-check-inline" id="cuestionario_maida_p5">
								  <input class="form-check-input" type="radio" id="maida_p5_si" name="maida_p5" value="1">
								  <label class="form-check-label" id="label_maida_p5_si"></label>
								</div>
								<div class="form-check form-check-inline" id="cuestionario_maida_p5">
								  <input class="form-check-input" type="radio" id="maida_p5_no" name="maida_p5" value="2" checked>
								  <label class="form-check-label" id="label_maida_p5_no"></label>
								</div>		
								<div class="form-check form-check-inline" id="cuestionario_maida_p5">
									<select class="selectpicker" id="patologia" name="patologia" data-size="5" data-live-search="true" title="Patología">			  
									</select>							  
								</div>
							</div>
						</div>						
							
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="form-check form-check-inline" id="cuestionario_maida_p6">
								   <label class="form-check-label mr-1 mb-1" id="cuestionario_maida_p6_label"></label>					  
								</div>									
								
								<div class="form-check form-check-inline" id="cuestionario_maida_p6">
								  <input class="form-check-input" type="radio" id="maida_p6_si" name="maida_p6" value="1">
								  <label class="form-check-label" id="label_maida_p6_si"></label>
								</div>
								<div class="form-check form-check-inline" id="cuestionario_maida_p6">
								  <input class="form-check-input" type="radio" id="maida_p6_no" name="maida_p6" value="2" checked>
								  <label class="form-check-label" id="label_maida_p6_no"></label>
								</div>
							</div>
						</div>
						
					</div><!-- FIN TAB TRATAMIENTO-->					
				</div><!-- FIN TAB CONTENT-->	
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_cuestionario_maida" type="submit" id="reg_cuestionario"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="agregar_atenciones_familiares">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Atenciones Familiares</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form class="invoice-form" id="formulario_atenciones_familiares">
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required readonly id="id-registro" name="id-registro" />
					  <input type="text" required readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home_familiares" role="tab" aria-controls="home_cuestionario" aria-selected="false">Datos Usuario</a>
					</li>
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#menu1_familiares" role="tab" aria-controls="menu1" aria-selected="false">Familiares</a>
					</li>
				</ul>
				<br/>
				<div class="tab-content" id="myTabContent"><!-- INICIO TAB CONTENT-->
					<div class="tab-pane fade active show" id="home_familiares" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB HOME-->					
						<div class="form-row">
							<div class="col-md-4 mb-3">
							  <label>Expediente</label>
							  <input type="number" id="expediente" name="expediente" placeholder="Expediente" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Fecha</label>
							  <input type="date" required id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Identidad</label>
							  <input type="text" required readonly id="identidad" name="identidad" class="form-control"/>
							</div>						
						</div>
						
						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Nombre</label>
							  <input type="text" id="nombre" name="nombre" readonly placeholder="Nombre" class="form-control"/>
							</div>						
						</div>	
						
						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Observaciones <span class="priority">*<span/></label>
							  <textarea id="obs" name="obs" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Observaciones"></textarea>
							</div>					
						</div>	

						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="servicio">Servicio </label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="servicio" name="servicio" data-live-search="true" title="Servicio">			  
								</select>
								</div>
							</div>					
						</div>						
						
					</div><!-- FIN TAB HOME-->				
					<div class="tab-pane fade" id="menu1_familiares" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB TRATAMIENTO-->
			
						<div class="col-md-12 mb-3">
							<div class="card">
							  <div class="card-header text-white bg-info mb-3" align="center">
								Datos Familiares
							  </div>
							  <div class="card-body">

								 <table>
								   <thead>
									  <tr>
										 <th width="2.66%">#</th>
										 <th width="16.66%">Identidad</th>
										 <th width="30.66%">Nombre Completo</th>
										 <th width="16.66%">Responsable</th>
										 <th width="10.66%">Genero</th>
										 <th width="22.66%">Observaciones</th>
									   </tr>
									</thead>
									<tbody>
										<tr>
										  <th scope="row">1</th>
										  <td>                          
											<input type="number" id="identidad1" name="identidad1" class="form-control" placeholder="Ingrese el Númer de Identidad" title="Ingrese el Númer de Identidad"/>	
										  </td>
										  <td>
										    <input type="text" id="nombre1" name="nombre1" class="form-control" placeholder="Ingrese el Nombre Completo" title="Ingrese el Nombre Completo"/>
										  </td>
										  <td>
										  	 <select class="selectpicker" id="responsable1" name="responsable1" data-live-search="true" title="Responsable">			  
											 </select>											
										  </td>
										  <td>
										  	<select class="selectpicker" id="genero1" name="genero1" data-live-search="true" title="Genero">			  
											</select>
										  </td>								  
										  <td>
											 <input type="text" id="observaciones1" name="observaciones1" class="form-control" placeholder="Ingrese una Observiación"/>
										   </td>
										  </tr>
										  <tr>
										  <th scope="row">2</th>
										  <td>                          
											<input type="number" id="identidad2" name="identidad2" class="form-control" placeholder="Ingrese el Númer de Identidad" title="Ingrese el Númer de Identidad"/>	
										  </td>
										  <td>
										  <input type="text" id="nombre2" name="nombre2" class="form-control" placeholder="Ingrese el Nombre Completo" title="Ingrese el Nombre Completo"/>								  
										  </td>
										  <td>
										 	 <select class="selectpicker" id="responsable2" name="responsable2" data-live-search="true" title="Responsable">			  
											 </select>
										  </td>								  
										  <td>
										 	 <select class="selectpicker" id="genero2" name="genero2" data-live-search="true" title="Genero">			  
											 </select>
										  </td>								  
										  <td>
											 <input type="text" id="observaciones2" name="observaciones2" class="form-control" placeholder="Ingrese una Observiación"/>
										   </td>
										  </tr>
										  <tr>
										  <th scope="row">3</th>
										  <td>                          
											<input type="number" id="identidad3" name="identidad3" class="form-control" placeholder="Ingrese el Númer de Identidad" title="Ingrese el Númer de Identidad"/>	
										  </td>
										  <td>
										     <input type="text" id="nombre3" name="nombre3" class="form-control" placeholder="Ingrese el Nombre Completo" title="Ingrese el Nombre Completo"/>
										  </td>
										  <td>
									 	 	  <select class="selectpicker" id="responsable3" name="responsable3" data-live-search="true" title="Responsable">			  
											  </select>
										  </td>
										  <td>
										 	  <select class="selectpicker" id="genero3" name="genero3" data-live-search="true" title="Genero">			  
											  </select>
										  </td>								  
										  <td>
											 <input type="text" id="observaciones3" name="observaciones3" class="form-control" placeholder="Ingrese una Observiación"/>
										   </td>
										  </tr>
										  <tr>
										  <th scope="row">4</th>
										  <td>                          
											<input type="number" id="identidad4" name="identidad4" class="form-control" placeholder="Ingrese el Númer de Identidad"  title="Ingrese el Númer de Identidad"/>	
										  </td>
										  <td>
										  <input type="text" id="nombre4" name="nombre4" class="form-control" placeholder="Ingrese el Nombre Completo" title="Ingrese el Nombre Completo"/>								  
										  </td>
										  <td>
										  	  <select class="selectpicker" id="responsable4" name="responsable4" data-live-search="true" title="Responsable">			  
											  </select>	
										  </td>
										  <td>
										  	  <select class="selectpicker" id="genero4" name="genero4" data-live-search="true" title="Genero">			  
											  </select>	
										  </td>								  
										  <td>
											 <input type="text" id="observaciones4" name="observaciones4" class="form-control" placeholder="Ingrese una Observiación"/>
										   </td>
										  </tr>
										  <tr>
										  <th scope="row">5</th>
										  <td>                          
											<input type="number" id="identidad5" name="identidad5" class="form-control" placeholder="Ingrese el Númer de Identidad"  title="Ingrese el Númer de Identidad"/>	
										  </td>
										  <td>
										  <input type="text" id="nombre5" name="nombre5" class="form-control" placeholder="Ingrese el Nombre Completo"  title="Ingrese el Nombre Completo"/>								  
										  </td>
										  <td>
										 	  <select class="selectpicker" id="responsable5" name="responsable5" data-live-search="true" title="Responsable">			  
											  </select>
										  </td>
										  <td>
										  	  <select class="selectpicker" id="genero5" name="genero5" data-live-search="true" title="Genero">			  
											  </select>
										  </td>								  
										  <td>
											 <input type="text" id="observaciones5" name="observaciones5" class="form-control" placeholder="Ingrese una Observiación"/>
										   </td>
										  </tr>							  
									</tbody>
								</table>
						
							  </div>
							</div>
						</div>	
						
					</div><!-- FIN TAB TRATAMIENTO-->					
				</div><!-- FIN TAB CONTENT-->	
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_atenciones_familiares" type="submit" id="reg_atenciones_familiares"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="registrar">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario ATAS</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form class="invoice-form" id="formulario1">				
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home_form1" role="tab" aria-controls="home_form1" aria-selected="false">ATA</a>
					</li>
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link" id="transito-tab" data-toggle="tab" href="#transito_form1" role="tab" aria-controls="transito_form1" aria-selected="false">Transito</a>
					</li>
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link" id="referencias-tab" data-toggle="tab" href="#referencia_form1" role="tab" aria-controls="referencia_form1" aria-selected="false">Referencias</a>
					</li>
				</ul>
				<br>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" required value="Registro" readonly id="pro" name="pro"class="form-control" />
					  <input type="text" required readonly id="id-registro" name="id-registro" readonly="readonly" style="display: none;"/>
					</div>				
				</div>				
				<div class="tab-content" id="myTabContent"><!-- INICIO TAB CONTENT-->
				
					<div class="tab-pane fade active show" id="home_form1" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB HOME-->
					
						<div class="form-row">
							<div class="col-md-4 mb-3">
							  <label>Expediente</label>
							  <input type="number" required id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Fecha</label>
							 <input type="date" required id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Paciente</label>
							  <input type="text" required readonly id="paciente" name="paciente" class="form-control" placeholder="Paciente"/>
							</div>						
						</div>	

						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Nombre</label>
							 <input type="text" required id="nomb1" readonly name="nomb1" placeholder="Nombre" class="form-control"/>
							</div>								
						</div>
						
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="patologia1">Patología 1 <span class="priority">*<span/></label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="patologia1" name="patologia1" required data-live-search="true" title="Patologia">			  
								</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="patologia2">Patología 2</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="patologia2" name="patologia2" data-live-search="true" title="Patologia" required>			  
								</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="patologia3">Patología 3</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="patologia3" name="patologia2" data-live-search="true" title="Patologia">			  
								</select>
								</div>
							</div>	
						</div>	
						
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="servicio">Servicio</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="servicio" name="servicio" data-live-search="true" title="Servicio">			  
								</select>
								</div>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="ihss">IHSS (Asegurado)</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="ihss" name="ihss" data-live-search="true" title="Asegurado">			  
									</select>
								</div>
							</div>								
							<div class="col-md-3 mb-3">
								<label for="enfermedad">Enfermedad</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="enfermedad" name="enfermedad" data-live-search="true" title="Enfermedad">			  
								</select>
								</div>
							</div>	
						</div>		

						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Observaciones <span class="priority">*<span/></label>
							  <textarea id="observaciones" name="observaciones" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Observaciones"></textarea>
							</div>							
						</div>	

						<div class="form-row" id="trabajo_social">
							<div class="col-md-3 mb-3">
								<label for="tipo_atencion">Tipo de Atención</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="tipo_atencion" name="tipo_atencion" data-live-search="true" title="Tipo de Atención">			  
								</select>
								</div>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="nivel_socioeconomico">Nivel Socioeconómico</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="nivel_socioeconomico" name="nivel_socioeconomico" data-live-search="true" title="Nivel Socioeconómico">			  
								</select>
								</div>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="problema_social">Nivel Socioeconómico</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="problema_social" name="problema_social" data-live-search="true" title="Problema Social Identificado">			  
								</select>
								</div>
							</div>
							<div class="col-md-3 mb-3" style="display: none;" id="grupo_cantidades_tipo_atencion">
							  <label>Cantidad</label>
							  <input type="number" id="cantidad_tipo_atencion" name="cantidad_tipo_atencion" placeholder="Cantidad tipo de Atención" data-toggle="tooltip" data-placement="top" title="Cantidad Tipo de Atención" class="form-control"/>
							</div>								
						</div>		

						<div class="form-row" id="referencia_grupo">
							<div class="col-md-12 mb-3" id="referencia_grupo">
								<div class="form-check form-check-inline" id="referencia_grupo">
								   <label class="form-check-label mr-1 mb-1" id="referencia_label"></label>					  
								</div>	
								
								<div class="form-check form-check-inline" id="referencia_grupo">
								  <input class="form-check-input" type="radio" id="referenciasi" name="referencia" value="1">
								  <label class="form-check-label" id="label_referenciasi"></label>
								</div>
								<div class="form-check form-check-inline" id="referencia_grupo">
								  <input class="form-check-input" type="radio" id="referenciano" name="referencia" value="2" checked>
								  <label class="form-check-label" id="label_referenciano"></label>
								</div>	

								<div class="form-check form-check-inline" id="referencia_grupo">
								   <label class="form-check-label mr-1 mb-1" id="cronico_label"></label>					  
								</div>	
								
								<div class="form-check form-check-inline" id="referencia_grupo">
								  <input class="form-check-input" type="radio" id="cronico_si" name="cronico" value="1">
								  <label class="form-check-label" id="label_cronico_si"></label>
								</div>
								<div class="form-check form-check-inline" id="referencia_grupo">
								  <input class="form-check-input" type="radio" id="cronico_no" name="cronico" value="2" checked>
								  <label class="form-check-label" id="label_cronico_no"></label>
								</div>									

								<div class="form-check form-check-inline" id="referencia_grupo">
								   <label class="form-check-label mr-1 mb-1" id="suicida_label"></label>					  
								</div>	
								
								<div class="form-check form-check-inline" id="referencia_grupo">
								  <input class="form-check-input" type="radio" id="suicida_si" name="suicida" value="1">
								  <label class="form-check-label" id="label_suicida_si"></label>
								</div>
								<div class="form-check form-check-inline" id="referencia_grupo">
								  <input class="form-check-input" type="radio" id="suicida_no" name="suicida" value="2" checked>
								  <label class="form-check-label" id="label_suicida_no"></label>
								</div>

								<div class="form-check form-check-inline">
								   <label class="form-check-label mr-1 mb-1" id="preferencia_label"></label>					  
								</div>	
								
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="preferencia_si" name="preferencia" value="1">
								  <label class="form-check-label" id="label_preferencia_si"></label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="preferencia_no" name="preferencia" value="2" checked>
								  <label class="form-check-label" id="label_preferencia_no"></label>
								</div>	
							</div>
						</div>

						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="programar_cita">Cita de Seguimiento</label>			
								<div class="input-group mb-3">
								<select class="selectpicker" id="programar_cita" name="programar_cita" data-live-search="true" title="Cita de Seguimiento" >			  
								</select>
								</div>
							</div>
							<div class="col-md-8 mb-3">
							  <label id="label_programar_cita"></label>
							  <input type="text" id="otros_programar_cita" name="otros_programar_cita" placeholder="Comentario" max="250" class="form-control" style="display: none"/>
							</div>		
						</div>							
						
					</div><!-- FIN TAB HOME-->				
					<div class="tab-pane fade" id="transito_form1" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB TRANSITO-->
						<div class="col-md-12 mb-3">
							<div class="card">
							  <div class="card-header text-white bg-info mb-3" align="center">
								Transito Recibida
							  </div>
							  <div class="card-body">
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label for="transito_servicio_recibida">Recibida de</label>			
										<div class="input-group mb-3">
										<select class="selectpicker" id="transito_servicio_recibida" name="transito_servicio_recibida" data-live-search="true" title="Recibida de">			  
										</select>
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="transito_unidad_recibida">Unidad</label>			
										<div class="input-group mb-3">
										<select class="selectpicker" id="transito_unidad_recibida" name="transito_unidad_recibida" data-live-search="true" title="Unidad">			  
										</select>
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="transito_profesional_recibida">Unidad</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_profesional_recibida" name="transito_profesional_recibida" data-live-search="true" title="Profresional">			  
											</select>
										</div>
									</div>							
								</div>
								
								<div class="form-row">
									<div class="col-md-12 mb-3">
									  <label>Motivo</label>
									  <input type="text" name="transito_motivo_recibida" id="transito_motivo_recibida" maxlength="100" placeholder="Motivo Referencia Recibida" class="form-control"/>
									</div>								
								</div>								
								
							  </div>
							</div>								
						</div>

						<div class="col-md-12 mb-3">
							<div class="card">
							  <div class="card-header text-white bg-info mb-3" align="center">
								Transito Enviada
							  </div>
							  <div class="card-body">
							  
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label for="transito_servicio_enviada">Enviada a</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_servicio_enviada" name="transito_servicio_enviada" data-live-search="true" title="Enviada a">			  
											</select>
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="transito_unidad_enviada">Unidad</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_unidad_enviada" name="transito_unidad_enviada" data-live-search="true" title="Unidad">			  
											</select>
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="transito_profesional_enviada">Profesional</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_profesional_enviada" name="transito_profesional_enviada" data-live-search="true" title="Profesional">			  
											</select>
										</div>
									</div>							
								</div>	
								
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label for="tipo_atencion_ata">Tipo de Atención</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="tipo_atencion_ata" name="tipo_atencion_ata" data-live-search="true" title="Tipo de Atención">			  
											</select>
										</div>
									</div>									
									<div class="col-md-9 mb-3">
									  <label>Motivo</label>
									  <input type="text" name="transito_motivo_enviada" id="transito_motivo_enviada" maxlength="100" placeholder="Motivo Referencia Enviada" class="form-control"/>
									</div>								
								</div>
								
							  </div>
							</div>
							
						</div>
						
					</div><!-- FIN TAB TRANSITO-->	

					<div class="tab-pane fade" id="referencia_form1" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB REFERENCIAS-->
							
							<div class="card">
							  <div class="card-header text-white bg-info mb-3" align="center">
								Referencia Recibida
							  </div>
							  <div class="card-body">							  
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label for="nivel">Nivel</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="nivel" name="nivel" data-live-search="true" title="Nivel">			  
											</select>
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="centro">Centro</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="centro" name="centro" data-live-search="true" title="Centro">			  
											</select>
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="centroi">Recibida de</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="centroi" name="centroi" data-live-search="true" title="Recibida de">			  
											</select>
										</div>
									</div>								
								</div>
								
								<div class="form-row">
									<div class="col-md-6 mb-3">
									  <label>Clínico</label>
									  <input type="text" name="clinico" id="clinico" class="form-control"  title="Diagnostico Clínico" placeholder="Diagnostico Clínico" class="form-control"/>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="motivo">Motivo</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="motivo" name="motivo" data-live-search="true" title="Motivo">			  
											</select>
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="motivo_e">Otro Motivo</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="motivo_e" name="motivo_e" data-live-search="true" title="Otro Motivo">			  
											</select>
										</div>
									</div>								
								</div>																
							  </div>
							</div>

						<div class="card">
						  <div class="card-header text-white bg-info mb-3" align="center">
							Referencia Enviada
						  </div>
						  <div class="card-body">
						  
							<div class="form-row">
								<div class="col-md-3 mb-3">
									<label for="nivel_e">Nivel</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="nivel_e" name="nivel_e" data-live-search="true" title="Nivel">			  
										</select>
									</div>
								</div>
								<div class="col-md-3 mb-3">
									<label for="centro_e">Centro</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="centro_e" name="centro_e" data-live-search="true" title="Centro">			  
										</select>
									</div>
								</div>
								<div class="col-md-3 mb-3">
									<label for="centroi_e">Enviada a</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="centroi_e" name="centroi_e" data-live-search="true" title="Enviada a">			  
										</select>
									</div>
								</div>								
							</div>	
							
							<div class="form-row">
								<div class="col-md-6 mb-3">
								  <label>Diagnostico</label>
								  <input type="text" name="diagnostico_clinico" id="diagnostico_clinico" class="form-control"  title="Motivo de la referencia" placeholder="Diagnostico Clínico" class="form-control"/>
								</div>		
								<div class="col-md-3 mb-3">
									<label for="motivo_traslado">Motivo</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="motivo_traslado" name="motivo_traslado" data-live-search="true" title="Motivo">			  
										</select>
									</div>
								</div>
								<div class="col-md-3 mb-3">
									<label for="motivo_e1">Otro Motivo</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="motivo_e1" name="motivo_e1" data-live-search="true" title="Otro Motivo">			  
										</select>
									</div>
								</div>									
							</div>
							
						  </div>
						</div>
						
					</div><!-- FIN TAB REFERENCIAS-->
					
				</div><!-- FIN TAB CONTENT-->	
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario1" type="submit" id="reg_ata_form1"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		 <button class="btn btn-danger ml-2" form="formulario1" type="submit" id="clean_ata_form1"><div class="sb-nav-link-icon"></div><i class="fas fa-broom fa-lg"></i> Limpiar</button>		 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="registrar1">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario ATAS</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form class="invoice-form" id="formulario_atas">
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required class="form-control" id="id-registro1" name="id-registro1" readonly="readonly"/>
					  <input type="hidden" required class="form-control" id="agenda_id" name="agenda_id" readonly="readonly"/>
					  <input type="hidden" required class="form-control" id="pacientes_id" name="pacientes_id" readonly="readonly"/>
					  <input type="text" readonly id="pro1" name="pro1" class="form-control"/>
					</div>				
				</div>
				
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home_form2" role="tab" aria-controls="home_form1" aria-selected="false">ATA</a>
					</li>
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link" id="transito-tab" data-toggle="tab" href="#transito_form2" role="tab" aria-controls="transito_form1" aria-selected="false">Transito</a>
					</li>
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link" id="referencias-tab" data-toggle="tab" href="#referencia_form2" role="tab" aria-controls="referencia_form1" aria-selected="false">Referencias</a>
					</li>				
				</ul>
				<br>

				<div class="tab-content" id="myTabContent"><!-- INICIO TAB CONTENT-->				
					<div class="tab-pane fade active show" id="home_form2" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB HOME-->							
						<div class="form-row">
							<div class="col-md-4 mb-3">
							  <label>Expediente</label>
							  <input type="number" required id="user1" name="user1" placeholder="Expediente o Identidad" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Fecha</label>
							 <input type="date" required id="fecha1" name="fecha1" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Paciente</label>
							  <input type="text" required readonly id="paciente1" name="paciente1" class="form-control" placeholder="Paciente"/>
							</div>						
						</div>	

						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Nombre</label>
							 <input type="text" required id="nombre_paciente" name="nombre_paciente" readonly placeholder="Nombre" class="form-control"/>
							</div>								
						</div>
						
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="patologia_1">Patología 1 <span class="priority">*<span/></label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="patologia_1" name="patologia_1" required data-live-search="true" title="Patologia">			  
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="patologia_2">Patología 2</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="patologia_2" name="patologia_2" data-live-search="true" title="Patologia">			  
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="patologia_3">Patología 3</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="patologia_3" name="patologia_3" data-live-search="true" title="Patologia">			  
									</select>
								</div>
							</div>
						</div>	
						
						<div class="form-row">
							<div class="col-md-3 mb-3" id="grupo_servicio">
								<label for="servicio1">Servicio</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="servicio1" name="servicio1" data-live-search="true" title="Servicio">			  
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="ihss_ata">Asegurado IHSS</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="ihss_ata" name="ihss_ata" data-live-search="true" title="Asegurado">			  
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="enfermedad1">Enfermedad</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="enfermedad1" name="enfermedad1" data-live-search="true" title="Enfermedad">			  
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="glucometria">Glucometría</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="glucometria" name="glucometria" data-live-search="true" title="Glucometría">			  
									</select>
								</div>
							</div>								
						</div>		

						<div class="form-row" id="trabajo_social1">
							<div class="col-md-3 mb-3">
								<label for="tipo_atencion1">Tipo Atención</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="tipo_atencion1" name="tipo_atencion1" data-live-search="true" title="Tipo Atención">			  
									</select>
								</div>
							</div>								
							<div class="col-md-3 mb-3">
								<label for="nivel_socioeconomico1">Nivel Socioeconómico</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="nivel_socioeconomico1" name="nivel_socioeconomico1" data-live-search="true" title="Nivel Socioeconómico">			  
									</select>
								</div>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="problema_social1">Problema Social Identificado</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="problema_social1" name="problema_social1" data-live-search="true" title="Problema Social Identificado">			  
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3" style="display: none;" id="grupo_cantidades_tipo_atencion1">
							  <label>Cantidad</label>
							  <input type="number" id="cantidad_tipo_atencion1" name="cantidad_tipo_atencion1" placeholder="Cantidad tipo de Atención" data-toggle="tooltip" data-placement="top" title="Cantidad Tipo de Atención" class="form-control"/>
							</div>								
						</div>							
						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <label>Observaciones <span class="priority">*<span/></label>
							  <textarea id="observaciones1" name="observaciones1" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Observaciones"></textarea>
							</div>							
						</div>	

						<div class="form-row" id="referencia_grupo1">
							<div class="col-md-12 mb-3" id="referencia_grupo1">
								<div class="form-check form-check-inline" id="referencia_grupo1">
								   <label class="form-check-label mr-1 mb-1" id="referencia_label1"></label>					  
								</div>	
								
								<div class="form-check form-check-inline" id="referencia_grupo1">
								  <input class="form-check-input" type="radio" id="referenciasi1" name="referencia1" value="1">
								  <label class="form-check-label" id="label_referenciasi1"></label>
								</div>
								<div class="form-check form-check-inline" id="referencia_grupo1">
								  <input class="form-check-input" type="radio" id="referenciano1" name="referencia1" value="2" checked>
								  <label class="form-check-label" id="label_referenciano1"></label>
								</div>	

								<div class="form-check form-check-inline" id="referencia_grupo1">
								   <label class="form-check-label mr-1 mb-1" id="cronico_label1"></label>					  
								</div>	
								
								<div class="form-check form-check-inline" id="referencia_grupo1">
								  <input class="form-check-input" type="radio" id="cronico_si1" name="cronico1" value="1">
								  <label class="form-check-label" id="label_cronico_si1"></label>
								</div>
								<div class="form-check form-check-inline" id="referencia_grupo1">
								  <input class="form-check-input" type="radio" id="cronico_no1" name="cronico1" value="2" checked>
								  <label class="form-check-label" id="label_cronico_no1"></label>
								</div>									

								<div class="form-check form-check-inline" id="referencia_grupo1">
								   <label class="form-check-label mr-1 mb-1" id="suicida_label1"></label>					  
								</div>	
								
								<div class="form-check form-check-inline" id="referencia_grupo1">
								  <input class="form-check-input" type="radio" id="suicida_si1" name="suicida1" value="1">
								  <label class="form-check-label" id="label_suicida_si1"></label>
								</div>
								<div class="form-check form-check-inline" id="referencia_grupo1">
								  <input class="form-check-input" type="radio" id="suicida_no1" name="suicida1" value="2" checked>
								  <label class="form-check-label" id="label_suicida_no1"></label>
								</div>	
								
								<div class="form-check form-check-inline">
								   <label class="form-check-label mr-1 mb-1" id="preferencia_label1"></label>					  
								</div>	
								
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="preferencia_si1" name="preferencia1" value="1">
								  <label class="form-check-label" id="label_preferencia_si1"></label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="preferencia_no1" name="preferencia1" value="2" checked>
								  <label class="form-check-label" id="label_preferencia_no1"></label>
								</div>									
							</div>
						</div>

						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="programar_cita_1">Cita de Seguimiento</label>			
								<div class="input-group mb-3">
									<select class="selectpicker" id="programar_cita_1" name="programar_cita_1" data-live-search="true" title="Cita de Seguimiento">			  
									</select>
								</div>
							</div>
							<div class="col-md-8 mb-3">
							  <label id="label_programar_cita_1"></label>
							  <input type="text" id="otros_programar_cita_1" name="otros_programar_cita_1" placeholder="Comentario" max="250" class="form-control" style="display: none"/>
							</div>		
						</div>							
						
					</div><!-- FIN TAB HOME-->				
					<div class="tab-pane fade" id="transito_form2" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB TRANSITO-->
						<div class="col-md-12 mb-3">
							<div class="card">
							  <div class="card-header text-white bg-info mb-3" align="center">
								Transito Recibida
							  </div>
							  <div class="card-body">
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label for="transito_servicio_recibida1">Recibida de</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_servicio_recibida1" name="transito_servicio_recibida1" data-live-search="true" title="Recibida de">			  
											</select>
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="transito_unidad_recibida1">Unidad</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_unidad_recibida1" name="transito_unidad_recibida1" data-live-search="true" title="Unidad">			  
											</select>
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="transito_profesional_recibidas1">Profesional</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_profesional_recibidas1" name="transito_profesional_recibidas1" data-live-search="true" title="Profesional">			  
											</select>
										</div>
									</div>								
								</div>
								
								<div class="form-row">
									<div class="col-md-12 mb-3">
									  <label>Motivo</label>
									  <input type="text" name="transito_motivo_recibida1" id="transito_motivo_recibida1" maxlength="100" placeholder="Motivo Referencia Recibida" class="form-control"/>
									</div>								
								</div>								
								
							  </div>
							</div>								
						</div>

						<div class="col-md-12 mb-3">
							<div class="card">
							  <div class="card-header text-white bg-info mb-3" align="center">
								Transito Enviada
							  </div>
							  <div class="card-body">							  
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label for="transito_servicio_enviada1">Enviada a</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_servicio_enviada1" name="transito_servicio_enviada1" data-live-search="true" title="Enviada a">			  
											</select>
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="transito_unidad_enviada1">Unidad</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_unidad_enviada1" name="transito_unidad_enviada1" data-live-search="true" title="Unidad">			  
											</select>
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="transito_profesional_enviada1">Profesional</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="transito_profesional_enviada1" name="transito_profesional_enviada1" data-live-search="true" title="Profesional">			  
											</select>
										</div>
									</div>							
								</div>	
								
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label for="tipo_atencion_ata1">Tipo de Atención</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="tipo_atencion_ata1" name="tipo_atencion_ata1" data-live-search="true" title="Tipo de Atención">			  
											</select>
										</div>
									</div>									
									<div class="col-md-9 mb-3">
									  <label>Motivo</label>
									  <input type="text" name="transito_motivo_enviada1" id="transito_motivo_enviada1" maxlength="100" placeholder="Motivo Referencia Enviada" class="form-control"/>
									</div>								
								</div>
								
							  </div>
							</div>
							
						</div>
	
					</div><!-- FIN TAB TRANSITO-->	

					<div class="tab-pane fade" id="referencia_form2" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB REFERENCIAS-->

							<div class="card">
							  <div class="card-header text-white bg-info mb-3" align="center">
								Referencia Recibida
							  </div>
							  <div class="card-body">							  
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label for="nivel1">Nivel</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="nivel1" name="nivel1" data-live-search="true" title="Nivel">			  
											</select>
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="centro1">Centro</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="centro1" name="centro1" data-live-search="true" title="Centro">			  
											</select>
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="centroi1">Recibida de</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="centroi1" name="centroi1" data-live-search="true" title="Recibida de">			  
											</select>
										</div>
									</div>								
								</div>
								
								<div class="form-row">
									<div class="col-md-6 mb-3">
									  <label>Clínico</label>
									  <input type="text" name="clinico1" id="clinico1" class="form-control"  title="Diagnostico Clínico" placeholder="Diagnostico Clínico" class="form-control"/>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="motivo1">Motivo</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="motivo1" name="motivo1" data-live-search="true" title="Motivo">			  
											</select>
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="motivo_re">Otro Motivo</label>			
										<div class="input-group mb-3">
											<select class="selectpicker" id="motivo_re" name="motivo_re" data-live-search="true" title="Otro Motivo">			  
											</select>
										</div>
									</div>								
								</div>																
							  </div>
							</div>

						<div class="card">
						  <div class="card-header text-white bg-info mb-3" align="center">
							Referencia Enviada
						  </div>
						  <div class="card-body">						  
							<div class="form-row">
								<div class="col-md-3 mb-3">
									<label for="nivel_e1">Nivel</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="nivel_e1" name="nivel_e1" data-live-search="true" title="Nivel">			  
										</select>
									</div>
								</div>	
								<div class="col-md-3 mb-3">
									<label for="centro_e1">Centro</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="centro_e1" name="centro_e1" data-live-search="true" title="Centro">			  
										</select>
									</div>
								</div>	
								<div class="col-md-3 mb-3">
									<label for="centroi_e1">Enviada a</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="centroi_e1" name="centroi_e1" data-live-search="true" title="Enviada a">			  
										</select>
									</div>
								</div>									
							</div>	
							
							<div class="form-row">
								<div class="col-md-6 mb-3">
								  <label>Diagnostico</label>
								  <input type="text" name="diagnostico_clinico1" id="diagnostico_clinico1" class="form-control"  title="Motivo de la referencia" placeholder="Diagnostico Clínico" class="form-control"/>
								</div>
								<div class="col-md-3 mb-3">
									<label for="motivo_traslado1">Motivo</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="motivo_traslado1" name="motivo_traslado1" data-live-search="true" title="Motivo">			  
										</select>
									</div>
								</div>
								<div class="col-md-3 mb-3">
									<label for="motivo_e1">Otro Motivo</label>			
									<div class="input-group mb-3">
										<select class="selectpicker" id="motivo_e1" name="motivo_e1" data-live-search="true" title="Otro Motivo">			  
										</select>
									</div>
								</div>									
							</div>
							
						  </div>
						</div>
	
					</div><!-- FIN TAB REFERENCIAS-->
					
				</div><!-- FIN TAB CONTENT-->	
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_atas" type="submit" id="edi_ata_por_usuario"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		 <button class="btn btn-danger ml-2" form="formulario_atas" type="submit" id="clean1_ata_por_usuario"><div class="sb-nav-link-icon"></div><i class="fas fa-broom fa-lg"></i> Limpiar</button>		 
	   </div>		
      </div>
    </div>
</div>
   <?php include("modals/modals.php");?>
<!--FIN MODAL-->  	

   <!--Fin Ventanas Modales-->
	<!--MENU-->	  
       <?php include("templates/menu.php"); ?>
    <!--FIN MENU--> 
	
<br><br><br>
<div class="container-fluid">
	<ol class="breadcrumb mt-2 mb-4">
		<li class="breadcrumb-item" id="acciones_atras"><a class="breadcrumb-link" href="#" id="ancla_volver"><span id="label_acciones_volver"></a></li>
		<li class="breadcrumb-item active" id="acciones_receta"><span id="label_acciones_receta"></span></li>
	</ol>
	
 	<div id="main">
		<form class="form-inline" id="form_main">
			<div class="form-group mx-sm-3 mb-1">
				<div class="input-group">
					<div class="input-group-append">
						<span class="input-group-text"><div class="sb-nav-link-icon"></div>Estado</span>
						<select id="estado" name="estado" class="selectpicker" title="Estado" data-live-search="true">
						</select>
					</div>	
				</div>
			</div>
		  <div class="form-group mr-1">
			<div class="input-group">				
				<div class="input-group-append">				
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fecha Inicio</span>
				</div>
				<input type="date" required id="fecha_b" name="fecha_b" style="width:165px;" value="<?php echo date ("Y-m-d");?>" class="form-control"/>	   
			</div>
		  </div>
		  <div class="form-group mr-1">
			<div class="input-group">				
				<div class="input-group-append">				
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fecha Fin</span>
				</div>
				<input type="date" required id="fecha_f" name="fecha_f" style="width:165px;" value="<?php echo date ("Y-m-d");?>" class="form-control"/>		   
			</div>   
		  </div>	  
		  <div class="form-group mr-1">
			<input type="text" placeholder="Buscar registros" id="bs-regis" title="Buscar por: Expediente, Nombre o Identidad" autofocus class="form-control" size="30"/>
		  </div>	   	  
		  <div class="form-group">
			<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
			  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				 <i class="fas fa-plus-circle fa-lg"></i> Atención
			  </a>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="#" id="nuevo-registro" data-toggle="tooltip" data-placement="top">ATA</a>
				<a class="dropdown-item" href="#" id="nuevo_ata_manual" data-toggle="tooltip" data-placement="top">ATA Manual</a>
				<a class="dropdown-item" href="#" id="nuevo_seguimiento" data-toggle="tooltip" data-placement="top">ATA Seguimiento</a>
				<a class="dropdown-item" href="#" id="ata_familiares" data-toggle="tooltip" data-placement="top">Atenciones Familiares</a>
				<a class="dropdown-item" href="#" id="cuestionario" data-toggle="tooltip" data-placement="top" title="Agregar Cuestionario para usuarios Egresados de MAIDA">Cuestionario</a>
				<a class="dropdown-item" href="#" id="entrevista" data-toggle="tooltip" data-placement="top">Entrevista</a>			
			  </div>
			</div>		  
		  </div>
		  <div class="form-group mr-1">
		     <button class="btn btn-primary ml-1" id="receta" data-toggle="tooltip" data-placement="top" title="Receta Médica"><div class="sb-nav-link-icon"></div><i class="fas fa-prescription-bottle-alt fa-lg"></i> Receta</button>
		  </div>	  
		  <div class="form-group">
			<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
			  <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				 <i class="fas fa-file-medical fa-lg"></i> Crear
			  </a>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="#" id="ref_enviadas" data-toggle="tooltip" data-placement="top">Referencias Enviadas</a>
				<a class="dropdown-item" href="#" id="ref_recibidas" data-toggle="tooltip" data-placement="top">Referencias Recibidas</a>
				<a class="dropdown-item" href="#" id="transito_enviada" data-toggle="tooltip" data-placement="top" title="Agregar Usuarios Enviados">Transito Enviados </a>
				<a class="dropdown-item" href="#" id="transito_recibida" data-toggle="tooltip" data-placement="top">Transito Recibidos</a>		
			  </div>
			</div>		  
		  </div>	  
		  <div class="form-group">
			<button class="btn btn-success ml-1" type="submit" id="historial" data-toggle="tooltip" data-placement="top" title="Buscar Historial de Atenciones"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i> Buscar</button>
		  </div>   
		</form>
		<hr/>   
		<div class="form-group">
		  <div class="col-sm-12">
			<div class="registros overflow-auto" id="agrega-registros"></div>
		   </div>		   
		</div>
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center" id="pagination"></ul>
		</nav>
	</div>
	<?php include("templates/receta.php"); ?>
    <?php include("templates/footer.php"); ?> 	
</div>

    <!-- add javascripts -->
	<?php 
		include "script.php"; 
		
		include "../js/main.php"; 
		include "../js/receta.php"; 
		include "../js/myjava_atas.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?>   
</body>
</html>