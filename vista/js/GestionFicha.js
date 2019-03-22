var tabla_seguimientos;
var sexo;
var Lista_Medicos;
var Listas_Comorbilidad;
var DiagnosticoEnfermeria;
var Tratamientos;
var Evaluado;
var Satisfaccion;
function init() {
    var idPaciente = $("#idPaciente").val();
    RecuperarInformacionPaciente(idPaciente);
    listar_seguimiento();
    listar_year();

}

function listar_year() {
    $.post("../../controlador/Gestion/CGestionPacientes.php?op=listar_year", function (ts) {
        $("#select_ano").empty();
        $("#select_ano").append(ts);
    });
}

function RecuperarInformacionPaciente(idPaciente) {
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
         sexo = data.sexo
    });
}

function listar_seguimiento() {

    $('#select_ano').on('change', function () {

        var idPaciente = $("#idPaciente").val();
        var ano = $("#select_ano").val();
        var mes = $("#select_mes").val();
        if (ano == '' || mes == '') {
            if (tabla_seguimientos != null) {
                Mostrar_lista(0, 0);
            }
        } else {
            Mostrar_lista(idPaciente, ano, mes);
        }
    });

    $('#select_mes').on('change', function () {

        var idPaciente = $("#idPaciente").val();
        var ano = $("#select_ano").val();
        var mes = $("#select_mes").val();
        if (ano == '' || mes == '') {
            if (tabla_seguimientos != null) {
                Mostrar_lista(0, 0);
            }
        } else {
            Mostrar_lista(idPaciente, ano, mes);
        }
    });
}
function RecuperarTotales(idPaciente,ano,mes){
    $.post("../../controlador/Gestion/CGestion.php?op=RecuperarTotales", {
        idPaciente: idPaciente,
        year: ano,
        mes: mes
    }, function (data, status) {
         data = JSON.parse(data);

      $("#totalFicha").empty();
      $("#totalFicha").append(data.TotalFicha);

     var porcentaje=Formato_Moneda(parseFloat((data.TotalFicha*100)/3),2)+" %";
    $("#porcFicha").empty();
      $("#porcFicha").append(porcentaje);

    });

}
function Mostrar_lista(idPaciente, ano, mes) {
    RecuperarTotales(idPaciente,ano,mes);
    if (tabla_seguimientos == null) {
        tabla_seguimientos = $('#datatable_seguimiento').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            "processing": true,
            'paging': true, // Table pagination
            'ordering': true, // Column ordering
            'info': true, // Bottom left status text
            responsive: true,
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-info'
                },
                {
                    extend: 'csv',
                    className: 'btn-info'
                },
                {
                    extend: 'excel',
                    className: 'btn-info',
                    title: 'XLS-File'
                },
                {
                    extend: 'pdf',
                    className: 'btn-info',
                    title: $('title').text(),
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'print',
                    className: 'btn-info'
                }
            ],
            "ajax": {
                url: '../../controlador/Gestion/CGestionPacientes.php?op=listar_seguimientos',
                type: "POST",
                data: {
                    idPaciente: idPaciente,
                    ano: ano,
                    mes: mes
                },
                dataType: "json",
                error: function (e) {
                    console.log(e.responseText);
                }
            },

            "columnDefs": [{
                "className": "dt-justify",
                "targets": "_all"
            }],
            "bDestroy": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[0, "asc"]], //Ordenar (columna,orden),
            // cambiar el lenguaje de datatable
            oLanguage: español
        }).DataTable();

    } else {

        tabla_seguimientos.destroy();
        tabla_seguimientos = $('#datatable_seguimiento').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            "processing": true,
            'paging': true, // Table pagination
            'ordering': true, // Column ordering
            'info': true, // Bottom left status text
            responsive: true,
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-info'
                },
                {
                    extend: 'csv',
                    className: 'btn-info'
                },
                {
                    extend: 'excel',
                    className: 'btn-info',
                    title: 'XLS-File'
                },
                {
                    extend: 'pdf',
                    className: 'btn-info',
                    title: $('title').text(),
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'print',
                    className: 'btn-info'
                }
            ],
            "ajax": {
                url: '../../controlador/Gestion/CGestionPacientes.php?op=listar_seguimientos',
                type: "POST",
                data: {
                    idPaciente: idPaciente,
                    ano: ano,
                    mes: mes
                },
                dataType: "json",
                error: function (e) {
                    console.log(e.responseText);
                }
            },

            "columnDefs": [{
                "className": "dt-justify",
                "targets": "_all"
            }],
            "bDestroy": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[0, "asc"]], //Ordenar (columna,orden),
            // cambiar el lenguaje de datatable
            oLanguage: español
        }).DataTable();

    }

}

