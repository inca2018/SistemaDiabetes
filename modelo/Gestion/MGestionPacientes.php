<?php
   require_once '../../config/config.php';

   class MGestionPacientes{

      public function __construct(){
      }


	  public function Listar_Pacientes_Todos(){
			  $sql="CALL `SP_PACIENTE_LISTAR`();";
			return ejecutarConsulta($sql);
		}

	    public function listar_seguimientos($idPaciente,$ano,$mes){
       $sql="SELECT seg.idSeguimiento,seg.Codigo,y.year as Year,FU_RECUPERAR_MES(seg.Mes) as Mes,DATE_FORMAT(seg.fechaRegistro,'%d/%m/%Y') as fechaRegistro FROM tab_seguimiento seg inner join tab_year y on y.idYear=seg.Year where seg.Year=$ano and seg.Mes=$mes and seg.Paciente_idPaciente=$idPaciente";

      return ejecutarConsulta($sql);
       }
       public function RecuperarInformacionPaciente($idPaciente){
            $sql = "SELECT CONCAT(pa.Codigo,' - ',pa.Nombres,' ',pa.apellidoPaterno,' ',pa.apellidoMaterno) as PacienteNombre,pa.edad,pa.numeroDocumento as documento,pa.Sexo_idSexo as sexo FROM tab_paciente pa where pa.idPaciente='$idPaciente'";
        return ejecutarConsultaSimpleFila($sql);
       }
        public function listar_year(){
			  $sql="SELECT * FROM tab_year";
			return ejecutarConsulta($sql);
		}

       public function EliminarResultados($idSeguimiento){
            $sql="CALL `SP_ELIMINAR_RESULTADOS`('$idSeguimiento');";

           return ejecutarConsulta($sql);
       }


   }

?>
