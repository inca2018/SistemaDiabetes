<?php
   require_once '../../config/config.php';

   class MCalidad{

      public function __construct(){
      }


	  public function Listar_calidad(){
           $sql="CALL `SP_CALIDAD_LISTAR`();";
           return ejecutarConsulta($sql);
       }
      public function Listar_GestionOvillado($idOrden){
           $sql="CALL `SP_OVILLADO_LISTAR_GESTION`('$idOrden');";
           return ejecutarConsulta($sql);
       }
      public function EnvioRechazo($idOrden,$TipoRechazo,$Observacion){
          $sql="";
          if($TipoRechazo=="ENCONADO"){
            $sql="UPDATE `orden` SET `Estado_idEstado`=10,`RechazoEnconado`='$Observacion',`fechaRechazoEnconado`=NOW() WHERE `idOrden`='$idOrden';";
          }elseif($TipoRechazo=="OVILLADO"){
            $sql="UPDATE `orden` SET `Estado_idEstado`=5,`RechazoOvillado`='$Observacion',`fechaRechazoOvillado`=NOW() WHERE `idOrden`='$idOrden';";
          }
           return ejecutarConsulta($sql);
      }

     public function Finalizar($idOrden){
         $sql="UPDATE `orden` SET  `Estado_idEstado`=7 WHERE `idOrden`='$idOrden'";
         return ejecutarConsulta($sql);
     }
   }

?>
