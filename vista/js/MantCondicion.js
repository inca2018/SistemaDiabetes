var tablaCondicion;

function init() {
    Iniciar_Componentes();
    Listar_Condicion();
}

function Iniciar_Componentes() {
    $("#FormularioCondicion").on("submit", function (e) {
        RegistroCondicion(e);
    });

}

function RegistroCondicion(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalCondicion #cuerpo").addClass("whirl");
        $("#ModalCondicion #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroCondicion()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroCondicion() {
    var formData = new FormData($("#FormularioCondicion")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CCondicion.php?op=AccionCondicion",
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
                $("#ModalCondicion #cuerpo").removeClass("whirl");
                $("#ModalCondicion #cuerpo").removeClass("ringed");
                $("#ModalCondicion").modal("hide");
                swal("Error:", Mensaje);
                LimpiarCondicion();
                tablaCondicion.ajax.reload();
            } else {
                $("#ModalCondicion #cuerpo").removeClass("whirl");
                $("#ModalCondicion #cuerpo").removeClass("ringed");
                $("#ModalCondicion").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarCondicion();
                tablaCondicion.ajax.reload();
            }
        }
    });
}

function Listar_Condicion() {
    tablaCondicion = $('#tablaCondicion').dataTable({
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
                title: 'Reporte de Condición'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte de Condición'
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CCondicion.php?op=Listar_Condicion',
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
    tablaCondicion.on('order.dt search.dt', function () {
        tablaCondicion.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoCondicion() {

    $("#ModalCondicion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalCondicion").modal("show");
    $("#tituloModalCondicion").empty();
    $("#tituloModalCondicion").append("Nuevo Registro de Condicion:");
}

function EditarCondicion(idCondicion) {
    $("#ModalCondicion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalCondicion").modal("show");
    $("#tituloModalCondicion").empty();
    $("#tituloModalCondicion").append("Editar Registro Condicion:");
    RecuperarCondicion(idCondicion);
}

function RecuperarCondicion(idCondicion) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CCondicion.php?op=RecuperarInformacion_Condicion", {
        "idCondicion": idCondicion
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idCondicion").val(data.idCondicion);
        $("#CondicionDescripcion").val(data.Descripcion);

    });
}

function EliminarCondicion(idCondicion) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Condicion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CCondicion.php?op=Eliminar_Condicion", {
            idCondicion: idCondicion
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaCondicion.ajax.reload();
            }
        });
    });
}

function ActivacionCondicion(idCondicion) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar Condicion!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CCondicion.php?op=Activacion_Condicion", {
            idCondicion: idCondicion,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaCondicion.ajax.reload();
            }
        });
    });
}

function DesactivacionCondicion(idCondicion) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Condicion!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CCondicion.php?op=Activacion_Condicion", {
            idCondicion: idCondicion,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaCondicion.ajax.reload();
            }
        });
    });
}

function LimpiarCondicion() {
    $('#FormularioCondicion')[0].reset();
    $("#idCondicion").val("");
    $("#CondicionPersona").removeAttr("disabled");
    $("#CondicionPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarCondicion();
    $("#ModalCondicion").modal("hide");

}

init();
