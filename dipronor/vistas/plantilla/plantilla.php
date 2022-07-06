<?php
	session_start(['name'=>'SD']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo COMPANY;?></title>
    <link href="<?php echo SERVERURL; ?>ajax/bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/>
    <link href="<?php echo SERVERURL; ?>ajax/bootstrap/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous"/>
    <link href="<?php echo SERVERURL; ?>vistas/plantilla/css/styles.css" rel="stylesheet"/>   
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>fontawesome/css/all.min.css">
    <link rel="shortcut icon" href="<?php echo SERVERURL; ?>vistas/plantilla/img/logo1.png">
    <link href="<?php echo SERVERURL; ?>ajax/sweetalert/sweetalert.css" rel="stylesheet" crossorigin="anonymous"/>			
</head>
<body class="sb-nav-fixed">
    <?php
        $peticionAjax = false;
        require_once "./controladores/vitasControlador.php";
        $vt = new vistasControlador();
        $vistasR = $vt->getVistasControlador();

        if($vistasR=="login" || $vistasR=="404"):
            if($vistasR=="login"){
                require_once "./vistas/contenido/login-view.php";
            }else{
                require_once "./vistas/contenido/404-view.php";
            } 
        else:		   	   
		   require_once "./controladores/loginControlador.php";
	   
		   $lc = new loginControlador();
		   
		   if(!isset($_SESSION['token_sd']) || !isset($_SESSION['user_sd'])){
				$lc->forzar_cierre_sesion_controlador();
		   }	   
    ?>

    <!-- Navbar Top -->
    <?php include "./vistas/plantilla/modulos/navbartop.php";?>
    <!-- fin Navbar Top -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">

            <!-- Navbar Lateral -->
            <?php include "./vistas/plantilla/modulos/navbarlateral.php";?>
            <!-- Fin Navbar Lateral -->
        </div>
        <div id="layoutSidenav_content">
            <main>
                <!-- Contenido -->
                <?php 
                    require_once $vistasR;
                ?>
                <!-- Fin Contenido -->
            </main>

            <!-- Footer -->
            <?php include "./vistas/plantilla/modulos/footer.php";?>
            <!-- Fin Footer -->
        </div>
    </div>
    <?php 	
		//VENTANAS MODALES
		include "./vistas/contenido/vistasModals.php";

		//Scripts
		include "./vistas/plantilla/modulos/script.php";

		//CIERRE DE SESIÓN
		include "./vistas/plantilla/modulos/logoutScript.php";
		
		//SCRIPT VENTANAS MODALES
		include "./ajax/js/main.php";

		endif; 		
	?>	
</body>
</html>