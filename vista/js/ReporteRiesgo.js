var ListaPacientes = new Array();
var txtNumPacientes = $("#NumeroPacientesEncontrados");
var panelMostrarPacientes = $("#panelBotonMostrarPacientes");

function init() {
    Listar_Sexo();
    iniciarCampos();
}

function buscarReporte() {

    var f_inicio = $("#inicio1").val();
    var f_fin = $("#fin1").val();
    var sexo = $("#IndicadorSexo").val();
    if (f_inicio == '' || f_fin == '') {
        notificar_warning("Seleccione Fechas")
    } else {
        buscarReporteService(f_inicio, f_fin, sexo);
    }
}

function iniciarCampos() {
    txtNumPacientes.hide();
    panelMostrarPacientes.hide();
    $('#date_inicio1').datepicker({
        format: 'dd/mm/yyyy',

    });
    $('#date_fin1').datepicker({

        format: 'dd/mm/yyyy',
    });
    $('#date_inicio1').datepicker().on('changeDate', function (ev) {
        var f_inicio = $("#inicio1").val();
        var f_fin = $("#fin1").val();
        var day = parseInt(f_inicio.substr(0, 2));
        var month = parseInt(f_inicio.substr(3, 2));
        var year = parseInt(f_inicio.substr(6, 8));
        $('#date_fin1').datepicker('setStartDate', new Date(year, (month - 1), day));
    });

    $('#date_fin1').datepicker().on('changeDate', function (ev) {
        var f_inicio = $("#inicio1").val();
        var f_fin = $("#fin1").val();
        var day = parseInt(f_fin.substr(0, 2));
        var month = parseInt(f_fin.substr(3, 2));
        var year = parseInt(f_fin.substr(6, 8));

        $('#date_inicio1').datepicker('setEndDate', new Date(year, (month - 1), day));
    });
}

function Listar_Sexo() {
    $.post("../../controlador/Mantenimiento/CMedico.php?op=listar_sexo", function (ts) {
        $("#IndicadorSexo").empty();
        $("#IndicadorSexo").append(ts);
    });
}

function buscarReporteService(fechaInicio, fechaFin, Sexo) {
    console.log("Fecha Inicio:" + fechaInicio);
    console.log("Fecha Fin:" + fechaFin);
    console.log("Sexo:" + Sexo);

    $.post("../../controlador/Reporte/CReporteRiesgo.php?op=ListadoReporteRiesgo", {
        fechaInicio: fechaInicio,
        fechaFin: fechaFin,
        Sexo: Sexo
    }, function (data, status) {
        data = JSON.parse(data);
        console.log(data);
        var TopA1 = 0;
        var TopA2 = 0;
        var TopA3 = 0;
        var TopA4 = 0;
        var TopB1 = 0;
        var TopB2 = 0;
        var TopB3 = 0;
        var TopB4 = 0;
        var TopC1 = 0;
        var TopC2 = 0;
        var TopC3 = 0;
        var TopC4 = 0;
        var TopD1 = 0;
        var TopD2 = 0;
        var TopE1 = 0;
        var TopE2 = 0;
        ListaPacientes.splice(0);
        //Recorrer Item
        data.forEach(function (elemento) {
            debugger;
            var Riesgo = elemento.Riesgo;
            var Codigo = elemento.Codigo;
            var PacienteNombres = elemento.PacienteNombres;
            var DNI = elemento.DNI;
            var OpcionesRiesgo = Riesgo.replace(/&quot;/g, '\"');
            OpcionesRiesgo = JSON.parse(OpcionesRiesgo);
            TopA1 = parseInt(TopA1) + parseInt(OpcionesRiesgo.opA1);
            TopA2 = parseInt(TopA2) + parseInt(OpcionesRiesgo.opA2);
            TopA3 = parseInt(TopA3) + parseInt(OpcionesRiesgo.opA3);
            TopA4 = parseInt(TopA4) + parseInt(OpcionesRiesgo.opA4);
            TopB1 = parseInt(TopB1) + parseInt(OpcionesRiesgo.opB1);
            TopB2 = parseInt(TopB2) + parseInt(OpcionesRiesgo.opB2);
            TopB3 = parseInt(TopB3) + parseInt(OpcionesRiesgo.opB3);
            TopB4 = parseInt(TopB4) + parseInt(OpcionesRiesgo.opB4);
            TopC1 = parseInt(TopC1) + parseInt(OpcionesRiesgo.opC1);
            TopC2 = parseInt(TopC2) + parseInt(OpcionesRiesgo.opC2);
            TopC3 = parseInt(TopC3) + parseInt(OpcionesRiesgo.opC3);
            TopC4 = parseInt(TopC4) + parseInt(OpcionesRiesgo.opC4);
            TopD1 = parseInt(TopD1) + parseInt(OpcionesRiesgo.opD1);
            TopD2 = parseInt(TopD2) + parseInt(OpcionesRiesgo.opD2);
            TopE1 = parseInt(TopE1) + parseInt(OpcionesRiesgo.opE1);
            TopE2 = parseInt(TopE2) + parseInt(OpcionesRiesgo.opE2);

            //ArmarPacientes
            var Paciente = new Object();
            Paciente.nombres = PacienteNombres;
            Paciente.Codigo = Codigo;
            Paciente.Dni = DNI;
            ListaPacientes.push(Paciente);

        });
        MostrarResultadoOpcion("opA1", TopA1);
        MostrarResultadoOpcion("opA2", TopA2);
        MostrarResultadoOpcion("opA3", TopA3);
        MostrarResultadoOpcion("opA4", TopA4);
        MostrarResultadoOpcion("opB1", TopB1);
        MostrarResultadoOpcion("opB2", TopB2);
        MostrarResultadoOpcion("opB3", TopB3);
        MostrarResultadoOpcion("opB4", TopB4);
        MostrarResultadoOpcion("opC1", TopC1);
        MostrarResultadoOpcion("opC2", TopC2);
        MostrarResultadoOpcion("opC3", TopC3);
        MostrarResultadoOpcion("opC4", TopC4);
        MostrarResultadoOpcion("opD1", TopD1);
        MostrarResultadoOpcion("opD2", TopD2);
        MostrarResultadoOpcion("opE1", TopE1);
        MostrarResultadoOpcion("opE2", TopE2);

        var NumPacientes = ListaPacientes.length;
        panelMostrarPacientes.show();
        txtNumPacientes.show();
        txtNumPacientes.empty();
        txtNumPacientes.append("<h4>N° Pacientes Encontrados: " + NumPacientes + "</h4>")
    });
}

function MostrarResultadoOpcion(opcion, total) {
    $("#" + opcion).empty();
    $("#" + opcion).text(parseInt(total));
}

function MostrarPacientesEncontrados() {
    $("#ModalPacientesReporte").modal("show");
    var cuerpoTabla =$("#cuerpoElementos");
    var items = "";
    ListaPacientes.forEach(function (elemento,index) {
        var item = ArmarPaciente((parseInt(index)+1),elemento);
        items = items + item;
    });
    cuerpoTabla.html(items);

    $("#tablaPacientes").dataTable();
}

function ArmarPaciente(num,elemento) {
    var temp = "<tr>";
    temp = temp + "<td>"+num+"</td>";
    temp = temp + "<td>"+elemento.Codigo+"</td>";
    temp = temp + "<td>"+elemento.nombres+"</td>";
    temp = temp + "<td>"+elemento.Dni+"</td>";
    temp = temp + "</tr>";
    return temp;
}

init();
