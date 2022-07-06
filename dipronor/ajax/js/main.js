$('.FormularioAjax').submit(function(e){
    e.preventDefault();
	
    var form=$(this);

    var tipo=form.attr('data-form');
    var action=form.attr('action');
    var method=form.attr('method');
    var respuesta=form.children('.RespuestaAjax');
	
    var msjError="<script>swal({title: 'Ocurrio un error inesperado', text: 'Por favor intenta de nuevo', type: 'error', confirmButtonClass: 'btn-danger'});</script>";
    var formdata = new FormData(this);

    var textoAlerta;
	var type;
	var classButtom;

    if(tipo=="save"){
        textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
		type = "info";
		classButtom = "btn-primary";		
    }else if(tipo=="delete"){
        textoAlerta="Los datos serán eliminados completamente del sistema";
		type = "warning";
		classButtom = "btn-warning";		
    }else if(tipo=="update"){
        textoAlerta="Los datos del sistema serán actualizados";
		type = "info";		
    }else{
        textoAlerta="¿Quieres realizar la operación solicitada?";
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
	  closeOnConfirm: false
	},
	function(){		
        $.ajax({
            type: method,
            url: action,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt){
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    if(percentComplete<100){
                        respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                      }else{
                          respuesta.html('<p class="text-center"></p>');
                      }
                  }
                }, false);
                return xhr;
            },
            success: function (data){
                respuesta.html(data);
			},
            error: function() {
                respuesta.html(msjError);			
            }
        });
        return false;
	});
});
//FIN LOGIN FORM

//INICIO BUSCAR DATOS EN TABLA
$(document).ready(function(){
  $("#formBuscarColaboradores #colaborador_id").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
}); 
//FIN BUSCAR DATOS EN TABLA
/*############################################################################################################################################################################################*/
/*############################################################################################################################################################################################*/
/*INICIO FORMULARIO COLABORADORES*/

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#modal_registrar_clientes").on('shown.bs.modal', function(){
        $(this).find('#formClientes #nombre_clientes').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_proveedores").on('shown.bs.modal', function(){
        $(this).find('#formProveedores #nombre_proveedores').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_colaboradores").on('shown.bs.modal', function(){
        $(this).find('#formColaboradores #nombre_colaborador').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_usuarios").on('shown.bs.modal', function(){
        $(this).find('#formUsers #colaborador_id_usuario').focus();
    });
});

$(document).ready(function(){
    $("#modal_buscar_colaboradores").on('shown.bs.modal', function(){
        $(this).find('#DatatableColaboradoresBusqueda #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_puestos").on('shown.bs.modal', function(){
        $(this).find('#formPuestos #puesto').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_secuencias").on('shown.bs.modal', function(){
        $(this).find('#formSecuencia #empresa_secuencia').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_empresa").on('shown.bs.modal', function(){
        $(this).find('#formEmpresa #empresa_razon_social').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_privilegios").on('shown.bs.modal', function(){
        $(this).find('#formPrivilegios #privilegios_nombre').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_tipoUsuario").on('shown.bs.modal', function(){
        $(this).find('#formTipoUsuario #tipo_usuario_nombre').focus();
    });
});

$(document).ready(function(){
    $("#modal_registrar_productos").on('shown.bs.modal', function(){
        $(this).find('#formProductos #producto').focus();
    });
});

$(document).ready(function(){
    $("#modal_buscar_colaboradores").on('shown.bs.modal', function(){
        $(this).find('#formulario_busqueda_coloboradores #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modal_movimientos").on('shown.bs.modal', function(){
        $(this).find('#formularioMovimientos #movimiento_categoria').focus();
    });
});

$(document).ready(function(){
    $("#modal_medidas").on('shown.bs.modal', function(){
        $(this).find('#formMedidas #medidas_medidas').focus();
    });
});

$(document).ready(function(){
    $("#modal_ubicacion").on('shown.bs.modal', function(){
        $(this).find('#formUbicacion #ubicacion_ubicacion').focus();
    });
});

$(document).ready(function(){
    $("#modal_almacen").on('shown.bs.modal', function(){
        $(this).find('#formAlmacen #almacen_almacen').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/


$('#formProductos #descripcion').keyup(function() {
	var max_chars = 100;
	var chars = $(this).val().length;
	var diff = max_chars - chars;
	
	$('#formProductos #charNum_descripcion').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
});

$('#invoice-form #notes').keyup(function() {
	var max_chars = 255;
	var chars = $(this).val().length;
	var diff = max_chars - chars;
	
	$('#invoice-form #charNum_notas').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip({
	  trigger: "hover"
  })
});