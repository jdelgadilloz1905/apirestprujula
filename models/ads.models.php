<?php

require_once "conexion.php";

class ModelsAds{

    static public function mdlCreateAd($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, descripcion, id_categoria, image_url, latitud, longitud, habitaciones, precio,oferta,descuento) VALUES (:nombre, :descripcion, :id_categoria, :image_url, :latitud, :longitud, :habitaciones, :precio,:oferta,:descuento)");


        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);

        $stmt->bindParam(":image_url", $datos["image_url"], PDO::PARAM_STR);

        $stmt->bindParam(":latitud", $datos["latitud"], PDO::PARAM_STR);

        $stmt->bindParam(":longitud", $datos["longitud"], PDO::PARAM_STR);

        $stmt->bindParam(":habitaciones", $datos["habitaciones"], PDO::PARAM_STR);

        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

        $stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);

        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }
}