function agregar_seguimiento() {
    var idPaciente = $("#idPaciente").val();
    var ano = $("#select_ano").val();
    var mes = $("#select_mes").val();

    if (ano == '' || mes == '') {
        swal("Error:", "Seleccione Año y Mes para continuar!");
    } else {
        $.redirect('../../vista/Operaciones/Ficha.php', {
            'idSeguimiento': 0,
            'idPaciente': idPaciente,
            'idAno': ano,
            'idMes': mes
        });
    }
}

function volver() {
    $.redirect('../../vistas/Operaciones/gestion_pacientes.php');
}

function limpiar_modal() {
    $("#modal_seguimiento").modal("hide");
    $("#modal_pie").modal("hide");
}

function informacion(idSeguimiento, idPaciente, ano, mes) {
    limpiar_modal();

    $('#modal_seguimiento').modal({
        backdrop: 'static',
        keyboard: false
    })
    $("#modal_seguimiento").modal('show');

    $.post("../../controlador/Gestion/CSeguimiento.php?op=recuperarSeguimiento", {
        idPaciente: idPaciente,
        idAno: ano,
        idMes: mes
    }, function (data, status) {
        data = JSON.parse(data);


        $("#fecha_creacion").empty();
        $("#fecha_creacion").append("Fecha de Evaluación : " + data.fechaRegistro);

        $("#var1AI").attr("disabled", "true");
        $("#var2AI").attr("disabled", "true");
        $("#var3AI").attr("disabled", "true");
        $("#var4AI").attr("disabled", "true");
        $("#var5AI").attr("disabled", "true");
        $("#var6AI").attr("disabled", "true");
        $("#var7AI").attr("disabled", "true");
        $("#var8AI").attr("disabled", "true");
        $("#var9AI").attr("disabled", "true");
        $("#var10AI").attr("disabled", "true");
        $("#var11AI").attr("disabled", "true");
        $("#var12AI").attr("disabled", "true");
        $("#var13AI").attr("disabled", "true");
        $("#var14AI").attr("disabled", "true");

        $("#talla").attr("disabled", "true");
        $("#peso").attr("disabled", "true");

        $("#var1AI").val(data.A1);
        $("#var2AI").val(data.A2);
        $("#var3AI").val(data.A3);
        $("#var4AI").val(data.A4);
        $("#var5AI").val(data.A5);
        $("#var6AI").val(data.A6);
        $("#var7AI").val(data.A7);
        $("#var8AI").val(data.A8);
        $("#var9AI").val(data.A9);
        $("#var10AI").val(data.A10);
        $("#var11AI").val(data.A11);
        $("#var12AI").val(data.A12);
        $("#var13AI").val(data.A13);
        $("#var14AI").val(data.A14);

        $("#talla").val(data.A14);
        $("#peso").val(data.A14);


        $('input:radio[id=var1BI]').filter('[value=' + data.B1 + ']').attr('checked', true);
        $('input:radio[id=var2BI]').filter('[value=' + data.B2 + ']').attr('checked', true);
        $('input:radio[id=var3BI]').filter('[value=' + data.B3 + ']').attr('checked', true);
        $('input:radio[id=var4BI]').filter('[value=' + data.B4 + ']').attr('checked', true);
        $('input:radio[id=var5BI]').filter('[value=' + data.B5 + ']').attr('checked', true);
        $('input:radio[id=var6BI]').filter('[value=' + data.B6 + ']').attr('checked', true);
        $('input:radio[id=var7BI]').filter('[value=' + data.B7 + ']').attr('checked', true);
        $('input:radio[id=var8BI]').filter('[value=' + data.B8 + ']').attr('checked', true);
        $('input:radio[id=var9BI]').filter('[value=' + data.B9 + ']').attr('checked', true);


        $("#obs1I").attr("disabled", "true");
        $("#obs2I").attr("disabled", "true");
        $("#obs3I").attr("disabled", "true");
        $("#obs4I").attr("disabled", "true");
        $("#obs5I").attr("disabled", "true");
        $("#obs6I").attr("disabled", "true");
        $("#obs7I").attr("disabled", "true");
        $("#obs8I").attr("disabled", "true");
        $("#obs9I").attr("disabled", "true");

        $("#obs1I").val(data.OBS1);
        $("#obs2I").val(data.OBS2);
        $("#obs3I").val(data.OBS3);
        $("#obs4I").val(data.OBS4);
        $("#obs5I").val(data.OBS5);
        $("#obs6I").val(data.OBS6);
        $("#obs7I").val(data.OBS7);
        $("#obs8I").val(data.OBS8);
        $("#obs9I").val(data.OBS9);



        $("#riesgoI").attr("disabled", "true");
        $("#riesgoI").val(data.Riesgo);

        $("#fecha_inicioI").attr("disabled", "true");
        $("#fecha_inicioI").val(data.fechaInicio);

        $("#observacionesI").attr("disabled", "true");
        $("#observacionesI").val(data.Observaciones);

        $("#proxima_citaI").attr("disabled", "true");
        $("#proxima_citaI").val(data.ProximaCita);

        $('input:radio[id=taller1I]').filter('[value=' + data.Taller1 + ']').attr('checked', true);
        $('input:radio[id=taller2I]').filter('[value=' + data.Taller2 + ']').attr('checked', true);
        $('input:radio[id=taller3I]').filter('[value=' + data.Taller3 + ']').attr('checked', true);

    });


}

