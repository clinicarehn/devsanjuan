<?php  
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();
date_default_timezone_set('America/Tegucigalpa');

$nombre_host = getRealIP();	
$fecha = date("Y-m-d H:i:s");
if(isset($_SESSION['colaborador_id'])){
 $colaborador_id = $_SESSION['colaborador_id'];  
}else{
   $colaborador_id = "";
}

$comentario = mb_convert_case("Salio del Sistema", MB_CASE_TITLE, "UTF-8");   

//OBTENER CORRELATIVO
$query = "SELECT MAX(acceso_id) AS max, COUNT(acceso_id) AS count 
   FROM historial_acceso";
$result = $mysqli->query($query);    

$correlativo2=$result->fetch_assoc();    

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
  $numero = 1;
else
  $numero = $numero + 1;

if($colaborador_id != "" || $colaborador_id != null){
  $insert = "INSERT INTO historial_acceso 
	  VALUES('$numero','$fecha','$colaborador_id','$nombre_host','$comentario')";
  $mysqli->query($insert);  
}

session_unset();
session_destroy();
header('Location: ../../index.php');
exit(0);
?>  