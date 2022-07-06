	<div class="container-fluid">
    <ol class="breadcrumb mt-2 mb-4">
        <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?php echo SERVERURL; ?>dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active">Cuentas por Pagar Proveedores</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-sliders-h mr-1"></i>
            Cuentas por Pagar Proveedores
        </div>
        <div class="card-body"> 
            <div class="table-responsive">
                <table id="dataTableCuentasPorPagarProveedores" class="table table-striped table-condensed table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Pagar</th>
							<th>Fecha</th>
                            <th>Cliente</th>
                            <th>Factura</th>
                            <th>Saldo</th>							
                        </tr>
                    </thead>
                </table>  
            </div>                   
            </div>
        <div class="card-footer small text-muted">
 			<?php
				require_once "./core/mainModel.php";
				
				$insMainModel = new mainModel();
				$entidad = "pagar_proveedores";
				$consulta_last_update = $insMainModel->getlastUpdate($entidad)->fetch_assoc();
				$fecha_registro = $consulta_last_update['fecha_registro'];
				$hora = date('g:i:s a',strtotime($fecha_registro));
								
				echo "Última Actualización ".$insMainModel->getTheDay($fecha_registro, $hora);			
			?>
        </div>
    </div>
</div>

<?php
	$insMainModel->guardar_historial_accesos("Ingreso al modulo Cuentas por Pagar Proveedores");
?>