function EditarSeguimiento(idSeguimiento, idPaciente, idAno, idMes) {
    swal({
        title: "Editar?",
        text: "Esta Seguro que desea Editar Seguimiento!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Editar!",
        closeOnConfirm: false
    }, function () {
        EnvioEditarSeguimiento(idSeguimiento, idPaciente, idAno, idMes);

    });
}

function EnvioEditarSeguimiento(idSeguimiento, idPaciente, idAno, idMes) {
    $.redirect('../../vista/Operaciones/Seguimiento.php', {
        'idSeguimiento': idSeguimiento,
        'idPaciente': idPaciente,
        'idAno': idAno,
        'idMes': idMes
    });
}

function EliminarSeguimiento(idSeguimiento, idPaciente, idAno, idMes) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Seguimiento!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        EnvioEliminarSeguimiento(idSeguimiento, idPaciente, idAno, idMes);

    });
}

function EnvioEliminarSeguimiento(idSeguimiento, idPaciente, idAno, idMes) {
    $.post("../../controlador/Gestion/CSeguimiento.php?op=EliminarSeguimiento", {
        idSeguimiento: idSeguimiento
    }, function (data, status) {
        data = JSON.parse(data);
        if (data.Eliminar) {
            swal("Eliminado!", data.Mensaje, "success");
            tabla_seguimientos.ajax.reload();
        } else {
            swal("Error", data.Mensaje, "error");
        }
    });
}

function VerFicha(idSeguimiento) {
    $("#modal_seguimiento").modal("show");
    $.post("../../controlador/Gestion/CFicha.php?op=RecuperarListas", function (data, status) {
        data = JSON.parse(data);

        Lista_Medicos = data.medicos;
        Listas_Comorbilidad = data.comorbilidad;
        DiagnosticoEnfermeria = data.enfermeria;
        Tratamientos = data.tratamientos;
        Evaluado = data.evaluado;
        Satisfaccion = data.satisfaccion;

        RecuperarGrupos(idSeguimiento);
        RecuperarEspecialidades(idSeguimiento);

    });

}
function VerPie(idSeguimiento){

    $("#modal_pie").modal("show");
    RecuperarResultadoPie(idSeguimiento);

}

