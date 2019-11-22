var sexo;
var Lista_Medicos;
var Listas_Comorbilidad;
var DiagnosticoEnfermeria;
var Tratamientos;
var Evaluado;
var Satisfaccion;
var totalPreguntas = 0;

var totalAvance = $("#totalAvance");

function init() {
    RecuperarListas();
}

function RecuperarListas() {
    $.post("../../controlador/Gestion/CFicha.php?op=RecuperarListas", function (data, status) {
        data = JSON.parse(data);
        Lista_Medicos = data.medicos;
        Listas_Comorbilidad = data.comorbilidad;
        DiagnosticoEnfermeria = data.enfermeria;
        Tratamientos = data.tratamientos;
        Evaluado = data.evaluado;
        Satisfaccion = data.satisfaccion;
        iniciar_funciones();
    });
}

function iniciar_funciones() {
    var idPaciente = $("#idPaciente").val();
    RecuperarDatosPaciente(idPaciente);
    RecuperarGrupos();
    RecuperarEspecialidades();
}

function LanzarFuncionOpcionesPie() {

    $(".opciones").each(function () {
        $(this).on('click', function () {

            var opcion = $(this).data("opcion");
            switch (opcion) {
                //Opcion Libre
                case 1:
                    MostrarOpcion($(this), 2);
                    break;
                    //Opcion B -  MONOFILAMENTO NORMAL (CHECK)
                case 2:
                    MostrarOpcion($(this), 3);
                    break;
                    //Opcion C - MONOFILAMENTO ANORMAL (X)
                case 3:
                    MostrarOpcion($(this), 4);
                    break;
                    //Opcion D - VIBRACION NORMAL (VERDE)
                case 4:
                    MostrarOpcion($(this), 5);
                    break;
                    //Opcion E - VIBRACION ANORMAL (ROJO)
                case 5:
                    MostrarOpcion($(this), 6);
                    break;
                    //Opcion F - MONOFILAMENTO NORMAL (CHECK) - VIBRACION NORMAL (VERDE)
                case 6:
                    MostrarOpcion($(this), 7);
                    break;
                    //Opcion G - MONOFILAMENTO NORMAL (CHECK) - VIBRACION ANORMAL (ROJO)
                case 7:
                    MostrarOpcion($(this), 8);
                    break;
                    //Opcion H - MONOFILAMENTO ANORMAL (X) - VIBRACION ANORMAL (VERDE)
                case 8:
                    MostrarOpcion($(this), 9);
                    break;
                    //Opcion I - MONOFILAMENTO ANORMAL (X) - VIBRACION ANORMAL (ROJO)
                case 9:
                    MostrarOpcion($(this), 1);
                    break;
            }
        });
    });
}

function MostrarOpcion(Check, opcion) {
    Check.removeClass("OptionA");
    Check.removeClass("OptionB");
    Check.removeClass("OptionC");
    Check.removeClass("OptionD");
    Check.removeClass("OptionE");
    Check.empty();

    Check.data("opcion", opcion);

    switch (opcion) {
        case 1:
            Check.addClass("OptionA");
            break;
        case 2:
            Check.addClass("OptionB");
            Check.html('<span><i class="fa fa-check" aria-hidden="true"></i></span>');
            break;
        case 3:
            Check.addClass("OptionC");
            Check.html('<span><i class="fa fa-times" aria-hidden="true"></i></span>');
            break;
        case 4:
            Check.addClass("OptionD"); //VERDE
            break;
        case 5:
            Check.addClass("OptionE"); //ROJO
            break;
        case 6:
            Check.addClass("OptionD");
            Check.html('<span><i class="fa fa-check" aria-hidden="true"></i></span>');
            break;
        case 7:
            Check.addClass("OptionE");
            Check.html('<span><i class="fa fa-check" aria-hidden="true"></i></span>');
            break;
        case 8:
            Check.addClass("OptionD");
            Check.html('<span><i class="fa fa-times" aria-hidden="true"></i></span>');
            break;
        case 9:
            Check.addClass("OptionE");
            Check.html('<span><i class="fa fa-times" aria-hidden="true"></i></span>');
            break;
    }
}

