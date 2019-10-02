<?php
session_start();
require_once "../../modelo/Mantenimiento/MOpcion.php";
require_once "../../modelo/General/MGeneral.php";

$mantenimiento        = new MOpcion();
$general              = new MGeneral();
$idOpcion          = isset($_POST["idOpcion"]) ? limpiarCadena($_POST["idOpcion"]) : "";
$OpcionDescripcion = isset($_POST["OpcionDescripcion"]) ? limpiarCadena($_POST["OpcionDescripcion"]) : "";
$Opcion               = isset($_POST["Opcion"]) ? limpiarCadena($_POST["Opcion"]) : "";
$login_idLog          = $_SESSION['idUsuario'];

$idGrupoOpcion = isset($_POST["idGrupoOpcion"]) ? limpiarCadena($_POST["idGrupoOpcion"]) : "";
$Propiedades = isset($_POST["Propiedades"]) ? limpiarCadena($_POST["Propiedades"]) : "";
$TipoOpcion = isset($_POST["TipoOpcion"]) ? limpiarCadena($_POST["TipoOpcion"]) : "";
$OpcionTitulo =isset($_POST["OpcionTitulo"]) ? limpiarCadena($_POST["OpcionTitulo"]) : "";

$OpcionInfo =isset($_POST["OpcionInfo"]) ? limpiarCadena($_POST["OpcionInfo"]) : "";


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
        return '<button type="button"  title="Editar Opción" class="btn btn-warning btn-sm" onclick="EditarOpcion(' . $reg->idOpcion . ')"><i class="fa fa-pen"></i></button>
        <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionOpcion(' . $reg->idOpcion . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarOpcion(' . $reg->idOpcion . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Editar Opción" class="btn btn-warning btn-sm" onclick="EditarOpcion(' . $reg->idOpcion . ')"><i class="fa fa-pen"></i></button><button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionOpcion(' . $reg->idOpcion . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarOpcion(' . $reg->idOpcion . ')"><i class="fa fa-trash"></i></button>';
    }
}
switch ($_GET['op']) {


    //********************************** NUEVOS ***********************************//

    case 'ListarTipoOpcion':
        	$rpta = $mantenimiento->ListarTipoOpcion();
        echo '<option value="0">--- SELECCIONE ---</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idTipoOpcion . '>' . $reg->Descripcion . '</option>';
         	}
        break;
    case 'RecuperarInformacionGrupoOpciones':
        $rspta = $mantenimiento->RecuperarInformacionGrupoOpciones($idGrupoOpcion);
        echo json_encode($rspta);
        break;

    case 'AccionOpcion':
        $rspta = array(
            "Error" => false,
            "Mensaje" => "",
            "Registro" => false
        );

        if($idOpcion==null || $idOpcion==""){
             $RespuestaRegistro = $mantenimiento->RegistroOpcion($idGrupoOpcion,$Propiedades,$TipoOpcion,$OpcionTitulo,$OpcionInfo);
            if ($RespuestaRegistro) {
                $rspta["Registro"] = true;
                $rspta["Mensaje"]  = "Opcion se registro Correctamente.";
            } else {
                $rspta["Registro"] = false;
                $rspta["Mensaje"]  = "Opcion no se puede registrar comuniquese con el area de soporte.";
            }

        }else{
             $RespuestaRegistro = $mantenimiento->ActualizarOpcion($idOpcion,$idGrupoOpcion,$Propiedades,$TipoOpcion,$OpcionTitulo,$OpcionInfo);
            if ($RespuestaRegistro) {
                $rspta["Registro"] = true;
                $rspta["Mensaje"]  = "Opcion se Actualizó Correctamente.";
            } else {
                $rspta["Registro"] = false;
                $rspta["Mensaje"]  = "Opcion no se puede Actualizar comuniquese con el area de soporte.";
            }


        }



        echo json_encode($rspta);
        break;


    case 'Listar_Opcion':

        $rspta = $mantenimiento->Listar_Opcion($idGrupoOpcion);
        $data  = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '',
                "1" => BuscarEstado($reg),
                "2" => $reg->tipoOpcion,
                "3" => $reg->TituloOpcion,
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

          case 'Eliminar_Opcion':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Opcion($idOpcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Opcion Eliminado." : $rspta['Mensaje'] = "Opcion no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Opcion':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Opcion($idOpcion, $Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Opcion " . $Mensaje : $rspta['Mensaje'] = "Opcion no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'RecuperarOpcion':
        $rspta = $mantenimiento->RecuperarOpcion($idOpcion);
        echo json_encode($rspta);
        break;
}


?>
