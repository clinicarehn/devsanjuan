<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";

	
	if(isset($_POST['productos_id']) && isset($_POST['producto']) && isset($_POST['descripcion']) && isset($_POST['cantidad']) && isset($_POST['precio_compra']) && isset($_POST['precio_venta'])){
		require_once "../controladores/productosControlador.php";
		$insProductos = new productosControlador();
		
		echo $insProductos->edit_productos_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}