<?php
session_start(); 
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Agenda";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Agenda", MB_CASE_TITLE, "UTF-8");   

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
    <meta name="author" content="Script Tutorials" />
    <meta name="description" content="Responsive Websites Orden Hospitalaria de San Juan de Dios">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Agenda :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>	
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?> 
<!--INICIO VENTANA MODALES-->
<div class="modal fade" id="eliminar_cita">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Eliminar Cita</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="form-eliminarcita" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="proceso">Proceso</label>
					  <input type="hidden" id="agenda_id_cita" name="agenda_id_cita" class="form-control" id="id">	
					  <input type="hidden" id="pacientes_id" name="pacientes_id" class="form-control" id="id">	
					  <input type="hidden" name="expediente" id="expediente" class="form-control" id="expediente" placeholder="Expediente">	
					  <input type="text" required readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row" id="grupo_expediente">
					<div class="col-md-12 mb-3">
					  <label for="expedoente">Nombre</label>
				     <input type="text" name="comentario" id="usuario" class="form-control" id="usuario" placeholder="Paciente" readonly="readonly">
					</div>			
				</div>									
				
				<div class="form-row">			  
					<div class="col-md-12 mb-3">
					  <label for="direccion">Comentario <span class="priority">*<span/></label>
					  <input type="text" name="comentario" id="comentario" class="form-control" id="contranaterior" placeholder="Comentario" required="required">
					</div>
				</div>						  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-danger ml-2" type="submit" id="eliminar" form="form-eliminarcita"><div class="sb-nav-link-icon"></div><i class="fas fa-trash fa-lg"></i> Eliminar</button>			
		</div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Citas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="proceso">Proceso</label>
					  <input type="hidden" required="required" id="id-registro" name="id-registro"class="form-control"/>
					  <input type="hidden" required="required" id="agenda_id" name="agenda_id" class="form-control">              
					  <input type="hidden" required="required" id="pacientes_id_registro" name="pacientes_id_registro"class="form-control"/>
					  <input type="hidden" required="required" id="servicio_registro" name="servicio_registro" class="form-control"/>	
					  <input type="text" required readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Expediente</label>
				      <input type="text" required="required" name="expediente" id="expediente"  readonly maxlength="100" class="form-control"/>
					</div>		
					<div class="col-md-8 mb-3">
					  <label for="expedoente">Nombre</label>
				      <input type="text" required="required" name="nombre" id="nombre"  readonly maxlength="100" class="form-control"/>
					</div>							
				</div>		
				<div class="form-row" id="grupo_expediente">
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Fecha Anterior</label>
				      <input type="text" required="required" name="fecha_a" id="fecha_a"  readonly value="<?php echo date ("Y-m-d");?>" maxlength="100" class="form-control"/>
					</div>		
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Nueva Fecha</label>
				      <input type="date" required="required" name="fecha_n" id="fecha_n" value="<?php echo date ("Y-m-d");?>" maxlength="100" class="form-control"/>
					</div>		
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Hora</label>
				      <select id="hora_nueva" name="hora_nueva" class="custom-select" data-toggle="tooltip" data-placement="top" ="Nueva Hora" required="required">
				      </select>
					</div>							
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Estado <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="status_repro" name="status_repro" class="custom-select" data-toggle="tooltip" data-placement="top" title="Religión">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_estado_reprogramacion">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" id="servicio_boton"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>									
				</div>	
				<div class="form-row" id="grupo_expediente">
					<div class="col-md-12 mb-3">
					  <label>Observación <span class="priority">*<span/></label>
					  <textarea id="observacion" name="observacion" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Observación"></textarea>
					  <p id="charNum_cita_observacion">250 Caracteres</p>
					</div>													
				</div>					
				
				<div class="form-row">		
					<div class="col-md-12 mb-3">
					  <label>Comentario <span class="priority">*<span/></label>
					  <textarea id="comentario" name="comentario" class="form-control" rows="3" maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Comentario"></textarea>
					  <p id="charNum_cita_comentarion">250 Caracteres</p>
					</div>						
				</div>

				<div class="form-check-inline">
				  <label for="fecha">Comentario</label>
				  <div class="col-md-6 mb-3">
					  <input class="form-check-input" type="checkbox" name="respuesta" id="checkeliminar" value="1">
					  <label class="form-check-label" for="exampleRadios1">Sí</label>				  
				  </div>				  
				</div>				  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="edi" form="formulario"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>	
			<button class="btn btn-success ml-2" type="submit" id="edi1" form="formulario"><div class="sb-nav-link-icon"></div><i class="fas fa-comments fa-lg"></i> Comentario</button>				
		</div>			
      </div>
    </div>
