<?php
session_start();
require_once "../../modelo/Mantenimiento/MNacionalidad.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MNacionalidad();
$general              = new MGeneral();
$idNacionalidad          = isset($_POST["idNacionalidad"]) ? limpiarCadena($_POST["idNacionalidad"]) : "";
$NacionalidadDescripcion = isset($_POST["NacionalidadDescripcion"]) ? limpiarCadena($_POST["NacionalidadDescripcion"]) : "";
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
    if ($reg->Estado_idEstado == 1 || $reg->Estado_idEstado == 3) {
        return '
        <button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarNacionalidad(' . $reg->idNacionalidad . ')"><i class="fa fa-edit"></i></button>
        <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DeshabilitarNacionalidad(' . $reg->idNacionalidad . ')"><i class="fa fa-arrow-circle-down"></i></button>
         <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarNacionalidad(' . $reg->idNacionalidad . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2 || $reg->Estado_idEstado == 4 ) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="HabilitarNacionalidad(' . $reg->idNacionalidad . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarNacionalidad(' . $reg->idNacionalidad . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionNacionalidad':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idNacionalidad)) {
            $validarNacionalidad = $mantenimiento->ValidarNacionalidad($NacionalidadDescripcion, $idNacionalidad);
            if ($validarNacionalidad > 0) {
                $rspta["Mensaje"] .= "El Nacionalidad ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el Nacionalidad.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroNacionalidad($NacionalidadDescripcion, $idNacionalidad);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Nacionalidad se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Nacionalidad no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarNacionalidad = $mantenimiento->ValidarNacionalidad($NacionalidadDescripcion, $idNacionalidad);

            if ($validarNacionalidad > 0) {
                $rspta["Mensaje"] .= "El Nacionalidad ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar Nacionalidad.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroNacionalidad($NacionalidadDescripcion, $idNacionalidad);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Nacionalidad se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Nacionalidad no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_Nacionalidad':

        $rspta = $mantenimiento->Listar_Nacionalidad();
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

    case 'Eliminar_Nacionalidad':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Nacionalidad($idNacionalidad);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Nacionalidad Eliminado." : $rspta['Mensaje'] = "Nacionalidad no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Nacionalidad':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Nacionalidad($idNacionalidad, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Nacionalidad " . $Mensaje : $rspta['Mensaje'] = "Nacionalidad no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

     case 'HabilitarNacionalidad':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Habilitación Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->HabilitarNacionalidad($idNacionalidad);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Nacionalidad " . $Mensaje : $rspta['Mensaje'] = "Nacionalidad no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
     break;

     case 'DesHabilitarNacionalidad':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " DesHabilitación Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );
        $rspta['Eliminar'] = $mantenimiento->DeshabilitarNacionalidad($idNacionalidad);
        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Nacionalidad " . $Mensaje : $rspta['Mensaje'] = "Nacionalidad no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
     break;

    case 'RecuperarInformacion_Nacionalidad':
        $rspta = $mantenimiento->Recuperar_Nacionalidad($idNacionalidad);
        echo json_encode($rspta);
        break;
}


?>
