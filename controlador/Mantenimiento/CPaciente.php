<?php
   session_start();
   require_once "../../modelo/Mantenimiento/MPaciente.php";
   require_once "../../modelo/General/MGeneral.php";
   $mantenimiento = new MPaciente();
   $general = new MGeneral();


    $idPersona=isset($_POST["idPersona"])?limpiarCadena($_POST["idPersona"]):"";

    $idPaciente=isset($_POST["idPaciente"])?limpiarCadena($_POST["idPaciente"]):"";
    $PacienteCodigo=isset($_POST["PacienteCodigo"])?limpiarCadena($_POST["PacienteCodigo"]):"";
    $PacienteNombre=isset($_POST["PacienteNombre"])?limpiarCadena($_POST["PacienteNombre"]):"";
    $PacienteApellidoP=isset($_POST["PacienteApellidoP"])?limpiarCadena($_POST["PacienteApellidoP"]):"";
    $PacienteApellidoM=isset($_POST["PacienteApellidoM"])?limpiarCadena($_POST["PacienteApellidoM"]):"";
    $PacienteFechaNacimiento=isset($_POST["PacienteFechaNacimiento"])?limpiarCadena($_POST["PacienteFechaNacimiento"]):"";
    $PacienteEdad=isset($_POST["PacienteEdad"])?limpiarCadena($_POST["PacienteEdad"]):"";
    $PacienteTipoDocumento=isset($_POST["PacienteTipoDocumento"])?limpiarCadena($_POST["PacienteTipoDocumento"]):"";
    $PacienteNumeroDocumento=isset($_POST["PacienteNumeroDocumento"])?limpiarCadena($_POST["PacienteNumeroDocumento"]):"";
    $PacienteSexo=isset($_POST["PacienteSexo"])?limpiarCadena($_POST["PacienteSexo"]):"";
    $PacienteTelefono=isset($_POST["PacienteTelefono"])?limpiarCadena($_POST["PacienteTelefono"]):"";
    $PacienteCelular=isset($_POST["PacienteCelular"])?limpiarCadena($_POST["PacienteCelular"]):"";
    $PacienteCorreo=isset($_POST["PacienteCorreo"])?limpiarCadena($_POST["PacienteCorreo"]):"";
    $PacienteDireccion=isset($_POST["PacienteDireccion"])?limpiarCadena($_POST["PacienteDireccion"]):"";



    $PacienteTipoMedida=isset($_POST["PacienteTipoMedida"])?limpiarCadena($_POST["PacienteTipoMedida"]):"";
    $PacienteCantidadMedida=isset($_POST["PacienteCantidadMedida"])?limpiarCadena($_POST["PacienteCantidadMedida"]):"";


    $PacienteDX=isset($_POST["PacienteDX"])?limpiarCadena($_POST["PacienteDX"]):"";
    $PacienteMedico=isset($_POST["PacienteMedico"])?limpiarCadena($_POST["PacienteMedico"]):"";
    $PacienteDepartamento=isset($_POST["PacienteDepartamento"])?limpiarCadena($_POST["PacienteDepartamento"]):"";
    $PacienteProvincia=isset($_POST["PacienteProvincia"])?limpiarCadena($_POST["PacienteProvincia"]):"";
    $PacienteDistrito=isset($_POST["PacienteDistrito"])?limpiarCadena($_POST["PacienteDistrito"]):"";
    $PacienteCondicion=isset($_POST["PacienteCondicion"])?limpiarCadena($_POST["PacienteCondicion"]):"";



    $idDepartamento=isset($_POST["idDepartamento"])?limpiarCadena($_POST["idDepartamento"]):"";
    $idProvincia=isset($_POST["idProvincia"])?limpiarCadena($_POST["idProvincia"]):"";
    $idDistrito=isset($_POST["idDistrito"])?limpiarCadena($_POST["idDistrito"]):"";


    $Opcion=isset($_POST["Opcion"])?limpiarCadena($_POST["Opcion"]):"";

   $login_idLog=$_SESSION['idUsuario'];

   //hora
   // date_default_timezone_set('America/Lima');
   //$FechaRegistro=date("Y-m-d H:i:s");
   $date = str_replace('/', '-', $PacienteFechaNacimiento);
   $PacienteFechaNacimiento = date("Y-m-d", strtotime($date));
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
        return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarPaciente(' . $reg->idPaciente . ')"><i class="fa fa-edit"></i></button>
                <button type="button"  title="Desactivación" class="btn btn-info btn-sm" onclick="DesactivacionPaciente(' . $reg->idPaciente . ')"><i class="fa fa-arrow-circle-down"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarPaciente(' . $reg->idPaciente . ')"><i class="fa fa-trash"></i></button>';
    } elseif ($reg->Estado_idEstado == 2) {
        return '<button type="button"  title="Activación" class="btn btn-info btn-sm" onclick="ActivacionPaciente(' . $reg->idPaciente . ')"><i class="fa fa-arrow-circle-up"></i></button>
            <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarPaciente(' . $reg->idPaciente . ')"><i class="fa fa-trash"></i></button>';
    }
}

   switch($_GET['op']){
        case 'AccionPaciente':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idPaciente)){

                /*--  validar si el numero de la factura ya se encuentra emitido  --*/
                $validarPaciente=$mantenimiento->ValidarPaciente($PacienteNumeroDocumento,$idPaciente);
                if($validarPaciente>0){
                    $rspta["Mensaje"].="El Paciente ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Paciente.";
                }else{
                    $RespuestaRegistro=$mantenimiento->RegistroPaciente($idPaciente,$PacienteCodigo,$PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$PacienteFechaNacimiento,$PacienteEdad,$PacienteTipoDocumento,$PacienteNumeroDocumento,$PacienteSexo,$PacienteTelefono,$PacienteCelular,$PacienteCorreo,$PacienteDireccion,$PacienteTipoMedida,$PacienteCantidadMedida,$PacienteDX,$PacienteMedico,$PacienteDepartamento,$PacienteProvincia,$PacienteDistrito,$PacienteCondicion);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Paciente se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Paciente no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{
                 $validarPaciente=$mantenimiento->ValidarPaciente($PacienteNumeroDocumento,$idPaciente);
                if($validarPaciente>0){
                    $rspta["Mensaje"].="El Paciente ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Actualizar el Paciente.";
                }else{

                    $RespuestaRegistro=$mantenimiento->RegistroPaciente($idPaciente,$PacienteCodigo,$PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$PacienteFechaNacimiento,$PacienteEdad,$PacienteTipoDocumento,$PacienteNumeroDocumento,$PacienteSexo,$PacienteTelefono,$PacienteCelular,$PacienteCorreo,$PacienteDireccion,$PacienteTipoMedida,$PacienteCantidadMedida,$PacienteDX,$PacienteMedico,$PacienteDepartamento,$PacienteProvincia,$PacienteDistrito,$PacienteCondicion);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Paciente se Actualizo Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Paciente no se puede Actualizar comuniquese con el area de soporte.";
                    }
                }
            }

         echo json_encode($rspta);
       break;
        case 'listar_Departamentos':

      		$rpta = $general->listar_Departamentos();
           echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idDepartamento . '>' . $reg->departamento . '</option>';
         	}
       break;
          case 'listar_Provincias':

      		$rpta = $general->listar_Provincias($idDepartamento);
            echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idProvincia . '>' . $reg->provincia . '</option>';
         	}
       break;
           case 'listar_Distritos':

      		$rpta = $general->listar_Distritos($idProvincia);
            echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idDistrito . '>' . $reg->distrito . '</option>';
         	}
       break;




        case 'listar_estados':

      		$rpta = $general->Listar_Estados(1);

         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idEstado . '>' . $reg->nombreEstado . '</option>';
         	}
       break;
            case 'listar_tipoMedida':
      		$rpta = $general->listar_tipoMedida();
            echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idTipoMedida . '>' . $reg->Descripcion . '</option>';
         	}
       break;
         case 'listar_tipoDocumento':

      		$rpta = $general->listar_tipoDocumento();
           echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idTipoDocumento . '>' . $reg->Descripcion . '</option>';
         	}
       break;
           case 'listar_sexo':
      		$rpta = $general->Listar_Sexo();
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idSexo . '>' . $reg->Descripcion . '</option>';
         	}
       break;

            case 'listar_condicion':
      		$rpta = $general->Listar_Condicion();
            echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idCondicion . '>' . $reg->Descripcion . '</option>';
         	}
       break;

        case 'listar_medicos':

      		$rpta = $general->Listar_Medicos();
            echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idMedico . '>' . $reg->nombres . '</option>';
         	}
       break;

            case 'listar_dx':
      		$rpta = $general->Listar_DX();
            echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idDiagnostico . '>' . $reg->Descripcion . '</option>';
         	}
       break;
          case 'listar_procedencia':
      		$rpta = $general->listar_procedencia();
            echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idDist . '>' . $reg->distrito . '</option>';
         	}
       break;



		case 'Listar_Paciente':

         $rspta=$mantenimiento->Listar_Pacientes_Todos();
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
                "1"=>BuscarEstado($reg),
                "2"=>$reg->Codigo,
                "3"=>$reg->NombreCompletoPaciente,
                "4"=>$reg->edad,
                "5"=>$reg->tipoDocu,
                "6"=>$reg->numeroDocumento,
                "7"=>$reg->condicion,
                "8"=>$reg->procedencia,
                "9"=>BuscarAccion($reg)

            );
         }
         $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
         echo json_encode($results);
      break;



       case 'Eliminar_Paciente':
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Eliminar_Paciente($idPaciente);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Paciente Eliminado." : $rspta['Mensaje'] = "Paciente no se pudo eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;

    case 'Activacion_Paciente':
        $Mensaje = "";
        ($Opcion == 1) ? $Mensaje = " Activado Correctamente. " : $Mensaje = " Desactivado Correctamente. ";
        $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $mantenimiento->Activacion_Paciente($idPaciente,$Opcion);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Paciente " . $Mensaje : $rspta['Mensaje'] = "Paciente no se pudo Restablecer comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;



      case 'Recuperar_Paciente':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Paciente($idPersona,2,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Paciente Restablecido.":$rspta['Mensaje']="Paciente no se pudo Restablecer comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

		case 'RecuperarInformacion_Paciente':
			$rspta=$mantenimiento->Recuperar_Paciente($idPaciente);
         echo json_encode($rspta);
      break;


		 case 'RecuperarCorrelativo':
			$rspta=$mantenimiento->RecuperarCorrelativo();
         echo json_encode($rspta);
      break;

   }


?>
