<script>
$(document).ready(function() {
    getServicio();
    getHoraConsulta();
    getHoraConsultaSobrecupo()
    getTipoSobrecupo();

    var hoy = new Date();
    fecha_actual = convertDate(hoy);
    $("#form-addevent #color").css("pointer-events", "none");
    $("#ModalEdit #color").css("pointer-events", "none");

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        height: 792,
        width: 990,
        hiddenDays: [0, 6], //OCULTAR DIAS
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
            'Dic'
        ],
        defaultDate: fecha_actual,
        slotLabelInterval: '00:20:00',
        minTime: "07:20:00",
        maxTime: "23:59:59",
        slotDuration: "00:40:00",
        editable: true,
        eventLimit: true,
        selectable: true,
        selectHelper: true,
        //eventDurationEditable: false,
        displayEventTime: true,
        businessHours: {
            start: '07:20:00', // hora final
            end: '18:00:00', // hora inicial
            dow: [1, 2, 3, 4, 5] // dias de semana, 0=Domingo
        },

        select: function(start, end, e) {  
            $("#context-menu").parent().addClass("show").show();
            $("#context-menu-cita").parent().addClass("show").show();

            var fecha_cita = moment(start).format('YYYY-MM-DD HH:mm:ss');
            var colaborador_id = $('#botones_citas #medico_general').val();
            var nombre_colaborador = $('#botones_citas #medico_general option:selected').html();
            var servicio_id = $('#botones_citas #servicio').val();
            var nombre_servicio = $('#botones_citas #servicio option:selected').html();

            $("#context-menu-cita #menu_cita").on("click", function(e) {
                $('#ModalAdd').modal({
                    show: true,
                    backdrop: 'static'
                });
                $(this).parent().removeClass("show").hide();
            }); 
            
            $("#context-menu-cita #menu_bloquear").on("click", function(e) {
                $('#modalBloqueoHoras').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
                $('#formBloqueoHora')[0].reset();
                $('#formBloqueoHora #proBloqueoHora').val("Bloquear Hora");
                $('#formBloqueoHora #bloqueo_fecha').val(fecha_cita);
                $('#formBloqueoHora #bloqueo_servicio').val(nombre_servicio);
                $('#formBloqueoHora #servicio_id').val(servicio_id);
                $('#formBloqueoHora #bloqueo_colaborador').val(nombre_colaborador);
                $('#formBloqueoHora #colaborador_id').val(colaborador_id);
                
                $('#formBloqueoHora').attr({ 'data-form': 'save' });
	            $('#formBloqueoHora').attr({ 'action': '<?php echo SERVERURL; ?>php/citas/addBloqueoHoraCita.php' });                
                $(this).parent().removeClass("show").hide();
            }); 
            
            if (getBloqueoFecha(fecha_cita, colaborador_id, servicio_id) == 1){
                if (getFechaAusencias(moment(start).format('YYYY-MM-DD HH:mm:ss'), $('#botones_citas #medico_general').val()) == 2) {
                    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
                        if (getFinSemana(moment(start).format('YYYY-MM-DD HH:mm:ss')) == "Sabado" ||
                        getFinSemana(moment(start).format('YYYY-MM-DD HH:mm:ss')) == "Domingo") {
                            swal({
                                title: 'Error',
                                text: 'No se permite agendar un fin de semana',
                                type: 'error',
                                confirmButtonClass: 'btn-danger',
                                allowEscapeKey: false,
                                keyboard: false,
                                allowOutsideClick: false
                            });
                        } else {
                            $("#ModalAdd_enviar").attr('disabled', false);
                            if ($('#botones_citas #medico_general').val() != "" && $('botones_citas #servicio').val() != "") {
                                $('#form-addevent')[0].reset();
                                if (moment(start).format('YYYY-MM-DD HH:mm:ss') >= fecha_actual) {
                                    $('#ModalAdd #fecha_cita').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                                    $('#ModalAdd #fecha_cita_end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                                    $('#ModalAdd #medico').val($('#botones_citas #medico_general').val());
                                    $('#ModalAdd #unidad').val($('#botones_citas #unidad').val());
                                    $('#ModalAdd #serv').val($('#botones_citas #servicio').val());
                                    $('#form-addevent #profesional_citas').val(getProfesionalName($('#botones_citas #medico_general').val()));
                                    $("#context-menu #context-pacientes_id").val(getPacientes_id(event.id));
                                    $("#context-menu #context-agenda_id").val(event.id);
                                    var top = e.pageY - 10;
                                    var left = e.pageX - 90;
                                    $("#context-menu-cita").css({
                                        display: "block",
                                        top: top,
                                        left: left
                                    }).addClass("show");
                                    return false; //blocks default Webbrowser right click menu
                                } else {
                                    swal({
                                        title: 'Error',
                                        text: 'No se puede agregar una cita en esta fecha',
                                        type: 'error',
                                        confirmButtonClass: 'btn-danger',
                                        allowEscapeKey: false,
                                        allowOutsideClick: false
                                    });
                                }
                            } else {
                                swal({
                                    title: 'Error',
                                    text: 'Debe seleccionar un médico y un servcicio antes de agendar una cita',
                                    type: 'error',
                                    confirmButtonClass: 'btn-danger',
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $('#botones_citas #medico_general').focus();
                            }
                        }
                    } else {
                        swal({
                            title: 'Acceso Denegado',
                            text: 'No tiene permisos para ejecutar esta acción',
                            type: 'error',
                            confirmButtonClass: 'btn-danger',
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        });
                        $('#botones_citas #medico_general').focus();
                    }
                }else{
                    swal({
                        title: "Error",
                        text: "El médico se encuentra ausente, no se le puede agendar una cita. " +
                            getComentarioAusencia(moment(start).format('YYYY-MM-DD HH:mm:ss'),
                                $('#botones_citas #medico_general').val()) + "",
                        type: "error",
                        confirmButtonClass: "btn-danger",
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    $('#botones_citas #medico_general').focus();
                }
            }else{
                swal({
                    title: "Error",
                    text: "La hora se encuentra bloqueada para el medico . " + nombre_colaborador + " con el comentario: " +
                    getComentarioBloqueoHora(fecha_cita, colaborador_id, servicio_id) + "",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#context-menu").hide();
                $("#context-menu-cita").hide();
            }
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
                    $("#ModalEdit_enviar").attr('disabled', false);
                    $("#ModalImprimir_enviar").attr('disabled', false);
                    $('#form-editevent')[0].reset();
                    var palabras = event.title.split("-");
                    var fecha = moment(event.start).format('YYYY-MM-DD HH:mm:ss').split(" ");
                    $('#ModalEdit #paciente').val(palabras[1]);
                    $('#ModalEdit #fecha_citaedit1').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalEdit #fecha_citaeditend').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalEdit #color').val(event.color);
                    getColaborador_id(event.id);
                    getComentario(event.id);
                    getComentario1(event.id);
                    getHora(event.id);
                    getHoraConsulta();
                    getHoraConsultaSobrecupo()
                    getFechaInicio(event.id);
                    getHoraInicio(event.id);
                    getExpediente(event.id);
                    $('#ModalEdit #id').val(event.id);
                    caracteresEditarCitaComentario();
                    caracteresEditarCitaComentario1();
                    caracteresEditarCitaObservacion();

                    $('#ModalEdit').modal({
                        show: true,
                        keyboard: false,
                        backdrop: 'static'
                    });
                    $('#mensaje_ModalEdit').hide();
                    $('#mensaje_ModalEdit').html("");
                } else {
                    swal({
                        title: 'Acceso Denegado',
                        text: 'No tiene permisos para ejecutar esta acción',
                        type: 'error',
                        confirmButtonClass: 'btn-danger',
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    $('#botones_citas #medico_general').focus();
                }
            });
            element.bind('contextmenu', function(e) {
                $("#context-menu #context-pacientes_id").val(getPacientes_id(event.id));
                $("#context-menu #context-agenda_id").val(event.id);
                var top = e.pageY - 10;
                var left = e.pageX - 90;
                $("#context-menu").css({
                    display: "block",
                    top: top,
                    left: left
                }).addClass("show");
                return false; //blocks default Webbrowser right click menu
            });
        }
        /*,
        		eventDrop: function(event, delta, revertFunc) { // si changement de position
        		   if(getFechaAusencias(moment(event.start).format('YYYY-MM-DD HH:mm:ss')) == 2){
        		       if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 10){
        		           if (moment(event.start).format('YYYY-MM-DD HH:mm:ss') >= fecha_actual){
        			          edit(event);
        		           }else{
        						swal({
        							title: "Error",
        							text: "No se puede mover una cita en esta fecha",
        							type: "error",
        							confirmButtonClass: "btn-danger",
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
        			        $('#botones_citas #medico_general').focus();
        		        }
        		   }else{
        				swal({
        					title: "Error",
        					text: "No se puede mover una cita en esta fecha",
        					type: "error",
        					confirmButtonClass: 'btn-danger',
        					allowEscapeKey: false,
        					allowOutsideClick: false
        				});
        			    $('#botones_citas #medico_general').focus();
        		   }
        		}*/
        /*,
        		eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
        		 if(getFechaAusencias(moment(start).format('YYYY-MM-DD HH:mm:ss')) == 2){
        		   if (getUsuarioSistema() == 1){
        			   edit(event);
        		   }else{
        				swal({
        					title: "Error",
        					text: "El médico se encuentra ausente, no se le puede agendar una cita. " + getComentarioAusencia(moment(event.start).format('YYYY-MM-DD HH:mm:ss'), $('#botones_citas #medico_general').val()) + "",
        					type: "error",
        					confirmButtonClass: "btn-danger",
        					allowEscapeKey: false,
        					allowOutsideClick: false
        				});
        			    $('#botones_citas #medico_general').focus();
        		  }
        		 }else{
        			swal({
        				title: "Error",
        				text: "El médico se encuentra ausente, no se le puede agendar una cita",
        				type: "error",
        				confirmButtonClass: "btn-danger",
        				allowEscapeKey: false,
        				allowOutsideClick: false
        			});
        			$('#botones_citas #medico_general').focus();
        		  }
        		}*/ //, events: "<?php echo SERVERURL; ?>php/citas/getCalendar.php",
    }).on("click", function() {
        $("#context-menu").removeClass("show").hide();
    });

    $("#context-menu a").on("click", function() {
        $(this).parent().removeClass("show").hide();
    });
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function() {
    $("#modalBloqueoHoras").on('shown.bs.modal', function() {
        $(this).find('#formBloqueoHora #bloqueo_obs').focus();
    });
});

$(document).ready(function() {
    $("#ModalAdd").on('shown.bs.modal', function() {
        $(this).find('#form-addevent #expediente').focus();
    });
});

$(document).ready(function() {
    $("#registrar_ausencias").on('shown.bs.modal', function() {
        $(this).find('#formulario_ausencias #comentario_ausencias').focus();
    });
});

$(document).ready(function() {
    $("#registrar_config_edades").on('shown.bs.modal', function() {
        $(this).find('#formulario_config_edades #edad').focus();
    });
});

$(document).ready(function() {
    $("#modal_sobrecupo").on('shown.bs.modal', function() {
        $(this).find('#formulario_sobrecupo #sobrecupo_expediente').focus();
    });
});

$(document).ready(function() {
    $("#buscarCita").on('shown.bs.modal', function() {
        $(this).find('#form-buscarcita #bs-regis').focus();
    });
});

$(document).ready(function() {
    $("#buscarHistorial").on('shown.bs.modal', function() {
        $(this).find('#form-buscarhistorial #bs-regis').focus();
    });
});

$(document).ready(function() {
    $("#buscarHistorialReprogramaciones").on('shown.bs.modal', function() {
        $(this).find('#form_buscarhistorial_reprogramaciones #bs-regis').focus();
    });
});

$(document).ready(function() {
    $("#buscarHistorialNo").on('shown.bs.modal', function() {
        $(this).find('#form-buscarhistorialno #bs-regis').focus();
    });
});

$('#botones_citas #ausencias').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
        e.preventDefault();
        $('#formulario_ausencias')[0].reset();
        pagination_ausencias(1);
        $('#registrar_ausencias').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
        getUnidadesAusencias();
        $('#formulario_ausencias #pro_ausencias').val("Registro");
        return false;
    } else {
        swal({
            title: 'Acceso Denegado',
            text: 'No tiene permisos para ejecutar esta acción',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
        $('#botones_citas #medico_general').focus();
    }
});

$('#botones_citas #config_edades').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
        e.preventDefault();
        $('#formulario_config_edades')[0].reset();
        $('#registrar_config_edades').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
        $('#formulario_config_edades')[0].reset();
        $('#formulario_config_edades #pro_config_edades').val("Registro");
        getEdadConfig();
        return false;
    } else {
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

$('#botones_citas #sobrecupo').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
        e.preventDefault();
        $('#formulario_sobrecupo')[0].reset();
        pagination_ausencias(1);
        getHoraConsulta();
        getHoraConsultaSobrecupo()
        getTipoSobrecupo();
        $("#sobrecupo_agregar").attr('disabled', false);
        $("#formulario_sobrecupo #pro_sobrecupo").val("Registro");
        $('#modal_sobrecupo').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
        clean_sobrecupo();
        return false;
    } else {
        swal({
            title: 'Acceso Denegado',
            text: 'No tiene permisos para ejecutar esta acción',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
        $('#botones_citas #medico_general').focus();
    }
});

$('#botones_citas #historial_nopresento').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 10) {
        $('#form-buscarhistorialno')[0].reset();
        pagination_busqueda_historial_nopresento(1);
        $('#buscarHistorialNo').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
        return false;
    } else {
        swal({
            title: 'Acceso Denegado',
            text: 'No tiene permisos para ejecutar esta acción',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
        $('#botones_citas #medico_general').focus();
    }
});

