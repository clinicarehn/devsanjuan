<?php
session_start(); 
include('../php/funtions.php'); 

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Colaboradores";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Colaboradores", MB_CASE_TITLE, "UTF-8");   

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
    <title>Colaboradores :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>	
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?> 
<!--INICIO MODAL PARA EL INGRESO DE PACIENTES-->
<div class="modal fade" id="registrar_colaboradores">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registra o Edita un Colaborador</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_colaboradores">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required="required" readonly id="id-registro" name="id-registro" class="form-control"/>
					  <input type="text" required="required" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="expediente">Nombre</label>
					  <input type="text" required name="nombre" id="nombre" maxlength="100" class="form-control"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Apellido</label>
					  <input type="text" required name="apellido" id="apellido" maxlength="100" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label for="edad">Identidad</label>
					  <input type="text" required name="identidad" id="identidad" maxlength="100" class="form-control" title="Este número de Identidad debe estar exactamente igual al que se registro en Odoo en la ficha del Colaborador"/>
					</div>						
				</div>				
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="empresa">Empresa</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="empresa" name="empresa" data-size="5" data-live-search="true" title="Empresa">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="puesto">Puesto</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="puesto" name="puesto" data-size="5" data-live-search="true" title="Puesto">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="puesto">Estado</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="estatus" name="estatus" data-size="5" data-live-search="true" title="Estado">			  
						</select>
						</div>
					</div>
				</div>					  
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_colaboradores" type="submit" id="reg_colaboradores"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		 <button class="btn btn-warning ml-2" form="formulario_colaboradores" type="submit" id="edit_colaboradores"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Editar</button>					 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar_puestos">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Puestos</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_puestos">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required="required" readonly id="id-registro" name="id-registro" class="form-control"/>
					  <input type="hidden" required="required" value="Registro" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" required name="puestosn" id="puestosn" placeholder="Puesto" maxlength="100" class="form-control" required />
					</div>						
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="registros overflow-auto" id="agrega-registros_puestos"></div>
					</div>
				</div>	
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<nav aria-label="Page navigation example">
							<ul class="pagination justify-content-center" id="pagination_puestos"></ul>
						</nav>
					</div>				
				</div>					
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_puestos" type="submit" id="reg_puestos_colaboradores"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>					 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar_servicios_colaboradores">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Servicio a Colaborador</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_servicios_colaboradores">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required="required" value="Registro" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="puesto_id">Puesto <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="puesto_id" name="puesto_id" required data-live-search="true" title="Puesto">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="colaborador_id">Colaborador <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="colaborador_id" name="colaborador_id" required data-live-search="true" title="Colaborador">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="servicio_colaborador">Servicio <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="servicio_colaborador" name="servicio_colaborador" required data-live-search="true" title="Servicio">			  
						</select>
						</div>
					</div>		
					<div class="col-md-3 mb-3">
						<label for="servicio_colaborador">Jornada <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="servicio_jornada_colaborador" name="servicio_jornada_colaborador" required data-live-search="true" title="Jornada">			  
						</select>
						</div>
					</div>								
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="nombre">Nuevos <span class="priority">*<span/></label>
						<input type="text" required name="cantidad_nuevos" id="cantidad_nuevos" placeholder="Nuevos" maxlength="100" class="form-control"/>
					</div>
					<div class="col-md-4 mb-3">
					  	<label for="nombre">Susiguientes <span class="priority">*<span/></label>
						<input type="text" required name="cantidad_subsiguientes" id="cantidad_subsiguientes" placeholder="Subisiguientes" maxlength="100" class="form-control"/>  
					</div>							
				</div>		
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="registros overflow-auto" id="agrega-registros_servicio_colaborador"></div>
					</div>
				</div>	
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<nav aria-label="Page navigation example">
							<ul class="pagination justify-content-center" id="pagination_servicio_colaborador"></ul>
						</nav>
					</div>				
				</div>					
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_servicios_colaboradores" type="submit" id="reg_jornada_servicios_colaboradores"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>				 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar_servicios">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Servicios</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_servicios">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" readonly id="id-registro" name="id-registro" class="form-control"/>
					  <input type="hidden" required="required" value="Registro" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" required name="servicios" id="servicios" placeholder="Servicios" maxlength="100" class="form-control" required />
					</div>						
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="registros overflow-auto" id="agrega-registros_servicios"></div>
					</div>
				</div>	
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<nav aria-label="Page navigation example">
							<ul class="pagination justify-content-center" id="pagination_servicios"></ul>
						</nav>
					</div>				
				</div>					
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_servicios" type="submit" id="reg_servicios_colaboradores"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>					 
	   </div>		
      </div>
    </div>
</div>	
<!--FIN MODAL PARA EL INGRESO DE PACIENTES-->
  <?php include("modals/modals.php"); ?>  
<!--FIN VENTANAS MODALES-->	

<?php include("templates/menu.php"); ?> 

<br><br><br>
<div class="container-fluid">
	<ol class="breadcrumb mt-2 mb-4">
		<li class="breadcrumb-item"><a class="breadcrumb-link" href="inicio.php">Dashboard</a></li>
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Colaboradores</li>
	</ol>

    <form class="form-inline" id="main_form">
		<div class="form-group mx-sm-3 mb-1">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>Estado</span>
					<select id="status" name="status" class="selectpicker" title="Estado" data-live-search="true">
					</select>
				</div>	
			</div>
		</div>	
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar por: Código, Nombre o Puesto" data-toggle="tooltip" data-placement="top" title="Buscar por: Código, Nombre o Puesto" id="bs-regis" autofocus class="form-control" size="50" autofocus />
      </div>
      <div class="form-group">
	    <button class="btn btn-primary ml-1" type="submit" id="nuevo-registro-colaboradores" data-toggle="tooltip" data-placement="top" title="Registrar Colaborador"><div class="sb-nav-link-icon"></div><i class="fas fa-plus-circle fa-lg"></i> Colaboradores</button>
      </div> 
      <div class="form-group">
	    <button class="btn btn-info ml-1" type="submit" id="nuevo-registro-puestos" data-toggle="tooltip" data-placement="top" title="Registrar Puestos"><div class="sb-nav-link-icon"></div><i class="fas fa-network-wired fa-lg"></i> Puestos</button>
      </div> 	
      <div class="form-group">
	    <button class="btn btn-warning ml-1" type="submit" id="nuevo-registro-servicios" data-toggle="tooltip" data-placement="top" title="Registrar Servicios"><div class="sb-nav-link-icon"></div><i class="fab fa-servicestack fa-lg"></i> Servicios</button>
      </div> 	
      <div class="form-group">
	    <button class="btn btn-danger ml-1" type="submit" id="nuevo-registro-colaborador-servicios" data-toggle="tooltip" data-placement="top" title="Registrar Jornada de Trabajo a Colaboradores"><div class="sb-nav-link-icon"></div><i class="fas fa-people-carry fa-lg"></i> Jornada</button>
      </div> 		  	  
      <div class="form-group">
	    <button class="btn btn-success ml-1" type="submit" id="reporte_excel" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i> Exportar</button>
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
		include "../js/myjava_colaboradores.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?>   
</body>
</html>