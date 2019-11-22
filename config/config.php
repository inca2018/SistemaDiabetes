<?php
require_once "global.php";


function Conexion(){
   $conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

    mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

    //Si tenemos un posible error en la conexión lo mostramos
    if (mysqli_connect_errno())
    {
        printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());
        exit();
    }
  return  $conexion;
}


if (!function_exists('ejecutarConsulta')){

   function ejecutarConsulta($sql){
      $conexion=Conexion();
      $query=$conexion->prepare($sql);
      if($query){
         $query = $conexion->query($sql);
      }
       mysqli_close($conexion);
      return $query;
   }

   function ejecutarConsultaSimpleFila($sql){
      $conexion=Conexion();
      $query = $conexion->query($sql);
      $row = $query->fetch_assoc();
       mysqli_close($conexion);
      return $row;
	}

	function ejecutarConsulta_retornarID($sql){
       $conexion=Conexion();
       $query = $conexion->query($sql);
       $id=$conexion->insert_id;
       mysqli_close($conexion);
      return $id;
	}

	function limpiarCadena($str){
       $conexion=Conexion();
      $str = mysqli_real_escape_string($conexion,trim($str));
         mysqli_close($conexion);
      return htmlspecialchars($str);
	}

   function validarDatos($sql){
      $conexion=Conexion();
      $query = $conexion->query($sql);
        mysqli_close($conexion);
      return $query->num_rows;
   }

   function totalLista($sql){
      $conexion=Conexion();
      $query = $conexion->query($sql);
       mysqli_close($conexion);
      return $query->num_rows;
   }

}
?>
