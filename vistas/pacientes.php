<?php
session_start(); 
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Pacientes";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Pacientes", MB_CASE_TITLE, "UTF-8");   

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
    <title>Pacientes :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>   		
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?> 

<div class="modal fade" id="mensaje_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Información Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form id="mensaje_sistema">		
				<div class="form-row">
					<div class="col-md-12 mb-3">
					   <div class="modal-title" id="mensaje_mensaje_show"></div>
					</div>					
				</div>				
			</form>
      </div>
	  <div class="modal-footer">
		<button class="btn btn-success ml-2" type="submit" id="okay" data-dismiss="modal"><div class="sb-nav-link-icon"></div><i class="fas fa-thumbs-up fa-lg"></i> Okay</button>	
		<button class="btn btn-danger ml-2" type="submit" id="bad" data-dismiss="modal"><div class="sb-nav-link-icon"></div><i class="fas fa-thumbs-up fa-lg"></i> Okay</button>				
	  </div>	  
    </div>
  </div>
</div>

<div class="modal fade" id="agregar_expediente_manual">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Identidad y/o Expediente a Paciente</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_expediente_manual">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required readonly id="id-registro" name="id-registro" class="form-control"/>
					  <input type="hidden" required readonly id="pacientes_id" name="pacientes_id" class="form-control"/>
					  <input type="text" required readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row" id="grupo_expediente">
					<div class="col-md-6 mb-3">
					  <label for="expediente">Nombre</label>
					  <input type="text" required readonly id="name_manual" name="name_manual" class="form-control" readonly />
					</div>
					<div class="col-md-6 mb-3">
					  <label for="edad">Edad</label>
					  <input type="text" required class="form-control" name="edad_manual" id="edad_manual" maxlength="100" readonly />
					</div>				
				</div>				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="nombre">Expediente </label>
					  <input type="text" class="form-control" id="expediente_usuario_manual" name="expediente_usuario_manual" autofocus placeholder="Expediente" maxlength="100"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="apellido">Identidad </label>
					  <input type="text" class="form-control" name="identidad_ususario_manual" autofocus placeholder="Identidad" id="identidad_ususario_manual" maxlength="100"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="fecha">Fecha</label>
					  <input type="date" class="form-control" name="fecha_re_manual" id="fecha_re_manual" value="<?php echo date ("Y-m-d");?>" maxlength="100"/>
					</div>					
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="sexo">Expediente </label>
					  <input type="text" name="expediente_manual" class="form-control" id="expediente_manual" maxlength="100" value = "0" readonly />
					</div>
					<div class="col-md-4 mb-3">
					  <label for="telefono">Identidad </label>
					  <input type="number" name="identidad_manual" class="form-control" id="identidad_manual" maxlength="100" value = "0" readonly />
					</div>

					<div class="col-md-4 mb-3">
						<label for="sexo_manual">Sexo <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
							<select class="selectpicker" id="sexo_manual" name="sexo_manual" data-live-search="true" title="Sexo">			  
							</select>
						</div>
					</div>				
				</div>					
				 <div class="form-check-inline">
					 <p for="end" class="col-sm-9 form-check-label">¿Desea convertir usuario en temporal?</p>
					 <div class="col-sm-5">
						<input type="radio" class="form-check-input" name="respuesta" id="respuestasi" value="1"> Sí
						<input type="radio" class="form-check-input" name="respuesta" id="respuestano" value = "2" checked> No	
					 </div>					 
				 </div>						  
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_expediente_manual" type="submit" id="reg_manual"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		 <button class="btn btn-warning ml-2" form="formulario_agregar_expediente_manual" type="submit" id="convertir_manual"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Convertir</button>					 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar_profesionales">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Profesiones</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_profesionales" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row" id="grupo_expediente">
					<div class="col-md-12 mb-3">
					  <input type="text" required="required" id="profesionales_buscar" name="profesionales_buscar" class="form-control" placeholder="Buscar por: Profesionales" id="centros_buscar" maxlength="100"/>
					</div>			
				</div>				
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<nav aria-label="Page navigation example">
							<ul class="pagination" id="agrega_registros_profesionales"></ul>
						</nav>					  
					</div>				
				</div>	
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <center><ul class="pagination justify-content-center" id="pagination_profesionales"></ul></center>
					</div>					
				</div>		  
			</form>
        </div>
	    <div class="modal-footer">
		 <button class="btn btn-primary ml-2" type="submit" id="reg_profesionales" form="formulario_profesionales"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>					 
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
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Pacientes</li>
	</ol>

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
		<div class="form-group mx-sm-3 mb-1">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>Tipo</span>
					<select id="tipo" name="tipo" class="selectpicker" title="Tipo" data-live-search="true">
					</select>
				</div>	
			</div>
		</div>			  
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar por: Expediente, Nombre, Identidad o Teléfono Principal" data-toggle="tooltip" data-placement="top" title="Buscar por: Expediente, Nombre, Apellido, Identidad o Teléfono Principal" id="bs-regis" autofocus class="form-control" size="60" autofocus />
      </div>
	  <div class="form-group">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-user-plus fa-lg"></i> Crear
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="nuevo-registro">Registro de Usuarios</a>
			<a class="dropdown-item" href="#" id="profesion">Registro de Profesiones</a>		
		  </div>
		</div>		  
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
		include "../js/myjava_pacientes.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?>
</body>
</html>