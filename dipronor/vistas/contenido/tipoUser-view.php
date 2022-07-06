<div class="container-fluid">
    <ol class="breadcrumb mt-2 mb-4">
        <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?php echo SERVERURL; ?>dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active">Tipo de Usuario</li>
    </ol>
	<div class="card mb-4">
		<div class="card-header">
				<i class="fas fa-users-cog mr-1"></i>
				Tipo de Usuario
		</div>
		<div class="card-body"> 
				<div class="table-responsive">
					<table id="dataTableTipoUser" class="table table-striped table-condensed table-hover" style="width:100%">
						<thead>
							<tr>
								<th>Descripción</th>
								<th>Editar</th>	
								<th>Eliminar</th>
							</tr>
						</thead>
					</table>  
				</div>                   
				</div>
			<div class="card-footer small text-muted">
 			<?php
				require_once "./core/mainModel.php";
				
				$insMainModel = new mainModel();
				$entidad = "tipo_user";
				$consulta_last_update = $insMainModel->getlastUpdate($entidad)->fetch_assoc();
				$fecha_registro = $consulta_last_update['fecha_registro'];
				$hora = date('g:i:s a',strtotime($fecha_registro));
								
				echo "Última Actualización ".$insMainModel->getTheDay($fecha_registro, $hora);			
			?>
			</div>
		</div>
	</div>	

<?php
	$insMainModel->guardar_historial_accesos("Ingreso al modulo Tipo Usuario");
?>