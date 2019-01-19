<?php
require_once '../../config/config.php';


class MCondicion
{

    public function __construct()
    {
    }
    public function Listar_Condicion()
    {
        $sql = "CALL `SP_MANT_CONDICION_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_Condicion($idCondicion)
    {
        $sql = "CALL `SP_MANT_CONDICION_ELIMINAR`('$idCondicion');";
        return ejecutarConsulta($sql);
    }
    public function ValidarCondicion($nombreCondicion, $idCondicion)
    {
        $sql = "";
        if ($idCondicion == '' || $idCondicion == null || empty($idCondicion)) {
            $sql = "SELECT * FROM tab_condicion WHERE Descripcion='$nombreCondicion';";
        } else {
            $sql = "SELECT * FROM tab_condicion WHERE Descripcion='$nombreCondicion' and idCondicion!='$idCondicion';";
        }
        return validarDatos($sql);
    }
    public function RegistroCondicion($CondicionDescripcion, $idCondicion)
    {
        $sql = "";
        if ($idCondicion == "" || $idCondicion == null || empty($idCondicion)) {
            $sql = "CALL `SP_MANT_CONDICION_REGISTRO`('$CondicionDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_CONDICION_EDITAR`('$CondicionDescripcion','$idCondicion');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_Condicion($idCondicion)
    {
        $sql = "CALL `SP_MANT_CONDICION_RECUPERAR`('$idCondicion');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_Condicion($idCondicion, $Opcion)
    {
        $sql = "CALL `SP_MANT_CONDICION_ACTIVACION`('$idCondicion','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
