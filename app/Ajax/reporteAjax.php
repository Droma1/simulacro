<?php
    $peticionAjax = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../../app/Controller/inscripController.php";

    $registro = new inscripcionController();
    
    try {
        echo $registro->reporte_constancia($_POST['documento']);
    } catch (Exception $e) {
        echo $registro->error_alert("Hubo un error al procesar los datos, intentar nuevamente".$e->getMessage());
    }

}else{
    echo ' Advertencia: acceso no permitido, favor verifique sus datos nuevamente.';
}
?>