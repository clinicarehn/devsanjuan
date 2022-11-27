<?php 
session_start(); 
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$_SESSION['menu'] = "Colaboradores";

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

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
    <meta charset="utf-8" />
    <meta name="author" content="KIREDS" />
    <meta name="description" content="Responsive Websites Orden Hospitalaria de San Juan de Dios">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Colaboradores :: <?php echo $empresa; ?></title>
    <!--Menu e Iconos-->   
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../css/error_bien.css" type="text/css" media="screen">		
    <link rel="stylesheet" href="../login/css/all.css"><!--//USO DE ICONOS font awesome-->   
    <link rel="shortcut icon" href="../img/logo1.png">
    <!--******************************************************************************-->
    <link href="../css/estilo-paginacion.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-select.css">
	<link href="../sweetalert/sweetalert.css" rel="stylesheet"> 	
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->
   <?php include("templates/modals.php"); ?>
      
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="eliminar_servicio" data-keyboard="false">
 <div class="modal-dialog modal-sm modal-content-centered">
   <div class="modal-content">
	 <div class="modal-header">
		<h4 class="modal-title" id="myModalLabel"><center>¿Desea eliminar este registro?</center></h4>
		<input type="text" name="dato" id="dato" readonly style="display: none;"/>
	 </div>
	 <div class="modal-body">
	   <center>
		<button type="button" class="btn btn-primary" onClick="eliminarRegistro();" id="Si" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ok"></span> Si</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" id="No"><span class="glyphicon glyphicon-ok"></span> No</button>
		<p>
		<div id ="salida" style="display: none;">
		</div>
		</p>
	   </center>
	 </div>
  </div>
  </div>
</div>  

<!-- MODAL PARA EL REGISTRO DE COLABORADORES-->
<div class="modal fade" id="registrar_colaboradores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-content-centered" role="document">
	<div class="modal-content">
	<form class="form-horizontal" id="formulario_colaboradores">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Registra o Edita un Colaborador</h4>
	  </div>
	  <div class="modal-body">
		  <input type="text" required="required" readonly id="id-registro" name="id-registro" readonly="readonly" style="display: none;" class="form-control"/>
		  <div class="form-group">
			<p class="col-sm-1 control-label">Proceso</p>
			<div class="col-sm-11">
			  <input type="text" required="required" readonly id="pro" name="pro" class="form-control"/>
			</div>
		  </div>
		  
		  <div class="form-group">
			<p class="col-sm-1 control-label">Nombre</p>
			<div class="col-sm-3">
			  <input type="text" required name="nombre" id="nombre" maxlength="100" class="form-control"/>
			</div>
			<p  class="col-sm-1 control-label">Apellido</p>
			<div class="col-sm-3">
			  <input type="text" required name="apellido" id="apellido" maxlength="100" class="form-control"/>
			</div>	
			<p  class="col-sm-1 control-label">Identidad</p>
			<div class="col-sm-3">
			  <input type="text" required name="identidad" id="identidad" maxlength="100" class="form-control" title="Este número de Identidad debe estar exactamente igual al que se registro en Odoo en la ficha del Colaborador"/>
			</div>						
		  </div>
		  
		  <div class="form-group">
			<p class="col-sm-1 control-label">Empresa</p>
			<div class="col-sm-3">
			   <select id="empresa" name="empresa" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Seleccione la Empresa">		   
			   </select>
			</div>
			<p class="col-sm-1 control-label">Puesto</p>
			<div class="col-sm-3">
				<select id="puesto" name="puesto" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Seleccione el Puesto">		   
				</select>
			</div>
			<p class="col-sm-1 control-label">Estatus</p>
			<div class="col-sm-3">
				<select id="estatus" name="estatus" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Estatus">		   
				</select>
			</div>					
		  </div>				  
		  
		  <div class="form-group">
			   <div id="mensaje"></div>
		  </div>				  
	  </div>
	  <div class="modal-footer">
		<button type="submit" id="reg" class="btn btn-success" title="Registrar"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</button>
		<button type="submit" id="edi" class="btn btn-info" title="Editar"><span class="glyphicon glyphicon-floppy-save"></span> Editar</button>
	  </div>
	</form>
	</div>
  </div>
</div> 	

