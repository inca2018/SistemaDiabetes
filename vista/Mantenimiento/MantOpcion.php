<?php

if(isset($_POST["idGrupoOpcion"])){

}else{
    header('Location: ../../vista/Mantenimiento/MantOpcion.php');
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
              <div>Mantenimiento Opcions</div>
            </div> -->
        <!-- START card-->
        <input type="hidden" id="idGrupoOpcion" value="<?php echo $_POST["idGrupoOpcion"]; ?>">
        <div class="card card-default m-1 ">
            <div class="card-body ">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center">
                        <h3>Mantenimiento de Opciones:</h3>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="row">
                    <div class="col-md-2">
                        <button class="btn btn-info btn-block btn-sm mt-3 " onclick="volver();"><i class="fas fa-chevron-left mr-2"></i>Grupo de Opciones</button>
                    </div>
                    <div class="col-md-8 text-center">
                        <label>Grupo de Opción:</label>
                        <h3 id="TituloGrupoOpcion"></h3>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btn-block btn-sm" onclick="NuevoOpcion();"><i class="fa fa-plus fa-lg mr-2"></i> Nueva Opción</button>
                    </div>
                </div>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista General Grupo de Opciones:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaOpcion">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th data-priority="1">#</th>
                                            <th>ESTADO</th>
                                            <th>TIPO DE OPCIÓN</th>
                                            <th>TITULO DE OPCIÓN</th>
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

<div class="modal fade " id="ModalOpcion" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalOpcion"></h4>
                </div>
            </div>
            <div class="modal-body ">
                <form id="FormularioOpcion" method="POST" autocomplete="off">
                    <input type="hidden" name="idOpcion" id="idOpcion">
                    <div class="row" id="cuerpo">
                        <div class="col-md-12 bl">
                            <div class="row">
                                <div class="col-md-4" id="ElementoTipo">
                                    <div class="form-group">
                                        <label for="OpcionTipo" class="col-form-label">Tipo de Opción:</label>
                                        <select class="form-control  " id="OpcionTipo" name="OpcionTipo" data-message="- Tipo de Opción">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" id="ElementoTitulo">
                                    <div class="form-group">
                                        <label for="OpcionTitulo" class="col-form-label">Titulo:</label>
                                        <input class="form-control  " id="OpcionTitulo" name="OpcionTitulo" data-message="- Titulo Opción" placeholder="Titulo" type="text" onkeypress="return SoloLetras(event,150,this.id);">
                                    </div>
                                </div>
                                <div class="col-md-12" id="ElementoRango">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionAtributo" class="col-form-label">Atributo:</label>
                                                <input class="form-control  " id="OpcionAtributo" name="OpcionAtributo" data-message="- Atributo" placeholder="Kg." maxlength="6" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionMinimo" class="col-form-label">Mínimo(valor minimo 1):</label>
                                                <input class="form-control  " id="OpcionMinimo" name="OpcionMinimo" data-message="- Mínimo de Rango" placeholder="0" maxlength="6" type="text" onkeypress="return SoloNumerosModificado(event,4,this.id);">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionMaximo" class="col-form-label">Máximo(valor maximo 9999):</label>
                                                <input class="form-control  " id="OpcionMaximo" name="OpcionMaximo" data-message="- Máximo de Rango" placeholder="0" maxlength="6" type="text" onkeypress="return SoloNumerosModificado(event,4,this.id);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="ElementoRangoSexo">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="col-form-label">SEXO:</label>
                                                <h4>HOMBRE</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionAtributoHombre" class="col-form-label">Atributo:</label>
                                                <input class="form-control" id="OpcionAtributoHombre" name="OpcionAtributoHombre" data-message="- Atributo (Hombre)" placeholder="Kg." maxlength="6" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionMinimoHombre" class="col-form-label">Mínimo(valor minimo 1):</label>
                                                <input class="form-control  " id="OpcionMinimoHombre" name="OpcionMinimoHombre" data-message="- Mínimo de Rango (Hombre)" placeholder="0" maxlength="6" type="text" onkeypress="return SoloNumerosModificado(event,4,this.id);">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionMaximoHombre" class="col-form-label">Máximo(valor maximo 9999):</label>
                                                <input class="form-control  " id="OpcionMaximoHombre" name="OpcionMaximoHombre" data-message="- Máximo de Rango (Hombre)" placeholder="0" maxlength="6" type="text" onkeypress="return SoloNumerosModificado(event,4,this.id);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="col-form-label">SEXO:</label>
                                                <h4>MUJER</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionAtributoMujer" class="col-form-label">Atributo:</label>
                                                <input class="form-control" id="OpcionAtributoMujer" name="OpcionAtributoMujer" data-message="- Atributo (Mujer)" placeholder="Kg." maxlength="6" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionMinimoMujer" class="col-form-label">Mínimo(valor minimo 1):</label>
                                                <input class="form-control  " id="OpcionMinimoMujer" name="OpcionMinimoMujer" data-message="- Mínimo de Rango (Mujer)" placeholder="0" maxlength="6" type="text" onkeypress="return SoloNumerosModificado(event,4,this.id);">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcionMaximoMujer" class="col-form-label">Máximo(valor maximo 9999):</label>
                                                <input class="form-control  " id="OpcionMaximoMujer" name="OpcionMaximoMujer" data-message="- Máximo de Rango (Mujer)" placeholder="0" maxlength="6" type="text" onkeypress="return SoloNumerosModificado(event,4,this.id);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="ElementoFormula">
                                    <label for="" class="text-info">Ingrese Campos</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcioneCampo1" class="col-form-label">Campo N° 1 (V1):</label>
                                                <input class="form-control" id="OpcioneCampo1" name="OpcioneCampo1" data-message="- Campo N° 1" placeholder="" maxlength="50" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcioneCampo2" class="col-form-label">Campo N° 2 (V2):</label>
                                                <input class="form-control" id="OpcioneCampo2" name="OpcioneCampo2" data-message="- Campo N° 2" placeholder="" maxlength="50" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcioneCampo3" class="col-form-label">Campo N° 3 (V3):</label>
                                                <input class="form-control" id="OpcioneCampo3" name="OpcioneCampo3" data-message="- Campo N° 3" placeholder="" maxlength="50" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OpcioneCampo4" class="col-form-label">Campo N° 4 (V4):</label>
                                                <input class="form-control" id="OpcioneCampo4" name="OpcioneCampo4" data-message="- Campo N° 4" placeholder="" maxlength="50" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <label for="" class="text-info">Seleccione Operacion:</label>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <button type="button" class="OpcionBoton btn btn-info text-center" title="Suma" onclick="Agregar(1)">+</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="OpcionBoton btn btn-info text-center" title="Resta" onclick="Agregar(2)">-</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="OpcionBoton btn btn-info text-center" title="Multiplicación" onclick="Agregar(3)">*</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="OpcionBoton btn btn-info text-center" title="División" onclick="Agregar(4)">%</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="OpcionBoton btn btn-info text-center" title="Inicio Parentesís" onclick="Agregar(5)">(</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="OpcionBoton btn btn-info text-center" title="Fin Parentesís" onclick="Agregar(6)">)</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="OpcionBoton btn btn-info text-center" title="Exponente" onclick="Agregar(7)">X<sup>2</sup></button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" id="botonV1" class="OpcionBoton btn btn-success text-center" disabled title="Variable 1" onclick="Agregar(8)">V1</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" id="botonV2" class="OpcionBoton btn btn-success text-center" disabled title="Variable 2" onclick="Agregar(9)">V2</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" id="botonV3" class="OpcionBoton btn btn-success text-center" disabled title="Variable 3" onclick="Agregar(10)">V3</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" id="botonV4" class="OpcionBoton btn btn-success text-center" disabled title="Variable 4" onclick="Agregar(11)">V4</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="OpcionBoton btn btn-danger text-center" title="Borrar" onclick="BorrarOperacion(12)"><i class="fa fa-trash fa-sm"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <label for="" class="text-info">Operación:</label>
                                    <div class="row">
                                        <div class="col-10 offset-2">
                                            <div class="row text-center" id="area_formula">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12" id="ElementoCondicionCampo">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="OpcionTipoCampo" class="col-form-label">Tipo de Campo:</label>
                                                <select class="form-control  " id="OpcionTipoCampo" name="OpcionTipoCampo" data-message="- Tipo de Opción">
                                                <option value="0">--SELECCIONAR--</option>
                                                <option value="1">LISTA MEDICOS</option>
                                                <option value="2">LISTA DE COMORBILIDAD(OTRAS PATOLOGIAS)</option>
                                                <option value="3">CAMPOS DE TRATAMIENTO</option>
                                                <option value="4">EVALUADO POR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mr-1 ml-1">
                                <button type="button" class="col-md-2 btn btn-success btn-sm" title="Guardar" onclick="VerificarOpcion();">
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


<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/MantOpcion.js"></script>
