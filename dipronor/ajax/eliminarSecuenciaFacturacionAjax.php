<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['secuencia_facturacion_id'])){
		require_once "../controladores/secuenciaFacturacionControlador.php";
		$insSecuenciaFacturacion = new secuenciaFacturacionControlador();
		
		echo $insSecuenciaFacturacion->delete_secuencia_facturacion_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}