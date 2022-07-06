<script>
$(document).ready(function () {
	showGraphCEAnterior();
	showGraphCEActual();
	showGraphUNAAnterior();
	showGraphUNAActual();
	
	setInterval('showGraphCEActual()',10000);
	setInterval('showGraphUNAActual()',10000);
});

	
function showGraphCEAnterior(){
	{		
		$.post("<?php echo SERVERURL; ?>php/main/atencionesUltimosAnoCE.php",
		function(data){
			var datos = eval(data);
			var mes = [];
			var total = [];
			
			for(var fila=0; fila < datos.length; fila++){
				mes.push(datos[fila]["mes"]);
				total.push(datos[fila]["total"]);
			}

			var ctx = document.getElementById('graphBarCEAnterior').getContext('2d');		
			var chart = new Chart(ctx, {
				// The type of chart we want to create
				type: 'bar',

				// The data for our dataset
				data: {
					labels: mes,
					datasets: [{
						label: 'Reporte de Atenciones Consulta Externa Año <?php echo date("Y",strtotime(date("Y-m-d")."- 1 year")); ?>',
						backgroundColor: '#4099ff',
						borderColor: '#4099ff',
						hoverBackgroundColor: '#73b4ff',
						hoverBorderColor: '#FAFAFA',
						borderWidth: 1,
						data: total,
						datalabels: {
							color: '#4099ff',
							anchor: 'end',
							align: 'top',
							labels: {
								title: {
									font: {
										weight: 'bold'
									}
								}
							}							
						}
					}]
				},

				// Configuration options go here
				plugins: [ChartDataLabels],
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					},
					plugins: {
						legend: {
							labels: {
								// This more specific font property overrides the global property
								font: {
									size: 12,
									weight: 'bold'
								}
							}
						}
					}
				}		
			});	
		});
	}
}

function showGraphCEActual(){
	{
		$.post("<?php echo SERVERURL; ?>php/main/atencionesAnoActualCE.php",
		function(data){
			var datos = eval(data);
			var mes = [];
			var total = [];
			
			for(var fila=0; fila < datos.length; fila++){
				mes.push(datos[fila]["mes"]);
				total.push(datos[fila]["total"]);
			}

			var ctx = document.getElementById('graphBarCEActual').getContext('2d');		
			var chart = new Chart(ctx, {
				// The type of chart we want to create
				type: 'bar',

				// The data for our dataset
				data: {
					labels: mes,
					datasets: [{
						label: 'Reporte de Atenciones Consulta Externa Año <?php echo date("Y"); ?>',
						backgroundColor: '#2ed8b6',
						borderColor: '#2ed8b6',
						hoverBackgroundColor: '#59e0c5',
						hoverBorderColor: '#FAFAFA',
						borderWidth: 1,
						data: total,
						datalabels: {
							color: '#2ed8b6',
							anchor: 'end',
							align: 'top',
							labels: {
								title: {
									font: {
										weight: 'bold'
									}
								}
							}							
						}
					}]
				},

				// Configuration options go here
				plugins: [ChartDataLabels],
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					},
					plugins: {
						legend: {
							labels: {
								// This more specific font property overrides the global property
								font: {
									size: 12,
									weight: 'bold'
								}
							}
						}
					}	
				}		
			});				
		});
	}
}

function showGraphUNAAnterior(){
	{
		$.post("<?php echo SERVERURL; ?>php/main/atencionesUltimosAnoUNA.php",
		function(data){
			var datos = eval(data);
			var mes = [];
			var total = [];
			
			for(var fila=0; fila < datos.length; fila++){
				mes.push(datos[fila]["mes"]);
				total.push(datos[fila]["total"]);
			}
			
			var ctx = document.getElementById('graphBarUNAAnterior').getContext('2d');		
			var chart = new Chart(ctx, {
				// The type of chart we want to create
				type: 'bar',

				// The data for our dataset
				data: {
					labels: mes,
					datasets: [{
						label: 'Reporte de Atenciones UNA Año <?php echo date("Y",strtotime(date("Y-m-d")."- 1 year")); ?>',
						backgroundColor: '#FFB64D',
						borderColor: '#FFB64D',
						hoverBackgroundColor: '#ffcb80',
						hoverBorderColor: '#FAFAFA',
						borderWidth: 1,
						data: total,
						datalabels: {
							color: '#FFB64D',
							anchor: 'end',
							align: 'top',
							labels: {
								title: {
									font: {
										weight: 'bold'
									}
								}
							}							
						}
					}]
				},

				// Configuration options go here
				plugins: [ChartDataLabels],
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					},
					plugins: {
						legend: {
							labels: {
								// This more specific font property overrides the global property
								font: {
									size: 12,
									weight: 'bold'
								}
							}
						}
					}	
				}		
			});		
			
		});
	}
}

function showGraphUNAActual(){
	{
		$.post("<?php echo SERVERURL; ?>php/main/atencionesAnoActualUNA.php",
		function(data){
			var datos = eval(data);
			var mes = [];
			var total = [];
			
			for(var fila=0; fila < datos.length; fila++){
				mes.push(datos[fila]["mes"]);
				total.push(datos[fila]["total"]);
			}
			
			var ctx = document.getElementById('graphBarUNAActual').getContext('2d');		
			var chart = new Chart(ctx, {
				// The type of chart we want to create
				type: 'bar',

				// The data for our dataset
				data: {
					labels: mes,
					datasets: [{
						label: 'Reporte de Atenciones UNA Año <?php echo date("Y"); ?>',
						backgroundColor: '#FF5370',
						borderColor: '#FF5370',
						hoverBackgroundColor: '#ff869a',
						hoverBorderColor: '#FAFAFA',
						borderWidth: 1,
						data: total,
						datalabels: {
							color: '#FF5370',
							anchor: 'end',
							align: 'top',
							labels: {
								title: {
									font: {
										weight: 'bold'
									}
								}
							}							
						}
					}]
				},

				// Configuration options go here
				plugins: [ChartDataLabels],
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					},
					plugins: {
						legend: {
							labels: {
								// This more specific font property overrides the global property
								font: {
									size: 12,
									weight: 'bold'
								}
							}
						}
					}	
				}		
			});		
		});
	}
}
</script>