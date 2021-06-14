<?php

require_once "conexion.php";

class ModelsAds{

    static public function mdlCreateAd($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_user,title,price,price_offer,description,half,people,offer,discount_amount,id_category,address,country,country_code,county,city,municipality,state,lat,lng,address_reference,phone,picture_url,picture_url_offer,picture_galery,
                                                                            camping_mochila,camping_baul,agua,luz,tocador,cocinas,bbq,fogata,historico,ecologia,agricola,reactivo_pasivo,reactivo_activo,recreacion_piscinas,recreacion_acuaticas,recreacion_veredas,
                                                                            recreacion_espeleologia,recreacion_kayac_paddle_balsas,recreacion_cocina,recreacion_pajaros,recreacion_alpinismo,recreacion_zipline,paracaidas,recreacion_areas,recreacion_animales,
                                                                            equipos_mesas,equipos_sillas,equipos_estufas, rowid)
                                                                    VALUES (:id_user,:title,:price,:price_offer,:description,:half,:people,:offer,:discount_amount,:id_category,:address,:country,:country_code,:county,:city,:municipality,:state,:lat,:lng,:address_reference,:phone,:picture_url,:picture_url_offer,:picture_galery,
                                                                            :camping_mochila,:camping_baul,:agua,:luz,:tocador,:cocinas,:bbq,:fogata,:historico,:ecologia,:agricola,:reactivo_pasivo,:reactivo_activo,:recreacion_piscinas,:recreacion_acuaticas,:recreacion_veredas,
                                                                            :recreacion_espeleologia,:recreacion_kayac_paddle_balsas,:recreacion_cocina,:recreacion_pajaros,:recreacion_alpinismo,:recreacion_zipline,:paracaidas,:recreacion_areas,:recreacion_animales,
                                                                            :equipos_mesas,:equipos_sillas,:equipos_estufas, :rowid)");

