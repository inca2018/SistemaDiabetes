var tabla_pacientes;
function init(){

    listar_pacientes();
}
function listar_pacientes(){

   tabla_pacientes=$('#tablaPacientes').dataTable({
         "aProcessing": true,
         "aServerSide": true,
         "processing": true,
         'paging': true, // Table pagination
         'ordering': true, // Column ordering
         'info': true, // Bottom left status text
         responsive: true,
         dom: 'lBfrtip',
         buttons: [
                { extend: 'copy', className: 'btn-info' },
                { extend: 'csv', className: 'btn-info' },
                { extend: 'excel', className: 'btn-info', title: 'XLS-File' },
                { extend: 'pdf', className: 'btn-info', title: $('title').text(),orientation:'landscape',pageSize:'LEGAL'  },
                { extend: 'print', className: 'btn-info' }
            ],
         "ajax":{
            url: '../../controlador/Gestion/CGestionPacientes.php?op=listar_pacientes',
            type : "POST",

            dataType : "json",
            error: function(e){
               console.log(e.responseText);
            }
         },
         columnDefs: [
            { width: 10, targets: 2}
          ],
         fixedColumns: false,

         "bDestroy": true,
         //"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
         "order": [[ 0, "asc" ]],//Ordenar (columna,orden),
         // cambiar el lenguaje de datatable
         //oLanguage: español
      }).DataTable();

    tabla_pacientes.on( 'order.dt search.dt', function () {
        tabla_pacientes.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();


}
function ficha(idPaciente){
    $.redirect('../../vista/Operaciones/GestionFicha.php', {'idPaciente':idPaciente});
}
init();
