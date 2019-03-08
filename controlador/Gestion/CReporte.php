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


    $Year=isset($_POST["Year"])? limpiarCadena($_POST["Year"]):"";

    $Mes=isset($_POST["Mes"])? limpiarCadena($_POST["Mes"]):"";


      /*-- Fin de Variables --*/
switch ($_GET["op"]){

    case 'recuperar_totales':
        $rspta=$control->RecuperarIndicadores($Year,$Mes);
        echo json_encode($rspta);
    break;

     case 'recuperar_indicadores_generales':
            $Listas=array();

      		$rpta = $control->ReporteCondicion();

         	while ($reg = $rpta->fetch_object()){
                    $condiciones=array();
					$condiciones["Condicion"]=$reg->Condicion;
                    $condiciones["TotalPaciente"]=$reg->TotalPaciente;
                $Listas["Condiciones"][]=$condiciones;
         	}

      		$rpta2 = $control->ReporteDiagnostico();
         	while ($reg2 = $rpta2->fetch_object()){
				    $diagnostico=array();
					$diagnostico["Diagnostico"]=$reg2->Diagnostico;
                    $diagnostico["TotalPaciente"]=$reg2->TotalPaciente;
                $Listas["Diagnosticos"][]=$diagnostico;
         	}


      		$rpta3 = $control->ReporteGradoInstruccion();
         	while ($reg3 = $rpta3->fetch_object()){
				    $grado=array();
					$grado["Grado"]=$reg3->GradoInstruccion;
                    $grado["TotalPaciente"]=$reg3->TotalPaciente;
                $Listas["GradoInstruccion"][]=$grado;
         	}

            echo json_encode($Listas);
       break;

}



?>
