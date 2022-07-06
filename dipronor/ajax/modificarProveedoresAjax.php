<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['proveedores_id']) && isset($_POST['nombre_proveedores']) && isset($_POST['apellido_proveedores']) && isset($_POST['rtn_proveedores']) && isset($_POST['departamento_proveedores']) && isset($_POST['municipio_proveedores']) && isset($_POST['dirección_proveedores']) && isset($_POST['telefono_proveedores']) && isset($_POST['correo_proveedores'])){
		require_once "../controladores/proveedoresControlador.php";
		$insProveedores = new proveedoresControlador();
		
		echo $insProveedores->edit_proveedores_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}