var sexo;

function init() {
    var idPaciente = $("#idPaciente").val();
    RecuperarDatosPaciente(idPaciente);
    RecuperarGrupos();
    RecuperarEspecialidades();
    LanzarFuncionOpcionesPie();
}
function LanzarFuncionOpcionesPie(){

     $(".opciones").each(function () {
          $(this).on('click', function () {
            if($(this).data("opcion")==1){
                $(this).removeClass("Option");
                $(this).addClass("OptionX");
                $(this).data("opcion",2);
                $(this).html("<span>X</span>");

            }else if($(this).data("opcion")==2){
                $(this).removeClass("OptionX");
                $(this).addClass("OptionFull");
                $(this).data("opcion",3);
                $(this).empty();

            }else if($(this).data("opcion")==3){
                $(this).removeClass("OptionFull");
                $(this).addClass("Option");
                $(this).data("opcion",1);
            }
          });
    });
}
function RecuperarEspecialidades(){
    $("#bloqueEspecialidades")
    $.post("../../controlador/Gestion/CFicha.php?op=RecuperarEspecialidades", function (data, status) {
        data = JSON.parse(data);
        console.log(data);
        $.post("../../controlador/Gestion/CFicha.php?op=ListarDiagnosticos", function (ts) {
                 var diagnosticos=ts;
                 var query="";
                 data.forEach(function (element) {

                   var idEspecialidad=element.id;
                   var especialidad=element.especialidad;
                   var medicos=element.medicos;

                   query=query+'<div class="row">'+
                                                '<div class="col-md-2 mt-5">'+
                                                    '<label for="">'+especialidad+'</label>'+
                                                '</div>'+
                                                '<div class="col-md-2 mt-5">'+
                                                    '<div class="row">'+
                                                        '<label for="" class="col-md-3 ">SI</label>'+
                                                        '<input id="radio1" class="form-control opcion2 col-md-3 mt-1" type="radio" name="radio'+idEspecialidad+'" value="1">'+
                                                        '<label for="" class="col-md-3 ">NO</label>'+
                                                        '<input id="radio2" class="form-control opcion2 col-md-3 mt-1" type="radio" name="radio'+idEspecialidad+'" value="1" checked>'+
                                                    '</div>'+
                                                '</div>'+

                                                '<div class="col-md-2">'+
                                                   ' <div class="form-group">'+
                                                        '<label for="OpcionTipoCampo" class="col-form-label">Diagnosticos:</label>'+
                                                          '<select class="form-control" id="OptionDiag'+idEspecialidad+'" name="OpcionTipoCampo">'+
                                                           diagnosticos+'</select>'+
                                                   ' </div>'+
                                               ' </div>'+
                                                '<div class="col-md-2">'+
                                                   ' <div class="form-group">'+
                                                       ' <label for="OpcionTipoCampo" class="col-form-label">Medico:</label>'+
                                                        '<select class="form-control  " id="OptionMedico'+idEspecialidad+'" name="OpcionTipoCampo"  >'+medicos+

                                                        '</select>'+
                                                    '</div>'+
                                               ' </div>'+
                                                '<div class="col-md-2">'+
                                                   ' <div class="form-group">'+
                                                       ' <label for="" class="col-form-label">Tratamiento:</label>'+
                                                       ' <input type="text" class="form-control" placeholder="" name="" id="tratamiento'+idEspecialidad+'" readonly>'+
                                                    '</div>'+
                                                '</div>'+
                                               ' <div class="col-md-2">'+
                                                   ' <div class="form-group">'+
                                                        '<label for="" class="col-form-label">Observaciones:</label>'+
                                                       ' <input type="text" class="form-control" placeholder="" name="" id="Obser'+idEspecialidad+'" readonly>'+
                                                    '</div>'+
                                                '</div>'+
                                           ' </div>';

                });

                $("#contenedorEspecialidades").html(query);

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
                grupoOpcion = grupoOpcion + '<div class="row mt-1">';
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
                '<h4 class="text-info">' + Titulo + '</h4>' +
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
            opcion = '<div class="col-md-4">' +
                '<label class="">' + Titulo + '(' + atributo + '):</label>' +
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 mt-4">' +
                '<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
                '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
                '</div> ';

            break;
        case "4":
            var atributo = "";
            var minimo = "";
            var maximo = "";
            var paciente = "";
            if (sexo == 1) {
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
            opcion = '<div class="col-md-4">' +
                '<label class="">' + Titulo + '(' + atributo + ') - ' + paciente + ':</label>' +
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2 mt-4">' +
                '<button style="display:none;" id="SI' + idOpcion + '" class="btn btn-success  btn-sm"type="button"><i class="fa fa-sm fa-check"></i></button>' +
                '<button style="display:none;" id="NO' + idOpcion + '" class="btn btn-danger  btn-sm"type="button"><i class="fa fa-sm fa-times"></i>' + '</button>' +
                '</div> ';

            break;
        case "5":

            opcion = '<div class="col-md-4">' +
                '<div class="form-group">' +
                ' <label for="" class="col-form-label">' + Titulo + ':</label>' +
                '<div class="input-group date dateFecha">' +
                ' <input class="form-control opcionFecha" type="text" id="OP'+idOpcion +'" data-tipo="' + Tipo + '" data-id="'+idOpcion +'" autocomplete="off">' +
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

            opcion='<div class="col-md-2 opcionFormula" style="display:none;" id="V' + v1 + '"  data-id="'+v1+'"> '+
                '<label class="">'+v1+':</label>'+
                '<input  class="form-control caja campo  campoV" data-tipo="v1" type="text" step="any"  maxlength="100"> '+
             '</div>'+
             ' <div class="col-md-2 opcionFormula" style="display:none;" id="V' + v2 + '"  data-id="'+v2+'"> '+
               ' <label class="">'+v2+':</label> '+
                '<input  class="form-control caja campo  campoV" data-tipo="v2" type="text" step="any"  maxlength="100">'+
             '</div>'+
              '<div class="col-md-2 opcionFormula" style="display:none;" id="V' + v3 + '"  data-id="'+v3+'"> '+
                '<label class="">'+v3+':</label> '+
                '<input  class="form-control caja campo  campoV" data-tipo="v3" type="text" step="any"  maxlength="100">'+
             '</div>'+
              '<div class="col-md-2 opcionFormula" style="display:none;" id="V' + v4 + '" data-id="'+v4+'"> '+
                '<label class="">'+v4+':</label>'+
                '<input   class="form-control caja campo  campoV" data-tipo="v4" type="text" step="any"  maxlength="100">'+
             '</div>'+
             '<div class="col-md-4"> '+
                '<label class="">'+Titulo+':</label>'+
                '<input id="F' + idOpcion + '" class="form-control caja campo opcionCampo" data-tipo="f" type="text" step="any" placeholder="'+formula+'"  maxlength="100" onkeypress="return SoloNumerosModificado(event,4,this.id);">'+
             '</div>';

            break;
        case "7":

            opcion='<div class="form-group col-md-12">'+
                '<label class=" col-md-4 col-form-label">'+Titulo+':</label>'+
                '<div class="col-md-4 col-form-label"> '+
                    '<div class="row">'+
                       ' <label for="" class="col-md-2">SI</label>'+
                       ' <input id="radio1" class="form-control opcion2 col-md-2" type="radio" name="radio'+idOpcion+'" value="1">'+
                       ' <label for="" class="col-md-2">NO</label>'+
                       ' <input id="radio2" class="form-control opcion2 col-md-2" type="radio" name="radio'+idOpcion+'" value="1" checked> '+
                  '  </div> '+
               ' </div> '+
            '</div>';

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

function LanzarFunciones() {

    $(".opcionFormula").each(function(){

        var elemento=$(this);
        var id=elemento.data("id");

        if(id=="" || id==null){
            $(this).hide();
        }else{
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
            var atributo = elemento.data("atributo");
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

}

init();
