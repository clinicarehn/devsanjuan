/*
############################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################
*/
$('.FormularioAjax').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    var tipo = form.attr('data-form');
    var action = form.attr('action');
    var method = form.attr('method');
    var respuesta = form.children('.RespuestaAjax');

    var msjError = "<script></script>";
    var formdata = new FormData(this);

    var textoAlerta;
    var type;
    var classButtom;

    if (tipo == "save") {
        textoAlerta = "Los datos que enviaras quedaran almacenados en el sistema";
        type = "info";
        classButtom = "btn-primary";
    } else if (tipo == "delete") {
        textoAlerta = "Los datos serán eliminados completamente del sistema";
        type = "warning";
        classButtom = "btn-warning";
    } else if (tipo == "update") {
        textoAlerta = "Los datos del sistema serán actualizados";
        type = "info";
    } else {
        textoAlerta = "¿Quieres realizar la operación solicitada?";
        type = "warning";
        classButtom = "btn-primary";
        classButtom = "btn-warning";
    }

    swal({
            title: "¿Estas seguro?",
            text: textoAlerta,
            type: type,
            showCancelButton: true,
            confirmButtonClass: classButtom,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            allowEscapeKey: false,
            allowOutsideClick: false
        },
        function() {
            $.ajax({
                type: method,
                url: action,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            if (percentComplete < 100) {
                                respuesta.html('<p class="text-center">Procesado... (' + percentComplete + '%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: ' + percentComplete + '%;"></div></div>');
                            } else {
                                respuesta.html('<p class="text-center"></p>');
                            }
                        }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                    var datos = eval(data);
                    if (datos[0] == 'Error') {
                        swal({
                            title: datos[0],
                            text: datos[1],
                            type: datos[2],
                            confirmButtonClass: datos[3],
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        });
                    } else {
                        swal({
                            title: datos[0],
                            text: datos[1],
                            type: datos[2],
                            confirmButtonClass: datos[3],
                            timer: 3000,
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        });
                    }

                    if (datos[4] != "") {
                        $('#' + datos[4])[0].reset();
                        $('#' + datos[4] + ' #pro').val(datos[5]);
                    }

                    if (datos[7] != "") {
                        $('#' + datos[7]).modal('hide');
                    }

                    llenarTabla(datos[6]);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
            return false;
        });
});

