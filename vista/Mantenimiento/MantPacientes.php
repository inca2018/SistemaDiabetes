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
              <div>Mantenimiento Pacientes</div>
            </div> -->
        <!-- START card-->
        <div class="card card-default m-1 ">
            <div class="card-body ">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center ">
                        <h3>Mantenimiento de Paciente:</h3>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="row">
                    <div class="col-md-2 offset-10">
                        <button class="btn btn-success btn-block btn-sm" onclick="NuevoPaciente();"><i class="fa fa-plus fa-lg mr-2"></i> Nueva Paciente</button>
                    </div>
                </div>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista General de Paciente:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaPaciente">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th data-priority="1">#</th>
                                            <th>ESTADO</th>
                                            <th>CODIGO</th>
                                            <th>PACIENTE</th>
                                            <th>DNI</th>
                                            <th>TIPO DE ENFERMEDAD</th>
                                            <th>SEXO</th>
                                            <th>CONDICION</th>
                                            <th>PROCEDENCIA</th>
                                            <th>MEDICO TRATANTE</th>
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

<div class="modal fade " id="ModalPaciente" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalPaciente"></h4>
                </div>
            </div>
            <div class="modal-body ">
                <form id="FormularioPaciente" method="POST" autocomplete="off">
                    <input type="hidden" name="idPaciente" id="idPaciente">
                    <input type="hidden" name="idPersona" id="idPersona">
                    <div class="row mb-3 mt-1">
                        <div class="col-md-3">
                            <label class=""><span class="red">(*) Campos Obligatorios</span></label>
                        </div>
                        <div class="col-md-1 offset-8">
                            <button type="button" class="btn btn-info btn-sm btn-display" title="Limpiar Campos" onclick="LimpiarPaciente();">
                                <i class="fa fa-trash-alt fa-lg "></i>
                            </button>
                        </div>
                    </div>

                    <div class="row" id="cuerpo">
                        <div class="col-md-12 bl">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">Codigo de Paciente:</label>
                                        <input class="form-control" id="PacienteCodigo" name="PacienteCodigo" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">Nombres:</label>
                                        <input class="form-control validarPanel" id="PacienteNombre" name="PacienteNombre" data-message="- Nombre de Paciente" placeholder="Nombre" type="text" onkeypress="return SoloLetras(event,40,this.id);">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">Apellido Paterno:</label>
                                        <input type="text" class="form-control validarPanel" placeholder="Apellido Paterno" name="PacienteApellidoP" id="PacienteApellidoP" data-message="- Apellido Paterno" onkeypress="return SoloLetras(event,40,this.id);">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">Apellido Materno:</label>
                                        <input type="text" class="form-control validarPanel" placeholder="Apellido Materno" name="PacienteApellidoM" id="PacienteApellidoM" data-message="- Apellido Materno" onkeypress="return SoloLetras(event,40,this.id);">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">Fecha de Nacimiento:</label>
                                        <div class="input-group date " id="dateFechaNacimiento">
                                            <input class="form-control validarPanel" type="text" id="PacienteFechaNacimiento" name="PacienteFechaNacimiento" autocomplete="off" data-message="- Fecha de Nacimiento">
                                            <span class="input-group-append input-group-addon">
                                                <span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">DNI:</label>
                                        <input type="number" class="form-control validarPanel" placeholder="Dni" name="PacienteDNI" id="PacienteDNI" data-message="- DNI" onkeypress="return SoloNumerosModificado(event,8,this.id);">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">Telefono:</label>
                                        <input type="number" class="form-control " placeholder="Telefono" name="PacienteTelefono" id="PacienteTelefono" onkeypress="return SoloNumerosModificado(event,9,this.id);">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">Dirección:</label>
                                        <textarea id="PacienteDireccion" name="PacienteDireccion" rows="1" class="form-control">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteNombre" class="col-form-label">Correo:</label>
                                        <input type="email" class="form-control " placeholder="Correo" name="PacienteCorreo" id="PacienteCorreo" maxlength="40">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteEnfermedad" class="col-form-label">Tipo de Enfermedad:</label>
                                        <input type="text" class="form-control validarPanel" placeholder="Tipo de Enfermedad" name="PacienteEnfermedad" id="PacienteEnfermedad" maxlength="100" data-message="- Tipo de Enfermedad">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteDX" class="col-form-label">D.X:</label>
                                         <select class="form-control validarPanel" id="PacienteDX" name="PacienteDX" data-message="- D.X">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteMedico" class="col-form-label">Medico Tratante:</label>
                                        <select class="form-control validarPanel" id="PacienteMedico" name="PacienteMedico" data-message="- Medico Tratante">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteProcedencia" class="col-form-label">Procedencia:</label>
                                        <input type="text" class="form-control validarPanel" placeholder="Procedencia" name="PacienteProcedencia" id="PacienteProcedencia" maxlength="100" data-message="- Procedencia">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteCondicion" class="col-form-label">Condición:</label>
                                        <select class="form-control validarPanel" id="PacienteCondicion" name="PacienteCondicion" data-message="- Condicion">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteSexo" class="col-form-label">Sexo Paciente:</label>
                                        <select class="form-control validarPanel" id="PacienteSexo" name="PacienteSexo" data-message="- Sexo de Paciente">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PacienteSexo" class="col-form-label">Estado:</label>
                                        <select class="form-control validarPanel" id="PacienteEstado" name="PacienteEstado" data-message="- Estado">
                                        </select>
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

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/MantPacientes.js"></script>