</div>

<div class="modal fade" id="enviar_sms">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Enviar SMS</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_enviar_sms" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" id="pacientes_id" name="pacientes_id" class="form-control"/>
					  <input type="hidden" id="agenda_id" name="agenda_id" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="expedoente">Para</label>
					<input type="text" required="required" id="to" name="to" placeholder="Ejemplo: 97567896,97567897,97567898,97567899,97567810" maxlength="44" class="form-control" />
					</div>								
				</div>		
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="expedoente">Mensaje</label>
					  <textarea id="text" name="text"  class="form-control" maxlength="160" rows="5"></textarea>
				      <p id="charNum">160 Caracteres</p>
				      <p style="color: blue;"><b>Ejemplo: 97567896,97567897,97567898,97567899,97567810<br/>Se puede enviar hasta 5 Números separados por coma (,)</b></p>
					</div>								
				</div>					
				  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-warning ml-2" type="submit" id="sms_clean" form="formulario_enviar_sms"><div class="sb-nav-link-icon"></div><i class="fas fa-eraser fa-lg"></i> Limpiar</button>	
			<button class="btn btn-success ml-2" type="submit" id="sms_send" form="formulario_enviar_sms"><div class="sb-nav-link-icon"></div><i class="fas fa-paper-plane fa-lg"></i> Enviar</button>				
		</div>			
      </div>
    </div>
</div>

<div class="modal fade" id="enviar_sms_varios">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Enviar SMS</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_enviar_sms_varios" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="hidden" id="pacientes_id" name="pacientes_id" class="form-control"/>
						<input type="hidden" id="agenda_id" name="agenda_id" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-2 mb-3">
					  <label for="expedoente">Fecha</label>
					  <input type="date" required="required" id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" title="Fecha Inicial" class="form-control"/>
					</div>				
					<div class="col-md-2 mb-3">
					  <label for="expedoente">Servicio</label>
					  <select id="servicio" name="servicio" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio"> 				   
						<option value="">Seleccione</option>
				      </select>
					</div>	
					<div class="col-md-2 mb-3">
					  <label for="expedoente">Unidad</label>
					  <select id="unidad" name="unidad" class="custom-select" data-toggle="tooltip" data-placement="top" title="Unidad"> 				   
							<option value="">Seleccione</option>
				      </select>
					</div>	
					<div class="col-md-3 mb-3">
					  <label for="expedoente">Profesional</label>
					  <select id="medico" name="medico" class="custom-select" data-toggle="tooltip" data-placement="top" title="Profesional"> 				   
						    <option value="">Seleccione</option>
				      </select>
					</div>
					<div class="col-md-3 mb-3">
					  <label for="expedoente">Tipo de Reporte</label>
					  <select id="tipo_reporte" name="tipo_reporte" class="custom-select" data-toggle="tooltip" data-placement="top" title="Tipo de Reporte">
				      </select>
					</div>						
				</div>			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="expedoente">Mensaje</label>
					  <textarea id="text" name="text" class="form-control" maxlength="160" rows="5"></textarea>
				      <p id="charNumSMS">148 Caracteres</p>
					</div>								
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <span style="color: blue;" data-toggle="tooltip" data-placement="top" title="Leyendas de autocompletación que se pueden utilizar para enviar los SMS de forma personalizada"><b>Leyendas</b></span>
					</div>						
				</div>	
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <span title="Permite agregar el nombre del usuario"><b>Nombre Usuario:</b> <span id="nombre_usuario">@nombre_usuario</span></span>
					</div>	
					<div class="col-md-6 mb-3">
					  <span title="Permite agregar el apellido del usuario"><b>Apellido Usuario:</b> <span id="nombre_apellido">@nombre_apellido</span></span>
					</div>						
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <span title="Permite agregar el nombre del mes"><b>Día Nombre:</b> <span id="dia_nombre">@dia_nombre</span></span>
					</div>	
					<div class="col-md-6 mb-3">
					  <span title="Permite agregar el número de día de la semana"><b>Día:</b> <span id="dia">@dia</span></span>
					</div>						
				</div>	
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <span title="Permite agregar el nombre del mes"><b>Mes:</b> <span id="mes">@mes</span></span>
					</div>	
					<div class="col-md-6 mb-3">
					  <span title="Permite agregar el año"><b>Año:</b> <span id="año">@año</span></span>
					</div>						
				</div>											  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-warning ml-2" type="submit" id="sms_clean_varios" form="formulario_enviar_sms_varios"><div class="sb-nav-link-icon"></div><i class="fas fa-eraser fa-lg"></i> Limpiar</button>	
			<button class="btn btn-success ml-2" type="submit" id="sms_send_varios" form="formulario_enviar_sms_varios"><div class="sb-nav-link-icon"></div><i class="fas fa-paper-plane fa-lg"></i> Enviar</button>				
		</div>			
      </div>
    </div>
