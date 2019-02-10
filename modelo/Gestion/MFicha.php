<?php
   require_once '../../config/config.php';



   class MFicha{

      public function __construct(){
      }
      public function RecuperarGrupos(){
           $sql = "SELECT * FROM `tab_grupoopcion` where Estado_idEstado=1";
         return ejecutarConsulta($sql);
      }

       public function RecuperarOpciones($idGrupo){
           $sql = "SELECT * FROM `tab_opcion` WHERE `Estado_idEstado`=1 and `GrupoOpcion_idGrupoOpcion`='$idGrupo'";
         return ejecutarConsulta($sql);
      }

   }

?>
