<?php

if(isset($_POST["idPaciente"])){

}else{
    header('Location: ../../vista/Operaciones/GestionFicha.php');
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
					<div class="card card-default">
						<div class="card-body">
							<div class="card-body">
								<div class="row ">
									<div class="col-md-12 w-100 text-center ">
										<h3>Registro de Ficha de control (Mensual):</h3> </div>
								</div>
								<div class="row m-1">
									<form method="post" id="formulario_seguimiento">
										<input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $_POST['idPaciente']?>">
										<input type="hidden" id="idAno" name="idAno" value="<?php echo $_POST['idAno']?>">
										<input type="hidden" id="idMes" name="idMes" value="<?php echo $_POST['idMes']?>">
										<input type="hidden" id="idUsuario" name="idUsuario" value=" ">
										<div class="col-12 col-md-12">
											<!-- Custom Tabs -->
											<div class="card">
												<div class="card-header   p-0">
													<ul class="nav nav-pills ml-auto p-2">
														<li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Datos de Seguimiento</a></li>
														<li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Otra Especialidad</a></li>
														<li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Observaciones</a></li>
													</ul>
												</div>
												<!-- /.card-header -->
												<div class="card-body">
													<div class="tab-content">
														<div class="tab-pane active" id="tab_1">
															<div class="col-md-12 col-12">
																<table class="table   table-hover table-sm dt-responsive nowrap" id="datatable_variables1">
																	<thead class="thead">
																		<tr>
																			<th data-priority="1">#</th>
																			<th>Intervención /Parametros</th>
																			<th>Metas</th>
																			<th>Valor</th>
																			<th>Indicador</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<th data-priority="1">1.-</th>
																			<th>Consejeria Diabeto Logica</th>
																			<th></th>
																			<th colspan="2">
																				<input id="var1A" class="form-control col-md-12" type="text" name="var1A" step="any" onkeypress="return SoloLetras(event,50,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">2.-</th>
																			<th>Glucosa Ayunas(mg/dl.) </th>
																			<th>70-130 mg/dl.</th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var2A" class="form-control col-md-12" type="number" name="var2A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op2"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">3.-</th>
																			<th>Glucosa al Azar(mg/dl.) </th>
																			<th>70-130 mg/dl. </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var3A" class="form-control col-md-12" type="number" name="var3A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op3"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">4.-</th>
																			<th>Glucosa post prandial(mg/dl.) </th>
																			<th> &lt 180 mg/dl. </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var4A" class="form-control col-md-12" type="number" name="var4A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op4"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">5.-</th>
																			<th>Hemoglobina Glicosilada </th>
																			<th> 5-7 %</th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var5A" class="form-control col-md-12" type="number" name="var5A" onkeypress="return SoloNumerosModificado(event,4,this.id);"> </div>
																			</th>
																			<th id="op5"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">6.-</th>
																			<th>Colesterol Total </th>
																			<th> &lt 200 mg/dl.</th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var6A" class="form-control col-md-12" type="number" name="var6A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op6"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">7.-</th>
																			<th>HDL-c </th>
																			<th> Varon: &lt 40mg/dl.
																				<br>Mujer: &lt 50mg/dl. </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var7A" class="form-control col-md-12" type="number" name="var7A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op7"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">8.-</th>
																			<th>LDL-c </th>
																			<th> &lt 100 mg/dl. </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var8A" class="form-control col-md-12" type="number" name="var8A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op8"></th>
																		</tr>
																		<tr>
																			<th data-priority="1">9.-</th>
																			<th>Triglicéridos </th>
																			<th> &lt 150 mg/dl. </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var9A" class="form-control col-md-12" type="number" name="var9A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op9"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">10.-</th>
																			<th>Talla:
																				<input id="talla" class="form-control col-md-4" type="number" name="talla" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> Peso:
																				<input id="peso" class="form-control col-md-4" type="number" name="peso" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </th>
																			<th> 7% Peso Actual P: </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var10A" class="form-control col-md-12" type="number" name="var10A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op10"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">11.-</th>
																			<th>IMC(P/T12) </th>
																			<th> N:18,5 -24,9 </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var11A" class="form-control col-md-12" type="number" name="var11A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op11"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">12.-</th>
																			<th>Microalbumimuria</th>
																			<th> &lt 30 mg/24h </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var12A" class="form-control col-md-12" type="number" name="var12A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op12"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">13.-</th>
																			<th>Creatinina en sangre</th>
																			<th> 06-11 mg/dl. </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var13A" class="form-control col-md-12" type="number" name="var13A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op13"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">14.-</th>
																			<th>Presión Arterial</th>
																			<th> &gt 130/80 m mHg. </th>
																			<th>
																				<div class="row mr-1 ml-1">
																					<input id="var14A" class="form-control col-md-12" type="number" name="var14A" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
																			</th>
																			<th id="op14"> </th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<!-- /.tab-pane -->
														<div class="tab-pane" id="tab_2">
															<div class="col-md-12 col-12">
																<table class="table   table-hover table-sm dt-responsive nowrap" id="datatable_tarifario">
																	<thead class="thead">
																		<tr>
																			<th data-priority="1">#</th>
																			<th>Intervención /Parametros</th>
																			<th></th>
																			<th>Acción</th>
																			<th>Observación</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<th data-priority="1">1.-</th>
																			<th>Endicronologia</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-6">
																						<label>SI</label>
																						<input id="var1B" class="form-control col-md-12" type="radio" name="var1B" value="1"> </div>
																					<div class="checradiokbox col-6">
																						<label>NO</label>
																						<input id="var1B" class="form-control col-md-12" type="radio" name="var1B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs1" class="form-control col-md-12" type="text" name="obs1" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">2.-</th>
																			<th>Neurologia</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-6">
																						<label>SI</label>
																						<input id="var2B" class="form-control col-md-12" type="radio" name="var2B" value="1"> </div>
																					<div class="radio col-6">
																						<label>NO</label>
																						<input id="var2B" class="form-control col-md-12" type="radio" name="var2B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs2" class="form-control col-md-12" type="text" name="obs2" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">3.-</th>
																			<th>Ev. Fondo de Ojo</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-6">
																						<label>SI</label>
																						<input id="var3B" class="form-control col-md-12" type="radio" name="var3B" value="1"> </div>
																					<div class="radio col-6">
																						<label>NO</label>
																						<input id="var3B" class="form-control col-md-12" type="radio" name="var3B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs3" class="form-control col-md-12" type="text" name="obs3" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">4.-</th>
																			<th>Cardiologia</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-6">
																						<label>SI</label>
																						<input id="var4B" class="form-control col-md-12" type="radio" name="var4B" value="1"> </div>
																					<div class="radio col-6">
																						<label>NO</label>
																						<input id="var4B" class="form-control col-md-12" type="radio" name="var4B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs4" class="form-control col-md-12" type="text" name="obs4" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">5.-</th>
																			<th>C.Cardiovascular</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-6">
																						<label>SI</label>
																						<input id="var5B" class="form-control col-md-12" type="radio" name="var5B" value="1"> </div>
																					<div class="radio col-6">
																						<label>NO</label>
																						<input id="var5B" class="form-control col-md-12" type="radio" name="var5B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs5" class="form-control col-md-12" type="text" name="obs5" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">6.-</th>
																			<th>Urologia</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-6">
																						<label>SI</label>
																						<input id="var6B" class="form-control col-md-12" type="radio" name="var6B" value="1"> </div>
																					<div class="radio col-6">
																						<label>NO</label>
																						<input id="var6B" class="form-control col-md-12" type="radio" name="var6B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs6" class="form-control col-md-12" type="text" name="obs6" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">7.-</th>
																			<th>Dental</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-6">
																						<label>SI</label>
																						<input id="var7B" class="form-control col-md-12" type="radio" name="var7B" value="1"> </div>
																					<div class="radio col-6">
																						<label>NO</label>
																						<input id="var7B" class="form-control col-md-12" type="radio" name="var7B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs7" class="form-control col-md-12" type="text" name="obs7" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">8.-</th>
																			<th>Podologia</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-6">
																						<label>SI</label>
																						<input id="var8B" class="form-control col-md-12" type="radio" name="var8B" value="1"> </div>
																					<div class="radio col-6">
																						<label>NO</label>
																						<input id="var8B" class="form-control col-md-12" type="radio" name="var8B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs8" class="form-control col-md-12" type="text" name="obs8" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																		<tr>
																			<th data-priority="1">9.-</th>
																			<th>Paciente Controlado</th>
																			<th></th>
																			<th>
																				<div class="row">
																					<div class="radio col-md-6">
																						<label>SI</label>
																						<input id="var9B" class="form-control col-md-12" type="radio" name="var9B" value="1"> </div>
																					<div class="radio col-md-6">
																						<label>NO</label>
																						<input id="var9B" class="form-control col-md-12" type="radio" name="var9B" value="2"> </div>
																				</div>
																			</th>
																			<th>
																				<input id="obs9" class="form-control col-md-12" type="text" name="obs9" onkeypress="return SoloLetras(event,100,this.id);"> </th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<!-- /.tab-pane -->
														<div class="tab-pane" id="tab_3">
															<div class="row">
																<div class="  col-md-12">
																	<div class="form-group">
																		<label class="letras">Riesgo:</label>
																		<textarea class="form-control" rows="3" cols="10" name="riesgo" id="riesgo" maxlength="380" placeholder="Ingresar Descripción"></textarea>
																	</div>
																</div>
																<div class="  col-md-4">
																	<div class="form-group">
																		<label class="letras">Fecha Inicio:</label>
																		<input type="date" class="form-control col-md-12" id="fecha_inicio" name="fecha_inicio"> </div>
																</div>
																<div class="  col-md-12">
																	<div class="form-group">
																		<label class="letras">Observaciones:</label>
																		<textarea class="form-control" rows="4" cols="3" name="observaciones" id="observaciones" maxlength="380" placeholder="Ingresar Descripción"></textarea>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="row">
																		<label class="col-12 letras">Taller de Glucometria:</label>
																		<div class="radio  col-6">
																			<label class="col-md-4 letras">SI</label>
																			<input class="col-md-8" id="taller1" type="radio" name="taller1" value="1"> </div>
																		<div class="radio  col-6">
																			<label class="col-md-4 letras">NO</label>
																			<input class="col-md-8" id="taller1" type="radio" name="taller1" value="2"> </div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="row">
																		<label class="col-12 letras">Taller de Nutrición:</label>
																		<div class="radio  col-6">
																			<label class="col-md-4 letras">SI</label>
																			<input class="col-md-8" id="taller2" type="radio" name="taller2" value="1"> </div>
																		<div class="radio  col-6">
																			<label class="col-md-4 letras">NO</label>
																			<input class="col-md-8" id="taller2" type="radio" name="taller2" value="2"> </div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="row">
																		<label class="col-12 letras">Taller de "Conocimiento de la Diabetes":</label>
																		<div class="radio  col-6">
																			<label class="col-md-4 letras">SI</label>
																			<input class="col-md-8" id="taller3" type="radio" name="taller3" value="1"> </div>
																		<div class="radio  col-6">
																			<label class="col-md-4 letras">NO</label>
																			<input class="col-md-8" id="taller3" type="radio" name="taller3" value="2"> </div>
																	</div>
																</div>
																<div class="  col-md-4">
																	<div class="form-group">
																		<label class="letras">Proxima Cita:</label>
																		<input type="date" class="form-control col-md-12" id="proxima_cita" name="proxima_cita"> </div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-4  ">
																	<button id="volver_boton" type="button" class="btn btn-info " onclick="volver_ficha(<?php echo $_POST['idPaciente']?>);">VOLVER</button>
																</div>
																<div class="col-md-4 offset-4">
																	<button id="grabar_boton" type="submit" class="btn btn-success ">GUARDAR</button>
																</div>
															</div>
														</div>
														<!-- /.tab-pane -->
													</div>
													<!-- /.tab-content -->
												</div>
												<!-- /.card-body -->
											</div>
											<!-- ./card -->
										</div>
									</form>
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
			<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Seguimiento.js"></script>
