<script>
$(document).ready(function() {
  getReporte();
  getServicio();
  pagination_busqueda_reportes(1);
});

$(document).ready(function() {
  $('#form_main #servicio').on('change', function(){	
       pagination_busqueda_reportes(1);
  });
});

$(document).ready(function() {
  $('#form_main #unidad').on('change', function(){	
       pagination_busqueda_reportes(1);
  });
});

$(document).ready(function() {
  $('#form_main #profesional').on('change', function(){	
       pagination_busqueda_reportes(1);  
  });
});

$(document).ready(function() {
  $('#form_main #reporte').on('change', function(){	
       pagination_busqueda_reportes(1);   
  });
});

$(document).ready(function() {
  $('#form_main #fecha_i').on('change', function(){	
       pagination_busqueda_reportes(1);
  });
});

$(document).ready(function() {
  $('#form_main #fecha_f').on('change', function(){	
       pagination_busqueda_reportes(1);
  });
});

$(document).ready(function() {
  $('#form_main #bs-regis').on('keyup', function(){	
       pagination_busqueda_reportes(1);
  });
});

//REPORTES EN EXCEL
//LISTA DE ESPERA
$('#form_main #reportes_exportar').on('click', function(e){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 15 || getUsuarioSistema() == 18){	
	e.preventDefault();
	if($('#form_main #servicio').val() != ""){
	   reporteEXCEL();
	}else{
		swal({
			title: "Error", 
			text: "No se puede generar el reporte",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			  
	}
}else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});						 
 }		
});
//REPORTE DE CITAS MENORES A 15 DIAS	
$('#form_main #reporte1').on('click', function(e){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 15 || getUsuarioSistema() == 18){	
	e.preventDefault();
	if($('#form_main #servicio').val() != ""){
	   reporteMenores15EXCEL();
	}else{
		swal({
			title: "Error", 
			text: "No se puede generar el reporte",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});		  
	}
}else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});			 
 }		
});
	
//REPORTE DE CITAS MAYORES A 15 DIAS	
$('#form_main #reporte2').on('click', function(e){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 15 || getUsuarioSistema() == 18){	
	e.preventDefault();
	if($('#form_main #servicio').val() != ""){
	   reporteMayores15EXCEL();
	}else{
		swal({
			title: "Error", 
			text: "No se puede generar el reporte",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});		  
	}
}else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});	
 }		
});

/************************************************************************************************/
//REPORTE LISTA DE ESPERA
function reporteEXCEL(){
	var url = '';
	var servicio = $('#form_main #servicio').val();
	var unidad = $('#form_main #unidad').val();
	var reporte = $('#form_main #reporte').val();
	var medico_general = $('#form_main #profesional').val();	
	var fechai = $('#form_main #fecha_i').val();
	var fechaf = $('#form_main #fecha_f').val();
	
	if(reporte == "" || reporte == null){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}
	
	if(reporte == 1){
		url = '<?php echo SERVERURL; ?>php/reportes_admision/reportes_lista_excel.php?servicio='+servicio+'&unidad='+unidad+'&reporte='+reporte+'&medico_general='+medico_general+'&fechai='+fechai+'&fechaf='+fechaf;
	}else if(reporte == 2){
		url = '<?php echo SERVERURL; ?>php/reportes_admision/reportes_lista_repro_excel.php?servicio='+servicio+'&unidad='+unidad+'&reporte='+reporte+'&medico_general='+medico_general+'&fechai='+fechai+'&fechaf='+fechaf;
	}else if(reporte == 3){
		url = '<?php echo SERVERURL; ?>php/reportes_admision/reporte_agenda.php?servicio='+servicio+'&unidad='+unidad+'&reporte='+reporte+'&medico_general='+medico_general+'&fechai='+fechai+'&fechaf='+fechaf;
	}else if(reporte == 4){
		url = '<?php echo SERVERURL; ?>php/reportes_admision/reporte_sobrecupo.php?servicio='+servicio+'&unidad='+unidad+'&reporte='+reporte+'&medico_general='+medico_general+'&fechai='+fechai+'&fechaf='+fechaf;
	}else{
		swal({
			title: "Error", 
			text: "Ha seleccionado una opción invalida, o simplemente no existe un reporte para esta opción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			
	}
	
    window.open(url);
}

//REPORTE USUARIOS MENORES DE 15 DIAS
function reporteMenores15EXCEL(){
	var url = '';
	var servicio = $('#form_main #servicio').val();
	var unidad = $('#form_main #unidad').val();
	var reporte = $('#form_main #reporte').val();
	var medico_general = $('#form_main #profesional').val();	
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	
	if(reporte == 1 || reporte == ""){		
		url = '<?php echo SERVERURL; ?>php/reportes_admision/reporteDiarioCitasMenores15.php?servicio='+servicio+'&unidad='+unidad+'&desde='+desde+'&hasta='+hasta;	
        window.open(url);		
	}else{
		swal({
			title: "Error", 
			text: "No existe un reporte para esta Opción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	 	   
	}		
}

//REPORTE DE USUARIOS MAYORES A 15 DIAS
function reporteMayores15EXCEL(){
	var url = '';
	var servicio = $('#form_main #servicio').val();
	var unidad = $('#form_main #unidad').val();
	var reporte = $('#form_main #reporte').val();
	var medico_general = $('#form_main #profesional').val();	
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	
	if(reporte == 1 || reporte == ""){	
		url = '<?php echo SERVERURL; ?>php/reportes_admision/reporteDiarioCitasMayores15.php?servicio='+servicio+'&unidad='+unidad+'&desde='+desde+'&hasta='+hasta;	
		window.open(url);
	}else{
		swal({
			title: "Error", 
			text: "No existe un reporte para esta Opción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	   
	}	    
}	
/****************************************************************************************************************************************************/
function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/reportes_admision/getReporte.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #reporte').html("");
			$('#form_main #reporte').html(data);				
        }
     });		
}

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/reportes_admision/servicios.php';		
    
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #servicio').html("");
			$('#form_main #servicio').html(data);				
        }
     });		
}

