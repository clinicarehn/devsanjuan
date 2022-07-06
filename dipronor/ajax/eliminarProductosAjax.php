<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['productos_id'])){
		require_once "../controladores/productosControlador.php";
		$insProductos = new productosControlador();
		
		echo $insProductos->delete_productos_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}