<script>
$(document).ready(function() {
   getServicio();
   getReporte();
   getPatologia();
   getVia();
   getColaborador_usuario();
   pagination_preclinica(1);
});

$(document).ready(function() {
  $('#form_main #servicio').on('change', function(){
	 getColaborador_usuario();
     pagination_preclinica(1);
  });
});

$(document).ready(function() {
  $('#form_main #reporte').on('change', function(){
	 getColaborador_usuario();
     pagination_preclinica(1);
  });
});

$(document).ready(function() {
  $('#form_main #fecha_i').on('change', function(){
     pagination_preclinica(1);
  });
});

$(document).ready(function() {
  $('#form_main #fecha_f').on('change', function(){
     pagination_preclinica(1);
  });
});

$(document).ready(function() {
  $('#form_main #bs-regis').on('keyup', function(){
     pagination_preclinica(1);
  });
});

$(document).ready(function() {
  $('#form_main #colaborador_usuario').on('change', function(){
     pagination_preclinica(1);
  });
});

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/servicios.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #servicio').html("");
			$('#form_main #servicio').html(data);
			$('#form_main #servicio').selectpicker('refresh');
		}
     });
}

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/getReporte.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #reporte').html("");
			$('#form_main #reporte').html(data);
			$('#form_main #reporte').selectpicker('refresh');
        }
     });
}

