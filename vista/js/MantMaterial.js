var tablaMaterial;
function init(){
   Iniciar_Componentes();
   Listar_Material();
	Listar_Estado();
}
function Iniciar_Componentes(){
   //var fecha=hoyFecha();

	//$('#date_fecha_comprobante').datepicker('setDate',fecha);

    $("#FormularioMaterial").on("submit",function(e)
	{
	      RegistroMaterial(e);
	});

}
function RegistroMaterial(event){
	  //cargar(true);
	event.preventDefault(); //No se activará la acción predeterminada del evento
    var error="";

    $(".validarPanel").each(function(){
			if($(this).val()==" " || $(this).val()==0){
				error=error+$(this).data("message")+"<br>";
			}
    });

    if(error==""){
		$("#ModalMaterial #cuerpo").addClass("whirl");
		$("#ModalMaterial #cuerpo").addClass("ringed");
		setTimeout('AjaxRegistroMaterial()', 2000);
	}else{
 		notificar_warning("Complete :<br>"+error);
	}
}
function AjaxRegistroMaterial(){
    var formData = new FormData($("#FormularioMaterial")[0]);
		console.log(formData);
		$.ajax({
			url: "../../controlador/Mantenimiento/CMaterial.php?op=AccionMaterial",
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
						$("#ModalMaterial #cuerpo").removeClass("whirl");
						$("#ModalMaterial #cuerpo").removeClass("ringed");
						$("#ModalMaterial").modal("hide");
						swal("Error:", Mensaje);
						LimpiarMaterial();
						tablaMaterial.ajax.reload();
					}else{
						$("#ModalMaterial #cuerpo").removeClass("whirl");
						$("#ModalMaterial #cuerpo").removeClass("ringed");
						$("#ModalMaterial").modal("hide");
					   swal("Acción:", Mensaje);
						LimpiarMaterial();
						tablaMaterial.ajax.reload();
					}
			 }
		});
}
function Listar_Estado(){
	 $.post("../../controlador/Mantenimiento/CMaterial.php?op=listar_estados", function (ts) {
      $("#MaterialEstado").append(ts);
   });
}
function Listar_Material(){

	tablaMaterial = $('#tablaMaterial').dataTable({
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
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }

            , {
               extend: 'excel'
               , className: 'btn-info'
               , title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            , {
               extend: 'pdfHtml5'
               , className: 'btn-info sombra3'
               , title: "Sistema de Matricula - Jose Galvez - Reporte"
               ,orientation: 'landscape'
               ,pageSize: 'LEGAL',
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: RecuperarLogo64(),
                    } );
                }
            }
            , {
               extend: 'print'
               , className: 'btn-info',
                title: "Sistema de Matricula - Jose Galvez - Reporte"
            }
            ],
         "ajax": { //Solicitud Ajax Servidor
			url: '../../controlador/Mantenimiento/CMaterial.php?op=Listar_Material',
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
	tablaMaterial.on('order.dt search.dt', function () {
		tablaMaterial.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
}
function NuevoMaterial(){
    $("#ModalMaterial").modal({
      backdrop: 'static'
      , keyboard: false
    });
    $("#ModalMaterial").modal("show");
    $("#tituloModalMaterial").empty();
    $("#tituloModalMaterial").append("Nuevo Material:");
}
function EditarMaterial(idMaterial){
    $("#ModalMaterial").modal({
      backdrop: 'static'
      , keyboard: false
    });
    $("#ModalMaterial").modal("show");
    $("#tituloModalMaterial").empty();
    $("#tituloModalMaterial").append("Editar Material:");
	RecuperarMaterial(idMaterial);
}
function RecuperarMaterial(idMaterial){
	//solicitud de recuperar Proveedor
	$.post("../../controlador/Mantenimiento/CMaterial.php?op=RecuperarInformacion_Material",{"idMaterial":idMaterial}, function(data, status){
		data = JSON.parse(data);
		console.log(data);

	$("#idMaterial").val(data.idMaterial);
	$("#MaterialNombre").val(data.Descripcion);
	$("#MaterialEstado").val(data.Estado_idEstado);

	});
}
function EliminarMaterial(idMaterial){
      swal({
      title: "Eliminar?",
      text: "Esta Seguro que desea Eliminar Material!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Eliminar!",
      closeOnConfirm: false
   }, function () {
      ajaxEliminarMaterial(idMaterial);
   });
}
function ajaxEliminarMaterial(idMaterial){
    $.post("../../controlador/Mantenimiento/CMaterial.php?op=Eliminar_Material", {idMaterial: idMaterial}, function (data, e) {
      data = JSON.parse(data);
      var Error = data.Error;
      var Mensaje = data.Mensaje;
      if (Error) {
         swal("Error", Mensaje, "error");
      } else {
         swal("Eliminado!", Mensaje, "success");
         tablaMaterial.ajax.reload();
      }
   });
}
function HabilitarMaterial(idMaterial){
      swal({
      title: "Habilitar?",
      text: "Esta Seguro que desea Habilitar Material!",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Habilitar!",
      closeOnConfirm: false
   }, function () {
      ajaxHabilitarMaterial(idMaterial);
   });
}
function ajaxHabilitarMaterial(idMaterial){
       $.post("../../controlador/Mantenimiento/CMaterial.php?op=Recuperar_Material", {idMaterial: idMaterial}, function (data, e) {
      data = JSON.parse(data);
      var Error = data.Error;
      var Mensaje = data.Mensaje;
      if (Error) {
         swal("Error", Mensaje, "error");
      } else {
         swal("Eliminado!", Mensaje, "success");
         tablaMaterial.ajax.reload();
      }
   });
}
function LimpiarMaterial(){
   $('#FormularioMaterial')[0].reset();
	$("#idMaterial").val("");

}
function Cancelar(){
    LimpiarMaterial();
    $("#ModalMaterial").modal("hide");
}


init();
