<?php

require_once "conexion.php";

class ModelsAds{

    static public function mdlCreateAd($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(titulo,precio,descripcion,media,personas,oferta,monto_descuento,id_categoria,direccion,ciudad,lat,lng,direccion_referencia,telefono,imagen_principal,imagen_oferta,imagen_galeria,
                                                                            camping_mochila,camping_baul,agua,luz,tocador,cocinas,bbq,fogata,historico,ecologia,agricola,reactivo_pasivo,reactivo_activo,recreacion_piscinas,recreacion_acuaticas,recreacion_veredas,
                                                                            recreacion_espeleologia,recreacion_kayac_paddle_balsas,recreacion_cocina,recreacion_pajaros,recreacion_alpinismo,recreacion_zipline,paracaidas,recreacion_areas,recreacion_animales,
                                                                            equipos_mesas,equipos_sillas,equipos_estufas)
                                                                    VALUES (:titulo,:precio,:descripcion,:media,:personas,:oferta,:monto_descuento,:id_categoria,:direccion,:ciudad,:lat,:lng,:direccion_referencia,:telefono,:imagen_principal,:imagen_oferta,:imagen_galeria,
                                                                            :camping_mochila,:camping_baul,:agua,:luz,:tocador,:cocinas,:bbq,:fogata,:historico,:ecologia,:agricola,:reactivo_pasivo,:reactivo_activo,:recreacion_piscinas,:recreacion_acuaticas,:recreacion_veredas,
                                                                            :recreacion_espeleologia,:recreacion_kayac_paddle_balsas,:recreacion_cocina,:recreacion_pajaros,:recreacion_alpinismo,:recreacion_zipline,:paracaidas,:recreacion_areas,:recreacion_animales,
                                                                            :equipos_mesas,:equipos_sillas,:equipos_estufas)");

        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":media", $datos["media"], PDO::PARAM_STR);
        $stmt->bindParam(":personas", $datos["personas"], PDO::PARAM_STR);
        $stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
        $stmt->bindParam(":monto_descuento", $datos["monto_descuento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":lat", $datos["lat"], PDO::PARAM_STR);
        $stmt->bindParam(":lng", $datos["lng"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_referencia", $datos["direccion_referencia"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen_principal", $datos["imagen_principal"]);
        $stmt->bindParam(":imagen_oferta", $datos["imagen_oferta"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen_galeria", $datos["imagen_galeria"], PDO::PARAM_STR);
        $stmt->bindParam(":camping_mochila", $datos["camping_mochila"], PDO::PARAM_STR);
        $stmt->bindParam(":camping_baul", $datos["camping_baul"], PDO::PARAM_STR);
        $stmt->bindParam(":agua", $datos["agua"], PDO::PARAM_STR);
        $stmt->bindParam(":luz", $datos["luz"], PDO::PARAM_STR);
        $stmt->bindParam(":tocador", $datos["tocador"], PDO::PARAM_STR);
        $stmt->bindParam(":cocinas", $datos["cocinas"], PDO::PARAM_STR);
        $stmt->bindParam(":bbq", $datos["bbq"], PDO::PARAM_STR);
        $stmt->bindParam(":fogata", $datos["fogata"], PDO::PARAM_STR);
        $stmt->bindParam(":historico", $datos["historico"], PDO::PARAM_STR);
        $stmt->bindParam(":ecologia", $datos["ecologia"], PDO::PARAM_STR);
        $stmt->bindParam(":agricola", $datos["agricola"], PDO::PARAM_STR);
        $stmt->bindParam(":reactivo_pasivo", $datos["reactivo_pasivo"], PDO::PARAM_STR);
        $stmt->bindParam(":reactivo_activo", $datos["reactivo_activo"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_piscinas", $datos["recreacion_piscinas"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_acuaticas", $datos["recreacion_acuaticas"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_veredas", $datos["recreacion_veredas"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_espeleologia", $datos["recreacion_espeleologia"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_kayac_paddle_balsas", $datos["recreacion_kayac_paddle_balsas"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_cocina", $datos["recreacion_cocina"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_pajaros", $datos["recreacion_pajaros"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_alpinismo", $datos["recreacion_alpinismo"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_zipline", $datos["recreacion_zipline"], PDO::PARAM_STR);
        $stmt->bindParam(":paracaidas", $datos["paracaidas"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_areas", $datos["recreacion_areas"], PDO::PARAM_STR);
        $stmt->bindParam(":recreacion_animales", $datos["recreacion_animales"], PDO::PARAM_STR);
        $stmt->bindParam(":equipos_mesas", $datos["equipos_mesas"], PDO::PARAM_STR);
        $stmt->bindParam(":equipos_sillas", $datos["equipos_sillas"], PDO::PARAM_STR);
        $stmt->bindParam(":equipos_estufas", $datos["equipos_estufas"], PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlShowAdsId($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT  a.*, c.nombre nombre_categoria from $tabla a left join categorias c on a.id_categoria = c.id where a.estado =1 and a.$item = :$item");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlShowAllAds($tabla){

        $stmt = Conexion::conectar()->query("SELECT  a.*, c.nombre nombre_categoria from $tabla a left join categorias c on a.id_categoria = c.id where a.estado =1 order by a.id desc  ");

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

        $stmt = Conexion::conectar()->prepare("SELECT a.*, c.nombre nombre_categoria FROM $tabla a left join categorias c on a.id_categoria = c.id WHERE a.oferta = 1 and a.estado = 1 ORDER BY a.id $modo LIMIT $base, $tope");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;

    }

    static public function mdlShowAllAdsFront($tabla,$ordenar,$item,$valor,$base,$tope, $modo){

        $fechaActual = date("Y-m-d");

        $stmt = Conexion::conectar()->prepare("SELECT a.*, c.nombre nombre_categoria FROM $tabla a left join categorias c on a.id_categoria = c.id WHERE a.$item = :$item AND (a.oferta = 0 or a.fin_oferta is null ) ORDER BY $ordenar $modo LIMIT $base, $tope");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlShowSearchAds($tabla,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT a.*, c.nombre nombre_categoria FROM $tabla a left join categorias c on a.id_categoria = c.id
                                                            WHERE estado = 1 
                                                            and (a.titulo LIKE '%$valor%' or a.descripcion LIKE '%$valor%') ORDER BY a.id DESC ");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }
}