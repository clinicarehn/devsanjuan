<?php
session_start(); 
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php'); 
}    

$_SESSION['menu'] = "Referencias";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();		
$fecha = date("Y-m-d H:i:s"); 
$comentario = mb_convert_case("Ingreso al Modulo de Referencias", MB_CASE_TITLE, "UTF-8");   

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
    <title>Referencias :: <?php echo $empresa; ?></title>
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
        <h5 class="modal-title">Información</h5>
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
  
<div class="modal fade" id="modal_consolidado_referencias">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Consolidado de Referencias</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_modal_consolidado_referencias">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" required="required" readonly id="pro" name="pro" class="form-control"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Referencia</label>
					  <select id="consolidado_ref_ugd" name="consolidado_ref_ugd" class="custom-select" data-toggle="tooltip" data-placement="top" title= "Referencia">
							<option>Seleccione</option>
					   </select>	
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Año</label>
					  <select id="año_ref_ugd" name="año_ref_ugd" class="custom-select" data-toggle="tooltip" data-placement="top" title= "Año">
						  <option>Seleccione</option>
					  </select>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Servicio</label>
					  <select id="servicio_ref_ugd" name="servicio_ref_ugd" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio">
					  </select>	
					</div>						
				</div>				
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-success ml-2" form="formulario_modal_consolidado_referencias" type="submit" id="reg_consolidado_ref_ugd" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i></button>		 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="registrar_centros">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Centros</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_centros">			
			
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home_centros" role="tab" aria-controls="home_centros" aria-selected="false">Centros</a>
					</li>
					<li class="nav-item waves-effect waves-light">
					  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#menu1_busquedas" role="tab" aria-controls="menu1_busquedas" aria-selected="false">Búsqueda</a>
					</li>
				</ul>
				<br>
				<div class="tab-content"><!--Inicio TAB Panel-->
				
					<div class="tab-pane fade active show" id="home_centros" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB HOME-->
							
							<div class="form-row">
								<div class="col-md-12 mb-3">
									<input type="hidden" readonly id="id-registro" name="id-registro" class="form-control"/>
									<input type="text" required="required" readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
								</div>
							</div>	
							<div class="form-row">
								<div class="col-md-4 mb-3">
								  <label>Nivel</label>
								  <div class="input-group mb-3">
									  <select id="centros_nivel" name="centros_nivel" class="custom-select" data-toggle="tooltip" data-placement="top" title="Nivel">
										<option value="">Seleccione</option>
									  </select>
									  <div class="input-group-append" id="buscar_departamento_pacientes">				
										<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div>
										<i class="fas fa-search fa-lg"></i></a>
								  </div>
								</div>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Centro</label>
							  <div class="input-group mb-3">
								  <select id="centros_centro" name="centros_centro" class="custom-select" data-toggle="tooltip" data-placement="top" title="Centro">
									<option value="">Seleccione</option>
								  </select>
								  <div class="input-group-append" id="buscar_departamento_pacientes">				
									<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
								  </div>
							   </div>
							</div>	
							<div class="col-md-4 mb-3">
							  <label>Departamento</label>
							  <div class="input-group mb-3">
								  <select id="departamento_referencias" name="departamento_referencias" class="custom-select" data-toggle="tooltip" data-placement="top" title="Departamento Referencias">
									<option value="">Seleccione</option>
								  </select>
								  <div class="input-group-append" id="buscar_departamento_pacientes">				
									<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
								  </div>
							   </div>
							</div>						
						</div>	

						<div class="form-row">
							<div class="col-md-4 mb-3">
							  <label>Red</label>
							  <div class="input-group mb-3">
								  <select id="red_centro" name="red_centro" class="custom-select" data-toggle="tooltip" data-placement="top" title="Red">
									<option value="">Seleccione</option>
								  </select>
								  <div class="input-group-append" id="buscar_departamento_pacientes">				
									<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
								  </div>
							   </div>
							</div>	
							<div class="col-md-8 mb-3">
							  <label>Nombre</label>
							  <input type="text" required="required" name="centros_nombre" class="form-control" id="centros_nombre" maxlength="100"/>
							</div>						
						</div>		
					
					</div><!-- FIN TAB HOME-->
					
					<div class="tab-pane fade" id="menu1_busquedas" role="tabpanel" aria-labelledby="home-tab"><!-- INICIO TAB BÚSQUEDA-->

						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <input type="text" required="required" name="centros_buscar" class="form-control" placeholder="Buscar por: Centro." id="centros_buscar" maxlength="100"/>
							</div>						
						</div>	
						
						<div class="form-row">
							<div class="col-md-12 mb-3">
							  <div class="registros overflow-auto" id="agrega_registros_centros"></div>
							</div>							
						</div>	

						<nav aria-label="Page navigation example">
							<ul class="pagination justify-content-center" id="pagination_centros"></ul>
						</nav>						
									
					</div><!-- FIN TAB BÚSQUEDA-->
					
				</div><!--Fin TAB Panel-->

			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_centros" type="submit" id="reg_centros" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="agregar_referencias_recibidas">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Referencias Recibidas y Respuestas Enviadas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_referencias_recibidas">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
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
					  <input type="text" required="required" id="nombre" name="nombre" placeholder="Nombre" class="form-control" readonly />	
					</div>							
				</div>					

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Nivel</label>
					  <div class="input-group mb-3">
						  <select id="centros_nivel" name="centros_nivel" class="custom-select" data-toggle="tooltip" data-placement="top" title="Nivel">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_niveles_referencias_recibidas" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Centro</label>
					  <div class="input-group mb-3">
						  <select id="centro" name="centro" class="custom-select" data-toggle="tooltip" data-placement="top" title="Centro">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_tipo_centros_referencias_recibidas" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Referencia</label>
					  <div class="input-group mb-3">
						  <select id="recibidade" name="recibidade" class="custom-select" data-toggle="tooltip" data-placement="top" title="Referencia Recidia de">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_centros_referencias_recibidas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>		

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Patología</label>
					  <div class="input-group mb-3">
						  <select id="patologia1" name="patologia1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Patología">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_patologia_referencias_recibidas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-8 mb-3">
					  <label>Diagnostico</label>
					  <input type="text" required="required" id="diagnostico" name="diagnostico" placeholder="Diagnostico" class="form-control"/>
					</div>								
				</div>	

				<div class="form-row">	
					<div class="col-md-4 mb-3">
					  <label>Motivo</label>
					  <div class="input-group mb-3">
						  <select id="motivo" name="motivo" class="custom-select" data-toggle="tooltip" data-placement="top" title="Motivo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>				
					<div class="col-md-4 mb-3">
					  <label>Otro Motivo</label>
					  <div class="input-group mb-3">
						  <select id="motivo1" name="motivo1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Otro Motivo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>				
					<div class="col-md-4 mb-3">
					  <label>Servicio</label>
					  <div class="input-group mb-3">
						  <select id="servicio" name="servicio" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_servicios_referencias_recibidas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>					
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Unidad</label>
					  <div class="input-group mb-3">
						  <select id="unidad" name="unidad" class="custom-select" data-toggle="tooltip" data-placement="top" title="Unidad">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Profesional</label>
					  <div class="input-group mb-3">
						  <select id="medico_general" name="medico_general" class="custom-select" data-toggle="tooltip" data-placement="top" title="Profesional">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>					
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_referencias_recibidas" type="submit" id="reg_rr" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="agregar_referencias_enviadas">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Referencias Enviadas y Respuestras Recibidas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_referencias_enviadas">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
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
					  <input type="text" required="required" readonly id="identidad" name="identidad" class="form-control"/>
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
					  <label>Nivel</label>
					  <div class="input-group mb-3">
						  <select id="centros_nivel" name="centros_nivel" class="custom-select" data-toggle="tooltip" data-placement="top" title="Nivel">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_niveles_referencias_enviadas" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Centro</label>
					  <div class="input-group mb-3">
						  <select id="centro" name="centro" class="custom-select" data-toggle="tooltip" data-placement="top" title="Centro">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_tipo_centro_referencias_enviadas" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Envada a</label>
					  <div class="input-group mb-3">
						  <select id="enviadaa" name="enviadaa" class="custom-select" data-toggle="tooltip" data-placement="top" title="Enviada a">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_centros_referencias_enviadas" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>		

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Patología</label>
					  <div class="input-group mb-3">
						  <select id="patologia1" name="patologia1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Patología">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_patologia1_referencias_enviadas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Patología</label>
					  <div class="input-group mb-3">
						  <select id="patologia2" name="patologia2" class="custom-select" data-toggle="tooltip" data-placement="top" title="Patología">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_patologia2_referencias_enviadas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Patología</label>
					  <div class="input-group mb-3">
						  <select id="patologia3" name="patologia3" class="custom-select" data-toggle="tooltip" data-placement="top" title="Patología">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_patologia3_referencias_enviadas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>		
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Diagnostico</label>
					  <input type="text" required="required" id="diagnostico" name="diagnostico" placeholder="Diagnostico" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Motivo</label>
					  <div class="input-group mb-3">
						  <select id="motivo_traslado" name="motivo_traslado" class="custom-select" data-toggle="tooltip" data-placement="top" title="Motivo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Otro Motivo</label>
					  <div class="input-group mb-3">
						  <select id="motivo" name="motivo" class="custom-select" data-toggle="tooltip" data-placement="top" title="Otro Motivo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes" style="display: none;">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>		
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Servicio</label>
					  <div class="input-group mb-3">
						  <select id="servicio" name="servicio" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_servicios_referencias_enviadas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Unidad</label>
					  <div class="input-group mb-3">
						  <select id="unidad" name="unidad" class="custom-select" data-toggle="tooltip" data-placement="top" title="Unidad">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_unidades_referencias_enviadas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Profesional</label>
					  <div class="input-group mb-3">
						  <select id="medico_general" name="medico_general" class="custom-select" data-toggle="tooltip" data-placement="top" title="Profesional">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_profesionales_referencias_enviadas">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>					
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_referencias_enviadas" type="submit" id="reg_re" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="agregar_info_confirmacion_enviada">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Confirmación Referencia Recibida</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_agregar_info_respuesta_enviada">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="hidden" id="referencia_info_respuesta" name="referencia_info_respuesta"class="form-control"/>
						<input type="hidden" id="colaborador_id_info_respuesta" name="colaborador_id_info_respuesta" class="form-control"/>
						<input type="hidden" id="servicio_id_info_respuesta" name="servicio_id_info_respuesta" class="form-control"/>
						<input type="text" id="pro_info_respuesta" name="pro_info_respuesta" class="form-control" readonly />
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Expediente</label>
					  <input type="number" required="required" id="expediente_info_respuesta" name="expediente_info_respuesta" placeholder="Expediente o Identidad" readonly="readonly" class="form-control"/>	
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Fecha</label>
					  <input type="date" required="required" readonly id="fecha_info_respuesta" name="fecha_info_respuesta" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Identidad</label>
					  <input type="text" required="required" readonly id="identidad_info_respuesta" name="identidad_info_respuesta" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					  <input type="text" required="required" readonly id="nombre_info_respuesta" name="nombre_info_respuesta" class="form-control"/>	
					</div>							
				</div>	

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Correo</label>
					  <input type="email" placeholder="alguien@algo.com" id="correo_info_respuesta" name="correo_info_respuesta" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Teléfono</label>
					  <input type="number" placeholder="Ejemplo: 97567896" id="telefono_info_respuesta" name="telefono_info_respuesta" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
						<div class="form-check form-check-inline">
						  <label class="form-check-label">Confirmo: </label>
						</div>					
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="si_info_respuesta" name="respuesta_info_respuesta" value="1">
						  <label class="form-check-label" for="si_info_respuesta">Sí</label>						  
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" id="no_info_respuesta" name="respuesta_info_respuesta" value="2">
						  <label class="form-check-label" for="no_info_respuesta">No</label>						  
						</div>
					</div>						
				</div>		

				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Observación</label>
					  <input type="text" placeholder="Observación" id="observacion_info_respuesta" name="observacion_info_respuesta" class="form-control"/>	
					</div>							
				</div>					

				<div class="form-row" id="grupo_confirmacion_respuesta" style="display: none;">
					<div class="col-md-4 mb-3">
					  <label>Confirmación</label>
					  <div class="input-group mb-3">
						  <select id="confirmo_respuesta" name="confirmo_respuesta" class="custom-select" data-toggle="tooltip" data-placement="top" title="Confirmación">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>
				
				<div class="form-row" id="grupo_confirmacion_respuesta1">
					<div class="col-md-4 mb-3">
					  <label>Confirmación</label>
					  <div class="input-group mb-3">
						  <select id="confirmo_respuesta1" name="confirmo_respuesta1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Confirmación">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_departamento_pacientes">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success""><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>				
				
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_agregar_info_respuesta_enviada" type="submit" id="reg_info_respuesta" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		 
	   </div>		
      </div>
    </div>
