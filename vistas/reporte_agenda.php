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
$comentario = mb_convert_case("Ingreso al Modulo Reoirte de Agenda", MB_CASE_TITLE, "UTF-8");

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
		<li class="breadcrumb-item active" id="acciones_receta">Reporte Agenda</li>
	</ol>

	<div class="card mb-4">
        <div class="card-body">
			<form class="form-inline" id="form_main_reporte_agenda">
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
								<option value="">Seleccione</option>
								</select>
						</div>	
					</div>
				</div>	
				<div class="form-group mx-sm-3 mb-1">
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>Vendedor</span>
							<select id="colaborador" name="colaborador" class="selectpicker" title="Colaborador" data-live-search="true">
								<option value="">Seleccione</option>
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
            <label><input type="checkbox" value="1" name="servicio" checked="checked"><span>Servicio</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="tipo" checked="checked"><span>Tipo</span></label>
        </div>															
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="dia1" checked="checked"><span>1</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="dia2" checked="checked"><span>2</span></label>
        </div>	
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="dia3" checked="checked"><span>3</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="dia4" checked="checked"><span>4</span></label>
        </div>															
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="dia5" checked="checked"><span>5</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="dia6" checked="checked"><span>6</span></label>
        </div>	
		
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="dia7" checked="checked"><span>7</span></label>
        </div>	
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="dia8" checked="checked"><span>8</span></label>
        </div>
        <div class="ck-button">
            <label><input type="checkbox" value="1" name="dia9" checked="checked"><span>9</span></label>
        </div>															
        <div class="ck-button">						
            <label><input type="checkbox" value="1" name="dia10" checked="checked"><span>10</span></label>
        </div>		
    </div>  	
	<br/>

    <div class="card mb-4">
		<div class="card mb-4">
			<div class="card-header">
				<i class="fab fa-sellsy mr-1"></i>
				Reporte Agenda
			</div>
			<div class="card-body"> 
				<form id="formReporteAgenda">
					<div class="table-responsive">
						<table id="dataTableReporteAgenda" class="display" style="width:100%">
							<thead>
								<tr>
									<th class="servicio">Servicio</th>
									<th class="tipo">Tipo</th>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
									<th>5</th>
									<th>6</th>
									<th>7</th>
									<th>8</th>
									<th>9</th>
									<th>10</th>
									<th>11</th>
									<th>12</th>
									<th>13</th>
									<th>14</th>
									<th>15</th>
									<th>16</th>
									<th>17</th>
									<th>18</th>
									<th>19</th>
									<th>20</th>
									<th>21</th>
									<th>22</th>
									<th>23</th>
									<th>24</th>
									<th>25</th>
									<th>26</th>
									<th>27</th>
									<th>28</th>
									<th>29</th>
									<th>30</th>																														
									<th>31</th>
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
		include "../js/myjava_reporte_agenda.php";
		include "../js/select.php";
		include "../js/functions.php";
		include "../js/myjava_cambiar_pass.php";
	?>
</body>
</html>