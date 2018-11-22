function init(){
    var idPerfil=$("#idPerfil").val();

     $("#FormularioPermisos").on("submit",function(e)
	{
	      RegistroPermisos(e);
	});
    RecuperarPermisos(idPerfil);
    IniciarGestionPermisos();
}

function RegistroPermisos(){
    event.preventDefault(); //No se activará la acción predeterminada del evento

    $("#cuerpo").addClass("whirl");
    $("#cuerpo").addClass("ringed");
    setTimeout('AjaxActualizarPermisos()', 2000);

}
function AjaxActualizarPermisos(){
        var formData = new FormData($("#FormularioPermisos")[0]);
		console.log(formData);
		$.ajax({
			url: "../../controlador/Mantenimiento/CPerfil.php?op=ActualizarPermisos",
			 type: "POST",
			 data: formData,
			 contentType: false,
			 processData: false,
			 success: function(data,status)
			 {
					data = JSON.parse(data);
					console.log(data);
					var Mensaje=data.Mensaje;
				 	var Error=data.Registro;
					if(!Error){
                        notificar_danger(Mensaje);
					}else{
                        $("#cuerpo").removeClass("whirl");
                        $("#cuerpo").removeClass("ringed");
                        notificar_success(Mensaje);
					}
			 }
		});
}
function IniciarGestionPermisos(){
    $('.datos_eps[type=radio]').change(function(){
      if($(this).val()==1){
		    // valor si
		}else{
			//  valor no;
		}
	});
}
function RecuperarPermisos(idPerfil){
    	//solicitud de recuperar Proveedor
	$.post("../../controlador/Mantenimiento/CPerfil.php?op=RecuperarPermisosPerfil",{"idPerfil":idPerfil}, function(data, status){
		data = JSON.parse(data);
		console.log(data);

    if(parseInt(data.Permiso1)==1){
        $(".m_gestion1[value='1']").attr('checked', 'checked');
    }else{
        $(".m_gestion1[value='0']").attr('checked', 'checked');
    }

	if(parseInt(data.Permiso2)==1){
        $(".m_gestion2[value='1']").attr('checked', 'checked');
    }else{
        $(".m_gestion2[value='0']").attr('checked', 'checked');
    }
	if(parseInt(data.Permiso3)==1){
        $(".m_gestion3[value='1']").attr('checked', 'checked');
    }else{
        $(".m_gestion3[value='0']").attr('checked', 'checked');
    }

	if(parseInt(data.Permiso4)==1){
        $(".m_gestion4[value='1']").attr('checked', 'checked');
    }else{
        $(".m_gestion4[value='0']").attr('checked', 'checked');
    }


    if(parseInt(data.Permiso5)==1){
        $(".m_mantenimiento[value='1']").attr('checked', 'checked');
    }else{
        $(".m_mantenimiento[value='0']").attr('checked', 'checked');
    }

    if(parseInt(data.Permiso6)==1){
        $(".m_reporte[value='1']").attr('checked', 'checked');
    }else{
        $(".m_reporte[value='0']").attr('checked', 'checked');
    }


    $("#perfilRecuperado").empty();
    $("#perfilRecuperado").html("<em><b>"+data.nombrePerfil+"</b></em>");

    $("#idPermisos").val(data.idPermisos);

	});
}
function RegresarPermisos(){
    $.redirect('MantPerfiles.php');
}

init();
