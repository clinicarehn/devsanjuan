<script>
$(document).ready(function(){
	evaluarRegistrosPendientes();
	//evaluarRegistrosPendientesEmail(); //AL INGRESAR AL SISTEMA ENVIARA UN CORREO CON LA CANTIDAD DE REGISTROS PENDIENTES

	$('#label_acciones_volver').html("ATA");
	$('#label_acciones_receta').html("");
	listar_busqueda_productos();
});

$(document).ready(pagination(1))
  $(function(){
	  funciones();

	  //FUNCONES FORMULARIO SEGUIMIENTO TELEFONICO USUARIOS NUEVOS
	  /**********************************************************************/
	  getDepartamento();
	  getAtencionSeguimiento();
	  /**********************************************************************/

	  //INICIO BOTON AGREGAR
	  //ATA Usuarios
	  $('#nuevo-registro').on('click',function(){
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		   /*if(getPuestoId() == 2 || getPuestoId() == 4){
				swal({
					title: "Error",
					text: "No puede agregar usuarios haciendo uso de esta opción, antes deben pasar por el área de preclínica",
					type: "error",
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
     	   }else{*/
		      $('#formulario1')[0].reset();
			  cleanForms1();
			  $("#formulario1 #grupo_localidades").hide();
              $("#formulario1 #motivo").attr('readonly', true);
              $("#formulario1 #motivo_e").attr('readonly', true);
              $("#formulario1 #centroi_e").attr('readonly', true);
              $("#formulario1 #diagnostico_clinico").attr('readonly', true);
		      $("#formulario1 #clinico").attr('readonly', true);
              $("#formulario1 #transito_motivo_recibida").attr('readonly', true);
              $("#formulario1 #transito_motivo_enviada").attr('readonly', true);
		      $("#formulario1 #reg").attr('disabled', true);
		      $('#formulario1 #expediente').focus();
		      $("#grupo_atas_localidades").hide();
		      $('#formulario1 #fecha').val($('#fecha_b').val());
     	      $('#formulario1 #pro').val('Registro');
		      $('#formulario1 #edi').hide();
		      $('#formulario1 #reg').show();
              $('#formulario1 #ihss').val(2);
			  $('#formulario1 #referencia_label').html('');
              $('#formulario1 #label_referenciasi').html('');
              $('#formulario1 #label_referenciano').html('');
			  $('#formulario1 #referenciasi').hide();
              $('#formulario1 #referenciano').hide();
              $('#formulario1 #suicida_label').html("¿Conducta Suicida?");
              $('#formulario1 #label_suicida_si').html('Sí');
              $('#formulario1 #label_suicida_no').html('No');
			  $('#formulario1 #suicida_si').show();
              $('#formulario1 #suicida_no').show();
			  $('#formulario1 #otros_programar_cita').hide();
			  $('#formulario1 #label_cronico_si').html('Sí');
              $('#formulario1 #label_cronico_no').html('No');

		  	  //SI EL PUESTO ES DE TRABAJO SOCIAL
			  if(getPuesto() == 11){
				 $('#formulario1 #trabajo_social').show();
			  }else{
				 $('#formulario1 #trabajo_social').hide();
			  }

			if ((getTipoUsuario($('#formulario1 #expediente').val()), $('#formulario1 #servicio').val()) == 'N' && $('#formulario1 #servicio').val() != 7){
				swal({
					title: 'Advertencia',
					text: 'Este es un usuario nuevo, tiene referencia, por favor llenarla antes de guardar el registro',
					type: 'warning',
					confirmButtonClass: 'btn-warning',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$("#formulario1 #edi").attr('disabled', true);
				$('#formulario1 #referenciasi1').prop('checked', true); //DESELECCIONA UN CHECK BOX

			}else if (getTipoUsuario(getExpediente($('#formulario1 #expediente').val()), $('#formulario1 #servicio').val()) == 'S'){
				$("#formulario1 #edi").attr('disabled', false);

			}else{
				$("#formulario1 #edi").attr('disabled', false);
			}

			if(getEdadUsuarioFormulario($('#formulario1 #servicio').val(),getPacientesID(expediente))==1){
				swal({
					title: 'Error',
					text: 'Este usuario esta próximo a cumplir 18 años, recuerde que ya es tiempo que lo transfiera a Consulta Externa',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}

			if(getPuesto() == 2 || getPuesto() == 4 || getPuesto() == 1){
			   //REFERENCIAS
			   $('#formulario1 #referencia_label').html("¿Referencia?");
			   $('#formulario1 #referencia_label').show();
			   $('#formulario1 #referenciasi').show();
			   $('#formulario1 #referenciano').show();
			   $('#formulario1 #label_referenciasi').show();
			   $('#formulario1 #label_referenciano').show();
			   $('#formulario1 #label_referenciasi').html('Sí');
			   $('#formulario1 #label_referenciano').html('No');
			}else{
			   $('#formulario1 #referencia_label').html('');
			   $('#formularioformulario1_atas #referencia_label').hide();
			   $('#formulario1 #referenciasi').hide();
			   $('#formulario1 #referenciano').hide();
			   $('#formulario1 #label_referenciasi').hide();
			   $('#formulario1 #label_referenciano').hide();
			   $('#formulario1 #label_referenciasi').html('');
			   $('#formulario1 #label_referenciano').html('');
			}

			if(getPuesto() == 2 || getPuesto() == 10){
			   //USUARIO CRONICO
			   $('#formulario1 #cronico_label').html("¿Crónico?");
			   $('#formulario1 #cronico_label').show();
			   $('#formulario1 #cronico_si').show();
			   $('#formulario1 #cronico_no').show();
			   $('#formulario1 #label_cronico_si').show();
			   $('#formulario1 #label_cronico_no').show();
			}else{
			   $('#formulario1 #cronico_label').hide();
			   $('#formulario1 #cronico_si').hide();
			   $('#formulario1 #cronico_no').hide();
			   $('#formulario1 #label_cronico_si').hide();
			   $('#formulario1 #label_cronico_no').hide();
			}

		      $('#registrar').modal({
			     show:true,
				 keyboard: false,
			     backdrop:'static'
		      });
           //}
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


      //ATA MANUAL
	  $('#form_main #nuevo_ata_manual').on('click',function(){
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	         $('#registrar_ata_manual').modal({
	            show:true,
				keyboard: false,
                backdrop:'static'
             });
			 $('#formulario_ata_manual #primera_si').prop('checked', false); //DESELECCIONA UN CHECK BOX
			 $('#formulario_ata_manual #primera_no').prop('checked', true); //DESELECCIONA UN CHECK BOX
	         $('#formulario_ata_manual')[0].reset();
			 limpiarATA_Manual();
			 $('#formulario_ata_manual #reg_ata_manual').attr('disabled', true);
		}else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
         }
	  });

	  //ATA SEGUIMIENTO USUARIOS NUEVOS
	  $('#form_main #nuevo_seguimiento').on('click',function(){
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	         $('#modal_seguimiento').modal({
	            show:true,
				keyboard: false,
                backdrop:'static'
             });
	         $('#formulario_seguimiento')[0].reset();
			 cleanSeguimiento();

			//HABILITAR VALORES DE SOLO LECTURA
			$('#formulario_seguimiento #identidad').attr('readonly', false);
			$('#formulario_seguimiento #nombres').attr('readonly', false);
			$('#formulario_seguimiento #apellidos').attr('readonly', false);
			$('#formulario_seguimiento #fecha').attr('readonly', false);
			$('#formulario_seguimiento #fecha_n').attr('readonly', false);
			$('#formulario_seguimiento #telefono').attr('readonly', false);
			$('#formulario_seguimiento #localidad').attr('readonly', false);
			//DESHABILITAR
			$("#formulario_seguimiento #departamento").attr('readonly', false);
		    $("#formulario_seguimiento #municipio").attr('readonly', false);

		}else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
         }
	  });

      //Atenciones a Familiares
	  $('#form_main #ata_familiares').on('click',function(){
           if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	           $('#agregar_atenciones_familiares').modal({
	              show:true,
				  keyboard: false,
                  backdrop:'static'
                });
	            $('#formulario_atenciones_familiares')[0].reset();
	            limpiarAtencionesFamiliares();
	            $('#formulario_atenciones_familiares #pro').val("Registro");
	            $("#reg_atenciones_familiares").attr('disabled', true);
          }else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
         }
	  });

      //Cuestionario Familiares MAIDA
	  $('#form_main #cuestionario').on('click',function(){
         if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	         $('#agregar_cuestionario_maida').modal({
	            show:true,
				keyboard: false,
                backdrop:'static'
             });
	         $('#formulario_cuestionario_maida')[0].reset();
	         limpiarCuestionario();
	         $('#formulario_cuestionario_maida #cuestionario_maida_p1_label').html('1. ¿Ha consumido Alcohol despues de su egreso?');
	         $('#formulario_cuestionario_maida #label_maida_p1_si').html('Sí');
	         $('#formulario_cuestionario_maida #label_maida_p1_no').html('No');
	         $('#formulario_cuestionario_maida #label_maida_p1_si').show();
	         $('#formulario_cuestionario_maida #label_maida_p1_no').show();

	         $('#formulario_cuestionario_maida #cuestionario_maida_p2_label').html('2. ¿Cuantas veces a recaido en el consumo del Alcohol desde su egreso?');
	         $('#formulario_cuestionario_maida #label_maida_p2_1').html('Una Vez');
	         $('#formulario_cuestionario_maida #label_maida_p2_2').html('Dos a tres veces');
	         $('#formulario_cuestionario_maida #label_maida_p2_3').html('Mas de tres veces');
	         $('#formulario_cuestionario_maida #label_maida_p2_4').html('Ninguna');
	         $('#formulario_cuestionario_maida #maida_p2_1').show();
	         $('#formulario_cuestionario_maida #maida_p2_2').show();
	         $('#formulario_cuestionario_maida #maida_p2_3').show();
	         $('#formulario_cuestionario_maida #maida_p2_4').show();


	         $('#formulario_cuestionario_maida #cuestionario_maida_p3_label').html('3. ¿Cuanto tiempo ha logrado estar sin consumir despuúes de su egreso?');
	         $('#formulario_cuestionario_maida #label_maida_p3_1').html('Menos de un mes');
	         $('#formulario_cuestionario_maida #label_maida_p3_2').html('1 a 3 meses');
	         $('#formulario_cuestionario_maida #label_maida_p3_3').html('3 a 6 meses');
	         $('#formulario_cuestionario_maida #label_maida_p3_4').html('Mayor de 6 meses');
	         $('#formulario_cuestionario_maida #maida_p3_1').show();
	         $('#formulario_cuestionario_maida #maida_p3_2').show();
	         $('#formulario_cuestionario_maida #maida_p3_3').show();
	         $('#formulario_cuestionario_maida #maida_p3_4').show();

	         $('#formulario_cuestionario_maida #cuestionario_maida_p4_label').html('4. ¿Asiste a grupos de apoyo?');
	         $('#formulario_cuestionario_maida #label_maida_p4_1').html('Alcohólicos Anonimos');
	         $('#formulario_cuestionario_maida #label_maida_p4_2').html('Iglesia');
	         $('#formulario_cuestionario_maida #label_maida_p4_3').html('Otros');
			 $('#formulario_cuestionario_maida #label_maida_p4_4').html('Ninguno');
	         $('#formulario_cuestionario_maida #maida_p4_1').show();
	         $('#formulario_cuestionario_maida #maida_p4_2').show();
	         $('#formulario_cuestionario_maida #maida_p4_3').show();
			 $('#formulario_cuestionario_maida #maida_p4_4').show();

	         $('#formulario_cuestionario_maida #cuestionario_maida_p5_label').html('5. ¿Presencia de patología dual?');
	         $('#formulario_cuestionario_maida #label_maida_p5_si').html('Sí');
	         $('#formulario_cuestionario_maida #label_maida_p5_no').html('No');
	         $('#formulario_cuestionario_maida #label_maida_p5_si').show();
	         $('#formulario_cuestionario_maida #label_maida_p5_no').show();


	         $('#formulario_cuestionario_maida #cuestionario_maida_p6_label').html('6. ¿Consumo de otras drogas?');
	         $('#formulario_cuestionario_maida #label_maida_p6_si').html('Sí');
	         $('#formulario_cuestionario_maida #label_maida_p6_no').html('No');
	         $('#formulario_cuestionario_maida #label_maida_p6_si').show();
	         $('#formulario_cuestionario_maida #label_maida_p6_no').show();

	         getPatologia1();
	         $("#reg_cuestionario").attr('disabled', true);
        }else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
        }
	  });


	  //INICIO MODAL ENTREVISTA
	  $('#form_main #entrevista').on('click',function(){
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
			 $('#formulario_entrevista_trabajo_social .nav-tabs li:eq(0) a').tab('show');
			 $('#formulario_entrevista_trabajo_social').attr({ 'data-form': 'save' });
			 $('#formulario_entrevista_trabajo_social').attr({ 'action': '<?php echo SERVERURL; ?>php/atas/agregarEntrevistaTS.php' });
	         $('#modal_entrevista_trabajo_social').modal({
	            show:true,
				keyboard: false,
                backdrop:'static'
             });
			 $('#formulario_entrevista_trabajo_social .nav-tabs li:eq(0) a').tab('show');
	         $('#formulario_entrevista_trabajo_social')[0].reset();
			 $('#formulario_entrevista_trabajo_social #pro_entrevista').val("Registro");
			 $('#formulario_entrevista_trabajo_social #grupo_servicio').show();
			 $('#reg_entrevista').show();
			 $('#edi_entrevista').hide();
			 $('#delete_entrevista').hide();
			 $('#formulario_entrevista_trabajo_social #expediente').attr('readonly', false);
		}else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
         }
	  });
     //FIN BOTON AGREGAR

	  //INICIO BOTON REFERENCIAS
	  //Referencia Enviada
	  $('#form_main #ref_enviadas').on('click',function(){
          if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	          $('#agregar_referencias_enviadas').modal({
	             show:true,
				 keyboard: false,
                 backdrop:'static'
              });
	          limpiarReferenciasEnviadas()
	          $('#formulario_agregar_referencias_enviadas')[0].reset();
	          $('#formulario_agregar_referencias_enviadas #pro').val("Registro");
	          $("#formulario_agregar_referencias_enviadas #reg").attr('disabled', true);
           }else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
          }
	  });

      //Referencia Recibida
	  $('#form_main #ref_recibidas').on('click',function(){
          if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	          $('#agregar_referencias_recibidas').modal({
	              show:true,
				  keyboard: false,
                  backdrop:'static'
              });
	          limpiarReferenciasRecibidas();
	          $('#formulario_agregar_referencias_recibidas')[0].reset();
	          $("#formulario_agregar_referencias_recibidas #reg").attr('disabled', true);
	          $('#formulario_agregar_referencias_recibidas #pro').val("Registro");
          }else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
          }
	  });
	  //FIN BOTON REFERENCIAS

	  //INICIO BOTON TRANSITO
	  //Transito ENVIADA
	  $('#form_main #transito_enviada').on('click',function(){
           if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	            limpiarTransitoEnviadas();
	            $('#registrar_transito_enviada').modal({
	                show:true,
					keyboard: false,
                    backdrop:'static'
                });
	            $('#formulario_transito_enviada')[0].reset();
	            $('#formulario_transito_enviada #pro').val("Registro");
	            $("#formular io_transito_enviada #reg").attr('disabled', true);
            }else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
            }
	  });

	  //Transito RECIBIDA
	  $('#form_main #transito_recibida').on('click',function(){
           if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
                limpiarTransitoRecibidas();
	            $('#registrar_transito_recibida').modal({
	               show:true,
				   keyboard: false,
                   backdrop:'static'
                });
	            $('#formulario_transito_recibida')[0].reset();
	            $('#formulario_transito_recibida #pro').val("Registro");
	            $("#reg_transito_recibida").attr('disabled', true);
            }else{
			  swal({
					title: 'Acceso Denegado',
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
            }
	  });
	  //FIN BOTON TRANSITO

	   $('#form_main #bs-regis').on('keyup',function(){
		  pagination(1);
       });

      $('#form_main #fecha_b').on('change',function(){
		  pagination(1);
      });

      $('#form_main #fecha_f').on('change',function(){
		  pagination(1);
      });

	  $('#form_main #estado').on('change',function(){
		  pagination(1);
      });

      //EVALUAMOS EL USUARIO QUE NO SEA DE TRABAJO SOCIAL
	  if(getPuestoId() == 2 || getPuestoId() == 4 || getPuestoId() == 1){
		  $("#formulario1 #trabajo_social").hide();
		  $("#formulario_atas #trabajo_social1").hide();
	  }else{
		  $("#formulario1 #trabajo_social").show();
		  $("#formulario_atas #trabajo_social1").show();
	  }
});

$('#reg_ata_form1').on('click', function(e){
	 e.preventDefault();
	 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		if( (getPuestoId() == 2 || getPuestoId() == 1) && $('#formulario1 #servicio').val() == 12){
			if($('#formulario1 #programar_cita').val() == "" || $('#formulario1 #programar_cita').val() == null){
				  swal({
						title: "Error",
						text: "La opción de programar cita no puede quedar en blanco, por favor corregir",
						type: "error",
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
				  });
				  $('#formulario1 #programar_cita').focus();
			}else{
				agregaRegistro();
			}
		}else if(getPuestoId() == 11){
			agregaRegistro();
		}else if(getPuestoId() == 10){
			agregaRegistro();
		}else{
			  swal({
					title: 'Error',
					text: 'Lo sentimos, por ahora no se puede agregar información para este servicio, por favor corregir.',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
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
		  return false;
	}
});

$('#edi_ata_por_usuario').on('click', function(e){
	 e.preventDefault();
	 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		if(getPuestoId() == 2 || getPuestoId() == 1){
			if($('#formulario_atas #programar_cita_1').val() == "" || $('#formulario_atas #programar_cita_1').val() == null){
				  swal({
						title: "Error",
						text: "La opción de programar cita no puede quedar en blanco, por favor corregir",
						type: "error",
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
				  });
				  $('#formulario_atas #programar_cita_1').focus();
			}else{
				agregaRegistroPorUsuario();
			}
		}else if(getPuestoId() == 11){
			agregaRegistroPorUsuario();
		}else if(getPuestoId() == 10){
			agregaRegistroPorUsuario();
		}else{
			  swal({
					title: 'Error',
					text: 'Lo sentimos, por ahora no se puede agregar información para este servicio, por favor corregir.',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
			  return false;
		}
	 }
});

function funciones(){
	  limpiarPatologia1();
	  limpiarPatologia2();
	  getRespuestaFormulario();
	  getEnfermedadad();
	  getTipoAtención();
	  getNivelSocioeconomico();
	  getProblemaSocial();
	  getMotivoTraslado();
	  getMotivoTrasladoOtro();
	  getServicio();
	  getServicioRecetaATA();
	  getVia(0);
	  getMedicamentos();
	  getGenero();
	  getResponsable();
	  getServicioATA_Manual();
	  getEstado();
	  getProgramarCita();
	  getSexo();
}

function cleanForms1(){
	limpiarPatologia1();
	$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
    getServicio();
	getServicioRecetaATA();
	getServicioTransito();
    getEnfermedadad();
	getTipoAtención();
	getNivelSocioeconomico();
	getProblemaSocial();
    patologiaCIE10_1();
	patologiaCIE10_2();
    patologiaCIE10_3();
	getMotivoTraslado();
    getMotivoTrasladoOtro();
	getProgramarCita();
    $('#formulario1 #grupo_cantidades_tipo_atencion').hide();
	//REFERENCIAS RECIBIDAS
	getNivel();
	$('#formulario1 #clinico').val("");
	$('#formulario1 #motivo').val("");
	//REFERENCIAS ENVIADAS
	getNivel_e();
	$('#formulario1 #diagnostico_clinico').val("");
	$('#formulario1 #motivo_e').val("");
}

function limpiarPatologiaformulario_atas(){
	getPatologia_1();
    getPatologia_2();
    getPatologia_3();
}

function cleanForms2(){
	$('#formulario_atas .nav-tabs li:eq(0) a').tab('show');
	getServicioTransito();
    getEnfermedadad();
	getTipoAtención();
	getNivelSocioeconomico();
	getProblemaSocial();
    getMotivoTraslado();
	getMotivoTrasladoOtro();
	getProgramarCita();
    $('#formulario_atas #grupo_cantidades_tipo_atencion1').hide();
	//REFERENCIAS RECIBIDAS
	getNivel1();
	$('#formulario_atas #motivo1').val("");
	//REFERENCIAS ENVIADAS
	getNivel_e1();
	$('#formulario_atas #motivo_e1').val("");
	$("#edi_ata_por_usuario").attr('disabled', true);
}

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#modal_productos").on('shown.bs.modal', function(){
        $(this).find('#formulario_busqueda_productos #buscar').focus();
    });
});

$(document).ready(function(){
    $("#buscarHistorial").on('shown.bs.modal', function(){
        $(this).find('#form-buscarhistorial #bs-regis-historial').focus();
    });
});

$(document).ready(function(){
    $("#registrar_ata_manual").on('shown.bs.modal', function(){
        $(this).find('#formulario_ata_manual #expediente_ata').focus();
    });
});

$(document).ready(function(){
    $("#agregar_referencias_recibidas").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_referencias_recibidas #expediente').focus();
    });
});

$(document).ready(function(){
    $("#agregar_referencias_enviadas").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_referencias_enviadas #expediente').focus();
    });
});

$(document).ready(function(){
    $("#registrar_transito_enviada").on('shown.bs.modal', function(){
        $(this).find('#formulario_transito_enviada #expediente').focus();
    });
});

$(document).ready(function(){
    $("#registrar_transito_recibida").on('shown.bs.modal', function(){
        $(this).find('#formulario_transito_recibida #expediente').focus();
    });
});

$(document).ready(function(){
    $("#registrar").on('shown.bs.modal', function(){
        $(this).find('#formulario1 #expediente').focus();
    });
});

$(document).ready(function(){
    $("#registrar1").on('shown.bs.modal', function(){
        $(this).find('#formulario_atas #expediente').focus();
    });
});

$(document).ready(function(){
    $("#agregar_atenciones_familiares").on('shown.bs.modal', function(){
        $(this).find('#formulario_atenciones_familiares #expediente').focus();
    });
});

$(document).ready(function(){
    $("#agregar_cuestionario_maida").on('shown.bs.modal', function(){
        $(this).find('#formulario_cuestionario_maida #expediente').focus();
    });
});

$(document).ready(function(){
    $("#eliminar").on('shown.bs.modal', function(){
        $(this).find('#form_ausencia #motivo_ausencia').focus();
    });
});

$(document).ready(function(){
    $("#modal_seguimiento").on('shown.bs.modal', function(){
        $(this).find('#formulario_seguimiento #identidad').focus();
    });
});

$(document).ready(function(){
    $("#modal_entrevista_trabajo_social").on('shown.bs.modal', function(){
        $(this).find('#formulario_entrevista_trabajo_social #expediente').focus();
    });
});

$(document).ready(function(){
    $("#modal_acceso").on('shown.bs.modal', function(){
        $(this).find('#formulario_acceso #pass1').focus();
    });
});

