<?php
   require_once '../../config/config.php';
   require_once "PasswordHash.php";

   class MMedico{

      public function __construct(){
      }

	  public function Listar_Medicos(){
           $sql="CALL `SP_MEDICO_LISTAR`();";
           return ejecutarConsulta($sql);
       }
      public function Eliminar_Medico($idMedico){
          $sql="CALL `SP_CRUD_MEDICO`('ELIMINAR','$idMedico','-1','-1','-1','2000-01-01','-1','-1','-1','-1','-1','-1');";

           return ejecutarConsulta($sql);
       }
      public function ValidarMedico($documento,$idMedico){
          $sql="";
          if($idMedico=='' || $idMedico==null || empty($idMedico)){
			 $sql="SELECT * FROM tab_medico WHERE  dni='$documento';";
          }else{
             $sql="SELECT * FROM tab_medico WHERE idMedico='$idMedico' and dni!='$documento';";
          }

          return validarDatos($sql);
      }
      public function RegistroMedico($idMedico,$MedicoNombre,$MedicoApellidoP,$MedicoApellidoM,$MedicoFechaNacimiento,$MedicoEdad,$MedicoDNI,$MedicoSexo,$MedicoTelefono,$MedicoCelular,$MedicoCorreo){
        $sql="";


            $MedicoNombre=ucfirst(mb_strtolower($MedicoNombre));
            $MedicoApellidoP=ucfirst(mb_strtolower($MedicoApellidoP));
            $MedicoApellidoM=ucfirst(mb_strtolower($MedicoApellidoM));

            $MedicoNombre=$this->VerificarNull($MedicoNombre);
            $MedicoApellidoP=$this->VerificarNull($MedicoApellidoP);
            $MedicoApellidoM=$this->VerificarNull($MedicoApellidoM);
            $MedicoFechaNacimiento=$this->VerificarNull($MedicoFechaNacimiento);
            $MedicoEdad=$this->VerificarNull($MedicoEdad);
            $MedicoDNI=$this->VerificarNull($MedicoDNI);
            $MedicoSexo=$this->VerificarNull($MedicoSexo);
            $MedicoTelefono=$this->VerificarNull($MedicoTelefono);
            $MedicoCelular=$this->VerificarNull($MedicoCelular);
            $MedicoCorreo=$this->VerificarNull($MedicoCorreo);


        if($idMedico=="" || $idMedico==null || empty($idMedico)){
             $sql="CALL `SP_CRUD_MEDICO`('REGISTRAR','-1','$MedicoNombre','$MedicoApellidoP','$MedicoApellidoM','$MedicoFechaNacimiento','$MedicoEdad','$MedicoDNI','$MedicoTelefono','$MedicoCelular','$MedicoCorreo','$MedicoSexo');";

        }else{
             $sql="CALL `SP_CRUD_MEDICO`('EDITAR','$idMedico','$MedicoNombre','$MedicoApellidoP','$MedicoApellidoM','$MedicoFechaNacimiento','$MedicoEdad','$MedicoDNI','$MedicoTelefono','$MedicoCelular','$MedicoCorreo','$MedicoSexo');";
        }


         return ejecutarConsulta($sql);
      }
		public function Recuperar_Medico($idMedico){
			$sql="CALL `SP_MEDICO_RECUPERAR`('$idMedico');";
			return ejecutarConsultaSimpleFila($sql);
		}

        public function Activacion_Medico($idMedico,$Opcion)
        {
            $sql="";
            if($Opcion==1){
                $sql="CALL `SP_CRUD_MEDICO`('HABILITAR','$idMedico','-1','-1','-1','2000-01-01','-1','-1','-1','-1','-1','-1');";
            }else{
                $sql="CALL `SP_CRUD_MEDICO`('INHABILITAR','$idMedico','-1','-1','-1','2000-01-01','-1','-1','-1','-1','-1','-1');";
            }

        return ejecutarConsulta($sql);
        }


        public function VerificarNull($valor){
           if($valor=='' || $valor==null){
			  return $valor='-1';
		   }else{
               return $valor;
           }
       }

   }

?>
