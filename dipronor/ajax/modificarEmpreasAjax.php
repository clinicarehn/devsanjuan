<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['empresa_id']) && isset($_POST['empresa_empresa']) && isset($_POST['telefono_empresa']) && isset($_POST['correo_empresa']) && isset($_POST['rtn_empresa']) && isset($_POST['direccion_empresa'])){
		require_once "../controladores/empresaControlador.php";
		$insProveedores = new empresaControlador();
		
		echo $insProveedores->edit_empresa_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}