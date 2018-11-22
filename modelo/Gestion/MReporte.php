<?php
   require_once '../../config/config.php';

class MReporte {

   public function __construct(){

   }


     public function total_clientes(){
		$sql="SELECT COUNT(*) as TOTAL FROM `usuario`";
		return ejecutarConsultaSimpleFila($sql);
	}

     public function total_establecimiento(){
		$sql="SELECT COUNT(*) as TOTAL FROM `proveedor`";
		return ejecutarConsultaSimpleFila($sql);
	}
     public function total_equipo_activos(){
		$sql="SELECT COUNT(*) as TOTAL FROM punto_venta";
		return ejecutarConsultaSimpleFila($sql);
	}
    public function total_equipo_inactivos(){
		$sql="SELECT COUNT(*) as TOTAL FROM entidad";
		return ejecutarConsultaSimpleFila($sql);
	}



      public function total_pacientes($Fecha1,$Fecha2){
        $sql="SELECT COUNT(fechaRegistro) AS TOTAL_PACIENTES FROM `paciente` WHERE  DATE(`fechaRegistro`) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function total_atenciones($Fecha1,$Fecha2){
        $sql="SELECT COUNT(fechaRegistro) AS TOTAL_ATENCIONES FROM `seguimiento` WHERE  DATE(`fechaRegistro`) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }

     public function total_adecuado($Fecha1,$Fecha2,$id_paciente){
        $sql="SELECT  COUNT(val1.VAR4) AS CONTAR FROM seguimiento s RIGHT JOIN paciente p ON p.idPaciente=s.Paciente_idPaciente INNER JOIN valores1 val1 ON val1.ID=s.ResultadosA WHERE val1.VAR4>180 and p.idPaciente='$id_paciente' and DATE(s.fechaRegistro) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }

     public function listar_paciente(){
       $sql="SELECT p.idPaciente FROM paciente p INNER JOIN seguimiento s ON s.Paciente_idPaciente=p.idPaciente INNER JOIN valores1 val1 ON val1.ID=s.ResultadosA GROUP BY p.idPaciente;  ";
      return ejecutarConsulta($sql);
   }


    public function condicion1($Fecha1,$Fecha2){
        $sql="SELECT COUNT(pa.idPaciente) AS TOTAL1 FROM paciente pa WHERE pa.Condicion_idCondicion=1 AND DATE(pa.fechaRegistro) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }
      public function condicion2($Fecha1,$Fecha2){
        $sql="SELECT COUNT(pa.idPaciente) AS TOTAL2 FROM paciente pa WHERE pa.Condicion_idCondicion=2 AND DATE(pa.fechaRegistro) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }
      public function condicion3($Fecha1,$Fecha2){
        $sql="SELECT COUNT(pa.idPaciente) AS TOTAL3 FROM paciente pa WHERE pa.Condicion_idCondicion=3 AND DATE(pa.fechaRegistro) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }


     public function tipo1($Fecha1,$Fecha2){
        $sql="SELECT COUNT(pa.idPaciente) AS TOTAL4 FROM paciente pa WHERE pa.dx=1 AND DATE(pa.fechaRegistro) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function tipo2($Fecha1,$Fecha2){
        $sql="SELECT COUNT(pa.idPaciente) AS TOTAL5 FROM paciente pa WHERE pa.dx=2 AND DATE(pa.fechaRegistro) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function tipo3($Fecha1,$Fecha2){
        $sql="SELECT COUNT(pa.idPaciente) AS TOTAL6 FROM paciente pa WHERE pa.dx=3 AND DATE(pa.fechaRegistro) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function tipo4($Fecha1,$Fecha2){
        $sql="SELECT COUNT(pa.idPaciente) AS TOTAL7 FROM paciente pa WHERE pa.dx=4 AND DATE(pa.fechaRegistro) BETWEEN '$Fecha1' AND '$Fecha2'";
        return ejecutarConsultaSimpleFila($sql);
    }




 }


?>
