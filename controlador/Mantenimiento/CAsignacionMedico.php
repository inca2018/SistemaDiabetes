<?php
session_start();
require_once "../../modelo/Mantenimiento/MAsignacionMedico.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MAsignacionMedico();
$general              = new MGeneral();

$idEspecialidad = isset($_POST["idEspecialidad"]) ? limpiarCadena($_POST["idEspecialidad"]) : "";
$idMedico= isset($_POST["idMedico"]) ? limpiarCadena($_POST["idMedico"]) : "";
$idAsignacion=isset($_POST["idAsignacion"]) ? limpiarCadena($_POST["idAsignacion"]) : "";

switch ($_GET['op']) {

   /** FUNCIONES NUEVAS **/
    case 'RecuperarInformacionEspecialidad':
        $rspta = $mantenimiento->RecuperarInformacionEspecialidad($idEspecialidad);
        echo json_encode($rspta);
        break;

   case 'listarMedicosDisponibles':

        $rspta = $mantenimiento->ListarMedicosDisponibles($idEspecialidad);
        $data  = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '',
                "1" => "<div ondblclick='Asignar(".$reg->idMedico.")'><label>".$reg->NombreMedico."</label></div>",
                "2" => "<div ondblclick='Asignar(".$reg->idMedico.")'><label>".$reg->dni."</label></div>",
                "3" => "<div ondblclick='Asignar(".$reg->idMedico.")'><label>".$reg->edad."</label></div>"
            );
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
    break;

       case 'ListarAsignaciones':

        $rspta = $mantenimiento->ListarAsignaciones($idEspecialidad);
        $data  = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '',
                "1" =>  $reg->Especialidad,
                "2" =>  $reg->NombreMedico,
                "3" =>  $reg->fechaRegistro,
                "4" =>  '<button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarAsignacion(' . $reg->idAsignacionEspecialidad . ')"><i class="fa fa-trash"></i></button>'
            );
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
    break;
    case 'AsignarMedico':

        $rspta = array(
            "Mensaje" => "",
            "Asignar" => false,
            "Error" => false
        );

        $rspta['Asignar'] = $mantenimiento->AsignarMedico($idEspecialidad, $idMedico);

        $rspta['Asignar'] ? $rspta['Mensaje'] = "Se Asignó Correctamente el Medico " : $rspta['Mensaje'] = "No se Pudo Asignar Medico comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;
    case 'EliminarAsignacion':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->EliminarAsignacion($idAsignacion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Asignación Eliminada." : $rspta['Mensaje'] = "Asignación no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;
}


?>
