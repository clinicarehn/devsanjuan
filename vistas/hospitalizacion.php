<?php
session_start(); 
include('../php/funtions.php'); 

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Hospitalizacion";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();	
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo Hospitalizacion", MB_CASE_TITLE, "UTF-8");   

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
    <title>Hospitalizacion :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>		
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?> 
<!--INICIO MODAL PARA EL INGRESO DE PACIENTES-->

<!--FIN MODAL PARA EL INGRESO DE PACIENTES-->
  <?php include("modals/modals.php"); ?>  
<!--FIN VENTANAS MODALES-->	

<?php include("templates/menu.php"); ?> 

<!--INICIO MODAL PARA EL INGRESO DE LA HOSPITALIZACION-->
<div class="modal fade" id="agregar_hospitalizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-content-centered" role="document">
	<div class="modal-content">
	<form class="form-horizontal" id="formulario_agregar_hospitalizacion">
	
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Hospitalización</h4>
	  </div>
			 
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs">
		 <li class="active"><a data-toggle="tab" href="#home">Hospitalización</a></li>
		 <li><a data-toggle="tab" href="#menu1">Transito</a></li>
		 <li><a data-toggle="tab" href="#menu2">Referencias</a></li>
		 <li><a data-toggle="tab" href="#recetas"><label id="label_titulo_recetas" style="font-weight: normal;"></label></a></li>
	 </ul>		

