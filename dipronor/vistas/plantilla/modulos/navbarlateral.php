<nav class="sb-sidenav accordion bg-color-verde" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
        <div class="sb-sidenav-menu-heading" style=""><img src="<?php echo SERVERURL; ?>vistas/plantilla/img/logo.png" alt="We share" loading="lazy" width="100%" height="100%"></div>
            <a class="nav-link link" href="<?php echo SERVERURL; ?>dashboard/">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#collapseVentas" aria-expanded="false" aria-controls="collapseVentas">
                <div class="sb-nav-link-icon"><i class="fab fa-sellsy"></i></div>
                Ventas
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>clientes/"><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>Clientes</a>
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>facturas/"><div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>Facturas</a>
                </nav>
            </div>
            <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                <div class="sb-nav-link-icon"><i class="fas fa-store-alt"></i></div>
                Compras
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>proveedores/"><div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>Proveedores</a>
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>compras/"><div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>Compras</a>
                </nav>
            </div>  
            <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#collapseAlmacen" aria-expanded="false" aria-controls="collapseAlmacen">
                <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                Almacen
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseAlmacen" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>productos/"><div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>Productos</a>
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>movimientos/"><div class="sb-nav-link-icon"><i class="fab fa-servicestack"></i></div>Movimientos</a>
                </nav>
            </div>                        
            <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="false" aria-controls="collapseReportes">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                Reportes
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>            
            <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    </a>									
                    <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#historialCollapse" aria-expanded="false" aria-controls="historialCollapse">
                        <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                        Historial
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="historialCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link link" href="<?php echo SERVERURL; ?>historialAccesos/"><div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>Accesos</a>
							<a class="nav-link link" href="<?php echo SERVERURL; ?>bitacora/"><div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>Bitacora</a>							
                        </nav>
                    </div>
                    <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#facturasCollapse" aria-expanded="false" aria-controls="facturasCollapse">
                        <div class="sb-nav-link-icon"><i class="fab fa-sellsy"></i></div>
                        Ventas
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="facturasCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link link" href="<?php echo SERVERURL; ?>reporteVentas/"><div class="sb-nav-link-icon"><i class="fab fa-sellsy"></i></div>Reporte de Ventas</a>
							<a class="nav-link link" href="<?php echo SERVERURL; ?>cobrarClientes/"><div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>CXC Clientes</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#comprasCollapse" aria-expanded="false" aria-controls="comprasCollapse">
                        <div class="sb-nav-link-icon"><i class="fas fa-store-alt"></i></i></div>
                        Compras
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="comprasCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link link" href="<?php echo SERVERURL; ?>reporteCompras/"><div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>Reporte de Compras</a>
							<a class="nav-link link" href="<?php echo SERVERURL; ?>pagarProveedores/"><div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>CXP Proveedores</a>						
                        </nav>
                    </div>
                </nav>
            </div>

            <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#configuracion" aria-expanded="false" aria-controls="configuracion">
                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></i></div>
                Configuración
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="configuracion" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>colaboradores/"><div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>Colaboradores</a>
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>puestos/"><div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>Puestos</a>					
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>users/"><div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>Usuarios</a>
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>secuencia/"><div class="sb-nav-link-icon"><i class="fas fa-sliders-h"></i></div>Secuencia</a>
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>empresa/"><div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>Empresa</a>	
					<a class="nav-link link" href="<?php echo SERVERURL; ?>confAlmacen/"><div class="sb-nav-link-icon"><i class="fab fas fa-warehouse"></i></div>Almacén</a>	
					<a class="nav-link link" href="<?php echo SERVERURL; ?>confUbicacion/bicacion/"><div class="sb-nav-link-icon"><i class="fas fa-search-location"></i></div>Ubicación</a>
					<a class="nav-link link" href="<?php echo SERVERURL; ?>confMedida/"><div class="sb-nav-link-icon"><i class="fas fa-balance-scale-left"></i></div>Medidas</a>
                </nav>
            </div>
			
            <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#varios" aria-expanded="false" aria-controls="configuracion">
                <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></i></div>
                Varios
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="varios" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link link" href="<?php echo SERVERURL; ?>privilegio/"><div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>Privilegios</a>                    
					<a class="nav-link link" href="<?php echo SERVERURL; ?>tipoUser/"><div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>Tipo Usuario</a>						
                </nav>
            </div>			
			
        </div>
    </div>
    <div class="sb-sidenav-footer link">
        <div class="small"><b>Inicio sesión como:</b></div>
        <span id="user_session"></span>
    </div>
</nav>