<?php
if($peticionAjax){

    require_once "../../app/Model/inscripModel.php";

}else{

    require_once "./app/Model/inscripModel.php";

}

class inscripcionController extends inscripcionModel{

    public function listar_registro(){
        $consulta = inscripcionModel::listado_registro();
        return $consulta;
    }
    public function contador_tema($tipo){
        switch ($tipo) {
            case 'recibidos':
                $sql = "select count(tema), tema from list_registry_accepted group by tema";
                break;
            
            default:
                $sql = "select count(tema), tema from listar_registro_general group by tema";
                break;
        }
        $consulta = mainClass::consulta_simple($sql);
        return $consulta;
    }
    public function reporte_lista(){
        $consulta = inscripcionModel::reporte_lista_model();
        if($consulta->rowCount() > 0){
            $contador = 1;
            $respuesta = '
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success" id="excel_g">Generar Excel <span class="icon-file-excel"></span></button>
                </div>
                
                <div class="col">
                <br>
                    <div class="card">
                        <div class="card-body" style="position:relative; overflow-x:scroll;">
                            <table class="table table-sm" id="tabla_excel">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellido Paterno</th>
                                        <th scope="col">Apellido Materno</th>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Código Postulante</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Fecha de Recepción</th>
                                        <th scope="col">Carrera</th>
                                        <th scope="col">Tema</th>
                                        <th scope="col">Nivel</th>
                                        <th scope="col">Grado</th>
                                        <th scope="col">Region</th>
                                        <th scope="col">Provincia</th>
                                        <th scope="col">Colegio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ';
                                    while($dato = $consulta->fetch()){                                    
                                        $respuesta = $respuesta . '<tr><th scope="row">'.$contador.'</th>
                                        <td>'.$dato['nombre'].'</td>
                                        <td>'.$dato['apellido_p'].'</td>
                                        <td>'.$dato['apellido_m'].'</td>
                                        <td>'.$dato['documento'].'</td>
                                        <td>'.$dato['phone'].'</td>
                                        <td>'.$dato['cod_postulante'].'</td>
                                        <td><span class="badge bg-success">'.$dato['status_'].'</span></td>
                                        <td>'.$dato['date_status'].'</td>
                                        <td>'.$dato['n_carrera'].'</td>
                                        <td>'.$dato['tema'].'</td>
                                        <td>'.$dato['nivel'].'</td>
                                        <td>'.$dato['n_grado'].'</td>
                                        <td>'.$dato['n_region'].'</td>
                                        <td>'.$dato['n_provincia'].'</td>
                                        <td>'.$dato['n_ie'].'</td></tr>';
                                        $contador = $contador + 1;
                                }
                                $respuesta = $respuesta . '
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $("#excel_g").click(function(){
                    exportarTablaAExcel("tabla_excel", "registro_simulacro_aceptados.xlsx");
                });
            </script>
        ';
        }else{
            $respuesta = 'no hay registros';
        }
        return $respuesta;
    }
    public function recepcion_controller(){
        $documento = mainClass::clear_string($_POST['documento']);
        $validar = mainClass::consulta_simple("select * from list_registry_accepted where cod_postulante = '".$documento."';");
        if($validar->rowCount() > 0){
            $alerta = [
                "Alerta" => "msg",
                "icon" => "warning",
                "title" => "Advertencia.",
                "msg" => "El registro ya se encuentra recepcionado."
            ];
        }else{
            $consulta = inscripcionModel::recepcion_model($documento);
            if($consulta->rowCount() > 0){
                $alerta = [
                    "Alerta" => "direccionar",

                    "icon" => "success",

                    "title" => "Recepcion exitosa",

                    "msg" => "se recepcionó registros del postulante.",

                    "direccion" => "recepcionar"
                ];
            }else{
                $alerta = [
                    "Alerta" => "msg",
                    "icon" => "warning",
                    "title" => "Advertencia.",
                    "msg" => "No se pudo completar la recepcion."
                ];
            }
        }
        
        return mainClass::alerts($alerta);
    }
    public function registro_check(){
        $documento = mainClass::clear_string($_POST['documento']);
        $consulta = inscripcionModel::busqueda_postulante_model($documento);
        //echo "buscando...";
        if($consulta->rowCount()>0){
            $r_consulta = (array) $consulta->fetch();
            $respuesta = '
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                            <label for="Nombre">Nombre del postulante</label>
                                                    <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del postulante" value="'.$r_consulta['nombre'].'"disabled>
                                                    
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="ap_paterno">Apellido Paterno</label>
                                                    <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" placeholder="Apellido Paterno" value="'.$r_consulta['apellido_p'].'" disabled>

                                            </div>
                                            <div class="col-md-4 mb-3">
                                                    <label for="ap_materno">Apellido Materno</label>
                                                    <input type="text" class="form-control" id="ap_materno" name="ap_materno" placeholder="Apellido Materno" value="'.$r_consulta['apellido_m'].'" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                    <label for="documento">Documento de identidad</label>
                                                    <input type="number" class="form-control" id="documento" name="documento" placeholder="Dni o Carnet de Extrangería" value="'.$r_consulta['documento'].'" disabled>

                                            </div>
                                            <div class="col-md-4 mb-3">
                                                      <label for="documento">Carrera a postular</label>
                                                    <input type="text" class="form-control" id="carrera" name="carrera" placeholder="" value="'.$r_consulta['n_carrera'].'" disabled>

                                            </div>
                                            <div class="col-md-4 mb-3">
                                                    <label for="cel">Teléfono o Celular</label>
                                                    <input type="number" class="form-control" name="cel" id="cel" placeholder="Celular" value="'.$r_consulta['phone'].'" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-md-4 mb-3">
                                                    <label for="codigo">Código del Postulante</label>
                                                    <input type="number" name="codigo" id="codigo" class="form-control" placeholder="Código del postulante" value="'.$r_consulta['cod_postulante'].'" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <buttom class="btn btn-warning validar">Recepcionar</buttom>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="respuesta_actualizacion"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $(".validar").click(function(){
                                registro_consulta("2");
                            });
                        </script>
            ';
        }else{
            $respuesta = '
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="alert alert-danger" role="alert">
                            <span class="icon-attention"></span> No se encuentra registro de su inscripión, en caso de que sea un error, favor de contactarse con la oficina de Admisión de la UNAMAD
                        </div>
                    </div>
                </div>
            ';
        }
        return $respuesta;
    }
    public function actualizar_registro(){
        $tema_p = ["INGENIERÍA AGROINDUSTRIAL","INGENIERÍA DE SISTEMAS E INFORMÁTICA", "INGENIERÍA FORESTAL Y MEDIO AMBIENTE"];
        $tema_q = ["MEDICINA VETERINARIA - ZOOTECNIA", "ENFERMERÍA"];
        $tema_r = ["EDUCACIÓN: ESPECIALIDAD PRIMARIA E INFORMÁTICA", "EDUCACIÓN: ESPECIALIDAD INICIAL Y ESPECIAL", "EDUCACIÓN: ESPECIALIDAD MATEMÁTICA Y COMPUTACIÓN", "ECOTURISMO", "DERECHO Y CIENCIAS POLÍTICAS", "CONTABILIDAD Y FINANZAS", "ADMINISTRACIÓN Y NEGOCIOS INTERNACIONALES"];

        if(in_array($_POST['carrera'], $tema_p)){
            $tema = 'P';
        }elseif(in_array($_POST['carrera'], $tema_q)){
            $tema = 'Q';
        }elseif (in_array($_POST['carrera'], $tema_r)) {
            $tema = 'R';
        }
        $dato = [ 
            'nombre' => mainClass::clear_string($_POST['nombre']),
            'Apellido_p' => mainClass::clear_string($_POST['apellido_p']),
            'Apellido_m' => mainClass::clear_string($_POST['apellido_m']),
            'Documento' => mainClass::clear_string($_POST['documento']),
            'Carrera' => mainClass::clear_string($_POST['carrera']),
            'Cel' => mainClass::clear_string($_POST['celular']),
            'codigo' => mainClass::clear_string($_POST['codigo']),
            'tema' => $tema
        ];

        $consulta = inscripcionModel::actualizar_registro_model($dato);
        $respuestaModel =  $consulta->fetch();
        if($respuestaModel[0] == 'exito'){
               
            $alerta = [
                "Alerta" => "direccionar",

                "icon" => "success",

                "title" => "Actualización Exitosa",

                "msg" => "se completó el registro exitosamente.",

                "direccion" => "actualizar"
            ];
        }else{
            $alerta = [
                "Alerta" => "msg",
                "icon" => "warning",
                "title" => "Advertencia.",
                "msg" => "No se pudo completar el registro"
            ];
        }
        return mainClass::alerts($alerta);
        //var_dump($dato);
    }
    public function busqueda_postulante($dato){
        $dato = mainClass::clear_string($dato);
        $consulta = inscripcionModel::busqueda_postulante_model($dato);
        //echo "buscando...";
        if($consulta->rowCount()>0){
            $r_consulta = (array) $consulta->fetch();
            $respuesta = '
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del postulante" value="'.$r_consulta['nombre'].'">
                                                    <label for="Nombre">Nombre del postulante</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" placeholder="Apellido Paterno" value="'.$r_consulta['apellido_p'].'">
                                                    <label for="ap_paterno">Apellido Paterno</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="ap_materno" name="ap_materno" placeholder="Apellido Materno" value="'.$r_consulta['apellido_m'].'">
                                                    <label for="ap_materno">Apellido Materno</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <select name="doc_tipo" id="doc_tipo" class="form-select">
                                                        <option value="0" selected disabled="">Elije una opcion...</option>
                                                        <option value="dni">DNI</option>
                                                        <option value="carnet">Carnet de Extranjería</option>
                                                    </select>
                                                    <label for="doc_tipo">Documento...</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="documento" name="documento" placeholder="Dni o Carnet de Extrangería" value="'.$r_consulta['documento'].'">
                                                    <label for="documento">Dni o Carnet de Extrangería</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="carrera" name="carrera" aria-label="Carrera profesional..." >
                                                        <option value="'.$r_consulta['n_carrera'].'" SELECTED >'.$r_consulta['n_carrera'].' - carrera seleccionada</option>
                                                        <option value="ADMINISTRACIÓN Y NEGOCIOS INTERNACIONALES">ADMINISTRACIÓN Y NEGOCIOS INTERNACIONALES</option>
                                                        <option value="CONTABILIDAD Y FINANZAS">CONTABILIDAD Y FINANZAS</option>
                                                        <option value="DERECHO Y CIENCIAS POLÍTICAS">DERECHO Y CIENCIAS POLÍTICAS</option>
                                                        <option value="ECOTURISMO">ECOTURISMO</option>
                                                        <option value="EDUCACIÓN: ESPECIALIDAD MATEMÁTICA Y COMPUTACIÓN">EDUCACIÓN: ESPECIALIDAD MATEMÁTICA Y COMPUTACIÓN</option>
                                                        <option value="EDUCACIÓN: ESPECIALIDAD INICIAL Y ESPECIAL">EDUCACIÓN: ESPECIALIDAD INICIAL Y ESPECIAL</option>
                                                        <option value="ENFERMERÍA">ENFERMERÍA</option>
                                                        <option value="EDUCACIÓN: ESPECIALIDAD PRIMARIA E INFORMÁTICA">EDUCACIÓN: ESPECIALIDAD PRIMARIA E INFORMÁTICA</option>
                                                        <option value="INGENIERÍA AGROINDUSTRIAL">INGENIERÍA AGROINDUSTRIAL</option>
                                                        <option value="INGENIERÍA FORESTAL Y MEDIO AMBIENTE">INGENIERÍA FORESTAL Y MEDIO AMBIENTE</option>
                                                        <option value="INGENIERÍA DE SISTEMAS E INFORMÁTICA">INGENIERÍA DE SISTEMAS E INFORMÁTICA</option>
                                                        <option value="MEDICINA VETERINARIA - ZOOTECNIA">MEDICINA VETERINARIA - ZOOTECNIA</option>
                                                    </select>
                                                    <label for="carrera">Carrera profesional</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" name="cel" id="cel" placeholder="Celular" value="'.$r_consulta['phone'].'">
                                                    <label for="cel">Teléfono o Celular</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="codigo" id="codigo" class="form-control" placeholder="Código del postulante" value="'.$r_consulta['cod_postulante'].'" disabled>
                                                    <label for="codigo">Código del Postulante</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <buttom class="btn btn-warning" id="Actualizar">Actualizar</buttom>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="respuesta_actualizacion"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $("#Actualizar").click(function(){
                                //console.log("generando");
                                actualizar_registro();
                            });
                        </script>
            ';
        }else{
            $respuesta = '
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="alert alert-danger" role="alert">
                            <span class="icon-attention"></span> No se encuentra registro de su inscripión, en caso de que sea un error, favor de contactarse con la oficina de Admisión de la UNAMAD
                        </div>
                    </div>
                </div>
            ';
        }
        return $respuesta;
    }

