<?php	
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();
	
	$almacen_id = $_POST['almacen_id'];
	$result = $insMainModel->getAlmacenEdit($almacen_id);
	$valores2 = $result->fetch_assoc();
	
	$datos = array(
		0 => $valores2['ubicacion_id'],
		1 => $valores2['nombre'],
		2 => $valores2['estado'],		
	);
	echo json_encode($datos);