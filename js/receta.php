<script>
//INICIO ACCIONES FROMULARIO BUSQUEDA PRODUCTOS
$(document).ready(function(){
	$("#formulario_receta_medica #recetaItem").on('click', '.buscar_producto', function() {
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

var listar_busqueda_productos = function(){
	var table_busqueda_productos = $("#dataTableProductos").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/productos/getProductosTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-info'><span class='far fa-eye'></span></button>"},
			{"data":"producto"},
			{"data":"concentracion"},
			{"data":"unidad"}
		],
        "lengthMenu": lengthMenu5,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,//esta se encuenta en el archivo main.js
	});
	table_busqueda_productos.search('').draw();
	$('#buscar').focus();

	view_productos_dataTable("#dataTableProductos tbody", table_busqueda_productos);
}

var view_productos_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		var row = $('#formulario_busqueda_productos #row').val();
		$('#formulario_receta_medica #recetaItem #productCode_'+ row).val(data.template_codigo);
		$('#formulario_receta_medica #recetaItem #product_'+ row).val(data.producto);
		$('#formulario_receta_medica #recetaItem #concentracion_'+ row).val(data.concentracion);
		$('#formulario_receta_medica #recetaItem #unidad_'+ row).val(data.unidad);
		$('#formulario_receta_medica #recetaItem #productName_'+ row).val(data.producto + ' ' + data.concentracion + ' ' + data.unidad);
		$('#formulario_receta_medica #recetaItem #quanty_'+ row).val(1);
		$('#formulario_receta_medica #recetaItem #quanty_'+ row).focus();
		addRow();
		getVia(parseInt(row));
		$('#modal_productos').modal('hide');
	});
}
//FIN ACCIONES FROMULARIO BUSQUEDA PRODUCTOS

function limpiarTabla(){
	$("#formulario_receta_medica #recetaItem > tbody").empty();//limpia solo los registros del body
	var count = 0;
	var htmlRows = '';
	htmlRows += '<tr>';
	htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
	htmlRows += '<td><input type="hidden" name="productCode[]" id="productCode_'+count+'" class="form-control" placeholder="Producto ISV" autocomplete="off"><input type="hidden" name="product[]" id="product_'+count+'" class="form-control" placeholder="Valor ISV" autocomplete="off"><input type="hidden" name="concentracion[]" id="concentracion_'+count+'" class="form-control" placeholder="Código Producto" autocomplete="off"><input type="hidden" name="unidad[]" id="unidad_'+count+'" class="form-control" placeholder="Código Producto" autocomplete="off"><div class="input-group mb-3"><input type="text" name="productName[]" id="productName_'+count+'" class="form-control producto" placeholder="Producto o Servicio" autocomplete="off"><div id="suggestions_producto_'+count+'" class="suggestions"></div><div class="input-group-append" id="producto_grupo"><a data-toggle="modal" href="#" class="btn btn-outline-success buscar_productos"><div class="sb-nav-link-icon"></div><i class="buscar_producto fas fa-search-plus fa-lg"></i></a></div></div></td>';
	htmlRows += '<td><select name="via[]" id="via_'+count+'" class="form-control"></select></td>';
	htmlRows += '<td><input type="text" step="0.01" name="quanty[]" id="quanty_'+count+'" class="form-control" placeholder="Cantidad" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="manana[]" id="manana_'+count+'" class="form-control manana" placeholder="Mañana" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="mediodia[]" id="mediodia_'+count+'" class="form-control mediodia" placeholder="Mediodia" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="tarde[]" id="tarde_'+count+'" class="form-control tarde" placeholder="Tarde" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="noche[]" id="noche_'+count+'" class="form-control noche" placeholder="Noche" autocomplete="off"></td>';
	htmlRows += '</tr>';
	$('#recetaItem tbody').append(htmlRows);
}

