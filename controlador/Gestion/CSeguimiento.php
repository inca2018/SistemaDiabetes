<?php
   session_start();
   require_once "../../modelo/Gestion/MSeguimiento.php";
   require_once "../../modelo/General/MGeneral.php";
   require_once "../../config/conexion.php";


    $gestion = new MSeguimiento();
    $general = new MGeneral();
    $recursos = new Conexion();


	 $login_idLog=$_SESSION['idUsuario'];

      $id_paciente=isset($_POST["idPaciente"])? limpiarCadena($_POST["idPaciente"]):"";
    $id_ano=isset($_POST["idAno"])? limpiarCadena($_POST["idAno"]):"";
    $id_mes=isset($_POST["idMes"])? limpiarCadena($_POST["idMes"]):"";
    $riesgo=isset($_POST["riesgo"])? limpiarCadena($_POST["riesgo"]):"";
    $fecha_inicio=isset($_POST["fecha_inicio"])? limpiarCadena($_POST["fecha_inicio"]):"";
    $observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";
    $taller1=isset($_POST["taller1"])? limpiarCadena($_POST["taller1"]):"";
    $taller2=isset($_POST["taller2"])? limpiarCadena($_POST["taller2"]):"";
    $taller3=isset($_POST["taller3"])? limpiarCadena($_POST["taller3"]):"";
    $proxima_cita=isset($_POST["proxima_cita"])? limpiarCadena($_POST["proxima_cita"]):"";
    $id_usuario=isset($_POST["idUsuario"])? limpiarCadena($_POST["idUsuario"]):"";
    $estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

    $id_valores1=isset($_POST["id_valores1"])? limpiarCadena($_POST["id_valores1"]):"";
    $id_valores2=isset($_POST["id_valores2"])? limpiarCadena($_POST["id_valores2"]):"";
    $id_seguimiento=isset($_POST["id_seguimiento"])? limpiarCadena($_POST["id_seguimiento"]):"";


    //valores

    $var1A=isset($_POST["var1A"])? limpiarCadena($_POST["var1A"]):"";
    $var2A=isset($_POST["var2A"])? limpiarCadena($_POST["var2A"]):"";
    $var3A=isset($_POST["var3A"])? limpiarCadena($_POST["var3A"]):"";
    $var4A=isset($_POST["var4A"])? limpiarCadena($_POST["var4A"]):"";
    $var5A=isset($_POST["var5A"])? limpiarCadena($_POST["var5A"]):"";
    $var6A=isset($_POST["var6A"])? limpiarCadena($_POST["var6A"]):"";
    $var7A=isset($_POST["var7A"])? limpiarCadena($_POST["var7A"]):"";
    $var8A=isset($_POST["var8A"])? limpiarCadena($_POST["var8A"]):"";
    $var9A=isset($_POST["var9A"])? limpiarCadena($_POST["var9A"]):"";
    $var10A=isset($_POST["var10A"])? limpiarCadena($_POST["var10A"]):"";
    $var11A=isset($_POST["var11A"])? limpiarCadena($_POST["var11A"]):"";
    $var12A=isset($_POST["var12A"])? limpiarCadena($_POST["var12A"]):"";
    $var13A=isset($_POST["var13A"])? limpiarCadena($_POST["var13A"]):"";
    $var14A=isset($_POST["var14A"])? limpiarCadena($_POST["var14A"]):"";



    $var1B=isset($_POST["var1B"])? limpiarCadena($_POST["var1B"]):"";
    $var2B=isset($_POST["var2B"])? limpiarCadena($_POST["var2B"]):"";
    $var3B=isset($_POST["var3B"])? limpiarCadena($_POST["var3B"]):"";
    $var4B=isset($_POST["var4B"])? limpiarCadena($_POST["var4B"]):"";
    $var5B=isset($_POST["var5B"])? limpiarCadena($_POST["var5B"]):"";
    $var6B=isset($_POST["var6B"])? limpiarCadena($_POST["var6B"]):"";
    $var7B=isset($_POST["var7B"])? limpiarCadena($_POST["var7B"]):"";
    $var8B=isset($_POST["var8B"])? limpiarCadena($_POST["var8B"]):"";
    $var9B=isset($_POST["var9B"])? limpiarCadena($_POST["var9B"]):"";


    $obs1=isset($_POST["obs1"])? limpiarCadena($_POST["obs1"]):"";
    $obs2=isset($_POST["obs2"])? limpiarCadena($_POST["obs2"]):"";
    $obs3=isset($_POST["obs3"])? limpiarCadena($_POST["obs3"]):"";
    $obs4=isset($_POST["obs4"])? limpiarCadena($_POST["obs4"]):"";
    $obs5=isset($_POST["obs5"])? limpiarCadena($_POST["obs5"]):"";
    $obs6=isset($_POST["obs6"])? limpiarCadena($_POST["obs6"]):"";
    $obs7=isset($_POST["obs7"])? limpiarCadena($_POST["obs7"]):"";
    $obs8=isset($_POST["obs8"])? limpiarCadena($_POST["obs8"]):"";
    $obs9=isset($_POST["obs9"])? limpiarCadena($_POST["obs9"]):"";

	$talla=isset($_POST["talla"])? limpiarCadena($_POST["talla"]):"";
	$peso=isset($_POST["peso"])? limpiarCadena($_POST["peso"]):"";

   $date = str_replace('/', '-', $fecha_inicio);
   $fecha_inicio = date("Y-m-d", strtotime($date));

   $date = str_replace('/', '-', $proxima_cita);
   $proxima_cita= date("Y-m-d", strtotime($date));


