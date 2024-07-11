<?php
    $peticionAjax = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if($_POST['Nivel'] === 'SECUNDARIA'){
            $datos = [
                "Nombre" => $_POST['Nombre'],
                "Apellido_p" => $_POST['Apellido_p'],
                "Apellido_m" => $_POST['Apellido_m'],
                "Documento" => $_POST['Documento'],
                "Carrera" => $_POST['Carrera'],
                "Celular" => $_POST['Cel'],
                "Nivel" => $_POST['Nivel'],
                "Grado" => $_POST['Grado'],
                "Region" => $_POST['Region'],
                "Provincia" => $_POST['Provincia'],
                "Ie_selecion" => $_POST['Ie_selecion']
            ];
        }else{
            $datos = [
                "Nombre" => $_POST['Nombre'],
                "Apellido_p" => $_POST['Apellido_p'],
                "Apellido_m" => $_POST['Apellido_m'],
                "Documento" => $_POST['Documento'],
                "Carrera" => $_POST['Carrera'],
                "Celular" => $_POST['Cel'],
                "Nivel" => $_POST['Nivel']
            ];
        }
    require_once "../../app/Controller/inscripController.php";

    $registro = new inscripcionController();
    echo $registro->val_reg($datos);

}else{
    echo ' Advertencia: acceso no permitido, favor verifique sus datos nuevamente.';
}
?>