var datos;
var datos2;
var sumaDisponible = 0;
var sumaNoDisponible = 0;
var sumaDisponible2 = 0;
var sumaNoDisponible2 = 0;
var cuerpo = "";
var cuerpo2 = "";
var cont = 0;


var tabladetalle1;
var tabladetalle2;
var tablaReporte;

function init() {

    iniciar();
    Listar_Sexo();
}


function Listar_Sexo() {
    $.post("../../controlador/Mantenimiento/CMedico.php?op=listar_sexo", function (ts) {
        $("#IndicadorSexo").empty();
        $("#IndicadorSexo").append(ts);
    });
}

function iniciar() {

    $('#date_inicio1').datepicker({
        format: 'dd/mm/yyyy',

    });
    $('#date_fin1').datepicker({

        format: 'dd/mm/yyyy',
    });

    $('#date_inicio1').datepicker().on('changeDate', function (ev) {
        var f_inicio = $("#inicio1").val();
        var f_fin = $("#fin1").val();
        var day = parseInt(f_inicio.substr(0, 2));
        var month = parseInt(f_inicio.substr(3, 2));
        var year = parseInt(f_inicio.substr(6, 8));
        $('#date_fin1').datepicker('setStartDate', new Date(year, (month - 1), day));
    });

    $('#date_fin1').datepicker().on('changeDate', function (ev) {
        var f_inicio = $("#inicio1").val();
        var f_fin = $("#fin1").val();
        var day = parseInt(f_fin.substr(0, 2));
        var month = parseInt(f_fin.substr(3, 2));
        var year = parseInt(f_fin.substr(6, 8));

        $('#date_inicio1').datepicker('setEndDate', new Date(year, (month - 1), day));
    });

}

function buscar_reporte() {

    var f_inicio = $("#inicio1").val();
    var f_fin = $("#fin1").val();
    var sexo = $("#IndicadorSexo").val();
    if (f_inicio == '' || f_fin == '') {
        notificar_warning("Seleccione Fechas")
    } else {
        buscarReporte(f_inicio, f_fin, sexo);
    }
}

