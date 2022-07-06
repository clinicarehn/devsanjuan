<script>
$(document).ready(function() {
	  $('#form_main #servicio').on('change', function(){
		var servicio_id = $('#form_main #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#form_main #unidad').html(data);						
            }
         });
		 
      });					
});

$(document).ready(function() {
	getServicio();
	getReporte();
});
	
$(document).ready(function() {
	  $('#form_main #unidad').on('change', function(){
		var servicio_id = $('#form_main #servicio').val();
		var puesto_id = $('#form_main #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id+'&puesto_id='+puesto_id,
            success: function(data){
				$('#form_main #medico_general').html("");
				$('#form_main #medico_general').html(data);			
            }
         });
		 
      });					
});

//UNIDADES
function pagination(partida){
    var reporte = $('#form_main #reporte').val();	
	var servicio = $('#form_main #servicio').val();
	var unidad = $('#form_main #unidad').val();
	var colaborador = $('#form_main #medico_general').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();

	var url = '<?php echo SERVERURL; ?>php/reportes/buscar_ata_unidades.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		beforeSend: function(){
			swal({
				title: "",
				text: "Por favor espere...",
				imageUrl: '../img/gif-load.gif',
				closeOnConfirm: false,
				showConfirmButton: false,
				imageSize: '150x150',
				allowEscapeKey: false,
				allowOutsideClick: false
			});		   
        },		
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);			
		},
		complete:function(){
            //$('#myPleaseWait').modal('hide');
			swal.close();			
		}		
	});
	return false;	
}

function pagination1(partida){
    var reporte = $('#form_main #reporte').val();	
	var servicio = $('#form_main #servicio').val();
	var unidad = $('#form_main #unidad').val();
	var colaborador = $('#form_main #medico_general').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	
	var url = '<?php echo SERVERURL; ?>php/reportes/buscar_ata_psicoandpsiquia.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&servicio='+servicio,
		beforeSend: function(){
			swal({
				title: "",
				text: "Por favor espere...",
				imageUrl: '../img/gif-load.gif',
				closeOnConfirm: false,
				showConfirmButton: false,
				imageSize: '150x150',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
        },		
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);			
		},
		complete:function(){
            swal.close();			
		}	
	});
	return false;	
}
//CONSULTA REPORTES ATAS
$(document).ready(function() {
  $('#form_main #servicio').on('change', function(){
     if($('#form_main #reporte').val()!="" && $('#form_main #servicio').val()!=""){	   
        var servicio = $('#form_main #servicio').val();		  
        var reporte = $('#form_main #reporte').val();	
	    var unidad = $('#form_main #unidad').val();
	    var colaborador = $('#form_main #medico_general').val();
	    var desde = $('#form_main #fecha_i').val();
	    var hasta = $('#form_main #fecha_f').val(); 
		var url = '';			
		
		if(unidad == "" && reporte != "" && servicio != ""){
			
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_psicoandpsiquia.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_psicoandpsiquia.php';
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_psicoandpsiquia.php';
		    }		
		
		   if(reporte == "ata"){
		      pagination1(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();		
		         }	
              }); 						
		   }						
		}else{		
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_unidades.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_unidades.php';		      
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';		      
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_unidades.php';		      
		    }		
		
		   if(reporte == "ata"){
		      pagination(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();		
		         }
              }); 						
		   }						
		}
	 }	
   });	
});

$(document).ready(function() {
  $('#form_main #unidad').on('change', function(){	
     if($('#form_main #reporte').val()!="" && $('#form_main #servicio').val()!=""){	  
        var servicio = $('#form_main #servicio').val();		  
        var reporte = $('#form_main #reporte').val();	
	    var unidad = $('#form_main #unidad').val();
	    var colaborador = $('#form_main #medico_general').val();
	    var desde = $('#form_main #fecha_i').val();
	    var hasta = $('#form_main #fecha_f').val(); 
		var url = '';			
		
		if(unidad == "" && reporte != "" && servicio != ""){
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_psicoandpsiquia.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_psicoandpsiquia.php';
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_psicoandpsiquia.php';
		    }		
		
		   if(reporte == "ata"){
		      pagination1(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();		
		         }
              }); 						
		   }						
		}else{
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_unidades.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_unidades.php';		      
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';		      
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_unidades.php';		      
		    }		
		
		   if(reporte == "ata"){
		      pagination(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();			
		         }
              }); 						
		   }						
		}
	 }
   });					
});

$(document).ready(function() {
   $('#form_main #reporte').on('change', function(){
     if($('#reporte').val()!="" && $('#form_main #servicio').val()!=""){	   
        var servicio = $('#form_main #servicio').val();		  
        var reporte = $('#form_main #reporte').val();	
	    var unidad = $('#form_main #unidad').val();
	    var colaborador = $('#form_main #medico_general').val();
	    var desde = $('#form_main #fecha_i').val();
	    var hasta = $('#form_main #fecha_f').val(); 
		var url = '';			
		if(unidad == "" && reporte != "" && servicio != ""){
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_psicoandpsiquia.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_psicoandpsiquia.php';
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_psicoandpsiquia.php';
		    }		
		
		   if(reporte == "ata"){
		      pagination1(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");					
                 },
		         complete:function(){
                      swal.close();			
		         }
              }); 						
		   }						
		}else{
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_unidades.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_unidades.php';		      
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';		      
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_unidades.php';		      
		    }		
		
		   if(reporte == "ata"){
		      pagination(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();		
		         }
              }); 						
		   }						
		}
	 }
   });					
});

