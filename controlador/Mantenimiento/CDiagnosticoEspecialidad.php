<?php
session_start();
require_once "../../modelo/Mantenimiento/MDiagnosticoEspecialidad.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MDiagnosticoEspecialidad();
$general              = new MGeneral();
$idDiagnosticoEspecialidad          = isset($_POST["idDiagnosticoEspecialidad"]) ? limpiarCadena($_POST["idDiagnosticoEspecialidad"]) : "";
$DiagnosticoEspecialidadDescripcion = isset($_POST["DiagnosticoEspecialidadDescripcion"]) ? limpiarCadena($_POST["DiagnosticoEspecialidadDescripcion"]) : "";
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
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarDiagnosticoEspecialidad(' . $reg->idDiagnosticoEspecialidad . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionDiagnosticoEspecialidad(' . $reg->idDiagnosticoEspecialidad . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarDiagnosticoEspecialidad(' . $reg->idDiagnosticoEspecialidad . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionDiagnosticoEspecialidad(' . $reg->idDiagnosticoEspecialidad . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarDiagnosticoEspecialidad(' . $reg->idDiagnosticoEspecialidad . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionDiagnosticoEspecialidad':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idDiagnosticoEspecialidad)) {
            $validarDiagnosticoEspecialidad = $mantenimiento->ValidarDiagnosticoEspecialidad($DiagnosticoEspecialidadDescripcion, $idDiagnosticoEspecialidad);
            if ($validarDiagnosticoEspecialidad > 0) {
                $rspta["Mensaje"] .= "El DiagnosticoEspecialidad ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el DiagnosticoEspecialidad.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroDiagnosticoEspecialidad($DiagnosticoEspecialidadDescripcion, $idDiagnosticoEspecialidad);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "DiagnosticoEspecialidad se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "DiagnosticoEspecialidad no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarDiagnosticoEspecialidad = $mantenimiento->ValidarDiagnosticoEspecialidad($DiagnosticoEspecialidadDescripcion, $idDiagnosticoEspecialidad);

            if ($validarDiagnosticoEspecialidad > 0) {
                $rspta["Mensaje"] .= "El DiagnosticoEspecialidad ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar DiagnosticoEspecialidad.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroDiagnosticoEspecialidad($DiagnosticoEspecialidadDescripcion, $idDiagnosticoEspecialidad);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "DiagnosticoEspecialidad se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "DiagnosticoEspecialidad no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_DiagnosticoEspecialidad':

        $rspta = $mantenimiento->Listar_DiagnosticoEspecialidad();
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

    case 'Eliminar_DiagnosticoEspecialidad':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_DiagnosticoEspecialidad($idDiagnosticoEspecialidad);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "DiagnosticoEspecialidad Eliminado." : $rspta['Mensaje'] = "DiagnosticoEspecialidad no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_DiagnosticoEspecialidad':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_DiagnosticoEspecialidad($idDiagnosticoEspecialidad, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "DiagnosticoEspecialidad " . $Mensaje : $rspta['Mensaje'] = "DiagnosticoEspecialidad no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_DiagnosticoEspecialidad':
        $rspta = $mantenimiento->Recuperar_DiagnosticoEspecialidad($idDiagnosticoEspecialidad);
        echo json_encode($rspta);
        break;
}


?>
