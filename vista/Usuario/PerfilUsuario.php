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

        <!-- START card-->
        <div class="card card-default">
            <div class="card-body">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center ">
                        <h3>Perfil de Usuario:</h3>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <form id="FormularioPerfil" method="POST" autocomplete="off">
                <input type="hidden" id="idUsuario" name="idUsuario" >
                <div class="row" id="area_perfil">

                    <div class="col-md-6 br">
                        <h5 class="mt-3 mb-3 titulo_area"><em><b>Información de Usuario:</b></em></h5>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioPerfil" class="col-md-5 col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="UsuarioNombre" name="UsuarioNombre" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioApellidoPaterno" class="col-md-5 col-form-label">Apellido Paterno:</label>
                                <input type="text" class="form-control" id="UsuarioApellidoPaterno" name="UsuarioApellidoPaterno" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioApellidoMaterno" class="col-md-5 col-form-label">Apellido Materno:</label>
                                <input type="text" class="form-control" id="UsuarioApellidoMaterno" name="UsuarioApellidoMaterno" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioContacto" class="col-md-5 col-form-label">Correo:</label>
                                <input type="email" class="form-control" id="UsuarioCorreo" name="UsuarioCorreo" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioContacto" class="col-md-5 col-form-label">Telefono de Contacto:</label>
                                <input type="text" class="form-control" id="UsuarioContacto" name="UsuarioContacto" onkeypress="return SoloNumerosModificado(event,8,this.id);">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <h5 class="mt-3 mb-3 titulo_area"><em><b>Cambio de Contraseña:</b></em></h5>
                         <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioPassVerificar" class="col-md-5 col-form-label">Usuario:</label>
                                <input type="text" class="form-control" id="UsuarioUsuario" name="UsuarioUsuario" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioPassVerificar" class="col-md-5 col-form-label">Perfil:</label>
                                <input type="text" class="form-control" id="UsuarioPerfil" name="UsuarioPerfil" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioPassVerificar" class="col-md-5 col-form-label">Contraseña Anterior:</label>
                                <input type="password" class="form-control" id="UsuarioPassVerificar" name="UsuarioPassVerificar">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="UsuarioPassNuevo" class="col-md-5 col-form-label">Contraseña Nueva:</label>
                                <input type="password" class="form-control" id="UsuarioPassNuevo" name="UsuarioPassNuevo">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-block ">ACTUALIZAR DATOS</button>
                            </div>

                        </div>
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

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/PerfilUsuario.js"></script>
