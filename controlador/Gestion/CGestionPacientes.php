<?php
   session_start();
   require_once "../../modelo/Gestion/MGestionPacientes.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";


    $gestion = new MGestionPacientes();
    $general = new MGeneral();
    $recursos = new Conexion();

	 $id_paciente=isset($_POST["idPaciente"])? limpiarCadena($_POST["idPaciente"]):"";
	 $ano=isset($_POST["ano"])? limpiarCadena($_POST["ano"]):"";
	 $mes=isset($_POST["mes"])? limpiarCadena($_POST["mes"]):"";

	 $login_idLog=$_SESSION['idUsuario'];


    function BuscarEstado($reg){

       if($reg->Estado_idEstado=='5' || $reg->Estado_idEstado==5){
			   return '<div class="badge badge-purple">'.$reg->nombreEstado.'</div>';
		 }elseif($reg->Estado_idEstado=='1' || $reg->Estado_idEstado==1){
			   return '<div class="badge badge-success">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='2' || $reg->Estado_idEstado==2){
			   return '<div class="badge badge-danger">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='6' || $reg->Estado_idEstado==6){
			   return '<div class="badge badge-warning">EN PROCESO CALIDAD</div>';
		  }elseif($reg->Estado_idEstado=='7' || $reg->Estado_idEstado==7){
			   return '<div class="badge badge-success">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='8' || $reg->Estado_idEstado==8){
			   return '<div class="badge badge-warning">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='9' || $reg->Estado_idEstado==9){
			   return '<div class="badge badge-warning">'.$reg->nombreEstado.'</div>';
		  }elseif($reg->Estado_idEstado=='10' || $reg->Estado_idEstado==10){
			   return '<div class="badge badge-info">'.$reg->nombreEstado.'</div>';
        }
    }

  function BuscarAccion($reg){
		  $resp="";

        $resp.='
				<button title="Fichas" class="btn btn-info  btn-sm"type="button" onclick="ficha('.$reg->idPaciente.')">

                 <i class="fas fa-chart-line"></i>
              </button>';
		 return $resp;
    }


   switch($_GET['op']){

	 case 'listar_pacientes':

         $rspta=$gestion->Listar_Pacientes_Todos();
         $data= array();
         while ($reg=$rspta->fetch_object()){
         $data[]=array(
               "0"=>'',
                "1"=>BuscarEstado($reg),
                "2"=>$reg->Codigo,
                "3"=>$reg->NomnbrePersona,
                "4"=>$reg->DNI,
                "5"=>$reg->TipoEnfermedad,
                "6"=>$reg->SexoPaciente,
                "7"=>$reg->CondicionPaciente,
                "8"=>$reg->Procedencia,
                "9"=>$reg->MedicoPaciente,
                "10"=>BuscarAccion($reg)

            );
         }
         $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
         echo json_encode($results);
      break;
case 'listar_seguimientos':
      $rspta=$gestion->listar_seguimientos($id_paciente,$ano,$mes);
      $data= Array();
      $num=0;
      while ($reg=$rspta->fetch_object()){
         $num++;
         $data[]=array(
            "0"=>$num,
            "1"=>'<button title="Información de Seguimiento" class="btn btn-info  btn-sm"type="button" onclick="informacion('.$reg->idSeguimiento.','.$reg->Paciente_idPaciente.','.$reg->ANO.','.$reg->MES.')">
                 <i class="fas fa-clipboard-list"></i>
              </button>
                ',
            "2"=>$reg->PACIENTE,
            "3"=>$reg->fechaInicio,
            "4"=>$reg->ProximaCita,
            "5"=>BuscarEstado($reg)

            );
      }
      $results = array(
         "sEcho"=>1, //Información para el datatables
         "iTotalRecords"=>count($data), //enviamos el total registros al datatable
         "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
         "aaData"=>$data);
      echo json_encode($results);

    break;
   }


?>
