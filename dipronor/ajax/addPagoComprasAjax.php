<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	if(isset($_POST['proveedorPurchase']) && isset($_POST['fechaPurchase']) && isset($_POST['tipo_pago_idPurchase'])){
		require_once "../controladores/pagoCompraControlador.php";
		$insPagosCompras = new pagoCompraControlador();
		
		echo $insPagosCompras->agregar_pago_compra_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}