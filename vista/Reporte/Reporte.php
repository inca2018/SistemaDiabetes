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
                <br>
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
                            <div class="col-md-3 col-12">
                                <button type="button" class="btn btn-success col-md-12 my-4" onclick="buscar_reporte()">BUSCAR RESULTADOS</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                   <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-4 p-2 text-center bb bt br bl fondo2">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb bt br fondo2">
                                <b>Masculino</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb bt br fondo2">
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
                            <div class="col-md-4 p-2 text-center bb br bl fondo2">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
                                <b>Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
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
                            <div class="col-md-4 p-2 text-center bb br bl fondo2">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
                                <b>Con hemoglobina glucosilada</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
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
                            <div class="col-md-4 p-2 text-center bb br bl fondo2">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
                                <b>Con Colesterol</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
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
                            <div class="col-md-4 p-2 text-center bb br bl fondo2">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
                                <b>Con HDL-C Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
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
                            <div class="col-md-4 p-2 text-center bb br bl fondo2">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
                                <b>Con LDL-C Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
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
                            <div class="col-md-4 p-2 text-center bb br bl fondo2">
                                <b>Indicador</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
                                <b>Con IMC Adecuado</b>
                            </div>
                            <div class="col-md-4 p-2 text-center bb br fondo2">
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
                <br>
                 <div class="row justify-content-center">
                      <div class="col-md-10">
                       <div class="row">
                             <div class="col-md-12 p-2 text-center bb br fondo2">
                                <b>Talleres</b>
                            </div>
                            <div class="col-md-2 p-2 text-center bb br fondo2">
                                <b>T.Glucometria</b>
                            </div>
                            <div class="col-md-2 p-2 text-center bb br fondo2">
                               <b>T.Nutrición</b>
                            </div>
                            <div class="col-md-2 p-2 text-center bb br bl fondo2">
                                 <b>T.Conocimiento de Diabetes</b>
                            </div>
                              <div class="col-md-2 p-2 text-center bb br bl fondo2">
                                 <b>T.Insulinisación</b>
                            </div>
                              <div class="col-md-2 p-2 text-center bb br bl fondo2">
                                 <b>T.Podologia</b>
                            </div>
                              <div class="col-md-2 p-2 text-center bb br bl fondo2">
                                 <b>T.Psicologia</b>
                            </div>
                            <div class="col-md-2 p-2 text-center bb br fondo1" id="indTaller1">
                                 0
                            </div>
                            <div class="col-md-2 p-2 text-center bb br fondo1" id="indTaller2">
                                 0
                            </div>
                            <div class="col-md-2 p-2 text-center bb br fondo1" id="indTaller3">
                                 0
                            </div>
                            <div class="col-md-2 p-2 text-center bb br fondo1" id="indTaller4">
                                0
                            </div>
                             <div class="col-md-2 p-2 text-center bb br fondo1" id="indTaller5">
                                 0
                            </div>
                            <div class="col-md-2 p-2 text-center bb br fondo1" id="indTaller6">
                                 0
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

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Reporte.js"></script>
