<?php
require_once "conexion.php";

class ModelsCategory{

    static public function mdlShowCategory($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch(PDO::FETCH_ASSOC);

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = 1 ORDER BY id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }

        $stmt -> close();

        $stmt = null;

    }

    /*=============================================
        INSERTAR CATEGORIA
        =============================================*/



    /*=============================================
        ACTUALIZAR NOMBRE O ESTADO DE LA CATEGORIA
        =============================================*/

    /*=============================================
        ELIMINAR CATEGORIA QUE NO ESTAN ASOCIADO A UN ANUNCIO
        =============================================*/
}