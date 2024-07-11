//import './validacion.js';

$(document).ready(function(){
  // Detectar la preferencia del usuario
  const userPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  const theme = $('.icon-theme');

  // Aplicar la clase dark-mode si el usuario prefiere el modo oscuro
  
  if (userPrefersDark) {
    $('body').addClass('dark-mode');
    theme.addClass('icon-sun-inv');
  }else{
    theme.addClass('icon-moon');
  }

  // Alternar entre modos cuando se hace clic en el botón
  $('#toggle-dark-mode').on('click', function() {
    $('body').toggleClass('dark-mode');
    
    // Guardar la preferencia del usuario en localStorage
    if ($('body').hasClass('dark-mode')) {
      localStorage.setItem('theme', 'dark');
      theme.toggleClass('icon-moon icon-sun-inv');
    } else {
      localStorage.setItem('theme', 'light');
      theme.toggleClass('icon-sun-inv icon-moon');
    }
  });

  // Aplicar la preferencia guardada del usuario
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    $('body').toggleClass('dark-mode', savedTheme === 'dark');
    if (savedTheme === 'light') {
        theme.removeClass('icon-sun-inv').addClass('icon-moon');
      }
  }
  // Script para ocultar la ventana emergente al aceptar las cookies
  //var cookieStatus = localStorage.setItem('cookieStatus','true');
  if(!localStorage.getItem('cookieStatus')){
    $('.contenedor-cookie').html('<div class="pantalla"></div>'+
      '<div class="cookie-popup">'+
          'Este sitio web utiliza cookies. Al continuar navegando, aceptas nuestra política de cookies.'+
          '<label class="btn-links" id="cookie-btn" >Aceptar</label>'+
      '</div>');
  }
  
  $('#cookie-btn').click(function(){
    // Aquí puedes guardar la preferencia del usuario en una cookie o localStorage
    localStorage.setItem('cookieStatus','true');
    $('.contenedor-cookie').html('');
  });

  $('#registrar').click(function(){
    var flag_ = validar_inicio();
    //console.log(flag_);
    if(flag_ === 8){
      $('#continuar').click();
    }else{
      $('.alerta').html('<div class="alert alert-danger" role="alert">'+
        'Completar correctamente los campos para continuar con el registro'+
      '</div>');
    }
    //$('#continuar').click();
  });

  $('#Region').change(function() {
    var regionSeleccionada = $(this).val();
    var provincia = $('#Provincia');
    
    if (regionSeleccionada === 'Otro') {
        provincia.prop('disabled', true);
        provincia.val("0");  // Reset to default
        $('#Ie_seleccion').prop('disabled', true);
            $('#Ie_seleccion').val("0");  // Reset to default
        $('#Lugar_ie').prop('disabled', false);
        $('#Nombre_ie').prop('disabled', false);
        $('#Ie_seleccion').prop('disabled', true);
    } else {
        provincia.prop('disabled', false);
        $('#Lugar_ie').prop('disabled', true);
        $('#Lugar_ie').val("");
        $('#Nombre_ie').prop('disabled', true);
        $('#Nombre_ie').val("");
        $('#Ie_seleccion').prop('disabled', false);
    }
  });

  $('#Provincia').change(function(){
    var provincia = $(this).val();
    validar_provincia(provincia);

  });



  $('#Guardar').click(function(){
    
    //console.log(flag);
    if($('#Nivel').val() === 'SECUNDARIA'){
        var flag = validar_fin();
        if(flag == 6){
          guardar_inscripcion();
        }else{
          Swal.fire({
            position: "center",
            icon: "warning",
            title: "Completar los campos marcados por favor.",
            showConfirmButton: false,
            timer: 2500
          });
        }
    }else{
      //alert('no secundaria');
      guardar_inscripcion();
    }
    
  });

  $('#consultar_registro').click(function(){
    var doc = $('#documento_c').val();
    console.log(doc+"-"+doc.length);
    if(doc.length > 0 ){
      constancia_consulta();
    }else{
      Swal.fire({
        title: "Campo vacio!",
        text: "Ingrese su DNI / Carnet de Extranjería!",
        icon: "warning"
      });
    }
  });

  

});

