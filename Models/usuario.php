<?php
    require_once "conexion.php";

    //$tabla: Tabla en donde se hara la consulta
    //$e: Campo a filtrar 
    //$v: 
    class UserModel{
        static public function pregunta($tabla, $e, $v){
            $s = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla WHERE $e = :$e"
            );
            
            $s->bindParam(":".$e, $v, PDO::PARAM_STR);
            $s->execute();
            return $s->fetch();
        }
    }

?>