$(document).ready(function(){
    $("#modalPatologia").on('shown.bs.modal', function(){
        $(this).find('#formularioBusquedaPatologia #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modalBusquedaUnidad").on('shown.bs.modal', function(){
        $(this).find('#formularioBusquedaUnidad #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modal_busqueda_servicios").on('shown.bs.modal', function(){
        $(this).find('#formulario_busqueda_servicios #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modalCentroReferencia").on('shown.bs.modal', function(){
        $(this).find('#formularioBusquedaCentroReferencia #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modalBusquedaProfesionales").on('shown.bs.modal', function(){
        $(this).find('#formularioBusquedaProfesionales #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modalSolicitadoPorTS").on('shown.bs.modal', function(){
        $(this).find('#formularioSolicitadoPorTS #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modalClasificacionTS").on('shown.bs.modal', function(){
        $(this).find('#formularioClasificacionTS #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modalTipologiaTS").on('shown.bs.modal', function(){
        $(this).find('#formularioTipologiaTS #buscar').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

$('#formulario1 #clean').on('click', function(e){
	e.preventDefault();
	getNivel();
	$('#formulario1 #motivo').val("");
	$("#formulario1 #centro").attr('readonly', true);
	$("#formulario1 #motivo").attr('readonly', true);
    getNivel_e();
	$('#formulario1 #centroi_e').val("");
	$('#formulario1 #motivo_e').val("");
	$('#formulario1 #diagnostico_clinico').val("");
	$("#formulario1 #centro_e").attr('readonly', true);
	$("#formulario1 #centroi_e").attr('readonly', true);
	$("#formulario1 #motivo_e").attr('readonly', true);
	$("#formulario1 #diagnostico_clinico").attr('readonly', true);
	$("#formulario1 #clinico").attr('readonly', true);
	$('#formulario1 #clinico').val("");
	$("#formulario1 #transito_motivo_recibida").attr('readonly', true);
	$("#formulario1 #transito_motivo_enviada").attr('readonly', true);
	$("#formulario1 #transito_motivo_enviada").attr('readonly', true);
	$('#formulario1 #transito_motivo_recibida').val("");
	$('#formulario1 #transito_motivo_enviada').val("");
	$("#formulario1 #reg").attr('disabled', true);
	getServicio();
	getServicioTransito();
	getServicioTransitoRecibida();
	getServicioTransitoEnviada();
    patologiaCIE10_1();
	patologiaCIE10_2();
    patologiaCIE10_3();
	getEnfermedadad();
	getTipoAtención();
	getNivelSocioeconomico();
	getProblemaSocial();
	getMotivoTraslado();
	getMotivoTrasladoOtro();
	$("#formulario1 #reg").attr('disabled', false);
	getRespuestaFormulario();
	$('#formulario1 #referenciasi').prop('checked', false); //DESELECCIONA UN CHECK BOX
	$('#formulario1 #referenciano').prop('checked', false); //DESELECCIONA UN CHECK BOX
});

$('#clean1_ata_por_usuario').on('click', function(e){
	e.preventDefault();
	getNivel1();
	$('#formulario_atas #motivo1').val("");
	$("#formulario_atas #centro1").attr('readonly', true);
	$("#formulario_atas #motivo1").attr('readonly', true);
    getNivel_e1();
	$('#formulario_atas #motivo_e1').val("");
	$('#formulario_atas #diagnostico_clinico1').val("");
	$("#formulario_atas #centro_e1").attr('readonly', true);
	$("#formulario_atas #motivo_e1").attr('readonly', true);
	$("#formulario_atas #clinico1").attr('readonly', true);
	$('#formulario_atas #clinico1').val("");
	$("#formulario_atas #diagnostico_clinico1").attr('readonly', true);
	$("#formulario_atas #transito_motivo_recibida1").attr('readonly', true);
	$("#formulario_atas #transito_motivo_enviada1").attr('readonly', true);
	$("#formulario_atas #transito_motivo_enviada1").attr('readonly', true);
	$('#formulario_atas #transito_motivo_recibida1').val("");
	$('#formulario_atas #transito_motivo_enviada1').val("");
	$("#edi_ata_por_usuario").attr('disabled', true);
	getServicioTransitoRecibida1();
	getServicioTransitoEnviada1();
	getServicioformATA();
	patologiaCIE10_1_1();
	patologiaCIE10_2_1();
	patologiaCIE10_3_1();
    getMotivoTraslado();
    getMotivoTrasladoOtro()
	getEnfermedadad();
	getTipoAtención();
	getNivelSocioeconomico();
	getProblemaSocial();
	$("#edi_ata_por_usuario").attr('disabled', false);
	getRespuestaFormulario();

	$('#formulario_atas #referenciasi1').prop('checked', false); //DESELECCIONA UN CHECK BOX
	$('#formulario_atas #referenciano1').prop('checked', false); //DESELECCIONA UN CHECK BOX

	if (getTipoUsuario($('#formulario_atas #user1').val(), getServicioEdit($('#formulario_atas #agenda_id').val())) == 'N' && getServicioEdit($('#formulario_atas #agenda_id').val()) != 7){
		swal({
			title: 'Advertencia',
			text: 'Este es un usuario nuevo, tiene referencia, por favor llenarla antes de guardar el registro',
			type: 'warning',
			confirmButtonClass: 'btn-warning',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		$("#edi_ata_por_usuario").attr('disabled', true);
		$('#formulario_atas #referenciasi1').prop('checked', true); //DESELECCIONA UN CHECK BOX
	}else if (getTipoUsuario(exp, getServicioEdit(agenda_id)) == 'S'){
		$("#edi_ata_por_usuario").attr('disabled', false);
		$('#formulario_atas #referenciasi1').prop('checked', false); //DESELECCIONA UN CHECK BOX
		$('#formulario_atas #referenciano1').prop('checked', false); //DESELECCIONA UN CHECK BOX
	}else{
		$("#edi_ata_por_usuario").attr('disabled', false);
		$('#formulario_atas #referenciasi1').prop('checked', false); //DESELECCIONA UN CHECK BOX
		$('#formulario_atas #referenciano1').prop('checked', false); //DESELECCIONA UN CHECK BOX
	}
});

$('#historial').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	e.preventDefault();
	 $('#form-buscarhistorial')[0].reset();
     pagination_busqueda_historial(1);
	 $('#buscarHistorial').modal({
	     show:true,
		 keyboard: false,
	     backdrop:'static'
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
	  return false;
}
});

$('#form_ausencia #Si').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	e.preventDefault();
	if($('#form_ausencia #motivo_ausencia').val() != ""){
		eliminarRegistro();
	}else{
		swal({
			title: "Error",
			text: "El comentario no puede quedar en blanco",
			type: "error",
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
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

$(document).ready(function() {
	$('#form-buscarhistorial #bs-regis-historial').on('keyup',function(){
	    pagination_busqueda_historial(1);
   	    return false;
    });
});

function pagination_busqueda_historial(partida){
	var url = '<?php echo SERVERURL; ?>php/atas/buscar_historial.php';
    var dato = $('#form-buscarhistorial #bs-regis-historial').val();

	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&dato='+dato,
		success:function(data){
			var array = eval(data);
			$('#form-buscarhistorial #agrega-registros_historial').html(array[0]);
			$('#form-buscarhistorial #pagination_historial').html(array[1]);
		}
	});
	return false;
}

function agregaSeguimiento(){
	var url = '<?php echo SERVERURL; ?>php/atas/agregarSeguimiento.php';
	var hoy = new Date();
    fecha_actual = convertDate(hoy);

	if ($('#formulario_seguimiento #fecha_n').val() == fecha_actual || $('#formulario_seguimiento #fecha_n').val() > fecha_actual){
		swal({
			title: "Error",
			text: "Debe seleccionar una fecha de nacimiento válida",
			type: "error",
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		$('#formulario_seguimiento #fecha').focus();
		return false;
	}else{
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formulario_seguimiento').serialize(),
			success: function(registro){
				if(registro == 1){
					swal({
						title: 'Almacenado',
						text: 'Registro almacenado correctamente',
						type: "success",
						timer: 3000,
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$('#modal_seguimiento').modal('hide');
					cleanSeguimiento();
					pagination(1);
					return false;
				}if(registro == 2){
					swal({
						title: 'Error',
						text: 'Error al almacenar este registro',
						type: 'error',
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					return false;
				}if(registro == 3){
					swal({
						title: 'Error',
						text: 'Este registro ya existe',
						type: 'error',
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					return false;
				}else{
					swal({
						title: 'Error',
						text: 'Error, no se puedo almacenar el registro',
						type: 'error',
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					return false;
				}
			}
		});
		return false;
    }
}

function agregaRegistro(){
if($('#formulario1 #departamento').val() != "" && $('#formulario1 #municipio').val() != "" && $('#formulario1 #localidad').val() != "" && $('#formulario1 #expediente').val() != 0){
  if($('#formulario1 #patologia1').val()!=""){
     if($('#formulario1 #servicio').val()!=""){
    	var fecha = $('#formulario1 #fecha').val();
        var hoy = new Date();
        fecha_actual = convertDate(hoy);
	    var url = '<?php echo SERVERURL; ?>php/atas/agregar.php';

	    if ($('#formulario1 #fecha_n').val() == fecha_actual || $('#formulario1 #fecha_n').val() < fecha_actual){
			swal({
				title: 'Error',
				text: 'Debe seleccionar una fecha de nacimiento válida',
				type: 'error',
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
			$('#formulario1 #fecha_n').focus();
			$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
		   return false;
	    }else{
			if ($('#formulario1 #expediente').val() == "" || $('#formulario1 #expediente').val()==0){
				swal({
					title: 'Error',
					text: 'El número de expediente no puede quedar en blanco o ser igual a cero.',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
				return false;
			}else{
			 /*if(getMes(fecha)==2){
					swal({
						title: 'Error',
						text: 'No se puede agregar/modificar registros fuera de este periodo.',
						type: 'error',
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
					return false;
			   }else{*/
				if ( fecha <= fecha_actual){
				   $.ajax({
					  type:'POST',
					  url:url,
					  data:$('#formulario1').serialize(),
					  success: function(registro){
						 if ($('#formulario1 #pro').val() == 'Registro'){
							if(registro == 1){
								swal({
									title: 'Error',
									text: 'El municipio no corresponde al departamento, comunicarse con admisión antes de continuar.',
									type: 'error',
									confirmButtonClass: 'btn-danger',
									allowEscapeKey: false,
									allowOutsideClick: false
								});
								$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
								return false;
							}else if(registro == 2){
								swal({
									title: 'Almacenado',
									text: 'Registro almacenado correctamente',
									type: "success",
									timer: 3000,
									allowEscapeKey: false,
									allowOutsideClick: false
								  });								  
								  $('#formulario1')[0].reset();
								  $('#formulario1 .nav-tabs li:eq(0) a').tab('show');
								  cleanForms1();
								  pagination(1);
								  return false;
							}else if(registro == 4){
								swal({
									title: 'Error',
									text: 'Este usuario ya se había almacenado antes.',
									type: 'error',
									confirmButtonClass: 'btn-danger',
									allowEscapeKey: false,
									allowOutsideClick: false
								});
								$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
							}else if(registro == 5){
								swal({
									title: 'Error',
									text: 'Este usuario ya tiene atención con otro profesional del mismo servicio o simplemente ya tiene atención con su persona, por favor verificar las atenciones pendientes e intentelo nuevamente.',
									type: 'error',
									confirmButtonClass: 'btn-danger',
									allowEscapeKey: false,
									allowOutsideClick: false
								});
								$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
							}else if(registro == 6){
								swal({
									title: 'Error',
									text: 'No se puede almacenar la atención, por favor validar con el área de Admisión antes de continuar, puede ser que exista una ausencia marcada para este usuario o el usuario se encuentra en su lista pendiente de atención, por favor valide su ATA.',
									type: 'error',
									confirmButtonClass: 'btn-danger',
									allowEscapeKey: false,
									allowOutsideClick: false
								});
								$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
							}else{
								swal({
									title: 'Error',
									text: 'No se puedo almacenar el registro favor interntar mas tarde.',
									type: 'error',
									confirmButtonClass: 'btn-danger',
									allowEscapeKey: false,
									allowOutsideClick: false
								});
								$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
								return false;
							}
						}
					 }
				  });
				  return false;
				}else{
					swal({
						title: 'Error',
						text: 'No se puede agregar/modificar registros fuera de esta fecha',
						type: 'error',
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
					$('#formulario1')[0].reset();
					limpiarPatologiaformulario_atas();
					return false;
				}
			  //}
	      }
       }
	}else{
		swal({
			title: 'Error',
			text: 'El servicio no puede quedar en blanco',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
        $('#formulario1 .nav-tabs li:eq(0) a').tab('show');
	  return false;
    }
 }else{
		swal({
			title: 'Error',
			text: 'La primer patología no puede quedar en blanco',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
        $('#formulario1 .nav-tabs li:eq(0) a').tab('show');
        limpiarPatologiaformulario_atas();
	    return false;
 }
}else{
	swal({
		title: 'Error',
		text: 'No se puede guardar el registro, debe comunicarse el área de admisión, para actualizar los datos del usuario',
		type: 'error',
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
	$('#formulario1 .nav-tabs li:eq(0) a').tab('show');
    limpiarPatologiaformulario_atas();
	return false;
 }
}

function agregaRegistroPorUsuario(){
if($('#formulario_atas #departamento1').val() != "" && $('#formulario_atas #municipio1').val() != "" && $('#formulario_atas #localidad1').val() != ""){
 if($('#formulario_atas #patologia_1').val()!=""){
 	var fecha = $('#formulario_atas #fecha1').val();

    var hoy = new Date();
    fecha_actual = convertDate(hoy);

	var url = '<?php echo SERVERURL; ?>php/atas/agregar_por_usuario.php';
	var agenda_id = $('#formulario_atas #agenda_id').val();;
	var pacientes_id = $('#formulario_atas #pacientes_id').val();


   /*if(getMes(fecha)==2){
		swal({
			title: 'Error',
			text: 'No se puede agregar/modificar registros fuera de este periodo',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
        $('#formulario_atas .nav-tabs li:eq(0) a').tab('show');
	    patologiaCIE10_1_1();
	    patologiaCIE10_2_1();
        patologiaCIE10_3_1();

	  return false;
   }else{*/
	if ( fecha <= fecha_actual){
	    $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_atas').serialize(),
		  success: function(registro){
			  if ($('#formulario_atas #pro1').val() == 'Registro por usuario'){
				 if(registro == 1){
					swal({
						title: "Error",
						text: "El municipio no corresponde al departamento, comunicarse con admisión antes de continuar",
						type: "error",
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$('#formulario_atas .nav-tabs li:eq(0) a').tab('show');
					return false;
				 }else if(registro == 2){
					$('#formulario_atas')[0].reset();
					$('#formulario_atas #pro1').val('Registro por usuario');
					cleanForms2();
					if(getPuestoId() == 2 || getPuestoId() == 4 ){
						swal({
							title: "Almacenado",
							text: "Registro almacenado correctamente. ¿Desea realizar la receta médica para este usuario?",
							type: "info",
							showCancelButton: true,
							confirmButtonText: "¡Sí, deseo realizarla!",
							cancelButtonText: "Cancelar",
							closeOnConfirm: false,
							showLoaderOnConfirm: true,
							allowEscapeKey: false,
							allowOutsideClick: false
						}, function () {
							swal.close();
							showRecetaMedica(agenda_id, pacientes_id);
						});
					}else{
						swal({
							title: 'Almacenado',
							text: 'Registro almacenado correctamente',
							type: "success",
							timer: 3000,
							allowEscapeKey: false,
							allowOutsideClick: false
						});
					}
					$('#registrar1').modal('hide');
					$('#formulario_atas .nav-tabs li:eq(0) a').tab('show');
					$("#edi_ata_por_usuario").attr('disabled', true);
					pagination(1);
					cleanForms2();
					limpiarPatologiaformulario_atas();
					return false;
				}else if(registro == 3){
					swal({
						title: 'Error',
						text: 'Este registro ya existe, no se puede almacenar nuevamente',
						type: 'error',
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$('#formulario_atas .nav-tabs li:eq(0) a').tab('show');
					return false;
				}else{
					swal({
						title: 'Error',
						text: 'No se puedo almacenar el registro favor interntar mas tarde.',
						type: 'error',
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$('#formulario_atas .nav-tabs li:eq(0) a').tab('show');
					return false;
				}
		     }
		  }
	   });
	return false;
	}else{
		swal({
			title: 'Error',
			text: 'No se puede agregar/modificar registros fuera de esta fecha',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
        $('#formulario_atas .nav-tabs li:eq(0) a').tab('show');
		limpiarPatologiaformulario_atas();
		return false;
	}
   //}
  }else{
		swal({
			title: 'Error',
			text: 'La primer patología no puede quedar en blanco',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
        $('#formulario_atas .nav-tabs li:eq(0) a').tab('show');
		limpiarPatologiaformulario_atas();
	  return false;
 }
 }else{
		swal({
			title: 'Error',
			text: 'No se puede guardar el registro, debe comunicarse el área de admisión, para actualizar los datos del usuario',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
        limpiarPatologiaformulario_atas();
	    return false;
 }
}

function nosePresento(id, pacientes_id){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
   if(getPuestoId() == 2 || getPuestoId() == 4){
	  swal({
			title: 'Acceso Denegado',
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
	  });
   }else{
		$('#form_ausencia #dato').val(id);
		$('#form_ausencia #motivo_ausencia').val("");
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
			text: "¿Desea remover este usuario: " + dato + " que no se presento a su cita?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, remover este registro!",
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
			eliminarRegistro(id,inputValue);
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
}

function eliminarRegistro(id,comentario){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/usuario_no_presento.php';
	var fecha = $('#fecha_b').val();

	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'id='+id+'&fecha='+fecha+'&comentario='+comentario,
		  success: function(registro){
			  if(registro == 1){
			    pagination(1);
				swal({
					title: 'Success',
					text: 'El registro ha sido removido de la lista',
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			  }else if(registro == 2){
				swal({
					title: 'Error',
					text: 'Error al remover este registro',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			  }else if(registro == 3){
				swal({
					title: 'Error',
					text: 'Este registro ya tiene almacenada una ausencia',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			  }else if(registro == 4){
				swal({
					title: 'Error',
					text: 'Este usuario ya ha sido precliniado, no puede marcarle una ausencia',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			  }else{
				swal({
					title: 'Error',
					text: 'Error al ejecutar esta acción',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			  }
		  }
	   });
	   return false;
	}else{
		swal({
			title: 'Error',
			text: 'No se puede ejecutar esta acción fuera de esta fecha',
			type: 'error',
			confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
		});
	}
}

function getServicioEdit(agenda_id){
  var url = '<?php echo SERVERURL; ?>php/atas/getServicio.php';
  var servicio;

  $.ajax({
 	 type:'POST',
	 url:url,
	 async: false,
	 data:'agenda_id='+agenda_id,
	 success: function(data){
		servicio = data;
		$('#formulario_atas #servicio1').val(data);
	 }
   });
   return servicio;
}

function editarRegistro(id,agenda_id, exp){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
  if(exp != 0){
	$('#formulario_atas')[0].reset();

	if(exp == 0){
		$("#edi_ata_por_usuario").attr('disabled', true);
	}else{
		$("#edi_ata_por_usuario").attr('disabled', false);
	}

	var url = '<?php echo SERVERURL; ?>php/agenda/editar.php';
	var expedientes;

		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&agenda_id='+agenda_id,
		success: function(valores){
				var datos = eval(valores);
				$('#formulario_atas #reg').hide();
				$('#edi_ata_por_usuario').show();
				$('#formulario_atas #pro1').val('Registro por usuario');
				$('#formulario_atas #id-registro1').val(id);
				$('#formulario_atas #agenda_id').val(agenda_id);
				$('#formulario_atas #pacientes_id').val(id);
				if (exp == 0){
				  expedientes = 'TEMP';
				}else{
					expedientes = exp;
				}

                $('#user1').val(expedientes);
				$('#departamento1').val(datos[0]);
				getServicioEdit(agenda_id);
				$('#formulario_atas #grupo_localidades1').hide();
				$('#formulario_atas #grupo_servicio').hide();
				$('#formulario_atas #municipio1').val(datos[1]);
				$('#formulario_atas #localidad1').val(datos[2]);
				$('#formulario_atas #localidad1').val(datos[2]);
				$('#formulario_atas #nombre_paciente').val(datos[3]);
                $('#formulario_atas #paciente1').val(datos[4]);
                $('#formulario_atas #label_cronico_si1').html('Sí');
                $('#formulario_atas #label_cronico_no1').html('No');
                $('#formulario_atas #ihss_ata').val(2);
				$('#formulario_atas #fecha1').val(datos[9]);
				$('#formulario_atas #user1').attr("readonly", true);
				$('#formulario_atas #fecha1').attr("readonly", true);

                $('#formulario_atas #suicida_label1').html("¿Conducta Suicida?");
                $('#formulario_atas #label_suicida_si1').html('Sí');
                $('#formulario_atas #label_suicida_no1').html('No');
			    $('#formulario_atas #suicida_si1').show();
                $('#formulario_atas #suicida_no1').show();
				

                $('#formulario_atas #otros_programar_cita_1').hide();

				//SI EL PUESTO ES DE TRABAJO SOCIAL
				if(getPuesto() == 11){
					$('#formulario_atas #trabajo_social1').show();
				}else{
					$('#formulario_atas #trabajo_social1').hide();
				}

				//CONSULTAMOS LOS REGISTROS QUE NO SEAN DE TRABAJO SOCIAL
				if($('#formulario_atas #servicio1').val() != 8){
				    $('#formulario_atas #patologia_1').val(datos[5]);
				    $('#formulario_atas #patologia_2').val(datos[6]);
				    $('#formulario_atas #patologia_3').val(datos[7]);
				}else{
				    getPatologia1TS($('#formulario_atas #user1').val(), $('#formulario_atas #fecha1').val(), $('#formulario_atas #servicio1').val());
				}

				//TRABAJO SOCIAL, TIPO USUARIO

				$('#formulario_atas #glucometria').val(datos[8]);
                $("#edi_ata_por_usuario").attr('disabled', false);
                $("#formulario_atas #motivo1").attr('readonly', true);
                $("#formulario_atas #motivo_e1").attr('readonly', true);
                $("#formulario_atas #motivo_e1").attr('readonly', true);
                $("#formulario_atas #diagnostico_clinico1").attr('readonly', true);
                $("#formulario_atas #clinico1").attr('readonly', true);
				$("#formulario_atas #transito_motivo_recibida1").attr('readonly', true);
                $("#formulario_atas #transito_motivo_enviada1").attr('readonly', true);

                cleanForms2();
				if (getTipoUsuario(exp, getServicioEdit(agenda_id)) == 'N' && getServicioEdit(agenda_id) != 7){
					swal({
						title: 'Advertencia',
						text: 'Este es un usuario nuevo, tiene referencia, por favor llenarla antes de guardar el registro',
						type: 'warning',
						confirmButtonClass: 'btn-warning',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				    $("#edi_ata_por_usuario").attr('disabled', true);
					$('#formulario_atas #referenciasi1').prop('checked', true); //DESELECCIONA UN CHECK BOX

				}else if (getTipoUsuario(exp, getServicioEdit(agenda_id)) == 'S'){
				    $("#edi_ata_por_usuario").attr('disabled', false);

				}else{
				    $("#edi_ata_por_usuario").attr('disabled', false);
				}

				if(getEdadUsuario(agenda_id,id)==1){
					swal({
						title: 'Error',
						text: 'Este usuario esta próximo a cumplir 18 años, recuerde que ya es tiempo que lo transfiera a Consulta Externa',
						type: 'error',
						confirmButtonClass: 'btn-danger',
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				}

				if(getPuesto() == 2 || getPuesto() == 4 || getPuesto() == 1){
				   //REFERENCIAS
			       $('#formulario_atas #referencia_label1').html("¿Referencia?");
				   $('#formulario_atas #referencia_label1').show();
				   $('#formulario_atas #referenciasi1').show();
				   $('#formulario_atas #referenciano1').show();
                   $('#formulario_atas #label_referenciasi1').show();
                   $('#formulario_atas #label_referenciano1').show();
                   $('#formulario_atas #label_referenciasi1').html('Sí');
                   $('#formulario_atas #label_referenciano1').html('No');
		        }else{
			       $('#formulario_atas #referencia_label1').html('');
				   $('#formulario_atas #referencia_label1').hide();
				   $('#formulario_atas #referenciasi1').hide();
				   $('#formulario_atas #referenciano1').hide();
                   $('#formulario_atas #label_referenciasi1').hide();
                   $('#formulario_atas #label_referenciano1').hide();
                   $('#formulario_atas #label_referenciasi1').html('');
                   $('#formulario_atas #label_referenciano1').html('');
		        }

				if(getPuesto() == 2 || getPuesto() == 10){
				   //USUARIO CRONICO
			       $('#formulario_atas #cronico_label1').html("¿Crónico?");
			       $('#formulario_atas #cronico_label1').show();
				   $('#formulario_atas #cronico_si1').show();
				   $('#formulario_atas #cronico_no1').show();
                   $('#formulario_atas #label_cronico_si1').show();
                   $('#formulario_atas #label_cronico_no1').show();
		        }else{
			       $('#formulario_atas #cronico_label1').hide();
				   $('#formulario_atas #cronico_si1').hide();
				   $('#formulario_atas #cronico_no1').hide();
                   $('#formulario_atas #label_cronico_si1').hide();
                   $('#formulario_atas #label_cronico_no1').hide();
		        }

				$('#registrar1').modal({
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
			title: 'Error',
			text: 'Este es un expediente temporal, no se puede almacenar',
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
}

//EVALUA SI SE SELECCIONA EL RADIO BOTON DE REFERENCIA EL EL FORMULARIO
//FORMULARIO1
//SÍ
$(document).ready(function() {
	$('#formulario1 #referenciasi').on('click', function(){
        $("#formulario1 #reg").attr('disabled', true);
    });
});

//NO
$(document).ready(function() {
	$('#formulario1 #referenciano').on('click', function(){
		$("#formulario1 #reg").attr('disabled', false);
    });
});


//FOMULARIO ATA
//SÍ
$(document).ready(function() {
	$('#formulario_atas #referenciasi1').on('click', function(){
        $("#edi_ata_por_usuario").attr('disabled', true);
    });
});

//NO
$(document).ready(function() {
	$('#formulario_atas #referenciano1').on('click', function(){
		$("#edi_ata_por_usuario").attr('disabled', false);
    });
});


$(document).ready(function() {
	$('#formulario1 #servicio').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/atas/buscar_usuario_ata.php';
        var expediente = $('#formulario1 #expediente').val();
        var servicio = $('#formulario1 #servicio').val();
        var fecha = $('#formulario1 #fecha').val();

		if (getTipoUsuario(expediente, servicio) == 'N'){
			swal({
				title: 'Advertencia',
				text: 'Este es un usuario nuevo, tiene referencia, por favor llenarla antes de guardar el registro',
				type: 'warning',
				confirmButtonClass: 'btn-warning',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		    $("#formulario1 #reg").attr('disabled', true);
			$('#formulario1 #referenciasi').prop('checked', true); //DESELECCIONA UN CHECK BOX
		}else if (getTipoUsuario(expediente,servicio) == 'S'){
			$("#formulario1 #reg").attr('disabled', false);
	    }else{
		   $("#formulario1 #reg").attr('disabled', false);
		   $("#formulario1 #reg").attr('disabled', false);
		}

    	if(getEdadUsuario1($('#formulario1 #servicio').val(),expediente)==1){
			swal({
				title: 'Advertencia',
				text: 'Este usuario esta próximo a cumplir 18 años, recuerde que ya es tiempo que lo transfiera a Consulta Externa',
				type: 'warning',
				confirmButtonClass: 'btn-warning',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		}

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente+'&servicio='+servicio,
		   success:function(data){
			  var array = eval(data);
			  $('#formulario1 #paciente').val(array[0]);
		  }
	  });
	  return false;
    });
});

function municipio(municipio){
  var url = '<?php echo SERVERURL; ?>php/selects/departamentos_municipios_select.php';
  $.ajax({
 	 type:'POST',
	 url:url,
	 data:'id='+municipio,
		success: function(data){
			$('#municipio option').remove();
			$('#municipio').append(data);
		}
 });
 return false;
}

function getEdadUsuario(agenda_id,pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getEdad.php';
	var edad;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'pacientes_id='+pacientes_id,
		success:function(data){
		  var array = eval(data);
		  if(getServicioEdit(agenda_id) == 6 && array[0] >= 17 && array[1] >=5){
			  edad  = 1;//El Usuario es un adulto;
		  }else{
			  edad  = 2;//El usuario aun es un niño
		  }
		}
	});
	return edad;
}

function getEdadUsuarioFormulario(servicio,pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getEdad.php';
	var edad;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'pacientes_id='+pacientes_id,
		success:function(data){
		  var array = eval(data);
		  if(servicio == 6 && array[0] >= 17 && array[1] >=5){
			  edad  = 1;//El Usuario es un adulto;
		  }else{
			  edad  = 2;//El usuario aun es un niño
		  }
		}
	});
	return edad;
}

function getEdadUsuario1(servicio,expediente){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getEdad1.php';
	var edad;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'expediente='+expediente,
		success:function(data){
		  var array = eval(data);
		  if(servicio == 6 && array[0] >= 17 && array[1] >=5){
			  edad  = 1;//El Usuario es un adulto;
		  }else{
			  edad  = 2;//El usuario aun es un niño
		  }
		}
	});
	return edad;
}

function reportePDF(){
	var busqueda = $('#bs-regis').val();
	window.open('<?php echo SERVERURL; ?>php/users/users.php?busqueda='+busqueda);
}

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/agenda/paginar.php';
    var fechai = $('#form_main #fecha_b').val();
	var fechaf = $('#form_main #fecha_f').val();
	var dato = '';
	var estado = '';

    if($('#form_main #estado').val() == "" || $('#form_main #estado').val() == null){
		estado = 0;
	}else{
		estado = $('#form_main #estado').val();
	}

	if($('#form_main #bs-regis').val() == "" || $('#form_main #bs-regis').val() == null){
		dato = '';
	}else{
		dato = $('#form_main #bs-regis').val();
	}

	$.ajax({
		type:'POST',
		url:url,
		async: true,
		data:'partida='+partida+'&fechai='+fechai+'&fechaf='+fechaf+'&dato='+dato+'&estado='+estado,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

/*VERIFICAR LA EXISTENCIA DEL USUARIO (PACIENTE)*/
$(document).ready(function(e) {
    $('#formulario1 #expediente').on('blur', function(){
	 if($('#formulario1 #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/atas/buscar_expediente.php';
        var expediente = $('#formulario1 #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
				swal({
					title: 'Error',
					text: 'Registro no encontrado',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario1 #expediente').focus();
				$('#paciente').val("");
				getServicio();
				getServicioTransito();
				$("#formulario1 #reg").attr('disabled', true);
				return false;
			  }else if (array[0] == "Error_Temporal"){
				swal({
					title: 'Error',
					text: 'Este es un usuario Temporal, por favor verificar con el área de Admisión',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario1 #expediente').focus();
				$('#formulario1 #paciente').val("");
				getServicio();
				getServicioTransito();
				$("#formulario1 #reg").attr('disabled', true);
				return false;
			  }else if (array[0] == "Familiar"){
				swal({
					title: 'Error',
					text: 'Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario1 #expediente').focus();
				$('#formulario1 #paciente').val("");
				getServicio();
				getServicioTransito();
				$("#formulario1 #reg").attr('disabled', true);
				return false;
			  }else if (array[0] == "Bien"){
			     $('#formulario1 #nomb1').val(array[1]);
                 $('#formulario1 #departamento').val(array[2]);
                 $('#formulario1 #municipio').val(array[3]);
                 getServicio();
				 getServicioTransito();
                 $('#formulario1 #localidad').val(array[4]);
                 getRespuestaFormulario();
			  }else{
				swal({
					title: 'Error',
					text: 'Error, no se puede procesar su consulta, intentenlo nuevamente',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario1 #expediente').focus();
				$('#formulario1 #paciente').val("");
				getServicio();
				getServicioTransito();
				$("#formulario1 #reg").attr('disabled', true);
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario1')[0].reset();
        $("#formulario1 #reg").attr('disabled', true);
	 }
	});
});

$(document).ready(function(e) {
    $('#formulario1 #expediente').on('blur', function(){
	 if($('#formulario1 #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/atas/buscar_usuario_ata.php';
        var expediente = $('#formulario1 #expediente').val();
        var servicio = $('#formulario1 #servicio').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente+'&servicio='+servicio,
		   success:function(data){
			  var array = eval(data);
			  $('#formulario1 #paciente').val(array[0]);
		  }
	  });
	  return false;
	}else{
		$('#formulario1')[0].reset();
        $("#formulario1 #reg").attr('disabled', true);
	 }
	});
});

function municipio(municipio){
  var url = '<?php echo SERVERURL; ?>php/selects/departamentos_municipios_select.php';
  $.ajax({
 	 type:'POST',
	 url:url,
	 data:'id='+municipio,
		success: function(data){
			$('#municipio option').remove();
			$('#municipio').append(data);
		}
 });
 return false;
}

function municipio1(municipio){
  var url = '<?php echo SERVERURL; ?>php/selects/departamentos_municipios_select.php';
  $.ajax({
 	 type:'POST',
	 url:url,
	 data:'id='+municipio,
		success: function(data){
			$('#formulario_atas #municipio1 option').remove();
			$('#formulario_atas #municipio1').append(data);
		}
 });
 return false;
}

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function getPatologia1(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario1 #patologia1').html("");
				$('#formulario1 #patologia1').html(data);

				$('#formulario_cuestionario_maida #patologia').html("");
				$('#formulario_cuestionario_maida #patologia').html(data);

				$('#formulario_ata_manual #patologia_ata1').html("");
				$('#formulario_ata_manual #patologia_ata1').html(data);
		}
   });
   return false;
}

function getPatologia2(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario1 #patologia2').html("");
				$('#formulario1 #patologia2').html(data);

				$('#formulario_ata_manual #patologia_ata2').html("");
				$('#formulario_ata_manual #patologia_ata2').html(data);
		}
   });
   return false;
}

function getPatologia3(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario1 #patologia3').html("");
				$('#formulario1 #patologia3').html(data);

				$('#formulario_ata_manual #patologia_ata3').html("");
				$('#formulario_ata_manual #patologia_ata3').html(data);
		}
   });
   return false;
}

function getPatologia_1(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_atas #patologia_1').html("");
				$('#formulario_atas #patologia_1').html(data);
		}
   });
   return false;
}

function getPatologia_2(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_atas #patologia_2').html("");
				$('#formulario_atas #patologia_2').html(data);
		}
   });
   return false;
}

function getPatologia_3(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_atas #patologia_3').html("");
				$('#formulario_atas #patologia_3').html(data);
		}
   });
   return false;
}

function limpiarPatologia1(){
	getPatologia1();
	getPatologia2();
	getPatologia3();
	getRespuestaFormulario();
	getNivel();
    getNivel_e();
}

function limpiarPatologia2(){
	getPatologia_1();
	getPatologia_2();
	getPatologia_3();
	getRespuestaFormulario();
    getNivel1();
	getNivel_e1();
}

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/atas/servicios_ata.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #servicio').html("");
			$('#formulario1 #servicio').html(data);

		    $('#formulario_atas #servicio1').html("");
			$('#formulario_atas #servicio1').html(data);

		    $('#formulario_atenciones_familiares #servicio').html("");
			$('#formulario_atenciones_familiares #servicio').html(data);

		    $('#formulario_cuestionario_maida #servicio').html("");
			$('#formulario_cuestionario_maida #servicio').html(data);

		    $('#formulario_transito_enviada #servicio').html("");
			$('#formulario_transito_enviada #servicio').html(data);

		    $('#formulario_transito_recibida #servicio').html("");
			$('#formulario_transito_recibida #servicio').html(data);

		    $('#formulario_receta_medica #servicio_receta').html("");
			$('#formulario_receta_medica #servicio_receta').html(data);
        }
     });
}

function getServicioTransito(){
    var url = '<?php echo SERVERURL; ?>php/atas/servicios_transito.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #transito_servicio_recibida').html("");
			$('#formulario1 #transito_servicio_recibida').html(data);

		    $('#formulario1 #transito_servicio_enviada').html("");
			$('#formulario1 #transito_servicio_enviada').html(data);

			$('#formulario_atas #transito_servicio_recibida1').html("");
			$('#formulario_atas #transito_servicio_recibida1').html(data);

		    $('#formulario_atas #transito_servicio_enviada1').html("");
			$('#formulario_atas #transito_servicio_enviada1').html(data);
        }
     });
}

function getServicioformATA(){
    var url = '<?php echo SERVERURL; ?>php/atas/servicios_transito.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
			$('#formulario_atas #transito_servicio_recibida1').html("");
			$('#formulario_atas #transito_servicio_recibida1').html(data);

		    $('#formulario_atas #transito_servicio_enviada1').html("");
			$('#formulario_atas #transito_servicio_enviada1').html(data);

        }
     });
}

//REFERENCIAS RECIBIDAS FORMULARIO ATA
function getNivel(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #nivel').html("");
			$('#formulario1 #nivel').html(data);
        }
     });
}

//REFERENCIAS ENVIADAS FORMULARIO ATA
function getNivel_e(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #nivel_e').html("");
			$('#formulario1 #nivel_e').html(data);
        }
     });
}

//REFERENCIAS RECIBIDAS FORMULARIO ATA POR USUARIO
function getNivel1(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_atas #nivel1').html("");
			$('#formulario_atas #nivel1').html(data);
        }
     });
}

function getNivel_e1(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_atas #nivel_e1').html("");
			$('#formulario_atas #nivel_e1').html(data);
        }
     });
}

//ATA NUEVO
$(document).ready(function() {
	$('#formulario1 #nivel').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';

		var nivel = $('#formulario1 #nivel').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario1 #centro').html("");
			  $('#formulario1 #centro').html(data);
              $("#formulario1 #reg").attr('disabled', true);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario1 #centro').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';

		var nivel = $('#formulario1 #nivel').val();
		var centro = $('#formulario1 #centro').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario1 #centroi').html("");
			  $('#formulario1 #centroi').html(data);
              $("#formulario1 #reg").attr('disabled', true);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario1 #centroi').on('change', function(){
		setCentroiFormulario();
    });
});

function setCentroiFormulario(){
   $("#formulario1 #motivo").attr('readonly', false);
   $("#formulario1 #clinico").attr('readonly', false);
}

//REFERENCIAS ENVIADAS
$(document).ready(function() {
	$('#formulario1 #nivel_e').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';

		var nivel = $('#formulario1 #nivel_e').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario1 #centro_e').html("");
			  $('#formulario1 #centro_e').html(data);
              $("#formulario1 #reg").attr('disabled', true);
		  }
	  });
	  return false;
    });
});


$(document).ready(function() {
	$('#formulario1 #centroi_e').on('change', function(){
		setDiagnosticoClinicoFormulario();
    });
});

function setDiagnosticoClinicoFormulario(){
   $("#formulario1 #motivo_e").attr('readonly', false);
   $("#formulario1 #diagnostico_clinico").attr('readonly', false);
}
$(document).ready(function() {
	$('#formulario1 #centro_e').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';

		var nivel = $('#formulario1 #nivel_e').val();
		var centro = $('#formulario1 #centro_e').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario1 #centroi_e').html("");
			  $('#formulario1 #centroi_e').html(data);
              $("#formulario1 #reg").attr('disabled', true);
		  }
	  });
	  return false;
    });
});

//INICIO FORMULARO 1
$(document).ready(function() {
	$('#formulario1 #motivo').on('change', function(){
	    if($("#formulario1 #centroi").val()!="" && $("#formulario1 #motivo").val()!="" && $("#formulario1 #nivel").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario1 #motivo_e').on('change', function(){
	    if($("#formulario1 #centroi_e").val()!="" && $("#formulario1 #nivel_e").val()!="" && $("#formulario1 #diagnostico_clinico").val()!="" && $("#formulario1 #motivo_traslado").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario1 #diagnostico_clinico').on('blur', function(){
	    if($("#formulario1 #centroi_e").val()!="" && $("#formulario1 #motivo_e").val()!="" && $("#formulario1 #nivel_e").val()!="" && $("#formulario1 #diagnostico_clinico").val()!="" && $("#formulario1 #motivo_traslado").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario1 #centroi').on('keypress', function(){
	    if($("#formulario1 #centroi").val()!="" && $("#formulario1 #motivo").val()!="" && $("#formulario1 #nivel").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario1 #motivo_e1').on('change', function(){
	    if($("#formulario1 #centroi").val()!="" && $("#formulario1 #motivo").val()!="" && $("#formulario1 #nivel").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario1 #motivo_traslado').on('change', function(){
	    if($("#formulario1 #centroi").val()!="" && $("#formulario1 #motivo").val()!="" && $("#formulario1 #nivel").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario1 #diagnostico_clinico').on('keypress', function(){
	    if($("#formulario1 #centroi_e").val()!="" && $("#formulario1 #motivo_e").val()!="" && $("#formulario1 #nivel_e").val()!="" && $("#formulario1 #diagnostico_clinico").val()!="" && $("#formulario1 #motivo_traslado").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario1 #centroi_e').on('keypress', function(){
	    if($("#formulario1 #centroi_e").val()!="" && $("#formulario1 #motivo_e").val()!="" && $("#formulario1 #nivel_e").val()!="" && $("#formulario1 #diagnostico_clinico").val()!="" && $("#formulario1 #motivo_traslado").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario1 #motivo_e').on('keypress', function(){
	    if($("#formulario1 #centroi_e").val()!="" && $("#formulario1 #motivo_e").val()!="" && $("#formulario1 #nivel_e").val()!=""){
		    $("#formulario1 #reg").attr('disabled', false);
		}else{
			$("#formulario1 #reg").attr('disabled', true);
		}
    });
});

//FIN FORMULARIO1

//INICIO ATA POR USUARIO
$(document).ready(function() {
	$('#formulario_atas #centroi1').on('change', function(){
		setCentroi1FormularioATA();
    });
});

function setCentroi1FormularioATA(){
   $("#formulario_atas #motivo1").attr('readonly', false);
   $("#formulario_atas #clinico1").attr('readonly', false);
}

$(document).ready(function() {
	$('#formulario_atas #centroi_e1').on('change', function(){
 	   	setDiagnosticoClinico1FormularioATA();
    });
});

function setDiagnosticoClinico1FormularioATA(){
   $("#formulario_atas #motivo_e1").attr('readonly', false);
   $("#formulario_atas #diagnostico_clinico1").attr('readonly', false);
}

$(document).ready(function() {
	$('#formulario_atas #nivel1').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';

		var nivel = $('#formulario_atas #nivel1').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario_atas #centro1').html("");
			  $('#formulario_atas #centro1').html(data);
			  $("#edi_ata_por_usuario").attr('disabled', true);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario_atas #nivel_e1').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';

		var nivel = $('#formulario_atas #nivel_e1').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario_atas #centro_e1').html("");
			  $('#formulario_atas #centro_e1').html(data);
			  $("#edi_ata_por_usuario").attr('disabled', true);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario_atas #centro1').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';

		var nivel = $('#formulario_atas #nivel1').val();
		var centro = $('#formulario_atas #centro1').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_atas #centroi1').html("");
			  $('#formulario_atas #centroi1').html(data);
              $("#edi_ata_por_usuario").attr('disabled', true);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario_atas #centro_e1').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';

		var nivel = $('#formulario_atas #nivel_e1').val();
		var centro = $('#formulario_atas #centro_e1').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_atas #centroi_e1').html("");
			  $('#formulario_atas #centroi_e1').html(data);
              $("#edi_ata_por_usuario").attr('disabled', true);
		  }
	  });
	  return false;
    });
});


$(document).ready(function() {
	$('#formulario_atas #motivo_re').on('change', function(){
	    if($("#formulario_atas #centroi1").val()!="" && $("#formulario_atas #motivo1").val()!="" && $("#formulario_atas #nivel1").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #motivo1').on('change', function(){
	    if($("#formulario_atas #centroi1").val()!="" && $("#formulario_atas #motivo1").val()!="" && $("#formulario_atas #nivel1").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #motivo_e1').on('change', function(){
	    if($("#formulario_atas #centroi_e1").val()!="" && $("#formulario_atas #motivo_e1").val()!="" && $("#formulario_atas #nivel_e1").val()!="" && $("#formulario_atas #diagnostico_clinico1").val()!="" && $("#formulario_atas #motivo_traslado").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #diagnostico_clinico1').on('blur', function(){
	    if($("#formulario_atas #centroi_e1").val()!="" && $("#formulario_atas #motivo_e1").val()!="" && $("#formulario_atas #nivel_e1").val()!="" && $("#formulario_atas #diagnostico_clinico1").val()!="" && $("#formulario_atas #motivo_traslado").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #centroi1').on('keypress', function(){
	    if($("#formulario_atas #centroi1").val()!="" && $("#formulario_atas #motivo1").val()!="" && $("#formulario_atas #nivel1").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #centroi_e1').on('keypress', function(){
	    if($("#formulario_atas #centroi_e1").val()!="" && $("#formulario_atas #motivo_e1").val()!="" && $("#formulario_atas #nivel_e1").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #motivo1').on('keypress', function(){
	    if($("#formulario_atas #centroi1").val()!="" && $("#formulario_atas #motivo1").val()!="" && $("#formulario_atas #nivel1").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #motivo_e1').on('keypress', function(){
	    if($("#formulario_atas #centroi_e1").val()!="" && $("#formulario_atas #motivo_e1").val()!="" && $("#formulario_atas #nivel_e1").val()!="" && $("#formulario_atas #diagnostico_clinico1").val()!="" && $("#formulario_atas #motivo_traslado").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #diagnostico_clinico1').on('keypress', function(){
	    if($("#formulario_atas #centroi_e1").val()!="" && $("#formulario_atas #motivo_e1").val()!="" && $("#formulario_atas #nivel_e1").val()!="" && $("#formulario_atas #diagnostico_clinico1").val()!="" && $("#formulario_atas #motivo_traslado").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});

$(document).ready(function() {
	$('#formulario_atas #motivo_e1').on('keypress', function(){
	    if($("#formulario_atas #centro_e1").val()!="" && $("#formulario_atas #motivo_e1").val()!="" && $("#formulario_atas #nivel_e1").val()!=""){
		    $("#edi_ata_por_usuario").attr('disabled', false);
		}else{
			$("#edi_ata_por_usuario").attr('disabled', true);
		}
    });
});
//TRANSITO RECIBIDA
$(document).ready(function() {
	  $('#formulario1 #transito_servicio_recibida').on('change', function(){
			getUnidadTransitoRecibida();
      });
});

function getUnidadTransitoRecibida(){
	var servicio_id = $('#transito_servicio_recibida').val();
	var url = '<?php echo SERVERURL; ?>php/atas/getUnidad.php';

	$.ajax({
		type: "POST",
		url: url,
		async: true,
		data:'servicio='+servicio_id,
		success: function(data){
			$('#formulario1 #transito_unidad_recibida').html(data);

			$('#formulario1 #transito_unidad_recibida').html(data);
		}
	 });
}

function getServicioTransitoRecibida(){
   var url = '<?php echo SERVERURL; ?>php/atas/servicios_transito.php';
   var servicio_id = $('#formulario1 #servicio').val();

   $.ajax({
      type: "POST",
      url: url,
	  async: true,
      data:'servicio='+servicio_id,
      success: function(data){
		$('#formulario1 #transito_unidad_recibida').html(data);;
    }
  });
}

$(document).ready(function() {
	$('#formulario1 #transito_unidad_recibida').on('change', function(){
		setMotivoTransitoRecibidaFormulario();
    });
});

function setMotivoTransitoRecibidaFormulario(){
	$("#formulario1 #transito_motivo_recibida").attr('readonly', false);
	$("#formulario1 #reg").attr('disabled', false);
	$("#formulario1 #transito_motivo_recibida").focus();
}

$(document).ready(function() {
	  $('#formulario1 #transito_servicio_enviada').on('change', function(){
			getTransitoEnviadaUnidad();
      });
});

function getTransitoEnviadaUnidad(){
		var servicio_id = $('#formulario1 #transito_servicio_enviada').val();
		var url = '<?php echo SERVERURL; ?>php/atas/getUnidad.php';

		$.ajax({
			type: "POST",
			url: url,
			async: true,
			data:'servicio='+servicio_id,
			success: function(data){
				$('#formulario1 #transito_unidad_enviada').html(data);
			}
		 });
		 return false;
}
$(document).ready(function() {
	$('#formulario1 #transito_unidad_enviada').on('change', function(){
		setMotivoTransitoEnviadaFormulario();
    });
});

function setMotivoTransitoEnviadaFormulario(){
	$("#formulario1 #transito_motivo_enviada").attr('readonly', false);
	$("#formulario1 #reg").attr('disabled', false);
	$("#formulario1 #transito_motivo_enviada").focus();
}

function getServicioTransitoEnviada(){
	var servicio_id = $('#formulario1 #servicio').val();
    var url = '<?php echo SERVERURL; ?>php/atas/getUnidad.php'

    $.ajax({
		 type: "POST",
		 url: url,
		 async: true,
		 data:'servicio='+servicio_id,
		 success: function(data){
			$('#formulario1 #transito_unidad_enviada').html(data);
		}
	});
}

//TRANSITO ENVIADA
$(document).ready(function() {
	  $('#formulario_atas #transito_servicio_recibida1').on('change', function(){
			getTransitoRecibidaServiciosFormularioATAS()
      });
});

function getTransitoRecibidaServiciosFormularioATAS(){
	var servicio_id = $('#transito_servicio_recibida1').val();
	var url = '<?php echo SERVERURL; ?>php/atas/getUnidad.php';

	$.ajax({
		type: "POST",
		url: url,
		async: true,
		data:'servicio='+servicio_id,
		success: function(data){
			$('#formulario_atas #transito_unidad_recibida1').html(data);
		}
	 });
	 return false;
}

function getServicioTransitoRecibida1(){
   var url = '<?php echo SERVERURL; ?>php/atas/servicios_transito.php';
   var servicio_id = $('#formulario_atas #servicio1').val();
   $.ajax({
      type: "POST",
      url: url,
	  async: true,
      data:'servicio='+servicio_id,
      success: function(data){
		$('#formulario_atas #transito_unidad_recibida1').html(data);
    }
  });
}

$(document).ready(function() {
	$('#formulario_atas #transito_unidad_recibida1').on('change', function(){
		setMotivoTransitoRecibidaFormularoATAS();
    });
});

function setMotivoTransitoRecibidaFormularoATAS(){
	$("#formulario_atas #transito_motivo_recibida1").attr('readonly', false);
	$("#edi_ata_por_usuario").attr('disabled', false);
	$("#formulario_atas #transito_motivo_recibida1").focus();
}

$(document).ready(function() {
	  $('#formulario_atas #transito_servicio_enviada1').on('change', function(){
			getTransitoEnviadaServiciosFormularioATAS();
      });
});

function getTransitoEnviadaServiciosFormularioATAS(){
	var servicio_id = $('#transito_servicio_enviada1').val();
	var url = '<?php echo SERVERURL; ?>php/atas/getUnidad.php';

	$.ajax({
		type: "POST",
		url: url,
		async: true,
		data:'servicio='+servicio_id,
		success: function(data){
			$('#formulario_atas #transito_unidad_enviada1').html(data);
		}
	 });
	 return false;
}
$(document).ready(function() {
	$('#formulario_atas #transito_unidad_enviada1').on('change', function(){
		setMotivoTransitoEnviadaFormularioATAS();
    });
});

function setMotivoTransitoEnviadaFormularioATAS(){
	$("#formulario_atas #transito_motivo_enviada1").attr('readonly', false);
	$("#edi_ata_por_usuario").attr('disabled', false);
	$("#formulario_atas #transito_motivo_enviada1").focus();
}

function getServicioTransitoEnviada1(){
   var url = '<?php echo SERVERURL; ?>php/atas/servicios_transito.php';
   var servicio_id = $('#formulario_atas #servicio1').val();

   $.ajax({
     type: "POST",
     url: url,
	 async: true,
     data:'servicio='+servicio_id,
     success: function(data){
	    $('#formulario_atas #transito_unidad_enviada1').html(data);
	}
 });
}

$(document).ready(function() {
	 /*********************************/
	 //FORM AGREGAR REFERENCIAS ENVIADAS
	 getNivelAgregarReferenciasEnviadas();
	 getServicioReferenciasEnviadas();
	 getPatologia1ReferenciasEnviadas();
	 getPatologia2ReferenciasEnviadas();
	 getPatologia3ReferenciasEnviadas();
	 /*********************************/
	 //FORM AGREGAR REFERENCIAS RECIBIDAS
	 getNivelAgregarReferenciasRecibidas();
	 getServicioReferenciasRecibidas();
	 getPatologia1ReferenciasRecibidas();
	 /*********************************/
});

$('#reg_referencias_rc').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_referencias_recibidas #expediente').val() == "" && $('#formulario_agregar_referencias_recibidas #motivo').val() == "" && $('#formulario_agregar_referencias_recibidas #recibidade').val() == "" && $('#formulario_agregar_referencias_recibidas #patologia1').val() == ""){
		 $('#formulario_agregar_referencias_recibidas')[0].reset();
		swal({
			title: 'Error',
			text: 'No se pueden enviar los datos, los campos estan vacíos',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
	 }else{
		e.preventDefault();
		agregarReferenciasRecibidas();
	 }
});

$(document).ready(function(e) {
    $('#formulario_agregar_referencias_recibidas #expediente').on('blur', function(){
	 if($('#formulario_agregar_referencias_recibidas #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/referencias/buscar_expediente.php';
        var expediente = $('#formulario_agregar_referencias_recibidas #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
				swal({
					title: 'Error',
					text: 'Registro no encontrado',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$("#reg_referencias_rc").attr('disabled', true);
				return false;
			  }else if (array[0] == "Error_Temporal"){
				swal({
					title: 'Error',
					text: 'Este es un usuario Temporal, por favor verificar con el área de Admisión',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_agregar_referencias_recibidas #expediente').focus();
				$("#reg_referencias_rc").attr('disabled', true);
				return false;
			  }else if (array[0] == "Familiar"){
				swal({
					title: 'Error',
					text: 'Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_agregar_referencias_recibidas #expediente').focus();
				$("#formulario_agregar_referencias_recibidas #reg").attr('disabled', true);
				return false;
			  }else if (array[0] == "Bien"){
			     $('#formulario_agregar_referencias_recibidas #identidad').val(array[1]);
                 $('#formulario_agregar_referencias_recibidas #nombre').val(array[2]);
                 $("#formulario_agregar_referencias_recibidas #reg").attr('disabled', true);
                 limpiarReferenciasRecibidas();
			  }else{
				swal({
					title: 'Error',
					text: 'Error, no se puede procesar su consulta, intentenlo nuevamente',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_agregar_referencias_recibidas #expediente').focus();
				$("#reg_referencias_rc").attr('disabled', true);
				return false;
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario_agregar_referencias_recibidas')[0].reset();
		$('#formulario_agregar_referencias_recibidas #pro').val("Registro");
        $("#reg_referencias_rc").attr('disabled', true);
	 }
	});
});

function limpiarReferenciasRecibidas(){
	getNivel();
	getServicioReferenciasRecibidas();
	getPatologia1ReferenciasRecibidas();
    getNivelAgregarReferenciasRecibidas();
	getMotivoTraslado();
	getMotivoTrasladoOtro();
	$('#formulario_agregar_referencias_recibidas #pro').val("Registro");
	$("#reg_referencias_rc").attr('disabled', true);
}

function getNivelAgregarReferenciasRecibidas(){

    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_referencias_recibidas #centros_nivel').html("");
			$('#formulario_agregar_referencias_recibidas #centros_nivel').html(data);
        }
     });
}

function getCentroAgregarReferenciasRecibidas(){
   var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
   var nivel = $('#formulario_agregar_referencias_recibidas #centros_nivel').val();

	$.ajax({
        type: "POST",
        url: url,
	    data:'nivel='+nivel,
        success: function(data){
		    $('#formulario_agregar_referencias_recibidas #centro').html("");
			$('#formulario_agregar_referencias_recibidas #centro').html(data);
        }
     });
}

$(document).ready(function() {
	$('#formulario_agregar_referencias_recibidas #centros_nivel').on('change', function(){
		getCentroAgregarReferenciasRecibidas();
    });
});

$(document).ready(function() {
	$('#formulario_agregar_referencias_recibidas #centro').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';

        var nivel = $('#formulario_agregar_referencias_recibidas #centros_nivel').val();
		var centro = $('#formulario_agregar_referencias_recibidas #centro').val();


	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_agregar_referencias_recibidas #recibidade').html("");
			  $('#formulario_agregar_referencias_recibidas #recibidade').html(data);
		  }
	  });
	  return false;
    });
});

function getServicioReferenciasRecibidas(){
    var url = '<?php echo SERVERURL; ?>php/atas/servicios.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_referencias_recibidas #servicio').html("");
			$('#formulario_agregar_referencias_recibidas #servicio').html(data);
		}
     });
}

function getPatologia1ReferenciasRecibidas(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
			$('#formulario_agregar_referencias_recibidas #patologia1').html("");
			$('#formulario_agregar_referencias_recibidas #patologia1').html(data);
		}
   });
   return false;
}

function agregarReferenciasRecibidas(){
	var url = '<?php echo SERVERURL; ?>php/atas/agregarReferenciasRecibidas.php';

   	var fecha = $('#formulario_agregar_referencias_recibidas #fecha').val();
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

  /* if(getMes(fecha)==2){
	swal({
		title: 'Error',
		text: 'No se puede agregar/modificar registros fuera de este periodo',
		type: 'error',
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
	return false;
   }else{*/
   if ( fecha <= fecha_actual){
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_referencias_recibidas').serialize(),
		success: function(registro){
			if (registro == 1){
			    $('#formulario_agregar_referencias_recibidas')[0].reset();
			    $('#formulario_agregar_referencias_recibidas #pro').val('Registro');
                limpiarReferenciasRecibidas();
				swal({
					title: 'Almacenado',
					text: 'Registro almacenado correctamente',
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 2){
                limpiarReferenciasRecibidas();
				swal({
					title: 'Error',
					text: 'Este registro ya existe',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 3){
                limpiarReferenciasRecibidas();
				swal({
					title: 'Error',
					text: 'No se puede guardar la referencia, no existen atenciones del usuario para esta fecha',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 4){
                limpiarReferenciasRecibidas();
				swal({
					title: 'Error',
					text: 'Error al completar el registro',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 5){
                limpiarReferenciasRecibidas();
				swal({
					title: 'Error',
					text: 'Hay registros en blanco o quizás la atención para el servicio seleccionado no es el correcto, por favor verificar antes de continuar',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else{
				limpiarReferenciasRecibidas();
				swal({
					title: "Error",
					text: "Error al procesar su solicitud",
					type: "error",
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}
		}
	});
  }else{
	swal({
		title: 'Error',
		text: 'No se puede agregar/modificar registros fuera de esta fecha',
		type: 'error',
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
	return false;
  }
 //}
}

$(document).ready(function(e) {
    $('#formulario_agregar_referencias_enviadas #expediente').on('blur', function(){
	 if($('#formulario_agregar_referencias_enviadas #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/referencias/buscar_expediente.php';
        var expediente = $('#formulario_agregar_referencias_enviadas #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
				swal({
					title: 'Error',
					text: 'Registro no encontrado',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_agregar_referencias_enviadas #expediente').focus();
				$("#reg_referencias_re").attr('disabled', true);
				return false;
			  }else if (array[0] == "Error_Temporal"){
				swal({
					title: 'Error',
					text: 'Este es un usuario Temporal, por favor verificar con el área de Admisión',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_agregar_referencias_enviadas #expediente').focus();
				$("#reg_referencias_re").attr('disabled', true);
				return false;
			  }else if (array[0] == "Familiar"){
				swal({
					title: 'Error',
					text: 'Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_agregar_referencias_enviadas #expediente').focus();
				$("#reg_referencias_re").attr('disabled', true);
				return false;
			  }else if (array[0] == "Bien"){
			     $('#formulario_agregar_referencias_enviadas #identidad').val(array[1]);
                 $('#formulario_agregar_referencias_enviadas #nombre').val(array[2]);
                 $("#formulario_agregar_referencias_enviadas #reg").attr('disabled', true);
                 limpiarReferenciasEnviadas();
			  }else{
				swal({
					title: 'Error',
					text: 'Error, no se puede procesar su consulta, intentenlo nuevamente',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_agregar_referencias_enviadas #expediente').focus();
				$("#reg_referencias_re").attr('disabled', true);
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario_agregar_referencias_enviadas')[0].reset();
		$('#formulario_agregar_referencias_enviadas #pro').val("Registro");
        $("#reg_referencias_re").attr('disabled', true);
	 }
	});
});

function limpiarReferenciasEnviadas(){
	getNivelAgregarReferenciasEnviadas();
	getServicioReferenciasEnviadas();
	getPatologia1ReferenciasEnviadas();
	getPatologia2ReferenciasEnviadas();
	getPatologia3ReferenciasEnviadas();
	getMotivoTraslado();
	getMotivoTrasladoOtro();
	$('#formulario_agregar_referencias_enviadas #pro').val("Registro");
	$("#reg_referencias_re").attr('disabled', true);
}

function getNivelAgregarReferenciasEnviadas(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_referencias_enviadas #centros_nivel').html("");
			$('#formulario_agregar_referencias_enviadas #centros_nivel').html(data);
        }
     });
}

function getCentroAgregarReferenciasEnviadas(){
   var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
   var nivel = $('#formulario_agregar_referencias_enviadas #centros_nivel').val();

	$.ajax({
        type: "POST",
        url: url,
	    data:'nivel='+nivel,
        success: function(data){
		    $('#formulario_agregar_referencias_enviadas #centro').html("");
			$('#formulario_agregar_referencias_enviadas #centro').html(data);
        }
     });
}

$(document).ready(function() {
	$('#formulario_agregar_referencias_enviadas #centros_nivel').on('change', function(){
		getCentroAgregarReferenciasEnviadas();
    });
});

$(document).ready(function() {
	$('#formulario_agregar_referencias_enviadas #centro').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';

        var nivel = $('#formulario_agregar_referencias_enviadas #centros_nivel').val();
		var centro = $('#formulario_agregar_referencias_enviadas #centro').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_agregar_referencias_enviadas #enviadaa').html("");
			  $('#formulario_agregar_referencias_enviadas #enviadaa').html(data);
		  }
	  });
	  return false;
    });
});

function getServicioReferenciasEnviadas(){
    var url = '<?php echo SERVERURL; ?>php/atas/servicios.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_referencias_enviadas #servicio').html("");
			$('#formulario_agregar_referencias_enviadas #servicio').html(data);
		}
     });
}

function getPatologia1ReferenciasEnviadas(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_referencias_enviadas #patologia1').html("");
				$('#formulario_agregar_referencias_enviadas #patologia1').html(data);
		}
   });
   return false;
}

function getPatologia2ReferenciasEnviadas(){
  var url = '<?php echo SERVERURL; ?>php/atas/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_referencias_enviadas #patologia2').html("");
				$('#formulario_agregar_referencias_enviadas #patologia2').html(data);
		}
   });
   return false;
}

function getPatologia3ReferenciasEnviadas(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_referencias_enviadas #patologia3').html("");
				$('#formulario_agregar_referencias_enviadas #patologia3').html(data);
		}
   });
   return false;
}

$('#reg_referencias_re').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_referencias_enviadas #expediente').val() == "" && $('#formulario_agregar_referencias_enviadas #>').val() == "" && $('#formulario_agregar_referencias_enviadas #enviadaa').val() == "" && $('#formulario_agregar_referencias_enviadas #patologia1').val() == "" && $('#formulario_agregar_referencias_enviadas #motivo_traslado').val() == ""){
		 $('#formulario_agregar_referencias_enviadas')[0].reset();
		swal({
			title: 'Error',
			text: 'No se pueden enviar los datos, los campos estan vacíos',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
	 }else{
		e.preventDefault();
		agregarReferenciasEnviadas();
	 }
});

function agregarReferenciasEnviadas(){
	var url = '<?php echo SERVERURL; ?>php/atas/agregarReferenciasEnviadas.php';

   	var fecha = $('#formulario_agregar_referencias_enviadas #fecha').val();
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

   /*if(getMes(fecha)==2){
		swal({
			title: 'Error',
			text: 'No se puede agregar/modificar registros fuera de este periodo',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	    return false;
   }else{*/
   if ( fecha <= fecha_actual){
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_referencias_enviadas').serialize(),
		success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_referencias_enviadas')[0].reset();
			   $('#formulario_agregar_referencias_enviadas #pro').val('Registro');
                limpiarReferenciasEnviadas();
				swal({
					title: 'Almacenado',
					text: 'Registro almacenado correctamente',
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 2){
			    limpiarReferenciasEnviadas();
				swal({
					title: 'Error',
					text: 'No se puede guardar la referencia, no existen atenciones del usuario para esta fecha',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 3){
			    limpiarReferenciasEnviadas();
				swal({
					title: 'Error',
					text: 'Error al completar el registro',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 4){
			    limpiarReferenciasEnviadas();
				swal({
					title: 'Error',
					text: 'Hay campos vación o se presento un error, por favor corregir',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 5){
			    limpiarReferenciasEnviadas();
				swal({
					title: 'Error',
					text: 'Este Registro ya existe',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else{
			    limpiarReferenciasEnviadas();
				swal({
					title: 'Error',
					text: 'Error al completar su solicitud',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}
		}
	});
  }else{
	swal({
		title: 'Error',
		text: 'No se puede agregar/modificar registros fuera de esta fecha',
		type: 'error',
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});
	return false;
  }
 //}
}

$(document).ready(function() {
	 getServicio();
	 getServicioTransitoEnviadasa();
     getServicioTransitoRecibidasa();
});

function getServicioTransitoEnviadasa(){
    var url = '<?php echo SERVERURL; ?>php/atas/servicios_transito.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_transito_enviada #enviada').html("");
			$('#formulario_transito_enviada #enviada').html(data);
		}
     });
}

$(document).ready(function() {
	  $('#formulario_transito_enviada #enviada').on('change', function(){
		var servicio_id = $('#formulario_transito_enviada #enviada').val();
        var url = '<?php echo SERVERURL; ?>php/atas/getUnidad.php';

		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#formulario_transito_enviada #unidad').html(data);
            }
         });

      });
});

function limpiarTransitoEnviadas(){
	getServicio();
	getServicioTransitoEnviadasa();
	getTipoAtención();
	$("#reg_transito_enviada").attr('disabled', true);
	$('#formulario_transito_enviada #pro').val("Registro");
	$("#reg_transito_enviada").attr('disabled', true);
}

function agregarTransitoEnviadas(){
	var url = '<?php echo SERVERURL; ?>php/referencias/agregarTransitoEnviadas.php';

   	var fecha = $('#formulario_transito_enviada #fecha').val();
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

   if(getMes(fecha)==2){
	swal({
		title: 'Error',
		text: 'No se puede agregar/modificar registros fuera de este periodo',
		type: 'error',
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
		data:$('#formulario_transito_enviada').serialize(),
		success: function(registro){
			if (registro == 1){
			    $('#formulario_transito_enviada')[0].reset();
			    $('#formulario_transito_enviada #pro').val('Registro');
                limpiarTransitoEnviadas();
				swal({
					title: 'Almacenado',
					text: 'Registro almacenado correctamente',
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 2){
				swal({
					title: 'Error',
					text: 'Este registro ya existe',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				limpiarTransitoEnviadas();
			   return false;
			}else{
				swal({
					title: 'Error',
					text: 'Error al completar el registro',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    limpiarTransitoEnviadas();
			    return false;
			}
		}
	});
   }else{
		swal({
			title: 'Error',
			text: 'No se puede agregar/modificar registros fuera de esta fecha',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
   }
  }
}

$(document).ready(function(e) {
    $('#formulario_transito_enviada #expediente').on('blur', function(){
	 if($('#formulario_transito_enviada #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/referencias/buscar_expediente.php';
        var expediente = $('#formulario_transito_enviada #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
				swal({
					title: 'Error',
					text: 'Registro no encontrado',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$("#reg_transito_enviada").attr('disabled', true);
				return false;
			  }else if (array[0] == "Error_Temporal"){
				swal({
					title: 'Error',
					text: 'Este es un usuario Temporal, por favor verificar con el área de Admisión',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_transito_enviada #expediente').focus();
				$("#reg_transito_enviada").attr('disabled', true);
				return false;
			  }else if (array[0] == "Familiar"){
				swal({
					title: 'Error',
					text: 'Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_transito_enviada #expediente').focus();
				$("#formulario_transito_enviada #reg").attr('disabled', true);
				return false;
			  }else if (array[0] == "Bien"){
			      $('#formulario_transito_enviada #identidad').val(array[1]);
                  $('#formulario_transito_enviada #nombre').val(array[2]);
                  $("#reg_transito_enviada").attr('disabled', true);
                 limpiarTransitoEnviadas();
			  }else{
				swal({
					title: 'Error',
					text: 'Error, no se puede procesar su consulta, intentenlo nuevamente',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_transito_enviada #expediente').focus();
				$("#reg_transito_enviada").attr('disabled', true);
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario_transito_enviada')[0].reset();
        $('#formulario_transito_enviada #pro').val("Registro");
        $("#reg_transito_enviada").attr('disabled', true);
	 }
	});
});

$('#reg_transito_enviada').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_transito_enviada #expediente').val() == "" && $('#formulario_transito_enviada #motivo').val() == "" && $('#formulario_transito_enviada #enviadaa').val() == "" && $('#formulario_transito_enviada #patologia1').val() == ""){
		 $('#formulario_transito_enviada')[0].reset();
		swal({
			title: 'Error',
			text: 'No se pueden enviar los datos, los campos estan vacíos',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
	 }else{
		e.preventDefault();
		agregarTransitoEnviadas();
	 }
});

function getServicioTransitoRecibidasa(){
    var url = '<?php echo SERVERURL; ?>php/atas/servicios_transito.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_transito_recibida #recibida').html("");
			$('#formulario_transito_recibida #recibida').html(data);
		}
     });
}

$(document).ready(function() {
	  $('#formulario_transito_recibida #recibida').on('change', function(){
		var servicio_id = $('#formulario_transito_recibida #recibida').val();
        var url = '<?php echo SERVERURL; ?>php/atas/getUnidad.php';

		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#formulario_transito_recibida #unidad').html(data);
            }
         });

      });
});

function limpiarTransitoRecibidas(){
    getServicio();
    getServicioTransitoRecibidasa();
	$('#formulario_transito_recibida #pro').val("Registro");
}

function agregarTransitoRecibidas(){
	var url = '<?php echo SERVERURL; ?>php/referencias/agregarTransitoRecibidas.php';

   	var fecha = $('#formulario_transito_recibida #fecha').val();
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

   if(getMes(fecha)==2){
		swal({
			title: 'Error',
			text: 'No se puede agregar/modificar registros fuera de este periodo',
			type: 'error',
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
		data:$('#formulario_transito_recibida').serialize(),
		success: function(registro){
			if (registro == 1){
			    $('#formulario_transito_recibida')[0].reset();
			    $('#pro').val('Registro');
                limpiarTransitoRecibidas();
				swal({
					title: 'Almacenado',
					text: 'Registro almacenado correctamente',
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
			}else if(registro == 2){
				swal({
					title: 'Error',
					text: 'Este registro ya existe',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    limpiarTransitoRecibidas();
			    return false;
			}else{
				swal({
					title: 'Error',
					text: 'Error al completar el registro',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				limpiarTransitoRecibidas();
			    return false;
			}
		}
	});
   }else{
		swal({
			title: 'Error',
			text: 'No se puede agregar/modificar registros fuera de esta fecha',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	    return false;
   }
  }
}

$(document).ready(function(e) {
    $('#formulario_transito_recibida #expediente').on('blur', function(){
	 if($('#formulario_transito_recibida #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/referencias/buscar_expediente.php';
        var expediente = $('#formulario_transito_recibida #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
				swal({
					title: 'Error',
					text: 'Registro no encontrado',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    $('#formulario_transito_recibida #expediente').focus();
				$("#reg_transito_recibida").attr('disabled', true);
				return false;
			  }else if (array[0] == "Error_Temporal"){
				swal({
					title: 'Error',
					text: 'Este es un usuario Temporal, por favor verificar con el área de Admisión',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    $('#formulario_transito_recibida #expediente').focus();
				$("#reg_transito_recibida").attr('disabled', true);
				return false;
			  }else if (array[0] == "Familiar"){
				swal({
					title: 'Error',
					text: 'Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_transito_recibida #expediente').focus();
				$("#reg_transito_recibida").attr('disabled', true);
				return false;
			  }else if (array[0] == "Bien"){
			     $('#formulario_transito_recibida #identidad').val(array[1]);
                 $('#formulario_transito_recibida #nombre').val(array[2]);
                 $("#reg_transito_recibida").attr('disabled', false);
                 limpiarTransitoRecibidas();
			  }else{
				swal({
					title: 'Error',
					text: 'Error, no se puede procesar su consulta, intentenlo nuevamente',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_transito_recibida #expediente').focus();
				$("#reg_transito_recibida").attr('disabled', true);
				return false;
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario_transito_recibida')[0].reset();
		$('#formulario_transito_recibida #pro').val("Registro");
        $("#reg_transito_recibida").attr('disabled', true);
	 }
	});
});

$('#reg_transito_recibida').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_transito_recibida #expediente').val() == "" && $('#formulario_transito_recibida #motivo').val() == "" && $('#formulario_transito_recibida #recibida').val() == "" && $('#formulario_transito_recibida #unidad').val() == "" && $('#formulario_transito_recibida #patologia1').val() == "" && $('#formulario_transito_recibida #profesional_recibida').val() == "" && $('#formulario_transito_recibida #servicio').val() == ""){
		$('#formulario_transito_recibida')[0].reset();
		swal({
			title: 'Error',
			text: 'No se pueden enviar los datos, los campos estan vacíos',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
	 }else{
		e.preventDefault();
		agregarTransitoRecibidas();
	 }
});


//EVALUA SI EL USUARIO VIENE POR PRIMERA VEZ AL HOSPITAL O ES SUBSIGUIENTE
function getTipoUsuario(expediente, servicio){
    var url = '<?php echo SERVERURL; ?>php/atas/getPaciente.php';

	var paciente;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'expediente='+expediente+'&servicio='+servicio,
		success:function(data){
		   //EVALUA QUE EL PUESTO ES IGUAL A PSIQUIATRIA, ES EL UNICO QUE RECIBE REFERENCIAS
		   if(getPuestoId() == 2 || getPuestoId() == 4){
			  paciente = data;
		   }else{
			  paciente = 'No';
		   }
		}
	});
	return paciente;
}

function getPuestoId(){
    var url = '<?php echo SERVERURL; ?>php/atas/getPuestoId.php';

	var puesto;

	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){
			 puesto = data;
		}
	});
	return puesto;
}

function getPacientesID(expediente){
    var url = '<?php echo SERVERURL; ?>php/atas/getPacienteId.php';

	var pacientes_id;

	$.ajax({
	    type:'POST',
		url:url,
		data:'expediente='+expediente,
		async: false,
		success:function(data){
			 pacientes_id = data;
		}
	});
	return pacientes_id;
}

function getExpediente(expediente){
    var url = '<?php echo SERVERURL; ?>php/atas/getExpediente.php';

	var expediente;

	$.ajax({
	    type:'POST',
		url:url,
		data:'expediente='+expediente,
		async: false,
		success:function(data){
			 expediente = data;
		}
	});
	return expediente;
}

function getColaborador(){
    var url = '<?php echo SERVERURL; ?>php/atas/getColaborador.php';

	var colaborador_id;

	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){
			 colaborador_id = data;
		}
	});
	return colaborador_id;
}

function getAgendaID(expediente, fecha, servicio_id, colaborador_id){
    var url = '<?php echo SERVERURL; ?>php/atas/getAgendaID.php';

	var agenda_id;

	$.ajax({
	    type:'POST',
		url:url,
		data:'expediente='+expediente+'&fecha='+fecha+'&servicio_id='+servicio_id+'&colaborador_id='+colaborador_id,
		async: false,
		success:function(data){
			 agenda_id = data;
		}
	});
	return agenda_id;
}

$(document).ready(function() {
   $('#agregar_referencias_recibidas #servicio').on('change', function(){
        if($('#agregar_referencias_recibidas #centros_nivel').val()!="" && $('#agregar_referencias_recibidas #centro').val()!="" && $('#agregar_referencias_recibidas #recibidade').val()!="" && $('#agregar_referencias_recibidas #patologia1').val()!="" && $('#agregar_referencias_recibidas #servicio').val()!=""){
			 $("#reg_referencias_rc").attr('disabled', false);
		}else{
			swal({
				title: 'Error',
				text: 'Hay registros en blanco, favor corregir',
				type: 'error',
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		}

   });
});

$(document).ready(function() {
   $('#agregar_referencias_enviadas #servicio').on('change', function(){
        if($('#agregar_referencias_enviadas #centros_nivel').val()!="" && $('#agregar_referencias_enviadas #centro').val()!="" && $('#agregar_referencias_enviadas #enviadaa').val()!="" && $('#agregar_referencias_enviadas #patologia1').val()!="" && $('#agregar_referencias_enviadas #servicio').val()!=""){
			 $("#reg_referencias_re").attr('disabled', false);
		}else{
			swal({
				title: 'Error',
				text: 'Hay registros en blanco, favor corregir',
				type: 'error',
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		}

   });
});

$(document).ready(function() {
   $('#registrar_transito_recibida #servicio').on('change', function(){
        if($('#registrar_transito_recibida #recibida').val()!="" && $('#registrar_transito_recibida #unidad').val()!="" && $('#registrar_transito_recibida #servicio').val()!=""){
			 $("#reg_transito_recibida").attr('disabled', false);
		}else{
			swal({
				title: 'Error',
				text: 'Hay registros en blanco, favor corregir',
				type: 'error',
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		}

   });
});

$(document).ready(function() {
   $('#registrar_transito_enviada #servicio').on('change', function(){
        if($('#registrar_transito_enviada #enviada').val()!="" && $('#registrar_transito_enviada #unidad').val()!="" && $('#registrar_transito_enviada #servicio').val()!=""){
			 $("#reg_transito_enviada").attr('disabled', false);
		}else{
			swal({
				title: 'Error',
				text: 'Hay registros en blanco, favor corregir',
				type: 'error',
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		}

   });
});

function getRespuesta(){
    var url = '<?php echo SERVERURL; ?>php/atas/getRespuesta.php';
	var usuario;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){
          usuario = data;
		}
	});
	return usuario;
}

//FUNCION PARA LOS ASEGURADOS DEL IHSS
function getRespuestaFormulario(){
    var url = '<?php echo SERVERURL; ?>php/atas/getRespuesta.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #ihss').html("");
			$('#formulario1 #ihss').html(data);

		    $('#formulario_atas #ihss_ata').html("");
			$('#formulario_atas #ihss_ata').html(data);
		}
     });
}

$(document).ready(function() {
	setInterval('pagination(1)',22000);
	setInterval('evaluarRegistrosPendientes()',1800000 ); //CADA MEDIA HORA
});


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

function evaluarRegistrosPendientes(){
    var url = '<?php echo SERVERURL; ?>php/atas/evaluarPendientes.php';
	var string = '';

	$.ajax({
	    type:'POST',
		data:'fecha='+fecha,
		url:url,
		success: function(valores){
		   var datos = eval(valores);
		   if(datos[0]>0){

			  if(datos[0] == 1 || datos[0] == 0){
				  string = 'Registro pendiente';
			  }else{
				  string = 'Registros pendientes';
			  }

			  swal({
					title: 'Advertencia',
					text: "Se le recuerda que tiene " + datos[0] + " " + string + " de subir al ATA en este mes de " + datos[1] + ". Debe revisar sus registros pendientes.",
					type: 'warning',
					confirmButtonClass: 'btn-warning',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });
		   }

		}
	});
}

function evaluarRegistrosPendientesEmail(){
    var url = '<?php echo SERVERURL; ?>php/mail/evaluarPendientes.php';

	$.ajax({
	    type:'POST',
		url:url,
		success: function(valores){

		}
	});
}

function getEnfermedadad(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getEnfermedad.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #enfermedad').html("");
			$('#formulario1 #enfermedad').html(data);
;
		    $('#formulario_atas #enfermedad1').html("");
			$('#formulario_atas #enfermedad1').html(data);
		}
     });
}

//INICIO TRABAJO SOCIAL
function getTipoAtención(){
    var url = '<?php echo SERVERURL; ?>php/atas/getTipoAtencion.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #tipo_atencion').html("");
			$('#formulario1 #tipo_atencion').html(data);

		    $('#formulario_atas #tipo_atencion1').html("");
			$('#formulario_atas #tipo_atencion1').html(data);

		    $('#formulario_transito_enviada #tipo_atencion_enviadas').html("");
			$('#formulario_transito_enviada #tipo_atencion_enviadas').html(data);

		    $('#formulario1 #tipo_atencion_ata').html("");
			$('#formulario1 #tipo_atencion_ata').html(data);

		    $('#formulario_atas #tipo_atencion_ata1').html("");
			$('#formulario_atas #tipo_atencion_ata1').html(data);
		}
     });
}

function getNivelSocioeconomico(){
    var url = '<?php echo SERVERURL; ?>php/atas/getNivelSocioeconomico.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #nivel_socioeconomico').html("");
			$('#formulario1 #nivel_socioeconomico').html(data);

		    $('#formulario_atas #nivel_socioeconomico1').html("");
			$('#formulario_atas #nivel_socioeconomico1').html(data);
		}
     });
}

function getProblemaSocial(){
    var url = '<?php echo SERVERURL; ?>php/atas/getProblemaSocial.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #problema_social').html("");
			$('#formulario1 #problema_social').html(data);

		    $('#formulario_atas #problema_social1').html("");
			$('#formulario_atas #problema_social1').html(data);
		}
     });
}
//FIN TRABAJO SOCIAL

function getMotivoTraslado(){
    var url = '<?php echo SERVERURL; ?>php/atas/getMotivoTraslado.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario1 #motivo').html("");
			$('#formulario1 #motivo').html(data);

		    $('#formulario1 #motivo_traslado').html("");
			$('#formulario1 #motivo_traslado').html(data);

		    $('#formulario_atas #motivo_traslado1').html("");
			$('#formulario_atas #motivo_traslado1').html(data);

		    $('#formulario_atas #motivo1').html("");
			$('#formulario_atas #motivo1').html(data);

		    $('#agregar_referencias_enviadas #motivo_traslado').html("");
			$('#agregar_referencias_enviadas #motivo_traslado').html(data);

	       $('#formulario_agregar_referencias_recibidas #motivo').html("");
	       $('#formulario_agregar_referencias_recibidas #motivo').html(data);
		}
     });
}

function getMotivoTrasladoOtro(){
    var url = '<?php echo SERVERURL; ?>php/atas/getMotivoTrasladoOtros.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		   $('#formulario1 #motivo_e').html("");
		   $('#formulario1 #motivo_e').html(data);

		   $('#formulario1 #motivo_e1').html("");
		   $('#formulario1 #motivo_e1').html(data);

	       $('#formulario_atas #motivo_re').html("");
	       $('#formulario_atas #motivo_re').html(data);

	       $('#formulario_atas #motivo_e1').html("");
	       $('#formulario_atas #motivo_e1').html(data);

	       $('#formulario_agregar_referencias_enviadas #motivo').html("");
	       $('#formulario_agregar_referencias_enviadas #motivo').html(data);

	       $('#formulario_agregar_referencias_recibidas #motivo1').html("");
	       $('#formulario_agregar_referencias_recibidas #motivo1').html(data);
		}
     });
}

function getPuesto(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getPuesto.php';
	var puesto;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){
          puesto = data;
		}
	});
	return puesto;
}

//PROFESIONAL TRANSITO RECIBIDA
$(document).ready(function() {
	$('#formulario1 #transito_unidad_recibida').on('change', function(){
		 	getProfesionalTransitoRecibida();
    });
});

function getProfesionalTransitoRecibida(){
	var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';

	var servicio = $('#formulario1 #transito_servicio_recibida').val();
	var puesto_id = $('#formulario1 #transito_unidad_recibida').val();

	$.ajax({
	   type:'POST',
	   url:url,
	   data:'puesto_id='+puesto_id+'&servicio='+servicio,
	   success:function(data){
		  $('#formulario1 #transito_profesional_recibida').html("");
		  $('#formulario1 #transito_profesional_recibida').html(data);
		  setMotivoTransitoRecibidaFormulario();
	  }
  });
  return false;
}

$(document).ready(function() {
	$('#formulario_atas #transito_unidad_recibida1').on('change', function(){
		 getTransitoRecibidaUnidadFormularioATAS();
    });
});

function getTransitoRecibidaUnidadFormularioATAS(){
	var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';

	var servicio = $('#formulario_atas #transito_servicio_recibida1').val();
	var puesto_id = $('#formulario_atas #transito_unidad_recibida1').val();

	$.ajax({
	   type:'POST',
	   url:url,
	   data:'puesto_id='+puesto_id+'&servicio='+servicio,
	   success:function(data){
		  $('#formulario_atas #transito_profesional_recibidas1').html("");
		  $('#formulario_atas #transito_profesional_recibidas1').html(data);
		  setMotivoTransitoRecibidaFormularoATAS();
	  }
  });
  return false;
}
$(document).ready(function() {
	$('#formulario_transito_recibida #unidad').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';

        var servicio = $('#formulario_transito_recibida #recibida').val();
		var puesto_id = $('#formulario_transito_recibida #unidad').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'puesto_id='+puesto_id+'&servicio='+servicio,
		   success:function(data){
		      $('#formulario_transito_recibida #profesional_recibida').html("");
			  $('#formulario_transito_recibida #profesional_recibida').html(data);
		  }
	  });
	  return false;
    });
});

//PROFESIONAL TRANSITO ENVIADA
$(document).ready(function() {
	$('#formulario1 #transito_unidad_enviada').on('change', function(){
		 getProfesionalTransitoEnviada();
    });
});

function getProfesionalTransitoEnviada(){
	var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';

	var servicio = $('#formulario1 #transito_servicio_enviada').val();
	var puesto_id = $('#formulario1 #transito_unidad_enviada').val();

	$.ajax({
		   type:'POST',
		   url:url,
		   data:'puesto_id='+puesto_id+'&servicio='+servicio,
		   success:function(data){
			  $('#formulario1 #transito_profesional_enviada').html("");
			  $('#formulario1 #transito_profesional_enviada').html(data);
			  setMotivoTransitoEnviadaFormulario();
		  }
	});
	return false;
}


$(document).ready(function() {
	$('#formulario_atas #transito_unidad_enviada1').on('change', function(){
		 	getTransitoEnviadaProfesionalFormularioATA();
    });
});

function getTransitoEnviadaProfesionalFormularioATA(){
	var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';

	var servicio = $('#formulario_atas #transito_servicio_enviada1').val();
	var puesto_id = $('#formulario_atas #transito_unidad_enviada1').val();

	$.ajax({
	   type:'POST',
	   url:url,
	   data:'puesto_id='+puesto_id+'&servicio='+servicio,
	   success:function(data){
		  $('#formulario_atas #transito_profesional_enviada1').html("");
		  $('#formulario_atas #transito_profesional_enviada1').html(data);
		  setMotivoTransitoEnviadaFormularioATAS();
	  }
  });
  return false;
}
$(document).ready(function() {
	$('#formulario_transito_enviada #unidad').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';

        var servicio = $('#formulario_transito_enviada #enviada').val();
		var puesto_id = $('#formulario_transito_enviada #unidad').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'puesto_id='+puesto_id+'&servicio='+servicio,
		   success:function(data){
		      $('#formulario_transito_enviada #profesional_enviadas').html("");
			  $('#formulario_transito_enviada #profesional_enviadas').html(data);
		  }
	  });
	  return false;
    });
});

function getPatologia1TS(expediente, fecha, servicio_id){
    var url = '<?php echo SERVERURL; ?>php/atas/getPatologiaTS.php';

	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'expediente='+expediente+'&fecha='+fecha+'&servicio_id='+servicio_id,
		success:function(data){
		    var datos = eval(data);
		    $('#formulario_atas #patologia_1').val(datos[0]);
			$('#formulario_atas #patologia_2').val(datos[1]);
			$('#formulario_atas #patologia_3').val(datos[2]);
		    $('#formulario_atas #patologia1').val(datos[0]);
			$('#formulario_atas #patologia2').val(datos[1]);
			$('#formulario_atas #patologia3').val(datos[2]);
		}
	});

}

