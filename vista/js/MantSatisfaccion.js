var tablaSatisfaccion;

function init() {
    Iniciar_Componentes();
    Listar_Satisfaccion();
}

function Iniciar_Componentes() {
    $("#FormularioSatisfaccion").on("submit", function (e) {
        RegistroSatisfaccion(e);
    });

}

function RegistroSatisfaccion(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalSatisfaccion #cuerpo").addClass("whirl");
        $("#ModalSatisfaccion #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroSatisfaccion()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroSatisfaccion() {
    var formData = new FormData($("#FormularioSatisfaccion")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CSatisfaccion.php?op=AccionSatisfaccion",
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
                $("#ModalSatisfaccion #cuerpo").removeClass("whirl");
                $("#ModalSatisfaccion #cuerpo").removeClass("ringed");
                $("#ModalSatisfaccion").modal("hide");
                swal("Error:", Mensaje);
                LimpiarSatisfaccion();
                tablaSatisfaccion.ajax.reload();
            } else {
                $("#ModalSatisfaccion #cuerpo").removeClass("whirl");
                $("#ModalSatisfaccion #cuerpo").removeClass("ringed");
                $("#ModalSatisfaccion").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarSatisfaccion();
                tablaSatisfaccion.ajax.reload();
            }
        }
    });
}

function Listar_Satisfaccion() {
    tablaSatisfaccion = $('#tablaSatisfaccion').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": false, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CSatisfaccion.php?op=Listar_Satisfaccion',
            type: "POST",
            dataType: "JSON",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3, 4]
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
                title: 'Facturacion'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: $('title').text()
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaSatisfaccion.on('order.dt search.dt', function () {
        tablaSatisfaccion.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoSatisfaccion() {

    $("#ModalSatisfaccion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalSatisfaccion").modal("show");
    $("#tituloModalSatisfaccion").empty();
    $("#tituloModalSatisfaccion").append("Nuevo Registro de Satisfaccion:");
}

function EditarSatisfaccion(idSatisfaccion) {
    $("#ModalSatisfaccion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalSatisfaccion").modal("show");
    $("#tituloModalSatisfaccion").empty();
    $("#tituloModalSatisfaccion").append("Editar Registro Satisfaccion:");
    RecuperarSatisfaccion(idSatisfaccion);
}

function RecuperarSatisfaccion(idSatisfaccion) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CSatisfaccion.php?op=RecuperarInformacion_Satisfaccion", {
        "idSatisfaccion": idSatisfaccion
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idSatisfaccion").val(data.idSatisfaccion);
        $("#SatisfaccionDescripcion").val(data.Descripcion);

    });
}

function EliminarSatisfaccion(idSatisfaccion) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Satisfaccion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CSatisfaccion.php?op=Eliminar_Satisfaccion", {
            idSatisfaccion: idSatisfaccion
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaSatisfaccion.ajax.reload();
            }
        });
    });
}

function ActivacionSatisfaccion(idSatisfaccion) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar Satisfaccion!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CSatisfaccion.php?op=Activacion_Satisfaccion", {
            idSatisfaccion: idSatisfaccion,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaSatisfaccion.ajax.reload();
            }
        });
    });
}

function DesactivacionSatisfaccion(idSatisfaccion) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Satisfaccion!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CSatisfaccion.php?op=Activacion_Satisfaccion", {
            idSatisfaccion: idSatisfaccion,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaSatisfaccion.ajax.reload();
            }
        });
    });
}

function LimpiarSatisfaccion() {
    $('#FormularioSatisfaccion')[0].reset();
    $("#idSatisfaccion").val("");
    $("#SatisfaccionPersona").removeAttr("disabled");
    $("#SatisfaccionPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarSatisfaccion();
    $("#ModalSatisfaccion").modal("hide");

}

init();
