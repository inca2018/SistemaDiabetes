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
      public function Eliminar_Paciente($idPaciente){
          $sql="CALL `SP_CRUD_PACIENTE`('ELIMINAR','$idPaciente','-1','-1','-1','-1','2000-01-01','-1','-1','-1','-1','-1','-1','-1','-1','-1','-1','1','-1','-1','-1','-1','-1');";
           return ejecutarConsulta($sql);
       }
      public function ValidarPaciente($documento,$idPaciente){
          $sql="";
          if($idPaciente=='' || $idPaciente==null || empty($idPaciente)){
			 $sql="SELECT * FROM tab_paciente WHERE  numeroDocumento='$documento';";
          }else{
             $sql="SELECT * FROM tab_paciente WHERE idPaciente='$idPaciente' and numeroDocumento!='$documento';";
          }

          return validarDatos($sql);
      }
      public function RegistroPaciente($idPaciente,$PacienteCodigo,$PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$PacienteFechaNacimiento,$PacienteEdad,$PacienteTipoDocumento,$PacienteNumeroDocumento,$PacienteSexo,$PacienteTelefono,$PacienteCelular,$PacienteCorreo,$PacienteDireccion,$PacienteTipoMedida,$PacienteCantidadMedida,$PacienteDX,$PacienteMedico,$PacienteDepartamento,$PacienteProvincia,$PacienteDistrito,$PacienteCondicion){
        $sql="";

            $PacienteCodigo=$this->VerificarNull($PacienteCodigo);
            $PacienteNombre=$this->VerificarNull($PacienteNombre);
            $PacienteApellidoP=$this->VerificarNull($PacienteApellidoP);
            $PacienteApellidoM=$this->VerificarNull($PacienteApellidoM);
            $PacienteFechaNacimiento=$this->VerificarNull($PacienteFechaNacimiento);
            $PacienteEdad=$this->VerificarNull($PacienteEdad);
            $PacienteTipoDocumento=$this->VerificarNull($PacienteTipoDocumento);
            $PacienteNumeroDocumento=$this->VerificarNull($PacienteNumeroDocumento);
            $PacienteSexo=$this->VerificarNull($PacienteSexo);
            $PacienteTelefono=$this->VerificarNull($PacienteTelefono);
            $PacienteCelular=$this->VerificarNull($PacienteCelular);
            $PacienteCorreo=$this->VerificarNull($PacienteCorreo);
            $PacienteDireccion=$this->VerificarNull($PacienteDireccion);
            $PacienteTipoMedida=$this->VerificarNull($PacienteTipoMedida);
            $PacienteCantidadMedida=$this->VerificarNull($PacienteCantidadMedida);
            $PacienteDX=$this->VerificarNull($PacienteDX);
            $PacienteMedico=$this->VerificarNull($PacienteMedico);
            $PacienteDepartamento=$this->VerificarNull($PacienteDepartamento);
            $PacienteProvincia=$this->VerificarNull($PacienteProvincia);
            $PacienteDistrito=$this->VerificarNull($PacienteDistrito);
            $PacienteCondicion=$this->VerificarNull($PacienteCondicion);


        if($idPaciente=="" || $idPaciente==null || empty($idPaciente)){
             $sql="CALL `SP_CRUD_PACIENTE`('REGISTRAR','-1','$PacienteCodigo','$PacienteNombre','$PacienteApellidoP','$PacienteApellidoM','$PacienteFechaNacimiento','$PacienteEdad','$PacienteNumeroDocumento','$PacienteTelefono','$PacienteCelular','$PacienteCorreo','$PacienteDireccion','$PacienteTipoMedida','$PacienteCantidadMedida','$PacienteSexo','$PacienteDX','$PacienteMedico','$PacienteTipoDocumento','$PacienteDepartamento','$PacienteProvincia','$PacienteDistrito','$PacienteCondicion');";

        }else{
             $sql="CALL `SP_CRUD_PACIENTE`('EDITAR','$idPaciente','$PacienteCodigo','$PacienteNombre','$PacienteApellidoP','$PacienteApellidoM','$PacienteFechaNacimiento','$PacienteEdad','$PacienteNumeroDocumento','$PacienteTelefono','$PacienteCelular','$PacienteCorreo','$PacienteDireccion','$PacienteTipoMedida','$PacienteCantidadMedida','$PacienteSexo','$PacienteDX','$PacienteMedico','$PacienteTipoDocumento','$PacienteDepartamento','$PacienteProvincia','$PacienteDistrito','$PacienteCondicion');";
        }

         return ejecutarConsulta($sql);
      }
		public function Recuperar_Paciente($idPaciente){
			$sql="CALL `SP_PACIENTE_RECUPERAR`('$idPaciente');";
			return ejecutarConsultaSimpleFila($sql);
		}
        public function RecuperarCorrelativo(){
		$sql="SELECT COUNT(*) as correlativo FROM tab_paciente";
		return ejecutarConsultaSimpleFila($sql);
	       }

        public function Activacion_Paciente($idPaciente,$Opcion)
        {
            $sql="";
            if($Opcion==1){
                $sql="CALL `SP_CRUD_PACIENTE`('HABILITAR','$idPaciente','-1','-1','-1','-1','2000-01-01','-1','-1','-1','-1','-1','-1','-1','-1','-1','-1','1','-1','-1','-1','-1','-1');";
            }else{
                $sql="CALL `SP_CRUD_PACIENTE`('DESHABILITAR','$idPaciente','-1','-1','-1','-1','2000-01-01','-1','-1','-1','-1','-1','-1','-1','-1','-1','-1','1','-1','-1','-1','-1','-1');";
            }

        return ejecutarConsulta($sql);
        }


        public function VerificarNull($valor){
           if($valor=='' || $valor==null || empty($valor)){
			  return $valor='-1';
		   }else{
               return $valor;
           }
       }

   }

?>
