<?php
if( isset($_POST["idOrden"]) ){

}else{
	 header('Location: ../../Gestion/vista/Operaciones/Enconado.php');
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

        <!-- START card-->
        <div class="card card-default">
            <div class="card-body">
                <input type="hidden" id="idOrden" value="<?php echo $_POST["idOrden"];?>">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center ">
                        <h3>Gestión de Trabajo de Ovillado:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 ">
                        <button class="btn btn-info btn-block btn-sm" onclick="Volver();"><i class="fas fa-chevron-left mr-1"></i>Volver a lista de Ordenes</button>
                    </div>
                    <div class="col-md-2 offset-8">
                        <button class="btn btn-success btn-block btn-sm" onclick="NuevoOvillado();"><i class="fa fa-plus fa-lg mr-2"></i> Nuevo Orden de Trabajo</button>
                    </div>
                </div>
                <hr>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista de Trabajos de Ovillado Realizados:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaGestionOvillado">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th data-priority="1">#</th>
                                            <th>Estado</th>
                                            <th>Orden</th>
                                            <th>Trabajador</th>
                                            <th>Material</th>
                                            <th>Orden de Trabajo</th>
                                            <th>Cant. de Ovillos</th>
                                            <th>Peso Ovillo</th>
                                            <th>Lote Ovillo</th>
                                            <th>F.Registro</th>
                                            <th>Acciones</th>
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

<div class="modal fade " id="ModalOvillado" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalOvillado"></h4>
                </div>
            </div>
            <div class="modal-body ">
                <form id="FormularioOvillado" method="POST" autocomplete="off">
                    <input type="hidden" name="idOvilladoGestion" id="idOvilladoGestion">
                    <input type="hidden" name="idMaterialOculto" id="idMaterialOculto">
                    <input type="hidden" name="idOrden" id="" value="<?php echo $_POST["idOrden"];?>">
                    <div class="row mb-3 mt-1">
                        <div class="col-md-3">
                            <label class=""><span class="red">(*) Campos Obligatorios</span></label>
                        </div>
                        <div class="col-md-1 offset-8">
                            <button type="button" class="btn btn-info btn-sm btn-display" title="Limpiar Campos" onclick="LimpiarOvillado();">
                                <i class="fa fa-trash-alt fa-lg "></i>
                            </button>
                        </div>
                    </div>

                    <div class="row" id="cuerpo">
                        <div class="col-md-12  ">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="OvilladoNombre" class="col-md-5 col-form-label">Orden de Trabajo:</label>
                                        <div class="col-md-7">
                                            <input class="form-control " id="OvilladoNombre" name="OvilladoNombre" data-message="- Campo  Nombre de Ovillado" placeholder="Nombre del Trabajo de Ovillado" type="text" maxlength="50" readonly>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="OvilloTrabajador" class="col-md-5 col-form-label">Trabajador<span class="red">*</span>:</label>
                                        <div class="col-md-7">
                                            <select class="form-control validarPanel" id="OvilloTrabajador" name="OvilloTrabajador" data-message="- Campo Trabajador">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="OvilladoMaterial" class="col-md-5 col-form-label">Material:</label>
                                        <div class="col-md-7">
                                            <input class="form-control validarPanel" id="OvilladoMaterial" name="OvilladoMaterial" data-message="- Campo  Peso de Ovillado" placeholder="Peso de Ovillado" type="text" onkeypress="return SoloNumerosModificado(event,8,this.id);" readonly>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="OvilladoPeso" class="col-md-5 col-form-label">Peso de Ovillo:</label>
                                        <div class="col-md-7">
                                            <input class="form-control validarPanel" id="OvilladoPeso" name="OvilladoPeso" data-message="- Campo  Peso de Ovillado" placeholder="Peso de Ovillado" type="text" onkeypress="return SoloNumerosModificado(event,8,this.id);">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="OvilladoLote" class="col-md-5 col-form-label">Lote de Ovillo:</label>
                                        <div class="col-md-7">
                                            <input class="form-control validarPanel" id="OvilladoLote" name="OvilladoLote" data-message="- Campo  Lote de Ovillado" placeholder="Lote de Ovillado" type="text" maxlength="50">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="OvilladoCantidad" class="col-md-5 col-form-label">Cantidad de Ovillos:</label>
                                        <div class="col-md-7">
                                            <input class="form-control validarPanel" id="OvilladoCantidad" name="OvilladoCantidad" data-message="- Campo  Numero de Ovillado" placeholder="Numero de Ovillado" type="text" onkeypress="return SoloNumerosModificado(event,8,this.id);">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                        <label for="EnconadoNumero" class="  col-form-label">Observaciones Adicionales:</label>
                                        <textarea class="form-control validarPanel" id="OvilladoObservacion" name="OvilladoObservacion"></textarea>

                                </div>

                            </div>
                            <div class="row mr-1 ml-1 mt-3">
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


<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/GestionOvillado.js"></script>
