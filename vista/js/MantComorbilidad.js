var tablaComorbilidad;

function init() {
    Iniciar_Componentes();
    Listar_Comorbilidad();
}

function Iniciar_Componentes() {
    $("#FormularioComorbilidad").on("submit", function (e) {
        RegistroComorbilidad(e);
    });

}

function RegistroComorbilidad(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalComorbilidad #cuerpo").addClass("whirl");
        $("#ModalComorbilidad #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroComorbilidad()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroComorbilidad() {
    var formData = new FormData($("#FormularioComorbilidad")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CComorbilidad.php?op=AccionComorbilidad",
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
                $("#ModalComorbilidad #cuerpo").removeClass("whirl");
                $("#ModalComorbilidad #cuerpo").removeClass("ringed");
                $("#ModalComorbilidad").modal("hide");
                swal("Error:", Mensaje);
                LimpiarComorbilidad();
                tablaComorbilidad.ajax.reload();
            } else {
                $("#ModalComorbilidad #cuerpo").removeClass("whirl");
                $("#ModalComorbilidad #cuerpo").removeClass("ringed");
                $("#ModalComorbilidad").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarComorbilidad();
                tablaComorbilidad.ajax.reload();
            }
        }
    });
}

function Listar_Comorbilidad() {
    tablaComorbilidad = $('#tablaComorbilidad').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": false, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CComorbilidad.php?op=Listar_Comorbilidad',
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
    tablaComorbilidad.on('order.dt search.dt', function () {
        tablaComorbilidad.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoComorbilidad() {

    $("#ModalComorbilidad").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalComorbilidad").modal("show");
    $("#tituloModalComorbilidad").empty();
    $("#tituloModalComorbilidad").append("Nuevo Registro de Comorbilidad:");
}

function EditarComorbilidad(idComorbilidad) {
    $("#ModalComorbilidad").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalComorbilidad").modal("show");
    $("#tituloModalComorbilidad").empty();
    $("#tituloModalComorbilidad").append("Editar Registro Comorbilidad:");
    RecuperarComorbilidad(idComorbilidad);
}

function RecuperarComorbilidad(idComorbilidad) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CComorbilidad.php?op=RecuperarInformacion_Comorbilidad", {
        "idComorbilidad": idComorbilidad
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idComorbilidad").val(data.idComorbilidad);
        $("#ComorbilidadDescripcion").val(data.Descripcion);

    });
}

function EliminarComorbilidad(idComorbilidad) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Comorbilidad!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CComorbilidad.php?op=Eliminar_Comorbilidad", {
            idComorbilidad: idComorbilidad
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaComorbilidad.ajax.reload();
            }
        });
    });
}

function ActivacionComorbilidad(idComorbilidad) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar Comorbilidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CComorbilidad.php?op=Activacion_Comorbilidad", {
            idComorbilidad: idComorbilidad,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaComorbilidad.ajax.reload();
            }
        });
    });
}

function DesactivacionComorbilidad(idComorbilidad) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Comorbilidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CComorbilidad.php?op=Activacion_Comorbilidad", {
            idComorbilidad: idComorbilidad,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaComorbilidad.ajax.reload();
            }
        });
    });
}

function LimpiarComorbilidad() {
    $('#FormularioComorbilidad')[0].reset();
    $("#idComorbilidad").val("");
    $("#ComorbilidadPersona").removeAttr("disabled");
    $("#ComorbilidadPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarComorbilidad();
    $("#ModalComorbilidad").modal("hide");

}

init();
