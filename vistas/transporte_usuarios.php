<?php
session_start(); 
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Transporte Usuarios";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Transporte Usuarios", MB_CASE_TITLE, "UTF-8");   

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
    <title>Transporte Usuarios :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>		
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?> 
<!--INICIO MODAL PARA EL INGRESO DE PACIENTES-->
<div class="modal fade" id="registrar_transporte">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Control de Uso Vehicular</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_transporte">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					      <input type="hidden" required="required" readonly id="id-registro" name="id-registro" class="form-control"/>
						  <input type="text" required="required" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row" id="grupo_expediente">
					<div class="col-md-4 mb-3">
					  <label for="expediente">Fecha</label>
					  <input type="date" required="required" id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>
					<div class="col-md-8 mb-3">
					  <label for="edad">Motivo</label>
					  <input type="text" required name="motivo" id="motivo" maxlength="100" class="form-control"/>
					</div>				
				</div>				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="nombre">Adulto Hombre </label>
					  <input type="number" required name="adulto_h" id="adulto_h" maxlength="100" value="0" class="form-control"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="apellido">Adulto Mujer </label>
					  <input type="number" required name="adulto_m" id="adulto_m" maxlength="100" value="0" class="form-control"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="fecha">Niños</label>
					  <input type="number" required name="niño" id="niño" maxlength="100" value="0" class="form-control"/>
					</div>					
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="sexo">Hora Inicial </label>
					  <input type="time" required name="hora_inicial" id="hora_inicial" maxlength="100" class="form-control"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="telefono">Hora Final </label>
					  <input type="time" required name="hora_final" id="hora_final" maxlength="100" class="form-control"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="telefono">Kilometro Inicial</label>
					  <input type="number" required name="km_inicial" id="km_inicial" maxlength="100" class="form-control"/> 
					</div>					
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="sexo">Kilometro Final </label>
					  <input type="number" required name="km_final" id="km_final" maxlength="100" class="form-control"/>
					</div>
					<div class="col-md-3 mb-3">
						<label for="transportista">Usuario <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="transportista" name="transportista" required data-size="5" data-live-search="true" title="Usuario">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="vehiculo_t">Vehículo <span class="priority">*<span/></label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="vehiculo_t" name="vehiculo_t" required data-size="5" data-live-search="true" title="Vehículo">			  
						</select>
						</div>
					</div>						
				</div>  
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_transporte" type="submit" id="reg_vehiculos_transporte"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		 <button class="btn btn-warning ml-2" form="formulario_transporte" type="submit" id="edit_vehiculos_transporte"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Editar</button>					 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="registrar_combustible">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Control de Combustible</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_combustible">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					      <input type="text" required="required" value="Registro" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				<div class="form-row" id="grupo_expediente">
					<div class="col-md-4 mb-3">
					  <label for="expediente">Fecha</label>
					  <input type="date" required="required" id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>
					<div class="col-md-8 mb-3">
					  <label for="edad">Tanque Inicio</label>
					  <input type="number" required name="tanque_inicio" id="tanque_inicio" placeholder="Tanque Inicio" maxlength="100" class="form-control"/>
					</div>	
					<div class="col-md-8 mb-3">
					  <label for="edad">Cantidad Litros</label>
					  <input type="number" required name="cantidad_litros" id="cantidad_litros" placeholder="Litros Comprados" maxlength="100" class="form-control"/>
					</div>						
				</div>				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="nombre">Valor de la Compra </label>
					  <input type="number" required name="valor_compra" id="valor_compra" placeholder="Valor de la Compra" maxlength="100" class="form-control"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="apellido">Tanque Final </label>
					  <input type="number" required name="tanque_final" id="tanque_final" readonly placeholder="Tanque Final" maxlength="100" class="form-control"/>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="fecha">Usuario</label>
					  <div class="input-group mb-3">
						  <select id="transportista_combustible" name="transportista_combustible" class="custom-select" data-toggle="tooltip" data-placement="top" title="Usuario">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_usuario_transporte_combutible">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>					
				</div> 
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="fecha">Vehículo</label>
					  <div class="input-group mb-3">
						  <select id="vehiculo" name="vehiculo" class="custom-select" data-toggle="tooltip" data-placement="top" title="Vehículo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_usuario_transporte_combutible">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>					
				</div> 				
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_combustible" type="submit" id="reg_combustible_transporte"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		 <button class="btn btn-warning ml-2" form="formulario_combustible" type="submit" id="edit_combustible_transporte"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Editar</button>					 
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
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Transporte Usuarios</li>
	</ol>

    <form class="form-inline" id="main_form">
		<div class="form-group mx-sm-3 mb-1">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>tipo</span>
					<select id="tipo" name="tipo" class="selectpicker" title="tipo" data-live-search="true">
					</select>
				</div>	
			</div>
		</div>	
		<div class="form-group mx-sm-3 mb-1">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text"><div class="sb-nav-link-icon"></div>Vehículo</span>
					<select id="vehiculo_main" name="vehiculo_main" class="selectpicker" title="Vehículo" data-live-search="true">
					</select>
				</div>	
			</div>
		</div>			
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fecha Inicio</span>
			</div>
		    <input type="date" required="required" id="fecha_i" name="fecha_i" style="width:160px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/>	
		</div>  
      </div>	
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fecha Fin</span>
			</div>
			<input type="date" required="required" id="fecha_f" name="fecha_ffecha_f" style="width:160px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/> 	
		</div> 
      </div>	  
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar Registros" data-toggle="tooltip" data-placement="top" title="Buscar por: Motivo de Viaje, Transportista, Usuario" id="bs-regis" autofocus class="form-control" size="30" autofocus />
      </div>
	  <div class="form-group mr-1">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-user-plus fa-lg"></i> Crear
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="nuevo_transporte">Control Vehicular</a>
			<a class="dropdown-item" href="#" id="nuevo_combustible">Control de Combustible</a>		
		  </div>
		</div>		  
	  </div> 
	  <div class="form-group">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-download fa-lg"></i> Exportar
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="reporte_transporte">Control Vehicular</a>
			<a class="dropdown-item" href="#" id="reporte_combustible">Control de Combustible</a>		
		  </div>
		</div>		  
	  </div>	   
    </form>	
	<hr/>  
	<br/>
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
		include "../js/myjava_transporte_usuarios.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?>  
</body>
</html>