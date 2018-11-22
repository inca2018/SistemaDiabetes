var datos;
var datos2;

function init(){

	ListarAlumnos();
	Mostrar_Indicadores();


    $('#date_inicio1').datepicker({
			 format: 'dd/mm/yyyy',

        });
	$('#date_fin1').datepicker({

		    format: 'dd/mm/yyyy',
    });

	$('#date_inicio1').datepicker().on('changeDate', function (ev) {
	    var f_inicio=$("#inicio1").val();
		 var f_fin=$("#fin1").val();
	   var day = parseInt(f_inicio.substr(0,2));
		var month = parseInt(f_inicio.substr(3,2));
		var year = parseInt(f_inicio.substr(6,8));
	 $('#date_fin1').datepicker('setStartDate',new Date(year,(month-1),day));
   });

	$('#date_fin1').datepicker().on('changeDate', function (ev) {
	    var f_inicio=$("#inicio1").val();
		 var f_fin=$("#fin1").val();
		var day = parseInt(f_fin.substr(0,2));
		var month = parseInt(f_fin.substr(3,2));
		var year = parseInt(f_fin.substr(6,8));

	 $('#date_inicio1').datepicker('setEndDate',new Date(year,(month-1),day));
   });

    $("#alumnosSelect").select2({
      theme: 'bootstrap'
   });
}

function Mostrar_Indicadores(){
		 datos = {
						               type: "pie",

										data : {
											datasets :[{
												data :[
														1,
														1,
													],
												backgroundColor: [

													"#5BC374",
													"#EE2D2A",

												],
											}],

											labels : [

												"% Ovillos Total",
												"% Ovillos Mal Estado",

											]
										   },
										options : {
											responsive : true,
                                             title: {
                                                    display: true,
                                                    text: 'INDICADOR 1'
                                                }

										}

									};

			                 var canvas = document.getElementById('chart1').getContext('2d');
					         window.pie = new Chart(canvas, datos);

	      datos2 = {
						               type: "pie",
										data : {
											datasets :[{
												data :[
														1,
														1,

													],
												backgroundColor: [
                                                    "#EE2D2A",
													"#5BC374",


												],
											}],

											labels : [

												"% Ovillos Total",
												"% Ovillos Buen Estado",


											]
										   },
										options : {
											responsive : true,
                                             title: {
                                                    display: true,
                                                    text: 'INDICADOR 2'
                                                }

										}

									};

			                 var canvas = document.getElementById('chart2').getContext('2d');
					         window.pie2 = new Chart(canvas, datos2);
}

function ListarAlumnos(){
    $.post("../../controlador/Gestion/CGestion.php?op=listar_alumnos_filtro", function (ts) {
      $("#alumnosSelect").append(ts);
   });
}

function buscar_reporte1(){


	var usuario=$("#alumnosSelect").val();
    var f_inicio=$("#inicio1").val();
   var f_fin=$("#fin1").val();

	if(usuario=='' || f_inicio=='' || f_fin=='' ){
		  	notificar_warning("Seleccione Paramentros")
		}else{
			actualizar_indicadores1(f_inicio,f_fin,usuario);
		}

}

function actualizar_indicadores1(f_inicio,f_fin,idAlumno){

	$.post("../../controlador/Gestion/CGestion.php?op=RecuperarGraficoFechasAlumno",{fechaInicio:f_inicio,fechaFin:f_fin,idAlumno:idAlumno}, function(data, status){
      data = JSON.parse(data);
		console.log(data);
      var cuotaTotal = parseInt(data.CuotaTotales);
      var cuotaPendiente = parseInt(data.CuotaPendiente);
		var cuotaPagada = parseInt(data.CuotaPagada);
		var cuotaVencida = parseInt(data.CuotaVencida);



		$("#ind_cuota_total").append();
		$("#ind_cuota_pendiente").append();
		$("#ind_cuota_pagada").append();
		$("#ind_cuota_vencida").append();

		$("#ind_cuota_total").html("<b>"+cuotaTotal+"</b>");
		$("#ind_cuota_pendiente").html("<b>"+cuotaPendiente+"</b>");
		$("#ind_cuota_pagada").html("<b>"+cuotaPagada+"</b>");
		$("#ind_cuota_vencida").html("<b>"+cuotaVencida+"</b>");

		var porcCartVencida=parseFloat((cuotaVencida*100)/cuotaTotal).toFixed(2);
		var porcCartNoVencida=parseFloat(100-porcCartVencida);


		var porcCartPagadas=parseFloat((cuotaPagada*100)/cuotaTotal).toFixed(2);
		var porcCartNoPagadas=parseFloat(100-porcCartPagadas);

		datos.data.datasets.splice(0);
		var newData = {
									backgroundColor : [
											"#5BC374",
											"#EE2D2A",


									],
									data : [porcCartNoVencida,porcCartVencida]
								};
		datos.data.datasets.push(newData);
		window.pie.update();

		datos2.data.datasets.splice(0);
		var newData2 = {
									backgroundColor : [
                                            "#EE2D2A",
											"#5BC374",

									],
									data : [porcCartNoPagadas,porcCartPagadas]
								};
		datos2.data.datasets.push(newData2);
		window.pie2.update();
    });
}

init();
