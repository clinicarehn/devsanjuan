<script>
$(document).ready(function() {
	$('#label_acciones_volver').html("Home");
	$('#label_acciones_colas').html("");
	listar_reporte_patologia();
	getServicio();
	getDepartamento();
});

$('#acciones_atras').on('click', function(e){
	$('#formColas').show();
	$('#label_acciones_receta').html("");
	$('#receta_medica').hide();
	$('#acciones_atras').addClass("breadcrumb-item active");
	$('#acciones_receta').removeClass("active");
});	

//INICIO ACCIONES FROMULARIO ENTREVISTA
var listar_reporte_patologia = function(){
	var departamentos = $("#form_main_reporte_patologia #departamentos").val();	
	var municipios = $("#form_main_reporte_patologia #municipios").val();	
	var servicio = $("#form_main_reporte_patologia #servicio").val();	
	var unidad = $("#form_main_reporte_patologia #unidad").val();
	var colaborador = $("#form_main_reporte_patologia #colaborador").val();	
	var fechai = $("#form_main_reporte_patologia #fechai").val();	
	var fechaf = $("#form_main_reporte_patologia #fechaf").val();	

	var table_reporte_patologia  = $("#dataTableReportePatologia").DataTable({
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/reporte_patologias/llenarDataTableReportePatologia.php",
			"data":{
				"departamentos":departamentos,
				"municipios":municipios,
				"servicio":servicio,
				"unidad":unidad,
				"colaborador":colaborador,
				"fechai":fechai,
				"fechaf":fechaf
			}			
		},
        "lengthMenu": lengthMenu20,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,		
		"columns":[
			{
				"data":"departamento",
				"className": "departamento"
			},
			{
				"data":"municipio",
				"className": "municipio"
			},			
			{
				"data":"patologia",
				"className": "patologia"
			},
			{
				"data":"0_4",
				"className": "0_4"
			},
			{
				"data":"5_10",
				"className": "5_10"
			},
			{
				"data":"11_20",
				"className": "11_20"
			},
			{
				"data":"21_30",
				"className": "21_30"
			},
			{
				"data":"31_40",
				"className": "31_40"
			},
			{
				"data":"41_50",
				"className": "41_50"
			},
			{
				"data":"51_60",
				"className": "51_60"
			},
			{
				"data":"61_mas",
				"className": "61_mas"
			},
			{
				"data":"mujeres",
				"className": "mujeres"
			},
			{
				"data":"hombres",
				"className": "hombres"
			},																										
			{
				"data":"total_",
				"className": "total"			
			}
		],
		"buttons":[		
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Reporte Patologías',
				className: 'btn btn-info',
				action: 	function(){
					listar_reporte_patologia();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Reporte Patologías',
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
				title: 'Reporte Reporte Patologías',
				className: 'btn btn-danger',
				exportOptions: {
                    columns: ':visible'
                },				
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
	$('#buscar').focus();
}

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/citas/getServicio.php';

    $.ajax({
        type: "POST",
        url: url,
        success: function(data) {
            $('#form_main_reporte_patologia #servicio').html("");
            $('#form_main_reporte_patologia #servicio').html(data);
			$('#form_main_reporte_patologia #servicio').selectpicker('refresh');
        }
    });
}

$(document).ready(function() {
    $('#form_main_reporte_patologia #servicio').on('change', function() {
        var servicio_id = $('#form_main_reporte_patologia #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getUnidad.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'servicio=' + servicio_id,
            success: function(data) {
                $('#form_main_reporte_patologia #unidad').html(data);
                $('#form_main_reporte_patologia #unidad').selectpicker('refresh');
            }
        });
    });

    $('#form_main_reporte_patologia #unidad').on('change', function() {
        var servicio_id = $('#form_main_reporte_patologia #servicio').val();
        var puesto_id = $('#form_main_reporte_patologia #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getMedico.php';

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: 'servicio=' + servicio_id + '&puesto_id=' + puesto_id,
            success: function(data) {
				$('#form_main_reporte_patologia #colaborador').html("");
                $('#form_main_reporte_patologia #colaborador').html(data);
                $('#form_main_reporte_patologia #colaborador').selectpicker('refresh');
            }
        });

    });

	$('#form_main_reporte_patologia #departamentos').on('change', function(){	
		listar_reporte_patologia();
	});	

	$('#form_main_reporte_patologia #municipios').on('change', function(){	
		listar_reporte_patologia();
	});	

	$('#form_main_reporte_patologia #servicio').on('change', function(){	
		listar_reporte_patologia();
	});	

	$('#form_main_reporte_patologia #unidad').on('change', function(){	
		listar_reporte_patologia();
	});	

	$('#form_main_reporte_patologia #colaborador').on('change', function(){	
		listar_reporte_patologia();
	});		

	$('#form_main_reporte_patologia #fechai').on('change', function(){	
		listar_reporte_patologia()
	});		
	
	$('#form_main_reporte_patologia #fechaf').on('change', function(){	
		listar_reporte_patologia();
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

function getDepartamento(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getDepartamento.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main_reporte_patologia #departamentos').html("");
			$('#form_main_reporte_patologia #departamentos').html(data);
			$('#form_main_reporte_patologia #departamentos').selectpicker('refresh');	
		}			
     });		
}

$(document).ready(function() {
	$('#form_main_reporte_patologia #departamentos').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/pacientes/getMunicipio.php';
       		
		var departamento_id = $('#form_main_reporte_patologia #departamentos').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'departamento_id='+departamento_id,
		   success:function(data){
		      $('#form_main_reporte_patologia #municipios').html("");
			  $('#form_main_reporte_patologia #municipios').html(data);
			  $('#form_main_reporte_patologia #municipios').selectpicker('refresh');		  
		  }
	  });
	  return false;			 				
    });					
});
</script>