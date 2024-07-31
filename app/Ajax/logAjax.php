<?php

    $peticionAjax = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../../app/Controller/logController.php";
        $registro = new logController();
    }else{
        echo ' Advertencia: acceso no permitido, favor verifique sus datos nuevamente.';
    }
?>