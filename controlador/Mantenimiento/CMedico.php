<?php
   session_start();
   require_once "../../modelo/Mantenimiento/MMedico.php";
   require_once "../../modelo/General/MGeneral.php";
   $mantenimiento = new MMedico();
   $general = new MGeneral();


    $idMedico=isset($_POST["idMedico"])?limpiarCadena($_POST["idMedico"]):"";

    $MedicoNombre=isset($_POST["MedicoNombre"])?limpiarCadena($_POST["MedicoNombre"]):"";
    $MedicoApellidoP=isset($_POST["MedicoApellidoP"])?limpiarCadena($_POST["MedicoApellidoP"]):"";
    $MedicoApellidoM=isset($_POST["MedicoApellidoM"])?limpiarCadena($_POST["MedicoApellidoM"]):"";
    $MedicoFechaNacimiento=isset($_POST["MedicoFechaNacimiento"])?limpiarCadena($_POST["MedicoFechaNacimiento"]):"";
    $MedicoEdad=isset($_POST["MedicoEdad"])?limpiarCadena($_POST["MedicoEdad"]):"";
    $MedicoDNI=isset($_POST["MedicoDNI"])?limpiarCadena($_POST["MedicoDNI"]):"";
    $MedicoSexo=isset($_POST["MedicoSexo"])?limpiarCadena($_POST["MedicoSexo"]):"";
    $MedicoTelefono=isset($_POST["MedicoTelefono"])?limpiarCadena($_POST["MedicoTelefono"]):"";
    $MedicoCelular=isset($_POST["MedicoCelular"])?limpiarCadena($_POST["MedicoCelular"]):"";
    $MedicoCorreo=isset($_POST["MedicoCorreo"])?limpiarCadena($_POST["MedicoCorreo"]):"";



    $Opcion=isset($_POST["Opcion"])?limpiarCadena($_POST["Opcion"]):"";

    $login_idLog=$_SESSION['idUsuario'];

   //hora
   // date_default_timezone_set('America/Lima');
   //$FechaRegistro=date("Y-m-d H:i:s");
   $date = str_replace('/', '-', $MedicoFechaNacimiento);
   $MedicoFechaNacimiento = date("Y-m-d", strtotime($date));
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

function BuscarAccion($reg)
{
    if ($reg->Estado_idEstado == 1) {
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarMedico(' . $reg->idMedico . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionMedico(' . $reg->idMedico . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarMedico(' . $reg->idMedico . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionMedico(' . $reg->idMedico . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarMedico(' . $reg->idMedico . ')"><i class="fa fa-trash"></i></button>';
    }
}

   switch($_GET['op']){
        case 'AccionMedico':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idMedico)){

                /*--  validar si el numero de la factura ya se encuentra emitido  --*/
                $validarMedico=$mantenimiento->ValidarMedico($MedicoDNI,$idMedico);
                if($validarMedico>0){
                    $rspta["Mensaje"].="El Medico ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Medico.";
                }else{
                    $RespuestaRegistro=$mantenimiento->RegistroMedico($idMedico,$MedicoNombre,$MedicoApellidoP,$MedicoApellidoM,$MedicoFechaNacimiento,$MedicoEdad,$MedicoDNI,$MedicoSexo,$MedicoTelefono,$MedicoCelular,$MedicoCorreo);

                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Medico se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Medico no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{
                 $validarMedico=$mantenimiento->ValidarMedico($MedicoDNI,$idMedico);
                if($validarMedico>0){
                    $rspta["Mensaje"].="El Medico ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Actualizar el Medico.";
                }else{

                    $RespuestaRegistro=$mantenimiento->RegistroMedico($idMedico,$MedicoNombre,$MedicoApellidoP,$MedicoApellidoM,$MedicoFechaNacimiento,$MedicoEdad,$MedicoDNI,$MedicoSexo,$MedicoTelefono,$MedicoCelular,$MedicoCorreo);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Medico se Actualizo Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Medico no se puede Actualizar comuniquese con el area de soporte.";
                    }
                }
            }

         echo json_encode($rspta);
       break;

           case 'listar_sexo':
      		$rpta = $general->Listar_Sexo();
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idSexo . '>' . $reg->Descripcion . '</option>';
         	}
       break;

		case 'Listar_Medico':

         $rspta=$mantenimiento->Listar_Medicos();
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
                "0"=>'',
                "1"=>BuscarEstado($reg),
                "2"=>$reg->Nombremedico,
                "3"=>$reg->edad,
                "4"=>$reg->dni,
                "5"=>$reg->Comunicacion,
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



    case 'Eliminar_Medico':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Medico($idMedico);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Medico Eliminado." : $rspta['Mensaje'] = "Medico no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Medico':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Medico($idMedico,$Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Medico " . $Mensaje : $rspta['Mensaje'] = "Medico no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;



      case 'Recuperar_Medico':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Medico($idPersona,2,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Medico Restablecido.":$rspta['Mensaje']="Medico no se pudo Restablecer comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

		case 'RecuperarInformacion_Medico':
			$rspta=$mantenimiento->Recuperar_Medico($idMedico);
         echo json_encode($rspta);
      break;


		 case 'RecuperarCorrelativo':
			$rspta=$mantenimiento->RecuperarCorrelativo();
         echo json_encode($rspta);
      break;

   }


?>
