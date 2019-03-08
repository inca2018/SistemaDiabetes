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

                <div class="row ">
                    <div class="col-md-4 col-12 ">
                        <!-- SELECT2-->
                        <div class="form-group">
                            <label>Seleccione Año:</label>
                            <select class="form-control" id="select_ano" name="select_ano" required>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 ">
                        <!-- SELECT2-->
                        <div class="form-group">
                            <label>Seleccione Mes:</label>
                            <select class="form-control" id="select_mes" name="select_mes" required>
                                <option value="">-- SELECCIONAR --</option>
                                <option value="1">ENERO</option>
                                <option value="2">FEBRERO</option>
                                <option value="3">MARZO</option>
                                <option value="4">ABRIL</option>
                                <option value="5">MAYO</option>
                                <option value="6">JUNIO</option>
                                <option value="7">JULIO</option>
                                <option value="8">AGOSTO</option>
                                <option value="9">SEPTIEMBRE</option>
                                <option value="10">OCTUBRE</option>
                                <option value="11">NOVIEMBRE</option>
                                <option value="12">DICIEMBRE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label> </label>
                        <button type="button" class="btn btn-success col-md-12 mt-2 " onclick="buscar_reporte()">BUSCAR RESULTADOS</button>
                    </div>

                </div>
                <div class="row m-4">
                    <div class="col-xl-3">
                        <!-- START card-->
                        <div class="card border-0 sombra3">
                            <div class="row row-flush">
                                <div class="col-4 bg-info-dark text-center d-flex align-items-center justify-content-center rounded-left">
                                    <em class="fas fa-file-invoice-dollar fa-2x"></em>
                                </div>
                                <div class="col-8">
                                    <div class="card-body text-center p-1">
                                        <h4 class="text-center text-info" id="total1"><b>0</b></h4>
                                        <p class="mb-0 text-muted">Total de Pacientes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END card-->
                    </div>
                    <div class="col-xl-3">
                        <!-- START card-->
                        <div class="card border-0  sombra3">
                            <div class="row row-flush">
                                <div class="col-4 bg-warning-dark text-center d-flex align-items-center justify-content-center rounded-left">
                                    <em class="fas fa-user-md fa-2x"></em>
                                </div>
                                <div class="col-8">
                                    <div class="card-body text-center p-1">
                                        <h4 class="text-center text-warning" id="total2"><b>0</b></h4>
                                        <p class="mb-0 text-muted">Total de Medicos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END card-->
                    </div>
                    <div class="col-xl-3">
                        <!-- START card-->
                        <div class="card border-0 sombra3 ">
                            <div class="row row-flush">
                                <div class="col-4 bg-success-dark text-center d-flex align-items-center justify-content-center rounded-left">
                                    <em class="fas fa-notes-medical fa-2x"></em>

                                </div>
                                <div class="col-8">
                                    <div class="card-body text-center p-1">
                                        <h4 class="text-center text-success" id="total3"><b>0</b></h4>
                                        <p class="mb-0 text-muted">Total de Fichas </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END card-->
                    </div>
                    <div class="col-xl-3">
                        <!-- START card-->
                        <div class="card border-0 sombra3 ">
                            <div class="row row-flush">
                                <div class="col-4 bg-success-dark text-center d-flex align-items-center justify-content-center rounded-left">
                                    <em class="fas fa-file-medical fa-2x"></em>
                                </div>
                                <div class="col-8">
                                    <div class="card-body text-center p-1">
                                        <h4 class="text-center text-success" id="total4"><b>0</b></h4>
                                        <p class="mb-0 text-muted">Total de Fichas del Año</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END card-->
                    </div>

                </div>


                <div class="row m-2 justify-content-center">
                    <div class="col-md-12">
                        <h4 class="text-muted m-2">- Indicadores Generales.</h4>
                        <table class="table   table-hover table-sm dt-responsive " id="datatable_reporte">
                            <thead class="thead">
                                <tr>
                                    <th class="text-left">Sexo:</th>
                                    <th class="text-center">Masculino</th>
                                    <th class="text-center">Femenino</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-left">Total Pacientes:</th>
                                    <th class="text-center" id="indMasculino">0</th>
                                    <th class="text-center" id="indFemenino">0</th>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table  table-hover table-sm dt-responsive " id="datatable_reporte">
                            <thead class="thead">
                                <tr>
                                    <th class="text-left">Indicador:</th>
                                    <th class="text-center">GLICEMICO ADECUADO</th>
                                    <th class="text-center">GLICEMICO DESADEACUADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-left">PACIENTE CON CONTROL DE GLICEMICO ADECUADO O DESADECUADO:</th>
                                    <th class="text-center" id="indPorConHG">0</th>
                                    <th class="text-center" id="indPorSinHG">0</th>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table  table-hover table-sm dt-responsive " id="datatable_reporte">
                            <thead class="thead">
                                <tr>
                                    <th class="text-left">Indicador:</th>
                                    <th class="text-center">CON HEMOGLOBINA GLUCOSILADA</th>
                                    <th class="text-center">SIN HEMOGLOBINA GLUCOSILADA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-left">% DE PACIENTES CON/SIN HEMOGLOBINA:</th>
                                    <th class="text-center" id="indConHG">0</th>
                                    <th class="text-center" id="indSinHG">0</th>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table  table-hover table-sm dt-responsive " id="datatable_reporte">
                            <thead class="thead">
                                <tr>
                                    <th class="text-left">Indicador:</th>
                                    <th class="text-center">CON COLESTEROL</th>
                                    <th class="text-center">SIN COLESTEROL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-left">NUMERO DE PACIENTES CON/SIN COLESTEROL TOTAL ADECUADO:</th>
                                    <th class="text-center" id="indConCol">0</th>
                                    <th class="text-center" id="indSinCol">0</th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table  table-hover table-sm dt-responsive " id="datatable_reporte">
                            <thead class="thead">
                                <tr>
                                    <th class="text-left">Indicador:</th>
                                    <th class="text-center">CON HDL-c ADECUADO</th>
                                    <th class="text-center">SIN HDL-c ADECUADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-left">NUMERO DE PACIENTES CON/SIN COLESTEROL HDL-c ADECUADO:</th>
                                    <th class="text-center" id="indConHDL">0</th>
                                    <th class="text-center" id="indSinHDL">0</th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table  table-hover table-sm dt-responsive " id="datatable_reporte">
                            <thead class="thead">
                                <tr>
                                    <th class="text-left">Indicador:</th>
                                    <th class="text-center">CON LDL-c ADECUADO</th>
                                    <th class="text-center">SIN LDL-c ADECUADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-left">NUMERO DE PACIENTES CON/SIN COLESTEROL LDL-c ADECUADO:</th>
                                    <th class="text-center" id="indConLDL">0</th>
                                    <th class="text-center" id="indSinLDL">0</th>
                                </tr>
                            </tbody>
                        </table>
                         <table class="table  table-hover table-sm dt-responsive " id="datatable_reporte">
                            <thead class="thead">
                                <tr>
                                    <th class="text-left">Indicador:</th>
                                    <th class="text-center">CON IMC ADECUADO</th>
                                    <th class="text-center">SIN IMC ADECUADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-left">NUMERO DE PACIENTES CON/SIN IMC ADECUADO:</th>
                                    <th class="text-center" id="indConIMC">0</th>
                                    <th class="text-center" id="indSinIMC">0</th>
                                </tr>
                            </tbody>
                        </table>
                         <table class="table  table-hover table-sm dt-responsive " id="datatable_reporte">
                            <thead class="thead">
                                <tr>
                                    <th class="text-left">Indicador:</th>
                                    <th class="text-center">T. GLUCOMETRIA</th>
                                    <th class="text-center">T. NUTRICIÓN</th>
                                    <th class="text-center">T. CONOCIMIENTO DE DIABETES</th>
                                    <th class="text-center">T. INSULINISACIÓN</th>
                                    <th class="text-center">T. PODOLOGIA</th>
                                     <th class="text-center">T. PSICOLOGÍA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-left"> NUMERO DE PACIENTES DE CADA TALLER (VARIOS E INDIVIDUAL):</th>
                                    <th class="text-center" id="indTaller1">0</th>
                                    <th class="text-center" id="indTaller2">0</th>
                                    <th class="text-center" id="indTaller3">0</th>
                                    <th class="text-center" id="indTaller4">0</th>
                                    <th class="text-center" id="indTaller5">0</th>
                                    <th class="text-center" id="indTaller6">0</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <hr>
                <div class="row m-2">
                   <h4 class="text-muted ">- Pacientes del Programa de Diabetes según Condición.</h4>
                    <div class="col-md-12">
                        <table class="table   table-hover table-sm dt-responsive nowrap" id="datatable_reporte">
                            <thead class="thead">
                                <tr id="cabeceraCondicion">
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="cuerpoCondicion">
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row m-2">
                    <h4 class="text-muted ">- Pacientes del Programa de Diabetes según Tipo de Diabetes.</h4>
                    <div class="col-md-12">
                        <table class="table   table-hover table-sm dt-responsive nowrap" id="datatable_reporte">
                            <thead class="thead">
                                <tr id="cabeceraDiagnostico">
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="cuerpoDiagnostico">
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row m-2">
                    <h4 class="text-muted ">- Pacientes del Programa de Diabetes según Grado de Instrucción.</h4>
                    <div class="col-md-12">
                        <table class="table   table-hover table-sm dt-responsive nowrap" id="datatable_reporte">
                            <thead class="thead">
                                <tr id="cabeceraGradoInstruccion">
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="cuerpoGradoInstruccion">
                                </tr>
                            </tbody>
                        </table>
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

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Indicadores.js"></script>
