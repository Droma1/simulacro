<?php
if($peticionAjax){

    require_once "../../config/main.php";

}else{

    require_once "./config/main.php";

}
    class inscripcionModel extends mainClass{
        protected function registro($dato, $flag, $tema){
            $fecha = date("Y-m-d H:i:s");
            if($flag == 1){
                $sql = mainClass::conectar()->prepare("call inscripcion(:Dato1, :Dato2, :Dato3, :Dato4, :Dato5, :Dato6, :Dato7, :Dato8, :Dato9, :Dato10, :Dato11, :Dato12, :Dato13, :Dato14);");
                $sql->bindParam(":Dato1", $dato['Nombre']);
                $sql->bindParam(":Dato2", $dato['Apellido_p']);
                $sql->bindParam(":Dato3", $dato['Apellido_m']);
                $sql->bindParam(":Dato4", $dato['Documento']);
                $sql->bindParam(":Dato5", $dato['Carrera']);
                $sql->bindParam(":Dato6", $dato['Cel']);
                $sql->bindParam(":Dato7", $dato['Nivel']);
                $sql->bindParam(":Dato8", $dato['Grado']);
                $sql->bindParam(":Dato9", $dato['Region']);
                $sql->bindParam(":Dato10", $dato['Provincia']);
                $sql->bindParam(":Dato11", $dato['Ie_selecion']);
                $sql->bindParam(":Dato12", $fecha);
                $sql->bindParam(":Dato13", $flag);
                $sql->bindParam(":Dato14", $tema);
                $sql->execute();

            }else{
                $dato['Grado'] = isset($dato['Grado']) ? $dato['Grado'] : "-";
                $dato['Region'] = isset($dato['Region']) ? $dato['Region'] : "-";
                $dato['Provincia'] = isset($dato['Provincia']) ? $dato['Provincia'] : "-";
                $dato['IE'] = isset($dato['IE']) ? $dato['IE'] : "-";

                $sql = mainClass::conectar()->prepare("call inscripcion(:Dato1, :Dato2, :Dato3, :Dato4, :Dato5, :Dato6, :Dato7, :Dato8, :Dato9, :Dato10, :Dato11, :Dato12, :Dato13, :Dato14);");
                $sql->bindParam(":Dato1", $dato['Nombre']);
                $sql->bindParam(":Dato2", $dato['Apellido_p']);
                $sql->bindParam(":Dato3", $dato['Apellido_m']);
                $sql->bindParam(":Dato4", $dato['Documento']);
                $sql->bindParam(":Dato5", $dato['Carrera']);
                $sql->bindParam(":Dato6", $dato['Cel']);
                $sql->bindParam(":Dato7", $dato['Nivel']);
                $sql->bindParam(":Dato8", $dato['Grado']);
                $sql->bindParam(":Dato9", $dato['Region']);
                $sql->bindParam(":Dato10", $dato['Provincia']);
                $sql->bindParam(":Dato11", $dato['IE']);
                $sql->bindParam(":Dato12", $fecha);
                $sql->bindParam(":Dato13", $flag);
                $sql->bindParam(":Dato14", $tema);
                $sql->execute();

            }

            return $sql;
        }
        protected function v_exist($dato){
            $sql = mainClass::consulta_simple("select * from postulante where documento = '".$dato."';");
            if($sql->RowCount()>0){
                $respuesta = 'existe';
            }else{
                $respuesta = 'no existe';
            }
            return $respuesta;
        }
        protected function registro_consulta($documento){
            $sql = mainClass::consulta_simple("select * from listar_registro where documento = '".$documento."';");

            return $sql;
        }
        protected function listado_registro(){
            $sql = mainClass::consulta_simple("select * from listar_registro;");
            return $sql;
        }
    }
?>