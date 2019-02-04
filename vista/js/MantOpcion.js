function init(){
    var idGrupoOpcion=$("#idGrupoOpcion").val();

}
function LanzarPrueba(){
     var objeto='{"string": "Hello World","tipo": 2,"titulo": "Hola Mundo","minimo1": 12,"maximo1": 20}';
     objeto=JSON.parse(objeto);
     console.log(objeto.tipo);
}

function NuevoOpcion() {

    $("#ModalOpcion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalOpcion").modal("show");
    $("#tituloModalOpcion").empty();
    $("#tituloModalOpcion").append("Nuevo Registro de Opcion:");

    ListarTipoOpcion();
}
function ListarTipoOpcion(){
    	$.post("../../controlador/Mantenimiento/COpcion.php?op=ListarTipoOpcion", function (ts) {
		$("#TipoOpcion").empty();
		$("#TipoOpcion").append(ts);
	});

}
function LimpiarOpcion() {
    $('#FormularioOpcion')[0].reset();
    $("#idOpcion").val("");
}
 function Cancelar() {
    LimpiarOpcion();
    $("#ModalOpcion").modal("hide");

}


init();
