var tabla_medicos;
var tabla_asignaciones;
function init() {
    var idEspecialidad = $("#idEspecialidad").val();
    RecuperarInformacionEspecialidad(idEspecialidad);
    ListarAsignacionesRegistradas(idEspecialidad);

}

function RecuperarInformacionEspecialidad(idEspecialidad) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Mantenimiento/CAsignacionMedico.php?op=RecuperarInformacionEspecialidad", {
        "idEspecialidad": idEspecialidad
    }, function (data, status) {
        data = JSON.parse(data);
        $("#TituloEspecialidad").empty();
        $("#TituloEspecialidad").append(data.TituloEspecialidad);

    });
}

function ListarAsignacionesRegistradas(idEspecialidad){
     tabla_asignaciones = $('#tablaAsignaciones').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": false, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/CAsignacionMedico.php?op=ListarAsignaciones',
            type: "POST",
            dataType: "JSON",
            data:{idEspecialidad:idEspecialidad},
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3,4]
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
    tabla_asignaciones.on('order.dt search.dt', function () {
        tabla_asignaciones.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function ListarMedicosDisponibles(idEspecialidad) {
    if(tabla_medicos==null){
        tabla_medicos = $('#tablaAsignacionMedico').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": true, // Paginacion en tabla
		"ordering": false, // Ordenamiento en columna de tabla
		"info": false, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
	   "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Mantenimiento/CAsignacionMedico.php?op=listarMedicosDisponibles',
			type: "POST",
			dataType: "JSON",
            data:{idEspecialidad:idEspecialidad},
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"drawCallback": function(settings) { // Evento de repintado
		$('#tablaAsignacionMedico tr').each(function() {
			//Al pasar el mouse por la celda,aplica los cambios
			$(this).parent().on('mouseover', 'tr', function() {
				$(this).css('background-color', '#5d9cec');
				$(this).css('color', 'white');
				//Al dejar de pasar el mouse por la celda,aplica los cambios
			$(this).bind("mouseout", function() {
				$(this).css('background-color', '');
				$(this).css('color', '#656565');
				});
			});
		});
		},
		// cambiar el lenguaje de datatable
		oLanguage: español,
	}).DataTable();
	//Aplicar ordenamiento y autonumeracion , index
	tabla_medicos.on('order.dt search.dt', function () {
		tabla_medicos.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
    }else{
        tabla_medicos.destroy();
        tabla_medicos = $('#tablaAsignacionMedico').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": true, // Paginacion en tabla
		"ordering": false, // Ordenamiento en columna de tabla
		"info": false, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
	   "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Mantenimiento/CAsignacionMedico.php?op=listarMedicosDisponibles',
			type: "POST",
			dataType: "JSON",
            data:{idEspecialidad:idEspecialidad},
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"drawCallback": function(settings) { // Evento de repintado
		$('#tablaAsignacionMedico tr').each(function() {
			//Al pasar el mouse por la celda,aplica los cambios
			$(this).parent().on('mouseover', 'tr', function() {
				$(this).css('background-color', '#5d9cec');
				$(this).css('color', 'white');
				//Al dejar de pasar el mouse por la celda,aplica los cambios
			$(this).bind("mouseout", function() {
				$(this).css('background-color', '');
				$(this).css('color', '#656565');
				});
			});
		});
		},
		// cambiar el lenguaje de datatable
		oLanguage: español,
	}).DataTable();
	//Aplicar ordenamiento y autonumeracion , index
	tabla_medicos.on('order.dt search.dt', function () {
		tabla_medicos.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
    }
}
function NuevoAsignacionMedico(){
    $("#ModalAsignacionMedico").modal("show");
      var idEspecialidad = $("#idEspecialidad").val();
   ListarMedicosDisponibles(idEspecialidad);
}
function Asignar(idMedico){
    var idEspecialidad = $("#idEspecialidad").val();
     $.post("../../controlador/Mantenimiento/CAsignacionMedico.php?op=AsignarMedico", {
            idEspecialidad: idEspecialidad,
            idMedico: idMedico
        }, function (data, e) {
            data = JSON.parse(data);
            var Asignar = data.Asignar;
            var Mensaje = data.Mensaje;
            if (!Asignar) {
                swal("Error", Mensaje, "error");
                 $("#ModalAsignacionMedico").modal("hide");
            } else {
                swal("Asignado !", Mensaje, "success");
                 $("#ModalAsignacionMedico").modal("hide");
                 tabla_asignaciones.ajax.reload();
            }
        });
}

function EliminarAsignacion(idAsignacion) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar la Asignación!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/CAsignacionMedico.php?op=EliminarAsignacion", {
            idAsignacion: idAsignacion
        }, function (data, e) {
            data = JSON.parse(data);
            var Eliminar = data.Eliminar;
            var Mensaje = data.Mensaje;
            if (!Eliminar) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tabla_asignaciones.ajax.reload();
            }
        });
    });
}
function volver(){
    $.redirect('../../vista/Mantenimiento/MantEspecialidad.php');
}
init();
