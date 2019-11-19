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
          $sql="DELETE FROM `tab_paciente` WHERE `idPaciente`=$idPaciente";
           return ejecutarConsulta($sql);
       }
      public function ValidarPaciente($PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$idPaciente){
          $sql="";
          if($idPaciente=='' || $idPaciente==null || empty($idPaciente)){
			 $sql="SELECT * FROM tab_paciente WHERE  Nombres='$PacienteNombre' and apellidoPaterno='$PacienteApellidoP' and apellidoMaterno='$PacienteApellidoM';";
          }else{
             $sql="SELECT * FROM tab_paciente WHERE idPaciente!='$idPaciente' and Nombres='$PacienteNombre' and apellidoPaterno='$PacienteApellidoP' and apellidoMaterno='$PacienteApellidoM';";
          }

          return validarDatos($sql);
      }
      public function RegistroPaciente($idPaciente,$PacienteCodigo,$PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$PacienteFechaNacimiento,$PacienteEdad,$PacienteTipoDocumento,$PacienteNumeroDocumento,$PacienteSexo,$PacienteTelefono,$PacienteCelular,$PacienteCorreo,$PacienteDireccion,$PacienteTipoMedida,$PacienteCantidadMedida,$PacienteDX,$PacienteMedico,$PacienteDepartamento,$PacienteProvincia,$PacienteDistrito,$PacienteCondicion,$PacienteGrado,$PacienteTitulo,$PacienteNacionalidad){
        $sql="";

            $PacienteNombre=ucfirst(mb_strtolower($PacienteNombre,'utf-8'));
            $PacienteApellidoP=ucfirst(mb_strtolower($PacienteApellidoP,'utf-8'));
            $PacienteApellidoM=ucfirst(mb_strtolower($PacienteApellidoM,'utf-8'));

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
            $PacienteGrado=$this->VerificarNull($PacienteGrado);
            $PacienteTitulo=$this->VerificarNull($PacienteTitulo);
            $PacienteNacionalidad=$this->VerificarNull($PacienteNacionalidad);



        if($idPaciente=="" || $idPaciente==null || empty($idPaciente)){

             $sql="INSERT INTO `tab_paciente`(`idPaciente`, `Codigo`, `Nombres`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `edad`, `numeroDocumento`, `Telefono`, `Celular`, `Correo`, `Direccion`, `TipoMedida_idTipoMedida`, `CantidadTiempo`, `tituloGrado`, `Sexo_idSexo`, `DX_idDX`, `Medico_idMedico`, `TipoDocumento_idTipoDocumento`, `Departamento_idDepartamento`, `Provincia_idProvincia`, `Distrito_idDistrito`, `Condicion_idCondicion`, `GradoInstruccion_idGradoInstruccion`, `Estado_idEstado`, `fechaRegistro`,`Nacionalidad_idNacionalidad`) VALUES (NULL,$PacienteCodigo,$PacienteNombre,$PacienteApellidoP,$PacienteApellidoM,$PacienteFechaNacimiento,$PacienteEdad,$PacienteNumeroDocumento,$PacienteTelefono,$PacienteCelular,$PacienteCorreo,$PacienteDireccion,$PacienteTipoMedida,$PacienteCantidadMedida,$PacienteTitulo,$PacienteSexo,$PacienteDX,$PacienteMedico,$PacienteTipoDocumento,$PacienteDepartamento,$PacienteProvincia,$PacienteDistrito,$PacienteCondicion,$PacienteGrado,1,NOW(),$PacienteNacionalidad)";

        }else{
            $sql="UPDATE `tab_paciente` SET  `Nombres`=$PacienteNombre,`apellidoPaterno`=$PacienteApellidoP,`apellidoMaterno`=$PacienteApellidoM,`fechaNacimiento`=$PacienteFechaNacimiento,`edad`=$PacienteEdad,`numeroDocumento`=$PacienteNumeroDocumento,`Telefono`=$PacienteTelefono,`Celular`=$PacienteCelular,`Correo`=$PacienteCorreo,`Direccion`=$PacienteDireccion,`TipoMedida_idTipoMedida`=$PacienteTipoMedida,`CantidadTiempo`=$PacienteCantidadMedida,`tituloGrado`=$PacienteTitulo,`Sexo_idSexo`=$PacienteSexo,`DX_idDX`=$PacienteDX,`Medico_idMedico`=$PacienteMedico,`TipoDocumento_idTipoDocumento`=$PacienteTipoDocumento,`Departamento_idDepartamento`=$PacienteDepartamento,`Provincia_idProvincia`=$PacienteProvincia,`Distrito_idDistrito`=$PacienteDistrito,`Condicion_idCondicion`=$PacienteCondicion,`GradoInstruccion_idGradoInstruccion`=$PacienteGrado , `Nacionalidad_idNacionalidad`=$PacienteNacionalidad WHERE `idPaciente`=$idPaciente";
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
                $sql="UPDATE `tab_paciente` SET `Estado_idEstado`=1 WHERE `idPaciente`=$idPaciente;";
            }else{
                $sql="UPDATE `tab_paciente` SET `Estado_idEstado`=2 WHERE `idPaciente`=$idPaciente;";
            }

        return ejecutarConsulta($sql);
        }


        public function VerificarNull($valor){
           if($valor=='' || $valor==null || empty($valor)){
			  return $valor='NULL';
		   }else{
               return "'".$valor."'";
           }
       }

   }

?>
