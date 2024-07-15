<?php
    $peticionAjax = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../../app/Controller/inscripController.php";

    $registro = new inscripcionController();
    echo $registro->reporte_lista();

}else{
    echo ' Advertencia: acceso no permitido, favor verifique sus datos nuevamente.';
}
?>