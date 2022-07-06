<?php
$fecha = $_POST['fecha'];

$fecha_ = date("w", strtotime($fecha));

echo $fecha_;
?>