<?php
session_start();
include('../php/funtions.php');
//CONEXION A DB
$mysqli = connect_mysqli();

if( isset($_SESSION['colaborador_id']) == false ){
   header('Location: login.php');
}

$_SESSION['menu'] = "Reporte Receta Electrónica";

if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];
}else{
   $colaborador_id = "";
}

$type = $_SESSION['type'];

$nombre_host = getRealIP();
$fecha = date("Y-m-d H:i:s");
$comentario = mb_convert_case("Ingreso al Modulo Reporte Programacion de Citas", MB_CASE_TITLE, "UTF-8");

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
    <title>Reporte Receta Electrónica :: <?php echo $empresa; ?></title>
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
		<li class="breadcrumb-item" id="acciones_atras"><a class="breadcrumb-link" href="#" id="ancla_volver"><span id="label_acciones_volver"></a></li>
		<li class="breadcrumb-item active" id="acciones_receta"><span id="label_acciones_receta"></span></li>
	</ol>

	<form id="reporteReceta">
		<div class="table-responsive">
			<table id="dataTableReceta" class="table table-striped table-condensed table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Detalles</th>
						<th>Fecha</th>
						<th>Identidad</th>
						<th>Expediente</th>
						<th>Usuario</th>
						<th>Profesional</th>
						<th>Servicio</th>
						<th>Editar</th>
						<th>Eliminar</th>
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
		include "../js/receta.php";
		include "../js/myjava_reporte_receta.php";
		include "../js/select.php";
		include "../js/functions.php";
		include "../js/myjava_cambiar_pass.php";
	?>
</body>
</html>