function RecuperarEspecialidades(idSeguimiento) {
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
                    '<div class="col-md-6 mt-5">' +
                    '<label for="">' + especialidad + '</label>' +
                    '</div>' +
                    '<div class="col-md-6 mt-5">' +
                    '<div class="row">' +
                    '<label for="" class="col-md-3 ">SI</label>' +
                    '<input id="SIE' + idEspecialidad + '" class="form-control opcion2 col-md-3 mt-1" type="radio" name="radioE' + idEspecialidad + '" value="1">' +
                    '<label for="" class="col-md-3 ">NO</label>' +
                    '<input id="NOE' + idEspecialidad + '" class="form-control opcion2 col-md-3 mt-1" type="radio" name="radioE' + idEspecialidad + '" value="0" checked>' +
                    '</div>' +
                    '</div>' +

                    '<div class="col-md-3">' +
                    ' <div class="form-group">' +
                    '<label for="OpcionTipoCampo" class="col-form-label">Diagnosticos:</label>' +
                    '<select class="form-control" id="OptionDiag' + idEspecialidad + '" data-message="' + especialidad + ' - Diagnostico" name="OpcionTipoCampo" disabled>' +
                    diagnosticos + '</select>' +
                    ' </div>' +
                    ' </div>' +
                    '<div class="col-md-3">' +
                    ' <div class="form-group">' +
                    ' <label for="OpcionTipoCampo" class="col-form-label">Medico:</label>' +
                    '<select class="form-control  " id="OptionMedico' + idEspecialidad + '" data-message="' + especialidad + ' - Medico" name="OpcionTipoCampo"  disabled>' + medicos +

                    '</select>' +
                    '</div>' +
                    ' </div>' +
                    '<div class="col-md-3">' +
                    ' <div class="form-group">' +
                    ' <label for="" class="col-form-label">Tratamiento:</label>' +
                    ' <input type="text" class="form-control"  data-message="' + especialidad + ' - Tratamiento" id="tratamiento' + idEspecialidad + '" disabled>' +
                    '</div>' +
                    '</div>' +
                    ' <div class="col-md-3">' +
                    ' <div class="form-group">' +
                    '<label for="" class="col-form-label">Observaciones:</label>' +
                    ' <input type="text" class="form-control" data-message="' + especialidad + ' - Observaciones" id="Obser' + idEspecialidad + '" disabled>' +
                    '</div>' +
                    '</div>' +
                    ' </div>';
            });
            query =query+'<div class="col-md-12">' +
                '<label class="">Paciente Refiere:</label><input type="hidden" id="ocultoRefiere">' +
                '<textarea id="RefiereOpcion" class="form-control  caja campo opcionCampo" data-tipo="20" type="text" step="any"  ></textarea>' +
                '</div>';

            $("#contenedorEspecialidades").html(query);
            LanzarFuncionesEspecialidad();
            RecuperarResultadosEspecialidad(idSeguimiento);
        });

    });

}

function RecuperarGrupos(idSeguimiento) {
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
            var riesgo = '<div class="card border-primary mb-1">' +
            '<div class="card-header text-white bg-primary" id="headingEspecialidad">' +
            '<h4 class="mb-0"><a class="text-inherit" data-toggle="collapse" data-target="#collapseRiesgo" aria-expanded="false" aria-controls="collapseRiesgo" href="">CATEGORIZACIÓN DE RIESGO</a>' +
            '</h4>' +
            '</div>' +
            '<div class="collapse" id="collapseRiesgo" aria-labelledby="headingEspecialidad" data-parent="#accordion">' +
            '<div class="card-body border-top">' +
            '<div class="row p-3" >' +
            '<div class="col-md-3 bb bt bl p-2 text-center fondo1">PACIENTE BAJO RIESGO<br>Todo lo siguiente</div>'+
            '<div class="col-md-3 bt bb bl p-2 text-center fondo2">MODERADO RIESGO<br>Uno o Más de lo siguiente</div>'+
            '<div class="col-md-3 bt bb bl p-2 text-center fondo3">ALTO RIESGO<br>Uno de los siguientes</div>'+
            '<div class="col-md-3 bt bb br p-2 text-center fondo4">MUY ALTO RRIESGO<br>Uno de los siguientes</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opA1" class="m-2 riesgoOpcion">Percibe Monofilamento</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opA2" class="m-2 riesgoOpcion">No percibe monofilamento</div>'+
            '<div class="col-md-3 bb bl br p-1 text-left "><input  type="checkbox" id="opA3" class="m-2 riesgoOpcion">No percibe diapazon</div>'+
            '<div class="col-md-3 bb br p-1 text-left "><input  type="checkbox" id="opA4" class="m-2 riesgoOpcion">Úlcera activa</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opB1" class="m-2 riesgoOpcion">Ninguna úlcera previa</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opB2" class="m-2 riesgoOpcion">Piel o uñas de riesgo</div>'+
            '<div class="col-md-3 bb bl br p-1 text-left "><input  type="checkbox" id="opB3" class="m-2 riesgoOpcion">Deformidad severa</div>'+
            '<div class="col-md-3 bb br p-1 text-left "><input  type="checkbox" id="opB4" class="m-2 riesgoOpcion">Dedo o pie amputado</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opC1" class="m-2 riesgoOpcion">Ninguna  deformidad severa</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opC2" class="m-2 riesgoOpcion">Pulso tibial de dificil percepción</div>'+
            '<div class="col-md-3 bb bl br p-1 text-left "><input  type="checkbox" id="opC3" class="m-2 riesgoOpcion">Ausencia de Pulso</div>'+
            '<div class="col-md-3 bb br p-1 text-left "><input  type="checkbox" id="opC4" class="m-2 riesgoOpcion">Úlcera Antigua</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opD1" class="m-2 riesgoOpcion">Pulsos pedio presentes</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opD2" class="m-2 riesgoOpcion">Una deformidad leve</div>'+
            '<div class="col-md-3 bb bl br p-1 text-left "></div>'+
            '<div class="col-md-3 bb br p-1 text-left "></div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opE1" class="m-2">Ninguna Amputación</div>'+
            '<div class="col-md-3 bb bl p-1 text-left "><input  type="checkbox" id="opE2" class="m-2">Formación de callos</div>'+
            '<div class="col-md-3 bb bl br p-1 text-left "></div> '+
            '<div class="col-md-3 bb br p-1 text-left "></div>'+

            ' </div>' +
            '</div>' +
            '</div>' +
            '</div>';
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


        Html = Html + riesgo;
        Html = Html + especialidades;

        $("#accordion_info").html(Html);

        LanzarFunciones();
        //LanzarFuncionOpcionesPie();
    });
}

