<?php
require_once '../../config/config.php';


class MDiagnosticoEnfermeria
{

    public function __construct()
    {
    }
    public function Listar_DiagnosticoEnfermeria()
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICOENFERMERIA_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_DiagnosticoEnfermeria($idDiagnosticoEnfermeria)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICOENFERMERIA_ELIMINAR`('$idDiagnosticoEnfermeria');";
        return ejecutarConsulta($sql);
    }
    public function ValidarDiagnosticoEnfermeria($nombreDiagnosticoEnfermeria, $idDiagnosticoEnfermeria)
    {
        $sql = "";
        if ($idDiagnosticoEnfermeria == '' || $idDiagnosticoEnfermeria == null || empty($idDiagnosticoEnfermeria)) {
            $sql = "SELECT * FROM tab_diagnostico_enfermeria WHERE Descripcion='$nombreDiagnosticoEnfermeria';";
        } else {
            $sql = "SELECT * FROM tab_diagnostico_enfermeria WHERE Descripcion='$nombreDiagnosticoEnfermeria' and idDiagnosticoEnfermeria!='$idDiagnosticoEnfermeria';";
        }
        return validarDatos($sql);
    }
    public function RegistroDiagnosticoEnfermeria($DiagnosticoEnfermeriaDescripcion, $idDiagnosticoEnfermeria)
    {
        $sql = "";
        if ($idDiagnosticoEnfermeria == "" || $idDiagnosticoEnfermeria == null || empty($idDiagnosticoEnfermeria)) {
            $sql = "CALL `SP_MANT_DIAGNOSTICOENFERMERIA_REGISTRO`('$DiagnosticoEnfermeriaDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_DIAGNOSTICOENFERMERIA_EDITAR`('$DiagnosticoEnfermeriaDescripcion','$idDiagnosticoEnfermeria');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_DiagnosticoEnfermeria($idDiagnosticoEnfermeria)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICOENFERMERIA_RECUPERAR`('$idDiagnosticoEnfermeria');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_DiagnosticoEnfermeria($idDiagnosticoEnfermeria, $Opcion)
    {
        $sql = "CALL `SP_MANT_DIAGNOSTICOENFERMERIA_ACTIVACION`('$idDiagnosticoEnfermeria','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
