function guardar_inscripcion(){

            //console.log("registrando");

        var datos = new FormData();

        datos.append('Nombre',$('#Nombre').val());
        datos.append('Apellido_p',$('#Apellido_p').val());
        datos.append('Apellido_m',$('#Apellido_m').val());
        datos.append('Documento',$('#Documento').val());
        datos.append('Carrera',$('#carrera').val());
        datos.append('Cel',$('#Cel').val());
        datos.append('Nivel',$('#Nivel').val());

        

        if($('#Nivel').val() === 'SECUNDARIA'){
            datos.append('Grado',$('#Grado').val());
            datos.append('Region',$('#Region').val());
            if($('#Region').val() == 'Madre de Dios'){
                datos.append('Provincia',$('#Provincia').val());
                datos.append('Ie_selecion',$('#Ie_seleccion').val());
            }else{
                datos.append('Provincia',$('#Lugar_ie').val());
                datos.append('Ie_selecion',$('#Nombre_ie').val());
            }
        }

        //datos.append('tipo', 'verificar_pago');

        var msjError="<script>alert('Ocurrió un error inesperado'+'Por favor recargue la página','error');</script>";



        var url_ = "./app/Ajax/ConsultaAjax.php";
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

                                $(".RespuestaConsulta").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">Procesando '+percentComplete+' %</div></div>');

                            }else{

                                $(".RespuestaConsulta").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">Procesando '+percentComplete+' %</div></div>');

                            }

                        }

                        }, false);

                        return xhr;

                    },

                    success: function (data) {

                        //console.log(data);

                        $(".RespuestaConsulta").html(data);

                    },

                    error: function() {

                        $(".RespuestaConsulta").html(msjError);

                    }

            });

        


    /*Swal.fire({
        position: "center",
        icon: "success",
        title: "se guardaron correctamente",
        showConfirmButton: false,
        timer: 2500
      });*/
}