<?php
require_once '../../config/config.php';


class MDiagnosticoEspecialidad
{

    public function __construct()
    {
    }
    public function Listar_DiagnosticoEspecialidad()
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICOESPECIALIDAD_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_DiagnosticoEspecialidad($idDiagnosticoEspecialidad)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICOESPECIALIDAD_ELIMINAR`('$idDiagnosticoEspecialidad');";
        return ejecutarConsulta($sql);
    }
    public function ValidarDiagnosticoEspecialidad($nombreDiagnosticoEspecialidad, $idDiagnosticoEspecialidad)
    {
        $sql = "";
        if ($idDiagnosticoEspecialidad == '' || $idDiagnosticoEspecialidad == null || empty($idDiagnosticoEspecialidad)) {
            $sql = "SELECT * FROM tab_diagnostico_especialidad WHERE Descripcion='$nombreDiagnosticoEspecialidad';";
        } else {
            $sql = "SELECT * FROM tab_diagnostico_especialidad WHERE Descripcion='$nombreDiagnosticoEspecialidad' and idDiagnosticoEspecialidad!='$idDiagnosticoEspecialidad';";
        }
        return validarDatos($sql);
    }
    public function RegistroDiagnosticoEspecialidad($DiagnosticoEspecialidadDescripcion, $idDiagnosticoEspecialidad)
    {
        $sql = "";
        if ($idDiagnosticoEspecialidad == "" || $idDiagnosticoEspecialidad == null || empty($idDiagnosticoEspecialidad)) {
            $sql = "CALL `SP_MANT_DIAGNOSTICOESPECIALIDAD_REGISTRO`('$DiagnosticoEspecialidadDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_DIAGNOSTICOESPECIALIDAD_EDITAR`('$DiagnosticoEspecialidadDescripcion','$idDiagnosticoEspecialidad');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_DiagnosticoEspecialidad($idDiagnosticoEspecialidad)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICOESPECIALIDAD_RECUPERAR`('$idDiagnosticoEspecialidad');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_DiagnosticoEspecialidad($idDiagnosticoEspecialidad, $Opcion)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICOESPECIALIDAD_ACTIVACION`('$idDiagnosticoEspecialidad','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
