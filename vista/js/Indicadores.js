
function init(){


}

function buscar_reporte(){
    var inicio=$("#FechaInicio").val();
    var fin=$("#FechaFin").val();
    if(inicio=='' || fin=='' ){
         swal("Error!", "Seleccione todos los indicadores para buscar reporte!.", "warning");
    }else{
         recuperar_totales(inicio,fin);
    }

}

function recuperar_totales(inicio,fin){
    $.post("../../controlador/Gestion/CReporte.php?op=recuperar_totales",{Inicio:inicio,Fin:fin}, function(data, status){
      data = JSON.parse(data);
      console.log(data);

        $("#total1").empty();
        $("#total1").append(data.pacientes);

        $("#total2").empty();
        $("#total2").append(data.atenciones);

        $("#total3").empty();
        $("#total3").append(data.adecuado_si);

        $("#total4").empty();
        $("#total4").append(data.adecuado_no);


        $("#condicion1").empty();
        $("#condicion1").html(data.condicion1);

        $("#condicion2").empty();
        $("#condicion2").html(data.condicion2);

        $("#condicion3").empty();
        $("#condicion3").html(data.condicion3);

        $("#tipo1").empty();
        $("#tipo1").html(data.tipo1);

         $("#tipo2").empty();
        $("#tipo2").html(data.tipo2);

         $("#tipo3").empty();
        $("#tipo3").html(data.tipo3);

         $("#tipo4").empty();
        $("#tipo4").html(data.tipo4);


    });
}

init();

