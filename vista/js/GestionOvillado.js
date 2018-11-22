var tablaGestionOvillado;

function init(){

  Listar_Gestion();
  Listar_Trabajadores();

	$("#FormularioOvillado").on("submit", function (e) {
        RegistroOvillado(e);
    });

	$('#OvilloTrabajador').select2({
		theme: 'bootstrap'
		, language: 'es'
	});
}

function RegistroOvillado(event) {
    //cargar(true);
    event.preventDefault(); //No se activará la acción predeterminada del evento
    var error = "";

    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });

    if (error == "") {
        $("#ModalOvillado #cuerpo").addClass("whirl");
        $("#ModalOvillado #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroOvillado()', 2000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function Listar_Trabajadores() {
    $.post("../../controlador/Gestion/COvillado.php?op=listar_trabajadores", function (ts) {
        $("#OvilloTrabajador").append(ts);
    });
}

function AjaxRegistroOvillado() {
    var formData = new FormData($("#FormularioOvillado")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controlador/Gestion/COvillado.php?op=AccionOvillado",
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
                $("#ModalOvillado #cuerpo").removeClass("whirl");
                $("#ModalOvillado #cuerpo").removeClass("ringed");
                $("#ModalOvillado").modal("hide");
                swal("Error:", Mensaje);
                LimpiarOvillado();
                tablaGestionOvillado.ajax.reload();
            } else {
                $("#ModalOvillado #cuerpo").removeClass("whirl");
                $("#ModalOvillado #cuerpo").removeClass("ringed");
                $("#ModalOvillado").modal("hide");
                swal("Acción:", Mensaje);
                LimpiarOvillado();
                tablaGestionOvillado.ajax.reload();
            }
        }
    });
}
function LimpiarOvillado() {
    $('#FormularioOvillado')[0].reset();
    $("#idOvilladoGestion").val("");
     $("idMaterialOculto").val("");
	$('#OvilloTrabajador').val("0").trigger('change');
}
function NuevoOvillado() {
    $("#ModalOvillado").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalOvillado").modal("show");
    $("#tituloModalOvillado").empty();
    $("#tituloModalOvillado").append("Nuevo Orden de Trabajo de Ovillado:");
    RecuperarCorrelativo();
    RecuperarMaterial();
}
function RecuperarCorrelativo() {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Gestion/COvillado.php?op=RecuperarCorrelativo", function (data, status) {
        data = JSON.parse(data);
        console.log(data);
        $("#OvilladoNombre").val("OV - 000" + (parseInt(data.correlativo) + 1));
    });
}
function RecuperarMaterial() {
    //solicitud de recuperar Proveedor
	  var idOrden=$("#idOrden").val();
    $.post("../../controlador/Gestion/COvillado.php?op=RecuperarMaterialDato",{"idOrden":idOrden}, function (data, status) {
        data = JSON.parse(data);
        console.log(data);
			$("#idMaterialOculto").val(data.idMaterial);
			$("#OvilladoMaterial").val(data.Descripcion)

    });
}

function Listar_Gestion() {
     var idOrden=$("#idOrden").val();
    tablaGestionOvillado = $('#tablaGestionOvillado').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": false, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        dom: 'lBfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[0, "asc"]],
        "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info',
                title: "Sistema"
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: "Sistema"
            }
            , {
                extend: 'pdfHtml5',
                className: 'btn-info sombra3',
                title: "Sistema",
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
            , {
                extend: 'print',
                className: 'btn-info',
                title: "Sistema"
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/COvillado.php?op=Listar_GestionOvilladoLista',
            type: "POST",
            dataType: "JSON",
			   data:{idOrden:idOrden},
            error: function (e) {
                console.log(e.responseText);
            }
        },
        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaGestionOvillado.on('order.dt search.dt', function () {
        tablaGestionOvillado.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function Volver(){
	$.redirect('../operaciones/Ovillado.php');
}

function EditarOvillado(idGestionOvillo){

	 $("#ModalOvillado").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalOvillado").modal("show");
    $("#tituloModalOvillado").empty();
    $("#tituloModalOvillado").append("Editar Orden de Trabajo:");
    RecuperarOvillado(idGestionOvillo);
}

function RecuperarOvillado(idGestionOvillo) {
    //solicitud de recuperar Proveedor
    $.post("../../controlador/Gestion/COvillado.php?op=RecuperarInformacion_Ovillado", {
        "idOvilladoGestion": idGestionOvillo
    }, function (data, status) {
        data = JSON.parse(data);
        console.log(data);
		  $.post("../../controlador/Gestion/COvillado.php?op=listar_trabajadores", function (ts) {
			  $("#OvilloTrabajador").append(ts);
			   $("#idOvilladoGestion").val(data.idOvillado);
            $("#OvilladoNombre").val(data.CodigoTrabajo);
            $("#OvilladoMaterial").val(data.NombreMaterial);
            $("#OvilladoPeso").val(data.PesoOvillo);
            $("#OvilladoLote").val(data.LoteOvillo);
            $("#OvilladoCantidad").val(data.Cantidadovillos);
              $("#OvilladoObservacion").val(data.Observaciones);

 				$('#OvilloTrabajador').val(data.Persona_idPersona).trigger('change');
    		});


    });
}

function EliminarOvillado(idOvilladoGestion) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Orden de trabajo de Ovillado!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        ajaxEliminarOvillado(idOvilladoGestion);
    });
}

function ajaxEliminarOvillado(idOvilladoGestion) {
    $.post("../../controlador/Gestion/COvillado.php?op=Eliminar_Ovillado", {
        idOvilladoGestion: idOvilladoGestion
    }, function (data, e) {
        data = JSON.parse(data);
        var Eliminar = data.Eliminar;
        var Mensaje = data.Mensaje;
        if (!Eliminar) {
            swal("Error", Mensaje, "error");
        } else {
			  debugger;
            swal("Eliminado!", Mensaje, "success");
            tablaGestionOvillado.ajax.reload();
        }
    });
}


function Cancelar() {
    LimpiarOvillado();
    $("#ModalOvillado").modal("hide");

}
init();
