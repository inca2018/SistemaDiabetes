

<?php

    if(isset($_POST['idPerfil'])){

    }else{
        header('Location: ../../vista/Mantenimiento/MantPerfiles.php');
    }
?>

<!-- Inicio de Cabecera-->
<?php require_once('../layaout/Header.php');?>
<!-- fin Cabecera-->
<!-- Inicio del Cuerpo y Nav -->
<?php require_once('../layaout/Nav.php');?>
<!-- Fin  del Cuerpo y Nav -->
<!-- Cuerpo del sistema de Menu -->
   <!-- Main section-->
   <section class="section-container">
      <!-- Page content-->
      	<div class="content-wrapper">
            <!-- <div class="content-heading">
              <div>Mantenimiento Perfils</div>
            </div> -->
            <!-- START card-->
            <div class="card card-default m-1 ">
               <div class="card-body" id="cuerpo">
                 <form  id="FormularioPermisos" method="POST" autocomplete="off">

                       <input type="hidden" id="idPerfil" name="idPerfil" value="<?php echo $_POST['idPerfil'] ;?>">
                       <input type="hidden" id="idPermisos" name="idPermisos" >
                        <div class="row ">
                            <div class="col-md-12 w-100 text-center ">
                                <h3>Mantenimiento de Permisos:</h3>
                            </div>
                        </div>
                        <hr class="mt-2 mb-2">
                        <h5 class="mt-3 mb-3 titulo_area" ><em><b>Permisos de Perfil:</b></em></h5>
                        <h3 class="mt-3 mb-3 text-muted" id="perfilRecuperado"><em><b></b></em></h3>
                        <div class="row">
                            <label class="col-md-3 col-form-label texto-x12"><b>MÓDULO GESTIÓN ENCONADO:</b></label>
                            <div class="col-md-3  mt-1">
                               <div class="row">
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_gestion1" name="m_gestion1" value="1" >
                                    <span></span>SI</label>
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_gestion1" name="m_gestion1" value="0" >
                                    <span></span>NO</label>
                               </div>
                            </div>
                        </div>
                         <div class="row">
                            <label class="col-md-3 col-form-label texto-x12"><b>MÓDULO GESTIÓN OVILLADO:</b></label>
                            <div class="col-md-3  mt-1">
                               <div class="row">
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_gestion2" name="m_gestion2" value="1" >
                                    <span></span>SI</label>
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_gestion2" name="m_gestion2" value="0" >
                                    <span></span>NO</label>
                               </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label texto-x12"><b>MÓDULO GESTIÓN TINTORERIA:</b></label>
                            <div class="col-md-3  mt-1">
                               <div class="row">
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_gestion3" name="m_gestion3" value="1" >
                                    <span></span>SI</label>
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_gestion3" name="m_gestion3" value="0" >
                                    <span></span>NO</label>
                               </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label texto-x12"><b>MÓDULO GESTIÓN CALIDAD:</b></label>
                            <div class="col-md-3  mt-1">
                               <div class="row">
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_gestion4" name="m_gestion4" value="1" >
                                    <span></span>SI</label>
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_gestion4" name="m_gestion4" value="0" >
                                    <span></span>NO</label>
                               </div>
                            </div>
                        </div>
                         <div class="row">
                            <label class="col-md-3 col-form-label texto-x12"><b>MÓDULO MANTENIMIENTO:</b></label>
                            <div class="col-md-3  mt-1">
                               <div class="row">
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_mantenimiento" name="m_mantenimiento" value="1" >
                                    <span></span>SI</label>
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_mantenimiento" name="m_mantenimiento" value="0" >
                                    <span></span>NO</label>
                               </div>
                            </div>
                        </div>
                         <div class="row">
                            <label class="col-md-3 col-form-label texto-x12"><b>MÓDULO REPORTES:</b></label>
                            <div class="col-md-3  mt-1">
                               <div class="row">
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_reporte" name="m_reporte" value="1" >
                                    <span></span>SI</label>
                                    <label class=" texto-x12 col-md-6">
                                    <input type="radio" class="m_reporte" name="m_reporte" value="0" >
                                    <span></span>NO</label>
                               </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                           <div class="col-md-3">
                                <button  type="button" class="btn btn-info" onclick="RegresarPermisos();"><i class="fas fa-arrow-left fa-lg mr-2"></i>
                                VOLVER
                                </button>
                            </div>
                            <div class="col-md-3 offset-2">
                                <button  type="submit" class="btn btn-success  "><i class="fa fa-save fa-lg mr-2 "></i>
                                GUARDAR
                                </button>
                            </div>

                        </div>

                 </form>
               </div>
           </div>
         </div>
   </section>
    <!-- Fin Modal Agregar-->
<!-- Fin del Cuerpo del Sistema del Menu-->
<!-- Inicio del footer -->
<?php require_once('../layaout/Footer.php');?>
<!-- Fin del Footer -->

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/PermisosPerfil.js"></script>
