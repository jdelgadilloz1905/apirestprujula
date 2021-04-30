<?php
require_once "conexion.php";

class ModelsConfig{

    static public function mdlConfig(){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM config");

        $stmt -> execute();

        return $stmt -> fetch();
    }

    static public function mdlUploadImage(){


    }
}