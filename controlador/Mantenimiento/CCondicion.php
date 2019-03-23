<?php
session_start();
require_once "../../modelo/Mantenimiento/MCondicion.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MCondicion();
$general              = new MGeneral();
$idCondicion          = isset($_POST["idCondicion"]) ? limpiarCadena($_POST["idCondicion"]) : "";
$CondicionDescripcion = isset($_POST["CondicionDescripcion"]) ? limpiarCadena($_POST["CondicionDescripcion"]) : "";
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
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarCondicion(' . $reg->idCondicion . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionCondicion(' . $reg->idCondicion . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarCondicion(' . $reg->idCondicion . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionCondicion(' . $reg->idCondicion . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarCondicion(' . $reg->idCondicion . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionCondicion':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idCondicion)) {
            $validarCondicion = $mantenimiento->ValidarCondicion($CondicionDescripcion, $idCondicion);
            if ($validarCondicion > 0) {
                $rspta["Mensaje"] .= "El Condicion ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el Condicion.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroCondicion($CondicionDescripcion, $idCondicion);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Condicion se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Condicion no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarCondicion = $mantenimiento->ValidarCondicion($CondicionDescripcion, $idCondicion);

            if ($validarCondicion > 0) {
                $rspta["Mensaje"] .= "El Condicion ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar Condicion.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroCondicion($CondicionDescripcion, $idCondicion);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Condicion se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Condicion no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_Condicion':

        $rspta = $mantenimiento->Listar_Condicion();
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

    case 'Eliminar_Condicion':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Condicion($idCondicion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Condicion Eliminado." : $rspta['Mensaje'] = "Condicion no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Condicion':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Condicion($idCondicion, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Condicion " . $Mensaje : $rspta['Mensaje'] = "Condicion no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_Condicion':
        $rspta = $mantenimiento->Recuperar_Condicion($idCondicion);
        echo json_encode($rspta);
        break;
}


?>