$(document).ready(function() {
	$('#formulario1 #tipo_atencion').on('change', function(){
		 if($('#formulario1 #tipo_atencion').val() == 2){
			 $('#formulario1 #grupo_cantidades_tipo_atencion').show();
		 }else{
			 $('#formulario1 #grupo_cantidades_tipo_atencion').hide();
		 }
    });
});

$(document).ready(function() {
	$('#formulario_atas #tipo_atencion1').on('change', function(){
		 if($('#formulario_atas #tipo_atencion1').val() == 2){
			 $('#formulario_atas #grupo_cantidades_tipo_atencion1').show();
		 }else{
			 $('#formulario_atas #grupo_cantidades_tipo_atencion1').hide();
		 }
    });
});

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

//EVALUA SI SE SELECCIONA EL RADIO BOTON DE RECETAS EL EL FORMULARIO
//FORMULARIO
//SÍ
$(document).ready(function() {
	$('#formulario1 #receta_si').on('click', function(){
		$("#formulario1 #label_titulo_recetas").html("Recetas");
        $("#reg_ata_form1").attr('disabled', true);
    });
});

//NO
$(document).ready(function() {
	$('#formulario1 #receta_no').on('click', function(){
		$("#formulario1 #label_titulo_recetas").html("");
		$("#reg_ata_form1").attr('disabled', false);
    });
});