<!-- MODAL PARA EL REGISTRO DE PUESTOS-->
<div class="modal fade" id="registrar_puestos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
  <div class="modal-dialog modal-content-centered" role="document">
	<div class="modal-content">
	<form class="form-horizontal" id="formulario_puestos" onsubmit="return agregaRegistroPuestos();">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Registrar Puestos</h4>
	  </div>
	  <input type="text" required="required" readonly id="id-registro" name="id-registro" readonly="readonly" style="display: none;" class="form-control"/>
	  <div class="modal-body">				  
		  <div class="form-group">
			<p class="col-sm-2 control-label">Proceso</p>
			<div class="col-sm-10">
			  <input type="text" required="required" value="Registro" readonly id="pro" name="pro" class="form-control"/>
			</div>
		  </div>
		  
		  <div class="form-group">
			<p class="col-sm-2 control-label">Puestos</p>
			<div class="col-sm-7">
			  <input type="text" required name="puestosn" id="puestosn" maxlength="100" class="form-control"/>
			</div>	
			<div class="col-sm-2">
			  <button type="submit" id="reg" class="btn btn-success" title="Registrar"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</button>
			</div>					
		  </div>			  				  

		 <div class="form-group">
		   <div class="col-sm-14">
			 <div class="registros" id="agrega-registros_puestos"></div>
			</div>	
		   <div class="col-sm-14">	   
			 <center>	
			   <ul class="pagination" id="pagination_puestos"></ul>
			 </center>					
		   </div>					
		</div>	
		
		  <div class="form-group">
			   <div id="mensajep"></div>
		  </div>				  
	  </div>
	</form>
	</div>
  </div>
</div> 	

<!-- MODAL AGREGAR COLABORADORES A SERVICIO-->
<div class="modal fade" id="registrar_servicios_colaboradores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-content-centered" role="document">
	<div class="modal-content">
	<form class="form-horizontal" id="formulario_servicios_colaboradores" onsubmit="return agregaServicioColaborador();">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Registrar Servicio a Colaborador</h4>
	  </div>
	  <div class="modal-body">				  
		  <div class="form-group">
			<p class="col-sm-1 control-label">Proceso</p>
			<div class="col-sm-11">
			  <input type="text" required="required" value="Registro" readonly id="pro" name="pro" class="form-control"/>
			</div>
		  </div>
		  
		  <div class="form-group">
			<p class="col-sm-1 control-label">Puesto</p>
			<div class="col-sm-2">
			   <select id="puesto_id" name="puesto_id" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Seleccione">		   
			   </select>					   
			</div>				  
			<p class="col-sm-1 control-label">Colaborador</p>
			<div class="col-sm-2">
			   <select id="colaborador_id" name="colaborador_id" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Seleccione">		   
			   </select>					   
			</div>	
			<p class="col-sm-1 control-label">Servicio</p>
			<div class="col-sm-2">
			   <select id="servicio_colaborador" name="servicio_colaborador" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Seleccione">		   
			   </select>
			</div>
			<p class="col-sm-1 control-label">Jornada</p>
			<div class="col-sm-2">
			   <select id="servicio_jornada_colaborador" name="servicio_jornada_colaborador" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Seleccione">		   
			   </select>
			</div>										
		  </div>

		  <div class="form-group">
			<p class="col-sm-1 control-label">Nuevos</p>
			<div class="col-sm-2">
			   <input type="number" class="form-control" required id="cantidad_nuevos" name="cantidad_nuevos" autofocus title="Cantidad de Usuarios Nuevos que vera el Profesional" placeholder="Nuevos" maxlength="100"/>					   
			</div>				  
			<p class="col-sm-2 control-label">Subsiguientes</p>
			<div class="col-sm-2">
			   <input type="number" class="form-control" required id="cantidad_subsiguientes" name="cantidad_subsiguientes" autofocus title="Cantidad de Usuarios Subsiguientes que vera el Profesional" placeholder="Subsiguientes" maxlength="100"/>					   
			</div>					
			<div class="col-sm-1">
				<button type="submit" id="reg" class="btn btn-success" title="Registrar"><span class="glyphicon glyphicon-floppy-disk"></span></button>
			</div>					  
			<div class="col-sm-14" >
				<button type="submit" id="clean_datos" class="btn btn-warning" title="Limpiar"><span class="glyphicon glyphicon-trash"></span></button>
			</div>						
		  </div>				  

		  <div class="form-group">
			
		  </div>					  
		  
		 <div class="form-group">
		   <div class="col-sm-14">
			 <div class="registros" id="agrega-registros_servicio_colaborador"></div>
			</div>	
		   <div class="col-sm-14">	   
			 <center>	
			   <ul class="pagination" id="pagination_servicio_colaborador"></ul>
			 </center>					
		   </div>					
		</div>				
		
		<div class="form-group">
			   <div id="mensaje_servicio_colaborador"></div>
		</div>				  
	  </div>
	</form>
	</div>
  </div>
