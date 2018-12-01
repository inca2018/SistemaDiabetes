var tablaPaciente;

function init() {
	Iniciar_Componentes();
	Listar_Estado();
	Listar_Sexo();
	Listar_Condicion();
	Listar_Medicos();
	Listar_Paciente();
	Listar_dx();
    Listar_Procedencia();
}

function Iniciar_Componentes() {
	//var fecha=hoyFecha();

	//$('#date_fecha_comprobante').datepicker('setDate',fecha);

	$("#FormularioPaciente").on("submit", function (e) {
		RegistroPaciente(e);
	});
	$('#dateFechaNacimiento').datepicker({
		format: 'dd/mm/yyyy',
		language: 'es'
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

function Listar_Procedencia(){
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
				"targets": [1, 2, 3, 4, 5, 6]
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

function RecuperarPaciente(idPaciente, idPersona) {
	//solicitud de recuperar Proveedor
	debugger;
	$("#idPaciente").val(idPaciente);
	$("#idPersona").val(idPersona);
	$.post("../../controlador/Mantenimiento/CPaciente.php?op=RecuperarInformacion_Paciente", {
		"idPaciente": idPaciente,
		idPersona: idPersona
	}, function (data, status) {
		data = JSON.parse(data);
		console.log(data);
		$.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_estados", function (ts) {
            $("#PacienteEstado").empty();
			$("#PacienteEstado").append(ts);
			$.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_sexo", function (ts) {
                $("#PacienteSexo").empty();
				$("#PacienteSexo").append(ts);
				$.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_condicion", function (ts) {
                    $("#PacienteCondicion").empty();
					$("#PacienteCondicion").append(ts);
					$.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_medicos", function (ts) {
                        $("#PacienteMedico").empty();
						$("#PacienteMedico").append(ts);
						$.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_dx", function (ts) {
                            $("#PacienteDX").empty();
							$("#PacienteDX").append(ts);
                             $.post("../../controlador/Mantenimiento/CPaciente.php?op=listar_procedencia", function (ts) {
                                $("#PacienteProcedencia").empty();
                                $("#PacienteProcedencia").append(ts);

                                 $("#PacienteCodigo").val(data.Codigo);
                                $("#PacienteNombre").val(data.nombrePersona);
                                $("#PacienteApellidoP").val(data.apellidoPaterno);
                                $("#PacienteApellidoM").val(data.apellidoMaterno);
                                $("#PacienteFechaNacimiento").val(data.fechaNacimiento);
                                $("#PacienteDNI").val(data.DNI);
                                $("#PacienteTelefono").val(data.telefono);
                                $("#PacienteDireccion").val(data.direccion);
                                $("#PacienteCorreo").val(data.correo);
                                $("#PacienteEnfermedad").val(data.TipoEnfermedad);
                                $("#PacienteDX").val(data.dx);
                                $("#PacienteMedico").val(data.Medico_idMedico);
                                $("#PacienteProcedencia").val(data.Procedencia);
                                $("#PacienteCondicion").val(data.Condicion_idCondicion);
                                $("#PacienteSexo").val(data.Sexo_idSexo);
                                $("#PacienteEstado").val(data.Estado_idEstado);
                            });

						});


					});
				});
			});
		});
	});
}

function EliminarPaciente(idPaciente, idPersona) {
	swal({
		title: "Eliminar?",
		text: "Esta Seguro que desea Eliminar Paciente!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si, Eliminar!",
		closeOnConfirm: false
	}, function () {
		ajaxEliminarPaciente(idPaciente, idPersona);
	});
}

function ajaxEliminarPaciente(idPaciente, idPersona) {
	$.post("../../controlador/Mantenimiento/CPaciente.php?op=Eliminar_Paciente", {
		idPaciente: idPaciente,
		idPersona: idPersona
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
}

function HabilitarPaciente(idPaciente, idPersona) {
	swal({
		title: "Habilitar?",
		text: "Esta Seguro que desea Habilitar Paciente!",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si, Habilitar!",
		closeOnConfirm: false
	}, function () {
		ajaxHabilitarPaciente(idPaciente, idPersona);
	});
}

function ajaxHabilitarPaciente(idPaciente, idPersona) {
	$.post("../../controlador/Mantenimiento/CPaciente.php?op=Recuperar_Paciente", {
		idPaciente: idPaciente,
		idPersona: idPersona
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
}

function LimpiarPaciente() {
	$('#FormularioPaciente')[0].reset();
	$("#idPaciente").val("");

}

function Cancelar() {
	LimpiarPaciente();
	$("#ModalPaciente").modal("hide");

}

init();