//FORMULARIO_ATAS
//SÍ
$(document).ready(function() {
	$('#formulario_atas #receta_si1').on('click', function(){
		$("#formulario_atas #label_titulo_recetas1").html("Recetas");
		$("#edi_ata_por_usuario").attr('disabled', true);
    });
});

//NO
$(document).ready(function() {
	$('#formulario_atas #receta_no1').on('click', function(){
		$("#formulario_atas #label_titulo_recetas1").html("");
		$("#edi_ata_por_usuario").attr('disabled', false);
    });
});

//INICIO ATENCIONES A FAMILIARES
function limpiarAtencionesFamiliares(){
	$('#formulario_atenciones_familiares .nav-tabs li:eq(0) a').tab('show');
	$('#formulario_atenciones_familiares')[0].reset();
	$('#formulario_atenciones_familiares #pro').val("Registro");
	getGenero();
	getResponsable();
	getServicio();
}

function cleanAtencionesFamiliares(){
	$('#formulario_atenciones_familiares .nav-tabs li:eq(0) a').tab('show');
	$('#formulario_atenciones_familiares #pro').val("Registro");
	getGenero();
	getResponsable();
	getServicio();
	cleanFamiliares();
}

function cleanFamiliares(){
    $('#formulario_atenciones_familiares #identidad1').val('');
	$('#formulario_atenciones_familiares #nombre1').val('');
	$('#formulario_atenciones_familiares #responsable1').val('');
	$('#formulario_atenciones_familiares #observaciones1').val('');

    $('#formulario_atenciones_familiares #identidad2').val('');
	$('#formulario_atenciones_familiares #nombre2').val('');
	$('#formulario_atenciones_familiares #responsable2').val('');
	$('#formulario_atenciones_familiares #observaciones2').val('');

    $('#formulario_atenciones_familiares #identidad3').val('');
	$('#formulario_atenciones_familiares #nombre3').val('');
	$('#formulario_atenciones_familiares #responsable3').val('');
	$('#formulario_atenciones_familiares #observaciones3').val('');

    $('#formulario_atenciones_familiares #identidad4').val('');
	$('#formulario_atenciones_familiares #nombre4').val('');
	$('#formulario_atenciones_familiares #responsable4').val('');
	$('#formulario_atenciones_familiares #observaciones4').val('');

    $('#formulario_atenciones_familiares #identidad5').val('');
	$('#formulario_atenciones_familiares #nombre5').val('');
	$('#formulario_atenciones_familiares #responsable5').val('');
	$('#formulario_atenciones_familiares #observaciones5').val('');
}