function RecuperarEspecialidades() {
    //$("#bloqueEspecialidades")

    $.post("../../controlador/Gestion/CFicha.php?op=ListarDiagnosticos", function (ts) {
        var diagnosticos = ts;
        $.post("../../controlador/Gestion/CFicha.php?op=RecuperarEspecialidades", function (data, status) {
            data = JSON.parse(data);
            var query = "";
            data.forEach(function (element) {

                var idEspecialidad = element.id;
                var especialidad = element.especialidad;
                var medicos = element.medicos;

                $("#OptionDiag" + idEspecialidad).select2({
                    theme: 'bootstrap'
                });
                $("#OptionMedico" + idEspecialidad).select2({
                    theme: 'bootstrap'
                });
                query = query + '<div class="row opcionEspecialidad OpcionGeneral" data-id="' + idEspecialidad + '" data-opcion="ESPECIALIDAD">' +
                    '<div class="col-md-2 mt-5">' +
                    '<label for="">' + especialidad + '</label>' +
                    '</div>' +
                    '<div class="col-md-2 mt-5">' +
                    '<div class="row">' +
                    '<label for="" class="col-md-3 ">SI</label>' +
                    '<input id="SIE' + idEspecialidad + '" class="form-control opcion2 col-md-3 mt-1" type="radio" name="radioE' + idEspecialidad + '" value="1">' +
                    '<label for="" class="col-md-3 ">NO</label>' +
                    '<input id="NOE' + idEspecialidad + '" class="form-control opcion2 col-md-3 mt-1" type="radio" name="radioE' + idEspecialidad + '" value="0" checked>' +
                    '</div>' +
                    '</div>' +


                    '<div class="col-md-2">' +
                    ' <div class="form-group">' +
                    ' <label for="" class="col-form-label">Diagnostico:</label>' +
                    ' <input type="text" class="form-control"  data-message="' + especialidad + ' - Diagnostico" id="OptionDiag' + idEspecialidad + '" disabled>' +
                    '</div>' +
                    '</div>' +

                    '<script>var input' + idEspecialidad + ' = document.getElementById("OptionDiag' + idEspecialidad + '"); new Awesomplete(input' + idEspecialidad + ','+diagnosticos+'); </script>' +


                    '<div class="col-md-2">' +
                    ' <div class="form-group">' +
                    ' <label for="OpcionTipoCampo" class="col-form-label">Medico:</label>' +
                    '<select class="form-control selector" id="OptionMedico' + idEspecialidad + '" data-message="' + especialidad + ' - Medico" name="OpcionTipoCampo"  disabled>' + medicos +

                    '</select>' +
                    '</div>' +
                    ' </div>' +
                    '<div class="col-md-2">' +
                    ' <div class="form-group">' +
                    ' <label for="" class="col-form-label">Tratamiento:</label>' +
                    ' <input type="text" class="form-control"  data-message="' + especialidad + ' - Tratamiento" id="tratamiento' + idEspecialidad + '" disabled>' +
                    '</div>' +
                    '</div>' +
                    ' <div class="col-md-2">' +
                    ' <div class="form-group">' +
                    '<label for="" class="col-form-label">Observaciones:</label>' +
                    ' <input type="text" class="form-control" data-message="' + especialidad + ' - Observaciones" id="Obser' + idEspecialidad + '" disabled>' +
                    '</div>' +
                    '</div>' +
                    ' </div>';

            });

            query = query + '<div class="col-md-12">' +
                '<label class="">Paciente Refiere:</label><input type="hidden" id="ocultoRefiere">' +
                '<textarea id="RefiereOpcion" class="form-control  caja campo opcionCampo" data-tipo="20" type="text" step="any"  ></textarea>' +
                '</div>';

            $("#contenedorEspecialidades").html(query);
            LanzarFuncionesEspecialidad();


        });
    });

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
        sexo = data.sexo;

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

            var grupoOpcion = '<div class="card border-primary mb-1">' +
                '<div class="card-header text-white bg-primary" id="cabecera' + idGrupo + '">' +
                '<h4 class="mb-0"><a class="text-inherit" data-toggle="collapse" data-target="#collapse' + idGrupo + '" aria-expanded="false" aria-controls="collapse' + idGrupo + '" href="">' + grupo + '</a>' +
                '</h4>' +
                '</div>' +
                '<div class="collapse" id="collapse' + idGrupo + '" aria-labelledby="cabecera' + idGrupo + '" data-parent="#accordion">' +
                '<div class="card-body border-top">';

            var contador = 0;
            opciones.forEach(function (element2) {

                var idOpcion = element2.id;
                var Tipo = element2.tipo;
                grupoOpcion = grupoOpcion + '<div class="row mt-1 ml-5 OpcionGeneral" data-grupo="' + idGrupo + '" data-id="' + idOpcion + '" data-tipo="' + Tipo + '" data-opcion="OPCION">';
                var OpcionSet = RecuperarTipoOpcion(element2, contador++, grupo);
                grupoOpcion = grupoOpcion + OpcionSet + '</div>';
            });

            grupoOpcion = grupoOpcion + '</div></div></div>';

            Html = Html + grupoOpcion;
        });
        var especialidades = '<div class="card border-primary mb-1">' +
            '<div class="card-header text-white bg-primary" id="headingEspecialidad">' +
            '<h4 class="mb-0"><a class="text-inherit" data-toggle="collapse" data-target="#collapseEspecialidad" aria-expanded="false" aria-controls="collapseEspecialidad" href="">OTRAS ESPECIALIDADES</a>' +
            '</h4>' +
            '</div>' +
            '<div class="collapse" id="collapseEspecialidad" aria-labelledby="headingEspecialidad" data-parent="#accordion">' +
            '<div class="card-body border-top">' +
            '<div class="row" >' +
            ' <div class="col-md-12" id="contenedorEspecialidades">' +
            '</div>' +
            ' </div>' +
            '</div>' +
            '</div>' +
            '</div>';
        var riesgo = '<div class="card border-primary mb-1">' +
            '<div class="card-header text-white bg-primary" id="headingEspecialidad">' +
            '<h4 class="mb-0"><a class="text-inherit" data-toggle="collapse" data-target="#collapseRiesgo" aria-expanded="false" aria-controls="collapseRiesgo" href="">CATEGORIZACIÓN DE RIESGO</a>' +
            '</h4>' +
            '</div>' +
            '<div class="collapse" id="collapseRiesgo" aria-labelledby="headingEspecialidad" data-parent="#accordion">' +
            '<div class="card-body border-top">' +
            '<div class="row p-3" >' +
            '<div class="col-md-3 bb bt bl p-2 text-center fondo1">PACIENTE BAJO RIESGO<br>Todo lo siguiente</div>' +
            '<div class="col-md-3 bt bb bl p-2 text-center fondo2">MODERADO RIESGO<br>Uno o Más de lo siguiente</div>' +
            '<div class="col-md-3 bt bb bl p-2 text-center fondo3">ALTO RIESGO<br>Uno de los siguientes</div>' +
            '<div class="col-md-3 bt bb br p-2 text-center fondo4">MUY ALTO RRIESGO<br>Uno de los siguientes</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opA1" class="m-3 riesgoOpcion">Percibe Monofilamento</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opA2" class="m-3 riesgoOpcion">No percibe monofilamento</div>' +
            '<div class="col-md-3 bb bl br p-1 text-left "><input  type="checkbox" id="opA3" class="m-3 riesgoOpcion">No percibe diapazon</div>' +
            '<div class="col-md-3 bb br p-1 text-left "><input  type="checkbox" id="opA4" class="m-3 riesgoOpcion">Úlcera activa</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opB1" class="m-3 riesgoOpcion">Ninguna úlcera previa</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opB2" class="m-3 riesgoOpcion">Piel o uñas de riesgo</div>' +
            '<div class="col-md-3 bb bl br p-1 text-left "><input  type="checkbox" id="opB3" class="m-3 riesgoOpcion">Deformidad severa</div>' +
            '<div class="col-md-3 bb br p-1 text-left "><input  type="checkbox" id="opB4" class="m-3 riesgoOpcion">Dedo o pie amputado</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opC1" class="m-3 riesgoOpcion">Ninguna  deformidad severa</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opC2" class="m-3 riesgoOpcion">Pulso tibial de dificil percepción</div>' +
            '<div class="col-md-3 bb bl br p-1 text-left "><input  type="checkbox" id="opC3" class="m-3 riesgoOpcion">Ausencia de Pulso</div>' +
            '<div class="col-md-3 bb br p-1 text-left "><input  type="checkbox" id="opC4" class="m-3 riesgoOpcion">Úlcera Antigua</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opD1" class="m-3 riesgoOpcion">Pulsos pedio presentes</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opD2" class="m-3 riesgoOpcion">Una deformidad leve</div>' +
            '<div class="col-md-3 bb bl br p-1 text-left "></div>' +
            '<div class="col-md-3 bb br p-1 text-left "></div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opE1" class="m-3">Ninguna Amputación</div>' +
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opE2" class="m-3">Formación de callos</div>' +
            '<div class="col-md-3 bb bl br p-1 text-left "></div> ' +
            '<div class="col-md-3 bb br p-1 text-left "></div>' +

            ' </div>' +
            '</div>' +
            '</div>' +
            '</div>';
        var pie =
            '<div class="card border-primary mb-1">' +
            '<div class="card-header text-white bg-primary" id="headingTwo">' +
            '<h4 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" href="">EXAMEN DE PIE</a>' +
            '</h4>' +
            '</div>' +
            '<div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">' +
            '<div class="card-body border-top">' +
            '<div class="row">' +
            '<div class="col-md-12">' +
            '<div class="row">' +
            '<div class="col-md-12"><p>Si no siente el monofilamento y la vibracion seguir lo siguiente:</p></div>' +
            '<div class="col-md-3">' +
            '<div class="row">' +
            '<div class="col-md-12"><p>Respuesta al monofilamento</p></div>' +
            '<div class="col-md-6"><p>normal</p></div>' +
            '<div class="col-md-6"><span class="opciones OptionB OpcionPie"><span><i class="fa fa-check" aria-hidden="true"></i></span></span>' +
            '</div>' +
            '<div class="col-md-6"><p>anormal</p></div>' +
            '<div class="col-md-6"><span class="opciones OptionC OpcionPie"><i class="fa fa-times" aria-hidden="true"></i></span></div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
            '<div class="row">' +
            '<div class="col-md-12"><p>Respuesta a la vibracion</p></div>' +
            '<div class="col-md-6"><p>normal</p></div>' +
            '<div class="col-md-6"><span class="opciones OptionD OpcionPie"></span></div>' +
            '<div class="col-md-6"><p>anormal</p></div>' +
            '<div class="col-md-6"><span class="opciones OptionE OpcionPie"></span></div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
            '<div class="row">' +
            '<div class="col-md-9"><p>Monofilamento normal/Vibración normal</p></div>' +
            '<div class="col-md-3"><span class="opciones OptionD OpcionPie"><span><i class="fa fa-check " aria-hidden="true"></i></span></span></div>' +
            '<div class="col-md-9"><p>Monofilamento normal/Vibración anormal</p></div>' +
            '<div class="col-md-3"><span class="opciones OptionE OpcionPie"><span><i class="fa fa-check " aria-hidden="true"></i></span></span></div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
            '<div class="row">' +
            '<div class="col-md-9"><p>Monofilamento anormal/Vibración normal</p></div>' +
            '<div class="col-md-3"><span class="opciones OptionD OpcionPie"><span><i class="fa fa-times " aria-hidden="true"></i></span></span></div>' +
            '<div class="col-md-9"><p>Monofilamento anormal/Vibración anormal</p></div>' +
            '<div class="col-md-3"><span class="opciones OptionE OpcionPie"><span><i class="fa fa-times " aria-hidden="true"></i></span></span></div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-8 offset-4">' +
            '<div class="row" >' +
            '<div class="col-md-12 padre">' +
            '<div class="ImagenPie">' +
            '<div class="OpcionPie1" id="OpcionPieN1">' +
            '<div class="opciones OptionA" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie2" id="OpcionPieN2">' +
            '<div class="opciones OptionA" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie3" id="OpcionPieN3">' +
            '<div class="opciones OptionA" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie4" id="OpcionPieN4">' +
            '<div class="opciones OptionA" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie5" id="OpcionPieN5">' +
            '<div class="opciones OptionA" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie6" id="OpcionPieN6">' +
            '<div class="opciones OptionA" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie7" id="OpcionPieN7">' +
            '<div class="opciones OptionA" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie8" id="OpcionPieN8">' +
            '<div class="opciones OptionA" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
        Html = Html + riesgo;
        Html = Html + especialidades;
        Html = Html + pie;
        $("#accordion").html(Html);
        LanzarFunciones();
        LanzarFuncionOpcionesPie();
        console.log("Total Preguntas:" + totalPreguntas);

        VerificarPorcentajeAvance();
    });
}