    public function val_reg($dato){
        $tema_p = ["INGENIERÍA AGROINDUSTRIAL","INGENIERÍA DE SISTEMAS E INFORMÁTICA", "INGENIERÍA FORESTAL Y MEDIO AMBIENTE"];
        $tema_q = ["MEDICINA VETERINARIA - ZOOTECNIA", "ENFERMERÍA"];
        $tema_r = ["EDUCACIÓN: ESPECIALIDAD PRIMARIA E INFORMÁTICA", "EDUCACIÓN: ESPECIALIDAD INICIAL Y ESPECIAL", "EDUCACIÓN: ESPECIALIDAD MATEMÁTICA Y COMPUTACIÓN", "ECOTURISMO", "DERECHO Y CIENCIAS POLÍTICAS", "CONTABILIDAD Y FINANZAS", "ADMINISTRACIÓN Y NEGOCIOS INTERNACIONALES"];

        if(in_array($dato['Carrera'], $tema_p)){
            $tema = 'P';
        }elseif(in_array($dato['Carrera'], $tema_q)){
            $tema = 'Q';
        }elseif (in_array($dato['Carrera'], $tema_r)) {
            $tema = 'R';
        }

        $flag = 0;
        if($dato['Nivel'] == 'SECUNDARIA'){
            $dato['Nombre'] = mainClass::clear_string($dato['Nombre']);
            $dato['Apellido_p'] = mainClass::clear_string($dato['Apellido_p']);
            $dato['Apellido_m'] = mainClass::clear_string($dato['Apellido_m']);
            $dato['Documento'] = mainClass::clear_string($dato['Documento']);
            $dato['Carrera'] = mainClass::clear_string($dato['Carrera']);
            $dato['Cel'] = mainClass::clear_string($dato['Celular']);
            $dato['Nivel'] = mainClass::clear_string($dato['Nivel']);
            $dato['Grado'] = mainClass::clear_string($dato['Grado']);
            $dato['Region'] = mainClass::clear_string($dato['Region']);
            $dato['Provincia'] = mainClass::clear_string($dato['Provincia']);
            $dato['Ie_selecion'] = mainClass::clear_string($dato['Ie_selecion']);
            $flag = 1;
        }else{
            $dato['Apellido_p'] = mainClass::clear_string($dato['Apellido_p']);
            $dato['Apellido_m'] = mainClass::clear_string($dato['Apellido_m']);
            $dato['Documento'] = mainClass::clear_string($dato['Documento']);
            $dato['Carrera'] = mainClass::clear_string($dato['Carrera']);
            $dato['Cel'] = mainClass::clear_string($dato['Celular']);
            $dato['Nivel'] = mainClass::clear_string($dato['Nivel']);
        }

        $verificar_existencia = inscripcionModel::v_exist($dato['Documento']);

        //$v_existencia = (array) $verificar_existencia->fetch();
        if($verificar_existencia !='existe'){

        

            $registroModel = inscripcionModel::registro($dato,$flag, $tema);
            $respuestaModel = (array) $registroModel->fetch();

            if($respuestaModel[0] == 'exito'){
               
                $alerta = [
                    "Alerta" => "direccionar",
    
                    "icon" => "success",
    
                    "title" => "Registro Exitoso",
    
                    "msg" => "se completó el registro exitosamente.",
    
                    "direccion" => "consulta"
                ];
            }else{
                $alerta = [
                    "Alerta" => "msg",
                    "icon" => "warning",
                    "title" => "Advertencia.",
                    "msg" => "No se pudo completar el registro"
                ];
            }
        }else{
            $alerta = [
                "Alerta" => "direccionar",

                "icon" => "warning",

                "title" => "Registro Existente",

                "msg" => "Ya contamos con un registro de su inscripción, proceda a imprimir su constancia.",

                "direccion" => "consulta"
            ];
        }
        return mainClass::alerts($alerta);
    }
    public function reporte_constancia($doc){
        $documento = mainClass::clear_string($doc);

        $verificar_existencia = inscripcionModel::v_exist($doc);

        if($verificar_existencia == 'existe'){
            $consulta = inscripcionModel::registro_consulta($documento);
            $r_consulta = (array) $consulta->fetch();
            $respuesta = '
                <!--cuerpo de pdf-->
                <div class="row notify justify-content-center">
                    <div class="col-md-6">
                        <h4><strong>¡IMPORTANTE!</strong> Presentar la siguiente constancia a la oficina de Admisión, Bajo responsabilidad del Postulante <strong><span class="icon-down"></span><span class="icon-down"></span><span class="icon-down"></span></strong></h4>
                    </div>
                </div>
                <br>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" id="generar_pdf">generar pdf</button>
                            </div>
                        </div>
                    </div>

                    <div class="pdf_cuerpo">
                        <img src="'.URL.'public/img/logo_un.jpg" class="marca_de_agua" alt="">
                        <strong><CENTER><h5>UNIVERSIDAD NACIONAL AMAZÓNICA DE MADRE DE DIOS</h5></CENTER></strong>
                        <center><h5>DIRECCIÓN DE ADMISIÓN</h5></center>
                        <center>************************************************************************************************</center>
                        <div class="row" style="float:right;">
                            '.date("g:i a, d-m-Y").'
                            
                        </div>
                        <br>
                        <strong><center><h4>CONSTANCIA DE INSCRIPCIÓN DE SIMULACRO <br>DE EXAMEN ORDINARIO 2024-II</h4></center></strong>
                        <br>
                        <center><strong><i>CÓDIGO DE POSTULANTE:</i></strong></center>
                        <center><strong><h1>'.$r_consulta['cod_postulante'].'</h1></strong></center>
                        <br>
                        <div class="row">
                            <div class="col-3"><i><strong>NOMBRES:</strong></i></div>
                            <div class="col-9"><p>'.$r_consulta['nombre'].'</p></div>
                        </div>
                        <div class="row">
                            <div class="col-3"><i><strong>APELLIDOS:</strong></i></div>
                            <div class="col-9"><p>'.$r_consulta['apellido_p'].' '.$r_consulta['apellido_m'].'</p></div>
                        </div>
                        <div class="row">
                            <div class="col-3"><i><strong>DNI:</strong></i></div>
                            <div class="col-9"><p>'.$r_consulta['documento'].'</p></div>
                        </div>
                        <div class="row">
                            <div class="col-3"><i><strong>CELULAR:</strong></i></div>
                            <div class="col-9"><p>'.$r_consulta['phone'].'</p></div>
                        </div>
                        <hr>
                        <strong><i>CARRERA PROFESIONAL:</i></strong><br>
                        <i>'.$r_consulta['n_carrera'].'</i>
                        <hr>
                        <center><strong><h1>TEMA: P</h1></strong></center>
                        <strong><p>RECOMENDACIONES IMPORTANTES:</p></strong>
                        <p><strong>SEÑOR(ITA) POSTULANTE,</strong> se le recuerda que <strong>ESTÁ TERMINANTEMENTE PROHIBIDO</strong> Traer artículos como:</p>
                        <p>Celulares, calculadoras, ipad, teléfonos de pulseras, reproductores de música, radio, audífonos, auriculares, 
                            lapiceros, aretes, anillos, collares, piercing, pulseras, gorros, reloj, mochilas, cartucheras, carteras y otros.</p>
                        <br>
                        <p><strong>VESTIMENTA: POLO Y PANTALÓN (VARONES Y MUJERES).</strong> No se permitirá el ingreso de los postulantes con prendas demasiado cortas, escotadas o inapropiadas (bividi, crop, mini short, sandalias, etc).</p>
                        <br>
                        <p><strong>NOTA:</strong>¡La UNAMAD, no se responsabiliza por los objetos retenidos!</p>

                        <br>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <hr>
                                <p><strong><i>FIRMA:</i></strong> '.$r_consulta['apellido_p'].' '.$r_consulta['apellido_m'].', '.$r_consulta['nombre'].'</p>
                            </div>
                            <div class="col-4">
                                <center><div class="box"></div></center>
                                <center><strong>HUELLA</strong></center>
                            </div>
                        </div>
                        <br>
                        <br>
                        
                        <div class="row">
                            <div class="col-4">
                                <center><img src="'.URL.'public/img/Logo_UNAMAD.jpg" alt="LOGO UNAMAD" style="max-height:60px;"></center>
                            </div>
                            <div class="col-4">
                                <div class="contenedor_admi">
                                    <strong><center><p>DIRECCIÓN DE ADMISIÓN</p></center></strong>
                                </div>
                            </div>
                            <div class="col-4">
                                <center><img src="'.URL.'public/img/calidad.jpg" alt="calidad unamad" style="max-height:60px;"></center>
                            </div>
                        </div>
                        
                    </div>
                <!--end cuerpo pdf-->
                <script>
                    $("#generar_pdf").click(function(){
                        console.log("generando");
                        generar();
                    });
                </script>
            ';
        }else{
            $respuesta = '
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="alert alert-danger" role="alert">
                            <span class="icon-attention"></span> No se encuentra registro de su inscripión, en caso de que sea un error, favor de contactarse con la oficina de Admisión de la UNAMAD
                        </div>
                    </div>
                </div>
            ';
        }
        return $respuesta;
    }
}

?>