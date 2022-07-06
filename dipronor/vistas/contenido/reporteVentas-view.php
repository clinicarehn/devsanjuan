<div class="container-fluid">
    <ol class="breadcrumb mt-2 mb-4">
        <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?php echo SERVERURL; ?>dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active">Reporte de Ventas</li>
    </ol>
   <div class="card mb-4">
        <div class="card-body">
			<form class="form-inline" id="form_main_ventas">
				  <div class="form-group mx-sm-3 mb-2">
					<label>Fecha Inicio</label>
					<input type="date" required id="fechai" name="fechai" value="<?php echo date ("Y-m-d");?>" class="form-control ml-1" data-toggle="tooltip" data-placement="top" title="Fecha Inicio">
				  </div>	
				  <div class="form-group mx-sm-3 mb-2">
					<label>Fecha Fin</label>
					<input type="date" required id="fechaf" name="fechaf" value="<?php echo date ("Y-m-d");?>" class="form-control ml-1" data-toggle="tooltip" data-placement="top" title="Fecha Fin">
				  </div>
			</form>          
        </div>
    </div>	
    <div class="card mb-4">
		<div class="card mb-4">
			<div class="card-header">
				<i class="fab fa-sellsy mr-1"></i>
				Reporte de Ventas
			</div>
			<div class="card-body"> 
				<div class="table-responsive">
					<table id="dataTablaReporteVentas" class="table table-striped table-condensed table-hover" style="width:100%">
						<thead>
							<tr>
							<th>Imprimir</th>	
							<th>Fecha</th>							
							<th>Cliente</th>
							<th>Factura</th>
							<th>Total</th>
							</tr>
						</thead>
					</table>  
				</div>                   
				</div>
			<div class="card-footer small text-muted">
 			<?php
				require_once "./core/mainModel.php";
				
				$insMainModel = new mainModel();
				$entidad = "facturas";
				$consulta_last_update = $insMainModel->getlastUpdate($entidad)->fetch_assoc();
				$fecha_registro = $consulta_last_update['fecha_registro'];
				$hora = date('g:i:s a',strtotime($fecha_registro));
								
				echo "Última Actualización ".$insMainModel->getTheDay($fecha_registro, $hora);			
			?>
			</div>
		</div>
	</div>

<?php
	$insMainModel->guardar_historial_accesos("Ingreso al modulo Productos");
?>