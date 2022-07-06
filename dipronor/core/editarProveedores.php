<?php	
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();
	
	$proveedores_id  = $_POST['proveedores_id'];
	$result = $insMainModel->getProveedoresEdit($proveedores_id);
	$valores2 = $result->fetch_assoc();
	
	$datos = array(
		0 => $valores2['nombre'], 
		1 => $valores2['apellido'], 
		2 => $valores2['rtn'],
		3 => $valores2['fecha'],
		4 => $valores2['departamentos_id'],
		5 => $valores2['municipios_id'],
		6 => $valores2['localidad'],
		7 => $valores2['telefono'],
		8 => $valores2['correo'],	
		9 => $valores2['estado'],						
	);
	echo json_encode($datos);