<script>
$(document).ready(function(){
	getTempUsers();
	getActiveUsers();
	getPasiveUsers();
	getDeadUsers();
	getPendientesAtencion();
	getPendientesPreclinica();
	getTotalExtemporaneos();
	getTotalAusencias();	
});

//DATOS MAIN
function getTempUsers(){
    var url = '<?php echo SERVERURL; ?>php/main/getTemporales.php';
	$.ajax({
	    type:'POST',
		url:url,
		success: function(data){
           	$('#main_temporales').html(data);  		  		  			  
		}
	});	
}

function getActiveUsers(){
    var url = '<?php echo SERVERURL; ?>php/main/getActivos.php';
	$.ajax({
	    type:'POST',
		url:url,
		success: function(data){
           	$('#main_activos').html(data);  		  		  			  
		}
	});	
}

function getPasiveUsers(){
    var url = '<?php echo SERVERURL; ?>php/main/getPasivos.php';
	$.ajax({
	    type:'POST',
		url:url,
		success: function(data){
           	$('#main_pasivos').html(data);  		  		  			  
		}
	});	
}

function getDeadUsers(){
    var url = '<?php echo SERVERURL; ?>php/main/getFallecidos.php';
	$.ajax({
	    type:'POST',
		url:url,
		success: function(data){
           	$('#main_fallecidos').html(data);  		  		  			  
		}
	});	
}

function getTotalAusencias(){
    var url = '<?php echo SERVERURL; ?>php/main/totalAusencias.php';
	$.ajax({
	    type:'POST',
		url:url,
		success: function(data){
           	$('#main_ausencias').html(data);  		  		  			  
		}
	});	
}

function getPendientesAtencion(){
    var url = '<?php echo SERVERURL; ?>php/main/pendienteAtenciones.php';
	$.ajax({
	    type:'POST',
		url:url,
		success: function(data){
           	$('#main_prendiente_ata').html(data);  		  		  			  
		}
	});	
}

function getPendientesPreclinica(){
    var url = '<?php echo SERVERURL; ?>php/main/pendientePreclinica.php';
	$.ajax({
	    type:'POST',
		url:url,
		success: function(data){
           	$('#main_pendiente_preclinica').html(data);  		  		  			  
		}
	});	
}

function getTotalExtemporaneos(){
    var url = '<?php echo SERVERURL; ?>php/main/totalExtemporaneos.php';
	$.ajax({
	    type:'POST',
		url:url,
		success: function(data){
           	$('#main_extemporaneos').html(data);  		  		  			  
		}
	});	
}

