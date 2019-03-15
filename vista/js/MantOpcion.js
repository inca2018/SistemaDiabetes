var ArregloFormula;
var Formula = "";
var tablaOpcion;

function init() {
    OcultarElementos();
    var idGrupoOpcion = $("#idGrupoOpcion").val();
    RecuperarInformacionGrupoOpciones(idGrupoOpcion);
    Iniciar_componentes();
    Listar_Opcion(idGrupoOpcion);
}

function Iniciar_componentes() {
    ElementoTipoValidacion(true);
    $('#OpcionTipo').on('change', function () {
        var tipoOpcion = $('#OpcionTipo').val();
        OcultarElementos();
        switch (tipoOpcion) {
            case "1":
                ElementoTituloMostrar(true);
                ElementoTituloValidacion(true);
                break;
            case "2":
                ElementoTituloMostrar(true);
                ElementoTituloValidacion(true);
                break;
            case "3":
                ElementoTituloMostrar(true);
                ElementoRangoMostrar(true);

                ElementoTituloValidacion(true);
                ElementoAtributoValidacion(true);
                ElementoMinimoValidacion(true);
                ElementoMaximoValidacion(true);
                break;
            case "4":
                ElementoTituloMostrar(true);
                ElementoRangoSexoMostrar(true);

                ElementoTituloValidacion(true);
                OpcionAtributoHombreValidacion(true);
                OpcionMinimoHombreValidacion(true);
                OpcionMaximoHombreValidacion(true);
                OpcionAtributoMujerValidacion(true);
                OpcionMinimoMujerValidacion(true);
                OpcionMaximoMujerValidacion(true);
                break;
            case "5":
                ElementoTituloMostrar(true);
                ElementoTituloValidacion(true);
                break;
            case "6":
                if (ArregloFormula == null) {
                    ArregloFormula = new Array();
                }
                ElementoTituloMostrar(true);
                ElementoTituloValidacion(true);
                ElementoFormulaMostrar(true);

                ElementoTituloValidacion(true);
                OpcionMinimoFormulaValidacion(true);
                OpcionMaximoFormulaValidacion(true);
                break;
            case "7":
                ElementoTituloMostrar(true);
                ElementoTituloValidacion(true);
                break;
            case "9":
                ElementoTituloMostrar(true);
                ElementoTituloValidacion(true);

                ElementoCondicionCampoMostrar(true);
                OpcionTipoCampoMostrar(true);
                OpcionTipoCampoValidacion(true);

                break;
            case "10":
                ElementoTituloMostrar(true);
                ElementoTituloValidacion(true);
                break;
            case "11":
                ElementoTituloMostrar(true);
                ElementoTituloValidacion(true);
                OpcionListados(true);
                ElementoListados(true);
            break;
        }
    });


    $("#OpcioneCampo1").on("blur", function () {
        var val = $("#OpcioneCampo1").val();
        if (val == "") {
            $("#botonV1").attr("disabled", true);
        } else {
            $("#botonV1").removeAttr("disabled");
        }
    });
    $("#OpcioneCampo2").on("blur", function () {
        var val = $("#OpcioneCampo2").val();
        if (val == "") {
            $("#botonV2").attr("disabled", true);
        } else {
            $("#botonV2").removeAttr("disabled");
        }
    });
    $("#OpcioneCampo3").on("blur", function () {
        var val = $("#OpcioneCampo3").val();
        if (val == "") {
            $("#botonV3").attr("disabled", true);
        } else {
            $("#botonV3").removeAttr("disabled");
        }
    });
    $("#OpcioneCampo4").on("blur", function () {
        var val = $("#OpcioneCampo4").val();
        if (val == "") {
            $("#botonV4").attr("disabled", true);
        } else {
            $("#botonV4").removeAttr("disabled");
        }
    });

}

