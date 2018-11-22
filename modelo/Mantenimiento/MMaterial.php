<?php
   require_once '../../config/config.php';


   class MMaterial{

      public function __construct(){
      }

	  public function Listar_Material(){
           $sql="CALL `SP_MATERIAL_LISTAR`();";
           return ejecutarConsulta($sql);
       }
      public function Eliminar_Material($idMaterial,$codigo,$idCreador){
           $sql="CALL `SP_MATERIAL_HABILITACION`('$idMaterial','$codigo','$idCreador');";

           return ejecutarConsulta($sql);
       }
      public function ValidarMaterial($Materialnom,$idMaterial){
          $sql="";
          if($idMaterial=='' || $idMaterial==null || empty($idMaterial)){
			   $sql="SELECT * FROM material WHERE Descripcion='$Materialnom';";
          }else{
             $sql="SELECT * FROM material WHERE idMaterial!='$idMaterial' and Descripcion='$Materialnom';";
          }
          return validarDatos($sql);
      }
      public function RegistroMaterial($idMaterial,$MaterialNombre,$MaterialEstado,$login_idLog){
        $sql="";

        if($idMaterial=="" || $idMaterial==null || empty($idMaterial)){
             $sql="CALL `SP_MATERIAL_REGISTRO`('$MaterialNombre','$MaterialEstado','$login_idLog');";

        }else{

             $sql="CALL `SP_MATERIAL_ACTUALIZAR`('$MaterialNombre','$MaterialEstado','$idMaterial','$login_idLog');";
        }

         return ejecutarConsulta($sql);
      }

		public function Recuperar_Material($idMaterial){
			$sql="CALL `SP_MATERIAL_RECUPERAR`('$idMaterial');";
			return ejecutarConsultaSimpleFila($sql);
		}


   }

?>