<div class="tab-content"><!--Inicio TAB Panel-->

  <div id="home" class="tab-pane active fade in"><!--Inicio TAB Hospitalizacion-->
			<div class="modal-body">	                                        
			<div class="form-group">
				 <p for="end" class="col-sm-1 control-label">Proceso</p>
				 <div class="col-sm-11">
					<input type="text" required="required" readonly id="id-registro" name="id-registro" readonly="readonly" style="display: none;"/>
					<input type="text" required="required" readonly id="historial_id" name="historial_id" readonly="readonly" style="display: none;"/>
					<input type="text" required="required" readonly id="servicio" name="servicio" readonly="readonly" style="display: none;"/>
					<input type="text" required="required" readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
				 </div>				
			 </div>
							 
			<div class="form-group">
				 <p for="end" class="col-sm-1 control-label">Expediente</p>
				 <div class="col-sm-3">
					<input type="number" required="required" readonly id="expediente" name="expediente" placeholder="Expediente o Identidad" style="display: none;" class="form-control"/>
					<input type="number" required="required" readonly id="expediente1" name="expediente1" placeholder="Expediente o Identidad" style="display: none;" class="form-control"/>
				 </div>								 
				 <p class="col-sm-1 control-label">Fecha</p>					
				 <div class="col-sm-3">
				   <input type="date" required="required" id="fecha" name="fecha" readonly value="<?php echo date ("Y-m-d");?>" class="form-control"/>
				 </div>						 
				 <p for="end" class="col-sm-1 control-label">Paciente</p>
				 <div class="col-sm-3">
					<input type="text" required="required" id="paciente" name="paciente" class="form-control"/>
				 </div>							 
			 </div>	
			 
			<div class="form-group">
				 <p for="end" class="col-sm-1 control-label">Nombre</p>
				 <div class="col-sm-11">
					<input type="text" required="required" readonly id="nombre" name="nombre" class="form-control"/>
				 </div>							 
			 </div>		

		  <div class="form-group">
			<p for="parentesco" class="col-sm-1 control-label">Patología</p>
			<div class="col-sm-3">
			   <select id="patologia1" name="patologia1" required="required" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="5" data-live-search="true" title="Patología1">
				  <optgroup label="Patología1">	
					  </optgroup>   				   
				   </select>					
			</div>
			<p for="parentesco" class="col-sm-1 control-label">Patología</p>
			<div class="col-sm-3">
			  <select id="patologia2" name="patologia2" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="5" data-live-search="true" title="Patología2">
				  <optgroup label="Patología2">
					  </optgroup>   				   
				   </select>					   
			</div>
			<p for="parentesco" class="col-sm-1 control-label">Patología</p>
			<div class="col-sm-3">
			  <select id="patologia3" name="patologia3" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="5" data-live-search="true" title="Patología3">
				  <optgroup label="Patología3">	
					  </optgroup>   				   
				   </select>					   
			</div>					
		  </div>						 				 

			<div class="form-group">
				 <p for="end" class="col-sm-1 control-label">Obsv.</p>
				 <div class="col-sm-11">
					<input type="text" id="observaciones" name="observaciones" placeholder="Obsevaciones" class="form-control"/>
				 </div>						 
			 </div>	

			<div class="form-group">
			   <p for="ihss" class="col-sm-1 control-label">IHSS</p>
			   <div class="col-sm-3">
				 <select id="ihss" name="ihss" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Asegurado">  				   
				 </select>					
			   </div>	
			   <p for="enfermedad" class="col-sm-1 control-label">Enferm.</p>
			   <div class="col-sm-3">
				   <select id="enfermedad" name="enfermedad" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Enfermedad">  				   
				   </select>					
			   </div>	
			   <p for="end" class="col-sm-1 control-label" id="servicio_grupo_label">Servicio</p>
			   <div class="col-sm-3" id="servicio_grupo">
				  <select id="servicio_consulta" name="servicio_consulta" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Servicio">   				   		 
				  </select>	
			   </div>						   
			</div>					
			
			<div class="form-group" id="group_alta">
				 <div class="col-sm-4">
				  <p for="end" class="col-sm-1 control-label"></p>
				  <input type="radio" name="alta" id="alta_medica" value="1"> <label id="label_altamedica" style="font-weight: normal;"></label>						  
				  <input type="radio" name="alta" id="alta_exigida" value="2" checked="checked"> <label id="label_altaexigida" style="font-weight: normal;"></label>						
				 </div>
				 <p for="end" class="col-sm-2 control-label" id="suicida_label"></p>		
				 <div class="col-sm-2">
					 <input type="radio" name="suicida" id="suicida_si" value="1"> <label id="label_suicida_si" style="font-weight: normal;"></label>						  
					 <input type="radio" name="suicida" id="suicida_no" value="2" checked> <label id="label_suicida_no" style="font-weight: normal;"></label>						 
				 </div>							 
				 <div class="col-sm-4">
				  <p title="Permite actualizar el último diagnostico, siempre y cuando ya ha sido confirmado por el profesional."><input type="checkbox" name="diagnostico_ultimo" id="diagnostico_ultimo" value="1">
				  <label id="label_actualizar_diagnostico" style="font-weight: normal;"></label></p>							
				 </div>					  
			 </div>	

			<div class="form-group">						 
				 <p for="end" class="col-sm-2 control-label" id="cronico_label"></p>
				 <div class="col-sm-2">
					<input type="radio" name="cronico1" id="cronico_si" value="1"> <label id="label_cronico_si" style="font-weight: normal;"></label>						  
					<input type="radio" name="cronico1" id="cronico_no" value="2" checked> <label id="label_cronico_no" style="font-weight: normal;"></label>
				 </div>					  
		   </div>						   
	   </div>
			
  </div><!--Fin TAB Hospitalizacion-->
  
  <div id="menu1" class="tab-pane fade in"><!--Inicio TAB Transito-->
   <div class="modal-body"><!--Inicio Body-->
		  
	  <div class="form-group" >
		<p for="transito_servicio_recibida" class="col-sm-1 control-label">Recibida</p>					
		  <div class="col-sm-3">
			  <select id="transito_servicio_recibida" name="transito_servicio_recibida" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Recibida de">   				   
			  </select>					  
		 </div>	
		<p for="transito_unidad_recibida" class="col-sm-1 control-label">Unidad</p>					
		  <div class="col-sm-3">
			  <select id="transito_unidad_recibida" name="transito_unidad_recibida" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Recibida de">   				   
			  </select>					  
		 </div>	
		<p for="transito_profesional_recibida" class="col-sm-1 control-label">Profesional</p>					
		  <div class="col-sm-3">
			  <select id="transito_profesional_recibida" name="transito_profesional_recibida" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Profesional">   				   
			  </select>					  
		 </div>					 
	 </div>
	 
	  <div class="form-group">				  
		 <p for="transito_motivo_recibida" class="col-sm-1 control-label">Motivo</p>
		 <div class="col-sm-11">
			<input type="text" name="transito_motivo_recibida" id="transito_motivo_recibida" maxlength="100" placeholder="Motivo Transito Recibido" class="form-control"/>
		 </div>						 
	 </div>
	 
	 <hr/>
	  <div class="form-group" >
		<p for="transito_servicio_enviada" class="col-sm-1 control-label">Enviada</p>					
		  <div class="col-sm-3">
			  <select id="transito_servicio_enviada" name="transito_servicio_enviada" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Enviada a">   				   
			  </select>					  
		 </div>	
		<p for="transito_unidad_enviada" class="col-sm-1 control-label">Unidad</p>					
		  <div class="col-sm-3">
			  <select id="transito_unidad_enviada" name="transito_unidad_enviada" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Enviada a">   				   
			  </select>					  
		 </div>					 
		<p for="transito_profesional_enviada" class="col-sm-1 control-label">Profesional</p>					
		  <div class="col-sm-3">
			  <select id="transito_profesional_enviada" name="transito_profesional_enviada" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Enviada a">   				   
			  </select>					  
		 </div>							 
	 </div>	

	  <div class="form-group">
		<p class="col-sm-1 control-label">Tipo Atención</p>
		  <div class="col-sm-2">
			<select id="tipo_atencion_enviadas" name="tipo_atencion_enviadas" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Tipo de Atención">  				   
			</select>	
		  </div>			  
		 <p for="transito_motivo_enviada" class="col-sm-1 control-label">Motivo</p>
		 <div class="col-sm-8">
			<input type="text" name="transito_motivo_enviada" id="transito_motivo_enviada" maxlength="100" placeholder="Motivo Transito Enviada" class="form-control"/>
		 </div>						 
	 </div>				 
	  
   </div><!--Fin Body-->		  
  </div><!--Fin TAB Transito-->		  
  
  <div id="menu2" class="tab-pane fade in"><!--Inicio TAB Referencias-->
   <div class="modal-body"><!--Inicio Body-->
		  <!--REFERENCIAS RECIBIDAS-->
		  <div class="form-group">
		  <p for="telefonoresp2" class="col-sm-1 control-label">Niveles</p>
			<div class="col-sm-3">
			   <select id="nivel" name="nivel" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Niveles"> 				   
			   </select>					
			</div>		
		  <p for="telefonoresp2" class="col-sm-1 control-label">Centro</p>
			<div class="col-sm-3">
			   <select id="centro" name="centro" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Centro">  				   
			   </select>					
			</div>
			<p for="telefonoresp2" class="col-sm-1 control-label">Recibida</p>					
			<div class="col-sm-3">
			   <select id="centroi" name="centroi" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Recibida de">   				   
			   </select>						                       
			</div>					
		  </div>				  

		  <div class="form-group">	
			<p for="nombres" class="col-sm-1 control-label">Clínico</p>					
			<div class="col-sm-3">
			  <input type="text" name="clinico" id="clinico" class="form-control" title="Diagnostico Clínico" placeholder="Diagnostico Clínico" class="form-control"/>
			</div>					  
			<p for="nombres" class="col-sm-1 control-label">Motivo</p>					
			<div class="col-sm-3">
				<select id="motivo" name="motivo" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Motivo Traslado">   				   
				</select>						  
			</div>		
			<p for="nombres" class="col-sm-1 control-label">Motivo</p>					
			<div class="col-sm-3">
			  <select id="motivo_e" name="motivo_e" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Otro Motivo">   				   
			  </select>						  
			</div>					
		  </div>
		  <hr/>	
		  
		  <!--REFERENCIAS ENVIADAS-->
		  <div class="form-group">
		  <p for="telefonoresp2" class="col-sm-1 control-label">Niveles</p>
			<div class="col-sm-3">
			   <select id="nivel_e" name="nivel_e" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Niveles"> 				   
			   </select>					
			</div>		
		  <p for="telefonoresp2" class="col-sm-1 control-label">Centro</p>
			<div class="col-sm-3">
			   <select id="centro_e" name="centro_e" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Centro">  				   
			   </select>					
			</div>
			<p for="telefonoresp2" class="col-sm-1 control-label">Enviada</p>					
			<div class="col-sm-3">
			   <select id="centroi_e" name="centroi_e" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Enviada a">   				   
			   </select>						                       
			</div>					
		  </div>

		  <div class="form-group">				  
			<p for="diagnostico" class="col-sm-1 control-label">Diagnostico</p>					
			<div class="col-sm-3">
			  <input type="text" name="diagnostico_clinico" id="diagnostico_clinico" class="form-control" title="Motivo de la referencia" placeholder="Diagnostico Clínico" class="form-control"/>
			</div>	
			<p for="telefonoresp2" class="col-sm-1 control-label">Motivo</p>
			<div class="col-sm-3">
				 <select id="motivo_traslado" name="motivo_traslado" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Motivo de Traslado"> 				   
				 </select>					
			</div>						
			<p for="nombres" class="col-sm-1 control-label">Otro</p>					
			<div class="col-sm-3">
			  <select id="motivo_e1" name="motivo_e1" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Otro Motivo">   				   
			  </select>	
			</div>					
		  </div>	
   </div><!--Fin Body-->		  
  </div><!--Fin TAB Referencias-->	 
  