function Listar_Opcion(idGrupoOpcion) {
    tablaOpcion = $('#tablaOpcion').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "processing": true,
        "paging": true, // Paginacion en tabla
        "ordering": true, // Ordenamiento en columna de tabla
        "info": true, // Informacion de cabecera tabla
        "responsive": true, // Accion de responsive
        "ajax": { //Solicitud Ajax Servidor
            url: '../../controlador/Mantenimiento/COpcion.php?op=Listar_Opcion',
            type: "POST",
            dataType: "JSON",
            data: {
                idGrupoOpcion: idGrupoOpcion
            },
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [1, 2, 3, 4]
            }
            , {
                "className": "text-left",
                "targets": [0]
            }
         , ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-info'
            }
            , {
                extend: 'csv',
                className: 'btn-info'
            }
            , {
                extend: 'excel',
                className: 'btn-info',
                title: ''
            }
            , {
                extend: 'pdf',
                className: 'btn-info',
                title: $('title').text()
            }
            , {
                extend: 'print',
                className: 'btn-info'
            }
            ],
        // cambiar el lenguaje de datatable
        oLanguage: español,
    }).DataTable();
    //Aplicar ordenamiento y autonumeracion , index
    tablaOpcion.on('order.dt search.dt', function () {
        tablaOpcion.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function OcultarElementos() {
    /*elementos*/
    ElementoTituloMostrar(false);
    ElementoRangoMostrar(false);
    ElementoRangoSexoMostrar(false);
    ElementoFormulaMostrar(false);
    ElementoCondicionCampoMostrar(false);
    OpcionTipoCampoMostrar(false);
    OpcionListados(false);
    /*validacion*/
    ElementoTituloValidacion(false);
    ElementoAtributoValidacion(false);
    ElementoMinimoValidacion(false);
    ElementoMaximoValidacion(false);
    OpcionTipoCampoValidacion(false);
    ElementoListados(false);

    OpcionAtributoHombreValidacion(false);
    OpcionMinimoHombreValidacion(false);
    OpcionMaximoHombreValidacion(false);
    OpcionAtributoMujerValidacion(false);
    OpcionMinimoMujerValidacion(false);
    OpcionMaximoMujerValidacion(false);
    OpcionMinimoFormulaValidacion(false);
    OpcionMaximoFormulaValidacion(false);
    BorrarOperacion();
}

function RecuperarInformacionGrupoOpciones(idGrupoOpcion) {

    $.post("../../controlador/Mantenimiento/COpcion.php?op=RecuperarInformacionGrupoOpciones", {
        "idGrupoOpcion": idGrupoOpcion
    }, function (data, status) {
        data = JSON.parse(data);
        $("#TituloGrupoOpcion").empty();
        $("#TituloGrupoOpcion").append(data.TituloGrupoOpciones);

    });
}

function LanzarPrueba() {
    var objeto = '{"string": "Hello World","tipo": 2,"titulo": "Hola Mundo","minimo1": 12,"maximo1": 20}';
    objeto = JSON.parse(objeto);
    console.log(objeto.tipo);
}

function VerificarOpcion() {

    var error = "";
    $(".validarPanel").each(function () {
        if ($(this).val() == " " || $(this).val() == 0) {
            error = error + $(this).data("message") + "<br>";
        }
    });


    var op = $("#OpcionTipo").val();
    if (op == 6) {
        var total = 0;
        var camp1 = $("#OpcioneCampo1").val();
        var camp2 = $("#OpcioneCampo2").val();
        var camp3 = $("#OpcioneCampo3").val();
        var camp4 = $("#OpcioneCampo4").val();
        (camp1 != "") ? total = total + 1: 0;
        (camp2 != "") ? total = total + 1: 0;
        (camp3 != "") ? total = total + 1: 0;
        (camp4 != "") ? total = total + 1: 0;
        if (total < 1) {
            error = error + "- Ingrese al Menos una Variable" + "<br>";
        }
        if (ArregloFormula != null) {
            if (ArregloFormula.length < 2) {
                error = error + "- Genere la Formula con minimo una Operación" + "<br>";
            }
        }
    }

    if (error == "") {
        $("#ModalOpcion #cuerpo").addClass("whirl");
        $("#ModalOpcion #cuerpo").addClass("ringed");
        setTimeout('AjaxRegistroOpcion()', 1000);
    } else {
        notificar_warning("Complete :<br>" + error);
    }
}

function AjaxRegistroOpcion() {

    var Propiedad = VerificacionTipoOpcion();
    var idGrupoOpcion = $("#idGrupoOpcion").val();
    var TipoOpcion = $("#OpcionTipo").val();
    var OpcionTitulo = $("#OpcionTitulo").val();
    $.ajax({
        url: "../../controlador/Mantenimiento/COpcion.php?op=AccionOpcion",
        type: "POST",
        data: {
            Propiedades: Propiedad,
            idGrupoOpcion: idGrupoOpcion,
            TipoOpcion: TipoOpcion,
            OpcionTitulo: OpcionTitulo
        },
        success: function (data, status) {
            data = JSON.parse(data);
            console.log(data);
            var Mensaje = data.Mensaje;
            var Registro = data.Registro;
            if (!Registro) {
                $("#ModalOpcion #cuerpo").removeClass("whirl");
                $("#ModalOpcion #cuerpo").removeClass("ringed");
                $("#ModalOpcion").modal("hide");
                swal("Error:", Mensaje, "error");
                OcultarElementos();
                Limpiar();
                tablaOpcion.ajax.reload();
            } else {
                $("#ModalOpcion #cuerpo").removeClass("whirl");
                $("#ModalOpcion #cuerpo").removeClass("ringed");
                $("#ModalOpcion").modal("hide");
                swal("Acción:", Mensaje, "success");
                OcultarElementos();
                Limpiar();
                tablaOpcion.ajax.reload();
            }
        }
    });
}

function VerificacionTipoOpcion() {
    var Propiedades = "";
    var tipoOpcion = $('#OpcionTipo').val();
    var titulo = $("#OpcionTitulo").val();

    switch (tipoOpcion) {
        case "1":
            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Cabecera","Titulo":"' + titulo + '"}';
            break;
        case "2":
            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Opcion Campo Texto","Titulo":"' + titulo + '"}';
            break;
        case "3":
            var atributo = $("#OpcionAtributo").val();
            var minimo = $("#OpcionMinimo").val();
            var maximo = $("#OpcionMaximo").val();

            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Opcion Rango","Titulo":"' + titulo + '","Atributo":"' + atributo + '","Minimo":' + minimo + ',"Maximo":' + maximo + '}';
            break;
        case "4":
            var atributoHombre = $("#OpcionAtributoHombre").val();
            var minimoHombre = $("#OpcionMinimoHombre").val();
            var maximoHombre = $("#OpcionMaximoHombre").val();
            var atributoMujer = $("#OpcionAtributoMujer").val();
            var minimoMujer = $("#OpcionMinimoMujer").val();
            var maximoMujer = $("#OpcionMaximoMujer").val();
            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Opcion Rango-Sexo","Titulo":"' + titulo + '","AtributoHombre":"' + atributoHombre + '","MinimoHombre":' + minimoHombre + ',"MaximoHombre":' + maximoHombre + ',"AtributoMujer":"' + atributoMujer + '","MinimoMujer":' + minimoMujer + ',"MaximoMujer":' + maximoMujer + '}';
            break;
        case "5":
            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Opcion Campo Fecha","Titulo":"' + titulo + '"}';
            break;
        case "6":
            var camp1 = $("#OpcioneCampo1").val();
            var camp2 = $("#OpcioneCampo2").val();
            var camp3 = $("#OpcioneCampo3").val();
            var camp4 = $("#OpcioneCampo4").val();

            var minimo = $("#OpcionMinimoFormula").val();
            var maximo = $("#OpcionMaximoFormula").val();


            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Opcion Formula","Titulo":"' + titulo + '","minimo":"'+minimo+'","maximo":"'+maximo+'","variable1":"' + camp1 + '","variable2":"' + camp2 + '","variable3":"' + camp3 + '","variable4":"' + camp4 + '","Formula":"' + Formula + '"}';
            break;
        case "7":
            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Opcion Condición","Titulo":"' + titulo + '"}';
            break;

        case "9":
            var tipoCampos = $("#OpcionTipoCampo").val();
            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Opcion Condición Campos","Titulo":"' + titulo + '","TipoCampo":' + tipoCampos + '}';
            break;
        case "10":
            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"SubCabecera","Titulo":"' + titulo + '"}';
            break;
        case "11":
            var tipoCampos = $("#OpcionTipoCampo2").val();
            var Propiedades = '{"TipoOpcion":' + tipoOpcion + ',"CodigoOpcion":"Opcion Listado","Titulo":"' + titulo + '","TipoCampo":' + tipoCampos + '}';
            break;
    }

    return Propiedades;
}

function Agregar(valor) {

    var area = $("#area_formula");

    if (ArregloFormula == null) {
        ArregloFormula = new Array();
    }
    if (ArregloFormula.length > 9) {
        notificar_warning("No puede agregar mas de 10 Valores.");
    } else {


        area.html("");
        switch (valor) {
            case 1:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-info text-center" title="Suma">+</button></div>';
                ArregloFormula.push(obj);
                Formula = Formula + "+SEP";
                break;
            case 2:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-info text-center" title="Resta">-</button> </div>';
                ArregloFormula.push(obj);
                Formula = Formula + "-SEP";
                break;
            case 3:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-info text-center" title="Multiplicación" >*</button> </div>';
                ArregloFormula.push(obj);
                Formula = Formula + "*SEP";
                break;
            case 4:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-info text-center" title="División">%</button> </div>';
                ArregloFormula.push(obj);
                Formula = Formula + "/SEP";
                break;
            case 5:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-info text-center" title="Inicio Parentesís">(</button> </div>';
                ArregloFormula.push(obj);
                Formula = Formula + "(SEP";
                break;
            case 6:
                var obj = ' <div class="col-md-1"><button class="OpcionBoton btn btn-info text-center" title="Fin Parentesís">)</button> </div>';
                ArregloFormula.push(obj);
                Formula = Formula + ")SEP";
                break;
            case 7:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-info text-center" title="Exponente">X<sup>2</sup></button></div> ';
                ArregloFormula.push(obj);
                Formula = Formula + "EXPSEP";
                break;
            case 8:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-success text-center" title="Variable 1">V1</button></div>';
                ArregloFormula.push(obj);
                Formula = Formula + "V1SEP";
                break;
            case 9:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-success text-center" title="Variable 2">V2</button> </div>';
                ArregloFormula.push(obj);
                Formula = Formula + "V2SEP";
                break;
            case 10:
                var obj = ' <div class="col-md-1"><button class="OpcionBoton btn btn-success text-center" title="Variable 3">V3</button> </div>';
                ArregloFormula.push(obj);
                Formula = Formula + "V3SEP";
                break;
            case 11:
                var obj = '<div class="col-md-1"><button class="OpcionBoton btn btn-success text-center" title="Variable 4">V4</button></div> ';
                ArregloFormula.push(obj);
                Formula = Formula + "V4SEP";
                break;

        }
        var temporal = "";

        ArregloFormula.forEach(function (element) {
            temporal = temporal + element;
        });

        area.html(temporal);
    }
}

function BorrarOperacion() {
    if (ArregloFormula != null) {
        ArregloFormula = [];
        $("#area_formula").html("");
        Formula = "";
    }
}

function NuevoOpcion() {

    $("#ModalOpcion").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#ModalOpcion").modal("show");
    $("#tituloModalOpcion").empty();
    $("#tituloModalOpcion").append("Nuevo Registro de Opcion:");

    ListarTipoOpcion();
}

function ListarTipoOpcion() {
    $.post("../../controlador/Mantenimiento/COpcion.php?op=ListarTipoOpcion", function (ts) {
        $("#OpcionTipo").empty();
        $("#OpcionTipo").append(ts);
    });

}

function LimpiarOpcion() {
    $('#FormularioOpcion')[0].reset();
    $("#idOpcion").val("");
}

function Cancelar() {
    LimpiarOpcion();
    $("#ModalOpcion").modal("hide");

}


function EliminarOpcion(idOpcion) {
    swal({
        title: "Eliminar?",
        text: "Esta Seguro que desea Eliminar Opción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/COpcion.php?op=Eliminar_Opcion", {
            idOpcion: idOpcion
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Eliminado!", Mensaje, "success");
                tablaOpcion.ajax.reload();
            }
        });
    });
}

