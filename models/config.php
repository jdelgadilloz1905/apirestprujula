<?php
require_once "conexion.php";

class ModelsConfig{

    static public function mdlConfig(){

        $stmt = Conexion::conectar()->query("SELECT * FROM config");

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }
}