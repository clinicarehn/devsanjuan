<?php
session_start();
include('../php/funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php');
}

$_SESSION['menu'] = "Colas";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();
$fecha = date("Y-m-d H:i:s");
$comentario = mb_convert_case("Ingreso al Modulo de Colas", MB_CASE_TITLE, "UTF-8");

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
    <title>Colas :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>
</head>
<body>
   <!--Ventanas Modales-->
    <div class="modal fade" id="citaSeguimientoColas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Información Usuario</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
    			<form id="formCitaSeguimientoColas">
            <div class='form-row'>
            	<div class='col-md-12 mb-6 sm-3'>
            	  <p id="datos_usuario_cita_seguimiento_title"></p>
            	</div>
            </div>
            <div class='form-row'>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="nombre_seguimiento"></p>
            	</div>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="identidad_seguimiento"></p>
            	</div>
              <div class='col-md-4 mb-6 sm-3'>
            	  <p id="expediente_seguimiento"></p>
            	</div>
            </div>
            <div class='form-row'>
            	<div class='col-md-12 mb-6 sm-3'>
            	  <p id="cita_seguimiento_title"></p>
            	</div>
            </div>
            <div class='form-row'>
              <div class='col-md-4 mb-6 sm-3'>
            	  <p id="tipo_cita_seguimiento"></p>
            	</div>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="profesional_seguimiento"></p>
            	</div>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="servicio_seguimiento"></p>
            	</div>
            </div>
            <div class='form-row'>
              <div class='col-md-4 mb-6 sm-3'>
            	  <p id="unidad_segumiento"></p>
            	</div>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="fecha_atencion_seguimiento"></p>
            	</div>
            </div>
            <div class='form-row'>
            	<div class='col-md-12 mb-6 sm-3'>
            	  <p id="descripcion_seguimiento"></p>
            	</div>
            </div>


            <div class='form-row'>
            	<div class='col-md-12 mb-6 sm-3'>
            	  <p id="datos_usuario_cita_seguimiento_title1"></p>
            	</div>
            </div>
            <div class='form-row'>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="nombre_seguimiento1"></p>
            	</div>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="identidad_seguimiento1"></p>
            	</div>
              <div class='col-md-4 mb-6 sm-3'>
            	  <p id="expediente_seguimiento1"></p>
            	</div>
            </div>
            <div class='form-row'>
            	<div class='col-md-12 mb-6 sm-3'>
            	  <p id="cita_seguimiento_title1"></p>
            	</div>
            </div>
            <div class='form-row'>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="servicio_seguimiento1"></p>
            	</div>
              <div class='col-md-4 mb-6 sm-3'>
            	  <p id="profesional_seguimiento1"></p>
            	</div>
            	<div class='col-md-4 mb-6 sm-3'>
            	  <p id="tipo_cita_seguimiento1"></p>
            	</div>
            </div>
            <div class='form-row'>
            	<div class='col-md-12 mb-6 sm-3'>
            	  <p id="fecha_atencion_seguimiento1"></p>
            	</div>
            </div>
            <div class='form-row'>
            	<div class='col-md-12 mb-6 sm-3'>
            	  <p id="descripcion_seguimiento1"></p>
            	</div>
            </div>
    			</form>
         </div>
    	  <div class="modal-footer">
    		<button class="btn btn-success ml-2" type="submit" id="okay" data-dismiss="modal"><div class="sb-nav-link-icon"></div><i class="fas fa-thumbs-up fa-lg"></i> Okay</button>
    	  </div>
       </div>
     </div>
    </div>

  <?php include("templates/modals.php"); ?>

<!--INICIO MODAL-->
   <?php include("modals/modals.php");?>
<!--FIN MODAL-->

   <!--Fin Ventanas Modales-->
	<!--MENU-->
       <?php include("templates/menu.php"); ?>
    <!--FIN MENU-->

<br><br><br>
<div class="container-fluid">
	<ol class="breadcrumb mt-2 mb-4">
		<li class="breadcrumb-item" id="acciones_atras"><a class="breadcrumb-link" href="#" id="ancla_volver"><span id="label_acciones_volver"></a></li>
		<li class="breadcrumb-item active" id="acciones_receta"><span id="label_acciones_receta"></span></li>
	</ol>

	<form id="formColas">
		<div class="table-responsive">
			<table id="dataTableColas" class="table table-striped table-condensed table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Posición</th>
						<th>Hora</th>
						<th>Identidad</th>
						<th>Expediente</th>
						<th>Usuario</th>
						<th>Teléfono</th>
						<th>Edad</th>
						<th>Profesional</th>
						<th>Servicio</th>
						<th>Seguimiento</th>
						<th>Receta</th>
						<th>Remover</th>
					</tr>
				</thead>
			</table>
		</div>
	</form>
	<?php include("templates/receta.php"); ?>
    <?php include("templates/footer.php"); ?>
</div>

    <!-- add javascripts -->
	<?php
		include "script.php";

		include "../js/main.php";
		include "../js/myjava_colas.php";
		include "../js/select.php";
		include "../js/functions.php";
		include "../js/myjava_cambiar_pass.php";
	?>
</body>
</html>
