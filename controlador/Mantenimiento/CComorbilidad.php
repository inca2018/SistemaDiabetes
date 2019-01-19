<?php
session_start();
require_once "../../modelo/Mantenimiento/MComorbilidad.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MComorbilidad();
$general              = new MGeneral();
$idComorbilidad          = isset($_POST["idComorbilidad"]) ? limpiarCadena($_POST["idComorbilidad"]) : "";
$ComorbilidadDescripcion = isset($_POST["ComorbilidadDescripcion"]) ? limpiarCadena($_POST["ComorbilidadDescripcion"]) : "";
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
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarComorbilidad(' . $reg->idComorbilidad . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionComorbilidad(' . $reg->idComorbilidad . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarComorbilidad(' . $reg->idComorbilidad . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionComorbilidad(' . $reg->idComorbilidad . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarComorbilidad(' . $reg->idComorbilidad . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {
    case 'AccionComorbilidad':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );
        if (empty($idComorbilidad)) {
            $validarComorbilidad = $mantenimiento->ValidarComorbilidad($ComorbilidadDescripcion, $idComorbilidad);
            if ($validarComorbilidad > 0) {
                $rspta["Mensaje"] .= "El Comorbilidad ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Registrar el Comorbilidad.";
            } else {
                $RespuestaRegistro = $mantenimiento->RegistroComorbilidad($ComorbilidadDescripcion, $idComorbilidad);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Comorbilidad se registro Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Comorbilidad no se puede registrar comuniquese con el area de soporte.";
                }
            }
        } else {

            $validarComorbilidad = $mantenimiento->ValidarComorbilidad($ComorbilidadDescripcion, $idComorbilidad);

            if ($validarComorbilidad > 0) {
                $rspta["Mensaje"] .= "El Comorbilidad ya se encuentra Registrado ";
                $rspta["Error"] = true;
            }
            if ($rspta["Error"]) {
                $rspta["Mensaje"] .= "Por estas razones no se puede Actualizar Comorbilidad.";
            } else {

                $RespuestaRegistro = $mantenimiento->RegistroComorbilidad($ComorbilidadDescripcion, $idComorbilidad);
                if ($RespuestaRegistro) {
                    $rspta["Registro"] = true;
                    $rspta["Mensaje"]  = "Comorbilidad se Actualizo Correctamente.";
                } else {
                    $rspta["Registro"] = false;
                    $rspta["Mensaje"]  = "Comorbilidad no se puede Actualizar comuniquese con el area de soporte.";
                }
            }
        }
        echo json_encode($rspta);
        break;

    case 'Listar_Comorbilidad':

        $rspta = $mantenimiento->Listar_Comorbilidad();
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

    case 'Eliminar_Comorbilidad':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Comorbilidad($idComorbilidad);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Comorbilidad Eliminado." : $rspta['Mensaje'] = "Comorbilidad no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Comorbilidad':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Comorbilidad($idComorbilidad, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Comorbilidad " . $Mensaje : $rspta['Mensaje'] = "Comorbilidad no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarInformacion_Comorbilidad':
        $rspta = $mantenimiento->Recuperar_Comorbilidad($idComorbilidad);
        echo json_encode($rspta);
        break;
}


?>
