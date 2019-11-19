<?php
require_once '../../config/config.php';


class MNacionalidad
{

    public function __construct()
    {
    }
    public function Listar_Nacionalidad()
    {
        $sql = "SELECT * FROM tab_nacionalidad nac INNER JOIN estado e ON e.idEstado=nac.Estado_idEstado where e.idEstado!=10";
        return ejecutarConsulta($sql);
    }
    public function Eliminar_Nacionalidad($idNacionalidad)
    {
        $sql = "UPDATE `tab_nacionalidad` SET  `Estado_idEstado`=10  WHERE `idNacionalidad`=$idNacionalidad";
        return ejecutarConsulta($sql);
    }
    public function ValidarNacionalidad($nombreNacionalidad, $idNacionalidad)
    {
        $sql = "";
        if ($idNacionalidad == '' || $idNacionalidad == null || empty($idNacionalidad)) {
            $sql = "SELECT * FROM tab_nacionalidad WHERE Descripcion='$nombreNacionalidad';";
        } else {
            $sql = "SELECT * FROM tab_nacionalidad WHERE Descripcion='$nombreNacionalidad' and idNacionalidad!='$idNacionalidad';";
        }
        return validarDatos($sql);
    }
    public function RegistroNacionalidad($NacionalidadDescripcion, $idNacionalidad)
    {
        $sql = "";
        if ($idNacionalidad == "" || $idNacionalidad == null || empty($idNacionalidad)) {
            //$sql = "CALL `SP_MANT_Nacionalidad_REGISTRO`('$NacionalidadDescripcion');";
            $sql="INSERT INTO `tab_nacionalidad`(`idNacionalidad`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,'".$NacionalidadDescripcion."',1,NOW())";


        } else {
            $sql = "UPDATE `tab_nacionalidad` SET `Descripcion`='".$NacionalidadDescripcion."'  WHERE `idNacionalidad`=$idNacionalidad";
        }
        return ejecutarConsulta($sql);
    }
    public function Recuperar_Nacionalidad($idNacionalidad)
    {
        $sql = "CALL `SP_MANT_Nacionalidad_RECUPERAR`('$idNacionalidad');";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function Activacion_Nacionalidad($idNacionalidad, $Opcion)
    {
        $sql = "CALL `SP_MANT_Nacionalidad_ACTIVACION`('$idNacionalidad','$Opcion');";
        return ejecutarConsulta($sql);
    }

    public function HabilitarNacionalidad($idNacionalidad){
       $sql = "UPDATE `tab_nacionalidad` SET  `Estado_idEstado`=1  WHERE `idNacionalidad`=$idNacionalidad";
       return ejecutarConsulta($sql);
    }

    public function DeshabilitarNacionalidad($idNacionalidad){
       $sql = "UPDATE `tab_nacionalidad` SET  `Estado_idEstado`=2  WHERE `idNacionalidad`=$idNacionalidad";
       return ejecutarConsulta($sql);
    }

}

?>
