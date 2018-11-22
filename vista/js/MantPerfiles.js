var tablaPerfil;
function init(){
   Iniciar_Componentes();
   Listar_Perfil();
	Listar_Estado();
}
function Iniciar_Componentes(){
   //var fecha=hoyFecha();

	//$('#date_fecha_comprobante').datepicker('setDate',fecha);

    $("#FormularioPerfil").on("submit",function(e)
	{
	      RegistroPerfil(e);
	});

}
function RegistroPerfil(event){
	  //cargar(true);
	event.preventDefault(); //No se activará la acción predeterminada del evento
    var error="";

    $(".validarPanel").each(function(){
			if($(this).val()==" " || $(this).val()==0){
				error=error+$(this).data("message")+"<br>";
			}
    });

    if(error==""){
		$("#ModalPerfil #cuerpo").addClass("whirl");
		$("#ModalPerfil #cuerpo").addClass("ringed");
		setTimeout('AjaxRegistroPerfil()', 2000);
	}else{
 		notificar_warning("Complete :<br>"+error);
	}
}
function AjaxRegistroPerfil(){
    var formData = new FormData($("#FormularioPerfil")[0]);
		console.log(formData);
		$.ajax({
			url: "../../controlador/Mantenimiento/CPerfil.php?op=AccionPerfil",
			 type: "POST",
			 data: formData,
			 contentType: false,
			 processData: false,
			 success: function(data, status)
			 {
					data = JSON.parse(data);
					console.log(data);
					var Mensaje=data.Mensaje;
				 	var Error=data.Registro;
					if(!Error){
						$("#ModalPerfil #cuerpo").removeClass("whirl");
						$("#ModalPerfil #cuerpo").removeClass("ringed");
						$("#ModalPerfil").modal("hide");
						swal("Error:", Mensaje);
						LimpiarPerfil();
						tablaPerfil.ajax.reload();
					}else{
						$("#ModalPerfil #cuerpo").removeClass("whirl");
						$("#ModalPerfil #cuerpo").removeClass("ringed");
						$("#ModalPerfil").modal("hide");
					   swal("Acción:", Mensaje);
						LimpiarPerfil();
						tablaPerfil.ajax.reload();
					}
			 }
		});
}
 function Listar_Estado(){
	 $.post("../../controlador/Mantenimiento/CPerfil.php?op=listar_estados", function (ts) {
      $("#PerfilEstado").append(ts);
   });
}
function Listar_Perfil(){

	tablaPerfil = $('#tablaPerfil').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": true, // Paginacion en tabla
		"ordering": false, // Ordenamiento en columna de tabla
		"info": false, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
	   "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Mantenimiento/CPerfil.php?op=Listar_Perfil',
			type: "POST",
			dataType: "JSON",
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true
        , "columnDefs": [
            {
               "className": "text-center"
               , "targets": [1,2]
            }
            , {
               "className": "text-left"
               , "targets": [0]
            }
         , ]
         , buttons: [
            {
               extend: 'copy'
               , className: 'btn-info'
            }
            , {
               extend: 'csv'
               , className: 'btn-info'
            }
            , {
               extend: 'excel'
               , className: 'btn-info'
               , title: 'Facturacion'
            }
            , {
               extend: 'pdf'
               , className: 'btn-info'
               , title: $('title').text()
            }
            , {
               extend: 'print'
               , className: 'btn-info'
            }
            ],
		// cambiar el lenguaje de datatable
		oLanguage: español,
	}).DataTable();
	//Aplicar ordenamiento y autonumeracion , index
	tablaPerfil.on('order.dt search.dt', function () {
		tablaPerfil.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
}
function NuevoPerfil(){
    $("#ModalPerfil").modal({
      backdrop: 'static'
      , keyboard: false
    });
    $("#ModalPerfil").modal("show");
    $("#tituloModalPerfil").empty();
    $("#tituloModalPerfil").append("Nuevo Perfil:");
}
function EditarPerfil(idPerfil){
    $("#ModalPerfil").modal({
      backdrop: 'static'
      , keyboard: false
    });
    $("#ModalPerfil").modal("show");
    $("#tituloModalPerfil").empty();
    $("#tituloModalPerfil").append("Editar Perfil:");
	RecuperarPerfil(idPerfil);
}
function RecuperarPerfil(idPerfil){
	//solicitud de recuperar Proveedor
	$.post("../../controlador/Mantenimiento/CPerfil.php?op=RecuperarInformacion_Perfil",{"idPerfil":idPerfil}, function(data, status){
		data = JSON.parse(data);
		console.log(data);

	$("#idPerfil").val(data.idPerfil);
	$("#PerfilNombre").val(data.nombrePerfil);
	$("#PerfilDescripcion").val(data.descripcionPerfil);
	$("#PerfilEstado").val(data.Estado_idEstado);

	});
}
function EliminarPerfil(idPerfil){
      swal({
      title: "Eliminar?",
      text: "Esta Seguro que desea Eliminar Perfil!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Eliminar!",
      closeOnConfirm: false
   }, function () {
      ajaxEliminarPerfil(idPerfil);
   });
}
function ajaxEliminarPerfil(idPerfil){
    $.post("../../controlador/Mantenimiento/CPerfil.php?op=Eliminar_Perfil", {idPerfil: idPerfil}, function (data, e) {
      data = JSON.parse(data);
      var Error = data.Error;
      var Mensaje = data.Mensaje;
      if (Error) {
         swal("Error", Mensaje, "error");
      } else {
         swal("Eliminado!", Mensaje, "success");
         tablaPerfil.ajax.reload();
      }
   });
}
function HabilitarPerfil(idPerfil){
      swal({
      title: "Habilitar?",
      text: "Esta Seguro que desea Habilitar Perfil!",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Habilitar!",
      closeOnConfirm: false
   }, function () {
      ajaxHabilitarPerfil(idPerfil);
   });
}
function ajaxHabilitarPerfil(idPerfil){
       $.post("../../controlador/Mantenimiento/CPerfil.php?op=Recuperar_Perfil", {idPerfil: idPerfil}, function (data, e) {
      data = JSON.parse(data);
      var Error = data.Error;
      var Mensaje = data.Mensaje;
      if (Error) {
         swal("Error", Mensaje, "error");
      } else {
         swal("Eliminado!", Mensaje, "success");
         tablaPerfil.ajax.reload();
      }
   });
}
function LimpiarPerfil(){
   $('#FormularioPerfil')[0].reset();
	$("#idPerfil").val("");

}
function Cancelar(){
    LimpiarPerfil();
    $("#ModalPerfil").modal("hide");

}
function PermisosPerfil(idPerfil){
     $.redirect('PermisosPerfil.php', {'idPerfil':idPerfil});
}
init();