function RecuperarTipoOpcion(elemento, contador, grupo) {

    var idOpcion = elemento.id;
    var Titulo = elemento.titulo;
    var Informacion = elemento.Informacion;
    if (Informacion == 'null' || Informacion == null) {
        Informacion = "";
    }

    var Propiedades = elemento.propiedades.replace(/&quot;/g, '\"');
    var Propiedades = JSON.parse(Propiedades);
    var Tipo = elemento.tipo;

    grupo = "";
    var opcion = "";
    switch (Tipo) {
        case "1":
            opcion = '<div class="col-md-12">' +
                '<h4 class="text-info"><u>' + Titulo + ':</u></h4>' +
                '</div>';
            break;
        case "2":
            opcion = '<div class="col-md-12">' +
                '<label class="">' + Titulo + ':</label><span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span>' +
                '<textarea id="CAM' + idOpcion + '" class="form-control  caja campo opcionCampo fuTextoCaja" data-tipo="' + Tipo + '" type="text" step="any"  ></textarea>' +
                '</div>';
            totalPreguntas = totalPreguntas + 1;
            break;
        case "3":
            var atributo = Propiedades.Atributo;
            var minimo = Propiedades.Minimo;
            var maximo = Propiedades.Maximo;
            var place = '';
            if (maximo == 9999) {
                place = '(Rango: >' + minimo + ' ' + atributo + ')';
            } else {
                place = '(Rango: ' + minimo + ' ' + atributo + ' - ' + maximo + ' ' + atributo + ')';
            }
            opcion = '<input type="hidden" class="opcionOculto" id="OF' + idOpcion + '"  data-minimo="' + minimo + '" data-maximo="' + maximo + '">' +

                '<div class="col-md-12"><label class="">' + Titulo + '- Rango:(' + minimo + ' ' + atributo + '-' + maximo + ' ' + atributo + '):</label><span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span></div>' +
                '<div class="col-md-4">' +
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango validar fuTextoCaja" data-message="' + grupo + ' - ' + Titulo + '" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +

                '<div class="col-md-2 ">' +
                '<img style="display:none;" id="SI' + idOpcion + '" src="../../assets/image/emoticon2.png" alt="Resultado Bueno" height="30" width="30">' +
                '<img style="display:none;" id="NO' + idOpcion + '" src="../../assets/image/emoticon1.png" alt="Resultado Malo" height="30" width="30">' +
                '</div> ';
            /*'<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
            '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
            '</div> ';*/
            totalPreguntas = totalPreguntas + 1;
            break;
        case "4":
            var atributo = "";
            var minimo = "";
            var maximo = "";
            var paciente = "";

            if (sexo == 1 || sexo == "1") {
                atributo = Propiedades.AtributoHombre;
                minimo = Propiedades.MinimoHombre;
                maximo = Propiedades.MaximoHombre;
                paciente = "Paciente Masculino";
            } else if (sexo == 2 || sexo == "2") {
                atributo = Propiedades.AtributoMujer;
                minimo = Propiedades.MinimoMujer;
                maximo = Propiedades.MaximoMujer;
                paciente = "Paciente Femenino";
            }

            var place = '';
            if (maximo == 9999) {
                place = '(Rango: >' + minimo + ' ' + atributo + ')';
            } else {
                place = '(Rango: ' + minimo + ' ' + atributo + ' - ' + maximo + ' ' + atributo + ')';
            }
            opcion = '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '"  data-minimo="' + minimo + '" data-maximo="' + maximo + '" data-sexo="' + sexo + '">' +
                '<div class="col-md-12"><label class="">' + Titulo + ' Rango(' + minimo + '' + atributo + ' - ' + maximo + ' ' + atributo + ') - ' + paciente + ':</label><span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span></div>' +
                '<div class="col-md-4">' +
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango validar fuTextoCaja" data-message="' + grupo + ' - ' + Titulo + '" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +

                '<div class="col-md-2 ">' +
                '<img style="display:none;" id="SI' + idOpcion + '" src="../../assets/image/emoticon2.png" alt="Resultado Bueno" height="30" width="30">' +
                '<img style="display:none;" id="NO' + idOpcion + '" src="../../assets/image/emoticon1.png" alt="Resultado Malo" height="30" width="30">' +
                '</div> ';
            /*'<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
            '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
            '</div> ';*/
            totalPreguntas = totalPreguntas + 1;
            break;
        case "5":

            opcion = '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '" >' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                ' <label for="" class="col-form-label">' + Titulo + ':</label><span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span>' +
                '<div class="input-group date dateFecha">' +
                ' <input class="form-control opcionFecha validar fuTextoDate" type="text" id="FE' + idOpcion + '" data-message="' + grupo + ' - ' + Titulo + '" data-tipo="' + Tipo + '" data-id="' + idOpcion + '" autocomplete="off">' +
                ' <span class="input-group-append input-group-addon">' +
                '     <span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>' +
                ' </span>' +
                '</div>' +
                '</div>' +
                '</div>';
            totalPreguntas = totalPreguntas + 1;

            break;
        case "6":
            var v1 = Propiedades.variable1;
            var v2 = Propiedades.variable2;
            var v3 = Propiedades.variable3;
            var v4 = Propiedades.variable4;
            var formula = Propiedades.Formula;
            var minimo = Propiedades.minimo;
            var maximo = Propiedades.maximo;
            var vv1 = "";
            (v1 == "") ? vv1 = "": vv1 = "validar";
            var vv2 = "";
            (v2 == "") ? vv2 = "": vv2 = "validar";
            var vv3 = "";
            (v3 == "") ? vv3 = "": vv3 = "validar";
            var vv4 = "";
            (v4 == "") ? vv4 = "": vv4 = "validar";

            opcion =
                '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '" data-formula="' + formula + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" data-v1="' + v1 + '" data-v2="' + v2 + '"  data-v3="' + v3 + '" data-v4="' + v4 + '">' +

                '<div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v1 + '"> ' +
                '<label class="">' + v1 + ':</label>' +
                '<input  class="form-control caja campo  campoV ' + vv1 + ' " data-message="' + grupo + ' - ' + v1 + '" id="V1' + idOpcion + '" type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);"> ' +
                '</div>' +
                ' <div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v2 + '"> ' +
                ' <label class="">' + v2 + ':</label> ' +
                '<input  class="form-control caja campo  campoV ' + vv2 + ' " data-message="' + grupo + ' - ' + v2 + '" id="V2' + idOpcion + '" type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v3 + '"> ' +
                '<label class="">' + v3 + ':</label> ' +
                '<input  class="form-control caja campo  campoV ' + vv3 + ' " data-message="' + grupo + ' - ' + v3 + '" id="V3' + idOpcion + '"  type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 opcionFormula" style="display:none;" data-id="' + v4 + '"> ' +
                '<label class="">' + v4 + ':</label>' +
                '<input   class="form-control caja campo  campoV ' + vv4 + ' " data-message="' + grupo + ' - ' + v4 + '" id="V4' + idOpcion + '"type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-4"> ' +
                '<label class="">' + Titulo + ' Rango(' + minimo + '-' + maximo + '):</label><span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span>' +
                '<input id="F' + idOpcion + '" class="form-control caja campo opcionCampo fuTextoChange"  type="text" step="any" placeholder="' + quitarSeparador(formula) + '"  maxlength="100"  disabled>' +
                '</div>' +

                '<div class="col-md-2 mt-3">' +
                '<img style="display:none;" id="SI' + idOpcion + '" src="../../assets/image/emoticon2.png" alt="Resultado Bueno" height="30" width="30">' +
                '<img style="display:none;" id="NO' + idOpcion + '" src="../../assets/image/emoticon1.png" alt="Resultado Malo" height="30" width="30">' +
                '</div> ';
            /*'<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
            '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
            '</div> ';*/
            totalPreguntas = totalPreguntas + 1;
            break;

        case "7":
            var tipo = Propiedades.tipo;

            opcion = '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '">' +

                '<div class="col-md-12"><label class="col-form-label">' + Titulo + ':</label><span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span></div>' +
                '<div class="form-group  col-md-4"> ' +
                '<div class="row">' +
                ' <label for="" class="col-md-2">SI</label>' +
                ' <input id="radio1" class="form-control opcion2 col-md-2 fuTextoCheck" type="radio" name="radio' + idOpcion + '" value="1">' +
                ' <label for="" class="col-md-2">NO</label>' +
                ' <input id="radio2" class="form-control opcion2 col-md-2 fuTextoCheck" type="radio" name="radio' + idOpcion + '" value="0" checked> ' +
                '  </div> ' +
                ' </div> ';
            totalPreguntas = totalPreguntas + 1;
            break;

        case "9":
            var TipoCampos = Propiedades.TipoCampo;

            opcion = '<input type="hidden" class="opcionOculto opcionCondicionCampo" id="OF' + idOpcion + '" data-tipocampo="' + TipoCampos + '">' +

                '<div class="col-md-12"><label class="col-form-label">' + Titulo + ':</label><span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span></div>' +
                '<div class="form-group col-md-4">' +
                '<div class="col-md-12 col-form-label"> ' +
                '<div class="row">' +
                ' <label for="" class="col-md-2">SI</label>' +
                ' <input id="SI' + idOpcion + '" class="form-control opcion2 col-md-2 condicion fuTextoCheck' + idOpcion + '" type="radio" name="radio' + idOpcion + '" value="1">' +
                ' <label for="" class="col-md-2">NO</label>' +
                ' <input id="NO' + idOpcion + '" class="form-control opcion2 col-md-2 condicion fuTextoCheck' + idOpcion + '" type="radio" name="radio' + idOpcion + '" value="0" checked> ' +
                '  </div> ' +
                ' </div> ' +
                '</div>' +

                '<div class="col-md-4" style="display:none;" id="area' + idOpcion + '"> <select class="form-control " data-message="' + grupo + ' - ' + Titulo + ' - Listado" id="SELECT' + idOpcion + '" name="" disabled></select></div>' +
                '<div class=" col-md-4" style="display:none;" id="DO' + idOpcion + '" ><input id="dosis' + idOpcion + '" class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="DOSIS/DIA" disabled></div>' +
                '<div class=" col-md-4" style="display:none;" id="TA' + idOpcion + '"><input id="tab' + idOpcion + '"  class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="NUM. INYECC." disabled></div>';
            totalPreguntas = totalPreguntas + 1;
            break;

        case "10":
            opcion = '<div class="col-md-12">' +
                '<h5 class="text-info"><em>' + Titulo + '</em></h5>' +
                '</div>';
            break;
        case "11":
            var TipoCampos = Propiedades.TipoCampo;

            opcion = '<input type="hidden" class="opcionOculto opcionCondicionCampo" id="OF' + idOpcion + '" data-tipocampo="' + TipoCampos + '">' +
                '<div class="col-md-12"><label class="col-form-label">' + Titulo + ':</label><span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span></div>' +
                '<div class="col-md-4" style="display:none;" id="area' + idOpcion + '"> <select class="form-control fuTextoSelect" data-message="' + grupo + ' - ' + Titulo + ' - Listado" id="SELECT' + idOpcion + '" name=""></select></div>' +
                '<div class=" col-md-4" style="display:none;" id="DO' + idOpcion + '" ><input id="dosis' + idOpcion + '" class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="DOSIS/DIA" disabled></div>' +
                '<div class=" col-md-4" style="display:none;" id="TA' + idOpcion + '"><input id="tab' + idOpcion + '"  class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="NUM. INYECC." disabled></div>';
            totalPreguntas = totalPreguntas + 1;
            break;

        case "16":
            var atributoCriterioA = "";
            var minimoCriterioA = "";
            var maximoCriterioA = "";
            var atributoCriterioB = "";
            var minimoCriterioB = "";
            var maximoCriterioB = "";
            var CriterioA = "";
            var CriterioB = "";

            atributoCriterioA = Propiedades.AtributoCriterioA;
            minimoCriterioA = Propiedades.MinimoCriterioA;
            maximoCriterioA = Propiedades.MaximoCriterioA;
            CriterioA = Propiedades.CriterioA;

            atributoCriterioB = Propiedades.AtributoCriterioB;
            minimoCriterioB = Propiedades.MinimoCriterioB;
            maximoCriterioB = Propiedades.MaximoCriterioB;
            CriterioB = Propiedades.CriterioB;


            var placeA = '';
            if (maximo == 9999) {
                placeA = '(Rango: >' + minimoCriterioA + ' ' + atributoCriterioA + ')';
            } else {
                placeA = '(Rango: ' + minimoCriterioA + ' ' + atributoCriterioA + ' - ' + maximoCriterioA + ' ' + atributoCriterioA + ')';
            }

            var placeB = '';
            if (maximo == 9999) {
                placeB = '(Rango: >' + minimoCriterioB + ' ' + atributoCriterioB + ')';
            } else {
                placeB = '(Rango: ' + minimoCriterioB + ' ' + atributoCriterioB + ' - ' + maximoCriterioB + ' ' + atributoCriterioB + ')';
            }


            opcion =
                '<input type="hidden" class="opcionOculto " id="OFA' + idOpcion + '"  data-minimo="' + minimoCriterioA + '" data-maximo="' + maximoCriterioA + '" data-sexo="' + sexo + '">' +
                '<input type="hidden" class="opcionOculto " id="OFB' + idOpcion + '"  data-minimo="' + minimoCriterioB + '" data-maximo="' + maximoCriterioB + '" data-sexo="' + sexo + '">' +

                '<div class="col-md-12">' +
                '<label class="">' + Titulo + '</label>' +
                '<span class="ml-3 badge badge-primary" title="' + Informacion + '"><i class="fa fa-info-circle fa2x"></i></span>' +
                '</div>' +

                '<div class="col-md-4">' +
                '<label>' + CriterioA + ' - Rango(' + minimoCriterioA + '' + atributoCriterioA + ' - ' + maximoCriterioA + ' ' + atributoCriterioA + '):</label>' +
                '<input id="OPA' + idOpcion + '" class="form-control  caja campo FuRango16 validar fuTextoCaja  " data-message="' + grupo + ' - ' + Titulo + '" data-id="' + idOpcion + '" data-atributo="' + atributoCriterioA + '" data-tipo="' + Tipo + '" data-minimo="' + minimoCriterioA + '" data-maximo="' + maximoCriterioA + '" data-op="A" type="text" step="any"  maxlength="100" placeholder="' + placeA + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +

                '<div class="col-md-2 mt-4">' +
                '<img style="display:none;" id="SI' + idOpcion + 'A" src="../../assets/image/emoticon2.png" alt="Resultado Bueno" height="30" width="30">' +
                '<img style="display:none;" id="NO' + idOpcion + 'A" src="../../assets/image/emoticon1.png" alt="Resultado Malo" height="30" width="30">' +
                '</div> ' +

                '<div class="col-md-12">' +
                '<label class="">' + CriterioB + ' Rango(' + minimoCriterioB + '' + atributoCriterioB + ' - ' + maximoCriterioB + ' ' + atributoCriterioB + '):</label>' +
                '</div>' +

                '<div class="col-md-4">' +
                '<input id="OPB' + idOpcion + '" class="form-control  caja campo FuRango16 validar fuTextoCaja  " data-message="' + grupo + ' - ' + Titulo + '" data-id="' + idOpcion + '" data-atributo="' + atributoCriterioB + '" data-tipo="' + Tipo + '" data-minimo="' + minimoCriterioB + '" data-maximo="' + maximoCriterioB + '" data-op="B" type="text" step="any"  maxlength="100" placeholder="' + placeB + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +

                '<div class="col-md-2 mt-1">' +
                '<img style="display:none;" id="SI' + idOpcion + 'B" src="../../assets/image/emoticon2.png" alt="Resultado Bueno" height="30" width="30">' +
                '<img style="display:none;" id="NO' + idOpcion + 'B" src="../../assets/image/emoticon1.png" alt="Resultado Malo" height="30" width="30">' +
                '</div> ';
            /*'<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
            '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
            '</div> ';*/
            totalPreguntas = totalPreguntas + 1;
            break;
    }
    return opcion;
}

