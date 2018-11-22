<?php
   session_start();
   require_once "../../modelo/Mantenimiento/MPerfil.php";
   require_once "../../modelo/General/MGeneral.php";
   $mantenimiento = new MPerfil();
   $general = new MGeneral();


	$idPerfil=isset($_POST["idPerfil"])?limpiarCadena($_POST["idPerfil"]):"";
	$PerfilNombre=isset($_POST["PerfilNombre"])?limpiarCadena($_POST["PerfilNombre"]):"";
	$PerfilDescripcion=isset($_POST["PerfilDescripcion"])?limpiarCadena($_POST["PerfilDescripcion"]):"";
	$PerfilEstado=isset($_POST["PerfilEstado"])?limpiarCadena($_POST["PerfilEstado"]):"";

	$login_idLog=$_SESSION['idUsuario'];

   $idPermisos=isset($_POST["idPermisos"])?limpiarCadena($_POST["idPermisos"]):"";
	$Permiso1=isset($_POST["m_gestion1"])?limpiarCadena($_POST["m_gestion1"]):"";
	$Permiso2=isset($_POST["m_gestion2"])?limpiarCadena($_POST["m_gestion2"]):"";
	$Permiso3=isset($_POST["m_gestion3"])?limpiarCadena($_POST["m_gestion3"]):"";
	$Permiso4=isset($_POST["m_gestion4"])?limpiarCadena($_POST["m_gestion4"]):"";
	$Permiso5=isset($_POST["m_mantenimiento"])?limpiarCadena($_POST["m_mantenimiento"]):"";
	$Permiso6=isset($_POST["m_reporte"])?limpiarCadena($_POST["m_reporte"]):"";


    function BuscarEstado($reg){
        if($reg->Estado_idEstado=='1' || $reg->Estado_idEstado==1 ){
            return '<div class="badge badge-success">'.$reg->nombreEstado.'</div>';
        }elseif($reg->Estado_idEstado=='2' || $reg->Estado_idEstado==2){
            return '<div class="badge badge-danger">'.$reg->nombreEstado.'</div>';
        }else{
             return '<div class="badge badge-primary">'.$reg->nombreEstado.'</div>';
        }
    }
    function BuscarAccion($reg){
        if($reg->Estado_idEstado==1 || $reg->Estado_idEstado==2 ){
            return '<button type="button"  title="Permisos" class="btn btn-info btn-sm mr-1" onclick="PermisosPerfil('.$reg->idPerfil.')"><i class="fa fa-tasks"></i></button><button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarPerfil('.$reg->idPerfil.')"><i class="fa fa-edit"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarPerfil('.$reg->idPerfil.')"><i class="fa fa-trash"></i></button>';
        }elseif($reg->Estado_idEstado==4){
            return '<button type="button"  title="Habilitar" class="btn btn-info btn-sm" onclick="HabilitarPerfil('.$reg->idPerfil.')"><i class="fa fa-sync"></i></button>';
        }
    }

   switch($_GET['op']){
        case 'AccionPerfil':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idPerfil)){

                /*--  validar si el numero de la factura ya se encuentra emitido  --*/
                $validarPerfil=$mantenimiento->ValidarPerfil($PerfilNombre,$idPerfil);
                if($validarPerfil>0){
                    $rspta["Mensaje"].="El Perfil ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Perfil.";
                }else{
                    $RespuestaRegistro=$mantenimiento->RegistroPerfil($idPerfil,$PerfilNombre,$PerfilDescripcion,$PerfilEstado,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Perfil se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Perfil no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{

                 $validarPerfil=$mantenimiento->ValidarPerfil($PerfilNombre,$idPerfil);
                if($validarPerfil>0){
                    $rspta["Mensaje"].="El Perfil ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Perfil.";
                }else{

                    $RespuestaRegistro=$mantenimiento->RegistroPerfil($idPerfil,$PerfilNombre,$PerfilDescripcion,$PerfilEstado,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Perfil se Actualizo Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Perfil no se puede Actualizar comuniquese con el area de soporte.";
                    }
                }
            }

         echo json_encode($rspta);
       break;
      case 'listar_estados':

      		$rpta = $general->Listar_Estados(1);
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idEstado . '>' . $reg->nombreEstado . '</option>';
         	}
       break;

		case 'Listar_Perfil':

         $rspta=$mantenimiento->Listar_Perfil_Todos();
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
               "1"=>BuscarEstado($reg),
               "2"=>$reg->nombrePerfil,
               "3"=>$reg->descripcionPerfil,
               "4"=>$reg->fechaRegistro,
               "5"=>BuscarAccion($reg)
            );
         }
         $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
         echo json_encode($results);
      break;

      case 'Eliminar_Perfil':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Perfil($idPerfil,1,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Perfil Eliminado.":$rspta['Mensaje']="Perfil no se pudo eliminar comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

      case 'Recuperar_Perfil':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Perfil($idPerfil,2,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Perfil Restablecido.":$rspta['Mensaje']="Perfil no se pudo Restablecer comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

		case 'RecuperarInformacion_Perfil':
			$rspta=$mantenimiento->Recuperar_Perfil($idPerfil);
         echo json_encode($rspta);
      break;

		  case 'RecuperarPermisosPerfil':
			$rspta=$mantenimiento->Recuperar_Permisos($idPerfil);
         echo json_encode($rspta);
      break;

    case 'ActualizarPermisos':
        $rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
        $RespuestaRegistro=$mantenimiento->ActualizarPermisos($idPermisos,$Permiso1,$Permiso2,$Permiso3,$Permiso4,$Permiso5,$Permiso6,$idPerfil,$login_idLog);
            if($RespuestaRegistro){
                $rspta["Registro"]=true;
                $rspta["Mensaje"]="Permisos Actualizados Correctamente.";
            }else{
                $rspta["Registro"]=false;
                $rspta["Mensaje"]="Permisos no se Actualizaron comuniquese con el area de soporte.";
            }
        echo json_encode($rspta);
    break;


   }


?>
