var tablaEnconado;

function init() {
    Iniciar_Componentes();
    Listar_Enconado();
    Listar_Materiales();
}

function Iniciar_Componentes() {
    //var fecha=hoyFecha();

    //$('#date_fecha_comprobante').datepicker('setDate',fecha);

    $("#FormularioEnconado").on("submit", function (e) {
        RegistroEnconado(e);
    });

}

function RegistroEnconado(event) {
    //cargar(true);
    event.preventDefault(); //No se activará la acción predeterminada del evento
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalEnconado #cuerpo").addClass("whirl");
        $("#ModalEnconado #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroEnconado()', 2000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroEnconado() {
    var formData = new FormData($("#FormularioEnconado")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Gestion/CEnconado.php?op=AccionEnconado",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, status) {
            data = JSON.parse(data);
            console.log(data);
            var Mensaje = data.Mensaje;
            var Error = data.Registro;
            if (!Error) {
                $("#ModalEnconado #cuerpo").removeClass("whirl");
                $("#ModalEnconado #cuerpo").removeClass("ringed");
                $("#ModalEnconado").modal("hide");
                swal("Error:", Mensaje);
                LimpiarEnconado();
                tablaEnconado.ajax.reload();
            } else {
                $("#ModalEnconado #cuerpo").removeClass("whirl");
                $("#ModalEnconado #cuerpo").removeClass("ringed");
                $("#ModalEnconado").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarEnconado();
                tablaEnconado.ajax.reload();
            }
        }
    });
}

function Listar_Materiales() {
    $.post("../../controlador/Gestion/CEnconado.php?op=listar_materiales", function (ts) {
        $("#EnconadoMaterial").append(ts);
    });
}

function Listar_Enconado() {

    tablaEnconado = $('#tablaEnconado').dataTable({
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
                "targets": [0, 1, 2, 4, 7, 8]
            }
            , {
                "className": "text-left",
                "targets": [3, ]
            }, {
                "className": "text-right",
                "targets": [5, 6]
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
            url: '../../controlador/Gestion/CEnconado.php?op=Listar_Enconado',
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
    tablaEnconado.on('order.dt search.dt', function () {
        tablaEnconado.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoEnconado() {
    $("#ModalEnconado").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalEnconado").modal("show");
    $("#tituloModalEnconado").empty();
    $("#tituloModalEnconado").append("Nuevo Orden de Trabajo:");
    $("#boton_bloqueo").show();
    RecuperarCorrelativo();
}

function EditarEnconado(idEnconado) {
    $("#ModalEnconado").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalEnconado").modal("show");
    $("#tituloModalEnconado").empty();
    $("#tituloModalEnconado").append("Editar Enconado:");
    $("#boton_bloqueo").show();
    RecuperarEnconado(idEnconado);
}

function Informacion(idEnconado) {
    $("#ModalEnconado").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalEnconado").modal("show");
    $("#tituloModalEnconado").empty();
    $("#tituloModalEnconado").append("Editar Enconado:");
    $("#boton_bloqueo").hide();
    RecuperarEnconado(idEnconado);
}

function RecuperarEnconado(idEnconado) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Gestion/CEnconado.php?op=RecuperarInformacion_Enconado", {
        "idEnconado": idEnconado
    }, function (data, status) {
        data = JSON.parse(data);
        console.log(data);
        $.post("../../controlador/Gestion/CEnconado.php?op=listar_materiales", function (ts) {
            $("#EnconadoMaterial").append(ts);
            $("#idEnconado").val(data.idOrden);
            $("#EnconadoNombre").val(data.NumOrden);
            $("#EnconadoMaterial").val(data.Material_idMaterial);
            $("#EnconadoLote").val(data.Lote);
            $("#EnconadoKilos").val(data.Kilos);
            $("#EnconadoNumero").val(data.NumConos);
            $("#EnconadoObservacion").val(data.Observaciones);


        });


    });
}

function RecuperarCorrelativo() {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Gestion/CEnconado.php?op=RecuperarCorrelativo", function (data, status) {
        data = JSON.parse(data);
        console.log(data);
        $("#EnconadoNombre").val("Nº 000" + (parseInt(data.correlativo) + 1));
    });
}

function EliminarEnconado(idEnconado) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Enconado!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        ajaxEliminarEnconado(idEnconado);
    });
}

function ajaxEliminarEnconado(idEnconado) {
    $.post("../../controlador/Gestion/CEnconado.php?op=Eliminar_Enconado", {
        idEnconado: idEnconado
    }, function (data, e) {
        data = JSON.parse(data);
        var Error = data.Error;
        var Mensaje = data.Mensaje;
        if (Error) {
            swal("Error", Mensaje, "error");
        } else {
            swal("Eliminado!", Mensaje, "success");
            tablaEnconado.ajax.reload();
        }
    });
}

function HabilitarEnconado(idEnconado) {
    swal({
        title: "Habilitar?",
        text: "Esta Seguro que desea Habilitar Enconado!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Habilitar!",
        closeOnConfirm: false
    }, function () {
        ajaxHabilitarEnconado(idEnconado);
    });
}

function ajaxHabilitarEnconado(idEnconado) {
    $.post("../../controlador/Mantenimiento/CEnconado.php?op=Recuperar_Enconado", {
        idEnconado: idEnconado
    }, function (data, e) {
        data = JSON.parse(data);
        var Error = data.Error;
        var Mensaje = data.Mensaje;
        if (Error) {
            swal("Error", Mensaje, "error");
        } else {
            swal("Eliminado!", Mensaje, "success");
            tablaEnconado.ajax.reload();
        }
    });
}

function LimpiarEnconado() {
    $('#FormularioEnconado')[0].reset();
    $("#idEnconado").val("");

}

function Cancelar() {
    LimpiarEnconado();
    $("#ModalEnconado").modal("hide");

}

function EnviarOVillado(idEnconado) {
    swal({
        title: "Enviar?",
        text: "Esta Seguro que desea Enviar la Orden al Area de  Ovillado!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Enviar!",
        closeOnConfirm: false
    }, function () {
        ajaxEnviarEnconado(idEnconado);
    });
}

function ajaxEnviarEnconado(idEnconado) {
    $.post("../../controlador/Gestion/CEnconado.php?op=Enviar_Enconado", {
        idEnconado: idEnconado
    }, function (data, e) {
        data = JSON.parse(data);
        var Enviar = data.Enviar;
        var Mensaje = data.Mensaje;
        if (!Enviar) {
            swal("Error", Mensaje, "error");
        } else {
            swal("Enviado!", Mensaje, "success");
            tablaEnconado.ajax.reload();
        }
    });
}

function InformacionRechazo(idEnconado) {

    $("#ModalRechazo").modal("show");

    $.post("../../controlador/Gestion/CEnconado.php?op=RecuperarRechazo", {
        "idEnconado": idEnconado
    }, function (data, status) {
        data = JSON.parse(data);
        console.log(data);

        $("#RechazoObservacion").val(data.Rechazo);
        $("#FechaRechazo").val(data.FechaRechazo);

    });
  }

init();
