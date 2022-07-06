<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['privilegios_nombre'])){
		require_once "../controladores/privilegioControlador.php";
		$insVarios = new privilegioControlador();
		
		echo $insVarios->agregar_privilegio_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}