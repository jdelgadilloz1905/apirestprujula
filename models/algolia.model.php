<?php

require_once "conexion.php";

class ModelsAlgolia{

    static public function mdlGetAllPublications(){

        $stmt = Conexion::conectar()->query("SELECT  * from anuncios where estado =1 and algolia = 0 order by id desc  ");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlUpdateSincronizadoAlgolia($tabla,$item,$valor,$id){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


}