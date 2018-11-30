var ArregloVerificacion;
var sexo = 0;
var flecha_down = '<button class="btn btn-danger  btn-sm"type="button"><i class="fa fa-arrow-down"></i>';
var flecha_up = '<button class="btn btn-success  btn-sm"type="button"><i class="fa fa-arrow-up"></i></button>';

function init() {

    recuperar_pacientes();
    iniciar_componentes();
    EvaluarSeguimiento();


}

function iniciar_componentes() {


    iniciar_radios();
    gestion_radios();
    gestion_inputs();


    $("#formulario_seguimiento").on("submit", function (e) {
        guardaryeditar(e);

    });

}

function recuperar_pacientes() {
    var id = $("#idPaciente").val();
    $.post("../../controlador/Gestion/CSeguimiento.php?op=mostrar", {
        idPaciente: id
    }, function (data, status) {
        data = JSON.parse(data);

        sexo = parseInt(data.idSexo);

    });
}

function iniciar_radios() {
    $('#obs1').attr("disabled", "true");
    $('#obs2').attr("disabled", "true");
    $('#obs3').attr("disabled", "true");
    $('#obs4').attr("disabled", "true");
    $('#obs5').attr("disabled", "true");
    $('#obs6').attr("disabled", "true");
    $('#obs7').attr("disabled", "true");
    $('#obs8').attr("disabled", "true");
    $('#obs9').attr("disabled", "true");


    $('input:radio[name=var1B]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=var2B]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=var3B]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=var4B]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=var5B]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=var6B]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=var7B]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=var8B]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=var9B]').filter('[value=2]').attr('checked', true);


    $('input:radio[name=taller1]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=taller2]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=taller3]').filter('[value=2]').attr('checked', true);



}

function gestion_radios() {
    $("input[name=var1B]").click(function () {
        var val1 = $('input:radio[name=var1B]:checked').val();
        if (val1 == 1) {
            $('#obs1').removeAttr("disabled");
        } else {
            $('#obs1').attr("disabled", "true");
        }
    });


    $("input[name=var2B]").click(function () {
        var val1 = $('input:radio[name=var2B]:checked').val();
        if (val1 == 1) {
            $('#obs2').removeAttr("disabled");
        } else {
            $('#obs2').attr("disabled", "true");
        }
    });

    $("input[name=var3B]").click(function () {
        var val1 = $('input:radio[name=var3B]:checked').val();
        if (val1 == 1) {
            $('#obs3').removeAttr("disabled");
        } else {
            $('#obs3').attr("disabled", "true");
        }
    });

    $("input[name=var4B]").click(function () {
        var val1 = $('input:radio[name=var4B]:checked').val();
        if (val1 == 1) {
            $('#obs4').removeAttr("disabled");
        } else {
            $('#obs4').attr("disabled", "true");
        }
    });

    $("input[name=var5B]").click(function () {
        var val1 = $('input:radio[name=var5B]:checked').val();
        if (val1 == 1) {
            $('#obs5').removeAttr("disabled");
        } else {
            $('#obs5').attr("disabled", "true");
        }
    });

    $("input[name=var6B]").click(function () {
        var val1 = $('input:radio[name=var6B]:checked').val();
        if (val1 == 1) {
            $('#obs6').removeAttr("disabled");
        } else {
            $('#obs6').attr("disabled", "true");
        }
    });

    $("input[name=var7B]").click(function () {
        var val1 = $('input:radio[name=var7B]:checked').val();
        if (val1 == 1) {
            $('#obs7').removeAttr("disabled");
        } else {
            $('#obs7').attr("disabled", "true");
        }
    });

    $("input[name=var8B]").click(function () {
        var val1 = $('input:radio[name=var8B]:checked').val();
        if (val1 == 1) {
            $('#obs8').removeAttr("disabled");
        } else {
            $('#obs8').attr("disabled", "true");
        }
    });


    $("input[name=var9B]").click(function () {
        var val1 = $('input:radio[name=var9B]:checked').val();
        if (val1 == 1) {
            $('#obs9').removeAttr("disabled");
        } else {
            $('#obs9').attr("disabled", "true");
        }
    });
}

