<?php
//Incluímos inicialmente la conexión a la base de datos
require "../../config/config.php";

class perfil{
    //Implementamos nuestro constructor
	public function __construct()
	{

	}

    public function datoperfil($idusu){
        $sql="select usu.dniUsu as dni, usu.nombreUsu as nombre, usu.apellidosUsu as apellido, usu.telefonoUsu as telefono, usu.Correo as correo,log.usuarioLog as usuario from usuarios usu INNER JOIN login log on usu.idUsu=log.Usuarios_idUsuarios WHERE idUsu=$idusu";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function editarusuario($idusu, $telefono, $correo){
        $sql="UPDATE usuarios SET telefonoUsu='$telefono',Correo='$correo' WHERE idUsu=$idusu";
        return ejecutarConsulta($sql);
    }

    public function editaracceso($idusu, $Usuario, $password){
        $sql="UPDATE login SET usuarioLog='$Usuario', contrasenaLog='$password' WHERE idLog=$idusu";
        return ejecutarConsulta($sql);
    }

    public function usuvalidarupd($columna,$valor,$codigo){
        $sql="SELECT * FROM usuarios where $columna='$valor' and not idUsu=$codigo";
        return validarDatos($sql);
    }

   public function logvalidarupd($columna,$valor,$codigo){
      $sql="SELECT * FROM login where $columna='$valor' and not Usuarios_idUsuarios=$codigo";
      return validarDatos($sql);
   }
}
?>
