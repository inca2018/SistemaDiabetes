<?php
//Ip de la pc servidor de base de datos
define("DB_HOST","localhost");

//Nombre de la base de datos
define("DB_NAME", "sistemadiabetes");

//Usuario de la base de datos
define("DB_USERNAME", "root");

//Contraseña del usuario de la base de datos
define("DB_PASSWORD", "");

//definimos la codificación de los caracteres
define("DB_ENCODE","utf8");

//Definimos una constante como nombre del proyecto
define("PRO_NOMBRE","");

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

//Si tenemos un posible error en la conexión lo mostramos
if (mysqli_connect_errno())
{
	printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta'))
{
	function ejecutarConsulta($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}

	function ejecutarConsultaSimpleFila($sql){
      global $conexion;
      $query = $conexion->query($sql);
      $row = $query->fetch_assoc();
      return $row;
	}

	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $conexion->insert_id;
	}

	function limpiarCadena($str)
	{
		global $conexion;
		$str = mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
	}
    function validarDatos($sql){
        global $conexion;
        $query = $conexion->query($sql);
        return $query->num_rows;
    }
    function totalLista($sql){
      global $conexion;
      $query = $conexion->query($sql);
      return $query->num_rows;
    }
}
?>