$(document).ready(function(e) {
    $('#formulario_atenciones_familiares #expediente').on('blur', function(){
	 if($('#formulario_atenciones_familiares #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/atas/buscar_expediente_familiares.php';
        var expediente = $('#formulario_atenciones_familiares #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
				swal({
					title: 'Error',
					text: 'Registro no encontrado',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_atenciones_familiares #expediente').focus();
				$("#reg_atenciones_familiares").attr('disabled', true);
				return false;
			  }else if (array[0] == "Error_Temporal"){
				swal({
					title: 'Error',
					text: 'Este es un usuario Temporal, por favor verificar con el área de Admisión',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_atenciones_familiares #expediente').focus();
				$("#reg_atenciones_familiares").attr('disabled', true);
				return false;
			  }else if (array[0] == "Familiar"){
				swal({
					title: 'Error',
					text: 'Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_atenciones_familiares #expediente').focus();
				$("#reg_atenciones_familiares").attr('disabled', true);
				return false;
			  }else if (array[0] == "Bien"){
                 $('#formulario_atenciones_familiares #nombre').val(array[1]);
				 $('#formulario_atenciones_familiares #identidad').val(array[2]);
                 $("#reg_atenciones_familiares").attr('disabled', false);
                 $('#formulario_atenciones_familiares #obs').focus();
                 cleanAtencionesFamiliares();
			  }else{
				swal({
					title: 'Error',
					text: 'Error, no se puede procesar su consulta, intentenlo nuevamente',
					type: 'error',
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_atenciones_familiares #expediente').focus();
				$('#formulario_atenciones_familiares #identidad').val(array[1]);
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario_atenciones_familiares')[0].reset();
        $('#formulario_atenciones_familiares #pro').val("Registro");
        $("#reg_atenciones_familiares").attr('disabled', true);
	 }
	});
});

$(document).ready(function() {
	$('#formulario_atenciones_familiares #servicio').on('change', function(){
           if($('#formulario_atenciones_familiares #servicio') != ""){
               $("#reg_atenciones_familiares").attr('disabled', false);
		   }else{
			   $("#reg_atenciones_familiares").attr('disabled', true);
		   }
    });
});

$('#reg_seguimiento').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	if($('#formulario_seguimiento #identidad').val() != "" && $('#formulario_seguimiento #nombres').val() != "" && $('#formulario_seguimiento #apellidos').val() != "" && $('#formulario_seguimiento #telefono').val() != "" && $('#formulario_seguimiento #departamento').val() != "" && $('#formulario_seguimiento #municipio').val() != "" && $('#formulario_seguimiento #localidad').val() != "" && $('#formulario_seguimiento #comentario_seguimiento').val() != "" && $('#formulario_seguimiento #genero').val() != "" && $('#formulario_seguimiento #seguimiento').val() != ""){
		e.preventDefault();
		agregaSeguimiento();
	}else{
		swal({
			title: 'Error',
			text: 'Hay registros en blanco, por favor corregir',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
	}
});

$('#reg_atenciones_familiares').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_atenciones_familiares #expediente').val() != "" && $('#formulario_atenciones_familiares #identidad1').val() != "" && $('#formulario_atenciones_familiares #nombre1').val() != "" && $('#formulario_atenciones_familiares #responsable1').val() != "" && $('#formulario_atenciones_familiares #servicio').val() != "" && $('#formulario_atenciones_familiares #observaciones1').val() != "" && $('#formulario_atenciones_familiares #genero1').val() != ""){
		 e.preventDefault();
		 agregaRegistroFamiliares();
		return false;
	 }else{
		swal({
			title: 'Error',
			text: 'No se pueden enviar los datos, los campos estan vacíos',
			type: 'error',
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		$('#formulario_atenciones_familiares #pro').val('Registro');
        return false;
	 }
});

function agregaRegistroFamiliares(){
if($('#formulario_atenciones_familiares #expediente').val() != "" && $('#formulario_atenciones_familiares #obs').val() != "" && $('#formulario_atenciones_familiares #identidad1').val() != "" && $('#formulario_atenciones_familiares #nombre1').val() != "" && $('#formulario_atenciones_familiares #responsable1').val() != "" && $('#formulario_atenciones_familiares #genero1').val() != "" && $('#formulario_atenciones_familiares #observaciones1').val() != "" && $('#formulario_atenciones_familiares #servicio').val() != ""){
    var fecha = $('#formulario_atenciones_familiares #fecha').val();
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

	var url = '<?php echo SERVERURL; ?>php/atas/agregar_atenciones_familiares.php';

    if ($('#formulario_atenciones_familiares #expediente').val() == "" || $('#formulario_atenciones_familiares #expediente').val()==0){
			swal({
				title: 'Error',
				text: 'El número de expediente no puede quedar en blanco o ser igual a cero',
				type: 'error',
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
			return false;
	}else{
	  if(getMes(fecha)==2){
				swal({
					title: 'Error',
					text: 'No se puede agregar/modificar registros fuera de este periodo',
					type: 'error',
					confirmButtonClass: 'btn-danger'
					
				});
		       return false;
		   }else{
	        if ( fecha <= fecha_actual){
	           $.ajax({
		          type:'POST',
		          url:url,
		          data:$('#formulario_atenciones_familiares').serialize(),
		          success: function(registro){
                      if(registro == 1){
						swal({
							title: 'Error',
							text: 'Su sesión ha vencido, por favor inicie sesión nuevamente',
							type: 'error',
							confirmButtonClass: 'btn-danger'
						});
						return false;
					  }else if(registro == 2){
			                $('#formulario_atenciones_familiares')[0].reset();
							swal({
								title: 'Success',
								text: 'Registro almacenado correctamente',
								type: "success",
								timer: 3000, //timeOut for auto-close
							});
							$('#agregar_atenciones_familiares').modal('hide');
						    limpiarAtencionesFamiliares();
			                return false;
					  }else if(registro == 3){
						swal({
							title: 'Error',
							text: 'Error en almacenar este registro',
							type: 'error',
							confirmButtonClass: 'btn-danger'
						});
					  }else if(registro == 4){
							swal({
								title: 'Error',
								text: 'Este usuario ya ha sido almacenado con anterioridad',
								type: 'error',
								confirmButtonClass: 'btn-danger'
							});
					  }else if(registro == 5){
							swal({
								title: 'Error',
								text: 'Lo sentimos, no existe atención almacenada para este usuario',
								type: 'error',
								confirmButtonClass: 'btn-danger'
							});
					  }else{
							swal({
								title: 'Error',
								text: 'No se puedo almacenar el registro favor interntar mas tarde',
								type: 'error',
								confirmButtonClass: 'btn-danger'
							});
						  return false;
					  }
		         }
	          });
	          return false;
	        }else{
				swal({
					title: 'Error',
					text: 'No se puede agregar/modificar registros fuera de esta fecha',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
	           $('#formulario_atenciones_familiares')[0].reset();
		       return false;
	        }
		   }
	      }
}else{
	swal({
		title: 'Error',
		text: 'No se puede guardar el registro, debe comunicarse el área de admisión, para actualizar los datos del usuario',
		type: 'error',
		confirmButtonClass: 'btn-danger'
	});
	return false;
 }
}

function getGenero(){
  var url = '<?php echo SERVERURL; ?>php/atas/getGenero.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_atenciones_familiares #genero1').html("");
				$('#formulario_atenciones_familiares #genero1').html(data);

				$('#formulario_atenciones_familiares #genero2').html("");
				$('#formulario_atenciones_familiares #genero2').html(data);

				$('#formulario_atenciones_familiares #genero3').html("");
				$('#formulario_atenciones_familiares #genero3').html(data);

				$('#formulario_atenciones_familiares #genero4').html("");
				$('#formulario_atenciones_familiares #genero4').html(data);

				$('#formulario_atenciones_familiares #genero5').html("");
				$('#formulario_atenciones_familiares #genero5').html(data);
		}
   });
   return false;
}

function getResponsable(){
  var url = '<?php echo SERVERURL; ?>php/atas/getResponsable.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_atenciones_familiares #responsable1').html("");
				$('#formulario_atenciones_familiares #responsable1').html(data);

				$('#formulario_atenciones_familiares #responsable2').html("");
				$('#formulario_atenciones_familiares #responsable2').html(data);

				$('#formulario_atenciones_familiares #responsable3').html("");
				$('#formulario_atenciones_familiares #responsable3').html(data);

				$('#formulario_atenciones_familiares #responsable4').html("");
				$('#formulario_atenciones_familiares #responsable4').html(data);

				$('#formulario_atenciones_familiares #responsable5').html("");
				$('#formulario_atenciones_familiares #responsable5').html(data);
		}
   });
   return false;
}

function limpiarCuestionario(){
	$('#formulario_cuestionario_maida .nav-tabs li:eq(0) a').tab('show');
	$('#formulario_cuestionario_maida #pro').val("Registro");
	$('#formulario_cuestionario_maida #expediente').focus();
	getServicio();
	hidePreguntas();
	getPatologia1();
}

/*INICIO RADIO BOTON*/
//INICIO PREGUNTA CINDO
$(document).ready(function() {
	$('#formulario_cuestionario_maida #maida_p5_si').on('click', function(){
		$("#formulario_cuestionario_maida #patologia_cuestionario").show();
    });
});

$(document).ready(function() {
	$('#formulario_cuestionario_maida #maida_p5_no').on('click', function(){
		$("#formulario_cuestionario_maida #patologia_cuestionario").hide();
    });
});


//INICIO PREGUNTA uno
$(document).ready(function() {
	$('#formulario_cuestionario_maida #maida_p1_si').on('click', function(){
		showPreguntas();
    });
});

$(document).ready(function() {
	$('#formulario_cuestionario_maida #maida_p1_no').on('click', function(){
		hidePreguntas();
    });
});
/*INICIO RADIO BOTON*/

function showPreguntas(){
	$("#formulario_cuestionario_maida #cuestionario_maida_p2").show();
	$("#formulario_cuestionario_maida #cuestionario_maida_p3").show();
}

function hidePreguntas(){
	$("#formulario_cuestionario_maida #cuestionario_maida_p2").hide();
	$("#formulario_cuestionario_maida #cuestionario_maida_p3").hide();
	$('#formulario_cuestionario_maida #maida_p1_no').prop('checked', true);
}

$(document).ready(function(e) {
    $('#formulario_cuestionario_maida #expediente').on('blur', function(){
	 if($('#formulario_cuestionario_maida #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/referencias/buscar_expediente.php';
        var expediente = $('#formulario_cuestionario_maida #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
				swal({
					title: 'Error',
					text: 'Registro no encontrado',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				$('#formulario_cuestionario_maida #expediente').focus();
				$("#reg_cuestionario").attr('disabled', true);
				return false;
			  }else if (array[0] == "Error_Temporal"){
				swal({
					title: 'Error',
					text: 'Este es un usuario Temporal, por favor verificar con el área de Admisión',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				$('#formulario_cuestionario_maida #expediente').focus();
				$("#reg_cuestionario").attr('disabled', true);
				return false;
			  }else if (array[0] == "Familiar"){
				swal({
					title: 'Error',
					text: 'Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				$('#formulario_cuestionario_maida #expediente').focus();
				$("#reg_cuestionario").attr('disabled', true);
				return false;
			  }else if (array[0] == "Bien"){
			     $('#formulario_cuestionario_maida #identidad').val(array[1]);
                 $('#formulario_cuestionario_maida #nombre').val(array[2]);
                 $('#formulario_cuestionario_maida #mensaje')
                 $("#reg_cuestionario").attr('disabled', false);
                 limpiarReferenciasRecibidas();
			  }else{
				swal({
					title: 'Error',
					text: 'Error, no se puede procesar su consulta, intentenlo nuevamente',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				$('#formulario_cuestionario_maida #expediente').focus();
				$("#reg_cuestionario").attr('disabled', true);
				return false;
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario_cuestionario_maida')[0].reset();
		$('#formulario_cuestionario_maida #pro').val("Registro");
        $("#reg_cuestionario").attr('disabled', true);
	 }
	});
});

$('#reg_cuestionario').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_cuestionario_maida #expediente').val() != "" && $('#formulario_cuestionario_maida #identidad1').val() != "" && $('#formulario_cuestionario_maida #nombre1').val() != "" && $('#formulario_cuestionario_maida #obs').val() != ""){
		 e.preventDefault();
		 agregaRegistroCuestionario();
		return false;
	 }else{
		swal({
			title: 'Error',
			text: 'No se pueden enviar los datos, los campos estan vacíos',
			type: 'error',
			confirmButtonClass: 'btn-danger'
		});
        $('#formulario_cuestionario_maida #pro').val('Registro');
        return false;
	 }
});

$('#reg_ata_manual').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 alert("estas aqui");
	 if ($('#formulario_ata_manual #expediente_ata').val() != "" && $('#formulario_ata_manual #paciente_ata').val() != "" && $('#formulario_ata_manual #patologia_ata1').val() != "" && $('#formulario_ata_manual #servicio_ata').val() != "" && $('#formulario_ata_manual #unidad_ata').val() != "" && $('#formulario_ata_manual #colaborador_ata').val() != ""){
		 e.preventDefault();
		 agregaATA_Manual();
		return false;
	 }else{
		swal({
			title: 'Error',
			text: 'No se pueden enviar los datos, los campos estan vacíos',
			type: 'error',
			confirmButtonClass: 'btn-danger'
		});
        $('#formulario_ata_manual #pro').val('Registro');
        return false;
	 }
});


function agregaRegistroCuestionario(){
if($('#formulario_cuestionario_maida #expediente').val() != "" && $('#formulario_cuestionario_maida #obs').val() != ""){
    var fecha = $('#formulario_cuestionario_maida #fecha').val();
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

	var url = '<?php echo SERVERURL; ?>php/atas/agregar_cuestionario_maida.php';

    if ($('#formulario_cuestionario_maida #expediente').val() == "" || $('#formulario_cuestionario_maida #expediente').val()==0){
			swal({
				title: 'Error',
				text: 'El número de expediente no puede quedar en blanco o ser igual a cero',
				type: 'error',
				confirmButtonClass: 'btn-danger'
			});
			return false;
	}else{
	  if(getMes(fecha)==2){
			swal({
				title: 'Error',
				text: 'No se puede agregar/modificar registros fuera de este periodo',
				type: 'error',
				confirmButtonClass: 'btn-danger'
			});
		    return false;
	 }else{
	    if ( fecha <= fecha_actual){
	        $.ajax({
	            type:'POST',
		        url:url,
		        data:$('#formulario_cuestionario_maida').serialize(),
		        success: function(registro){
                   if(registro == 1){
		              $('#formulario_cuestionario_maida')[0].reset();
					swal({
						title: 'Success',
						text: 'Registro almacenado correctamente',
						type: "success",
						timer: 3000, //timeOut for auto-close
					});
					$('#agregar_cuestionario_maida').modal('hide');
					impiarCuestionario();
			        return false;
				   }else if(registro == 2){
						swal({
							title: 'Error',
							text: 'Error en almacenar este registro',
							type: 'error',
							confirmButtonClass: 'btn-danger'
						});
						return false;
					  }else if(registro == 3){
						swal({
							title: 'Error',
							text: 'Su sesión ha vencido, por favor inicie sesión nuevamente',
							type: 'error',
							confirmButtonClass: 'btn-danger'
						});
						return false;
					  }else if(registro == 4){
						swal({
							title: 'Error',
							text: 'Este usuario ya ha sido almacenado con anterioridad',
							type: 'error',
							confirmButtonClass: 'btn-danger'
						});
						return false;
					  }else{
						swal({
							title: 'Error',
							text: 'No se puedo almacenar el registro favor interntar mas tarde',
							type: 'error',
							confirmButtonClass: 'btn-danger'
						});
						return false;
					  }
		         }
	          });
	          return false;
	        }else{
				swal({
					title: 'Error',
					text: 'No se puede agregar/modificar registros fuera de esta fecha',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
	            $('#formulario_cuestionario_maida')[0].reset();
		        return false;
	        }
		   }
	      }
}else{
		swal({
			title: 'Error',
			text: 'No se puede guardar el registro, debe comunicarse el área de admisión, para actualizar los datos del usuario',
			type: 'error',
			confirmButtonClass: 'btn-danger'
		});
	   return false;
 }
}
/*FIN CUESTIONARIO PARA USUARIOS EGRESADOS DE MAIDA*/

//INICIO AGREGAR ATA MANUAL
function agregaATA_Manual(){
	var url = '<?php echo SERVERURL; ?>php/atas/agregar_ATA_Manual.php';

	$.ajax({
	    type:'POST',
	    url:url,
	    data:$('#formulario_ata_manual').serialize(),
	    success: function(registro){
            if(registro == 1){
	            $('#formulario_ata_manual')[0].reset();
				swal({
					title: "Success",
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000, //timeOut for auto-close
				});
		    	limpiarATA_Manual();
                $('#formulario_ata_manual #expediente_ata').focus();
		        return false;
			}else if(registro == 2){
				swal({
					title: "Error",
					text: "Error al almacenar este registro, hay datos erróneos",
					type: "error",
					confirmButtonClass: "btn-danger"
				});
			}else if(registro == 3){
				swal({
					title: 'Error',
					text: 'Este usuario ya ha sido almacenado no se puede repetir el registro',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
			}else if(registro == 4){
				swal({
					title: 'Error',
					text: 'Lo sentimos hay registros en blanco, por favor actualice el Departamento, Municipio y Genero para este usuario desde el módulo de pacientes',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
			}else{
				swal({
					title: 'Error',
					text: 'No se puedo almacenar el registro favor interntar mas tarde',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				return false;
			}
		}
	});
	return false;
 }
//FIN AGREGAR ATA MANUAL

function getServicioATA_Manual(){
    var url = '<?php echo SERVERURL; ?>php/atas/servicios_ata_manual.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_ata_manual #servicio_ata').html("");
			$('#formulario_ata_manual #servicio_ata').html(data);
        }
     });
}

$(document).ready(function() {
	$('#formulario_ata_manual #servicio_ata').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/atas/getUnidad.php';
        var servicio = $('#formulario_ata_manual #servicio_ata').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'servicio='+servicio,
		   success:function(data){
		      $('#formulario_ata_manual #unidad_ata').html("");
			  $('#formulario_ata_manual #unidad_ata').html(data);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario_ata_manual #unidad_ata').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/reportes_depurados/getMedico.php';
        var servicio = $('#formulario_ata_manual #servicio_ata').val();
        var puesto_id = $('#formulario_ata_manual #unidad_ata').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'servicio='+servicio+'&puesto_id='+puesto_id,
		   success:function(data){
		      $('#formulario_ata_manual #colaborador_ata').html("");
			  $('#formulario_ata_manual #colaborador_ata').html(data);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario_ata_manual #colaborador_ata').on('change', function(){
		 $("#formulario_ata_manual #reg_ata_manual").attr('disabled', false);
		 $("#formulario_ata_manual #observacion_ata").focus();
    });
});

$(document).ready(function(e) {
    $('#formulario_ata_manual #expediente_ata').on('blur', function(){
	 if($('#formulario_ata_manual #expediente_ata').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/referencias/buscar_expediente.php';
        var expediente = $('#formulario_ata_manual #expediente_ata').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
				swal({
					title: 'Error',
					text: 'Registro no encontrado',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				$('#formulario_ata_manual #expediente_ata').focus();
				$('#formulario_ata_manual #reg_ata_manual').attr('disabled', true);
				return false;
			  }else if (array[0] == "Error_Temporal"){
				swal({
					title: 'Error',
					text: 'Este es un usuario Temporal, por favor verificar con el área de Admisión',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				$("#formulario_ata_manual #reg_ata_manual").attr('disabled', true);
				return false;
			  }else if (array[0] == "Familiar"){
				swal({
					title: 'Error',
					text: 'Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				$('#formulario_ata_manual #expediente_ata').focus();
				$('#formulario_ata_manual #reg_ata_manual').attr('disabled', true);
				return false;
			  }else if (array[0] == "Bien"){
			     $('#formulario_ata_manual #identidad_ata').val(array[1]);
                 $('#formulario_ata_manual #nombre_ata').val(array[2]);
                 $('#formulario_ata_manual #reg_ata_manual').attr('disabled', true);
                 limpiarATA_Manual();
			  }else{
				swal({
					title: 'Error',
					text: 'Error, no se puede procesar su consulta, intentenlo nuevamente',
					type: 'error',
					confirmButtonClass: 'btn-danger'
				});
				$('#formulario_ata_manual #expediente_ata').focus();
				$('#formulario_ata_manual #reg_ata_manual').attr('disabled', true);
				return false;
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario_ata_manual')[0].reset();
		$('#formulario_ata_manual #pro_ata').val("Registro");
        $('#formulario_ata_manual #reg_ata_manual').attr('disabled', true);
	 }
	});
});

$(document).ready(function() {
	$('#formulario_ata_manual #servicio_ata').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/atas/buscar_usuario_ata.php';
        var expediente = $('#formulario_ata_manual #expediente_ata').val();
        var servicio = $('#formulario_ata_manual #servicio_ata').val();
        var fecha = $('#formulario_ata_manual #fecha_ata').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente+'&servicio='+servicio,
		   success:function(data){
			  var array = eval(data);
			  $('#formulario_ata_manual #paciente_ata').val(array[0]);
		  }
	  });
	  return false;
    });
});

function limpiarATA_Manual(){
	getServicioATA_Manual();
	getPatologia1();
	getPatologia2();
	getPatologia3();
	$('#formulario_ata_manual #pro_ata').val('Registro');
	$('#formulario_ata_manual #primera_si').prop('checked', false); //DESELECCIONA UN CHECK BOX
	$('#formulario_ata_manual #primera_no').prop('checked', true); //DESELECCIONA UN CHECK BOX	
}

function getEstado(){
    var url = '<?php echo SERVERURL; ?>php/atas/getEstado.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #estado').html("");
			$('#form_main #estado').html(data);
		}
     });
}

function getProgramarCita(){
    var url = '<?php echo SERVERURL; ?>php/atas/getProgramarCita.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_atas #programar_cita_1').html("");
			$('#formulario_atas #programar_cita_1').html(data);

		    $('#formulario1 #programar_cita').html("");
			$('#formulario1 #programar_cita').html(data);
		}
     });
}

function getEstadoAtencion(agenda_id){
    var url = '<?php echo SERVERURL; ?>php/atas/getEstadoAtencion.php';
	var estado_atencion;
	$.ajax({
	    type:'POST',
		url:url,
		data:'agenda_id='+agenda_id,
		async: false,
		success:function(data){
          estado_atencion = data;
		}
	});
	return estado_atencion;
}

$(document).ready(function() {
	$('#formulario_atas #programar_cita_1').on('change', function(){
		  if($('#formulario_atas #programar_cita_1').val() != 0){
		     $('#formulario_atas #label_programar_cita_1').html("Comentario");
			 $('#formulario_atas #otros_programar_cita_1').show();
			 $('#formulario_atas #otros_programar_cita_1').val('');
			 $('#formulario_atas #otros_programar_cita_1').focus();
	     }else{
		    $('#formulario_atas #otros_programar_cita_1').hide();
			$('#formulario_atas #label_programar_cita_1').html("");
			$('#formulario_atas #otros_programar_cita_1').val('');
	     }
    });

	$('#formulario1 #programar_cita').on('change', function(){
         if($('#formulario1 #programar_cita').val() != 0){
			  $('#formulario1 #label_programar_cita').html("Comentario");
		      $('#formulario1 #otros_programar_cita').show();
			  $('#formulario1 #otros_programar_cita').val('');
			  $('#formulario1 #otros_programar_cita').focus();
	     }else{
		     $('#formulario1 #otros_programar_cita').hide();
			 $('#formulario1 #label_programar_cita').html("");
			 $('#formulario1 #otros_programar_cita').val('');
			 $('#formulario1 #label_programar_cita').html("");
	     }
    });
})

function consultarCitaUsuario(agenda_id,){
    var url = '<?php echo SERVERURL; ?>php/atas/getConsultaCita.php';
	var cita;
	$.ajax({
	    type:'POST',
		url:url,
		data:'agenda_id='+agenda_id,
		async: false,
		success:function(data){
          cita = data;
		}
	});
	return cita;
}

function getMedicamentos(){
    var url = '<?php echo SERVERURL; ?>php/postclinica/getMedicamentos.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_receta_medica #medicamento1').html("");
			$('#formulario_receta_medica #medicamento1').html(data);

		    $('#formulario_receta_medica #medicamento2').html("");
			$('#formulario_receta_medica #medicamento2').html(data);

		    $('#formulario_receta_medica #medicamento3').html("");
			$('#formulario_receta_medica #medicamento3').html(data);

		    $('#formulario_receta_medica #medicamento4').html("");
			$('#formulario_receta_medica #medicamento4').html(data);

		    $('#formulario_receta_medica #medicamento5').html("");
			$('#formulario_receta_medica #medicamento5').html(data);
		}
     });
}

function seguimientoUsuarios(pacientes_id, agenda_id){
	var url = '<?php echo SERVERURL; ?>php/atas/editarSeguimento.php';

	$.ajax({
	type:'POST',
	url:url,
	data:'pacientes_id='+pacientes_id+'&agenda_id='+agenda_id,
	success: function(valores){
			var datos = eval(valores);
			$('#formulario_seguimiento #pro').val('Edicion');
			$('#formulario_seguimiento #id-registro').val(id);
			$('#formulario_seguimiento #nombres').val(datos[0]);
			$('#formulario_seguimiento #apellidos').val(datos[1]);
			$('#formulario_seguimiento #identidad').val(datos[2]);
            $('#formulario_seguimiento #fecha_n').val(datos[3]);
			$('#formulario_seguimiento #telefono').val(datos[4]);
			$('#formulario_seguimiento #departamento').val(datos[5]);
            getMunicipioEditar(datos[5], datos[6]);
			$('#formulario_seguimiento #localidad').val(datos[7]);
			$('#formulario_seguimiento #genero').val(datos[8]);
            $('#formulario_seguimiento #fecha_n').attr('readonly', true);
			$('#formulario_seguimiento .nav-tabs li:eq(0) a').tab('show');
			//HABILITAR VALORES DE SOLO LECTURA
			$('#formulario_seguimiento #identidad').attr('readonly', true);
			$('#formulario_seguimiento #nombres').attr('readonly', true);
			$('#formulario_seguimiento #apellidos').attr('readonly', true);
			$('#formulario_seguimiento #fecha').attr('readonly', true);
			$('#formulario_seguimiento #fecha_n').attr('readonly', true);
			$('#formulario_seguimiento #telefono').attr('readonly', true);
			$('#formulario_seguimiento #localidad').attr('readonly', true);
			//DESHABILITAR
			$("#formulario_seguimiento #departamento").attr('readonly', true);
			$("#formulario_seguimiento #municipio").attr('readonly', true);


			$('#modal_seguimiento').modal({
		      show:true,
		      backdrop:'static'
	        });
		return false;
	}
	});
	return false;
}

function getMunicipioEditar(departamento_id, municipio_id){
	var url = '<?php echo SERVERURL; ?>php/pacientes/getMunicipio.php';

	var departamento_id = $('#formulario_seguimiento #departamento').val();

	$.ajax({
	   type:'POST',
	   url:url,
	   data:'departamento_id='+departamento_id,
	   success:function(data){
	      $('#formulario_seguimiento #municipio').html("");
		  $('#formulario_seguimiento #municipio').html(data);
		  $('#formulario_seguimiento #municipio').val(municipio_id);
	  }
	});
	return false;
}

function cleanSeguimiento(){
	$('#formulario_seguimiento .nav-tabs li:eq(0) a').tab('show');
	$('#formulario_seguimiento #ansioso').prop('checked', false);
	$('#formulario_seguimiento #depresivo').prop('checked', false);
	$('#formulario_seguimiento #psicotico').prop('checked', false);
	$('#formulario_seguimiento #agitacion').prop('checked', false);
	$('#formulario_seguimiento #pro').val("Registro");
	getAtencionSeguimiento();
	getDepartamento();
	$('#formulario_seguimiento #identidad').val(0);
	$('#formulario_seguimiento #nombres').val("");
	$('#formulario_seguimiento #apellidos').val("");
	$('#formulario_seguimiento #telefono').val("");
	$('#formulario_seguimiento #localidad').val("");
	$('#formulario_seguimiento #otros_especifique').val("");
	$('#formulario_seguimiento #conducta_especifique').val("");
	$('#formulario_seguimiento #comentario_seguimiento').val("");
}

function getAtencionSeguimiento(){
    var url = '<?php echo SERVERURL; ?>php/atas/getAtencionSeguimiento.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_seguimiento #seguimiento').html("");
			$('#formulario_seguimiento #seguimiento').html(data);
		}
     });
}

