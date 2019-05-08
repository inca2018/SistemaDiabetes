<?php
   session_start();
   require_once "../../modelo/Gestion/MGestionPacientes.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";


    $gestion = new MGestionPacientes();
    $general = new MGeneral();
    $recursos = new Conexion();

	 $idPaciente=isset($_POST["idPaciente"])? limpiarCadena($_POST["idPaciente"]):"";
	 $ano=isset($_POST["ano"])? limpiarCadena($_POST["ano"]):"";
	 $mes=isset($_POST["mes"])? limpiarCadena($_POST["mes"]):"";

	 $login_idLog=$_SESSION['idUsuario'];
    $idSeguimiento=isset($_POST["idSeguimiento"])? limpiarCadena($_POST["idSeguimiento"]):"";

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
                "3"=>$reg->NombreCompletoPaciente,
                "4"=>$reg->edad,
                "5"=>$reg->tipoDocu,
                "6"=>$reg->numeroDocumento,
                "7"=>$reg->condicion,
                "8"=>$reg->procedencia,
                "9"=>BuscarAccion($reg)

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
      $rspta=$gestion->listar_seguimientos($idPaciente,$ano,$mes);
      $data= Array();
      $num=0;
      while ($reg=$rspta->fetch_object()){
         $num++;
         $data[]=array(
            "0"=>$num,
            "1"=>$reg->Codigo,
            "2"=>$reg->Year,
            "3"=>$reg->Mes,
            "4"=>$reg->fechaRegistro,
            "5"=> '<button  class="btn btn-primary  btn-sm"type="button" title="Ver Resultados de Ficha" onclick="VerFicha('.$reg->idSeguimiento.')">
                     <i class="fa fa-user-md" aria-hidden="true"></i>
                   </button>
                   <button  class="btn btn-info  btn-sm"type="button" title="Ver Resultado de Prueba Pie" onclick="VerPie('.$reg->idSeguimiento.')">
                     <i class="fa fa-medkit" aria-hidden="true"></i>
                   </button>
                   <button  class="btn btn-danger  btn-sm"type="button" title="Eliminar Resultados" onclick="Eliminar('.$reg->idSeguimiento.')">
                     <i class="fa fa-times" aria-hidden="true"></i>
                   </button>'
            );
      }
      $results = array(
         "sEcho"=>1, //Información para el datatables
         "iTotalRecords"=>count($data), //enviamos el total registros al datatable
         "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
         "aaData"=>$data);
      echo json_encode($results);

       break;

       case 'RecuperarInformacionPaciente':
            $rspta = $gestion->RecuperarInformacionPaciente($idPaciente);
            echo json_encode($rspta);
       break;
           case 'listar_year':
      		$rpta = $gestion->listar_year();
            echo '<option value="0">-- SELECCIONE --</option>';
         	while ($reg = $rpta->fetch_object()){
					echo '<option   value=' . $reg->idYear . '>' . $reg->year . '</option>';
         	}
       break;

       case 'EliminarResultados':
           $rspta = array(
            "Mensaje" => "",
            "Eliminar" => false,
            "Error" => false
        );

        $rspta['Eliminar'] = $gestion->EliminarResultados($idSeguimiento);

        $rspta['Eliminar'] ? $rspta['Mensaje'] = "Resultados Eliminados." : $rspta['Mensaje'] = "Resultados no se pudieron eliminar comuniquese con el area de soporte";
        echo json_encode($rspta);
        break;
   }


?>
