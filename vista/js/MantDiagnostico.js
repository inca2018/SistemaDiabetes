var tablaDiagnostico;

function init() {
    Iniciar_Componentes();
    Listar_Diagnostico();
}

function Iniciar_Componentes() {
    $("#FormularioDiagnostico").on("submit", function (e) {
        RegistroDiagnostico(e);
    });

}

function RegistroDiagnostico(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalDiagnostico #cuerpo").addClass("whirl");
        $("#ModalDiagnostico #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroDiagnostico()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroDiagnostico() {
    var formData = new FormData($("#FormularioDiagnostico")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CDiagnostico.php?op=AccionDiagnostico",
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
                $("#ModalDiagnostico #cuerpo").removeClass("whirl");
                $("#ModalDiagnostico #cuerpo").removeClass("ringed");
                $("#ModalDiagnostico").modal("hide");
                swal("Error:", Mensaje);
                LimpiarDiagnostico();
                tablaDiagnostico.ajax.reload();
            } else {
                $("#ModalDiagnostico #cuerpo").removeClass("whirl");
                $("#ModalDiagnostico #cuerpo").removeClass("ringed");
                $("#ModalDiagnostico").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarDiagnostico();
                tablaDiagnostico.ajax.reload();
            }
        }
    });
}

function Listar_Diagnostico() {
    tablaDiagnostico = $('#tablaDiagnostico').dataTable({
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
                title: 'Reporte Diagnostico Paciente'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte Diagnostico Paciente'
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CDiagnostico.php?op=Listar_Diagnostico',
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
    tablaDiagnostico.on('order.dt search.dt', function () {
        tablaDiagnostico.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoDiagnostico() {

    $("#ModalDiagnostico").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalDiagnostico").modal("show");
    $("#tituloModalDiagnostico").empty();
    $("#tituloModalDiagnostico").append("Nuevo Registro de Diagnostico:");
}

function EditarDiagnostico(idDiagnostico) {
    $("#ModalDiagnostico").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalDiagnostico").modal("show");
    $("#tituloModalDiagnostico").empty();
    $("#tituloModalDiagnostico").append("Editar Registro Diagnostico:");
    RecuperarDiagnostico(idDiagnostico);
}

function RecuperarDiagnostico(idDiagnostico) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CDiagnostico.php?op=RecuperarInformacion_Diagnostico", {
        "idDiagnostico": idDiagnostico
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idDiagnostico").val(data.idDiagnostico);
        $("#DiagnosticoDescripcion").val(data.Descripcion);

    });
}

function EliminarDiagnostico(idDiagnostico) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Diagnostico!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnostico.php?op=Eliminar_Diagnostico", {
            idDiagnostico: idDiagnostico
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaDiagnostico.ajax.reload();
            }
        });
    });
}

function ActivacionDiagnostico(idDiagnostico) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar Diagnostico!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnostico.php?op=Activacion_Diagnostico", {
            idDiagnostico: idDiagnostico,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaDiagnostico.ajax.reload();
            }
        });
    });
}

function DesactivacionDiagnostico(idDiagnostico) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Diagnostico!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnostico.php?op=Activacion_Diagnostico", {
            idDiagnostico: idDiagnostico,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaDiagnostico.ajax.reload();
            }
        });
    });
}

function LimpiarDiagnostico() {
    $('#FormularioDiagnostico')[0].reset();
    $("#idDiagnostico").val("");
    $("#DiagnosticoPersona").removeAttr("disabled");
    $("#DiagnosticoPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarDiagnostico();
    $("#ModalDiagnostico").modal("hide");

}

init();
