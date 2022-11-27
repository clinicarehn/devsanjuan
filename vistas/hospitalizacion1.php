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
$comentario = mb_convert_case("Ingreso al Modulo de Hospitalizacion", MB_CASE_TITLE, "UTF-8");   

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
    <meta charset="utf-8" />
    <meta name="author" content="KIREDS" />
    <meta name="description" content="Responsive Websites Orden Hospitalaria de San Juan de Dios">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Hospitalización :: <?php echo $empresa; ?></title>
    <!--Menu e Iconos-->   
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../css/error_bien.css" type="text/css" media="screen">		
    <link rel="stylesheet" href="../login/css/all.css"><!--//USO DE ICONOS font awesome-->   
    <link rel="shortcut icon" href="../img/logo1.png">
    <!--******************************************************************************-->
    <link href="../css/estilo-paginacion.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-select.css">
	<link href="../sweetalert/sweetalert.css" rel="stylesheet">		
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?>    
   
<!--Buscar Historial -->   
<div class="modal fade" id="buscarHistorial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-content-centered" role="document">
	<div class="modal-content">
	<form class="form-horizontal" id="form-buscarhistorial">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Historial de Usuarios</h4>
	  </div>
	  <div class="modal-body">
		  <div class="form-group">
			<div class="col-sm-12">
			  <input type="text" placeholder="Buscar por: Expediente, Paciente o Identidad" id="bs-regis-historial" autofocus class="form-control"/>					  
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-12">
			  <div class="registros" id="agrega-registros_historial"></div>
			</div>
			<center>	
			   <ul class="pagination" id="pagination_historial"></ul>
			</center>
		  </div>					  				  
	  </div>
	</form>
	</div>
  </div>
</div> 
		
<!--INICIO MOSTRAR INFORMACIÓN-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mensaje_show" data-keyboard="false">
 <div class="modal-dialog modal-lg modal-content-centered">
   <div class="modal-content">
	 <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Información</h4>
	 </div>
	 <div class="modal-body">
	   <p class="modal-title" id="mensaje_mensaje_show"></p>
	   <center>			
		<p>
		<div id ="salida" style="display: none;">
		</div>
		</p>
	   </center>
	 </div>
	 <div class="modal-footer">
		<button type="button" class="btn btn-primary" data-dismiss="modal" id="okay"><span class="glyphicon glyphicon-ok"></span> Okay</button>
		<button style="display: none;" type="button" class="btn btn-danger" data-dismiss="modal" id="bad"><span class="glyphicon glyphicon-ok"></span> Okay</button>
	 </div>		 
  </div>
  </div>
</div>     
<!--FIN MOSTRAR INFORMACIÓN-->
		
<!--INICIO MENSAJE-->   
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mensaje" data-keyboard="false">
 <div class="modal-dialog modal-sm modal-content-centered">
   <div class="modal-content">
	 <div class="modal-header">
		<h4 class="modal-title" id="mensaje_mensaje"></h4>
	 </div>
	 <div class="modal-body">
	   <center>
		<button type="button" class="btn btn-primary" data-dismiss="modal" id="okay"><span class="glyphicon glyphicon-ok"></span> Okay</button>
		<button style="display: none;" type="button" class="btn btn-danger" data-dismiss="modal" id="bad"><span class="glyphicon glyphicon-ok"></span> Okay</button>			
		<p>
		<div id ="salida" style="display: none;">
		</div>
		</p>
	   </center>
	 </div>
  </div>
  </div>
</div>   
<!--FIN MENSAJE--> 
  
<!-- MODAL TRANSFERIR -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="transferir"  data-keyboard="false">
 <div class="modal-dialog modal-sm modal-content-centered">
   <div class="modal-content">
	 <div class="modal-header">
		<h4 class="modal-title" id="myModalLabel"><center></center></h4>
		<input type="text" name="hosp_id" id="hosp_id" readonly style="display: none;"/>
		<input type="text" name="expediente" id="expediente" readonly style="display: none;"/>
		<input type="text" name="servicio_id" id="servicio_id" readonly style="display: none;"/>
	 </div>
	 <div class="modal-body">
	   <center>
		<button type="button" class="btn btn-primary" onClick="transferir();" id="Si" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ok"></span> Si</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" id="No"><span class="glyphicon glyphicon-remove-circle"></span> No</button>
		<p>
		<div id ="salida" style="display: none;">
		</div>
		</p>
	   </center>
	 </div>
  </div>
  </div>
</div>
   
