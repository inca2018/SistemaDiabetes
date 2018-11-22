<?php
   require_once '../../config/config.php';
   require_once "PasswordHash.php";

   class MPerfil{

      public function __construct(){
      }

	  public function Listar_Perfil_Todos(){
           $sql="CALL `SP_PERFIL_LISTAR_TODOS`();";
           return ejecutarConsulta($sql);
       }
      public function Eliminar_Perfil($idPerfil,$codigo,$idCreador){
           $sql="CALL `SP_PERFIL_HABILITACION`('$idPerfil','$codigo','$idCreador');";

           return ejecutarConsulta($sql);
       }
      public function ValidarPerfil($perfilnom,$idPerfil){
          $sql="";
          if($idPerfil=='' || $idPerfil==null || empty($idPerfil)){
			   $sql="SELECT * FROM perfil WHERE   nombrePerfil='$perfilnom';";
          }else{
             $sql="SELECT * FROM perfil WHERE idPerfil!='$idPerfil' and nombrePerfil='$perfilnom';";
          }
          return validarDatos($sql);
      }
      public function RegistroPerfil($idPerfil,$PerfilNombre,$PerfilDescripcion,$PerfilEstado,$login_idLog){
        $sql="";
 		   $PerfilDescripcion=trim($PerfilDescripcion);

		  if($PerfilDescripcion=='' || $PerfilDescripcion==null || empty($PerfilDescripcion)){
			  $PerfilDescripcion='-1';
		  }

        if($idPerfil=="" || $idPerfil==null || empty($idPerfil)){
             $sql="CALL `SP_PERFIL_REGISTRO`('$PerfilNombre','$PerfilDescripcion','$PerfilEstado','$login_idLog');";

        }else{
             $sql="CALL `SP_PERFIL_ACTUALIZAR`('$PerfilNombre','$PerfilDescripcion','$PerfilEstado','$idPerfil','$login_idLog');";
        }

         return ejecutarConsulta($sql);
      }
		public function Recuperar_Perfil($idPerfil){
			$sql="CALL `SP_PERFIL_RECUPERAR`('$idPerfil');";
			return ejecutarConsultaSimpleFila($sql);
		}
		 public function Recuperar_Permisos($idPerfil){
			$sql="CALL `SP_PERMISOS_RECUPERAR`($idPerfil);";
			return ejecutarConsultaSimpleFila($sql);
		}

		  public function ActualizarPermisos($idPermisos,$Permiso1,$Permiso2,$Permiso3,$Permiso4,$Permiso5,$Permiso6,$idPerfil,$login_idLog){
           $sql="CALL `SP_PERMISOS_ACTUALIZAR`('$idPermisos','$Permiso1','$Permiso2','$Permiso3','$Permiso4','$Permiso5','$Permiso6','$idPerfil','$login_idLog');";
           return ejecutarConsulta($sql);
       }

   }

?>
