<?php
session_start();
require_once "../../modelo/Mantenimiento/MGradoInstruccion.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MGradoInstruccion();
$general              = new MGeneral();
$idGradoInstruccion          = isset($_POST["idGradoInstruccion"]) ? limpiarCadena($_POST["idGradoInstruccion"]) : "";
$GradoInstruccionDescripcion = isset($_POST["GradoInstruccionDescripcion"]) ? limpiarCadena($_POST["GradoInstruccionDescripcion"]) : "";
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
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarGradoInstruccion(' . $reg->idGradoInstruccion . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionGradoInstruccion(' . $reg->idGradoInstruccion . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarGradoInstruccion(' . $reg->idGradoInstruccion . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionGradoInstruccion(' . $reg->idGradoInstruccion . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarGradoInstruccion(' . $reg->idGradoInstruccion . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionGradoInstruccion':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idGradoInstruccion)) {
            $validarGradoInstruccion = $mantenimiento->ValidarGradoInstruccion($GradoInstruccionDescripcion, $idGradoInstruccion);
            if ($validarGradoInstruccion > 0) {
                $rspta["Mensaje"] .= "El GradoInstruccion ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el GradoInstruccion.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroGradoInstruccion($GradoInstruccionDescripcion, $idGradoInstruccion);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "GradoInstruccion se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "GradoInstruccion no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarGradoInstruccion = $mantenimiento->ValidarGradoInstruccion($GradoInstruccionDescripcion, $idGradoInstruccion);

            if ($validarGradoInstruccion > 0) {
                $rspta["Mensaje"] .= "El GradoInstruccion ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar GradoInstruccion.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroGradoInstruccion($GradoInstruccionDescripcion, $idGradoInstruccion);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "GradoInstruccion se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "GradoInstruccion no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_GradoInstruccion':

        $rspta = $mantenimiento->Listar_GradoInstruccion();
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

    case 'Eliminar_GradoInstruccion':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_GradoInstruccion($idGradoInstruccion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "GradoInstruccion Eliminado." : $rspta['Mensaje'] = "GradoInstruccion no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_GradoInstruccion':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_GradoInstruccion($idGradoInstruccion, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "GradoInstruccion " . $Mensaje : $rspta['Mensaje'] = "GradoInstruccion no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_GradoInstruccion':
        $rspta = $mantenimiento->Recuperar_GradoInstruccion($idGradoInstruccion);
        echo json_encode($rspta);
        break;
}


?>
