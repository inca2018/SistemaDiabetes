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
                        <h3>Gestión de Enconado:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-9">
                        <button class="btn btn-success btn-block btn-sm" onclick="NuevoEnconado();"><i class="fa fa-plus fa-lg mr-2"></i> Nuevo Orden de Enconado</button>
                    </div>
                </div>
                <hr>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista de Ordenes de Enconados:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaEnconado">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th data-priority="1">#</th>
                                            <th>ESTADO</th>
                                            <th>Nº ORDEN</th>
                                            <th>MATERIAL</th>
                                            <th>LOTE</th>
                                            <th>KILOS</th>
                                            <th>N° DE CONO</th>
                                            <th>F.REGISTRO</th>
                                            <th>ACCIONES</th>
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

<div class="modal fade " id="ModalEnconado" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalEnconado"></h4>
                </div>
            </div>
            <div class="modal-body ">
                <form id="FormularioEnconado" method="POST" autocomplete="off">
                    <input type="hidden" name="idEnconado" id="idEnconado">
                    <div class="row mb-3 mt-1">
                        <div class="col-md-3">
                            <label class=""><span class="red">(*) Campos Obligatorios</span></label>
                        </div>
                        <div class="col-md-1 offset-8">
                            <button type="button" class="btn btn-info btn-sm btn-display" title="Limpiar Campos" onclick="LimpiarEnconado();">
                                <i class="fa fa-trash-alt fa-lg "></i>
                            </button>
                        </div>
                    </div>

                    <div class="row" id="cuerpo">
                        <div class="col-md-12   bl">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="EnconadoNombre" class="col-md-5 col-form-label">Numero de Orden:</label>
                                        <div class="col-md-7">
                                            <input class="form-control " id="EnconadoNombre" name="EnconadoNombre" data-message="- Campo  Nombre de Enconado" placeholder="Nombre de Enconado" type="text" maxlength="50" readonly>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 br">
                                    <div class="form-group row">
                                        <label for="EnconadoMaterial" class="col-md-5 col-form-label"> Material<span class="red">*</span>:</label>
                                        <div class="col-md-7">
                                            <select class="form-control validarPanel" id="EnconadoMaterial" name="EnconadoMaterial" data-message="- Campo Material">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="EnconadoLote" class="col-md-5 col-form-label">Lote:</label>
                                        <div class="col-md-7">
                                            <input class="form-control validarPanel" id="EnconadoLote" name="EnconadoLote" data-message="- Campo  Lote de Enconado" placeholder="Lote de Enconado" type="text" maxlength="50">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="EnconadoKilos" class="col-md-5 col-form-label">Kilos:</label>
                                        <div class="col-md-7">
                                            <input class="form-control validarPanel" id="EnconadoKilos" name="EnconadoKilos" data-message="- Campo  Kilos de Enconado" placeholder="Kilos de Enconado" type="text" onkeypress="return SoloNumerosModificado(event,8,this.id);">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="EnconadoNumero" class="col-md-5 col-form-label">Numero de Conos:</label>
                                        <div class="col-md-7">
                                            <input class="form-control validarPanel" id="EnconadoNumero" name="EnconadoNumero" data-message="- Campo  Numero de Enconado" placeholder="Numero de Enconado" type="text" onkeypress="return SoloNumerosModificado(event,8,this.id);">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                        <label for="EnconadoNumero" class="  col-form-label">Observaciones Adicionales:</label>
                                        <textarea class="form-control validarPanel" id="EnconadoObservacion" name="EnconadoObservacion"></textarea>

                                </div>


                            </div>
                            <div class="row mr-1 ml-1 mt-3">
                                <button type="submit" class="col-md-2 btn btn-success btn-sm" title="Guardar" id="boton_bloqueo">
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


<div class="modal fade " id="ModalRechazo" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" >MOTIVO DE RECHAZO:</h4>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idOrden">
                 <input type="hidden" id="TipoRechazo">
                <div class="row m-2">
                    <div class="col-md-12 m-2">
                        <label for="" class="col-form-label">Observaciones de Rechazo:</label>
                        <textarea class="form-control validarPanel" id="RechazoObservacion" rows="8"></textarea>
                    </div>
                    <div class="col-md-12 m-2">
                        <label for="" class="col-form-label">Fecha de Rechazo:</label>
                        <input class="form-control " type="text" id="FechaRechazo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Enconado.js"></script>
