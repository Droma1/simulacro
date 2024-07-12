<?php

    $peticionAjax = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../../app/Controller/inscripController.php";
        $registro = new inscripcionController();
    if(isset($_POST['tipo'])){
            echo $registro->actualizar_registro();
    }elseif(isset($_POST['tk'])){
        echo $registro->registro_check();
    }else{
        
        echo $registro->busqueda_postulante($_POST['documento']);
    }

    

    }else{
        echo ' Advertencia: acceso no permitido, favor verifique sus datos nuevamente.';
    }
?>