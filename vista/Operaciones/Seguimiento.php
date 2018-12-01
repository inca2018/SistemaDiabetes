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
                            <h3>Registro de Ficha de control (Mensual):</h3>
                        </div>
                    </div>
                    <div class="row m-1" id="contenedor">
                        <form method="post" id="formulario_seguimiento">
                            <input type="hidden" id="idSeguimiento" name="idSeguimiento" value="<?php echo $_POST['idSeguimiento']?>">
                            <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $_POST['idPaciente']?>">
                            <input type="hidden" id="idAno" name="idAno" value="<?php echo $_POST['idAno']?>">
                            <input type="hidden" id="idMes" name="idMes" value="<?php echo $_POST['idMes']?>">
                            <input type="hidden" id="idUsuario" name="idUsuario" value=" ">
                            <div class="col-12 col-md-12">
                                <div role="tabpanel">
                                    <ul class="nav nav-pills " role="tablist">
                                        <li class="nav-item pill-1 m-2 " role="presentation"><a class="nav-link active" href="#op_1" aria-controls="home" role="tab" data-toggle="tab">Datos del Seguimiento</a>
                                        </li>
                                        <li class="nav-item pill-2 m-2" role="presentation"><a class="nav-link" href="#op_2" aria-controls="profile" role="tab" data-toggle="tab">Otras Especialidades</a>
                                        </li>

                                        <li class="nav-item pill-3 m-2" role="presentation"><a class="nav-link" href="#op_3" aria-controls="settings" role="tab" data-toggle="tab">Otros Tratamientos</a>
                                        </li>
                                        <li class="nav-item pill-4 m-2" role="presentation" ><a class="nav-link" href="#op_4" aria-controls="settings" role="tab" data-toggle="tab">Datos Adicionales</a>
                                        </li>
                                        <li class="nav-item pill-5 m-2" role="presentation" ><a class="nav-link" href="#op_5" aria-controls="settings" role="tab" data-toggle="tab">Fechas de Seguimiento</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="op_1" role="tabpanel">
                                            <div class="container">
                                                <div class="col-md-12">
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
                                                                    <input id="seg1" class="form-control col-md-12 caja  campo" data-tipo="texto" type="text" name="seg1" step="any" onkeypress="return SoloLetras(event,50,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">2.-</th>
                                                                <th>Glucosa Ayunas(mg/dl.) </th>
                                                                <th>70-130 mg/dl.</th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg2" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="70" data-fin="130" type="number" name="seg2" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op2"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">3.-</th>
                                                                <th>Glucosa al Azar(mg/dl.) </th>
                                                                <th>70-130 mg/dl. </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg3" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="70" data-fin="130" type="number" name="seg3" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op3"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">4.-</th>
                                                                <th>Glucosa post prandial(mg/dl.) </th>
                                                                <th> &lt 180 mg/dl. </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg4" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="0" data-fin="180" type="number" name="seg4" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op4"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">5.-</th>
                                                                <th>Hemoglobina Glicosilada </th>
                                                                <th> 5-7 %</th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg5" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="5" data-fin="7" type="number" name="seg5" onkeypress="return SoloNumerosModificado(event,4,this.id);"> </div>
                                                                </th>
                                                                <th id="op5"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">6.-</th>
                                                                <th>Colesterol Total </th>
                                                                <th> &lt 200 mg/dl.</th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg6" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="0" data-fin="200" type="number" name="seg6" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
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
                                                                        <input id="seg7" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="0" data-fin="40" data-fin2="50" type="number" name="seg7" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op7"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">8.-</th>
                                                                <th>LDL-c </th>
                                                                <th> &lt 100 mg/dl. </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg8" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="0" data-fin="100" type="number" name="seg8" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op8"></th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">9.-</th>
                                                                <th>Triglicéridos </th>
                                                                <th> &lt 150 mg/dl. </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg9" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="0" data-fin="150" type="number" name="seg9" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op9"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">10.-</th>
                                                                <th>Talla:
                                                                    <input id="talla" class="form-control col-md-4 caja  campo" data-tipo="validar" type="number" name="talla" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> Peso:
                                                                    <input id="peso" class="form-control col-md-4 caja  campo" data-tipo="validar" type="number" name="peso" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </th>
                                                                <th> 7% Peso Actual P: </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="peso_actual" class="form-control col-md-12 caja  campo" data-tipo="texto" data-inicio="0" data-fin="1000" type="number" name="peso_actual" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);" readonly> </div>
                                                                </th>
                                                                <th id="op10"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">11.-</th>
                                                                <th>IMC(P/T12) </th>
                                                                <th> N:18,5 -24,9 </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="imc" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="18.5" data-fin="24.9" type="texto" name="imc" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);" readonly> </div>
                                                                </th>
                                                                <th id="op11"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">12.-</th>
                                                                <th>Microalbumimuria</th>
                                                                <th> &lt 30 mg/24h </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg12" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="0" data-fin="30" type="number" name="seg12" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op12"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">13.-</th>
                                                                <th>Creatinina en sangre</th>
                                                                <th> 06-11 mg/dl. </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg13" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="6" data-fin="11" type="number" name="seg13" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op13"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">14.-</th>
                                                                <th>Presión Arterial</th>
                                                                <th> &gt 130/80 m mHg. </th>
                                                                <th>
                                                                    <div class="row mr-1 ml-1">
                                                                        <input id="seg14" class="form-control col-md-12 caja  campo" data-tipo="numero" data-inicio="130" data-fin="1000" type="number" name="seg14" step="any" onkeypress="return SoloNumerosModificado(event,6,this.id);"> </div>
                                                                </th>
                                                                <th id="op14"> </th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="op_2" role="tabpanel">
                                            <div class="container">
                                                <div class="col-md-12">
                                                    <table class="table   table-hover table-sm dt-responsive nowrap" id="datatable_tarifario">
                                                        <thead class="thead">
                                                            <tr>
                                                                <th width="5%" data-priority="1">#</th>
                                                                <th width="25%">Intervención /Parametros</th>
                                                                <th width="0%"></th>
                                                                <th width="30%">Acción</th>
                                                                <th width="40%">Observación</th>
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
                                                                            <label>SI
                                                                                <input id="radio1" class="form-control opcion2" type="radio" name="radio1" value="1"></label></div>
                                                                        <div class="checradiokbox col-6">
                                                                            <label>NO
                                                                                <input id="radio1" class="form-control opcion2" type="radio" name="radio1" value="2" checked></label></div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs1" class="form-control caja campo2" type="text" name="obs1" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">2.-</th>
                                                                <th>Neurologia</th>
                                                                <th></th>
                                                                <th>
                                                                    <div class="row">
                                                                        <div class="radio col-6">
                                                                            <label>SI
                                                                                <input id="radio2" class="form-control opcion2" type="radio" name="radio2" value="1"> </label></div>
                                                                        <div class="radio col-6">
                                                                            <label>NO
                                                                                <input id="radio2" class="form-control opcion2" type="radio" name="radio2" value="2" checked> </label></div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs2" class="form-control caja campo2" type="text" name="obs2" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">3.-</th>
                                                                <th>Ev. Fondo de Ojo</th>
                                                                <th></th>
                                                                <th>
                                                                    <div class="row">
                                                                        <div class="radio col-6">
                                                                            <label>SI
                                                                                <input id="radio3" class="form-control opcion2" type="radio" name="radio3" value="1"> </label></div>
                                                                        <div class="radio col-6">
                                                                            <label>NO
                                                                                <input id="radio3" class="form-control opcion2" type="radio" name="radio3" value="2" checked></label> </div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs3" class="form-control  caja campo2" type="text" name="obs3" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">4.-</th>
                                                                <th>Cardiologia</th>
                                                                <th></th>
                                                                <th>
                                                                    <div class="row">
                                                                        <div class="radio col-6">
                                                                            <label>SI
                                                                                <input id="radio4" class="form-control opcion2" type="radio" name="radio4" value="1"></label> </div>
                                                                        <div class="radio col-6">
                                                                            <label>NO
                                                                                <input id="radio4" class="form-control  opcion2" type="radio" name="radio4" value="2" checked></label> </div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs4" class="form-control   caja campo2" type="text" name="obs4" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">5.-</th>
                                                                <th>C.Cardiovascular</th>
                                                                <th></th>
                                                                <th>
                                                                    <div class="row">
                                                                        <div class="radio col-6">
                                                                            <label>SI
                                                                                <input id="radio5" class="form-control opcion2" type="radio" name="radio5" value="1"></label> </div>
                                                                        <div class="radio col-6">
                                                                            <label>NO
                                                                                <input id="radio5" class="form-control  opcion2" type="radio" name="radio5" value="2" checked ></label> </div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs5" class="form-control   caja campo2" type="text" name="obs5" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">6.-</th>
                                                                <th>Urologia</th>
                                                                <th></th>
                                                                <th>
                                                                    <div class="row">
                                                                        <div class="radio col-6">
                                                                            <label>SI
                                                                                <input id="radio6" class="form-control opcion2" type="radio" name="radio6" value="1"></label> </div>
                                                                        <div class="radio col-6">
                                                                            <label>NO
                                                                                <input id="radio6" class="form-control  opcion2" type="radio" name="radio6" value="2" checked></label> </div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs6" class="form-control  caja campo2" type="text" name="obs6" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">7.-</th>
                                                                <th>Dental</th>
                                                                <th></th>
                                                                <th>
                                                                    <div class="row">
                                                                        <div class="radio col-6">
                                                                            <label>SI
                                                                                <input id="radio7" class="form-control opcion2" type="radio" name="radio7" value="1"></label> </div>
                                                                        <div class="radio col-6">
                                                                            <label>NO
                                                                                <input id="radio7" class="form-control  opcion2" type="radio" name="radio7" value="2" checked></label> </div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs7" class="form-control  caja campo2" type="text" name="obs7" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">8.-</th>
                                                                <th>Podologia</th>
                                                                <th></th>
                                                                <th>
                                                                    <div class="row">
                                                                        <div class="radio col-6">
                                                                            <label>SI
                                                                                <input id="radio8" class="form-control opcion2 " type="radio" name="radio8" value="1"> </label></div>
                                                                        <div class="radio col-6">
                                                                            <label>NO
                                                                                <input id="radio8" class="form-control opcion2 " type="radio" name="radio8" value="2" checked></label> </div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs8" class="form-control  caja campo2" type="text" name="obs8" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                            <tr>
                                                                <th data-priority="1">9.-</th>
                                                                <th>Paciente Controlado</th>
                                                                <th></th>
                                                                <th>
                                                                    <div class="row">
                                                                        <div class="radio col-md-6">
                                                                            <label>SI
                                                                                <input id="radio9" class="form-control opcion2 " type="radio" name="radio9" value="1"></label> </div>
                                                                        <div class="radio col-md-6">
                                                                            <label>NO
                                                                                <input id="radio9" class="form-control  opcion2" type="radio" name="radio9" value="2" checked></label> </div>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <input id="obs9" class="form-control  caja campo2" type="text" name="obs9" onkeypress="return SoloLetras(event,100,this.id);"> </th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="op_3" role="tabpanel">
                                            <div class="container">
                                                <h5 class="mt-2 mb-2 titulo_area3" id="titulo_gasto"><em><b>Comorbilidad al momento de la captación del caso(Evaluado por el personal de salud capacitado):</b></em></h5>

                                                <div class="row bb bl br bt">
                                                    <div class="col-md-4">
                                                        <table>
                                                            <tr>

                                                                <th>Hipertensión Arterial</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro1" class="form-control opcion3" type="radio" name="otro1" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro1" class="form-control opcion3" type="radio" name="otro1" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Obesidad</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro2" class="form-control opcion3" type="radio" name="otro2" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro2" class="form-control opcion3" type="radio" name="otro2" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Dislipidemia</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro3" class="form-control opcion3" type="radio" name="otro3" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro3" class="form-control opcion3" type="radio" name="otro3" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Anemia</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro4" class="form-control opcion3" type="radio" name="otro4" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro4" class="form-control opcion3" type="radio" name="otro4" value="2" checked></label></div>
                                                                </th>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <table>
                                                            <tr>

                                                                <th>Higado Graso</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro5" class="form-control opcion3" type="radio" name="otro5" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro5" class="form-control opcion3" type="radio" name="otro5" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Insuficiencia Cardiaca</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro6" class="form-control opcion3" type="radio" name="otro6" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro6" class="form-control opcion3" type="radio" name="otro6" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Enf. Renal Crónica</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro7" class="form-control opcion3" type="radio" name="otro7" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro7" class="form-control opcion3" type="radio" name="otro7" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Dialisis</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro8" class="form-control opcion3" type="radio" name="otro8" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro8" class="form-control opcion3" type="radio" name="otro8" value="2" checked></label></div>
                                                                </th>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <table>
                                                            <tr>

                                                                <th>Hipotiroidismo</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro9" class="form-control opcion3" type="radio" name="otro9" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro9" class="form-control opcion3" type="radio" name="otro9" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Tuberculosis</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro10" class="form-control opcion3" type="radio" name="otro10" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro10" class="form-control opcion3" type="radio" name="otro10" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Fuma Actualmente</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro11" class="form-control opcion3" type="radio" name="otro11" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro11" class="form-control opcion3" type="radio" name="otro11" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Cancer</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro12" class="form-control opcion3" type="radio" name="otro12" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro12" class="form-control opcion3" type="radio" name="otro12" value="2" checked></label></div>
                                                                </th>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4 bb bl br bt">
                                                        <div class="row">
                                                            <h5 class="mt-2 mb-2 titulo_area3" id="titulo_gasto"><em><b>Complicaciones al momento de la captación del caso</b>(evaluado por personal de salud entrenado):</em></h5>
                                                            <div class="col-md-12">
                                                                <table>
                                                                    <tr>

                                                                        <th>Neuropatía Sensitiva Periferica</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro13" class="form-control opcion3" type="radio" name="otro13" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro13" class="form-control opcion3" type="radio" name="otro13" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Retinopatía no proliferativa</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro14" class="form-control opcion3" type="radio" name="otro14" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro14" class="form-control opcion3" type="radio" name="otro14" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Retinopatía proliferativa</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro15" class="form-control opcion3" type="radio" name="otro15" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro15" class="form-control opcion3" type="radio" name="otro15" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Pie Diabetico sin amputación</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro16" class="form-control opcion3" type="radio" name="otro16" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro16" class="form-control opcion3" type="radio" name="otro16" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Pie con aputación menor</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro17" class="form-control opcion3" type="radio" name="otro17" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro17" class="form-control opcion3" type="radio" name="otro17" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Pie con aputación mayor</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro18" class="form-control opcion3" type="radio" name="otro18" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro18" class="form-control opcion3" type="radio" name="otro18" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Hipoglicemia en ultimo año</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro19" class="form-control opcion3" type="radio" name="otro19" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro19" class="form-control opcion3" type="radio" name="otro19" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Hospitalización en el año previo</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro20" class="form-control opcion3" type="radio" name="otro20" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro20" class="form-control opcion3" type="radio" name="otro20" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Infarto agudo Miocardio</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro21" class="form-control opcion3" type="radio" name="otro21" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro21" class="form-control opcion3" type="radio" name="otro21" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Enf.Cerebro vacular</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro22" class="form-control opcion3" type="radio" name="otro22" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro22" class="form-control opcion3" type="radio" name="otro22" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Enf.Arterial Periferíca</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro23" class="form-control opcion3" type="radio" name="otro23" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro23" class="form-control opcion3" type="radio" name="otro23" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 bb bl br bt">
                                                        <h5 class="m-2 titulo_area3" id="titulo_gasto"><em><b>Tratamiento</b>(evaluado por personal de Salud entrenado)</em></h5>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table>
                                                                    <tr>

                                                                        <th>¿Cumple dieta saludable?</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro24" class="form-control opcion3" type="radio" name="otro24" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro24" class="form-control opcion3" type="radio" name="otro24" value="2" checked></label></div>
                                                                        </th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>¿Camina 30 minutos diarios?</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro25" class="form-control opcion3" type="radio" name="otro25" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro25" class="form-control opcion3" type="radio" name="otro25" value="2" checked></label></div>
                                                                        </th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th colspan="4">Tipo de Medicamento (una o más)</th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>1.- MetFormina</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro26" data-id="1" class="form-control opcion3 opcionTexto" type="radio" name="otro26" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro26" data-id="1" class="form-control opcion3 opcionTexto" type="radio" name="otro26" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre1" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta1" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>2.- Sulfonilureas:Glibenclamida</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro27"  data-id="2" class="form-control opcion3 opcionTexto" type="radio" name="otro27" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro27"  data-id="2" class="form-control opcion3 opcionTexto" type="radio" name="otro27" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre2" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta2" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th> Glimepirida</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro28" data-id="3" class="form-control opcion3 opcionTexto" type="radio" name="otro28" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro28" data-id="3" class="form-control opcion3 opcionTexto" type="radio" name="otro28" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre3" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta3" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>3.- Inhibidores de laDPP4</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro29" data-id="4" class="form-control opcion3 opcionTexto" type="radio" name="otro29" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro29" data-id="4" class="form-control opcion3 opcionTexto" type="radio" name="otro29" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre4" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta4" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>4.- Pioglitazonas</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro30" data-id="5" class="form-control opcion3 opcionTexto" type="radio" name="otro30" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro30" data-id="5" class="form-control opcion3 opcionTexto" type="radio" name="otro30" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre5" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta5" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>5.- Glifozinas(Empa Dapaglifozina)</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro31"  data-id="6" class="form-control opcion3 opcionTexto" type="radio" name="otro31" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro31" data-id="6"  class="form-control opcion3 opcionTexto" type="radio" name="otro31" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre6" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta6" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>6.- Agonistas de receptores GLP1 INSULINAS</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro32" data-id="7" class="form-control opcion3 opcionTexto" type="radio" name="otro32" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro32" data-id="7" class="form-control opcion3 opcionTexto" type="radio" name="otro32" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre7" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta7" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>7.- Insulinas Humanas: Cristalinas</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro33" data-id="8" class="form-control opcion3 opcionTexto" type="radio" name="otro33" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro33" data-id="8" class="form-control opcion3 opcionTexto" type="radio" name="otro33" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre8" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta8" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th> NPH</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro34" data-id="9" class="form-control opcion3 opcionTexto" type="radio" name="otro34" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro34" data-id="9" class="form-control opcion3 opcionTexto" type="radio" name="otro34" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre9" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta9" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>8.- Insulinas Analogas: Rápidas</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro35" data-id="10" class="form-control opcion3 opcionTexto" type="radio" name="otro35" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro35" data-id="10" class="form-control opcion3 opcionTexto" type="radio" name="otro35" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre10" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta10" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th> Basal</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro36" data-id="11" class="form-control opcion3 opcionTexto" type="radio" name="otro36" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro36" data-id="11" class="form-control opcion3 opcionTexto" type="radio" name="otro36" value="2" checked></label></div>
                                                                        </th>
                                                                        <th><input id="pre11" class="form-control caja texto3" type="text" name="obs1" placeholder="Presentación" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                        <th><input id="tableta11" class="form-control caja texto3" type="text" name="obs1" placeholder="Tab/dia" onkeypress="return SoloLetras(event,100,this.id);"></th>
                                                                    </tr>

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <h5 class="mt-2 mb-2 titulo_area3" id="titulo_gasto"><em><b>OTROS TRATAMIENTOS</b></em></h5>
                                                <div class="row bb bl br bt">
                                                    <div class="col-md-4">
                                                        <table>
                                                            <tr>

                                                                <th>AAS</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro37" class="form-control opcion3" type="radio" name="otro37" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro37" class="form-control opcion3" type="radio" name="otro37" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Estatinas</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro38" class="form-control opcion3" type="radio" name="otro38" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro38" class="form-control opcion3" type="radio" name="otro38" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Fibratos</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro39" class="form-control opcion3" type="radio" name="otro39" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro39" class="form-control opcion3" type="radio" name="otro39" value="2" checked></label></div>
                                                                </th>
                                                            </tr>


                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <table>
                                                            <tr>

                                                                <th>IECA(Enalapril)</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro40" class="form-control opcion3" type="radio" name="otro40" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro40" class="form-control opcion3" type="radio" name="otro40" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>ARA II(Losartán)</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro41" class="form-control opcion3" type="radio" name="otro41" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro41" class="form-control opcion3" type="radio" name="otro41" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Beta Bloqueador</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro42" class="form-control opcion3" type="radio" name="otro42" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro42" class="form-control opcion3" type="radio" name="otro42" value="2" checked></label></div>
                                                                </th>
                                                            </tr>


                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <table>
                                                            <tr>

                                                                <th>Bloq. Canal Calcio</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro43" class="form-control opcion3" type="radio" name="otro43" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro43" class="form-control opcion3" type="radio" name="otro43" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Furosemida</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro44" class="form-control opcion3" type="radio" name="otro44" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro44" class="form-control opcion3" type="radio" name="otro44" value="2" checked></label></div>
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>Hidroclorotiazida</th>
                                                                <th>
                                                                    <div class="radio col-6">
                                                                        <label>SI
                                                                            <input id="otro45" class="form-control opcion3" type="radio" name="otro45" value="1"></label></div>
                                                                </th>
                                                                <th>
                                                                    <div class="checradiokbox col-6">
                                                                        <label>NO
                                                                            <input id="otro45" class="form-control opcion3" type="radio" name="otro45" value="2" checked></label></div>
                                                                </th>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                </div>
                                                <h5 class="mt-2 mb-2 titulo_area3" id="titulo_gasto"><em><b>EXAMEN DE PIE DIABETICO</b>(Realizado por personal de salud entrenado)</em></h5>
                                                <div class="row bb bl br bt ">
                                                    <div class="col-md-4 ">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <table>
                                                                    <tr>

                                                                        <th>¿Fue Evaluado del pie en el Ultimo año?</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro46" class="form-control opcion3" type="radio" name="otro46" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro46" class="form-control opcion3" type="radio" name="otro46" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr class="bb bl br bt">
                                                                        <th colspan="4">Examen objetivo del pie</th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Uñas micoticas,distroficas o encarnadas</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro47" class="form-control opcion3" type="radio" name="otro47" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro47" class="form-control opcion3" type="radio" name="otro47" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Resequedad de la piel</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro48" class="form-control opcion3" type="radio" name="otro48" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro48" class="form-control opcion3" type="radio" name="otro48" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr class="bb bl br bt">
                                                                        <th colspan="4">Lesión Severa:evalue</th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Dedos en martillo,en garra</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro49" class="form-control opcion3" type="radio" name="otro49" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro49" class="form-control opcion3" type="radio" name="otro49" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Dedos superpuestos</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro50" class="form-control opcion3" type="radio" name="otro50" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro50" class="form-control opcion3" type="radio" name="otro50" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Amputación previa</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro51" class="form-control opcion3" type="radio" name="otro51" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro51" class="form-control opcion3" type="radio" name="otro51" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Juanetes o hallux Valgus</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro52" class="form-control opcion3" type="radio" name="otro52" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro52" class="form-control opcion3" type="radio" name="otro52" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Pie de Charcot o Plano o Cavo</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro53" class="form-control opcion3" type="radio" name="otro53" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro53" class="form-control opcion3" type="radio" name="otro53" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Úlcera aguda en pie</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro54" class="form-control opcion3" type="radio" name="otro54" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro54" class="form-control opcion3" type="radio" name="otro54" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Gangrena en pie</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro55" class="form-control opcion3" type="radio" name="otro55" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro55" class="form-control opcion3" type="radio" name="otro55" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr class="bb bl br bt">
                                                                        <th colspan="4">Pulsos</th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Pedio Der. Ausente</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro56" class="form-control opcion3" type="radio" name="otro56" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro56" class="form-control opcion3" type="radio" name="otro56" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Pedio Izq. Ausente</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro57" class="form-control opcion3" type="radio" name="otro57" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro57" class="form-control opcion3" type="radio" name="otro57" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Tibial Der. Ausente</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro58" class="form-control opcion3" type="radio" name="otro58" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro58" class="form-control opcion3" type="radio" name="otro58" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>

                                                                        <th>Tibial Izq. Ausente</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro59" class="form-control opcion3" type="radio" name="otro59" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro59" class="form-control opcion3" type="radio" name="otro59" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <img src="../imagenes/imagenPie.png" width="100%" height="100%">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row bb bl br bt ">
                                                    <div class="col-md-4 ">
                                                        <h5 class="mt-2 mb-2 titulo_area3" id="titulo_gasto"><em><b>EVALUACIÓN DE LA EDUCACIÓN</b> </em></h5>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table>
                                                                    <tr>
                                                                        <th>Ha tenido el paciente educación sobre cuidado de los pies</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro60" class="form-control opcion3" type="radio" name="otro60" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro60" class="form-control opcion3" type="radio" name="otro60" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Ha recibido educación en diabetes (3 ó más sesiones)?</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro61" class="form-control opcion3" type="radio" name="otro61" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro61" class="form-control opcion3" type="radio" name="otro61" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Se realiza automonitoreo de glucosa</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro62" class="form-control opcion3" type="radio" name="otro62" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro62" class="form-control opcion3" type="radio" name="otro62" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <h5 class="mt-2 mb-2 titulo_area3" id="titulo_gasto"><em><b>VALORACIÓN DEL CALZADO</b> </em></h5>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table>
                                                                    <tr>
                                                                        <th>Calzado en mal estado:roto,desgastado o deforme por el uso</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro63" class="form-control opcion3" type="radio" name="otro63" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro63" class="form-control opcion3" type="radio" name="otro63" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Calzado que deja al descubierto los dedos o el Talón</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro64" class="form-control opcion3" type="radio" name="otro64" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro64" class="form-control opcion3" type="radio" name="otro64" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Calzado de punta estrecha que comprimiera los dedos</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro65" class="form-control opcion3" type="radio" name="otro65" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro65" class="form-control opcion3" type="radio" name="otro65" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Calzado demasiado ancho que no permitiera un ajuste adecuado al pie</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro66" class="form-control opcion3" type="radio" name="otro66" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro66" class="form-control opcion3" type="radio" name="otro66" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Calzado de un tacón de altura superior a 2.5 cm.</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro67" class="form-control opcion3" type="radio" name="otro67" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro67" class="form-control opcion3" type="radio" name="otro67" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Calzado con costuras o imperfecciones en su interior que favorecen roces.</th>
                                                                        <th>
                                                                            <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="otro68" class="form-control opcion3" type="radio" name="otro68" value="1"></label></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="checradiokbox col-6">
                                                                                <label>NO
                                                                                    <input id="otro68" class="form-control opcion3" type="radio" name="otro68" value="2" checked></label></div>
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="op_4" role="tabpanel">
                                            <div class="container">
                                                <h5 class="mt-2 mb-2 titulo_area3" id="titulo_gasto"><em><b>GRADO DE INSTRUCCIÓN</b> </em></h5>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <table>
                                                            <tr>
                                                                <th>1.-</th>
                                                                <th>
                                                                    Primaria Incompleta
                                                                </th>
                                                                <th>
                                                                    <input  type="checkbox" class="checkOpcion" name="var1B" id="check1">
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>2.-</th>
                                                                <th>
                                                                    Primaria Completa
                                                                </th>
                                                                <th>
                                                                    <input  type="checkbox" class="checkOpcion" name="var1B" id="check2">
                                                                </th>
                                                            </tr>
                                                             <tr>
                                                                <th>2.-</th>
                                                                <th>
                                                                    Secundaria Completa
                                                                </th>
                                                                <th>
                                                                     <input  type="checkbox" class="checkOpcion" name="var1B" id="check3">
                                                                </th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                     <div class="col-md-3">
                                                        <table>
                                                            <tr>
                                                                <th>4.-</th>
                                                                <th>
                                                                    Secundaria Completa
                                                                </th>
                                                                <th>
                                                                     <input  type="checkbox" class="checkOpcion" name="var1B" id="check4">
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>5.-</th>
                                                                <th>
                                                                    Superior no Univ. Incompleto
                                                                </th>
                                                                <th>
                                                                     <input  type="checkbox" class="checkOpcion" name="var1B" id="check5">
                                                                </th>
                                                            </tr>
                                                             <tr>
                                                                <th>6.-</th>
                                                                <th>
                                                                    Superio No Uni. Completo
                                                                </th>
                                                                <th>
                                                                     <input  type="checkbox" class="checkOpcion" name="var1B" id="check6">
                                                                </th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <table>
                                                            <tr>
                                                                <th>7.-</th>
                                                                <th>
                                                                    Seperior Univ. Incompleto
                                                                </th>
                                                                <th>
                                                                    <input  type="checkbox" class="checkOpcion" name="var1B" id="check7">
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>8.-</th>
                                                                <th>
                                                                    Superior Univ. Completo
                                                                </th>
                                                                <th>
                                                                     <input  type="checkbox" class="checkOpcion" name="var1B" id="check8">
                                                                </th>
                                                            </tr>
                                                             <tr>
                                                                <th>0.-</th>
                                                                <th>
                                                                    Ninguno
                                                                </th>
                                                                <th>
                                                                    <input  type="checkbox" class="checkOpcion" name="var1B" id="check9">
                                                                </th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <hr>
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
                                                            <input type="date" class="form-control col-md-12" id="fecha_inicio" name="fecha_inicio">
                                                        </div>
                                                    </div>
                                                    <div class="  col-md-12">
                                                        <div class="form-group">
                                                            <label class="letras">Observaciones:</label>
                                                            <textarea class="form-control" rows="4" cols="3" name="observaciones" id="observaciones" maxlength="380" placeholder="Ingresar Descripción"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <label class="col-12 letras">Taller de Glucometria:</label>
                                                            <div class="radio  col-6"><label class="  letras">SI</label><input class="col-md-8" id="taller1" type="radio" name="taller1" value="1"></div>
                                                            <div class="radio  col-6"><label class="  letras">NO</label><input class="col-md-8" id="taller1" type="radio" name="taller1" value="2"></div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <label class="col-12 letras">Taller de Nutrición:</label>
                                                            <div class="radio  col-6"><label class="  letras">SI</label><input class="col-md-8" id="taller2" type="radio" name="taller2" value="1"></div>
                                                            <div class="radio  col-6"><label class="  letras">NO</label><input class="col-md-8" id="taller2" type="radio" name="taller2" value="2"></div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <label class="col-12 letras">Taller de "Conocimiento de la Diabetes":</label>
                                                            <div class="radio  col-6"><label class="  letras">SI</label><input class="col-md-8" id="taller3" type="radio" name="taller3" value="1"></div>
                                                            <div class="radio  col-6"><label class=" letras">NO</label><input class="col-md-8" id="taller3" type="radio" name="taller3" value="2"></div>
                                                        </div>

                                                    </div>

                                                    <div class="  col-md-4">
                                                        <div class="form-group">
                                                            <label class="letras">Proxima Cita:</label>
                                                            <input type="date" class="form-control col-md-12" id="proxima_cita" name="proxima_cita">
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                        </div>
                                        <div class="tab-pane" id="op_5" role="tabpanel">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <table>
                                                            <tr>
                                                                <th>FECHAS</th>
                                                                <th>
                                                                    <input type="date" class="form-control col-md-12 fechaOpcion" id="fecha1" name="fecha1" style="width:140px; font-size:12px;">
                                                                </th>
                                                                <th>
                                                                   <input type="date" class="form-control col-md-12 fechaOpcion" id="fecha2" name="fecha2" style="width:140px; font-size:12px;">
                                                                </th>
                                                                <th>
                                                                   <input type="date" class="form-control col-md-12 fechaOpcion" id="fecha3" name="fecha3" style="width:140px; font-size:12px;">
                                                                </th>
                                                                <th>
                                                                    <input type="date" class="form-control col-md-12 fechaOpcion" id="fecha4" name="fecha4" style="width:140px; font-size:12px;">
                                                                </th>
                                                                <th>
                                                                    <input type="date" class="form-control col-md-12 fechaOpcion" id="fecha5" name="fecha5" style="width:140px; font-size:12px;">
                                                                </th>
                                                                <th>
                                                                    <input type="date" class="form-control col-md-12 fechaOpcion" id="fecha6" name="fecha6" style="width:140px; font-size:12px;">
                                                                </th>
                                                                <th>
                                                                    <input type="date" class="form-control col-md-12 fechaOpcion" id="fecha7" name="fecha7" style="width:140px; font-size:12px;">
                                                                </th>


                                                            </tr>

                                                              <tr>
                                                                <th>Cumple Dieta</th>
                                                                <th>
                                                                  <div class="radio col-12">
                                                                                <label>SI
                                                                                    <input id="ra1" class="form-control opcion5" type="radio" name="ra1" value="1"></label></div>
                                                                    <div class="radio col-12">
                                                                                <label>NO
                                                                                    <input id="ra1" class="form-control opcion5" type="radio" name="ra1" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra2" class="form-control opcion5" type="radio" name="ra2" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra2" class="form-control opcion5" type="radio" name="ra2" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra3" class="form-control opcion5" type="radio" name="ra3" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra3" class="form-control opcion5" type="radio" name="ra3" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra4" class="form-control opcion5" type="radio" name="ra4" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra4" class="form-control opcion5" type="radio" name="ra4" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra5" class="form-control opcion5" type="radio" name="ra5" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra5" class="form-control opcion5" type="radio" name="ra5" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra6" class="form-control opcion5" type="radio" name="ra6" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra6" class="form-control opcion5" type="radio" name="ra6" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra7" class="form-control opcion5" type="radio" name="ra7" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra7" class="form-control opcion5" type="radio" name="ra7" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                            <tr>
                                                                <th>Cumple Caminatas</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra8" class="form-control opcion5" type="radio" name="ra8" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra8" class="form-control opcion5" type="radio" name="ra8" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra9" class="form-control opcion5" type="radio" name="ra9" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra9" class="form-control opcion5" type="radio" name="ra9" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra10" class="form-control opcion5" type="radio" name="ra10" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra10" class="form-control opcion5" type="radio" name="ra10" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra11" class="form-control opcion5" type="radio" name="ra11" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra11" class="form-control opcion5" type="radio" name="ra11" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra12" class="form-control opcion5" type="radio" name="ra12" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra12" class="form-control opcion5" type="radio" name="ra12" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra13" class="form-control opcion5" type="radio" name="ra13" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra13" class="form-control opcion5" type="radio" name="ra13" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra14" class="form-control opcion5" type="radio" name="ra14" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra14" class="form-control opcion5" type="radio" name="ra14" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                            <tr>
                                                                <th>Cumple Medicación</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra15" class="form-control opcion5" type="radio" name="ra15" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra15" class="form-control opcion5" type="radio" name="ra15" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra16" class="form-control opcion5" type="radio" name="ra16" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra16" class="form-control opcion5" type="radio" name="ra16" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra17" class="form-control opcion5" type="radio" name="ra17" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra17" class="form-control opcion5" type="radio" name="ra17" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra18" class="form-control opcion5" type="radio" name="ra18" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra18" class="form-control opcion5" type="radio" name="ra18" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra19" class="form-control opcion5" type="radio" name="ra19" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra19" class="form-control opcion5" type="radio" name="ra19" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra20" class="form-control opcion5" type="radio" name="ra20" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra20" class="form-control opcion5" type="radio" name="ra20" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra21" class="form-control opcion5" type="radio" name="ra21" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra21" class="form-control opcion5" type="radio" name="ra21" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                            <tr>
                                                                <th>Cumple Medicación DM2</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra22" class="form-control opcion5" type="radio" name="ra22" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra22" class="form-control opcion5" type="radio" name="ra22" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra23" class="form-control opcion5" type="radio" name="ra23" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra23" class="form-control opcion5" type="radio" name="ra23" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra24" class="form-control opcion5" type="radio" name="ra24" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra24" class="form-control opcion5" type="radio" name="ra24" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra25" class="form-control opcion5" type="radio" name="ra25" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra25" class="form-control opcion5" type="radio" name="ra25" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra26" class="form-control opcion5" type="radio" name="ra26" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra26" class="form-control opcion5" type="radio" name="ra26" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra27" class="form-control opcion5" type="radio" name="ra27" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra27" class="form-control opcion5" type="radio" name="ra27" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra28" class="form-control opcion5" type="radio" name="ra28" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra28" class="form-control opcion5" type="radio" name="ra28" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                             <tr>
                                                                <th>Recibio Educación</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra29" class="form-control opcion5" type="radio" name="ra29" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra29" class="form-control opcion5" type="radio" name="ra29" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra30" class="form-control opcion5" type="radio" name="ra30" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra30" class="form-control opcion5" type="radio" name="ra30" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra31" class="form-control opcion5" type="radio" name="ra31" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra31" class="form-control opcion5" type="radio" name="ra31" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra32" class="form-control opcion5" type="radio" name="ra32" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra32" class="form-control opcion5" type="radio" name="ra32" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra33" class="form-control opcion5" type="radio" name="ra33" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra33" class="form-control opcion5" type="radio" name="ra33" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra34" class="form-control opcion5" type="radio" name="ra34" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra34" class="form-control opcion5" type="radio" name="ra34" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra35" class="form-control opcion5" type="radio" name="ra35" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra35" class="form-control opcion5" type="radio" name="ra35" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                             <tr>
                                                                <th>Tuvo Hipoglicemia</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra36" class="form-control opcion5" type="radio" name="ra36" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra36" class="form-control opcion5" type="radio" name="ra36" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra37" class="form-control opcion5" type="radio" name="ra37" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra37" class="form-control opcion5" type="radio" name="ra37" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra38" class="form-control opcion5" type="radio" name="ra38" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra38" class="form-control opcion5" type="radio" name="ra38" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra39" class="form-control opcion5" type="radio" name="ra39" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra39" class="form-control opcion5" type="radio" name="ra39" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra40" class="form-control opcion5" type="radio" name="ra40" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra40" class="form-control opcion5" type="radio" name="ra40" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra41" class="form-control opcion5" type="radio" name="ra41" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra41" class="form-control opcion5" type="radio" name="ra41" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra42" class="form-control opcion5" type="radio" name="ra42" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra42" class="form-control opcion5" type="radio" name="ra42" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                             <tr>
                                                                <th>Tiene Ulcera en el pie?</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra43" class="form-control opcion5" type="radio" name="ra43" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra43" class="form-control opcion5" type="radio" name="ra43" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra44" class="form-control opcion5" type="radio" name="ra44" value="1" checked></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra44" class="form-control opcion5" type="radio" name="ra44" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra45" class="form-control opcion5" type="radio" name="ra45" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra45" class="form-control opcion5" type="radio" name="ra45" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra46" class="form-control opcion5" type="radio" name="ra46" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra46" class="form-control opcion5" type="radio" name="ra46" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra47" class="form-control opcion5" type="radio" name="ra47" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra47" class="form-control opcion5" type="radio" name="ra47" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra48" class="form-control opcion5" type="radio" name="ra48" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra48" class="form-control opcion5" type="radio" name="ra48" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra49" class="form-control opcion5" type="radio" name="ra49" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra49" class="form-control opcion5" type="radio" name="ra49" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                              <tr>
                                                                <th>Automonitoreo de glucosa</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra50" class="form-control opcion5" type="radio" name="ra50" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra50" class="form-control opcion5" type="radio" name="ra50" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra51" class="form-control opcion5" type="radio" name="ra51" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra51" class="form-control opcion5" type="radio" name="ra51" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra52" class="form-control opcion5" type="radio" name="ra52" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra52" class="form-control opcion5" type="radio" name="ra52" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra53" class="form-control opcion5" type="radio" name="ra53" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra53" class="form-control opcion5" type="radio" name="ra53" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra54" class="form-control opcion5" type="radio" name="ra54" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra54" class="form-control opcion5" type="radio" name="ra54" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra55" class="form-control opcion5" type="radio" name="ra55" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra55" class="form-control opcion5" type="radio" name="ra55" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra56" class="form-control opcion5" type="radio" name="ra56" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra56" class="form-control opcion5" type="radio" name="ra56" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                            <tr>
                                                                <th>Se Hospitalizo</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra57" class="form-control opcion5" type="radio" name="ra57" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra57" class="form-control opcion5" type="radio" name="ra57" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra58" class="form-control opcion5" type="radio" name="ra58" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra58" class="form-control opcion5" type="radio" name="ra58" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra59" class="form-control opcion5" type="radio" name="ra59" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra59" class="form-control opcion5" type="radio" name="ra59" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra60" class="form-control opcion5" type="radio" name="ra60" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra60" class="form-control opcion5" type="radio" name="ra60" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra61" class="form-control opcion5" type="radio" name="ra61" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra61" class="form-control opcion5" type="radio" name="ra61" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra62" class="form-control opcion5" type="radio" name="ra62" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra62" class="form-control opcion5" type="radio" name="ra62" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra63" class="form-control opcion5" type="radio" name="ra63" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra63" class="form-control opcion5" type="radio" name="ra63" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                            <tr>
                                                                <th>Electrocardiograma</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra64" class="form-control opcion5" type="radio" name="ra64" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra64" class="form-control opcion5" type="radio" name="ra64" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra65" class="form-control opcion5" type="radio" name="ra65" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra65" class="form-control opcion5" type="radio" name="ra65" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra66" class="form-control opcion5" type="radio" name="ra66" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra66" class="form-control opcion5" type="radio" name="ra66" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra67" class="form-control opcion5" type="radio" name="ra67" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra67" class="form-control opcion5" type="radio" name="ra67" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra68" class="form-control opcion5" type="radio" name="ra68" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra68" class="form-control opcion5" type="radio" name="ra68" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra69" class="form-control opcion5" type="radio" name="ra69" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra69" class="form-control opcion5" type="radio" name="ra69" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra70" class="form-control opcion5" type="radio" name="ra70" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra70" class="form-control opcion5" type="radio" name="ra70" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                            <tr>
                                                                <th>Chequeo de retinopatia</th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra71" class="form-control opcion5" type="radio" name="ra71" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra71" class="form-control opcion5" type="radio" name="ra71" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra72" class="form-control opcion5" type="radio" name="ra72" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra72" class="form-control opcion5" type="radio" name="ra72" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra73" class="form-control opcion5" type="radio" name="ra73" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra73" class="form-control opcion5" type="radio" name="ra73" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra74" class="form-control opcion5" type="radio" name="ra74" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra74" class="form-control opcion5" type="radio" name="ra74" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                  <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra75" class="form-control opcion5" type="radio" name="ra75" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra75" class="form-control opcion5" type="radio" name="ra75" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra76" class="form-control opcion5" type="radio" name="ra76" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra76" class="form-control opcion5" type="radio" name="ra76" value="2" checked></label></div>
                                                                </th>
                                                                <th>
                                                                   <div class="radio col-6">
                                                                                <label>SI
                                                                                    <input id="ra77" class="form-control opcion5" type="radio" name="ra77" value="1"></label></div>
                                                                    <div class="radio col-6">
                                                                                <label>NO
                                                                                    <input id="ra77" class="form-control opcion5" type="radio" name="ra77" value="2" checked></label></div>
                                                                </th>


                                                            </tr>
                                                        </table>

                                                    </div>
                                                </div>
                                                <hr>
                                                 <div class="row">
                                                    <div class="col-md-4">
                                                        <button id="volver_boton" type="button" class="btn btn-info " onclick="volver_ficha(<?php echo $_POST['idPaciente']?>);">VOLVER</button>
                                                    </div>

                                                    <div class="col-md-4 offset-4">
                                                        <button id="grabar_boton" type="button" class="btn btn-success" onclick="GuardarSeguimiento();">GUARDAR</button>
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
        </div>
    </div>
</section>
<!-- Fin Modal Agregar-->
<!-- Fin del Cuerpo del Sistema del Menu-->
<!-- Inicio del footer -->
<?php require_once('../layaout/Footer.php');?>
<!-- Fin del Footer -->
<script src="<?php echo $conexionConfig->rutaOP(); ?>vista/js/Seguimiento.js"></script>
