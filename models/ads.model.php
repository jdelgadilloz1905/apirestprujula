<?php

require_once "conexion.php";

class ModelsAds{

    static public function mdlCreateAd($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_user,title,price,price_offer,description,half,people,offer,discount_amount,id_category,address,country,country_code,county,city,municipality,state,lat,lng,address_reference,phone,picture_url,picture_url_offer,picture_galery,
                                                                            agua,luz,tocador,cocinas,bbq,fogata,historico,ecologia,agricola,reactivo_pasivo,reactivo_activo,recreacion_piscinas,recreacion_acuaticas,recreacion_veredas,
                                                                            recreacion_espeleologia,recreacion_kayac_paddle_balsas,recreacion_cocina,recreacion_pajaros,recreacion_alpinismo,recreacion_zipline,paracaidas,recreacion_areas,recreacion_animales,
                                                                            equipos_mesas,equipos_sillas,equipos_estufas,casetas_acampar,toldos,estufas_gas,tanques_gas,lena,carbon,se_admiten_mascotas,perros_servicios, rowid)
                                                                    VALUES (:id_user,:title,:price,:price_offer,:description,:half,:people,:offer,:discount_amount,:id_category,:address,:country,:country_code,:county,:city,:municipality,:state,:lat,:lng,:address_reference,:phone,:picture_url,:picture_url_offer,:picture_galery,
                                                                            :agua,:luz,:tocador,:cocinas,:bbq,:fogata,:historico,:ecologia,:agricola,:reactivo_pasivo,:reactivo_activo,:recreacion_piscinas,:recreacion_acuaticas,:recreacion_veredas,
                                                                            :recreacion_espeleologia,:recreacion_kayac_paddle_balsas,:recreacion_cocina,:recreacion_pajaros,:recreacion_alpinismo,:recreacion_zipline,:paracaidas,:recreacion_areas,:recreacion_animales,
                                                                            :equipos_mesas,:equipos_sillas,:equipos_estufas,:casetas_acampar,:toldos,:estufas_gas,:tanques_gas,:lena,:carbon,:se_admiten_mascotas,:perros_servicios, :rowid)");

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
        $stmt->bindParam(":casetas_acampar", $datos["casetas_acampar"], PDO::PARAM_STR);
        $stmt->bindParam(":toldos", $datos["toldos"], PDO::PARAM_STR);
        $stmt->bindParam(":estufas_gas", $datos["estufas_gas"], PDO::PARAM_STR);
        $stmt->bindParam(":tanques_gas", $datos["tanques_gas"], PDO::PARAM_STR);
        $stmt->bindParam(":lena", $datos["lena"], PDO::PARAM_STR);
        $stmt->bindParam(":carbon", $datos["carbon"], PDO::PARAM_STR);
        $stmt->bindParam(":se_admiten_mascotas", $datos["se_admiten_mascotas"], PDO::PARAM_STR);
        $stmt->bindParam(":perros_servicios", $datos["perros_servicios"], PDO::PARAM_STR);

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
                                                                            picture_url= :picture_url,picture_url_offer= :picture_url_offer,picture_galery = :picture_galery,agua = :agua,luz = :luz,tocador = :tocador,cocinas = :cocinas,bbq = :bbq,fogata = :fogata,historico = :historico,ecologia = :ecologia,
                                                                            agricola = :agricola,reactivo_pasivo = :reactivo_pasivo,reactivo_activo = :reactivo_activo,recreacion_piscinas = :recreacion_piscinas, recreacion_acuaticas = :recreacion_acuaticas,recreacion_veredas = :recreacion_veredas, 
                                                                            recreacion_espeleologia = :recreacion_espeleologia,recreacion_kayac_paddle_balsas = :recreacion_kayac_paddle_balsas,recreacion_cocina = :recreacion_cocina,recreacion_pajaros = :recreacion_pajaros,recreacion_alpinismo = :recreacion_alpinismo,
                                                                            recreacion_zipline = :recreacion_zipline,paracaidas = :paracaidas, recreacion_areas = :recreacion_areas,recreacion_animales = :recreacion_animales, equipos_mesas = :equipos_mesas,equipos_sillas = :equipos_sillas,equipos_estufas = :equipos_estufas,
                                                                            casetas_acampar = :casetas_acampar,toldos = :toldos,estufas_gas = :estufas_gas, tanques_gas = :tanques_gas, lena = :lena, carbon = :carbon,se_admiten_mascotas = :se_admiten_mascotas, perros_servicios = :perros_servicios
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
        $stmt->bindParam(":casetas_acampar", $datos["casetas_acampar"], PDO::PARAM_STR);
        $stmt->bindParam(":toldos", $datos["toldos"], PDO::PARAM_STR);
        $stmt->bindParam(":estufas_gas", $datos["estufas_gas"], PDO::PARAM_STR);
        $stmt->bindParam(":tanques_gas", $datos["tanques_gas"], PDO::PARAM_STR);
        $stmt->bindParam(":lena", $datos["lena"], PDO::PARAM_STR);
        $stmt->bindParam(":carbon", $datos["carbon"], PDO::PARAM_STR);
        $stmt->bindParam(":se_admiten_mascotas", $datos["se_admiten_mascotas"], PDO::PARAM_STR);
        $stmt->bindParam(":perros_servicios", $datos["perros_servicios"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlUserPublications($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT a.id,a.id_user idUser,a.title,a.price,a.price_offer,a.description,a.half,a.people,a.offer,a.discount_amount, a.id_category, c.nombre nombre_categoria FROM $tabla a left join categorias c on a.id_category = c.id
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

    static public function mdlBookPublications($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_anuncio,id_user,cantidad_personas, cantidad_dias,fecha_desde,fecha_hasta,fecha_vencimiento,precio,impuesto,descuento,comision,total,rowid)
                                                                    VALUES (:id_anuncio,:id_user,:cantidad_personas, :cantidad_dias,:fecha_desde,:fecha_hasta,:fecha_vencimiento,:precio,:impuesto,:descuento,:comision, :total,:rowid)");

        $stmt->bindParam(":id_anuncio", $datos["id_anuncio"], PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad_personas", $datos["cantidad_personas"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad_dias", $datos["cantidad_dias"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_desde", $datos["fecha_desde"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_hasta", $datos["fecha_hasta"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
        $stmt->bindParam(":comision", $datos["comision"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":rowid", $datos["rowid"], PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlDateReservadas($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT  id_anuncio, fecha_desde, fecha_hasta from $tabla where $item = :$item order by id desc  ");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlOfferxPublication($tabla,$item,$valor){

        $stmt = Conexion::conectar()->query("SELECT r.*, u.nombre, u.apellido, u.foto from $tabla r LEFT JOIN usuarios u ON r.id_user = u.id where r.id_anuncio = $valor AND r.estatus = 0 order by r.id desc ");

        //$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    /***************************************
    MOSTRAR LAS RESERVACIONS DE MIS PUBLICACIONES
     **************************************/

    static public function mdlShowReservation($tabla,$item,$valor,$estatus){

        $stmt = Conexion::conectar()->prepare("SELECT  r.*, u.nombre, u.apellido, a.title 
                                                         from $tabla r 
                                                         left join usuarios u 
                                                         on u.id = r.id_user 
                                                         left join anuncios a 
                                                         on a.id = r.id_anuncio
                                                         where r.$item = :$item AND r.estatus = :estatus order by r.id desc  ");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> bindParam(":estatus", $estatus, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlUpdateReservation($tabla,$data){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = :estatus WHERE id = :id");

        $stmt->bindParam(":estatus", $data["updEstatus"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $data["updId"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlShowAdsReservation($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT  r.*, u.nombre, u.apellido, u.email from $tabla r left join usuarios u on u.id = r.id_user where r.$item = :$item ");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);


        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlConfirmReservation($tabla,$item,$valor){ //busco los datos del usuario si existe, reservacion y datos del anuncio

        $stmt = Conexion::conectar()->prepare("SELECT  r.*, a.title , u.id id_user,u.email, u.nombre, u.apellido, u.foto, 
                                                                    u.estado, u.ultimo_login, u.fecha_creacion,u.telefono,u.idioma,u.modo,
                                                                     u.email_encriptado,u.verificacion 
                                                            from $tabla r 
                                                            left join usuarios u 
                                                            on u.id = r.id_user
                                                            left join anuncios a
                                                            on a.id = r.id_anuncio 
                                                            where r.$item = :$item ");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);


        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }


}
