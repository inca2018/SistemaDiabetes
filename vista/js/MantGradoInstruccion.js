var tablaGradoInstruccion;

function init() {
    Iniciar_Componentes();
    Listar_GradoInstruccion();
}

function Iniciar_Componentes() {
    $("#FormularioGradoInstruccion").on("submit", function (e) {
        RegistroGradoInstruccion(e);
    });

}

function RegistroGradoInstruccion(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalGradoInstruccion #cuerpo").addClass("whirl");
        $("#ModalGradoInstruccion #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroGradoInstruccion()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroGradoInstruccion() {
    var formData = new FormData($("#FormularioGradoInstruccion")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CGradoInstruccion.php?op=AccionGradoInstruccion",
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
                $("#ModalGradoInstruccion #cuerpo").removeClass("whirl");
                $("#ModalGradoInstruccion #cuerpo").removeClass("ringed");
                $("#ModalGradoInstruccion").modal("hide");
                swal("Error:", Mensaje);
                LimpiarGradoInstruccion();
                tablaGradoInstruccion.ajax.reload();
            } else {
                $("#ModalGradoInstruccion #cuerpo").removeClass("whirl");
                $("#ModalGradoInstruccion #cuerpo").removeClass("ringed");
                $("#ModalGradoInstruccion").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarGradoInstruccion();
                tablaGradoInstruccion.ajax.reload();
            }
        }
    });
}

function Listar_GradoInstruccion() {
    tablaGradoInstruccion = $('#tablaGradoInstruccion').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": false, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CGradoInstruccion.php?op=Listar_GradoInstruccion',
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
    tablaGradoInstruccion.on('order.dt search.dt', function () {
        tablaGradoInstruccion.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoGradoInstruccion() {

    $("#ModalGradoInstruccion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalGradoInstruccion").modal("show");
    $("#tituloModalGradoInstruccion").empty();
    $("#tituloModalGradoInstruccion").append("Nuevo Registro de GradoInstruccion:");
}

function EditarGradoInstruccion(idGradoInstruccion) {
    $("#ModalGradoInstruccion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalGradoInstruccion").modal("show");
    $("#tituloModalGradoInstruccion").empty();
    $("#tituloModalGradoInstruccion").append("Editar Registro GradoInstruccion:");
    RecuperarGradoInstruccion(idGradoInstruccion);
}

function RecuperarGradoInstruccion(idGradoInstruccion) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CGradoInstruccion.php?op=RecuperarInformacion_GradoInstruccion", {
        "idGradoInstruccion": idGradoInstruccion
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idGradoInstruccion").val(data.idGradoInstruccion);
        $("#GradoInstruccionDescripcion").val(data.Descripcion);

    });
}

function EliminarGradoInstruccion(idGradoInstruccion) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar GradoInstruccion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CGradoInstruccion.php?op=Eliminar_GradoInstruccion", {
            idGradoInstruccion: idGradoInstruccion
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaGradoInstruccion.ajax.reload();
            }
        });
    });
}

function ActivacionGradoInstruccion(idGradoInstruccion) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar GradoInstruccion!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CGradoInstruccion.php?op=Activacion_GradoInstruccion", {
            idGradoInstruccion: idGradoInstruccion,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaGradoInstruccion.ajax.reload();
            }
        });
    });
}

function DesactivacionGradoInstruccion(idGradoInstruccion) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar GradoInstruccion!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CGradoInstruccion.php?op=Activacion_GradoInstruccion", {
            idGradoInstruccion: idGradoInstruccion,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaGradoInstruccion.ajax.reload();
            }
        });
    });
}

function LimpiarGradoInstruccion() {
    $('#FormularioGradoInstruccion')[0].reset();
    $("#idGradoInstruccion").val("");
    $("#GradoInstruccionPersona").removeAttr("disabled");
    $("#GradoInstruccionPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarGradoInstruccion();
    $("#ModalGradoInstruccion").modal("hide");

}

init();
