<?php
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_GET['token'])){
		require_once "../controladores/loginControlador.php";		
		
		$logout = new loginControlador();
		
		echo $logout->cerrar_sesion_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}
