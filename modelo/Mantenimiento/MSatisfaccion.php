<?php
require_once '../../config/config.php';


class MSatisfaccion
{

    public function __construct()
    {
    }
    public function Listar_Satisfaccion()
    {
        $sql = "CALL `SP_MANT_SATISFACCION_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_Satisfaccion($idSatisfaccion)
    {
        $sql = "CALL `SP_MANT_SATISFACCION_ELIMINAR`('$idSatisfaccion');";
        return ejecutarConsulta($sql);
    }
    public function ValidarSatisfaccion($nombreSatisfaccion, $idSatisfaccion)
    {
        $sql = "";
        if ($idSatisfaccion == '' || $idSatisfaccion == null || empty($idSatisfaccion)) {
            $sql = "SELECT * FROM tab_satisfaccion WHERE Descripcion='$nombreSatisfaccion';";
        } else {
            $sql = "SELECT * FROM tab_satisfaccion WHERE Descripcion='$nombreSatisfaccion' and idSatisfaccion!='$idSatisfaccion';";
        }
        return validarDatos($sql);
    }
    public function RegistroSatisfaccion($SatisfaccionDescripcion, $idSatisfaccion)
    {
        $sql = "";
        if ($idSatisfaccion == "" || $idSatisfaccion == null || empty($idSatisfaccion)) {
            $sql = "CALL `SP_MANT_SATISFACCION_REGISTRO`('$SatisfaccionDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_SATISFACCION_EDITAR`('$SatisfaccionDescripcion','$idSatisfaccion');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_Satisfaccion($idSatisfaccion)
    {
        $sql = "CALL `SP_MANT_SATISFACCION_RECUPERAR`('$idSatisfaccion');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_Satisfaccion($idSatisfaccion, $Opcion)
    {
        $sql = "CALL `SP_MANT_SATISFACCION_ACTIVACION`('$idSatisfaccion','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
