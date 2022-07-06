	<div class="container-fluid">
    <ol class="breadcrumb mt-2 mb-4">
        <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?php echo SERVERURL; ?>dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active">Bitacora</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
			<form class="form-inline" id="formMainBitacora" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
			  <div class="form-group mb-3">
				<label for="inputFechaInicial" class="mr-1">Fecha Inicial</label>
				<input type="date" class="form-control" id="fechai" name="fechai" value="<?php echo date('Y-m-d');?>">
			  </div>
			  <div class="form-group mx-sm-3 mb-3">
				<label for="inputFechaFinal" class="mr-1">Fecha Final</label>
				<input type="date" class="form-control" id="fechaf" name="fechaf" value="<?php echo date('Y-m-d');?>" >
			  </div>
			</form>	           
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-sliders-h mr-1"></i>
            Bitacora
        </div>
        <div class="card-body"> 
            <div class="table-responsive">
                <table id="dataTableBitacora" class="table table-striped table-condensed table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>							
                            <th>Tipo</th>
                            <th>Colaborador</th>						
                        </tr>
                    </thead>
                </table>  
            </div>                   
            </div>
        <div class="card-footer small text-muted">
			<?php
				require_once "./core/mainModel.php";
				
				$insMainModel = new mainModel();
				$entidad = "bitacora";
				$consulta_last_update = $insMainModel->getlastUpdate($entidad)->fetch_assoc();
				$fecha_registro = $consulta_last_update['fecha_registro'];
				$hora = date('g:i:s a',strtotime($fecha_registro));
				echo "Última Actualización ".$insMainModel->getTheDay($fecha_registro, $hora);		
			?>
        </div>
    </div>
</div>

<?php
	$insMainModel->guardar_historial_accesos("Ingreso al modulo Bitacora");
?>