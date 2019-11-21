<?php
   require_once '../../config/config.php';


   class MUsuario{

      public function __construct(){
      }

	  public function Listar_Usuarios_Todos(){
           $sql="CALL `SP_USUARIO_LISTAR_TODO`();";
           return ejecutarConsulta($sql);
       }
      public function Eliminar_Usuario($idUsuario,$codigo,$idCreador){
            $sql="UPDATE `usuario` SET `Estado_idEstado`=10 WHERE `idUsuario`=$idUsuario";
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

        public function HabilitarUsuario($idUsuario){
           $sql="UPDATE `usuario` SET `Estado_idEstado`=1 WHERE `idUsuario`=$idUsuario";
           return ejecutarConsulta($sql);
       }
       public function DesHabilitarUsuario($idUsuario){
           $sql="UPDATE `usuario` SET `Estado_idEstado`=2 WHERE `idUsuario`=$idUsuario";
           return ejecutarConsulta($sql);
       }


   }

?>
