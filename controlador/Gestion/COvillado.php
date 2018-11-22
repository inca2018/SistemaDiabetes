<?php
   session_start();
   require_once "../../modelo/Gestion/MOvillado.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";


    $gestion = new MOvillado();
    $general = new MGeneral();
    $recursos = new Conexion();


	 $login_idLog=$_SESSION['idUsuario'];

	 $idEnconado=isset($_POST["idEnconado"])?limpiarCadena($_POST["idEnconado"]):"";

	$idOrden=isset($_POST["idOrden"])?limpiarCadena($_POST["idOrden"]):"";

	$idOvilladoGestion=isset($_POST["idOvilladoGestion"])?limpiarCadena($_POST["idOvilladoGestion"]):"";
	$OvilladoNombre=isset($_POST["OvilladoNombre"])?limpiarCadena($_POST["OvilladoNombre"]):"";
	$OvilloTrabajador=isset($_POST["OvilloTrabajador"])?limpiarCadena($_POST["OvilloTrabajador"]):"";

	$OvilladoPeso=isset($_POST["OvilladoPeso"])?limpiarCadena($_POST["OvilladoPeso"]):"";
	$OvilladoLote=isset($_POST["OvilladoLote"])?limpiarCadena($_POST["OvilladoLote"]):"";
	$OvilladoCantidad=isset($_POST["OvilladoCantidad"])?limpiarCadena($_POST["OvilladoCantidad"]):"";
