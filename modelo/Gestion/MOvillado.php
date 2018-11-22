<?php
   require_once '../../config/config.php';

   class MOvillado{

      public function __construct(){
      }

   public function RecuperarCorrelativo(){
		$sql="SELECT COUNT(*) as correlativo FROM ovillado";
		return ejecutarConsultaSimpleFila($sql);
	}
   public function RecuperarMaterialDato($idOrden){
		$sql="SELECT ma.idMaterial,ma.Descripcion FROM orden o INNER JOIN material ma On ma.idMaterial=o.Material_idMaterial where o.idOrden='$idOrden'";
		return ejecutarConsultaSimpleFila($sql);
	}

	  public function Listar_Enconado(){
           $sql="CALL `SP_OVILLADO_LISTAR`();";
           return ejecutarConsulta($sql);
       }
		  public function Listar_GestionOvillado($idOrden){
           $sql="CALL `SP_OVILLADO_LISTAR_GESTION`('$idOrden');";
           return ejecutarConsulta($sql);
       }

      public function Eliminar_Ovillado($idOvillado){
           $sql="DELETE FROM `ovillado` WHERE `idOvillado`='$idOvillado'";
           return ejecutarConsulta($sql);
       }

      public function RegistroOvillado($idOrden,$idOvilladoGestion,$OvilladoNombre,$OvilloTrabajador,$OvilladoMaterial,$OvilladoPeso,$OvilladoLote,$OvilladoCantidad,$OvilladoObservacion){
        $sql="";

          if($OvilladoObservacion=="" || $OvilladoObservacion==null || empty($OvilladoObservacion)){
              $OvilladoObservacion="-1";
          }
        if($idOvilladoGestion=="" || $idOvilladoGestion==null || empty($idOvilladoGestion)){
             $sql="CALL `SP_GESTION_REGISTRO`('$idOrden','$OvilladoPeso','$OvilladoLote','$OvilladoNombre','$OvilladoMaterial','$OvilladoCantidad','$OvilloTrabajador','$OvilladoObservacion');";

        }else{
             $sql="CALL `SP_GESTION_ACTUALIZAR`('$idOvilladoGestion','$OvilladoPeso','$OvilladoLote','$OvilladoNombre','$OvilladoCantidad','$OvilloTrabajador','$OvilladoObservacion');";
        }

         return ejecutarConsulta($sql);
      }

		public function Recuperar_Ovillado($idOvilladoGestion){
			$sql="CALL `SP_GESTION_RECUPERAR`('$idOvilladoGestion');";

			return ejecutarConsultaSimpleFila($sql);
		}
      public function Enviar_Calidad($idEnconado){
			$sql="UPDATE `orden` SET `Estado_idEstado`=6 WHERE `idOrden`='$idEnconado' ";
			return ejecutarConsulta($sql);
		}

		public function  VerificarTrabajos($idEnconado){
			$sql="SELECT COUNT(*) as Cantidad FROM ovillado ov WHERE ov.Orden_idOrden='$idEnconado'";
			return ejecutarConsultaSimpleFila($sql);
		}
        public function RecuperarRechazo($idEnconado){
			$sql="SELECT o.RechazoOvillado as Rechazo,DATE_FORMAT(o.fechaRechazoOvillado,'%d/%m/%Y') as FechaRechazo FROM orden o WHERE o.idOrden='$idEnconado';";
			return ejecutarConsultaSimpleFila($sql);
		}

   }

?>
