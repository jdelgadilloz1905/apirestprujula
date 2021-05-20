<?php

require_once "conexion.php";

class ModelsAds{

    static public function mdlCreateAd($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(titulo, descripcion, id_categoria, image_portada,image_portada_oferta, latitud, longitud, habitaciones, precio,precio_oferta,descuento, fechas_desactivada)
                                                                    VALUES (:titulo, :descripcion, :id_categoria, :image_portada, :image_portada_oferta, :latitud, :longitud, :habitaciones, :precio,:precio_oferta,:descuento, :fechas_desactivada)");


        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);

        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);

        $stmt->bindParam(":image_portada", $datos["image_portada"], PDO::PARAM_STR);

        $stmt->bindParam(":image_portada_oferta", $datos["image_portada_oferta"], PDO::PARAM_STR);

        $stmt->bindParam(":latitud", $datos["latitud"], PDO::PARAM_STR);

        $stmt->bindParam(":longitud", $datos["longitud"], PDO::PARAM_STR);

        $stmt->bindParam(":habitaciones", $datos["habitaciones"], PDO::PARAM_STR);

        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

        $stmt->bindParam(":precio_oferta", $datos["precio_oferta"], PDO::PARAM_STR);

        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);

        $stmt->bindParam(":fechas_desactivada", $datos["fechas_desactivada"], PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlShowAllAds($tabla){

        $stmt = Conexion::conectar()->query("SELECT  * from $tabla where estado =1 order by id desc  ");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlGetLastId($tabla){

        $stmt = Conexion::conectar()->query("SELECT  MAX(id) AS id from $tabla ");

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlIncreaseQuantity($tabla,$item,$valor,$id){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = $item + :$item WHERE id = :id");

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

    static public function mdlShowAllAdsOferts($tabla,$base,$tope, $modo){

        $fechaActual = date("Y-m-d");

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE oferta = 1 and estado = 1 ORDER BY id $modo LIMIT $base, $tope");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;

    }

    static public function mdlShowAllAdsFront($tabla,$ordenar,$item,$valor,$base,$tope, $modo){

        $fechaActual = date("Y-m-d");

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND (oferta = 0 or fin_oferta is null ) ORDER BY $ordenar $modo LIMIT $base, $tope");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlShowSearchAds($tabla,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT a.*, c.nombre nombre_categoria FROM $tabla a left join categorias c on a.id_category = c.id
                                                            WHERE a.estado = 1 
                                                            and (a.title LIKE '%$valor%' or a.description LIKE '%$valor%') ORDER BY a.id DESC ");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }
}