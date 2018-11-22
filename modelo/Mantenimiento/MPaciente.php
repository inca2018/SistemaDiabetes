<?php
   require_once '../../config/config.php';
   require_once "PasswordHash.php";

   class MPaciente{

      public function __construct(){
      }

	  public function Listar_Pacientes_Todos(){
           $sql="CALL `SP_PACIENTE_LISTAR`();";
           return ejecutarConsulta($sql);
       }
      public function Eliminar_Paciente($idPaciente,$codigo,$idCreador){
           $sql="CALL `SP_PACIENTE_HABILITACION`('$idPaciente','$codigo','$idCreador');";
           return ejecutarConsulta($sql);
       }
      public function ValidarPaciente($dni,$idPersona){
          $sql="";
          if($idPersona=='' || $idPersona==null || empty($idPersona)){
			 $sql="SELECT * FROM persona WHERE  DNI='$dni';";
          }else{
             $sql="SELECT * FROM persona WHERE idPersona='$idPersona' and DNI!='$dni';";
          }

          return validarDatos($sql);
      }
      public function RegistroPaciente($idPersona,$idPaciente,$PacienteCodigo,$PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$PacienteFechaNacimiento,$PacienteDNI,$PacienteTelefono,$PacienteDireccion,$PacienteCorreo,$PacienteEnfermedad,$PacienteDX,$PacienteMedico,$PacienteProcedencia,$PacienteCondicion,$PacienteSexo,$PacienteEstado,$login_idLog){
        $sql="";

		  if($PacienteCorreo=='' || $PacienteCorreo==null || empty($PacienteCorreo)){
			  $PacienteCorreo='-1';
		  }
			if($PacienteTelefono=='' || $PacienteTelefono==null || empty($PacienteTelefono)){
			  $PacienteTelefono='-1';
		  }
			if($PacienteDireccion=='' || $PacienteDireccion==null || empty($PacienteDireccion)){
			  $PacienteDireccion='-1';
		  }
			if($PacienteFechaNacimiento=='' || $PacienteFechaNacimiento==null || empty($PacienteFechaNacimiento)){
			  $PacienteFechaNacimiento='-1';
		  }


        if($idPaciente=="" || $idPaciente==null || empty($idPaciente)){
             $sql="CALL `SP_PACIENTE_REGISTRO`('$PacienteCodigo','$PacienteNombre','$PacienteApellidoP','$PacienteApellidoM','$PacienteFechaNacimiento','$PacienteDNI','$PacienteTelefono','$PacienteDireccion','$PacienteCorreo','$PacienteEnfermedad','$PacienteDX','$PacienteMedico','$PacienteProcedencia','$PacienteCondicion','$PacienteSexo','$PacienteEstado','$login_idLog');";

        }else{
             $sql="CALL `SP_PACIENTE_ACTUALIZAR`('$idPersona','$idPaciente','$PacienteNombre','$PacienteApellidoP','$PacienteApellidoM','$PacienteFechaNacimiento','$PacienteDNI','$PacienteTelefono','$PacienteDireccion','$PacienteCorreo','$PacienteEnfermedad','$PacienteDX','$PacienteMedico','$PacienteProcedencia','$PacienteCondicion','$PacienteSexo','$PacienteEstado','$login_idLog');";
        }

         return ejecutarConsulta($sql);
      }
		public function Recuperar_Paciente($idPaciente){
			$sql="CALL `SP_PACIENTE_RECUPERAR`('$idPaciente');";
			return ejecutarConsultaSimpleFila($sql);
		}


        public function RecuperarCorrelativo(){
		$sql="SELECT COUNT(*) as correlativo FROM paciente";
		return ejecutarConsultaSimpleFila($sql);
	}

   }

?>
