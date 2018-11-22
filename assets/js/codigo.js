function notificar_danger(mensaje) {
   var me_error="<i class='fa fa-close'></i> ";

   var options =$("#notify_danger").data('options');
   var message = me_error+mensaje;
   if (!message)
   $.error('Notify: No message specified');
   $.notify(message, options || {});
}
function notificar_success(mensaje) {
   var me_success="<i class='fa fa-check'></i> ";
   var options =$("#notify_success").data('options');
   var message =me_success+mensaje;
   if (!message)
   $.error('Notify: No message specified');
   $.notify(message, options || {});
}
function notificar_info(mensaje) {
   var me_info="<i class='fa fa-info-circle'></i> ";
   var options =$("#notify_info").data('options');
   var message = me_info+mensaje;
   if (!message)
   $.error('Notify: No message specified');
   $.notify(message, options || {});
}
function notificar_warning(mensaje) {
   var me_warning="<i class='fa fa-exclamation-triangle'></i> ";
   var options =$("#notify_warning").data('options');
   var message = me_warning+mensaje;
   if (!message)
   $.error('Notify: No message specified');
   $.notify(message, options || {});
}

function format_mes(Mes){
   var Mes;
   Mes=Mes-1;
   var Meses=['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', ' DICIEMBRE'];
   var STMes;

   STMes=Meses[Mes];
   return STMes;
}

jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
	return this.flatten().reduce( function ( a, b ) {
		if ( typeof a === 'string' ) {
			a = a.replace(/[^\d.-]/g, '') * 1;
		}
		if ( typeof b === 'string' ) {
			b = b.replace(/[^\d.-]/g, '') * 1;
		}

		return a + b;
	}, 0 );
} );

/* Cerrar Session */
function cerrarSession(){
   swal({
      title: "Cerrar Sesión",
      text: "Esta Seguro de Cerrar Sesión",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Cerrar Sesión",
      closeOnConfirm: false
   },
   function() {
      window.location.replace("../Menu/logouth.php");
   });
}

function PerfilUsuarioOperaciones(){
	 window.location.replace("../Usuario/PerfilUsuario.php");
}

$(document).ready(function(){

   $('[data-toggle="tooltip"]').tooltip();

   $('.num-input').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g,'');});
});

$.fn.datepicker.dates['es'] = {
    days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
    daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    today: "Hoy",
    clear: "Clear",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};

function hoyFecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();

        dd = addZero(dd);
        mm = addZero(mm);

        return dd+'/'+mm+'/'+yyyy;
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}


function Formato_Moneda(amount, decimals) {
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}


function SoloNumerosModificado(e,num,id){
	var path="#"+id;
	var da=$(path).val().length;
	if(da==num){
		return false;
	}else{
	var keynum = window.event ? window.event.keyCode : e.which;
		if ((keynum == 8) || (keynum == 46)){
			return true;
		}else{
			return /\d/.test(String.fromCharCode(keynum));
	}
	}
}

function SoloLetras(e,num,id){
	var path="#"+id;
	var da=$(path).val().length;
	if(da==num){
		return false;
	}else{
		var tecla = document.all ? tecla = e.keyCode : tecla = e.which;
		return !((tecla > 47 && tecla < 58) || tecla == 46);
	}
}





