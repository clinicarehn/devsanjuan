<script>
$(document).ready(function(){
	listar_receta();
	listar_busqueda_productos();
	getServicioReceta();

	$('#label_acciones_volver').html("Reporte Receta");
	$('#label_acciones_receta').html("");
	listar_busqueda_productos();
});

var listar_receta = function(){
	var table_receta  = $("#dataTableReceta").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/receta/getTablaReceta.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"fecha"},
			{"data":"identidad"},
			{"data":"expediente"},
			{"data":"usuario"},
			{"data":"profesional"},
			{"data":"servicio"},
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit'></span></button>"},
			{"defaultContent":"<button class='delete btn btn-danger'><span class='fa fa-trash'></span></button>"}
		],
    "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Receta Electrónica',
				className: 'btn btn-info',
				action: 	function(){
					listar_entrevista_ts();
				}
			},
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Receta Electrónica',
				className: 'btn btn-success'
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Receta Electrónica',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,//esta se encuenta en el archivo main.js
						width:170,
            height:45
					});
				}
			}
		]
	});
	table_receta.search('').draw();
	$('#buscar').focus();

	view_reporte_receta_electronica_dataTable("#dataTableReceta tbody", table_receta);
	edit_reporte_receta_electronica_dataTable("#dataTableReceta tbody", table_receta);
	delete_reporte_receta_electronica_dataTable("#dataTableReceta tbody", table_receta);
}

