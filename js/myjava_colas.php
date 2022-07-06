<script>
$(document).ready(function() {
	$('#label_acciones_volver').html("Colas");
	$('#label_acciones_colas').html("");
	listar_colas();
	getServicioReceta();
	//setInterval('listar_colas()',3000); //CADA 3 SEGUNDOS
});

$('#acciones_atras').on('click', function(e){
	$('#formColas').show();
	$('#label_acciones_receta').html("");
	$('#receta_medica').hide();
	$('#acciones_atras').addClass("breadcrumb-item active");
	$('#acciones_receta').removeClass("active");
});

//INICIO ACCIONES FROMULARIO ENTREVISTA
var listar_colas = function(){
	var table_colas  = $("#dataTableColas").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/colas/getColaTabla.php"
		},
		"columns":[
			{"data":"cola_numero"},
			{"data":"hora"},
			{"data":"identidad"},
			{"data":"expediente"},
			{"data":"usuario"},
			{"data":"telefono1"},
			{"data":"edad"},
			{"data":"profesional"},
			{"data":"servicio"},
			{"defaultContent":"<button class='seguimiento btn btn-info' title='Ver Cita Seguimiento'><span class='fas fa-user-md'></span></button>"},
			{"defaultContent":"<button class='receta btn btn-primary' title='Ver Receta Medica'><span class='fas fa-prescription'></span></button>"},
			{"defaultContent":"<button class='remove btn btn-danger' title='Remover Usuario'><span class='fas fa-user-minus'></span></button>"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,	
		"aProcessing": true,
		"aServerSide": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,
		"columnDefs": [
		  { width: "3.09%", targets: 0 },
		  { width: "10.09%", targets: 1 },
		  { width: "9.09%", targets: 2 },
		  { width: "5.09%", targets: 3 },
		  { width: "20.09%", targets: 4 },
		  { width: "9.09%", targets: 5 },
		  { width: "9.09%", targets: 6 },
		  { width: "16.09%", targets: 7 },
		  { width: "6.09%", targets: 8 },
		  { width: "6.09%", targets: 7 },
		  { width: "6.09%", targets: 8 },
		  { width: "6.09%", targets: 9 }
		],			
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Colas',
				className: 'btn btn-info',
				action: 	function(){
					listar_colas();
				}
			}
		]		
	});
	$('#buscar').focus();

	remove_usuario_dataTable("#dataTableColas tbody", table_colas);
	view_receta_dataTable("#dataTableColas tbody", table_colas);
	seguimiento_usuario_dataTable("#dataTableColas tbody", table_colas);
}

var remove_usuario_dataTable = function(tbody, table){
	$(tbody).off("click", "button.remove");
	$(tbody).on("click", "button.remove", function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 10){
			var data = table.row( $(this).parents("tr") ).data();
			var colas_id = data.colas_id;

			$('#label_acciones_receta').html("Receta Medica");

			swal({
			  title: "Remover Usuario",
			  text: "¿Esta seguro que desea remover este usuario de la cola?",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-warning",
			  confirmButtonText: "¡Si, deseo removerlo!",
			  closeOnConfirm: false
			},
			function(){
				var url = '<?php echo SERVERURL; ?>php/colas/removeUser.php';

				$.ajax({
					type:'POST',
					url:url,
					data:'colas_id='+colas_id,
					success:function(data){
						if(data == 1){
							swal({
								title: 'Success',
								text: 'Registro removido correctamente',
								type: "success",
								timer: 3000,
							});
							listar_colas();
						}else{
							  swal({
									title: 'Error',
									text: 'No se puede procesar su solicitud',
									type: 'error',
									confirmButtonClass: 'btn-danger'
							  });
						}
					}
				});
			});
		}else{
		  swal({
				title: 'Acceso Denegado',
				text: 'No tiene permisos para ejecutar esta acción',
				type: 'error',
				confirmButtonClass: 'btn-danger'
		  });
		}
	});
}

