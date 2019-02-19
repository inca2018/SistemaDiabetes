<?php
   session_start();
   require_once "../../modelo/Gestion/MFicha.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";


    $Ficha = new MFicha();
    $general = new MGeneral();
    $recursos = new Conexion();


    $idGrupo = isset($_POST["idGrupo"]) ? limpiarCadena($_POST["idGrupo"]) : "";

   switch($_GET['op']){

        case 'RecuperarGrupos':
            $rpta = $Ficha->RecuperarGrupos();
            $Grupos=array();
            while ($reg = $rpta->fetch_object()){
                 $Grupo=array("id"=>$reg->idGrupoOpcion,"grupo"=>$reg->Descripcion,"opciones"=>null);
                 $rpta2 = $Ficha->RecuperarOpciones($reg->idGrupoOpcion);
                 $Opciones=array();
                 while ($reg2 = $rpta2->fetch_object()){
                    $Opcion=array("id"=>$reg2->idOpcion,"titulo"=>$reg2->TituloOpcion,"propiedades"=>$reg2->Propiedades,"tipo"=>$reg2->TipoOpcion_idTipoOpcion);
                    $Opciones[]=$Opcion;
                    $Grupo["opciones"]=$Opciones;
                }

                $Grupos[]=$Grupo;
            }
           echo json_encode($Grupos);
        break;

       case 'RecuperarEspecialidades':
             $rpta = $Ficha->RecuperarEspecialidades();
            $Especialidades=array();
            while ($reg = $rpta->fetch_object()){

            }

            $rpta = $Ficha->RecuperarEspecialidades();

            $Especialidades=array();
            while ($reg = $rpta->fetch_object()){
                 $Especialidad=array("id"=>$reg->idEspecialidad,"especialidad"=>$reg->Descripcion,"medicos"=>null);

                 $rpta2 = $Ficha->RecuperarMedicos($reg->idEspecialidad);
                $Medico="";
                $Medico.='<option value"0">-- SELECCIONAR --</option>';
                 while ($reg2 = $rpta2->fetch_object()){
                     $Medico.='<option   value=' . $reg2->idMedico . '>' . $reg2->Medico . '</option>';
                }
                $Especialidad["medicos"]=$Medico;
                $Especialidades[]=$Especialidad;
             }
           echo json_encode($Especialidades);
         break;

       case 'ListarDiagnosticos':
           	$rpta = $Ficha->ListarDiagnosticoEspecialidad();
        echo '<option value="0">--- SELECCIONE ---</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idDiagnosticoEspecialidad . '>' . $reg->Descripcion . '</option>';
         	}

           break;

   }


?>
