<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['ubicacion_ubicacion']) && isset($_POST['empresa_ubicacion'])){
		require_once "../controladores/ubicacionControlador.php";
		$insAgregar = new ubicacionControlador();
		
		echo $insAgregar->agregar_ubicacion_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}