<?php
session_start(); 
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Usuarios del Sistema";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();	
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Usuarios del Sistema", MB_CASE_TITLE, "UTF-8");   

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
    <title>Usuarios del Sistema :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>	
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?> 
<!--INICIO MODAL PARA EL INGRESO DE PACIENTES-->
<div class="modal fade" id="registrar">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Usuarios</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required="required" id="id-registro" name="id-registro" class="form-control"/>	
					  <input type="text" required="required" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="expediente">Colaborador <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="colaborador" name="colaborador" class="custom-select" data-toggle="tooltip" data-placement="top" title="Colaborador" required>
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>
					<div class="col-md-6 mb-3">
					  <label for="nombre">Empresa <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="empresa" name="empresa" class="custom-select" data-toggle="tooltip" data-placement="top" title="Empresa" required>
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-user-lock fa-lg"></i></a>
						  </div>
					   </div>
					</div>							
				</div>				
				<div class="form-row">
					<div class="col-md-3 mb-3">
					  <label for="nombre">NickName <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <input type="text" required name="username" id="username" maxlength="100" class="form-control"/>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-user-lock fa-lg"></i></a>
						  </div>
					   </div>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="nombre">Email <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <input type="email" required name="email" id="email" maxlength="100" class="form-control"/>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-at fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-3 mb-3">
					  <label for="nombre">Tipo <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="tipo" name="tipo" class="custom-select" data-toggle="tooltip" data-placement="top" title="Tipo" required>
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-user-shield fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-2 mb-3">
					  <label for="expediente">Estado <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="estatus" name="estatus" class="custom-select" data-toggle="tooltip" data-placement="top" title="Estado" required>
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>	
				<div class="form-row">				
					
				</div>					  
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario" type="submit" id="reg_usaurios_sistema"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>					 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="registrar_editar">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Usuarios</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_editar">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" required="required" readonly id="id-registro1" name="id-registro1" readonly="readonly" style="display: none;" class="form-control"/>
					  <input type="text" required="required" readonly id="pro1" name="pro1" class="form-control"/>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="expediente">Colaborador <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="colaborador1" name="colaborador1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Colaborador">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>
					<div class="col-md-6 mb-3">
					  <label for="nombre">Empresa <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="empresa1" name="empresa1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Empresa" required>
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-user-lock fa-lg"></i></a>
						  </div>
					   </div>
					</div>					
				</div>				
				<div class="form-row">		
					<div class="col-md-6 mb-3">
					  <label for="nombre">Email <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <input type="email" required name="email1" id="email1" maxlength="100" class="form-control" required>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-at fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label for="nombre">Tipo <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="tipo1" name="tipo1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Tipo" required>
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-user-shield fa-lg"></i></a>
						  </div>
					   </div>
					</div>					
					<div class="col-md-2 mb-3">
					  <label for="expediente">Estado <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="estatus1" name="estatus1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Estado" required>
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>				
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-warning ml-2" form="formulario_editar" type="submit" id="edit_usaurios_sistema"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Editar</button>					 
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
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Usuarios del Sistema</li>
	</ol>

    <form class="form-inline" id="main_form">
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Estado</span>
			</div>
			<select id="status" name="status" class="custom-select" style="width:200px;" data-toggle="tooltip" data-placement="top" title="Estado">
			    <option value="">Estado</option>
			</select>	
		</div>		   
      </div>		  
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar por: Código, Nombre, Apellido, Username o E-mail" data-toggle="tooltip" data-placement="top" title="Buscar por: Código, Nombre, Apellido, Username o E-mail" id="bs-regis" autofocus class="form-control" size = "80" autofocus />
      </div> 	  
      <div class="form-group">
	    <button class="btn btn-primary ml-1" type="submit" id="nuevo-registro" data-toggle="tooltip" data-placement="top" title="Registrar Usuario"><div class="sb-nav-link-icon"></div><i class="fas fa-plus-circle fa-lg"></i> Crear</button>
      </div>
      <div class="form-group">
	    <button class="btn btn-success ml-1" type="submit" id="reporte" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i> Exportar</button>
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
		include "../js/myjava_users.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?> 
</body>
</html>