function addRow(){
	var count = $("#recetaItem .itemRow").length;
	getVia(parseInt(count));
	var htmlRows = '';
	htmlRows += '<tr>';
	htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
	htmlRows += '<td><input type="hidden" name="productCode[]" id="productCode_'+count+'" class="form-control" placeholder="Producto ISV" autocomplete="off"><input type="hidden" name="product[]" id="product_'+count+'" class="form-control" placeholder="Valor ISV" autocomplete="off"><input type="hidden" name="concentracion[]" id="concentracion_'+count+'" class="form-control" placeholder="Código Producto" autocomplete="off"><input type="hidden" name="unidad[]" id="unidad_'+count+'" class="form-control" placeholder="Código Producto" autocomplete="off"><div class="input-group mb-3"><input type="text" name="productName[]" id="productName_'+count+'" class="form-control producto" placeholder="Producto o Servicio" autocomplete="off"><div id="suggestions_producto_'+count+'" class="suggestions"></div><div class="input-group-append" id="producto_grupo"><a data-toggle="modal" href="#" class="btn btn-outline-success buscar_productos"><div class="sb-nav-link-icon"></div><i class="buscar_producto fas fa-search-plus fa-lg"></i></a></div></div></td>';
	htmlRows += '<td><select name="via[]" id="via_'+count+'" class="form-control"></select></td>';
	htmlRows += '<td><input type="text" step="0.01" name="quanty[]" id="quanty_'+count+'" class="form-control" placeholder="Cantidad" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="manana[]" id="manana_'+count+'" class="form-control manana" placeholder="Mañana" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="mediodia[]" id="mediodia_'+count+'" class="form-control mediodia" placeholder="Mediodia" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="tarde[]" id="tarde_'+count+'" class="form-control tarde" placeholder="Tarde" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="noche[]" id="noche_'+count+'" class="form-control noche" placeholder="Noche" autocomplete="off"></td>';
	htmlRows += '</tr>';
	$('#recetaItem tbody').append(htmlRows);
}

function llenarReceta(count){
	getVia(parseInt(count));
	var htmlRows = '';
	htmlRows += '<tr>';
	htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
	htmlRows += '<td><input type="hidden" name="productCode[]" id="productCode_'+count+'" class="form-control" placeholder="Producto ISV" autocomplete="off"><input type="hidden" name="product[]" id="product_'+count+'" class="form-control" placeholder="Valor ISV" autocomplete="off"><input type="hidden" name="concentracion[]" id="concentracion_'+count+'" class="form-control" placeholder="Código Producto" autocomplete="off"><input type="hidden" name="unidad[]" id="unidad_'+count+'" class="form-control" placeholder="Código Producto" autocomplete="off"><div class="input-group mb-3"><input type="text" name="productName[]" id="productName_'+count+'" class="form-control producto" placeholder="Producto o Servicio" autocomplete="off"><div id="suggestions_producto_'+count+'" class="suggestions"></div><div class="input-group-append" id="producto_grupo"><a data-toggle="modal" href="#" class="btn btn-outline-success buscar_productos"><div class="sb-nav-link-icon"></div><i class="buscar_producto fas fa-search-plus fa-lg"></i></a></div></div></td>';
	htmlRows += '<td><select name="via[]" id="via_'+count+'" class="form-control"></select></td>';
	htmlRows += '<td><input type="text" step="0.01" name="quanty[]" id="quanty_'+count+'" class="form-control" placeholder="Cantidad" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="manana[]" id="manana_'+count+'" class="form-control manana" placeholder="Mañana" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="mediodia[]" id="mediodia_'+count+'" class="form-control mediodia" placeholder="Mediodia" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="tarde[]" id="tarde_'+count+'" class="form-control tarde" placeholder="Tarde" autocomplete="off"></td>';
	htmlRows += '<td><input type="text" step="0.01" name="noche[]" id="noche_'+count+'" class="form-control noche" placeholder="Noche" autocomplete="off"></td>';
	htmlRows += '</tr>';
	$('#recetaItem tbody').append(htmlRows);
}

