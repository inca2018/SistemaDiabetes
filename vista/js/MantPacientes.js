var tablaPaciente;

function init() {
    Iniciar_Componentes();
    Listar_TipoDocumento();
    Listar_Sexo();
    Listar_Condicion();
    Listar_Medicos();
    Listar_Paciente();
    Listar_dx();
    Listar_Procedencia();
    Listar_Departamento();
    Listar_Provincia(0);
    Listar_Distrito(0);
    Listar_TipoMedida();
    Listar_GradoInstruccion();

}

function Iniciar_Componentes() {
    $("#FormularioPaciente").on("submit", function (e) {
        RegistroPaciente(e);
    });
    $('#dateFechaNacimiento').datepicker({
        format: 'yyyy/mm/dd',
        language: 'es'
    });
    SetFechaFin();
    VerificacionFechaNacimiento();
    CambioTipoDocumento();
}

function Listar_GradoInstruccion() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_Grado", function (ts) {
        $("#PacienteGrado").empty();
        $("#PacienteGrado").append(ts);
    });
}

function Listar_Departamento() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_Departamentos", function (ts) {
        $("#PacienteDepartamento").empty();
        $("#PacienteDepartamento").append(ts);
    });

    $("#PacienteDepartamento").change(function () {
        var departamento = $("#PacienteDepartamento").val();
        Listar_Provincia(departamento);
        Listar_Distrito(0);
    });

}

function Listar_Provincia(idDepartamento) {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_Provincias", {
        idDepartamento: idDepartamento
    }, function (ts) {
        $("#PacienteProvincia").empty();
        $("#PacienteProvincia").append(ts);
    });
    $("#PacienteProvincia").change(function () {
        var provincia = $("#PacienteProvincia").val();
        Listar_Distrito(provincia);
    });
}

function Listar_Distrito(idProvincia) {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_Distritos", {
        idProvincia: idProvincia
    }, function (ts) {
        $("#PacienteDistrito").empty();
        $("#PacienteDistrito").append(ts);
    });
}

function CambioTipoDocumento() {
    $("#PacienteNumeroDocumento").attr("disabled", true);
    $("#PacienteTipoDocumento").change(function () {
        var tipo = $("#PacienteTipoDocumento").val();
        (tipo == 0) ? $("#PacienteNumeroDocumento").attr("disabled", true): $("#PacienteNumeroDocumento").removeAttr("disabled");
    });

    $("#PacienteMedida").attr("disabled", true);

    $("#PacienteTiempoEnfermedad").blur(function () {
        var tiempo = $("#PacienteTiempoEnfermedad").val();
        (tiempo == 0) ? $("#PacienteMedida").attr("disabled", true): $("#PacienteMedida").removeAttr("disabled");;
    });
}

function SetFechaFin() {
    var hoy = hoyFecha();
    var day = parseInt(hoy.substr(0, 2));
    var month = parseInt(hoy.substr(3, 2));
    var year = parseInt(hoy.substr(6, 8));
    $('#dateFechaNacimiento').datepicker('setEndDate', new Date(year, (month - 1), day));
}

function VerificacionFechaNacimiento() {

    $("#PacienteFechaNacimiento").change(function () {

        var fecha = $("#PacienteFechaNacimiento").val();
        var edad = calcularEdad(fecha);
        $("#Edad").val(edad);
    });

}

function RegistroPaciente(event) {
    //cargar(true);
    event.preventDefault(); //No se activará la acción predeterminada del evento
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == "" || $(this).val() == 0 || $(this).val() == "0") {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalPaciente #cuerpo").addClass("whirl");
        $("#ModalPaciente #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroPaciente()', 2000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroPaciente() {
    var formData = new FormData($("#FormularioPaciente")[0]);
    var PacienteEdad = $("#Edad").val();
    var numDocumento = $("#PacienteNumeroDocumento").val();
    formData.append("PacienteEdad", PacienteEdad);
    formData.append("PacienteNumeroDocumento", numDocumento);

    console.log(formData);
    $.ajax({
        url: "../../controlador/Mantenimiento/CPaciente.php?op=AccionPaciente",
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
                $("#ModalPaciente #cuerpo").removeClass("whirl");
                $("#ModalPaciente #cuerpo").removeClass("ringed");
                $("#ModalPaciente").modal("hide");
                swal("Error:", Mensaje);
                LimpiarPaciente();
                tablaPaciente.ajax.reload();
            } else {
                $("#ModalPaciente #cuerpo").removeClass("whirl");
                $("#ModalPaciente #cuerpo").removeClass("ringed");
                $("#ModalPaciente").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarPaciente();
                tablaPaciente.ajax.reload();
            }
        }
    });
}