var view_receta_dataTable = function(tbody, table){
	$(tbody).off("click", "button.receta");
	$(tbody).on("click", "button.receta", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		var receta_id = data.receta_id;

		if(estadoReceta(receta_id) == 1){
			if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 10){
				if(data.receta_id != 0){

					var url = '<?php echo SERVERURL; ?>php/receta/getReceta.php';

					$('#label_acciones_receta').html("Receta Medica");

					$.ajax({
						type:'POST',
						url:url,
						data:'receta_id='+receta_id,
						success:function(data){
						   var datos = eval(data);
						   $('#receta_medica').show();
						   $('#formColas').hide();
						   $('#label_acciones_colas').html("Receta");
						   $('#reporteReceta').hide();
						   $('#acciones_atras').addClass("breadcrumb-item active");
						   $('#acciones_receta').removeClass("active");
						   $('#formulario_receta_medica #expediente').val(datos[0]);
						   $('#formulario_receta_medica #fecha').val(datos[1]);
						   $('#formulario_receta_medica #identidad').val(datos[2]);
						   $('#formulario_receta_medica #nombre').val(datos[3]);
						   $('#formulario_receta_medica #servicio_receta').val(datos[4]);
						   $('#formulario_receta_medica #observaciones').val(datos[5]);

						   //DESHABILITAR OBJETOS
						   $('#formulario_receta_medica #servicio_receta').attr('disabled', true);
							 $('#formulario_receta_medica #buscar_servicio_receta_electronica').hide();
						   $('#formulario_receta_medica #observaciones').attr('readonly',true);
						   $('#formulario_receta_medica #validar_receta').hide();
						   $('#formulario_receta_medica #editar_receta').hide();
						   $('#formulario_receta_medica #eliminar_receta').hide();
						   $('#formulario_receta_medica #addRows').hide();
						   $('#formulario_receta_medica #removeRows').hide();
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
								llenarTablaReceta(fila);

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
								$('#formulario_receta_medica #validar_receta').attr('disabled',true);
								$('#formulario_receta_medica #addRows').attr('disabled',true);
								$('#formulario_receta_medica #removeRows').attr('disabled',true);
								$("#formulario_receta_medica #recetaItem .buscar_producto").click(false);
							}
						}
					});
				}else{
					swal({
						title: 'Error',
						text: 'Este usuario no tiene una receta prescrita',
						type: 'error',
						confirmButtonClass: 'btn-danger'
					});
				}
			}else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger'
			  });
			}
		}else{
			swal({
				title: 'Error',
				text: 'Lo sentimos esta receta ha sido cancelada',
				type: 'error',
				confirmButtonClass: 'btn-danger'
			});
		}
	});
}

