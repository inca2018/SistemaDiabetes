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
              <div>Mantenimiento GrupoOpcions</div>
            </div> -->
        <!-- START card-->
        <div class="card card-default m-1 ">
            <div class="card-body ">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center ">
                        <h3>Mantenimiento  Grupo de Opciones:</h3>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="row">
                    <div class="col-md-3 offset-9">
                        <button class="btn btn-success btn-block btn-sm" onclick="NuevoGrupoOpcion();"><i class="fa fa-plus fa-lg mr-2"></i> Nuevo Grupo de Opciones</button>
                    </div>
                </div>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista General   Grupo de Opciones:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaGrupoOpcion">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th data-priority="1">#</th>
                                            <th>ESTADO</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>CANTIDAD DE OPCIONES</th>
                                            <th>FECHA DE REGISTRO</th>
                                            <th>ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fin Modal Agregar-->
<!-- Fin del Cuerpo del Sistema del Menu-->
<!-- Inicio del footer -->
<?php require_once('../layaout/Footer.php');?>
<!-- Fin del Footer -->

<div class="modal fade " id="ModalGrupoOpcion" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalGrupoOpcion"></h4>
                </div>
            </div>
            <div class="modal-body ">
                <form id="FormularioGrupoOpcion" method="POST" autocomplete="off">
                    <input type="hidden" name="idGrupoOpcion" id="idGrupoOpcion">
                    <div class="row" id="cuerpo">
                        <div class="col-md-12 bl">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="GrupoOpcionDescripcion " class="col-md-4 col-form-label  ">Grupo de Opciones:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control validarPanel" placeholder="GrupoOpcion" name="GrupoOpcionDescripcion" id="GrupoOpcionDescripcion" data-message="- Campo GrupoOpcion">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mr-1 ml-1">
                                <button type="submit" class="col-md-2 btn btn-success btn-sm" title="Guardar">
                                    <i class="fa fa-save fa-lg mr-2"></i>GUARDAR
                                </button>
                                <button type="button" class="col-md-2 btn btn-danger btn-sm  offset-8" title="Cancelar" onclick="Cancelar();">
                                    <i class="fa fa-times fa-lg mr-2"></i>CANCELAR
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/MantGrupoOpcion.js"></script>
