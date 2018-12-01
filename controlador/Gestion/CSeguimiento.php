<?php
   session_start();
   require_once "../../modelo/Gestion/MSeguimiento.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";


    $gestion = new MSeguimiento();
    $general = new MGeneral();
    $recursos = new Conexion();


	 $login_idLog=$_SESSION['idUsuario'];

      $id_paciente=isset($_POST["idPaciente"])? limpiarCadena($_POST["idPaciente"]):"";
    $id_ano=isset($_POST["idAno"])? limpiarCadena($_POST["idAno"]):"";
    $id_mes=isset($_POST["idMes"])? limpiarCadena($_POST["idMes"]):"";
    $riesgo=isset($_POST["riesgo"])? limpiarCadena($_POST["riesgo"]):"";
    $fecha_inicio=isset($_POST["fecha_inicio"])? limpiarCadena($_POST["fecha_inicio"]):"";
    $observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";
    $taller1=isset($_POST["taller1"])? limpiarCadena($_POST["taller1"]):"";
    $taller2=isset($_POST["taller2"])? limpiarCadena($_POST["taller2"]):"";
    $taller3=isset($_POST["taller3"])? limpiarCadena($_POST["taller3"]):"";
    $proxima_cita=isset($_POST["proxima_cita"])? limpiarCadena($_POST["proxima_cita"]):"";
    $id_usuario=isset($_POST["idUsuario"])? limpiarCadena($_POST["idUsuario"]):"";
    $estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

    $id_valores1=isset($_POST["id_valores1"])? limpiarCadena($_POST["id_valores1"]):"";
    $id_valores2=isset($_POST["id_valores2"])? limpiarCadena($_POST["id_valores2"]):"";
    $id_seguimiento=isset($_POST["id_seguimiento"])? limpiarCadena($_POST["id_seguimiento"]):"";

 /** ------------------VARIABLES NUEVOS ----------------------------------**/

    $Opciones1=isset($_POST["Opciones1"])? limpiarCadena($_POST["Opciones1"]):"";
    $Opciones2Radios=isset($_POST["Opciones2Radios"])? limpiarCadena($_POST["Opciones2Radios"]):"";
    $Opcion2Campos=isset($_POST["Opcion2Campos"])? limpiarCadena($_POST["Opcion2Campos"]):"";
    $Opcion3Radios=isset($_POST["Opcion3Radios"])? limpiarCadena($_POST["Opcion3Radios"]):"";
    $Opcion3Campos=isset($_POST["Opcion3Campos"])? limpiarCadena($_POST["Opcion3Campos"]):"";
    $Opcion4=isset($_POST["Opcion4"])? limpiarCadena($_POST["Opcion4"]):"";
    $riesgo=isset($_POST["riesgo"])? limpiarCadena($_POST["riesgo"]):"";
    $fechaInicio=isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]):"";
    $Obs=isset($_POST["Obs"])? limpiarCadena($_POST["Obs"]):"";
    $Taller1=isset($_POST["Taller1"])? limpiarCadena($_POST["Taller1"]):"";
    $Taller2=isset($_POST["Taller2"])? limpiarCadena($_POST["Taller2"]):"";
    $Taller3=isset($_POST["Taller3"])? limpiarCadena($_POST["Taller3"]):"";
    $proximaCita=isset($_POST["proximaCita"])? limpiarCadena($_POST["proximaCita"]):"";
    $Opcion5=isset($_POST["Opcion5"])? limpiarCadena($_POST["Opcion5"]):"";
    $Opcion5Fechas=isset($_POST["Opcion5Fechas"])? limpiarCadena($_POST["Opcion5Fechas"]):"";

    $idPaciente=isset($_POST["idPaciente"])? limpiarCadena($_POST["idPaciente"]):"";
    $idAno=isset($_POST["idAno"])? limpiarCadena($_POST["idAno"]):"";
    $idMes=isset($_POST["idMes"])? limpiarCadena($_POST["idMes"]):"";

	$talla=isset($_POST["talla"])? limpiarCadena($_POST["talla"]):"";
	$peso=isset($_POST["peso"])? limpiarCadena($_POST["peso"]):"";

    $idSeguimiento=isset($_POST["idSeguimiento"])? limpiarCadena($_POST["idSeguimiento"]):"";

   $date = str_replace('/', '-', $fechaInicio);
   $fechaInicio = date("Y-m-d", strtotime($date));

   $date = str_replace('/', '-', $proximaCita);
   $proximaCita= date("Y-m-d", strtotime($date));


function verificar($dato){
	if($dato["TOTAL"]==null){
		$dato["TOTAL"]=0;
	}
	return $dato;
}

   switch($_GET['op']){

  case 'guardaryeditar':

     	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idSeguimiento)){

                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Persona.";
                }else{
                    $RespuestaRegistro=$gestion->RegistroSeguimiento($idSeguimiento,$idPaciente,$idAno,$idMes,$Opciones1,$Opciones2Radios,$Opcion2Campos,$Opcion3Radios,$Opcion3Campos,$Opcion4,$riesgo,$fechaInicio,$Obs,$Taller1,$Taller2,$Taller3,$proximaCita,$Opcion5,$Opcion5Fechas);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Seguimiento se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Seguimiento no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{

                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Seguimiento.";
                }else{

                    $RespuestaRegistro=$gestion->RegistroSeguimiento($idSeguimiento,$idPaciente,$idAno,$idMes,$Opciones1,$Opciones2Radios,$Opcion2Campos,$Opcion3Radios,$Opcion3Campos,$Opcion4,$riesgo,$fechaInicio,$Obs,$Taller1,$Taller2,$Taller3,$proximaCita,$Opcion5,$Opcion5Fechas);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Seguimiento se Actualizo Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Seguimiento no se puede Actualizar comuniquese con el area de soporte.";
                    }
                }
            }

         echo json_encode($rspta);
      break;

     case 'mostrar':
         $rspta=$gestion->recuperar_paciente($id_paciente);
      echo json_encode($rspta);
      break;
      case 'RecuperarSeguimiento':
         $rspta=$gestion->RecuperarSeguimiento($idSeguimiento);
      echo json_encode($rspta);
      break;


      case 'recuperarSeguimiento':
         $rspta=$gestion->recuperarSeguimiento($id_paciente,$id_ano,$id_mes);
      echo json_encode($rspta);
      break;

       case 'EliminarSeguimiento':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$gestion->EliminarSeguimiento($idSeguimiento);

         $rspta['Eliminar']?$rspta['Mensaje']="Seguimiento Eliminado.":$rspta['Mensaje']="Seguimiento no se pudo eliminar comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

   }


?>
