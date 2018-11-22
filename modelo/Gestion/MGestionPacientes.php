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
       $sql="SELECT concat(per.nombrePersona,' ',per.apellidoPaterno,' ', per.apellidoMaterno) AS PACIENTE,s.Paciente_idPaciente,s.fechaInicio,S.ProximaCita,s.Estado_idEstado,s.idSeguimiento,s.year AS ANO,s.mes AS MES,e.nombreEstado FROM seguimiento s INNER JOIN paciente p ON p.idPaciente=s.Paciente_idPaciente INNER JOIN persona per On per.idPersona=p.Persona_idPersona INNER JOIN estado e On e.idEstado=s.Estado_idEstado WHERE p.idPaciente='$idPaciente' AND s.year='$ano'  and s.mes='$mes'";
      return ejecutarConsulta($sql);
   }

   }

?>
