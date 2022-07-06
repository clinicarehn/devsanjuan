<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['privilegio_id_']) && isset($_POST['privilegios_nombre'])){
		require_once "../controladores/privilegioControlador.php";
		$insPrivilegio = new privilegioControlador();
		
		echo $insPrivilegio->edit_privilegio_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}