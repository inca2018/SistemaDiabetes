var tablaCalidad;
var tablaGestionOvillado;

function init() {
    Listar_Calidad();

}

function Listar_Calidad() {

    tablaCalidad = $('#tablaCalidad').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        dom: 'lBfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[0, "asc"]],
        "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info',
                title: "Sistema"
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: "Sistema"
            }
            , {
                extend: 'pdfHtml5',
                className: 'btn-info sombra3',
                title: "Sistema",
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
            , {
                extend: 'print',
                className: 'btn-info',
                title: "Sistema"
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CCalidad.php?op=Listar_Ovillado',
            type: "POST",
            dataType: "JSON",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaCalidad.on('order.dt search.dt', function () {
        tablaCalidad.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function OrdenesOvilladoLista(idOrden) {
    $("#ModalTrabajos").modal("show");
    Listar_Gestion_lista(idOrden);
}

function Listar_Gestion_lista(idOrden) {
    if (tablaGestionOvillado == null) {
        tablaGestionOvillado = $('#tablaTrabajos').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            "processing": true,
            "paging": true, // Paginacion en tabla
            "ordering": true, // Ordenamiento en columna de tabla
            "info": false, // Informacion de cabecera tabla
            "responsive": true, // Accion de responsive
            dom: 'lBfrtip',
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[0, "asc"]],
            "bDestroy": true,
            "columnDefs": [
                {
                    "className": "text-center",
                    "targets": [1, 2,3,4,5,6,7,8]
            }
            , {
                    "className": "text-left",
                    "targets": [0]
            }
         , ],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-info',
                    title: "Sistema"
            }
            , {
                    extend: 'excel',
                    className: 'btn-info',
                    title: "Sistema"
            }
            , {
                    extend: 'pdfHtml5',
                    className: 'btn-info sombra3',
                    title: "Sistema",
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
            }
            , {
                    extend: 'print',
                    className: 'btn-info',
                    title: "Sistema"
            }
            ],
            "ajax": { //Solicitud Ajax Servidor
                url: '../../controlador/Gestion/COvillado.php?op=Listar_Gestion_trabajos',
                type: "POST",
                dataType: "JSON",
                data: {
                    idOrden: idOrden
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            },
            // cambiar el lenguaje de datatable
            oLanguage: español,
        }).DataTable();
        //Aplicar ordenamiento y autonumeracion , index
        tablaGestionOvillado.on('order.dt search.dt', function () {
            tablaGestionOvillado.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

    } else {
        tablaGestionOvillado.destroy();

        tablaGestionOvillado = $('#tablaTrabajos').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            "processing": true,
            "paging": true, // Paginacion en tabla
            "ordering": true, // Ordenamiento en columna de tabla
            "info": false, // Informacion de cabecera tabla
            "responsive": true, // Accion de responsive
            dom: 'lBfrtip',
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[0, "asc"]],
            "bDestroy": true,
            "columnDefs": [
                {
                    "className": "text-center",
                    "targets": [1, 2,3,4,5,6,7,8]
            }
            , {
                    "className": "text-left",
                    "targets": [0]
            }
         , ],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-info',
                    title: "Sistema"
            }
            , {
                    extend: 'excel',
                    className: 'btn-info',
                    title: "Sistema"
            }
            , {
                    extend: 'pdfHtml5',
                    className: 'btn-info sombra3',
                    title: "Sistema",
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
            }
            , {
                    extend: 'print',
                    className: 'btn-info',
                    title: "Sistema"
            }
            ],
            "ajax": { //Solicitud Ajax Servidor
                url: '../../controlador/Gestion/COvillado.php?op=Listar_Gestion_trabajos',
                type: "POST",
                dataType: "JSON",
                data: {
                    idOrden: idOrden
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            },
            // cambiar el lenguaje de datatable
            oLanguage: español,
        }).DataTable();
        //Aplicar ordenamiento y autonumeracion , index
        tablaGestionOvillado.on('order.dt search.dt', function () {
            tablaGestionOvillado.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    }

}

function DevolverEnconado(idOrden) {
    $("#ModalRechazo").modal("show");
    $("#tituloRechazo").empty();
    $("#tituloRechazo").append("MOTIVO DE RECHAZO - ENVIAR AL AREA DE ENCONADO");
    $("#TipoRechazo").val("ENCONADO");
    $("#idOrden").val(idOrden);
}

function EnviarRechazo() {

    var TipoRechazo = $("#TipoRechazo").val();
    var idOrden = $("#idOrden").val();
    var Observacion = $("#RechazoObservacion").val();

    if (Observacion == '') {
        notificar_warning("Debe Ingresar el Motivo de Rechazo!");
    } else {
        $.post("../../controlador/Gestion/CCalidad.php?op=EnvioRechazo", {
            idOrden: idOrden,
            TipoRechazo: TipoRechazo,
            Observacion: Observacion
        }, function (data, e) {
            data = JSON.parse(data);
            var Enviar = data.Enviar;
            var Mensaje = data.Mensaje;
            if (!Enviar) {
                swal("Error", Mensaje, "error");
            } else {
                $("#ModalRechazo").modal("hide");
                swal("Rechazo!", Mensaje, "success");
                tablaCalidad.ajax.reload();
            }
        });

    }
}

function DevolverOvillado(idOrden) {
    $("#ModalRechazo").modal("show");
    $("#tituloRechazo").empty();
    $("#tituloRechazo").append("MOTIVO DE RECHAZO - ENVIAR AL AREA DE OVILLADO");
    $("#TipoRechazo").val("OVILLADO");
    $("#idOrden").val(idOrden);
}


function Finalizar(idOrden) {
    swal({
        title: "Aprobar?",
        text: "Esta Seguro que desea Aprobar Orden de Trabajo!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Aprobar!",
        closeOnConfirm: false
    }, function () {
        ajaxFinalizar(idOrden);
    });
}

function ajaxFinalizar(idOrden) {
    $.post("../../controlador/Gestion/CCalidad.php?op=Finalizar", {
        idOrden: idOrden
    }, function (data, e) {
        data = JSON.parse(data);
        var Finalizar = data.Finalizar;
        var Mensaje = data.Mensaje;
        if (!Finalizar) {
            swal("Error", Mensaje, "error");
        } else {
            swal("Aprobado!", Mensaje, "success");
            tablaCalidad.ajax.reload();
        }
    });
}

init();