<!--INICIO MODAL PARA EL INGRESO DE ATA DE FAMILIARES-->
<div class="modal fade" id="agregar_ata_familiares" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-content-centered" role="document">
	<div class="modal-content">
	<form class="form-horizontal" id="formulario_ata_familiares">
	
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Ingeso ATA Familiares</h4>
	  </div>
			 
	 <div class="modal-body">
			<div class="form-group">
				 <p for="end" class="col-sm-1 control-label">Proceso</p>
				 <div class="col-sm-11">
					<input type="text" required="required" readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
				 </div>				
			 </div>
							 
			<div class="form-group">
				 <p for="end" class="col-sm-1 control-label">Expediente</p>
				 <div class="col-sm-3">
					<input type="number" required="required" id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
				 </div>	
				 <p class="col-sm-1 control-label">Fecha</p>					
				 <div class="col-sm-3">
				   <input type="date" required="required" id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
				 </div>						 
				 <p for="end" class="col-sm-1 control-label">Paciente</p>
				 <div class="col-sm-3">
					<input type="text" required="required" readonly id="paciente" name="paciente" class="form-control"/>
				 </div>							 
			 </div>	
			 
			<div class="form-group">
				 <p for="end" class="col-sm-1 control-label">Nombre</p>
				 <div class="col-sm-11">
					<input type="text" required="required" readonly id="nombre" name="nombre" class="form-control"/>
				 </div>							 
		   </div>						 

		  <div class="form-group">
			   <p for="end" class="col-sm-1 control-label">Obs.</p>
			   <div class="col-sm-7">
				   <input type="text" required="required" id="obs" placeholder="Observaciones" name="obs" title="Observaciones" class="form-control"/>
			   </div>				  
			   <p class="col-sm-1 control-label" id="label_expediente">Servicio</p>					
			   <div class="col-sm-3">
				  <select id="servicio" name="servicio" class="selectpicker form-control form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Servicio">   				   
				  </select>	
			   </div>							   
		  </div>
	 </div> 

	 <div class="modal-body">								  
		 <div class="form-group">
		   <div class="col-sm-12">
				  <div id="mensaje"></div>
		   </div>
		 </div>						 
																
	 </div>
	 
	  <div class="modal-footer">
		 <button type="submit" id="reg" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>			     
	  </div>
	</form>
	</div>
  </div>
</div>	
<!--FIN MODAL PARA EL INGRESO ATA FAMILIARES-->    
   	
<!-- MODAL ALTA ABANDONO -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_alta"  data-keyboard="false">
 <div class="modal-dialog modal-sm modal-content-centered">
   <div class="modal-content">
	 <div class="modal-header">
		<h4 class="modal-title" id="myModalLabel"><center></center></h4>
		<input type="text" name="hosp_id" id="hosp_id" readonly style="display: none;"/>
		<input type="text" name="expediente" id="expediente" readonly style="display: none;"/>
		<input type="text" name="servicio_id" id="servicio_id" readonly style="display: none;"/>
	 </div>
	 <div class="modal-body">
	   <center>
		<button type="button" class="btn btn-primary" onClick="altaAbandono();" id="Si" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ok"></span> Si</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" id="No"><span class="glyphicon glyphicon-remove-circle"></span> No</button>
		<p>
		<div id ="salida" style="display: none;">
		</div>
		</p>
	   </center>
	 </div>
  </div>
  </div>
</div>   
   
<!-- Eliminar Rgistro -->
	<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
	  <div class="modal-dialog modal-content-centered" role="document">
		<div class="modal-content">
		<form class="form-horizontal" id="form_ausencia">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
			   <input type="text" name="dato" id="dato" readonly style="display: none;"/>
			   <p for="motivo" class="col-sm-1 control-label">Motivo</p>
				<div class="form-group">
					 <div class="col-sm-10">
						<input type="text" required id="motivo_ausencia" name="motivo_ausencia" class="form-control"/>
						<input type="text" name="hosp_id" id="hosp_id" readonly style="display: none;"/>
						<input type="text" name="expediente" id="expediente" readonly style="display: none;"/>
						<input type="text" name="servicio_id" id="servicio_id" readonly style="display: none;"/>							
					 </div>							 
			   </div>	
		  </div>	
		  <div class="modal-body">
				<div class="form-group">
					 <div class="col-sm-12">
						<div id ="salida"></div>
					 </div>							 
			   </div>	
			  
		  </div>				  
		  <div class="modal-footer">
			 <button type="button" class="btn btn-primary" id="Si" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ok"></span> Si</button>
			 <button type="button" class="btn btn-default" data-dismiss="modal" id="No"><span class="glyphicon glyphicon-remove-circle"></span> No</button>
		  </div>
		</form>
		</div>
	  </div>
