<?php
   session_start();
   require_once "../../modelo/Mantenimiento/MUsuario.php";
   require_once "../../modelo/General/MGeneral.php";
   $mantenimiento = new MUsuario();
   $general = new MGeneral();
	//Variables Generales
    $idUsuario=isset($_POST["idUsuario"])?limpiarCadena($_POST["idUsuario"]):"";
    $UsuarioPersona=isset($_POST["UsuarioPersona"])?limpiarCadena($_POST["UsuarioPersona"]):"";
    $UsuarioUsuario=isset($_POST["UsuarioUsuario"])?limpiarCadena($_POST["UsuarioUsuario"]):"";
    $UsuarioPerfil=isset($_POST["UsuarioPerfil"])?limpiarCadena($_POST["UsuarioPerfil"]):"";
    $UsuarioPassword=isset($_POST["UsuarioPassword"])?limpiarCadena($_POST["UsuarioPassword"]):"";
    $UsuarioEstado=isset($_POST["UsuarioEstado"])?limpiarCadena($_POST["UsuarioEstado"]):"";



   $login_idLog=$_SESSION['idUsuario'];
   //hora
   // date_default_timezone_set('America/Lima');
   //$FechaRegistro=date("Y-m-d H:i:s");
 	//$date = str_replace('/', '-', $PersonaFechaNacimiento);
   //$PersonaFechaNacimiento = date("Y-m-d", strtotime($date));
	/*$date = str_replace('/', '-', $fechaVencimiento);
   $fechaVencimiento = date("Y-m-d", strtotime($date));*/

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
            return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarUsuario('.$reg->idUsuario.')"><i class="fa fa-edit"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarUsuario('.$reg->idUsuario.')"><i class="fa fa-trash"></i></button>';
        }elseif($reg->Estado_idEstado==4){
            return '<button type="button"  title="Habilitar" class="btn btn-info btn-sm" onclick="HabilitarUsuario('.$reg->idUsuario.')"><i class="fa fa-sync"></i></button>';
        }
    }

   switch($_GET['op']){
        case 'AccionUsuario':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idUsuario)){

                /*--  validar si el numero de la factura ya se encuentra emitido  --*/
                $validarUsuario=$mantenimiento->ValidarUsuario($UsuarioUsuario,$idUsuario);
                if($validarUsuario>0){
                    $rspta["Mensaje"].="El Usuario ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Usuario.";
                }else{
                    $RespuestaRegistro=$mantenimiento->RegistroUsuario($UsuarioPersona,$UsuarioUsuario,$UsuarioPerfil,$UsuarioPassword,$UsuarioEstado,$idUsuario,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Usuario se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Usuario no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{

                 $validarUsuario=$mantenimiento->ValidarUsuario($UsuarioUsuario,$idUsuario);
                if($validarUsuario>0){
                    $rspta["Mensaje"].="El Usuario ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Usuario.";
                }else{

                    $RespuestaRegistro=$mantenimiento->RegistroUsuario($UsuarioPersona,$UsuarioUsuario,$UsuarioPerfil,$UsuarioPassword,$UsuarioEstado,$idUsuario,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Usuario se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Usuario no se puede Actualizar comuniquese con el area de soporte.";
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
       case 'listar_perfiles':
            echo '<option value="0">-- SELECCIONAR --</option>';
      		$rpta = $general->Listar_Perfiles();
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idPerfil . '>' . $reg->nombrePerfil . '</option>';
         	}
       break;

       case 'listar_personas_sin_usuario':
            echo '<option value="0">-- SELECCIONAR --</option>';
      		$rpta = $general->Listar_Personas_Sin_Usuario();
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idPersona . '>' . $reg->nombrePersona.' '.$reg->apellidoPaterno.' '.$reg->apellidoMaterno.'</option>';
         	}
       break;
		case 'listar_personas_todo':
            echo '<option value="0">-- SELECCIONAR --</option>';
      		$rpta = $general->Listar_Personas_Todo();
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idPersona . '>' . $reg->nombrePersona.' '.$reg->apellidoPaterno.' '.$reg->apellidoMaterno.'</option>';
         	}
       break;

		case 'Listar_Usuario':

         $rspta=$mantenimiento->Listar_Usuarios_Todos();
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
               "1"=>BuscarEstado($reg),
               "2"=>$reg->nombrePerfil,
               "3"=>$reg->NombrePersona,
               "4"=>$reg->usuario,
               "5"=>$reg->fechaRegistro,
               "6"=>BuscarAccion($reg)
            );
         }
         $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
         echo json_encode($results);
      break;

      case 'Eliminar_Usuario':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Usuario($idUsuario,1,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Usuario Eliminado.":$rspta['Mensaje']="Usuario no se pudo eliminar comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

      case 'Recuperar_Usuario':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Usuario($idUsuario,2,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Usuario Restablecido.":$rspta['Mensaje']="Usuario no se pudo Restablecer comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

		case 'RecuperarInformacion_Usuario':
			$rspta=$mantenimiento->Recuperar_Usuario($idUsuario);
         echo json_encode($rspta);
      break;


   }


?>
