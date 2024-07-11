<?php
if($peticionAjax){

    require_once "../../app/Model/inscripModel.php";

}else{

    require_once "././app/Model/inscripModel.php";

}

class inscripcionController extends inscripcionModel{

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
                    "title" => "no se pudo completar el registro."
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
                        <center>***************************************************************************************************</center>
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
                            <span class="icon-attention"></span> No se encuentra registro de su inscripión, en caso de que sea un error, favor decontactarse con la oficina de Admisión de la UNAMAD
                        </div>
                    </div>
                </div>
            ';
        }
        return $respuesta;
    }
}

?>