<?php
  session_start([
   'cookie_lifetime' => 86400,
   //'read_and_close'  => true,
]);
   require_once "Mlogin.php";
   require_once "PasswordHash.php";

   $login=new login();

   $usu=isset($_POST["usu"])? limpiarCadena($_POST["usu"]):"";
   $pass=isset($_POST["pass"])? limpiarCadena($_POST["pass"]):"";
   $hasher=new PasswordHash(8,false);


switch ($_GET["op"]){

   case 'verificar':
        //$f=$hasher->HashPassword("123456");
        //echo $f;
      $rspta=array("Error"=>false,"Mensaje"=>"","Rol"=>"");
      // validar si el usuario exite
      $validausu=$login->validaUsuario($usu);


      if($validausu>0){

         $idusu=$login->idusu($usu);
         $idusu=$idusu['idUsuario'];
         //consulta contraseña
         $hash=$login->password($usu);
         $hash=$hash['pass'];

       if($hasher->CheckPassword($pass,$hash)==1){

            $rspta=$login->datosUsuario($idusu);
            $fetch=$rspta->fetch_object();
            if (isset($fetch)){

            $_SESSION['idUsuario']=$fetch->idUsuario;
            $_SESSION['perfil']=$fetch->Perfil;
            $_SESSION['nombrePerfil']=$fetch->nombrePerfil;
            $_SESSION['NombreUsuario']=$fetch->NombreUsuario;
            $_SESSION['Year']=date("Y");
            $_SESSION['permiso1']=$fetch->Permiso1;
            $_SESSION['permiso2']=$fetch->Permiso2;
            $_SESSION['permiso3']=$fetch->Permiso3;
            $_SESSION['permiso4']=$fetch->Permiso4;
            $_SESSION['permiso5']=$fetch->Permiso5;
            $_SESSION['permiso6']=$fetch->Permiso6;


            }
        }else{
            $rspta["Error"]=2;
            $rspta["Rol"]=$hash." --- ".$pass."---";
            $rspta["Mensaje"]="Contraseña Invalido";
         }

      }else{
         $rspta["Error"]=1;
			$rspta["Rol"]=$usu;
         $rspta["Mensaje"]="Usuario Invalido";
      }
      echo json_encode($rspta);

   break;
}


?>
