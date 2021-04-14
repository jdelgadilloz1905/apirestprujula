<?php
require_once "conexion.php";

class ModelsBanner{

    static public function mdlShowBanner($tabla){

        $stmt = Conexion::conectar()->query("SELECT  * from $tabla where estado =1 order by id desc  ");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }
}