function pagination_preclinica(partida){
	var servicio = $('#form_main #servicio').val();
	var reporte = $('#form_main #reporte').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs-regis').val();
	var colaborador_usuario = "";

	if($('#form_main #colaborador_usuario').val() == "" || $('#form_main #colaborador_usuario').val() == null){
		colaborador_usuario = "";
	}else{
		colaborador_usuario = $('#form_main #colaborador_usuario').val();
	}

	if(servicio == "" || servicio == null){
		servicio = 1;
	}else{
		servicio = $('#form_main #servicio').val();
	}

	if(reporte == "" || reporte == null){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}

	if(reporte == 1){
		url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/paginar_preclinica.php';
	}else{
        url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/paginar_postclinica.php';
	}

	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&dato='+dato+'&colaborador_usuario='+colaborador_usuario,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function reporteEXCEL(){
  if($('#form_main #servicio').val()!=""){
	var servicio = $('#form_main #servicio').val();
	var reporte = $('#form_main #reporte').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var colaborador_usuario = $('#form_main #colaborador_usuario').val();

	if(colaborador_usuario == "" || colaborador_usuario == null){
		colaborador_usuario = "";
	}else{
		colaborador_usuario = $('#form_main #colaborador_usuario').val();
	}

	if(reporte == ""){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}

	if(reporte == 1){
		url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/reportePreclinica.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&colaborador_usuario='+colaborador_usuario;
	}else{
		url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/reportePostclinica.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&colaborador_usuario='+colaborador_usuario;
	}

	window.open(url);
}else{
	swal({
		title: "Error",
		text: "Debe seleccionar por lo menos una opción de búsqueda",
		type: "error",
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
  }
}

function reporteEXCELDiario(){
  if($('#form_main #servicio').val()!=""){
	var servicio = $('#form_main #servicio').val();
	var reporte = $('#form_main #reporte').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var colaborador_usuario = $('#form_main #colaborador_usuario').val();

	if(colaborador_usuario == "" || colaborador_usuario == null){
		colaborador_usuario = "";
	}else{
		colaborador_usuario = $('#form_main #colaborador_usuario').val();
	}

	if(reporte == ""){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}

	if(reporte == 1){
		url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/reporteDiarioUsuarios.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&colaborador_usuario='+colaborador_usuario;
		window.open(url);
	}else{
		swal({
			title: "Error",
			text: "Este reporte no está disponible para postclínica",
			type: "error",
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	}
}else{
	swal({
		title: "Error",
		text: "Debe seleccionar por lo menos una opción de búsqueda",
		type: "error",
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
  }
}

function limpiar(){
	$('#servicio').html("");
    $('#agrega-registros').html("");
	$('#pagination').html("");
    getServicio();
	getReporte();
    $('#form_main #colaborador_usuario').html("");
	getColaborador_usuario();
	pagination_preclinica(1);
}

function showTratamiento(postclinica_id, expediente){
	var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/getTratamiento.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'postclinica_id='+postclinica_id+'&partida='+1+'&expediente='+expediente,
		success:function(data){
			$('#mensaje_show').modal({
	              show:true,
				  keyboard: false,
	              backdrop:'static'
	        });
        	var array = eval(data);
			$('#showInfo #agrega-registros-show').html(array[0]);
			$('#showInfo #pagination_show').html(array[1]);
		}
	});

}

function modal_eliminarPreclinica(preclinica_id, pacientes_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		var nombre_usuario = consultarNombre(pacientes_id);
		var expediente_usuario = consultarExpediente(pacientes_id);
		var dato;

		if(expediente_usuario == 0){
		   dato = nombre_usuario;
		}else{
			dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
		}

		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar la preclínica de este usuario: " + dato + "?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eliminar la preclínica!",
			closeOnConfirm: false,
			inputPlaceholder: "Comentario",
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(inputValue){
		  if (inputValue === false) return false;
		  if (inputValue === "") {
			swal.showInputError("Necesitas escribir algo");
			return false
		  }
			eliminarPreclinica(preclinica_id,inputValue);
		});
   }else{
		swal({
			title: "Acceso Denegado",
			text: "No tiene permisos para ejecutar esta acción",
			type: "error",
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	}
}

function modal_eliminarPostClinica(postclinica_id, pacientes_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		var nombre_usuario = consultarNombre(pacientes_id);
		var expediente_usuario = consultarExpediente(pacientes_id);
		var dato;

		if(expediente_usuario == 0){
		   dato = nombre_usuario;
		}else{
			dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
		}

		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar la postclinica de este usuario: " + dato + "?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eliminar la postclinica!",
			closeOnConfirm: false,
			inputPlaceholder: "Comentario",
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(inputValue){
		  if (inputValue === false) return false;
		  if (inputValue === "") {
			swal.showInputError("Necesitas escribir algo");
			return false
		  }
			eliminarPostclinica(postclinica_id,inputValue);
		});
   }else{
		swal({
			title: "Acceso Denegado",
			text: "No tiene permisos para ejecutar esta acción",
			type: "error",
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	}
}

function eliminarPreclinica(id, comentario){
  if(getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/eliminarPreclinica.php';

		var fecha = getFechaPreclinica(id);

		var hoy = new Date();
		fecha_actual = convertDate(hoy);

		if(getMes(fecha)==2){
			swal({
				title: "Error",
				text: "No se puede agregar/modificar registros fuera de este periodo",
				type: "error",
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
			return false;
		}else{
		   if ( fecha <= fecha_actual){
			$.ajax({
			  type:'POST',
			  url:url,
			  data:'id='+id+'&comentario='+comentario,
			  success: function(registro){
				 if(registro == 1){
					swal({
						title: "Success",
						text: "Registro Eliminado Correctamente",
						type: "success",
						timer: 3000,
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					pagination_preclinica(1);
				 }else if(registro == 2){
					swal({
						title: "Error",
						text: "Error al Eliminar el Registro",
						type: "error",
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				 }else if(registro == 3){
					swal({
						title: "Error",
						text: "No se puede eliminar este registro, existe información en la atención del usuario (ATA)",
						type: "error",
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				 }else if(registro == 4){
					swal({
						title: "Error",
						text: "No se puede eliminar este registro, Ya se ha realizado las Postclínica, por favor verifique y/o elimine la Postclínica antes de proceder",
						type: "error",
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});

				 }else{
					swal({
						title: "Error",
						text: "No se puede eliminar este registro, por favor intente de nuevo más tarde",
						type: "error",
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				 }

				 return false;
			  }
			});
			}else{
				swal({
					title: "Error",
					text: "No se puede agregar/modificar registros fuera de esta fecha",
					type: "error",
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}
		}
  }else{
	swal({
		title: "Acceso Denegado",
		text: "No tiene permisos para ejecutar esta acción",
		type: "error",
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
  }
}


function eliminarPostclinica(id, comentario){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/eliminarPostclinica.php';

	var fecha = getFechaPostclinica(id);

    var hoy = new Date();
    fecha_actual = convertDate(hoy);

    if(getMes(fecha)==2){
		swal({
			title: "Error",
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error",
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
  }else{
   if ( fecha <= fecha_actual){
	$.ajax({
      type:'POST',
	  url:url,
	  data:'id='+id+'&comentario='+comentario,
	  success: function(registro){
		 if(registro == 1){
				swal({
					title: "Success",
					text: "Registro eliminado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination_preclinica(1);
		 }else if(registro == 3){
			swal({
				title: "Error",
				text: "No se puede eliminar este registro, existe información en la atención del usuario",
				type: "error",
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
			pagination_preclinica(1);
		 }else{
			swal({
				title: "Error",
				text: "Error al Eliminar el Registro",
				type: "error",
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		 }
		 return false;
  	  }
	});
	}else{
		swal({
			title: "Error",
			text: "No se puede agregar/modificar registros fuera de esta fecha",
			type: "error",
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	   return false;
	}
   }
  }else{
	swal({
		title: "Acceso Denegado",
		text: "No tiene permisos para ejecutar esta acción",
		type: "error",
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
  }
}

/*
$('#eliminar_preclinica #Si').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 eliminarPreclinica();
});

$('#eliminar_postclinica #Si').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 eliminarPostclinica();
});*/

function editarPreclinica(preclinica_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	   var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/editarPreclinica.php';

	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'id='+preclinica_id,
		  success: function(valores){
			  var datos = eval(valores);
			  $('#formulario_agregar_preclinica #pro').val('Edicion');
  			  $('#formulario_agregar_preclinica #id-registro').val(preclinica_id);
			  $('#formulario_agregar_preclinica #expediente').val(datos[0]);
			  $('#formulario_agregar_preclinica #fecha').val(datos[1]);
			  $('#formulario_agregar_preclinica #identidad').val(datos[2]);
			  $('#formulario_agregar_preclinica #nombre').val(datos[3]);
			  $('#formulario_agregar_preclinica #pa').val(datos[4]);
			  $('#formulario_agregar_preclinica #fr').val(datos[5]);
			  $('#formulario_agregar_preclinica #fc').val(datos[6]);
			  $('#formulario_agregar_preclinica #temperatura').val(datos[7]);
			  $('#formulario_agregar_preclinica #peso').val(datos[8]);
			  $('#formulario_agregar_preclinica #talla').val(datos[9]);
			  $('#formulario_agregar_preclinica #observaciones').val(datos[10]);

			  $('#reg_preclinica').hide();
			  $('#reg_preclinica_edicion').hide();
			  $('#edit_preclinica').show();

			  $('#agregar_preclinica').modal({
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
			title: "Acceso Denegado",
			text: "No tiene permisos para ejecutar esta acción",
			type: "error",
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
   }
}

function editarPostclinica(postclinica_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	   var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/editarPostclinica.php';

	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'id='+postclinica_id,
		  success: function(valores){
			  var datos = eval(valores);
			  $('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');
			  $('#formulario_agregar_postclinica #pro').val('Edicion');
  			  $('#formulario_agregar_postclinica #id-registro').val(postclinica_id);
  			  $('#formulario_agregar_postclinica #expediente').val(datos[0]);
  			  $('#formulario_agregar_postclinica #fecha').val(datos[1]);
  			  $('#formulario_agregar_postclinica #identidad').val(datos[2]);
  			  $('#formulario_agregar_postclinica #nombre').val(datos[3]);
  			  $('#formulario_agregar_postclinica #patologia1').val(datos[4]);
  			  $('#formulario_agregar_postclinica #fecha_siguiente').val(datos[5]);
  			  $('#formulario_agregar_postclinica #hora').val(datos[6]);
  			  $('#formulario_agregar_postclinica #observacion').val(datos[7]);
  			  $('#formulario_agregar_postclinica #procedimiento').val(datos[8]);
              editarPostclinicaDetalle(postclinica_id);

			  $('#reg_postclinica').hide();
			  $('#reg_postclinica_edicion').hide();
			  $('#edit_posclinica').show();

			  $('#agregar_postclinica').modal({
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
		title: "Acceso Denegado",
		text: "No tiene permisos para ejecutar esta acción",
		type: "error",
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
   }
}

function getPatologia(){
  var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
			$('#formulario_agregar_postclinica #patologia1').html("");
			$('#formulario_agregar_postclinica #patologia1').html(data);
			$('#formulario_agregar_postclinica #patologia1').selectpicker('refresh');
		}
   });
   return false;
}

function editarPostclinicaDetalle(postclinica_id){
	var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/editarPostclinicaDetalle.php';

	$.ajax({
	   type:'POST',
	   url:url,
	   data:'id='+postclinica_id,
	   success: function(valores){
		   var datos = eval(valores);

		   var x = 1;
           for(i=0;i<datos.length;i++){ //Recorrer el arreglo jason que viene desde php
			 $('#formulario_agregar_postclinica #medicamento' + x).val(datos[i]['medicamento']);
			 $('#formulario_agregar_postclinica #dosis' + x).val(datos[i]['dosis']);
			 $('#formulario_agregar_postclinica #via' + x).val(datos[i]['via']);
			 $('#formulario_agregar_postclinica #frecuencia' + x).val(datos[i]['frecuencia']);
			 $('#formulario_agregar_postclinica #recomendaciones' + x).val(datos[i]['recomendaciones']);
			 $('#formulario_agregar_postclinica #registro' + x).val(datos[i]['id']);
             x++;
           }
		}
	 });
	 return false;
}

$('#edit_preclinica').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 modificarPreclinica();
});

$('#formulario_agregar_postclinica #reg').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 modificarPostclinica();
});

function modificarPreclinica(){
	var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/modificarPreclinica.php';

	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_preclinica').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_preclinica')[0].reset();
				$('#formulario_agregar_preclinica #pro').val('Registro');
				swal({
					title: "Success",
					text: "Registro modificado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination_preclinica(1);
				return false;
			}else{
				swal({
					title: "Error",
					text: "Error al completar el registro",
					type: "error",
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}
		  }
	   });
  }

function modificarPostclinica(){
	var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/modificarPostclinica.php';

	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_postclinica').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_postclinica')[0].reset();
				$('#formulario_agregar_postclinica #pro').val('Registro');
				swal({
					title: "Success",
					text: "Registro modificado con éxito",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination_preclinica(1);
				return false;
			}else{
				swal({
					title: "Error",
					text: "Error al completar el registro",
					type: "error",
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   return false;
			}
		  }
	   });
  }

$('#form_main #exportar').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	 e.preventDefault();
	 reporteEXCEL();
 }else{
	swal({
		title: "Acceso Denegado",
		text: "No tiene permisos para ejecutar esta acción",
		type: "error",
		confirmButtonClass: 'btn-danger'
	});
 }
});

$('#form_main #reporte_diario').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	 e.preventDefault();
	 reporteEXCELDiario();
 }else{
	swal({
		title: "Acceso Denegado",
		text: "No tiene permisos para ejecutar esta acción",
		type: "error",
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
 }
});

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function getMes(fecha){
    var url = '<?php echo SERVERURL; ?>php/atas/getMes.php';
	var resp;

	$.ajax({
	    type:'POST',
		data:'fecha='+fecha,
		url:url,
		async: false,
		success:function(data){
          resp = data;
		}
	});
	return resp	;
}

function getFechaPreclinica(preclinica_id){
    var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/getFechaPreclinica.php';
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'preclinica_id='+preclinica_id,
		async: false,
		success:function(data){
          fecha = data;
		}
	});
	return fecha;
}

function getFechaPostclinica(postclinica_id){
    var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/getFechaPostclinica.php';
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'postclinica_id='+postclinica_id,
		async: false,
		success:function(data){
          fecha = data;
		}
	});
	return fecha;
}

function getColaborador_usuario(){
    var url = '<?php echo SERVERURL; ?>php/reportes_enfermeria/getColaborador_usuario.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		     $('#form_main #colaborador_usuario').html("");
			 $('#form_main #colaborador_usuario').html(data);
			 $('#form_main #colaborador_usuario').selectpicker('refresh');
		}
     });
}

function consultarNombre(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getNombre.php';
	var resp;

	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){
          resp = data;
		}
	});
	return resp;
}

function consultarExpediente(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getExpedienteInformacion.php';
	var resp;

	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){
          resp = data;
		}
	});
	return resp;
}

function getVia(){
    var url = '<?php echo SERVERURL; ?>php/atas/getVia.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_postclinica #via1').html("");
			$('#formulario_agregar_postclinica #via1').html(data);
			$('#formulario_agregar_postclinica #via1').selectpicker('refresh');

		    $('#formulario_agregar_postclinica #via2').html("");
			$('#formulario_agregar_postclinica #via2').html(data);
			$('#formulario_agregar_postclinica #via2').selectpicker('refresh');

		    $('#formulario_agregar_postclinica #via3').html("");
			$('#formulario_agregar_postclinica #via3').html(data);
			$('#formulario_agregar_postclinica #via3').selectpicker('refresh');

		    $('#formulario_agregar_postclinica #via4').html("");
			$('#formulario_agregar_postclinica #via4').html(data);
			$('#formulario_agregar_postclinica #via4').selectpicker('refresh');

		    $('#formulario_agregar_postclinica #via5').html("");
			$('#formulario_agregar_postclinica #via5').html(data);
			$('#formulario_agregar_postclinica #via5').selectpicker('refresh');
		}
     });
}

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});
</script>
