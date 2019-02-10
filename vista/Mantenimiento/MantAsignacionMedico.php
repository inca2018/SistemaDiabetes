<?php

if(isset($_POST["idEspecialidad"])){

}else{
    header('Location: ../../vista/Mantenimiento/MantEspecialidad.php');
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
              <div>Mantenimiento AsignacionMedicos</div>
            </div> -->
        <!-- START card-->
        <input type="hidden" id="idEspecialidad" value="<?php echo $_POST["idEspecialidad"];?>">

        <div class="card card-default m-1 ">
            <div class="card-body ">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center ">
                        <h3>Asignación de Especialidad:</h3>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="row">
                    <div class="col-md-2">
                        <button class="btn btn-info btn-block btn-sm mt-3 " onclick="volver();"><i class="fas fa-chevron-left mr-2"></i> Especialidades</button>
                    </div>
                    <div class="col-md-8 text-center">
                            <label>Especialidad:</label>
                            <h3 id="TituloEspecialidad"></h3>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btn-block btn-sm mt-3" onclick="NuevoAsignacionMedico();"><i class="fa fa-plus fa-lg mr-2"></i> Nueva Asignación</button>
                    </div>
                </div>
                <hr>
                <h5 class="mt-3 mb-3 titulo_area"><em><b>Lista General de Asignaciones:</b></em></h5>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaAsignaciones">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th data-priority="1">#</th>
                                            <th>ESPECIALIDAD</th>
                                            <th>MEDICO ASIGNADO</th>
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

<div class="modal fade " id="ModalAsignacionMedico" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-">Asignación de Especialidad</h4>
                </div>
            </div>
            <div class="modal-body ">
                <form id="FormularioAsignacionMedico" method="POST" autocomplete="off">
                    <input type="hidden" name="idAsignacionMedico" id="idAsignacionMedico">
                    <div class="row" id="cuerpo">
                        <div class="col-md-12 bl">
                            <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaAsignacionMedico">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th>MEDICO</th>
                                        <th>DNI</th>
                                        <th>EDAD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/MantAsignacionMedico.js"></script>