function buscarReporte(Inicio, Fin, Sexo) {
    $.post("../../controlador/Gestion/CReporte.php?op=recuperar_totales", {
        Inicio: Inicio,
        Fin: Fin,
        Sexo: Sexo
    }, function (data, status) {
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

        $("#indMasculino").append(parseInt(data.TotalPacienteMasculino)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(1);"><i class="fa fa-share"></i></button> ');
        $("#indFemenino").append(parseInt(data.TotalPacienteFemenino)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(2);"><i class="fa fa-share"></i></button> ');



        $("#indPorConHG").append(parseFloat(data.CantidadHgSI)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(3);"><i class="fa fa-share"></i></button> ');
        $("#indPorSinHG").append(parseFloat(data.CantidadHgNO)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(4);"><i class="fa fa-share"></i></button> ');

        $("#indConHG").append(parseInt(data.PorcentajeHgCon)+" %");
        $("#indSinHG").append(parseInt(data.PorcentajeHgSin)+" %");

        var TotalCol=parseInt(data.totalColesterolSI)+parseInt(data.totalColesterolNO);
        var porceA=(parseInt(data.totalColesterolSI)*100)/TotalCol;
        var porceB=(parseInt(data.totalColesterolNO)*100)/TotalCol;

        $("#indConCol").append(parseInt(data.totalColesterolSI)+' - '+porceA+' %<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(5);"><i class="fa fa-share"></i></button> ');
        $("#indSinCol").append(parseInt(data.totalColesterolNO)+' - '+porceB+' %<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(6);"><i class="fa fa-share"></i></button> ');

        var TotalCol2=parseInt(data.totalHDLSI)+parseInt(data.totalHDLNO);
        var porceA2=(parseInt(data.totalHDLSI)*100)/TotalCol2;
        var porceB2=(parseInt(data.totalHDLNO)*100)/TotalCol2;

        $("#indConHDL").append(parseInt(data.totalHDLSI)+' - '+porceA2+' %<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(7);"><i class="fa fa-share"></i></button> ');
        $("#indSinHDL").append(parseInt(data.totalHDLNO)+' - '+porceB2+' %<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(8);"><i class="fa fa-share"></i></button> ');

        var TotalCol3=parseInt(data.totalLDLSI)+parseInt(data.totalLDLNO);
        var porceA3=(parseInt(data.totalLDLSI)*100)/TotalCol3;
        var porceB3=(parseInt(data.totalLDLNO)*100)/TotalCol3;

        $("#indConLDL").append(parseInt(data.totalLDLSI)+' - '+porceA3+' %<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(9);"><i class="fa fa-share"></i></button> ');
        $("#indSinLDL").append(parseInt(data.totalLDLNO)+' - '+porceB3+' %<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(10);"><i class="fa fa-share"></i></button> ');

         var TotalCol4=parseInt(data.totalIMCSI)+parseInt(data.totalIMCNO);
        var porceA4=(parseInt(data.totalIMCSI)*100)/TotalCol4;
        var porceB4=(parseInt(data.totalIMCNO)*100)/TotalCol4;

        $("#indConIMC").append(parseInt(data.totalIMCSI)+' - '+porceA4+' %<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(11);"><i class="fa fa-share"></i></button> ');
        $("#indSinIMC").append(parseInt(data.totalIMCNO)+' - '+porceB4+' %<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(12);"><i class="fa fa-share"></i></button> ');


        $("#indTaller1").empty();
        $("#indTaller2").empty();
        $("#indTaller3").empty();
        $("#indTaller4").empty();
        $("#indTaller5").empty();
        $("#indTaller6").empty();

        $("#indTaller1").append("SI = " + parseInt(data.tallerGLUCSI) + " NO = " + parseInt(data.tallerGLUCNO)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(13);"><i class="fa fa-share"></i></button> ');
        $("#indTaller2").append("SI = " + parseInt(data.tallerNUTSI) + " NO = " + parseInt(data.tallerNUTNO)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(14);"><i class="fa fa-share"></i></button> ');
        $("#indTaller3").append("SI = " + parseInt(data.tallerDIASI) + " NO = " + parseInt(data.tallerDIANO)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(15);"><i class="fa fa-share"></i></button> ');
        $("#indTaller4").append("SI = " + parseInt(data.tallerINSSI) + " NO = " + parseInt(data.tallerINSNO)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(16);"><i class="fa fa-share"></i></button> ');
        $("#indTaller5").append("SI = " + parseInt(data.tallerPODSI) + " NO = " + parseInt(data.tallerPODNO)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(17);"><i class="fa fa-share"></i></button> ');
        $("#indTaller6").append("SI = " + parseInt(data.tallerPSISI) + " NO = " + parseInt(data.tallerPSINO)+'<button class="btn btn-warning  btn-sm ml-3"  onclick="PacienteReporte(18);"><i class="fa fa-share"></i></button> ');

    });
}

function verificar(dato) {
    if (isNaN(dato)) {
        return 0;
    } else {
        var dato_Redondenado = Math.round(dato * 100) / 100;
        return dato_Redondenado;
    }
}

function PacienteReporte(num) {
    debugger;
    var f_inicio = $("#inicio1").val();
    var f_fin = $("#fin1").val();
    var sexo = $("#IndicadorSexo").val();

    if (f_inicio == '' || f_fin == '') {
        notificar_warning("Seleccione Fechas")
    } else {
        BuscarReporte(num, f_inicio, f_fin,sexo);
    }
}

function BuscarReporte(num, inicio, fin, sexo) {

    $("#ModalReporte").modal("show");

    if (tablaReporte == null) {
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
                data: {
                    "num": num,
                    "Inicio": inicio,
                    "Fin": fin,
                    "Sexo":sexo
                },
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
    } else {
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
                data: {
                    "num": num,
                    "Inicio": inicio,
                    "Fin": fin,
                     "Sexo":sexo
                },
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

function BuscarTaller(taller) {
    $.post("../../controlador/Gestion/CReporte.php?op=recuperarPacientesTaller", {
        idOpcionTaller: taller
    }, function (data, status) {
        data = JSON.parse(data);


    });
}

init();
