var tablaMedico;

function init() {
    Iniciar_Componentes();
    Listar_Sexo();
    Listar_Medico();

}

function Iniciar_Componentes() {
    $("#FormularioMedico").on("submit", function (e) {
        RegistroMedico(e);
    });
    $('#dateFechaNacimiento').datepicker({
        format: 'yyyy/mm/dd',
        language: 'es'
    });
    SetFechaFin();
    VerificacionFechaNacimiento();

}


function SetFechaFin() {
    var hoy = hoyFecha();
    var day = parseInt(hoy.substr(0, 2));
    var month = parseInt(hoy.substr(3, 2));
    var year = parseInt(hoy.substr(6, 8));
    $('#dateFechaNacimiento').datepicker('setEndDate', new Date(year, (month - 1), day));
}

function VerificacionFechaNacimiento() {

    $("#MedicoFechaNacimiento").change(function () {

        var fecha = $("#MedicoFechaNacimiento").val();
        var edad = calcularEdad(fecha);
        $("#Edad").val(edad);
    });

}

function RegistroMedico(event) {
    //cargar(true);
    event.preventDefault(); //No se activará la acción predeterminada del evento
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == "" || $(this).val() == 0 || $(this).val() == "0") {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalMedico #cuerpo").addClass("whirl");
        $("#ModalMedico #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroMedico()', 2000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroMedico() {
    var formData = new FormData($("#FormularioMedico")[0]);
    var MedicoEdad = $("#Edad").val();
    formData.append("MedicoEdad", MedicoEdad);

    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CMedico.php?op=AccionMedico",
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
                $("#ModalMedico #cuerpo").removeClass("whirl");
                $("#ModalMedico #cuerpo").removeClass("ringed");
                $("#ModalMedico").modal("hide");
                swal("Error:", Mensaje);
                LimpiarMedico();
                tablaMedico.ajax.reload();
            } else {
                $("#ModalMedico #cuerpo").removeClass("whirl");
                $("#ModalMedico #cuerpo").removeClass("ringed");
                $("#ModalMedico").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarMedico();
                tablaMedico.ajax.reload();
            }
        }
    });
}


function Listar_Sexo() {
    $.post("../../controlador/Mantenimiento/CMedico.php?op=listar_sexo", function (ts) {
        $("#MedicoSexo").empty();
        $("#MedicoSexo").append(ts);
    });
}


function Listar_Medico() {
    tablaMedico = $('#tablaMedico').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": false, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CMedico.php?op=Listar_Medico',
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
                "targets": [1, 2, 3, 4, 5]
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
    tablaMedico.on('order.dt search.dt', function () {
        tablaMedico.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function NuevoMedico() {
    $("#ModalMedico").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalMedico").modal("show");
    $("#tituloModalMedico").empty();
    $("#tituloModalMedico").append("Nuevo Medico:");

}

function EditarMedico(idMedico, idPersona) {
    $("#ModalMedico").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalMedico").modal("show");
    $("#tituloModalMedico").empty();
    $("#tituloModalMedico").append("Editar Medico:");
    RecuperarMedico(idMedico, idPersona);
}

function RecuperarMedico(idMedico) {
    //solicitud de recuperar Proveedor

    $("#idMedico").val(idMedico);
    $.post("../../controlador/Mantenimiento/CMedico.php?op=RecuperarInformacion_Medico", {
        "idMedico": idMedico,
    }, function (data, status) {
        data = JSON.parse(data);
        console.log(data);

        $.post("../../controlador/Mantenimiento/CMedico.php?op=listar_sexo", function (ts) {
            $("#MedicoSexo").empty();
            $("#MedicoSexo").append(ts);
            $("#MedicoSexo").val(data.Sexo_idSexo);

            $("#codigoMostrar").empty();
            $("#codigoMostrar").append(data.Codigo);

            $("#MedicoNombre").val(data.nombres);
            $("#MedicoApellidoP").val(data.apellidoPaterno);
            $("#MedicoApellidoM").val(data.apellidoMaterno);
            $("#Edad").val(data.edad);
            $("#MedicoDNI").val(data.dni);
            $("#MedicoTelefono").val(data.Telefono);
            $("#MedicoCelular").val(data.Celular);
            $("#MedicoCorreo").val(data.Correo);

            $('#MedicoFechaNacimiento').datepicker('setDate', data.fechaNacimiento);

        });

    });
}


function EliminarMedico(idMedico) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Medico!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CMedico.php?op=Eliminar_Medico", {
            idMedico: idMedico
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaMedico.ajax.reload();
            }
        });
    });
}

function ActivacionMedico(idMedico) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar Medico!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CMedico.php?op=Activacion_Medico", {
            idMedico: idMedico,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaMedico.ajax.reload();
            }
        });
    });
}

function DesactivacionMedico(idMedico) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Medico!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CMedico.php?op=Activacion_Medico", {
            idMedico: idMedico,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaMedico.ajax.reload();
            }
        });
    });
}



function LimpiarMedico() {
    $('#FormularioMedico')[0].reset();
    $("#idMedico").val("");

}

function Cancelar() {
    LimpiarMedico();
    $("#ModalMedico").modal("hide");

}

function calcularEdad(fecha) {

    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    return edad;
}
init();