</div>

<div class="modal fade" id="agregar_confirmacion">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Confirmación</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_confirmacion" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="proceso">Proceso</label>
					  <input type="text" required="required" readonly id="agenda_id_confirmacion" name="agenda_id_confirmacion" readonly="readonly" style="display: none;" class="form-control"/>
					  <input type="text" required="required" readonly id="colaborador_id_confirmacion" name="colaborador_id_confirmacion" readonly="readonly" style="display: none;" class="form-control"/>
					  <input type="text" required="required" readonly id="servicio_id_confirmacion" name="servicio_id_confirmacion" readonly="readonly" style="display: none;" class="form-control"/>
					  <input type="text" required readonly id="pro_confirmacion" name="pro_confirmacion" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
					  <label for="expediente_confirmacion">Expediente</label>
					  <input type="text" required="required" id="expediente_confirmacion" name="expediente_confirmacion" placeholder="Expediente o Identidad" readonly="readonly" class="form-control"/>
					</div>		
					<div class="col-md-3 mb-3">
					  <label for="fecha_confirmacion">Fecha</label>
				      <input type="date" required="required" readonly id="fecha_confirmacion" name="fecha_confirmacion" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>		
					<div class="col-md-3 mb-3">
					  <label for="identidad_confirmacion">Identidad</label>
				      <input type="text" required="required" readonly id="identidad_confirmacion" name="identidad_confirmacion" class="form-control"/>
					</div>
					<div class="col-md-3 mb-3">
					  <label for="hora_confirmacion">Hora</label>
				      <input type="text" required="required" readonly id="hora_confirmacion" name="hora_confirmacion" class="form-control"/>
					</div>												
				</div>		
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="expedoente">Nombre</label>
				      <input type="text" required="required" readonly id="nombre_confirmacion" name="nombre_confirmacion" class="form-control"/>
					</div>									
				</div>	
				
				<div class="form-row">
					<div class="col-md-8 mb-3">
					  <label for="expedoente">Correo</label>
					  <input type="email" placeholder="alguien@algo.com" id="correo_confirmacion" name="correo_confirmacion" class="form-control"/>					      
					</div>		
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Teléfono</label>
				      <input type="number" placeholder="Ejemplo: 97567896" id="telefono_confirmacion" name="telefono_confirmacion" class="form-control"/>
					</div>								
				</div>
				
				<div class="form-row">
					<div class="col-md-8 mb-3">
						<div class="form-check-inline">
							<p for="end" class="col-sm-5 form-check-label">¿Confirmo?</p>
							<div class="col-sm-6">
							<input type="radio" class="form-check-input" name="respuesta_confirmacion" id="si_respuesta_confirmacion" value="1">Sí
							<input type="radio" class="form-check-input" name="respuesta_confirmacion" id="no_respuesta_confirmacion" value="1">No					
							</div>						 
						</div>					      
					</div>		
					<div class="col-md-4 mb-3" id="grupo_confirmacion1" style="display: none;">
					  <label for="expedoente">¿Confirmo?</label>
					  <select id="confirmo_no" name="confirmo_no" class="custom-select" data-toggle="tooltip" data-placement="top" title= "Confirmación">
						<option value="">Seleccione</option>
				      </select>	
					</div>								
				</div>	

				<div class="form-group">
					<div class="col-md-12 mb-3">
					  <label>Observación <span class="priority">*<span/></label>
					  <textarea id="observacion_confirmacion" name="observacion_confirmacion" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Observación"></textarea>
					  <p id="charNum_agenda_observacion">250 Caracteres</p>
					</div>					   
				 </div>					
				 <div class="form-check-inline">
					 <p for="end" class="col-sm-4 form-check-label">¿Editar Registro?</p>
					 <div class="col-sm-4">
						<input type="radio" class="form-check-input" name="editar_confirmacion" id="editar_si_confirmacion" value="1">Sí
						<input type="radio" class="form-check-input" name="editar_confirmacion" id="editar_no_confirmacion" value="1">No					
					 </div>	
					 <p for="end" class="col-sm-4 form-check-label">¿Actualizar Datos?</p>
					 <div class="col-sm-4">
						<input type="radio" class="form-check-input" name="actualizar_datos" id="actualizar_datos_si" value="1">Sí
						<input type="radio" class="form-check-input" name="actualizar_datos" id="actualizar_datos_no" value="2">No					
					 </div>						 
				 </div>					
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_confirmacion" form="formulario_agregar_confirmacion"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>	
			<button class="btn btn-warning ml-2" type="submit" id="edit_confirmacion" form="formulario_agregar_confirmacion"><div class="sb-nav-link-icon"></div><i class="fas fa-save fa-lg"></i> Modificar</button>				
		</div>			
      </div>
    </div>
