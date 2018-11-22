<?php
   session_start();
   require_once "../../modelo/Mantenimiento/MMaterial.php";
   require_once "../../modelo/General/MGeneral.php";
   $mantenimiento = new MMaterial();
   $general = new MGeneral();


	$idMaterial=isset($_POST["idMaterial"])?limpiarCadena($_POST["idMaterial"]):"";
	$MaterialNombre=isset($_POST["MaterialNombre"])?limpiarCadena($_POST["MaterialNombre"]):"";

	$MaterialEstado=isset($_POST["MaterialEstado"])?limpiarCadena($_POST["MaterialEstado"]):"";


	$login_idLog=$_SESSION['idUsuario'];



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
            return '
            <button type="button" title="Editar" class="btn btn-warning btn-sm" onclick="EditarMaterial('.$reg->idMaterial.')"><i class="fa fa-edit"></i></button>
               <button type="button"  title="Eliminar" class="btn btn-danger btn-sm" onclick="EliminarMaterial('.$reg->idMaterial.')"><i class="fa fa-trash"></i></button>
               ';
        }elseif($reg->Estado_idEstado==4){
            return '<button type="button"  title="Habilitar" class="btn btn-info btn-sm" onclick="HabilitarMaterial('.$reg->idMaterial.')"><i class="fa fa-sync"></i></button>';
        }
    }

   switch($_GET['op']){
        case 'AccionMaterial':
		 	$rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         if(empty($idMaterial)){

                /*--  validar si el numero de la factura ya se encuentra emitido  --*/
                $validarMaterial=$mantenimiento->ValidarMaterial($MaterialNombre,$idMaterial);
                if($validarMaterial>0){
                    $rspta["Mensaje"].="El Material ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Material.";
                }else{
                    $RespuestaRegistro=$mantenimiento->RegistroMaterial($idMaterial,$MaterialNombre,$MaterialEstado,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Material se registro Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Material no se puede registrar comuniquese con el area de soporte.";
                    }
                }
            }else{

                 $validarMaterial=$mantenimiento->ValidarMaterial($MaterialNombre,$idMaterial);
                if($validarMaterial>0){
                    $rspta["Mensaje"].="El Material ya se encuentra Registrado ";
                    $rspta["Error"]=true;
                }
                if($rspta["Error"]){
                    $rspta["Mensaje"].="Por estas razones no se puede Registrar el Material.";
                }else{

                    $RespuestaRegistro=$mantenimiento->RegistroMaterial($idMaterial,$MaterialNombre,$MaterialEstado,$login_idLog);
                    if($RespuestaRegistro){
                        $rspta["Registro"]=true;
                        $rspta["Mensaje"]="Material se Actualizo Correctamente.";
                    }else{
                        $rspta["Registro"]=false;
                        $rspta["Mensaje"]="Material no se puede Actualizar comuniquese con el area de soporte.";
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

		case 'Listar_Material':

         $rspta=$mantenimiento->Listar_Material();
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
               "1"=>BuscarEstado($reg),
               "2"=>$reg->Descripcion,
               "3"=>$reg->fechaRegistro,
               "4"=>BuscarAccion($reg)
            );
         }
         $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
         echo json_encode($results);
      break;

      case 'Eliminar_Material':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Material($idMaterial,1,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Material Eliminado.":$rspta['Mensaje']="Material no se pudo eliminar comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

      case 'Recuperar_Material':
         $rspta = array("Mensaje"=>"","Eliminar"=>false,"Error"=>false);
         /*------ Cuando el usuario ya se esta facturando, ya no se puede eliminar --------*/
         $rspta['Eliminar']=$mantenimiento->Eliminar_Material($idMaterial,2,$login_idLog);

         $rspta['Eliminar']?$rspta['Mensaje']="Material Restablecido.":$rspta['Mensaje']="Material no se pudo Restablecer comuniquese con el area de soporte";
         echo json_encode($rspta);
      break;

      case 'RecuperarInformacion_Material':
			$rspta=$mantenimiento->Recuperar_Material($idMaterial);
         echo json_encode($rspta);
      break;


   }


?>
