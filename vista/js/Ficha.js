var sexo;
var Lista_Medicos;
var Listas_Comorbilidad;
var DiagnosticoEnfermeria;
var Tratamientos;
function init() {
    RecuperarListas();
}

function RecuperarListas() {
    $.post("../../controlador/Gestion/CFicha.php?op=RecuperarListas", function (data, status) {
        data = JSON.parse(data);
        console.log(data);
        Lista_Medicos = data.medicos;
        Listas_Comorbilidad = data.comorbilidad;
        DiagnosticoEnfermeria = data.enfermeria;
        Tratamientos=data.tratamientos;
        iniciar_funciones();
    });


}

function iniciar_funciones(){
     var idPaciente = $("#idPaciente").val();
    RecuperarDatosPaciente(idPaciente);
    RecuperarGrupos();
    RecuperarEspecialidades();
    LanzarFuncionOpcionesPie();
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
        console.log(data);
        $.post("../../controlador/Gestion/CFicha.php?op=ListarDiagnosticos", function (ts) {
            var diagnosticos = ts;
            var query = "";
            data.forEach(function (element) {

                var idEspecialidad = element.id;
                var especialidad = element.especialidad;
                var medicos = element.medicos;

                query = query + '<div class="row opcionEspecialidad" data-id="'+idEspecialidad+'">' +
                    '<div class="col-md-2 mt-5">' +
                    '<label for="">' + especialidad + '</label>' +
                    '</div>' +
                    '<div class="col-md-2 mt-5">' +
                    '<div class="row">' +
                    '<label for="" class="col-md-3 ">SI</label>' +
                    '<input id="SI'+idEspecialidad+'" class="form-control opcion2 col-md-3 mt-1" type="radio" name="radio' + idEspecialidad + '" value="1">' +
                    '<label for="" class="col-md-3 ">NO</label>' +
                    '<input id="NO'+idEspecialidad+'" class="form-control opcion2 col-md-3 mt-1" type="radio" name="radio' + idEspecialidad + '" value="0" checked>' +
                    '</div>' +
                    '</div>' +

                    '<div class="col-md-2">' +
                    ' <div class="form-group">' +
                    '<label for="OpcionTipoCampo" class="col-form-label">Diagnosticos:</label>' +
                    '<select class="form-control" id="OptionDiag' + idEspecialidad + '" name="OpcionTipoCampo" disabled>' +
                    diagnosticos + '</select>' +
                    ' </div>' +
                    ' </div>' +
                    '<div class="col-md-2">' +
                    ' <div class="form-group">' +
                    ' <label for="OpcionTipoCampo" class="col-form-label">Medico:</label>' +
                    '<select class="form-control  " id="OptionMedico' + idEspecialidad + '" name="OpcionTipoCampo"  disabled>' + medicos +

                    '</select>' +
                    '</div>' +
                    ' </div>' +
                    '<div class="col-md-2">' +
                    ' <div class="form-group">' +
                    ' <label for="" class="col-form-label">Tratamiento:</label>' +
                    ' <input type="text" class="form-control" placeholder="" name="" id="tratamiento' + idEspecialidad + '" disabled>' +
                    '</div>' +
                    '</div>' +
                    ' <div class="col-md-2">' +
                    ' <div class="form-group">' +
                    '<label for="" class="col-form-label">Observaciones:</label>' +
                    ' <input type="text" class="form-control" placeholder="" name="" id="Obser' + idEspecialidad + '" disabled>' +
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
                grupoOpcion = grupoOpcion + '<div class="row mt-1 ml-5 OpcionGeneral" data-id="' + idOpcion + '" data-tipo="' + Tipo + '">';
                var OpcionSet = RecuperarTipoOpcion(element2, contador++);
                grupoOpcion = grupoOpcion + OpcionSet + '</div>';
            });


            grupoOpcion = grupoOpcion + '</div></div></div>';

            Html = Html + grupoOpcion;
        });

        $("#accordion").html(Html);

        LanzarFunciones();
    });
}