$(document).ready(function(){
	$(document).on('click', '#checkAll', function() {
		$(".itemRow").prop("checked", this.checked);
	});
	$(document).on('click', '.itemRow', function() {
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() {
		if($("#formulario_receta_medica #expediente").val() != ""){
			addRow();
		}else{
			swal({
				title: "Error",
				text: "Lo sentimos no puede agregar más filas, debe seleccionar un usuario antes de poder continuar",
				type: "error",
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		}
	});
	$(document).on('click', '#removeRows', function(){
		if ($('.itemRow ').is(':checked') ){
			$(".itemRow:checked").each(function() {
				$(this).closest('tr').remove();
				count--;
			});
			$('#checkAll').prop('checked', false);
		}else{
			swal({
				title: "Error",
				text: "Lo sentimos debe seleccionar un fila antes de intentar eliminarla",
				type: "error",
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		}
	});
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}
	});
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});

/*INICIO AUTO COMPLETAR*/
/*INICIO SUGGESTION PRODUCTO*/
$("#formulario_receta_medica #recetaItem").on('click', '.producto', function() {
	var row = $(this).closest("tr").index();
	var col = $(this).closest("td").index();

    $('#formulario_receta_medica #recetaItem #productName_'+ row).on('keyup', function() {
	   if($('#formulario_receta_medica #recetaItem #productName_'+ row).val() != ""){
			 var key = $(this).val();
			 var dataString = 'key='+key;
			 var url = '<?php echo SERVERURL; ?>php/productos/autocompletarProductos.php';

			$.ajax({
			   type: "POST",
			   url: url,
			   data: dataString,
			   success: function(data) {
				  //Escribimos las sugerencias que nos manda la consulta
				  $('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeIn(1000).html(data);
				  //Al hacer click en algua de las sugerencias
				  $('.suggest-element').on('click', function(){
						//Obtenemos la id unica de la sugerencia pulsada
						var id = $(this).attr('id');

						var dataString = 'productos_id='+id;

						//Editamos el valor del input con data de la sugerencia pulsada
						$('#formulario_receta_medica #recetaItem #productName_'+ row).val($('#'+id).attr('data'));
						$('#formulario_receta_medica #recetaItem #quanty_'+ row).focus();
						//Hacemos desaparecer el resto de sugerencias
						$('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeOut(1000);
						addRow();
						getVia(parseInt(row));
						return false;
				 });
			  }
		   });
	   }else{
		   $('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeIn(1000).html("");
		   $('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeOut(1000);
	   }
	 });

	//OCULTAR EL SUGGESTION
    $('#formulario_receta_medica #recetaItem #productName_'+ row).on('blur', function() {
	   $('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeOut(1000);
    });

    $('#formulario_receta_medica #recetaItem #productName_'+ row).on('click', function() {
	   if($('#formulario_receta_medica #recetaItem #productName_1').val() != ""){
			 var key = $(this).val();
			 var dataString = 'key='+key;
			 var url = '<?php echo SERVERURL; ?>php/productos/autocompletarProductos.php';

			$.ajax({
			   type: "POST",
			   url: url,
			   data: dataString,
			   success: function(data) {
				  //Escribimos las sugerencias que nos manda la consulta
				  $('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeIn(1000).html(data);
				  //Al hacer click en algua de las sugerencias
				  $('.suggest-element').on('click', function(){
						//Obtenemos la id unica de la sugerencia pulsada
						var id = $(this).attr('id');

						var dataString = 'productos_id='+id;

						//Editamos el valor del input con data de la sugerencia pulsada
						$('#formulario_receta_medica #recetaItem #productName_'+ row).val($('#'+id).attr('data'));
						$('#formulario_receta_medica #recetaItem #quanty_'+ row).focus();
						//Hacemos desaparecer el resto de sugerencias
						$('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeOut(1000);

						addRow();
						getVia(parseInt(row));
						return false;
				 });
			  }
		   });
	   }else{
		   $('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeIn(1000).html("");
		   $('#formulario_receta_medica #recetaItem #suggestions_producto_'+ row).fadeOut(1000);
	   }
	});
});
/*FIN SUGGESTION PRODUCTO*/
/*FIN AUTO COMPLETAR*/

//INICIO BOTOES RECETA MEDICA
$('#formulario_receta_medica #bt_add').on('click', function(e){
	e.preventDefault();
});

$('#formulario_receta_medica #bt_del').on('click', function(e){
	e.preventDefault();
});
//FIN BOTONES RECETA MEDICA

function getVia(row){
    var url = '<?php echo SERVERURL; ?>php/atas/getVia.php';

	if(row == "" || row == 0){
		row = 0;
	}
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
			$('#formulario_receta_medica #via_' + row).html(data);
		}
     });
}

$('#formulario_receta_medica #buscar_servicio_receta_electronica').on('click', function(e){
	listar_servicio_receta_electronica();
	$('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

var listar_servicio_receta_electronica = function(){
	var table_servicio_receta_medica  = $("#dataTableServicios").DataTable({
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
	table_servicio_receta_medica.search('').draw();
	$('#buscar').focus();

	view_servicio_receta_medica_dataTable("#dataTableServicios tbody", table_servicio_receta_medica);
}

var view_servicio_receta_medica_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#formulario_receta_medica #servicio_receta').val(data.servicio_id);
		consultarServicioReceta();
		$('#modal_busqueda_servicios').modal('hide');
	});
}

function consultarServicioReceta(){
	var servicio_id = $('#formulario_receta_medica #servicio_receta').val();
	var fecha = $('#formulario_receta_medica #fecha').val();
	var pacientes_id = $('#formulario_receta_medica #pacientes_id').val();
	var colaborador_id = getColaborador();
	var url = '<?php echo SERVERURL; ?>php/receta/validarAtencion.php';

	$.ajax({
		type: "POST",
		url: url,
		async: true,
		data:'servicio_id='+servicio_id+'&fecha='+fecha+'&pacientes_id='+pacientes_id+'&colaborador_id='+colaborador_id,
		success: function(data){
			if(data == 1){
				swal({
					title: "Error",
					text: "Lo sentimos, este usuario no cuenta con atención almacenada, por favor verifique si se presentó a cita o si tiene una cita pendiente para este día",
					type: "error",
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_receta_medica #validar').attr("disabled", true);
				$('#formulario_receta_medica #addRows').attr("disabled", true);
				$('#formulario_receta_medica #removeRows').attr("disabled", true);
			}else{
				$('#formulario_receta_medica #validar').attr("disabled", false);
				$('#formulario_receta_medica #addRows').attr("disabled", false);
				$('#formulario_receta_medica #removeRows').attr("disabled", false);
			}
		}
	 });
}

$('#formulario_receta_medica #observaciones').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;

		$('#formulario_receta_medica #charNum_notas').html(diff + ' Caracteres');

		if(diff == 0){
			return false;
		}
});

function caracteresObservacionReceta(){
	var max_chars = 250;
	var chars = $('#formulario_receta_medica #observaciones').val().length;
	var diff = max_chars - chars;
	
	$('#formulario_receta_medica #charNum_notas').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}

/*
//CALCULO DEL TOTAL PARA CADA DOSIS POR LINEA
$(document).ready(function(){
	$("#formulario_receta_medica #recetaItem").on('blur', '.manana', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		//OBTENER LOS VALORES DE LAS DOSIS
		var total = 0;
		var manana = $('#formulario_receta_medica #recetaItem #manana_' + row_index).val();
		var mediodia = $('#formulario_receta_medica #recetaItem #mediodia_' + row_index).val();
		var tarde = $('#formulario_receta_medica #recetaItem #tarde_' + row_index).val();
		var noche = $('#formulario_receta_medica #recetaItem #noche_' + row_index).val();

		if(!manana) {
			manana = 0;
		}

		if(!mediodia) {
			mediodia = 0;
		}

		if(!tarde) {
			tarde = 0;
		}

		if(!noche) {
			noche = 0;
		}

		total = parseFloat(manana) + parseFloat(mediodia) + parseFloat(tarde) + parseFloat(noche);

		$('#formulario_receta_medica #recetaItem #quanty_' + row_index).val(total);
	});
});

$(document).ready(function(){
	$("#formulario_receta_medica #recetaItem").on('blur', '.mediodia', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		//OBTENER LOS VALORES DE LAS DOSIS
		var total = 0;
		var manana = $('#formulario_receta_medica #recetaItem #manana_' + row_index).val();
		var mediodia = $('#formulario_receta_medica #recetaItem #mediodia_' + row_index).val();
		var tarde = $('#formulario_receta_medica #recetaItem #tarde_' + row_index).val();
		var noche = $('#formulario_receta_medica #recetaItem #noche_' + row_index).val();

		if(!manana) {
			manana = 0;
		}

		if(!mediodia) {
			mediodia = 0;
		}

		if(!tarde) {
			tarde = 0;
		}

		if(!noche) {
			noche = 0;
		}

		total = parseFloat(manana) + parseFloat(mediodia) + parseFloat(tarde) + parseFloat(noche);

		$('#formulario_receta_medica #recetaItem #quanty_' + row_index).val(total);
	});
});

$(document).ready(function(){
	$("#formulario_receta_medica #recetaItem").on('blur', '.tarde', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		//OBTENER LOS VALORES DE LAS DOSIS
		var total = 0;
		var manana = $('#formulario_receta_medica #recetaItem #manana_' + row_index).val();
		var mediodia = $('#formulario_receta_medica #recetaItem #mediodia_' + row_index).val();
		var tarde = $('#formulario_receta_medica #recetaItem #tarde_' + row_index).val();
		var noche = $('#formulario_receta_medica #recetaItem #noche_' + row_index).val();

		if(!manana) {
			manana = 0;
		}

		if(!mediodia) {
			mediodia = 0;
		}

		if(!tarde) {
			tarde = 0;
		}

		if(!noche) {
			noche = 0;
		}

		total = parseFloat(manana) + parseFloat(mediodia) + parseFloat(tarde) + parseFloat(noche);

		$('#formulario_receta_medica #recetaItem #quanty_' + row_index).val(total);
	});
});

$(document).ready(function(){
	$("#formulario_receta_medica #recetaItem").on('blur', '.noche', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		//OBTENER LOS VALORES DE LAS DOSIS
		var total = 0;
		var manana = $('#formulario_receta_medica #recetaItem #manana_' + row_index).val();
		var mediodia = $('#formulario_receta_medica #recetaItem #mediodia_' + row_index).val();
		var tarde = $('#formulario_receta_medica #recetaItem #tarde_' + row_index).val();
		var noche = $('#formulario_receta_medica #recetaItem #noche_' + row_index).val();

		if(!manana) {
			manana = 0;
		}

		if(!mediodia) {
			mediodia = 0;
		}

		if(!tarde) {
			tarde = 0;
		}

		if(!noche) {
			noche = 0;
		}

		total = parseFloat(manana) + parseFloat(mediodia) + parseFloat(tarde) + parseFloat(noche);

		$('#formulario_receta_medica #recetaItem #quanty_' + row_index).val(total);
	});
});*/
</script>