function LanzarFunciones() {

    $(".OpcionGeneral").each(function () {
        var id = $(this).data("id");
        var tipo = $(this).data("tipo");
        if (tipo == 9 || tipo == 11) {

            var tipoCampos = $("#OF" + id).data("tipocampo");

            $("#SELECT" + id).select2({
                theme: 'bootstrap'
            });
            switch (tipoCampos) {
                case 1:
                    $("#area" + id).show();
                    $("#SELECT" + id).empty();
                    $("#SELECT" + id).append(Lista_Medicos);

                    break;
                case 2:
                    $("#area" + id).show();

                    $("#SELECT" + id).empty();
                    $("#SELECT" + id).append(Listas_Comorbilidad);
                    break;
                case 3:
                    $("#DO" + id).show();
                    $("#TA" + id).show();
                    break;
                case 4:
                    $("#area" + id).show();
                    $("#SELECT" + id).append(Evaluado);
                    break;
                case 5:
                    $("#area" + id).show();
                    $("#SELECT" + id).append(DiagnosticoEnfermeria);
                    break;
                case 6:
                    $("#area" + id).show();
                    $("#SELECT" + id).append(Tratamientos);
                    break;
                case 7:
                    $("#area" + id).show();
                    $("#SELECT" + id).append(Satisfaccion);
                    break;

            }

            $('#SI' + id).change(function () {
                if (this.checked == true) {

                    if (tipoCampos == 3) {
                        $("#dosis" + id).removeAttr("disabled");
                        $("#tab" + id).removeAttr("disabled");
                        $("#SELECT" + id).removeClass("validar");
                    } else {
                        $("#SELECT" + id).removeAttr("disabled");
                        $("#SELECT" + id).addClass("validar");
                    }

                } else {
                    if (tipoCampos == 3) {
                        $("#dosis" + id).attr("disabled", true);
                        $("#tab" + id).attr("disabled", true);
                        $("#SELECT" + id).addClass("validar");
                    } else {
                        $("#SELECT" + id).attr("disabled", true);
                        $("#SELECT" + id).removeClass("validar");
                    }

                }
            });
            $('#NO' + id).change(function () {
                if (this.checked == true) {

                    if (tipoCampos == 3) {
                        $("#dosis" + id).attr("disabled", true);
                        $("#tab" + id).attr("disabled", true);
                    } else {
                        $("#SELECT" + id).attr("disabled", true);
                        $("#SELECT" + id).removeClass("validar");
                    }

                } else {
                    if (tipoCampos == 3) {
                        $("#dosis" + id).removeAttr("disabled");
                        $("#tab" + id).removeAttr("disabled");
                        $("#SELECT" + id).removeClass("validar");
                    } else {
                        $("#SELECT" + id).removeAttr("disabled");
                        $("#SELECT" + id).addClass("validar");
                    }

                }
            });
        }
    });

    $(".opcionFormula").each(function () {

        var elemento = $(this);
        var id = elemento.data("id");

        if (id == "" || id == null) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });

    $(".dateFecha").each(function () {
        $(this).datepicker({
            format: 'yyyy/mm/dd',
            language: 'es'
        });
    });

    $(".FuRango").each(function () {
        var elemento = $(this);
        elemento.on('change', function () {

            var id = elemento.data("id");
            $("#SI" + id).hide();
            $("#NO" + id).hide();
            var minimo = elemento.data("minimo");
            var maximo = elemento.data("maximo");
            if (elemento.val() == "") {
                $("#SI" + id).hide();
                $("#NO" + id).hide();
            } else {
                if (elemento.val() >= minimo && elemento.val() <= maximo) {
                    $("#SI" + id).show();
                    $("#NO" + id).hide();
                } else {
                    $("#SI" + id).hide();
                    $("#NO" + id).show();
                }
            }

        });
    });

    $(".FuRango16").each(function () {
        var elemento = $(this);
        elemento.on('change', function () {

            var id = elemento.data("id");
            var opcion = elemento.data("op");
            var minimo = elemento.data("minimo");
            var maximo = elemento.data("maximo");
            if (elemento.val() == "") {
                if (opcion == "A") {
                    $("#SI" + id + "A").hide();
                    $("#NO" + id + "A").hide();
                } else {
                    $("#SI" + id + "B").hide();
                    $("#NO" + id + "B").hide();
                }

            } else {
                if (elemento.val() >= minimo && elemento.val() <= maximo) {
                    if (opcion == "A") {
                        $("#SI" + id + "A").show();
                        $("#NO" + id + "A").hide();
                    } else {
                        $("#SI" + id + "B").show();
                        $("#NO" + id + "B").hide();
                    }
                } else {
                    if (opcion == "A") {
                        $("#SI" + id + "A").hide();
                        $("#NO" + id + "A").show();
                    } else {
                        $("#SI" + id + "B").hide();
                        $("#NO" + id + "B").show();
                    }
                }
            }
        });
    });



    $(".campoV").blur(function () {

        var codigo = $(this).attr("id");
        var buscadoId = codigo.substring(2);
        var v1 = $("#V1" + buscadoId).val();
        var v2 = $("#V2" + buscadoId).val();
        var v3 = $("#V3" + buscadoId).val();
        var v4 = $("#V4" + buscadoId).val();
        var formula = $("#OF" + buscadoId).data("formula");
        var min = $("#OF" + buscadoId).data("minimo");
        var max = $("#OF" + buscadoId).data("maximo");

        examinarFormula(buscadoId, v1, v2, v3, v4, formula, min, max);
    });

    $(".fuTextoSelect").change(function () {

        VerificarPorcentajeAvance();
    });

    $('input').change(function () {

        VerificarPorcentajeAvance();
    });

}

