<?php
   require_once '../../config/config.php';

   class MEnconado{

      public function __construct(){
      }

   public function RecuperarCorrelativo(){
		$sql="SELECT COUNT(*) as correlativo FROM orden";
		return ejecutarConsultaSimpleFila($sql);
	}

	  public function Listar_Enconado(){
           $sql="CALL `SP_ORDEN_LISTAR`();";
           return ejecutarConsulta($sql);
       }
      public function Eliminar_Enconado($idEnconado){
           $sql="DELETE FROM `orden` WHERE `idOrden`='$idEnconado'";
           return ejecutarConsulta($sql);
       }

      public function RegistroEnconado($idEnconado,$EnconadoNombre,$EnconadoMaterial,$EnconadoLote,$EnconadoKilos,$EnconadoNumero,$login_idLog,$EnconadoObservacion){
        $sql="";

          if($EnconadoObservacion=="" || $EnconadoObservacion==null || empty($EnconadoObservacion)){
              $EnconadoObservacion="-1";
          }


        if($idEnconado=="" || $idEnconado==null || empty($idEnconado)){
             $sql="CALL `SP_ORDEN_REGISTRO`('$EnconadoNombre','$EnconadoMaterial','$EnconadoLote','$EnconadoKilos','$EnconadoNumero','$login_idLog','$EnconadoObservacion');";

        }else{

             $sql="CALL `SP_ORDEN_ACTUALIZAR`('$EnconadoMaterial','$EnconadoLote','$EnconadoKilos','$EnconadoNumero','$login_idLog','$idEnconado','$EnconadoObservacion');";
        }

         return ejecutarConsulta($sql);
      }

		public function Recuperar_Enconado($idEnconado){
			$sql="CALL `SP_ORDEN_RECUPERAR`('$idEnconado');";
			return ejecutarConsultaSimpleFila($sql);
		}
      public function Enviar_Enconado($idEnconado){
			$sql="UPDATE `orden` SET `Estado_idEstado`=5 WHERE `idOrden`='$idEnconado' ";
			return ejecutarConsulta($sql);
		}

       public function RecuperarRechazo($idEnconado){
			$sql="SELECT o.RechazoEnconado as Rechazo,DATE_FORMAT(o.fechaRechazoEnconado,'%d/%m/%Y') as FechaRechazo FROM orden o WHERE o.idOrden='$idEnconado';";
			return ejecutarConsultaSimpleFila($sql);
		}


   }

?>