</div> 
</div> 		

<!-- MODAL PARA EL REGISTRO DE SERVICIOS-->
<div class="modal fade" id="registrar_servicios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
  <div class="modal-dialog modal-content-centered" role="document">
	<div class="modal-content">
	<form class="form-horizontal" id="formulario_servicios" onsubmit="return agregaRegistroServicios();">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Registrar Servicios</h4>
	  </div>
	  <input type="text" required="required" readonly id="id-registro" name="id-registro" readonly="readonly" style="display: none;" class="form-control"/>
	  <div class="modal-body">				  
		  <div class="form-group">
			<p class="col-sm-2 control-label">Proceso</p>
			<div class="col-sm-10">
			  <input type="text" required="required" value="Registro" readonly id="pro" name="pro" class="form-control"/>
			</div>
		  </div>
		  
		  <div class="form-group">
			<p class="col-sm-2 control-label">Servicio</p>
			<div class="col-sm-7">
			  <input type="text" required name="servicios" id="servicios" maxlength="100" class="form-control"/>
			</div>		
			<div class="col-sm-2">
			  <button type="submit" id="reg" class="btn btn-success" title="Registrar"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</button>
			</div>						
		  </div>			  				  
		  
		 <div class="form-group">
		   <div class="col-sm-14">
			 <div class="registros" id="agrega-registros_servicio"></div>
			</div>	
		   <div class="col-sm-14">	   
			 <center>	
			   <ul class="pagination" id="pagination_servicio"></ul>
			 </center>					
		   </div>					
		</div>				
		
		  <div class="form-group">
			   <div id="mensajes"></div>
		  </div>				  
	  </div>
	</form>
	</div>
  </div>
</div> 		  
</div>      
<!--Fin Ventanas Modales-->
   
<!--MENU-->	  
   <?php include("templates/menu.php"); ?>
<!--FIN MENU--> 

<div class="container-fluid">
	<br><br><br>
	<ol class="breadcrumb mt-2 mb-4">
		 <li class="breadcrumb-item" id="acciones_atras"><a id="ancla_volver" class="breadcrumb-link" style="text-decoration: none;" href="#"><span id="label_acciones_volver">Colaboradores</a></li>
		  <li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_receta"></span></li>
	 </ol>
	 
   <form class="form-inline" id="main_form">
      <div class="form-group">
         <select id="status" name="status" class="selectpicker form-control" data-hide-disabled="true" data-size="10" data-live-search="true" title="Estatus" required="required">
		 </select>	
      </div>	
      <div class="form-group">
        <input type="text" placeholder="Buscar por: Código, Nombre o Puesto" title="Buscar por: Código, Nombre o Puesto" id="bs-regis" size="50" autofocus class="form-control"/>
      </div>
      <div class="form-group">
		<a id="nuevo-registro-colaboradores" class="btn btn-primary" class="form-control"><span class="<a target="_blank" href="#" id="limpiar" title="Limpiar" class="btn btn-danger"><span class="fas fa-plus-circle fa-lg"></span></a></span></a>
      </div>
      <div class="form-group">
        <a id="nuevo-registro-puestos" class="btn btn-info" class="form-control" title="Puesto"><span class="fas fa-network-wired fa-lg"></span></a>
      </div>		
      <div class="form-group">
         <a id="nuevo-registro-servicios" class="btn btn-warning" class="form-control" title="Servicios"><span class="fab fa-servicestack fa-lg"></span></a>
      </div>
      <div class="form-group">
        <a id="nuevo-registro-colaborador-servicios" class="btn btn-danger" class="form-control" title="Colaboradores"><span class="fas fa-people-carry fa-lg"></span></a>
      </div>
      <div class="form-group">	    
        <a target="_blank" href="#" id="reporte_excel" class="btn btn-success" title="Exportar Búqueda" class="form-control"><span class="fas fa-download fa-lg"></span></a>
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
    <script src="../js/session.js"></script>		
   	<script src="../js/myjava_colaboradores.js"></script>  
    <script src="../js/functions.js"></script>  
	<script src="../js/myjava_cambiar_pass.js"></script>
	<script src="../sweetalert/sweetalert.min.js"></script>	
    <!--Boton volver al principio-->
    <script src="../js/arriba.js"></script>      
    <span class="ir-arriba" title="Ir Arriba"><i class="fas fa-chevron-up fa-xs"></i></span>  
</body>
</html>

