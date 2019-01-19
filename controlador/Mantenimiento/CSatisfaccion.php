<?php
session_start();
require_once "../../modelo/Mantenimiento/MSatisfaccion.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MSatisfaccion();
$general              = new MGeneral();
$idSatisfaccion          = isset($_POST["idSatisfaccion"]) ? limpiarCadena($_POST["idSatisfaccion"]) : "";
$SatisfaccionDescripcion = isset($_POST["SatisfaccionDescripcion"]) ? limpiarCadena($_POST["SatisfaccionDescripcion"]) : "";
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
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarSatisfaccion(' . $reg->idSatisfaccion . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionSatisfaccion(' . $reg->idSatisfaccion . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarSatisfaccion(' . $reg->idSatisfaccion . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionSatisfaccion(' . $reg->idSatisfaccion . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarSatisfaccion(' . $reg->idSatisfaccion . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionSatisfaccion':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idSatisfaccion)) {
            $validarSatisfaccion = $mantenimiento->ValidarSatisfaccion($SatisfaccionDescripcion, $idSatisfaccion);
            if ($validarSatisfaccion > 0) {
                $rspta["Mensaje"] .= "El Satisfaccion ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el Satisfaccion.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroSatisfaccion($SatisfaccionDescripcion, $idSatisfaccion);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Satisfaccion se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Satisfaccion no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarSatisfaccion = $mantenimiento->ValidarSatisfaccion($SatisfaccionDescripcion, $idSatisfaccion);

            if ($validarSatisfaccion > 0) {
                $rspta["Mensaje"] .= "El Satisfaccion ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar Satisfaccion.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroSatisfaccion($SatisfaccionDescripcion, $idSatisfaccion);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Satisfaccion se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Satisfaccion no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_Satisfaccion':

        $rspta = $mantenimiento->Listar_Satisfaccion();
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

    case 'Eliminar_Satisfaccion':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Satisfaccion($idSatisfaccion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Satisfaccion Eliminado." : $rspta['Mensaje'] = "Satisfaccion no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Satisfaccion':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Satisfaccion($idSatisfaccion, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Satisfaccion " . $Mensaje : $rspta['Mensaje'] = "Satisfaccion no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_Satisfaccion':
        $rspta = $mantenimiento->Recuperar_Satisfaccion($idSatisfaccion);
        echo json_encode($rspta);
        break;
}


?>
