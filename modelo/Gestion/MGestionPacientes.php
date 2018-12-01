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
       $sql="SELECT s.idModulo,concat(per.nombrePersona,' ',per.apellidoPaterno,' ', per.apellidoMaterno) AS PACIENTE,IF(p.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo,(DATE_FORMAT(NOW(),'%Y')-DATE_FORMAT(per.fechaNacimiento,'%Y')) as  Edad,s.idPaciente,s.year,FU_RECUPERAR_MES(s.Mes) as Mes,DATE_FORMAT(s.FechaInicio,'%d/%m/%Y') as FechaInicio,DATE_FORMAT(s.FechaProximaCita,'%d/%m/%Y') as FechaProxima,FU_RECUPERAR_MES(s.Mes) as Mes,s.year as idYear,s.Mes as idMes FROM modulo_seguimiento_paciente s INNER JOIN paciente p ON p.idPaciente=s.idPaciente INNER JOIN persona per On per.idPersona=p.Persona_idPersona WHERE s.idPaciente=$idPaciente  and s.year=$ano and s.Mes=$mes";

      return ejecutarConsulta($sql);
   }

   }

?>
