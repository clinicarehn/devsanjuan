<?php
    class vistasModelo{
        protected function getVistasModelo($vistas){
            $listaBlanca = ["dashboard","clientes", "facturas", "proveedores","compras","productos","movimientos","historialAccesos", "bitacora", "colaboradores", "puestos", "users", "secuencia", "empresa","privilegio","tipoUser",'cobrarClientes','pagarProveedores','reporteCompras','reporteVentas', 'confAlmacen', 'confUbicacion', 'confMedida'];

            if(in_array($vistas, $listaBlanca)){
				if(is_file("./vistas/contenido/".$vistas."-view.php")){
					$contenido="./vistas/contenido/".$vistas."-view.php";
				}else{
					$contenido="login";
				}
			}elseif($vistas=="login"){
				$contenido="login";
			}elseif($vistas=="index"){
				$contenido="login";
			}else{
				$contenido="login";
			}
			return $contenido;
        }
    }