<?php

require_once ('../../modelo/usuario/mlogin.php');
require_once('../layaout/Header.php');

   $login = new login();
   // capturamos el id del usuario
   $idusu=$_SESSION['idUsuario'];

   // capturamos la hora de session
   date_default_timezone_set('America/Lima');
   $horacierre=date("Y-m-d H:i:s");
   // calculamos la hora de cierre
   $ipser=$_SERVER['REMOTE_ADDR'];

   echo "IP: (".$ipser.")";

   $cierreSession=$login->cierreacceso($idusu,$horacierre,$ipser);

   if($cierreSession){
      header("Refresh:3; url=../../../index.php");
      session_unset();
      session_destroy();
   }

?>

<!-- Inicio del Cuerpo y Nav -->
<?php require_once('../layaout/Nav.php');?>
<!-- Fin  del Cuerpo y Nav -->

<!-- Cuerpo del sistema de Menu -->
<!-- Main section-->
      <section class="section-container">
         <!-- Page content-->
         <div class="content-wrapper">
            <div class="content-heading">
               <div>Menu Principal
                  <small data-localize="dashboard.WELCOME"></small>
               </div>
               <!-- END Language list-->
            </div>
            <div class="row">
               <div class="col-12 text-center">
                  <h2 class="text-thin">Cerrando Sesión</h2>
               </div>
               <div class="col-12 ">
                  <!-- START card-->
                  <?php if($cierreSession): ?>
                  <div class="card flex-row align-items-center align-items-stretch border-0">
                     <div class="col-12 text-center p-4">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw text-info"></i>
                        <span class="sr-only">Loading...</span>
                     </div>
                  </div>
                  <?php else: ?>
                  <div class="alert alert-danger" role="alert">
                     <strong><i class="fa fa-close"></i></strong>
                     No se puede cerrar Sesion, cierre el navegador y intente nuevamente.
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </section>
<!-- Fin del Cuerpo del Sistema del Menu-->
<!-- Inicio del footer -->
<?php require_once('../layaout/Footer.php');?>
<!-- Fin del Footer -->
