<?php
   require_once '../../config/config.php';

class MReporte {

   public function __construct(){

   }

     public function RecuperarIndicadores($Inicio,$Fin){
        $sql="CALL `SP_REPORTE_GENERAL`('$Inicio','$Fin');";
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
        $sql="SELECT CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno) as Paciente ,pac.edad,'MACULINO' as Sexo   FROM tab_paciente pac WHERE pac.Sexo_idSexo=1";
         return ejecutarConsulta($sql);
    }
    public function ReporteFemenino(){
        $sql="SELECT CONCAT(pac.Nombres,' ',pac.apellidoPaterno,' ',pac.apellidoMaterno) as Paciente ,pac.edad,'FEMENINO' as Sexo   FROM tab_paciente pac WHERE pac.Sexo_idSexo=2";
         return ejecutarConsulta($sql);
    }

    public function ReporteGlicemico($inicio,$fin,$op){
        $sql="";
        if($op==1){

        }else{

        }

         return ejecutarConsulta($sql);

    }






 }


?>
