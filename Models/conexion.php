<?php

class Conexion{
    static public function conectar(){
        $e = new PDO("mysql:host=localhost; dbname=agenda", "root", "");
        $e -> exec("set names utf8");
        return $e;
        
    }
}
?>

