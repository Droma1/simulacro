<?php
if($peticionAjax){

    require_once "../../config/main.php";

}else{

    require_once "./config/main.php";

}

class admisionModel extends mainClass{

    public function listar_total_registrados() {
            // Preparar la conexión y la consulta
            $sql = mainClass::conectar_SQL()->prepare("SELECT * FROM [Admision].[vw_TotalPostulantesPorCategoria] order by categoria desc;");
    
            // Ejecutar la consulta
            $sql->execute();
    
            // Obtener resultados
    
            // Devolver los resultados
            return $sql;
    }
    public function total_postulante_dirimencia(){
        $sql = mainClass::conectar_SQL()->prepare("SELECT * FROM [Admision].[vw_TotalPostulantesPorModalidadDirimencia] order by modalidad desc;");
        $sql->execute();

        return $sql;
    } 
    public function total_postulante_tema(){
        $sql = mainClass::conectar_SQL()->prepare("SELECT * FROM [Admision].[vw_TotalPostulantesPorGrupo] order by TEMAXD asc;");
        $sql->execute();

        return $sql;
    }
    
}
?>