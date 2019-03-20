<?php
require_once '../../config/config.php';


class MOpcion
{

    public function __construct()
    {
    }


    /** NUEVOS **/
    public function ListarTipoOpcion(){
        $sql = "CALL `SP_MANT_OPCION_LISTARTIPOS`();";
        return ejecutarConsulta($sql);
    }
    public function RecuperarInformacionGrupoOpciones($idGrupoOpcion){
        $sql = "SELECT tab.Descripcion as TituloGrupoOpciones FROM tab_grupoopcion tab WHERE  tab.idGrupoOpcion='$idGrupoOpcion'";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function RegistroOpcion($grupo,$propiedades,$TipoOpcion,$OpcionTitulo){
        if($grupo=='' || $grupo==0){
            $grupo=null;
        }
        $sql = "INSERT INTO `tab_opcion`(`idOpcion`,`TituloOpcion`, `Propiedades`, `fechaRegistro`, `Estado_idEstado`, `TipoOpcion_idTipoOpcion`, `GrupoOpcion_idGrupoOpcion`) VALUES (NULL,'$OpcionTitulo','$propiedades',NOW(),1,'$TipoOpcion','$grupo')";

        return ejecutarConsulta($sql);
    }
     public function ActualizarOpcion($idOpcion,$grupo,$propiedades,$TipoOpcion,$OpcionTitulo){
        if($grupo=='' || $grupo==0){
            $grupo=null;
        }
        $sql = "UPDATE `tab_opcion` SET  `TituloOpcion`='$OpcionTitulo',`Propiedades`='$propiedades',`TipoOpcion_idTipoOpcion`='$TipoOpcion',`GrupoOpcion_idGrupoOpcion`='$grupo' WHERE `idOpcion`='$idOpcion'";

        return ejecutarConsulta($sql);
    }
    public function Listar_Opcion($idGrupoOpcion){
        $sql = "SELECT op.idOpcion,op.TituloOpcion,op.fechaRegistro,op.Estado_idEstado,e.nombreEstado,tip.Descripcion as tipoOpcion FROM tab_opcion op inner join estado e ON e.idEstado=op.Estado_idEstado inner join tab_tipoopcion tip on tip.idTipoOpcion=op.TipoOpcion_idTipoOpcion where op.GrupoOpcion_idGrupoOpcion= '$idGrupoOpcion' ";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_Opcion($idOpcion){
        $sql = "DELETE FROM `tab_opcion` WHERE `idOpcion`='$idOpcion'";
        return ejecutarConsulta($sql);
    }
    public function Activacion_Opcion($idOpcion, $Opcion){
         $sql = "UPDATE `tab_opcion` SET  `Estado_idEstado`='$Opcion'   WHERE `idOpcion`='$idOpcion'";
        return ejecutarConsulta($sql);
    }
    public function RecuperarOpcion($idOpcion){
        $sql = "SELECT * FROM `tab_opcion` WHERE `idOpcion`=$idOpcion";
        return ejecutarConsultaSimpleFila($sql);
    }
}

?>
