<?php
session_start();
include('../conexion-postgresql.php');
include('../funtions.php');

//CONEXION A DB
//LEER ARCHIVO DE CONFIGURACION PARA LA CONEXION
$conexion = conectar();
   
//CONSULTAR LOS MEDICAMENTOS
$query = "SELECT pp.id AS template_codigo, pp.default_code AS codigo, pp.name_template AS producto, x_concentracion AS concentracion, pu.name AS unidad, x_codigo_atc AS codigo_atc
     FROM product_product AS pp
     INNER JOIN product_template AS pt
     ON pp.product_tmpl_id = pt.id
     INNER JOIN product_uom pu
     ON pt.uom_id = pu.id
     WHERE pt.type = 'product' AND pt.sale_ok = 't'
	 ORDER BY pp.default_code";
	 
$resultado_busqueda = pg_query($conexion, $query); 

$data = array();
while( $row = pg_fetch_array($resultado_busqueda)){
   $producto = cleanString(str_replace($row['concentracion'], "", $row['producto']));
   $data[] = array( 
      "template_codigo"=>$row['template_codigo'],
      "codigo"=>$row['codigo'],
      "producto"=>$producto,
      "concentracion"=>$row['concentracion'],
      "unidad"=>$row['unidad']
  );
}

$arreglo = array(
    "echo" => 1,
    "totalrecords" => count($data),
    "totaldisplayrecords" => count($data),
    "data" => $data
);

echo json_encode($arreglo);
?>