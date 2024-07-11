function constancia_consulta(){
    var datos = new FormData();
    datos.append('documento',$('#documento_c').val());
    var msjError="<script>alert('Ocurrió un error inesperado'+'Por favor recargue la página','error');</script>";

    var url_ = "./app/Ajax/reporteAjax.php";
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

                                $(".body_container").html('<div class="row justify-content-center"><div class="col-6"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">Procesando '+percentComplete+' %</div></div></div></div>');

                            }else{

                                $(".body_container").html('<div class="row justify-content-center"><div class="col-6"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">Procesando '+percentComplete+' %</div></div></div></div>');

                            }

                        }

                        }, false);

                        return xhr;

                    },

                    success: function (data) {

                        //console.log(data);

                        $(".body_container").html(data);

                    },

                    error: function() {

                        $(".body_container").html(msjError);

                    }

            });
}