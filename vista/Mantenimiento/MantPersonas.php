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
              <div>Mantenimiento Personas</div>
            </div> -->
            <!-- START card-->
            <div class="card card-default m-1 ">
               <div class="card-body ">
                        <div class="row ">
                            <div class="col-md-12 w-100 text-center ">
                                <h3>Mantenimiento de Persona:</h3>
                            </div>
                        </div>
                        <hr class="mt-2 mb-2">
                         <div class="row">
                            <div class="col-md-2 offset-10">
                                <button class="btn btn-success btn-block btn-sm" onclick="NuevoPersona();"><i class="fa fa-plus fa-lg mr-2"></i> Nueva Persona</button>
                            </div>
                        </div>
                        <h5 class="mt-3 mb-3 titulo_area" ><em><b>Lista General de Persona:</b></em></h5>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                   <div class="col-md-12">
                                        <table class="table w-100 table-hover table-sm dt-responsive nowrap" id="tablaPersona">
                                            <thead class="thead-light text-center">
                                                <tr>
                                                    <th data-priority="1">#</th>
                                                    <th>ESTADO</th>
                                                    <th>NOMBRES</th>
                                                    <th>APELLIDOS</th>
                                                    <th>DNI</th>
                                                    <th>REGISTRO</th>
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

<div class="modal fade " id="ModalPersona" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
	<div class="modal-dialog modal-lg  ">
		<div class="modal-content">
            <div class="row m-1 bb">
                <div class="col-md-12">
                    <h4 class="text-center text-" id="tituloModalPersona"></h4>
                </div>
            </div>
			<div class="modal-body " >
				<form id="FormularioPersona" method="POST" autocomplete="off">
                     <input type="hidden" name="idPersona" id="idPersona">
                     <div class="row mb-3 mt-1">
                         <div class="col-md-3">
                             <label class=""><span class="red">(*) Campos Obligatorios</span></label>
                         </div>
                         <div class="col-md-1 offset-8">
                              <button type="button" class="btn btn-info btn-sm btn-display" title="Limpiar Campos" onclick="LimpiarPersona();">
                              <i class="fa fa-trash-alt fa-lg "></i>
                              </button>
                         </div>
                     </div>

					 <div class="row" id="cuerpo">
					      <div class="col-md-12 bl">

                                <div class="row">
                                      <div class="col-md-6 br">
                                        <div class="form-group row">
                                            <label for="PersonaNombre" class="col-md-5 col-form-label"><i class="fas fa-address-book fa-lg mr-2"></i>Nombres<span class="red">*</span>:</label>
                                            <div class="col-md-7">
                                                <input class="form-control validarPanel" id="PersonaNombre" name="PersonaNombre" data-message="- Nombre de Persona"  placeholder="Nombre" type="text" onkeypress="return SoloLetras(event,40,this.id);">

                                            </div>
                                        </div>
                                    </div>



                                      <div class="col-md-6 br">
                                        <div class="form-group row">
                                            <label for="PersonaFechaNacimiento" class="col-md-5 col-form-label"><i class="far fa-calendar-check fa-lg mr-2"></i>F.Nacimiento<span class="red">*</span>:</label>
                                            <div class="col-md-7">
                                                <div class=" row">
																<div class="input-group date  col-md-12" id="dateFechaNacimiento"   >
																	<input class="form-control validarPanel" type="text" id="PersonaFechaNacimiento" name="PersonaFechaNacimiento"  autocomplete="off" data-message="- Fecha de Nacimiento">
																	<span class="input-group-append input-group-addon">

																		<span class="input-group-text "><i class="fa fa-calendar fa-lg"></i></span>
																	</span>
																</div>
															</div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6 br">
                                           <div class="form-group row">
                                                <label for="PersonaApellidoP " class="col-md-5 col-form-label  "><i class="far fa-address-book mr-2 fa-lg"></i>Apellido P.<span class="red">*</span>:</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control validarPanel" placeholder="Apellido Paterno" name="PersonaApellidoP" id="PersonaApellidoP" data-message="- Apellido Paterno" onkeypress="return SoloLetras(event,40,this.id);">
                                                </div>
                                            </div>
                                     </div>

                                      <div class="col-md-6">
                                           <div class="form-group row">
                                                <label for="PersonaDNI" class="col-md-5 col-form-label"><i class="fa fa-lock mr-2 fa-lg"></i>DNI:<span class="red">*</span>:</label>
                                                <div class="col-md-7">
                                                    <input type="number" class="form-control validarPanel" placeholder="Dni" name="PersonaDNI" id="PersonaDNI" data-message="- DNI" onkeypress="return SoloNumerosModificado(event,8,this.id);">
                                                </div>
                                            </div>
                                     </div>


                                     <div class="col-md-6 br">
                                        <div class="form-group row">
                                            <label for="PersonaApellidoM" class="col-md-5 col-form-label"><i class="fa fa-address-card mr-2 fa-lg"></i>Apellido M.<span class="red">*</span>:</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control validarPanel" placeholder="Apellido Materno" name="PersonaApellidoM" id="PersonaApellidoM" data-message="- Apellido Materno" onkeypress="return SoloLetras(event,40,this.id);">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                           <div class="form-group row">
                                                <label for="PersonaCorreo " class="col-md-5 col-form-label"><i class="fa fa-at mr-2 fa-lg"></i>Correo:</label>
                                                <div class="col-md-7">
                                                    <input type="email" class="form-control " placeholder="Correo" name="PersonaCorreo" id="PersonaCorreo" maxlength="40">
                                                </div>
                                            </div>
                                     </div>
                                    <div class="col-md-6 br">
                                        <div class="form-group row">
                                            <label for="PersonaTelefono" class="col-md-5 col-form-label"><i class="fa fa-phone fa-lg mr-3"></i>Telefono:</label>
                                            <div class="col-md-7">
                                               <input type="number" class="form-control " placeholder="Telefono" name="PersonaTelefono" id="PersonaTelefono" onkeypress="return SoloNumerosModificado(event,9,this.id);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group row">
                                            <label for="PersonaDireccion" class="col-md-5 col-form-label"><i class="fa fa-address-card fa-lg mr-3"></i>Dirección::</label>
                                            <div class="col-md-7">
                                                 <textarea id="PersonaDireccion" name="PersonaDireccion" rows="4" class="form-control" >

                                                 </textarea>
                                            </div>
                                        </div>
                                    </div>
 										 <div class="col-md-6 br">
                                        <div class="form-group row">
                                            <label for="PersonaEstado" class="col-md-5 col-form-label"><i class="fa fa-sun fa-lg mr-3"></i>Estado<span class="red">*</span>:</label>
                                            <div class="col-md-7">
                                                <select class="form-control validarPanel" id="PersonaEstado" name="PersonaEstado" data-message="- Estado">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mr-1 ml-1">
                                           <button type="submit" class="col-md-2 btn btn-success btn-sm" title="Guardar">
                                              <i class="fa fa-save fa-lg mr-2"></i>GUARDAR
                                           </button>

                                           <button type="button" class="col-md-2 btn btn-danger btn-sm  offset-8" title="Cancelar" onclick="Cancelar();">
                                              <i class="fa fa-times fa-lg mr-2"></i>CANCELAR
                                           </button>

                               </div>
                            </div>
					 </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/MantPersonas.js"></script>
