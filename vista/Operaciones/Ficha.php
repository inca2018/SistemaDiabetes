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
                <hr class="mt-2 mb-2">
                <form action="">
                    <h5 class="mt-3 mb-3 titulo_area"><em><b>Grupo de Opciones:</b></em></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="accordion">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="accordion2">
                                <div class="card border-primary mb-1">
                                    <div class="card-header text-white bg-primary" id="headingOne">
                                        <h4 class="mb-0"><a class="text-inherit" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" href="">OTRAS ESPECIALIDADES</a>
                                        </h4>
                                    </div>
                                    <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion2">
                                        <div class="card-body border-top">
                                            <div class="row" >
                                                <div class="col-md-12" id="contenedorEspecialidades">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card  mb-1 border-primary">
                                    <div class="card-header text-white bg-primary" id="headingTwo">
                                        <h4 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" href="">EXAMEN DE PIE</a>
                                        </h4>
                                    </div>
                                    <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion2">
                                        <div class="card-body border-top">
                                            <div class="row">
                                                <div class="col-md-9 offset-3 padre">
                                                    <div class="ImagenPie">
                                                        <div class="OpcionPie1">
                                                            <div class="opciones Option" data-opcion="1">

                                                            </div>
                                                        </div>
                                                        <div class="OpcionPie2">
                                                            <div class="opciones Option" data-opcion="1">

                                                            </div>
                                                        </div>
                                                        <div class="OpcionPie3">
                                                            <div class="opciones Option" data-opcion="1">
                                                                <!--<span id="x">X</span>-->
                                                            </div>
                                                        </div>
                                                        <div class="OpcionPie4">
                                                            <div class="opciones Option" data-opcion="1">

                                                            </div>
                                                        </div>
                                                        <div class="OpcionPie5">
                                                            <div class="opciones Option" data-opcion="1">

                                                            </div>
                                                        </div>
                                                        <div class="OpcionPie6">
                                                            <div class="opciones Option" data-opcion="1">

                                                            </div>
                                                        </div>
                                                        <div class="OpcionPie7">
                                                            <div class="opciones Option" data-opcion="1">

                                                            </div>
                                                        </div>
                                                        <div class="OpcionPie8">
                                                            <div class="opciones Option" data-opcion="1">

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
