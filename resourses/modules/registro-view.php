<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $peticionAjax = false;
require_once "app/Controller/inscripController.php";
    $datos = [
        "Nombre" => $_POST['Nombre'],
        "Apellido_p" => $_POST['ap_paterno'],
        "Apellido_m" => $_POST['ap_materno'],
        "Documento" => $_POST['documento'],
        "Carrera" => $_POST['carrera'],
        "Celular" => $_POST['cel'],
        "Nivel" => $_POST['nivel']
    ];
    /*$validar = new inscripcionController();
    $validar_ = $validar->val_inicio($datos);*/
    
?>
<section class="container">
    <br>
    <div class="row">
        <div class="col">
            <div class="card" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Nombre:</label>
                                <input type="text" name="Nombre" id="Nombre" class="form-control" value="<?php echo $datos['Nombre']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Apellido Paterno:</label>
                                <input type="text" name="Apellido_p" id="Apellido_p" class="form-control" value="<?php echo $datos['Apellido_p']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Apellido Materno:</label>
                                <input type="text" name="Apellido_m" id="Apellido_m" class="form-control" value="<?php echo $datos['Apellido_m']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">DNI / Carnet de Extrangería:</label>
                                <input type="number" name="Documento" id="Documento" class="form-control" value="<?php echo $datos['Documento']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Carrera:</label>
                                <input type="text" name="Carrera" id="carrera" class="form-control" value="<?php echo $datos['Carrera']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Celular:</label>
                                <input type="number" name="Celular" id="Cel" class="form-control" value="<?php echo $datos['Celular']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="">Nivel:</label>
                                <input type="Text" name="Nivel" id="Nivel" class="form-control" value="<?php echo $datos['Nivel']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <?php
                                if($datos['Nivel'] !== 'SECUNDARIA'){
                                    ?>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success" id="Guardar">Guardar</button>
                                    </div>
                                    <div class="mb-3">
                                        <div class="RespuestaConsulta"></div>
                                    </div>
                                    <?php
                                }
                            ?>
                            <div class="respuestaAjax"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php
        if($datos['Nivel'] === 'SECUNDARIA'){
            ?>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="Grado" name="Grado" aria-label="Grado">
                                            <option value="0" SELECTED disabled="">Elije una opción...</option>
                                            <option value="Primero">Primero de Secundaria</option>
                                            <option value="Segundo">Segundo de Secundaria</option>
                                            <option value="Tercero">Tercaro de Secundaria</option>
                                            <option value="Cuarto">Cuarto de Secundaria</option>
                                            <option value="Quinto">Quinto de Secundaria</option>
                                        </select>
                                        <label for="Grado">Grado...</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="Region" name="Region" aria-label="Region">
                                            <option value="0" SELECTED disabled="">Elije una opción...</option>
                                            <option value="Madre de Dios">Madre de Dios</option>
                                            <option value="Amazonas">Amazonas</option>
                                            <option value="Áncash">Áncash</option>
                                            <option value="Apurímac">Apurímac</option>
                                            <option value="Arequipa">Arequipa</option>
                                            <option value="Ayacucho">Ayacucho</option>
                                            <option value="Cajamarca">Cajamarca</option>
                                            <option value="Cusco">Cusco</option>
                                            <option value="Huancavelica">Huancavelica</option>
                                            <option value="Huánuco">Huánuco</option>
                                            <option value="Ica">Ica</option>
                                            <option value="Junín">Junín</option>
                                            <option value="La Libertad">La Libertad</option>
                                            <option value="Lambayeque">Lambayeque</option>
                                            <option value="Lima">Lima</option>
                                            <option value="Loreto">Loreto</option>
                                            <option value="Moquegua">Moquegua</option>
                                            <option value="Pasco">Pasco</option>
                                            <option value="Piura">Piura</option>
                                            <option value="Puno">Puno</option>
                                            <option value="San Martín">San Martín</option>
                                            <option value="Tacna">Tacna</option>
                                            <option value="Tumbes">Tumbes</option>
                                            <option value="Ucayali">Ucayali</option>
                                        </select>
                                        <label for="Grado">Región...</label>
                                    </div>
                                </div>
                                <div class="col-md-4 provin" style="display:none;">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="Provincia" name="Provincia" aria-label="Provincia" disabled>
                                            <option value="0" SELECTED disabled="">Elije una opción...</option>
                                            <option value="Manu">Manu</option>
                                            <option value="Tahuamanu">Tahuamanu</option>
                                            <option value="Tambopata">Tambopata</option>
                                        </select>
                                        <label for="Grado">Provincia...</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 lugar" style="display:none;">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="Lugar_ie" name="Lugar_ie" placeholder="Lugar de la instituión eduativa" disabled>
                                        <label for="Lugar_ie">Lugar de la Institución Educativa</label>
                                    </div>
                                </div>
                                <div class="col-md-4 nombre_i" style="display:none;">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="Nombre_ie" name="Nombre_ie" placeholder="Nombre de la instituión eduativa" disabled>
                                        <label for="Nombre_ie">Nombre de la Institución Educativa</label>
                                    </div>
                                </div>
                                <div class="col-md-4 ie_edu" style="display:none;">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="Ie_seleccion" name="Ie_seleccion" aria-label="Seleccione su institución educativa" disabled>
                                            <option value="0" SELECTED disabled="">Elije una opción...</option>
                                        </select>
                                        <label for="Ie_seleccion">Seleccione su institución educativa...</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success" id="Guardar">Guardar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="RespuestaConsulta"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
    <br>
</section>
<?php
}else{
    ?>
    <section class="container">
        <br>
        <div class="row">
            <div class="col">
                <div class="alert alert-danger" role="alert">
                    <h1 class="text-center"><span class="icon-attention"></span></h1>  <label for="">Por favor para proceder con el registro de inscripción, completar correctamente los campos iniciales,
                    en caso de tener problemas para completar su registro comunicarse con la oficina de Admisión de la UNAMAD.</label>
                </div>
            </div>
        </div>
        <br>
    </section>
    <?php
}
?>