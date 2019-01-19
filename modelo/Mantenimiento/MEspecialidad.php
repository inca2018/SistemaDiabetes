<?php
require_once '../../config/config.php';


class MEspecialidad
{

    public function __construct()
    {
    }
    public function Listar_Especialidad()
    {
        $sql = "CALL `SP_MANT_ESPECIALIDAD_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_Especialidad($idEspecialidad)
    {
        $sql = "CALL `SP_MANT_ESPECIALIDAD_ELIMINAR`('$idEspecialidad');";
        return ejecutarConsulta($sql);
    }
    public function ValidarEspecialidad($nombreEspecialidad, $idEspecialidad)
    {
        $sql = "";
        if ($idEspecialidad == '' || $idEspecialidad == null || empty($idEspecialidad)) {
            $sql = "SELECT * FROM tab_especialidad WHERE Descripcion='$nombreEspecialidad';";
        } else {
            $sql = "SELECT * FROM tab_especialidad WHERE Descripcion='$nombreEspecialidad' and idEspecialidad!='$idEspecialidad';";
        }
        return validarDatos($sql);
    }
    public function RegistroEspecialidad($EspecialidadDescripcion, $idEspecialidad)
    {
        $sql = "";
        if ($idEspecialidad == "" || $idEspecialidad == null || empty($idEspecialidad)) {
            $sql = "CALL `SP_MANT_ESPECIALIDAD_REGISTRO`('$EspecialidadDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_ESPECIALIDAD_EDITAR`('$EspecialidadDescripcion','$idEspecialidad');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_Especialidad($idEspecialidad)
    {
        $sql = "CALL `SP_MANT_ESPECIALIDAD_RECUPERAR`('$idEspecialidad');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_Especialidad($idEspecialidad, $Opcion)
    {
        $sql = "CALL `SP_MANT_ESPECIALIDAD_ACTIVACION`('$idEspecialidad','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
