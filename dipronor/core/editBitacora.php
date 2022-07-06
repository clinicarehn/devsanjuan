<?php
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	session_start(['name'=>'SD']);
	
	$insMainModel = new mainModel();

	//ACTUALIZAMOS LA BITACORA
	$codigo_bitacora = $_SESSION['codigo_bitacora_sd'];
	$hora = date("H:m:s");
	$insMainModel->actualizar_bitacora($codigo_bitacora, $hora);
?>