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
        <div class="card">

            <div class="card-body">


                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center bl br bt bb fondo2">
                                <b>Pacientes del Programa de Diabetes según Condición</b>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 br bl bb fondo2 letra-18" id="cabeceraCondicion">

                            </div>
                            <div class="col-md-6 br bb fondo1 letra-18" id="cuerpoCondicion">

                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center bl br bt bb fondo2">
                                <b>Pacientes del Programa de Diabetes según Tipo de Diabetes</b>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 br bl bb fondo2 letra-18" id="cabeceraDiagnostico">

                            </div>
                            <div class="col-md-6 br bb fondo1 letra-18" id="cuerpoDiagnostico">

                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center bl br bt bb fondo2">
                                <b>Pacientes del Programa de Diabetes según Grado de Instrucción</b>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 br bl bb fondo2 letra-18" id="cabeceraGradoInstruccion">

                            </div>
                            <div class="col-md-6 br bb fondo1 letra-18" id="cuerpoGradoInstruccion">

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


<div class="modal fade " id="ModalReporte" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
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
                    <div class="row">
                        <div class="col-12">

                                    <div class="container">

                                        <div class="row">
                                            <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaPacientes">
                                                <thead class="thead-light text-center">
                                                    <tr>
                                                        <th data-priority="1">#</th>
                                                        <th>PACIENTE</th>
                                                        <th>EDAD</th>
                                                        <th id="atributo">ATRIBUTO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Indicadores.js"></script>