$(document).ready(function() {	
  $('#form_main #fecha_i').on('change', function(){
     if($('#form_main #reporte').val()!="" && $('#form_main #servicio').val()!=""){	   
        var servicio = $('#form_main #servicio').val();		  
        var reporte = $('#form_main #reporte').val();	
	    var unidad = $('#form_main #unidad').val();
	    var colaborador = $('#form_main #medico_general').val();
	    var desde = $('#form_main #fecha_i').val();
	    var hasta = $('#form_main #fecha_f').val(); 
		var url = '';			
		
		if(unidad == "" && reporte != "" && servicio != ""){
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_psicoandpsiquia.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_psicoandpsiquia.php';
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_psicoandpsiquia.php';
		    }		
		
		   if(reporte == "ata"){
		      pagination1(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();			
		         }
              }); 						
		   }						
		}else{
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_unidades.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_unidades.php';		      
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';		      
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_unidades.php';		      
		    }		
		
		   if(reporte == "ata"){
		      pagination(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();		
		         }
              }); 						
		   }						
		}
	 }
	});
});

$(document).ready(function() {
  $('#form_main #fecha_f').on('change', function(){
     if($('#reporte').val()!="" && $('#form_main #servicio').val()!=""){	   
        var servicio = $('#form_main #servicio').val();		  
        var reporte = $('#form_main #reporte').val();	
	    var unidad = $('#form_main #unidad').val();
	    var colaborador = $('#form_main #medico_general').val();
	    var desde = $('#form_main #fecha_i').val();
	    var hasta = $('#form_main #fecha_f').val(); 
		var url = '';			
		
		if(unidad == "" && reporte != "" && servicio != ""){
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_psicoandpsiquia.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_psicoandpsiquia.php';
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_psicoandpsiquia.php';
		    }		
		
		   if(reporte == "ata"){
		      pagination1(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");			
                 },
		         complete:function(){
                      swal.close();		
		         }
              }); 						
		   }						
		}else{
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_unidades.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_unidades.php';		      
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';		      
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_unidades.php';		      
		    }		
		
		   if(reporte == "ata"){
		      pagination(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();		
		         }
              }); 						
		   }						
		}
	 }
   });					
});

$(document).ready(function() {
  $('#form_main #medico_general').on('change', function(){
     if($('#reporte').val()!="" && $('#form_main #servicio').val()!=""){	   
        var servicio = $('#form_main #servicio').val();		  
        var reporte = $('#form_main #reporte').val();	
	    var unidad = $('#form_main #unidad').val();
	    var colaborador = $('#form_main #medico_general').val();
	    var desde = $('#form_main #fecha_i').val();
	    var hasta = $('#form_main #fecha_f').val(); 
		var url = '';			
		
		if(unidad == "" && reporte != "" && servicio != ""){
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_psicoandpsiquia.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_psicoandpsiquia.php';
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_psicoandpsiquia.php';
		    }		
		
		   if(reporte == "ata"){
		      pagination1(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();		
		         }
              }); 						
		   }						
		}else{
		    if(reporte == "at2rd"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_unidades.php';
		    }else if(reporte == "at2rm"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_unidades.php';		      
		    }else if(reporte == "sm03"){
   		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades.php';		      
		    }else if(reporte == "procedencia"){
		       url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_unidades.php';		      
		    }		
		
		   if(reporte == "ata"){
		      pagination(1);
		   }else{
		      $.ajax({
                 type: "POST",
                 url: url,
			     async: true,
                 data:'desde='+desde+'&hasta='+hasta+'&unidad='+unidad+'&servicio='+servicio+'&colaborador='+colaborador,
		         beforeSend: function(){
					swal({
						title: "",
						text: "Por favor espere...",
						imageUrl: '../img/gif-load.gif',
						closeOnConfirm: false,
						showConfirmButton: false,
						imageSize: '150x150',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                 },			  
                 success: function(data){
                     $('#agrega-registros').html(data);
			         $('#pagination').html("");				
                 },
		         complete:function(){
                      swal.close();			
		         }
              }); 						
		   }						
		}
	 }
   });					
});

function reporteEXCEL(){
 if($('#form_main #servicio').val()!=""){	
    var servicio = $('#form_main #servicio').val();		  
    var reporte = $('#form_main #reporte').val();	
	var unidad = $('#form_main #unidad').val();
	var colaborador = $('#form_main #medico_general').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
    var url = '';	

	if (unidad == "" && servicio !="" && reporte !=""){
		  if(reporte == "ata"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_ata_psicoandpsiquia_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;	
		  }else if(reporte == "at2rd"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_psicoandpsiquia_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;	
		  }else if(reporte == "at2rm"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_psicoandpsiquia_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
		  }else if(reporte == "sm03"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;	
		  }else if(reporte == "procedencia"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_psicoandpsiquia_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
		  }				
	}else{
       if(servicio !="" && reporte != "" && unidad !=""){
		  if(reporte == "ata"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_ata_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador='+colaborador;	
		  }else if(reporte == "at2rd"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rd_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador='+colaborador;	
		  }else if(reporte == "at2rm"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_at2rm_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador='+colaborador;	
		  }else if(reporte == "sm03"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_sm03_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador='+colaborador;	
		  }else if(reporte == "procedencia"){
		      url = '<?php echo SERVERURL; ?>php/reportes/buscar_procedencia_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador='+colaborador;	
		  }
	  }				
	}
    window.open(url);	
}else{  
		swal({
			title: "Error", 
			text: "Debe seleccionar por lo menos una opción de búsqueda",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			  
  }		
}

function limpiar(){
	$('#pagination').html("");
    getServicio();
	getReporte();
}

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/reportes/getReporte.php';		
		
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
    var url = '<?php echo SERVERURL; ?>php/reportes/getServicio.php';		
		
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

$('#form_main #reporte_excel').on('click', function(e){
    e.preventDefault();
    reporteEXCEL();
});

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});
</script>