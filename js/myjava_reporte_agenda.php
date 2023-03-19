<script>
$(document).ready(function() {
	$('#label_acciones_volver').html("Home");
	$('#label_acciones_colas').html("");
	listar_reporte_agenda();
	getServicio();
});

$('#acciones_atras').on('click', function(e){
	$('#formColas').show();
	$('#label_acciones_receta').html("");
	$('#receta_medica').hide();
	$('#acciones_atras').addClass("breadcrumb-item active");
	$('#acciones_receta').removeClass("active");
});	

//INICIO ACCIONES FROMULARIO ENTREVISTA
var listar_reporte_agenda = function(){
	var servicio = $("#form_main_reporte_agenda #servicio").val();	
	var unidad = $("#form_main_reporte_agenda #unidad").val();
	var colaborador = $("#form_main_reporte_agenda #colaborador").val();	
	var fechai = $("#form_main_reporte_agenda #fechai").val();	
	var fechaf = $("#form_main_reporte_agenda #fechaf").val();	

	var table_reporte_agenda  = $("#dataTableReporteAgenda").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/reporte_agenda/llenarDataTableReporteAgenda.php",
			"data":{
				"servicio":servicio,
				"unidad":unidad,
				"colaborador":colaborador,
				"fechai":fechai,
				"fechaf":fechaf
			}			
		},
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,		
		"columns":[
			{
				"data":"servicio",
				"className": "servicio"
			},
			{
				"data":"tipo",
				"className": "tipo"
			},
			{
				"data":"1",
				"className": "dia1"
			},
			{
				"data":"2",
				"className": "dia2"
			},
			{
			  "data":"3",
			  "className": "dia3"
			},
			{
				"data":"4",
				"className": "dia4"
			},
			{
				"data":"5",
				"className": "dia5"
			},
			{
				"data":"6",
				"className": "dia6"
			},
			{
				"data":"7",
				"className": "dia7"
			},
			{
				"data":"8",
				"className": "dia8"
			},
			{
				"data":"9",
				"className": "dia9"
			},
			{
				"data":"10",
				"className": "dia10"
			},
			{"data":"11"},
			{"data":"12"},
			{"data":"13"},
			{"data":"14"},
			{"data":"15"},
			{"data":"16"},
			{"data":"17"},
			{"data":"18"},
			{"data":"19"},
			{"data":"20"},
			{"data":"21"},
			{"data":"22"},
			{"data":"23"},
			{"data":"24"},
			{"data":"25"},
			{"data":"26"},
			{"data":"27"},
			{"data":"28"},
			{"data":"29"},
			{"data":"30"},															
			{"data":"31"},															
			{
				"data":"total",
				"className": "total"
			}
		],
		"buttons":[		
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Reporte Agenda',
				className: 'btn btn-info',
				action: 	function(){
					listar_reporte_agenda();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Reporte Agenda',
				className: 'btn btn-success',
				exportOptions: {
                    columns: ':visible'
                }							
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Reporte Agenda',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,//esta se encuenta en el archivo main.js
						width:170,
                        height:45
					} );
				},
				exportOptions: {
                    columns: ':visible'
                }								
			}
		]			
	});
	$('#buscar').focus();
}

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/citas/getServicio.php';

    $.ajax({
        type: "POST",
        url: url,
        success: function(data) {
            $('#form_main_reporte_agenda #servicio').html("");
            $('#form_main_reporte_agenda #servicio').html(data);
			$('#form_main_reporte_agenda #servicio').selectpicker('refresh');
        }
    });
}

$(document).ready(function() {
    $('#form_main_reporte_agenda #servicio').on('change', function() {
        var servicio_id = $('#form_main_reporte_agenda #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getUnidad.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'servicio=' + servicio_id,
            success: function(data) {
                $('#form_main_reporte_agenda #unidad').html(data);
                $('#form_main_reporte_agenda #unidad').selectpicker('refresh');
            }
        });
    });

    $('#form_main_reporte_agenda #unidad').on('change', function() {
        var servicio_id = $('#form_main_reporte_agenda #servicio').val();
        var puesto_id = $('#form_main_reporte_agenda #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getMedico.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'servicio=' + servicio_id + '&puesto_id=' + puesto_id,
            success: function(data) {
				$('#form_main_reporte_agenda #colaborador').html("");
                $('#form_main_reporte_agenda #colaborador').html(data);
                $('#form_main_reporte_agenda #colaborador').selectpicker('refresh');
            }
        });

    });
	
	$('#form_main_reporte_agenda #servicio').on('change', function(){	
		listar_reporte_agenda();
	});	

	$('#form_main_reporte_agenda #unidad').on('change', function(){	
		listar_reporte_agenda();
	});	

	$('#form_main_reporte_agenda #colaborador').on('change', function(){	
		listar_reporte_agenda();
	});		

	$('#form_main_reporte_agenda #fechai').on('change', function(){	
		listar_reporte_agenda()
	});		
	
	$('#form_main_reporte_agenda #fechaf').on('change', function(){	
		listar_reporte_agenda();
	});			
});

//MOSTRAR / OCULTAR REGISTROS DE LA TABLA
$("input:checkbox:not(:checked)").each(function() {
	var column = "table ." + $(this).attr("name");
	$(column).hide();
});

$("input:checkbox").click(function(){
	var column = "table ." + $(this).attr("name");
	$(column).toggle();
});
</script>