</div> 	

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
		
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mensaje_expediente" data-keyboard="false">
 <div class="modal-dialog modal-sm">
   <div class="modal-content">
	 <div class="modal-header">
		<h4 class="modal-title" id="mensaje_mensaje"></h4>
	 </div>
	 <div class="modal-body">
	   <center>
		<button type="button" class="btn btn-primary" data-dismiss="modal" id="okay"><span class="glyphicon glyphicon-ok"></span> Okay</button>
		<button style="display: none;" type="button" class="btn btn-danger" data-dismiss="modal" id="bad"><span class="glyphicon glyphicon-ok"></span> Okay</button>			
		<p>
		<div id ="salida" style="display: none;">
		</div>
		</p>
	   </center>
	 </div>
  </div>
  </div>
</div> 
<!--FIN MODAL PARA EL INGRESO DE LA PRECLINICA-->	
<!--Fin Ventanas Modales-->

<!--MENU-->	  
   <?php include("templates/menu.php"); ?>
<!--FIN MENU--> 
	
<div class="container-fluid">
	<br><br><br>
	<ol class="breadcrumb mt-2 mb-4">
		 <li class="breadcrumb-item" id="acciones_atras"><a id="ancla_volver" class="breadcrumb-link" style="text-decoration: none;" href="#"><span id="label_acciones_volver">Hospitalización</a></li>
		  <li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_receta"></span></li>
	 </ol>
	 
    <form class="form-inline" id="form_main">
	  <div class="form-group">
         <select id="estado_atencion" name="estado_atencion" class="selectpicker" data-hide-disabled="true" data-size="10" data-live-search="true" title="Atención">   				   		 
         </select>	
      </div>	
      <div class="form-group">
         <select id="sala" name="sala" class="selectpicker" data-hide-disabled="true" data-size="10" data-live-search="true" title="Sala">   				   		 
         </select>	
      </div>
      <div class="form-group">
         <select id="estado" name="estado" class="selectpicker" data-hide-disabled="true" data-size="10" data-live-search="true" title="Estado">   				   		 
         </select>	
      </div>	  
      <div class="form-group">
        <input type="date" required="required" id="fecha_b" name="fecha_b" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
      </div>
      <div class="form-group">
        <input type="date" required="required" id="fecha_f" name="fecha_f" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
      </div>	  
      <div class="form-group">
		<input type="text" placeholder="Buscar por: Expediente, Nombre, Apellido o Identidad" title="Buscar por: Expediente, Nombre, Apellido o Identidad" id="bs-regis" autofocus class="form-control" size="30"/>
      </div>
      <div class="form-group">
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="fas fa-plus-circle fa-lg"></span>
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
			  <li class="dropdown-header">Agregar</li>
              <li><a title="Agrega las atenciones de los usuarios extemporaneos." href="#" id="nuevo-registro">ATA Usuarios</a></li>
			  <li><a title="Agrega las atenciones de los usuarios extemporaneos." href="#" id="nuevo_registro_familiares">ATA Familiares</a></li> 
            </ul>
          </div> 
      </div>	
      <div class="form-group">
       <a id="historial" name="historial" class="btn btn-success" class="form-control" title="Historial de Atenciones"><span class="fas fa-search fa-lg"></span></a>
      </div>
    <div class="form-group">
      <a target="_blank" href="#" id="limpiar" title="Limpiar" class="btn btn-danger"><span class="fas fa-broom fa-lg"></span></a>
    </div>	  
    </form>	

	<hr/>    
    <div class="form-group">
	  <div class="col-sm-14">
		<div class="registros" id="agrega-registros"></div>
	   </div>		   
	</div>
    <center>	
      <ul class="pagination" id="pagination"></ul>
    </center>

	<?php include("templates/footer.php"); ?>	
</div>

    <!-- add javascripts -->
    <script src="../js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap-select.js"></script>		
    <!--Función que permite hacer desplegable el menú-->
    <script src="../js/menu-despelgable.js"></script>
    <script src="../js/main.js"></script>	
   	<script src="../js/myjava_hospitalizacion.js"></script>
    <script src="../js/select.js"></script>	
    <script src="../js/session.js"></script>		
    <script src="../js/functions.js"></script>
	<script src="../js/myjava_cambiar_pass.js"></script>
	<script src="../js/session.js"></script>
	<script src="../sweetalert/sweetalert.min.js"></script>	
    <!--Boton volver al principio-->
    <script src="../js/arriba.js"></script>      
    <span class="ir-arriba" title="Ir Arriba"><i class="fas fa-chevron-up fa-xs"></i></span>    
</body>
</html>