function getDepartamento(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getDepartamento.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_seguimiento #departamento').html("");
			$('#formulario_seguimiento #departamento').html(data);
		}
     });
}

$(document).ready(function() {
	$('#formulario_seguimiento #departamento').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/pacientes/getMunicipio.php';

		var departamento_id = $('#formulario_seguimiento #departamento').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'departamento_id='+departamento_id,
		   success:function(data){
		      $('#formulario_seguimiento #municipio').html("");
			  $('#formulario_seguimiento #municipio').html(data);
		  }
	  });
	  return false;
    });
});

function getSexo(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getSexo.php';

	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_seguimiento #genero').html("");
			$('#formulario_seguimiento #genero').html(data);
		}
     });
}

$(document).ready(function(){
  $('#formulario_seguimiento #telefono').on('blur', function(e){
      if($("#formulario_seguimiento #telefono").val().length != 8) {
		$("#formulario_seguimiento #telefono").css("border-color", "red");
        $("#formulario_seguimiento #telefono").focus();
        return false;
      }else{
		$("#formulario_seguimiento #telefono").css("border-color", "none");
	  }
  });
});

$('#formulario_seguimiento #comentario_seguimiento').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;

		$('#formulario_seguimiento #charNum_seguimiento').html(diff + ' Caracteres');

		if(diff == 0){
			return false;
		}
});