function ActivacionOpcion(idOpcion) {
    swal({
        title: "Activar?",
        text: "Esta Seguro que desea Activar Opción!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Activar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/COpcion.php?op=Activacion_Opcion", {
            idOpcion: idOpcion,
            Opcion: 1
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Activado !", Mensaje, "success");
                tablaOpcion.ajax.reload();
            }
        });
    });
}

function DesactivacionOpcion(idOpcion) {
    swal({
        title: "Desactivar?",
        text: "Esta Seguro que desea Desactivar Opción!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Desactivar!",
        closeOnConfirm: false
    }, function () {
        $.post("../../controlador/Mantenimiento/COpcion.php?op=Activacion_Opcion", {
            idOpcion: idOpcion,
            Opcion: 2
        }, function (data, e) {
            data = JSON.parse(data);
            var Error = data.Error;
            var Mensaje = data.Mensaje;
            if (Error) {
                swal("Error", Mensaje, "error");
            } else {
                swal("Desactivado !", Mensaje, "success");
                tablaOpcion.ajax.reload();
            }
        });
    });
}


/** Funciones Mostrar **/

function ElementoTipoMostrar(valor) {
    (valor) ? $("#ElementoTipo").show(): $("#ElementoTipo").hide();
}

function ElementoTituloMostrar(valor) {
    (valor) ? $("#ElementoTitulo").show(): $("#ElementoTitulo").hide();
}

