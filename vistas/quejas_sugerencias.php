<?php
session_start();
include('../php/funtions.php'); 

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Quejas y Sugerencias";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Quejas y Sugerencias", MB_CASE_TITLE, "UTF-8");   

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
    <title>Quejas y Sugerencias :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>		
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?>    

<!--INICIO MODAL-->
<div class="modal fade" id="mensaje_show">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Información Queja</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_mostrar_queja">
				<div class="modal-title" id="mensaje_mensaje_show"></div>							  
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-success ml-2" form="formulario_mostrar_queja" type="submit" id="okay_queja" data-dismiss="modal"><div class="sb-nav-link-icon"></div><i class="fas fa-thumbs-up fa-lg"></i> Okay</button>				 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="agregar_queja">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Quejas y Sugerencias</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_quejas">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="proceso">Proceso</label>
					  <input type="hidden" required="required" readonly id="id-registro" name="id-registro" />
					  <input type="text" required="required" readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente</label>
					 <input type="number" required="required" id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha</label>
				     <input type="date" required="required" id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Identidad</label>
					  <input type="text" required="required" readonly id="identidad" name="identidad"  placeholder="Identidad" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
						<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required="required" readonly="readonly">
					</div>					
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="form-check form-check-inline">
						  <label class="form-check-label">Gestión: </label>
						</div>
						
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="queja" name="gestion" value="1">
						  <label class="form-check-label" for="queja">Queja</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="suge" name="gestion" value="2">
						  <label class="form-check-label" for="suge">Sugerencia</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="feli" name="gestion" value="3">
						  <label class="form-check-label" for="feli">Felicitación</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="recl" name="gestion" value="4">
						  <label class="form-check-label" for="recl">Reclamo</label>
						</div>
						<div class="form-check form-check-inline">
						  <label class="form-check-label">Seguimiento: </label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="seg_si" name="seguimiento" value="1">
						  <label class="form-check-label" for="queja">Sí</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="seg_no" name="seguimiento" value="2">
						  <label class="form-check-label" for="suge">No</label>
						</div>	
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="form-check form-check-inline">
						  <label class="form-check-label">Tipo: </label>
						</div>
						
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="calidez" name="calidez" value="1">
						  <label class="form-check-label" for="queja">Calidez</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="competencia" name="competencia" value="1">
						  <label class="form-check-label" for="competencia">Comptenencia</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="estructura" name="estructura" value="1">
						  <label class="form-check-label" for="estructura">Estructura</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="organizacion" name="organizacion" value="1">
						  <label class="form-check-label" for="organizacion">Organización</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="otros" name="otros" value="1">
						  <label class="form-check-label" for="otros">Otros</label>
						</div>	
						<div class="form-check form-check-inline">
							<input type="hidden" required="required" id="otro_detalle" name="otro_detalle" placeholder="Especifique" class="form-control"/>
						</div>							
					</div>
				</div>				
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="form-check form-check-inline">
						  <label class="form-check-label">Incidente: </label>
						</div>					
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="incidente_oral" name="incidente" value="1">
						  <label class="form-check-label" for="incidente_oral">Oral</label>						  
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="incidente_escrito" name="incidente" value="2">
						  <label class="form-check-label" for="incidente_escrito">Escrito</label>						  
						</div>
						<div class="form-check form-check-inline">
						   <label class="form-check-label mr-1 mb-3" for="servicio">Servicio </label>
						  <div class="input-group mb-3">
							  <select id="servicio" name="servicio" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio">
								<option value="">Seleccione</option>
							  </select>
							  <div class="input-group-append" id="buscar_servicios_quejas">				
								<a data-toggle="modal" href="#" class="btn btn-outline-success" id="servicio_boton"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
							  </div>
						   </div>					  
						</div>						
					</div>							
				</div>

				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Descripción</label>
					   <textarea id="queja" name="queja" required placeholder="Descripción de la Queja" class="form-control" maxlength="250" rows="3"></textarea>
						<p id="charNum_queja">255 Caracteres</p>
					</div>					
				</div>	

				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Descripción</label>
				      <textarea id="queja1" name="queja1" required placeholder="Descripción de la Queja" class="form-control" maxlength="250" rows="3"></textarea>	
						<p id="charNum_queja1">255 Caracteres</p>
					</div>					
				</div>					
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_quejas" type="submit" id="reg_quejas"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>				 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="eliminar_queja">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Quejas y Sugerencias</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="form_eliminar_queja">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" id="queja_id" name="queja_id" class="form-control" id="id" required="required">	
					  <input type="hidden" id="pacientes_id" name="pacientes_id" class="form-control" id="id" required="required">	
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					 <input type="text" required="required" id="usuario" name="usuario" placeholder="Paciente" readonly class="form-control"/>
					</div>					
				</div>

				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Comentario</label>
					 <input type="text" required="required" id="Comentario" name="Comentario" placeholder="Comentario" class="form-control"/>
					</div>					
				</div>	
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-danger ml-2" form="form_eliminar_queja" type="submit" id="eliminar"><div class="sb-nav-link-icon"></div><i class="fas fa-trash fa-lg"></i> Elimnar</button>				 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="seguimiento_queja">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Quejas y Sugerencias</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="form_seguimiento_queja">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
				    <input type="hidden" id="queja_id" name="queja_id" class="form-control" id="id" required="required">	
				    <input type="hidden" id="pacientes_id" name="pacientes_id" class="form-control" id="id" required="required">	
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					 <input type="text" required="required" id="usuario" name="usuario" placeholder="Paciente" readonly class="form-control"/>
					</div>					
				</div>

				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Seguimiento</label>
					  <textarea id="seguimiento" name="seguimiento" required placeholder="Seguimiento de la Queja" class="form-control" maxlength="250" rows="3"></textarea>	
			          <p id="charNum_seguimiento">255 Caracteres</p>	
					</div>					
				</div>

				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="checkbox" id="resuelta" name="resuelta" value="1">
				  <label class="form-check-label" for="resuelta">Resuelta</label>
				</div>				
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-warning ml-2" form="form_seguimiento_queja" type="submit" id="reg"><div class="sb-nav-link-icon"></div><i class="fas fa-trash fa-lg"></i> Registrar</button>				 
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
		<li class="breadcrumb-item"><a class="breadcrumb-link" href="inicio.php">Dashboard</a></li>
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Quejas y Sugerencias</li>
	</ol>
	
    <form class="form-inline" id="form_main">	
	<div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Servicio</span>
			</div>
			<select id="servicio" name="servicio" class="custom-select" style="width:160px;" data-toggle="tooltip" data-placement="top" title="Servicio">
				<option value="">Servicio</option>
			</select>	
		</div>	   
      </div>	
	  <div class="form-group mr-1">	   
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fecha Inicio</span>
			</div>
			<input type="date" required="required" id="fecha_b" name="fecha_b" style="width:163px;" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
		</div>			
      </div>
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fecha Inicio</span>
			</div>
			<input type="date" required="required" id="fecha_f" name="fecha_f" style="width:163px;" value="<?php echo date ("Y-m-d");?>" class="form-control"/>	   
		</div>		         
      </div>	  
      <div class="form-group mr-1">
		<input type="text" placeholder="Buscar por: Expediente, Nombre o Identidad" id="bs_regis" title="Buscar por: Expediente, Nombre, Apellido o Identidad" autofocus class="form-control" size="37"/>
      </div>	   	  
      <div class="form-group">
	    <button class="btn btn-primary ml-1" type="submit" id="nuevo_registro" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-plus-circle fa-lg"></i> Crear</button>
      </div>
      <div class="form-group">
	    <button class="btn btn-success ml-1" type="submit" id="reporte" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i> Exportar</button>
      </div>	
      <div class="form-group">
	     <button class="btn btn-danger ml-1" type="submit" id="limpiar" data-toggle="tooltip" data-placement="top" title="Limpiar"><div class="sb-nav-link-icon"></div><i class="fas fa-broom fa-lg"></i> Limpiar</button>		 
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
		include "../js/myjava_quejas_sugerencias.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?>   
</body>
</html>