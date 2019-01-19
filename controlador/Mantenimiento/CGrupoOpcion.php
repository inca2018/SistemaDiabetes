<?php
session_start();
require_once "../../modelo/Mantenimiento/MGrupoOpcion.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MGrupoOpcion();
$general              = new MGeneral();
$idGrupoOpcion          = isset($_POST["idGrupoOpcion"]) ? limpiarCadena($_POST["idGrupoOpcion"]) : "";
$GrupoOpcionDescripcion = isset($_POST["GrupoOpcionDescripcion"]) ? limpiarCadena($_POST["GrupoOpcionDescripcion"]) : "";
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
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarGrupoOpcion(' . $reg->idGrupoOpcion . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionGrupoOpcion(' . $reg->idGrupoOpcion . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarGrupoOpcion(' . $reg->idGrupoOpcion . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionGrupoOpcion(' . $reg->idGrupoOpcion . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarGrupoOpcion(' . $reg->idGrupoOpcion . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionGrupoOpcion':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idGrupoOpcion)) {
            $validarGrupoOpcion = $mantenimiento->ValidarGrupoOpcion($GrupoOpcionDescripcion, $idGrupoOpcion);
            if ($validarGrupoOpcion > 0) {
                $rspta["Mensaje"] .= "El GrupoOpcion ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el GrupoOpcion.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroGrupoOpcion($GrupoOpcionDescripcion, $idGrupoOpcion);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "GrupoOpcion se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "GrupoOpcion no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarGrupoOpcion = $mantenimiento->ValidarGrupoOpcion($GrupoOpcionDescripcion, $idGrupoOpcion);

            if ($validarGrupoOpcion > 0) {
                $rspta["Mensaje"] .= "El GrupoOpcion ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar GrupoOpcion.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroGrupoOpcion($GrupoOpcionDescripcion, $idGrupoOpcion);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "GrupoOpcion se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "GrupoOpcion no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_GrupoOpcion':

        $rspta = $mantenimiento->Listar_GrupoOpcion();
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

    case 'Eliminar_GrupoOpcion':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_GrupoOpcion($idGrupoOpcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "GrupoOpcion Eliminado." : $rspta['Mensaje'] = "GrupoOpcion no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_GrupoOpcion':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_GrupoOpcion($idGrupoOpcion, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "GrupoOpcion " . $Mensaje : $rspta['Mensaje'] = "GrupoOpcion no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_GrupoOpcion':
        $rspta = $mantenimiento->Recuperar_GrupoOpcion($idGrupoOpcion);
        echo json_encode($rspta);
        break;
}


?>
