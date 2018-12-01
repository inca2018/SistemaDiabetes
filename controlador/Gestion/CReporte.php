<?php
   require_once "../../modelo/Gestion/MReporte.php";
   require_once '../../config/conexion.php';

   //require_once "../../modelos/MGeneral.php";

   $control = new MReporte();
   $con = new Conexion();

  $contador1=0;
  $contador2=0;
   //$general = new MGeneral();
   /* variables */
    ini_set('date.timezone','America/Lima');


    $idUser=isset($_POST["idUser"])? limpiarCadena($_POST["idUser"]):"";
    $idPerfil=isset($_POST["idPerfil"])? limpiarCadena($_POST["idPerfil"]):"";

    $grupo=isset($_POST["idGrupo"])? limpiarCadena($_POST["idGrupo"]):"";
    $id_ticket=isset($_POST["id_ticket"])? limpiarCadena($_POST["id_ticket"]):"";



    $FechaInicio=isset($_POST["Inicio"])? limpiarCadena($_POST["Inicio"]):"";
    $FechaFin=isset($_POST["Fin"])? limpiarCadena($_POST["Fin"]):"";
    $idEquipo=isset($_POST["idEquipo"])? limpiarCadena($_POST["idEquipo"]):"";

    ini_set('date.timezone','America/Lima');
    $fecha_actual=date('Y-m-d H:i:s',time());

    $ano=date("Y", strtotime($fecha_actual));
    $mes=date("m", strtotime($fecha_actual));


   $date = str_replace('/', '-', $FechaInicio);
   $FechaInicio = date("Y-m-d", strtotime($date));

   $date = str_replace('/', '-', $FechaFin);
   $FechaFin= date("Y-m-d", strtotime($date));

      /*-- Fin de Variables --*/
switch ($_GET["op"]){

         case 'recuperar_totales':
        $response=Array();


        $resu1=$control->total_pacientes($FechaInicio,$FechaFin);
        $response["pacientes"]=$resu1["TOTAL_PACIENTES"];

        $resu2=$control->total_atenciones($FechaInicio,$FechaFin);
        $response["atenciones"]=$resu2["TOTAL_ATENCIONES"];


        $rspta_paciente=$control->listar_paciente();
         while ($reg_paciente=$rspta_paciente->fetch_object()){
              $rspta_s=$control->total_adecuado($FechaInicio,$FechaFin,$reg_paciente->idPaciente);

             if($rspta_s["CONTAR"]==0){
                 $contador1=$contador1+1;
             }else{
                 $contador2=$contador2+1;
             }
         }

         $response["adecuado_si"]=$contador1;
         $response["adecuado_no"]=$contador2;

        $resu3=$control->condicion1($FechaInicio,$FechaFin);
        $response["condicion1"]=$resu3["TOTAL1"];

         $resu4=$control->condicion2($FechaInicio,$FechaFin);
        $response["condicion2"]=$resu4["TOTAL2"];



        $resu6=$control->tipo1($FechaInicio,$FechaFin);
        $response["tipo1"]=$resu6["TOTAL4"];

        $resu7=$control->tipo2($FechaInicio,$FechaFin);
        $response["tipo2"]=$resu7["TOTAL5"];
        $resu8=$control->tipo3($FechaInicio,$FechaFin);
        $response["tipo3"]=$resu8["TOTAL6"];
        $resu9=$control->tipo4($FechaInicio,$FechaFin);
        $response["tipo4"]=$resu9["TOTAL7"];
         $resu10=$control->tipo5($FechaInicio,$FechaFin);
        $response["tipo5"]=$resu10["TOTAL8"];
         $resu11=$control->tipo6($FechaInicio,$FechaFin);
        $response["tipo6"]=$resu11["TOTAL9"];
         $resu12=$control->tipo7($FechaInicio,$FechaFin);
        $response["tipo7"]=$resu12["TOTAL10"];


        echo json_encode($response);
    break;




}

function verificar($dato){
	if($dato["TOTAL"]==null){
		$dato["TOTAL"]=0;
	}
	return $dato;
}

function verificar2($dato){
	if($dato==null){
		$dato=0;
	}
	return $dato;
}

?>