$OvilladoObservacion=isset($_POST["OvilladoObservacion"])?limpiarCadena($_POST["OvilladoObservacion"]):"";

	$OvilladoMaterial=isset($_POST["idMaterialOculto"])?limpiarCadena($_POST["idMaterialOculto"]):"";

    function BuscarEstado($reg){

       if($reg->Estado_idEstado=='5' || $reg->Estado_idEstado==5){
               if($reg->RechazoOvillado==null){
                    return '<div class="badge badge-purple">'.$reg->nombreEstado.'</div>';
               }else{
                    return '<div class="badge badge-danger">ORDEN RECHAZADA POR CALIDAD</div>';
               }
		 }elseif($reg->Estado_idEstado=='1' || $reg->Estado_idEstado==1){
			   return '<div class="badge badge-success">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='2' || $reg->Estado_idEstado==2){
			   return '<div class="badge badge-danger">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='6' || $reg->Estado_idEstado==6){
			   return '<div class="badge badge-warning">ENVIADO A CALIDAD</div>';
		  }elseif($reg->Estado_idEstado=='7' || $reg->Estado_idEstado==7){
			   return '<div class="badge badge-success">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='8' || $reg->Estado_idEstado==8){
			   return '<div class="badge badge-warning">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='9' || $reg->Estado_idEstado==9){
			   return '<div class="badge badge-warning">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='10' || $reg->Estado_idEstado==10){
			   return '<div class="badge badge-info">'.$reg->nombreEstado.'</div>';
        }
    }

  function BuscarEstado2($reg){

       if ($reg->Estado_idEstado=='1' || $reg->Estado_idEstado==1){
			   return '<div class="badge badge-success">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='2' || $reg->Estado_idEstado==2){
			   return '<div class="badge badge-danger">'.$reg->nombreEstado.'</div>';
		  }

    }
  function BuscarAccion($reg){
		  $resp="";
		  if($reg->Estado_idEstado==5){
            $resp.='<button type="button"  title="Enviar a Calidad" class="btn btn-primary btn-sm" onclick="EnviarCalidad('.$reg->idOrden.')"><i class="far fa-share-square"></i></button><button type="button"  title="Gestión de Ordenes de Ovillado" class="btn btn-purple btn-sm ml-2" onclick="OrdenesOvillado('.$reg->idOrden.')"><i class="fas fa-list-ul"></i></button>';
        }elseif($reg->Estado_idEstado==6){
			   $resp.='<button type="button"  title="Mostrar Ordenes de Ovillado" class="btn btn-primary btn-sm ml-2" onclick="OrdenesOvilladoLista('.$reg->idOrden.')"><i class="fas fa-list-ul"></i></button>';
		  }elseif($reg->Estado_idEstado==7){
              $resp.='<button type="button"  title="Mostrar Ordenes de Ovillado" class="btn btn-primary btn-sm ml-2" onclick="OrdenesOvilladoLista('.$reg->idOrden.')"><i class="fas fa-list-ul"></i></button>';
          }

       if($reg->RechazoOvillado!=null){
             $resp.= '<button type="button"  title="Información de Rechazo" class="btn btn-danger btn-sm ml-2" onclick="InformacionRechazo('.$reg->idOrden.')"><i class="fas fa-info"></i></button>';
          }

		 return $resp;
    }
  function BuscarAccion2($reg){
		  $resp="";
        if($reg->Estado_idEstado==1 || $reg->Estado_idEstado==2){
            $resp.='
            <button type="button" title="Editar" class="btn btn-warning btn-sm" onclick="EditarOvillado('.$reg->idOvillado.')"><i class="fa fa-edit"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarOvillado('.$reg->idOvillado.')"><i class="fa fa-trash"></i></button>
               ';
        }

		 return $resp;
    }

   switch($_GET['op']){
        case 'AccionOvillado':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idEnconado)){

                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Orden de Trabajo de Ovillado.";
                }else{
                    $RespuestaRegistro=$gestion->RegistroOvillado($idOrden,$idOvilladoGestion,$OvilladoNombre,$OvilloTrabajador,$OvilladoMaterial,$OvilladoPeso,$OvilladoLote,$OvilladoCantidad,$OvilladoObservacion);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Orden Trabajo de Ovillado se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Orden Trabajo de Ovillado no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{

                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Orden Trabajo de Ovillado.";
                }else{
                    $RespuestaRegistro=$gestion->RegistroOvillado($idOrden,$idOvilladoGestion,$OvilladoNombre,$OvilloTrabajador,$OvilladoMaterial,$OvilladoPeso,$OvilladoLote,$OvilladoCantidad,$OvilladoObservacion);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Orden Trabajo de Ovillado se Actualizo Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Orden Trabajo de Ovillado no se puede Actualizar comuniquese con el area de soporte.";
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
		 case 'listar_trabajadores':

      		$rpta = $general->Listar_Personas_Todo();
            echo '<option value="0"> -- SELECCIONE -- </option> ';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idPersona. '>' . $reg->nombrePersona.' '.$reg->apellidoPaterno.' '.$reg->apellidoMaterno.' DNI: '.$reg->DNI. '</option>';
         	}
       break;

		case 'Listar_Ovillado':

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
			case 'Listar_GestionOvilladoLista':

         $rspta=$gestion->Listar_GestionOvillado($idOrden);
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
               "1"=>BuscarEstado2($reg),
               "2"=>$reg->cod_orden,
               "3"=>$reg->Trabajador,
					"4"=>$reg->NombreMaterial,
					"5"=>$reg->cod_trabajo,
					"6"=>$reg->Cantidadovillos,
				   "7"=>$reg->PesoOvillo,
					"8"=>$reg->LoteOvillo,
					"9"=>$reg->fechaRegistro,
					"10"=>BuscarAccion2($reg)
            );
         }

         $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
         echo json_encode($results);
      break;
			case 'Listar_Gestion_trabajos':

         $rspta=$gestion->Listar_GestionOvillado($idOrden);
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
               "1"=>$reg->cod_orden,
               "2"=>$reg->Trabajador,
					"3"=>$reg->NombreMaterial,
					"4"=>$reg->cod_trabajo,
					"5"=>$reg->Cantidadovillos,
				   "6"=>$reg->PesoOvillo,
					"7"=>$reg->LoteOvillo,
					"8"=>$reg->fechaRegistro,
            );
         }
         $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
         echo json_encode($results);
      break;


      case 'Eliminar_Ovillado':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$gestion->Eliminar_Ovillado($idOvilladoGestion);

         $rspta['Eliminar']?$rspta['Mensaje']="Orden de Trabajo de Ovillado Eliminado Correctamente.":$rspta['Mensaje']="Orden de Trabajao de Ovillado no se pudo eliminar comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

      case 'RecuperarInformacion_Ovillado':
			$rspta=$gestion->Recuperar_Ovillado($idOvilladoGestion);
         echo json_encode($rspta);
      break;

		 case 'RecuperarCorrelativo':
			$rspta=$gestion->RecuperarCorrelativo();
         echo json_encode($rspta);
      break;
			 case 'RecuperarMaterialDato':
			$rspta=$gestion->RecuperarMaterialDato($idOrden);
         echo json_encode($rspta);
      break;


      case 'Enviar_Calidad':
         $rspta = array("Mensaje"=>"","Enviar"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
			$verificacion=$gestion->VerificarTrabajos($idEnconado);
			if($verificacion["Cantidad"]<=0){
				$rspta['Mensaje']="Debe Registrar una Orden de Ovillado para poder Continuar.";
			}else{
				$rspta['Enviar']=$gestion->Enviar_Calidad($idEnconado);
         	$rspta['Enviar']?$rspta['Mensaje']="Orden Enviada.":$rspta['Mensaje']="Orden no se pudo enviar comuniquese con el area de soporte";
			}

         echo json_encode($rspta);
      break;

       case 'RecuperarRechazo':
			$rspta=$gestion->RecuperarRechazo($idEnconado);
         echo json_encode($rspta);
      break;
   }


?>
