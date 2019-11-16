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
              <div>Mantenimiento Medicos</div>
            </div> -->
        <!-- START card-->
        <div class="card card-default m-1 ">
            <div class="card-body ">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center ">
                        <h3>Mantenimiento de Medicos:</h3>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="row">
                    <div class="col-md-2 offset-10">
                        <button class="btn btn-success btn-block btn-sm" onclick="NuevoMedico();"><i class="fa fa-plus fa-lg mr-2"></i> Nuevo Medico</button>
                    </div>
                </div>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista General de Medicos:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaMedico">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th data-priority="1">#</th>
                                            <th>ESTADO</th>
                                            <th>NOMBRES Y APELLIDOS</th>
                                            <th>EDAD</th>
                                            <th>DNI</th>
                                            <th>TELEFONO/CELULAR</th>
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

<div class="modal fade " id="ModalMedico" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="row mt-3 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalMedico"></h4>
                </div>
            </div>
            <div class="modal-body" id="cuerpo">
                <form id="FormularioMedico" method="POST" autocomplete="off">
                    <input type="hidden" name="idMedico" id="idMedico">
                    <div class="row mb-3 mt-1">
                         <div class="col-md-3">
                             <label class=""><span class="red">(*) Campos Obligatorios</span></label>
                         </div>
                         <div class="col-md-1 offset-8">
                              <button type="button" class="btn btn-info btn-sm btn-display" title="Limpiar Campos" onclick="LimpiarMedico();">
                              <i class="fa fa-trash-alt fa-lg "></i>
                              </button>
                         </div>
                     </div>
                    <div class="row">
                        <div class="col-12">
                            <div role="tabpanel">
                                <ul class="nav nav-pills " role="tablist">
                                    <li class="nav-item pill-1 m-2 " role="presentation"><a class="nav-link active" href="#op_1" aria-controls="home" role="tab" data-toggle="tab">Datos del Medico</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="op_1" role="tabpanel">
                                    <div class="container">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="MedicoNombre" class="col-form-label">Nombres:</label>
                                                    <input class="form-control validarPanel" id="MedicoNombre" name="MedicoNombre" data-message="- Nombre de Medico" placeholder="Nombre" type="text" onkeypress="return SoloLetras(event,40,this.id);">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="MedicoNombre" class="col-form-label">Apellido Paterno:</label>
                                                    <input type="text" class="form-control validarPanel" placeholder="Apellido Paterno" name="MedicoApellidoP" id="MedicoApellidoP" data-message="- Apellido Paterno" onkeypress="return SoloLetras(event,40,this.id);">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="MedicoNombre" class="col-form-label">Apellido Materno:</label>
                                                    <input type="text" class="form-control validarPanel" placeholder="Apellido Materno" name="MedicoApellidoM" id="MedicoApellidoM" data-message="- Apellido Materno" onkeypress="return SoloLetras(event,40,this.id);">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="MedicoNombre" class="col-form-label">Fecha de Nacimiento:</label>
                                                    <div class="input-group date " id="dateFechaNacimiento">
                                                        <input class="form-control validarPanel" type="text" id="MedicoFechaNacimiento" name="MedicoFechaNacimiento" autocomplete="off" data-message="- Fecha de Nacimiento">
                                                        <span class="input-group-append input-group-addon">
                                                            <span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="MedicoNombre" class="col-form-label">Edad:</label>
                                                    <input type="number" class="form-control" placeholder="0" name="Edad" id="Edad" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="MedicoDNI" class="col-form-label">DNI:</label>
                                                    <input type="number" class="form-control validarPanel" placeholder="Numero de DNI" name="MedicoDNI" id="MedicoDNI" data-message="- Numero de DNI" onkeypress="return SoloNumerosModificado(event,8,this.id);">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="MedicoSexo" class="col-form-label">Sexo:</label>
                                                    <select class="form-control validarPanel" id="MedicoSexo" name="MedicoSexo" data-message="- Sexo de Medico">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="MedicoNombre" class="col-form-label">Telefono:</label>
                                                    <input type="number" class="form-control " placeholder="Telefono" name="MedicoTelefono" id="MedicoTelefono" onkeypress="return SoloNumerosModificado(event,9,this.id);">
                                                </div>
                                            </div>
                                             <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="MedicoCelular" class="col-form-label">Celular:</label>
                                                    <input type="number" class="form-control " placeholder="Celular" name="MedicoCelular" id="MedicoCelular" onkeypress="return SoloNumerosModificado(event,9,this.id);">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="MedicoNombre" class="col-form-label">Correo:</label>
                                                    <input type="email" class="form-control " placeholder="Correo" name="MedicoCorreo" id="MedicoCorreo" maxlength="40">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row m-3">
                        <button type="submit" class="col-md-2 btn btn-success btn-sm" title="Guardar"><i class="fa fa-save fa-lg mr-2"></i>GUARDAR
                        </button>
                        <button type="button" class="col-md-2 btn btn-danger btn-sm  offset-8" title="Cancelar" onclick="Cancelar();"><i class="fa fa-times fa-lg mr-2"></i>CANCELAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/MantMedico.js"></script>
