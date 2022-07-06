<script>
$(document).ready(function() {
	//$('#dataTableEntrevistaTS').DataTable().ajax.reload(null, false);
	listar_entrevista_ts();
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#agregar_pasivos").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_pasivos #expediente').focus();
    });
});

$(document).ready(function(){
    $("#agregar_fallecidos").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_fallecidos #expediente').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

$(document).ready(function() {
    cleanEntrevistaTS();
});

//INICIO ACCIONES FROMULARIO ENTREVISTA
var listar_entrevista_ts = function(){
	var table_entrevista_ts  = $("#dataTableEntrevistaTS").DataTable({
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/reporte_entrevista_ts/getEntrevistaTS.php"
		},		
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"usuario"},
			{"data":"identidad"},
			{"data":"expediente"},
			{"data":"modalidad"},
			{"data":"entrevistado"},
			{"data":"relacion"},
			{"data":"trabajador_social"},
			{"data":"solicitado_por"},			
			{"data":"agenda"},
			{"data":"servicio"},			
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit'></span></button>"},
			{"defaultContent":"<button class='delete btn btn-danger'><span class='fa fa-trash'></span></button>"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,
		"columnDefs": [	
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 },
		  { width: "7.69%", targets: 3 },
		  { width: "7.69%", targets: 4 },
		  { width: "7.69%", targets: 5 },
		  { width: "7.69%", targets: 6 },
		  { width: "7.69%", targets: 7 },
		  { width: "8.69%", targets: 8 },
		  { width: "8.69%", targets: 9 },
		  { width: "2.69%", targets: 10 },
		  { width: "2.69%", targets: 11 }		  
		],			
		"buttons":[		
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Entrevista Trabajo Social',
				className: 'btn btn-info',
				action: 	function(){
					listar_entrevista_ts();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Entrevista Trabajo Social',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Entrevista Trabajo Social',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,//esta se encuenta en el archivo main.js
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_entrevista_ts.search('').draw();
	$('#buscar').focus();
	
	view_reporte_trabajo_social_dataTable("#dataTableEntrevistaTS tbody", table_entrevista_ts);
	edit_reporte_trabajo_social_dataTable("#dataTableEntrevistaTS tbody", table_entrevista_ts);
	delete_reporte_trabajo_social_dataTable("#dataTableEntrevistaTS tbody", table_entrevista_ts);
}

var view_reporte_trabajo_social_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 9){
			var data = table.row( $(this).parents("tr") ).data();		
			var entrevista_id = data.entrevista_id		
			var url = '<?php echo SERVERURL; ?>php/reporte_entrevista_ts/getEntrevistaDetalles.php';

			$.ajax({
				type:'POST',
				url:url,
				data:'entrevista_id='+entrevista_id,
				success:function(data){										
				   $('#mensaje_show').modal({
					 show:true,
					 keyboard: false,
					 backdrop:'static'  
				   });	
				   $('#mensaje_mensaje_show').html(data);
				   $('#mensaje_sistema #bad').hide();
				   $('#mensaje_sistema #okay').show();				
				}
			});
		}else{
		  swal({
				title: 'Acceso Denegado', 
				text: 'No tiene permisos para ejecutar esta acción',
				type: 'error', 
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
		  });		
		}				
	});
}

