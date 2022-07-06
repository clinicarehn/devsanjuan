<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['usuarios_id'])){
		require_once "../controladores/usuarioControlador.php";
		$insUsers = new usuarioControlador();
		
		echo $insUsers->delete_user_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}