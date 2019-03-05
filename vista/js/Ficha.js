var sexo;
var Lista_Medicos;
var Listas_Comorbilidad;
var DiagnosticoEnfermeria;
var Tratamientos;
var Evaluado;

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
            if ($(this).data("opcion") == 1) {
                $(this).removeClass("Option");
                $(this).addClass("OptionX");
                $(this).data("opcion", 2);
                $(this).html("<span>X</span>");

            } else if ($(this).data("opcion") == 2) {
                $(this).removeClass("OptionX");
                $(this).addClass("OptionFull");
                $(this).data("opcion", 3);
                $(this).empty();

            } else if ($(this).data("opcion") == 3) {
                $(this).removeClass("OptionFull");
                $(this).addClass("Option");
                $(this).data("opcion", 1);
            }
        });
    });
}

function RecuperarEspecialidades() {
    $("#bloqueEspecialidades")
    $.post("../../controlador/Gestion/CFicha.php?op=RecuperarEspecialidades", function (data, status) {
        data = JSON.parse(data);

        $.post("../../controlador/Gestion/CFicha.php?op=ListarDiagnosticos", function (ts) {
            var diagnosticos = ts;
            var query = "";
            data.forEach(function (element) {

                var idEspecialidad = element.id;
                var especialidad = element.especialidad;
                var medicos = element.medicos;

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
                    '<label for="OpcionTipoCampo" class="col-form-label">Diagnosticos:</label>' +
                    '<select class="form-control" id="OptionDiag' + idEspecialidad + '" data-message="'+especialidad+' - Diagnostico" name="OpcionTipoCampo" disabled>' +
                    diagnosticos + '</select>' +
                    ' </div>' +
                    ' </div>' +
                    '<div class="col-md-2">' +
                    ' <div class="form-group">' +
                    ' <label for="OpcionTipoCampo" class="col-form-label">Medico:</label>' +
                    '<select class="form-control  " id="OptionMedico' + idEspecialidad + '" data-message="'+especialidad+' - Medico" name="OpcionTipoCampo"  disabled>' + medicos +

                    '</select>' +
                    '</div>' +
                    ' </div>' +
                    '<div class="col-md-2">' +
                    ' <div class="form-group">' +
                    ' <label for="" class="col-form-label">Tratamiento:</label>' +
                    ' <input type="text" class="form-control"  data-message="'+especialidad+' - Tratamiento" id="tratamiento' + idEspecialidad + '" disabled>' +
                    '</div>' +
                    '</div>' +
                    ' <div class="col-md-2">' +
                    ' <div class="form-group">' +
                    '<label for="" class="col-form-label">Observaciones:</label>' +
                    ' <input type="text" class="form-control" data-message="'+especialidad+' - Observaciones" id="Obser' + idEspecialidad + '" disabled>' +
                    '</div>' +
                    '</div>' +
                    ' </div>';
            });

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
                grupoOpcion = grupoOpcion + '<div class="row mt-1 ml-5 OpcionGeneral" data-id="' + idOpcion + '" data-tipo="' + Tipo + '" data-opcion="OPCION">';
                var OpcionSet = RecuperarTipoOpcion(element2, contador++,grupo);
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
        var pie = ' <div class="card border-primary mb-1">' +
            '<div class="card-header text-white bg-primary" id="headingTwo">' +
            '<h4 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" href="">EXAMEN DE PIE</a>' +
            ' </h4>' +
            '</div>' +
            ' <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">' +
            ' <div class="card-body border-top">' +
            '<div class="row" >' +
            ' <div class="col-md-9 offset-3 padre">' +
            ' <div class="ImagenPie">' +
            ' <div class="OpcionPie1" id="OpcionPieN1">' +
            ' <div class="opciones Option" data-opcion="1">' +
            '</div>' +
            ' </div>' +
            '<div class="OpcionPie2" id="OpcionPieN2">' +
            '<div class="opciones Option" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie3" id="OpcionPieN3">' +
            '<div class="opciones Option" data-opcion="1">' +
            '</div>' +
            '</div>' +
            ' <div class="OpcionPie4" id="OpcionPieN4">' +
            '<div class="opciones Option" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie5" id="OpcionPieN5">' +
            ' <div class="opciones Option" data-opcion="1">' +

            '</div>' +
            ' </div>' +
            ' <div class="OpcionPie6" id="OpcionPieN6">' +
            '<div class="opciones Option" data-opcion="1">' +
            '</div>' +
            '</div>' +
            ' <div class="OpcionPie7" id="OpcionPieN7">' +
            '<div class="opciones Option" data-opcion="1">' +
            '</div>' +
            '</div>' +
            '<div class="OpcionPie8" id="OpcionPieN8">' +
            ' <div class="opciones Option" data-opcion="1">' +
            ' </div>' +
            '</div>' +
            '</div>' +
            ' </div>' +
            ' </div>' +
            '</div>' +
            '</div>' +
            '</div>';
        Html = Html + especialidades;
        Html = Html + pie;
        $("#accordion").html(Html);

        LanzarFunciones();
        LanzarFuncionOpcionesPie();
    });
}

function RecuperarTipoOpcion(elemento, contador,grupo) {

    var idOpcion = elemento.id;
    var Titulo = elemento.titulo;

    var Propiedades = elemento.propiedades.replace(/&quot;/g, '\"');
    var Propiedades = JSON.parse(Propiedades);
    var Tipo = elemento.tipo;

    grupo="";
    var opcion = "";
    switch (Tipo) {
        case "1":
            opcion = '<div class="col-md-12">' +
                '<h4 class="text-info"><u>' + Titulo + ':</u></h4>' +
                '</div>';
            break;
        case "2":
            opcion = '<div class="col-md-4">' +
                '<label class="">' + Titulo + ':</label>' +
                '<input id="CAM' + idOpcion + '" class="form-control  caja campo opcionCampo" data-tipo="' + Tipo + '" type="text" step="any"  maxlength="100">' +
                '</div>';
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

                '<div class="col-md-12"><label class="">' + Titulo + '(' + atributo + '):</label></div>' +
                '<div class="col-md-4">' +
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango validar" data-message="'+grupo+' - '+Titulo+'" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2">' +
                '<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
                '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
                '</div> ';

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
            } else {
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
                '<div class="col-md-12"><label class="">' + Titulo + '(' + atributo + ') - ' + paciente + ':</label></div>' +
                '<div class="col-md-4">' +
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango validar" data-message="'+grupo+' - '+Titulo+'" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 ">' +
                '<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
                '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
                '</div> ';

            break;
        case "5":

            opcion = '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '" >' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                ' <label for="" class="col-form-label">' + Titulo + ':</label>' +
                '<div class="input-group date dateFecha">' +
                ' <input class="form-control opcionFecha validar" type="text" id="FE' + idOpcion + '" data-message="'+grupo+' - '+Titulo+'" data-tipo="' + Tipo + '" data-id="' + idOpcion + '" autocomplete="off">' +
                ' <span class="input-group-append input-group-addon">' +
                '     <span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>' +
                ' </span>' +
                '</div>' +
                '</div>' +
                '</div>';

            break;
        case "6":
            var v1 = Propiedades.variable1;
            var v2 = Propiedades.variable2;
            var v3 = Propiedades.variable3;
            var v4 = Propiedades.variable4;
            var formula = Propiedades.Formula;
            var minimo = Propiedades.minimo;
            var maximo = Propiedades.maximo;
            var vv1="";
            (v1=="")? vv1="":vv1="validar";
            var vv2="";
            (v2=="")? vv2="":vv2="validar";
            var vv3="";
            (v3=="")? vv3="":vv3="validar";
            var vv4="";
            (v4=="")? vv4="":vv4="validar";

            opcion =
                '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '" data-formula="' + formula + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" data-v1="'+v1+'" data-v2="'+v2+'"  data-v3="'+v3+'" data-v4="'+v4+'">' +

                '<div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v1 + '"> ' +
                '<label class="">' + v1 + ':</label>' +
                '<input  class="form-control caja campo  campoV '+vv1+' " data-message="'+grupo+' - '+v1+'" id="V1' + idOpcion + '" type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);"> ' +
                '</div>' +
                ' <div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v2 + '"> ' +
                ' <label class="">' + v2 + ':</label> ' +
                '<input  class="form-control caja campo  campoV '+vv2+' " data-message="'+grupo+' - '+v2+'" id="V2' + idOpcion + '" type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v3 + '"> ' +
                '<label class="">' + v3 + ':</label> ' +
                '<input  class="form-control caja campo  campoV '+vv3+' " data-message="'+grupo+' - '+v3+'" id="V3' + idOpcion + '"  type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 opcionFormula" style="display:none;" data-id="' + v4 + '"> ' +
                '<label class="">' + v4 + ':</label>' +
                '<input   class="form-control caja campo  campoV '+vv4+' " data-message="'+grupo+' - '+v4+'" id="V4' + idOpcion + '"type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-4"> ' +
                '<label class="">' + Titulo + ' Rango(' + minimo + '-' + maximo + '):</label>' +
                '<input id="F' + idOpcion + '" class="form-control caja campo opcionCampo "  type="text" step="any" placeholder="' + quitarSeparador(formula) + '"  maxlength="100"  disabled>' +
                '</div>' +

                '<div class="col-md-2 mt-4">' +
                '<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
                '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
                '</div> ';

            break;

        case "7":
            var tipo = Propiedades.tipo;

            opcion = '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '">' +

                '<div class="col-md-12"><label class="col-form-label">' + Titulo + ':</label></div>' +
                '<div class="form-group  col-md-4"> ' +
                '<div class="row">' +
                ' <label for="" class="col-md-2">SI</label>' +
                ' <input id="radio1" class="form-control opcion2 col-md-2" type="radio" name="radio' + idOpcion + '" value="1">' +
                ' <label for="" class="col-md-2">NO</label>' +
                ' <input id="radio2" class="form-control opcion2 col-md-2" type="radio" name="radio' + idOpcion + '" value="0" checked> ' +
                '  </div> ' +
                ' </div> ';

            break;

        case "9":
            var TipoCampos = Propiedades.TipoCampo;

            opcion = '<input type="hidden" class="opcionOculto opcionCondicionCampo" id="OF' + idOpcion + '" data-tipocampo="' + TipoCampos + '">' +

                '<div class="col-md-12"><label class="col-form-label">' + Titulo + ':</label></div>' +
                '<div class="form-group col-md-4">' +
                '<div class="col-md-12 col-form-label"> ' +
                '<div class="row">' +
                ' <label for="" class="col-md-2">SI</label>' +
                ' <input id="SI' + idOpcion + '" class="form-control opcion2 col-md-2 condicion' + idOpcion + '" type="radio" name="radio' + idOpcion + '" value="1">' +
                ' <label for="" class="col-md-2">NO</label>' +
                ' <input id="NO' + idOpcion + '" class="form-control opcion2 col-md-2 condicion' + idOpcion + '" type="radio" name="radio' + idOpcion + '" value="0" checked> ' +
                '  </div> ' +
                ' </div> ' +
                '</div>' +
<<<<<<< HEAD
                '<div class="col-md-4" style="display:none;" id="area' + idOpcion + '"> <select class="form-control " id="SELECT' + idOpcion + '" name="" disabled></select></div>' +
                '<div class=" col-md-4" style="display:none;" id="DO' + idOpcion + '" ><input id="dosis' + idOpcion + '" class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="DOSIS/DIA" disabled></div>' +
                '<div class=" col-md-4" style="display:none;" id="TA' + idOpcion + '"><input id="tab' + idOpcion + '"  class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="NUM. INYECC." disabled></div>';
=======
                '<div class="col-md-4" style="display:none;" id="area'+idOpcion+'"> <select class="form-control " data-message="'+grupo+' - '+Titulo+' - Listado" id="SELECT' + idOpcion + '" name="" disabled></select></div>'+
                '<div class=" col-md-4" style="display:none;" id="DO' + idOpcion + '" ><input id="dosis'+idOpcion+'" class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="DOSIS/DIA" disabled></div>'+
                '<div class=" col-md-4" style="display:none;" id="TA' + idOpcion + '"><input id="tab'+idOpcion+'"  class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="NUM. INYECC." disabled></div>';
>>>>>>> origin/master
            break;

        case "10":
            opcion = '<div class="col-md-12">' +
                '<h5 class="text-info"><em>' + Titulo + '</em></h5>' +
                '</div>';

            break;
    }
    return opcion;
}

function LanzarFunciones() {

    $(".OpcionGeneral").each(function () {
        var id = $(this).data("id");
        var tipo = $(this).data("tipo");
        if (tipo == 9) {

            var tipoCampos = $("#OF" + id).data("tipocampo");

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

            }

            $('#SI' + id).change(function () {
                if (this.checked == true) {
<<<<<<< HEAD
                    if (tipoCampos == 3) {
                        $("#dosis" + id).removeAttr("disabled");
                        $("#tab" + id).removeAttr("disabled");
                    } else {
                        $("#SELECT" + id).removeAttr("disabled");
                    }

                } else {
                    if (tipoCampos == 3) {
                        $("#dosis" + id).attr("disabled", true);
                        $("#tab" + id).attr("disabled", true);
                    } else {
                        $("#SELECT" + id).attr("disabled", true);
=======
                    if(tipoCampos==3){
                         $("#dosis"+id).removeAttr("disabled");
                         $("#tab"+id).removeAttr("disabled");
                         $("#SELECT"+id).removeClass("validar");
                    }else{
                        $("#SELECT"+id).removeAttr("disabled");
                        $("#SELECT"+id).addClass("validar");
                    }

                } else {
                    if(tipoCampos==3){
                         $("#dosis"+id).attr("disabled",true);
                         $("#tab"+id).attr("disabled",true);
                         $("#SELECT"+id).addClass("validar");
                    }else{
                       $("#SELECT"+id).attr("disabled",true);
                       $("#SELECT"+id).removeClass("validar");
>>>>>>> origin/master
                    }

                }
            });
            $('#NO' + id).change(function () {
                if (this.checked == true) {
<<<<<<< HEAD
                    if (tipoCampos == 3) {
                        $("#dosis" + id).attr("disabled", true);
                        $("#tab" + id).attr("disabled", true);
                    } else {
                        $("#SELECT" + id).attr("disabled", true);
                    }

                } else {
                    if (tipoCampos == 3) {
                        $("#dosis" + id).removeAttr("disabled");
                        $("#tab" + id).removeAttr("disabled");
                    } else {
                        $("#SELECT" + id).removeAttr("disabled");
=======
                    if(tipoCampos==3){
                          $("#dosis"+id).attr("disabled",true);
                         $("#tab"+id).attr("disabled",true);
                    }else{
                       $("#SELECT"+id).attr("disabled",true);
                       $("#SELECT"+id).removeClass("validar");
                    }

                } else {
                    if(tipoCampos==3){
                         $("#dosis"+id).removeAttr("disabled");
                         $("#tab"+id).removeAttr("disabled");
                         $("#SELECT"+id).removeClass("validar");
                    }else{
                       $("#SELECT"+id).removeAttr("disabled");
                         $("#SELECT"+id).addClass("validar");
>>>>>>> origin/master
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
            var tipo = elemento.data("tipo");

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


}

function LanzarFuncionesEspecialidad() {
    $(".opcionEspecialidad").each(function () {

<<<<<<< HEAD
        var id = $(this).data("id");
        $('#SIE' + id).change(function () {
            if (this.checked == true) {
                $("#OptionDiag" + id).removeAttr("disabled");
                $("#OptionMedico" + id).removeAttr("disabled");
                $("#tratamiento" + id).removeAttr("disabled");
                $("#Obser" + id).removeAttr("disabled");
            } else {
                $("#OptionDiag" + id).attr("disabled", true);
                $("#OptionMedico" + id).attr("disabled", true);
                $("#tratamiento" + id).attr("disabled", true);
                $("#Obser" + id).attr("disabled", true);
            }
        });
        $('#NOE' + id).change(function () {
            if (this.checked == true) {
                $("#OptionDiag" + id).attr("disabled", true);
                $("#OptionMedico" + id).attr("disabled", true);
                $("#tratamiento" + id).attr("disabled", true);
                $("#Obser" + id).attr("disabled", true);

            } else {
                $("#OptionDiag" + id).removeAttr("disabled");
                $("#OptionMedico" + id).removeAttr("disabled");
                $("#tratamiento" + id).removeAttr("disabled");
                $("#Obser" + id).removeAttr("disabled");
            }
        });
    });
=======
          var id = $(this).data("id");
           $('#SIE'+id).change(function () {
                if (this.checked == true) {
                    $("#OptionDiag"+id).removeAttr("disabled");
                    $("#OptionMedico"+id).removeAttr("disabled");
                    $("#tratamiento"+id).removeAttr("disabled");
                    $("#Obser"+id).removeAttr("disabled");

                     $("#OptionDiag"+id).addClass("validar");
                    $("#OptionMedico"+id).addClass("validar");
                     $("#tratamiento"+id).addClass("validar");
                    $("#Obser"+id).addClass("validar");
                } else {
                     $("#OptionDiag"+id).attr("disabled",true);
                    $("#OptionMedico"+id).attr("disabled",true);
                    $("#tratamiento"+id).attr("disabled",true);
                    $("#Obser"+id).attr("disabled",true);

                     $("#OptionDiag"+id).removeClass("validar");
                    $("#OptionMedico"+id).removeClass("validar");
                     $("#tratamiento"+id).removeClass("validar");
                    $("#Obser"+id).removeClass("validar");
                }
            });
            $('#NOE'+id).change(function () {
                if (this.checked == true) {
                     $("#OptionDiag"+id).attr("disabled",true);
                    $("#OptionMedico"+id).attr("disabled",true);
                    $("#tratamiento"+id).attr("disabled",true);
                    $("#Obser"+id).attr("disabled",true);

                    $("#OptionDiag"+id).removeClass("validar");
                    $("#OptionMedico"+id).removeClass("validar");
                     $("#tratamiento"+id).removeClass("validar");
                    $("#Obser"+id).removeClass("validar");
                } else {
                  $("#OptionDiag"+id).removeAttr("disabled");
                    $("#OptionMedico"+id).removeAttr("disabled");
                    $("#tratamiento"+id).removeAttr("disabled");
                    $("#Obser"+id).removeAttr("disabled");

                    $("#OptionDiag"+id).addClass("validar");
                    $("#OptionMedico"+id).addClass("validar");
                     $("#tratamiento"+id).addClass("validar");
                    $("#Obser"+id).addClass("validar");
                }
            });
     });
>>>>>>> origin/master
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

<<<<<<< HEAD
    var Resultados = new Array();
=======
    var error="";

   /* $(".validar").each(function(){
			if($(this).val()==" " || $(this).val()==0){
				error=error+$(this).data("message")+"<br>";
			}
    });*/

    if(error==""){
		$("#accordion").addClass("whirl");
		$("#accordion").addClass("ringed");
		setTimeout('AjaxGuardarFicha()', 2000);
	}else{
 		notificar_warning("Complete :<br>"+error);
	}

}

function AjaxGuardarFicha(){

    $("#accordion").removeClass("whirl");
    $("#accordion").removeClass("ringed");



    var ArregloOpciones = new Array();

    $(".OpcionGeneral").each(function (){
>>>>>>> origin/master

    $(".OpcionGeneral").each(function () {

        var tipoOpcion = $(this).data("opcion");
        var id = $(this).data("id");
        var tipoTipo = $(this).data("tipo");

        var Resultado = new Array();

        if (tipoOpcion == "OPCION") {

            switch (tipoTipo) {
                case 2:
<<<<<<< HEAD
                    var campo = $("#CAM" + id).val();
                    console.log("ID =" + id + " tipo=" + 2 + " CAMPO=" + campo);

                    Resultado.push(id);
                    Resultado.push("OPCION");
                    Resultado.push(2);
                    Resultado.push(campo);
=======
                    var campo=$("#CAM"+id).val();
                    var Opcion ="";
                    Opcion=Opcion+""+id;//id
                    Opcion=Opcion+",OPCION";//Gneral
                    Opcion=Opcion+","+2;//tipoOpcion
                    Opcion=Opcion+","+campo;//campo
                    Opcion=Opcion+", ";//rESPUESTA
                    Opcion=Opcion+", ";//Estado
                    Opcion=Opcion+", ";//Sexo
                    Opcion=Opcion+", ";//v1
                    Opcion=Opcion+", ";//v2
                    Opcion=Opcion+", ";//v3
                    Opcion=Opcion+", ";//v4
                    Opcion=Opcion+", ";//tipocampo
                    Opcion=Opcion+", ";//valorcampo
                    Opcion=Opcion+", ";//dosis
                    Opcion=Opcion+", ";//numero
                    Opcion=Opcion+", ";//diagnostico
                    Opcion=Opcion+", ";//medico
                    Opcion=Opcion+", ";//tratamiento
                    Opcion=Opcion+", ";//observacion
                    Opcion=Opcion+", ";//r1
                    Opcion=Opcion+", ";//r2
                    Opcion=Opcion+", ";//r3
                    Opcion=Opcion+", ";//r4
                    Opcion=Opcion+", ";//r5
                    Opcion=Opcion+", ";//r6
                    Opcion=Opcion+", ";//r7
                    Opcion=Opcion+", ";//r8
                    ArregloOpciones.push(Opcion);
                   // console.log("ID ="+id+" tipo="+2+" CAMPO="+campo);
>>>>>>> origin/master
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
<<<<<<< HEAD
                    console.log("ID=" + id + " tipo=" + 3 + " respuesta=" + respuesta + " estado=" + Estado);

                    Resultado.push(id);
                    Resultado.push("OPCION");
                    Resultado.push(3);
                    Resultado.push(respuesta);
                    Resultado.push(Estado);
=======
                    var Opcion ="";
                    Opcion=Opcion+""+id;//id
                    Opcion=Opcion+",OPCION";//Gneral
                    Opcion=Opcion+","+3;//tipoOpcion
                    Opcion=Opcion+", ";//campo
                    Opcion=Opcion+","+respuesta;//rESPUESTA
                    Opcion=Opcion+","+Estado;//Estado
                    Opcion=Opcion+", ";//Sexo
                    Opcion=Opcion+", ";//v1
                    Opcion=Opcion+", ";//v2
                    Opcion=Opcion+", ";//v3
                    Opcion=Opcion+", ";//v4
                    Opcion=Opcion+", ";//tipocampo
                    Opcion=Opcion+", ";//valorcampo
                    Opcion=Opcion+", ";//dosis
                    Opcion=Opcion+", ";//numero
                    Opcion=Opcion+", ";//diagnostico
                    Opcion=Opcion+", ";//medico
                    Opcion=Opcion+", ";//tratamiento
                    Opcion=Opcion+", ";//observacion
                    Opcion=Opcion+", ";//r1
                    Opcion=Opcion+", ";//r2
                    Opcion=Opcion+", ";//r3
                    Opcion=Opcion+", ";//r4
                    Opcion=Opcion+", ";//r5
                    Opcion=Opcion+", ";//r6
                    Opcion=Opcion+", ";//r7
                    Opcion=Opcion+", ";//r8
                    ArregloOpciones.push(Opcion);
                   // console.log("ID="+id+" tipo="+3+" respuesta="+respuesta+" estado="+Estado);

>>>>>>> origin/master
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
<<<<<<< HEAD
                    console.log("ID=" + id + " tipo=" + 4 + " respuesta=" + respuesta + " estado=" + Estado + " Sexo=" + sexo);

                    Resultado.push(id);
                    Resultado.push("OPCION");
                    Resultado.push(4);
                    Resultado.push(respuesta);
                    Resultado.push(Estado);
                    Resultado.push(sexo);
                    break;
                case 5:
                    var campo = $("#FE" + id).val();

                    console.log("ID =" + id + " tipo=" + 5 + " CAMPO=" + campo);

                    Resultado.push(id);
                    Resultado.push("OPCION");
                    Resultado.push(5);
                    Resultado.push(campo);
=======
                    var Opcion ="";
                    Opcion=Opcion+""+id;//id
                    Opcion=Opcion+",OPCION";//Gneral
                    Opcion=Opcion+","+4;//tipoOpcion
                    Opcion=Opcion+", ";//campo
                    Opcion=Opcion+","+respuesta;//rESPUESTA
                    Opcion=Opcion+","+Estado;//Estado
                    Opcion=Opcion+","+sexo;//Sexo
                    Opcion=Opcion+", ";//v1
                    Opcion=Opcion+", ";//v2
                    Opcion=Opcion+", ";//v3
                    Opcion=Opcion+", ";//v4
                    Opcion=Opcion+", ";//tipocampo
                    Opcion=Opcion+", ";//valorcampo
                    Opcion=Opcion+", ";//dosis
                    Opcion=Opcion+", ";//numero
                    Opcion=Opcion+", ";//diagnostico
                    Opcion=Opcion+", ";//medico
                    Opcion=Opcion+", ";//tratamiento
                    Opcion=Opcion+", ";//observacion
                    Opcion=Opcion+", ";//r1
                    Opcion=Opcion+", ";//r2
                    Opcion=Opcion+", ";//r3
                    Opcion=Opcion+", ";//r4
                    Opcion=Opcion+", ";//r5
                    Opcion=Opcion+", ";//r6
                    Opcion=Opcion+", ";//r7
                    Opcion=Opcion+", ";//r8
                    ArregloOpciones.push(Opcion);
                    //console.log("ID="+id+" tipo="+4+" respuesta="+respuesta+" estado="+Estado+" Sexo="+sexo);

                    break;
                case 5:
                     var campo=$("#FE"+id).val();
                    //console.log("ID ="+id+" tipo="+5+" CAMPO="+campo);
                     var Opcion ="";
                    Opcion=Opcion+""+id;//id
                    Opcion=Opcion+",OPCION";//Gneral
                    Opcion=Opcion+","+5;//tipoOpcion
                    Opcion=Opcion+","+campo;//campo
                    Opcion=Opcion+", ";//rESPUESTA
                    Opcion=Opcion+", ";//Estado
                    Opcion=Opcion+", ";//Sexo
                    Opcion=Opcion+", ";//v1
                    Opcion=Opcion+", ";//v2
                    Opcion=Opcion+", ";//v3
                    Opcion=Opcion+", ";//v4
                    Opcion=Opcion+", ";//tipocampo
                    Opcion=Opcion+", ";//valorcampo
                    Opcion=Opcion+", ";//dosis
                    Opcion=Opcion+", ";//numero
                    Opcion=Opcion+", ";//diagnostico
                    Opcion=Opcion+", ";//medico
                    Opcion=Opcion+", ";//tratamiento
                    Opcion=Opcion+", ";//observacion
                    Opcion=Opcion+", ";//r1
                    Opcion=Opcion+", ";//r2
                    Opcion=Opcion+", ";//r3
                    Opcion=Opcion+", ";//r4
                    Opcion=Opcion+", ";//r5
                    Opcion=Opcion+", ";//r6
                    Opcion=Opcion+", ";//r7
                    Opcion=Opcion+", ";//r8
                    ArregloOpciones.push(Opcion);

>>>>>>> origin/master
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
<<<<<<< HEAD
                    console.log("ID=" + id + "tipo=" + 6 + " respuesta=" + respuesta + " estado=" + Estado + " v1=" + v1 + " V3=" + v2 + " v3=" + v3 + " v4=" + v4);
                    Resultado.push(id);
                    Resultado.push("OPCION");
                    Resultado.push(6);
                    Resultado.push(respuesta);
                    Resultado.push(Estado);
                    Resultado.push(v1);
                    Resultado.push(v2);
                    Resultado.push(v3);
                    Resultado.push(v4);

                    break;
                case 7:
                    var Estado = $('input[name=radio' + id + ']:checked').val();
                    console.log("ID=" + id + " tipo=" + 7 + " estado=" + Estado);

                    Resultado.push(id);
                    Resultado.push("OPCION");
                    Resultado.push(7);
                    Resultado.push(Estado);
=======

                     var Opcion ="";
                    Opcion=Opcion+""+id;//id
                    Opcion=Opcion+",OPCION";//Gneral
                    Opcion=Opcion+","+6;//tipoOpcion
                    Opcion=Opcion+", ";//campo
                    Opcion=Opcion+","+respuesta;//rESPUESTA
                    Opcion=Opcion+","+Estado;//Estado
                    Opcion=Opcion+", ";//Sexo
                    Opcion=Opcion+","+v1;//v1
                    Opcion=Opcion+","+v2;//v2
                    Opcion=Opcion+","+v3;//v3
                    Opcion=Opcion+","+v4;//v4
                    Opcion=Opcion+", ";//tipocampo
                    Opcion=Opcion+", ";//valorcampo
                    Opcion=Opcion+", ";//dosis
                    Opcion=Opcion+", ";//numero
                    Opcion=Opcion+", ";//diagnostico
                    Opcion=Opcion+", ";//medico
                    Opcion=Opcion+", ";//tratamiento
                    Opcion=Opcion+", ";//observacion
                    Opcion=Opcion+", ";//r1
                    Opcion=Opcion+", ";//r2
                    Opcion=Opcion+", ";//r3
                    Opcion=Opcion+", ";//r4
                    Opcion=Opcion+", ";//r5
                    Opcion=Opcion+", ";//r6
                    Opcion=Opcion+", ";//r7
                    Opcion=Opcion+", ";//r8
                    ArregloOpciones.push(Opcion);
                   //  console.log("ID="+id+"tipo="+6+" respuesta="+respuesta+" estado="+Estado+" v1="+v1+" V3="+v2+" v3="+v3+" v4="+v4);


                    break;
                case 7:
                     var Estado=$('input[name=radio'+id+']:checked').val();

                      var Opcion ="";
                    Opcion=Opcion+""+id;//id
                    Opcion=Opcion+",OPCION";//Gneral
                    Opcion=Opcion+","+7;//tipoOpcion
                    Opcion=Opcion+", ";//campo
                    Opcion=Opcion+", ";//rESPUESTA
                    Opcion=Opcion+","+Estado;//Estado
                    Opcion=Opcion+", ";//Sexo
                    Opcion=Opcion+", ";//v1
                    Opcion=Opcion+", ";//v2
                    Opcion=Opcion+", ";//v3
                    Opcion=Opcion+", ";//v4
                    Opcion=Opcion+", ";//tipocampo
                    Opcion=Opcion+", ";//valorcampo
                    Opcion=Opcion+", ";//dosis
                    Opcion=Opcion+", ";//numero
                    Opcion=Opcion+", ";//diagnostico
                    Opcion=Opcion+", ";//medico
                    Opcion=Opcion+", ";//tratamiento
                    Opcion=Opcion+", ";//observacion
                    Opcion=Opcion+", ";//r1
                    Opcion=Opcion+", ";//r2
                    Opcion=Opcion+", ";//r3
                    Opcion=Opcion+", ";//r4
                    Opcion=Opcion+", ";//r5
                    Opcion=Opcion+", ";//r6
                    Opcion=Opcion+", ";//r7
                    Opcion=Opcion+", ";//r8
                    ArregloOpciones.push(Opcion);
                   // console.log("ID="+id+" tipo="+7+" estado="+Estado);
>>>>>>> origin/master
                    break;
                case 9:
                    var tipoCampo = $("#OF" + id).data("tipocampo");
                    var Estado = $('input[name=radio' + id + ']:checked').val();
                    var select = $("#SELECT" + id).val();
                    var dosis = $("#dosis" + id).val();
                    var num = $("#tab" + id).val();
                    console.log("ID=" + id + " tipo=" + 9 + " tipoCampo=" + tipoCampo + " estado=" + Estado + " dosis=" + dosis + " num=" + num);

                    Resultado.push(id);
                    Resultado.push("OPCION");
                    Resultado.push(9);
                    Resultado.push(tipoCampo);
                    Resultado.push(Estado);
                    Resultado.push(dosis);
                    Resultado.push(num);

<<<<<<< HEAD
=======
                      var tipoCampo=$("#OF"+id).data("tipocampo");
                      var Estado=$('input[name=radio'+id+']:checked').val();
                      var select=$("#SELECT"+id).val();
                      var dosis=$("#dosis"+id).val();
                      var num=$("#tab"+id).val();


                     var Opcion ="";
                    Opcion=Opcion+""+id;//id
                    Opcion=Opcion+",OPCION";//Gneral
                    Opcion=Opcion+","+9;//tipoOpcion
                    Opcion=Opcion+", ";//campo
                    Opcion=Opcion+", ";//rESPUESTA
                    Opcion=Opcion+","+Estado;//Estado
                    Opcion=Opcion+", ";//Sexo
                    Opcion=Opcion+", ";//v1
                    Opcion=Opcion+", ";//v2
                    Opcion=Opcion+", ";//v3
                    Opcion=Opcion+", ";//v4
                    Opcion=Opcion+","+tipoCampo;//tipocampo
                    Opcion=Opcion+","+select;//valorcampo
                    Opcion=Opcion+","+dosis;//dosis
                    Opcion=Opcion+","+num;//numero
                    Opcion=Opcion+", ";//diagnostico
                    Opcion=Opcion+", ";//medico
                    Opcion=Opcion+", ";//tratamiento
                    Opcion=Opcion+", ";//observacion
                    Opcion=Opcion+", ";//r1
                    Opcion=Opcion+", ";//r2
                    Opcion=Opcion+", ";//r3
                    Opcion=Opcion+", ";//r4
                    Opcion=Opcion+", ";//r5
                    Opcion=Opcion+", ";//r6
                    Opcion=Opcion+", ";//r7
                    Opcion=Opcion+", ";//r8
                    ArregloOpciones.push(Opcion);
                   // console.log("ID="+id+" tipo="+9+" tipoCampo="+tipoCampo+" estado="+Estado+" dosis="+dosis+" num="+num);
>>>>>>> origin/master

                    break;
            }

        } else if (tipoOpcion == "ESPECIALIDAD") {

            var Estado = $('input[name=radioE' + id + ']:checked').val();
            var diagnostico = $("#OptionDiag" + id).val();
            var medico = $("#OptionMedico" + id).val();
            var tratamiento = $("#tratamiento" + id).val();
            var observacion = $("#Obser" + id).val();

<<<<<<< HEAD
            console.log("ID =" + id + " Estado=" + Estado + " Diag=" + diagnostico + " Medico=" + medico + " Tratamiento=" + tratamiento + " Obsr=" + observacion);
            Resultado.push(id);
            Resultado.push("ESPECIALIDAD");
            Resultado.push(Estado);
            Resultado.push(diagnostico);
            Resultado.push(medico);
            Resultado.push(tratamiento);

        }

        Resultados.push(Resultado);
    });


  var ResultadoPie = new Array();

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

    console.log("RESULTADO PIE: R1=" + resu1 + " R2=" + resu2 + " R3=" + resu3 + " R4=" + resu4 + " R5=" + resu5 + " R6=" + resu6 + " R7=" + resu7 + " R8=" + resu8);

     ResultadoPie.push("PIE");
    ResultadoPie.push(resu1);
    ResultadoPie.push(resu2);
    ResultadoPie.push(resu3);
    ResultadoPie.push(resu4);
    ResultadoPie.push(resu5);
    ResultadoPie.push(resu6);
    ResultadoPie.push(resu7);
    ResultadoPie.push(resu8);

 Resultados.push(ResultadoPie);
     console.log(Resultados);
}
=======
        }else if(tipoOpcion=="ESPECIALIDAD"){

            var Estado=$('input[name=radioE'+id+']:checked').val();
            var diagnostico=$("#OptionDiag"+id).val();
            var medico=$("#OptionMedico"+id).val();
            var tratamiento=$("#tratamiento"+id).val();
            var observacion=$("#Obser"+id).val();

            var Opcion ="";
                    Opcion=Opcion+""+id;//id
                    Opcion=Opcion+",ESPECIALIDAD";//Gneral
                    Opcion=Opcion+", ";//tipoOpcion
                    Opcion=Opcion+", ";//campo
                    Opcion=Opcion+", ";//rESPUESTA
                    Opcion=Opcion+","+Estado;//Estado
                    Opcion=Opcion+", ";//Sexo
                    Opcion=Opcion+", ";//v1
                    Opcion=Opcion+", ";//v2
                    Opcion=Opcion+", ";//v3
                    Opcion=Opcion+", ";//v4
                    Opcion=Opcion+", ";//tipocampo
                    Opcion=Opcion+", ";//valorcampo
                    Opcion=Opcion+", ";//dosis
                    Opcion=Opcion+", ";//numero
                    Opcion=Opcion+","+diagnostico;//diagnostico
                    Opcion=Opcion+","+medico;//medico
                    Opcion=Opcion+","+tratamiento;//tratamiento
                    Opcion=Opcion+","+observacion;//observacion
                    Opcion=Opcion+", ";//r1
                    Opcion=Opcion+", ";//r2
                    Opcion=Opcion+", ";//r3
                    Opcion=Opcion+", ";//r4
                    Opcion=Opcion+", ";//r5
                    Opcion=Opcion+", ";//r6
                    Opcion=Opcion+", ";//r7
                    Opcion=Opcion+", ";//r8
                    ArregloOpciones.push(Opcion);

           // console.log("ID ="+id+" Estado="+Estado+" Diag="+diagnostico+" Medico="+medico+" Tratamiento="+tratamiento+" Obsr="+observacion);

        }


    });


var hijo1=$("#OpcionPieN1").children("div");
    var resu1=hijo1.data("opcion");
var hijo2=$("#OpcionPieN2").children("div");
    var resu2=hijo2.data("opcion");
var hijo3=$("#OpcionPieN3").children("div");
    var resu3=hijo3.data("opcion");
var hijo4=$("#OpcionPieN4").children("div");
    var resu4=hijo4.data("opcion");
var hijo5=$("#OpcionPieN5").children("div");
    var resu5=hijo5.data("opcion");
var hijo6=$("#OpcionPieN6").children("div");
    var resu6=hijo6.data("opcion");
var hijo7=$("#OpcionPieN7").children("div");
    var resu7=hijo7.data("opcion");
var hijo8=$("#OpcionPieN8").children("div");
    var resu8=hijo8.data("opcion");

   var Pie = new Object();
                Pie.id="";
                Pie.opcion="PIE";
                Pie.tipo="";
                Pie.campo="";
                Pie.respuesta="";
                Pie.estado="";
                Pie.sexo="";
                Pie.v1="";
                Pie.v2="";
                Pie.v3="";
                Pie.v4="";
                Pie.tipocampo="";
                Pie.valorcampo="";
                Pie.dosis="";
                Pie.numero="";
                Pie.diagnostico="";
                Pie.medico="";
                Pie.tratamiento="";
                Pie.observacion="";
                Pie.r1=resu1;
                Pie.r2=resu2;
                Pie.r3=resu3;
                Pie.r4=resu4;
                Pie.r5=resu5;
                Pie.r6=resu6;
                Pie.r7=resu7;
                Pie.r8=resu8;

                    var Opcion ="";
                    Opcion=Opcion+" ";//id
                    Opcion=Opcion+",PIE";//Gneral
                    Opcion=Opcion+", ";//tipoOpcion
                    Opcion=Opcion+", ";//campo
                    Opcion=Opcion+", ";//rESPUESTA
                    Opcion=Opcion+", ";//Estado
                    Opcion=Opcion+", ";//Sexo
                    Opcion=Opcion+", ";//v1
                    Opcion=Opcion+", ";//v2
                    Opcion=Opcion+", ";//v3
                    Opcion=Opcion+", ";//v4
                    Opcion=Opcion+", ";//tipocampo
                    Opcion=Opcion+", ";//valorcampo
                    Opcion=Opcion+", ";//dosis
                    Opcion=Opcion+", ";//numero
                    Opcion=Opcion+", ";//diagnostico
                    Opcion=Opcion+", ";//medico
                    Opcion=Opcion+", ";//tratamiento
                    Opcion=Opcion+", ";//observacion
                    Opcion=Opcion+","+resu1;//r1
                    Opcion=Opcion+","+resu2;//r2
                    Opcion=Opcion+","+resu3;//r3
                    Opcion=Opcion+","+resu4;//r4
                    Opcion=Opcion+","+resu5;//r5
                    Opcion=Opcion+","+resu6;//r6
                    Opcion=Opcion+","+resu7;//r7
                    Opcion=Opcion+","+resu8;//r8

                    ArregloOpciones.push(Opcion);
   // console.log("RESULTADO PIE: R1="+resu1+" R2="+resu2+" R3="+resu3+" R4="+resu4+" R5="+resu5+" R6="+resu6+" R7="+resu7+" R8="+resu8);




var OpcionesR=ArregloOpciones.join('|');


var idPaciente=$("#idPaciente").val();
var idAno=$("#idAno").val();
var idMes=$("#idMes").val();
    $.post("../../controlador/Gestion/CFicha.php?op=GuardarFicha",{OpcionesR:OpcionesR,idPaciente:idPaciente,idAno:idAno,idMes:idMes}, function (data, status) {
        data = JSON.parse(data);
        console.log(data);

         var Registro=data.Registro;
         var Mensaje=data.Mensaje;
        if(Registro){
            notificar_success(Mensaje);
        }else{
            notificar_danger(Mensaje);
        }
    });
}



>>>>>>> origin/master
init();
