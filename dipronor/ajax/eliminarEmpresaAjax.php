<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['empresa_id'])){
		require_once "../controladores/empresaControlador.php";
		$insProveedores = new empresaControlador();
		
		echo $insProveedores->delete_empresa_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}