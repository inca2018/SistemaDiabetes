<?php
   require_once '../../config/config.php';

class Login{
    //Implementamos nuestro constructor
	public function __construct()
	{

	}
  public function password($usuario){
     $sql="Select password  from usuario where user='$usuario'";
     return ejecutarConsultaSimpleFila($sql);
   }
   public function idusu($usuario){
     $sql="Select idUsuario  from usuario where user='$usuario'";
     return ejecutarConsultaSimpleFila($sql);
   }
   public function datosUsuario($usuario){
     $sql="SELECT u.idUsuario,u.Perfil_idPerfil as Perfil,p.nombrePerfil,CONCAT(per.nombrePersona,' ',per.apellidoPaterno,' ',per.apellidoMaterno) as NombreUsuario,per.correo,perm.permiso1,perm.permiso2,perm.permiso3 FROM usuario u INNER JOIN perfil p on p.idPerfil=u.Perfil_idPerfil INNER JOIN persona per on per.idPersona=u.Persona_idPersona INNER JOIN permisos perm on perm.perfil_idPerfil=p.idPerfil where u.idUsuario='$usuario'";
     return ejecutarConsulta($sql);
   }
   public function cierreacceso($idusu, $session, $server){
     $sql="UPDATE login SET fechaLogout='$session', ip='$server' WHERE Usuario_idUsuario='$idusu'";
     return ejecutarConsulta($sql);
   }
   public function validaUsuario($columna,$valor){
     $sql="SELECT * FROM usuario where $columna='$valor'";
     return validarDatos($sql);
   }
}
?>
