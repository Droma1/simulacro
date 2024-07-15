<?php
    $peticionAjax = false;
    require_once "./app/Controller/inscripController.php";
    $contadores = new inscripcionController();
    $contador = $contadores->contador_tema('recibidos');
    $total = 0;
    $flag = 0;
?>

<section class="container">
    <br>
    <div class="row justify-content-center">
        <?php
            while ($tema = $contador->fetch()) {
                ?>
                <div class="col-md-4">
                    <div class="alert alert-primary" role="alert">
                        <?php echo "Tema: ".$tema[1]." : ".$tema[0]; ?>
                    </div>
                    
                </div>
                <?php
                $total = $total + $tema[0];
                }
            ?>
        </div>
        <div class="row">
            <div class="col text-end">
                <h4><?php echo "Total de recepcionados:".$total; ?></h4>
            </div>
        </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>Recepcionar expediente de Postulante</h4>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text buscar_registro_ck btn btn-success" id="basic-addon1"> <span class="icon-search"></span> Buscar</span>
                                    <input type="text" class="form-control" id="documento_c" placeholder="Código del postulante" aria-label="código" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <button type="submit" id="recepcionados" class="btn btn-primary">Listar registros recepcionados</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="resultado_busqueda">

    </div>
    <br>
    <div class="lista_recibidos">
    </div>
    <br>
</section>