function Listar_Estado() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_estados", function (ts) {
        $("#PacienteEstado").empty();
        $("#PacienteEstado").append(ts);
    });
}

function Listar_TipoMedida() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_tipoMedida", function (ts) {
        $("#PacienteTipoMedida").empty();
        $("#PacienteTipoMedida").append(ts);
    });
}

function Listar_TipoDocumento() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_tipoDocumento", function (ts) {
        $("#PacienteTipoDocumento").empty();
        $("#PacienteTipoDocumento").append(ts);
    });
}

function Listar_Sexo() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_sexo", function (ts) {
        $("#PacienteSexo").empty();
        $("#PacienteSexo").append(ts);
    });
}

function Listar_Condicion() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_condicion", function (ts) {
        $("#PacienteCondicion").empty();
        $("#PacienteCondicion").append(ts);
    });
}

function Listar_Medicos() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_medicos", function (ts) {
        $("#PacienteMedico").empty();
        $("#PacienteMedico").append(ts);
    });
}

function Listar_dx() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_dx", function (ts) {
        $("#PacienteDX").empty();
        $("#PacienteDX").append(ts);
    });
}

function Listar_Procedencia() {
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_procedencia", function (ts) {
        $("#PacienteProcedencia").empty();
        $("#PacienteProcedencia").append(ts);
    });
}