</div>
  
	 <div class="form-group">
		<div class="col-sm-12">
			<div id="mensaje"></div>
		</div>
	 </div>			  
	 
	  <div class="modal-footer">
		 <button type="submit" id="reg" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
		 <button type="submit" id="edi" class="btn btn-primary" title="Guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
		 <button type="clean" id="clean" class="btn btn-warning" title="Limpiar"><span class="glyphicon glyphicon glyphicon-trash"></span> Limpiar</button>
	  </div>
	</form>
	</div>
  </div>
</div>	

<br><br><br>
<div class="container-fluid">
	<ol class="breadcrumb mt-2 mb-4">
		<li class="breadcrumb-item"><a class="breadcrumb-link" href="inicio.php">Dashboard</a></li>
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Hospitalizacion</li>
	</ol>

    <form class="form-inline" id="form_main">
		<div class="form-group mx-sm-3 mb-1">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>Atención</span>
					<select id="estado_atencion" name="estado_atencion" class="selectpicker" title="Atención" data-live-search="true">
					</select>
				</div>	
			</div>
		</div>
		<div class="form-group mx-sm-3 mb-1">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>Sala</span>
					<select id="sala" name="sala" class="selectpicker" title="Sala" data-live-search="true">
					</select>
				</div>	
			</div>
		</div>
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
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Inicio</span>
			</div>
		    <input type="date" required="required" id="fecha_b" name="fecha_b" style="width:160px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/>  		
		</div>
      </div>	
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fin</span>
			</div>
			<input type="date" required="required" id="fecha_f" name="fecha_f" style="width:160px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/>  		
		</div> 
      </div>		  
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar Registro" data-toggle="tooltip" data-placement="top" title="Buscar por: Expediente, Nombre, Apellido o Identidad" id="bs-regis" autofocus class="form-control" size="20" autofocus />
      </div>
	  <div class="form-group">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-user-plus fa-lg"></i> Crear
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="nuevo-registro">ATA Usuarios</a>
			<a class="dropdown-item" href="#" id="nuevo_registro_familiares">ATA Familiares</a>			
		  </div>
		</div>		  
	  </div> 	  
      <div class="form-group">
	    <button class="btn btn-success ml-1" type="submit" id="historial" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i> Exportar</button>
      </div>	
      <div class="form-group" style="display: none;">
	     <button class="btn btn-danger ml-1" type="submit" id="limpiar" data-toggle="tooltip" data-placement="top" title="Limpiar"><div class="sb-nav-link-icon"></div><i class="fas fa-broom fa-lg"></i></button>		 
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
		include "../js/myjava_hospitalizacion.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?> 
</body>
</html>