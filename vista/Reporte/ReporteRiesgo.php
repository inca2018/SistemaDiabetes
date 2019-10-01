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
                        <h3>Panel de Reporte General:</h3>
                    </div>
                </div>

                <div class="row  m-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <div class="form-group row">
                                    <label for="inicio1" class="col-md-12 col-form-label"><i class="far fa-calendar-check fa-lg mr-2"></i>Fecha Inicio:</label>
                                    <div class="col-md-12">
                                        <div class=" row">
                                            <div class="input-group date  col-md-12" id="date_inicio1">
                                                <input class="form-control validarPanel" type="text" id="inicio1" name="inicio1" autocomplete="off" data-message="- Fecha de Nacimiento">
                                                <span class="input-group-append input-group-addon">
                                                    <span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group row">
                                    <label for="fin1" class="col-md-12 col-form-label"><i class="far fa-calendar-check fa-lg mr-2"></i>Fecha Fin: </label>
                                    <div class="col-md-12">
                                        <div class=" row">
                                            <div class="input-group date  col-md-12" id="date_fin1">
                                                <input class="form-control validarPanel" type="text" id="fin1" name="fin1" autocomplete="off" data-message="- Fecha de Nacimiento">
                                                <span class="input-group-append input-group-addon">
                                                    <span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="IndicadorSexo" class="col-form-label">Sexo:</label>
                                    <select class="form-control validarPanel" id="IndicadorSexo" name="IndicadorSexo">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12 mt-3">
                                <button type="button" class="btn btn-success col-md-12 my-4" onclick="buscarReporte()">BUSCAR RESULTADOS</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-4" id="NumeroPacientesEncontrados">
                        <h3>N° Pacientes encontrados: 10</h3>
                    </div>
                    <div class="col-md-2" id="panelBotonMostrarPacientes">
                           <button class="btn btn-info btn-sm ml-5" onclick="MostrarPacientesEncontrados()"><i class="fa fa-user fa-2x"></i></button>
                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12 p-2 text-center bb br fondo1">
                                <b>CATEGORIZACIÓN DE RIESGO</b>
                            </div>
                            <div class="col-md-3 p-2 text-center bb br fondo1">
                                <b>PACIENTE BAJO RIESGO</b><br>
                                <b>Todo lo siguiente</b>
                            </div>
                            <div class="col-md-3 p-2 text-center bb br fondo2">
                                <b>MODERADO RIESGO</b><br>
                                <b>Uno o Más de lo siguiente</b>
                            </div>
                            <div class="col-md-3 p-2 text-center bb br fondo3">
                                <b>ALTO RIESGO</b><br>
                                <b>Uno de los siguientes</b>
                            </div>
                            <div class="col-md-3 p-2 text-center bb br bl fondo4">
                                <b>MUY ALTO RIESGO</b><br>
                                <b>Uno de los siguientes</b>
                            </div>

                            <div class="col-md-3 p-2 text-center bb br fondo1" >
                                <div class="col-md-12">
                                    <p>Percibe Monofilamento:</p>
                                </div>
                                <div class="col-md-12" id="opA1">
                                    0
                                </div>
                                <div class="col-md-12">
                                    <p>Ninguna Úlcera previa:</p>
                                </div>
                                <div class="col-md-12" id="opB1">
                                    0
                                </div>
                                <div class="col-md-12">
                                    <p>Ninguna Deformidad severa:</p>
                                </div>
                                <div class="col-md-12" id="opC1">
                                    0
                                </div>
                                 <div class="col-md-12">
                                    <p>Pulsos pedio presentes:</p>
                                </div>
                                <div class="col-md-12" id="opD1">
                                    0
                                </div>
                                 <div class="col-md-12">
                                    <p>Ninguna Amputación:</p>
                                </div>
                                <div class="col-md-12" id="opE1">
                                    0
                                </div>
                            </div>
                            <div class="col-md-3 p-2 text-center bb br fondo1" id="indTaller2">
                               <div class="col-md-12">
                                    <p>No percibe monofilamento:</p>
                                </div>
                                <div class="col-md-12" id="opA2">
                                    0
                                </div>
                                 <div class="col-md-12">
                                    <p>Piel o uñas de riesgo:</p>
                                </div>
                                <div class="col-md-12" id="opB2">
                                    0
                                </div>
                                 <div class="col-md-12">
                                    <p>Pulso tibial de dificil percepción:</p>
                                </div>
                                <div class="col-md-12" id="opC2">
                                    0
                                </div>
                                  <div class="col-md-12">
                                    <p>Una deformidad leve:</p>
                                </div>
                                <div class="col-md-12" id="opD2">
                                    0
                                </div>
                                  <div class="col-md-12">
                                    <p>Formación de callos:</p>
                                </div>
                                <div class="col-md-12" id="opE2">
                                    0
                                </div>
                            </div>
                            <div class="col-md-3 p-2 text-center bb br fondo1" id="indTaller3">
                                <div class="col-md-12">
                                    <p>No percibe diapazon:</p>
                                </div>
                                <div class="col-md-12" id="opA3">
                                    0
                                </div>
                                <div class="col-md-12">
                                    <p>Deformidad severa:</p>
                                </div>
                                <div class="col-md-12" id="opB3">
                                    0
                                </div>
                                 <div class="col-md-12">
                                    <p>Ausencia de Pulso:</p>
                                </div>
                                <div class="col-md-12" id="opC3">
                                    0
                                </div>
                            </div>
                            <div class="col-md-3 p-2 text-center bb br fondo1" id="indTaller4">
                                <div class="col-md-12">
                                    <p>Úlcera activa:</p>
                                </div>
                                <div class="col-md-12" id="opA4">
                                    0
                                </div>
                                 <div class="col-md-12">
                                    <p>Dedo o pie amputado:</p>
                                </div>
                                <div class="col-md-12" id="opB4">
                                    0
                                </div>
                                <div class="col-md-12">
                                    <p>Úlcera Antigua:</p>
                                </div>
                                <div class="col-md-12" id="opC4">
                                    0
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</section>
<!-- Fin Modal Agregar-->
<!-- Fin del Cuerpo del Sistema del Menu-->
<!-- Inicio del footer -->
<?php require_once('../layaout/Footer.php');?>
<!-- Fin del Footer -->

<div class="modal fade " id="ModalPacientesReporte" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row mt-3 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-">Pacientes Encontrados:</h4>
                </div>
            </div>
            <div class="modal-body" id="cuerpo">
                    <input type="hidden" name="idMedico" id="idMedico">
                    <div class="row">
                        <div class="col-12">
                            <div class="container">

                                <div class="row">
                                    <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaPacientes">
                                        <thead class="thead-light text-center">
                                            <tr>
                                                <th data-priority="1">#</th>
                                                <th>CODIGO</th>
                                                <th>PACIENTE</th>
                                                <th>DNI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cuerpoElementos">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/ReporteRiesgo.js"></script>
