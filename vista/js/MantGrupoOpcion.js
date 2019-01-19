var tablaGrupoOpcion;

function init() {
    Iniciar_Componentes();
    Listar_GrupoOpcion();
}

function Iniciar_Componentes() {
    $("#FormularioGrupoOpcion").on("submit", function (e) {
        RegistroGrupoOpcion(e);
    });

}

function RegistroGrupoOpcion(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalGrupoOpcion #cuerpo").addClass("whirl");
        $("#ModalGrupoOpcion #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroGrupoOpcion()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroGrupoOpcion() {
    var formData = new FormData($("#FormularioGrupoOpcion")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CGrupoOpcion.php?op=AccionGrupoOpcion",
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
                $("#ModalGrupoOpcion #cuerpo").removeClass("whirl");
                $("#ModalGrupoOpcion #cuerpo").removeClass("ringed");
                $("#ModalGrupoOpcion").modal("hide");
                swal("Error:", Mensaje);
                LimpiarGrupoOpcion();
                tablaGrupoOpcion.ajax.reload();
            } else {
                $("#ModalGrupoOpcion #cuerpo").removeClass("whirl");
                $("#ModalGrupoOpcion #cuerpo").removeClass("ringed");
                $("#ModalGrupoOpcion").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarGrupoOpcion();
                tablaGrupoOpcion.ajax.reload();
            }
        }
    });
}

function Listar_GrupoOpcion() {
    tablaGrupoOpcion = $('#tablaGrupoOpcion').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": false, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CGrupoOpcion.php?op=Listar_GrupoOpcion',
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
                "targets": [1, 3, 4]
            }
            , {
                "className": "text-left",
                "targets": [2]
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
    tablaGrupoOpcion.on('order.dt search.dt', function () {
        tablaGrupoOpcion.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoGrupoOpcion() {

    $("#ModalGrupoOpcion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalGrupoOpcion").modal("show");
    $("#tituloModalGrupoOpcion").empty();
    $("#tituloModalGrupoOpcion").append("Nuevo Registro de GrupoOpcion:");
}

function EditarGrupoOpcion(idGrupoOpcion) {
    $("#ModalGrupoOpcion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalGrupoOpcion").modal("show");
    $("#tituloModalGrupoOpcion").empty();
    $("#tituloModalGrupoOpcion").append("Editar Registro GrupoOpcion:");
    RecuperarGrupoOpcion(idGrupoOpcion);
}

function RecuperarGrupoOpcion(idGrupoOpcion) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CGrupoOpcion.php?op=RecuperarInformacion_GrupoOpcion", {
        "idGrupoOpcion": idGrupoOpcion
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idGrupoOpcion").val(data.idGrupoOpcion);
        $("#GrupoOpcionDescripcion").val(data.Descripcion);

    });
}

function EliminarGrupoOpcion(idGrupoOpcion) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar GrupoOpcion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CGrupoOpcion.php?op=Eliminar_GrupoOpcion", {
            idGrupoOpcion: idGrupoOpcion
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaGrupoOpcion.ajax.reload();
            }
        });
    });
}

function ActivacionGrupoOpcion(idGrupoOpcion) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar GrupoOpcion!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CGrupoOpcion.php?op=Activacion_GrupoOpcion", {
            idGrupoOpcion: idGrupoOpcion,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaGrupoOpcion.ajax.reload();
            }
        });
    });
}

function DesactivacionGrupoOpcion(idGrupoOpcion) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar GrupoOpcion!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CGrupoOpcion.php?op=Activacion_GrupoOpcion", {
            idGrupoOpcion: idGrupoOpcion,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaGrupoOpcion.ajax.reload();
            }
        });
    });
}

function LimpiarGrupoOpcion() {
    $('#FormularioGrupoOpcion')[0].reset();
    $("#idGrupoOpcion").val("");
    $("#GrupoOpcionPersona").removeAttr("disabled");
    $("#GrupoOpcionPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarGrupoOpcion();
    $("#ModalGrupoOpcion").modal("hide");

}

init();
