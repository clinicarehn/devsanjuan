<?php
session_start(); 
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Reporte Depurados";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo Reporte Depurados", MB_CASE_TITLE, "UTF-8");   

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
    <title>Reporte Depurados :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>	
</head>
<body>
   <!--Ventanas Modales-->
   <!-- Small modal -->  
  <?php include("templates/modals.php"); ?> 
<!--INICIO MODAL PARA EL INGRESO DE PACIENTES-->
<div class="modal fade" id="agregar_pasivos">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Usuarios Pasivos</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_pasivos">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					<input type="hidden" required readonly id="id-registro" name="id-registro" readonly="readonly" class="form-control"/>
					<input type="text" required="required" readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente <span class="priority">*<span/></label>
					  <input type="number" required="required" id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
					  <input type="number" required="required" id="expediente1" placeholder="Expediente o Identidad" name="expediente1" class="form-control"/>						  
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha <span class="priority">*<span/></label>
					  <input type="date" required="required" id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha Cita <span class="priority">*<span/></label>
					  <input type="date" required="required" id="fecha_cita" name="fecha_cita"  value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre <span class="priority">*<span/></label>
					  <input type="text" required="required" readonly id="nombre" name="nombre" class="form-control"/>	
					</div>							
				</div>					

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Servicio <span class="priority">*<span/></label>
					  <div class="input-group mb-3">
						  <select id="servicio" name="servicio" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_servicio_depurados_pasivos">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" id="servicio_boton"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Profesional</label>
					  <div class="input-group mb-3">
						  <select id="medico_general" name="medico_general" class="custom-select" data-toggle="tooltip" data-placement="top" title="Profesional">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_profesional_depurados_pasivos">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" id="servicio_boton"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Profesional</label>
					  <div class="input-group mb-3">
						  <select id="medico_general1" name="medico_general1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Profesional">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_profesional_depurados_pasivos1">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" id="servicio_boton"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>		

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Diagnostico <span class="priority">*<span/></label>
					  <input type="text" required="required" id="diagnostico" name="diagnostico" placeholder="Diagnostico" class="form-control"/>
					</div>	
					<div class="col-md-8 mb-3">
					  <label>Motivo <span class="priority">*<span/></label>
					  <input type="text" required="required" id="motivo" name="motivo" placeholder="Motivo" class="form-control"/>
					</div>						
				</div>					
								
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_pasivos" type="submit" id="reg_pasivos" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>	
		 <button class="btn btn-warning ml-2" form="formulario_agregar_pasivos" type="submit" id="edi_pasivos" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Editar</button>			 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="agregar_fallecidos">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Usuarios Fallecidos</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_fallecidos">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					<input type="hidden" required readonly id="id-registro" name="id-registro" readonly="readonly" class="form-control"/>
					<input type="text" required="required" readonly id="pro" name="pro" class="form-control" readonly="readonly"/>	
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente</label>
					  <input type="number" required="required" id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>
					  <input type="number" required="required" id="expediente1" placeholder="Expediente o Identidad" name="expediente1" class="form-control"/>				  
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha</label>
					  <input type="date" required="required" id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha Cita</label>
					  <input type="date" required="required" id="fecha_cita" name="fecha_cita"  value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					  <input type="text" required="required" readonly id="nombre" name="nombre" class="form-control"/>	
					</div>							
				</div>					

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Servicio</label>
					  <div class="input-group mb-3">
						  <select id="servicio" name="servicio" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_servicio_depurados_fallecidos">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" id="servicio_boton"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Profesional</label>
					  <div class="input-group mb-3">
						  <select id="medico_general" name="medico_general" class="custom-select" data-toggle="tooltip" data-placement="top" title="Profesional">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_profesional_depurados_fallecidos">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" id="servicio_boton"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Profesional</label>
					  <div class="input-group mb-3">
						  <select id="medico_general1" name="medico_general1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Profesional">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_profesional_depurados_fallecidos">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" id="servicio_boton"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>		

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Diagnostico</label>
					  <input type="text" required="required" id="diagnostico" name="diagnostico" placeholder="Diagnostico" class="form-control"/>
					</div>	
					<div class="col-md-8 mb-3">
					  <label>Motivo</label>
					  <input type="text" required="required" id="motivo" name="motivo" placeholder="Motivo" class="form-control"/>
					</div>						
				</div>					
								
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_fallecidos" type="submit" id="reg_fallecidos" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>	
		 <button class="btn btn-warning ml-2" form="formulario_agregar_fallecidos" type="submit" id="edi_fallecidos" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Editar</button>			 
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
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Reporte Depurados</li>
	</ol>

    <form class="form-inline" id="form_main">
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Estado</span>
			</div>
			<select id="status" name="status" class="custom-select" style="width:120px;" data-toggle="tooltip" data-placement="top" title="Estado">
				<option value="">Estado</option>
			</select>		
		</div>	   
      </div>	
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Reporte</span>
			</div>
			<select id="reporte" name="reporte" class="custom-select" style="width:115px;" data-toggle="tooltip" data-placement="top" title="Reporte">
				<option value="">Reporte</option>
			</select>		
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
			<input type="date" required="required" id="fecha_f" name="fecha_f" style="width:160px;" value="<?php echo date ("Y-m-d");?>" data-toggle="tooltip" data-placement="top" title="Fecha Inicial" class="form-control"/> 	
		</div> 
      </div>		  
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar Registro" data-toggle="tooltip" data-placement="top" title="Buscar por: Expediente, Nombre, Apellido o Identidad" id="bs-regis" autofocus class="form-control" size="20" autofocus />
      </div>
	  <div class="form-group">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-user-plus fa-lg"></i> Crear
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="nuevo-registro-pasivos">Depurar Usuarios Pasivos</a>
			<a class="dropdown-item" href="#" id="nuevo-registro-fallecidos">Depurar Usuarios Fallecidos</a>
			<a class="dropdown-item" href="#" id="ejecutar">Ejecutar Depuración</a>			
		  </div>
		</div>		  
	  </div> 	  
      <div class="form-group">
	    <button class="btn btn-success ml-1" type="submit" id="reportes_depurados" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i> Exportar</button>
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
		include "../js/myjava_reportes_depurados.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?>
</body>
</html>