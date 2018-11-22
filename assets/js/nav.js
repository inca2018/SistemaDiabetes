$(document).ready(function(){
      var path = window.location.pathname.split('/');
      const  Nav_link=path[path.length-1].replace('.php','');
         path = "#"+Nav_link;
         $(path).addClass('active');

   if(Nav_link=="Cliente" || Nav_link=="DCliente" || Nav_link=="TipoServicio"){
      $("#Gestion").addClass('active');
      $("#Gestion #level0").trigger('click');
      if(Nav_link=="DCliente"){
         $("#Gestion").addClass('active');
      }
   }
   else if(Nav_link=="Rol"){
      $("#MRol").addClass('active');
      $("#MRol #level0").trigger('click');
   }
   else if(Nav_link=="Personal" || Nav_link=="DPersonal"){
      $("#MPersonal").addClass('active');
      $("#MPersonal #level0").trigger('click');
   }
   else if(Nav_link=="Asignacion" || Nav_link=="GeneracionFactura"){
      $("#Servicios").addClass('active');
      $("#Servicios #level0").trigger('click');
   }

   else if(Nav_link=="GeneralPreFactura" || Nav_link=="ReporteCliente" || Nav_link=="InformacionAsignacion"){
      $("#Servicios").addClass('active');
      $("#Servicios #level0").trigger('click');
      $("#Servicios #nav1").trigger('click');
      $("#InformacionServicio").addClass('active2');
   }
   else if(Nav_link=="DCliente"){
      $("#Operaciones").addClass('active');
      $("#Operaciones #level0").trigger('click');
      $("#Cliente").addClass('active');
   }

});
