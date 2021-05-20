<?php

require_once "conexion.php";

class ModelsAlgolia{

    static public function mdlGetAllPublications(){

        $stmt = Conexion::conectar()->query("SELECT  * from anuncios where estado =1 order by id desc  ");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }


}