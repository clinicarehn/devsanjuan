<?php
    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";	
    }

    class colaboradorModelo extends mainModel{
		protected function agregar_colaborador_modelo($datos){
			$colaboradores_id  = mainModel::correlativo("colaboradores_id", "colaboradores");

			$insert = "INSERT INTO colaboradores VALUES('$colaboradores_id ','".$datos['puesto']."','".$datos['nombre']."','".$datos['apellido']."','".$datos['identidad']."','".$datos['estado']."','".$datos['telefono']."','".$datos['fecha']."')";
			
			$sql = mainModel::connection()->query($insert) or die(mainModel::connection()->error);
			
			return $sql;
		}
		
		protected function valid_colaborador_modelo($identidad){
			$query = "SELECT colaboradores_id  FROM colaboradores WHERE identidad = '$identidad'";
			
			$sql = mainModel::connection()->query($query) or die(mainModel::connection()->error);
			
			return $sql;
		}

		protected function editar_colaborador_modelo($datos){
			$udapte = "UPDATE colaboradores
			SET 
				puestos_id = '".$datos['puesto']."',
				nombre = '".$datos['nombre']."',
				apellido = '".$datos['apellido']."',
				estado = '".$datos['estado']."',
				telefono = '".$datos['telefono']."'
			WHERE colaboradores_id  = '".$datos['colaborador_id']."'";
			
			$sql = mainModel::connection()->query($udapte) or die(mainModel::connection()->error);
			
			return $sql;			
		}
		
		protected function delete_colaborador_modelo($colaboradores_id ){
			$delete = "DELETE FROM colaboradores WHERE colaboradores_id  = '$colaboradores_id '";
			
			$sql = mainModel::connection()->query($delete) or die(mainModel::connection()->error);
			
			return $sql;			
		}
		
		protected function valid_colaborador_bitacora($colaboradores_id ){
			$query = "SELECT id FROM bitacora WHERE colaboradores_id  = '$colaboradores_id '";
			
			$sql = mainModel::connection()->query($query) or die(mainModel::connection()->error);
			
			return $sql;			
		}
    }
