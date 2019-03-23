var tablaReporte;
function init(){


Mostrar_Informacion();

}


function Mostrar_Informacion(){
      $.post("../../controlador/Gestion/CReporte.php?op=recuperar_indicadores_generales" , function(data, status){
          data = JSON.parse(data);
          console.log(data);

            $("#cabeceraCondicion").empty();
            $("#cuerpoCondicion").empty();

            var cabCondicion="";
            var cuerpoCondicion="";

            data.Condiciones.forEach(function (element) {
                 cabCondicion=cabCondicion+'<div class="col-md-12 p-2 text-center bb fondo2"><b>'+element.Condicion+'</b></div>';
                 cuerpoCondicion=cuerpoCondicion+'<div class="col-md-12 p-2 text-center bb  fondo1">'+element.TotalPaciente+'<button class="btn btn-warning  btn-sm ml-3" onclick="PacienteCondicion('+element.idCondicion+')"><i class="fa fa-share"></i></button></div>';
            });

            $("#cabeceraCondicion").html(cabCondicion);
            $("#cuerpoCondicion").html(cuerpoCondicion);

            /*------------------------------------*/

            $("#cabeceraDiagnostico").empty();
            $("#cuerpoDiagnostico").empty();

            var cabDiagnostico="";
            var cuerpoDiagnostico="";

            data.Diagnosticos.forEach(function (element) {

                 cabDiagnostico=cabDiagnostico+'<div class="col-md-12 p-2 text-center bb fondo2"><b>'+element.Diagnostico+'</b></div>';
                 cuerpoDiagnostico=cuerpoDiagnostico+'<div class="col-md-12 p-2 text-center bb  fondo1">'+element.TotalPaciente+'<button class="btn btn-warning  btn-sm ml-3" onclick="PacienteDiagnostico('+element.idDiagnostico+')"><i class="fa fa-share"></i></button></div>';

            });

            $("#cabeceraDiagnostico").html(cabDiagnostico);
            $("#cuerpoDiagnostico").html(cuerpoDiagnostico);

               /*------------------------------------*/

            $("#cabeceraGradoInstruccion").empty();
            $("#cuerpoGradoInstruccion").empty();

            var cabgradoInstruccion="";
            var cuerpogradoInstruccion="";

            data.GradoInstruccion.forEach(function (element) {

                cabgradoInstruccion=cabgradoInstruccion+'<div class="col-md-12 p-2 text-center bb fondo2"><b>'+element.Grado+'</b></div>';
                cuerpogradoInstruccion=cuerpogradoInstruccion+'<div class="col-md-12 p-2 text-center bb  fondo1">'+element.TotalPaciente+'<button class="btn btn-warning  btn-sm ml-3" onclick="PacienteGradoInstruccion('+element.idGradoInstruccion+')"><i class="fa fa-share"></i></button></div>';
            });

            $("#cabeceraGradoInstruccion").html(cabgradoInstruccion);
            $("#cuerpoGradoInstruccion").html(cuerpogradoInstruccion);

        });
}

function PacienteCondicion(idCondicion){

    var Opcion="CONDICION";
    var id=idCondicion;


    $("#ModalReporte").modal("show");

    if(tablaReporte==null){
         tablaReporte = $('#tablaPacientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
          dom: 'lBfrtip',
         "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: 'Reporte'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte '
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CReporte.php?op=ListarReporte',
            type: "POST",
            dataType: "JSON",
            data:{"Opcion":Opcion,"id":id},
            error: function (e) {
                console.log(e.responseText);
            }
        },

        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaReporte.on('order.dt search.dt', function () {
        tablaReporte.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    }else{
        tablaReporte.destroy();
         tablaReporte = $('#tablaPacientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
          dom: 'lBfrtip',
         "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: 'Reporte'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte '
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CReporte.php?op=ListarReporte',
            type: "POST",
            dataType: "JSON",
            data:{"Opcion":Opcion,"id":id},
            error: function (e) {
                console.log(e.responseText);
            }
        },

        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaReporte.on('order.dt search.dt', function () {
        tablaReporte.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    }



}
function PacienteDiagnostico(idDiagnostico){
    var Opcion="DIAGNOSTICO";
    var id=idDiagnostico;
       $("#ModalReporte").modal("show");

    if(tablaReporte==null){
         tablaReporte = $('#tablaPacientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
          dom: 'lBfrtip',
         "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: 'Reporte'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte '
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CReporte.php?op=ListarReporte',
            type: "POST",
            dataType: "JSON",
            data:{"Opcion":Opcion,"id":id},
            error: function (e) {
                console.log(e.responseText);
            }
        },

        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaReporte.on('order.dt search.dt', function () {
        tablaReporte.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    }else{
        tablaReporte.destroy();
         tablaReporte = $('#tablaPacientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
          dom: 'lBfrtip',
         "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: 'Reporte'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte '
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CReporte.php?op=ListarReporte',
            type: "POST",
            dataType: "JSON",
            data:{"Opcion":Opcion,"id":id},
            error: function (e) {
                console.log(e.responseText);
            }
        },

        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaReporte.on('order.dt search.dt', function () {
        tablaReporte.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    }


}
function PacienteGradoInstruccion(idGradoInstruccion){
     var Opcion="GRADO";
    var id=idGradoInstruccion;


     $("#ModalReporte").modal("show");

    if(tablaReporte==null){
         tablaReporte = $('#tablaPacientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
          dom: 'lBfrtip',
         "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: 'Reporte'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte '
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CReporte.php?op=ListarReporte',
            type: "POST",
            dataType: "JSON",
            data:{"Opcion":Opcion,"id":id},
            error: function (e) {
                console.log(e.responseText);
            }
        },

        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaReporte.on('order.dt search.dt', function () {
        tablaReporte.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    }else{
        tablaReporte.destroy();
         tablaReporte = $('#tablaPacientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
          dom: 'lBfrtip',
         "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: 'Reporte'
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Reporte '
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Gestion/CReporte.php?op=ListarReporte',
            type: "POST",
            dataType: "JSON",
            data:{"Opcion":Opcion,"id":id},
            error: function (e) {
                console.log(e.responseText);
            }
        },

        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaReporte.on('order.dt search.dt', function () {
        tablaReporte.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    }

}

init();

