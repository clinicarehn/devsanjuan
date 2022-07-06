<?php
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();

	$facturas_id = $_POST['facturas_id'];

	//CONSULTAR DATOS DEL METODO DE PAGO
	$result = $insMainModel->getDatosFactura($facturas_id); 
     
	$cliente = "";
	$fecha_factura = "";
	$importe = 0;

	//OBTENEMOS LOS VALORES DEL REGISTRO
	if($result->num_rows>0){
		$consulta_registro = $result->fetch_assoc(); 
		$cliente = $consulta_registro['cliente'];
		$fecha_factura = $consulta_registro['fecha_factura'];	
	}

	$result_factura = $insMainModel->getDetalleProductosFactura($facturas_id);

	while($registro2 = $result_factura->fetch_assoc()){
		$cantidad = $registro2['cantidad'];
		$precio = $registro2['precio'];
		$descuento = $registro2['descuento'];
		$isv_valor = $registro2['isv_valor'];
		$importe += (($cantidad * $precio) - $descuento) + $isv_valor;
	}	

	$datos = array(
		 0 => $cliente, 
		 1 => $fecha_factura, 
		 2 => $importe,	 
	);	
	echo json_encode($datos);
?>