function gestion_inputs() {

    $('#var2A').keyup(function () {

        var dato2 = $('#var2A').val();
        if (dato2 >= 70 && dato2 <= 130) {
            console.log("Valido");
            $('#var2A').removeClass("colorNegativo");
            $('#var2A').addClass("colorPositivo");
            $("#op2").empty();
            $("#op2").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var2A').removeClass("colorPositivo");
            $('#var2A').addClass("colorNegativo");
            $("#op2").empty();
            $("#op2").html(flecha_down);
        }
    });

    $('#var3A').keyup(function () {

        var dato3 = $('#var3A').val();
        if (dato3 >= 70 && dato3 <= 130) {
            console.log("Valido");
            $('#var3A').removeClass("colorNegativo");
            $('#var3A').addClass("colorPositivo");
            $("#op3").empty();
            $("#op3").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var3A').removeClass("colorPositivo");
            $('#var3A').addClass("colorNegativo");
            $("#op3").empty();
            $("#op3").html(flecha_down);
        }
    });


    $('#var4A').keyup(function () {

        var dato4 = $('#var4A').val();
        if (dato4 <= 180) {
            console.log("Valido");
            $('#var4A').removeClass("colorNegativo");
            $('#var4A').addClass("colorPositivo");
            $("#op4").empty();
            $("#op4").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var4A').removeClass("colorPositivo");
            $('#var4A').addClass("colorNegativo");
            $("#op4").empty();
            $("#op4").html(flecha_down);
        }
    });


    $('#var5A').keyup(function () {

        var dato5 = $('#var5A').val();
        if (dato5 >= 5 && dato5 <= 7) {
            console.log("Valido");
            $('#var5A').removeClass("colorNegativo");
            $('#var5A').addClass("colorPositivo");
            $("#op5").empty();
            $("#op5").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var5A').removeClass("colorPositivo");
            $('#var5A').addClass("colorNegativo");
            $("#op5").empty();
            $("#op5").html(flecha_down);
        }
    });


    $('#var6A').keyup(function () {

        var dato6 = $('#var6A').val();
        if (dato6 <= 200) {
            console.log("Valido");
            $('#var6A').removeClass("colorNegativo");
            $('#var6A').addClass("colorPositivo");
            $("#op6").empty();
            $("#op6").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var6A').removeClass("colorPositivo");
            $('#var6A').addClass("colorNegativo");
            $("#op6").empty();
            $("#op6").html(flecha_down);
        }
    });

    $('#var7A').keyup(function () {

        var dato7 = $('#var7A').val();
        if (sexo == 2) {
            if (dato7 <= 40) {
                console.log("Valido");
                $('#var7A').removeClass("colorNegativo");
                $('#var7A').addClass("colorPositivo");
                $("#op7").empty();
                $("#op7").html(flecha_up);

            } else {
                console.log("No Valido");
                $('#var7A').removeClass("colorPositivo");
                $('#var7A').addClass("colorNegativo");
                $("#op7").empty();
                $("#op7").html(flecha_down);
            }
        } else {
            if (dato7 <= 50) {
                console.log("Valido");
                $('#var7A').removeClass("colorNegativo");
                $('#var7A').addClass("colorPositivo");
                $("#op7").empty();
                $("#op7").html(flecha_up);

            } else {
                console.log("No Valido");
                $('#var7A').removeClass("colorPositivo");
                $('#var7A').addClass("colorNegativo");
                $("#op7").empty();
                $("#op7").html(flecha_down);
            }
        }


    });

    $('#var8A').keyup(function () {

        var dato8 = $('#var8A').val();
        if (dato8 <= 100) {
            console.log("Valido");
            $('#var8A').removeClass("colorNegativo");
            $('#var8A').addClass("colorPositivo");
            $("#op8").empty();
            $("#op8").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var8A').removeClass("colorPositivo");
            $('#var8A').addClass("colorNegativo");
            $("#op8").empty();
            $("#op8").html(flecha_down);
        }
    });


    $('#var9A').keyup(function () {

        var dato9 = $('#var9A').val();
        if (dato9 <= 150) {
            console.log("Valido");
            $('#var9A').removeClass("colorNegativo");
            $('#var9A').addClass("colorPositivo");
            $("#op9").empty();
            $("#op9").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var9A').removeClass("colorPositivo");
            $('#var9A').addClass("colorNegativo");
            $("#op9").empty();
            $("#op9").html(flecha_down);
        }
    });


    $('#var11A').keyup(function () {

        var dato11 = $('#var11A').val();
        if (dato11 >= 18.5 && dato11 <= 24.9) {
            console.log("Valido");
            $('#var11A').removeClass("colorNegativo");
            $('#var11A').addClass("colorPositivo");
            $("#op11").empty();
            $("#op11").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var11A').removeClass("colorPositivo");
            $('#var11A').addClass("colorNegativo");
            $("#op11").empty();
            $("#op11").html(flecha_down);
        }
    });

    $('#var12A').keyup(function () {

        var dato12 = $('#var12A').val();
        if (dato12 <= 30) {
            console.log("Valido");
            $('#var12A').removeClass("colorNegativo");
            $('#var12A').addClass("colorPositivo");
            $("#op12").empty();
            $("#op12").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var12A').removeClass("colorPositivo");
            $('#var12A').addClass("colorNegativo");
            $("#op12").empty();
            $("#op12").html(flecha_down);
        }
    });


    $('#var13A').keyup(function () {

        var dato13 = $('#var13A').val();
        if (dato13 >= 6 && dato13 <= 11) {
            console.log("Valido");
            $('#var13A').removeClass("colorNegativo");
            $('#var13A').addClass("colorPositivo");
            $("#op13").empty();
            $("#op13").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var13A').removeClass("colorPositivo");
            $('#var13A').addClass("colorNegativo");
            $("#op13").empty();
            $("#op13").html(flecha_down);
        }
    });


    $('#var14A').keyup(function () {

        var dato14 = $('#var14A').val();
        if (dato14 <= 130) {
            console.log("Valido");
            $('#var14A').removeClass("colorNegativo");
            $('#var14A').addClass("colorPositivo");
            $("#op14").empty();
            $("#op14").html(flecha_up);

        } else {
            console.log("No Valido");
            $('#var14A').removeClass("colorPositivo");
            $('#var14A').addClass("colorNegativo");
            $("#op14").empty();
            $("#op14").html(flecha_down);
        }
    });



}

