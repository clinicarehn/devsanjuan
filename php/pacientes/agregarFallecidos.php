<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();
date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['expediente'];

$conutar = mysql_query("SELECT expediente");
$fecha = date("Y-m-d");
$servicio = $_POST['servicio'];
$colaborador = $_POST['medico_general'];
$diagnostico = $_POST['diagnostico'];
$comentario = cleanStringStrtolower($_POST['motivo']);
$usuario = $_SESSION['colaborador_id'];
$status = 3;

//CONSULTAR PACIENTE
$consultar_paciente = "SELECT pacientes_id 
     FROM pacientes 
	 WHERE expediente = '$expediente'";
$result = $mysqli->query($consultar_paciente);
$consultar_paciente2 = $result->fetch_assoc();
$pacientes_id = $consultar_paciente2['pacientes_id'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(depurado_id) AS max, COUNT(depurado_id) AS count 
    FROM depurados";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	
//VERIFICAMOS EL PROCESO

if ($proceso = 'Registro'){
	
   //CONSULTAR Registro
   $consultar_registro = "SELECT depurado_id 
         FROM depurados 
         WHERE fecha = '$fecha' and expediente = '$expediente'"; 
   $result = $mysqli->query($consultar_registro);

   if($result->num_rows>0){
	   echo 2; //REGISTRO YA EXISTE
   }else{
	   $insert = "INSERT INTO depurados VALUES('$numero', '$fecha', '$pacientes_id', '$expediente', '$diagnostico', '$fecha', '$status', '$usuario', '$colaborador','$servicio','$comentario')";
	   $mysqli->query($insert);
	   
	   $update = "UPDATE pacientes SET status = '$status' WHERE pacientes_id = '$pacientes_id'";
	   $mysqli->query($update);
	   
       echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
   }  
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>