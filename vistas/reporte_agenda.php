<?php
session_start(); 
include('../php/funtions.php'); 

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Reporte Agenda";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo Reporte Agenda", MB_CASE_TITLE, "UTF-8");   

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
    <title>Reporte Agenda :: <?php echo $empresa; ?></title>
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

<br><br><br>
<div class="container-fluid">
	<ol class="breadcrumb mt-2 mb-4">
		<li class="breadcrumb-item"><a class="breadcrumb-link" href="inicio.php">Dashboard</a></li>
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Reporte Agenda</li>
	</ol>

    <form id="form_reporte_agenda">
		<div class="form-group custom-control custom-checkbox custom-control-inline">
			<div class="col-md-3">		
				<label class="form-check-label" for="defaultCheck1"><b>Buscar por:</b> </label>				
			</div>			
			<div class="col-md-3">		
				<label class="form-check-label" for="defaultCheck1">Servicio</label>
				<label class="switch">
					<input type="checkbox" id="servicio_activo" name="servicio_activo" value="1" checked>
					<div class="slider round"></div>
				</label>
				<span class="question mb-2" id="label_servicio_activo"></span>				
			</div>
			<div class="col-md-3">		
				<label class="form-check-label" for="defaultCheck1">Unidad</label>
				<label class="switch">
					<input type="checkbox" id="unidad_activo" name="unidad_activo" value="1" checked>
					<div class="slider round"></div>
				</label>
				<span class="question mb-2" id="label_unidad_activo"></span>				
			</div>	
			<div class="col-md-4">		
				<label class="form-check-label" for="defaultCheck1">Profesional</label>
				<label class="switch">
					<input type="checkbox" id="profesional_activo" name="profesional_activo" value="1" checked>
					<div class="slider round"></div>
				</label>
				<span class="question mb-2" id="label_profesional_activo"></span>				
			</div>	
			<div class="col-md-3">		
				<label class="form-check-label" for="defaultCheck1">Fecha</label>
				<label class="switch">
					<input type="checkbox" id="fecha_activo" name="fecha_activo" value="1" checked>
					<div class="slider round"></div>
				</label>
				<span class="question mb-2" id="label_fecha_activo"></span>				
			</div>									
		</div>
		<div class="form-row">
			<div class="form-group mr-1">
				<select id="tipo" name="tipo" class="custom-select" style="width:130px;" data-toggle="tooltip" data-placement="top" title="Tipo">
					<option value="">Tipo</option>
					<option value="0">Todos</option>
					<option value="1">Programados</option>
					<option value="2">Atendidos</option>
					<option value="3">Ausencias</option>
				</select>		   
			</div>	
			<div class="form-group mr-1">
				<select id="servicio" name="servicio" class="custom-select" style="width:130px;" data-toggle="tooltip" data-placement="top" title="Servicio">
					<option value="">Servicio</option>
				</select>		   
			</div>	
			<div class="form-group mr-1">
				<select id="unidad" name="unidad" class="custom-select" style="width:130px;" data-toggle="tooltip" data-placement="top" title="Unidad">
					<option value="">Unidad</option>
				</select>		   
			</div>	
			<div class="form-group mr-1">
				<select id="profesional" name="profesional" class="custom-select" style="width:130px;" data-toggle="tooltip" data-placement="top" title="Profesional">
					<option value="">Profesional</option>
				</select>		   
			</div>			
			<div class="form-group mr-1">
			<input type="date" required="required" id="fecha_i" name="fecha_i" style="width:165px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/>  
			</div>	
			<div class="form-group mr-1">
				<input type="date" required="required" id="fecha_f" name="fecha_f" style="width:165px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/>  
			</div>
			<div class="form-group">
				<button class="btn btn-success ml-1" type="submit" id="reporte_excel" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i> Exportar</button>		 
			</div> 
			<div class="form-group">
				<button class="btn btn-danger ml-1" type="submit" id="limpiar" data-toggle="tooltip" data-placement="top" title="Limpiar"><div class="sb-nav-link-icon"></div><i class="fas fa-broom fa-lg"></i> Limpiar</button>		 
			</div> 
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
		include "../js/myjava_reporte_agenda.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?> 
</body>
</html>