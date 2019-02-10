<?php
require_once '../../config/config.php';


class MAsignacionMedico
{

    public function __construct()
    {
    }

    /** FUNCIONES NUEVAS **/
    function RecuperarInformacionEspecialidad($idEspecialidad){
        $sql = "SELECT es.Descripcion as TituloEspecialidad FROM tab_especialidad es WHERE es.idEspecialidad='$idEspecialidad'";
        return ejecutarConsultaSimpleFila($sql);
    }
     public function ListarMedicosDisponibles($idEspecialista)
    {
        $sql = "CALL `SP_ASIGNACION_LISTAR_MEDICOS_DISPONIBLES`('$idEspecialista');";
        return ejecutarConsulta($sql);
    }
     public function AsignarMedico($idEspecialista,$idMedico)
    {
        $sql = "INSERT INTO `tab_asignacionespecialidad`(`idAsignacionEspecialidad`, `Especialidad_idEspecialidad`, `Medico_idMedico`, `fechaRegistro`) VALUES (NULL,'$idEspecialista','$idMedico',NOW())";
        return ejecutarConsulta($sql);
    }
    public function ListarAsignaciones($idEspecialidad){
        $sql = "CALL `SP_ASIGNACION_LISTAR_ASIGNACIONES`('$idEspecialidad');";
         return ejecutarConsulta($sql);
    }

    public function EliminarAsignacion($idAsignacion){
          $sql = "DELETE FROM `tab_asignacionespecialidad` WHERE `idAsignacionEspecialidad`='$idAsignacion'";
        return ejecutarConsulta($sql);
    }

}

?>