var seguimiento_usuario_dataTable = function(tbody, table){
	$(tbody).off("click", "button.seguimiento");
	$(tbody).on("click", "button.seguimiento", function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 10){
			$('#label_acciones_receta').html("Seguimiento");
			var data = table.row( $(this).parents("tr") ).data();
			var programar_cita_id = data.programar_cita_id;
			if(data.programar_cita_id != 0){
				var url = '<?php echo SERVERURL; ?>php/colas/getProgramacionCitas.php';

				$.ajax({
					type:'POST',
					url:url,
					data:'programar_cita_id='+data.programar_cita_id,
					success: function(data){
						var datos = eval(data);

						for(var fila=0; fila < datos.length; fila++){
								//DATOS DEL USUARIO
								$('#formCitaSeguimientoColas #datos_usuario_cita_seguimiento_title').html("<center><b>Datos Usuario</b></center>").addClass('text-success');

								$('#formCitaSeguimientoColas #nombre_seguimiento').html("<b>Usuario: </b>" + datos[fila]["usuario"]);
								$('#formCitaSeguimientoColas #identidad_seguimiento').html("<b>Identidad: </b>" + datos[fila]["identidad"]);
								$('#formCitaSeguimientoColas #expediente_seguimiento').html("<b>Expediente: </b>" + datos[fila]["expediente"]);

								//DATOS DE LA CITA
								$('#formCitaSeguimientoColas #cita_seguimiento_title').html("<center><b>Cita Seguimiento</b></center>").addClass('text-info');

								$('#formCitaSeguimientoColas #profesional_seguimiento').html("<b>Solicitado por: </b>" + datos[fila]["profesional"]);
								$('#formCitaSeguimientoColas #servicio_seguimiento').html("<b>Servicio: </b>" + datos[fila]["servicio"]);

								$('#formCitaSeguimientoColas #unidad_segumiento').html("<b>Unidad: </b>" + datos[fila]["unidad"]);

								$('#formCitaSeguimientoColas #tipo_cita_seguimiento').html("<b>Tipo Cita: </b>" + datos[fila]["tipo_cita"]);
								$('#formCitaSeguimientoColas #descripcion_seguimiento').html("<b>Observaciones: </b>" + datos[fila]["descripcion"]);
						}

						return false;
					},
					error: function(){
						swal({
							title: 'Error',
							text: 'Lo sentimos se presentó un error, por favor inténtelo de nuevo más tarde',
							type: 'error',
							confirmButtonClass: 'btn-danger'
						});
					}
				});
			}else{
				//DATOS DEL USUARIO
				$('#formCitaSeguimientoColas #datos_usuario_cita_seguimiento_title').html("<center><b>No hay datos de seguimiento que mostrar</b></center>").addClass('text-danger');

				$('#formCitaSeguimientoColas #nombre_seguimiento').html("");
				$('#formCitaSeguimientoColas #identidad_seguimiento').html("");
				$('#formCitaSeguimientoColas #expediente_seguimiento').html("");

				//DATOS DE LA CITA
				$('#formCitaSeguimientoColas #cita_seguimiento_title').html("").removeClass('text-info');

				$('#formCitaSeguimientoColas #profesional_seguimiento').html("");
				$('#formCitaSeguimientoColas #servicio_seguimiento').html("");

				$('#formCitaSeguimientoColas #unidad_segumiento').html("");

				$('#formCitaSeguimientoColas #tipo_cita_seguimiento').html("");
				$('#formCitaSeguimientoColas #descripcion_seguimiento').html("");
			}

			if(data.transito_id != 0){
				   var url = '<?php echo SERVERURL; ?>php/colas/getTransito.php';

					 $.ajax({
						 type: 'POST',
						 url: url,
						 data:'transito_id='+data.transito_id,
						 success: function(data){
								var datos = eval(data);

								for(var fila=0; fila < datos.length; fila++){
									//DATOS DEL USUARIO
									$('#formCitaSeguimientoColas #datos_usuario_cita_seguimiento_title1').html("<center><b>Datos Usuario</b></center>").addClass('text-success');

									$('#formCitaSeguimientoColas #nombre_seguimiento1').html("<b>Usuario: </b>" + datos[fila]["usuario"]);
									$('#formCitaSeguimientoColas #identidad_seguimiento1').html("<b>Identidad: </b>" + datos[fila]["identidad"]);
									$('#formCitaSeguimientoColas #expediente_seguimiento1').html("<b>Expediente: </b>" + datos[fila]["expediente"]);

									//DATOS DE LA CITA
									$('#formCitaSeguimientoColas #cita_seguimiento_title1').html("<center><b>Transito Usarios</b></center>").addClass('text-info');

									$('#formCitaSeguimientoColas #profesional_seguimiento1').html("<b>Profesional que envía: </b>" + datos[fila]["profesional"]);
									$('#formCitaSeguimientoColas #servicio_seguimiento1').html("<b>Unidad: </b>" + datos[fila]["enviadaa_unidad"]);
									$('#formCitaSeguimientoColas #tipo_cita_seguimiento1').html("<b>Servicio: </b>" + datos[fila]["enviadaa"]);
									$('#formCitaSeguimientoColas #descripcion_seguimiento1').html("<b>Observaciones: </b>" + datos[fila]["observacion"]);
								}

								return false;
						 },
						 error: function(){
							 swal({
									title: 'Error',
									text: 'Lo sentimos se presentó un error, por favor inténtelo de nuevo más tarde',
									type: 'error',
									confirmButtonClass: 'btn-danger'
							  });
						 }
					 });
			}else{
				//DATOS DEL USUARIO
				$('#formCitaSeguimientoColas #datos_usuario_cita_seguimiento_title1').html("<center><b>No hay datos de transito que mostrar</b></center>").addClass('text-danger');

				$('#formCitaSeguimientoColas #nombre_seguimiento1').html("");
				$('#formCitaSeguimientoColas #identidad_seguimiento1').html("");
				$('#formCitaSeguimientoColas #expediente_seguimiento1').html("");

				//DATOS DE LA CITA
				$('#formCitaSeguimientoColas #cita_seguimiento_title1').html("").removeClass('text-info');

				$('#formCitaSeguimientoColas #profesional_seguimiento1').html("");
				$('#formCitaSeguimientoColas #servicio_seguimiento1').html("");
				$('#formCitaSeguimientoColas #tipo_cita_seguimiento1').html("");
				$('#formCitaSeguimientoColas #descripcion_seguimiento1').html("");
			}

			$('#citaSeguimientoColas').modal({
				 show:true,
				 keyboard: false,
				 backdrop:'static'
			});

		}else{
		  swal({
				title: 'Acceso Denegado',
				text: 'No tiene permisos para ejecutar esta acción',
				type: 'error',
				confirmButtonClass: 'btn-danger'
		  });
		}
	});
}

function estadoReceta(receta_id){
  var url = '<?php echo SERVERURL; ?>php/receta/estadoReceta.php';
  var estado;

  $.ajax({
 	 type:'POST',
	 data:'receta_id='+receta_id,
	 async: false,
	 url:url,
		success: function(data){
			estado = data;
		}
   });
   return estado;
}
</script>
