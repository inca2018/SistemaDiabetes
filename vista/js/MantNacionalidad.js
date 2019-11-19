var tablaNacionalidad;

function init() {
    Iniciar_Componentes();
    Listar_Nacionalidad();
}

function Iniciar_Componentes() {
    $("#FormularioNacionalidad").on("submit", function (e) {
        RegistroNacionalidad(e);
    });

}

function RegistroNacionalidad(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalNacionalidad #cuerpo").addClass("whirl");
        $("#ModalNacionalidad #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroNacionalidad()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroNacionalidad() {
    var formData = new FormData($("#FormularioNacionalidad")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CNacionalidad.php?op=AccionNacionalidad",
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
                $("#ModalNacionalidad #cuerpo").removeClass("whirl");
                $("#ModalNacionalidad #cuerpo").removeClass("ringed");
                $("#ModalNacionalidad").modal("hide");
                swal("Error:", Mensaje);
                LimpiarNacionalidad();
                tablaNacionalidad.ajax.reload();
            } else {
                $("#ModalNacionalidad #cuerpo").removeClass("whirl");
                $("#ModalNacionalidad #cuerpo").removeClass("ringed");
                $("#ModalNacionalidad").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarNacionalidad();
                tablaNacionalidad.ajax.reload();
            }
        }
    });
}

function Listar_Nacionalidad() {
    tablaNacionalidad = $('#tablaNacionalidad').dataTable({
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
                title: 'Reporte Satisfacción'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte Satisfacción'
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CNacionalidad.php?op=Listar_Nacionalidad',
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
    tablaNacionalidad.on('order.dt search.dt', function () {
        tablaNacionalidad.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoNacionalidad() {

    $("#ModalNacionalidad").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalNacionalidad").modal("show");
    $("#tituloModalNacionalidad").empty();
    $("#tituloModalNacionalidad").append("Nuevo Registro de Nacionalidad:");
}

function EditarNacionalidad(idNacionalidad) {
    $("#ModalNacionalidad").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalNacionalidad").modal("show");
    $("#tituloModalNacionalidad").empty();
    $("#tituloModalNacionalidad").append("Editar Registro Nacionalidad:");
    RecuperarNacionalidad(idNacionalidad);
}

function RecuperarNacionalidad(idNacionalidad) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CNacionalidad.php?op=RecuperarInformacion_Nacionalidad", {
        "idNacionalidad": idNacionalidad
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idNacionalidad").val(data.idNacionalidad);
        $("#NacionalidadDescripcion").val(data.Descripcion);

    });
}

function EliminarNacionalidad(idNacionalidad) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Nacionalidad!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CNacionalidad.php?op=Eliminar_Nacionalidad", {
            idNacionalidad: idNacionalidad
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaNacionalidad.ajax.reload();
            }
        });
    });
}

function HabilitarNacionalidad(idNacionalidad) {
    swal({
        title: "Habilitar?",
        text: "Esta Seguro que desea Habilitar Nacionalidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Habilitar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CNacionalidad.php?op=HabilitarNacionalidad", {
            idNacionalidad: idNacionalidad,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Habilitado !", Mensaje, "success");
                tablaNacionalidad.ajax.reload();
            }
        });
    });
}

function DeshabilitarNacionalidad(idNacionalidad) {
    swal({
        title: "Deshabilitar?",
        text: "Esta Seguro que desea Deshabilitar Nacionalidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, DesHabilitar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CNacionalidad.php?op=DesHabilitarNacionalidad", {
            idNacionalidad: idNacionalidad,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("DesHabilitado !", Mensaje, "success");
                tablaNacionalidad.ajax.reload();
            }
        });
    });
}

function DesactivacionNacionalidad(idNacionalidad) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Nacionalidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CNacionalidad.php?op=Activacion_Nacionalidad", {
            idNacionalidad: idNacionalidad,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaNacionalidad.ajax.reload();
            }
        });
    });
}

function LimpiarNacionalidad() {
    $('#FormularioNacionalidad')[0].reset();
    $("#idNacionalidad").val("");
    $("#NacionalidadPersona").removeAttr("disabled");
    $("#NacionalidadPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarNacionalidad();
    $("#ModalNacionalidad").modal("hide");

}

init();
