var tablaOvillado;
var tablaGestionOvillado;
function init(){
	Listar_Enconado();

}
function Listar_Enconado() {

    tablaOvillado = $('#tablaOvillado').dataTable({
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
                "targets": [0,1, 2,4,7,8]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }, {
                "className": "text-right",
                "targets": [5,6]
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
            url: '../../controlador/Gestion/COvillado.php?op=Listar_Ovillado',
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
    tablaOvillado.on('order.dt search.dt', function () {
        tablaOvillado.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function OrdenesOvillado(idOrden){
	$.redirect('../operaciones/GestionOvillado.php', {
		'idOrden': idOrden
	});
}

function EnviarCalidad(idEnconado) {
    swal({
        title: "Enviar?",
        text: "Esta Seguro que desea Enviar la Orden al Area de  Calidad!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Enviar!",
        closeOnConfirm: false
    }, function () {
        ajaxEnviarCalidad(idEnconado);
    });
}

function ajaxEnviarCalidad(idEnconado) {
    $.post("../../controlador/Gestion/COvillado.php?op=Enviar_Calidad", {
        idEnconado: idEnconado
    }, function (data, e) {
        data = JSON.parse(data);
        var Enviar = data.Enviar;
        var Mensaje = data.Mensaje;
        if (!Enviar) {
            swal("Error", Mensaje, "error");
        } else {
            swal("Enviado!", Mensaje, "success");
            tablaOvillado.ajax.reload();
        }
    });
}
function OrdenesOvilladoLista(idOrden){
	$("#ModalTrabajos").modal("show");
	Listar_Gestion_lista(idOrden);
}

function Listar_Gestion_lista(idOrden) {
	if(tablaGestionOvillado==null){
		 tablaGestionOvillado = $('#tablaTrabajos').dataTable({
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
                "targets": [1, 2,3,4,5,6,7]
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
            url: '../../controlador/Gestion/COvillado.php?op=Listar_Gestion_trabajos',
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

		}else{
	 tablaGestionOvillado.destroy();

    tablaGestionOvillado = $('#tablaTrabajos').dataTable({
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
                "targets": [1, 2,3,4,5,6,7,8]
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
            url: '../../controlador/Gestion/COvillado.php?op=Listar_Gestion_trabajos',
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

}

function InformacionRechazo(idEnconado) {

    $("#ModalRechazo").modal("show");

    $.post("../../controlador/Gestion/COvillado.php?op=RecuperarRechazo", {
        "idEnconado": idEnconado
    }, function (data, status) {
        data = JSON.parse(data);
        console.log(data);

        $("#RechazoObservacion").val(data.Rechazo);
        $("#FechaRechazo").val(data.FechaRechazo);

    });
  }

init();
