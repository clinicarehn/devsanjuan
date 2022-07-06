<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['secuencia_facturacion_id']) && isset($_POST['cai_secuencia']) && isset($_POST['prefijo_secuencia']) && isset($_POST['relleno_secuencia']) && isset($_POST['incremento_secuencia']) && isset($_POST['siguiente_secuencia']) && isset($_POST['rango_inicial_secuencia']) && isset($_POST['rango_final_secuencia']) && isset($_POST['fecha_activacion_secuencia']) && isset($_POST['fecha_limite_secuencia']) && isset($_POST['estado_secuencia'])){
		require_once "../controladores/secuenciaFacturacionControlador.php";
		$insSecuenciaFacturacion = new secuenciaFacturacionControlador();
		
		echo $insSecuenciaFacturacion->edit_secuencia_facturacion_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}