<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	if(isset($_POST['cliente']) && isset($_POST['fecha']) && isset($_POST['tipo_pago_id'])){
		require_once "../controladores/pagoFacturaControlador.php";
		$insFacturas = new pagoFacturaControlador();
		
		echo $insFacturas->agregar_pago_factura_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}