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
        <!-- <div class="content-heading">
              <div>Mantenimiento Satisfaccions</div>
            </div> -->
        <!-- START card-->
        <input type="hidden" id="idPaciente" value="<?php echo $_POST["idPaciente"] ;?>">
        <input type="hidden" id="idAno" value="<?php echo $_POST["idAno"] ;?>">
        <input type="hidden" id="idMes" value="<?php echo $_POST["idMes"] ;?>">

        <div class="card card-default m-1 ">
            <div class="card-body ">
                <div class="row ">
                    <div class="col-md-12 w-100 text-center ">
                        <h3>Ficha de Evaluación:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <label>Paciente:</label>
                        <h4 id="NombrePaciente"></h4>
                    </div>
                    <div class="col-md-3 text-center">
                        <label>Edad:</label>
                        <h4 id="EdadPaciente"></h4>
                    </div>
                    <div class="col-md-3 text-center">
                        <label>Numero de Documento:</label>
                        <h4 id="DocumentoPaciente"></h4>
                    </div>
                    <div class="col-md-3 text-center mt-3">
                        <button type="button" class="btn btn-success btn-block" onclick="GuardarFicha();">GUARDAR FICHA</button>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <form action="">
                    <h5 class="mt-3 mb-3 titulo_area"><em><b>Grupo de Opciones:</b></em></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="accordion">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Fin Modal Agregar-->
<!-- Fin del Cuerpo del Sistema del Menu-->
<!-- Inicio del footer -->
<?php require_once('../layaout/Footer.php');?>
<!-- Fin del Footer -->

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Ficha.js"></script>
