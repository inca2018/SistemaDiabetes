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
                        <button class="btn btn-success btn-block btn-sm" onclick="NuevoPaciente();"><i class="fa fa-plus fa-lg mr-2"></i> Nuevo Paciente</button>
                    </div>
                </div>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista General de Pacientes:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaPaciente">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th class="text-center" data-priority="1">#</th>
                                            <th class="text-center">ESTADO</th>
                                            <th class="text-center">CODIGO</th>
                                            <th class="text-center">PACIENTE</th>
                                            <th class="text-center">EDAD</th>
                                            <th class="text-center">DOCUMENTO</th>
                                            <th class="text-center">NUMERO DOC.</th>
                                            <th class="text-center">CONDICION</th>
                                            <th class="text-center">PROCEDENCIA</th>
                                            <th class="text-center">ACCIONES</th>
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
            <div class="row mt-3 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalPaciente"></h4>
                </div>
            </div>
            <div class="modal-body" id="cuerpo">
                <form id="FormularioPaciente" method="POST" autocomplete="off">
                    <input type="hidden" name="idPaciente" id="idPaciente">
                     <input type="hidden" id="PacienteCodigo" name="PacienteCodigo">
                    <div class="row">
                        <div class="col-12">
                            <div role="tabpanel">
                                <ul class="nav nav-pills " role="tablist">
                                    <li class="nav-item pill-1 m-2 " role="presentation"><a id="nav-base" class="nav-link active" href="#op_1" aria-controls="home" role="tab" data-toggle="tab">Datos del Paciente</a>
                                    </li>
                                    <li class="nav-item pill-2 m-2" role="presentation"><a id="nav-second" class="nav-link" href="#op_2" aria-controls="profile" role="tab" data-toggle="tab">Datos Adicionales</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="op_1" role="tabpanel">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="PacienteNombre" class="col-form-label">Codigo de Paciente:</label>
                                                    <h3 id="codigoMostrar" name="codigoMostrar" class="text-danger"></h3>

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
                                            <div class="col-md-3">
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
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="PacienteNombre" class="col-form-label">Edad:</label>
                                                    <input type="number" class="form-control" placeholder="0" name="Edad" id="Edad" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="PacienteTipoDocumento" class="col-form-label">Documento:</label>
                                                    <select class="form-control  " id="PacienteTipoDocumento" name="PacienteTipoDocumento" data-message="- Tipo de Documento">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="PacienteNumeroDocumento" class="col-form-label">Numero Documento:</label>
                                                    <input type="number" class="form-control  " placeholder="Numero de Documento" name="PacienteNumeroDocumento" id="PacienteNumeroDocumento" data-message="- Numero de Documento" onkeypress="return SoloNumerosModificado(event,8,this.id);">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="PacienteSexo" class="col-form-label">Sexo:</label>
                                                    <select class="form-control validarPanel" id="PacienteSexo" name="PacienteSexo" data-message="- Sexo de Paciente">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="PacienteNombre" class="col-form-label">Telefono:</label>
                                                    <input type="number" class="form-control " placeholder="Telefono" name="PacienteTelefono" id="PacienteTelefono" onkeypress="return SoloNumerosModificado(event,9,this.id);">
                                                </div>
                                            </div>
                                             <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="PacienteCelular" class="col-form-label">Celular:</label>
                                                    <input type="number" class="form-control " placeholder="Celular" name="PacienteCelular" id="PacienteCelular" onkeypress="return SoloNumerosModificado(event,9,this.id);">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="PacienteNombre" class="col-form-label">Correo:</label>
                                                    <input type="email" class="form-control " placeholder="Correo" name="PacienteCorreo" id="PacienteCorreo" maxlength="40">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="PacienteNombre" class="col-form-label">Dirección:</label>
                                                    <textarea id="PacienteDireccion" name="PacienteDireccion" rows="1" class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="op_2" role="tabpanel">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="PacienteCantidadMedida" class="col-form-label">Tiempo de Enfermedad:</label>
                                                    <input type="text" class="form-control " name="PacienteCantidadMedida" id="PacienteCantidadMedida" maxlength="100" data-message="- Cantidad de Medida" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="PacienteTipoMedida" class="col-form-label">Tipo de Medida:</label>
                                                    <select class="form-control " id="PacienteTipoMedida" name="PacienteTipoMedida" data-message="- Tipo de Medida">
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
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
                                                    <select class="form-control " id="PacienteMedico" name="PacienteMedico" data-message="- Medico Tratante">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="PacienteProcedencia" class="col-form-label">Departamento:</label>
                                                    <select class="form-control " id="PacienteDepartamento" name="PacienteDepartamento" data-message="- Procedencia">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="PacienteProcedencia" class="col-form-label">Provincia:</label>
                                                    <select class="form-control " id="PacienteProvincia" name="PacienteProvincia" data-message="- Procedencia">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="PacienteProcedencia" class="col-form-label">Distrito:</label>
                                                    <select class="form-control " id="PacienteDistrito" name="PacienteDistrito" data-message="- Procedencia">
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="PacienteGrado" class="col-form-label">Grado de Instrucción:</label>
                                                    <select class="form-control " id="PacienteGrado" name="PacienteGrado" data-message="- Condicion">
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="PacienteTitulo" class="col-form-label">Titulo actual/grado actual:</label>
                                                    <input type="text" class="form-control  " placeholder="Titulo/Grado" name="PacienteTitulo" id="PacienteTitulo" data-message="- Titulo">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="PacienteCondicion" class="col-form-label">Condición:</label>
                                                    <select class="form-control validarPanel" id="PacienteCondicion" name="PacienteCondicion" data-message="- Condicion">
                                                    </select>
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

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/MantPacientes.js"></script>
