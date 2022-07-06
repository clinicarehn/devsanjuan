<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['proveedores_id'])){
		require_once "../controladores/proveedoresControlador.php";
		$insProveedores = new proveedoresControlador();
		
		echo $insProveedores->delete_proveedores_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}