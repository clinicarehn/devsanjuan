<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['clientes_id'])){
		require_once "../controladores/clientesControlador.php";
		$insClientes = new clientesControlador();
		
		echo $insClientes->delete_clientes_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}