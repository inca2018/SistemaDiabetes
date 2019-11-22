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
           $sql = "SELECT tab.Medico_idMedico as idMedico,CONCAT(me.nombres,' ',me.apellidoPaterno,' ',me.apellidoMaterno) as Medico FROM tab_asignacionespecialidad tab INNER JOIN tab_medico me ON me.idMedico=tab.Medico_idMedico where tab.Especialidad_idEspecialidad='$idEspecialidad' and me.Estado_idEstado=1";
         return ejecutarConsulta($sql);
      }
      public function ListarDiagnosticoEspecialidad(){
          $sql="SELECT * FROM tab_diagnostico_especialidad where Estado_idEstado=1;";
          return ejecutarConsulta($sql);
      }

       public function RegistrarSeguimiento($idPaciente,$idAno,$idMes){
           $sql="CALL `SP_REGISTRO_SEGUIMIENTO`('$idPaciente','$idAno','$idMes');";
           return ejecutarConsultaSimpleFila($sql);
       }

       public function RegistrarResultados($opcion,$idSeguimiento){
           $sql="CALL `SP_REGISTRAR_RESULTADOS`('$opcion[0]','$opcion[1]','$opcion[2]','$opcion[3]','$opcion[4]','$opcion[5]','$opcion[6]','$opcion[7]','$opcion[8]','$opcion[9]','$opcion[10]','$opcion[11]','$opcion[12]','$opcion[13]','$opcion[14]','$opcion[15]','$opcion[16]','$opcion[17]','$opcion[18]','$opcion[19]','$opcion[20]','$opcion[21]','$opcion[22]','$opcion[23]','$opcion[24]','$opcion[25]','$opcion[26]','$opcion[27]','$idSeguimiento');";

           return ejecutarConsulta($sql);

       }
       public function ActualizarResultados($opcion,$idSeguimiento){
           $sql="CALL `SP_ACTUALIZAR_RESULTADOS`('$opcion[0]','$opcion[1]','$opcion[2]','$opcion[3]','$opcion[4]','$opcion[5]','$opcion[6]','$opcion[7]','$opcion[8]','$opcion[9]','$opcion[10]','$opcion[11]','$opcion[12]','$opcion[13]','$opcion[14]','$opcion[15]','$opcion[16]','$opcion[17]','$opcion[18]','$opcion[19]','$opcion[20]','$opcion[21]','$opcion[22]','$opcion[23]','$opcion[24]','$opcion[25]','$opcion[26]','$opcion[27]','$idSeguimiento');";

           return ejecutarConsulta($sql);

       }


       public function RecuperarResultadosEspecialidad($idSeguimiento){
         $sql = "SELECT * FROM `tab_resultado_ficha` WHERE `Seguimiento_idSeguimiento`='$idSeguimiento'";
         return ejecutarConsulta($sql);
       }

       public function RecuperarResultadoPie($idSeguimiento){
            $sql="SELECT * FROM `tab_resultado_pie` WHERE `Seguimiento_idSeguimiento`='$idSeguimiento'";
           return ejecutarConsultaSimpleFila($sql);
       }
       public function RecuperarResultadoRefiere($idSeguimiento){
           $sql="SELECT * FROM `tab_extra` WHERE  `Seguimiento_idSeguimiento`=$idSeguimiento";
           return ejecutarConsultaSimpleFila($sql);
       }

       public function BuscarDiagnostico($diagnostico){
          $idRecuperado=0;
           if($diagnostico!=""){

             $sql ="SELECT * FROM tab_diagnostico_especialidad d WHERE Descripcion='$diagnostico';";
             $resultado=ejecutarConsultaSimpleFila($sql);
             if($resultado["idDiagnosticoEspecialidad"]>0){
               $idRecuperado=$resultado["idDiagnosticoEspecialidad"];
             }else{
                 $sql2="INSERT INTO `tab_diagnostico_especialidad`(`idDiagnosticoEspecialidad`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,'".$diagnostico."',1,NOW())";
                 $idRecuperado=ejecutarConsulta_retornarID($sql2);
             }
           }
            return $idRecuperado;
       }

   }

?>
