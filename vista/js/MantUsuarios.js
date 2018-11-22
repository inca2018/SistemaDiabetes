var tablaUsuario;
function init(){
    Iniciar_Componentes();
    Listar_Estado();

    Listar_Perfiles();
    Listar_Usuario();
}
function Iniciar_Componentes(){
   //var fecha=hoyFecha();

	//$('#date_fecha_comprobante').datepicker('setDate',fecha);

    $("#FormularioUsuario").on("submit",function(e)
	{
	      RegistroUsuario(e);
	});

}
function RegistroUsuario(event){
	  //cargar(true);
	event.preventDefault(); //No se activará la acción predeterminada del evento
    var error="";

    $(".validarPanel").each(function(){
			if($(this).val()==" " || $(this).val()==0){
				error=error+$(this).data("message")+"<br>";
			}
    });

    if(error==""){
		$("#ModalUsuario #cuerpo").addClass("whirl");
		$("#ModalUsuario #cuerpo").addClass("ringed");
		setTimeout('AjaxRegistroUsuario()', 2000);
	}else{
 		notificar_warning("Complete :<br>"+error);
	}
}
function AjaxRegistroUsuario(){
    var formData = new FormData($("#FormularioUsuario")[0]);
		console.log(formData);
		$.ajax({
			url: "../../controlador/Mantenimiento/CUsuario.php?op=AccionUsuario",
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
						$("#ModalUsuario #cuerpo").removeClass("whirl");
						$("#ModalUsuario #cuerpo").removeClass("ringed");
						$("#ModalUsuario").modal("hide");
						swal("Error:", Mensaje);
						LimpiarUsuario();
						tablaUsuario.ajax.reload();
					}else{
						$("#ModalUsuario #cuerpo").removeClass("whirl");
						$("#ModalUsuario #cuerpo").removeClass("ringed");
						$("#ModalUsuario").modal("hide");
					   swal("Acción:", Mensaje);
						LimpiarUsuario();
						tablaUsuario.ajax.reload();
					}
			 }
		});
}
function Listar_Estado(){
	 $.post("../../controlador/Mantenimiento/CUsuario.php?op=listar_estados", function (ts) {
      $("#UsuarioEstado").append(ts);
   });
}
function Listar_Personas(){
	 $.post("../../controlador/Mantenimiento/CUsuario.php?op=listar_personas_sin_usuario", function (ts) {
       $("#UsuarioPersona").empty();
		 $("#UsuarioPersona").append(ts);
   });
}

function Listar_Perfiles(){
	 $.post("../../controlador/Mantenimiento/CUsuario.php?op=listar_perfiles", function (ts) {
      $("#UsuarioPerfil").append(ts);
   });
}
function Listar_Usuario(){
	tablaUsuario = $('#tablaUsuario').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": true, // Paginacion en tabla
		"ordering": false, // Ordenamiento en columna de tabla
		"info": false, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
	   "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Mantenimiento/CUsuario.php?op=Listar_Usuario',
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
               , "targets": [1,2,3,4,5,6]
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
	tablaUsuario.on('order.dt search.dt', function () {
		tablaUsuario.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
}
function NuevoUsuario(){
	 Listar_Personas();
    $("#ModalUsuario").modal({
      backdrop: 'static'
      , keyboard: false
    });
    $("#ModalUsuario").modal("show");
    $("#tituloModalUsuario").empty();
    $("#tituloModalUsuario").append("Nuevo Usuario:");
}
function EditarUsuario(idUsuario){
    $("#ModalUsuario").modal({
      backdrop: 'static'
      , keyboard: false
    });
    $("#ModalUsuario").modal("show");
    $("#tituloModalUsuario").empty();
    $("#tituloModalUsuario").append("Editar Usuario:");
	RecuperarUsuario(idUsuario);
}
function RecuperarUsuario(idUsuario){
	//solicitud de recuperar Proveedor
	$.post("../../controlador/Mantenimiento/CUsuario.php?op=RecuperarInformacion_Usuario",{"idUsuario":idUsuario}, function(data, status){
		data = JSON.parse(data);
		$.post("../../controlador/Mantenimiento/CUsuario.php?op=listar_personas_todo", function (ts) {
		$("#UsuarioPersona").empty();
		$("#UsuarioPersona").append(ts);

		$("#UsuarioPersona").attr("disabled","true");
		$("#idUsuario").val(data.idUsuario);
		$("#UsuarioPersona").val(data.Persona_idPersona);
		$("#UsuarioUsuario").val(data.user);
		$("#UsuarioPerfil").val(data.Perfil_idPerfil);
		$("#UsuarioPassword").val("");
		$("#UsuarioPassword").removeClass("validarPanel");
		$("#UsuarioEstado").val(data.Estado_idEstado);
		 });

	});
}
function EliminarUsuario(idUsuario){
      swal({
      title: "Eliminar?",
      text: "Esta Seguro que desea Eliminar Usuario!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Eliminar!",
      closeOnConfirm: false
   }, function () {
      ajaxEliminarUsuario(idUsuario);
   });
}
function ajaxEliminarUsuario(idUsuario){
    $.post("../../controlador/Mantenimiento/CUsuario.php?op=Eliminar_Usuario", {idUsuario: idUsuario}, function (data, e) {
      data = JSON.parse(data);
      var Error = data.Error;
      var Mensaje = data.Mensaje;
      if (Error) {
         swal("Error", Mensaje, "error");
      } else {
         swal("Eliminado!", Mensaje, "success");
         tablaUsuario.ajax.reload();
      }
   });
}
function HabilitarUsuario(idUsuario){
      swal({
      title: "Habilitar?",
      text: "Esta Seguro que desea Habilitar Usuario!",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Habilitar!",
      closeOnConfirm: false
   }, function () {
      ajaxHabilitarUsuario(idUsuario);
   });
}
function ajaxHabilitarUsuario(idUsuario){
       $.post("../../controlador/Mantenimiento/CUsuario.php?op=Recuperar_Usuario", {idUsuario: idUsuario}, function (data, e) {
      data = JSON.parse(data);
      var Error = data.Error;
      var Mensaje = data.Mensaje;
      if (Error) {
         swal("Error", Mensaje, "error");
      } else {
         swal("Eliminado!", Mensaje, "success");
         tablaUsuario.ajax.reload();
      }
   });
}
function LimpiarUsuario(){
   $('#FormularioUsuario')[0].reset();
	$("#idUsuario").val("");
	$("#UsuarioPersona").removeAttr("disabled");
	$("#UsuarioPassword").addClass("validarPanel");
}
function Cancelar(){
    LimpiarUsuario();
    $("#ModalUsuario").modal("hide");

}

init();
