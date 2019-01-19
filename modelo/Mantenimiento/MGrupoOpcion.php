<?php
require_once '../../config/config.php';


class MGrupoOpcion
{

    public function __construct()
    {
    }
    public function Listar_GrupoOpcion()
    {
        $sql = "CALL `SP_MANT_GRUPOOPCION_LISTAR`();";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_GrupoOpcion($idGrupoOpcion)
    {
        $sql = "CALL `SP_MANT_GRUPOOPCION_ELIMINAR`('$idGrupoOpcion');";
        return ejecutarConsulta($sql);
    }
    public function ValidarGrupoOpcion($nombreGrupoOpcion, $idGrupoOpcion)
    {
        $sql = "";
        if ($idGrupoOpcion == '' || $idGrupoOpcion == null || empty($idGrupoOpcion)) {
            $sql = "SELECT * FROM tab_grupoopcion WHERE Descripcion='$nombreGrupoOpcion';";
        } else {
            $sql = "SELECT * FROM tab_grupoopcion WHERE Descripcion='$nombreGrupoOpcion' and idGrupoOpcion!='$idGrupoOpcion';";
        }
        return validarDatos($sql);
    }
    public function RegistroGrupoOpcion($GrupoOpcionDescripcion, $idGrupoOpcion)
    {
        $sql = "";
        if ($idGrupoOpcion == "" || $idGrupoOpcion == null || empty($idGrupoOpcion)) {
            $sql = "CALL `SP_MANT_GRUPOOPCION_REGISTRO`('$GrupoOpcionDescripcion');";

        } else {
            $sql = "CALL `SP_MANT_GRUPOOPCION_EDITAR`('$GrupoOpcionDescripcion','$idGrupoOpcion');";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_GrupoOpcion($idGrupoOpcion)
    {
        $sql = "CALL `SP_MANT_GRUPOOPCION_RECUPERAR`('$idGrupoOpcion');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_GrupoOpcion($idGrupoOpcion, $Opcion)
    {
        $sql = "CALL `SP_MANT_GRUPOOPCION_ACTIVACION`('$idGrupoOpcion','$Opcion');";
        return ejecutarConsulta($sql);
    }
}

?>