/*##########################################################################################################################################################################################################################################################################################################################*/
//INICIO IDIOMA
var idioma_español = {
        "processing": "Procesando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "search": "Buscar:",
        "infoThousands": ",",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad",
            "collection": "Colección",
            "colvisRestore": "Restaurar visibilidad",
            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
            "copySuccess": {
                "1": "Copiada 1 fila al portapapeles",
                "_": "Copiadas %d fila al portapapeles"
            },
            "copyTitle": "Copiar al portapapeles",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
                "-1": "Mostrar todas las filas",
                "1": "Mostrar 1 fila",
                "_": "Mostrar %d filas"
            },
            "pdf": "PDF",
            "print": "Imprimir"
        },
        "autoFill": {
            "cancel": "Cancelar",
            "fill": "Rellene todas las celdas con <i>%d<\/i>",
            "fillHorizontal": "Rellenar celdas horizontalmente",
            "fillVertical": "Rellenar celdas verticalmentemente"
        },
        "decimal": ",",
        "searchBuilder": {
            "add": "Añadir condición",
            "button": {
                "0": "Constructor de búsqueda",
                "_": "Constructor de búsqueda (%d)"
            },
            "clearAll": "Borrar todo",
            "condition": "Condición",
            "conditions": {
                "date": {
                    "after": "Despues",
                    "before": "Antes",
                    "between": "Entre",
                    "empty": "Vacío",
                    "equals": "Igual a",
                    "not": "No",
                    "notBetween": "No entre",
                    "notEmpty": "No Vacio"
                },
                "moment": {
                    "after": "Despues",
                    "before": "Antes",
                    "between": "Entre",
                    "empty": "Vacío",
                    "equals": "Igual a",
                    "not": "No",
                    "notBetween": "No entre",
                    "notEmpty": "No vacio"
                },
                "number": {
                    "between": "Entre",
                    "empty": "Vacio",
                    "equals": "Igual a",
                    "gt": "Mayor a",
                    "gte": "Mayor o igual a",
                    "lt": "Menor que",
                    "lte": "Menor o igual que",
                    "not": "No",
                    "notBetween": "No entre",
                    "notEmpty": "No vacío"
                },
                "string": {
                    "contains": "Contiene",
                    "empty": "Vacío",
                    "endsWith": "Termina en",
                    "equals": "Igual a",
                    "not": "No",
                    "notEmpty": "No Vacio",
                    "startsWith": "Empieza con"
                }
            },
            "data": "Data",
            "deleteTitle": "Eliminar regla de filtrado",
            "leftTitle": "Criterios anulados",
            "logicAnd": "Y",
            "logicOr": "O",
            "rightTitle": "Criterios de sangría",
            "title": {
                "0": "Constructor de búsqueda",
                "_": "Constructor de búsqueda (%d)"
            },
            "value": "Valor"
        },
        "searchPanes": {
            "clearMessage": "Borrar todo",
            "collapse": {
                "0": "Paneles de búsqueda",
                "_": "Paneles de búsqueda (%d)"
            },
            "count": "{total}",
            "countFiltered": "{shown} ({total})",
            "emptyPanes": "Sin paneles de búsqueda",
            "loadMessage": "Cargando paneles de búsqueda",
            "title": "Filtros Activos - %d"
        },
        "select": {
            "1": "%d fila seleccionada",
            "_": "%d filas seleccionadas",
            "cells": {
                "1": "1 celda seleccionada",
                "_": "$d celdas seleccionadas"
            },
            "columns": {
                "1": "1 columna seleccionada",
                "_": "%d columnas seleccionadas"
            }
        },
        "thousands": "."
    }
    //FIN IDIOMA

//INICIO CONVETIR IMAGEN BASE 64
function toDataURL(src, callback, outputFormat) {
    var img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function() {
        var canvas = document.createElement('CANVAS');
        var ctx = canvas.getContext('2d');
        var dataURL;
        canvas.height = this.naturalHeight;
        canvas.width = this.naturalWidth;
        ctx.drawImage(this, 0, 0);
        dataURL = canvas.toDataURL(outputFormat);
        callback(dataURL);
    };
    img.src = src;
    if (img.complete || img.complete === undefined) {
        img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
        img.src = src;
    }
}
//FIN CONVERTIR IMAGEN BASE 64

var imagen;
toDataURL(
    '../img/logo.png',
    function(dataUrl) {
        imagen = dataUrl;
    }
)

//INICIO DATATABLE OPCIONES
var lengthMenu10 = [
    [10, 20, 30, 50, 100, -1],
    [10, 20, 30, 50, 100, "Todo"]
];
var lengthMenu5 = [
    [5, 10, 20, 30, 50, 100, -1],
    [5, 10, 20, 30, 50, 100, "Todo"]
];

var dom = "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>";
//FIN DATATABLE OPCIONES
/*##########################################################################################################################################################################################################################################################################################################################*/

/*##########################################################################################################################################################################################################################################################################################################################*/
//INICIO ACCIONES FORMULARIO ENTREVISTA TRABAJO SOCIAL
function cleanEntrevistaTS() {
    getModalidad();
    getTrabajadorSocial();
    getSolicitadoPor();
    getRelacion();
    getClasificacion1();
    getClasificacion2();
    getClasificacion3();
    getServicioTS();
    getIntervencion();
}

function getModalidad() {
    var url = '../php/atas/getModalidad.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #modalidad').html("");
            $('#formulario_entrevista_trabajo_social #modalidad').html(data);
        }
    });
}

