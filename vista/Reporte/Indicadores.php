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
                                <h3>Panel de Indicadores:</h3>
                            </div>
							</div>
							<div class="row justify-content-center m-3">
								 <div class="col-md-4 col-12">
                                        <div class="form-group row">
                                            <label for="inicio1" class="col-md-5 col-form-label"><i class="far fa-calendar-check fa-lg mr-2"></i>Fecha Inicio:<span class="red">*</span>:</label>
                                            <div class="col-md-7">
                                                <div class=" row">
																<div class="input-group date  col-md-12" id="date_inicio1"   >
																	<input class="form-control validarPanel" type="text" id="inicio1" name="inicio1"  autocomplete="off" data-message="- Fecha de Nacimiento">
																	<span class="input-group-append input-group-addon">
																		<span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>
																	</span>
																</div>
															</div>
                                            </div>
                                        </div>
									</div>
                          <div class="col-md-4 col-12">
                                        <div class="form-group row">
                                            <label for="fin1" class="col-md-5 col-form-label"><i class="far fa-calendar-check fa-lg mr-2"></i>Fecha Fin:<span class="red">*</span>:</label>
                                            <div class="col-md-7">
                                                <div class=" row">
																<div class="input-group date  col-md-12" id="date_fin1"   >
																	<input class="form-control validarPanel" type="text" id="fin1" name="fin1"  autocomplete="off" data-message="- Fecha de Nacimiento">
																	<span class="input-group-append input-group-addon">
																		<span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>
																	</span>
																</div>
															</div>
                                            </div>
                                        </div>
									</div>


                    </div>
							<div class="row mt-2">
									<div class="col-md-5 col-12">
										<div class="form-group">
										<label>Seleccione Trabajador:</label>
										<select class="form-control" id="alumnosSelect">
											<option value="">-- SELECCIONAR --</option>
										</select>
										</div>
									</div>
									<div class="col-md-4 col-12 mt-4">
											<button class=" btn btn-success sombra3   btn-block" type="button"  onclick="buscar_reporte1()"><i class="fa fa-search fa-lg mr-2"></i>BUSCAR</button>
									</div>
							</div>
							<hr>
							<div class="row">
										<div class="col-xl-3">
											<!-- START card-->
											<div class="card border-0 sombra3">
												<div class="row row-flush">
													<div class="col-4 bg-info-dark text-center d-flex align-items-center justify-content-center rounded-left">
														<em class="fas fa-file-invoice-dollar fa-2x"></em>
													</div>
													<div class="col-8">
														<div class="card-body text-center p-1">
															<h4 class="text-center text-info" id="ind_cuota_total"><b>0</b></h4>
															<p class="mb-0 text-muted">Total de Ovillos</p>
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
															<h4 class="text-center text-warning" id="ind_cuota_pendiente"><b>0</b></h4>
															<p class="mb-0 text-muted">Ovillos enviados a Calidad</p>
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
															<h4 class="text-center text-success" id="ind_cuota_pagada"><b>0</b></h4>
															<p class="mb-0 text-muted">Ovillos en Buen Estado</p>
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
															<h4 class="text-center text-danger" id="ind_cuota_vencida"><b>0</b></h4>
															<p class="mb-0 text-muted">Ovillos en Mal Estado</p>
														</div>
													</div>
												</div>
											</div>
											<!-- END card-->
              						 </div>

 								</div>
                      <hr>
                       <div class="row" >
                      	<div class="col-md-6 col-12 br"  id="reporteClienteEstadoCu">
                      		<canvas id="chart1" class="mb-3"></canvas>
                      </div>
                      	<div class="col-md-6 col-12 br" id="reporteGeneralEstadoCu">
                      		<canvas id="chart2" class="mb-3"></canvas>
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
