var ArregloVerificacion;
var sexo = 0;
var flecha_down = '<button class="btn btn-danger  btn-sm"type="button"><i class="fa fa-arrow-down"></i>';
var flecha_up = '<button class="btn btn-success  btn-sm"type="button"><i class="fa fa-arrow-up"></i></button>';

function init() {


    recuperar_pacientes();
    iniciar_componentes();
    EvaluarSeguimiento();
    var idSeguimiento = $("#idSeguimiento").val();
    if (idSeguimiento != 0) {
        RecuperarSeguimiento(idSeguimiento);
    }
}

function iniciar_componentes() {


    iniciar_radios();


    $("#formulario_seguimiento").on("submit", function (e) {
        guardaryeditar(e);

    });

    OpcionesHabilitar();
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

function RecuperarSeguimiento(idSeguimiento) {

    $.post("../../controlador/Gestion/CSeguimiento.php?op=RecuperarSeguimiento", {
        idSeguimiento: idSeguimiento
    }, function (data, status) {
        data = JSON.parse(data);

        //Recuperar Opciones 1
        var Opciones1 = data.op_opcion1.split("|");
        Opciones1.pop();

        //Recuperar Campos de Opciones 1
        var ArregloCampos = new Array();
        $(".campo").each(function () {
            ArregloCampos.push($(this));
        });
        // SETEAR VALORES RECUPERADOS 1
        for (var i = 0; i < Opciones1.length; i++) {
            ArregloCampos[i].val(Opciones1[i]);
        }
        //Recuperar Campos de Opciones 2 CAMPOS
        var Opciones2Campos = data.op_opcion2Campos.split("|");
        Opciones2Campos.pop();

        var Arreglo2Campos = new Array();
        $(".campo2").each(function () {
            Arreglo2Campos.push($(this));
        });
        // SETEAR VALORES RECUPERADOS 2
        for (var i = 0; i < Opciones2Campos.length; i++) {
            Arreglo2Campos[i].val(Opciones2Campos[i]);
        }

        var Opciones2Estado = data.op_opcion2Estado.split("|");
        Opciones2Estado.pop();

        var ArregloEstadoSI = new Array();
        var ArregloEstadoNO = new Array();
        $('.opcion2[type=radio][value=1]').each(function () {
            ArregloEstadoSI.push($(this));
        });
        $('.opcion2[type=radio][value=2]').each(function () {
            ArregloEstadoNO.push($(this));
        });

        for (var i = 0; i < Opciones2Estado.length; i++) {
            if (Opciones2Estado[i] == 1) {
                ArregloEstadoNO[i].prop("checked", false);
                ArregloEstadoSI[i].prop("checked", true);
            } else {
                ArregloEstadoNO[i].prop("checked", true);
                ArregloEstadoSI[i].prop("checked", false);
            }

        }


        var Opcion3Campos = data.op_opcion3Campos.split("|");
        Opcion3Campos.pop();
        var Opcion3Estados = data.op_opcion3Estado.split("|");
        Opcion3Estados.pop();

        var ArregloOpcion3Campos = new Array();
        $(".texto3").each(function () {
            ArregloOpcion3Campos.push($(this));
        });

        for (var i = 0; i < Opcion3Campos.length; i++) {
            ArregloOpcion3Campos[i].val(Opcion3Campos[i]);
        }

        var ArregloOpcion3EstadoSI = new Array();
        var ArregloOpcion3EstadoNO = new Array();
        $('.opcion3[type=radio][value=1]').each(function () {
            ArregloOpcion3EstadoSI.push($(this));
        });
        $('.opcion3[type=radio][value=2]').each(function () {
            ArregloOpcion3EstadoNO.push($(this));
        });


        for (var i = 0; i < Opcion3Estados.length; i++) {
            if (Opcion3Estados[i] == 1) {
                ArregloOpcion3EstadoNO[i].prop("checked", false);
                ArregloOpcion3EstadoSI[i].prop("checked", true);
            } else {
                ArregloOpcion3EstadoNO[i].prop("checked", true);
                ArregloOpcion3EstadoSI[i].prop("checked", false);
            }

        }



        var ArrregloOpcion4 = data.op_opcion4.split("|");
        ArrregloOpcion4.pop();

        var ArregloOpcion4Checks = new Array();
        $('.checkOpcion').each(function () {
            ArregloOpcion4Checks.push($(this));

        });

        for (var i = 0; i < ArrregloOpcion4.length; i++) {
            if (ArrregloOpcion4[i] == 1) {
                ArregloOpcion4Checks[i].prop("checked", true);
            } else {
                ArregloOpcion4Checks[i].prop("checked", false);
            }
        }

        var ArregloOpcionRecuperado5 = data.op_opcion5.split("|");
        ArregloOpcionRecuperado5.pop();

        var ArregloOpcion5SI = new Array();
        var ArregloOpcion5NO = new Array();
        $('.opcion5[type=radio][value=1]').each(function () {
            ArregloOpcion5SI.push($(this));
        });
        $('.opcion5[type=radio][value=2]').each(function () {
            ArregloOpcion5NO.push($(this));
        });
        console.log(ArregloOpcionRecuperado5);
        console.log(ArregloOpcion5SI);
        console.log(ArregloOpcion5NO);
        for (var i = 0; i < ArregloOpcionRecuperado5.length; i++) {

            if (ArregloOpcionRecuperado5[i]==1) {
                ArregloOpcion5NO[i].prop("checked",false);
                ArregloOpcion5SI[i].prop("checked",true);
            } else {
                ArregloOpcion5NO[i].prop("checked",true);
                ArregloOpcion5SI[i].prop("checked",false);
            }

        }



        var Arreglo5Fechas = data.op_opcion5Fechas.split("|");
        Arreglo5Fechas.pop();
        var Arreglo5Campos = new Array();

        $(".fechaOpcion").each(function () {
            Arreglo5Campos.push($(this));
        });

        for (var i = 0; i < Arreglo5Fechas.length; i++) {
            Arreglo5Campos[i].val(Arreglo5Fechas[i]);
        }

        $("#riesgo").val(data.Riesgo);
        $("#fecha_inicio").val(data.FechaInicio);
        $("#observaciones").val(data.Observaciones);

        $("#proxima_cita").val(data.FechaProximaCita);

        if(data.Taller1==1){
            $('#taller1[type=radio][value=1]').prop("checked", true);
            $('#taller1[type=radio][value=2]').prop("checked", false);
        }else{
           $('#taller1[type=radio][value=1]').prop("checked", false);
            $('#taller1[type=radio][value=2]').prop("checked", true);
        }
        if(data.Taller2==1){
            $('#taller2[type=radio][value=1]').prop("checked", true);
            $('#taller2[type=radio][value=2]').prop("checked", false);
        }else{
           $('#taller2[type=radio][value=1]').prop("checked", false);
            $('#taller2[type=radio][value=2]').prop("checked", true);
        }
        if(data.Taller3==1){
            $('#taller3[type=radio][value=1]').prop("checked", true);
            $('#taller3[type=radio][value=2]').prop("checked", false);
        }else{
           $('#taller3[type=radio][value=1]').prop("checked", false);
            $('#taller3[type=radio][value=2]').prop("checked", true);
        }


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
    $("#pre1").attr("disabled", "true");
    $("#tableta1").attr("disabled", "true");
    $("#pre2").attr("disabled", "true");
    $("#tableta2").attr("disabled", "true");
    $("#pre3").attr("disabled", "true");
    $("#tableta3").attr("disabled", "true");
    $("#pre4").attr("disabled", "true");
    $("#tableta4").attr("disabled", "true");
    $("#pre5").attr("disabled", "true");
    $("#tableta5").attr("disabled", "true");
    $("#pre6").attr("disabled", "true");
    $("#tableta6").attr("disabled", "true");
    $("#pre7").attr("disabled", "true");
    $("#tableta7").attr("disabled", "true");
    $("#pre8").attr("disabled", "true");
    $("#tableta8").attr("disabled", "true");
    $("#pre9").attr("disabled", "true");
    $("#tableta9").attr("disabled", "true");
    $("#pre10").attr("disabled", "true");
    $("#tableta10").attr("disabled", "true");
    $("#pre11").attr("disabled", "true");
    $("#tableta11").attr("disabled", "true");


    $('input:radio[name=taller1]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=taller2]').filter('[value=2]').attr('checked', true);
    $('input:radio[name=taller3]').filter('[value=2]').attr('checked', true);



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
    debugger;
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
        if(resultado>=18.5 && resultado<=24.9){
            $("#op11").empty();
            $("#op11").html(flecha_up);
        }else{
             $("#op11").empty();
            $("#op11").html(flecha_down);
        }
    } else {
        resultado = 0;
        $("#imc").val(resultado);
        $("#peso_actual").val(resultado);
         $("#op11").empty();
         $("#op11").html(flecha_down);
    }
}

function OpcionesHabilitar() {
    $('.opcion2[type=radio]').change(function () {
        var recuperado = $(this).val();
        var id = $(this).attr("id");
        var codigo = 0;
        codigo = id.replace("radio", "");
        codigo = codigo.trim();
        if (recuperado == 1) {
            $('#obs' + codigo).removeAttr("disabled");
        } else {
            $('#obs' + codigo).attr("disabled", "true");
            $('#obs' + codigo).val("");
        }
    });

    $('.opcionTexto[type=radio]').change(function () {
        debugger;
        var recuperado = $(this).val();
        var id = $(this).data("id");

        if (recuperado == 1) {
            $('#pre' + id).removeAttr("disabled");
            $('#tableta' + id).removeAttr("disabled");
        } else {
            $('#pre' + id).attr("disabled", "true");
            $('#pre' + id).val("");
            $('#tableta' + id).attr("disabled", "true");
            $('#tableta' + id).val("");
        }
    });
}

function VerificarCampos() {
    var Mensaje = "";
    var Variable = new Object();
    Variable.valor = $("#talla").val();
    Variable.texto = "Debe Ingresar Talla del Paciente.<br>";
    var Variable2 = new Object();
    Variable2.valor = $("#peso").val();
    Variable2.texto = "Debe Ingresar Peso del Paciente.<br>";
    var Variable3 = new Object();
    Variable3.valor = $("#seg2").val();
    Variable3.texto = "Debe Ingresar Parametro de Glucosa Ayunas del Paciente.<br>";
    var Variable4 = new Object();
    Variable4.valor = $("#seg3").val();
    Variable4.texto = "Debe Ingresar Parametro de Glucosa al Azar del Paciente.<br>";
    var Variable5 = new Object();
    Variable5.valor = $("#seg4").val();
    Variable5.texto = "Debe Ingresar Parametro de Glucosa post Prandial del Paciente.<br>";
    var Variable6 = new Object();
    Variable6.valor = $("#seg5").val();
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

    Validaciones.forEach(function (value, indice, array) {
        console.log("En el índice " + indice + " hay este valor: " + value.valor);
        var texto = value.valor;
        if (texto.length == 0) {
            Mensaje = Mensaje + "-" + value.texto;
        }
    });
    return Mensaje;
}

function GuardarSeguimiento() {

    var RespuestasOpcion1 = "";
    $(".campo").each(function () {
        RespuestasOpcion1 = RespuestasOpcion1 + $(this).val() + "|";
    });

    console.log(RespuestasOpcion1);

    var RespuestasOpcion2Radios = "";
    var RespuestasOpcion2Campos = "";

    $(".campo2").each(function () {
        RespuestasOpcion2Campos = RespuestasOpcion2Campos + $(this).val() + "|";
    });

    $('.opcion2[type=radio]').each(function () {
        if ($(this).is(':checked')) {
            RespuestasOpcion2Radios = RespuestasOpcion2Radios + $(this).val() + "|";
        }
    });

    var RespuestasOpcion3Radios = "";
    var RespuestasOpcion3Campos = "";

    // 66 opciones
    $('.opcion3[type=radio]').each(function () {

        if ($(this).is(':checked')) {
            RespuestasOpcion3Radios = RespuestasOpcion3Radios + $(this).val() + "|";
        }
    });

    // cajas de texto 22
    $(".texto3").each(function () {
        RespuestasOpcion3Campos = RespuestasOpcion3Campos + $(this).val() + "|";
    });

    var RespuestasOpcion4Check = "";

    $('.checkOpcion').each(function () {
        if (this.checked == true) {
            RespuestasOpcion4Check = RespuestasOpcion4Check + 1 + "|";
        } else {
            RespuestasOpcion4Check = RespuestasOpcion4Check + 2 + "|";
        }

    });

    var riesgo = $("#riesgo").val();
    var fechaInicio = $("#fecha_inicio").val();
    var Obs = $("#observaciones").val();
    var Taller1 = $("#taller1").val();
    var Taller2 = $("#taller2").val();
    var Taller3 = $("#taller3").val();
    var proximaCita = $("#proxima_cita").val();

    var Respuesta5 = "";
    var Respuesta5Fecha = "";
    $('.opcion5[type=radio]').each(function () {

        if ($(this).is(':checked')) {
            Respuesta5 = Respuesta5 + $(this).val() + "|";
        }
    });

    $(".fechaOpcion").each(function () {

        Respuesta5Fecha = Respuesta5Fecha + $(this).val() + "|";
    });
    var idSeguimiento=$("#idSeguimiento").val();
    var idPaciente = $("#idPaciente").val();
    var idAno = $("#idAno").val();
    var idMes = $("#idMes").val();
    var Mensaje_Validacion = VerificarCampos();
    if (Mensaje_Validacion.length == 0) {
        $("#contenedor").addClass("whirl");
        $("#contenedor").addClass("ringed");

        $.post("../../controlador/Gestion/CSeguimiento.php?op=guardaryeditar", {
            Opciones1: RespuestasOpcion1,
            Opciones2Radios: RespuestasOpcion2Radios,
            Opcion2Campos: RespuestasOpcion2Campos,
            Opcion3Radios: RespuestasOpcion3Radios,
            Opcion3Campos: RespuestasOpcion3Campos,
            Opcion4: RespuestasOpcion4Check,
            riesgo: riesgo,
            fechaInicio: fechaInicio,
            Obs: Obs,
            Taller1: Taller1,
            Taller2: Taller2,
            Taller3: Taller3,
            proximaCita: proximaCita,
            Opcion5: Respuesta5,
            Opcion5Fechas: Respuesta5Fecha,
            idSeguimiento:idSeguimiento,
            idPaciente: idPaciente,
            idAno: idAno,
            idMes: idMes


        }, function (data, status) {
            data = JSON.parse(data);
            $("#contenedor").removeClass("whirl");
            $("#contenedor").removeClass("ringed");

            if (data.Registro) {
                //swal("Acción:", data.Mensaje);
                swal({
                        title: "Seguimiento:",
                        text: data.Mensaje,
                        type: "success"
                    },
                    function () {
                        var idPaciente = $("#idPaciente").val();
                        $.redirect('../../vista/Operaciones/GestionFicha.php', {
                            'idPaciente': idPaciente
                        });

                    });
            } else {
                swal({
                        title: "Seguimiento:",
                        text: data.Mensaje,
                        type: "error"
                    },
                    function () {
                        var idPaciente = $("#idPaciente").val();
                        $.redirect('../../vista/Operaciones/GestionFicha.php', {
                            'idPaciente': idPaciente
                        });

                    });
            }

        });
    } else {
        notificar_warning("Validación:<br>" + Mensaje_Validacion);

    }



}

function Regresar() {
    console.log("REGRESO");
}

init();