function getTrabajadorSocial() {
    var url = '../php/atas/getTrabajadorSocial.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #trabajador_social').html("");
            $('#formulario_entrevista_trabajo_social #trabajador_social').html(data);
        }
    });
}

function getSolicitadoPor() {
    var url = '../php/atas/getSolicitadoPor.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #solicitado').html("");
            $('#formulario_entrevista_trabajo_social #solicitado').html(data);
        }
    });
}

function getRelacion() {
    var url = '../php/atas/getRelacion.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #relacion').html("");
            $('#formulario_entrevista_trabajo_social #relacion').html(data);
        }
    });
}

function getServicioTS() {
    var url = '../php/atas/servicioTS.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #servicio_id').html("");
            $('#formulario_entrevista_trabajo_social #servicio_id').html(data);
        }
    });
}

function getClasificacion3() {
    var url = '../php/atas/getClasificacion.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #clasificacion3').html("");
            $('#formulario_entrevista_trabajo_social #clasificacion3').html(data);
        }
    });
}

function getIntervencion() {
    var url = '../php/atas/getIntervencion.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #intervencion').html("");
            $('#formulario_entrevista_trabajo_social #intervencion').html(data);
        }
    });
}

function getClasificacion1() {
    var url = '../php/atas/getClasificacion.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #clasificacion1').html("");
            $('#formulario_entrevista_trabajo_social #clasificacion1').html(data);
        }
    });
}

function getClasificacion2() {
    var url = '../php/atas/getClasificacion.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_entrevista_trabajo_social #clasificacion2').html("");
            $('#formulario_entrevista_trabajo_social #clasificacion2').html(data);
        }
    });
}

$('#formulario_entrevista_trabajo_social #motivo').keyup(function() {
    var max_chars = 255;
    var chars = $(this).val().length;
    var diff = max_chars - chars;

    $('#formulario_entrevista_trabajo_social #charNumMotivoE').html(diff + ' Caracteres');

    if (diff == 0) {
        return false;
    }
});

$('#formulario_entrevista_trabajo_social #desarrollo').keyup(function() {
    var max_chars = 255;
    var chars = $(this).val().length;
    var diff = max_chars - chars;

    $('#formulario_entrevista_trabajo_social #charNumDesarrollo').html(diff + ' Caracteres');

    if (diff == 0) {
        return false;
    }
});

$('#formulario_entrevista_trabajo_social #valoracion').keyup(function() {
    var max_chars = 255;
    var chars = $(this).val().length;
    var diff = max_chars - chars;

    $('#formulario_entrevista_trabajo_social #charNumValoracion').html(diff + ' Caracteres');

    if (diff == 0) {
        return false;
    }
});

$('#formulario_entrevista_trabajo_social #observaciones').keyup(function() {
    var max_chars = 255;
    var chars = $(this).val().length;
    var diff = max_chars - chars;

    $('#formulario_entrevista_trabajo_social #charNumSituacion').html(diff + ' Caracteres');

    if (diff == 0) {
        return false;
    }
});

//OBTENER EL USUAIRO DE SISTEMA
function getUsuarioSistema() {
    var url = '../php/sesion/sistema_tipo_usuario.php';
    var usuario;
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        success: function(data) {
            usuario = data;
        }
    });
    return usuario;
}
//INICIO ACCIONES FORMULARIO ENTREVISTA TRABAJO SOCIAL
/*##########################################################################################################################################################################################################################################################################################################################*/

