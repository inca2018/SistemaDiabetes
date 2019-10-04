<?php
   require_once '../../config/config.php';

class MReporte {

   public function __construct(){

   }

     public function RecuperarIndicadores($Inicio,$Fin,$Sexo){
        $sql="CALL `SP_REPORTE_GENERAL`('$Inicio','$Fin','$Sexo');";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function ReporteCondicion(){
        $sql="SELECT cond.idCondicion,cond.Descripcion as Condicion,(SELECT COUNT(*) FROM tab_paciente pa WHERE pa.Condicion_idCondicion=cond.idCondicion) as TotalPaciente FROM tab_condicion cond";
        return ejecutarConsulta($sql);
    }
    public function ReporteDiagnostico(){
        $sql="SELECT diag.idDiagnostico,diag.Descripcion as Diagnostico,(SELECT COUNT(*) FROM tab_paciente pa WHERE pa.DX_idDX=diag.idDiagnostico) as TotalPaciente  FROM tab_diagnostico diag";
        return ejecutarConsulta($sql);
    }
      public function ReporteGradoInstruccion(){
        $sql="SELECT gra.idGradoInstruccion,gra.Descripcion as GradoInstruccion,(SELECT COUNT(*) FROM tab_paciente pa WHERE pa.GradoInstruccion_idGradoInstruccion=gra.idGradoInstruccion) as TotalPaciente FROM tab_gradoinstruccion gra";
        return ejecutarConsulta($sql);
    }

    public function ListarPacienteCondicion($id){
         $sql="SELECT CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno) as Paciente,pac.edad,con.Descripcion as Condicion  FROM tab_condicion con inner join tab_paciente pac on pac.Condicion_idCondicion=con.idCondicion where con.idCondicion=$id";
        return ejecutarConsulta($sql);
    }
    public function ListarPacienteDiagnostico($id){
         $sql="SELECT CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno) as Paciente,pac.edad,diag.Descripcion as Diagnostico  FROM tab_diagnostico diag inner join tab_paciente pac on pac.DX_idDX=diag.idDiagnostico where diag.idDiagnostico=$id";
        return ejecutarConsulta($sql);
    }

     public function ListarPacienteGrado($id){
         $sql="SELECT CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno) as Paciente,pac.edad,gra.Descripcion as Diagnostico  FROM tab_gradoinstruccion gra inner join tab_paciente pac on pac.GradoInstruccion_idGradoInstruccion=gra.idGradoInstruccion where gra.idGradoInstruccion=$id";
        return ejecutarConsulta($sql);
    }
    public function ReporteMasculino(){
        $sql="SELECT CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno) as Paciente ,pac.edad,'MASCULINO' as Sexo   FROM tab_paciente pac WHERE pac.Sexo_idSexo=1";
         return ejecutarConsulta($sql);
    }
    public function ReporteFemenino(){
        $sql="SELECT CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno) as Paciente ,pac.edad,'FEMENINO' as Sexo   FROM tab_paciente pac WHERE pac.Sexo_idSexo=2";
         return ejecutarConsulta($sql);
    }

    public function ReporteGlicemico($inicio,$fin,$op,$Sexo){
        $sql="";
        // SI TIENES
        if($op==1){
              $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - Resultado: ',fi.RespuestaValor,' %') as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=1 and fi.Opcion_Opcion=8 AND pac.Sexo_idSexo=".$Sexo.";" ;
        }else{
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - Resultado: ',fi.RespuestaValor,' %') as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=0 and fi.Opcion_Opcion=8 AND pac.Sexo_idSexo=".$Sexo.";";
        }

         return ejecutarConsulta($sql);

    }

      public function ReporteColesterol($inicio,$fin,$op,$Sexo){
        $sql="";
        // SI TIENES
        if($op==1){
              $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - Colesterol Total: ',fi.RespuestaValor) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=1 and fi.Opcion_Opcion=9 AND pac.Sexo_idSexo=".$Sexo.";" ;
        }else{
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - Colesterol Total: ',fi.RespuestaValor) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=0 and fi.Opcion_Opcion=9 AND pac.Sexo_idSexo=".$Sexo.";";
        }

         return ejecutarConsulta($sql);

    }


   public function ReporteHDL($inicio,$fin,$op,$Sexo){
        $sql="";
        // SI TIENES
        if($op==1){
              $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - HDL Total: ',fi.RespuestaValor) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=1 and fi.Opcion_Opcion=10 AND pac.Sexo_idSexo=".$Sexo.";" ;
        }else{
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - HDL Total: ',fi.RespuestaValor) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=0 and fi.Opcion_Opcion=10 AND pac.Sexo_idSexo=".$Sexo.";";
        }

         return ejecutarConsulta($sql);

    }

     public function ReporteLDL($inicio,$fin,$op,$Sexo){
        $sql="";
        // SI TIENES
        if($op==1){
              $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - LDL Total: ',fi.RespuestaValor) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=1 and fi.Opcion_Opcion=11 AND pac.Sexo_idSexo=".$Sexo.";" ;
        }else{
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - LDL Total: ',fi.RespuestaValor) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=0 and fi.Opcion_Opcion=11 AND pac.Sexo_idSexo=".$Sexo.";";
        }

         return ejecutarConsulta($sql);

    }

     public function ReporteIMC($inicio,$fin,$op,$Sexo){
        $sql="";
        // SI TIENES
        if($op==1){
              $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - IMC Total: ',fi.RespuestaValor) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=1 and fi.Opcion_Opcion=13 AND pac.Sexo_idSexo=".$Sexo.";" ;
        }else{
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - IMC Total: ',fi.RespuestaValor) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.RespuestaAdecuado=0 and fi.Opcion_Opcion=13 AND pac.Sexo_idSexo=".$Sexo.";";
        }

         return ejecutarConsulta($sql);

    }


     public function ReporteTalleres($inicio,$fin,$op,$Sexo){
        $sql="";
        // SI TIENES
        if($op==1){
              $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - T.Glucometria: ',IF(fi.RespuestaAdecuado=0,'NO','SI')) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.Opcion_Opcion=90 AND pac.Sexo_idSexo=".$Sexo.";" ;
        }elseif($op==2){
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - T.Nutrición: ',IF(fi.RespuestaAdecuado=0,'NO','SI')) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."'))  and fi.Opcion_Opcion=91 AND pac.Sexo_idSexo=".$Sexo.";";
        }elseif($op==3){
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - T.Conocimiento de Diabetes: ',IF(fi.RespuestaAdecuado=0,'NO','SI')) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."')) and fi.Opcion_Opcion=92 AND pac.Sexo_idSexo=".$Sexo.";";
        } elseif($op==4){
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - T.Insulinisación: ',IF(fi.RespuestaAdecuado=0,'NO','SI')) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."'))  and fi.Opcion_Opcion=93 AND pac.Sexo_idSexo=".$Sexo.";";
        }elseif($op==5){
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - T.Podologia: ',IF(fi.RespuestaAdecuado=0,'NO','SI')) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."'))  and fi.Opcion_Opcion=94 AND pac.Sexo_idSexo=".$Sexo.";";
        } elseif($op==6){
             // NO TIENES
                $sql="SELECT DISTINCT(pac.idPaciente),
                    CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno,' - T.Psicologia: ',IF(fi.RespuestaAdecuado=0,'NO','SI')) as Paciente ,pac.edad,
                    IF(pac.Sexo_idSexo=1,'MASCULINO','FEMENINO') as Sexo
                    FROM tab_paciente pac
                    INNER JOIN tab_seguimiento seg
                    on seg.Paciente_idPaciente=pac.idPaciente
                    INNER JOIN tab_resultado_ficha fi
                    ON fi.Seguimiento_idSeguimiento=seg.idSeguimiento
                    INNER JOIN tab_year y
                    on y.idYear=seg.Year
                    where ((y.year BETWEEN YEAR('".$inicio."') and YEAR('".$fin."'))  and  (DATE(seg.fechaRegistro) BETWEEN '".$inicio."' AND '".$fin."'))  and fi.Opcion_Opcion=95 AND pac.Sexo_idSexo=".$Sexo.";";
        }

         return ejecutarConsulta($sql);

    }

 }


?>
