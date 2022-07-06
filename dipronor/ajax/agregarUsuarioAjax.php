<?php
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['usuarios_colaborador_id']) && isset($_POST['colaborador_id_usuario']) && isset($_POST['nickname']) && isset($_POST['privilegio_id']) && isset($_POST['correo_usuario']) && isset($_POST['empresa_usuario']) && isset($_POST['tipo_user']) && isset($_POST['usuarios_activo'])){
		require_once "../controladores/usuarioControlador.php";
		$insUsuario = new usuarioControlador();

		echo $insUsuario->agregar_usuario_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}