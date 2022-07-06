<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['movimiento_categoria']) && isset($_POST['movimiento_producto']) && isset($_POST['movimiento_operacion']) && isset($_POST['movimiento_cantidad'])){
		require_once "../controladores/movimientoProductosControlador.php";
		$insMovimientoProductos = new movimientoProductosControlador();
		
		echo $insMovimientoProductos->agregar_movimiento_productos_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}