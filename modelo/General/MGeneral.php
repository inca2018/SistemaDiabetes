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
         $sql="SELECT med.idMedico,CONCAT(med.nombres,' ',med.apellidoPaterno,' ',med.apellidoMaterno) as nombres FROM tab_medico med where med.Estado_idEstado=1";
         return ejecutarConsulta($sql);
       }
        public function Listar_DX(){
         $sql="SELECT * FROM tab_diagnostico";
         return ejecutarConsulta($sql);
       }
        public function listar_procedencia(){
         $sql="select * from ubdistrito u where u.idProv=127";
         return ejecutarConsulta($sql);
       }
       public function listar_tipoDocumento(){
            $sql="SELECT * FROM tab_tipodocumento";
         return ejecutarConsulta($sql);
       }

       public function listar_Departamentos(){
            $sql="SELECT * FROM tab_departamento";
         return ejecutarConsulta($sql);
       }
       public function listar_Provincias($idDepartamento){
             $sql="SELECT * FROM tab_provincia where Departamento_idDepartamento=$idDepartamento";
         return ejecutarConsulta($sql);
       }
    public function listar_Distritos($idProvincia){
             $sql="SELECT * FROM tab_distrito where Provincia_idProvincia=$idProvincia";
         return ejecutarConsulta($sql);
       }
       public function listar_tipoMedida(){
             $sql="SELECT * FROM tab_tipomedida";
         return ejecutarConsulta($sql);
       }



   }

?>
