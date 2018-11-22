var datos;
var datos2;
var sumaDisponible=0;
var sumaNoDisponible=0;
var sumaDisponible2=0;
var sumaNoDisponible2=0;
var cuerpo="";
var cuerpo2="";
var cont=0;


var tabladetalle1;
var tabladetalle2;


function init(){

	iniciar();
	Mostrar_Indicadores();
}


function iniciar(){

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
												"% Ovillos Buen Estado",

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

			                 var canvas = document.getElementById('chart').getContext('2d');
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
                                                    text: 'INDICADOR 2'
                                                }

										}

									};

			                 var canvas = document.getElementById('chart2').getContext('2d');
					         window.pie2 = new Chart(canvas, datos2);
}
function buscar_reporte(){

   var f_inicio=$("#inicio1").val();
   var f_fin=$("#fin1").val();

	if(f_inicio=='' || f_fin==''){
		  	notificar_warning("Seleccione Fechas")
		}else{
			actualizar_indicadores1(f_inicio,f_fin);
			$("#body_detalles1").empty();
         $("#body_detalles2").empty();
		}
}
function actualizar_indicadores1(f_inicio,f_fin){

	$.post("../../controlador/Gestion/CGestion.php?op=RecuperarGraficoFechas",{fechaInicio:f_inicio,fechaFin:f_fin}, function(data, status){
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
											"#5BC374",
											"#EE2D2A",


									],
									data : [porcCartNoPagadas,porcCartPagadas]
								};
		datos2.data.datasets.push(newData2);
		window.pie2.update();
    });
}
function detalles1(){

    var inicio=$("#inicio1").val();
    var fin=$("#fin1").val();
    if(inicio=='' || fin=='' ){
         swal("Error!", "Seleccione todos los indicadores para buscar reporte!.", "warning");
    }else{
        $('#modal_detalles1').modal({backdrop: 'static', keyboard: false})
        $("#modal_detalles1").modal('show');

       mostrar_Tabla_detalles1(inicio,fin);
    }

}

function detalles2(){

    var inicio=$("#inicio1").val();
    var fin=$("#fin1").val();
    if(inicio=='' || fin=='' ){
         swal("Error!", "Seleccione todos los indicadores para buscar reporte!.", "warning");
    }else{
        $('#modal_detalles2').modal({backdrop: 'static', keyboard: false})
        $("#modal_detalles2").modal('show');
       mostrar_Tabla_detalles2(inicio,fin);
    }

}


function verificar(dato){
    if(isNaN(dato)){
        return 0;
    }else{
        var dato_Redondenado=Math.round(dato * 100) / 100;
        return dato_Redondenado;
    }
}