function LanzarFuncionesEspecialidad() {
    $(".opcionEspecialidad").each(function () {

        var id = $(this).data("id");
        $('#SIE' + id).change(function () {
            if (this.checked == true) {
                $("#OptionDiag" + id).removeAttr("disabled");
                $("#OptionMedico" + id).removeAttr("disabled");
                $("#tratamiento" + id).removeAttr("disabled");
                $("#Obser" + id).removeAttr("disabled");

                $("#OptionDiag" + id).addClass("validar");
                $("#OptionMedico" + id).addClass("validar");
                $("#tratamiento" + id).addClass("validar");
                $("#Obser" + id).addClass("validar");
            } else {
                $("#OptionDiag" + id).attr("disabled", true);
                $("#OptionMedico" + id).attr("disabled", true);
                $("#tratamiento" + id).attr("disabled", true);
                $("#Obser" + id).attr("disabled", true);

                $("#OptionDiag" + id).removeClass("validar");
                $("#OptionMedico" + id).removeClass("validar");
                $("#tratamiento" + id).removeClass("validar");
                $("#Obser" + id).removeClass("validar");
            }
        });
        $('#NOE' + id).change(function () {
            if (this.checked == true) {
                $("#OptionDiag" + id).attr("disabled", true);
                $("#OptionMedico" + id).attr("disabled", true);
                $("#tratamiento" + id).attr("disabled", true);
                $("#Obser" + id).attr("disabled", true);

                $("#OptionDiag" + id).removeClass("validar");
                $("#OptionMedico" + id).removeClass("validar");
                $("#tratamiento" + id).removeClass("validar");
                $("#Obser" + id).removeClass("validar");
            } else {
                $("#OptionDiag" + id).removeAttr("disabled");
                $("#OptionMedico" + id).removeAttr("disabled");
                $("#tratamiento" + id).removeAttr("disabled");
                $("#Obser" + id).removeAttr("disabled");

                $("#OptionDiag" + id).addClass("validar");
                $("#OptionMedico" + id).addClass("validar");
                $("#tratamiento" + id).addClass("validar");
                $("#Obser" + id).addClass("validar");
            }
        });
    });
    $("#RefiereOpcion").blur(function () {
        $("#RefiereOpcion").val('"' + $("#ocultoRefiere").val() + '"');
    });
    $("#RefiereOpcion").change(function () {
        $("#ocultoRefiere").val($("#RefiereOpcion").val());
    });
    $("#RefiereOpcion").click(function () {
        $("#RefiereOpcion").val($("#ocultoRefiere").val());
    });



    //$("#paises").autocomplete({source:availableTags});
}

function examinarFormula(id, v1, v2, v3, v4, formula, min, max) {

    var resultado = "";

    var Ingresos = new Array();
    formula = quitarSeparador(formula);

    if (formula.indexOf("EXP") > -1) {
        var enco = formula.indexOf("EXP");
        var buscado = formula.substring((enco - 2), enco);
        formula = formula.replace(buscado + "EXP", "(Math.pow(" + buscado + ",2))");

    }
    if (formula.indexOf("V1") > -1) {
        formula = formula.replace(/V1/gi, verificarV(v1));
    }
    if (formula.indexOf("V2") > -1) {
        formula = formula.replace(/V2/gi, verificarV(v2));
    }
    if (formula.indexOf("V3") > -1) {
        formula = formula.replace(/V3/gi, verificarV(v3));
    }
    if (formula.indexOf("V4") > -1) {
        formula = formula.replace(/V4/gi, verificarV(v4));
    }

    var resultado = (Math.ceil(eval(formula) * 100) / 100);
    if (isNaN(resultado)) {
        $("#OF" + id).val(0);
        $("#F" + id).val(0);

    } else {
        $("#OF" + id).val(resultado);
        $("#F" + id).val(resultado);

    }

    if (resultado == "" || resultado == 0) {
        $("#SI" + id).hide();
        $("#NO" + id).hide();
    } else {
        if (resultado >= min && resultado <= max) {
            $("#SI" + id).show();
            $("#NO" + id).hide();
        } else {
            $("#SI" + id).hide();
            $("#NO" + id).show();
        }
    }
}

function verificarV(valor) {
    if (valor == "") {
        return 0;
    } else {
        return valor;
    }

}

function quitarSeparador(valor) {
    var va = valor.replace(/SEP/gi, "");
    return va;
}

function GuardarFicha() {

    var error = "";

    $(".validar").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });
    if (error == "") {
        $("#accordion").addClass("whirl");
        $("#accordion").addClass("ringed");
        setTimeout('AjaxGuardarFicha()', 2000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }

}