function Listar_Paciente() {
    tablaPaciente = $('#tablaPaciente').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": false, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CPaciente.php?op=Listar_Paciente',
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
    tablaPaciente.on('order.dt search.dt', function () {
        tablaPaciente.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function RecuperarCorrelativo() {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=RecuperarCorrelativo", function (data, status) {
        data = JSON.parse(data);
        console.log(data);
        $("#codigoMostrar").empty();
        $("#codigoMostrar").append("Nº 000" + (parseInt(data.correlativo) + 1));
        $("#PacienteCodigo").val("Nº 000" + (parseInt(data.correlativo) + 1));
    });
}

function NuevoPaciente() {
    $("#ModalPaciente").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalPaciente").modal("show");
    $("#tituloModalPaciente").empty();
    $("#tituloModalPaciente").append("Nuevo Paciente:");
    RecuperarCorrelativo();
}

function EditarPaciente(idPaciente, idPersona) {
    $("#ModalPaciente").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalPaciente").modal("show");
    $("#tituloModalPaciente").empty();
    $("#tituloModalPaciente").append("Editar Paciente:");
    RecuperarPaciente(idPaciente, idPersona);
}

function RecuperarPaciente(idPaciente) {
    //solicitud de recuperar Proveedor

    $("#idPaciente").val(idPaciente);
    $.post("../../controlador/Mantenimiento/CPaciente.php?op=RecuperarInformacion_Paciente", {
        "idPaciente": idPaciente,
    }, function (data, status) {
        data = JSON.parse(data);
        console.log(data);
        $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_tipoDocumento", function (ts) {
            $("#PacienteTipoDocumento").empty();
            $("#PacienteTipoDocumento").append(ts);
            (data.TipoDocumento_idTipoDocumento == null) ? $("#PacienteTipoDocumento").val(0): $("#PacienteTipoDocumento").val(data.TipoDocumento_idTipoDocumento);

            $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_sexo", function (ts) {
                $("#PacienteSexo").empty();
                $("#PacienteSexo").append(ts);
                (data.Sexo_idSexo == null) ? $("#PacienteSexo").val(0): $("#PacienteSexo").val(data.Sexo_idSexo);

                $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_dx", function (ts) {
                    $("#PacienteDX").empty();
                    $("#PacienteDX").append(ts);
                    (data.DX_idDX == null) ? $("#PacienteDX").val(0): $("#PacienteDX").val(data.DX_idDX);

                    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_medicos", function (ts) {
                        $("#PacienteMedico").empty();
                        $("#PacienteMedico").append(ts);
                        (data.Medico_idMedico == null) ? $("#PacienteMedico").val(0): $("#PacienteMedico").val(data.Medico_idMedico);

                        $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_Departamentos", function (ts) {
                            $("#PacienteDepartamento").empty();
                            $("#PacienteDepartamento").append(ts);
                            (data.Departamento_idDepartamento == null) ? $("#PacienteDepartamento").val(0): $("#PacienteDepartamento").val(data.Departamento_idDepartamento);

                            $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_Provincias", {
                                idDepartamento: data.Departamento_idDepartamento
                            }, function (ts) {
                                $("#PacienteProvincia").empty();
                                $("#PacienteProvincia").append(ts);
                                (data.Provincia_idProvincia == null) ? $("#PacienteProvincia").val(0): $("#PacienteProvincia").val(data.Provincia_idProvincia);

                                $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_Distritos", {
                                    idProvincia: data.Provincia_idProvincia
                                }, function (ts) {
                                    $("#PacienteDistrito").empty();
                                    $("#PacienteDistrito").append(ts);
                                    (data.Distrito_idDistrito == null) ? $("#PacienteDistrito").val(0): $("#PacienteDistrito").val(data.Distrito_idDistrito);

                                    $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_condicion", function (ts) {
                                        $("#PacienteCondicion").empty();
                                        $("#PacienteCondicion").append(ts);
                                        (data.Condicion_idCondicion == null) ? $("#PacienteCondicion").val(0): $("#PacienteCondicion").val(data.Condicion_idCondicion);


                                        $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_tipoMedida", function (ts) {
                                            $("#PacienteTipoMedida").empty();
                                            $("#PacienteTipoMedida").append(ts);
                                            (data.TipoMedida_idTipoMedida == null) ? $("#PacienteTipoMedida").val(0): $("#PacienteTipoMedida").val(data.TipoMedida_idTipoMedida);

                                            $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_Grado", function (ts) {
                                                $("#PacienteGrado").empty();
                                                $("#PacienteGrado").append(ts);
                                                (data.GradoInstruccion_idGradoInstruccion == null) ? $("#PacienteGrado").val(0): $("#PacienteGrado").val(data.GradoInstruccion_idGradoInstruccion);
                                                $("#PacienteTitulo").val(data.tituloGrado);


                                                $("#codigoMostrar").empty();
                                                $("#codigoMostrar").append(data.Codigo);
                                                $("#PacienteCodigo").val(data.Codigo);
                                                $("#PacienteNombre").val(data.Nombres);
                                                $("#PacienteApellidoP").val(data.apellidoPaterno);
                                                $("#PacienteApellidoM").val(data.apellidoMaterno);
                                                $("#Edad").val(data.edad);
                                                $("#PacienteNumeroDocumento").val(data.numeroDocumento);
                                                $("#PacienteTelefono").val(data.Telefono);
                                                $("#PacienteCelular").val(data.Celular);
                                                $("#PacienteCorreo").val(data.Correo);
                                                $("#PacienteDireccion").val(data.Direccion);
                                                $("#PacienteCantidadMedida").val(data.CantidadTiempo);

                                                var year = data.fechaNacimiento.substring(0, 4);
                                                var mothn = data.fechaNacimiento.substring(5, 7);
                                                var day = data.fechaNacimiento.substring(8, 10);

                                                $('#dateFechaNacimiento').datepicker("setDate", new Date(year, mothn - 1, day));
                                                //$('#PacienteFechaNacimiento').datepicker('setDate', data.fechaNacimiento);

                                            });

                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
        });
    });
}


function EliminarPaciente(idPaciente) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Paciente!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CPaciente.php?op=Eliminar_Paciente", {
            idPaciente: idPaciente
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaPaciente.ajax.reload();
            }
        });
    });
}

function ActivacionPaciente(idPaciente) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar Paciente!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CPaciente.php?op=Activacion_Paciente", {
            idPaciente: idPaciente,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaPaciente.ajax.reload();
            }
        });
    });
}

function DesactivacionPaciente(idPaciente) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Paciente!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CPaciente.php?op=Activacion_Paciente", {
            idPaciente: idPaciente,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaPaciente.ajax.reload();
            }
        });
    });
}



function LimpiarPaciente() {
    $('#FormularioPaciente')[0].reset();
    $("#idPaciente").val("");

}

function Cancelar() {
    LimpiarPaciente();
    $("#ModalPaciente").modal("hide");

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
