<?php
   session_start();
   require_once "../../modelo/Mantenimiento/MPersona.php";
   require_once "../../modelo/General/MGeneral.php";
   $mantenimiento = new MPersona();
   $general = new MGeneral();


$idPersona=isset($_POST["idPersona"])?limpiarCadena($_POST["idPersona"]):"";
$PersonaNombre=isset($_POST["PersonaNombre"])?limpiarCadena($_POST["PersonaNombre"]):"";
$PersonaFechaNacimiento=isset($_POST["PersonaFechaNacimiento"])?limpiarCadena($_POST["PersonaFechaNacimiento"]):"";
$PersonaApellidoP=isset($_POST["PersonaApellidoP"])?limpiarCadena($_POST["PersonaApellidoP"]):"";
$PersonaDNI=isset($_POST["PersonaDNI"])?limpiarCadena($_POST["PersonaDNI"]):"";
$PersonaApellidoM=isset($_POST["PersonaApellidoM"])?limpiarCadena($_POST["PersonaApellidoM"]):"";
$PersonaCorreo=isset($_POST["PersonaCorreo"])?limpiarCadena($_POST["PersonaCorreo"]):"";
$PersonaTelefono=isset($_POST["PersonaTelefono"])?limpiarCadena($_POST["PersonaTelefono"]):"";
$PersonaDireccion=isset($_POST["PersonaDireccion"])?limpiarCadena($_POST["PersonaDireccion"]):"";
$PersonaEstado=isset($_POST["PersonaEstado"])?limpiarCadena($_POST["PersonaEstado"]):"";



   $login_idLog=$_SESSION['idUsuario'];

   //hora
   // date_default_timezone_set('America/Lima');
   //$FechaRegistro=date("Y-m-d H:i:s");
 	$date = str_replace('/', '-', $PersonaFechaNacimiento);
   $PersonaFechaNacimiento = date("Y-m-d", strtotime($date));
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
            return '<button type="button"   title="Editar" class="btn btn-warning btn-sm" onclick="EditarPersona('.$reg->idPersona.')"><i class="fa fa-edit"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarPersona('.$reg->idPersona.')"><i class="fa fa-trash"></i></button>';
        }elseif($reg->Estado_idEstado==4){
            return '<button type="button"  title="Habilitar" class="btn btn-info btn-sm" onclick="HabilitarPersona('.$reg->idPersona.')"><i class="fa fa-sync"></i></button>';
        }
    }

   switch($_GET['op']){
        case 'AccionPersona':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idPersona)){

                /*--  validar si el numero de la factura ya se encuentra emitido  --*/
                $validarPersona=$mantenimiento->ValidarPersona($PersonaDNI,$idPersona);
                if($validarPersona>0){
                    $rspta["Mensaje"].="El Persona ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Persona.";
                }else{
                    $RespuestaRegistro=$mantenimiento->RegistroPersona($PersonaNombre,$PersonaApellidoP,$PersonaApellidoM,$PersonaDNI,$PersonaFechaNacimiento,$PersonaCorreo,$PersonaTelefono,$PersonaDireccion,$PersonaEstado,$idPersona,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Persona se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Persona no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{
                 $validarPersona=$mantenimiento->ValidarPersona($PersonaDNI,$idPersona);
                if($validarPersona>0){
                    $rspta["Mensaje"].="El Persona ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Persona.";
                }else{

                    $RespuestaRegistro=$mantenimiento->RegistroPersona($PersonaNombre,$PersonaApellidoP,$PersonaApellidoM,$PersonaDNI,$PersonaFechaNacimiento,$PersonaCorreo,$PersonaTelefono,$PersonaDireccion,$PersonaEstado,$idPersona,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Persona se Actualizo Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Persona no se puede Actualizar comuniquese con el area de soporte.";
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
      		$rpta = $general->Listar_Personas_Sin_Persona();
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

		case 'Listar_Persona':

         $rspta=$mantenimiento->Listar_Personas_Todos();
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
               "1"=>BuscarEstado($reg),
               "2"=>$reg->nombrePersona,
               "3"=>$reg->apellidoPaterno." ".$reg->apellidoMaterno,
               "4"=>$reg->DNI,
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

      case 'Eliminar_Persona':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Persona($idPersona,1,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Persona Eliminado.":$rspta['Mensaje']="Persona no se pudo eliminar comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

      case 'Recuperar_Persona':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Persona($idPersona,2,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Persona Restablecido.":$rspta['Mensaje']="Persona no se pudo Restablecer comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

		case 'RecuperarInformacion_Persona':
			$rspta=$mantenimiento->Recuperar_Persona($idPersona);
         echo json_encode($rspta);
      break;


   }


?>
