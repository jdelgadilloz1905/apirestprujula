<?php

require_once "conexion.php";

class ModelsAlgolia{

    static public function mdlGetAllPublications(){

        $stmt = Conexion::conectar()->query("SELECT * from anuncios  where estado =1 and algolia = 0 order by id desc  ");

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

    static public function mdlInsertarLicencia($datos){


        $stmt = Conexion::conectarLicencia()->prepare("INSERT INTO clientes (email, nombre, direccion, rif, telefono,fecha_ini,fecha_fin,serial,estatus) 
                                                                              VALUES (:email, :nombre, :direccion, :rif, :telefono, :fecha_ini, :fecha_fin, :serial, :estatus)");

        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);

        $stmt->bindParam(":rif", $datos["rif"], PDO::PARAM_STR);

        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);

        $stmt->bindParam(":fecha_ini", $datos["fecha_ini"], PDO::PARAM_STR);

        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);

        $stmt->bindParam(":serial", $datos["serial"], PDO::PARAM_STR);

        $stmt->bindParam(":estatus", $datos["estatus"], PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlVerificarLicencia($valor){

        $stmt = Conexion::conectarLicencia()->prepare("SELECT * FROM clientes WHERE serial = :serial");

        $stmt -> bindParam(":serial", $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }


}