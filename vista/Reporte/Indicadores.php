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
					<div class="col-md-4 col-12">
						<label>Fecha de Inicio:</label>
						<input type="date" class="form-control col-md-12" id="FechaInicio">
					</div>
					<div class="col-md-4 col-12">
						<label>Fecha de Fin:</label>
						<input type="date" class="form-control col-md-12" id="FechaFin">
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
															<p class="mb-0 text-muted">Total de Pacientes Atendidos</p>
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
														<em class="fas fa-file-powerpoint fa-2x"></em>
													</div>
													<div class="col-8">
														<div class="card-body text-center p-1">
															<h4 class="text-center text-warning" id="total2"><b>0</b></h4>
															<p class="mb-0 text-muted">N° de Atenciones Realizadas</p>
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
														<em class="fas fa-check-square fa-2x"></em>
													</div>
													<div class="col-8">
														<div class="card-body text-center p-1">
															<h4 class="text-center text-success" id="total3"><b>0</b></h4>
															<p class="mb-0 text-muted">Pacientes con control
									de glicémico
									adecuado</p>
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
													<div class="col-4 bg-danger-dark text-center d-flex align-items-center justify-content-center rounded-left">
														<em class="fas fa-times fa-2x"></em>
													</div>
													<div class="col-8">
														<div class="card-body text-center p-1">
															<h4 class="text-center text-danger" id="total4"><b>0</b></h4>
															<p class="mb-0 text-muted">Pacientes con control de glicémico
									NO adecuado</p>
														</div>
													</div>
												</div>
											</div>
											<!-- END card-->
              						 </div>

 								</div>


				<div class="row m-4">

					<h5 class="m-2"> Pacientes del Programa de Diabetes según Condición</h5>
					<table class="table   table-hover table-sm dt-responsive nowrap" id="datatable_reporte">
						<thead class="thead">
							<tr>

								<th>Tipo de Paciente</th>
								<th>Caso Nuevo</th>
								<th>Caso Prevalente</th>



							</tr>
						</thead>
						<tbody>
							<tr>
								<th data-priority="1">N° de Pacientes</th>
								<th id="condicion1">0</th>
								<th id="condicion2">0</th>


							</tr>

						</tbody>
					</table>
				</div>

				<div class="row m-4">

					<h5 class="m-2"> Pacientes del Programa de Diabetes según Tipo de Diabetes</h5>
					<table class="table   table-hover table-sm dt-responsive nowrap" id="datatable_reporte">
						<thead class="thead">
							<tr>

								<th>Diagnóstico</th>

								<th>Diabetes TIPO 1</th>
								<th>Diabetes TIPO 2</th>
								<th>Diabetes GESTACIONAL</th>
								<th>Diabetes SECUNDARIA</th>
                                <th>Diabetes INTOLERANCIA A LA GLUCOSA</th>
                                <th>Diabetes NO CALSIFICADA</th>
                                 <th>OTRO</th>

							</tr>
						</thead>
						<tbody>
							<tr>
								<th data-priority="1">N° de Pacientes</th>
								<th id="tipo1">0</th>
								<th id="tipo2">0</th>
								<th id="tipo3">0</th>
								<th id="tipo4">0</th>
								<th id="tipo5">0</th>
                                <th id="tipo6">0</th>
                                <th id="tipo7">0</th>


							</tr>

						</tbody>
					</table>
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
