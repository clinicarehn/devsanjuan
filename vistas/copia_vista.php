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
    <meta name="author" content="Script Tutorials" />
    <meta name="description" content="Responsive Websites Orden Hospitalaria de San Juan de Dios">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pacientes :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>   
	
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../css/error_bien.css" type="text/css" media="screen">		
    <link rel="stylesheet" href="../login/css/all.css" type="text/css" media="screen"><!--//USO DE ICONOS font awesome-->     
    <link rel="shortcut icon" href="../img/logo1.png" type="text/css" media="screen">		
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
		<li class="breadcrumb-item active" id="acciones_factura"><span id="label_acciones_factura"></span>Pacientes</li>
	</ol>

    <form class="form-inline" id="form_main">
	  <div class="form-group mr-1">
		<select id="estado" name="estado" class="custom-select" style="width:200px;" data-toggle="tooltip" data-placement="top" title="Estado">
			<option value="">Estado</option>
		</select>		   
      </div>	
	  <div class="form-group mr-1">
		<select id="tipo" name="tipo" class="custom-select" style="width:200px;" data-toggle="tooltip" data-placement="top" title="Tipo">
			<option value="">Tipo</option>
		</select>		   
      </div>	  
      <div class="form-group mr-1">
         <input type="text" placeholder="Buscar por: Expediente, Nombre, Apellido, Identidad o Teléfono Principal" data-toggle="tooltip" data-placement="top" title="Buscar por: Expediente, Nombre, Apellido, Identidad o Teléfono Principal" id="bs-regis" autofocus class="form-control" size = "80" autofocus />
      </div>
	  <div class="form-group">
		<div class="dropdown show" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
		  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <i class="fas fa-user-plus fa-lg"></i>
		  </a>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#" id="nuevo-registro">Registro de Usuarios</a>
			<a class="dropdown-item" href="#" id="profesion">Registro de Profesiones</a>		
		  </div>
		</div>		  
	  </div> 	  
      <div class="form-group">
	    <button class="btn btn-success ml-1" type="submit" id="reporte" data-toggle="tooltip" data-placement="top" title="Exportar"><div class="sb-nav-link-icon"></div><i class="fas fa-download fa-lg"></i></button>
      </div>	
      <div class="form-group">
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
	<?php include("script.php"); ?>
	
	<script src="../js/menu-despelgable.js"></script>
	<script src="../js/myjava_pacientes.js"></script>
    <script src="../js/select.js"></script>	
    <script src="../js/session.js"></script>		
    <script src="../js/functions.js"></script>
	<script src="../js/myjava_cambiar_pass.js"></script>
	<script src="../js/session.js"></script>  
</body>
</html>