</div>	

<div class="modal fade" id="editar_referencias_enviadas">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Referencias Enviadas y Respuestas Recibidas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_edicion_referencias_enviadas">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="hidden" required="required" readonly id="referencia_id_enviada" name="referencia_id_enviada" readonly="readonly" class="form-control"/>
						<input type="hidden" required="required" readonly id="ata_id_enviada" name="ata_id_enviada" readonly="readonly"class="form-control"/>
						<input type="text" required="required" readonly id="pro_enviada" name="pro_enviada" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label>Expediente</label>
					  <input type="number" required="required" readonly id="expediente_enviada" name="expediente_enviada" placeholder="Expediente o Identidad" class="form-control"/>	
					</div>	
					<div class="col-md-6 mb-3">
					  <label>Identidad</label>
					  <input type="text" required="required" readonly id="identidad_enviada" name="identidad_enviada" class="form-control"/>
					</div>						
				</div>	
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label>Nombre</label>
					  <input type="text" required="required" readonly id="nombre_enviada" name="nombre_enviada" class="form-control"/>	
					</div>							
				</div>	
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Nivel</label>
					  <div class="input-group mb-3">
						  <select id="centros_nivel_enviada" name="centros_nivel_enviada" class="custom-select" data-toggle="tooltip" data-placement="top" title="Nivel">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_nivel_editar_referencia_enviada">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Centro</label>
					  <div class="input-group mb-3">
						  <select id="centro_enviada" name="centro_enviada" class="custom-select" data-toggle="tooltip" data-placement="top" title="Centro">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_centro_editar_referencia_enviada">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>
					<div class="col-md-4 mb-3">
					  <label>Enviada a</label>
					  <div class="input-group mb-3">
						  <select id="enviadaa" name="enviadaa" class="custom-select" data-toggle="tooltip" data-placement="top" title="Enviada a">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_editar_referencia_enviada">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>					
				</div>
				
				<div class="form-row" id="grupo_confirmacion_respuesta1">
					<div class="col-md-12 mb-3">
					  <label>Motivo</label>
					  <input type="text" required="required" id="motivo_enviada"name="motivo_enviada"  placeholder="Motivo de la Referencia" readonly class="form-control"/>
					</div>						
				</div>	

				<div class="form-row" >
					<div class="col-md-6 mb-3">
					  <label>Motivo</label>
					  <div class="input-group mb-3">
						  <select id="motivo" name="motivo" class="custom-select" data-toggle="tooltip" data-placement="top" title="Motivo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_motivo_editar_referencia_envida">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-6 mb-3">
					  <label>Otro Motivo</label>
					  <div class="input-group mb-3">
						  <select id="motivo_otro" name="motivo_otro" class="custom-select" data-toggle="tooltip" data-placement="top" title="Otro Motivo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_otro_motivo_editar_referencia_enviada">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" ><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>				
				</div>	

				<div class="form-row" >
					<div class="col-md-4 mb-3">
					  <label>Patología 1</label>
					  <div class="input-group mb-3">
						  <select id="patologia1" name="patologia1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Patología">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_patologia1_editar_referencia_envida">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Patología 2</label>
					  <div class="input-group mb-3">
						  <select id="patologia2" name="patologia2" class="custom-select" data-toggle="tooltip" data-placement="top" title="Patología">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_patologia2_editar_referencia_enviada">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" ><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Patología 3</label>
					  <div class="input-group mb-3">
						  <select id="patologia3" name="patologia3" class="custom-select" data-toggle="tooltip" data-placement="top" title="Patología">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_patologia3_editar_referencia_enviada">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>
				<div class="form-row" >
					<div class="col-md-12 mb-3">
					  <label>Diagnostico</label>
					   <input type="text" required="required" id="diagnostico_enviada" name="diagnostico_enviada" placeholder="Diangostico Clínico" class="form-control"/>
					</div>						
				</div>				
				
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_edicion_referencias_enviadas" type="submit" id="edit_referencias_ref_enviadas" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		 
	   </div>		
      </div>
    </div>
