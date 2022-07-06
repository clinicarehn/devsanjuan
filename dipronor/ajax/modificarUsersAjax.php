<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['usuarios_id']) && isset($_POST['correo_usuario']) && isset($_POST['tipo_user']) && isset($_POST['usuarios_activo']) && isset($_POST['privilegio_id'])){
		require_once "../controladores/usuarioControlador.php";
		$insUsers = new usuarioControlador();
		
		echo $insUsers->edit_user_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}