<?php
   require_once '../../config/config.php';

class MReporteRiesgo {

    public function __construct(){
    }
    public function ListadoReporteRiesgo($Inicio,$Fin,$Sexo){
        $sql="SELECT
        ex.Riesgo,
        pa.Codigo,
        pa.idPaciente,
        CONCAT(pa.Nombres,' ',pa.apellidoPaterno,' ',pa.apellidoMaterno) AS PacienteNombres,
        pa.numeroDocumento as DNI
        FROM tab_seguimiento seg
        INNER JOIN tab_paciente pa
        On pa.idPaciente=seg.Paciente_idPaciente
        INNER JOIN tab_extra ex
        ON ex.Seguimiento_idSeguimiento=seg.idSeguimiento
        WHERE pa.Sexo_idSexo=$Sexo AND (DATE(ex.fechaRegistro) BETWEEN '$Inicio' AND '$Fin');";
        return ejecutarConsulta($sql);
    }
}

?>
