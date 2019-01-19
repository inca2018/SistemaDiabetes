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
              <div>Mantenimiento GradoInstruccions</div>
            </div> -->
        <!-- START card-->
        <div class="card card-default m-1 ">
            <div class="card-body ">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center ">
                        <h3>Mantenimiento Grado de Instruccion:</h3>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="row">
                    <div class="col-md-4 offset-8">
                        <button class="btn btn-success btn-block btn-sm" onclick="NuevoGradoInstruccion();"><i class="fa fa-plus fa-lg mr-2"></i> Nuevo Grado de Instruccion</button>
                    </div>
                </div>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista General Grado de Instruccion:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaGradoInstruccion">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th data-priority="1">#</th>
                                            <th>ESTADO</th>
                                            <th>DESCRIPCIÓN</th>
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

<div class="modal fade " id="ModalGradoInstruccion" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalGradoInstruccion"></h4>
                </div>
            </div>
            <div class="modal-body ">
                <form id="FormularioGradoInstruccion" method="POST" autocomplete="off">
                    <input type="hidden" name="idGradoInstruccion" id="idGradoInstruccion">
                    <div class="row" id="cuerpo">
                        <div class="col-md-12 bl">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="GradoInstruccionDescripcion" class="col-md-4 col-form-label  ">Grado de Instruccion:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control validarPanel" placeholder="GradoInstruccion" name="GradoInstruccionDescripcion" id="GradoInstruccionDescripcion" data-message="- Campo GradoInstruccion">
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


<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/MantGradoInstruccion.js"></script>
