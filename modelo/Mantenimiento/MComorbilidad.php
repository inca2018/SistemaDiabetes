<?php
require_once '../../config/config.php';


class MComorbilidad
{

    public function __construct()
    {
    }
    public function Listar_Comorbilidad()
    {
        $sql = "CALL `SP_MANT_COMORBILIDAD_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_Comorbilidad($idComorbilidad)
    {
        $sql = "CALL `SP_MANT_COMORBILIDAD_ELIMINAR`('$idComorbilidad');";
        return ejecutarConsulta($sql);
    }
    public function ValidarComorbilidad($nombreComorbilidad, $idComorbilidad)
    {
        $sql = "";
        if ($idComorbilidad == '' || $idComorbilidad == null || empty($idComorbilidad)) {
            $sql = "SELECT * FROM tab_comorbilidad WHERE Descripcion='$nombreComorbilidad';";
        } else {
            $sql = "SELECT * FROM tab_comorbilidad WHERE Descripcion='$nombreComorbilidad' and idComorbilidad!='$idComorbilidad';";
        }
        return validarDatos($sql);
    }
    public function RegistroComorbilidad($ComorbilidadDescripcion, $idComorbilidad)
    {
        $sql = "";
        if ($idComorbilidad == "" || $idComorbilidad == null || empty($idComorbilidad)) {
            $sql = "CALL `SP_MANT_COMORBILIDAD_REGISTRO`('$ComorbilidadDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_COMORBILIDAD_EDITAR`('$ComorbilidadDescripcion','$idComorbilidad');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_Comorbilidad($idComorbilidad)
    {
        $sql = "CALL `SP_MANT_COMORBILIDAD_RECUPERAR`('$idComorbilidad');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_Comorbilidad($idComorbilidad, $Opcion)
    {
        $sql = "CALL `SP_MANT_COMORBILIDAD_ACTIVACION`('$idComorbilidad','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
