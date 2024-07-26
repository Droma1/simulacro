<?php
    $peticionAjax = false;
    require_once "./app/Model/admisionModel.php";
    $listas = new admisionModel();
    $lista = $listas->listar_total_registrados();
    $dirimencia = $listas->total_postulante_dirimencia();
    $total = $listas->total_postulante_tema();
    $total_ = 0;

    while ($dato2 = $lista->fetch()) {
        $total_ = $total_ + $dato2['total_postulantes'];
    }
?>

<section class="content">
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <center><h3>CONTEO DE DATOS DEL PROCESO DE ADMISIÓN 2024-II</h3></center>
            </div>
        </div>
        
        <div class="row">
            <?php
            $lista = $listas->listar_total_registrados();
            while ($dato = $lista->fetch()) {
                ?>
                <div class="col-md-6">
                    <div class="alert alert-primary" role="alert">
                        <?php echo $dato['categoria']." : ".$dato['total_postulantes']; ?>
                    </div>
                </div>
                <?php
                # code...
            }
            ?>
            
        </div>

        <div class="row">
            <br>
            <div class="col-md-6">
                <ul class="list-group">
                <?php
                        while ($b = $total->fetch()) {
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                TEMA <?php echo $b['TEMAXD']; ?> 
                                <span class="badge bg-primary rounded-pill"><?php echo $b['ORDINARIO']; ?></span>
                            </li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <?php
                        $total = $listas->total_postulante_tema();
                        while ($a = $dirimencia->fetch()) {
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $a['modalidad']; ?>
                                <span class="badge bg-primary rounded-pill"><?php echo $a['total_postulantes']; ?></span>
                            </li>
                            <?php
                        }
                    ?>
                </ul>
                <br>
                <ul class="list-group">
                <?php
                    $total = $listas->total_postulante_tema();
                        while ($b = $total->fetch()) {
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                TEMA <?php echo $b['TEMAXD']; ?> 
                                <span class="badge bg-primary rounded-pill"><?php echo $b['DIRIMENCIA']; ?></span>
                            </li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
<br>
        <div class="row">
            <?php
                $total = $listas->total_postulante_tema();
                while ($b = $total->fetch()) {
                    ?>
                    <div class="col-md-4">
                        <div class="alert alert-success" role="alert">
                            <strong>TOTAL TEMA <?php echo $b['TEMAXD']." : ".$b['TOTAL']; ?> </strong>
                        </div>
                    </div>
                    <?php
                }
            ?>
            
        </div>
        <div class="row">
            <div class="col">
                <h4>Total de Recepcionados : <?php echo $total_; ?></h4>
            </div>
        </div>
<br>
    </div>
</section>