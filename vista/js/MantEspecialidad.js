var tablaEspecialidad;

function init() {
    Iniciar_Componentes();
    Listar_Especialidad();
}

function Iniciar_Componentes() {
    $("#FormularioEspecialidad").on("submit", function (e) {
        RegistroEspecialidad(e);
    });

}

function RegistroEspecialidad(event) {
    event.preventDefault();
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalEspecialidad #cuerpo").addClass("whirl");
        $("#ModalEspecialidad #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroEspecialidad()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroEspecialidad() {
    var formData = new FormData($("#FormularioEspecialidad")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CEspecialidad.php?op=AccionEspecialidad",
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
                $("#ModalEspecialidad #cuerpo").removeClass("whirl");
                $("#ModalEspecialidad #cuerpo").removeClass("ringed");
                $("#ModalEspecialidad").modal("hide");
                swal("Error:", Mensaje);
                LimpiarEspecialidad();
                tablaEspecialidad.ajax.reload();
            } else {
                $("#ModalEspecialidad #cuerpo").removeClass("whirl");
                $("#ModalEspecialidad #cuerpo").removeClass("ringed");
                $("#ModalEspecialidad").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarEspecialidad();
                tablaEspecialidad.ajax.reload();
            }
        }
    });
}

function Listar_Especialidad() {
    tablaEspecialidad = $('#tablaEspecialidad').dataTable({
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
                "targets": [1, 2, 3, 4,5]
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
                title: 'Reporte de Especialidades'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte de Especialidades'
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CEspecialidad.php?op=Listar_Especialidad',
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
    tablaEspecialidad.on('order.dt search.dt', function () {
        tablaEspecialidad.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoEspecialidad() {

    $("#ModalEspecialidad").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalEspecialidad").modal("show");
    $("#tituloModalEspecialidad").empty();
    $("#tituloModalEspecialidad").append("Nuevo Registro de Especialidad:");
}

function EditarEspecialidad(idEspecialidad) {
    $("#ModalEspecialidad").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalEspecialidad").modal("show");
    $("#tituloModalEspecialidad").empty();
    $("#tituloModalEspecialidad").append("Editar Registro Especialidad:");
    RecuperarEspecialidad(idEspecialidad);
}

function RecuperarEspecialidad(idEspecialidad) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CEspecialidad.php?op=RecuperarInformacion_Especialidad", {
        "idEspecialidad": idEspecialidad
    }, function (data, status) {
        data = JSON.parse(data);

        $("#idEspecialidad").val(data.idEspecialidad);
        $("#EspecialidadDescripcion").val(data.Descripcion);

    });
}

function EliminarEspecialidad(idEspecialidad) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Especialidad!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CEspecialidad.php?op=Eliminar_Especialidad", {
            idEspecialidad: idEspecialidad
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaEspecialidad.ajax.reload();
            }
        });
    });
}

function ActivacionEspecialidad(idEspecialidad) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar Especialidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CEspecialidad.php?op=Activacion_Especialidad", {
            idEspecialidad: idEspecialidad,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaEspecialidad.ajax.reload();
            }
        });
    });
}

function DesactivacionEspecialidad(idEspecialidad) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Especialidad!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CEspecialidad.php?op=Activacion_Especialidad", {
            idEspecialidad: idEspecialidad,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaEspecialidad.ajax.reload();
            }
        });
    });
}

function LimpiarEspecialidad() {
    $('#FormularioEspecialidad')[0].reset();
    $("#idEspecialidad").val("");
    $("#EspecialidadPersona").removeAttr("disabled");
    $("#EspecialidadPassword").addClass("validarPanel");
}

function Cancelar() {
    LimpiarEspecialidad();
    $("#ModalEspecialidad").modal("hide");

}

function AsignacionMedico(idEspecialidad){
     $.redirect('../../vista/Mantenimiento/MantAsignacionMedico.php', {'idEspecialidad':idEspecialidad});
}
init();
