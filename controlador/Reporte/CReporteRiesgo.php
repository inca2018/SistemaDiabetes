<?php
   require_once "../../modelo/Reporte/MReporteRiesgo.php";
   require_once '../../config/conexion.php';

   //require_once "../../modelos/MGeneral.php";

    $control = new MReporteRiesgo();
    $con = new Conexion();

    $contador1=0;
    $contador2=0;
    //$general = new MGeneral();
    /* variables */
    ini_set('date.timezone','America/Lima');


    $fechaInicio=isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]):"";
    $fechaFin=isset($_POST["fechaFin"])? limpiarCadena($_POST["fechaFin"]):"";
    $Sexo=isset($_POST["Sexo"])? limpiarCadena($_POST["Sexo"]):"";


    $date = str_replace('/', '-', $fechaInicio);
    $fechaInicio = date("Y-m-d", strtotime($date));

    $date = str_replace('/', '-', $fechaFin);
    $fechaFin = date("Y-m-d", strtotime($date));

    /*-- Fin de Variables --*/
    switch ($_GET["op"]){
        case 'ListadoReporteRiesgo':
        $ListaRiesgo=array();
        $rpta = $control->ListadoReporteRiesgo($fechaInicio,$fechaFin,$Sexo);

        while ($reg = $rpta->fetch_object()){
            $objeto=array();
            $objeto["Riesgo"]=$reg->Riesgo;
            $objeto["idPaciente"]=$reg->idPaciente;
            $objeto["Codigo"]=$reg->Codigo;
            $objeto["PacienteNombres"]=$reg->PacienteNombres;
            $objeto["DNI"]=$reg->DNI;
            $ListaRiesgo[]=$objeto;
        }

        echo json_encode($ListaRiesgo);
        break;
    }



?>
