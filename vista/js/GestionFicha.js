var tabla_seguimientos;

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

function Mostrar_lista(idPaciente, ano, mes) {
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
    $('#formularioSeguimientoVista')[0].reset();

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


init();
