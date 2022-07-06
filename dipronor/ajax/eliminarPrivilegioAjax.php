<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['privilegio_id_'])){
		require_once "../controladores/privilegioControlador.php";
		$insPrivilegio = new privilegioControlador();
		
		echo $insPrivilegio->delete_privilegio_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}