var view_reporte_receta_electronica_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
			var data = table.row( $(this).parents("tr") ).data();
			var receta_id = data.receta_id
			var url = '<?php echo SERVERURL; ?>php/receta/getReceta.php';

			$.ajax({
				type:'POST',
				url:url,
				data:'receta_id='+receta_id,
				success:function(data){
				   var datos = eval(data);
				   $('#receta_medica').show();
				   $('#label_acciones_volver').html("Reporte Receta Electrónica");
				   $('#label_acciones_receta').html("Receta Electrónica");
				   $('#reporteReceta').hide();
				   $('#validar_receta').hide();
				   $('#editar_receta').hide();
				   $('#eliminar_receta').hide();
				   $('#acciones_atras').addClass("breadcrumb-item active");
				   $('#acciones_receta').removeClass("active");
				   $('#formulario_receta_medica #expediente').val(datos[0]);
				   $('#formulario_receta_medica #fecha').val(datos[1]);
				   $('#formulario_receta_medica #identidad').val(datos[2]);
				   $('#formulario_receta_medica #nombre').val(datos[3]);
				   $('#formulario_receta_medica #servicio_receta').val(datos[4]);
				   $('#formulario_receta_medica #servicio_receta').selectpicker('refresh');
				   $('#formulario_receta_medica #observaciones').val(datos[5]);

				   //DESHABILITAR OBJETOS
				   $('#formulario_receta_medica #fecha').attr('disabled', true);
				   $('#formulario_receta_medica #servicio_receta').attr('disabled', true);
				   $('#formulario_receta_medica #observaciones').attr('readonly',true);
				   $('#validar_receta').hide();
				   $('#editar_receta').hide();
				   $('#eliminar_receta').hide();

					 $('#formulario_receta_medica #addRows').hide();
					 $('#formulario_receta_medica #removeRows').hide();
				   $('#formulario_receta_medica #buscar_servicio_receta_electronica').hide();
				}
			});

			var url = '<?php echo SERVERURL; ?>php/receta/getRecetaDetalle.php';

			$.ajax({
				type:'POST',
				url:url,
				data:'receta_id='+receta_id,
				success:function(data){
					var datos = eval(data);
					$("#formulario_receta_medica #recetaItem > tbody").empty();//limpia solo los registros del body
					for(var fila=0; fila < datos.length; fila++){
						var product_template_id = datos[fila]["product_template_id"];
						var producto = datos[fila]["producto"];
						var concentracion = datos[fila]["concentracion"];
						var unidad = datos[fila]["unidad"];
						var producto_name = producto + ' ' +concentracion + ' ' + unidad;
						var via = datos[fila]["via"];
						var cantidad = datos[fila]["cantidad"];
						var manana = datos[fila]["manana"];
						var mediodia = datos[fila]["mediodia"];
						var tarde = datos[fila]["tarde"];
						var noche = datos[fila]["noche"];
						llenarReceta(fila);
						$('#formulario_receta_medica #recetaItem #productCode_'+ fila).val(product_template_id);
						$('#formulario_receta_medica #recetaItem #product_'+ fila).val(producto);
						$('#formulario_receta_medica #recetaItem #concentracion_'+ fila).val(concentracion);
						$('#formulario_receta_medica #recetaItem #unidad_'+ fila).val(unidad);
						$('#formulario_receta_medica #recetaItem #productName_'+ fila).val(producto_name);
						getViaReceta(fila, via);
						$('#formulario_receta_medica #recetaItem #quanty_'+ fila).val(cantidad);
						$('#formulario_receta_medica #recetaItem #manana_'+ fila).val(manana);
						$('#formulario_receta_medica #recetaItem #mediodia_'+ fila).val(mediodia);
						$('#formulario_receta_medica #recetaItem #tarde_'+ fila).val(tarde);
						$('#formulario_receta_medica #recetaItem #noche_'+ fila).val(noche);

						//DESHABILITAR OBJETOS
						$('#formulario_receta_medica #recetaItem #productCode_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #product_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #concentracion_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #unidad_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #productName_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #via_'+ fila).attr('disabled',true);
						$('#formulario_receta_medica #recetaItem #quanty_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #manana_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #mediodia_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #tarde_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem #noche_'+ fila).attr('readonly',true);
						$('#formulario_receta_medica #recetaItem .itemRow').attr('disabled',true);
						$('#formulario_receta_medica #recetaItem #checkAll').attr('disabled',true);
						$('#formulario_receta_medica #validar').attr('disabled',true);
						$('#formulario_receta_medica #addRows').attr('disabled',true);
						$('#formulario_receta_medica #removeRows').attr('disabled',true);
						$("#formulario_receta_medica #recetaItem #producto_grupo").hide();
					}
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

var edit_reporte_receta_electronica_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");
	$(tbody).on("click", "button.editar", function(e){
		var data = table.row( $(this).parents("tr") ).data();
		var receta_id = data.receta_id
		e.preventDefault();

		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8 || getUsuarioSistema() == 16){
			if(owner(receta_id) == 1){
				e.preventDefault();
				var url = '<?php echo SERVERURL; ?>php/receta/getReceta.php';
				$('#formulario_receta_medica #receta_id').val(receta_id);

				$.ajax({
					type:'POST',
					url:url,
					data:'receta_id='+receta_id,
					success:function(data){
					   var datos = eval(data);
					   $('#receta_medica').show();
					   $('#label_acciones_volver').html("Reporte Receta Electrónica");
					   $('#label_acciones_receta').html("Receta Electrónica");
					   $('#reporteReceta').hide();
					   $('#acciones_atras').addClass("breadcrumb-item active");
					   $('#acciones_receta').removeClass("active");
					   $('#formulario_receta_medica #expediente').val(datos[0]);
					   $('#formulario_receta_medica #fecha').val(datos[1]);
					   $('#formulario_receta_medica #identidad').val(datos[2]);
					   $('#formulario_receta_medica #nombre').val(datos[3]);
					   $('#formulario_receta_medica #servicio_receta').val(datos[4]);
					   $('#formulario_receta_medica #servicio_receta').selectpicker('refresh');
					   $('#formulario_receta_medica #observaciones').val(datos[5]);
					   $('#validar_receta').hide();
					   $('#editar_receta').show();
					   $('#eliminar_receta').hide();

						 $('#formulario_receta_medica #addRows').hide();
						 $('#formulario_receta_medica #removeRows').hide();

						 $('#formulario_receta_medica').attr({ 'data-form': 'update' });
						 $('#formulario_receta_medica').attr({ 'action': '<?php echo SERVERURL; ?>php/receta/editReceta.php' });

						 //HABILITAR OBJETOS
						  $('#formulario_receta_medica #observaciones').attr('readonly',false);

					   //DESHABILITAR OBJETOS
					   $('#formulario_receta_medica #servicio_receta').attr('disabled', true);
					   $('#formulario_receta_medica #fecha').attr('disabled', true);
					   $('#formulario_receta_medica #buscar_servicio_receta_electronica').hide();
						 caracteresObservacionReceta();
					}
				});
				var url = '<?php echo SERVERURL; ?>php/receta/getRecetaDetalle.php';

				$.ajax({
					type:'POST',
					url:url,
					data:'receta_id='+receta_id,
					success:function(data){
						var datos = eval(data);
						$("#formulario_receta_medica #recetaItem > tbody").empty();//limpia solo los registros del body
						for(var fila=0; fila < datos.length; fila++){
							var product_template_id = datos[fila]["product_template_id"];
							var producto = datos[fila]["producto"];
							var concentracion = datos[fila]["concentracion"];
							var unidad = datos[fila]["unidad"];
							var producto_name = producto + ' ' +concentracion + ' ' + unidad;
							var via = datos[fila]["via"];
							var cantidad = datos[fila]["cantidad"];
							var manana = datos[fila]["manana"];
							var mediodia = datos[fila]["mediodia"];
							var tarde = datos[fila]["tarde"];
							var noche = datos[fila]["noche"];
							llenarReceta(fila);
							$('#formulario_receta_medica #recetaItem #productCode_'+ fila).val(product_template_id);
							$('#formulario_receta_medica #recetaItem #product_'+ fila).val(producto);
							$('#formulario_receta_medica #recetaItem #concentracion_'+ fila).val(concentracion);
							$('#formulario_receta_medica #recetaItem #unidad_'+ fila).val(unidad);
							$('#formulario_receta_medica #recetaItem #productName_'+ fila).val(producto_name);
							getViaReceta(fila, via);
							$('#formulario_receta_medica #recetaItem #quanty_'+ fila).val(cantidad);
							$('#formulario_receta_medica #recetaItem #manana_'+ fila).val(manana);
							$('#formulario_receta_medica #recetaItem #mediodia_'+ fila).val(mediodia);
							$('#formulario_receta_medica #recetaItem #tarde_'+ fila).val(tarde);
							$('#formulario_receta_medica #recetaItem #noche_'+ fila).val(noche);

							//DESHABILITAR OBJETOS
							$('#formulario_receta_medica #recetaItem #productName_'+ fila).attr('readonly',true);

							//HABILITAR OBJETOS
							$('#formulario_receta_medica #recetaItem #productCode_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem #product_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem #concentracion_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem #unidad_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem #via_'+ fila).attr('disabled',false);
							$('#formulario_receta_medica #recetaItem #quanty_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem #manana_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem #mediodia_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem #tarde_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem #noche_'+ fila).attr('readonly',false);
							$('#formulario_receta_medica #recetaItem .itemRow').attr('disabled',false);
							$('#formulario_receta_medica #recetaItem #checkAll').attr('disabled',false);
							$('#formulario_receta_medica #validar').attr('disabled',false);
							$('#formulario_receta_medica #addRows').attr('disabled',false);
							$('#formulario_receta_medica #removeRows').attr('disabled',false);
							$("#formulario_receta_medica #recetaItem #producto_grupo").hide();
						}
					}
				});

				$('#formulario_receta_medica').attr({ 'data-form': 'update' });
				$('#formulario_receta_medica').attr({ 'action': '<?php echo SERVERURL; ?>php/receta/editReceta.php' });
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

var delete_reporte_receta_electronica_dataTable = function(tbody, table){
	$(tbody).off("click", "button.delete");
	$(tbody).on("click", "button.delete", function(e){
		var data = table.row( $(this).parents("tr") ).data();
		var receta_id = data.receta_id
		e.preventDefault();

		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8 || getUsuarioSistema() == 16){
			//VERIFICAMOS EL PROPIETARIO DE LA RECETA (QUIEN LAS PRESCRIBIO)
			if(owner(receta_id) == 1){
				var data = table.row( $(this).parents("tr") ).data();
				var receta_id = data.receta_id
				var url = '<?php echo SERVERURL; ?>php/receta/getReceta.php';
				$('#formulario_receta_medica #receta_id').val(receta_id);

				$.ajax({
					type:'POST',
					url:url,
					data:'receta_id='+receta_id,
					success:function(data){
					   var datos = eval(data);
					   $('#receta_medica').show();
					   $('#label_acciones_volver').html("Reporte Receta Electrónica");
					   $('#label_acciones_receta').html("Receta Electrónica");
					   $('#reporteReceta').hide();
					   $('#acciones_atras').addClass("breadcrumb-item active");
					   $('#acciones_receta').removeClass("active");
					   $('#formulario_receta_medica #expediente').val(datos[0]);
					   $('#formulario_receta_medica #fecha').val(datos[1]);
					   $('#formulario_receta_medica #identidad').val(datos[2]);
					   $('#formulario_receta_medica #nombre').val(datos[3]);
					   $('#formulario_receta_medica #servicio_receta').val(datos[4]);
					   $('#formulario_receta_medica #servicio_receta').selectpicker('refresh');
					   $('#formulario_receta_medica #observaciones').val(datos[5]);
					   $('#validar_receta').hide();
					   $('#editar_receta').hide();
					   $('#eliminar_receta').show();

						 $('#formulario_receta_medica #addRows').hide();
						 $('#formulario_receta_medica #removeRows').hide();

					   $('#formulario_receta_medica').attr({ 'data-form': 'delete' });
					   $('#formulario_receta_medica').attr({ 'action': '<?php echo SERVERURL; ?>php/receta/delReceta.php' });

					   //DESHABILITAR OBJETOS
					   $('#formulario_receta_medica #servicio_receta').attr('disabled', true);
					   $('#formulario_receta_medica #fecha').attr('disabled', true);
					   $('#formulario_receta_medica #observaciones').attr('readonly',true);
					   $('#formulario_receta_medica #buscar_servicio_receta_electronica').hide();
					}
				});
				var url = '<?php echo SERVERURL; ?>php/receta/getRecetaDetalle.php';

				$.ajax({
					type:'POST',
					url:url,
					data:'receta_id='+receta_id,
					success:function(data){
						var datos = eval(data);
						$("#formulario_receta_medica #recetaItem > tbody").empty();//limpia solo los registros del body
						for(var fila=0; fila < datos.length; fila++){
							var product_template_id = datos[fila]["product_template_id"];
							var producto = datos[fila]["producto"];
							var concentracion = datos[fila]["concentracion"];
							var unidad = datos[fila]["unidad"];
							var producto_name = producto + ' ' +concentracion + ' ' + unidad;
							var via = datos[fila]["via"];
							var cantidad = datos[fila]["cantidad"];
							var manana = datos[fila]["manana"];
							var mediodia = datos[fila]["mediodia"];
							var tarde = datos[fila]["tarde"];
							var noche = datos[fila]["noche"];
							llenarReceta(fila);
							$('#formulario_receta_medica #recetaItem #productCode_'+ fila).val(product_template_id);
							$('#formulario_receta_medica #recetaItem #product_'+ fila).val(producto);
							$('#formulario_receta_medica #recetaItem #concentracion_'+ fila).val(concentracion);
							$('#formulario_receta_medica #recetaItem #unidad_'+ fila).val(unidad);
							$('#formulario_receta_medica #recetaItem #productName_'+ fila).val(producto_name);
							getViaReceta(fila, via);
							$('#formulario_receta_medica #recetaItem #quanty_'+ fila).val(cantidad);
							$('#formulario_receta_medica #recetaItem #manana_'+ fila).val(manana);
							$('#formulario_receta_medica #recetaItem #mediodia_'+ fila).val(mediodia);
							$('#formulario_receta_medica #recetaItem #tarde_'+ fila).val(tarde);
							$('#formulario_receta_medica #recetaItem #noche_'+ fila).val(noche);

							//DESHABILITAR OBJETOS
							$('#formulario_receta_medica #recetaItem #productCode_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #product_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #concentracion_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #unidad_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #productName_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #via_'+ fila).attr('disabled',true);
							$('#formulario_receta_medica #recetaItem #quanty_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #manana_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #mediodia_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #tarde_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem #noche_'+ fila).attr('readonly',true);
							$('#formulario_receta_medica #recetaItem .itemRow').attr('disabled',true);
							$('#formulario_receta_medica #recetaItem #checkAll').attr('disabled',true);
							$('#formulario_receta_medica #validar').attr('disabled',true);
							$('#formulario_receta_medica #addRows').attr('disabled',true);
							$('#formulario_receta_medica #removeRows').attr('disabled',true);
							$("#formulario_receta_medica #recetaItem #producto_grupo").hide();
						}
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

$('#acciones_atras').on('click', function(e){
	 e.preventDefault;
	 if($('#formulario_receta_medica #productName_0').val() != ""){
		swal({
			title: "Tiene datos en la receta",
			text: "¿Esta seguro que desea volver, recuerde que tiene información en la receta la perderá?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			confirmButtonText: "¡Si, deseo volver!",
			closeOnConfirm: false,
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(){
			$('#reporteReceta').show();
			$('#label_acciones_receta').html("");
			$('#receta_medica').hide();
			$('#acciones_atras').addClass("breadcrumb-item active");
			$('#acciones_receta').removeClass("active");
			$('#formulario_receta_medica')[0].reset();
			swal.close();
		});
	 }else{
		 $('#reporteReceta').show();
		 $('#label_acciones_receta').html("");
		 $('#receta_medica').hide();
		 $('#acciones_atras').addClass("breadcrumb-item active");
		 $('#acciones_receta').removeClass("active");
	 }
});

$(document).ready(function(){
	$("#formulario_receta_medica #recetaItem").on('click', '.buscar_producto', function() {
		alert("Hola");
		if($("#formulario_receta_medica #expediente").val() != ""){
			listar_busqueda_productos();
			var row_index = $(this).closest("tr").index();
			var col_index = $(this).closest("td").index();

			$('#formulario_busqueda_productos #row').val(row_index);
			$('#formulario_busqueda_productos #col').val(col_index);
			$('#modal_productos').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});
		}else{
			swal({
				title: "Error",
				text: "Lo sentimos debe seleccionar un usuario antes de prescribir una receta",
				type: "error",
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		}
	});
});

function getServicioReceta(){
  var url = '<?php echo SERVERURL; ?>php/receta/getServicios.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
			$('#formulario_receta_medica #servicio_receta').html("");
			$('#formulario_receta_medica #servicio_receta').html(data);
			$('#formulario_receta_medica #servicio_receta').selectpicker('refresh');
		}
   });
   return false;
}

function owner(receta_id){
  var url = '<?php echo SERVERURL; ?>php/receta/owner.php';
  var dato;

  $.ajax({
 	 type:'POST',
	 data:'receta_id='+receta_id,
	 async: false,
	 url:url,
		success: function(data){
			dato = data;
		}
   });
   return dato;
}
</script>
