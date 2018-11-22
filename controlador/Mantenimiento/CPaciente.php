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
    $PacienteDNI=isset($_POST["PacienteDNI"])?limpiarCadena($_POST["PacienteDNI"]):"";
    $PacienteTelefono=isset($_POST["PacienteTelefono"])?limpiarCadena($_POST["PacienteTelefono"]):"";
    $PacienteDireccion=isset($_POST["PacienteDireccion"])?limpiarCadena($_POST["PacienteDireccion"]):"";
    $PacienteCorreo=isset($_POST["PacienteCorreo"])?limpiarCadena($_POST["PacienteCorreo"]):"";
    $PacienteEnfermedad=isset($_POST["PacienteEnfermedad"])?limpiarCadena($_POST["PacienteEnfermedad"]):"";
    $PacienteDX=isset($_POST["PacienteDX"])?limpiarCadena($_POST["PacienteDX"]):"";
    $PacienteMedico=isset($_POST["PacienteMedico"])?limpiarCadena($_POST["PacienteMedico"]):"";
    $PacienteProcedencia=isset($_POST["PacienteProcedencia"])?limpiarCadena($_POST["PacienteProcedencia"]):"";
    $PacienteCondicion=isset($_POST["PacienteCondicion"])?limpiarCadena($_POST["PacienteCondicion"]):"";
    $PacienteSexo=isset($_POST["PacienteSexo"])?limpiarCadena($_POST["PacienteSexo"]):"";
    $PacienteEstado=isset($_POST["PacienteEstado"])?limpiarCadena($_POST["PacienteEstado"]):"";



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
    function BuscarAccion($reg){
        if($reg->Estado_idEstado==1 || $reg->Estado_idEstado==2 ){
            return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarPaciente('.$reg->idPaciente.','.$reg->idPersona.')"><i class="fa fa-edit"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarPaciente('.$reg->idPaciente.','.$reg->idPersona.')"><i class="fa fa-trash"></i></button>';
        }elseif($reg->Estado_idEstado==4){
            return '<button type="button"  title="Habilitar" class="btn btn-info btn-sm" onclick="HabilitarPaciente('.$reg->idPaciente.','.$reg->idPersona.')"><i class="fa fa-sync"></i></button>';
        }
    }

   switch($_GET['op']){
        case 'AccionPaciente':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idPaciente)){

                /*--  validar si el numero de la factura ya se encuentra emitido  --*/
                $validarPaciente=$mantenimiento->ValidarPaciente($PacienteDNI,$idPersona);
                if($validarPaciente>0){
                    $rspta["Mensaje"].="El Paciente ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Paciente.";
                }else{
                    $RespuestaRegistro=$mantenimiento->RegistroPaciente($idPersona,$idPaciente,$PacienteCodigo,$PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$PacienteFechaNacimiento,$PacienteDNI,$PacienteTelefono,$PacienteDireccion,$PacienteCorreo,$PacienteEnfermedad,$PacienteDX,$PacienteMedico,$PacienteProcedencia,$PacienteCondicion,$PacienteSexo,$PacienteEstado,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Paciente se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Paciente no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{
                 $validarPaciente=$mantenimiento->ValidarPaciente($PacienteDNI,$idPersona);
                if($validarPaciente>0){
                    $rspta["Mensaje"].="El Paciente ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Paciente.";
                }else{

                    $RespuestaRegistro=$mantenimiento->RegistroPaciente($idPersona,$idPaciente,$PacienteCodigo,$PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$PacienteFechaNacimiento,$PacienteDNI,$PacienteTelefono,$PacienteDireccion,$PacienteCorreo,$PacienteEnfermedad,$PacienteDX,$PacienteMedico,$PacienteProcedencia,$PacienteCondicion,$PacienteSexo,$PacienteEstado,$login_idLog);
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
        case 'listar_estados':

      		$rpta = $general->Listar_Estados(1);
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idEstado . '>' . $reg->nombreEstado . '</option>';
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
					echo '<option   value=' . $reg->idPersona . '>' . $reg->NombreMedico . '</option>';
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
                "3"=>$reg->NomnbrePersona,
                "4"=>$reg->DNI,
                "5"=>$reg->TipoEnfermedad,
                "6"=>$reg->SexoPaciente,
                "7"=>$reg->CondicionPaciente,
                "8"=>$reg->Procedencia,
                "9"=>$reg->MedicoPaciente,
                "10"=>BuscarAccion($reg)

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
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Paciente($idPersona,1,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Paciente Eliminado.":$rspta['Mensaje']="Paciente no se pudo eliminar comuniquese con el area de soporte";
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
