<?php

    $peticionAjax = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../../app/Controller/logController.php";
        $validate = new logController();
        echo $validate->validacion_log();
    }else{
        echo ' Advertencia: acceso no permitido, favor verifique sus datos nuevamente.';
    }
?>