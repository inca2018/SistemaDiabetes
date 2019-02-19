<?php
   require_once '../../config/config.php';



   class MFicha{

      public function __construct(){
      }
      public function RecuperarGrupos(){
           $sql = "SELECT * FROM `tab_grupoopcion` where Estado_idEstado=1";
         return ejecutarConsulta($sql);
      }

       public function RecuperarOpciones($idGrupo){
           $sql = "SELECT * FROM `tab_opcion` WHERE `Estado_idEstado`=1 and `GrupoOpcion_idGrupoOpcion`='$idGrupo'";
         return ejecutarConsulta($sql);
      }

      public function RecuperarEspecialidades(){
           $sql = "SELECT * FROM `tab_especialidad` where `Estado_idEstado`=1";
         return ejecutarConsulta($sql);
      }
       public function RecuperarMedicos($idEspecialidad){
           $sql = "SELECT tab.Medico_idMedico as idMedico,CONCAT(me.nombres,' ',me.apellidoPaterno,' ',me.apellidoMaterno) as Medico FROM tab_asignacionespecialidad tab INNER JOIN tab_medico me ON me.idMedico=tab.Medico_idMedico where tab.Especialidad_idEspecialidad='$idEspecialidad'";
         return ejecutarConsulta($sql);
      }
      public function ListarDiagnosticoEspecialidad(){
          $sql="SELECT * FROM tab_diagnostico_especialidad;";
          return ejecutarConsulta($sql);
      }

   }

?>
