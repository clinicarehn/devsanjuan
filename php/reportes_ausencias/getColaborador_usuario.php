<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT c.colaborador_id AS 'colaborador_id', c.nombre AS 'nombre', c.apellido AS 'apellido'
    FROM colaboradores AS c
	INNER JOIN users AS u
	ON c.colaborador_id = u.colaborador_id
    WHERE type IN(3,4,15) AND c.estatus = 1 AND u.estatus = 1 
	ORDER BY c.nombre";
$result = $mysqli->query($consulta);	

if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';
	while($consulta2 = $result->fetch_assoc()){
		$nombre_ = explode(" ", trim(ucwords(strtolower($consulta2['nombre']), " ")));
		$nombre_usuario = $nombre_[0];
		$apellido_ = explode(" ", trim(ucwords(strtolower($consulta2['apellido']), " ")));	
		$nombre_apellido = $apellido_[0];

		$usuario_sistema_nombre = $nombre_usuario." ".$nombre_apellido;
		   
		if($usuario_sistema_nombre == ""){
		  $usuario_sistema_nombre = "HSJD";
		}else{
		  $usuario_sistema_nombre = $usuario_sistema_nombre;
		}  		
		
		echo '<option value="'.$consulta2['colaborador_id'].'">'.$consulta2['apellido'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>