function ElementoRangoMostrar(valor) {
    (valor) ? $("#ElementoRango").show(): $("#ElementoRango").hide();
}

function ElementoRangoSexoMostrar(valor) {
    (valor) ? $("#ElementoRangoSexo").show(): $("#ElementoRangoSexo").hide();
}

function ElementoFormulaMostrar(valor) {
    (valor) ? $("#ElementoFormula").show(): $("#ElementoFormula").hide();
}

function ElementoCondicionCampoMostrar(valor) {
    (valor) ? $("#ElementoCondicionCampo").show(): $("#ElementoCondicionCampo").hide();
}

function OpcionTipoCampoMostrar(valor) {
    (valor) ? $("#OpcionTipoCampo").show(): $("#OpcionTipoCampo").hide();
}

function OpcionListados(valor) {
    (valor) ? $("#ElementoListados").show(): $("#ElementoListados").hide();
}



/** Funciones Validacion **/
function ElementoListados(valor) {
    (valor) ? $("#OpcionTipoCampo2").addClass("validarPanel"): $("#OpcionTipoCampo2").removeClass("validarPanel");
}

function ElementoTipoValidacion(valor) {
    (valor) ? $("#OpcionTipo").addClass("validarPanel"): $("#OpcionTipo").removeClass("validarPanel");
}

