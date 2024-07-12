<?php
    $peticionAjax = false;
    require_once "./app/Controller/inscripController.php";
    $listas = new inscripcionController();
    $lista = $listas->listar_registro();
    $flag = 1;
?>

<div class="container-fluid">
    <div class="content">
        <br>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success" id="excel_g">Generar Excel</button>
            </div>
            <div class="col-md-12">
                <table class="table table-sm table-hover" id="tabla_excel">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO PATERNO</th>
                            <th scope="col">APELLIDO MATERNO</th>
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">CELULAR</th>
                            <th scope="col">CÓDIGO POSTULANTE</th>
                            <th scope="col">FECHA DE REGISTRO</th>
                            <th scope="col">CARRERA</th>
                            <th scope="col">TEMA</th>
                            <th scope="col">NIVEL</th>
                            <th scope="col">GRADO</th>
                            <th scope="col">REGION</th>
                            <th scope="col">PROVINCIA</th>
                            <th scope="col">INSTITUCIÓN EDUCATIVA</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php                                  
                            while($registro = $lista->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $flag; ?></td>
                            <td><?php echo $registro['nombre']; ?></td>
                            <td><?php echo $registro['apellido_p']; ?></td>
                            <td><?php echo $registro['apellido_m']; ?></td>
                            <td><?php echo $registro['documento']; ?></td>
                            <td><?php echo $registro['phone']; ?></td>
                            <td><?php echo $registro['cod_postulante']; ?></td>
                            <td><?php echo $registro['f_registro']; ?></td>
                            <td><?php echo $registro['n_carrera']; ?></td>
                            <td><?php echo $registro['tema']; ?></td>
                            <td><?php echo $registro['nivel']; ?></td>
                            <td><?php echo $registro['n_grado']; ?></td>
                            <td><?php echo $registro['n_region']; ?></td>
                            <td><?php echo $registro['n_provincia']; ?></td>
                            <td><?php echo $registro['n_ie']; ?></td>
                            </tr>
                            <?php
                            $flag = $flag + 1;
                            }
                            
                            ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>