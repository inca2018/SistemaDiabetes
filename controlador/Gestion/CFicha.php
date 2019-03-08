<?php
   session_start();
   require_once "../../modelo/Gestion/MFicha.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";


    $Ficha = new MFicha();
    $general = new MGeneral();
    $recursos = new Conexion();


    $idGrupo = isset($_POST["idGrupo"]) ? limpiarCadena($_POST["idGrupo"]) : "";
    $OpcionesR=isset($_POST["OpcionesR"]) ? limpiarCadena($_POST["OpcionesR"]) : "";
    $idPaciente=isset($_POST["idPaciente"]) ? limpiarCadena($_POST["idPaciente"]) : "";
    $idAno=isset($_POST["idAno"]) ? limpiarCadena($_POST["idAno"]) : "";
    $idMes=isset($_POST["idMes"]) ? limpiarCadena($_POST["idMes"]) : "";
    $idSeguimiento=isset($_POST["idSeguimiento"]) ? limpiarCadena($_POST["idSeguimiento"]) : "";

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
                $Especialidad=array("id"=>$reg->idEspecialidad,"especialidad"=>$reg->Descripcion,"medicos"=>null);
                $rpta2 = $Ficha->RecuperarMedicos($reg->idEspecialidad);
                $Medico="";
                $Medico.='<option value="0">--- SELECCIONE ---</option>';
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

       case 'RecuperarListas':
            $Listas=array();
            $Medicos="";
            $Comorbilidad="";
            $diagEnfermeria="";
            $tratamientos="";
            $evaluado="";
            $satisfaccion="";

      		$rpta = $general->Listar_Medicos();
            $Medicos.='<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					$Medicos.='<option   value=' . $reg->idMedico . '>' . $reg->nombres . '</option>';
         	}
            $Listas["medicos"]=$Medicos;


      		$rpta2 = $general->Listar_Comorbilidad();
            $Comorbilidad.='<option value="0">-- SELECCIONE --</option>';
         	while ($reg2 = $rpta2->fetch_object()){
					$Comorbilidad.='<option   value=' . $reg2->idComorbilidad . '>' . $reg2->Descripcion . '</option>';
         	}
            $Listas["comorbilidad"]=$Comorbilidad;


      		$rpta3 = $general->Listar_DiagEnfermeria();
            $diagEnfermeria.='<option value="0">-- SELECCIONE --</option>';
         	while ($reg3 = $rpta3->fetch_object()){
					$diagEnfermeria.='<option   value=' . $reg3->idDiagnosticoEnfermeria . '>' . $reg3->Descripcion . '</option>';
         	}
            $Listas["enfermeria"]=$diagEnfermeria;


            $rpta4 = $general->Listar_Tratamientos();
            $tratamientos.='<option value="0">-- SELECCIONE --</option>';
         	while ($reg4 = $rpta4->fetch_object()){
					$tratamientos.='<option   value=' . $reg4->idTratamiento . '>' . $reg4->Descripcion . '</option>';
         	}
            $Listas["tratamientos"]=$tratamientos;


           $rpta5 = $general->Listar_Evaluado();
            $evaluado.='<option value="0">-- SELECCIONE --</option>';
         	while ($reg5 = $rpta5->fetch_object()){
					$evaluado.='<option   value=' . $reg5->idEvaluado . '>' . $reg5->Descripcion . '</option>';
         	}
            $Listas["evaluado"]=$evaluado;



            $rpta6 = $general->Listar_Satisfaccion();
            $satisfaccion.='<option value="0">-- SELECCIONE --</option>';
         	while ($reg6 = $rpta6->fetch_object()){
					$satisfaccion.='<option   value=' . $reg6->idSatisfaccion . '>' . $reg6->Descripcion . '</option>';
         	}
            $Listas["satisfaccion"]=$satisfaccion;

            echo json_encode($Listas);
       break;

       case 'GuardarFicha':
              $rspta=array("Error"=>false,"Mensaje"=>"","Registro"=>false);
            $resuSeguimiento = $Ficha->RegistrarSeguimiento($idPaciente,$idAno,$idMes);
            $idSeguimiento=$resuSeguimiento["ID"];

            $OpcionesR = explode('|', $OpcionesR);

            $contador=count($OpcionesR);
            for($i=0;$i<$contador;$i++){
                $opcion=explode(',',$OpcionesR[$i]);
                 if($i==$contador-1){
                        $resuSeguimiento = $Ficha->RegistrarResultados($opcion,$idSeguimiento);
                        $rspta["Registro"]=true;

                     }else{
                        $resuSeguimiento = $Ficha->RegistrarResultados($opcion,$idSeguimiento);
                     }
            }

           if($rspta["Registro"]){
               $rspta["Mensaje"]="Registro de Seguimiento con Exito!";
           }else{
               $rspta["Mensaje"]="Registro de Seguimiento no se pudo Registrar Correctamente.";
           }
            echo json_encode($rspta);
           break;

       case 'RecuperarResultadosEspecialidad':

            $rpta = $Ficha->RecuperarResultadosEspecialidad($idSeguimiento);
            $Resultados=array();
            while ($reg = $rpta->fetch_object()){
                 $Resultado=array("idEspecialidad"=>$reg->Especialidad_idEspecialidad,"idSeguimiento"=>$reg->idResultadoFicha,"idOpcion"=>$reg->Opcion_Opcion,"tipoOpcion"=>$reg->TipoOpcion,"Propiedades"=>$reg->Propiedades,"RespuestaTexto"=>$reg->RespuestaTexto,"RespuestaValor"=>$reg->RespuestaValor,"RespuestaFecha"=>$reg->RespuestaFecha,"RespuestaAdecuado"=>$reg->RespuestaAdecuado,"TipoListado"=>$reg->TipoListado,"Grupo_idGrupo"=>$reg->Grupo_idGrupo);
                 $Resultados["Resultado"][]=$Resultado;
            }

            echo json_encode($Resultados);
           break;

       case 'RecuperarResultadoPie':
           $rspta=$Ficha->RecuperarResultadoPie($idSeguimiento);
            echo json_encode($rspta);
           break;
   }


?>
