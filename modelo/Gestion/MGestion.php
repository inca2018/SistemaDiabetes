<?php
   require_once '../../config/config.php';



   class MGestion{

      public function __construct(){
      }

        public function RecuperarDatosPerfil($idUsuario){
            $sql="SELECT u.idUsuario,p.nombrePersona,p.apellidoPaterno,p.apellidoMaterno,p.DNI,p.telefono,p.correo,p.direccion,u.usuario,u.pass,per.nombrePerfil FROM usuario u INNER JOIN persona p On p.idPersona=u.idUsuario INNER JOIN perfil per On per.idPerfil=u.Perfil_idPerfil WHERE u.idUsuario='$idUsuario'";
			return ejecutarConsultaSimpleFila($sql);
        }
		public function Recuperar_Gestion($idGestion){
			$sql="CALL `SP_Gestion_RECUPERAR`('$idGestion');";
			return ejecutarConsultaSimpleFila($sql);
		}

       public function RecuperarGraficoFechas($Inicio,$Fin){
			$sql="CALL `SP_REPORTE_GRAFICO1`('$Inicio','$Fin');";
			return ejecutarConsultaSimpleFila($sql);
		}
        public function RecuperarGraficoFechasAlumno($Inicio,$Fin,$idAlumno){
			$sql="CALL `SP_REPORTE_GRAFICO2`('$Inicio','$Fin','$idAlumno');";

			return ejecutarConsultaSimpleFila($sql);
		}
       public function ListarOperaciones(){
			$sql="CALL `SP_OPERACIONES_LISTAR`();";
			return ejecutarConsulta($sql);
		}

       public function BuscarReporteIndicadores($fechaInicio,$fechaFin){
           $sql="CALL `SP_REPORTE_1`('$fechaInicio','$fechaFin');";
			return ejecutarConsulta($sql);
       }

       public function BuscarReporteIndicadoresAlumno($fechaInicio,$fechaFin,$idAlumno){
           $sql="CALL `SP_REPORTE_2`('$fechaInicio','$fechaFin','$idAlumno');";
			return ejecutarConsulta($sql);
       }

       public function ListaComprobantes($idAlumno){
           $sql="CALL `SP_OPERACIONES_LISTAR_COMPROBANTES`($idAlumno);";
			return ejecutarConsulta($sql);
       }
       public function ListarDeudas($idAlumno,$year){
			$sql="CALL `SP_OPERACIONES_RECUPERAR_DEUDA`('$idAlumno','$year');";
			return ejecutarConsulta($sql);
		}
         public function ListarDeudasOperaciones($idAlumno,$year){
			$sql="CALL `SP_OPERACIONES_INFO_DEUDA1`('$idAlumno','$year');";
			return ejecutarConsulta($sql);
		}
       public function ListarDeudasPensiones($idAlumno,$year){
			$sql="CALL `SP_OPERACIONES_RECUPERAR_PENSIONES`('$idAlumno','$year');";
			return ejecutarConsulta($sql);
		}
         public function ListarDeudasPensionesOperaciones($idAlumno,$year){
			$sql="CALL `SP_OPERACIONES_INFO_DEUDA2`('$idAlumno','$year');";
			return ejecutarConsulta($sql);
		}
         public function ListarPagar($idAlumno,$year){
            $sql="CALL `SP_OPERACIONES_RECUPERAR_PAGAR`('$idAlumno','$year');";
			return ejecutarConsulta($sql);
         }

       public function RecuperarInformacionMatricula($idAlumno){
           $sql="CALL `SP_OPERACION_RECUPERAR_INFO`('$idAlumno');";
			return ejecutarConsultaSimpleFila($sql);
       }

       public function RecuperarInformacionMatricula2($idAlumno){
           $sql="CALL `SP_RECUPERAR_RECUPERAR_ALUMNO`('$idAlumno');";
			return ejecutarConsultaSimpleFila($sql);
       }
       public function RegistrarPago($idPlan,$idAlumno,$numPago,$PagoTipoPago,$PagoTipoTarjeta,$importePago,$pago_detalle,$login_idLog){

           if($PagoTipoTarjeta=='' || $PagoTipoTarjeta==null || empty($PagoTipoTarjeta)){
			  $PagoTipoTarjeta='0';
		  }
           if($pago_detalle=='' || $pago_detalle==null || empty($pago_detalle)){
			  $pago_detalle='0';
		  }

           $sql="CALL `SP_OPERACIONES_ACCION_PAGO`('$idPlan','$idAlumno','$numPago','$PagoTipoPago','$PagoTipoTarjeta','$importePago','$pago_detalle','$login_idLog');";

			return ejecutarConsulta($sql);
       }
       public function RegistrarCuota($idPlan,$idAlumno,$idCuota,$PagoTipoPago,$PagoTipoTarjeta,$importePago,$importeBase,$importeMora,$pago_detalle,$login_idLog){

           if($PagoTipoTarjeta=='' || $PagoTipoTarjeta==null || empty($PagoTipoTarjeta)){
			  $PagoTipoTarjeta='0';
		  }
           if($pago_detalle=='' || $pago_detalle==null || empty($pago_detalle)){
			  $pago_detalle='0';
		  }

			  if($importeMora=='' || $importeMora==null || empty($importeMora)){
			  $importeMora='0';
		  }

           $sql="CALL `SP_OPERACION_PAGO_CUOTA`('$idPlan','$idAlumno','$idCuota','$PagoTipoPago','$PagoTipoTarjeta','$importePago','$importeBase','$importeMora','$pago_detalle','$login_idLog');";

			return ejecutarConsulta($sql);
       }

       public function Listar_Cuotas($idPlan,$idAlumno){
			$sql="CALL `SP_OPERACIONES_LISTAR_CUOTAS`('$idPlan','$idAlumno');";
			return ejecutarConsulta($sql);
		}

        public function RecuperarCuotaPagar($idPlan,$idCuota){
           $sql="CALL `SP_OPERACION_RECUPERAR_CUOTA_PAGAR`('$idPlan','$idCuota');";
			return ejecutarConsultaSimpleFila($sql);
       }
		 public function RecuperarTotales($idAlumno,$year){
           $sql="CALL `SP_OPERACIONES_RECUPERAR_TOTALES`('$idAlumno','$year');";

			return ejecutarConsultaSimpleFila($sql);
       }

		  public function RecuperarParametros(){
			  $sql1=ejecutarConsulta("CALL `SP_RECUPERAR_PARAMETROS`(@p0, @p1, @p2, @p3);");
           $sql="SELECT @p0 AS `NumAlumnos`, @p1 AS `NumApoderados`, @p2 AS `PagoHoy`, @p3 AS `VencidoHoy`;";
			return ejecutarConsultaSimpleFila($sql);
       }

		public function RecuperarReporte($idAlumno){
          $sql1=ejecutarConsulta(" CALL `SP_INDICADORES_ALUMNO`(@p0, @p1, @p2, @p3,'$idAlumno');");
          $sql="SELECT @p0 AS `numCuotas`, @p1 AS `cuotaPend`, @p2 AS `cuotaPagada`, @p3 AS `cuotaVencida`;";
			return ejecutarConsultaSimpleFila($sql);
       }

		public function RecuperarReporteFechas($fechaInicio,$fechaFin){
          $sql1=ejecutarConsulta(" CALL `SP_INDICADORES_FECHAS`(@p0, @p1, @p2, @p3,'$fechaInicio','$fechaFin');");
          $sql="SELECT @p0 AS `numCuotas`, @p1 AS `cuotaPend`, @p2 AS `cuotaPagada`, @p3 AS `cuotaVencida`;";
			return ejecutarConsultaSimpleFila($sql);
       }


       public function RegistrarPagoP($idAlumnoP,$yearP,$importePago,$importeMora,$codigoPago,$TipoPago,$pagar_importe,$pagar_importe_mora,$tituloPago){
          $sql="CALL `SP_OPERACIONES_REGISTRO_PAGO`('$idAlumnoP','$yearP','$importePago','$importeMora','$codigoPago','$TipoPago','$pagar_importe','$pagar_importe_mora','$tituloPago');";
			return ejecutarConsulta($sql);
       }

       public function RecuperarInfoMatricula($idMatricula,$alumno,$year){
          $sql=" CALL `SP_OPERACIONES_INFO_MATRICULA`('$idMatricula','$alumno','$year');";
			return ejecutarConsulta($sql);
       }

        public function RecuperarInfoPension($idMatricula,$alumno,$year){
           $sql=" CALL `SP_OPERACIONES_INFO_PENSION`('$idMatricula','$alumno','$year');";
			return ejecutarConsulta($sql);
       }

       public function RegistrarPagoCabecera($idAlumno,$year,$final_importe_pagar,$final_importe_vuelto,$final_importe_total,$final_metodoPago,$final_tipo_tarjeta,$final_num_tarjeta,$final_cvv_tarjeta,$final_detalle){
			 if($final_tipo_tarjeta=='0' || $final_tipo_tarjeta==null || empty($final_tipo_tarjeta)){
			  $final_tipo_tarjeta='0';
		  }
			 if($final_num_tarjeta=='0' || $final_num_tarjeta==null || empty($final_num_tarjeta)){
			  $final_num_tarjeta='0';
		  }
			 if($final_cvv_tarjeta=='0' || $final_cvv_tarjeta==null || empty($final_cvv_tarjeta)){
			  $final_cvv_tarjeta='0';
		  }
		  $sql="CALL`SP_REGISTRAR_DATOS`('$idAlumno','$year','$final_importe_pagar','$final_importe_vuelto','$final_importe_total','$final_metodoPago','$final_tipo_tarjeta','$final_num_tarjeta','$final_cvv_tarjeta','$final_detalle');";

			return ejecutarConsultaSimpleFila($sql);
       }

		public function Cambios($idAlumno,$year,$cabecera){
			$sql="CALL `SP_ACTUALIZAR_PAGOS_NUEVO`($idAlumno, $year, $cabecera);";
			return ejecutarConsulta($sql);
		}

		public function actualizar_Documento($cabecera,$alumno,$documento){
			$sql="UPDATE `pagocabecera` SET  `Documento`='$documento'  WHERE  `idPago`='$cabecera' and `Alumno_idAlumno`='$alumno'";
			return ejecutarConsulta($sql);
		}

		public function RecuperarCabecera($cabecera,$idAlumno){
            $sql="SELECT pg.idPago,pg.ImporteTotal,pg.ImporteVuelto,pg.ImportePagar,pg.Observaciones,tt.Descripcion as Tarjeta,pg.NumeroTarjeta,pg.CVV,pg.fechaRegistro,pg.ReciboVoucher,CONCAT(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombresAlumno,p.DNI,p.telefono,p.direccion FROM pagocabecera pg  INNER JOIN alumno al ON al.idAlumno=pg.Alumno_idAlumno INNER JOIN persona p On p.idPersona=al.Persona_idPersona
INNER JOIN tipotarjeta tt ON tt.idTipoTarjeta=pg.TipoTarjeta_idTipoTarjeta WHERE pg.Alumno_idAlumno='$idAlumno' and pg.idPago='$cabecera';";

			return ejecutarConsultaSimpleFila($sql);
       }
		public function RecuperarDetalle($cabecera,$idAlumno,$year){
           $sql="SELECT * FROM pagodetalle pg WHERE pg.Cabecera_idCabecera='$cabecera' and pg.Alumno_idAlumno='$idAlumno' and pg.year='$year' and pg.Estado_idEstado=10;";

			return ejecutarConsulta($sql);
       }




       public function EliminarPagar($idPagar,$importePagar,$idAlumno,$year,$idCuota,$idMatricula,$TipoPago){
           if($idCuota=='0' || $idCuota==null || empty($idCuota)){
			  $idCuota='0';
		  }
           if($idMatricula=='0' || $idMatricula==null || empty($idMatricula)){
			  $idMatricula='0';
		  }
          $sql="CALL `SP_OPERACIONES_ELIMINAR_PAGAR`('$idPagar','$importePagar','$idAlumno','$year','$idCuota','$idMatricula','$TipoPago');";

			 return ejecutarConsulta($sql);
       }



    public function password($idUsuario){
     $sql="Select pass from usuario where idUsuario='$idUsuario'";
     return ejecutarConsultaSimpleFila($sql);
   }
    public function actualizar_datos_perfil($idUsuario,$UsuarioCorreo,$UsuarioContacto,$UsuarioPassNuevo,$accion){
         if($UsuarioCorreo=='0' || $UsuarioCorreo==null || empty($UsuarioCorreo)){
			  $UsuarioCorreo='0';
		  }
        if($UsuarioContacto=='0' || $UsuarioContacto==null || empty($UsuarioContacto)){
			  $UsuarioContacto='0';
		  }
        if($UsuarioPassNuevo=='0' || $UsuarioPassNuevo==null || empty($UsuarioPassNuevo)){
			  $UsuarioPassNuevo='0';
		  }
        $sql="CALL `SP_ACTUALIZAR_PERFIL`('$idUsuario','$UsuarioCorreo','$UsuarioContacto','$UsuarioPassNuevo','$accion')";

        return ejecutarConsulta($sql);
    }


   }

?>
