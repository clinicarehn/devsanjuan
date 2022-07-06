<?php	
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();
	
	$productos_id  = $_POST['productos_id'];
	$result = $insMainModel->getTipoProductosEdit($productos_id);
	$valores2 = $result->fetch_assoc();
	
	$datos = array(
		0 => $valores2['almacen_id'],
		1 => $valores2['medida_id'],
		2 => $valores2['nombre'],
		3 => $valores2['descripcion'],
		4 => $valores2['cantidad'],
		5 => $valores2['precio_compra'],
		6 => $valores2['precio_venta'],
		7 => $valores2['categoria_producto_id'],
		8 => $valores2['isv_venta'],	
		9 => $valores2['isv_compra'],	
		10 => $valores2['estado'],			
	);
	echo json_encode($datos);