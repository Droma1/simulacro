function process_log(){

    var loader = '<div class="loader2"><div class="align-self-center spinner-border text_spiner" role="status"></div> <span class="align-self-center visually-show">  Procesando datos ';
    var end_loader = '...</span></div>';

    var datos = new FormData();

    datos.append("usuario",$('#usuario').val());
    datos.append("clave",$('#clave').val());

    var msjError="<script>alert('Ocurrió un error inesperado'+'Por favor recargue la página','error');</script>";

    var url_ = "./app/Ajax/logAjax.php";
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

                                $(".RespuestaConsulta").html(loader+percentComplete+"%"+end_loader);

                            }else{

                                $(".RespuestaConsulta").html(loader+percentComplete+"%"+end_loader);

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
}