function llenarTabla(dato) {
    if (dato == "EntrevistaTS") {
        listar_entrevista_ts();
    }

    if (dato == "BloqueoHora") {
        actualizarEventos();
    }

    if (dato == "RecetaMedica") {
        listar_busqueda_productos();
        $('#main').show();
        $('#label_acciones_receta').html("");
        $('#receta_medica').hide();
        $('#acciones_atras').addClass("breadcrumb-item active");
        $('#acciones_factura').removeClass("active");
    }

    if (dato == "ReporteRecetaMedica") {
        listar_receta();
        listar_busqueda_productos();
        getServicioReceta();
        $('#reporteReceta').show();
        $('#label_acciones_receta').html("");
        $('#receta_medica').hide();
        $('#acciones_atras').addClass("breadcrumb-item active");
        $('#acciones_factura').removeClass("active");
    }
}

function getViaReceta(row, via) {
    var url = '../php/atas/getVia.php';

    if (row == "" || row == 0) {
        row = 0;
    }
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_receta_medica #via_' + row).html(data);
            $('#formulario_receta_medica #via_' + row).val(via);
        }
    });
}


function getServicioRecetaATA() {
    var url = '../php/atas/servicios_ata.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_receta_medica #servicio_receta').html("");
            $('#formulario_receta_medica #servicio_receta').html(data);
        }
    });
}

function getServicioReceta() {
    var url = '../php/citas/servicios.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        success: function(data) {
            $('#formulario_receta_medica #servicio_receta').html("");
            $('#formulario_receta_medica #servicio_receta').html(data);
        }
    });
}

$(function() {
    $('[data-toggle="tooltip"]').tooltip({
        trigger: "hover"
    })
});

var lengthMenu = [
    [5, 10, 20, 50, 100, -1],
    [5, 10, 20, 50, 100, 'Todos']
];

//REFRESCAR LA SESION CADA CIERTO TIEMPO PARA QUE NO EXPIRE
document.addEventListener("DOMContentLoaded", function() {
    // Invocamos cada 5 segundos ;)
    const milisegundos = 5 * 1000;
    setInterval(function() {
        // No esperamos la respuesta de la petición porque no nos importa
        fetch("../php/signin_out/refrescar.php");
    }, milisegundos);
});

//INICIO BUSQUEDA PRODUCTOS FACTURA
$(document).ready(function() {
    $("#formulario_facturacion #recetaItem").on('click', '.buscar_producto', function() {
        listar_productos_facturas_buscar();
        var row_index = $(this).closest("tr").index();
        var col_index = $(this).closest("td").index();

        $('#formulario_busqueda_productos_facturas #row').val(row_index);
        $('#formulario_busqueda_productos_facturas #col').val(col_index);
        $('#modal_busqueda_productos_facturas').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
    });
});
//FIN BUSQUEDA PRODUCTOS FACTURA

var listar_productos_facturas_buscar = function() {
    var table_productos_buscar = $("#dataTableProductosFacturas").DataTable({
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "../php/facturacion/getProductosFacturaTabla.php"
        },
        "columns": [
            { "defaultContent": "<button class='editar btn btn-primary'><span class='fas fa-copy'></span></button>" },
            { "data": "producto" },
            { "data": "descripcion" },
            { "data": "concentracion" },
            { "data": "medida" },
            { "data": "cantidad" },
            { "data": "precio_venta" }
        ],
        "pageLength": 5,
        "lengthMenu": lengthMenu,
        "stateSave": true,
        "bDestroy": true,
        "language": idioma_español,
    });
    table_productos_buscar.search('').draw();
    $('#buscar').focus();

    editar_productos_busqueda_dataTable("#dataTableProductosFacturas tbody", table_productos_buscar);
}

