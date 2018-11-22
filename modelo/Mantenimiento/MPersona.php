<?php
   require_once '../../config/config.php';
   require_once "PasswordHash.php";

   class MPersona{

      public function __construct(){
      }

	  public function Listar_Personas_Todos(){
           $sql="CALL `SP_PERSONA_LISTAR`();";
           return ejecutarConsulta($sql);
       }
      public function Eliminar_Persona($idPersona,$codigo,$idCreador){
           $sql="CALL `SP_PERSONA_HABILITACION`('$idPersona','$codigo','$idCreador');";
           return ejecutarConsulta($sql);
       }
      public function ValidarPersona($dni,$idPersona){
          $sql="";
          if($idPersona=='' || $idPersona==null || empty($idPersona)){
			 $sql="SELECT * FROM persona WHERE  DNI='$dni';";
          }else{
             $sql="SELECT * FROM persona WHERE idPersona='$idPersona' and DNI!='$dni';";
          }

          return validarDatos($sql);
      }
      public function RegistroPersona($PersonaNombre,$PersonaApellidoP,$PersonaApellidoM,$PersonaDNI,$PersonaFechaNacimiento,$PersonaCorreo,$PersonaTelefono,$PersonaDireccion,$PersonaEstado,$idPersona,$login_idLog){
        $sql="";

		  if($PersonaCorreo=='' || $PersonaCorreo==null || empty($PersonaCorreo)){
			  $PersonaCorreo='-1';
		  }
			if($PersonaTelefono=='' || $PersonaTelefono==null || empty($PersonaTelefono)){
			  $PersonaTelefono='-1';
		  }
			if($PersonaDireccion=='' || $PersonaDireccion==null || empty($PersonaDireccion)){
			  $PersonaDireccion='-1';
		  }
			if($PersonaFechaNacimiento=='' || $PersonaFechaNacimiento==null || empty($PersonaFechaNacimiento)){
			  $PersonaDireccion='-1';
		  }


        if($idPersona=="" || $idPersona==null || empty($idPersona)){
             $sql="CALL `SP_PERSONA_REGISTRO`('$PersonaNombre','$PersonaApellidoP','$PersonaApellidoM','$PersonaDNI','$PersonaFechaNacimiento','$PersonaCorreo','$PersonaTelefono','$PersonaDireccion','$PersonaEstado','$login_idLog');";

        }else{
             $sql="CALL `SP_PERSONA_ACTUALIZAR`('$PersonaNombre','$PersonaApellidoP','$PersonaApellidoM','$PersonaDNI','$PersonaFechaNacimiento','$PersonaCorreo','$PersonaTelefono','$PersonaDireccion','$PersonaEstado','$idPersona','$login_idLog');";
        }

         return ejecutarConsulta($sql);
      }
		public function Recuperar_Persona($idPersona){
			$sql="CALL `SP_PERSONA_RECUPERAR`('$idPersona');";
			return ejecutarConsultaSimpleFila($sql);
		}

   }

?>
