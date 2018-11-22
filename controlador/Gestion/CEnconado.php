<?php
   session_start();
   require_once "../../modelo/Gestion/MEnconado.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";


    $gestion = new MEnconado();
    $general = new MGeneral();
    $recursos = new Conexion();


	 $login_idLog=$_SESSION['idUsuario'];

		$idEnconado=isset($_POST["idEnconado"])?limpiarCadena($_POST["idEnconado"]):"";
		$EnconadoNombre=isset($_POST["EnconadoNombre"])?limpiarCadena($_POST["EnconadoNombre"]):"";
		$EnconadoMaterial=isset($_POST["EnconadoMaterial"])?limpiarCadena($_POST["EnconadoMaterial"]):"";
		$EnconadoLote=isset($_POST["EnconadoLote"])?limpiarCadena($_POST["EnconadoLote"]):"";
		$EnconadoKilos=isset($_POST["EnconadoKilos"])?limpiarCadena($_POST["EnconadoKilos"]):"";
		$EnconadoNumero=isset($_POST["EnconadoNumero"])?limpiarCadena($_POST["EnconadoNumero"]):"";
        $EnconadoObservacion=isset($_POST["EnconadoObservacion"])?limpiarCadena($_POST["EnconadoObservacion"]):"";


    function BuscarEstado($reg){

        if($reg->Estado_idEstado=='5' || $reg->Estado_idEstado==5){
			   return '<div class="badge badge-purple">ENVIADO A OVILLADO</div>';
		  }elseif($reg->Estado_idEstado=='6' || $reg->Estado_idEstado==6){
			   return '<div class="badge badge-warning">EN PROCESO DE CALIDAD</div>';
		  }elseif($reg->Estado_idEstado=='7' || $reg->Estado_idEstado==7){
			   return '<div class="badge badge-success">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='8' || $reg->Estado_idEstado==8){
			   return '<div class="badge badge-warning">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='9' || $reg->Estado_idEstado==9){
			   return '<div class="badge badge-warning">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='10' || $reg->Estado_idEstado==10){
                if($reg->RechazoEnconado==null || $reg->RechazoEnconado==""){
                     return '<div class="badge badge-info">'.$reg->nombreEstado.'</div>';
                }else{
                    return '<div class="badge badge-danger">ORDEN RECHAZADA POR CALIDAD</div>';
                }

        }else{
             return '<div class="badge badge-primary">'.$reg->nombreEstado.'</div>';
        }
    }
    function BuscarAccion($reg){
        $respuesta="";
        if($reg->Estado_idEstado==1 || $reg->Estado_idEstado==2 || $reg->Estado_idEstado==10){
            $respuesta.= '
				 <button type="button"  title="Enviar a Ovillado" class="btn btn-primary btn-sm" onclick="EnviarOVillado('.$reg->idOrden.')"><i class="far fa-share-square"></i></button>
            <button type="button" title="Editar" class="btn btn-warning btn-sm" onclick="EditarEnconado('.$reg->idOrden.')"><i class="fa fa-edit"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarEnconado('.$reg->idOrden.')"><i class="fa fa-trash"></i></button>
               ';
        }elseif($reg->Estado_idEstado==5 || $reg->Estado_idEstado==6 || $reg->Estado_idEstado==7){
            $respuesta.= '<button type="button"  title="Detalles de Orden" class="btn btn-info btn-sm" onclick="Informacion('.$reg->idOrden.')"><i class="fas fa-info"></i></button>';
        }

         if($reg->RechazoEnconado!=null){
             $respuesta.= '<button type="button"  title="Información de Rechazo" class="btn btn-danger btn-sm ml-2" onclick="InformacionRechazo('.$reg->idOrden.')"><i class="fas fa-info"></i></button>';
          }

        return $respuesta;
    }

   switch($_GET['op']){
        case 'AccionEnconado':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idEnconado)){

                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Enconado.";
                }else{
                    $RespuestaRegistro=$gestion->RegistroEnconado($idEnconado,$EnconadoNombre,$EnconadoMaterial,$EnconadoLote,$EnconadoKilos,$EnconadoNumero,$login_idLog,$EnconadoObservacion);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Enconado se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Enconado no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{

                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Enconado.";
                }else{

                    $RespuestaRegistro=$gestion->RegistroEnconado($idEnconado,$EnconadoNombre,$EnconadoMaterial,$EnconadoLote,$EnconadoKilos,$EnconadoNumero,$login_idLog,$EnconadoObservacion);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Enconado se Actualizo Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Enconado no se puede Actualizar comuniquese con el area de soporte.";
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
		 case 'listar_materiales':

      		$rpta = $general->Listar_Materiales();
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idMaterial. '>' . $reg->Descripcion . '</option>';
         	}
       break;


		case 'Listar_Enconado':

         $rspta=$gestion->Listar_Enconado();
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
               "1"=>BuscarEstado($reg),
               "2"=>$reg->NumOrden,
               "3"=>$reg->Descripcion,
					"4"=>$reg->Lote,
					"5"=>$reg->Kilos,
					"6"=>$reg->NumConos,
				   "7"=>$reg->fechaRegistro,
					"8"=>BuscarAccion($reg)
            );
         }
         $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
         echo json_encode($results);
      break;

      case 'Eliminar_Enconado':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$gestion->Eliminar_Enconado($idEnconado);

         $rspta['Eliminar']?$rspta['Mensaje']="Enconado Eliminado.":$rspta['Mensaje']="Enconado no se pudo eliminar comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

      case 'Recuperar_Enconado':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$gestion->Eliminar_Enconado($idEnconado,2,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Enconado Restablecido.":$rspta['Mensaje']="Enconado no se pudo Restablecer comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

      case 'RecuperarInformacion_Enconado':
			$rspta=$gestion->Recuperar_Enconado($idEnconado);
         echo json_encode($rspta);
      break;

      case 'RecuperarRechazo':
			$rspta=$gestion->RecuperarRechazo($idEnconado);
         echo json_encode($rspta);
      break;

		 case 'RecuperarCorrelativo':
			$rspta=$gestion->RecuperarCorrelativo();
         echo json_encode($rspta);
      break;


      case 'Enviar_Enconado':
         $rspta = array("Mensaje"=>"","Enviar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Enviar']=$gestion->Enviar_Enconado($idEnconado);

         $rspta['Enviar']?$rspta['Mensaje']="Orden Enviada.":$rspta['Mensaje']="Orden no se pudo enviar comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;


   }


?>
