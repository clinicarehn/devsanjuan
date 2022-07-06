<?php
session_start(); 
include('../php/funtions.php');   

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Camas";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Camas", MB_CASE_TITLE, "UTF-8");   

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
    <title>Camas :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?> 		
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?>    

<!--INICIO MODAL-->
<div class="modal fade" id="agregar_camas">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Ingreso de Camas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_camas">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="proceso">Proceso</label>
					  <input type="hidden" required="required" readonly id="id-registro" name="id-registro" readonly="readonly"/>
					  <input type="text" required="required" readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				<div class="form-row" id="grupo_expediente">
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
					  <input type="text" required="required" readonly id="identidad" name="identidad" class="form-control"/>
					</div>						
				</div>				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre </label>
					  <input type="text" required="required" readonly id="nombre" name="nombre" class="form-control"/>
					</div>					
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Sala </label>
					  <select id="sala" name="sala" class="form-control" data-toggle="tooltip" data-placement="top" title="Sala">   				   
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label>Cama </label>
					  <select id="cama" name="cama" class="form-control" data-toggle="tooltip" data-placement="top" title="Cama">   				   
				      </select>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Observación </label>
					  <input type="text" required="required" id="observaciones" name="observaciones" placeholder="Obsevaciones" class="form-control"/>   				   
					</div>				
				</div>				  
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_camas" type="submit" id="reg_camas"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		 <button class="btn btn-warning ml-2" form="formulario_agregar_camas" type="submit" id="edit_camas"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Modificar</button>					 
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
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Camas</li>
	</ol>
	
    <form class="form-inline" id="form_main">	
	<div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Sala</span>
			</div>
			<select id="sala" name="sala" class="custom-select" style="width:120px;" data-toggle="tooltip" data-placement="top"  title="Sala">
				<option value="">Sala</option>
			</select>	
		</div>	   
      </div>	
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Estado</span>
			</div>
			<select id="estado" name="estado" class="custom-select" style="width:120px;" data-toggle="tooltip" data-placement="top" title="Estado">
				<option value="">Estado</option>
			</select>	
		</div>	   
      </div>
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Unidad</span>
			</div>
			<select id="unidad" name="unidad" class="custom-select" style="width:130px;" data-toggle="tooltip" data-placement="top" title="Unidad">
				<option value="">Unidad</option>
			</select>
		</div>		   
      </div>	  
      <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Inicio</span>
			</div>
			<input type="date" required="required" id="fecha_b" name="fecha_b" style="width:160px;" value="<?php echo date ("Y-m-d");?>" class="form-control input-sm"/>
		</div>	           
      </div>
      <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fin</span>
			</div>
			<input type="date" required="required" id="fecha_f" name="fecha_f" style="width:160px;" value="<?php echo date ("Y-m-d");?>" class="form-control input-sm"/>
		</div>         
      </div>
      <div class="form-group mr-1">
		<input type="text" placeholder="Buscar Registros" id="bs-regis" title="Buscar por: Expediente, Nombre, Apellido o Identidad" autofocus class="form-control input-sm"/>
      </div>	  
	  <div class="form-group">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-plus-circle fa-lg"></i> Crear
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="asignar_camas">Asignar Cama</a>
			<a class="dropdown-item" href="#" id="crear_camas">Crear Cama</a>
			<a class="dropdown-item" href="#" id="crear_salas">Crear Sala</a>
		  </div>
		</div>		  
	  </div> 	  
      <div class="form-group">
	    <button class="btn btn-success ml-1" type="submit" id="reporte" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i> Exportar</button>
      </div>	
      <div class="form-group" style="display:none;">
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
		include "../js/myjava_camas.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?>   
</body>
</html>