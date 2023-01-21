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
$comentario = mb_convert_case("Ingreso al Modulo Reoirte de Patologías", MB_CASE_TITLE, "UTF-8");

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
    <meta name="author" content="CLINICARE" />
    <meta name="description" content="Responsive Websites Orden Hospitalaria de San Juan de Dios">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Reporte Agenda :: <?php echo $empresa; ?></title>
	<?php include("script_css.php"); ?>	
</head>
<body>
   <!--Ventanas Modales-->

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
		<li class="breadcrumb-item" id="acciones_atras"><a class="breadcrumb-link" href="#" id="ancla_volver"><span id="label_acciones_volver">Home</a></li>
		<li class="breadcrumb-item active" id="acciones_receta">Reporte Patologías</li>
	</ol>

	<div class="card mb-4">
        <div class="card-body">
			<form class="form-inline" id="form_main_reporte_patologia">
				<div class="form-group mx-sm-3 mb-1">
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>Departamentos</span>
							<select id="departamentos" name="departamentos" class="selectpicker" title="Departamentos" data-live-search="true">
							</select>
						</div>	
					</div>
				</div>	
				<div class="form-group mx-sm-3 mb-1">
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>Municipios</span>
							<select id="municipios" name="municipios" class="selectpicker" title="Municipios" data-live-search="true">
							</select>
						</div>	
					</div>
				</div>	
				<div class="form-group mx-sm-3 mb-1">
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>Servicio</span>
							<select id="servicio" name="servicio" class="selectpicker" title="Servicio" data-live-search="true">
							</select>
						</div>	
					</div>
				</div>	
				<div class="form-group mx-sm-3 mb-1">
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>Puesto</span>
							<select id="unidad" name="unidad" class="selectpicker" title="Puesto" data-live-search="true">
							</select>
						</div>	
					</div>
				</div>
				<div class="form-group mx-sm-3 mb-1">
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>Colaborador</span>
							<select id="colaborador" name="colaborador" class="selectpicker" title="Colaborador" data-live-search="true">
							</select>
						</div>	
					</div>
				</div>											
				<div class="form-group mx-sm-3 mb-1">
					<div class="input-group">				
						<div class="input-group-append">				
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>Inicio</span>
						</div>
						<input type="date" required id="fechai" name="fechai" value="<?php 
						$fecha = date ("Y-m-d");
						
						$año = date("Y", strtotime($fecha));
						$mes = date("m", strtotime($fecha));
						$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

						$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
						$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

						$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
						$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));						
						
						
						echo $fecha_inicial;
					?>" class="form-control" data-toggle="tooltip" data-placement="top" title="Fecha Inicio" style="width:165px;">
					</div>
				  </div>	
				  <div class="form-group mx-sm-3 mb-1">
				 	<div class="input-group">				
						<div class="input-group-append">				
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>Fin</span>
						</div>
						<input type="date" required id="fechaf" name="fechaf" value="<?php echo date ("Y-m-d");?>" class="form-control" data-toggle="tooltip" data-placement="top" title="Fecha Fin" style="width:165px;">
					</div>
				  </div>  				  
			</form>          
        </div>
    </div>
	
    <div class="options clearfix">
        <div class="ck-label">						
            <label for="">Mostrar/Ocultar</label>
        </div>															
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="departamento" checked="checked"><span>Departamentos</span></label>
        </div>
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="municipio" checked="checked"><span>Municipios</span></label>
        </div>		
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="patologia" checked="checked"><span>Patología</span></label>
        </div>															
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="0_4" checked="checked"><span>0 a 4 años</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="5_10" checked="checked"><span>5 a 10 años</span></label>
        </div>	
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="11_20" checked="checked"><span>11 a 20 años</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="21_30" checked="checked"><span>21 a 30 años</span></label>
        </div>															
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="31_40" checked="checked"><span>31 a 40 años</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="41_50" checked="checked"><span>41 a 50 años</span></label>
        </div>	
		
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="51_60" checked="checked"><span>51 a 60 años</span></label>
        </div>	
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="61_mas" checked="checked"><span>61 o más</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="mujeres" checked="checked"><span>Mujeres</span></label>
        </div>															
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="hombres" checked="checked"><span>Hombres</span></label>
        </div>		
    </div>  	
	<br/>

    <div class="card mb-4">
		<div class="card mb-4">
			<div class="card-header">
				<i class="fab fa-sellsy mr-1"></i>
				Reporte Patologías
			</div>
			<div class="card-body"> 
				<form id="formReporteAgenda">
					<div class="table-responsive">
						<table id="dataTableReportePatologia" class="table display" style="width:100%">
							<thead>
								<tr>
									<th class="departamento">Departamentos</th>
									<th class="municipio">Municipios</th>
									<th class="patologia">Patologia</th>
									<th class="0_4">0 a 4 años</th>
									<th class="5-10">5 a 10 años</th>
									<th class="11-20">11 a 20 años</th>
									<th class="21-30">21 a 30 años</th>
									<th class="31_40">31 a 40 años</th>
									<th class="41_50">41 a 50 años</th>
									<th class="51-60">51 a 60 años</th>
									<th class="61_mas">61 o más</th>
									<th clss="mujeres">Mujeres</th>
									<th class="hombres">Hombres</th>																											
									<th class="total">Total</th>
								</tr>
							</thead>						
						</table>  
					</div>  
				</form>                
			</div>
			<div class="card-footer small text-muted">

			</div>
		</div>
	</div>

	<?php include("templates/receta.php"); ?>
    <?php include("templates/footer.php"); ?>
</div>

    <!-- add javascripts -->
	<?php
		include "script.php";
		include "../js/main.php";
		include "../js/myjava_reporte_patologia_departamentos.php";
		include "../js/select.php";
		include "../js/functions.php";
		include "../js/myjava_cambiar_pass.php";
	?>
</body>
</html>