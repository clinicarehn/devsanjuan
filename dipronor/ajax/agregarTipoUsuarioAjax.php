<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['tipo_usuario_nombre'])){
		require_once "../controladores/tipoUsuarioControlador.php";
		$insVarios = new tipoUsuarioControlador();
		
		echo $insVarios->agregar_tipo_usuario_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}