$('#botones_citas #historial_reprogramaciones').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 7 || getUsuarioSistema() ==
        10) {
        e.preventDefault();
        $('#form_buscarhistorial_reprogramaciones')[0].reset();
        pagination_busqueda_reprogramaciones(1);
        $('#buscarHistorialReprogramaciones').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
        return false;
    } else {
        swal({
            title: 'Acceso Denegado',
            text: 'No tiene permisos para ejecutar esta acción',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
        $('#botones_citas #medico_general').focus();
    }
});

$('#botones_citas #historial').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 3 ||  getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 7 || getUsuarioSistema() ==
        10) {
        $('#form-buscarhistorial')[0].reset();
        pagination_busqueda_historial(1);
        $('#buscarHistorial').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
        return false;
    } else {
        swal({
            title: 'Acceso Denegado',
            text: 'No tiene permisos para ejecutar esta acción',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
        $('#botones_citas #medico_general').focus();
    }
});

$('#botones_citas #search').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16) {
        $('#form-buscarcita')[0].reset();
        pagination_busqueda(1);
        $('#buscarCita').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
        return false;
    } else {
        swal({
            title: 'Acceso Denegado',
            text: 'No tiene permisos para ejecutar esta acción',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
        $('#botones_citas #medico_general').focus();
    }
});

