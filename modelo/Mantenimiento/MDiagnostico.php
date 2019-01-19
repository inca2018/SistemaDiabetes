<?php
require_once '../../config/config.php';


class MDiagnostico
{

    public function __construct()
    {
    }
    public function Listar_Diagnostico()
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICO_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_Diagnostico($idDiagnostico)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICO_ELIMINAR`('$idDiagnostico');";
        return ejecutarConsulta($sql);
    }
    public function ValidarDiagnostico($nombreDiagnostico, $idDiagnostico)
    {
        $sql = "";
        if ($idDiagnostico == '' || $idDiagnostico == null || empty($idDiagnostico)) {
            $sql = "SELECT * FROM tab_diagnostico WHERE Descripcion='$nombreDiagnostico';";
        } else {
            $sql = "SELECT * FROM tab_diagnostico WHERE Descripcion='$nombreDiagnostico' and idDiagnostico!='$idDiagnostico';";
        }
        return validarDatos($sql);
    }
    public function RegistroDiagnostico($DiagnosticoDescripcion, $idDiagnostico)
    {
        $sql = "";
        if ($idDiagnostico == "" || $idDiagnostico == null || empty($idDiagnostico)) {
            $sql = "CALL `SP_MANT_DIAGNOSTICO_REGISTRO`('$DiagnosticoDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_DIAGNOSTICO_EDITAR`('$DiagnosticoDescripcion','$idDiagnostico');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_Diagnostico($idDiagnostico)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICO_RECUPERAR`('$idDiagnostico');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_Diagnostico($idDiagnostico, $Opcion)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICO_ACTIVACION`('$idDiagnostico','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