var editar_productos_busqueda_dataTable = function(tbody, table) {
        $(tbody).off("click", "button.editar");
        $(tbody).on("click", "button.editar", function(e) {
            e.preventDefault();
            if ($("#formulario_facturacion #cliente_nombre").val() != "") {
                var data = table.row($(this).parents("tr")).data();
                var row = $('#formulario_busqueda_productos_facturas #row').val();

                if (data.categoria == "Servicio") {
                    $('#formulario_facturacion #recetaItem #productName_' + row).val(data.producto);
                } else {
                    $('#formulario_facturacion #recetaItem #productName_' + row).val(data.producto + ' ' + data.concentracion + ' ' + data.medida);
                }
                $('#formulario_facturacion #recetaItem #productoID_' + row).val(data.productos_id);
                $('#formulario_facturacion #recetaItem #price_' + row).val(data.precio_venta);
                $('#formulario_facturacion #recetaItem #isv_' + row).val(data.impuesto_venta);
                $('#formulario_facturacion #recetaItem #discount_' + row).val(0);
                $('#formulario_facturacion #recetaItem #quantity_' + row).val(1);
                $('#formulario_facturacion #recetaItem #quantity_' + row).focus();

                calculateTotal();
                addRow();
                $('#modal_busqueda_productos_facturas').modal('hide');
            } else {
                swal({
                    title: "Error",
                    text: "Lo sentimos no se puede seleccionar un producto, por favor seleccione un cliente antes de poder continuar",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            }
        });
    }
    //FIN FUNCIONES PARA LLENAR DATOS EN LA TABLA

function llenarTablaReceta(count) {
    var htmlRows = '';
    htmlRows += '<tr>';
    htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
    htmlRows += '<td><input type="hidden" name="productCode[]" id="productCode_' + count + '" class="form-control" placeholder="Producto ISV" autocomplete="off"><input type="hidden" name="product[]" id="product_' + count + '" class="form-control" placeholder="Valor ISV" autocomplete="off"><input type="hidden" name="concentracion[]" id="concentracion_' + count + '" class="form-control" placeholder="Código Producto" autocomplete="off"><input type="hidden" name="unidad[]" id="unidad_' + count + '" class="form-control" placeholder="Código Producto" autocomplete="off"><div class="input-group mb-3"><input type="text" name="productName[]" id="productName_' + count + '" class="form-control producto" placeholder="Producto o Servicio" autocomplete="off"><div id="suggestions_producto_0" class="suggestions"></div><div class="input-group-append" id="grupo_buscar_colaboradores"><a data-toggle="modal" href="#" class="btn btn-outline-success buscar_productos"><div class="sb-nav-link-icon"></div><i class="buscar_producto fas fa-search-plus fa-lg"></i></a></div></div></td>';
    htmlRows += '<td><select name="via[]" id="via_' + count + '" class="form-control"></select></td>';
    htmlRows += '<td><input type="text" step="0.01 name="quanty[]" id="quanty_' + count + '" class="form-control" placeholder="Cantidad" autocomplete="off"></td>';
    htmlRows += '<td><input type="text" step="0.01 name="manana[]" id="manana_' + count + '" class="form-control manana" placeholder="Mañana" autocomplete="off"></td>';
    htmlRows += '<td><input type="text" step="0.01 name="mediodia[]" id="mediodia_' + count + '" class="form-control mediodia" placeholder="Mediodia" autocomplete="off"></td>';
    htmlRows += '<td><input type="text" step="0.01 name="tarde[]" id="tarde_' + count + '" class="form-control tarde" placeholder="Tarde" autocomplete="off"></td>';
    htmlRows += '<td><input type="text" step="0.01 name="noche[]" id="noche_' + count + '" class="form-control noche" placeholder="Noche" autocomplete="off"></td>';
    htmlRows += '</tr>';
    $('#recetaItem tbody').append(htmlRows);
}


document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    }))
});


//LLAMAR MENU CONTEXTUAL
$('.jumbotron').on('contextmenu', function(e) {
    var top = e.pageY - 10;
    var left = e.pageX - 90;
    $("#context-menu").css({
        display: "block",
        top: top,
        left: left
    }).addClass("show");
    return false; //blocks default Webbrowser right click menu
}).on("click", function() {
    $("#context-menu").removeClass("show").hide();
});

$("#context-menu a").on("click", function() {
    $(this).parent().removeClass("show").hide();
});