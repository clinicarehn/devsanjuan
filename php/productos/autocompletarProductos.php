<?php
session_start();
include('../conexion-postgresql.php');
include('../funtions.php');

//CONEXION A DB
//LEER ARCHIVO DE CONFIGURACION PARA LA CONEXION	
$conexion = conectar();	

$html = '';
$key = $_POST['key'];

$query = "SELECT pp.default_code AS codigo, pp.name_template AS producto, x_concentracion AS concentracion, pu.name AS unidad, x_codigo_atc AS codigo_atc
     FROM product_product AS pp
     INNER JOIN product_template AS pt
     ON pp.product_tmpl_id = pt.id
     INNER JOIN product_uom pu
     ON pt.uom_id = pu.id
	 WHERE pt.type = 'product' AND pt.sale_ok = 't' AND pp.name_template LIKE '".strip_tags($key)."%'
	 ORDER BY pp.name_template";
$result = pg_query($conexion, $query); 

while ($row = pg_fetch_array($result)) { 
    $producto_ = cleanString(str_replace($row['concentracion'], "", $row['producto']));
	$producto = $producto_.' '.$row['concentracion'].' '.$row['unidad'].'';
	
	$html .= '<div><a style="text-decoration:none;" class="suggest-element" data="'.utf8_encode($producto).'" id="'.$row['codigo'].'">'.utf8_encode($producto).'</a></div>';
}
echo $html;
?>