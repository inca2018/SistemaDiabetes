<?php
   require_once '../../config/config.php';
   require_once "PasswordHash.php";

   class MUsuario{

      public function __construct(){
      }

	  public function Listar_Usuarios_Todos(){
           $sql="CALL `SP_USUARIO_LISTAR_TODO`();";
           return ejecutarConsulta($sql);
       }
      public function Eliminar_Usuario($idUsuario,$codigo,$idCreador){
           $sql="CALL `SP_USUARIO_HABILITACION`('$idUsuario','$codigo','$idCreador');";
           return ejecutarConsulta($sql);
       }
      public function ValidarUsuario($nombreUsuario,$idUsuario){
          $sql="";
          if($idUsuario=='' || $idUsuario==null || empty($idUsuario)){
             $sql="SELECT * FROM usuario WHERE usuario='$nombreUsuario';";
          }else{
             $sql="SELECT * FROM usuario WHERE usuario='$nombreUsuario' and idUsuario!='$idUsuario';";
          }
          return validarDatos($sql);
      }
      public function RegistroUsuario($UsuarioPersona,$UsuarioUsuario,$UsuarioPerfil,$UsuarioPassword,$UsuarioEstado,$idUsuario,$login_idLog){
        $sql="";
        $hasher=new PasswordHash(8,FALSE);

			if($UsuarioPassword=='' || $UsuarioPassword=null || empty($UsuarioPassword)){
					 $UsuarioPassword=0;
				 }else{
				   $UsuarioPassword=$hasher->HashPassword($UsuarioPassword);
			}

        if($idUsuario=="" || $idUsuario==null || empty($idUsuario)){
             $sql="CALL `SP_USUARIO_REGISTRO`('$UsuarioUsuario','$UsuarioPassword','$UsuarioPerfil','$UsuarioPersona','$UsuarioEstado','$login_idLog');";

        }else{
             $sql="CALL `SP_USUARIO_ACTUALIZAR`('$UsuarioUsuario','$UsuarioPassword','$UsuarioPerfil','$UsuarioEstado',$idUsuario,'$login_idLog');";

        }

         return ejecutarConsulta($sql);
      }
		public function Recuperar_Usuario($idUsuario){
			$sql="CALL `SP_USUARIO_RECUPERAR`('$idUsuario');";
			return ejecutarConsultaSimpleFila($sql);
		}

   }

?>
