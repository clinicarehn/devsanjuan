<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['ubicacion_ubicacion']) && isset($_POST['ubicacion_id'])){
		require_once "../controladores/ubicacionControlador.php";
		$insPuestos = new ubicacionControlador();
		
		echo $insPuestos->delete_ubicacion_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}