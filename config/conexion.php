<?php

class Conexion {
   public function ruta(){
      return "http://localhost/ucv/SistemaControl/app/";
   }
   public function rutaOP(){
      return "http://localhost/ucv/SistemaControl/app/Gestion/";
   }
   public function convertir($string){
	   $cant=strlen($string);
		if($cant>1){
			   switch ($string){
					case '10':
						 $string='OCTUBRE';
					 	break;
					case '11':
						 $string='NOVIEMBRE';
					 	break;
					case '12':
						 $string='DICIEMBRE';
					 	break;
				}
		}else{
			  $string = str_replace(
				array('1', '2', '3', '4', '5', '6', '7', '8', '9'),
				array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE'),
				$string
				);
		}

   return $string;
   }
	public function validar_null($valor,$moneda){
		if($valor==null){
			if($moneda=="1"){
				 $valor="S/. 0";
			}elseif($moneda=="2"){
				 $valor ="$. 0";
			}else{
				 $valor="S/. 0";
			}
		}else{
			if($moneda=="1"){
				$valor="S/. ".$valor;
			}elseif($moneda=="2"){
				$valor="$. ".$valor;
			}else{
				$valor="S/. 0";
			}
		}
		 return $valor;
	}
	public function validar_vacio($valor){
		if($valor==null){
				 $valor="0.00";
		}
		 return $valor;
	}
   public function upload_documento($cliente_IdeCli,$OrdenInterno) {
      // ubicar el de recurso
      $linkDocumento='../../views/PreFactura/documento/';
      if(!file_exists($linkDocumento)){
         mkdir("$linkDocumento",0777);
      }
      $linkRecurso='../../views/PreFactura/documento/'.$cliente_IdeCli."/";
      if(!file_exists($linkRecurso)){
         mkdir("$linkRecurso",0777);
      }
      // subida de documento
      if(isset($_FILES["adjuntar_documento"])){
         $extension = explode('.', $_FILES['adjuntar_documento']['name']);
         $destination ='../../views/PreFactura/documento/'.$cliente_IdeCli.'/'.$OrdenInterno.'.pdf';
         $subida = move_uploaded_file($_FILES['adjuntar_documento']['tmp_name'], $destination);
         return $subida;
      }
   }

   public function upload_finContrato($idColaborador,$idContrato) {
      // ubicar el de recurso
      $linkDocumento='../../../documentos/RRHH';
      if(!file_exists($linkDocumento)){
         mkdir("$linkDocumento",0777);
      }
      $linkRecurso='../../../documentos/RRHH/'.$idColaborador."/";
      if(!file_exists($linkRecurso)){
         mkdir("$linkRecurso",0777);
      }
      if(isset($_FILES["documentoFinalizacion"])){
         $extension = explode('.', $_FILES['documentoFinalizacion']['name']);
         $destination ='../../../documentos/RRHH/'.$idColaborador.'/Finalizaicion'.$idContrato.'.pdf';
         $upload = move_uploaded_file($_FILES['adjuntar_documento']['tmp_name'], $destination);

      }else{
         $upload=false;
      }
      return $upload;
   }
}



?>