function mostrar_Tabla_detalles1(inicio,fin){
    if(tabladetalle1==null){
        tabladetalle1 = $('#tabla_Detalles1').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": false, // Paginacion en tabla
		"ordering": true, // Ordenamiento en columna de tabla
		"info": true, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
          dom: 'lBfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "order": [[0, "asc"]],

		"bDestroy": true
        , "columnDefs": [
            {
               "className": "text-center"
               , "targets": [0,1,2,3,4]
            }
            , {
               "className": "text-left"
               , "targets": []
            }
         , ]
         , buttons: [
            {
               extend: 'copy'
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }

            , {
               extend: 'excel'
               , className: 'btn-info'
               , title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            , {
				extend: 'pdfHtml5',
				className: 'btn-info sombra3',
				title: "Sistema de Matricula - Jose Galvez - Reporte" ,
				orientation: 'landscape',
				pageSize: 'LEGAL',
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: RecuperarLogo64(),
                    } );
                }
            }
            , {
               extend: 'print'
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            ],
         "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Gestion/CGestion.php?op=ListarReportes1',
			type: "POST",
			dataType: "JSON",
			data:{fechaInicio:inicio,fechaFin:fin},
			error: function (e) {
				console.log(e.responseText);
			}
		},
		// cambiar el lenguaje de datatable
		oLanguage: español,
	}).DataTable();
	//Aplicar ordenamiento y autonumeracion , index
	tabladetalle1.on('order.dt search.dt', function () {
		tabladetalle1.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
    }else{
        tabladetalle1.destroy();
        tabladetalle1 = $('#tabla_Detalles1').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": false, // Paginacion en tabla
		"ordering": true, // Ordenamiento en columna de tabla
		"info": true, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
          dom: 'lBfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "order": [[0, "asc"]],

		"bDestroy": true
        , "columnDefs": [
            {
               "className": "text-center"
               , "targets": [0,1,2,3,4]
            }
            , {
               "className": "text-left"
               , "targets": []
            }
         , ]
         , buttons: [
            {
               extend: 'copy'
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }

            , {
               extend: 'excel'
               , className: 'btn-info'
               , title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            , {
				extend: 'pdfHtml5',
				className: 'btn-info sombra3',
				title: "Sistema de Matricula - Jose Galvez - Reporte" ,
				orientation: 'landscape',
				pageSize: 'LEGAL',
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: RecuperarLogo64(),
                    } );
                }
            }
            , {
               extend: 'print'
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            ],
         "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Gestion/CGestion.php?op=ListarReportes1',
			type: "POST",
			dataType: "JSON",
			data:{fechaInicio:inicio,fechaFin:fin},
			error: function (e) {
				console.log(e.responseText);
			}
		},
		// cambiar el lenguaje de datatable
		oLanguage: español,
	}).DataTable();
	//Aplicar ordenamiento y autonumeracion , index
	tabladetalle1.on('order.dt search.dt', function () {
		tabladetalle1.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
    }

}
function mostrar_Tabla_detalles2(inicio,fin){
    if(tabladetalle2==null){
       tabladetalle2 = $('#tabla_Detalles2').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": false, // Paginacion en tabla
		"ordering": true, // Ordenamiento en columna de tabla
		"info": true, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
          dom: 'lBfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "order": [[0, "asc"]],

		"bDestroy": true
        , "columnDefs": [
            {
               "className": "text-center"
               , "targets": [0,1,2,3,4]
            }
            , {
               "className": "text-left"
               , "targets": []
            }
         , ]
         , buttons: [
            {
               extend: 'copy'
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }

            , {
               extend: 'excel'
               , className: 'btn-info'
               , title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            , {
				extend: 'pdfHtml5',
				className: 'btn-info sombra3',
				title: "Sistema de Matricula - Jose Galvez - Reporte" ,
				orientation: 'landscape',
				pageSize: 'LEGAL',
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: RecuperarLogo64(),
                    } );
                }
            }
            , {
               extend: 'print'
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            ],
         "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Gestion/CGestion.php?op=ListarReportes2',
			type: "POST",
			dataType: "JSON",
			data:{fechaInicio:inicio,fechaFin:fin},
			error: function (e) {
				console.log(e.responseText);
			}
		},
		// cambiar el lenguaje de datatable
		oLanguage: español,
	}).DataTable();
	//Aplicar ordenamiento y autonumeracion , index
	tabladetalle2.on('order.dt search.dt', function () {
		tabladetalle2.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
       }else{
       tabladetalle2.destroy();
       tabladetalle2 = $('#tabla_Detalles2').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": false, // Paginacion en tabla
		"ordering": true, // Ordenamiento en columna de tabla
		"info": true, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
          dom: 'lBfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "order": [[0, "asc"]],

		"bDestroy": true
        , "columnDefs": [
            {
               "className": "text-center"
               , "targets": [0,1,2,3,4]
            }
            , {
               "className": "text-left"
               , "targets": []
            }
         , ]
         , buttons: [
            {
               extend: 'copy'
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }

            , {
               extend: 'excel'
               , className: 'btn-info'
               , title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            , {
				extend: 'pdfHtml5',
				className: 'btn-info sombra3',
				title: "Sistema de Matricula - Jose Galvez - Reporte" ,
				orientation: 'landscape',
				pageSize: 'LEGAL',
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: RecuperarLogo64(),
                    } );
                }
            }
            , {
               extend: 'print'
               , className: 'btn-info',

            }
            ],
         "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Gestion/CGestion.php?op=ListarReportes2',
			type: "POST",
			dataType: "JSON",
			data:{fechaInicio:inicio,fechaFin:fin},
			error: function (e) {
				console.log(e.responseText);
			}
		},
		// cambiar el lenguaje de datatable
		oLanguage: español,
	}).DataTable();
	//Aplicar ordenamiento y autonumeracion , index
	tabladetalle2.on('order.dt search.dt', function () {
		tabladetalle2.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
       }

}
init();
