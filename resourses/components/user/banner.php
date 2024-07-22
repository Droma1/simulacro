<!--<section class="content time">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center" style="overflow:hidden;">
                <h3>¡¡ Simulacro de Examen Ordinario: <label id="countdown"></label> !!</h3>
            </div>
        </div>
    </div>-->
</section>
<div class="banner">
<section class="container">
    <br>
    <br>
<div class="row">
    
    <div class="col-md-6 col-xs-12">
        <div class="card">
            
            <div class="card-body">
                <br>
                <center><h1>Formulario de Inscripción Simulacro 2024-II</h1></center>
                <br>
                <form action="registro" method="post">
                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" placeholder="Apellido Paterno">
                    <label for="ap_paterno">Apellido Paterno</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="ap_materno" name="ap_materno" placeholder="Apellido Materno">
                    <label for="ap_materno">Apellido Materno</label>
                    
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del postulante">
                    <label for="Nombre">Nombre del postulante</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="doc_tipo" id="doc_tipo" class="form-select">
                        <option value="0" selected disabled="">Elije una opcion...</option>
                        <option value="dni">DNI</option>
                        <option value="carnet">Carnet de Extranjería</option>
                    </select>
                    <label for="doc_tipo">Documento...</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="documento" name="documento" placeholder="Dni o Carnet de Extrangería">
                    <label for="documento">Dni o Carnet de Extrangería</label>
                </div>
                
                <div class="form-floating mb-3">
                    <select class="form-select" id="carrera" name="carrera" aria-label="Carrera profesional...">
                        <option value="0" SELECTED disabled="">Elije una opción</option>
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
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="cel" id="cel" placeholder="Celular">
                    <label for="cel">Teléfono o Celular</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="nivel" name="nivel" aria-label="Nivel...">
                        <option value="0" SELECTED disabled="">Elije una opción</option>
                        <option value="PRIMARIA">Primaria</option>
                        <option value="SECUNDARIA">Secundaria</option>
                        <option value="SUPERIOR">Superior (Universitario / Técnico)</option>
                        <option value="EGRESADO">Egresado de Secundaria</option>
                    </select>
                    <label for="nivel">Nivel...</label>
                </div>
                <div class="form mb-3">
                    <a href="consulta" class="btn btn-warning">Consultar inscripción <span class="icon-search"></span></a>
                    <span class="btn btn-success" id="registrar" >Continuar <span class="icon-right"></span></span>                    
                    <button style="display:none;" type="submit" class="btn btn-success" id="continuar">Continuar</button>
                </div>
                <div class="form mb-3">
                <div class="alerta"></div>
                </div>
                </form>
            </div>
        </div>
    </div>
<br>
    <div class="col-md-6">
        <div class="time" style="display:none">
            <br>
            <h3>¡¡ Tiempo restante para el Simulacro de Examen Ordinario !!</h3>
                <div class="box_time">
                    <p class="dias numero_time"></p>
                    <h4>Días</h4>
                </div>
                <div class="box_time">
                    <h1>-</h1>
                </div>
                <div class="box_time">
                    <p class="horas numero_time"></p>
                    <h4>horas</h4>
                </div>
                <div class="box_time">
                    <h1>:</h1>
                </div>
                <div class="box_time">
                    <p class="minutos numero_time"></p>
                    <h4>Minutos</h4>
                </div>
                <div class="box_time">
                    <h1>:</h1>
                </div>
                <div class="box_time">
                    <p class="segundos numero_time"></p>
                    <h4>Segundos</h4>
                </div>
                <br>
                
        </div>
    </div>
    <br>
</div>
<br>
</section>
</div>