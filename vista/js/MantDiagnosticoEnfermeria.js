var tablaDiagnosticoEnfermeria;

function init() {
    Iniciar_Componentes();
    Listar_DiagnosticoEnfermeria();
}

function Iniciar_Componentes() {
    $("#FormularioDiagnosticoEnfermeria").on("submit", function (e) {
        RegistroDiagnosticoEnfermeria(e);
    });

}

function RegistroDiagnosticoEnfermeria(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalDiagnosticoEnfermeria #cuerpo").addClass("whirl");
        $("#ModalDiagnosticoEnfermeria #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroDiagnosticoEnfermeria()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroDiagnosticoEnfermeria() {
    var formData = new FormData($("#FormularioDiagnosticoEnfermeria")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CDiagnosticoEnfermeria.php?op=AccionDiagnosticoEnfermeria",
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
                $("#ModalDiagnosticoEnfermeria #cuerpo").removeClass("whirl");
                $("#ModalDiagnosticoEnfermeria #cuerpo").removeClass("ringed");
                $("#ModalDiagnosticoEnfermeria").modal("hide");
                swal("Error:", Mensaje);
                LimpiarDiagnosticoEnfermeria();
                tablaDiagnosticoEnfermeria.ajax.reload();
            } else {
                $("#ModalDiagnosticoEnfermeria #cuerpo").removeClass("whirl");
                $("#ModalDiagnosticoEnfermeria #cuerpo").removeClass("ringed");
                $("#ModalDiagnosticoEnfermeria").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarDiagnosticoEnfermeria();
                tablaDiagnosticoEnfermeria.ajax.reload();
            }
        }
    });
}

function Listar_DiagnosticoEnfermeria() {
    tablaDiagnosticoEnfermeria = $('#tablaDiagnosticoEnfermeria').dataTable({
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
                title: 'Reporte Diagnostico Enfermeria'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte Diagnostico Enfermeria'
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CDiagnosticoEnfermeria.php?op=Listar_DiagnosticoEnfermeria',
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
    tablaDiagnosticoEnfermeria.on('order.dt search.dt', function () {
        tablaDiagnosticoEnfermeria.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoDiagnosticoEnfermeria() {

    $("#ModalDiagnosticoEnfermeria").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalDiagnosticoEnfermeria").modal("show");
    $("#tituloModalDiagnosticoEnfermeria").empty();
    $("#tituloModalDiagnosticoEnfermeria").append("Nuevo Registro de DiagnosticoEnfermeria:");
}

function EditarDiagnosticoEnfermeria(idDiagnosticoEnfermeria) {
    $("#ModalDiagnosticoEnfermeria").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalDiagnosticoEnfermeria").modal("show");
    $("#tituloModalDiagnosticoEnfermeria").empty();
    $("#tituloModalDiagnosticoEnfermeria").append("Editar Registro DiagnosticoEnfermeria:");
    RecuperarDiagnosticoEnfermeria(idDiagnosticoEnfermeria);
}

function RecuperarDiagnosticoEnfermeria(idDiagnosticoEnfermeria) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CDiagnosticoEnfermeria.php?op=RecuperarInformacion_DiagnosticoEnfermeria", {
        "idDiagnosticoEnfermeria": idDiagnosticoEnfermeria
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idDiagnosticoEnfermeria").val(data.idDiagnosticoEnfermeria);
        $("#DiagnosticoEnfermeriaDescripcion").val(data.Descripcion);

    });
}

function EliminarDiagnosticoEnfermeria(idDiagnosticoEnfermeria) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar DiagnosticoEnfermeria!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnosticoEnfermeria.php?op=Eliminar_DiagnosticoEnfermeria", {
            idDiagnosticoEnfermeria: idDiagnosticoEnfermeria
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaDiagnosticoEnfermeria.ajax.reload();
            }
        });
    });
}

function ActivacionDiagnosticoEnfermeria(idDiagnosticoEnfermeria) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar DiagnosticoEnfermeria!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnosticoEnfermeria.php?op=Activacion_DiagnosticoEnfermeria", {
            idDiagnosticoEnfermeria: idDiagnosticoEnfermeria,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaDiagnosticoEnfermeria.ajax.reload();
            }
        });
    });
}

function DesactivacionDiagnosticoEnfermeria(idDiagnosticoEnfermeria) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar DiagnosticoEnfermeria!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CDiagnosticoEnfermeria.php?op=Activacion_DiagnosticoEnfermeria", {
            idDiagnosticoEnfermeria: idDiagnosticoEnfermeria,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaDiagnosticoEnfermeria.ajax.reload();
            }
        });
    });
}

function LimpiarDiagnosticoEnfermeria() {
    $('#FormularioDiagnosticoEnfermeria')[0].reset();
    $("#idDiagnosticoEnfermeria").val("");
    $("#DiagnosticoEnfermeriaPersona").removeAttr("disabled");
    $("#DiagnosticoEnfermeriaPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarDiagnosticoEnfermeria();
    $("#ModalDiagnosticoEnfermeria").modal("hide");

}

init();