function RecuperarTipoOpcion(elemento, contador, grupo) {

    var idOpcion = elemento.id;
    var Titulo = elemento.titulo;

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
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango validar" data-message="' + grupo + ' - ' + Titulo + '" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
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
            opcion = '<input type="hidden" class="opcionOculto " id="OF' + idOpcion + '"  data-minimo="' + minimo + '" data-maximo="' + maximo + '" data-sexo="">' +
                '<div class="col-md-12"><label class="">' + Titulo + '(' + atributo + ') - ' + paciente + ':</label></div>' +
                '<div class="col-md-4">' +
                '<input id="OP' + idOpcion + '" class="form-control  caja campo FuRango validar" data-message="' + grupo + ' - ' + Titulo + '" data-id="' + idOpcion + '" data-atributo="' + atributo + '" data-tipo="' + Tipo + '" data-minimo="' + minimo + '" data-maximo="' + maximo + '" type="text" step="any"  maxlength="100" placeholder="' + place + '" onkeypress="return SoloNumerosModificado(event,4,this.id);">' +
                '</div>' +
                '<div class="col-md-2">' +
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
                ' <input class="form-control opcionFecha validar" type="text" id="FE' + idOpcion + '" data-message="' + grupo + ' - ' + Titulo + '" data-tipo="' + Tipo + '" data-id="' + idOpcion + '" autocomplete="off">' +
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
                '<div class="form-group  col-md-8"> ' +
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
                ' <label for="" class="col-md-3">SI</label>' +
                ' <input id="SI' + idOpcion + '" class="form-control opcion2 col-md-3 condicion' + idOpcion + '" type="radio" name="radio' + idOpcion + '" value="1">' +
                ' <label for="" class="col-md-3">NO</label>' +
                ' <input id="NO' + idOpcion + '" class="form-control opcion2 col-md-3 condicion' + idOpcion + '" type="radio" name="radio' + idOpcion + '" value="0" checked> ' +
                '  </div> ' +
                ' </div> ' +
                '</div>' +

                '<div class="col-md-4" style="display:none;" id="area' + idOpcion + '"> <select class="form-control " data-message="' + grupo + ' - ' + Titulo + ' - Listado" id="SELECT' + idOpcion + '" name="" disabled></select></div>' +
                '<div class=" col-md-4" style="display:none;" id="DO' + idOpcion + '" ><input id="dosis' + idOpcion + '" class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="DOSIS/DIA" disabled></div>' +
                '<div class=" col-md-4" style="display:none;" id="TA' + idOpcion + '"><input id="tab' + idOpcion + '"  class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="NUM. INYECC." disabled></div>';
            break;

        case "10":
            opcion = '<div class="col-md-12">' +
                '<h5 class="text-info"><em>' + Titulo + '</em></h5>' +
                '</div>';

            break;
      case "11":
            var TipoCampos = Propiedades.TipoCampo;

            opcion = '<input type="hidden" class="opcionOculto opcionCondicionCampo" id="OF' + idOpcion + '" data-tipocampo="' + TipoCampos + '">' +
                '<div class="col-md-12"><label class="col-form-label">' + Titulo + ':</label></div>' +
                '<div class="col-md-4" style="display:none;" id="area'+idOpcion+'"> <select class="form-control " data-message="'+grupo+' - '+Titulo+' - Listado" id="SELECT' + idOpcion + '" name=""></select></div>'+
                '<div class=" col-md-4" style="display:none;" id="DO' + idOpcion + '" ><input id="dosis'+idOpcion+'" class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="DOSIS/DIA" disabled></div>'+
                '<div class=" col-md-4" style="display:none;" id="TA' + idOpcion + '"><input id="tab'+idOpcion+'"  class="form-control  caja campo opcionCampo" type="text"  maxlength="100" placeholder="NUM. INYECC." disabled></div>';
            break;
    }
    return opcion;
}

