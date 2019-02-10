<?php
session_start();
require_once "../../modelo/Mantenimiento/MEspecialidad.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MEspecialidad();
$general              = new MGeneral();
$idEspecialidad          = isset($_POST["idEspecialidad"]) ? limpiarCadena($_POST["idEspecialidad"]) : "";
$EspecialidadDescripcion = isset($_POST["EspecialidadDescripcion"]) ? limpiarCadena($_POST["EspecialidadDescripcion"]) : "";
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
        return '<button type="button"   title="Asignación de Especialidad" class="btn btn-primary btn-sm" onclick="AsignacionMedico(' . $reg->idEspecialidad . ')"><i class="fa fa-circle"></i></button>
        <button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarEspecialidad(' . $reg->idEspecialidad . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionEspecialidad(' . $reg->idEspecialidad . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarEspecialidad(' . $reg->idEspecialidad . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionEspecialidad(' . $reg->idEspecialidad . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarEspecialidad(' . $reg->idEspecialidad . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionEspecialidad':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idEspecialidad)) {
            $validarEspecialidad = $mantenimiento->ValidarEspecialidad($EspecialidadDescripcion, $idEspecialidad);
            if ($validarEspecialidad > 0) {
                $rspta["Mensaje"] .= "El Especialidad ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el Especialidad.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroEspecialidad($EspecialidadDescripcion, $idEspecialidad);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Especialidad se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Especialidad no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarEspecialidad = $mantenimiento->ValidarEspecialidad($EspecialidadDescripcion, $idEspecialidad);

            if ($validarEspecialidad > 0) {
                $rspta["Mensaje"] .= "El Especialidad ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar Especialidad.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroEspecialidad($EspecialidadDescripcion, $idEspecialidad);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Especialidad se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Especialidad no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_Especialidad':

        $rspta = $mantenimiento->Listar_Especialidad();
        $data  = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '',
                "1" => BuscarEstado($reg),
                "2" => $reg->Descripcion,
                "3" => $reg->Asignaciones,
                "4" => $reg->fechaRegistro,
                "5" => BuscarAccion($reg)
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

    case 'Eliminar_Especialidad':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Especialidad($idEspecialidad);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Especialidad Eliminado." : $rspta['Mensaje'] = "Especialidad no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Especialidad':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Especialidad($idEspecialidad, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Especialidad " . $Mensaje : $rspta['Mensaje'] = "Especialidad no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_Especialidad':
        $rspta = $mantenimiento->Recuperar_Especialidad($idEspecialidad);
        echo json_encode($rspta);
        break;
}


?>