//INICIO ENTREVISTA TRABAJO SOCIAL
/*
ENTIDADES UTILIZADAS PARA ESTE FORMULARIO
1. entrevista_modalidad
2. entrevista
3. tipologia
4. clasificacion_diagnostica
*/
$(document).ready(function() {
    cleanEntrevistaTS();
});

function agregarEntrevistaTS(pacientes_id, servicio_id, expediente){
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 9 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		var url = '<?php echo SERVERURL; ?>php/atas/buscar_expediente_entrevista.php';
		$.ajax({
			type:'POST',
			url:url,
			data:'expediente='+expediente,
			success: function(valores){
				var datos = eval(valores);
				$('#formulario_entrevista_trabajo_social .nav-tabs li:eq(0) a').tab('show');
				$('#formulario_entrevista_trabajo_social')[0].reset();
				$('#formulario_entrevista_trabajo_social #pro_entrevista').val("Registro");
				$('#formulario_entrevista_trabajo_social #id-registro').val(id);
				$('#formulario_entrevista_trabajo_social #expediente').attr('readonly', true);
				$('#formulario_entrevista_trabajo_social #expediente').val(expediente);
				$('#formulario_entrevista_trabajo_social #nombre').val(datos[2]);
				$('#formulario_entrevista_trabajo_social #pacientes_id').val("pacientes_id");
				$('#formulario_entrevista_trabajo_social #servicio_id').val(servicio_id);
				$('#formulario_entrevista_trabajo_social #grupo_servicio').hide();
				$('#formulario_entrevista_trabajo_social #entrevistado').focus();
				$('#formulario_entrevista_trabajo_social').attr({'data-form': 'save'});
				$('#formulario_entrevista_trabajo_social').attr({'action': '<?php echo SERVERURL; ?>php/atas/agregarEntrevistaTS.php'});
				$('#modal_entrevista_trabajo_social').modal({
					show:true,
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
			confirmButtonClass: 'btn-danger'
	  });
	 }
}

$(document).ready(function(e) {
    $('#formulario_entrevista_trabajo_social #expediente').on('blur', function(){
	 if($('#formulario_entrevista_trabajo_social #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/atas/buscar_expediente_entrevista.php';
        var expediente = $('#formulario_entrevista_trabajo_social #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  $('#formulario_entrevista_trabajo_social #pacientes_id').val(array[0]);
			  $('#formulario_entrevista_trabajo_social #nombre').val(array[2]);
              $('#formulario_entrevista_trabajo_social #reg').attr('disabled', false);
		   },
		   error:function(error){
				swal({
					title: "Error",
					text: "No al procesar su solicitud, por favor intentelo de nuevo",
					type: "error",
					confirmButtonClass: "btn-danger"
				});
                $('#formulario_entrevista_trabajo_social #reg').attr('disabled', true);
		   }
	  });
	  return false;
	 }else{
		$('#formulario_entrevista_trabajo_social')[0].reset();
		$('#formulario_entrevista_trabajo_social #pro_entrevista').val("Registro");
        $('#formulario_entrevista_trabajo_social #reg').attr('disabled', true);
	 }
	});
});

$(document).ready(function() {
	$('#formulario_entrevista_trabajo_social #clasificacion1').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/atas/getTipologia.php';
        var clasificacion_diagnostica_id = $('#formulario_entrevista_trabajo_social #clasificacion1').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'clasificacion_diagnostica_id='+clasificacion_diagnostica_id,
		   success:function(data){
		      $('#formulario_entrevista_trabajo_social #tipologia1').html("");
			  $('#formulario_entrevista_trabajo_social #tipologia1').html(data);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario_entrevista_trabajo_social #clasificacion2').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/atas/getTipologia.php';
        var clasificacion_diagnostica_id = $('#formulario_entrevista_trabajo_social #clasificacion2').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'clasificacion_diagnostica_id='+clasificacion_diagnostica_id,
		   success:function(data){
		      $('#formulario_entrevista_trabajo_social #tipologia2').html("");
			  $('#formulario_entrevista_trabajo_social #tipologia2').html(data);
		  }
	  });
	  return false;
    });
});

$(document).ready(function() {
	$('#formulario_entrevista_trabajo_social #clasificacion3').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/atas/getTipologia.php';
        var clasificacion_diagnostica_id = $('#formulario_entrevista_trabajo_social #clasificacion3').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'clasificacion_diagnostica_id='+clasificacion_diagnostica_id,
		   success:function(data){
		      $('#formulario_entrevista_trabajo_social #tipologia3').html("");
			  $('#formulario_entrevista_trabajo_social #tipologia3').html(data);
		  }
	  });
	  return false;
    });
});
//FIN ENTREVISTA TRABAJO SOCIAL

//INICIO RECETA
$(document).ready(function(e) {
    $('#formulario_receta_medica #expediente').on('blur', function(){
	 if($('#formulario_receta_medica #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/receta/buscar_expediente_receta.php';
        var expediente = $('#formulario_receta_medica #expediente').val();

	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){
					swal({
						title: "Error",
						text: "Registro no encontrado",
						type: "error",
						confirmButtonClass: "btn-danger"
					});
					return false;
			  }else if (array[0] == "Error1"){
					swal({
						title: "Error",
						text: "Este es un usuario temporal, no se puede agregar la preclínica, o simplemente el usuario no existe",
						type: "error",
						confirmButtonClass: "btn-danger"
					});
					return false;
			  }else{
			     $('#formulario_receta_medica #identidad').val(array[0]);
                 $('#formulario_receta_medica #nombre').val(array[1]);
                 $('#formulario_receta_medica #pacientes_id').val(array[2]);
				 $('#formulario_receta_medica #addRows').attr('disabled',false);
				 $('#formulario_receta_medica #removeRows').attr('disabled',false);
				 $("#formulario_receta_medica #validar").attr('disabled', false);
				 getServicio();
			  }
		  }
	  });
	  return false;
	 }else{
		$('#formulario1')[0].reset();
        $("#formulario1 #reg").attr('disabled', true);
	 }
	});
});

$(document).ready(function() {
	  $('#formulario_receta_medica #servicio_receta').on('change', function(){
			consultarServicioReceta();
      });
});

$('#receta').on('click', function(e){
	e.preventDefault();
	//acceso();
	if (getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		if(getPuestoId() == 2 || getPuestoId() == 4){
			formReceta();
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
			title: 'Acceso Denegado',
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error',
			confirmButtonClass: 'btn-danger'
	  });
	}
});

function formReceta(){
	$('#formulario_receta_medica')[0].reset();
	getServicioRecetaATA();
	$('#formulario_receta_medica #validar_receta').attr("disabled", false);
	$('#formulario_receta_medica #addRows').attr("disabled", false);
	$('#formulario_receta_medica #removeRows').attr("disabled", false);
	$('#formulario_receta_medica #validar_receta').show();
	$('#formulario_receta_medica #editar_receta').hide();
	$('#formulario_receta_medica #eliminar_receta').hide();
	limpiarTabla();
    $('#main').hide();
	$('#receta_medica').show();
	getVia(0);
	$('#formulario_receta_medica #expediente').attr('readonly', false);
	$('#formulario_receta_medica #expediente').focus();

	$('#formulario_receta_medica').attr({ 'data-form': 'save' });
	$('#formulario_receta_medica').attr({ 'action': '<?php echo SERVERURL; ?>php/receta/addReceta.php' });
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
		  closeOnConfirm: false
		},
		function(){
			$('#main').show();
			$('#label_acciones_receta').html("");
			$('#receta_medica').hide();
			$('#acciones_atras').addClass("breadcrumb-item active");
			$('#acciones_receta').removeClass("active");
			$('#formulario_receta_medica')[0].reset();
			swal.close();
		});
	 }else{
		 $('#main').show();
		 $('#label_acciones_receta').html("");
		 $('#receta_medica').hide();
		 $('#acciones_atras').addClass("breadcrumb-item active");
		 $('#acciones_receta').removeClass("active");
	 }
});

function showRecetaMedica(agenda_id, pacientes_id){
	var url = '<?php echo SERVERURL; ?>php/agenda/editar_receta.php';

	$.ajax({
	    type:'POST',
		url:url,
		data:'agenda_id='+agenda_id,
		success:function(data){	
				var datos = eval(data);

				$('#formulario_receta_medica')[0].reset();
				limpiarTabla();
				$('#formulario_receta_medica #pro').val("Registro");
				$('#formulario_receta_medica #agenda_id').val(agenda_id);
				$('#formulario_receta_medica #pacientes_id').val(pacientes_id);
				$('#formulario_receta_medica #expediente').val(datos[2]);
				$('#formulario_receta_medica #nombre').val(datos[0]);
				$('#formulario_receta_medica #identidad').val(datos[1]);
				$('#formulario_receta_medica #servicio_receta').val(datos[3]);
				$('#label_acciones_volver').html("ATA");
				$('#label_acciones_receta').html("Receta Electrónica");
				$('#formulario_receta_medica #expediente').attr('readonly', true);

				$('#formulario_receta_medica #validar_receta').attr("disabled", false);
				$('#formulario_receta_medica #addRows').attr("disabled", false);
				$('#formulario_receta_medica #removeRows').attr("disabled", false);
				$('#formulario_receta_medica #validar_receta').show();
				$('#formulario_receta_medica #editar_receta').hide();
				$('#formulario_receta_medica #eliminar_receta').hide();
				getVia(0);
				limpiarTabla();

				$('#main').hide();
				$('#receta_medica').show();

				$('#formulario_receta_medica').attr({ 'data-form': 'save' });
				$('#formulario_receta_medica').attr({ 'action': '<?php echo SERVERURL; ?>php/receta/addRecetaPorUsuario.php' });
		}
	});
}

function acceso(){
	$('#modal_acceso').modal({
		show:true,
		backdrop:'static'
	});
}
//FIN RECETA

