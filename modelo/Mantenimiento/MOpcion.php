<?php
require_once '../../config/config.php';


class MOpcion
{

    public function __construct()
    {
    }
    public function Listar_Opcion()
    {
        $sql = "CALL `SP_MANT_Opcion_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_Opcion($idOpcion)
    {
        $sql = "CALL `SP_MANT_Opcion_ELIMINAR`('$idOpcion');";
        return ejecutarConsulta($sql);
    }
    public function ValidarOpcion($nombreOpcion, $idOpcion)
    {
        $sql = "";
        if ($idOpcion == '' || $idOpcion == null || empty($idOpcion)) {
            $sql = "SELECT * FROM tab_Opcion WHERE Descripcion='$nombreOpcion';";
        } else {
            $sql = "SELECT * FROM tab_Opcion WHERE Descripcion='$nombreOpcion' and idOpcion!='$idOpcion';";
        }
        return validarDatos($sql);
    }
    public function RegistroOpcion($OpcionDescripcion, $idOpcion)
    {
        $sql = "";
        if ($idOpcion == "" || $idOpcion == null || empty($idOpcion)) {
            $sql = "CALL `SP_MANT_Opcion_REGISTRO`('$OpcionDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_Opcion_EDITAR`('$OpcionDescripcion','$idOpcion');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_Opcion($idOpcion)
    {
        $sql = "CALL `SP_MANT_Opcion_RECUPERAR`('$idOpcion');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_Opcion($idOpcion, $Opcion)
    {
        $sql = "CALL `SP_MANT_Opcion_ACTIVACION`('$idOpcion','$Opcion');";
        return ejecutarConsulta($sql);
    }

    public function ListarTipoOpcion(){
        $sql = "CALL `SP_MANT_OPCION_LISTARTIPOS`();";
        return ejecutarConsulta($sql);
    }
}

?>
