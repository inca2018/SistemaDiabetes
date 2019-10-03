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

    $Inicio=isset($_POST["Inicio"])? limpiarCadena($_POST["Inicio"]):"";
    $Fin=isset($_POST["Fin"])? limpiarCadena($_POST["Fin"]):"";


    $Opcion=isset($_POST["Opcion"])? limpiarCadena($_POST["Opcion"]):"";
    $id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";

    $Sexo=isset($_POST["Sexo"])? limpiarCadena($_POST["Sexo"]):"";


 $num=isset($_POST["num"])? limpiarCadena($_POST["num"]):"";

   $date = str_replace('/', '-', $Inicio);
   $Inicio = date("Y-m-d", strtotime($date));

   $date = str_replace('/', '-', $Fin);
   $Fin = date("Y-m-d", strtotime($date));


      /*-- Fin de Variables --*/
switch ($_GET["op"]){

    case 'recuperar_totales':
        $rspta=$control->RecuperarIndicadores($Inicio,$Fin,$Sexo);
        echo json_encode($rspta);
    break;

     case 'recuperar_indicadores_generales':
            $Listas=array();

      		$rpta = $control->ReporteCondicion();

         	while ($reg = $rpta->fetch_object()){
                    $condiciones=array();
                    $condiciones["idCondicion"]=$reg->idCondicion;
					$condiciones["Condicion"]=$reg->Condicion;
                    $condiciones["TotalPaciente"]=$reg->TotalPaciente;
                $Listas["Condiciones"][]=$condiciones;
         	}

      		$rpta2 = $control->ReporteDiagnostico();
         	while ($reg2 = $rpta2->fetch_object()){
				    $diagnostico=array();
                    $diagnostico["idDiagnostico"]=$reg2->idDiagnostico;
					$diagnostico["Diagnostico"]=$reg2->Diagnostico;
                    $diagnostico["TotalPaciente"]=$reg2->TotalPaciente;
                $Listas["Diagnosticos"][]=$diagnostico;
         	}


      		$rpta3 = $control->ReporteGradoInstruccion();
         	while ($reg3 = $rpta3->fetch_object()){
				    $grado=array();
                    $grado["idGradoInstruccion"]=$reg3->idGradoInstruccion;
					$grado["Grado"]=$reg3->GradoInstruccion;
                    $grado["TotalPaciente"]=$reg3->TotalPaciente;
                $Listas["GradoInstruccion"][]=$grado;
         	}

            echo json_encode($Listas);
       break;
    case 'ListarReporte':
        $rspta=null;
        if($Opcion=="CONDICION"){
            $rspta = $control->ListarPacienteCondicion($id);
            $data  = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" => '',
                    "1" => $reg->Paciente,
                    "2" => $reg->edad,
                    "3" => $reg->Condicion
                );
            }
        }elseif($Opcion=="DIAGNOSTICO"){
            $rspta = $control->ListarPacienteDiagnostico($id);
            $data  = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" => '',
                    "1" => $reg->Paciente,
                    "2" => $reg->edad,
                    "3" => $reg->Diagnostico
                );
            }
        }elseif($Opcion=="GRADO"){
             $rspta = $control->ListarPacienteGrado($id);
            $data  = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" => '',
                    "1" => $reg->Paciente,
                    "2" => $reg->edad,
                    "3" => $reg->Diagnostico
                );
            }
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);

        break;

       case 'ListarReporte2':
        $rspta=null;

        switch ($num){
            case 1:
                $rspta = $control->ReporteMasculino();
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                case 2:
                $rspta = $control->ReporteFemenino();
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                 case 3:
                $rspta = $control->ReporteGlicemico($Inicio,$Fin,1,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                 case 4:
                $rspta = $control->ReporteGlicemico($Inicio,$Fin,0,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                case 5:
                $rspta = $control->ReporteColesterol($Inicio,$Fin,1,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                 case 6:
                $rspta = $control->ReporteColesterol($Inicio,$Fin,0,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                case 7:
                $rspta = $control->ReporteHDL($Inicio,$Fin,1,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                 case 8:
                $rspta = $control->ReporteHDL($Inicio,$Fin,0,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;

                case 9:
                $rspta = $control->ReporteLDL($Inicio,$Fin,1,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
            case 10:
                $rspta = $control->ReporteLDL($Inicio,$Fin,0,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;

                 case 11:
                $rspta = $control->ReportIMC($Inicio,$Fin,1,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                   case 12:
                $rspta = $control->ReportIMC($Inicio,$Fin,0,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;

                 case 13:
                $rspta = $control->ReporteTalleres($Inicio,$Fin,1,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                case 14:
                $rspta = $control->ReporteTalleres($Inicio,$Fin,2,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                 case 15:
                $rspta = $control->ReporteTalleres($Inicio,$Fin,3,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                 case 16:
                $rspta = $control->ReporteTalleres($Inicio,$Fin,4,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                 case 17:
                $rspta = $control->ReporteTalleres($Inicio,$Fin,5,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;
                 case 18:
                $rspta = $control->ReporteTalleres($Inicio,$Fin,6,$Sexo);
                $data  = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => '',
                        "1" => $reg->Paciente,
                        "2" => $reg->edad,
                        "3" => $reg->Sexo
                    );
                }
            break;


        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);

        break;


}



?>