function guardaryeditar(e) {

    //cargar(true);
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled",true);
    //$("#btnLimpiar").prop("disabled",true);
    var Mensaje_Validacion = verificar_campos();
    if (Mensaje_Validacion.length == 0) {
        var formData = new FormData($("#formulario_seguimiento")[0]);
        console.log(formData);
        $.ajax({
            url: "../../controlador/Gestion/CSeguimiento.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data, status) {
                data = JSON.parse(data);
                console.log(data);
                var Mensaje = data.Mensaje;
                var Error = data.Error;

                if (Error) {

                    //$('#modal_usuarios').modal('hide');
                    //cargar(false);
                    //bootbox.alert(Mensaje);
                    //$("#btnGuardar").prop("disabled",false);
                    //$("#btnLimpiar").prop("disabled",false);
                    swal("Error:", Mensaje);
                    //$('#formularioUsuario')[0].reset();
                } else {
                    // $('#modal_usuarios').modal('hide');
                    //limpiar_modal();
                    //cargar(false);
                    //bootbox.alert(Mensaje);
                    //mostrarform(false);
                    //tabla_usuarios.ajax.reload();
                    //limpiar();

                    $("#grabar_boton").attr("disabled", "true");
                    swal("Seguimiento:", Mensaje);

                }
            }

        });
    } else {
        notificar_warning("Validación:<br>" + Mensaje_Validacion);

    }



}

function verificar_campos() {
    var Mensaje = "";
    var Variable = new Object();
    Variable.valor = $("#talla").val();
    Variable.texto = "Debe Ingresar Talla del Paciente.<br>";
    var Variable2 = new Object();
    Variable2.valor = $("#peso").val();
    Variable2.texto = "Debe Ingresar Peso del Paciente.<br>";
    var Variable3 = new Object();
    Variable3.valor = $("#var2A").val();
    Variable3.texto = "Debe Ingresar Parametro de Glucosa Ayunas del Paciente.<br>";
    var Variable4 = new Object();
    Variable4.valor = $("#var3A").val();
    Variable4.texto = "Debe Ingresar Parametro de Glucosa al Azar del Paciente.<br>";
    var Variable5 = new Object();
    Variable5.valor = $("#var4A").val();
    Variable5.texto = "Debe Ingresar Parametro de Glucosa post Prandial del Paciente.<br>";
    var Variable6 = new Object();
    Variable6.valor = $("#var5A").val();
    Variable6.texto = "Debe Ingresar Parametro de Hemoglobina Glicosilada del Paciente.<br>";
    var Variable7 = new Object();
    Variable7.valor = $("#fecha_inicio").val();
    Variable7.texto = "Debe Ingresar Fecha de Inicio del Seguimiento.<br>";
    var Variable8 = new Object();
    Variable8.valor = $("#proxima_cita").val();
    Variable8.texto = "Debe Ingresar Fecha de Proxima Visita del Seguimiento.<br>";


    var Validaciones = new Array();
    Validaciones.push(Variable);
    Validaciones.push(Variable2);
    Validaciones.push(Variable3);
    Validaciones.push(Variable4);
    Validaciones.push(Variable5);
    Validaciones.push(Variable6);
    Validaciones.push(Variable7);
    Validaciones.push(Variable8);

    debugger;
    Validaciones.forEach(function (value, indice, array) {
        console.log("En el índice " + indice + " hay este valor: " + value.valor);
        var texto = value.valor;
        if (texto.length == 0) {
            Mensaje = Mensaje + "-" + value.texto;
        }
    });


    return Mensaje;

}