</div>

<div class="modal fade" id="editar_referencias_recibidas">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Referencias Recibidas y Respuestas Enviadas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="formulario_edicion_referencias_recibidas">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<input type="hidden" required="required" readonly id="referencia_id" name="referencia_id" readonly="readonly" class="form-control"/>
						<input type="hidden" required="required" readonly id="ata_id" name="ata_id" readonly="readonly" class="form-control"/>	
						<input type="text" required="required" readonly id="pro" name="pro" class="form-control" readonly="readonly"/>
					</div>				
				</div>
				
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label>Expediente</label>
					  <input type="number" required="required" readonly id="expediente" name="expediente" placeholder="Expediente o Identidad" class="form-control"/>	
					</div>	
					<div class="col-md-6 mb-3">
					  <label>Identidad</label>
					  <input type="text" required="required" readonly id="identidad" name="identidad" class="form-control"/>
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
					  <label>Nivel</label>
					  <div class="input-group mb-3">
						  <select id="centros_nivel" name="centros_nivel" class="custom-select" data-toggle="tooltip" data-placement="top" title="Nivel">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_nivel_editar_referencia_recibida">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Centro</label>
					  <div class="input-group mb-3">
						  <select id="centro" name="centro" class="custom-select" data-toggle="tooltip" data-placement="top" title="Centro">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_centro_editar_referencia_recibida">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>
					<div class="col-md-4 mb-3">
					  <label>Recibida de</label>
					  <div class="input-group mb-3">
						  <select id="recibidade" name="recibidade" class="custom-select" data-toggle="tooltip" data-placement="top" title="Recibida de">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_editar_referencia_recibida">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>					
				</div>
				
				<div class="form-row" id="grupo_confirmacion_respuesta1">
					<div class="col-md-12 mb-3">
					  <label>Motivo</label>
					  <input type="text" required="required" id="motivo"name="motivo"  placeholder="Motivo de la Referencia" readonly class="form-control"/>
					</div>						
				</div>	

				<div class="form-row" >
					<div class="col-md-4 mb-3">
					  <label>Motivo</label>
					  <div class="input-group mb-3">
						  <select id="motivo1" name="motivo1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Motivo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_motivo_editar_referencia_recibida">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Otro Motivo</label>
					  <div class="input-group mb-3">
						  <select id="motivo_otro1" name="motivo_otro1" class="custom-select" data-toggle="tooltip" data-placement="top" title="Otro Motivo">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_otro_motivo_editar_referencia_recibida">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success" ><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>
					<div class="col-md-4 mb-3">
					  <label>Patología</label>
					  <div class="input-group mb-3">
						  <select id="patologia" name="patologia" class="custom-select" data-toggle="tooltip" data-placement="top" title="Patología">
							<option value="">Seleccione</option>
						  </select>
						  <div class="input-group-append" id="buscar_patologia_editar_referencia_recibida">				
							<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fas fa-search fa-lg"></i></a>
						  </div>
					   </div>
					</div>						
				</div>				
				
			</form>
        </div>
	   <div class="modal-footer">
		 <button class="btn btn-primary ml-2" form="formulario_edicion_referencias_recibidas" type="submit" id="edit_referencias_ref_recibida" data-toggle="tooltip" data-placement="top" title="Registrar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		 
	   </div>		
      </div>
    </div>
