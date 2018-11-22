var tablaPersona;
function init(){
    Iniciar_Componentes();
    Listar_Estado();
    Listar_Persona();
}
function Iniciar_Componentes(){
   //var fecha=hoyFecha();

	//$('#date_fecha_comprobante').datepicker('setDate',fecha);

    $("#FormularioPersona").on("submit",function(e)
	{
	      RegistroPersona(e);
	});
 	$('#dateFechaNacimiento').datepicker({
      format: 'dd/mm/yyyy',
      language: 'es'
   });
}
function RegistroPersona(event){
	  //cargar(true);
	event.preventDefault(); //No se activará la acción predeterminada del evento
    var error="";

    $(".validarPanel").each(function(){
			if($(this).val()==" " || $(this).val()==0){
				error=error+$(this).data("message")+"<br>";
			}
    });

    if(error==""){
		$("#ModalPersona #cuerpo").addClass("whirl");
		$("#ModalPersona #cuerpo").addClass("ringed");
		setTimeout('AjaxRegistroPersona()', 2000);
	}else{
 		notificar_warning("Complete :<br>"+error);
	}
}
function AjaxRegistroPersona(){
    var formData = new FormData($("#FormularioPersona")[0]);
		console.log(formData);
		$.ajax({
			url: "../../controlador/Mantenimiento/CPersona.php?op=AccionPersona",
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
						$("#ModalPersona #cuerpo").removeClass("whirl");
						$("#ModalPersona #cuerpo").removeClass("ringed");
						$("#ModalPersona").modal("hide");
						swal("Error:", Mensaje);
						LimpiarPersona();
						tablaPersona.ajax.reload();
					}else{
						$("#ModalPersona #cuerpo").removeClass("whirl");
						$("#ModalPersona #cuerpo").removeClass("ringed");
						$("#ModalPersona").modal("hide");
					   swal("Acción:", Mensaje);
						LimpiarPersona();
						tablaPersona.ajax.reload();
					}
			 }
		});
}
function Listar_Estado(){
	 $.post("../../controlador/Mantenimiento/CPersona.php?op=listar_estados", function (ts) {
      $("#PersonaEstado").append(ts);
   });
}

function Listar_Persona(){
	tablaPersona = $('#tablaPersona').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"processing": true,
		"paging": true, // Paginacion en tabla
		"ordering": false, // Ordenamiento en columna de tabla
		"info": false, // Informacion de cabecera tabla
		"responsive": true, // Accion de responsive
	   "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Mantenimiento/CPersona.php?op=Listar_Persona',
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
	tablaPersona.on('order.dt search.dt', function () {
		tablaPersona.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
}
function NuevoPersona(){
    $("#ModalPersona").modal({
      backdrop: 'static'
      , keyboard: false
    });
    $("#ModalPersona").modal("show");
    $("#tituloModalPersona").empty();
    $("#tituloModalPersona").append("Nuevo Persona:");
}
function EditarPersona(idPersona){
    $("#ModalPersona").modal({
      backdrop: 'static'
      , keyboard: false
    });
    $("#ModalPersona").modal("show");
    $("#tituloModalPersona").empty();
    $("#tituloModalPersona").append("Editar Persona:");
	RecuperarPersona(idPersona);
}
function RecuperarPersona(idPersona){
	//solicitud de recuperar Proveedor
	$.post("../../controlador/Mantenimiento/CPersona.php?op=RecuperarInformacion_Persona",{"idPersona":idPersona}, function(data, status){
		data = JSON.parse(data);
		console.log(data);

$("#idPersona").val(data.idPersona);
$("#PersonaNombre").val(data.nombrePersona);
$("#PersonaFechaNacimiento").val(data.fechaNacimiento);
$("#PersonaApellidoP").val(data.apellidoPaterno);
$("#PersonaDNI").val(data.DNI);
$("#PersonaApellidoM").val(data.apellidoMaterno);
$("#PersonaCorreo").val(data.correo);
$("#PersonaTelefono").val(data.telefono);
$("#PersonaDireccion").val(data.direccion);
$("#PersonaEstado").val(data.Estado_idEstado);

	});
}
function EliminarPersona(idPersona){
      swal({
      title: "Eliminar?",
      text: "Esta Seguro que desea Eliminar Persona!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Eliminar!",
      closeOnConfirm: false
   }, function () {
      ajaxEliminarPersona(idPersona);
   });
}
function ajaxEliminarPersona(idPersona){
    $.post("../../controlador/Mantenimiento/CPersona.php?op=Eliminar_Persona", {idPersona: idPersona}, function (data, e) {
      data = JSON.parse(data);
      var Error = data.Error;
      var Mensaje = data.Mensaje;
      if (Error) {
         swal("Error", Mensaje, "error");
      } else {
         swal("Eliminado!", Mensaje, "success");
         tablaPersona.ajax.reload();
      }
   });
}
function HabilitarPersona(idPersona){
      swal({
      title: "Habilitar?",
      text: "Esta Seguro que desea Habilitar Persona!",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Habilitar!",
      closeOnConfirm: false
   }, function () {
      ajaxHabilitarPersona(idPersona);
   });
}
function ajaxHabilitarPersona(idPersona){
       $.post("../../controlador/Mantenimiento/CPersona.php?op=Recuperar_Persona", {idPersona: idPersona}, function (data, e) {
      data = JSON.parse(data);
      var Error = data.Error;
      var Mensaje = data.Mensaje;
      if (Error) {
         swal("Error", Mensaje, "error");
      } else {
         swal("Eliminado!", Mensaje, "success");
         tablaPersona.ajax.reload();
      }
   });
}
function LimpiarPersona(){
   $('#FormularioPersona')[0].reset();
	$("#idPersona").val("");

}
function Cancelar(){
    LimpiarPersona();
    $("#ModalPersona").modal("hide");

}

init();
