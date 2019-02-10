function init() {
    var idPaciente = $("#idPaciente").val();
    RecuperarDatosPaciente(idPaciente);
    RecuperarGrupos();
}

function RecuperarDatosPaciente(idPaciente) {
    $.post("../../controlador/Gestion/CGestionPacientes.php?op=RecuperarInformacionPaciente", {
        idPaciente: idPaciente
    }, function (data, status) {
        data = JSON.parse(data);
        $("#NombrePaciente").empty();
        $("#EdadPaciente").empty();
        $("#DocumentoPaciente").empty();
        $("#NombrePaciente").text(data.PacienteNombre);
        $("#EdadPaciente").text(data.edad);
        $("#DocumentoPaciente").text(data.documento);
    });
}

function RecuperarGrupos() {
    var Html = "";
    $.post("../../controlador/Gestion/CFicha.php?op=RecuperarGrupos", function (data, status) {
        data = JSON.parse(data);


        data.forEach(function (element) {
            var idGrupo = element.id;
            var grupo = element.grupo;
            var opciones = element.opciones;

            var grupoOpcion = '<div class="card card-default mb-1">' +
                '<div class="card-header" id="cabecera' + idGrupo + '">' +
                '<h4 class="mb-0"><a class="text-inherit" data-toggle="collapse" data-target="#collapse' + idGrupo + '" aria-expanded="false" aria-controls="collapse' + idGrupo + '" href="">' + grupo + '</a>' +
                '</h4>' +
                '</div>' +
                '<div class="collapse" id="collapse' + idGrupo + '" aria-labelledby="cabecera' + idGrupo + '" data-parent="#accordion">' +
                '<div class="card-body border-top">';

            var contador = 0;
            opciones.forEach(function (element2) {
                grupoOpcion=grupoOpcion+'<div class="row mt-1">';
                var OpcionSet = RecuperarTipoOpcion(element2, contador++);
                grupoOpcion = grupoOpcion + OpcionSet+'</div>';
            });


            grupoOpcion = grupoOpcion + '</div></div></div>';

            Html = Html + grupoOpcion;
        });

        $("#accordion").html(Html);
    });
}

function RecuperarTipoOpcion(elemento, contador) {
    var idOpcion = elemento.id;
    var Titulo = elemento.titulo;
    debugger;
    var Propiedades=elemento.propiedades.replace(/&quot;/g, '\"');
    var Propiedades = JSON.parse(Propiedades);
    var Tipo = elemento.tipo;

    var opcion="";
    switch (Tipo) {
        case "1":
            opcion = '<div class="col-md-12">' +
                '<h4 class="text-info">' + Titulo + '</h4>' +
                '</div>';
            break;
        case "2":
            break;
        case "3":
            break;
        case "4":
            break;
        case "5":
            break;
        case "6":
            break;
        case "7":
            break;
        case "8":
            break;

        case "9":
            break;

        case "10":
             opcion = '<div class="col-md-12">' +
                '<h5 class="text-info">' + Titulo + '</h5>' +
                '</div>';

            break;
    }
    return opcion;
}
init();
