<?php
require_once '../../config/config.php';


class MGradoInstruccion
{

    public function __construct()
    {
    }
    public function Listar_GradoInstruccion()
    {
        $sql = "CALL `SP_MANT_GRADOINSTRUCCION_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_GradoInstruccion($idGradoInstruccion)
    {
        $sql = "CALL `SP_MANT_GRADOINSTRUCCION_ELIMINAR`('$idGradoInstruccion');";
        return ejecutarConsulta($sql);
    }
    public function ValidarGradoInstruccion($nombreGradoInstruccion, $idGradoInstruccion)
    {
        $sql = "";
        if ($idGradoInstruccion == '' || $idGradoInstruccion == null || empty($idGradoInstruccion)) {
            $sql = "SELECT * FROM tab_gradoinstruccion WHERE Descripcion='$nombreGradoInstruccion';";
        } else {
            $sql = "SELECT * FROM tab_gradoinstruccion WHERE Descripcion='$nombreGradoInstruccion' and idGradoInstruccion!='$idGradoInstruccion';";
        }
        return validarDatos($sql);
    }
    public function RegistroGradoInstruccion($GradoInstruccionDescripcion, $idGradoInstruccion)
    {
        $sql = "";
        if ($idGradoInstruccion == "" || $idGradoInstruccion == null || empty($idGradoInstruccion)) {
            $sql = "CALL `SP_MANT_GRADOINSTRUCCION_REGISTRO`('$GradoInstruccionDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_GRADOINSTRUCCION_EDITAR`('$GradoInstruccionDescripcion','$idGradoInstruccion');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_GradoInstruccion($idGradoInstruccion)
    {
        $sql = "CALL `SP_MANT_GRADOINSTRUCCION_RECUPERAR`('$idGradoInstruccion');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_GradoInstruccion($idGradoInstruccion, $Opcion)
    {
        $sql = "CALL `SP_MANT_GRADOINSTRUCCION_ACTIVACION`('$idGradoInstruccion','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
