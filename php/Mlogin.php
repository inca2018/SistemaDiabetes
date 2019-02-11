<?php
require_once "conexion.php";

Class Login{
   //Implementamos nuestro constructor
   public function __construct()
   {

   }
   public function password($usuario){
     $sql="Select pass from usuario where usuario='$usuario'";
     return ejecutarConsultaSimpleFila($sql);
   }
   public function idusu($usuario){
     $sql="Select idUsuario  from usuario where usuario='$usuario'";
     return ejecutarConsultaSimpleFila($sql);
   }
   public function datosUsuario($usuario){
     $sql="SELECT u.idUsuario,u.Perfil_idPerfil as Perfil,p.nombrePerfil,CONCAT(per.nombrePersona,' ',per.apellidoPaterno,' ',per.apellidoMaterno) as NombreUsuario,per.correo,perm.Permiso1,perm.Permiso2,perm.Permiso3,perm.Permiso4,perm.Permiso5,perm.Permiso6 FROM usuario u INNER JOIN perfil p on p.idPerfil=u.Perfil_idPerfil INNER JOIN persona per on per.idPersona=u.Persona_idPersona INNER JOIN permisos perm on perm.perfil_idPerfil=p.idPerfil where u.idUsuario='$usuario'";
     return ejecutarConsulta($sql);
   }
   public function cierreacceso($idusu, $session, $server){
     $sql="UPDATE login SET fechaLogout='$session', ip='$server' WHERE Usuarios_idUsuarios=$idusu";
     return ejecutarConsulta($sql);
   }
   public function validaUsuario($valor){
     $sql="SELECT * FROM usuario u  where u.usuario='$valor'";

     return validarDatos($sql);
   }
}
?>
