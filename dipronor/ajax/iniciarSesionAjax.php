<?php
	$peticionAjax = true;
	require_once "../core/configGenerales.php";

	if(isset($_POST['inputEmail']) && isset($_POST['inputPassword'])){
		require_once "../controladores/loginControlador.php";
		require_once "../core/mainModel.php";
		
		$login = new loginControlador();
		
		echo $login->iniciar_sesion_controlador();
	
		$insMainModel = new mainModel();

		//mainModel::guardar_historial_accesos("Inicio de Sesion");
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}
