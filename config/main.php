<?php
//var_dump($peticionAjax);
	if($peticionAjax){
        require_once "../../error_handler.php";
		require_once "../../database/db.php";
        require_once "../../config/config.php";
	}else{
        require_once "./error_handler.php";
		require_once "./database/db.php";
        require_once "./config/config.php";
    }

	

class mainClass{

    protected function conectar(){

        try{

            $link = new PDO(SGBD,USER,PASS);

        }catch (Exception $e){

            $link = $this->error_message("Error al conectar a la base de datos error: ".$e->getMessage());

        }

        return $link;

    }

    protected function consulta_simple($consulta){

        $respuesta = self::conectar()->prepare($consulta);

        $respuesta->execute();

        return $respuesta;

    }
    protected function conectar_SQL(){
    
        try{
    
            $link = new PDO(SGBD_SQL,USER_SQL,PASS_SQL);
    
        }catch (Exception $e){
            
            $link = $this->error_message("Error al conectar a la base de datos error: ".$e->getMessage());
    
        }
    
        return $link;
    
    }
    protected function consulta_simple_SQL($consulta){

        $respuesta = self::conectar_SQL()->prepare($consulta);

        $respuesta->execute();

        return $respuesta;

    }
    protected function encryption($string){
        $pass = password_hash($string,PASSWORD_DEFAULT,['cost'=>12]);
        return $pass;
    }
    protected function verify($string,$data){
        $pass = password_verify($string,$data);
        return $pass;
    }

    protected function clear_string($cadena){

        $cadena = trim($cadena);

        $cadena = stripcslashes($cadena);

        $cadena = str_ireplace("<script>","",$cadena);

        $cadena = str_ireplace("</script>","",$cadena);

        $cadena = str_ireplace("<script src","",$cadena);

        $cadena = str_ireplace("<script type=","",$cadena);

        $cadena = str_ireplace("SELECT * FROM","",$cadena);

        $cadena = str_ireplace("DELETE FROM","",$cadena);

        $cadena = str_ireplace("INSERT INTO","",$cadena);

        $cadena = str_ireplace("--","",$cadena);

        $cadena = str_ireplace("^","",$cadena);

        $cadena = str_ireplace("[","",$cadena);

        $cadena = str_ireplace("]","",$cadena);

        $cadena = str_ireplace("==","",$cadena);

        $cadena = str_ireplace("=","",$cadena);//''or 1=1;'



        return $cadena;

    }
    protected function error_message($message){
        $body_error = '
            <!-- Flexbox container for aligning the toasts -->
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">

                <!-- Then put toasts within -->
                <div class="toast" role="alert" style="opacity: 1 !important;">
                    <div class="toast-header text-danger">
                    <span class="rounded me-2 icon-attention"></span>
                    <strong class="me-auto">Error al enviar</strong>
                    <small>Hace 2 Seg.</small>
                    <button type="button" class="btn-close"></button>
                    </div>
                    <div class="toast-body">
                    '.$message.'
                    </div>
                </div>
            </div>
        ';
        
        return $body_error;
    }
    protected function alerts($datos){
        if($datos['Alerta']=="simple"){
            $alerta = "
                <script>
                    Swal.fire({
                        icon: '".$datos['icon']."',
                        title: '".$datos['title']."',
                        text: '".$datos['msg']."'
                    });                   
                </script>
            ";
        }elseif ($datos['Alerta']=="recargar") {
            
            $alerta = "
                <script>
                    swal.fire({
                        title:'".$datos['title']."',
                        text:'".$datos['msg']."',
                        icon:'".$datos['icon']."',
                        confirmButtonText:'Aceptar'
                    }).then(function(){
                        location.reload();
                        });
                </script>
            ";
        }elseif ($datos['Alerta']=="direccionar") {
            
            $alerta = "
                <script>
                    swal.fire({
                        title:'".$datos['title']."',
                        text:'".$datos['msg']."',
                        icon:'".$datos['icon']."',
                        confirmButtonText:'Aceptar'
                    }).then(function(){
                        window.location='".URL.$datos['direccion']."';
                        });
                </script>
            ";
        }elseif ($datos['Alerta']=="limpiar") {
            $alerta = "
                <script>
                    swal.fire({
                        title:'".$datos['title']."',
                        text:'".$datos['msg']."',
                        icon:'".$datos['icon']."',
                        confirmButtonText:'Aceptar'
                    }).then(function(){
                        $('.formAjax')[0].reset();
                        });
                </script>
            ";
        }elseif($datos['Alerta'] == "msg"){
            $alerta = "<script>
                        Swal.fire({
                            position: 'center',
                            icon: '".$datos['icon']."',
                            title: '".$datos['title']."',
                            text:'".$datos['msg']."',
                            showConfirmButton: false,
                            timer: 2500
                        });
            </script>";
        }
        return $alerta;
    }
}