var edit_reporte_trabajo_social_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");
	$(tbody).on("click", "button.editar", function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 9){
			var data = table.row( $(this).parents("tr") ).data();
			$('#formulario_entrevista_trabajo_social')[0].reset();
			$('#formulario_entrevista_trabajo_social #entrevista_id').val(data.entrevista_id);
			var url = '<?php echo SERVERURL; ?>php/reporte_entrevista_ts/buscarEntrevista.php';		
			
			$.ajax({
				type:'POST',
				url:url,
				data:$('#formulario_entrevista_trabajo_social').serialize(),
				success: function(valores){
					var datos = eval(valores);	
					$('#formulario_entrevista_trabajo_social .nav-tabs li:eq(0) a').tab('show');
					$('#formulario_entrevista_trabajo_social').attr({ 'data-form': 'update' }); 
					$('#formulario_entrevista_trabajo_social').attr({ 'action': '<?php echo SERVERURL; ?>php/reporte_entrevista_ts/actualizarEntrevista.php' }); 
					$('#formulario_entrevista_trabajo_social #reg_entrevista').hide();		
					$('#formulario_entrevista_trabajo_social #edi_entrevista').show();
					$('#formulario_entrevista_trabajo_social #delete_entrevista').hide();
					
					$('#formulario_entrevista_trabajo_social #expediente').val(datos[0]);
					$('#formulario_entrevista_trabajo_social #fecha').val(datos[1]);
					$('#formulario_entrevista_trabajo_social #modalidad').val(datos[2]);			
					$('#formulario_entrevista_trabajo_social #nombre').val(datos[3]);
					$('#formulario_entrevista_trabajo_social #entrevistado').val(datos[4]);
					$('#formulario_entrevista_trabajo_social #relacion').val(datos[5]);				
					$('#formulario_entrevista_trabajo_social #solicitado').val(datos[6]);			
					$('#formulario_entrevista_trabajo_social #intervencion').val(datos[7]);	
					$('#formulario_entrevista_trabajo_social #agenda').val(datos[8]);				
					$('#formulario_entrevista_trabajo_social #servicio_id').val(datos[9]);	
					$('#formulario_entrevista_trabajo_social #motivo').val(datos[10]);				
					$('#formulario_entrevista_trabajo_social #desarrollo').val(datos[11]);
					$('#formulario_entrevista_trabajo_social #valoracion').val(datos[12]);				
					$('#formulario_entrevista_trabajo_social #observaciones').val(datos[13]);
					$('#formulario_entrevista_trabajo_social #clasificacion1').val(datos[14]);
					getTiplogia_edit1(datos[14], datos[15])
					$('#formulario_entrevista_trabajo_social #tipologia1').val(datos[15]);
					$('#formulario_entrevista_trabajo_social #clasificacion2').val(datos[16]);
					getTiplogia_edit2(datos[16], datos[17]);
					$('#formulario_entrevista_trabajo_social #clasificacion3').val(datos[18]);
					getTiplogia_edit3(datos[18], datos[19]);	

					//BLOQUEAR CONTROLES
					$('#formulario_entrevista_trabajo_social #expediente').attr('readonly',true);
					$('#formulario_entrevista_trabajo_social #fecha').attr('readonly',true);
					
					activarDesactivarControles(false);				
					
					$('#formulario_entrevista_trabajo_social #pro_entrevista').val("Editar");	
						
					$('#modal_entrevista_trabajo_social').modal({
					  show:true,
					  keyboard: false,
					  backdrop:'static'
					});	
					return false;
				}
			});
			return false;
		}else{
		  swal({
				title: 'Acceso Denegado', 
				text: 'No tiene permisos para ejecutar esta acción',
				type: 'error', 
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
		  });		
		}			
	});
}

var delete_reporte_trabajo_social_dataTable = function(tbody, table){
	$(tbody).off("click", "button.delete");	
	$(tbody).on("click", "button.delete", function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 9){
			var data = table.row( $(this).parents("tr") ).data();
			var url = '<?php echo SERVERURL; ?>php/reporte_entrevista_ts/buscarEntrevista.php';
			$('#formulario_entrevista_trabajo_social')[0].reset();
			$('#formulario_entrevista_trabajo_social #entrevista_id').val(data.entrevista_id);	
			
			$.ajax({
				type:'POST',
				url:url,
				data:$('#formulario_entrevista_trabajo_social').serialize(),
				success: function(valores){
					var datos = eval(valores);
					$('#formulario_entrevista_trabajo_social .nav-tabs li:eq(0) a').tab('show');
					$('#formulario_entrevista_trabajo_social .nav-tabs li:eq(0) a').tab('show');	
					$('#formulario_entrevista_trabajo_social').attr({ 'data-form': 'delete' }); 
					$('#formulario_entrevista_trabajo_social').attr({ 'action': '<?php echo SERVERURL; ?>php/reporte_entrevista_ts/eliminarEntrevista.php' }); 				
					$('#formulario_entrevista_trabajo_social #reg_entrevista').hide();		
					$('#formulario_entrevista_trabajo_social #edi_entrevista').hide();
					$('#formulario_entrevista_trabajo_social #delete_entrevista').show();

					$('#formulario_entrevista_trabajo_social #expediente').val(datos[0]);
					$('#formulario_entrevista_trabajo_social #fecha').val(datos[1]);
					$('#formulario_entrevista_trabajo_social #modalidad').val(datos[2]);			
					$('#formulario_entrevista_trabajo_social #nombre').val(datos[3]);
					$('#formulario_entrevista_trabajo_social #entrevistado').val(datos[4]);
					$('#formulario_entrevista_trabajo_social #relacion').val(datos[5]);			
					$('#formulario_entrevista_trabajo_social #solicitado').val(datos[6]);			
					$('#formulario_entrevista_trabajo_social #intervencion').val(datos[7]);	
					$('#formulario_entrevista_trabajo_social #agenda').val(datos[8]);				
					$('#formulario_entrevista_trabajo_social #servicio_id').val(datos[9]);	
					$('#formulario_entrevista_trabajo_social #motivo').val(datos[10]);				
					$('#formulario_entrevista_trabajo_social #desarrollo').val(datos[11]);
					$('#formulario_entrevista_trabajo_social #valoracion').val(datos[12]);				
					$('#formulario_entrevista_trabajo_social #observaciones').val(datos[13]);
					$('#formulario_entrevista_trabajo_social #clasificacion1').val(datos[14]);
					getTiplogia_edit1(datos[14], datos[15]);
					$('#formulario_entrevista_trabajo_social #clasificacion2').val(datos[16]);	
					getTiplogia_edit2(datos[16], datos[17]);
					$('#formulario_entrevista_trabajo_social #clasificacion3').val(datos[18]);
					getTiplogia_edit3(datos[18], datos[19]);	
					
					//BLOQUEAR CONTROLES
					$('#formulario_entrevista_trabajo_social #expediente').attr('readonly',true);
					$('#formulario_entrevista_trabajo_social #fecha').attr('readonly',true);	
					
					activarDesactivarControles(true);				
					
					$('#formulario_entrevista_trabajo_social #pro_entrevista').val("Eliminar");	
						
					$('#modal_entrevista_trabajo_social').modal({
					  show:true,
					  keyboard: false,
					  backdrop:'static'
					});	
					return false;
				}
			});
			return false;
		}else{
		  swal({
				title: 'Acceso Denegado', 
				text: 'No tiene permisos para ejecutar esta acción',
				type: 'error', 
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
		  });		
		}			
	});
}

