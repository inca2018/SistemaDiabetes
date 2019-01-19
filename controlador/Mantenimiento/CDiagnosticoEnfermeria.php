<?php
session_start();
require_once "../../modelo/Mantenimiento/MDiagnosticoEnfermeria.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MDiagnosticoEnfermeria();
$general              = new MGeneral();
$idDiagnosticoEnfermeria          = isset($_POST["idDiagnosticoEnfermeria"]) ? limpiarCadena($_POST["idDiagnosticoEnfermeria"]) : "";
$DiagnosticoEnfermeriaDescripcion = isset($_POST["DiagnosticoEnfermeriaDescripcion"]) ? limpiarCadena($_POST["DiagnosticoEnfermeriaDescripcion"]) : "";
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
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarDiagnosticoEnfermeria(' . $reg->idDiagnosticoEnfermeria . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionDiagnosticoEnfermeria(' . $reg->idDiagnosticoEnfermeria . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarDiagnosticoEnfermeria(' . $reg->idDiagnosticoEnfermeria . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionDiagnosticoEnfermeria(' . $reg->idDiagnosticoEnfermeria . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarDiagnosticoEnfermeria(' . $reg->idDiagnosticoEnfermeria . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionDiagnosticoEnfermeria':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idDiagnosticoEnfermeria)) {
            $validarDiagnosticoEnfermeria = $mantenimiento->ValidarDiagnosticoEnfermeria($DiagnosticoEnfermeriaDescripcion, $idDiagnosticoEnfermeria);
            if ($validarDiagnosticoEnfermeria > 0) {
                $rspta["Mensaje"] .= "El DiagnosticoEnfermeria ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el DiagnosticoEnfermeria.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroDiagnosticoEnfermeria($DiagnosticoEnfermeriaDescripcion, $idDiagnosticoEnfermeria);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "DiagnosticoEnfermeria se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "DiagnosticoEnfermeria no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarDiagnosticoEnfermeria = $mantenimiento->ValidarDiagnosticoEnfermeria($DiagnosticoEnfermeriaDescripcion, $idDiagnosticoEnfermeria);

            if ($validarDiagnosticoEnfermeria > 0) {
                $rspta["Mensaje"] .= "El DiagnosticoEnfermeria ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar DiagnosticoEnfermeria.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroDiagnosticoEnfermeria($DiagnosticoEnfermeriaDescripcion, $idDiagnosticoEnfermeria);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "DiagnosticoEnfermeria se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "DiagnosticoEnfermeria no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_DiagnosticoEnfermeria':

        $rspta = $mantenimiento->Listar_DiagnosticoEnfermeria();
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

    case 'Eliminar_DiagnosticoEnfermeria':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_DiagnosticoEnfermeria($idDiagnosticoEnfermeria);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "DiagnosticoEnfermeria Eliminado." : $rspta['Mensaje'] = "DiagnosticoEnfermeria no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_DiagnosticoEnfermeria':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_DiagnosticoEnfermeria($idDiagnosticoEnfermeria, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "DiagnosticoEnfermeria " . $Mensaje : $rspta['Mensaje'] = "DiagnosticoEnfermeria no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_DiagnosticoEnfermeria':
        $rspta = $mantenimiento->Recuperar_DiagnosticoEnfermeria($idDiagnosticoEnfermeria);
        echo json_encode($rspta);
        break;
}


?>