</div>

<div class="modal fade" id="agregar_triage_reporte">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reporte de Triage - Agenda</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_triage_reporte" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" required="required" readonly id="agenda_id_confirmacion" name="agenda_id_confirmacion" readonly="readonly" style="display: none;" class="form-control"/>
					  <input type="text" required="required" readonly id="colaborador_id_confirmacion" name="colaborador_id_confirmacion" readonly="readonly" style="display: none;" class="form-control"/>
					  <input type="text" required="required" readonly id="servicio_id_confirmacion" name="servicio_id_confirmacion" readonly="readonly" style="display: none;" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Servicio</label>
					  <select id="servicio_triage" name="servicio_triage" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio">
				      </select>
					</div>		
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Fecha Inicio</label>
				      <input type="date" required="required" id="fecha_b" name="fecha_b" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>		
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Fecha Fin</label>
					  <input type="date" required="required" id="fecha_f" name="fecha_f" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>							
				</div>		
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="expedoente">Reporte de Triage</label>
					  <select id="reporte_triage" name="reporte_triage" class="custom-select" data-hide-disabled="true" data-size="10" data-live-search="true" title="Reporte">
				      </select>
					</div>									
				</div>						
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-success ml-2" type="submit" id="descargar_triage" form="formulario_triage_reporte"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i> Descargar</button>				
		</div>			
      </div>
    </div>
</div>
</div>

<div class="modal fade" id="agregar_triage">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reporte de Triage</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_triage" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="proceso">Proceso</label>
					  <input type="hidden" id="triage_id" name="triage_id"class="form-control"/>
					  <input type="hidden" id="agenda_id_triage" name="agenda_id_triage" class="form-control"/>
					  <input type="hidden" id="colaborador_id_triage" name="colaborador_id_triage" class="form-control"/>
					  <input type="hidden" id="servicio_id_triage" name="servicio_id_triage" class="form-control"/>
					  <input type="hidden" id="tipo_usuario" name="tipo_usuario" class="form-control"/>
					  <input type="hidden" id="pacientes_id" name="pacientes_id" class="form-control"/>
					  <input type="text" required readonly id="pro_triage" name="pro_triage" class="form-control" readonly >
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Expediente</label>
					  <input type="text" required="required" id="expediente_triage" name="expediente_triage" placeholder="Expediente o Identidad" readonly="readonly" class="form-control"/>
					</div>		
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Fecha</label>
				      <input type="date" required="required" readonly id="fecha_triage" name="fecha_triage" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>		
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Identidad</label>
					  <input type="text" required="required" readonly id="identidad_triage" name="identidad_triage" class="form-control"/>
					</div>							
				</div>		
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Nombre</label>
					  <input type="text" required="required" readonly id="nombre_triage" name="nombre_triage" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Atención</label>
				     <select id="atencion_triage" name="atencion_triage" class="custom-select" required data-toggle="tooltip" data-placement="top" title="Atención">
	                 </select>	
					</div>
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Observación</label>
					  <select id="observacion_triage" name="observacion_triage" class="custom-select" required data-toggle="tooltip" data-placement="top" title="Observación">
	                  </select>
					</div>						
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Información</label>
					  <select id="informacion_triage" name="informacion_triage" class="custom-select" required data-toggle="tooltip" data-placement="top" title="Informacion">
	                  </select>		
					</div>	
					<div class="col-md-4 mb-3">
					  <label for="expedoente">Tipo Atención</label>
				     <select id="tipo_triage" name="tipo_triage" class="custom-select" required data-toggle="tooltip" data-placement="top" title="Tipo Atención">
	                 </select>	
					</div>						
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="expedoente">Comentario</label>
					  <textarea id="comentario_triage" name="comentario_triage" required placeholder="Comentario" class="form-control" maxlength="250" rows="3"></textarea>	
					  <p id="charNum_triage">250 Caracteres</p>	
					</div>							
				</div>
				 <div class="form-check-inline">
					 <p for="end" class="col-sm-5 form-check-label">¿Cuenta con Atención?</p>
					 <div class="col-sm-4">
						<input type="radio" class="form-check-input" name="respuesta_triage" id="si_triage" value="1">Sí
						<input type="radio" class="form-check-input" name="respuesta_triage" id="no_triage" value="1">No					
					 </div>	
					 <p for="end" class="col-sm-2 form-check-label">¿Asistira?</p>
					 <div class="col-sm-4">
						<input type="radio" class="form-check-input" name="asistira_triage" id="si_asistira_triage" value="1">Sí
						<input type="radio" class="form-check-input" name="asistira_triage" id="no_asistira_triage" value="1">No					
					 </div>						 
				 </div>					
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_triage" form="formulario_triage"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
			<button class="btn btn-primary ml-2" type="submit" id="edit_triage" form="formulario_triage"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Modificar</button>			
		</div>			
      </div>
    </div>