        $stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_STR);
        $stmt->bindParam(":title", $datos["title"], PDO::PARAM_STR);
        $stmt->bindParam(":price", $datos["price"], PDO::PARAM_STR);
        $stmt->bindParam(":price_offer", $datos["price_offer"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $datos["description"], PDO::PARAM_STR);
        $stmt->bindParam(":half", $datos["half"], PDO::PARAM_STR);
        $stmt->bindParam(":people", $datos["people"], PDO::PARAM_STR);
        $stmt->bindParam(":offer", $datos["offer"], PDO::PARAM_STR);
        $stmt->bindParam(":discount_amount", $datos["discount_amount"], PDO::PARAM_STR);
        $stmt->bindParam(":id_category", $datos["id_category"], PDO::PARAM_STR);
        $stmt->bindParam(":address", $datos["address"], PDO::PARAM_STR);
        $stmt->bindParam(":country", $datos["country"], PDO::PARAM_STR);
        $stmt->bindParam(":country_code", $datos["country_code"], PDO::PARAM_STR);
        $stmt->bindParam(":county", $datos["county"], PDO::PARAM_STR);
        $stmt->bindParam(":city", $datos["city"], PDO::PARAM_STR);
        $stmt->bindParam(":municipality", $datos["municipality"], PDO::PARAM_STR);
        $stmt->bindParam(":state", $datos["state"], PDO::PARAM_STR);
        $stmt->bindParam(":lat", $datos["lat"], PDO::PARAM_STR);
        $stmt->bindParam(":lng", $datos["lng"], PDO::PARAM_STR);
        $stmt->bindParam(":address_reference", $datos["address_reference"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $datos["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":picture_url", $datos["picture_url"]);
        $stmt->bindParam(":picture_url_offer", $datos["picture_url_offer"], PDO::PARAM_STR);
        $stmt->bindParam(":picture_galery", $datos["picture_galery"], PDO::PARAM_STR);
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
        $stmt->bindParam(":rowid", $datos["rowid"], PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlShowAdsId($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT  a.*, c.nombre nombre_categoria from $tabla a left join categorias c on a.id_category = c.id where a.estado =1 and a.$item = :$item");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlShowAllAds($tabla){

        $stmt = Conexion::conectar()->query("SELECT  a.*, c.nombre nombre_categoria from $tabla a left join categorias c on a.id_category = c.id where a.estado =1 order by a.id desc  ");

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

        $stmt = Conexion::conectar()->prepare("SELECT a.*, c.nombre nombre_categoria FROM $tabla a left join categorias c on a.id_category = c.id WHERE a.offer = 1 and a.estado = 1 ORDER BY a.id $modo LIMIT $base, $tope");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;

    }

    static public function mdlShowAllAdsFront($tabla,$ordenar,$item,$valor,$base,$tope, $modo){

        $fechaActual = date("Y-m-d");

        $stmt = Conexion::conectar()->prepare("SELECT a.*, c.nombre nombre_categoria FROM $tabla a left join categorias c on a.id_category = c.id WHERE a.$item = :$item AND (a.offer = 0 or a.fin_oferta is null ) ORDER BY $ordenar $modo LIMIT $base, $tope");

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

    static public function mdlUpdateAd($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_user= :id_user,title= :title,price= :price, price_offer= :price_offer,description= :description,half= :half,people= :people,offer= :offer,discount_amount= :discount_amount,id_category= :id_category,address= :address,
                                                                            country= :country,country_code= :country_code,county= :county,city= :city,municipality= :municipality,state= :state,lat= :lat,lng= :lng,address_reference= :address_reference,phone= :phone,
                                                                            picture_url= :picture_url,picture_url_offer= :picture_url_offer,picture_galery = :picture_galery,camping_mochila= :camping_mochila,camping_baul = :camping_baul,agua = :agua,luz = :luz,tocador = :tocador,
                                                                            cocinas = :cocinas,bbq = :bbq,fogata = :fogata,historico = :historico,ecologia = :ecologia,agricola = :agricola,reactivo_pasivo = :reactivo_pasivo,reactivo_activo = :reactivo_activo,recreacion_piscinas = :recreacion_piscinas,
                                                                            recreacion_acuaticas = :recreacion_acuaticas,recreacion_veredas = :recreacion_veredas, recreacion_espeleologia = :recreacion_espeleologia,recreacion_kayac_paddle_balsas = :recreacion_kayac_paddle_balsas,
                                                                            recreacion_cocina = :recreacion_cocina,recreacion_pajaros = :recreacion_pajaros,recreacion_alpinismo = :recreacion_alpinismo,recreacion_zipline = :recreacion_zipline,paracaidas = :paracaidas,
                                                                            recreacion_areas = :recreacion_areas,recreacion_animales = :recreacion_animales, equipos_mesas = :equipos_mesas,equipos_sillas = :equipos_sillas,equipos_estufas = :equipos_estufas
                                                                            WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_STR);
        $stmt->bindParam(":title", $datos["title"], PDO::PARAM_STR);
        $stmt->bindParam(":price", $datos["price"], PDO::PARAM_STR);
        $stmt->bindParam(":price_offer", $datos["price_offer"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $datos["description"], PDO::PARAM_STR);
        $stmt->bindParam(":half", $datos["half"], PDO::PARAM_STR);
        $stmt->bindParam(":people", $datos["people"], PDO::PARAM_STR);
        $stmt->bindParam(":offer", $datos["offer"], PDO::PARAM_STR);
        $stmt->bindParam(":discount_amount", $datos["discount_amount"], PDO::PARAM_STR);
        $stmt->bindParam(":id_category", $datos["id_category"], PDO::PARAM_STR);
        $stmt->bindParam(":address", $datos["address"], PDO::PARAM_STR);
        $stmt->bindParam(":country", $datos["country"], PDO::PARAM_STR);
        $stmt->bindParam(":country_code", $datos["country_code"], PDO::PARAM_STR);
        $stmt->bindParam(":county", $datos["county"], PDO::PARAM_STR);
        $stmt->bindParam(":city", $datos["city"], PDO::PARAM_STR);
        $stmt->bindParam(":municipality", $datos["municipality"], PDO::PARAM_STR);
        $stmt->bindParam(":state", $datos["state"], PDO::PARAM_STR);
        $stmt->bindParam(":lat", $datos["lat"], PDO::PARAM_STR);
        $stmt->bindParam(":lng", $datos["lng"], PDO::PARAM_STR);
        $stmt->bindParam(":address_reference", $datos["address_reference"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $datos["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":picture_url", $datos["picture_url"]);
        $stmt->bindParam(":picture_url_offer", $datos["picture_url_offer"], PDO::PARAM_STR);
        $stmt->bindParam(":picture_galery", $datos["picture_galery"], PDO::PARAM_STR);
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

    static public function mdlUserPublications($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT a.id_user idUser,a.title,a.price,a.price_offer,a.description,a.half,a.people,a.offer,a.discount_amount, a.id_category, c.nombre nombre_categoria FROM $tabla a left join categorias c on a.id_category = c.id
                                                            WHERE a.estado = 1 
                                                            and a.id_user = $valor ORDER BY a.id DESC ");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlDeletePublication($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;
    }
}
