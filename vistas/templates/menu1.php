<!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="#"><a href="#"><img src="../img/logo.png" width="150" height="45" alt=""/></a></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">  
	 <?php
		 if ($_SESSION['type']==1){//MENÚ ADMINISTRADORES		   
	  ?>	
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
          <a class="dropdown-item" href="citas.php">Citas</a>
          <a class="dropdown-item" href="agenda.php">Agenda</a>
          <a class="dropdown-item" href="facturacion.php">Facturación</a>	
          <a class="dropdown-item" href="camas.php">Camas</a>	
          <a class="dropdown-item" href="quejas_sugerencias.php">Quejas</a>			  
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Enfermería</a>
        <div class="dropdown-menu" aria-labelledby="dropdown02">
          <a class="dropdown-item" href="preclinica.php">Preclínica</a>
          <a class="dropdown-item" href="postclinica.php">Postclínica</a>		  
        </div>
      </li>	 
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Atenciones</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="atas.php">ATA</a>
          <a class="dropdown-item" href="referencias.php">Referencias</a>
          <a class="dropdown-item" href="hospitalizacion.php">Hospitalización</a>		  
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Archivo</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="reporte_depurados.php">Depurados</a>		  
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">		
          <a class="dropdown-item" href="reportes.php">Reporte de Atenciones</a>
          <a class="dropdown-item" href="reportes_consolidados.php">Reporte de Atenciones Generalizado</a>
          <a class="dropdown-item" href="reportes_anuales.php">Reporte de Atenciones Anual</a>	
          <a class="dropdown-item" href="reportes_hospitalizacion.php">Reporte de Hospitalización</a>
          <a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a>
          <a class="dropdown-item" href="reporte_programacion_citas.php">Reporte Programación Citas</a>	
          <a class="dropdown-item" href="reportes_admision.php">Reportes Admisión</a>
          <a class="dropdown-item" href="reportes_enfermeria.php">Reportes Enfermería</a>
          <a class="dropdown-item" href="reporte_entrevista_ts.php">Reportes Entrevista TS</a>
          <a class="dropdown-item" href="reportes_sms.php">Reportes SMS</a>
          <a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a>
          <a class="dropdown-item" href="reportes_ata_familiares.php">Reporte ATA Familiares</a>	
          <a class="dropdown-item" href="reportes_ata_seguimiento.php">Reporte ATA Seguimiento</a>
          <a class="dropdown-item" href="reportes_transito.php">Reporte Transito</a>
          <a class="dropdown-item" href="reportes_ocupacion_camas.php">Reporte Reporte Ocupación de Camas</a>	
          <a class="dropdown-item" href="reporte_hospitalizacion.php">Tablero de Camas</a>
          <a class="dropdown-item" href="historial_accesos.php">Reporte Historial de Accesos</a>		  
        </div>
      </li>	
      <?php
	     }
	  ?> 
	  
	 <?php
		 if ($_SESSION['type']==6 || $_SESSION['type']==7 || $_SESSION['type']==16){//DIRECCIONES, SUBDIRECCIONES, GESTION CLINICA		   
	  ?>	
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
          <a class="dropdown-item" href="citas.php">Citas</a>
          <a class="dropdown-item" href="agenda.php">Agenda</a>
          <a class="dropdown-item" href="colas.php">Colas</a>	
          <a class="dropdown-item" href="camas.php">Camas</a>	
          <a class="dropdown-item" href="quejas_sugerencias.php">Quejas</a>			  
        </div>
      </li> 
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Atenciones</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="atas.php">ATA</a>
          <a class="dropdown-item" href="referencias.php">Referencias</a>
          <a class="dropdown-item" href="hospitalizacion.php">Hospitalización</a>		  
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Archivo</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="reporte_depurados.php">Depurados</a>		  
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">		
          <a class="dropdown-item" href="reportes.php">Reporte de Atenciones</a>
          <a class="dropdown-item" href="reportes_consolidados.php">Reporte de Atenciones Generalizado</a>
          <a class="dropdown-item" href="reportes_anuales.php">Reporte de Atenciones Anual</a>	
          <a class="dropdown-item" href="reportes_hospitalizacion.php">Reporte de Hospitalización</a>
          <a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a>
          <a class="dropdown-item" href="reporte_programacion_citas.php">Reporte Programación Citas</a>	
          <a class="dropdown-item" href="reportes_admision.php">Reportes Admisión</a>
          <a class="dropdown-item" href="reportes_enfermeria.php">Reportes Enfermería</a>
          <a class="dropdown-item" href="reporte_entrevista_ts.php">Reportes Entrevista TS</a>
          <a class="dropdown-item" href="reportes_sms.php">Reportes SMS</a>
          <a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a>
          <a class="dropdown-item" href="reportes_ata_familiares.php">Reporte ATA Familiares</a>	
          <a class="dropdown-item" href="reportes_ata_seguimiento.php">Reporte ATA Seguimiento</a>
          <a class="dropdown-item" href="reportes_transito.php">Reporte Transito</a>
          <a class="dropdown-item" href="reportes_ocupacion_camas.php">Reporte Reporte Ocupación de Camas</a>	
          <a class="dropdown-item" href="reporte_hospitalizacion.php">Tablero de Camas</a>		  
        </div>
      </li>	
      <?php
	     }
	  ?> 	  

	 <?php
		 if ($_SESSION['type']==2){//MENÚ MEDICOS		   
	  ?>	
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
          <a class="dropdown-item" href="citas.php">Citas</a>
          <a class="dropdown-item" href="agenda.php">Agenda</a>		  
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Atenciones</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="atas.php">ATA</a>
          <a class="dropdown-item" href="hospitalizacion.php">Hospitalización</a>		  
        </div>
      </li>	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">		
          <a class="dropdown-item" href="reportes.php">Reporte de Atenciones</a>	
          <a class="dropdown-item" href="reportes_hospitalizacion.php">Reporte de Hospitalización</a>
          <a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a>	
          <a class="dropdown-item" href="reportes_ata_familiares.php">Reporte ATA Familiares</a>	
          <a class="dropdown-item" href="reportes_ata_seguimiento.php">Reporte ATA Seguimiento</a>
          <a class="dropdown-item" href="reportes_transito.php">Reporte Transito</a>
		  <a class="dropdown-item" href="reporte_entrevista_ts.php">Reportes Entrevista TS</a>	
        </div>
      </li>		
	
      <?php
	     }
	  ?>	  
	
	 <?php
		 if ($_SESSION['type']==3){//MENÚ CAJA		   
	  ?>
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
          <a class="dropdown-item" href="citas.php">Citas</a>
          <a class="dropdown-item" href="agenda.php">Agenda</a>
          <a class="dropdown-item" href="colas.php">Colas</a>	
          <a class="dropdown-item" href="camas.php">Camas</a>	
		  
        </div>
      </li>	
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a>
          <a class="dropdown-item" href="reporte_programacion_citas.php">Reporte Programación Citas</a>	
          <a class="dropdown-item" href="reportes_admision.php">Reportes Admisión</a>
          <a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a>
          <a class="dropdown-item" href="reportes_transito.php">Reporte Transito</a>
		  <a class="dropdown-item" href="reportes_ata_seguimiento.php">Reporte ATA Seguimiento</a>		  
          <a class="dropdown-item" href="reporte_hospitalizacion.php">Tablero de Camas</a>		  
        </div>
      </li>		
      <?php
	     }
	  ?>
	  
	 <?php
		 if ($_SESSION['type']==4){//MENÚ USUARIOS		   
	  ?>	
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
          <a class="dropdown-item" href="citas.php">Citas</a>
          <a class="dropdown-item" href="agenda.php">Agenda</a>
          <a class="dropdown-item" href="colas.php">Colas</a>	
          <a class="dropdown-item" href="camas.php">Camas</a>	
		  
        </div>
      </li>	
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a>
          <a class="dropdown-item" href="reporte_programacion_citas.php">Reporte Programación Citas</a>	
          <a class="dropdown-item" href="reportes_admision.php">Reportes Admisión</a>
          <a class="dropdown-item" href="reporte_receta.php">Reporte Receta Electrónica</a>
          <a class="dropdown-item" href="reportes_transito.php">Reporte Transito</a>	
          <a class="dropdown-item" href="reporte_hospitalizacion.php">Tablero de Camas</a>		  
        </div>
      </li>		
      <?php
	     }
	  ?>	  
	  
	 <?php
		 if ($_SESSION['type']==5){//MENU ARCHIVO CLINICO	   
	  ?>
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
		  <a class="dropdown-item" href="agenda.php">Agenda</a>
          <a class="dropdown-item" href="citas.php">Citas</a>		  
        </div>
      </li>	
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Atenciones</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
		  <a class="dropdown-item" href="atas.php">ATA</a>
          <a class="dropdown-item" href="referencias.php">Referencias</a>		  
        </div>
      </li>	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Archivo</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="reporte_depurados.php">Depurados</a>		  
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">		
          <a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a>	  
        </div>
      </li>		  
      <?php
	     }
	  ?>

	 <?php
		 if ($_SESSION['type']==8){//COORDINADOR DE ENFERMERIA  
	  ?>	
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
          <a class="dropdown-item" href="citas.php">Citas</a>		  
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Enfermería</a>
        <div class="dropdown-menu" aria-labelledby="dropdown02">
          <a class="dropdown-item" href="preclinica.php">Preclínica</a>
          <a class="dropdown-item" href="postclinica.php">Postclínica</a>		  
        </div>
      </li>		  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Atenciones</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="atas.php">ATA</a>		  
        </div>
      </li>	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">		
          <a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a>
          <a class="dropdown-item" href="reportes_enfermeria.php">Reportes Enfermería</a>		  
        </div>
      </li>		  
      <?php
	     }
	  ?>	  

	 <?php
		 if ($_SESSION['type']==9){//MENÚ AUXILIAR DE ENFERMERÍA
	  ?>	
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
          <a class="dropdown-item" href="citas.php">Citas</a>		  
        </div>
      </li>	
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Enfermería</a>
        <div class="dropdown-menu" aria-labelledby="dropdown02">
          <a class="dropdown-item" href="preclinica.php">Preclínica</a>
          <a class="dropdown-item" href="postclinica.php">Postclínica</a>		  
        </div>
      </li>	
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="reportes_ausencias.php">Reporte de Usuarios</a>
          <a class="dropdown-item" href="reportes_enfermeria.php">Reportes Enfermería</a>		  
        </div>
      </li> 	  
      <?php
	     }
	  ?>	

	  <!--COORDINADOR DE UAU PENDIENTE DE HACER 10-->
	 
	  <!--CONTADOR GENERAL PENDIENTE DE HACER 13-->	 

	 <?php
		 if ($_SESSION['type']==14){//MENÚ TABLERO DE CAMAS		   
	  ?>	
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
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
	  
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admisión</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="pacientes.php">Usuarios</a>
          <a class="dropdown-item" href="colas_farmacia.php">Colas</a>		
		  
        </div>
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
			<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuración</a>
			<div class="dropdown-menu" aria-labelledby="dropdown05">
			  <a class="dropdown-item" href="colaboradores.php">Colaboradores</a>
			  <a class="dropdown-item" href="transporte_usuarios.php">Transporte Usuarios</a>
			  <a class="dropdown-item" href="users.php">Usuarios</a>
			  <a class="dropdown-item" href="config_varios.php">Varios</a>
			  <a class="dropdown-item" href="cargar.php">Importar</a>		  
		</div>
		</li>	  
		<?php
			 }		   
		?>
		
		<?php
		 if ($_SESSION['type']==6 || $_SESSION['type']==7 || $_SESSION['type']==16){//DIRECCIONES, SUBDIRECCIONES, GESTION CLINICA		   
		?>		
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuración</a>
			<div class="dropdown-menu" aria-labelledby="dropdown05">
			  <a class="dropdown-item" href="colaboradores.php">Colaboradores</a>	  
		</div>
		</li>	

		<?php
			 }		   
		?>
		<!--MENU TRANSPORTISTA-->
		<?php
		  if ($_SESSION['type']==11){		   
		?>	  
	 
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuración</a>
			<div class="dropdown-menu" aria-labelledby="dropdown05">
			  <a class="dropdown-item" href="transporte_usuarios.php">Transporte Usuarios</a>		  
		</div>
		</li>	
			<?php
			 }		   
		?>	
		
		<!--MENU TALENTO HUMANO-->
		<?php
		  if ($_SESSION['type']==12){		   
		?>	  
	 
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuración</a>
			<div class="dropdown-menu" aria-labelledby="dropdown05">
			  <a class="dropdown-item" href="colaboradores.php">Colaboradores</a>
			  <a class="dropdown-item" href="transporte_usuarios.php">Transporte Usuarios</a>		  
		</div>
		</li>	
			<?php
			 }		   
		?>	
		
		<li class="nav-item dropdown active">
			<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="saludo_sistema">></span></a>
			<div class="dropdown-menu" aria-labelledby="dropdown05">
			  <a class="dropdown-item" href="#" id="mostrar_cambiar_contraseña">Modificar Contraseña</a>
			  <a class="dropdown-item" href="#" id="salir_sistema">Sign Out</a>	  
			</div>
		</li>	
	  </ul>
      <!--<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>-->
    </form>
  </div>
</nav>

















		<li class="nav-item dropdown active">
		<a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  Admisión
		</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <li><a class="dropdown-item" href="#">Action</a></li>
			  <li><a class="dropdown-item" href="#">Another action</a></li>
			  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
				<ul class="dropdown-menu">
				  <li><a class="dropdown-item" href="#">Submenu action</a></li>
				  <li><a class="dropdown-item" href="#">Another submenu action</a></li>


				  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
					  <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
					</ul>
				  </li>
				  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
					  <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
					</ul>
				  </li>
				</ul>
			  </li>
			</ul>
		</li>
		
		
		
		
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#">Hidden brand</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Submenu action</a></li>
              <li><a class="dropdown-item" href="#">Another submenu action</a></li>


              <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                  <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                  <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                </ul>
              </li>



            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>		