//INICIO FORMULARIO 1
//1ER PATOLOGIA
$('#formulario1 #buscar_patologia_1_form1_atenciones').on('click', function(e){
	listar_patologia_1_formulario1_ata();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_1_formulario1_ata = function(){
	var table_patologia_1_formulario1_ata  = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_1_formulario1_ata.search('').draw();
	$('#buscar').focus();

	view_patologia_1_formulario1_ata_dataTable("#dataTablePatologias tbody", table_patologia_1_formulario1_ata);
}

var view_patologia_1_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #patologia1').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//2DA PATOLOGIA
$('#formulario1 #buscar_patologia_2_form1_atenciones').on('click', function(e){
	listar_patologia_2_formulario1_ata();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_2_formulario1_ata = function(){
	var table_patologia_2_formulario1_ata  = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_2_formulario1_ata.search('').draw();
	$('#buscar').focus();

	view_patologia_2_formulario1_ata_dataTable("#dataTablePatologias tbody", table_patologia_2_formulario1_ata);
}

var view_patologia_2_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #patologia2').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//3ERA PATOLOGIA
$('#formulario1 #buscar_patologia_3_form1_atenciones').on('click', function(e){
	listar_patologia_3_formulario1_ata();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_3_formulario1_ata = function(){
	var table_patologia_3_formulario1_ata  = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_3_formulario1_ata.search('').draw();
	$('#buscar').focus();

	view_patologia_3_formulario1_ata_dataTable("#dataTablePatologias tbody", table_patologia_3_formulario1_ata);
}

var view_patologia_3_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #patologia3').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//SERVICIOS
$('#formulario1 #buscar_servicios_atenciones_formulario1').on('click', function(e){
	listar_servicio_formulario1();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_formulario1 = function(){
	var table_servicio_formulario1  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServicioATATabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_formulario1.search('').draw();
	$('#buscar').focus();

	view_servicio_formulario1_dataTable("#dataTableServicios tbody", table_servicio_formulario1);
}

var view_servicio_formulario1_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #servicio').val(data.servicio_id);
		$('#modal_busqueda_servicios').modal('hide');
	});
}

//CENTRO REFERENCIAS RECIBIDAS ATENCION
$('#formulario1 #buscar_ref_recibida_de_atenciones').on('click', function(e){
	listar_centros_referencias_recibidas_formulario_ata();
	$('#modalCentroReferencia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_centros_referencias_recibidas_formulario_ata = function(){
	var nivel = $("#formulario1 #nivel").val();
	var centro_id = $("#formulario1 #centro").val();

	var table_centros_referencias_recibidas_formulario_ata = $("#dataTableCentroReferencias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getCentroNombreTabla.php",
			"data":{
				"nivel":nivel,
				"centro_id":centro_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"centro_nombre"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_centros_referencias_recibidas_formulario_ata.search('').draw();
	$('#buscar').focus();
	view_centros_referencias_recibidas_formulario_ata_dataTable("#dataTableCentroReferencias tbody", table_centros_referencias_recibidas_formulario_ata);
}

var view_centros_referencias_recibidas_formulario_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #centroi').val(data.centros_id);
		setCentroiFormulario();
		$('#modalCentroReferencia').modal('hide');
	});
}

//CENTRO REFERENCIAS ENVIADAS ATENCION
$('#formulario1 #buscar_enviada_re_atenciones').on('click', function(e){
	listar_centros_referencias_enviadas_ata();
	$('#modalCentroReferencia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_centros_referencias_enviadas_ata = function(){
	var nivel = $("#formulario1 #nivel_e").val();
	var centro_id = $("#formulario1 #centro_e").val();

	var table_centros_referencias_enviadas_formulario_ata = $("#dataTableCentroReferencias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getCentroNombreTabla.php",
			"data":{
				"nivel":nivel,
				"centro_id":centro_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"centro_nombre"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_centros_referencias_enviadas_formulario_ata.search('').draw();
	$('#buscar').focus();
	view_centros_referencias_enviadas_formulario_dataTable("#dataTableCentroReferencias tbody", table_centros_referencias_enviadas_formulario_ata);
}

var view_centros_referencias_enviadas_formulario_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #centroi_e').val(data.centros_id);
		setDiagnosticoClinicoFormulario();
		$('#modalCentroReferencia').modal('hide');
	});
}


//TRANSITO RECIBIDA FORMULARIO ATENCION
//SERVICIOS
$('#formulario1 #buscar_servicios_atenciones_transito_recibida').on('click', function(e){
	listar_servicio_transito_recibida_formulario1_ata();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_transito_recibida_formulario1_ata = function(){
	var table_servicio_transito_recibida_formulario1_ata  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServiciosTransitoTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_transito_recibida_formulario1_ata.search('').draw();
	$('#buscar').focus();

	view_servicio_transito_recibida_formulario1_ata_dataTable("#dataTableServicios tbody", table_servicio_transito_recibida_formulario1_ata);
}

var view_servicio_transito_recibida_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #transito_servicio_recibida').val(data.servicio_id);
		getUnidadTransitoRecibida();
		$('#modal_busqueda_servicios').modal('hide');
	});
}
//UNIDAD
$('#formulario1 #buscar_unidad_transito_recibida_atenciones').on('click', function(e){
	listar_unidad_transito_recibida_formulario1_ata();
	$('#modalBusquedaUnidad').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_unidad_transito_recibida_formulario1_ata = function(){
	var servicio = $("#formulario1 #transito_servicio_recibida").val();
	var table_unidad_transito_recibida_formulario1_ata = $("#dataTableUnidad").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getUnidadTabla.php",
			"data":{
				"servicio":servicio
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"puesto"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_unidad_transito_recibida_formulario1_ata.search('').draw();
	$('#buscar').focus();
	view_unidad_transito_recibida_formulario1_ata_dataTable("#dataTableUnidad tbody", table_unidad_transito_recibida_formulario1_ata);
}

var view_unidad_transito_recibida_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #transito_unidad_recibida').val(data.puesto_id);
		getProfesionalTransitoRecibida();
		$('#modalBusquedaUnidad').modal('hide');
	});
}
//PROFESIONAL
$('#formulario1 #buscar_profesional_tr_atenciones').on('click', function(e){
	listar_profesionales_transito_recibida_formulario1_ata();
	$('#modalBusquedaProfesionales').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_profesionales_transito_recibida_formulario1_ata = function(){
	var servicio = $("#formulario1 #transito_servicio_recibida").val();
	var puesto_id = $("#formulario1 #transito_unidad_recibida").val();

	var table_profesionales_transito_recibida_formulario1_ata = $("#dataTableProfesionales").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getMedicoTabla.php",
			"data":{
				"servicio":servicio,
				"puesto_id":puesto_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"colaborador"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_profesionales_transito_recibida_formulario1_ata.search('').draw();
	$('#buscar').focus();
	view_profesionales_transito_recibida_formulario1_ata_dataTable("#dataTableProfesionales tbody", table_profesionales_transito_recibida_formulario1_ata);
}

var view_profesionales_transito_recibida_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #transito_profesional_recibida').val(data.colaborador_id);
		$('#modalBusquedaProfesionales').modal('hide');
	});
}

//TRANSITO ENVIADA FORMULARIO ATENCION
//SERVICIOS
$('#formulario1 #buscar_enviada_te_atenciones').on('click', function(e){
	listar_servicio_transito_enviada_formulario1_ata();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_transito_enviada_formulario1_ata = function(){
	var table_servicio_transito_enviada_formulario1_ata  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServiciosTransitoTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_transito_enviada_formulario1_ata.search('').draw();
	$('#buscar').focus();

	view_servicio_transito_enviada_formulario1_ata_dataTable("#dataTableServicios tbody", table_servicio_transito_enviada_formulario1_ata);
}

var view_servicio_transito_enviada_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #transito_servicio_enviada').val(data.servicio_id);
		getTransitoEnviadaUnidad();
		$('#modal_busqueda_servicios').modal('hide');
	});
}
//UNIDAD
$('#formulario1 #buscar_unidad_te_atenciones').on('click', function(e){
	listar_unidad_transito_enviada_formulario1_ata();
	$('#modalBusquedaUnidad').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_unidad_transito_enviada_formulario1_ata = function(){
	var servicio = $("#formulario1 #transito_servicio_enviada").val();

	var table_unidad_transito_enviada_formulario1_ata = $("#dataTableUnidad").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getUnidadTabla.php",
			"data":{
				"servicio":servicio
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"puesto"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_unidad_transito_enviada_formulario1_ata.search('').draw();
	$('#buscar').focus();
	view_unidad_transito_enivada_formulario1_ata_dataTable("#dataTableUnidad tbody", table_unidad_transito_enviada_formulario1_ata);
}

var view_unidad_transito_enivada_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #transito_unidad_enviada').val(data.puesto_id);
		getProfesionalTransitoEnviada();
		$('#modalBusquedaUnidad').modal('hide');
	});
}
//PROFESIONAL
$('#formulario1 #buscar_profesional_te_atenciones').on('click', function(e){
	listar_profesionales_transito_enviada_formulario1_ata();
	$('#modalBusquedaProfesionales').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_profesionales_transito_enviada_formulario1_ata = function(){
	var servicio = $("#formulario1 #transito_servicio_enviada").val();
	var puesto_id = $("#formulario1 #transito_unidad_enviada").val();

	var table_profesionales_transito_enviada_formulario1_ata = $("#dataTableProfesionales").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getMedicoTabla.php",
			"data":{
				"servicio":servicio,
				"puesto_id":puesto_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"colaborador"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_profesionales_transito_enviada_formulario1_ata.search('').draw();
	$('#buscar').focus();
	view_profesionales_transito_enviada_formulario1_ata_dataTable("#dataTableProfesionales tbody", table_profesionales_transito_enviada_formulario1_ata);
}

var view_profesionales_transito_enviada_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario1 #transito_profesional_enviada').val(data.colaborador_id);
		$('#modalBusquedaProfesionales').modal('hide');
	});
}
//FIN FORMULARIO 1

//INICIO ATA EDICION

//1ER PATOLOGIA
$('#formulario_atas #buscar_patologia_1_form2_atenciones').on('click', function(e){
	listar_patologia_1_formulario1_ata_edicion();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_1_formulario1_ata_edicion = function(){
	var table_patologia_1_formulario1_ata_edicion = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_1_formulario1_ata_edicion.search('').draw();
	$('#buscar').focus();

	view_patologia_1_formulario1_ata_edicion_dataTable("#dataTablePatologias tbody", table_patologia_1_formulario1_ata_edicion);
}

var view_patologia_1_formulario1_ata_edicion_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #patologia_1').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//2DA PATOLOGIA
$('#formulario_atas #buscar_patologia_2_form2_atenciones').on('click', function(e){
	listar_patologia_2_formulario1_ata();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_2_formulario1_ata = function(){
	var table_patologia_2_formulario1_ata  = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_2_formulario1_ata.search('').draw();
	$('#buscar').focus();

	view_patologia_2_formulario1_ata_dataTable("#dataTablePatologias tbody", table_patologia_2_formulario1_ata);
}

var view_patologia_2_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #patologia_2').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//3ERA PATOLOGIA
$('#formulario_atas #buscar_patologia_3_form3_atenciones').on('click', function(e){
	listar_patologia_3_formulario1_ata();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_3_formulario1_ata = function(){
	var table_patologia_3_formulario1_ata  = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_3_formulario1_ata.search('').draw();
	$('#buscar').focus();

	view_patologia_3_formulario1_ata_dataTable("#dataTablePatologias tbody", table_patologia_3_formulario1_ata);
}

var view_patologia_3_formulario1_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #patologia_3').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//CENTRO REFERENCIAS RECIBIDAS ATENCION
$('#formulario_atas #buscar_ref_recibida_de_atenciones1').on('click', function(e){
	listar_centros_referencias_recibidas_formulario_ata_edicion();
	$('#modalCentroReferencia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_centros_referencias_recibidas_formulario_ata_edicion = function(){
	var nivel = $("#formulario_atas #nivel1").val();
	var centro_id = $("#formulario_atas #centro1").val();

	var table_centros_referencias_recibidas_formulario_ata_edicion = $("#dataTableCentroReferencias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getCentroNombreTabla.php",
			"data":{
				"nivel":nivel,
				"centro_id":centro_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"centro_nombre"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_centros_referencias_recibidas_formulario_ata_edicion.search('').draw();
	$('#buscar').focus();
	view_centros_referencias_recibidas_formulario_ata_edicion_dataTable("#dataTableCentroReferencias tbody", table_centros_referencias_recibidas_formulario_ata_edicion);
}

var view_centros_referencias_recibidas_formulario_ata_edicion_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #centroi1').val(data.centros_id);
		setCentroi1FormularioATA();
		$('#modalCentroReferencia').modal('hide');
	});
}
//TRANSITO RECIBIDA FORMULARIO ATENCION


//CENTRO REFERENCIAS ENVIADAS ATENCION
$('#formulario_atas #buscar_enviada_re_atenciones1').on('click', function(e){
	listar_centros_referencias_enviadas_formulario_ata();
	$('#modalCentroReferencia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_centros_referencias_enviadas_formulario_ata = function(){
	var nivel = $("#formulario_atas #nivel_e1").val();
	var centro_id = $("#formulario_atas #centro_e1").val();

	var table_centros_referencias_enviadas_formulario_ata = $("#dataTableCentroReferencias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getCentroNombreTabla.php",
			"data":{
				"nivel":nivel,
				"centro_id":centro_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"centro_nombre"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_centros_referencias_enviadas_formulario_ata.search('').draw();
	$('#buscar').focus();
	view_centros_referencias_enviadas_formulario_ata_dataTable("#dataTableCentroReferencias tbody", table_centros_referencias_enviadas_formulario_ata);
}

var view_centros_referencias_enviadas_formulario_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #centroi_e1').val(data.centros_id);
		setDiagnosticoClinico1FormularioATA();
		$('#modalCentroReferencia').modal('hide');
	});
}
//FIN FORMULARIO ATA EDICION

//INICIO REFERENCIAS ENVIADAS AREA ATENCIONES
//1ER PATOLOGIA
$('#formulario_agregar_referencias_enviadas #buscar_patologia1_referencia_enviada').on('click', function(e){
	listar_patologia_1_formulario1_ata_referencias_enviadas();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_1_formulario1_ata_referencias_enviadas = function(){
	var table_patologia_1_formulario1_ata_referencias_enviadas = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_1_formulario1_ata_referencias_enviadas.search('').draw();
	$('#buscar').focus();

	view_patologia_1_formulario1_ata_referencias_enviadas_dataTable("#dataTablePatologias tbody", table_patologia_1_formulario1_ata_referencias_enviadas);
}

var view_patologia_1_formulario1_ata_referencias_enviadas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_agregar_referencias_enviadas #patologia1').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//2DA PATOLOGIA
$('#formulario_agregar_referencias_enviadas #buscar_patologia2_referencia_enviada').on('click', function(e){
	listar_patologia_2_formulario1_ata_referencias_enviadas();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_2_formulario1_ata_referencias_enviadas = function(){
	var table_patologia_2_formulario1_ata_referencias_enviadas = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_2_formulario1_ata_referencias_enviadas.search('').draw();
	$('#buscar').focus();

	view_patologia_2_formulario1_ata_referencias_enviadas_dataTable("#dataTablePatologias tbody", table_patologia_2_formulario1_ata_referencias_enviadas);
}

var view_patologia_2_formulario1_ata_referencias_enviadas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_agregar_referencias_enviadas #patologia2').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//3ERA PATOLOGIA
$('#formulario_agregar_referencias_enviadas #buscar_patologia3_referencia_enviada').on('click', function(e){
	listar_patologia_3_formulario1_ata_referencias_enviadas();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_3_formulario1_ata_referencias_enviadas = function(){
	var table_patologia_3_formulario1_ata_referencias_enviadas = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_3_formulario1_ata_referencias_enviadas.search('').draw();
	$('#buscar').focus();

	view_patologia_3_formulario1_ata_referencias_enviadas_dataTable("#dataTablePatologias tbody", table_patologia_3_formulario1_ata_referencias_enviadas);
}

var view_patologia_3_formulario1_ata_referencias_enviadas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_agregar_referencias_enviadas #patologia3').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}
//FIN FORMULARIO FORMULARIO REFERENCIAS ENVIADAS AREA ATENCIONES

//INICIO FORMULARIO FORMULARIO REFERENCIAS RECIBIDAS AREA ATENCIONES
//PATOLOGIA
$('#formulario_agregar_referencias_recibidas #buscar_patologia_referencia_recibida').on('click', function(e){
	listar_patologia_3_formulario1_ata_referencia_recibida();
	$('#modalPatologia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_patologia_3_formulario1_ata_referencia_recibida = function(){
	var table_patologia_3_formulario1_ata_referencia_recibida  = $("#dataTablePatologias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getPatologiasTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"patologia_id"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"columnDefs": [
		  { width: "3.69", targets: 0 },
		  { width: "15.69%", targets: 1 },
		  { width: "6.69%", targets: 2 }
		]
	});
	table_patologia_3_formulario1_ata_referencia_recibida.search('').draw();
	$('#buscar').focus();

	view_patologia_3_formulario1_ata_referencia_recibida_dataTable("#dataTablePatologias tbody", table_patologia_3_formulario1_ata_referencia_recibida);
}

var view_patologia_3_formulario1_ata_referencia_recibida_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_agregar_referencias_recibidas #patologia1').val(data.id);
		$('#modalPatologia').modal('hide');
	});
}

//TRANSITO RECIBIDA FORMULARIO ATENCION
//SERVICIOS
$('#formulario_atas #buscar_servicios_transito_recibida_atenciones1').on('click', function(e){
	listar_servicio_transito_recibida_formulario_atas();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_transito_recibida_formulario_atas = function(){
	var table_servicio_transito_recibida_formulario_atas  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServiciosTransitoTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_transito_recibida_formulario_atas.search('').draw();
	$('#buscar').focus();

	view_servicio_transito_recibida_formulario_atas_dataTable("#dataTableServicios tbody", table_servicio_transito_recibida_formulario_atas);
}

var view_servicio_transito_recibida_formulario_atas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #transito_servicio_recibida1').val(data.servicio_id);
		getTransitoRecibidaServiciosFormularioATAS();
		$('#modal_busqueda_servicios').modal('hide');
	});
}
//UNIDAD
$('#formulario_atas #buscar_transito_recibida_unidad_atenciones1').on('click', function(e){
	listar_unidad_transito_recibida_formulario_ata();
	$('#modalBusquedaUnidad').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_unidad_transito_recibida_formulario_ata = function(){
	var servicio = $("#formulario_atas #transito_servicio_recibida1").val();
	var table_unidad_transito_recibida_formulario_ata = $("#dataTableUnidad").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getUnidadTabla.php",
			"data":{
				"servicio":servicio
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"puesto"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_unidad_transito_recibida_formulario_ata.search('').draw();
	$('#buscar').focus();
	view_unidad_transito_recibida_formulario_ata_dataTable("#dataTableUnidad tbody", table_unidad_transito_recibida_formulario_ata);
}

var view_unidad_transito_recibida_formulario_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #transito_unidad_recibida1').val(data.puesto_id);
		getTransitoRecibidaUnidadFormularioATAS();
		$('#modalBusquedaUnidad').modal('hide');
	});
}
//PROFESIONAL
$('#formulario_atas #buscar_transito_recibidaprofesional_tr_atenciones1').on('click', function(e){
	listar_profesionales_transito_recibida_formulario_ata();
	$('#modalBusquedaProfesionales').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_profesionales_transito_recibida_formulario_ata = function(){
	var servicio = $("#formulario_atas #transito_servicio_recibida1").val();
	var puesto_id = $("#formulario_atas #transito_unidad_recibida1").val();

	var table_profesionales_transito_recibida_formulario_ata = $("#dataTableProfesionales").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getMedicoTabla.php",
			"data":{
				"servicio":servicio,
				"puesto_id":puesto_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"colaborador"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_profesionales_transito_recibida_formulario_ata.search('').draw();
	$('#buscar').focus();
	view_profesionales_transito_recibida_formulario_ata_dataTable("#dataTableProfesionales tbody", table_profesionales_transito_recibida_formulario_ata);
}

var view_profesionales_transito_recibida_formulario_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #transito_profesional_recibidas1').val(data.colaborador_id);
		$('#modalBusquedaProfesionales').modal('hide');
	});
}

//TRANSITO ENVIADA FORMULARIO ATENCION FORMULARIO ATAS
//SERVICIOS
$('#formulario_atas #buscar_transito_enviada_te_atenciones1').on('click', function(e){
	listar_servicio_transito_enviada_formulario_ata();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_transito_enviada_formulario_ata = function(){
	var table_servicio_transito_enviada_formulario_ata  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServiciosTransitoTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_transito_enviada_formulario_ata.search('').draw();
	$('#buscar').focus();

	view_servicio_transito_enviada_formulario_ata_dataTable("#dataTableServicios tbody", table_servicio_transito_enviada_formulario_ata);
}

var view_servicio_transito_enviada_formulario_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #transito_servicio_enviada1').val(data.servicio_id);
		getTransitoEnviadaServiciosFormularioATAS();
		$('#modal_busqueda_servicios').modal('hide');
	});
}
//UNIDAD
$('#formulario_atas #buscar_transito_enviada_unidad_te_atenciones1').on('click', function(e){
	listar_unidad_transito_enviada_formulario_ata();
	$('#modalBusquedaUnidad').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_unidad_transito_enviada_formulario_ata = function(){
	var servicio = $("#formulario_atas #transito_servicio_enviada1").val();

	var table_unidad_transito_enviada_formulario_ata = $("#dataTableUnidad").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getUnidadTabla.php",
			"data":{
				"servicio":servicio
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"puesto"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_unidad_transito_enviada_formulario_ata.search('').draw();
	$('#buscar').focus();
	view_unidad_transito_enivada_formulario_ata_dataTable("#dataTableUnidad tbody", table_unidad_transito_enviada_formulario_ata);
}

var view_unidad_transito_enivada_formulario_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #transito_unidad_enviada1').val(data.puesto_id);
		getTransitoEnviadaProfesionalFormularioATA();
		$('#modalBusquedaUnidad').modal('hide');
	});
}
//PROFESIONAL
$('#formulario_atas #buscar_transito_enviada_profesional_tr_atenciones1').on('click', function(e){
	listar_profesionales_transito_enviada_formulario_ata();
	$('#modalBusquedaProfesionales').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_profesionales_transito_enviada_formulario_ata = function(){
	var servicio = $("#formulario_atas #transito_servicio_enviada1").val();
	var puesto_id = $("#formulario_atas #transito_unidad_enviada1").val();

	var table_profesionales_transito_enviada_formulario_ata = $("#dataTableProfesionales").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getMedicoTabla.php",
			"data":{
				"servicio":servicio,
				"puesto_id":puesto_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"colaborador"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_profesionales_transito_enviada_formulario_ata.search('').draw();
	$('#buscar').focus();
	view_profesionales_transito_enviada_formulario_ata_dataTable("#dataTableProfesionales tbody", table_profesionales_transito_enviada_formulario_ata);
}

var view_profesionales_transito_enviada_formulario_ata_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_atas #transito_profesional_enviada1').val(data.colaborador_id);
		$('#modalBusquedaProfesionales').modal('hide');
	});
}
//FIN FORMULARIO FORMULARIO REFERENCIAS ENVIADAS AREA ATENCIONES

//INICIO FORMULARIO REFERENCIAS ENVIADAS EN ATENCIONES
$('#formulario_agregar_referencias_enviadas #buscar_servicios_referencias_enviadas').on('click', function(e){
	listar_servicio_referencias_enviadas();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_referencias_enviadas = function(){
	var table_servicio_referencias_enviadas  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServicioATATabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_referencias_enviadas.search('').draw();
	$('#buscar').focus();

	view_servicio_referencias_enviadas_dataTable("#dataTableServicios tbody", table_servicio_referencias_enviadas);
}

var view_servicio_referencias_enviadas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_agregar_referencias_enviadas #servicio').val(data.servicio_id);
		$('#modal_busqueda_servicios').modal('hide');
	});
}

$('#formulario_agregar_referencias_enviadas #buscar_centro_referencias_enviadas').on('click', function(e){
	listar_centros_referencias_enviadas();
	$('#modalCentroReferencia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_centros_referencias_enviadas = function(){
	var nivel = $("#formulario_agregar_referencias_enviadas #centros_nivel").val();
	var centro_id = $("#formulario_agregar_referencias_enviadas #centro").val();

	var table_centros_referencias_enviadas = $("#dataTableCentroReferencias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getCentroNombreTabla.php",
			"data":{
				"nivel":nivel,
				"centro_id":centro_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"centro_nombre"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_centros_referencias_enviadas.search('').draw();
	$('#buscar').focus();
	view_centros_referencias_enviadas_dataTable("#dataTableCentroReferencias tbody", table_centros_referencias_enviadas);
}

var view_centros_referencias_enviadas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_agregar_referencias_enviadas #enviadaa').val(data.centros_id);
		$('#modalCentroReferencia').modal('hide');
	});
}
//FIN FORMULARIO REFERENCIAS ENVIADAS EN ATENCIONES

//INICIO FORMULARIO REFERENCIAS RECIBIDAS EN ATENCIONES
$('#formulario_agregar_referencias_recibidas #buscar_servicios_referencias_recibidas').on('click', function(e){
	listar_servicio_referencias_recibidas();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_referencias_recibidas = function(){
	var table_servicio_referencias_recibidas  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServicioATATabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_referencias_recibidas.search('').draw();
	$('#buscar').focus();

	view_servicio_referencias_recibidas_dataTable("#dataTableServicios tbody", table_servicio_referencias_recibidas);
}

var view_servicio_referencias_recibidas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_agregar_referencias_recibidas #servicio').val(data.servicio_id);
		$('#modal_busqueda_servicios').modal('hide');
	});
}

$('#formulario_agregar_referencias_recibidas #buscar_centros_referencias_recibidas').on('click', function(e){
	listar_centros_referencias_recibidas();
	$('#modalCentroReferencia').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_centros_referencias_recibidas = function(){
	var nivel = $("#formulario_agregar_referencias_recibidas #centros_nivel").val();
	var centro_id = $("#formulario_agregar_referencias_recibidas #centro").val();

	var table_centros_referencias_recibidas = $("#dataTableCentroReferencias").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getCentroNombreTabla.php",
			"data":{
				"nivel":nivel,
				"centro_id":centro_id
			}
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"centro_nombre"}
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
	});
	table_centros_referencias_recibidas.search('').draw();
	$('#buscar').focus();
	view_centros_referencias_recibidas_dataTable("#dataTableCentroReferencias tbody", table_centros_referencias_recibidas);
}

var view_centros_referencias_recibidas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_agregar_referencias_recibidas #recibidade').val(data.centros_id);
		$('#modalCentroReferencia').modal('hide');
	});
}
//FIN FORMULARIO REFERENCIAS RECIBIDAS EN ATENCIONES

//INICIO FORMULARIO TRANSITO ENVIADOS EN ATENCIONES
$('#formulario_transito_enviada #buscar_servicio_te').on('click', function(e){
	listar_servicio_transito_enviados();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_transito_enviados = function(){
	var table_servicio_transito_enviados  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServicioATATabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_transito_enviados.search('').draw();
	$('#buscar').focus();

	view_servicio_transito_enviados_dataTable("#dataTableServicios tbody", table_servicio_transito_enviados);
}

var view_servicio_transito_enviados_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_transito_enviada #servicio').val(data.servicio_id);
		$('#modal_busqueda_servicios').modal('hide');
	});
}
//FIN FORMULARIO TRANSITO ENVIADOS EN ATENCIONES

//INICIO FORMULARIO TRANSITO RECIBIDAS EN ATENCIONES
$('#formulario_transito_recibida #buscar_servicio_tr').on('click', function(e){
	listar_servicio_transito_enviados();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_transito_enviados = function(){
	var table_servicio_transito_enviados  = $("#dataTableServicios").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getServicioATATabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_servicio_transito_enviados.search('').draw();
	$('#buscar').focus();

	view_servicio_transito_enviados_dataTable("#dataTableServicios tbody", table_servicio_transito_enviados);
}

var view_servicio_transito_enviados_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_transito_recibida #servicio').val(data.servicio_id);
		$('#modal_busqueda_servicios').modal('hide');
	});
}
//FIN FORMULARIO TRANSITO RECIBIDAS EN ATENCIONES

//INICIO FORMULARIO TRABAJO SOCIAL

//ENTREVISTADO POR
$('#formulario_entrevista_trabajo_social #buscar_solicitado_por_entrevista').on('click', function(e){
	listar_solicitadoPorEntrevistaTS();
	$('#modalSolicitadoPorTS').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_solicitadoPorEntrevistaTS = function(){
	var table_solicitadoPorEntrevistaTS  = $("#dataTableSolicitadoPorTS").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getSolicitdoPorTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"colaborador"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_solicitadoPorEntrevistaTS.search('').draw();
	$('#buscar').focus();

	view_solicitadoPorEntrevistaTS_dataTable("#dataTableSolicitadoPorTS tbody", table_solicitadoPorEntrevistaTS);
}

var view_solicitadoPorEntrevistaTS_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_entrevista_trabajo_social #solicitado').val(data.colaborador_id);
		$('#modalSolicitadoPorTS').modal('hide');
	});
}

//CLASIFICACION TS 1
$('#formulario_entrevista_trabajo_social #buscar_clasificacion_ts_1').on('click', function(e){
	listar_ClasificacionTS_1();
	$('#modalClasificacionTS').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_ClasificacionTS_1 = function(){
	var table_ClasficiacionTS_1  = $("#dataTableClasificacionTS").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getClasificacionTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_ClasficiacionTS_1.search('').draw();
	$('#buscar').focus();

	view_ClasificacionTS_1_dataTable("#dataTableClasificacionTS tbody", table_ClasficiacionTS_1);
}

var view_ClasificacionTS_1_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_entrevista_trabajo_social #clasificacion1').val(data.clasificacion_diagnostica_id);
		$('#modalClasificacionTS').modal('hide');
	});
}

//CLASIFICACION TS 2
$('#formulario_entrevista_trabajo_social #buscar_clasificacion_ts_2').on('click', function(e){
	listar_ClasificacionTS_2();
	$('#modalClasificacionTS').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_ClasificacionTS_2 = function(){
	var table_ClasficiacionTS_2  = $("#dataTableClasificacionTS").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getClasificacionTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_ClasficiacionTS_2.search('').draw();
	$('#buscar').focus();

	view_ClasificacionTS_2_dataTable("#dataTableClasificacionTS tbody", table_ClasficiacionTS_2);
}

var view_ClasificacionTS_2_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_entrevista_trabajo_social #clasificacion2').val(data.clasificacion_diagnostica_id);
		$('#modalClasificacionTS').modal('hide');
	});
}

//CLASIFICACION TS 3
$('#formulario_entrevista_trabajo_social #buscar_clasificacion_ts_3').on('click', function(e){
	listar_ClasificacionTS_3();
	$('#modalClasificacionTS').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_ClasificacionTS_3 = function(){
	var table_ClasficiacionTS_3  = $("#dataTableClasificacionTS").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/atas/getClasificacionTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"nombre"}
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español//esta se encuenta en el archivo main.js
	});
	table_ClasficiacionTS_3.search('').draw();
	$('#buscar').focus();

	view_ClasificacionTS_3_dataTable("#dataTableClasificacionTS tbody", table_ClasficiacionTS_3);
}

var view_ClasificacionTS_3_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_entrevista_trabajo_social #clasificacion3').val(data.clasificacion_diagnostica_id);
		$('#modalClasificacionTS').modal('hide');
	});
}

//FIN FORMULARIO TRABAJO SOCIAL
</script>
