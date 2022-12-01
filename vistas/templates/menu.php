<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="inicio.php"><img src="../img/logo.png" width="150" height="45" alt="Logo"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		 <?php
			 if ($_SESSION['type']==1 || $_SESSION['type']==6 || $_SESSION['type']==7 || $_SESSION['type']==16){//MENÚ ADMINISTRADORES, DIRECCIONES, SUBDIRECCIONES, GESTION CLINICA		   
		 ?>		
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Admisión
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="pacientes.php">Usuarios</a></li>
			  <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
			  <li><a class="dropdown-item" href="citas.php">Citas</a></li>
			  <li><a class="dropdown-item" href="camas.php">Camas</a></li>
			  <li><a class="dropdown-item" href="quejas_sugerencias.php">Quejas y Sugerencias</a></li>
			</ul>
		</li>
		
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Preclínica
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="preclinica.php">Preclínica</a></li>
			  <li><a class="dropdown-item" href="postclinica.php">Postclínica</a></li>
			</ul>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Atenciones
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="atas.php">Atenciones</a></li>
			  <li><a class="dropdown-item" href="referencias.php">Referencias</a></li>
			  <li><a class="dropdown-item" href="hospitalizacion.php">Hospitalización</a></li>
			  <li><a class="dropdown-item" href="reporte_entrevista_ts.php">Reporte Entrevista TS</a></li>	
			</ul>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Archivo
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="reporte_depurados.php">Depurados</a></li>
			</ul>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">SESAL</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes.php">Atenciones</a></li>
					  <li><a class="dropdown-item" href="reportes_consolidados.php">Reporte de Atenciones Consolidado</a></li>
					  <li><a class="dropdown-item" href="reportes_anuales.php">Reporte de Atenciones Anuales</a></li>				  
					</ul>
				</li>		
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">SJD</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reporte_agenda.php">Reporte Agenda</a></li>			  
					</ul>
				</li>							
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Admisión</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reporte_programacion_citas.php">Reporte Reprogramación de Citas</a></li>
					  <li><a class="dropdown-item" href="reportes_admision.php">Reporte de Admisión</a></li>
					  <li><a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a></li>					  
					</ul>
				</li>	
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Hospitalización</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_hospitalizacion.php">Reporte de Hospitalización</a></li>
					  <li><a class="dropdown-item" href="reportes_ocupacion_camas.php">Reporte Ocupación de Camas</a></li>
					  <li><a class="dropdown-item" href="reporte_hospitalizacion.php">Tablero de Camas</a></li>				  
					</ul>
				</li>
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Atenciones</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_ata_familiares.php">Reporte ATA Familiares</a></li>
					  <li><a class="dropdown-item" href="reportes_ata_seguimiento.php">Reporte ATA Seguimiento</a></li>	
					  <li><a class="dropdown-item" href="reporte_entrevista_ts.php">Reporte Entrevista TS</a></li>	
					  <li><a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a></li>
					</ul>
				</li>
				<li><a class="dropdown-item" href="reportes_enfermeria.php">Reportes Enfermería</a></li>
				<li><a class="dropdown-item" href="reportes_transito.php">Reportes Transito Usuarios</a></li>
				<li><a class="dropdown-item" href="reportes_sms.php">Reportes SMS</a></li>
				<li><a class="dropdown-item" href="historial_accesos.php">Historial de Accesos</a></li>			
			</ul>
		</li>		
		<?php
			}
		?>

		<?php
			if ($_SESSION['type']==2){//MENÚ MEDICOS		   
		?>	
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Admisión
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="pacientes.php">Usuarios</a></li>
			  <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
			  <li><a class="dropdown-item" href="citas.php">Citas</a></li>
			  <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
			</ul>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Atenciones
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="atas.php">Atenciones</a></li>
			  <li><a class="dropdown-item" href="hospitalizacion.php">Hospitalización</a></li>
			</ul>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">SESAL</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes.php">Atenciones</a></li>			  
					</ul>
				</li>				
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Admisión</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a></li>					  
					</ul>
				</li>	
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Hospitalización</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_hospitalizacion.php">Reporte de Hospitalización</a></li>		  
					</ul>
				</li>
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Atenciones</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_ata_familiares.php">Reporte ATA Familiares</a></li>
					  <li><a class="dropdown-item" href="reportes_ata_seguimiento.php">Reporte ATA Seguimiento</a></li>	
					  <li><a class="dropdown-item" href="reporte_entrevista_ts.php">Reporte Entrevista TS</a></li>	
					  <li><a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a></li>
					</ul>
				</li>			
			</ul>
		</li>			
		<?php
			}
		?>		

		<?php
			if ($_SESSION['type']==3 || $_SESSION['type']==4){//MENÚ CAJA, USUARIOS			   
		?>
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Admisión
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="pacientes.php">Usuarios</a></li>
			  <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
			  <li><a class="dropdown-item" href="citas.php">Citas</a></li>
			  <li><a class="dropdown-item" href="colas.php">Colas</a></li>
			  <li><a class="dropdown-item" href="camas.php">Camas</a></li>
			</ul>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">			
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Admisión</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reporte_programacion_citas.php">Reporte Reprogramación de Citas</a></li>
					  <li><a class="dropdown-item" href="reportes_admision.php">Reporte de Admisión</a></li>
					  <li><a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a></li>					  
					</ul>
				</li>	
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Hospitalización</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_hospitalizacion.php">Reporte de Hospitalización</a></li>
					  <li><a class="dropdown-item" href="reportes_ocupacion_camas.php">Reporte Ocupación de Camas</a></li>
					  <li><a class="dropdown-item" href="reporte_hospitalizacion.php">Tablero de Camas</a></li>				  
					</ul>
				</li>
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Atenciones</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_ata_seguimiento.php">Reporte ATA Seguimiento</a></li>	
					  <li><a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a></li>
					</ul>
				</li>
				<li><a class="dropdown-item" href="reportes_transito.php">Reportes Transito Usuarios</a></li>
				<li><a class="dropdown-item" href="reportes_sms.php">Reportes SMS</a></li>			
			</ul>
		</li>			
		<?php
			}
		?>		

		<?php
			if ($_SESSION['type']==5){//MENU ARCHIVO CLINICO	   
		?>
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Admisión
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="pacientes.php">Usuarios</a></li>
			  <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
			  <li><a class="dropdown-item" href="citas.php">Citas</a></li>			  
			</ul>
		</li>			
		
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Atenciones
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="atas.php">Atenciones</a></li>
			  <li><a class="dropdown-item" href="referencias.php">Referencias</a></li>
			</ul>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Archivo
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="reporte_depurados.php">Depurados</a></li>
			</ul>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">			
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Admisión</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a></li>					  
					</ul>
				</li>	
				<li><a class="dropdown-item" href="reportes_transito.php">Reportes Transito Usuarios</a></li>		
			</ul>
		</li>			
		<?php
			}
		?>			
		
		<?php
			if ($_SESSION['type']==8){//COORDINADOR DE ENFERMERIA  
		?>			
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Admisión
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="pacientes.php">Usuarios</a></li>
			  <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
			  <li><a class="dropdown-item" href="citas.php">Citas</a></li>			  
			</ul>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Preclínica
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="preclinica.php">Preclínica</a></li>
			  <li><a class="dropdown-item" href="postclinica.php">PostClínica</a></li>
			</ul>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Atenciones
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="atas.php">Atenciones</a></li>
			  <li><a class="dropdown-item" href="hospitalizacion.php">Hospitalización</a></li>
			</ul>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">SESAL</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes.php">Atenciones</a></li>			  
					</ul>
				</li>				
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Admisión</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a></li>					  
					</ul>
				</li>	
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Hospitalización</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_hospitalizacion.php">Reporte de Hospitalización</a></li>
					  <li><a class="dropdown-item" href="reportes_ocupacion_camas.php">Reporte Ocupación de Camas</a></li>
					  <li><a class="dropdown-item" href="reporte_hospitalizacion.php">Tablero de Camas</a></li>				  
					</ul>
				</li>
				<li><a class="dropdown-item" href="reportes_enfermeria.php">Reportes Enfermería</a></li>		
			</ul>
		</li>		
		<?php
			}
		?>	

		<?php
		 if ($_SESSION['type']==9){//MENÚ AUXILIAR DE ENFERMERÍA
		?>	
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Admisión
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="pacientes.php">Usuarios</a></li>
			  <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
			  <li><a class="dropdown-item" href="citas.php">Citas</a></li>			  
			</ul>
		</li>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Preclínica
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="preclinica.php">Preclínica</a></li>
			  <li><a class="dropdown-item" href="postclinica.php">PostClínica</a></li>
			</ul>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">		
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Admisión</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a></li>					  
					</ul>
				</li>
				<li><a class="dropdown-item" href="reportes_enfermeria.php">Reportes Enfermería</a></li>		
			</ul>
		</li>
		<?php
			}
		?>	

		<!--COORDINADOR DE UAU PENDIENTE DE HACER 10-->
		<?php
			if ($_SESSION['type']==10){//MENÚ coordinador de uau	   
		?>
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Admisión
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="pacientes.php">Usuarios</a></li>
			  <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
			  <li><a class="dropdown-item" href="citas.php">Citas</a></li>
			  <li><a class="dropdown-item" href="colas.php">Colas</a></li>
			  <li><a class="dropdown-item" href="camas.php">Camas</a></li>
			  <li><a class="dropdown-item" href="quejas_sugerencias.php">Quejas y Sugerencias</a></li>
			</ul>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">			
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Admisión</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reporte_programacion_citas.php">Reporte Reprogramación de Citas</a></li>
					  <li><a class="dropdown-item" href="reportes_admision.php">Reporte de Admisión</a></li>
					  <li><a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a></li>					  
					</ul>
				</li>	
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Hospitalización</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_hospitalizacion.php">Reporte de Hospitalización</a></li>
					  <li><a class="dropdown-item" href="reportes_ocupacion_camas.php">Reporte Ocupación de Camas</a></li>
					  <li><a class="dropdown-item" href="reporte_hospitalizacion.php">Tablero de Camas</a></li>				  
					</ul>
				</li>
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Atenciones</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="reportes_ata_seguimiento.php">Reporte ATA Seguimiento</a></li>	
					  <li><a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a></li>
					</ul>
				</li>
				<li><a class="dropdown-item" href="reportes_transito.php">Reportes Transito Usuarios</a></li>
				<li><a class="dropdown-item" href="reportes_sms.php">Reportes SMS</a></li>			
			</ul>
		</li>			

		<?php
			}
		?>			

		<!--CONTADOR GENERAL PENDIENTE DE HACER 13-->	 

		<?php
			if ($_SESSION['type']==14){//MENÚ TABLERO DE CAMAS		   
		?>
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>	
		
		<li class="nav-item active">
			<a class="nav-link" href="reporte_hospitalizacion.php">Tablero de Camas <span class="sr-only">(current)</span></a>
		</li>		
		<?php
			}
		?>	

		<?php
			if ($_SESSION['type']==15){//MENÚ FARMACIA		   
		?>
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php">Dashboard <span class="sr-only">(current)</span></a>
		</li>	

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Admisión
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="pacientes.php">Usuarios</a></li>
			  <li><a class="dropdown-item" href="colas_farmacia.php">Colas</a></li>			  
			</ul>
		</li>
		
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Atenciones</a>
					<ul class="dropdown-menu">	
					  <li><a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a></li>
					</ul>
				</li>	
			</ul>
		</li>		
		<?php
			}
		?>	
    </ul>
	
    <form class="form-inline my-2 my-lg-0">
	  <ul class="navbar-nav mr-auto">
		<?php
			if ($_SESSION['type']==1){		   
		?>	  	  
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Configuración
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="colaboradores.php">Colaboradores</a></li>
			  <li><a class="dropdown-item" href="transporte_usuarios.php">Transporte Usuarios</a></li>	
			  <li><a class="dropdown-item" href="users.php">Usuarios</a></li>	
			  <li><a class="dropdown-item" href="config_varios.php">Varios</a></li>	
			  <li><a class="dropdown-item" href="cargar.php">Importar</a></li>				  
			</ul>
		</li>	  
		<?php
			}
		?>	

		<?php
			if ($_SESSION['type']==6 || $_SESSION['type']==7 || $_SESSION['type']==16){//DIRECCIONES, SUBDIRECCIONES, GESTION CLINICA		   
		?>	
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Configuración
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="colaboradores.php">Colaboradores</a></li>	
			  <li><a class="dropdown-item" href="transporte_usuarios.php">Transporte Usuarios</a></li>	
			  <li><a class="dropdown-item" href="users.php">Usuarios</a></li>	
			  <li><a class="dropdown-item" href="config_varios.php">Varios</a></li>				  		  
			</ul>
		</li>	  
		<?php
			}
		?>		
		
		<?php
		  if ($_SESSION['type']==11){//MENU TRANSPORTISTA
		?>	 
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Configuración
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="transporte_usuarios.php">Transporte Usuarios</a></li>				  
			</ul>
		</li>	
		<?php
			}
		?>

		<?php
		  if ($_SESSION['type']==12){//MENU TALENTO HUMANO
		?>	
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Configuración
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="colaboradores.php">Colaboradores</a></li>
			  <li><a class="dropdown-item" href="transporte_usuarios.php">Transporte Usuarios</a></li>			  
			</ul>
		</li>	 
		<?php
			}
		?>

		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <span id="saludo_sistema"></span>
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="#" id="mostrar_cambiar_contraseña">Modificar Contraseña</a></li>
			  <li><a class="dropdown-item" href="#" id="salir_sistema">Sign Out</a></li>
			</ul>
		</li>	  
	  </ul>
    </form>
  </div>
</nav>