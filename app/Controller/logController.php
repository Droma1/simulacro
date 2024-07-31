<?php
if($peticionAjax){

    require_once "../../app/Model/logModel.php";

}else{

    require_once "./app/Model/logModel.php";

}

class logController extends logModel{

    public function validacion_log(){
        $user = $_POST['usuario'];
        $pass = $_POST['clave'];
        //$2y$12$If0af4eHfrw4Qjr4RxPlzOJryThgZlU31ccKz2NZdhEAtxbow5FYy

        return $user." - ".$pass."-> ".mainClass::encryption("12345678");
    }
    
}

?>