<?php
   require_once '../../config/config.php';

   class MGeneral{

      public function __construct(){
      }

        public function Listar_Estados($tipo){
         $sql="CALL `SP_ESTADO_LISTAR`('$tipo');";
         return ejecutarConsulta($sql);
       }
        public function Listar_Persona_Todo(){
         $sql="CALL `SP_PERSONA_LISTAR_TODO`(); ";
         return ejecutarConsulta($sql);
       }

       public function Listar_Personas_Sin_Usuario(){
         $sql="CALL `SP_PERSONAS_LISTAR_SIN_USUARIOS`();";
         return ejecutarConsulta($sql);
       }
		public function Listar_Personas_Todo(){
         $sql="select * from persona";
         return ejecutarConsulta($sql);
       }
        public function Listar_Perfiles(){
         $sql="CALL `SP_PERFIL_LISTAR`();";
         return ejecutarConsulta($sql);
       }

		public function Listar_Materiales(){
         $sql="SELECT * FROM material";
         return ejecutarConsulta($sql);
       }
       public function Listar_Sexo(){
         $sql="SELECT * FROM sexo";
         return ejecutarConsulta($sql);
       }
        public function Listar_Condicion(){
         $sql="SELECT * FROM condicion";
         return ejecutarConsulta($sql);
       }
       public function Listar_Medicos(){
         $sql="SELECT p.idPersona,CONCAT(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombreMedico FROM persona p INNER JOIN usuario u ON u.Persona_idPersona=p.idPersona WHERE u.Perfil_idPerfil=11";
         return ejecutarConsulta($sql);
       }
 public function Listar_DX(){
         $sql="SELECT * FROM dx";
         return ejecutarConsulta($sql);
       }




   }

?>
