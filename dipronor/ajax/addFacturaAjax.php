<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	if(isset($_POST['cliente_id']) && isset($_POST['cliente']) && isset($_POST['fecha']) && isset($_POST['colaborador_id']) && isset($_POST['colaborador'])){
		require_once "../controladores/facturasControlador.php";
		$insFacturas = new facturasControlador();
		
		echo $insFacturas->agregar_facturas_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}