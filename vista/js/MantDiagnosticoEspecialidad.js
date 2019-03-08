var tablaDiagnosticoEspecialidad;

function init() {
    Iniciar_Componentes();
    Listar_DiagnosticoEspecialidad();
}

function Iniciar_Componentes() {
    $("#FormularioDiagnosticoEspecialidad").on("submit", function (e) {
        RegistroDiagnosticoEspecialidad(e);
    });

}

function RegistroDiagnosticoEspecialidad(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalDiagnosticoEspecialidad #cuerpo").addClass("whirl");
        $("#ModalDiagnosticoEspecialidad #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroDiagnosticoEspecialidad()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroDiagnosticoEspecialidad() {
    var formData = new FormData($("#FormularioDiagnosticoEspecialidad")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CDiagnosticoEspecialidad.php?op=AccionDiagnosticoEspecialidad",
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
                $("#ModalDiagnosticoEspecialidad #cuerpo").removeClass("whirl");
                $("#ModalDiagnosticoEspecialidad #cuerpo").removeClass("ringed");
                $("#ModalDiagnosticoEspecialidad").modal("hide");
                swal("Error:", Mensaje);
                LimpiarDiagnosticoEspecialidad();
                tablaDiagnosticoEspecialidad.ajax.reload();
            } else {
                $("#ModalDiagnosticoEspecialidad #cuerpo").removeClass("whirl");
                $("#ModalDiagnosticoEspecialidad #cuerpo").removeClass("ringed");
                $("#ModalDiagnosticoEspecialidad").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarDiagnosticoEspecialidad();
                tablaDiagnosticoEspecialidad.ajax.reload();
            }
        }
    });
}

function Listar_DiagnosticoEspecialidad() {
    tablaDiagnosticoEspecialidad = $('#tablaDiagnosticoEspecialidad').dataTable({
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
                title: 'Reporte Diagnostico Especialidad'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte Diagnostico Especialidad'
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CDiagnosticoEspecialidad.php?op=Listar_DiagnosticoEspecialidad',
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
    tablaDiagnosticoEspecialidad.on('order.dt search.dt', function () {
        tablaDiagnosticoEspecialidad.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoDiagnosticoEspecialidad() {

    $("#ModalDiagnosticoEspecialidad").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalDiagnosticoEspecialidad").modal("show");
    $("#tituloModalDiagnosticoEspecialidad").empty();
    $("#tituloModalDiagnosticoEspecialidad").append("Nuevo Registro de DiagnosticoEspecialidad:");
}

function EditarDiagnosticoEspecialidad(idDiagnosticoEspecialidad) {
    $("#ModalDiagnosticoEspecialidad").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalDiagnosticoEspecialidad").modal("show");
    $("#tituloModalDiagnosticoEspecialidad").empty();
    $("#tituloModalDiagnosticoEspecialidad").append("Editar Registro DiagnosticoEspecialidad:");
    RecuperarDiagnosticoEspecialidad(idDiagnosticoEspecialidad);
}

function RecuperarDiagnosticoEspecialidad(idDiagnosticoEspecialidad) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CDiagnosticoEspecialidad.php?op=RecuperarInformacion_DiagnosticoEspecialidad", {
        "idDiagnosticoEspecialidad": idDiagnosticoEspecialidad
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idDiagnosticoEspecialidad").val(data.idDiagnosticoEspecialidad);
        $("#DiagnosticoEspecialidadDescripcion").val(data.Descripcion);

    });
}

function EliminarDiagnosticoEspecialidad(idDiagnosticoEspecialidad) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar DiagnosticoEspecialidad!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnosticoEspecialidad.php?op=Eliminar_DiagnosticoEspecialidad", {
            idDiagnosticoEspecialidad: idDiagnosticoEspecialidad
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaDiagnosticoEspecialidad.ajax.reload();
            }
        });
    });
}

function ActivacionDiagnosticoEspecialidad(idDiagnosticoEspecialidad) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar DiagnosticoEspecialidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnosticoEspecialidad.php?op=Activacion_DiagnosticoEspecialidad", {
            idDiagnosticoEspecialidad: idDiagnosticoEspecialidad,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaDiagnosticoEspecialidad.ajax.reload();
            }
        });
    });
}

function DesactivacionDiagnosticoEspecialidad(idDiagnosticoEspecialidad) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar DiagnosticoEspecialidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnosticoEspecialidad.php?op=Activacion_DiagnosticoEspecialidad", {
            idDiagnosticoEspecialidad: idDiagnosticoEspecialidad,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaDiagnosticoEspecialidad.ajax.reload();
            }
        });
    });
}

function LimpiarDiagnosticoEspecialidad() {
    $('#FormularioDiagnosticoEspecialidad')[0].reset();
    $("#idDiagnosticoEspecialidad").val("");
    $("#DiagnosticoEspecialidadPersona").removeAttr("disabled");
    $("#DiagnosticoEspecialidadPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarDiagnosticoEspecialidad();
    $("#ModalDiagnosticoEspecialidad").modal("hide");

}

init();