</div>
</div>
<!--FIN VENTANA MODALES-->
  <?php include("modals/modals.php"); ?>  
<!--FIN VENTANAS MODALES-->	

<?php include("templates/menu.php"); ?> 

<br><br><br>
<div class="container-fluid">
	<ol class="breadcrumb mt-2 mb-4">
		<li class="breadcrumb-item"><a class="breadcrumb-link" href="inicio.php">Dashboard</a></li>
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Agenda</li>
	</ol>

    <form class="form-inline" id="form_agenda_main">		
	  <div class="form-group mr-1">
		   <select id="servicio" name="servicio" class="custom-select" style="width:150px;" data-toggle="tooltip" data-placement="top" title="Servicio"> 				   
			   <option value="">Servicio</option>
		   </select>	 	  
      </div>
	  <div class="form-group mr-1">
		   <select id="unidad" name="unidad" class="custom-select" style="width:150px;" data-toggle="tooltip" data-placement="top" title="Unidadad"> 
			   <option value="">Unidad</option>
		   </select>	   
      </div>	  
	  <div class="form-group mr-1">
		   <select id="medico_general" name="medico_general" class="custom-select" style="width:150px;" data-toggle="tooltip" data-placement="top" title="Profesional"> 
		   	     <option value="">Profesional</option>
		   </select>   
      </div>	
	  <div class="form-group mr-1">
		   <input type="date" required="required" id="fecha" name="fecha" style="width:165px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/>  
      </div>	
	  <div class="form-group mr-1">
			<input type="date" required="required" id="fechaf" name="fechaf" style="width:165px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/>  
      </div>		  
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar por: Expediente, Nombre o Identidad" id="bs-regis" data-toggle="tooltip" data-placement="top" title="Buscar por: Expediente, Nombre o Identidad" autofocus class="form-control" size="25"/>
      </div>
      <div class="form-group mr-1">
		   <select id="atencion" name="atencion" class="custom-select" style="width:130px;" data-toggle="tooltip" data-placement="top" title="Atención"> 
			   	<option value="">Seleccione</option>
		   </select>
      </div>	  
	  <div class="form-group">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Exportar">
		  <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-download fa-lg"></i> Exportar
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
		  	<a class="dropdown-item" href="#" id="send_sms">Enviar SMS</a>
			<div class="dropdown-divider"></div>
		 	<a class="dropdown-item" href="#" id="reporte">Reporte</a>
			<a class="dropdown-item" href="#" id="Reporte_Agenda">Reporte Agenda</a>	
			<a class="dropdown-item" href="#" id="agenda_triage">Triage - Agenda</a>
			<a class="dropdown-item" href="#" id="agenda_usuarios">Agenda Diaria</a>
			<a class="dropdown-item" href="#" id="confirmacion_agenda">Confirmación Agenda</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#" id="limpiar">Limpiar</a>			
		  </div>
		</div>		  
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
	<?php include("templates/footer.php"); ?>
</div>	  

    <!-- add javascripts -->
	<?php 
		include "script.php"; 
		
		include "../js/main.php"; 
		include "../js/myjava_agenda_pacientes.php"; 
		include "../js/sms.php";
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?> 
</body>
</html>