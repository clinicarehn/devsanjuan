<?php
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_GET['inputEmail']) && isset($_GET['inputPassword'])){
		require_once "../controladores/loginControlador.php";
		$login = new loginControlador();
		
		echo $login->iniciar_sesion_controlador();

	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}
