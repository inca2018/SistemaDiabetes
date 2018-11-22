function init(){
RecuperarInformacionUsuario();
       $("#FormularioPerfil").on("submit",function(e)
	{
	      ActualizarPerfil(e);
	});

}


function RecuperarInformacionUsuario(){
  $.post("../../controlador/Gestion/CGestion.php?op=RecuperarDatosPerfil", function (data, status) {
        data = JSON.parse(data);
        console.log(data);

    $("#UsuarioNombre").val(data.nombrePersona);
    $("#UsuarioApellidoPaterno").val(data.apellidoPaterno);
    $("#UsuarioApellidoMaterno").val(data.apellidoMaterno);
    $("#UsuarioCorreo").val(data.correo);
    $("#UsuarioContacto").val(data.telefono);
    $("#UsuarioUsuario").val(data.usuario);
    $("#UsuarioPerfil").val(data.nombrePerfil);
    $("#UsuarioPassVerificar").val("");
    $("#UsuarioPassNuevo").val("");
    $("#idUsuario").val(data.idUsuario);


    });
}
function ActualizarPerfil(event){
	  //cargar(true);
	event.preventDefault(); //No se activará la acción predeterminada del evento
    var error="";

    if(error==""){
		$("#area_perfil").addClass("whirl");
		$("#area_perfil").addClass("ringed");
		setTimeout('AjaxActualizarPerfil()', 2000);
	}else{
 		notificar_warning("Complete :<br>"+error);
	}
}
function AjaxActualizarPerfil(){
    var formData = new FormData($("#FormularioPerfil")[0]);
		console.log(formData);
		$.ajax({
			url: "../../controlador/Gestion/CGestion.php?op=ActualizarPerfil",
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
						$("#area_perfil").removeClass("whirl");
						$("#area_perfil").removeClass("ringed");

						swal("Error:", Mensaje);

					}else{
						$("#area_perfil").removeClass("whirl");
						$("#area_perfil").removeClass("ringed");

					    swal("Acción:", Mensaje);

					}
			 }
		});
}

init();