function RecuperarTipoOpcion(elemento, contador) {

    var idOpcion = elemento.id;
    var Titulo = elemento.titulo;

    var Propiedades = elemento.propiedades.replace(/&quot;/g, '\"');
    var Propiedades = JSON.parse(Propiedades);
    var Tipo = elemento.tipo;

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
                '<input id="OP' + idOpcion + '" class="form-control  caja campo opcionCampo" data-tipo="' + Tipo + '" data-inicio="" data-fin="" type="text" step="any"  maxlength="100">' +
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
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
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
            opcion = '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '"  data-minimo="' + minimo + '" data-maximo="' + maximo + '">' +
                '<div class="col-md-12"><label class="">' + Titulo + '(' + atributo + ') - ' + paciente + ':</label></div>' +
                '<div class="col-md-4">' +
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 mt-4">' +
                '<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
                '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
                '</div> ';

            break;
        case "5":

            opcion = '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '"  data-minimo="' + minimo + '" data-maximo="' + maximo + '">' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                ' <label for="" class="col-form-label">' + Titulo + ':</label>' +
                '<div class="input-group date dateFecha">' +
                ' <input class="form-control opcionFecha" type="text" id="OP' + idOpcion + '" data-tipo="' + Tipo + '" data-id="' + idOpcion + '" autocomplete="off">' +
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

            opcion =
                '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '" data-formula="' + formula + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '">' +

                '<div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v1 + '"> ' +
                '<label class="">' + v1 + ':</label>' +
                '<input  class="form-control caja campo  campoV" id="V1' + idOpcion + '" type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);"> ' +
                '</div>' +
                ' <div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v2 + '"> ' +
                ' <label class="">' + v2 + ':</label> ' +
                '<input  class="form-control caja campo  campoV" id="V2' + idOpcion + '" type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 opcionFormula" style="display:none;"  data-id="' + v3 + '"> ' +
                '<label class="">' + v3 + ':</label> ' +
                '<input  class="form-control caja campo  campoV" id="V3' + idOpcion + '"  type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 opcionFormula" style="display:none;" data-id="' + v4 + '"> ' +
                '<label class="">' + v4 + ':</label>' +
                '<input   class="form-control caja campo  campoV" id="V4' + idOpcion + '"type="text" step="any"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
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

            opcion = '<input type="hidden" class="opcionOculto opcionCondicionCampo" id="OF' + idOpcion + '" data-tipoCampo="' + TipoCampos + '">' +

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
                '<div class="col-md-4" style="display:none;" id="area'+idOpcion+'"> <select class="form-control " id="SELECT' + idOpcion + '" name="" disabled></select></div>'+
                '<div class=" col-md-4" style="display:none;" id="DO' + idOpcion + '" ><input id="dosis'+idOpcion+'" class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="DOSIS/DIA" disabled></div>'+
                '<div class=" col-md-4" style="display:none;" id="TA' + idOpcion + '"><input id="tab'+idOpcion+'"  class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="NUM. INYECC." disabled></div>';
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

            var tipoCampos=$("#OF"+id).data("tipocampo");

            switch(tipoCampos){
                case 1:
                    $("#area"+id).show();
                    $("#SELECT"+id).empty();
                    $("#SELECT"+id).append(Lista_Medicos);
                    break;
                case 2 :
                     $("#area"+id).show();
                     $("#SELECT"+id).empty();
                     $("#SELECT"+id).append(Listas_Comorbilidad);
                    break;
                 case 3 :
                     $("#DO"+id).show();
                     $("#TA"+id).show();
                    break;
                case 5:
                     $("#area"+id).show();
                    $("#SELECT"+id).append(DiagnosticoEnfermeria);
                    break;
                 case 6:
                     $("#area"+id).show();
                    $("#SELECT"+id).append(Tratamientos);
                    break;

            }

            $('#SI'+id).change(function () {
                if (this.checked == true) {
                    if(tipoCampos==3){
                         $("#dosis"+id).removeAttr("disabled");
                         $("#tab"+id).removeAttr("disabled");
                    }else{
                        $("#SELECT"+id).removeAttr("disabled");
                    }

                } else {
                    if(tipoCampos==3){
                        $("#dosis"+id).attr("disabled",true);
                         $("#tab"+id).attr("disabled",true);
                    }else{
                       $("#SELECT"+id).attr("disabled",true);
                    }

                }
            });
            $('#NO'+id).change(function () {
                if (this.checked == true) {
                    if(tipoCampos==3){
                          $("#dosis"+id).attr("disabled",true);
                         $("#tab"+id).attr("disabled",true);
                    }else{
                       $("#SELECT"+id).attr("disabled",true);
                    }

                } else {
                    if(tipoCampos==3){
                         $("#dosis"+id).removeAttr("disabled");
                         $("#tab"+id).removeAttr("disabled");
                    }else{
                       $("#SELECT"+id).removeAttr("disabled");
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

function LanzarFuncionesEspecialidad(){
     $(".OpcionGeneral").each(function () {
          var id = $(this).data("id");
          $('#SI'+id).change(function () {
                if (this.checked == true) {
                    $("#OptionDiag"+id).removeAttr("disabled");
                    $("#OptionMedico"+id).removeAttr("disabled");
                    $("#tratamiento"+id).removeAttr("disabled");
                    $("#Obser"+id).removeAttr("disabled");
                } else {
                     $("#OptionDiag"+id).attr("disabled",true);
                    $("#OptionMedico"+id).attr("disabled",true);
                    $("#tratamiento"+id).attr("disabled",true);
                    $("#Obser"+id).attr("disabled",true);
                }
            });
            $('#NO'+id).change(function () {
                if (this.checked == true) {
                     $("#OptionDiag"+id).attr("disabled",true);
                    $("#OptionMedico"+id).attr("disabled",true);
                    $("#tratamiento"+id).attr("disabled",true);
                    $("#Obser"+id).attr("disabled",true);

                } else {
                  $("#OptionDiag"+id).removeAttr("disabled");
                    $("#OptionMedico"+id).removeAttr("disabled");
                    $("#tratamiento"+id).removeAttr("disabled");
                    $("#Obser"+id).removeAttr("disabled");
                }
            });
     });
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

init();