//OBTENER TOTAL DE USUARIOS
//TEMPORALES
function getTemporales(){
    var url = '<?php echo SERVERURL; ?>php/main/getTemporales.php';
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

//ACTIVOS
function getActivos(){
    var url = '<?php echo SERVERURL; ?>php/main/getActivos.php';
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

//PASIVOS
function getPasivos(){
    var url = '<?php echo SERVERURL; ?>php/main/getPasivos.php';
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

//FALLECIDOS
function getFallecidos(){
    var url = '<?php echo SERVERURL; ?>php/main/getFallecidos.php';
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

//ATENCIONES
//PRECLINICA CONSULTA EXTERNA
function getPreclinicaCE(){
    var url = '<?php echo SERVERURL; ?>php/main/getPreclinica_ce.php';
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

//PRECLINICA UNA
function getPreclinicaUNA(){
    var url = '<?php echo SERVERURL; ?>php/main/getPreclinica_una.php';
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

//PENDIENTES CONSULTA EXTERNA
function getPendientesCE(){
    var url = '<?php echo SERVERURL; ?>php/main/getPendientes_ce.php';
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

//PENDIENTES UNA
function getPendientesUNA(){
    var url = '<?php echo SERVERURL; ?>php/main/getPendientes_una.php';
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

//PENDIENTES CLINICA DE DEPOSITO
function getPendientesClinica(){
    var url = '<?php echo SERVERURL; ?>php/main/getPendientes_clinica.php';
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

//INASISTENCIAS CONSULTA EXTERNA
function getInasistenciasCE(){
    var url = '<?php echo SERVERURL; ?>php/main/getInasistencias_ce.php';
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

//INASISTENCIAS UNA
function getInasistenciasUNA(){
    var url = '<?php echo SERVERURL; ?>php/main/getInasistencias_una.php';
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

//INASISTENCIAS CLINICA DE DEPOSITO
function getInasistenciasClinica(){
    var url = '<?php echo SERVERURL; ?>php/main/getInasistencias_clinica.php';
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

//INASISTENCIAS TERAPIA OCUPACIONAL
function getInasistenciasTerapia(){
    var url = '<?php echo SERVERURL; ?>php/main/getInasistencias_terapia.php';
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

//EXTEMPORANEOS CONSULTA EXTERNA
function getExtemporaneosCE(){
    var url = '<?php echo SERVERURL; ?>php/main/getExtemporaneos_ce.php';
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

//EXTEMPORANEOS CONSULTA UNA
function getExtemporaneosUNA(){
    var url = '<?php echo SERVERURL; ?>php/main/getExtemporaneos_una.php';
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

//EXTEMPORANEOS CONSULTA USUARIO EN CRISIS
function getExtemporaneoCrisis(){
    var url = '<?php echo SERVERURL; ?>php/main/getExtemporaneos_crisis.php';
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

/***************************************************************/
var datos = 0;

function main(){
	var temporal = getTemporales();
	var activo = getActivos();
	var pasivo = getPasivos();
	var fallecido = getFallecidos();
	/***********************************************/
	
	var preclinica_ce = 0;
	var preclinica_una = 0;	
	/***********************************************/	
	var pendientes_ce = 0;
	var pendientes_una = 0;
    var pendientes_clinica = 0;	
	/***********************************************/
	var inasistencias_ce = 0;
	var inasistencias_una = 0;
	var inasistencias_clinica = 0;
	var inasistencias_terapia = 0;
	/***********************************************/
	var extemporaneos_ce = 0;
	var extemporaneos_una = 0;	
	var extemporaneos_crisis = 0;
	/***********************************************/
	var maida = 0;
    var s_h = 0;
	/***********************************************/
	
    //Usuarios	
	$('#temporal').html("Total de Usuarios Temporales: " + temporal);
	$('#activos').html("Total de Usuarios Activos: " + activo);
	$('#pasivos').html("Total de Usuarios Pasivos: " + pasivo);
	$('#fallecidos').html("Total de Usuarios Fallecidos: " + fallecido);
    /***********************************************/
	//ATENCIONES
	$('#preclinica').html("Pendientes en C.E: " + preclinica_ce + "<br/>Pendientes en UNA: " + preclinica_una);
	$('#pendientes').html("Consulta Externa: " + pendientes_ce + "<br/>UNA: " + pendientes_una + "<br/>Clínica de Deposito: "
     	+ pendientes_clinica + "<br/>MAIDA: " + maida + "<br/>S.H: " + s_h);
	$('#inasistencias').html("Consulta Externa: " + inasistencias_ce + "<br/>UNA: " + inasistencias_una + "<br/>Clínica de Deposito: " + inasistencias_clinica + "<br/>Terapia Ocupacional: " + inasistencias_terapia);
	$('#extemporaneos').html("Consulta Externa: " + extemporaneos_ce + "<br/>UNA: " + extemporaneos_una + "<br/>Usuario en Crisis: " + extemporaneos_crisis);
    
	datos++;
    // lógica para obtener y mostrar los datos
    if (datos === 5)
       clearInterval(relojito);	
}

clearInterval(relojito);

var relojito = setInterval(function(){
   main();
}, 10000);

$(document).ready(function() {
   main();
});

/***************************************************************/

//PENDIENTES HOSPITALIZACION
function getPendientesMAIDA(){
    var url = '<?php echo SERVERURL; ?>php/main/getPendientes_hospitalizacion_maida.php';
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

function getPendientesSH(){
    var url = '<?php echo SERVERURL; ?>php/main/getPendientes_hospitalizacion_sh.php';
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
</script>