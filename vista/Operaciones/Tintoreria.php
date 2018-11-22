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
						<h3>Gestión de Tintoreria:</h3>
					</div>
				</div>
				<h5 class="mt-3 mb-3 titulo_area"><em><b>Lista de Ovillos para Tintoreria:</b></em></h5>
				<div class="row ">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaPersona">
									<thead class="thead-light text-center">
										<tr>
											<th data-priority="1">#</th>
											<th>ESTADO</th>
											<th>Nº ORDEN</th>
											<th>MATERIAL</th>
											<th>LOTE</th>
											<th>KILOS</th>
											<th>TRABAJADOR</th>
											<th>Nª DE CONO</th>
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

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Tintoreria.js"></script>
