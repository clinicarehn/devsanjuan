<script>
$(document).ready(function() {
	listar_programacion_citas();
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#agregar_pasivos").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_pasivos #expediente').focus();
    });
});

$(document).ready(function(){
    $("#agregar_fallecidos").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_fallecidos #expediente').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
//INICIO ACCIONES FROMULARIO PROVEEDORES
var listar_programacion_citas = function(){	
	var table_programacion_citas  = $("#dataTableProgramacionCitas").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/reporte_programacion_citas/getProgramacionCitas.php"
		},
		"columns":[
			{"data":"usuario"},
			{"data":"identidad"},
			{"data":"expediente"},
			{"data":"profesional"},
			{"data":"servicio"},
			{"data":"fecha_cita"},
			{"data":"tipo_cita"},
			{"data":"descripcion"},			
			{"data":"paciente"},
		],
        "lengthMenu": lengthMenu10,
		"stateSave": true,
		"bDestroy": true,	
		"aProcessing": true,
		"aServerSide": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,
		"columnDefs": [
		  { width: "19.11%", targets: 0 },
		  { width: "9.11%", targets: 1 },
		  { width: "5.11%", targets: 2 },
		  { width: "11.11%", targets: 3 },
		  { width: "11.11%", targets: 4 },
		  { width: "8.11%", targets: 5 },
		  { width: "11.11%", targets: 6 },
		  { width: "19.11%", targets: 7 },
		  { width: "5.11%", targets: 8 }			  
		],			
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Programación de Citas',
				className: 'btn btn-info',
				action: 	function(){
					listar_programacion_citas();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Programación de Citas',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Programación de Citas',
				className: 'btn btn-danger',
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
	table_programacion_citas.search('').draw();
	$('#buscar').focus();
}
//FIN LLENAR TABLAS PROMAMACION DE CITAS
</script>