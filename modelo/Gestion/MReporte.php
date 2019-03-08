<?php
   require_once '../../config/config.php';

class MReporte {

   public function __construct(){

   }

     public function RecuperarIndicadores($Year,$Mes){
        $sql="CALL `SP_REPORTE_GENERAL`('$Year','$Mes');";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function ReporteCondicion(){
        $sql="SELECT cond.Descripcion as Condicion,(SELECT COUNT(*) FROM tab_paciente pa WHERE pa.Condicion_idCondicion=cond.idCondicion) as TotalPaciente FROM tab_condicion cond";
        return ejecutarConsulta($sql);
    }
    public function ReporteDiagnostico(){
        $sql="SELECT diag.Descripcion as Diagnostico,(SELECT COUNT(*) FROM tab_paciente pa WHERE pa.DX_idDX=diag.idDiagnostico) as TotalPaciente  FROM tab_diagnostico diag";
        return ejecutarConsulta($sql);
    }
      public function ReporteGradoInstruccion(){
        $sql="SELECT gra.Descripcion as GradoInstruccion,(SELECT COUNT(*) FROM tab_paciente pa WHERE pa.GradoInstruccion_idGradoInstruccion=gra.idGradoInstruccion) as TotalPaciente FROM tab_gradoinstruccion gra";
        return ejecutarConsulta($sql);
    }




 }


?>
