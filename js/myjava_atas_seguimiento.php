<script>
$(document).ready(function() {
    getReporte();	
	pagination(1);

	$('#form_main #reporte').on('change',function(){
		 if($('#form_main #reporte').val() == 1){
			 pagination(1);
		 }else{
			 paginationPacientes(1);
		 }
    });
	
	$('#form_main #fecha_i').on('change',function(){
		 var reporte = "";
		 
		 if($('#form_main #reporte').val() == null || $('#form_main #reporte').val() == ""){
			 reporte = 1;
		 }else{
             reporte = $('#form_main #reporte').val();
		 }	 

		 if(reporte == 1){
			 pagination(1);
		 }else{
			 paginationPacientes(1);
		 }
    });

	$('#form_main #fecha_f').on('change',function(){
		 var reporte = "";
		 
		 if($('#form_main #reporte').val() == null || $('#form_main #reporte').val() == ""){
			 reporte = 1;
		 }else{
             reporte = $('#form_main #reporte').val();
		 }	 

		 if(reporte == 1){
			 pagination(1);
		 }else{
			 paginationPacientes(1);
		 }
    });	

    $('#form_main #bs_regis').on('keyup',function(){
		 var reporte = "";
		 
		 if($('#form_main #reporte').val() == null || $('#form_main #reporte').val() == ""){
			 reporte = 1;
		 }else{
             reporte = $('#form_main #reporte').val();
		 }	 

		 if(reporte == 1){
			 pagination(1);
		 }else{
			 paginationPacientes(1);
		 }
    });		
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#transferir_paciente").on('shown.bs.modal', function(){
        $(this).find('#form_transferir_paciente #comentario').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

$('#transferir').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16 || getUsuarioSistema() == 15 || getUsuarioSistema() == 18){	
        if($('#form_transferir_paciente #comentario').val() != ""){			
			transferirUsuarioSeguimiento();	
			return false;
		}else{			
			swal({
				title: "Acceso Denegado", 
				text: "Hay registros en blanco, por favor corregir",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});	
			return false;
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
        return false;		
	}	 
});

function transferirUsuarioSeguimiento(){
	var url = '<?php echo SERVERURL; ?>php/ata_seguimiento/transferirPaciente.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#form_transferir_paciente').serialize(),
		success: function(registro){
		    if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#form_transferir_paciente #comentario').val('');
				paginationPacientes(1);
				return false; 
			}if(registro == 2){
				swal({
					title: "Acceso Denegado", 
					text: "No se puedo transferir este registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false; 
			}if(registro == 3){
				swal({
					title: "Acceso Denegado", 
					text: "Este registro ya existe, no se puede transferir",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false; 
			}else{
				swal({
					title: "Acceso Denegado", 
					text: "Error, no se puedo transferir este registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});                					   			  
			    return false; 
			}
		}
	});
	return false;	
}

function showDetailsSeguimiento(ata_seguimiento_id){
	var url = '<?php echo SERVERURL; ?>php/ata_seguimiento/showDetailsSeguimiento.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:'ata_seguimiento_id='+ata_seguimiento_id,
		success: function(registro){
		   $('#mensaje_show #mensaje_mensaje_show').html(registro);
		   $('#mensaje_show #myModalLabel').html('Detalles ATA Seguimiento');
		   $('#mensaje_show').modal({
			   show:true,
			   keyboard: false,
			   backdrop:'static',
		   });
		   return false; 
		}
	});
	return false;	
}

function showDetailsPacientes(pacientes_seg_id){
	var url = '<?php echo SERVERURL; ?>php/ata_seguimiento/showDetailsPacientes.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:'pacientes_seg_id='+pacientes_seg_id,
		success: function(registro){
		   $('#mensaje_show #mensaje_mensaje_show').html(registro);
		   $('#mensaje_show #myModalLabel').html('Detalles Pacientes');
		   $('#mensaje_show').modal({
			   show:true,
			   keyboard: false,
			   backdrop:'static',
		   });
		   return false; 
		}
	});
	return false;	
}

//CONSULTAR ATA SEGUIMIENTO
function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/ata_seguimiento/buscar_ata_seguimiento.php';
    var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs_regis').val();
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&dato='+dato,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

//CONSULTAR PACIENTES
function paginationPacientes(partida){
	var url = '<?php echo SERVERURL; ?>php/ata_seguimiento/buscar_pacientes_seguimiento.php';
    var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs_regis').val();
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&dato='+dato,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

$('#form_transferir_paciente #comentario').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#form_transferir_paciente #charNum_comentario').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function transferirUsuario(pacientes_seg_id){
	var url = '<?php echo SERVERURL; ?>php/ata_seguimiento/buscar_expediente.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:'pacientes_seg_id='+pacientes_seg_id,
		success: function(registro){
		   var array = eval(registro);	
		   $('#form_transferir_paciente #pacientes_id').val(array[0]);
		   $('#form_transferir_paciente #usuario').val(array[1]);
		   $('#form_transferir_paciente #comentario').val('');
		   $('#transferir_paciente').modal({
			   show:true,
			   keyboard: false,
			   backdrop:'static',
		   });
		   return false; 
		}
	});
	return false;
}	
	
function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/ata_seguimiento/getReporte.php';		
		
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

function reporteEXCEL(){
	var reporte = $('#form_main #reporte').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs_regis').val();	
	var url = '';
	
	if($('#form_main #reporte').val() == null || $('#form_main #reporte').val() == ""){
	  reporte = 1;
	}else{
	  reporte = $('#form_main #reporte').val();
	}	 
	
	if(reporte == 1){
	   url = '<?php echo SERVERURL; ?>php/ata_seguimiento/buscar_ata_seguimiento_excel.php?desde='+desde+'&hasta='+hasta+'&dato='+dato;
	}else{
	   url = '<?php echo SERVERURL; ?>php/ata_seguimiento/buscar_pacientes_seguimiento_excel.php?desde='+desde+'&hasta='+hasta;
	}	
    
	window.open(url);	
}

function limpiar(){
    pagination(1);
	getReporte();
}

$('#form_main #reporte_excel').on('click', function(e){
    e.preventDefault();
	reporteEXCEL();
});

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});
</script>