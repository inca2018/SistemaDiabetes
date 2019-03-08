
function init(){

listar_year();

Mostrar_Informacion();

}
function listar_year() {
    $.post("../../controlador/Gestion/CGestionPacientes.php?op=listar_year", function (ts) {
        $("#select_ano").empty();
        $("#select_ano").append(ts);
    });
}
function buscar_reporte(){

    var year=$("#select_ano").val();
    var mes=$("#select_mes").val();
    if(year=='' || mes=='' ){
         swal("Error!", "Seleccione todos los indicadores para buscar reporte!.", "warning");
    }else{
         recuperar_totales(year,mes);
    }

}
function Mostrar_Informacion(){
      $.post("../../controlador/Gestion/CReporte.php?op=recuperar_indicadores_generales" , function(data, status){
          data = JSON.parse(data);
          console.log(data);

            $("#cabeceraCondicion").empty();
            $("#cuerpoCondicion").empty();

            var cabCondicion="";
            var cuerpoCondicion="";

            cabCondicion=cabCondicion+"<th class='text-center'>Condición</th>";
            cuerpoCondicion=cuerpoCondicion+"<th class='text-center'>N° de Pacientes</th>";

            data.Condiciones.forEach(function (element) {
                cabCondicion=cabCondicion+"<th class='text-center'>"+element.Condicion+"</th>";
                cuerpoCondicion=cuerpoCondicion+"<th class='text-center'>"+element.TotalPaciente+"</th>";
            });

            $("#cabeceraCondicion").html(cabCondicion);
            $("#cuerpoCondicion").html(cuerpoCondicion);

            /*------------------------------------*/

            $("#cabeceraDiagnostico").empty();
            $("#cuerpoDiagnostico").empty();

            var cabDiagnostico="";
            var cuerpoDiagnostico="";

            cabDiagnostico=cabDiagnostico+"<th class='text-center'>Diagnostico</th>";
            cuerpoDiagnostico=cuerpoDiagnostico+"<th class='text-center'>N° de Pacientes</th>";

            data.Diagnosticos.forEach(function (element) {
                cabDiagnostico=cabDiagnostico+"<th class='text-center'>"+element.Diagnostico+"</th>";
                cuerpoDiagnostico=cuerpoDiagnostico+"<th class='text-center'>"+element.TotalPaciente+"</th>";
            });

            $("#cabeceraDiagnostico").html(cabDiagnostico);
            $("#cuerpoDiagnostico").html(cuerpoDiagnostico);

               /*------------------------------------*/

            $("#cabeceraGradoInstruccion").empty();
            $("#cuerpoGradoInstruccion").empty();

            var cabgradoInstruccion="";
            var cuerpogradoInstruccion="";

            cabgradoInstruccion=cabgradoInstruccion+"<th class='text-center'>Grado de Instrucción</th>";
            cuerpogradoInstruccion=cuerpogradoInstruccion+"<th class='text-center'>N° de Pacientes</th>";

            data.GradoInstruccion.forEach(function (element) {
                cabgradoInstruccion=cabgradoInstruccion+"<th class='text-center'>"+element.Grado+"</th>";
                cuerpogradoInstruccion=cuerpogradoInstruccion+"<th class='text-center'>"+element.TotalPaciente+"</th>";
            });

            $("#cabeceraGradoInstruccion").html(cabgradoInstruccion);
            $("#cuerpoGradoInstruccion").html(cuerpogradoInstruccion);

        });
}
function recuperar_totales(year,mes){
    $.post("../../controlador/Gestion/CReporte.php?op=recuperar_totales",{Year:year,Mes:mes}, function(data, status){
      data = JSON.parse(data);
      console.log(data);

        $("#total1").empty();
        $("#total1").append(parseInt(data.TotalPaciente));

        $("#total2").empty();
        $("#total2").append(parseInt(data.totalMedico));

        $("#total3").empty();
        $("#total3").append(parseInt(data.totalFichasGeneral));

        $("#total4").empty();
        $("#total4").append(parseInt(data.totalFichasYear));


        $("#indMasculino").empty();
        $("#indFemenino").empty();
        $("#indPorConHG").empty();
        $("#indPorSinHG").empty();
        $("#indConHG").empty();
        $("#indSinHG").empty();
        $("#indConCol").empty();
        $("#indSinCol").empty();
        $("#indConHDL").empty();
        $("#indSinHDL").empty();
        $("#indConLDL").empty();
        $("#indSinLDL").empty();
        $("#indConIMC").empty();
        $("#indSinIMC").empty();

        $("#indMasculino").append(parseInt(data.TotalPacienteMasculino));
        $("#indFemenino").append(parseInt(data.TotalPacienteFemenino));
        $("#indPorConHG").append(parseFloat(data.PorcentajeHgCon));
        $("#indPorSinHG").append(parseFloat(data.PorcentajeHgSin));
        $("#indConHG").append(parseInt(data.CantidadHgSI));
        $("#indSinHG").append(parseInt(data.CantidadHgNO));
        $("#indConCol").append(parseInt(data.totalColesterolSI));
        $("#indSinCol").append(parseInt(data.totalColesterolNO));
        $("#indConHDL").append(parseInt(data.totalHDLSI));
        $("#indSinHDL").append(parseInt(data.totalHDLNO));
        $("#indConLDL").append(parseInt(data.totalLDLSI));
        $("#indSinLDL").append(parseInt(data.totalLDLNO));
        $("#indConIMC").append(parseInt(data.totalIMCSI));
        $("#indSinIMC").append(parseInt(data.totalIMCNO));


        $("#indTaller1").empty();
        $("#indTaller2").empty();
        $("#indTaller3").empty();
        $("#indTaller4").empty();
        $("#indTaller5").empty();
        $("#indTaller6").empty();

         $("#indTaller1").append("SI-> "+data.tallerGLUCSI+" NO ->"+data.tallerGLUCNO);
        $("#indTaller2").append("SI-> "+data.tallerNUTSI+" NO ->"+data.tallerNUTNO);
        $("#indTaller3").append("SI-> "+data.tallerDIASI+" NO ->"+data.tallerDIANO);
        $("#indTaller4").append("SI-> "+data.tallerINSSI+" NO ->"+data.tallerINSNO);
        $("#indTaller5").append("SI-> "+data.tallerPODSI+" NO ->"+data.tallerPODNO);
        $("#indTaller6").append("SI-> "+data.tallerPSISI+" NO ->"+data.tallerPSINO);

    });
}

init();