$(document).ready(function() {
	  $('#form_main #servicio').on('change', function(){
		var servicio_id = $('#form_main #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/reportes_admision/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#form_main #unidad').html("");
				$('#form_main #unidad').html(data);							
            }
         });
		 
      });					
});

$(document).ready(function() {
	  $('#form_main #unidad').on('change', function(){
		var servicio_id = $('#form_main #servicio').val();
		var puesto_id = $('#form_main #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/reportes_admision/getMedico.php';	        
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id+'&puesto_id='+puesto_id,
            success: function(data){
				$('#form_main #profesional').html(data);					
            }
         });
		 
      });					
});

function pagination_busqueda_reportes(partida){
	var url = '';
	var servicio = $('#form_main #servicio').val();
	var unidad = $('#form_main #unidad').val();
	var reporte = $('#form_main #reporte').val();
	var medico_general = $('#form_main #profesional').val();	
	var fechai = $('#form_main #fecha_i').val();
	var fechaf = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs-regis').val();
	var info_send = '';	
	
	if(servicio == "" || servicio == null){
		servicio = 1;
	}else{
		servicio = $('#form_main #servicio').val();
	}
	
	if(unidad == "" || unidad == null){
		unidad = "";
	}else{
		unidad = $('#form_main #unidad').val();
	}
		
	if(medico_general == "" || medico_general == null){
		medico_general = "";
	}else{
		medico_general = $('#form_main #profesional').val();
	}	
	
	if(reporte == "" || reporte == null){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}		

	if(reporte == 1){
			url = '<?php echo SERVERURL; ?>php/reportes_admision/paginar_reportes_lista.php'
	}else if(reporte == 2){
		url = '<?php echo SERVERURL; ?>php/reportes_admision/paginar_reportes_repro.php'
	}else if(reporte == 3){
		url = '<?php echo SERVERURL; ?>php/reportes_admision/paginar_agenda.php'
	}else{
		url = '<?php echo SERVERURL; ?>php/reportes_admision/paginar_sobrecupo.php'
	}
	
	info_send = 'partida='+partida+'&fechai='+fechai+'&fechaf='+fechaf+'&servicio='+servicio+'&unidad='+unidad+'&medico_general='+medico_general+'&reporte='+reporte+'&dato='+dato;
		
	$.ajax({
		type:'POST',
		url:url,
		data:info_send,		
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

//LIMPIAR EL FORMULARIO DE REPORTES
function limpiar(){		
	$('#form_main #reporte').html("");	
    $('#form_main #agrega-registros').html("");
	$('#form_main #pagination').html("");		
	$('#form_main #unidad').html("");
	$('#form_main #profesional').html("");
	$('#form_main #reporte').html("");	
    getServicio();
    getReporte();
    pagination_busqueda_reportes(1);	
}

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});
</script>