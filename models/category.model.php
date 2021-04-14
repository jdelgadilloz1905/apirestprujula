<?php
require_once "conexion.php";

class ModelsCategory{

    static public function mdlShowCategory($tabla){

        $stmt = Conexion::conectar()->query("SELECT  * from $tabla where estado =1 order by id desc  ");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

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