<?php
   session_start();
   require_once "../../modelo/Gestion/MGestion.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";
   require_once "../../../php/PasswordHash.php";

    $gestion = new MGestion();
    $general = new MGeneral();
    $recursos = new Conexion();


	 $login_idLog=$_SESSION['idUsuario'];

    $fechaInicio=isset($_POST["fechaInicio"])?limpiarCadena($_POST["fechaInicio"]):"";
    $fechaFin=isset($_POST["fechaFin"])?limpiarCadena($_POST["fechaFin"]):"";

    // GESTION DE PERFIL
    $UsuarioCorreo=isset($_POST["UsuarioCorreo"])?limpiarCadena($_POST["UsuarioCorreo"]):"";
    $UsuarioContacto=isset($_POST["UsuarioContacto"])?limpiarCadena($_POST["UsuarioContacto"]):"";
    $idUsuario=isset($_POST["idUsuario"])?limpiarCadena($_POST["idUsuario"]):"";

    $UsuarioPassVerificar=isset($_POST["UsuarioPassVerificar"])?limpiarCadena($_POST["UsuarioPassVerificar"]):"";
    $UsuarioPassNuevo=isset($_POST["UsuarioPassNuevo"])?limpiarCadena($_POST["UsuarioPassNuevo"]):"";


    $date = str_replace('/', '-', $fechaInicio);
    $fechaInicio = date("Y-m-d", strtotime($date));
 	 $date = str_replace('/', '-', $fechaFin);
    $fechaFin = date("Y-m-d", strtotime($date));


   switch($_GET['op']){
       case 'RecuperarDatosPerfil':
         $rspta=$gestion->RecuperarDatosPerfil($login_idLog);
         echo json_encode($rspta);
      break;

     case 'ActualizarPerfil':
           $rspta = array("Mensaje"=>"","Registro"=>false,"Error"=>false);

           $hasher=new PasswordHash(8,false);
           $hash=$gestion->password($idUsuario);
           $hash=$hash['pass'];

           if($UsuarioPassVerificar=='' || $UsuarioPassVerificar==null){
                $rspta["Registro"]=$gestion->actualizar_datos_perfil($idUsuario,$UsuarioCorreo,$UsuarioContacto,$UsuarioPassNuevo,1);
               $rspta["Mensaje"]="Datos del Perfil Actualizado Correctamente.";
           }else{

                if($hasher->CheckPassword($UsuarioPassVerificar,$hash)==1){

                  $UsuarioPassword = $hasher->HashPassword($UsuarioPassNuevo);
                  $rspta["Registro"]=$gestion->actualizar_datos_perfil($idUsuario,$UsuarioCorreo,$UsuarioContacto,$UsuarioPassword,2);
                  $rspta["Mensaje"]="Datos del Perfil Actualizado Correctamente.";

               }else{
                 $rspta["Registro"]=false;
                 $rspta["Mensaje"]="Contraseña anterior incorrecta";
               }
           }


         echo json_encode($rspta);
      break;

   }


?>