function getTiplogia_edit1(clasificacion, tipologia){
	var url = '<?php echo SERVERURL; ?>php/reporte_entrevista_ts/getTipologia.php';
		
	$.ajax({
	   type:'POST',
	   url:url,
	   data:'clasificacion='+clasificacion,
	   success:function(data){
	      $('#formulario_entrevista_trabajo_social #tipologia1').html("");
		  $('#formulario_entrevista_trabajo_social #tipologia1').html(data);
		  $('#formulario_entrevista_trabajo_social #tipologia1').val(tipologia);
	  }
	});
	return false;		
}

function getTiplogia_edit2(clasificacion, tipologia){
	var url = '<?php echo SERVERURL; ?>php/reporte_entrevista_ts/getTipologia.php';
		
	$.ajax({
	   type:'POST',
	   url:url,
	   data:'clasificacion='+clasificacion,
	   success:function(data){
	      $('#formulario_entrevista_trabajo_social #tipologia2').html("");
		  $('#formulario_entrevista_trabajo_social #tipologia2').html(data);
		  $('#formulario_entrevista_trabajo_social #tipologia2').val(tipologia);		  
	  }
	});
	return false;		
}

function getTiplogia_edit3(clasificacion, tipologia){
	var url = '<?php echo SERVERURL; ?>php/reporte_entrevista_ts/getTipologia.php';
		
	$.ajax({
	   type:'POST',
	   url:url,
	   data:'clasificacion='+clasificacion,
	   success:function(data){
	      $('#formulario_entrevista_trabajo_social #tipologia3').html("");
		  $('#formulario_entrevista_trabajo_social #tipologia3').html(data);
		  $('#formulario_entrevista_trabajo_social #tipologia3').val(tipologia);		  
	  }
	});
	return false;		
}

function activarDesactivarControles(valor){
	$('#formulario_entrevista_trabajo_social #modalidad').attr('disabled',valor);
	$('#formulario_entrevista_trabajo_social #entrevistado').attr('readonly',valor);	
	$('#formulario_entrevista_trabajo_social #relacion').attr('disabled',valor);
	$('#formulario_entrevista_trabajo_social #solicitado').attr('disabled',valor);	
	$('#formulario_entrevista_trabajo_social #intervencion').attr('disabled',valor);
	$('#formulario_entrevista_trabajo_social #agenda').attr('readonly',valor);	
	$('#formulario_entrevista_trabajo_social #servicio_id').attr('disabled',valor);
	$('#formulario_entrevista_trabajo_social #motivo').attr('readonly',valor);	
	$('#formulario_entrevista_trabajo_social #desarrollo').attr('readonly',valor);
	$('#formulario_entrevista_trabajo_social #valoracion').attr('readonly',valor);	
	$('#formulario_entrevista_trabajo_social #observaciones').attr('readonly',valor);
	$('#formulario_entrevista_trabajo_social #clasificacion1').attr('disabled',valor);	
	$('#formulario_entrevista_trabajo_social #tipologia1').attr('disabled',valor);
	$('#formulario_entrevista_trabajo_social #clasificacion2').attr('disabled',valor);	
	$('#formulario_entrevista_trabajo_social #tipologia2').attr('disabled',valor);
	$('#formulario_entrevista_trabajo_social #clasificacion3').attr('disabled',valor);
	$('#formulario_entrevista_trabajo_social #tipologia3').attr('disabled',valor);	
}
</script>