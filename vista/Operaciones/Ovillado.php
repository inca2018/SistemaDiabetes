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
						<h3>Lista de Ordenes Recibidadas:</h3>
					</div>
				</div>
				<h5 class="mt-3 mb-3 titulo_area"><em><b>Lista de Ordenes Recepcionados del Area de Enconado:</b></em></h5>
				<div class="row ">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaOvillado">
									<thead class="thead-light text-center">
										<tr>
											<th data-priority="1">#</th>
											<th>ESTADO</th>
											<th>Nº ORDEN</th>
											<th>MATERIAL</th>
											<th>LOTE</th>
											<th>KILOS</th>
											<th>TRABAJADOR</th>
											<th>N° DE CONO</th>
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
</section>
<!-- Fin Modal Agregar-->
<!-- Fin del Cuerpo del Sistema del Menu-->
<!-- Inicio del footer -->
<?php require_once('../layaout/Footer.php');?>
<!-- Fin del Footer -->

<div class="modal fade " id="ModalTrabajos" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
	<div class="modal-dialog modal-lg  ">
		<div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalEnconado"></h4>
                </div>
            </div>
			<div class="modal-body " >
				 	 <h5 class="mt-3 mb-3 titulo_area" ><em><b>Lista de Trabajos Realizados en la Gestión:</b></em></h5>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                   <div class="col-md-12">
                                        <table class="table w-100 table-hover table-sm dt-responsive" id="tablaTrabajos" style="font-size:10px">
                                            <thead class="thead-light text-center">
                                                <tr>
                                                    <th data-priority="1">#</th>
                                                    <th>Orden de Enconado</th>
                                                    <th>Trabajador</th>
                                                    <th>Material</th>
                                                    <th>Numero Orden</th>
																    <th>Cantidad de Ovillos</th>
                                                    <th>Peso Ovillo</th>
                                                    <th>Lote Ovillo</th>
                                                    <th>F.Registro</th>
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

<div class="modal fade " id="ModalRechazo" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" >MOTIVO DE RECHAZO:</h4>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idOrden">
                 <input type="hidden" id="TipoRechazo">
                <div class="row m-2">
                    <div class="col-md-12 m-2">
                        <label for="" class="col-form-label">Observaciones de Rechazo:</label>
                        <textarea class="form-control validarPanel" id="RechazoObservacion" rows="8"></textarea>
                    </div>
                    <div class="col-md-12 m-2">
                        <label for="" class="col-form-label">Fecha de Rechazo:</label>
                        <input class="form-control " type="text" id="FechaRechazo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Ovillado.js"></script>
