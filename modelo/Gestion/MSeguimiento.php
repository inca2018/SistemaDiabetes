<?php
   require_once '../../config/config.php';



   class MSeguimiento{

      public function __construct(){
      }

        public function registrar_seguimiento($id_paciente,$id_ano,$id_mes,$riesgo,$fecha_inicio,$observaciones,$taller1,$taller2,$taller3,$proxima_cita,$id_usuario,$estado,$id_valores1,$id_valores2){
       $sql="INSERT INTO `seguimiento`(`Paciente_idPaciente`, `year`, `mes`, `Riesgo`, `fechaInicio`, `Observaciones`, `Taller1`, `Taller2`, `Taller3`, `ProximaCita`, `Usuario_idUsuario`, `Estado_idEstado`, `fechaRegistro`, `ResultadosA`, `ResultadosB`) VALUES ('$id_paciente','$id_ano','$id_mes','$riesgo','$fecha_inicio','$observaciones','$taller1','$taller2','$taller3','$proxima_cita','$id_usuario','$estado',NOW(),'$id_valores1','$id_valores2') ";

      return ejecutarConsulta($sql);
   }

    public function editar_seguimiento($riesgo,$fecha_inicio,$observaciones,$taller1,$taller2,$taller3,$proxima_cita,$id_seguimiento){
        $sql="UPDATE `seguimiento` SET `Riesgo`=$riesgo,`fechaInicio`=$fecha_inicio,`Observaciones`=$observaciones,`Taller1`=$taller1,`Taller2`=$taller2,`Taller3`=$taller3,`ProximaCita`=$proxima_cita WHERE idSeguimiento='$id_seguimiento' ";
         return ejecutarConsulta($sql);
    }



     public function registrar_valores1($var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14,$talla,$peso){
       $sql="INSERT INTO `valores1`(`VAR1`, `VAR2`, `VAR3`, `VAR4`, `VAR5`, `VAR6`, `VAR7`, `VAR8`, `VAR9`, `VAR10`, `VAR11`, `VAR12`, `VAR13`, `VAR14`,`TALLA`,`PESO`) VALUES ('$var1','$var2','$var3','$var4','$var5','$var6','$var7','$var8','$var9','$var10','$var11','$var12','$var13','$var14','$talla','$peso') ";
      return ejecutarConsulta_retornarID($sql);
   }


     public function editar_valores1($var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14,$id_valores1){
        $sql="UPDATE `valores1` SET `VAR1`=$var1,`VAR2`=$var2,`VAR3`=$var3,`VAR4`=$var4,`VAR5`=$var5,`VAR6`=$var6,`VAR7`=$var7,`VAR8`=$var8,`VAR9`=$var9,`VAR10`=$var10,`VAR11`=$var11,`VAR12`=$var12,`VAR13`=$var13,`VAR14`=$var14 WHERE ID='$id_valores1' ";
         return ejecutarConsulta($sql);
    }

     public function registrar_valores2($var1,$obs1,$var2,$obs2,$var3,$obs3,$var4,$obs4,$var5,$obs5,$var6,$obs6,$var7,$obs7,$var8,$obs8,$var9,$obs9){
       $sql="INSERT INTO `valores2`( `VAR1`, `VAR1_OBS`, `VAR2`, `VAR2_OBS`, `VAR3`, `VAR3_OBS`, `VAR4`, `VAR4_OBS`, `VAR5`, `VAR5_OBS`, `VAR6`, `VAR6_OBS`, `VAR7`, `VAR7_OBS`, `VAR8`, `VAR8_OBS`, `VAR9`, `VAR9_OBS`) VALUES ('$var1','$obs1','$var2','$obs2','$var3','$obs3','$var4','$obs4','$var5','$obs5','$var6','$obs6','$var7','$obs7','$var8','$obs8','$var9','$obs9') ";
      return ejecutarConsulta_retornarID($sql);
   }


     public function editar_valores2($var1,$obs1,$var2,$obs2,$var3,$obs3,$var4,$obs4,$var5,$obs5,$var6,$obs6,$var7,$obs7,$var8,$obs8,$var9,$obs9,$id_valores2){
        $sql="UPDATE `valores2` SET  `VAR1`=$var1,`VAR1_OBS`=$obs1,`VAR2`=$var2,`VAR2_OBS`=$obs2,`VAR3`=$var3,`VAR3_OBS`=$obs3,`VAR4`=$var4,`VAR4_OBS`=$obs4,`VAR5`=$var5,`VAR5_OBS`=$obs5,`VAR6`=$var6,`VAR6_OBS`=$obs6,`VAR7`=$var7,`VAR7_OBS`=$obs7,`VAR8`=$var8,`VAR8_OBS`=$obs8,`VAR9`=$var9,`VAR9_OBS`=$obs9 WHERE ID='$id_valores2' ";
         return ejecutarConsulta($sql);
    }


    public function eliminar_seguimiento($id_seguimiento){
        $sql="DELETE FROM `seguimiento` WHERE idSeguimiento='$id_seguimiento'";
         return ejecutarConsulta($sql);
    }
    public function eliminar_valores1($id_Valores1){
        $sql="DELETE FROM `valores1` WHERE ID='$id_Valores1'";
         return ejecutarConsulta($sql);
    }
    public function eliminar_valores2($id_Valores2){
        $sql="DELETE FROM `valores2` WHERE ID='$id_Valores2'";
         return ejecutarConsulta($sql);
    }



     public function recuperar_seguimiento($id_seguimiento){
        $sql="SELECT  `ID`, `ID_PACIENTE`, `ID_ANO`, `ID_MES`, `RIESGO`, `FECHA_INICIO`, `OBSERVACIONES`, `TALLER1`, `TALLER2`, `TALLER3`, `PROXIMA_CITA`, `ID_USUARIO`, `ESTADO`, `FECHA_CREADO`, `ID_VALORES1`, `ID_VALORES2` FROM `seguimiento` WHERE ID='$id_seguimiento'";
        return ejecutarConsultaSimpleFila($sql);
    }

      public function recuperar_valores1($id_valores1){
        $sql="SELECT  SELECT `ID`, `VAR1`, `VAR2`, `VAR3`, `VAR4`, `VAR5`, `VAR6`, `VAR7`, `VAR8`, `VAR9`, `VAR10`, `VAR11`, `VAR12`, `VAR13`, `VAR14` FROM `valores1` WHERE ID='$id_valores1'";
        return ejecutarConsultaSimpleFila($sql);
    }

      public function recuperar_valores2($id_valores2){
        $sql="SELECT  SELECT `ID`, `VAR1`, `VAR1_OBS`, `VAR2`, `VAR2_OBS`, `VAR3`, `VAR3_OBS`, `VAR4`, `VAR4_OBS`, `VAR5`, `VAR5_OBS`, `VAR6`, `VAR6_OBS`, `VAR7`, `VAR7_OBS`, `VAR8`, `VAR8_OBS`, `VAR9`, `VAR9_OBS` FROM `valores2` WHERE ID='$id_valores2'";
        return ejecutarConsultaSimpleFila($sql);
    }

     public function recuperar_paciente($id_paciente){
        $sql="
			SELECT pa.idPaciente,pa.Codigo,CONCAT(p.nombrePersona,' ', p.apellidoPaterno,' ',p.apellidoMaterno) as PersonaNombre,pa.Procedencia,p.fechaNacimiento,pa.TipoEnfermedad,pa.dx,(SELECT CONCAT(pp.nombrePersona,' ', pp.apellidoPaterno,' ',pp.apellidoMaterno) FROM persona pp WHERE pp.idPersona=pa.Medico_idMedico) as Medico,p.direccion,con.Descripcion as Condicion,s.idSexo FROM persona p INNER JOIN paciente pa On pa.Persona_idPersona=p.idPersona INNER JOIN condicion con ON con.idCondicion=pa.Condicion_idCondicion INNER JOIN sexo s ON s.idSexo=pa.Sexo_idSexo WHERE pa.idPaciente='$id_paciente'";
        return ejecutarConsultaSimpleFila($sql);
    }


     public function recuperarSeguimiento($id_paciente,$ano,$mes){
        $sql="
SELECT s.Riesgo,s.fechaInicio,s.Observaciones,s.Taller1,s.Taller2,s.Taller3,s.ProximaCita,s.fechaRegistro,val1.VAR1 AS A1,val1.VAR2 AS A2,val1.VAR3 AS A3,val1.VAR4 AS A4,val1.VAR5 AS A5,val1.VAR6 AS A6,val1.VAR7 AS A7,val1.VAR8 as A8,val1.VAR9 AS A9,val1.VAR10 AS A10,val1.VAR11 AS A11,val1.VAR12 AS A12 , val1.VAR13 AS A13,val1.VAR14 AS A14,val1.TALLA,val1.PESO,val2.VAR1 AS B1,val2.VAR1_OBS AS OBS1,val2.VAR2 AS B2,val2.VAR2_OBS AS OBS2,val2.VAR3 AS B3,val2.VAR3_OBS AS OBS3,val2.VAR4 AS B4,val2.VAR4_OBS AS OBS4,val2.VAR5 AS B5,val2.VAR5_OBS AS OBS5,val2.VAR6 AS B6,val2.VAR6_OBS AS OBS6,val2.VAR7 AS B7,val2.VAR7_OBS AS OBS7,val2.VAR8 AS B8,val2.VAR8_OBS AS OBS8,val2.VAR9 AS B9,val2.VAR9_OBS AS OBS9 FROM seguimiento s INNER JOIN paciente p ON p.idPaciente=s.Paciente_idPaciente INNER JOIN valores1 val1 ON val1.ID=s.ResultadosA INNER JOIN valores2 val2 ON val2.ID=s.ResultadosB WHERE s.Paciente_idPaciente='$id_paciente' and s.year='$ano' and s.mes='$mes'";

        return ejecutarConsultaSimpleFila($sql);
    }



   }

?>
