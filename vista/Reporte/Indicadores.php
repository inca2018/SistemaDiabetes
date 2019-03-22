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

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4 p-2 text-center bb bt br bl fondo3">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb bt br fondo3">
                                <b>Masculino</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb bt br fondo3">
                               <b>Femenino</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br bl fondo1">
                                Total Pacientes
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indMasculino">
                                0
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indFemenino">
                                0
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-4 p-2 text-center bb br bl fondo3">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                                <b>Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                               <b>Inadecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br bl fondo1">
                                Paciente con control de Glicemico
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indPorConHG">
                                 0
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indPorSinHG">
                                 0
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-2 text-center bb br bl fondo3">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                                <b>Con hemoglobina glucosilada</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                               <b>Sin hemoglobina glucosilada</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br bl fondo1">
                                % De Pacientes con/sin hemoglobina
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indConHG">
                                 0
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indSinHG">
                                 0
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-md-4 p-2 text-center bb br bl fondo3">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                                <b>Con Colesterol</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                               <b>Sin Colesterol</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br bl fondo1">
                                Nº de Pacientes con/sin Colesterol
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indConCol">
                                 0
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indSinCol">
                                 0
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-2 text-center bb br bl fondo3">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                                <b>Con HDL-C Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                               <b>Sin HDL-C Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br bl fondo1">
                                Nº de Pacientes con/sin Colesterol HDL-C Adecuado
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indConHDL">
                                 0
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indSinHDL">
                                 0
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-2 text-center bb br bl fondo3">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                                <b>Con LDL-C Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                               <b>Sin LDL-C Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br bl fondo1">
                                Nº de Pacientes con/sin Colesterol LDL-C Adecuado
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indConLDL">
                                 0
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indSinLDL">
                                 0
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-2 text-center bb br bl fondo3">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                                <b>Con IMC Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo3">
                               <b>Sin IMC Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br bl fondo1">
                                Nº de Pacientes con/sin IMC Adecuado
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indConIMC">
                                 0
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo1" id="indSinIMC">
                                 0
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row m-2 justify-content-center">
                    <div class="col-md-12">
                        <h4 class="text-muted m-2">- Indicadores Generales.</h4>

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