function verificar($dato){
	if($dato["TOTAL"]==null){
		$dato["TOTAL"]=0;
	}
	return $dato;
}

   switch($_GET['op']){

  case 'guardaryeditar':

      if(empty($id_seguimiento)){
         $rspta =array("Error"=>false,"Mensaje"=>"","Registro"=>false);
         /* Regitrar */
         //var_dump($_POST);
         /* variables extras */

         if($rspta["Error"]){
         $rspta["Mensaje"].="Por estas razones ya no se puede registrar el seguimiento";
         }
         else{


             $id_valor1=$gestion->registrar_valores1($var1A,$var2A,$var3A,$var4A,$var5A,$var6A,$var7A,$var8A,$var9A,$var10A,$var11A,$var12A,$var13A,$var14A,$talla,$peso);
             $id_valor2=$gestion->registrar_valores2($var1B,$obs1,$var2B,$obs2,$var3B,$obs3,$var4B,$obs4,$var5B,$obs5,$var6B,$obs6,$var7B,$obs7,$var8B,$obs8,$var9B,$obs9);

            $rspta["Registro"]=$gestion->registrar_seguimiento($id_paciente,$id_ano,$id_mes,$riesgo,$fecha_inicio,$observaciones,$taller1,$taller2,$taller3,$proxima_cita,$login_idLog,'1',$id_valor1,$id_valor2);

            $rspta["Registro"]?$rspta["Mensaje"].="Seguimiento Registrado" : $rspta["Mensaje"].="Seguimiento no se pudo registrar ($id_paciente,$id_ano,$id_mes,$riesgo,$fecha_inicio,$observaciones,$taller1,$taller2,$taller3,$proxima_cita,$id_usuario,1,$id_valor1,$id_valor2) - Valores1   ($var1A,$var2A,$var3A,$var4A,$var5A,$var6A,$var7A,$var8A,$var9A,$var10A,$var11A,$var12A,$var13A,$var14A)- Valores 2 ($var1B,$obs1,$var2B,$obs2,$var3B,$obs3,$var4B,$obs4,$var5B,$obs5,$var6B,$obs6,$var7B,$obs7,$var8B,$obs8,$var9B,$obs9)";
         }

      /*------------------------------------- Update la asignacion -----------------------------------------------*/
      }else{
         $rspta =array("Error"=>false,"Mensaje"=>"","Editado"=>false);
         /* Para Editar */
         if($rspta["Error"]){
         $rspta["Mensaje"].="Por estas razones ya no se puede editar al paciente";
         }
         else{

             $rspta["Editado"]=$gestion->editar_paciente($riesgo,$fecha_inicio,$observaciones,$taller1,$taller2,$taller3,$proxima_cita,$id_seguimiento);

             $rspta["Editado"]=$gestion->editar_valores1($var1A,$var2A,$var3A,$var4A,$var5A,$var6A,$var7A,$var8A,$var9A,$var10A,$var11A,$var12A,$var13A,$var14A,$id_valores1);

             $rspta["Editado"]=$gestion->editar_valores2($var1B,$obs1,$var2B,$obs2,$var3B,$obs3,$var4B,$obs4,$var5B,$obs5,$var6B,$obs6,$var7B,$obs7,$var8B,$obs8,$var9B,$obs9,$id_valores2);


            $rspta["Editado"]?$rspta["Mensaje"].="Seguimiento Editado" : $rspta["Mensaje"].="Seguimiento no se pudo editar ($riesgo,$fecha_inicio,$observaciones,$taller1,$taller2,$taller3,$proxima_cita,$id_seguimiento) - Valores1 ($var1A,$var2A,$var3A,$var4A,$var5A,$var6A,$var7A,$var8A,$var9A,$var10A,$var11A,$var12A,$var13A,$var14A,$id_valores1)- Valores 2 ($var1B,$obs1,$var2B,$obs2,$var3B,$obs3,$var4B,$obs4,$var5B,$obs5,$var6B,$obs6,$var7B,$obs7,$var8B,$obs8,$var9B,$obs9,$id_valores2)";

         }
      }

      echo json_encode($rspta);
      break;

     case 'mostrar':
         $rspta=$gestion->recuperar_paciente($id_paciente);
      echo json_encode($rspta);
      break;

      case 'recuperarSeguimiento':
         $rspta=$gestion->recuperarSeguimiento($id_paciente,$id_ano,$id_mes);
      echo json_encode($rspta);
      break;

   }


?>
