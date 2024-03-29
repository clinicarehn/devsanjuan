<?php
session_start(); 
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Configuraciones Varios";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Configuraciones Varios", MB_CASE_TITLE, "UTF-8");   

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
    <title>Configuraciones Varios :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>		
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?> 
<!--INICIO MODAL PARA EL INGRESO DE PACIENTES-->
<div class="modal fade" id="registrar">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Identidad y/o Expediente a Paciente</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_registros">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="hidden" required="required" readonly id="id_registro" name="id_registro" class="form-control"/>
					  <input type="text" required="required" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row" id="grupo_expediente">
					<div class="col-md-3 mb-3">
						<label for="consulta_registro">Registro</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="consulta_registro" name="consulta_registro" data-size="3" data-live-search="true" title="Registro">			  
						</select>
						</div>
					</div>
					<div class="col-md-9 mb-3">
					  <label for="edad">Nombre</label>
					  <input type="text" required name="nombre_registro" id="nombre_registro" maxlength="100" class="form-control"/>
					</div>				
				</div>					  
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_registros" type="submit" id="reg_configuraciones_varios"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		 <button class="btn btn-warning ml-2" form="formulario_registros" type="submit" id="editar_confiraciones_varios"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Editar</button>					 
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
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Configuraciones Varios</li>
	</ol>

    <form class="form-inline" id="form_main">
		<div class="form-group mx-sm-3 mb-1">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>Consulta</span>
					<select id="consulta" name="consulta" class="selectpicker" title="Consulta" data-live-search="true">
					</select>
				</div>	
			</div>
		</div>	  
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar por: Código o Nombre" data-toggle="tooltip" data-placement="top" title="Buscar por: Código o Nombre" id="bs_regis" autofocus class="form-control" size = "80" autofocus />
      </div>	  
      <div class="form-group">
	    <button class="btn btn-primary ml-1" type="submit" id="nuevo_registro" data-toggle="tooltip" data-placement="top" title="Nuevo Registro"><div class="sb-nav-link-icon"></div><i class="fas fa-plus-circle fa-lg"></i> Crear</button>
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
		include "../js/myjava_config_varios.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?> 
</body>
</html>