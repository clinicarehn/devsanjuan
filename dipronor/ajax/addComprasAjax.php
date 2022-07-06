<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	if(isset($_POST['proveedores_id']) && isset($_POST['proveedor']) && isset($_POST['facturaPurchase']) && isset($_POST['colaborador_id']) && isset($_POST['colaborador'])){
		require_once "../controladores/comprasControlador.php";
		$insFacturas = new comprasControlador();
		
		echo $insFacturas->agregar_compras_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}