function ElementoTituloValidacion(valor) {
    (valor) ? $("#OpcionTitulo").addClass("validarPanel"): $("#OpcionTitulo").removeClass("validarPanel");
}

function ElementoAtributoValidacion(valor) {
    (valor) ? $("#OpcionAtributo").addClass("validarPanel"): $("#OpcionAtributo").removeClass("validarPanel");
}

function ElementoMinimoValidacion(valor) {
    (valor) ? $("#OpcionMinimo").addClass("validarPanel"): $("#OpcionMinimo").removeClass("validarPanel");
}

function ElementoMaximoValidacion(valor) {
    (valor) ? $("#OpcionMaximo").addClass("validarPanel"): $("#OpcionMaximo").removeClass("validarPanel");
}

function OpcionAtributoHombreValidacion(valor) {
    (valor) ? $("#OpcionAtributoHombre").addClass("validarPanel"): $("#OpcionAtributoHombre").removeClass("validarPanel");
}

function OpcionMinimoHombreValidacion(valor) {
    (valor) ? $("#OpcionMinimoHombre").addClass("validarPanel"): $("#OpcionMinimoHombre").removeClass("validarPanel");
}

function OpcionMaximoHombreValidacion(valor) {
    (valor) ? $("#OpcionMaximoHombre").addClass("validarPanel"): $("#OpcionMaximoHombre").removeClass("validarPanel");
}

function OpcionAtributoMujerValidacion(valor) {
    (valor) ? $("#OpcionAtributoMujer").addClass("validarPanel"): $("#OpcionAtributoMujer").removeClass("validarPanel");
}

function OpcionMinimoMujerValidacion(valor) {
    (valor) ? $("#OpcionMinimoMujer").addClass("validarPanel"): $("#OpcionMinimoMujer").removeClass("validarPanel");
}

function OpcionMaximoMujerValidacion(valor) {
    (valor) ? $("#OpcionMaximoMujer").addClass("validarPanel"): $("#OpcionMaximoMujer").removeClass("validarPanel");
}

function OpcionTipoCampoValidacion(valor) {
    (valor) ? $("#OpcionTipoCampo").addClass("validarPanel"): $("#OpcionTipoCampo").removeClass("validarPanel");
}

function OpcionMinimoFormulaValidacion(valor) {
    (valor) ? $("#OpcionMinimoFormula").addClass("validarPanel"): $("#OpcionMinimoFormula").removeClass("validarPanel");
}
function OpcionMaximoFormulaValidacion(valor) {
    (valor) ? $("#OpcionMaximoFormula").addClass("validarPanel"): $("#OpcionMaximoFormula").removeClass("validarPanel");
}



function Limpiar() {
    $('#FormularioOpcion')[0].reset();
}

function volver() {
    $.redirect('../../vista/Mantenimiento/MantGrupoOpcion.php');
}
init();