function quitarSeparador(valor) {

    var va = valor.replace(/SEP/gi, "");
    return va;
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

function LanzarFunciones() {

    $(".OpcionGeneral").each(function () {
        var id = $(this).data("id");
        var tipo = $(this).data("tipo");
        if (tipo == 9 || tipo == 11) {

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

}

function RecuperarResultadosEspecialidad(idSeguimiento){

     $.post("../../controlador/Gestion/CFicha.php?op=RecuperarResultadosEspecialidad",{idSeguimiento:idSeguimiento}, function (data, status) {
        data = JSON.parse(data);
       console.log(data);

         data.Resultado.forEach(function (element) {
             if(element.idEspecialidad==null){
                 switch(element.tipoOpcion){
                case '2':
                      $("#CAM"+element.idOpcion).val(element.RespuestaTexto);
                     $("#CAM"+element.idOpcion).attr("disabled",true);
                     break;
                case '3':
                     var min=$("#OF"+element.idOpcion).data("minimo");
                     var max=$("#OF"+element.idOpcion).data("maximo");
                     $("#OP"+element.idOpcion).val(element.RespuestaValor);

                     if(element.RespuestaValor>=min && element.RespuestaValor<=max){
                        $("#SI"+element.idOpcion).show();
                        }else{
                        $("#NO"+element.idOpcion).show();
                        }
                       $("#OP"+element.idOpcion).attr("disabled",true);
                     break;
                case '4':
                     var min=$("#OF"+element.idOpcion).data("minimo");
                     var max=$("#OF"+element.idOpcion).data("maximo");
                     $("#OP"+element.idOpcion).val(element.RespuestaValor);

                     if(element.RespuestaValor>=min && element.RespuestaValor<=max){
                        $("#SI"+element.idOpcion).show();
                        }else{
                        $("#NO"+element.idOpcion).show();
                        }
                       $("#OP"+element.idOpcion).attr("disabled",true);
                     break;
                 case '5':
                     $("#FE"+element.idOpcion).val(element.RespuestaFecha);
                      $("#FE"+element.idOpcion).attr("disabled",true);
                     break;
                case '6':
                    var propiedades=data = JSON.parse(element.Propiedades);
                    var v1=propiedades.v1;
                    var v2=propiedades.v2;
                    var v3=propiedades.v3;
                    var v4=propiedades.v4;
                    var min=$("#OF"+element.idOpcion).data("min");
                    var max=$("#OF"+element.idOpcion).data("max");

                     $("#F"+element.idOpcion).val(element.RespuestaValor);
                     $("#F"+element.idOpcion).attr("disabled",true);
                     if(element.RespuestaAdecuado>=min && element.RespuestaAdecuado<=max){
                        $("#SI"+element.idOpcion).show();
                        }else{
                        $("#NO"+element.idOpcion).show();
                        }

                     $(".opcionFormula").each(function () {
                        var elemento = $(this);
                        var id = elemento.data("id");

                        if (id == "" || id == null) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                     if(v1!=0){
                         $("#V1"+element.idOpcion).val(v1);
                         $("#V1"+element.idOpcion).attr("disabled",true);
                     }
                      if(v2!=0){
                         $("#V2"+element.idOpcion).val(v2);
                           $("#V2"+element.idOpcion).attr("disabled",true);
                     }
                     if(v3!=0){
                         $("#V3"+element.idOpcion).val(v3);
                          $("#V3"+element.idOpcion).attr("disabled",true);
                     }
                    if(v4!=0){
                         $("#V4"+element.idOpcion).val(v4);
                         $("#V4"+element.idOpcion).attr("disabled",true);
                     }

                     break;

                     case '7':
                      var respuesta=element.RespuestaAdecuado;
                      if(respuesta==1){
                         $('input:radio[id=radio1]').filter('[name=radio'+element.idOpcion+']').attr('checked', true);
                          $('input:radio[id=radio2]').filter('[name=radio'+element.idOpcion+']').attr('checked', false);
                         }else{
                          $('input:radio[id=radio1]').filter('[name=radio'+element.idOpcion+']').attr('checked', false);
                               $('input:radio[id=radio2]').filter('[name=radio'+element.idOpcion+']').attr('checked', true);
                         }

                      $('input:radio[id=radio1]').filter('[name=radio'+element.idOpcion+']').attr("disabled",true);
                     $('input:radio[id=radio2]').filter('[name=radio'+element.idOpcion+']').attr("disabled",true);

                     break;

                     case '9':
                       var propiedades=data = JSON.parse(element.Propiedades);
                       var tipocampo=propiedades.tipocampo;

                       var respuesta=element.RespuestaAdecuado;
                     if(respuesta==1){
                         $('input:radio[id=SI'+element.idOpcion+']').filter('[name=radio'+element.idOpcion+']').attr('checked', true);
                          $('input:radio[id=NO'+element.idOpcion+']').filter('[name=radio'+element.idOpcion+']').attr('checked', false);
                         }else{
                          $('input:radio[id=SI'+element.idOpcion+']').filter('[name=radio'+element.idOpcion+']').attr('checked', false);
                               $('input:radio[id=NO'+element.idOpcion+']').filter('[name=radio'+element.idOpcion+']').attr('checked', true);
                         }

                      $('input:radio[id=SI'+element.idOpcion+']').filter('[name=radio'+element.idOpcion+']').attr("disabled",true);
                      $('input:radio[id=NO'+element.idOpcion+']').filter('[name=radio'+element.idOpcion+']').attr("disabled",true);

                    if(tipocampo==1){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==2){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==3){
                        (propiedades.Dosis=="0")? $("#dosis"+element.idOpcion).val("") : $("#dosis"+element.idOpcion).val(propiedades.Dosis);
                        (propiedades.Num=="0")? $("#tab"+element.idOpcion).val("") : $("#tab"+element.idOpcion).val(propiedades.Num);


                    }else if(tipocampo==4){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==5){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==6){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==7){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }
                     break;

                case '11':
                       var propiedades=data = JSON.parse(element.Propiedades);
                       var tipocampo=propiedades.tipocampo;

                       var respuesta=element.RespuestaAdecuado;

                    if(tipocampo==1){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==2){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==3){
                        (propiedades.Dosis=="0")? $("#dosis"+element.idOpcion).val("") : $("#dosis"+element.idOpcion).val(propiedades.Dosis);
                        (propiedades.Num=="0")? $("#tab"+element.idOpcion).val("") : $("#tab"+element.idOpcion).val(propiedades.Num);


                    }else if(tipocampo==4){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==5){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==6){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }else if(tipocampo==7){
                        $("#SELECT"+element.idOpcion).val(propiedades.valorCampo);
                    }
                     break;
             }

             }else{
                 var propiedades=data = JSON.parse(element.Propiedades);
                 var Diagnostico=propiedades.Diagnostico;
                 var Medico=propiedades.Medico;
                 var Tratamiento=propiedades.Tratamiento;
                 var Observacion=propiedades.Observacion;
                 var id=element.idEspecialidad;

                  var respuesta=element.RespuestaAdecuado;
                      if(respuesta==1){
                         $('input:radio[id=SIE'+id+']').filter('[name=radioE'+id+']').attr('checked', true);
                          $('input:radio[id=NOE'+id+']').filter('[name=radioE'+id+']').attr('checked', false);
                         }else{
                          $('input:radio[id=SIE'+id+']').filter('[name=radioE'+id+']').attr('checked', false);
                               $('input:radio[id=NOE'+id+']').filter('[name=radioE'+id+']').attr('checked', true);
                         }

                      $('input:radio[id=SIE'+id+']').filter('[name=radioE'+id+']').attr("disabled",true);
                      $('input:radio[id=NOE'+id+']').filter('[name=radioE'+id+']').attr("disabled",true);

                    if(Diagnostico==0 || Diagnostico=='0'){
                        $("#OptionDiag"+id).attr("disabled",true);
                    }else{
                        $("#OptionDiag"+id).val(Diagnostico);
                    }

                 if(Medico==0 || Medico=='0'){
                        $("#OptionMedico"+id).attr("disabled",true);
                    }else{
                        $("#OptionMedico"+id).val(Medico);
                    }
                 if(Tratamiento==0 || Tratamiento=='0'){
                        $("#tratamiento"+id).attr("disabled",true);
                    }else{
                        $("#tratamiento"+id).val(Tratamiento);
                    }
                 if(Observacion==0 || Observacion=='0'){
                        $("#Obser"+id).attr("disabled",true);
                    }else{
                        $("#Obser"+id).val(Observacion);
                    }



             }

         });

         RecuperarResultadoRefiere(idSeguimiento);
       });
}
function RecuperarResultadoPie(idSeguimiento){
     $.post("../../controlador/Gestion/CFicha.php?op=RecuperarResultadoPie",{idSeguimiento:idSeguimiento}, function (data, status) {
        data = JSON.parse(data);
       console.log(data);

         VerificarOpcion(data.R1,1);
         VerificarOpcion(data.R2,2);
         VerificarOpcion(data.R3,3);
         VerificarOpcion(data.R4,4);
         VerificarOpcion(data.R5,5);
         VerificarOpcion(data.R6,6);
         VerificarOpcion(data.R7,7);
         VerificarOpcion(data.R8,8);

         });
}
function VerificarOpcion(valor,num){
    debugger;
        $("#PIE"+num).removeClass("Option");
        $("#PIE"+num).data("opcion",num);
        $("#PIE"+num).empty();
    switch (valor){
        case '1':
            $("#PIE"+num).addClass("OptionA");
            break;
        case '2':
            $("#PIE"+num).addClass("OptionB");
            $("#PIE"+num).html('<span><i class="fa fa-times" aria-hidden="true"></i></span>');
            break;
        case '3':
            $("#PIE"+num).addClass("OptionC");
            $("#PIE"+num).html('<span><i class="fa fa-check" aria-hidden="true"></i></span>');
            break;
        case '4':
            $("#PIE"+num).addClass("OptionD");
            break;
        case '5':
            $("#PIE"+num).addClass("OptionE");
            break;
    }
}
function RecuperarResultadoRefiere(idSeguimiento){
      $.post("../../controlador/Gestion/CFicha.php?op=RecuperarResultadoRefiere",{idSeguimiento:idSeguimiento}, function (data, status) {
        data = JSON.parse(data);
       console.log(data);

          var Respuestas = data.Riesgo.replace(/&quot;/g, '\"');
          var Respuestas=JSON.parse(Respuestas);

          (Respuestas.opA1==1)?$('#opA1').prop('checked', true):$('#opA1').prop('checked', false);
          (Respuestas.opA2==1)?$('#opA2').prop('checked', true):$('#opA2').prop('checked', false);
          (Respuestas.opA3==1)?$('#opA3').prop('checked', true):$('#opA3').prop('checked', false);
          (Respuestas.opA4==1)?$('#opA4').prop('checked', true):$('#opA4').prop('checked', false);

          (Respuestas.opB1==1)?$('#opB1').prop('checked', true):$('#opB1').prop('checked', false);
          (Respuestas.opB2==1)?$('#opB2').prop('checked', true):$('#opB2').prop('checked', false);
          (Respuestas.opB3==1)?$('#opB3').prop('checked', true):$('#opB3').prop('checked', false);
          (Respuestas.opB4==1)?$('#opB4').prop('checked', true):$('#opB4').prop('checked', false);

          (Respuestas.opC1==1)?$('#opC1').prop('checked', true):$('#opC1').prop('checked', false);
          (Respuestas.opC2==1)?$('#opC2').prop('checked', true):$('#opC2').prop('checked', false);
          (Respuestas.opC3==1)?$('#opC3').prop('checked', true):$('#opC3').prop('checked', false);
          (Respuestas.opC4==1)?$('#opC4').prop('checked', true):$('#opC4').prop('checked', false);

          (Respuestas.opD1==1)?$('#opD1').prop('checked', true):$('#opD1').prop('checked', false);
          (Respuestas.opD2==1)?$('#opD2').prop('checked', true):$('#opD2').prop('checked', false);

          (Respuestas.opE1==1)?$('#opE1').prop('checked', true):$('#opE1').prop('checked', false);
          (Respuestas.opE2==1)?$('#opE2').prop('checked', true):$('#opE2').prop('checked', false);

          $("#ocultoRefiere").val(data.Refiere);
          $("#RefiereOpcion").val('"'+data.Refiere+'"');

     });
}
init();
