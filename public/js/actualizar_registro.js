function enviar_actualizacion(){
    var datos = new FormData();
    datos.append('codigo',$('#codigo').val());
    datos.append('nombre',$('#Nombre').val());
    datos.append('apellido_p',$('#ap_paterno').val());
    datos.append('apellido_m',$('#ap_materno').val());
    datos.append('documento',$('#documento').val());
    datos.append('carrera',$('#carrera').val());
    datos.append('celular',$('#cel').val());
    datos.append('tipo', 'actualizar');
    var msjError="<script>alert('Ocurrió un error inesperado'+'Por favor recargue la página','error');</script>";

    var url_ = "./app/Ajax/actualizarAjax.php";
        //console.log(url_);

            $.ajax({

                type: "POST",
                url: url_,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,

                    xhr: function(){

                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {

                        if (evt.lengthComputable) {

                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);

                            if(percentComplete<100){

                                $(".respuesta_actualizacion").html('<div class="row justify-content-center"><div class="col-6"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">Procesando '+percentComplete+' %</div></div></div></div>');

                            }else{

                                $(".respuesta_actualizacion").html('<div class="row justify-content-center"><div class="col-6"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">Procesando... '+percentComplete+' %</div></div></div></div>');

                            }

                        }

                        }, false);

                        return xhr;

                    },

                    success: function (data) {

                        $(".respuesta_actualizacion").html(data);

                    },

                    error: function() {

                        $(".respuesta_actualizacion").html(msjError);

                    }

            });
}
function actualizar_registro(){
    var flag_ = validar_inicio();
    console.log(flag_);
    if(flag_ === 7){
       
      enviar_actualizacion();
    }else{
      $('.respuesta_actualizacion').html('<div class="alert alert-danger" role="alert">'+
        'Completar correctamente los campos para continuar con la actualización'+
      '</div>');
    }
}

function registro_consulta(dato){

    console.log(dato);
    var datos = new FormData();
    datos.append('documento',$('#documento_c').val());
    if(dato != null){
        datos.append('tk',dato);
    }
    var msjError="<script>alert('Ocurrió un error inesperado'+'Por favor recargue la página','error');</script>";

    var url_ = "./app/Ajax/actualizarAjax.php";
        //console.log(url_);

            $.ajax({

                type: "POST",
                url: url_,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,

                    xhr: function(){

                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {

                        if (evt.lengthComputable) {

                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);

                            if(percentComplete<100){

                                $(".resultado_busqueda").html('<div class="row justify-content-center"><div class="col-6"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">Procesando '+percentComplete+' %</div></div></div></div>');

                            }else{

                                $(".resultado_busqueda").html('<div class="row justify-content-center"><div class="col-6"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">Procesando... '+percentComplete+' %</div></div></div></div>');

                            }

                        }

                        }, false);

                        return xhr;

                    },

                    success: function (data) {

                        $(".resultado_busqueda").html(data);

                    },

                    error: function() {

                        $(".resultado_busqueda").html(msjError);

                    }

            });
}