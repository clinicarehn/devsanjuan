<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['tipo_user_id'])){
		require_once "../controladores/tipoUsuarioControlador.php";
		$insTipoUsuario = new tipoUsuarioControlador();
		
		echo $insTipoUsuario->delete_tipo_usuario_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}