</div>

  <?php include("modals/modals.php"); ?>  
<!--FIN VENTANAS MODALES-->	

<?php include("templates/menu.php"); ?> 

<br><br><br>
<div class="container-fluid">
	<ol class="breadcrumb mt-2 mb-4">
		<li class="breadcrumb-item"><a class="breadcrumb-link" href="inicio.php">Dashboard</a></li>
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Referencias</li>
	</ol>

    <form class="form-inline" id="form_main">
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Servicio</span>
			</div>
			<select id="servicio" name="servicio" class="custom-select" style="width:150px;" data-toggle="tooltip" data-placement="top" title="Servicio">
				<option value="">Servicio</option>
			</select>
		</div>			   
      </div>	
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Referencia</span>
			</div>
			<select id="referencias" name="referencias" class="custom-select" style="width:121px;" data-toggle="tooltip" data-placement="top" title="Referencia">
				<option value="">Referencia</option>
			</select>	
		</div>		   
      </div>
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Inicio</span>
			</div>
			<input type="date" required="required" id="fecha_i" name="fecha_i" style="width:160px;" title="Fecha Inicio" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
		</div>		   
      </div>
	  <div class="form-group mr-1">
		<div class="input-group">				
			<div class="input-group-append">				
				<span class="input-group-text"><div class="sb-nav-link-icon"></div>Inicio</span>
			</div>
			<input type="date" required="required" id="fecha_f" name="fecha_f" style="width:160px;" title="Fecha Fin" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
		</div>          	   
      </div>	  
      <div class="form-group mr-1">
		<input type="text" placeholder="Buscar Registro" id="bs-regis" title="Buscar Refrencias Enviadas/Recibidas, Buscar por: Expediente, Nombre, Apellido o Identidad" autofocus class="form-control" size="30"/>
      </div>
	  <div class="form-group">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-user-plus fa-lg"></i> Crear
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="referencias_enviadas">Referencias Enviadas</a>
			<a class="dropdown-item" href="#" id="referencias_recibidas">Referencias Recibidas</a>		
			<a class="dropdown-item" href="#" id="centros_mainform">Centros</a>			
		  </div>
		</div>		  
	  </div>
	  <div class="form-group ml-1">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-download fa-lg"></i> Exportar
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="reporte_referencias">Referencias</a>
			<a class="dropdown-item" href="#" id="reporte_patologias">Informe de Patologias</a>
			<a class="dropdown-item" href="#" id="reporte_procedencias">Control de Procedencias</a>
			<a class="dropdown-item" href="#" id="reporte_centros">Centros</a>
			<a class="dropdown-item" href="#" id="reporte_registro_referencias">Registro de Referencias</a>
			<a class="dropdown-item" href="#" id="reporte_consolidado_referencias">Consolidado de Referencias</a>
			<a class="dropdown-item" href="#" id="motivos_ref_ugd">Motivos de Referencias</a>
			<a class="dropdown-item" href="#" id="consolidados_motivos_ugd">Consolidado de Motivos</a>
			<a class="dropdown-item" href="#" id="ref_niveles_ugd">Consolidado Nivel de Atención</a>		
		  </div>
		</div>		  
	  </div>	  
      <div class="form-group" style="display:none;">
	     <button class="btn btn-danger ml-1" type="submit" id="limpiar" data-toggle="tooltip" data-placement="top" title="Limpiar"><div class="sb-nav-link-icon"></div><i class="fas fa-broom fa-lg"></i></button>		 
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
		include "../js/myjava_referencias.php"; 
		include "../js/select.php"; 	
		include "../js/functions.php"; 
		include "../js/myjava_cambiar_pass.php"; 		
	?>  
</body>
</html>