function volver_ficha(idPaciente) {
    $.redirect('../../vista/Operaciones/GestionFicha.php', {
        'idPaciente': idPaciente
    });

}

/** FUNCIONES FIJAS **/
function EvaluarSeguimiento() {

    $(".campo").each(function () {
        $("#" + $(this).attr("id")).keyup(function () {
            var elemento = $(this);
            var tipo = elemento.data("tipo");
            if (tipo == "numero") {
                var codigo = $(this).attr("id");
                codigo = codigo.replace("seg", "");
                codigo = codigo.trim();
                console.log(codigo);
                VerificarRango(elemento, codigo);
            } else if (tipo == "validar") {
                CalcularIMC();
            }

        });
    });
}

function VerificarRango(elemento, codigo) {

    var inicio = elemento.data("inicio");
    var fin = elemento.data("fin");
    var valor = elemento.val();
    if (valor == "" || valor == null) {
        $("#op" + codigo).empty();
        elemento.removeClass("incorrecto");
        elemento.removeClass("correcto");
    } else {
        if (codigo == 7) {
            if (sexo == 1) {
                var fin2 = elemento.data("fin2");
                if (valor >= inicio && valor <= fin) {
                    $("#op" + codigo).empty();
                    $("#op" + codigo).html(flecha_up);
                    elemento.removeClass("incorrecto");
                    elemento.addClass("correcto");
                } else {
                    $("#op" + codigo).empty();
                    $("#op" + codigo).html(flecha_down);
                    elemento.removeClass("correcto");
                    elemento.addClass("incorrecto");
                }
            } else {
                if (valor >= inicio && valor <= fin2) {
                    $("#op" + codigo).empty();
                    $("#op" + codigo).html(flecha_up);
                    elemento.removeClass("incorrecto");
                    elemento.addClass("correcto");
                } else {
                    $("#op" + codigo).empty();
                    $("#op" + codigo).html(flecha_down);
                    elemento.removeClass("correcto");
                    elemento.addClass("incorrecto");
                }
            }
        } else {
            if (valor >= inicio && valor <= fin) {
                $("#op" + codigo).empty();
                $("#op" + codigo).html(flecha_up);
                elemento.removeClass("incorrecto");
                elemento.addClass("correcto");
            } else {
                $("#op" + codigo).empty();
                $("#op" + codigo).html(flecha_down);
                elemento.removeClass("correcto");
                elemento.addClass("incorrecto");
            }
        }
    }
}

function CalcularIMC() {
    var resultado = 0;
    var talla = $("#talla").val();
    var peso = $("#peso").val();
    (talla == "") ? talla = 0: talla = talla;
    (peso == "") ? peso = 0: peso = peso;

    if (peso != 0) {
        resultado = parseFloat((peso / (Math.pow(talla, 2)))).toFixed(2);
        $("#imc").val(resultado);
        var porc = parseFloat((peso * 7) / 100).toFixed(2);
        $("#peso_actual").val(porc);
    } else {
        resultado = 0;
        $("#imc").val(resultado);
        $("#peso_actual").val(resultado);
    }
}

function prueba() {
    var Arreglo = new Array();
    var Respuestas = "";
    $(".campo").each(function () {
        Arreglo.push($(this).val());
        Respuestas = Respuestas + $(this).val() + "|";
    });

    console.log(Respuestas);

}

function prueba2() {
    var Arreglo = new Array();
    var Respuestas1 = "";
    var Respuestas2 = "";
   /* $(".opcion").each(function () {
        Arreglo.push($(this).val());
        Respuestas1 = Respuestas1 + $(this).val() + "|";
    });*/
    $(".campo").each(function () {
        Arreglo.push($(this).val());
        Respuestas2 = Respuestas2 + $(this).val() + "|";
    });

    $('.opcion[type=radio]').change(function(){
        if ($(this).val()==1) {
            Arreglo.push($(this).val());
            Respuestas2 = Respuestas2 + $(this).val() + "|";
        } else {
            Arreglo.push($(this).val());
            Respuestas2 = Respuestas2 + $(this).val() + "|";
        }
    });

    console.log(Respuestas1);
    console.log(Respuestas2);
}

init();