function AjaxGuardarFicha() {

    var ArregloOpciones = new Array();

    $(".OpcionGeneral").each(function () {

        var tipoOpcion = $(this).data("opcion");
        var id = $(this).data("id");
        var tipoTipo = $(this).data("tipo");
        var grupo = $(this).data("grupo");

        var Resultado = new Array();

        if (tipoOpcion == "OPCION") {

            switch (tipoTipo) {
                case 2:

                    var campo = $("#CAM" + id).val();
                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 2; //tipoOpcion
                    Opcion = Opcion + "#" + campo; //campo
                    Opcion = Opcion + "# "; //rESPUESTA
                    Opcion = Opcion + "# "; //Estado
                    Opcion = Opcion + "# "; //Sexo
                    Opcion = Opcion + "# "; //v1
                    Opcion = Opcion + "# "; //v2
                    Opcion = Opcion + "# "; //v3
                    Opcion = Opcion + "# "; //v4
                    Opcion = Opcion + "# "; //tipocampo
                    Opcion = Opcion + "# "; //valorcampo
                    Opcion = Opcion + "# "; //dosis
                    Opcion = Opcion + "# "; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "# "; //r1
                    Opcion = Opcion + "# "; //r2
                    Opcion = Opcion + "# "; //r3
                    Opcion = Opcion + "# "; //r4
                    Opcion = Opcion + "# "; //r5
                    Opcion = Opcion + "# "; //r6
                    Opcion = Opcion + "# "; //r7
                    Opcion = Opcion + "# "; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);
                    // console.log("ID ="+id+" tipo="+2+" CAMPO="+campo);

                    break;
                case 3:
                    var minimo = $("#OF" + id).data("minimo");
                    var maximo = $("#OF" + id).data("maximo");
                    var respuesta = $("#OP" + id).val();
                    if (respuesta == "") {
                        respuesta = 0;
                    }
                    var Estado = 0;
                    if (respuesta >= minimo && respuesta <= maximo) {
                        Estado = 1;
                    } else {
                        Estado = 0;
                    }

                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 3; //tipoOpcion
                    Opcion = Opcion + "# "; //campo
                    Opcion = Opcion + "#" + respuesta; //rESPUESTA
                    Opcion = Opcion + "#" + Estado; //Estado
                    Opcion = Opcion + "# "; //Sexo
                    Opcion = Opcion + "# "; //v1
                    Opcion = Opcion + "# "; //v2
                    Opcion = Opcion + "# "; //v3
                    Opcion = Opcion + "# "; //v4
                    Opcion = Opcion + "# "; //tipocampo
                    Opcion = Opcion + "# "; //valorcampo
                    Opcion = Opcion + "# "; //dosis
                    Opcion = Opcion + "# "; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "# "; //r1
                    Opcion = Opcion + "# "; //r2
                    Opcion = Opcion + "# "; //r3
                    Opcion = Opcion + "# "; //r4
                    Opcion = Opcion + "# "; //r5
                    Opcion = Opcion + "# "; //r6
                    Opcion = Opcion + "# "; //r7
                    Opcion = Opcion + "# "; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);
                    // console.log("ID="+id+" tipo="+3+" respuesta="+respuesta+" estado="+Estado);

                    break;
                case 4:
                    var minimo = $("#OF" + id).data("minimo");
                    var maximo = $("#OF" + id).data("maximo");
                    var sexo = $("#OF" + id).data("sexo");
                    var respuesta = $("#OP" + id).val();
                    if (respuesta == "") {
                        respuesta = 0;
                    }
                    var Estado = 0;
                    if (respuesta >= minimo && respuesta <= maximo) {
                        Estado = 1;
                    } else {
                        Estado = 0;
                    }

                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 4; //tipoOpcion
                    Opcion = Opcion + "# "; //campo
                    Opcion = Opcion + "#" + respuesta; //rESPUESTA
                    Opcion = Opcion + "#" + Estado; //Estado
                    Opcion = Opcion + "#" + sexo; //Sexo
                    Opcion = Opcion + "# "; //v1
                    Opcion = Opcion + "# "; //v2
                    Opcion = Opcion + "# "; //v3
                    Opcion = Opcion + "# "; //v4
                    Opcion = Opcion + "# "; //tipocampo
                    Opcion = Opcion + "# "; //valorcampo
                    Opcion = Opcion + "# "; //dosis
                    Opcion = Opcion + "# "; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "# "; //r1
                    Opcion = Opcion + "# "; //r2
                    Opcion = Opcion + "# "; //r3
                    Opcion = Opcion + "# "; //r4
                    Opcion = Opcion + "# "; //r5
                    Opcion = Opcion + "# "; //r6
                    Opcion = Opcion + "# "; //r7
                    Opcion = Opcion + "# "; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);
                    //console.log("ID="+id+" tipo="+4+" respuesta="+respuesta+" estado="+Estado+" Sexo="+sexo);

                    break;
                case 5:
                    var campo = $("#FE" + id).val();
                    //console.log("ID ="+id+" tipo="+5+" CAMPO="+campo);
                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 5; //tipoOpcion
                    Opcion = Opcion + "#" + campo; //campo
                    Opcion = Opcion + "# "; //rESPUESTA
                    Opcion = Opcion + "# "; //Estado
                    Opcion = Opcion + "# "; //Sexo
                    Opcion = Opcion + "# "; //v1
                    Opcion = Opcion + "# "; //v2
                    Opcion = Opcion + "# "; //v3
                    Opcion = Opcion + "# "; //v4
                    Opcion = Opcion + "# "; //tipocampo
                    Opcion = Opcion + "# "; //valorcampo
                    Opcion = Opcion + "# "; //dosis
                    Opcion = Opcion + "# "; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "# "; //r1
                    Opcion = Opcion + "# "; //r2
                    Opcion = Opcion + "# "; //r3
                    Opcion = Opcion + "# "; //r4
                    Opcion = Opcion + "# "; //r5
                    Opcion = Opcion + "# "; //r6
                    Opcion = Opcion + "# "; //r7
                    Opcion = Opcion + "# "; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);

                    break;
                case 6:
                    var minimo = $("#OF" + id).data("minimo");
                    var maximo = $("#OF" + id).data("maximo");
                    var v1 = $("#V1" + id).val();
                    var v2 = $("#V2" + id).val();
                    var v3 = $("#V3" + id).val();
                    var v4 = $("#V4" + id).val();
                    var respuesta = $("#F" + id).val();
                    var Estado = 0;
                    if (respuesta >= minimo && respuesta <= maximo) {
                        Estado = 1;
                    } else {
                        Estado = 0;
                    }

                    if (v1 == "") {
                        v1 = 0;
                    }
                    if (v2 == "") {
                        v2 = 0;
                    }
                    if (v3 == "") {
                        v3 = 0;
                    }
                    if (v4 == "") {
                        v4 = 0;
                    }
                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 6; //tipoOpcion
                    Opcion = Opcion + "# "; //campo
                    Opcion = Opcion + "#" + respuesta; //rESPUESTA
                    Opcion = Opcion + "#" + Estado; //Estado
                    Opcion = Opcion + "# "; //Sexo
                    Opcion = Opcion + "#" + v1; //v1
                    Opcion = Opcion + "#" + v2; //v2
                    Opcion = Opcion + "#" + v3; //v3
                    Opcion = Opcion + "#" + v4; //v4
                    Opcion = Opcion + "# "; //tipocampo
                    Opcion = Opcion + "# "; //valorcampo
                    Opcion = Opcion + "# "; //dosis
                    Opcion = Opcion + "# "; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "# "; //r1
                    Opcion = Opcion + "# "; //r2
                    Opcion = Opcion + "# "; //r3
                    Opcion = Opcion + "# "; //r4
                    Opcion = Opcion + "# "; //r5
                    Opcion = Opcion + "# "; //r6
                    Opcion = Opcion + "# "; //r7
                    Opcion = Opcion + "# "; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);
                    //  console.log("ID="+id+"tipo="+6+" respuesta="+respuesta+" estado="+Estado+" v1="+v1+" V3="+v2+" v3="+v3+" v4="+v4);


                    break;
                case 7:
                    var Estado = $('input[name=radio' + id + ']:checked').val();

                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 7; //tipoOpcion
                    Opcion = Opcion + "# "; //campo
                    Opcion = Opcion + "# "; //rESPUESTA
                    Opcion = Opcion + "#" + Estado; //Estado
                    Opcion = Opcion + "# "; //Sexo
                    Opcion = Opcion + "# "; //v1
                    Opcion = Opcion + "# "; //v2
                    Opcion = Opcion + "# "; //v3
                    Opcion = Opcion + "# "; //v4
                    Opcion = Opcion + "# "; //tipocampo
                    Opcion = Opcion + "# "; //valorcampo
                    Opcion = Opcion + "# "; //dosis
                    Opcion = Opcion + "# "; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "# "; //r1
                    Opcion = Opcion + "# "; //r2
                    Opcion = Opcion + "# "; //r3
                    Opcion = Opcion + "# "; //r4
                    Opcion = Opcion + "# "; //r5
                    Opcion = Opcion + "# "; //r6
                    Opcion = Opcion + "# "; //r7
                    Opcion = Opcion + "# "; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);
                    // console.log("ID="+id+" tipo="+7+" estado="+Estado);

                    break;
                case 9:

                    var tipoCampo = $("#OF" + id).data("tipocampo");
                    var Estado = $('input[name=radio' + id + ']:checked').val();
                    var select = $("#SELECT" + id).val();
                    var dosis = $("#dosis" + id).val();
                    var num = $("#tab" + id).val();

                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 9; //tipoOpcion
                    Opcion = Opcion + "# "; //campo
                    Opcion = Opcion + "# "; //rESPUESTA
                    Opcion = Opcion + "#" + Estado; //Estado
                    Opcion = Opcion + "# "; //Sexo
                    Opcion = Opcion + "# "; //v1
                    Opcion = Opcion + "# "; //v2
                    Opcion = Opcion + "# "; //v3
                    Opcion = Opcion + "# "; //v4
                    Opcion = Opcion + "#" + tipoCampo; //tipocampo
                    Opcion = Opcion + "#" + select; //valorcampo
                    Opcion = Opcion + "#" + dosis; //dosis
                    Opcion = Opcion + "#" + num; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "# "; //r1
                    Opcion = Opcion + "# "; //r2
                    Opcion = Opcion + "# "; //r3
                    Opcion = Opcion + "# "; //r4
                    Opcion = Opcion + "# "; //r5
                    Opcion = Opcion + "# "; //r6
                    Opcion = Opcion + "# "; //r7
                    Opcion = Opcion + "# "; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);
                    // console.log("ID="+id+" tipo="+9+" tipoCampo="+tipoCampo+" estado="+Estado+" dosis="+dosis+" num="+num);


                    break;
                case 11:

                    var tipoCampo = $("#OF" + id).data("tipocampo");
                    //var Estado=$('input[name=radio'+id+']:checked').val();
                    var select = $("#SELECT" + id).val();
                    var dosis = $("#dosis" + id).val();
                    var num = $("#tab" + id).val();

                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 11; //tipoOpcion
                    Opcion = Opcion + "# "; //campo
                    Opcion = Opcion + "# "; //rESPUESTA
                    Opcion = Opcion + "# "; //Estado
                    Opcion = Opcion + "# "; //Sexo
                    Opcion = Opcion + "# "; //v1
                    Opcion = Opcion + "# "; //v2
                    Opcion = Opcion + "# "; //v3
                    Opcion = Opcion + "# "; //v4
                    Opcion = Opcion + "#" + tipoCampo; //tipocampo
                    Opcion = Opcion + "#" + select; //valorcampo
                    Opcion = Opcion + "#" + dosis; //dosis
                    Opcion = Opcion + "#" + num; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "# "; //r1
                    Opcion = Opcion + "# "; //r2
                    Opcion = Opcion + "# "; //r3
                    Opcion = Opcion + "# "; //r4
                    Opcion = Opcion + "# "; //r5
                    Opcion = Opcion + "# "; //r6
                    Opcion = Opcion + "# "; //r7
                    Opcion = Opcion + "# "; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);
                    //console.log("ID=" + id + " tipo=" + 11 + " tipoCampo=" + tipoCampo + " estado=" + Estado + " dosis=" + dosis + " num=" + num);
                    break;
                case 16:
                    var minimoCriterioA = $("#OFA" + id).data("minimo");
                    var maximoCriterioA = $("#OFA" + id).data("maximo");
                    var respuestaCriterioA = $("#OPA" + id).val();

                    var minimoCriterioB = $("#OFB" + id).data("minimo");
                    var maximoCriterioB = $("#OFB" + id).data("maximo");
                    var respuestaCriterioB = $("#OPB" + id).val();

                    if (respuestaCriterioA == "") {
                        respuestaCriterioA = 0;
                    }
                    if (respuestaCriterioB == "") {
                        respuestaCriterioB = 0;
                    }
                    var EstadoCriterioA = 0;
                    if (respuestaCriterioA >= minimoCriterioA && respuestaCriterioA <= maximoCriterioA) {
                        EstadoCriterioA = 1;
                    } else {
                        EstadoCriterioA = 0;
                    }
                    var EstadoCriterioB = 0;
                    if (respuestaCriterioB >= minimoCriterioB && respuestaCriterioB <= maximoCriterioB) {
                        EstadoCriterioB = 1;
                    } else {
                        EstadoCriterioB = 0;
                    }
                    var Estado = 0;
                    if (EstadoCriterioA == 1 && EstadoCriterioB == 1) {
                        Estado = 1;
                    } else {
                        Estado = 0;
                    }

                    var Opcion = "";
                    Opcion = Opcion + "" + id; //id
                    Opcion = Opcion + "#OPCION"; //Gneral
                    Opcion = Opcion + "#" + 16; //tipoOpcion
                    Opcion = Opcion + "# "; //campo
                    Opcion = Opcion + "# "; //RESPUESTA
                    Opcion = Opcion + "#" + Estado; //Estado
                    Opcion = Opcion + "# "; //Sexo
                    Opcion = Opcion + "# "; //v1
                    Opcion = Opcion + "# "; //v2
                    Opcion = Opcion + "# "; //v3
                    Opcion = Opcion + "# "; //v4
                    Opcion = Opcion + "# "; //tipocampo
                    Opcion = Opcion + "# "; //valorcampo
                    Opcion = Opcion + "# "; //dosis
                    Opcion = Opcion + "# "; //numero
                    Opcion = Opcion + "# "; //diagnostico
                    Opcion = Opcion + "# "; //medico
                    Opcion = Opcion + "# "; //tratamiento
                    Opcion = Opcion + "# "; //observacion
                    Opcion = Opcion + "#" + respuestaCriterioA; //r1
                    Opcion = Opcion + "#" + EstadoCriterioA; //r2
                    Opcion = Opcion + "#" + minimoCriterioA; //r3
                    Opcion = Opcion + "#" + maximoCriterioA; //r4
                    Opcion = Opcion + "#" + respuestaCriterioB; //r5
                    Opcion = Opcion + "#" + EstadoCriterioB; //r6
                    Opcion = Opcion + "#" + maximoCriterioB; //r7
                    Opcion = Opcion + "#" + maximoCriterioB; //r8
                    Opcion = Opcion + "#" + grupo; //grupo
                    ArregloOpciones.push(Opcion);
                    //console.log("ID="+id+" tipo="+4+" respuesta="+respuesta+" estado="+Estado+" Sexo="+sexo);
                    console.log(Opcion);
                    break;

            }

        } else if (tipoOpcion == "ESPECIALIDAD") {

            var Estado = $('input[name=radioE' + id + ']:checked').val();
            var diagnostico = $("#OptionDiag" + id).val();
            var medico = $("#OptionMedico" + id).val();
            var tratamiento = $("#tratamiento" + id).val();
            var observacion = $("#Obser" + id).val();

            var Opcion = "";
            Opcion = Opcion + "" + id; //id - 0
            Opcion = Opcion + "#ESPECIALIDAD"; //Gneral - 1
            Opcion = Opcion + "# "; //tipoOpcion - 2
            Opcion = Opcion + "# "; //campo -3
            Opcion = Opcion + "# "; //rESPUESTA -4
            Opcion = Opcion + "#" + Estado; //Estado -5
            Opcion = Opcion + "# "; //Sexo -6
            Opcion = Opcion + "# "; //v1 -7
            Opcion = Opcion + "# "; //v2 -8
            Opcion = Opcion + "# "; //v3 -9
            Opcion = Opcion + "# "; //v4 -10
            Opcion = Opcion + "# "; //tipocampo -11
            Opcion = Opcion + "# "; //valorcampo -12
            Opcion = Opcion + "# "; //dosis -13
            Opcion = Opcion + "# "; //numero -14
            Opcion = Opcion + "#" + diagnostico; //diagnostico -15
            Opcion = Opcion + "#" + medico; //medico -16
            Opcion = Opcion + "#" + tratamiento; //tratamiento -17
            Opcion = Opcion + "#" + observacion; //observacion -18
            Opcion = Opcion + "# "; //r1 -19
            Opcion = Opcion + "# "; //r2 -20
            Opcion = Opcion + "# "; //r3 -21
            Opcion = Opcion + "# "; //r4 -22
            Opcion = Opcion + "# "; //r5 -23
            Opcion = Opcion + "# "; //r6 -24
            Opcion = Opcion + "# "; //r7 -25
            Opcion = Opcion + "# "; //r8 -26
            Opcion = Opcion + "# "; //grupo -27
            ArregloOpciones.push(Opcion);
            // console.log("ID ="+id+" Estado="+Estado+" Diag="+diagnostico+" Medico="+medico+" Tratamiento="+tratamiento+" Obsr="+observacion);
        }

    });


    var hijo1 = $("#OpcionPieN1").children("div");
    var resu1 = hijo1.data("opcion");
    var hijo2 = $("#OpcionPieN2").children("div");
    var resu2 = hijo2.data("opcion");
    var hijo3 = $("#OpcionPieN3").children("div");
    var resu3 = hijo3.data("opcion");
    var hijo4 = $("#OpcionPieN4").children("div");
    var resu4 = hijo4.data("opcion");
    var hijo5 = $("#OpcionPieN5").children("div");
    var resu5 = hijo5.data("opcion");
    var hijo6 = $("#OpcionPieN6").children("div");
    var resu6 = hijo6.data("opcion");
    var hijo7 = $("#OpcionPieN7").children("div");
    var resu7 = hijo7.data("opcion");
    var hijo8 = $("#OpcionPieN8").children("div");
    var resu8 = hijo8.data("opcion");


    var Opcion = "";
    Opcion = Opcion + " "; //id
    Opcion = Opcion + "#PIE"; //Gneral
    Opcion = Opcion + "# "; //tipoOpcion
    Opcion = Opcion + "# "; //campo
    Opcion = Opcion + "# "; //rESPUESTA
    Opcion = Opcion + "# "; //Estado
    Opcion = Opcion + "# "; //Sexo
    Opcion = Opcion + "# "; //v1
    Opcion = Opcion + "# "; //v2
    Opcion = Opcion + "# "; //v3
    Opcion = Opcion + "# "; //v4
    Opcion = Opcion + "# "; //tipocampo
    Opcion = Opcion + "# "; //valorcampo
    Opcion = Opcion + "# "; //dosis
    Opcion = Opcion + "# "; //numero
    Opcion = Opcion + "# "; //diagnostico
    Opcion = Opcion + "# "; //medico
    Opcion = Opcion + "# "; //tratamiento
    Opcion = Opcion + "# "; //observacion
    Opcion = Opcion + "#" + resu1; //r1
    Opcion = Opcion + "#" + resu2; //r2
    Opcion = Opcion + "#" + resu3; //r3
    Opcion = Opcion + "#" + resu4; //r4
    Opcion = Opcion + "#" + resu5; //r5
    Opcion = Opcion + "#" + resu6; //r6
    Opcion = Opcion + "#" + resu7; //r7
    Opcion = Opcion + "#" + resu8; //r8
    Opcion = Opcion + "# "; //grupo
    ArregloOpciones.push(Opcion);
    // console.log("RESULTADO PIE: R1="+resu1+" R2="+resu2+" R3="+resu3+" R4="+resu4+" R5="+resu5+" R6="+resu6+" R7="+resu7+" R8="+resu8);

    var opA1 = 0,
        opA2 = 0,
        opA3 = 0,
        opA4 = 0;
    ($('#opA1').prop('checked')) ? opA1 = 1: opA1 = 0;
    ($('#opA2').prop('checked')) ? opA2 = 1: opA2 = 0;
    ($('#opA3').prop('checked')) ? opA3 = 1: opA3 = 0;
    ($('#opA4').prop('checked')) ? opA4 = 1: opA4 = 0;
    var opB1 = 0,
        opB2 = 0,
        opB3 = 0,
        opB4 = 0;
    ($('#opB1').prop('checked')) ? opB1 = 1: opB1 = 0;
    ($('#opB2').prop('checked')) ? opB2 = 1: opB2 = 0;
    ($('#opB3').prop('checked')) ? opB3 = 1: opB3 = 0;
    ($('#opB4').prop('checked')) ? opB4 = 1: opB4 = 0;
    var opC1 = 0,
        opC2 = 0,
        opC3 = 0,
        opC4 = 0;
    ($('#opC1').prop('checked')) ? opC1 = 1: opC1 = 0;
    ($('#opC2').prop('checked')) ? opC2 = 1: opC2 = 0;
    ($('#opC3').prop('checked')) ? opC3 = 1: opC3 = 0;
    ($('#opC4').prop('checked')) ? opC4 = 1: opC4 = 0;

    var opD1 = 0,
        opD2 = 0;
    ($('#opD1').prop('checked')) ? opD1 = 1: opD1 = 0;
    ($('#opD2').prop('checked')) ? opD2 = 1: opD2 = 0;
    var opE1 = 0,
        opE2 = 0;
    ($('#opE1').prop('checked')) ? opE1 = 1: opE1 = 0;
    ($('#opE2').prop('checked')) ? opE2 = 1: opE2 = 0;

    var Respuestas = '{"opA1":' + opA1 + ',"opA2":' + opA2 + ',"opA3":' + opA3 + ',"opA4":' + opA4 + ',"opB1":' + opB1 + ',"opB2":' + opB2 + ',"opB3":' + opB3 + ',"opB4":' + opB4 + ',"opC1":' + opC1 + ',"opC2":' + opC2 + ',"opC3":' + opC3 + ',"opC4":' + opC4 + ',"opD1":' + opD1 + ',"opD2":' + opD2 + ',"opE1":' + opE1 + ',"opE2":' + opE2 + '}';



    var respuestaRefiere = $("#ocultoRefiere").val();
    var Opcion = "";
    Opcion = Opcion + " "; //id
    Opcion = Opcion + "#REFIERE"; //Gneral
    Opcion = Opcion + "# "; //tipoOpcion
    Opcion = Opcion + "#" + Respuestas; //campo
    Opcion = Opcion + "#" + respuestaRefiere; //rESPUESTA
    Opcion = Opcion + "# "; //Estado
    Opcion = Opcion + "# "; //Sexo
    Opcion = Opcion + "# "; //v1
    Opcion = Opcion + "# "; //v2
    Opcion = Opcion + "# "; //v3
    Opcion = Opcion + "# "; //v4
    Opcion = Opcion + "# "; //tipocampo
    Opcion = Opcion + "# "; //valorcampo
    Opcion = Opcion + "# "; //dosis
    Opcion = Opcion + "# "; //numero
    Opcion = Opcion + "# "; //diagnostico
    Opcion = Opcion + "# "; //medico
    Opcion = Opcion + "# "; //tratamiento
    Opcion = Opcion + "# "; //observacion
    Opcion = Opcion + "# "; //r1
    Opcion = Opcion + "# "; //r2
    Opcion = Opcion + "# "; //r3
    Opcion = Opcion + "# "; //r4
    Opcion = Opcion + "# "; //r5
    Opcion = Opcion + "# "; //r6
    Opcion = Opcion + "# "; //r7
    Opcion = Opcion + "# "; //r8
    Opcion = Opcion + "# "; //grupo

    ArregloOpciones.push(Opcion);

    var OpcionesR = ArregloOpciones.join('|');


    var idPaciente = $("#idPaciente").val();
    var idAno = $("#idAno").val();
    var idMes = $("#idMes").val();

    $.post("../../controlador/Gestion/CFicha.php?op=GuardarFicha", {
        OpcionesR: OpcionesR,
        idPaciente: idPaciente,
        idAno: idAno,
        idMes: idMes
    }, function (data, status) {
        data = JSON.parse(data);
        console.log(data);

        var Registro = data.Registro;
        var Mensaje = data.Mensaje;
        if (Registro) {
            $("#accordion").removeClass("whirl");
            $("#accordion").removeClass("ringed");
            swal({
                title: "Registro",
                text: "Se Registro Correctamente!",
                type: "info",
                showCancelButton: false,
                confirmButtonColor: "#27c24c",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            }, function () {
                $.redirect('../../vista/Operaciones/GestionFicha.php', {
                    'idPaciente': idPaciente
                });
            });
        } else {
            notificar_danger(Mensaje);
        }
    });
}