$('#modificar_edades').on('click', function(e) {
    e.preventDefault();
    if ($('#formulario_config_edades #edad').val() == 18 || $('#formulario_config_edades #edad').val() == 17) {
        modicarEdades();
    } else if ($('#formulario_config_edades #edad').val() == "") {
        swal({
            title: 'Error',
            text: 'El campo no puede quedar en blanco',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
    } else {
        swal({
            title: 'Error',
            text: 'Edad no permitida, por favor corregir, debe ser 17 o 18',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
    }
});

$('#sobrecupo_agregar').on('click', function(e) {
    e.preventDefault();
    if ($('#formulario_sobrecupo #sobrecupo_expediente').val() == "" || $(
            '#formulario_sobrecupo #sobrecupo_servicio').val() == "" || $(
            '#formulario_sobrecupo #sobrecupo_unidad').val() == "" || $(
            '#formulario_sobrecupo #sobrecupo_medico').val() == "" || $(
            '#formulario_sobrecupo #sobrecupo_obsevacion').val() == "" || $(
            '#formulario_sobrecupo #tipo_sobrecupo').val() == "") {
        swal({
            title: "Error",
            text: "No se pueden enviar los datos, los campos estan vacíos, el campo de observación y tipo no pueden quedar en blanco",
            type: "error",
            confirmButtonClass: "btn-danger",
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
    } else {
        var tipo = $('#formulario_sobrecupo #tipo_sobrecupo').val();
        var hoy = new Date();
        fecha_actual = convertDate(hoy);
        if (tipo == 2 || tipo == 3) {
            if ($('#formulario_sobrecupo #sobrecupo_fecha_cita').val() == fecha_actual) {
                swal({
                    title: 'Error',
                    text: 'Lo sentimos, no se puede agregar un sobrecupo en la fecha actual, en todo caso debe ser un usuario extemporaneo',
                    type: 'error',
                    confirmButtonClass: 'btn-danger',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else {
                agregarSobrecupo();
            }
        } else if (tipo == 1) {
            if ($('#formulario_sobrecupo #sobrecupo_fecha_cita').val() == fecha_actual) {
                agregarSobrecupo();
            } else {
                swal({
                    title: 'Error',
                    text: 'Lo sentimos, no se puede agregar un extemporaneo en esta fecha, en todo caso debe ser un usuario en sobrecupo',
                    type: 'error',
                    confirmButtonClass: 'btn-danger',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            }
        }
    }
});

$('#ModalAdd_enviar').on('click', function(e) {
    e.preventDefault();
    if ($('#expediente').val() == "" || $('#fecha_cita').val() == "") {
        $('#form-addevent')[0].reset();
        swal({
            title: 'Error',
            text: 'No se pueden enviar los datos, los campos estan vacíos',
            type: 'error',
            confirmButtonClass: 'btn-danger',
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
    } else {
        agregaRegistro();
    }
});

$('#mensaje_status #mensaje_status_okay').on('click', function(e) {
    e.preventDefault();
    if ($('#mensaje_status #status_repro').val() == "" || $('#mensaje_status #mensaje_status_comentario')
    .val() == "") {
        swal({
            title: "Error",
            text: "No se pueden enviar los datos, los campos estan vacíos",
            type: "error",
            confirmButtonClass: "btn-danger",
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
    } else {
        e.preventDefault();
        modificarStatus();
    }
});

$('#mensaje_status #mensaje_status_refresh').on('click', function(e) {
    e.preventDefault();
    getStatusRepro();
});

$('#ModalDelete_enviar').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
        if ($('#fecha_citaedit').val() == "" || $('#fecha_citaeditend').val() == "") {
            $('#form-editevent')[0].reset();
            swal({
                title: 'Error',
                text: 'No se puede eliminar el registro, los campos estan vacíos',
                type: 'error',
                confirmButtonClass: 'btn-danger',
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            return false;
        } else {
            eliminar($('#ModalEdit #id').val(), $('#ModalEdit #coment').val());
        }
    } else {
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

$('#ModalImprimir_enviar').on('click', function(e) {
    e.preventDefault();
    if ($('#fecha_citaedit').val() == "" || $('#fecha_citaeditend').val() == "") {
        $('#form-editevent')[0].reset();
        swal({
            title: "Error",
            text: "No se pueden enviar los datos, los campos estan vacíos",
            type: "error",
            confirmButtonClass: "btn-danger",
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
    } else {
        reportePDF($('#form-editevent #id').val());
    }
});

$('#ModalEdit_enviar').on('click', function(e) {
    e.preventDefault();
    if ($('#fecha_citaedit').val() == "" || $('#fecha_citaeditend').val() == "") {
        $('#form-editevent')[0].reset();
        swal({
            title: "Error",
            text: "No se pueden enviar los datos, los campos estan vacíos",
            type: "error",
            confirmButtonClass: "btn-danger",
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
    } else {
        actualizar();
    }
});

$('#reg_ausencias').on('click', function(e) {
    e.preventDefault();
    agregaAusencias();
});

$('#reg_buscarausencias').on('click', function(e) {
    e.preventDefault();
    pagination_ausencias(1);
});

$('#botones_citas #refresh').on('click', function(e) {
    e.preventDefault();
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
        if ($('#botones_citas #servicio').val() == "") {
            swal({
                title: "Error",
                text: "Debe seleccionar un servicio de la lista, antes de poder refrescar los eventos",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            return false;
        } else if ($('#botones_citas #medico_general').val() == "") {
            swal({
                title: "Error",
                text: "Debe seleccionar un médico de la lista, antes de poder refrescar los eventos",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            return false;
        } else {
            actualizarEventos();
        }
    } else {
        swal({
            title: "Acceso Denegado",
            text: "No tiene permisos para ejecutar esta acción",
            type: "error",
            confirmButtonClass: "btn-danger",
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        return false;
        $('#botones_citas #medico_general').focus();;
    }
});

$(document).ready(function() {
    getStatusRepro();
});

$(document).ready(function() {
    $(function() {
        $('#reportes_fechai').on('change', function() {
            pagination_busqueda_reportes(1);
        });
    });
});

$(document).ready(function() {
    $(function() {
        $('#reportes_fechaf').on('change', function() {
            pagination_busqueda_reportes(1);
        });
    });
});

$(document).ready(function() {
    setInterval('actualizarEventos()', 4000);
    getUnidadesAusencias();
});

//Buscar Cita de Usuarios
$(document).ready(function() {
    $('#form-buscarcita #bs-regis').on('keyup', function() {
        pagination_busqueda(1);
        return false;
    });
});

//Buscar Historial usuarios que llegaron a su cita
$(document).ready(function() {
    $('#form-buscarhistorialno #bs-regis').on('keyup', function() {
        pagination_busqueda_historial_nopresento(1);
        return false;
    });
});

//Buscar Historial usarios que no se presentaron a su cita
$(document).ready(function() {
    $('#form-buscarhistorial #bs-regis').on('keyup', function() {
        pagination_busqueda_historial(1);
        return false;
    });
});

//Buscar Historial usarios que no se presentaron a su cita
$(document).ready(function() {
    $('#form_buscarhistorial_reprogramaciones #bs-regis').on('keyup', function() {
        pagination_busqueda_reprogramaciones(1);
        return false;
    });
});

function pagination_busqueda_historial_nopresento(partida) {
    var url = '<?php echo SERVERURL; ?>php/citas/buscar_historial_nosepresento.php';
    var dato = $('#form-buscarhistorialno #bs-regis').val();

    $.ajax({
        type: 'POST',
        url: url,
        data: 'partida=' + partida + '&dato=' + dato,
        success: function(data) {
            var array = eval(data);
            $('#form-buscarhistorialno #agrega-registros').html(array[0]);
            $('#form-buscarhistorialno #pagination').html(array[1]);
        }
    });
    return false;
}

function pagination_busqueda_reprogramaciones(partida) {
    var url = '<?php echo SERVERURL; ?>php/citas/buscar_historial_reprogramaciones.php';
    var dato = $('#form_buscarhistorial_reprogramaciones #bs-regis').val();

    $.ajax({
        type: 'POST',
        url: url,
        data: 'partida=' + partida + '&dato=' + dato,
        success: function(data) {
            var array = eval(data);
            $('#form_buscarhistorial_reprogramaciones #agrega-registros').html(array[0]);
            $('#form_buscarhistorial_reprogramaciones #pagination').html(array[1]);
        }
    });
    return false;
}

function pagination_busqueda(partida) {
    var url = '<?php echo SERVERURL; ?>php/citas/buscar_cita.php';
    var dato = $('#form-buscarcita #bs-regis').val();

    $.ajax({
        type: 'POST',
        url: url,
        data: 'partida=' + partida + '&dato=' + dato,
        success: function(data) {
            var array = eval(data);
            $('#form-buscarcita #agrega-registros').html(array[0]);
            $('#form-buscarcita #pagination').html(array[1]);
        }
    });
    return false;
}

function pagination_busqueda_historial(partida) {
    var url = '<?php echo SERVERURL; ?>php/citas/buscar_historial.php';
    var dato = $('#form-buscarhistorial #bs-regis').val();

    $.ajax({
        type: 'POST',
        url: url,
        data: 'partida=' + partida + '&dato=' + dato,
        success: function(data) {
            var array = eval(data);
            $('#form-buscarhistorial #agrega-registros').html(array[0]);
            $('#form-buscarhistorial #pagination').html(array[1]);
        }
    });
    return false;
}

function agregaRegistro() {
    var url = '<?php echo SERVERURL; ?>php/citas/addEvent.php';
    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        data: $('#form-addevent').serialize(),
        success: function(registro) {
            if (registro == 2) {
                $('#form-addevent')[0].reset();
                swal({
                    title: "Error",
                    text: "Los datos ingresados son incorrectos",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#mensaje_ModalAdd #mensaje_ModalAdd").attr('disabled', true);
                return false;
            } else if (registro == 3) {
                $('#form-addevent')[0].reset();
                swal({
                    title: "Error",
                    text: "Usuario ya tiene cita agendada en ese dia, revise las ausencias del usuario o las citas pendientes antes de continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#mensaje_ModalAdd #mensaje_ModalAdd").attr('disabled', true);
                return false;
            } else if (registro == 4) {
                $('#form-addevent')[0].reset();
                swal({
                    title: "Error",
                    text: "El médico ya tiene esta hora ocupada",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#mensaje_ModalAdd #mensaje_ModalAdd").attr('disabled', true);
                return false;
            } else if (registro == 5) {
                $('#form-addevent')[0].reset();
                swal({
                    title: "Error",
                    text: "Error al completar el registro, por favor verifique la información",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#mensaje_ModalAdd #mensaje_ModalAdd").attr('disabled', true);
                return false;
            } else if (registro == 6) {
                swal({
                    title: "Error",
                    text: "Este usuario ya ha fallecido, por favor abocarse con el departamento de Archivo Clínico por cualquier duda o inconveniente",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#mensaje_ModalAdd #mensaje_ModalAdd").attr('disabled', true);
                return false;
            } else if (registro == 1) {
                swal({
                    title: "Error",
                    text: "Este es un usuario pasivo, por favor abocarse con el departamento de Archivo Clínico para cambiar el estatus del mismo y poder continuar con la agenda de la cita",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#mensaje_ModalAdd #mensaje_ModalAdd").attr('disabled', true);
                return false;
            } else if (registro == 7) {
                swal({
                    title: "Error",
                    text: "Lo sentimos, este usuario ya ha fallecido, para mayor información comuniquese al departamento de Archivo Clínico",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#mensaje_ModalAdd #mensaje_ModalAdd").attr('disabled', true);
                return false;
            }else if (registro == 8) {
                swal({
                    title: "Error",
                    text: "Lo sentimos este usuario ya tiene marcada una ausencia no se puede agendar nuevamente, por favor elimine la ausencia antes de continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            }else if (registro == 9) {
                swal({
                    title: "Error",
                    text: "Lo sentimos debe realizarle el cobro al usuario, antes de continuar, una vez realizado por favor agregar el número de factura",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalAdd #form-addevent #factura").focus();
                return false;
            }else {
                $("#mensaje_ModalAdd #mensaje_ModalAdd").attr('disabled', false);
                $("#calendar").fullCalendar('renderEvent', {
                        id: registro.id,
                        title: registro.title,
                        start: registro.start,
                        end: registro.end,
                        color: registro.color,
                    },
                    true);
                $('#form-addevent')[0].reset();
                $('#ModalAdd').modal('hide');
                swal({
                    title: "Success",
                    text: "Cita Agendada con éxito",
                    type: "success",
                    timer: 3000,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalAdd_enviar").attr('disabled', true);
                reportePDF(registro.id);
                sendEmail(registro.id);
                return false;
            }
        },
        error: function() {
            swal({
                title: "Error",
                text: "No se enviaron los datos, favor corregir",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
        }
    });
    return false;
}

function getComentario(paciente_id) {
    var url = '<?php echo SERVERURL; ?>php/citas/getComentario.php';
    var usuario;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: 'paciente_id=' + paciente_id,
        success: function(data) {
            $('#ModalEdit #coment1').val(data);
        }
    });
}

function getComentario1(paciente_id) {
    var url = '<?php echo SERVERURL; ?>php/citas/getComentario1.php';
    var usuario;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: 'paciente_id=' + paciente_id,
        success: function(data) {
            $('#ModalEdit #coment_1').val(data);
        }
    });
}

function getExpediente(agenda_id) {
    var url = '<?php echo SERVERURL; ?>php/citas/getExpediente.php';
    var usuario;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: 'agenda_id=' + agenda_id,
        success: function(data) {
            $('#ModalEdit #expediente_edit').val(data);
        }
    });
}

function edit(event) {
    start = event.start.format('YYYY-MM-DD HH:mm:ss');
    if (event.end) {
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
    } else {
        end = start;
    }

    id = event.id;

    Event = [];
    Event[0] = id;
    Event[1] = start;
    Event[2] = end;

    var pacientes_id = getPacientes_id(id);
    var colaborador_id = getColaboradorEdicion_id(id);
    var servicio_id = getServicio_id(id);
    var usuario = getNombreUsuario(pacientes_id);

    $.ajax({
        url: '<?php echo SERVERURL; ?>php/citas/editEventDate.php',
        type: "POST",
        async: true,
        data: {
            Event: Event
        },
        success: function(rep) {
            if (rep == 1) {
                $('#mensaje_status').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
                $('#mensaje_status #mensaje_status_mensaje').html(
                    "Se ha sido modificado la fecha de la cita para el usuario: " + usuario +
                    ". ¿Por favor agregue un Estatus de la Reprogramación?");
                $('#mensaje_status #bad').hide();
                $('#mensaje_status #okay').show();
                $('#mensaje_status #mensaje_status_agenda_id').val(getNewAgendaID(pacientes_id,
                    colaborador_id, servicio_id, start));
                reportePDF(getNewAgendaID(pacientes_id, colaborador_id, servicio_id, start));
                sendEmailReprogramación(getNewAgendaID(pacientes_id, colaborador_id, servicio_id, start));
                getStatusRepro();
                $('#mensaje_status #mensaje_status_comentario').val("");
            } else if (rep == 2) {
                swal({
                    title: "Error",
                    text: "Error al modificar la fecha de la cita",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            } else if (rep == 3) {
                swal({
                    title: "Error",
                    text: "Usuario ya tiene cita agendada en ese dia",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            } else if (rep == 4) {
                swal({
                    title: "Error",
                    text: "El médico ya tiene esta hora ocupada",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            } else if (rep == 5) {
                swal({
                    title: "Error",
                    text: "No se puede mover este usuario a esta hora",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            } else if (rep == 6) {
                swal({
                    title: "Error",
                    text: "Este usuario ya tiene realizada su preclínica, no se puede realizar ningún cambio",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            }
        }
    });
}

function actualizar() {
    var eventID = $('#ModalEdit #id').val();
    var url = '<?php echo SERVERURL; ?>php/citas/actualizarEventTitle.php';

    $.ajax({
        url: url,
        async: true,
        data: $('#form-editevent').serialize(),
        type: "POST",
        success: function(json) {
            if (json == 1) {
                swal({
                    title: "Success",
                    text: "Cita Modificada con éxito",
                    type: "success",
                    timer: 3000,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                reportePDF(eventID);
                sendEmailCambioCita(eventID);
                $("#ModalDelete_enviar").attr('disabled', true);
                $("#ModalEdit_enviar").attr('disabled', true);
                $("#ModalImprimir_enviar").attr('disabled', true);
                if ($('#form-editevent #colaborador').val() != $('#form-editevent #medico1').val()) {
                    $("#calendar").fullCalendar('removeEvents', eventID);
                    $('#calendar').fullCalendar('rerenderEvents');
                    $('#calendar').fullCalendar('updateEvent', json);
                    $('#calendar').fullCalendar('rerenderEvents');
                    $("#ModalEdit #ModalEdit_enviar").attr('disabled', false);
                } else {
                    $('#calendar').fullCalendar('updateEvent', json);
                    $('#calendar').fullCalendar('rerenderEvents');
                    $("#ModalEdit #ModalEdit_enviar").attr('disabled', false);
                }
            } else if (json == 2) {
                swal({
                    title: "Error",
                    text: "Los datos ingresados son incorrectos",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalEdit #ModalEdit_enviar").attr('disabled', true);
            } else if (json == 3) {
                swal({
                    title: "Error",
                    text: "Usuario ya tiene cita agendada en ese dia",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalEdit #ModalEdit_enviar").attr('disabled', true);
            } else if (json == 4) {
                swal({
                    title: "Error",
                    text: "El médico ya tiene esta hora ocupada",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalEdit #ModalEdit_enviar").attr('disabled', true);
            } else if (json == 5) {
                swal({
                    title: "Error",
                    text: "Este usuario ya tiene realizada su preclínica, no se puede realizar ningún cambio",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalEdit #ModalEdit_enviar").attr('disabled', true);
            } else if (json == 6) {
                swal({
                    title: "Error",
                    text: "Lo sentimos este usuario ya tiene marcada una ausencia no se puede agendar nuevamente, por favor elimine la ausencia antes de continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalEdit #ModalEdit_enviar").attr('disabled', true);
                return false;
            } else if (json == 7) {
                swal({
                    title: "Error",
                    text: "El profesional tiene esta hora ocupada en otro servicio, por favor validar antes de continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalEdit #ModalEdit_enviar").attr('disabled', true);
                return false;
            } else {
                swal({
                    title: "Error",
                    text: "Lo sentimos no se puede procesar su solicitd, intentelo de nuevo más tarde",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            }
        }
    });
}

function eliminar(eventID, comentario) {
    var url = "";
    $.ajax({
        url: '<?php echo SERVERURL; ?>php/citas/eliminarEventTitle.php',
        data: 'delete=delete&id=' + eventID + '&comentario=' + comentario,
        type: "POST",
        async: true,
        success: function(json) {
            if (json == 1) {
                $('#form-editevent')[0].reset();
                $("#calendar").fullCalendar('removeEvents', eventID);
                $('#calendar').fullCalendar('rerenderEvents');
                swal({
                    title: "Success",
                    text: "Cita eliminada correctamente",
                    type: "success",
                    timer: 3000,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $('#ModalEdit').modal('hide');
                $("#ModalDelete_enviar").attr('disabled', true);
                $("#ModalEdit_enviar").attr('disabled', true);
                $("#ModalImprimir_enviar").attr('disabled', true);
                $("#form-editevent #fecha_citaedit").val(getFechaSistema());
                return false;
            } else if (json == 2) {
                swal({
                    title: "Error",
                    text: "No se puedo eliminar el registro",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else if (json == 3) {
                swal({
                    title: "Error",
                    text: "No se puedo eliminar el registro ya se realizo la preclínica para este usuario",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else if (json == 4) {
                swal({
                    title: "Error",
                    text: "Lo sentimos, no se puede eliminar esta cita, debido a que sobrepasa el tiempo permitido, por favor proceda a reprogramar la cita, para poder continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else {
                swal({
                    title: "Error",
                    text: "Error al procesar la solicitud",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            }
        }
    });
}

$(document).ready(function(e) {
    $('#form-addevent #expediente').on('blur', function() {
        if (consultarDepartamento(consultarExpediente($('#form-addevent #expediente').val())) != 0 &&
            consultarMunicipio(consultarExpediente($('#form-addevent #form-addevent #expediente')
            .val())) != 0 && consultarPais(consultarExpediente($('#form-addevent #expediente')
        .val())) != 0 && consultarEstadoCivil(consultarExpediente($('#form-addevent #expediente')
            .val())) != 0 && consultarRaza(consultarExpediente($('#form-addevent #expediente')
        .val())) != 0 && consultarReligion(consultarExpediente($('#form-addevent #expediente')
        .val())) != 0 && consultarProfesion(consultarExpediente($('#form-addevent #expediente')
        .val())) != 0 && consultarEscolaridad(consultarExpediente($('#form-addevent #expediente')
            .val())) != 0 && consultarLugarNacimiento(consultarExpediente($(
                '#form-addevent #expediente').val())) != 0 && consultarParentesco(consultarExpediente($(
                '#form-addevent #expediente').val())) != 0 && consultarResponsable(consultarExpediente(
                $('#form-addevent #expediente').val())) != 0) {
            var url = '<?php echo SERVERURL; ?>php/citas/buscar_expediente.php';
            var expediente = $('#form-addevent #expediente').val();
            var colaborador_id = $('#botones_citas #medico_general').val();
            var unidad = $('#botones_citas #unidad').val();
            var start = $('#form-addevent #fecha_cita').val();
            var end = $('#form-addevent #fecha_cita_end').val();
            var servicio_id = $('#form-addevent #serv').val();

            if ($('#expediente').val() != "") {
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: true,
                    data: 'expediente=' + expediente + '&colaborador_id=' + colaborador_id +
                        '&start=' + start + '&end=' + end + '&servicio_id=' + servicio_id +
                        '&unidad=' + unidad,
                    success: function(data) {
                        if (data == 1) {
                            swal({
                                title: "Error",
                                text: "Expediente o Identidad del Usuario no existen",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 2) {
                            swal({
                                title: "Error",
                                text: "Tiene que actualizar los datos del usuario antes de continuar con la creación de la cita",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 3) {
                            swal({
                                title: "Error",
                                text: "No se puede agendar este usuario ya que es un Adulto",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 4) {
                            swal({
                                title: "Error",
                                text: "No se puede agendar este usuario ya que es un Niño",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 5) {
                            swal({
                                title: "Error",
                                text: "Registro no encontrado",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 6) {
                            swal({
                                title: "Error",
                                text: "No se puede agendar este usuario, el registro ya existe, para cerciorarse, por favor revise la ausencia de usuarios o en registros pendientes o simplemente revise si existe la atención almacenada",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 7) {
                            swal({
                                title: "Error",
                                text: "Este usuario no ha sido atendido por el profesional, por favor espere a que el profesional suba su atención en el sistema. A su vez verifique si dicho usuario tiene atención pendiente con otro profesional",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 8) {
                            swal({
                                title: "Error",
                                text: "Es necesario que actualice los datos de este usuario, antes de continuar, valide números de teléfono y procedencia",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 9) {
                            swal({
                                title: "Error",
                                text: "Registro no encontrado",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 10) {
                            swal({
                                title: "Error",
                                text: "Este usuario es un familiar, solo se permite agendar citas a los usuarios",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 11) {
                            swal({
                                title: "Error",
                                text: "El profesional tiene esta hora ocupada en otro servicio, por favor validar antes de continuar",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalAdd_enviar").attr('disabled', true);
                            return false;
                        } else {
                            var array = eval(data);
                            if (array[3] == 'NulaN') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else if (array[3] == 'NulaS') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else if (array[3] == 'Nula') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else if (array[3] == 'NulaP') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else if (array[3] == 'NulaSError') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else if (array[3] == 'NuevosExcede') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar mas usuarios nuevos ya llego al límite",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else if (array[3] == 'SubsiguienteExcede') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar mas usuarios subsiguientes ya llego al límite",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else if (array[3] == 'Vacio') {
                                swal({
                                    title: "Error",
                                    text: "El profesional no tiene asignada una jornada laboral o simplemente no tiene un servicio asignado, no se le puede agendar usuarios",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else if (array[3] == 'Mayora5anos') {
                                swal({
                                    title: "Error",
                                    text: "Lo sentimos, este usuario tiene más  de 5 años que no viene a su cita, debe agendarlo como un usuario nuevo, cualquier consulta por favor avocarse con el departamento de Archivo Clínico",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalAdd_enviar").attr('disabled', true);
                                return false;
                            } else {
                                $('#paciente_id').val(array[0]);
                                $('#nombre').val(array[1]);
                                $('#color').val(array[2]);
                                $('#hora').val(array[3]);
                                $('#medico').val(array[4]);
                                $("#ModalAdd_enviar").attr('disabled', false);
                            }
                        }
                    }
                });
            }
            return false;
        } else {
            if ($('#form-addevent #expediente').val() != "") {
                swal({
                    title: "Error",
                    text: "Registro no encontrado, o simplemente debe actualizar los datos antes de continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            }
        }
    });
});

//INICIO FUNCION EVALUAR HORAS CITA USUARIOS
$(document).ready(function(e) {
    $('#form-editevent #hora_nueva').on('change', function() {
        if (getFechaAusenciasEdicionCitas($('#form-editevent #fecha_citaedit').val()) == 2) {
            var url = '<?php echo SERVERURL; ?>php/citas/getHora.php';
            var fecha = $('#form-editevent #fecha_citaedit').val();
            var hora = $('#form-editevent #hora_nueva').val();
            var agenda_id = $('#form-editevent #id').val();
            var colaborador_id = $('#form-editevent #colaborador').val();

            var hoy = new Date();

            if (fecha >= fecha_actual) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: true,
                    data: 'fecha=' + fecha + '&agenda_id=' + agenda_id + '&colaborador_id=' +
                        colaborador_id + '&hora=' + hora,
                    success: function(data) {
                        if (data == 'NulaN') {
                            swal({
                                title: "Error",
                                text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 'NulaS') {
                            swal({
                                title: "Error",
                                text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 'Nula') {
                            swal({
                                title: "Error",
                                text: "No se puede agendar este usuario en esta hora",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 'NulaP') {
                            swal({
                                title: "Error",
                                text: "No se puede agendar este usuario en esta hora",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 'NulaSError') {
                            swal({
                                title: "Error",
                                text: "No se puede agendar este usuario en esta hora",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 'NuevosExcede') {
                            swal({
                                title: "Error",
                                text: "No se puede agendar mas usuarios nuevos ya llego al límite",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 'SubsiguienteExcede') {
                            swal({
                                title: "Error",
                                text: "No se puede agendar mas usuarios subsiguientes ya llego al límite",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 'Vacio') {
                            swal({
                                title: "Error",
                                text: "El profesional no tiene asignada una jornada laboral o simplemente no tiene un servicio asignado, no se le puede agendar usuarios",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 2) {
                            swal({
                                title: "Error",
                                text: "El médico ya tiene la hora ocupada",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 3) {
                            swal({
                                title: "Error",
                                text: "Usuario ya tiene cita agendada ese día",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            return false;
                        } else if (data == 4) {
                            swal({
                                title: "Error",
                                text: "El profesional tiene esta hora ocupada en otro servicio, por favor validar antes de continuar",
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $("#ModalEdit_enviar").attr('disabled', true);
                            $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                false);
                            return false;
                        } else {
                            $("#ModalEdit_enviar").attr('disabled', false);
                            getFecha(fecha, hora);
                            return false;
                        }
                    }
                });
            } else {
                swal({
                    title: "Error",
                    text: "No se puede realizar esta acción en esta fecha",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalEdit_enviar").attr('disabled', true);
                return false;
            }
            return false;
        } else {
            swal({
                title: "Error",
                text: "El médico se encuentra ausente, no se le puede agendar una cita. " +
                    getComentarioAusencia($('#ModalEdit #fecha_citaedit').val(), $(
                        '#ModalEdit #colaborador').val()) + "",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            $("#ModalEdit_enviar").attr('disabled', true);
            $("#form-editevent #ModalEdit #hora_nueva").attr('disabled', false);
        }
    });
});

$(document).ready(function(e) {
    $('#form-editevent #fecha_citaedit').on('change', function() {
        if (getFechaAusenciasEdicionCitas($('#form-editevent #fecha_citaedit').val()) == 2) {
            if (consultarFecha($('#form-editevent #fecha_citaedit').val()) == 6 || consultarFecha($(
                    '#ModalEdit #fecha_citaedit').val()) == 0) {
                swal({
                    title: "Error",
                    text: "No se permite agendar un fin de semana",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalEdit_enviar").attr('disabled', true);
            } else {
                var url = '<?php echo SERVERURL; ?>php/citas/getHora.php';
                var fecha = $('#form-editevent #fecha_citaedit').val();
                var hora = $('#form-editevent #hora_nueva').val();
                var agenda_id = $('#form-editevent #id').val();
                var colaborador_id = $('#form-editevent #colaborador').val();

                var hoy = new Date();

                if (fecha >= fecha_actual) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        async: true,
                        data: 'fecha=' + fecha + '&agenda_id=' + agenda_id +
                            '&colaborador_id=' + colaborador_id + '&hora=' + hora,
                        success: function(data) {
                            if (data == 'NulaN') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalEdit_enviar").attr('disabled', true);
                                $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                    false);
                                return false;
                            } else if (data == 'NulaS') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalEdit_enviar").attr('disabled', true);
                                $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                    false);
                                return false;
                            } else if (data == 'Nula') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalEdit_enviar").attr('disabled', true);
                                $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                    false);
                                return false;
                            } else if (data == 'NulaP') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalEdit_enviar").attr('disabled', true);
                                $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                    false);
                                return false;
                            } else if (data == 2) {
                                swal({
                                    title: "Error",
                                    text: "El médico ya tiene la hora ocupada",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalEdit_enviar").attr('disabled', true);
                                $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                    false);
                                return false;
                            } else if (data == 3) {
                                swal({
                                    title: "Error",
                                    text: "El médico ya tiene la hora ocupada",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalEdit_enviar").attr('disabled', true);
                                $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                    false);
                                return false;
                            } else if (data == 4) {
                                swal({
                                    title: "Error",
                                    text: "El profesional tiene esta hora ocupada en otro servicio, por favor validar antes de continuar",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#ModalEdit_enviar").attr('disabled', true);
                                $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                    false);
                                return false;
                            } else {
                                $("#form-editevent #ModalEdit #ModalEdit_enviar").attr(
                                    'disabled', false);
                                $("#form-editevent #ModalEdit #hora_nueva").attr('disabled',
                                    false);
                                getFecha(fecha, hora);
                                return false;
                            }
                        }
                    });
                } else {
                    swal({
                        title: "Error",
                        text: "No se puede realizar esta acción en esta fecha",
                        type: "error",
                        confirmButtonClass: "btn-danger",
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    $("#ModalEdit_enviar").attr('disabled', true);
                    $("#form-editevent #ModalEdit #hora_nueva").attr('disabled', false);
                    return false;
                }
                return false;
            }
        } else {
            swal({
                title: "Error",
                text: "El médico se encuentra ausente, no se le puede agendar una cita. " +
                    getComentarioAusencia($('#ModalEdit #fecha_citaedit').val(), $(
                        '#ModalEdit #colaborador').val()) + "",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            $("#ModalEdit_enviar").attr('disabled', true);
            $("#form-editevent #ModalEdit #hora_nueva").attr('disabled', false);
        }
    });
});
//INICIO FUNCION EVALUAR HORAS CITA USUARIOS

//INICIO FUNCION EVALUAR HORAS SOBRECUPO / EXTEMPORANEO
$(document).ready(function(e) {
    $('#formulario_sobrecupo #hora_sobrecupo').on('change', function() {
        if ($('#formulario_sobrecupo #tipo_sobrecupo').val() != "") {
            if (consultarFecha($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 6 ||
                consultarFecha($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 0) {
                swal({
                    title: "Error",
                    text: "No se permite agendar un fin de semana",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            } else {
                var url = '<?php echo SERVERURL; ?>php/citas/getHoraSobreCupo.php';
                var fecha = $('#formulario_sobrecupo #sobrecupo_fecha_cita').val();
                var hora = $('#formulario_sobrecupo #hora_sobrecupo').val();
                var servicio_id = $('#formulario_sobrecupo #sobrecupo_servicio').val();
                var colaborador_id = $('#formulario_sobrecupo #sobrecupo_medico').val();
                var expediente = $('#formulario_sobrecupo #sobrecupo_expediente').val();
                var tipo_sobrecupo = $('#formulario_sobrecupo #tipo_sobrecupo').val();

                var hoy = new Date();

                if (fecha >= fecha_actual) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        async: true,
                        data: 'fecha=' + fecha + '&servicio_id=' + servicio_id +
                            '&colaborador_id=' + colaborador_id + '&expediente=' + expediente +
                            '&hora=' + hora + '&tipo_sobrecupo=' + tipo_sobrecupo,
                        success: function(data) {
                            if (data == 'NulaN') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaS') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'Nula') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaP') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaSError') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NuevosExcede') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar mas usuarios nuevos ya llego al límite",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'SubsiguienteExcede') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar mas usuarios subsiguientes ya llego al límite",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'Vacio') {
                                swal({
                                    title: "Error",
                                    text: "El profesional no tiene asignada una jornada laboral o simplemente no tiene un servicio asignado, no se le puede agendar usuarios",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 2) {
                                swal({
                                    title: "Error",
                                    text: "El médico ya tiene la hora ocupada",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 3) {
                                swal({
                                    title: "Error",
                                    text: "Usuario ya tiene cita agendada ese día",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else {
                                $("#sobrecupo_agregar").attr('disabled', false);
                                getFecha(fecha, hora);
                                return false;
                            }
                        }
                    });
                } else {
                    swal({
                        title: "Error",
                        text: "No se puede realizar esta acción en esta fecha",
                        type: "error",
                        confirmButtonClass: "btn-danger",
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    $("#sobrecupo_agregar").attr('disabled', true);
                    return false;
                }
                return false;
            }
        } else {
            swal({
                title: "Error",
                text: "Lo sentimos la opción Tipo no puede quedar vacía, por favor verificar antes de continuar",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            $("#sobrecupo_agregar").attr('disabled', true);
            return false;
        }
    });
});

$(document).ready(function(e) {
    $('#formulario_sobrecupo #sobrecupo_fecha_cita').on('change', function() {
        if ($('#formulario_sobrecupo #tipo_sobrecupo').val() != "") {
            if (consultarFecha($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 6 ||
                consultarFecha($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 0) {
                swal({
                    title: "Error",
                    text: "No se permite agendar un fin de semana",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#sobrecupo_agregar").attr('disabled', true);
            } else {
                var url = '<?php echo SERVERURL; ?>php/citas/getHoraSobreCupo.php';
                var fecha = $('#formulario_sobrecupo #sobrecupo_fecha_cita').val();
                var hora = $('#formulario_sobrecupo #hora_sobrecupo').val();
                var servicio_id = $('#formulario_sobrecupo #sobrecupo_servicio').val();
                var colaborador_id = $('#formulario_sobrecupo #sobrecupo_medico').val();
                var expediente = $('#formulario_sobrecupo #sobrecupo_expediente').val();
                var tipo_sobrecupo = $('#formulario_sobrecupo #tipo_sobrecupo').val();

                var hoy = new Date();

                if (fecha >= fecha_actual) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        async: true,
                        data: 'fecha=' + fecha + '&servicio_id=' + servicio_id +
                            '&colaborador_id=' + colaborador_id + '&expediente=' + expediente +
                            '&hora=' + hora + '&tipo_sobrecupo=' + tipo_sobrecupo,
                        success: function(data) {
                            if (data == 'NulaN') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaS') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'Nula') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaP') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaSError') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NuevosExcede') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar mas usuarios nuevos ya llego al límite",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'SubsiguienteExcede') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar mas usuarios subsiguientes ya llego al límite",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'Vacio') {
                                swal({
                                    title: "Error",
                                    text: "El profesional no tiene asignada una jornada laboral o simplemente no tiene un servicio asignado, no se le puede agendar usuarios",
                                    type: "error",
                                    confirmButtonClass: "btn-danger"
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 2) {
                                swal({
                                    title: "Error",
                                    text: "El médico ya tiene la hora ocupada",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 3) {
                                $('#ModalEdit #mensaje_ModalEdit').removeClass('bien');
                                swal({
                                    title: "Error",
                                    text: "El médico ya tiene la hora ocupada",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else {
                                $("#sobrecupo_agregar").attr('disabled', false);
                                getFecha(fecha, hora);
                                return false;
                            }
                        }
                    });
                } else {
                    swal({
                        title: "Error",
                        text: "No se puede realizar esta acción en esta fecha",
                        type: "error",
                        confirmButtonClass: "btn-danger",
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    $("#sobrecupo_agregar").attr('disabled', true);
                    return false;
                }
                return false;
            }
        } else {
            swal({
                title: "Error",
                text: "Lo sentimos la opción Tipo no puede quedar vacía, por favor verificar antes de continuar",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            $("#sobrecupo_agregar").attr('disabled', true);
            return false;
        }
    });
});
//FIN FUNCION EVALUAR HORAS SOBRECUPO / EXTEMPORANEO

$('#formulario_sobrecupo #tipo_sobrecupo').on('change', function() {
    //$("#sobrecupo_agregar").attr('disabled', false);
    if ($('#formulario_sobrecupo #tipo_sobrecupo').val() != "") {
        if (getFechaAusenciasEdicionCitas($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 2) {
            if (consultarFecha($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 6 || consultarFecha($(
                    '#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 0) {
                swal({
                    title: "Error",
                    text: "No se permite agendar un fin de semana",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#sobrecupo_agregar").attr('disabled', true);
            } else {
                var url = '<?php echo SERVERURL; ?>php/citas/getHoraSobreCupo.php';
                var fecha = $('#formulario_sobrecupo #sobrecupo_fecha_cita').val();
                var hora = $('#formulario_sobrecupo #hora_sobrecupo').val();
                var servicio_id = $('#formulario_sobrecupo #sobrecupo_servicio').val();
                var colaborador_id = $('#formulario_sobrecupo #sobrecupo_medico').val();
                var expediente = $('#formulario_sobrecupo #sobrecupo_expediente').val();
                var tipo_sobrecupo = $('#formulario_sobrecupo #tipo_sobrecupo').val();

                var hoy = new Date();

                if (fecha >= fecha_actual) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        async: true,
                        data: 'fecha=' + fecha + '&servicio_id=' + servicio_id + '&colaborador_id=' +
                            colaborador_id + '&expediente=' + expediente + '&hora=' + hora +
                            '&tipo_sobrecupo=' + tipo_sobrecupo,
                        success: function(data) {
                            if (data == 'NulaN') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaS') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'Nula') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaP') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NulaSError') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar este usuario en esta hora",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'NuevosExcede') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar mas usuarios nuevos ya llego al límite",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'SubsiguienteExcede') {
                                swal({
                                    title: "Error",
                                    text: "No se puede agendar mas usuarios subsiguientes ya llego al límite",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 'Vacio') {
                                swal({
                                    title: "Error",
                                    text: "El profesional no tiene asignada una jornada laboral o simplemente no tiene un servicio asignado, no se le puede agendar usuarios",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 2) {
                                swal({
                                    title: "Error",
                                    text: "El médico ya tiene la hora ocupada",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else if (data == 3) {
                                $('#ModalEdit #mensaje_ModalEdit').removeClass('bien');
                                swal({
                                    title: "Error",
                                    text: "El médico ya tiene la hora ocupada",
                                    type: "error",
                                    confirmButtonClass: "btn-danger",
                                    allowEscapeKey: false,
                                    allowOutsideClick: false
                                });
                                $("#sobrecupo_agregar").attr('disabled', true);
                                return false;
                            } else {
                                $("#sobrecupo_agregar").attr('disabled', false);
                                getFecha(fecha, hora);
                                return false;
                            }
                        }
                    });
                } else {
                    swal({
                        title: "Error",
                        text: "No se puede realizar esta acción en esta fecha",
                        type: "error",
                        confirmButtonClass: "btn-danger",
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    $("#sobrecupo_agregar").attr('disabled', true);
                    return false;
                }
                return false;
            }
        } else {
            swal({
                title: "Error",
                text: "El médico se encuentra ausente, no se le puede agendar una cita. " +
                    getComentarioAusencia($('#ModalEdit #fecha_citaedit').val(), $(
                        '#ModalEdit #colaborador').val()) + "",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            $("#sobrecupo_agregar").attr('disabled', true);
        }
    } else {
        swal({
            title: "Error",
            text: "Lo sentimos la opción Tipo no puede quedar vacía, por favor verificar antes de continuar",
            type: "error",
            confirmButtonClass: "btn-danger",
            allowEscapeKey: false,
            allowOutsideClick: false
        });
        $("#sobrecupo_agregar").attr('disabled', true);
        return false;
    }
});

function getFecha(fecha, hora) {
    var url = '<?php echo SERVERURL; ?>php/citas/getFecha.php';

    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        data: 'fecha=' + fecha + '&hora=' + hora,
        success: function(data) {
            var datos = eval(data);
            $('#ModalEdit #fecha_citaedit1').val(datos[0]);
            $('#ModalEdit #fecha_citaeditend').val(datos[1]);
        }
    });
    return false;
}

function getColaborador_id(dato) {
    var url = '<?php echo SERVERURL; ?>php/citas/colaborador.php';

    $.ajax({
        type: 'POST',
        url: url,
        data: 'agenda_id=' + dato,
        success: function(data) {
            if (data == 'Error') {
                swal({
                    title: "Error",
                    text: "Error en los datos",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else {
                ;
                $('#ModalEdit #medico1').val(data);
                $('#ModalEdit #colaborador').val(data);
            }
        }
    });
    return false;
}

function getHora(dato) {
    var url = '<?php echo SERVERURL; ?>php/citas/getHoraUsuario.php';

    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        data: 'agenda_id=' + dato,
        success: function(data) {
            $('#ModalEdit #hora_citaeditend').val(data);
        }
    });
    return false;
}

function getFechaInicio(dato) {
    var url = '<?php echo SERVERURL; ?>php/citas/getFechaInicio.php';

    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        data: 'agenda_id=' + dato,
        success: function(data) {
            $('#ModalEdit #fecha_citaedit').val(data);
        }
    });
    return false;
}

function getHoraInicio(dato) {
    var url = '<?php echo SERVERURL; ?>php/citas/getHoraInicio.php';

    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        data: 'agenda_id=' + dato,
        success: function(data) {
            $('#ModalEdit #hora_nueva').val(data);
        }
    });
    return false;
}

function actualizarEventos() {
    if ($('#botones_citas #medico_general').val() != "" && $('#botones_cita #servicio').val() != "") {
        var colaborador_id = $('#botones_citas #medico_general').val();
        var servicio_id = $('#botones_citas #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getCalendar_busqueda.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'colaborador_id=' + colaborador_id + '&servicio=' + servicio_id,
            success: function(events) {
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', events);
                $('#calendar').fullCalendar('rerenderEvents');
            }
        });
    }
}

$(document).ready(function() {
    $('#botones_citas #medico_general').on('change', function() {
        var colaborador_id = $('#botones_citas #medico_general').val();
        var servicio_id = $('#botones_citas #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getCalendar_busqueda.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'colaborador_id=' + colaborador_id + '&servicio=' + servicio_id,
            success: function(events) {
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', events);
                $('#calendar').fullCalendar('rerenderEvents');
            }
        });

    });
});

$(document).ready(function() {
    $('#form-editevent #colaborador').on('change', function() {
        var fecha = $('#form-editevent #fecha_citaedit').val();
        if (getFechaAusenciasEdicionCitas(fecha) == 2) {
            $("#ModalEdit_enviar").attr('disabled', false);
        } else {
            $("#ModalEdit_enviar").attr('disabled', true);
            swal({
                title: "Error",
                text: "El médico se encuentra ausente, no se le puede mover una cita. " +
                    getComentarioAusencia(fecha, $('#form-editevent #colaborador').val()) + "",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
        }
    });
});

function convertDate(inputFormat) {
    function pad(s) {
        return (s < 10) ? '0' + s : s;
    }
    var d = new Date(inputFormat);
    return [d.getFullYear(), pad(d.getMonth() + 1), pad(d.getDate())].join('-');
}

//BOOSTRAP SELECT
$(document).ready(function() {
    $('#botones_citas #servicio').on('change', function() {
        var servicio_id = $('#botones_citas #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getUnidad.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'servicio=' + servicio_id,
            success: function(data) {
                $('#botones_citas #unidad').html(data);
            }
        });

    });
});

function agregaAusencias() {
    var url = '<?php echo SERVERURL; ?>php/citas/agregarAusencias.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: $('#formulario_ausencias').serialize(),
        success: function(registro) {
            if ($('#formulario_ausencias #pro_ausencias').val() == 'Registro') {
                $('#formulario_ausencias')[0].reset();
                $('#formulario_ausencias #pro_ausencias').val('Registro');
                swal({
                    title: "Success",
                    text: "Registro completado con éxito",
                    type: "success",
                    timer: 3000,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                pagination_ausencias(1);
                $('#formulario_ausencias')[0].reset();
                getUnidadesAusencias();
                return false;
            }
        }
    });
    return false;
}

function modicarEdades() {
    var url = '<?php echo SERVERURL; ?>php/citas/modificarEdades.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: $('#formulario_config_edades').serialize(),
        success: function(registro) {
            if (registro == 1) {
                swal({
                    title: "Success",
                    text: "Registro modificado correctamente",
                    type: "success",
                    timer: 3000,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                getEdadConfig();
                return false;
            } else {
                swal({
                    title: "Error",
                    text: "Registro no modificado",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            }
        }
    });
    return false;
}

$(document).ready(function() {
    $('#botones_citas #unidad').on('change', function() {
        var servicio_id = $('#botones_citas #servicio').val();
        var puesto_id = $('#botones_citas #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getMedico.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'servicio=' + servicio_id + '&puesto_id=' + puesto_id,
            success: function(data) {
                $('#botones_citas #medico_general').html(data);
                $('#form-editevent #colaborador').html(data);
            }
        });

    });
});

$(document).ready(function() {
    $('#formulario_ausencias #colaborador_ausencia').on('change', function() {
        var puesto_id = $('#formulario_ausencias #colaborador_ausencia').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getMedicoAusencias.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'puesto_id=' + puesto_id,
            success: function(data) {
                $('#formulario_ausencias #medico_ausencia').html(data);
            }
        });

    });
});

function getUnidadesAusencias() {
    var url = '<?php echo SERVERURL; ?>php/citas/getUnidadAusencia.php';

    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_ausencias #colaborador_ausencia').html(data);
        }
    });
    return false;
}

function getFechaAusenciasEdicionCitas(fecha) {
    var url = '<?php echo SERVERURL; ?>php/citas/getFechaAusencias.php';
    var colaborador_id = $('#colaborador').val();
    var valor = "";
    $.ajax({
        type: 'POST',
        url: url,
        data: 'fecha=' + fecha + '&colaborador_id=' + colaborador_id,
        async: false,
        success: function(data) {
            valor = data;
        }
    });
    return valor;
}

function pagination_ausencias(partida) {
    var url = '<?php echo SERVERURL; ?>php/citas/paginar_ausencias.php';
    var medico = $('#formulario_ausencias #medico_ausencia').val();
    var fechai = $('#formulario_ausencias #fecha_ausencia').val();
    var fechaf = $('#formulario_ausencias #fecha_ausenciaf').val();

    $.ajax({
        type: 'POST',
        url: url,
        data: 'partida=' + partida + '&medico=' + medico + '&fechai=' + fechai + '&fechaf=' + fechaf,
        success: function(data) {
            var array = eval(data);
            $('#formulario_ausencias #agrega-registros_ausencias').html(array[0]);
            $('#formulario_ausencias #pagination_ausencias').html(array[1]);
        }
    });
    return false;
}

function reportePDF(agenda_id) {
    window.open('<?php echo SERVERURL; ?>php/citas/tickets.php?agenda_id=' + agenda_id);
}

function getPacientes_id(agenda_id) {
    var url = '<?php echo SERVERURL; ?>php/citas/getPacientes_id.php';
    var pacientes_id;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: 'agenda_id=' + agenda_id,
        success: function(valores) {
            pacientes_id = valores;
        }
    });
    return pacientes_id;
}

function getColaboradorEdicion_id(agenda_id) {
    var url = '<?php echo SERVERURL; ?>php/citas/getColaborador_id.php';
    var colaborador_id;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: 'agenda_id=' + agenda_id,
        success: function(valores) {
            colaborador_id = valores;
        }
    });
    return colaborador_id;
}

function getServicio_id(agenda_id) {
    var url = '<?php echo SERVERURL; ?>php/citas/getServicio_id.php';
    var servicio_id;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: 'agenda_id=' + agenda_id,
        success: function(valores) {
            servicio_id = valores;
        }
    });
    return servicio_id;
}

function getNewAgendaID(pacientes_id, colaborador_id, servicio_id, fecha) {
    var url = '<?php echo SERVERURL; ?>php/citas/getNewAgendaId.php';
    var new_agenda_id;

    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: 'pacientes_id=' + pacientes_id + '&colaborador_id=' + colaborador_id + '&servicio_id=' +
            servicio_id + '&fecha=' + fecha,
        success: function(valores) {
            new_agenda_id = valores;
        }
    });
    return new_agenda_id;
}

$(document).ready(function() {
    $("#ModalDelete_enviar").attr('disabled', true);
    $('#checkeliminar').on('click', function() {
        if ($('#checkeliminar:checked').val() == 1) {
            $("#ModalDelete_enviar").attr('disabled', false);
        } else {
            $("#ModalDelete_enviar").attr('disabled', true);
        }
    });
});


function eliminarRegistro(id) {
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
        var url = '<?php echo SERVERURL; ?>php/citas/eliminar.php';

        $.ajax({
            type: 'POST',
            url: url,
            data: 'id=' + id,
            success: function(registro) {
                if (registro == 1) {
                    pagination_ausencias(1);
                    swal({
                        title: "Success",
                        text: "Registro eliminado con éxito",
                        type: "success",
                        timer: 3000,
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    return false;
                } else {
                    swal({
                        title: "Error",
                        text: "No se puede elimiar este registro",
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
    } else {
        swal({
            title: "Acceso Denegado",
            text: "No tiene permisos para ejecutar esta acción",
            type: "error",
            confirmButtonClass: "btn-danger",
            allowEscapeKey: false,
            allowOutsideClick: false
        });
    }
}

function clean_sobrecupo() {
    getJornada();
    getServiciosobrecupo();
    getHoraConsulta();
    getHoraConsultaSobrecupo()
    getTipoSobrecupo();
    $('#formulario_sobrecupo #pro_sobrecupo').val('Registro');
}

function getJornada() {
    var url = '<?php echo SERVERURL; ?>php/citas/getJornada.php';

    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_sobrecupo #jornada').html("");
            $('#formulario_sobrecupo #jornada').html(data);
        }
    });
    return false;
}

function getServiciosobrecupo() {
    var url = '<?php echo SERVERURL; ?>php/citas/servicios.php';

    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_sobrecupo #sobrecupo_servicio').html("");
            $('#formulario_sobrecupo #sobrecupo_servicio').html(data);
        }
    });
    return false;
}

$(document).ready(function() {
    $('#formulario_sobrecupo #sobrecupo_servicio').on('change', function() {
        var servicio_id = $('#formulario_sobrecupo #sobrecupo_servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getUnidad.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'servicio=' + servicio_id,
            success: function(data) {
                $('#formulario_sobrecupo #sobrecupo_unidad').html(data);
            }
        });

    });
});

$(document).ready(function() {
    $('#formulario_sobrecupo #sobrecupo_unidad').on('change', function() {
        var puesto_id = $('#formulario_sobrecupo #sobrecupo_unidad').val();
        var servicio_id = $('#formulario_sobrecupo #sobrecupo_servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getMedico.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'puesto_id=' + puesto_id + '&servicio=' + servicio_id,
            success: function(data) {
                $('#formulario_sobrecupo #sobrecupo_medico').html(data);
            }
        });

    });
});

/*VERIFICAR LA EXISTENCIA DEL USUARIO (PACIENTE)*/
$(document).ready(function(e) {
    $('#formulario_sobrecupo #sobrecupo_expediente').on('blur', function() {
        if ($('#formulario_sobrecupo #sobrecupo_expediente').val() != "") {
            var url = '<?php echo SERVERURL; ?>php/citas/buscar_expediente_consulta.php';
            var expediente = $('#formulario_sobrecupo #sobrecupo_expediente').val();
            $.ajax({
                type: 'POST',
                url: url,
                data: 'expediente=' + expediente,
                success: function(data) {
                    var array = eval(data);
                    if (array[0] == "Error") {
                        swal({
                            title: "Error",
                            text: "Registro no encontrado",
                            type: "error",
                            confirmButtonClass: "btn-danger",
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        });
                        $('#formulario_sobrecupo #paciente').val("");
                        clean_sobrecupo();
                        $("#formulario_sobrecupo #pro_sobrecupo").val("Registro");
                        $("#sobrecupo_agregar").attr('disabled', true);
                        return false;
                    } else if (array[0] == "Familiar") {
                        swal({
                            title: "Error",
                            text: "Registro no encontrado o puede  ser un familiar, por favor corregir",
                            type: "error",
                            confirmButtonClass: "btn-danger",
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        });
                        $('#paciente').val("");
                        clean_sobrecupo();
                        $("#formulario_sobrecupo #pro_sobrecupo").val("Registro");
                        $("#sobrecupo_agregar").attr('disabled', true);
                        return false;
                    } else {
                        $('#formulario_sobrecupo #sobrecupo_nombre').val(array[0]);
                        clean_sobrecupo();
                        $("#formulario_sobrecupo #pro_sobrecupo").val("Registro");
                    }
                }
            });
            return false;
        } else {
            $('#formulario_sobrecupo')[0].reset();
            $("#sobrecupo_agregar").attr('disabled', true);
            $("#formulario_sobrecupo #pro_sobrecupo").val("Registro");
        }
    });
});

function agregarSobrecupo() {
    var url = '<?php echo SERVERURL; ?>php/citas/agregarSobrecupo.php';

    $.ajax({
        type: 'POST',
        url: url,
        data: $('#formulario_sobrecupo').serialize(),
        success: function(registro) {
            if (registro == 1) {
                swal({
                    title: "Error",
                    text: "Este usuario es un adulto, no puede ser agendado en un la Unidad de Niños y Adolescentes",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else if (registro == 2) {
                swal({
                    title: "Error",
                    text: "Este usuario es un niño, no puede ser agendado en Consulta Externa para Adultos",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            }
            if (registro == 3) {
                reportePDF(getAgenda_id($('#formulario_sobrecupo #sobrecupo_expediente').val(), $(
                    '#formulario_sobrecupo #sobrecupo_fecha_cita').val(), $(
                    '#formulario_sobrecupo #sobrecupo_medico').val(), $(
                    '#formulario_sobrecupo #sobrecupo_servicio').val()));
                $('#formulario_sobrecupo')[0].reset();
                clean_sobrecupo();
                $('#formulario_sobrecupo #pro_sobrecupo').val('Registro');
                swal({
                    title: "Success",
                    text: "Registro completado con éxito",
                    type: "success",
                    timer: 3000,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                actualizarEventos();
                return false;
            } else if (registro == 4) {
                swal({
                    title: "Error",
                    text: "No se creo el sobre cupo, intentelo de nuevo más tarde",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else if (registro == 5) {
                swal({
                    title: "Error",
                    text: "Lo sentimos el Profesional tiene esta hora ocupada, o el usuario ya tiene cita para este día",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else if (registro == 6) {
                swal({
                    title: "Error",
                    text: "Lo sentimos este usuario ya tiene marcada una ausencia no se puede agendar nuevamente, por favor elimine la ausencia antes de continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else if (registro == 7) {
                swal({
                    title: "Error",
                    text: "El profesional tiene esta hora ocupada en otro servicio, por favor validar antes de continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            } else if (registro == 'NulaP') {
                swal({
                    title: "Error",
                    text: "No se puede agendar este usuario en esta hora",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalAdd_enviar").attr('disabled', true);
                return false;
            } else if (registro == 'NulaSError') {
                swal({
                    title: "Error",
                    text: "No se puede agendar este usuario en esta hora",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalAdd_enviar").attr('disabled', true);
                return false;
            } else if (registro == 'NuevosExcede') {
                swal({
                    title: "Error",
                    text: "No se puede agendar mas usuarios nuevos ya llego al límite",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalAdd_enviar").attr('disabled', true);
                return false;
            } else if (registro == 'SubsiguienteExcede') {
                swal({
                    title: "Error",
                    text: "No se puede agendar mas usuarios subsiguientes ya llego al límite",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                $("#ModalAdd_enviar").attr('disabled', true);
                return false;
            } else {
                swal({
                    title: "Error",
                    text: "Error al completar esta acción",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                return false;
            }
        }
    });
}

function getAgenda_id(expediente, fecha_cita, colaborador_id, servicio_id) {
    var url = '<?php echo SERVERURL; ?>php/citas/getAgenda.php';
    var agenda;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: 'expediente=' + expediente + '&fecha_cita=' + fecha_cita + '&colaborador_id=' + colaborador_id +
            '&servicio_id=' + servicio_id,
        success: function(data) {
            agenda = data;
        }
    });
    return agenda;
}

//VERIFICAR LA FECHA DE AUSENCIA DEL PROFESIONAL
$(document).ready(function(e) {
    $('#formulario_sobrecupo #sobrecupo_fecha_cita').on('change', function() {
        if (getFechaAusenciasSobreCupo($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 1) {
            swal({
                title: "Error",
                text: "El médico se encuentra ausente, no se le puede agendar una cita. " +
                    getComentarioAusencia($("#formulario_sobrecupo #sobrecupo_fecha_cita")
                    .val(), $('#formulario_sobrecupo #hora_sobrecupo').val()) + "",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            $('#botones_citas #medico_general').focus();

            $("#sobrecupo_agregar").attr('disabled', true);
        } else {
            $("#sobrecupo_agregar").attr('disabled', false);
        }
    });
});

function getFechaAusenciasSobreCupo(fecha) {
    var url = '<?php echo SERVERURL; ?>php/citas/getFechaAusencias.php';
    var colaborador_id = $('#formulario_sobrecupo #sobrecupo_medico').val();
    var valor = "";
    $.ajax({
        type: 'POST',
        url: url,
        data: 'fecha=' + fecha + '&colaborador_id=' + colaborador_id,
        async: false,
        success: function(data) {
            valor = data;
        }
    });
    return valor;
}

function getEdadConfig() {
    var url = '<?php echo SERVERURL; ?>php/citas/getEdadConfig.php';

    $.ajax({
        type: 'POST',
        url: url,
        success: function(data) {
            $('#formulario_config_edades #edad_devuelta').html("Valor por default: <strong>" + data +
                "</strong>");
        }
    });
}

function getFinSemana(fecha) {
    var url = '<?php echo SERVERURL; ?>php/citas/getFinSemana.php';

    var valor = "";
    $.ajax({
        type: 'POST',
        url: url,
        data: 'fecha=' + fecha,
        async: false,
        success: function(data) {
            valor = data;
        }
    });
    return valor;
}

function getStatusRepro() {
    var url = '<?php echo SERVERURL; ?>php/citas/getStatusID.php';

    $.ajax({
        type: "POST",
        url: url,
        success: function(data) {
            $('#mensaje_status #status_repro').html("");
            $('#mensaje_status #status_repro').html(data);
        }
    });
}

function modificarStatus() {
    var status_id = $('#mensaje_status #status_repro').val();
    var agenda_id = $('#mensaje_status #mensaje_status_agenda_id').val();
    var comentario = $('#mensaje_status #mensaje_status_comentario').val();

    if (status_id == "" || status_id == null) {
        status_id = 0;
    } else {
        status_id = $('#mensaje_status #status_repro').val();
    }

    var url = '<?php echo SERVERURL; ?>php/citas/addStatus.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: 'agenda_id=' + agenda_id + '&status_id=' + status_id + '&comentario=' + comentario,
        success: function(data) {
            if (data == 1) {
                swal({
                    title: "Success",
                    text: "Estatus Agregado Correctamente",
                    type: "success",
                    timer: 3000,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            } else {
                swal({
                    title: "Error",
                    text: "Error, está acción no se puedo procesar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            }
        }
    });
}

function getNombreUsuario(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/citas/getNombreUsuario.php';

    var valor = "";
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        success: function(data) {
            valor = data;
        }
    });
    return valor;
}

function sendEmail(agenda_id){
    var url = '<?php echo SERVERURL; ?>php/mail/correo_citas.php';

    $.ajax({
        type: 'POST',
        url: url,
        data: 'agenda_id=' + agenda_id,
        success: function(valores) {

        }
    });
}

function sendEmailCambioCita(agenda_id) {
    var url = '<?php echo SERVERURL; ?>php/mail/correo_cambio_citas.php';

    $.ajax({
        type: 'POST',
        url: url,
        data: 'agenda_id=' + agenda_id,
        success: function(valores) {

        }
    });
}

function sendEmailReprogramación(agenda_id) {
    var url = '<?php echo SERVERURL; ?>php/mail/correo_reprogramaciones.php';

    $.ajax({
        type: 'POST',
        url: url,
        data: 'agenda_id=' + agenda_id,
        success: function(valores) {

        }
    });
}

function getServicio() {
    var url = '<?php echo SERVERURL; ?>php/citas/getServicio.php';

    $.ajax({
        type: "POST",
        url: url,
        success: function(data) {
            $('#botones_citas #servicio').html("");
            $('#botones_citas #servicio').html(data);
        }
    });
}

//CONSULTAR INFORMACION DEL USUARIO
function consultarDepartamento(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarDepartamento.php';
    var departamento;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            departamento = data;
        }
    });
    return departamento;
}

function consultarMunicipio(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarMunicipio.php';
    var municipio;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            municipio = data;
        }
    });
    return municipio;
}

function consultarPais(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarPais.php';
    var pais;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            pais = data;
        }
    });
    return pais;
}

function consultarEstadoCivil(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarEstadoCivil.php';
    var estado_civil;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            estado_civil = data;
        }
    });
    return estado_civil;
}

function consultarRaza(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarRaza.php';
    var raza;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            raza = data;
        }
    });
    return raza;
}

function consultarReligion(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarReligion.php';
    var religion;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            religion = data;
        }
    });
    return religion;
}

function consultarProfesion(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarProfesion.php';
    var profesion;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            profesion = data;
        }
    });
    return profesion;
}

function consultarEscolaridad(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarEscolaridad.php';
    var escolaridad;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            escolaridad = data;
        }
    });
    return escolaridad;
}

function consultarLugarNacimiento(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarLugarNacimiento.php';
    var lugar_nacimiento;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            lugar_nacimiento = data;
        }
    });
    return lugar_nacimiento;
}

function consultarResponsable(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarResponsable.php';
    var responsable;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            responsable = data;
        }
    });
    return responsable;
}

function consultarParentesco(pacientes_id) {
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarParentesco.php';
    var parentesco;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'pacientes_id=' + pacientes_id,
        async: false,
        success: function(data) {
            parentesco = data;
        }
    });
    return parentesco;
}

//DEVUELVE EL PACIENTES_ID DEL USUARIO
function consultarExpediente(expediente) {
    var url = '<?php echo SERVERURL; ?>php/citas/consultarExpediente.php';
    var pacientes_id;

    $.ajax({
        type: 'POST',
        url: url,
        data: 'expediente=' + expediente,
        async: false,
        success: function(data) {
            pacientes_id = data;
        }
    });
    return pacientes_id;
}

function consultarFecha(fecha) {
    var url = '<?php echo SERVERURL; ?>php/citas/consultarFecha.php';
    var fecha;

    $.ajax({
        type: 'POST',
        url: url,
        data: 'fecha=' + fecha,
        async: false,
        success: function(data) {
            fecha = data;
        }
    });
    return fecha;
}
//FIN CONSULTAR INFORMACION DEL USUARIO

//BLOQUEO DE FINES DE SEMANA
$(document).ready(function(e) {
    $('#formulario_sobrecupo #sobrecupo_fecha_cita').on('change', function() {
        if (consultarFecha($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 6 ||
            consultarFecha($('#formulario_sobrecupo #sobrecupo_fecha_cita').val()) == 0) {
            swal({
                title: "Error",
                text: "No se permite agendar un fin de semana",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            $("#sobrecupo_agregar").attr('disabled', true);
            return false;
        } else {
            $("#sobrecupo_agregar").attr('disabled', false);
            return true;
        }
    });
});


function getFechaSistema() {
    var url = '<?php echo SERVERURL; ?>php/citas/getFechaSistema.php';
    var fecha_sistema;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        success: function(data) {
            fecha_sistema = data;
        }
    });
    return fecha_sistema;
}

function getProfesionalName(profesional) {
    var url = '<?php echo SERVERURL; ?>php/citas/getProfesionalName.php';
    var profesional;
    $.ajax({
        type: 'POST',
        url: url,
        data: 'profesional=' + profesional,
        async: false,
        success: function(data) {
            profesional = data;
        }
    });
    return profesional;
}


//INICIO DE BLOQUEQUEAR FECHA EN EL FORMULARIO DE SOBRECUPO
$(document).ready(function(e) {
    $('#formulario_sobrecupo #sobrecupo_fecha_cita').on('blur', function() {

        var fecha = $('#formulario_sobrecupo #sobrecupo_fecha_cita').val();
        var hoy = new Date();
        fecha_actual = convertDate(hoy);

        if (fecha < fecha_actual) {
            swal({
                title: "Error",
                text: "No se puede agregar un sobre cupo en esta fecha",
                type: "error",
                confirmButtonClass: "btn-danger",
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            $("#sobrecupo_agregar").attr('disabled', true);
        } else {
            $("#sobrecupo_agregar").attr('disabled', false);
        }
    });
});
//FIN DE BLOQUEQUEAR FECHA EN EL FORMULARIO DE SOBRECUPO

function getHoraConsulta() {
    var url = '<?php echo SERVERURL; ?>php/citas/getHoraCitas.php';

    $.ajax({
        type: "POST",
        url: url,
        success: function(data) {
            $('#form-editevent #hora_nueva').html("");
            $('#form-editevent #hora_nueva').html(data);
        }
    });
}

function getHoraConsultaSobrecupo() {
    var url = '<?php echo SERVERURL; ?>php/citas/getHoraConsultaSobreCupo.php';

    $.ajax({
        type: "POST",
        url: url,
        success: function(data) {
            $('#formulario_sobrecupo #hora_sobrecupo').html("");
            $('#formulario_sobrecupo #hora_sobrecupo').html(data);
        }
    });
}

function getTipoSobrecupo() {
    var url = '<?php echo SERVERURL; ?>php/citas/getTipoSobrecupo.php';

    $.ajax({
        type: "POST",
        url: url,
        success: function(data) {
            $('#formulario_sobrecupo #tipo_sobrecupo').html("");
            $('#formulario_sobrecupo #tipo_sobrecupo').html(data);
        }
    });
}

//INICIO MENU CONTEXTUAL, ELEMENTOS
//IMPRIMIR
$("#context-menu #menu-imprimir").on("click", function(e) {
    e.preventDefault();
    var agenda_id = $('#context-menu #context-agenda_id').val();
    reportePDF(agenda_id);
    $(this).parent().removeClass("show").hide();
});

//ELIMINAR CITA
$("#context-menu #menu-eliminar").on("click", function(e) {
    e.preventDefault();
    var pacientes_id = $('#context-menu #context-pacientes_id').val();
    var nombre_usuario = consultarNombre(pacientes_id);
    var expediente_usuario = consultarExpediente(pacientes_id);
    var dato;

    if (expediente_usuario == 0) {
        dato = nombre_usuario;
    } else {
        dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
    }

    swal({
        title: "¿Estas seguro?",
        text: "¿Desea remover la cita para el usuario: " + dato + "?",
        type: "input",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        cancelButtonText: "Cancelar",
        confirmButtonText: "¡Sí, remover la cita!",
        closeOnConfirm: false,
        inputPlaceholder: "Comentario",
        allowEscapeKey: false,
        allowOutsideClick: false
        },
        function(inputValue) {
            if (inputValue === false) return false;

            if (inputValue === "") {
                swal.showInputError("Necesitas escribir algo");
                return false
            }
            eliminar($('#context-menu #context-agenda_id').val(), inputValue);
            $(this).parent().removeClass("show").hide();
        });
});

$("#context-menu #menu-mover").on("click", function(e) {
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10) {
		$('#formTransferirServicio #pro').val('Registro');
		var agenda_id = $('#context-menu #context-agenda_id').val();
		var pacientes_id = $('#context-menu #context-pacientes_id').val();
		var url = '<?php echo SERVERURL; ?>php/citas/consultarDatosAgenda.php';

		$.ajax({
				type: 'POST',
				url: url,
				data: 'agenda_id=' + agenda_id,
				success: function(valores) {
					var datos = eval(valores);
					$('#formTransferirServicio #agenda_id').val(agenda_id);
					$('#formTransferirServicio #pacientes_id').val(pacientes_id);
					$('#formTransferirServicio #nombre').val(datos[0]);
					$('#formTransferirServicio #expediente').val(datos[1]);
					$('#formTransferirServicio #identidad').val(datos[2]);
					$('#formTransferirServicio #servicio_anterior').val(datos[3]);
					$('#formTransferirServicio #fecha').val(datos[4]);
					getServicioProfesional(datos[5]);
					$('#formTransferirServicio #servicio_id').val(datos[6]);

					$('#formTransferirServicio').attr({
						'data-form': 'save'
					});
					$('#formTransferirServicio').attr({
						'action': '<?php echo SERVERURL; ?>php/citas/transferirServicio.php'
					});

					$('#modalMoverServicioCitas').modal({
						show: true,
						keyboard: false,
						backdrop: 'static'
					});
					return false;
				}
		});
		$(this).parent().removeClass("show").hide();
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
//FIN MENU CONTEXTUAL, ELEMENTOS

function consultarNombre(pacientes_id) {
	var url = '<?php echo SERVERURL; ?>php/pacientes/getNombre.php';
	var resp;

	$.ajax({
		type: 'POST',
		url: url,
		data: 'pacientes_id=' + pacientes_id,
		async: false,
		success: function(data) {
			resp = data;
		}
	});
	return resp;
 }

function getServicioProfesional(colaborador_id) {
	var url = '<?php echo SERVERURL; ?>php/citas/getServicioProfesional.php';

	$.ajax({
		type: "POST",
		url: url,
		data: 'colaborador_id=' + colaborador_id,
		async: true,
		success: function(data) {
			$('#formTransferirServicio #servicio_nuevo').html("");
			$('#formTransferirServicio #servicio_nuevo').html(data);
		}
	});
}

$('#form-addevent #obs').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#form-addevent #charNum_citas_observacion').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresLocalidad(){
	var max_chars = 250;
	var chars = $('#form-addevent #obs').val().length;
	var diff = max_chars - chars;
	
	$('#form-addevent #charNum_citas_observacion').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}

$('#form-addevent #factura').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#form-addevent #charNum_citas_referencia_factura').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresLocalidad(){
	var max_chars = 250;
	var chars = $('#form-addevent #factura').val().length;
	var diff = max_chars - chars;
	
	$('#form-addevent #charNum_citas_referencia_factura').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}

$('#form-editevent #coment_1').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#form-editevent #charNum_editar_citas_comentario').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresEditarCitaComentario(){
	var max_chars = 250;
	var chars = $('#form-editevent #coment_1').val().length;
	var diff = max_chars - chars;
	
	$('#form-editevent #charNum_editar_citas_comentario').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}

$('#form-editevent #coment').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#form-editevent #charNum_editar_citas_comentario1').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresEditarCitaComentario1(){
	var max_chars = 250;
	var chars = $('#form-editevent #coment').val().length;
	var diff = max_chars - chars;
	
	$('#form-editevent #charNum_editar_citas_comentario1').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}

$('#form-editevent #coment1').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#form-editevent #charNum_editar_citas_observacion').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresEditarCitaObservacion(){
	var max_chars = 250;
	var chars = $('#form-editevent #coment1').val().length;
	var diff = max_chars - chars;
	
	$('#form-editevent #charNum_editar_citas_observacion').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}

$('#formBloqueoHora #bloqueo_obs').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#formBloqueoHora #charNum_bloqueo_obs').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresBloqueoHoras(){
	var max_chars = 250;
	var chars = $('#formBloqueoHora #bloqueo_obs').val().length;
	var diff = max_chars - chars;
	
	$('#formBloqueoHora #charNum_bloqueo_obs').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}
</script>