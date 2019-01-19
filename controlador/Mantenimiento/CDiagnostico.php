<?php
session_start();
require_once "../../modelo/Mantenimiento/MDiagnostico.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MDiagnostico();
$general              = new MGeneral();
$idDiagnostico          = isset($_POST["idDiagnostico"]) ? limpiarCadena($_POST["idDiagnostico"]) : "";
$DiagnosticoDescripcion = isset($_POST["DiagnosticoDescripcion"]) ? limpiarCadena($_POST["DiagnosticoDescripcion"]) : "";
$Opcion               = isset($_POST["Opcion"]) ? limpiarCadena($_POST["Opcion"]) : "";
$login_idLog          = $_SESSION['idUsuario'];

function BuscarEstado($reg)
{
    if ($reg->Estado_idEstado == '1' || $reg->Estado_idEstado == 1) {
        return '<div class="badge badge-success">' . $reg->nombreEstado . '</div>';
    } elseif ($reg->Estado_idEstado == '2' || $reg->Estado_idEstado == 2) {
        return '<div class="badge badge-danger">' . $reg->nombreEstado . '</div>';
    } else {
        return '<div class="badge badge-primary">' . $reg->nombreEstado . '</div>';
    }
}
function BuscarAccion($reg)
{
    if ($reg->Estado_idEstado == 1) {
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarDiagnostico(' . $reg->idDiagnostico . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionDiagnostico(' . $reg->idDiagnostico . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarDiagnostico(' . $reg->idDiagnostico . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionDiagnostico(' . $reg->idDiagnostico . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarDiagnostico(' . $reg->idDiagnostico . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionDiagnostico':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idDiagnostico)) {
            $validarDiagnostico = $mantenimiento->ValidarDiagnostico($DiagnosticoDescripcion, $idDiagnostico);
            if ($validarDiagnostico > 0) {
                $rspta["Mensaje"] .= "El Diagnostico ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el Diagnostico.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroDiagnostico($DiagnosticoDescripcion, $idDiagnostico);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Diagnostico se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Diagnostico no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarDiagnostico = $mantenimiento->ValidarDiagnostico($DiagnosticoDescripcion, $idDiagnostico);

            if ($validarDiagnostico > 0) {
                $rspta["Mensaje"] .= "El Diagnostico ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar Diagnostico.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroDiagnostico($DiagnosticoDescripcion, $idDiagnostico);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Diagnostico se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Diagnostico no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_Diagnostico':

        $rspta = $mantenimiento->Listar_Diagnostico();
        $data  = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '',
                "1" => BuscarEstado($reg),
                "2" => $reg->Descripcion,
                "3" => $reg->fechaRegistro,
                "4" => BuscarAccion($reg)
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

    case 'Eliminar_Diagnostico':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Diagnostico($idDiagnostico);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Diagnostico Eliminado." : $rspta['Mensaje'] = "Diagnostico no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Diagnostico':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Diagnostico($idDiagnostico, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Diagnostico " . $Mensaje : $rspta['Mensaje'] = "Diagnostico no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_Diagnostico':
        $rspta = $mantenimiento->Recuperar_Diagnostico($idDiagnostico);
        echo json_encode($rspta);
        break;
}


?>
