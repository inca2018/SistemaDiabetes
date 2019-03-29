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
var tablaReporte;

function init(){

	iniciar();
    Listar_Sexo();
}


function Listar_Sexo() {
    $.post("../../controlador/Mantenimiento/CMedico.php?op=listar_sexo", function (ts) {
        $("#IndicadorSexo").empty();
        $("#IndicadorSexo").append(ts);
    });
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

function buscar_reporte(){

   var f_inicio=$("#inicio1").val();
   var f_fin=$("#fin1").val();
   var sexo =$("#IndicadorSexo").val();
	if(f_inicio=='' || f_fin==''){
		  	notificar_warning("Seleccione Fechas")
		}else{
			buscarReporte(f_inicio,f_fin,sexo);
        }
}

function buscarReporte(Inicio,Fin,Sexo){
    $.post("../../controlador/Gestion/CReporte.php?op=recuperar_totales",{Inicio:Inicio,Fin:Fin,Sexo:Sexo}, function(data, status){
      data = JSON.parse(data);
      console.log(data);

        $("#total1").empty();
        $("#total1").append(parseInt(data.TotalPaciente));

        $("#total2").empty();
        $("#total2").append(parseInt(data.totalMedico));

        $("#total3").empty();
        $("#total3").append(parseInt(data.totalFichasGeneral));

        $("#total4").empty();
        $("#total4").append(parseInt(data.totalFichasYear));


        $("#indMasculino").empty();
        $("#indFemenino").empty();
        $("#indPorConHG").empty();
        $("#indPorSinHG").empty();
        $("#indConHG").empty();
        $("#indSinHG").empty();
        $("#indConCol").empty();
        $("#indSinCol").empty();
        $("#indConHDL").empty();
        $("#indSinHDL").empty();
        $("#indConLDL").empty();
        $("#indSinLDL").empty();
        $("#indConIMC").empty();
        $("#indSinIMC").empty();

        $("#indMasculino").append(parseInt(data.TotalPacienteMasculino));
        $("#indFemenino").append(parseInt(data.TotalPacienteFemenino));
        $("#indPorConHG").append(parseFloat(data.CantidadHgSI));
        $("#indPorSinHG").append(parseFloat(data.CantidadHgNO));
        $("#indConHG").append(parseInt(data.PorcentajeHgCon));
        $("#indSinHG").append(parseInt(data.PorcentajeHgSin));
        $("#indConCol").append(parseInt(data.totalColesterolSI));
        $("#indSinCol").append(parseInt(data.totalColesterolNO));
        $("#indConHDL").append(parseInt(data.totalHDLSI));
        $("#indSinHDL").append(parseInt(data.totalHDLNO));
        $("#indConLDL").append(parseInt(data.totalLDLSI));
        $("#indSinLDL").append(parseInt(data.totalLDLNO));
        $("#indConIMC").append(parseInt(data.totalIMCSI));
        $("#indSinIMC").append(parseInt(data.totalIMCNO));


        $("#indTaller1").empty();
        $("#indTaller2").empty();
        $("#indTaller3").empty();
        $("#indTaller4").empty();
        $("#indTaller5").empty();
        $("#indTaller6").empty();

        $("#indTaller1").append("SI-> "+data.tallerGLUCSI+" NO ->"+data.tallerGLUCNO);
        $("#indTaller2").append("SI-> "+data.tallerNUTSI+" NO ->"+data.tallerNUTNO);
        $("#indTaller3").append("SI-> "+data.tallerDIASI+" NO ->"+data.tallerDIANO);
        $("#indTaller4").append("SI-> "+data.tallerINSSI+" NO ->"+data.tallerINSNO);
        $("#indTaller5").append("SI-> "+data.tallerPODSI+" NO ->"+data.tallerPODNO);
        $("#indTaller6").append("SI-> "+data.tallerPSISI+" NO ->"+data.tallerPSINO);

    });
}
function verificar(dato){
    if(isNaN(dato)){
        return 0;
    }else{
        var dato_Redondenado=Math.round(dato * 100) / 100;
        return dato_Redondenado;
    }
}

function PacienteReporte(num){
    var f_inicio=$("#inicio1").val();
   var f_fin=$("#fin1").val();

	if(f_inicio=='' || f_fin==''){
		  	notificar_warning("Seleccione Fechas")
		}else{
		  BuscarReporte(num,f_inicio,f_fin);
        }
}
function BuscarReporte(num,inicio,fin){

    $("#ModalReporte").modal("show");

    if(tablaReporte==null){
         tablaReporte = $('#tablaPacientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
          dom: 'lBfrtip',
         "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: 'Reporte'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte '
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CReporte.php?op=ListarReporte2',
            type: "POST",
            dataType: "JSON",
            data:{"num":num,"Inicio":inicio,"Fin":fin},
            error: function (e) {
                console.log(e.responseText);
            }
        },

        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaReporte.on('order.dt search.dt', function () {
        tablaReporte.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    }else{
        tablaReporte.destroy();
         tablaReporte = $('#tablaPacientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
          dom: 'lBfrtip',
         "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: 'Reporte'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte '
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CReporte.php?op=ListarReporte2',
            type: "POST",
            dataType: "JSON",
             data:{"num":num,"Inicio":inicio,"Fin":fin},
            error: function (e) {
                console.log(e.responseText);
            }
        },

        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaReporte.on('order.dt search.dt', function () {
        tablaReporte.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    }
}
init();