function VolverGestion(idPaciente) {
    $.redirect('../../vista/Operaciones/GestionFicha.php', {
        'idPaciente': idPaciente
    });
}

function VerificarPorcentajeAvance() {
    //totalPreguntas
    var totalCompleta = 0;
    $(".OpcionGeneral").each(function () {
        var tipoOpcion = $(this).data("opcion");
        var id = $(this).data("id");
        var tipoTipo = $(this).data("tipo");
        var grupo = $(this).data("grupo");

        if (tipoOpcion == "OPCION") {
            switch (tipoTipo) {
                case 2:
                    var campo = $("#CAM" + id).val();
                    if (campo.length > 0) {
                        totalCompleta++;
                    }
                    break;
                case 3:
                    var minimo = $("#OF" + id).data("minimo");
                    var maximo = $("#OF" + id).data("maximo");
                    var respuesta = $("#OP" + id).val();
                    if (respuesta == "") {
                        respuesta = 0;
                    }
                    var Estado = 0;
                    if (respuesta >= minimo && respuesta <= maximo) {
                        Estado = 1;
                        totalCompleta++;
                    } else {
                        Estado = 0;
                    }

                    break;
                case 4:
                    var minimo = $("#OF" + id).data("minimo");
                    var maximo = $("#OF" + id).data("maximo");
                    var sexo = $("#OF" + id).data("sexo");
                    var respuesta = $("#OP" + id).val();
                    if (respuesta == "") {
                        respuesta = 0;
                    }
                    var Estado = 0;
                    if (respuesta >= minimo && respuesta <= maximo) {
                        Estado = 1;
                        totalCompleta++;
                    } else {
                        Estado = 0;
                    }


                    break;
                case 5:
                    var campo = $("#FE" + id).val();
                    if (campo.length > 0) {
                        totalCompleta++;
                    }
                    break;
                case 6:
                    var minimo = $("#OF" + id).data("minimo");
                    var maximo = $("#OF" + id).data("maximo");
                    var v1 = $("#V1" + id).val();
                    var v2 = $("#V2" + id).val();
                    var v3 = $("#V3" + id).val();
                    var v4 = $("#V4" + id).val();
                    var respuesta = $("#F" + id).val();
                    var Estado = 0;
                    if (respuesta >= minimo && respuesta <= maximo) {
                        Estado = 1;
                        totalCompleta++;
                    } else {
                        Estado = 0;
                    }

                    if (v1 == "") {
                        v1 = 0;
                    }
                    if (v2 == "") {
                        v2 = 0;
                    }
                    if (v3 == "") {
                        v3 = 0;
                    }
                    if (v4 == "") {
                        v4 = 0;
                    }

                    break;
                case 7:
                    var Estado = $('input[name=radio' + id + ']:checked').val();
                    if (Estado == 1) {
                        totalCompleta++;
                    }

                    break;
                case 9:

                    var tipoCampo = $("#OF" + id).data("tipocampo");
                    var Estado = $('input[name=radio' + id + ']:checked').val();
                    var select = $("#SELECT" + id).val();
                    var dosis = $("#dosis" + id).val();
                    var num = $("#tab" + id).val();

                    if (Estado == 1) {
                        totalCompleta++;
                    }

                    break;
                case 11:

                    var tipoCampo = $("#OF" + id).data("tipocampo");
                    //var Estado=$('input[name=radio'+id+']:checked').val();
                    var select = $("#SELECT" + id).val();
                    var dosis = $("#dosis" + id).val();
                    var num = $("#tab" + id).val();

                    if (select > 0) {
                        totalCompleta++;
                    }

                    break;
                case 16:
                    var minimoCriterioA = $("#OFA" + id).data("minimo");
                    var maximoCriterioA = $("#OFA" + id).data("maximo");
                    //var sexo = $("#OFA" + id).data("sexo");
                    var respuestaCriterioA = $("#OPA" + id).val();

                    var minimoCriterioB = $("#OFB" + id).data("minimo");
                    var maximoCriterioB = $("#OFB" + id).data("maximo");
                    //var sexo = $("#OFA" + id).data("sexo");
                    var respuestaCriterioB = $("#OPB" + id).val();

                    if (respuestaCriterioA == "") {
                        respuestaCriterioA = 0;
                    }
                    if (respuestaCriterioB == "") {
                        respuestaCriterioB = 0;
                    }
                    var Estado = 0;
                    if ((respuestaCriterioA >= minimoCriterioA && respuestaCriterioA <= maximoCriterioA) && (respuestaCriterioB >= minimoCriterioB && respuestaCriterioB <= maximoCriterioB)) {
                        Estado = 1;
                        totalCompleta++;
                    } else {
                        Estado = 0;
                    }


                    break;
            }
            var porcentaje = parseFloat((totalCompleta * 100) / totalPreguntas).toFixed(2);
            totalAvance.empty();
            totalAvance.text(porcentaje + "%");
        }
    });
}


init();
