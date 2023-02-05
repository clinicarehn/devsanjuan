<?php
session_start();
include('../conexion-postgresql.php');

//CONEXION A DB
//LEER ARCHIVO DE CONFIGURACION PARA LA CONEXION
$mysqli = connect_mysqli();
$otro_medicamento = 'Otro';

//CONSULTAR LOS MEDICAMENTOS
$query = "SELECT pt.id as product_template_id, pp.id AS product_id, pp.default_code AS codigo, pp.name_template AS producto, x_concentracion AS concentracion, pu.name AS unidad, x_codigo_atc AS codigo_atc
     FROM product_product AS pp
     INNER JOIN product_template AS pt
     ON pp.product_tmpl_id = pt.id
     INNER JOIN product_uom pu
     ON pt.uom_id = pu.id
     WHERE pt.type = 'product' AND pt.sale_ok = 't'";

$resultado_busqueda = pg_query($conexion, $query);
$consulta2 = pg_fetch_array($resultado_busqueda);

if(pg_num_rows($resultado_busqueda)>0){
	 while($consulta2 = pg_fetch_array($resultado_busqueda)){
	    echo '<option value="'.$consulta2['producto'].'">'.'['.$consulta2['codigo'].'] '.$consulta2['producto'].'</option>';
	 }
     echo '<option value="'.$otro_medicamento.'">'.$otro_medicamento.'</option>';
}
?>
