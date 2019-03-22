<?php

if(isset($_POST["idPaciente"])){

}else{
    header('Location: ../../vista/Operaciones/GestionPacientes.php');
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
        <input type="hidden" id="idPaciente" value="<?php echo $_POST["idPaciente"] ;?>">
        <div class="card card-default">
            <div class="card-body">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-12 w-100 text-center ">
                            <h3>Registro de Ficha de control (Mensual):</h3>
                        </div>
                    </div>
                    <h5 class="mt-3 mb-3 titulo_area"><em><b>Información de Paciente:</b></em></h5>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <label>Paciente:</label>
                            <h4 id="NombrePaciente"></h4>
                        </div>
                        <div class="col-md-4 text-center">
                            <label>Edad:</label>
                            <h4 id="EdadPaciente"></h4>
                        </div>
                        <div class="col-md-4 text-center">
                            <label>Numero de Documento:</label>
                            <h4 id="DocumentoPaciente"></h4>
                        </div>
                    </div>
                    <hr>
                    <label>Procedimientos:</label>
                    <p>1.- Seleccione el Mes en el que desea registrar Informacion de control.</p>
                    <div class="row">
                        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $_POST['idPaciente']?>">
                        <div class="col-md-2 col-12 ">
                            <!-- SELECT2-->
                            <div class="form-group">
                                <label>Seleccione Año:</label>
                                <select class="form-control" id="select_ano" name="select_ano" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 ">
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
                        <div class="col-md-6 col-2">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="w-50 bb br px-3">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <em class="fas fa-notes-medical fa-2x text-green"></em>
                                                <div class="ml-auto">
                                                    <div class="card-body text-right">
                                                        <h4 class="mt-0" id="totalFicha">0</h4>
                                                        <p class="mb-0 text-muted">N° de Fichas</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-50 bb  px-3">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <em class="fas fa-notes-medical fa-2x text-info"></em>
                                                <div class="ml-auto">
                                                    <div class="card-body text-right">

                                                            <h4 class="mt-0  mr-3" id="porcFicha">0.00 %</h4>
                                                            <p class="mb-0 text-muted">Porcentaje</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 d-flex justify-content-center align-self-center mt-3 ">
                            <button class="btn btn-success  btn-block" type="button" onclick="agregar_seguimiento()">NUEVA FICHA</button>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table my-4 w-100 table-hover table-sm dt-responsive nowrap" id="datatable_seguimiento" style="width:100%;font-size:12px">
                                        <thead class="thead-light">
                                            <tr>
                                                <th data-priority="1">#</th>

                                                <th>CODIGO DE SEGUIMIENTO</th>
                                                <th>AÑO</th>
                                                <th>MES</th>
                                                <th>FECHA EVALUACION</th>
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
    </div>
</section>
<!-- Fin Modal Agregar-->
<!-- Fin del Cuerpo del Sistema del Menu-->
<!-- Inicio del footer -->
<?php require_once('../layaout/Footer.php');?>


<div class="modal fade" id="modal_seguimiento" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabelLarge">Resultado de Ficha:</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="limpiar_modal();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div id="accordion_info">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="limpiar_modal();">Cerrar</button>
                </div>

            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="modal_pie" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabelLarge">Resultado de Exámen de Pie:</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="limpiar_modal();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="info_pie">
                            <div class="card border-primary mb-1">
                                <div class="card-header text-white bg-primary" id="headingTwo">
                                    <h4 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" href="">EXAMEN DE PIE</a>
                                    </h4>
                                </div>
                                <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body border-top">
                                        <div class="row">
                                            <div class="col-md-9 offset-3 padre">
                                                <div class="ImagenPie">
                                                    <div class="OpcionPie1" id="OpcionPieN1">
                                                        <div class="opciones Option" data-opcion="1" id="PIE1">
                                                        </div>
                                                    </div>
                                                    <div class="OpcionPie2" id="OpcionPieN2">
                                                        <div class="opciones Option" data-opcion="1" id="PIE2">
                                                        </div>
                                                    </div>
                                                    <div class="OpcionPie3" id="OpcionPieN3">
                                                        <div class="opciones Option" data-opcion="1" id="PIE3">
                                                        </div>
                                                    </div>
                                                    <div class="OpcionPie4" id="OpcionPieN4">
                                                        <div class="opciones Option" data-opcion="1" id="PIE4">
                                                        </div>
                                                    </div>
                                                    <div class="OpcionPie5" id="OpcionPieN5">
                                                        <div class="opciones Option" data-opcion="1" id="PIE5">

                                                        </div>
                                                    </div>
                                                    <div class="OpcionPie6" id="OpcionPieN6">
                                                        <div class="opciones Option" data-opcion="1" id="PIE6">
                                                        </div>
                                                    </div>
                                                    <div class="OpcionPie7" id="OpcionPieN7">
                                                        <div class="opciones Option" data-opcion="1" id="PIE7">
                                                        </div>
                                                    </div>
                                                    <div class="OpcionPie8" id="OpcionPieN8">
                                                        <div class="opciones Option" data-opcion="1" id="PIE8">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="limpiar_modal();">Cerrar</button>
                </div>

            </div>


        </div>
    </div>
</div>

<!-- Fin del Footer -->
<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/GestionFicha.js"></script>
