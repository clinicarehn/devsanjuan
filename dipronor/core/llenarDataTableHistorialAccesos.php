<?php	
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();
	$fechai = $_POST['fechai'];
	$fechaf = $_POST['fechaf'];
	
	$result = $insMainModel->getHistorialAccesos($fechai, $fechaf);
	
	$arreglo = array();
	
	while($data = $result->fetch_assoc()){
		$arreglo["data"][] = $data;
	}
	
	echo json_encode($arreglo);