<?php
class ControllerAds{

    static public function ctrCreateAd($data){

        if(isset($data["regTitle"])){
            //insertar los registros y posteriormente insertar las imagenes
            /*=============================================
                GENERAR CONTRASEÑA ALEATORIA
                =============================================*/

            function generarPassword($longitud){

                $key = "";
                $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

                $max = strlen($pattern)-1;

                for($i = 0; $i < $longitud; $i++){

                    $key .= $pattern[mt_rand(0,$max)];

                }

                return $key;

            }

            $nuevaForenKey = generarPassword(30);


            $datos = array(
                "id_user"=>$data["regIdUser"],
                "title"=>$data["regTitle"],
                "price"=>$data["regPrice"],
                "price_offer"=>$data["regPriceOffer"],
                "description"=>$data["regDescription"],
                "half"=>$data["regHalf"],
                "people"=>$data["regPeople"],
                "offer"=>$data["regOffer"],
                "discount_amount"=>$data["regDiscountAmount"],
                "id_category"=>$data["regIdCategory"],
                "address"=>$data["regAddress"]["completeAddress"],
                "country"=>$data["regAddress"]["country"],
                "country_code"=>$data["regAddress"]["countryCode"],
                "county"=>$data["regAddress"]["county"],
                "city"=>$data["regAddress"]["city"],
                "municipality"=>$data["regAddress"]["municipality"],
                "state"=>$data["regAddress"]["state"],
                "lat"=>$data["regAddress"]["lat"],
                "lng"=>$data["regAddress"]["lng"],
                "address_reference"=>$data["regAddressDescription"],
                "phone"=>$data["regPhone"],
                "picture_url"=>json_encode($data["regMainImage"]),
                "picture_url_offer"=>json_encode($data["regDealImage"]),
                "picture_galery"=>json_encode($data["regImageGallery"]),
                "camping_mochila"=>$data["regAmenities"]["camping_mochila"],
                "camping_baul"=>$data["regAmenities"]["camping_baul"],
                "agua"=>$data["regAmenities"]["agua"],
                "luz"=>$data["regAmenities"]["luz"],
                "tocador"=>$data["regAmenities"]["tocador"],
                "cocinas"=>$data["regAmenities"]["cocinas"],
                "bbq"=>$data["regAmenities"]["bbq"],
                "fogata"=>$data["regAmenities"]["fogata"],
                "historico"=>$data["regAmenities"]["historico"],
                "ecologia"=>$data["regAmenities"]["ecologia"],
                "agricola"=>$data["regAmenities"]["agricola"],
                "reactivo_pasivo"=>$data["regAmenities"]["reactivo_pasivo"],
                "reactivo_activo"=>$data["regAmenities"]["reactivo_activo"],
                "recreacion_piscinas"=>$data["regAmenities"]["recreacion_piscinas"],
                "recreacion_acuaticas"=>$data["regAmenities"]["recreacion_acuaticas"],
                "recreacion_veredas"=>$data["regAmenities"]["recreacion_veredas"],
                "recreacion_espeleologia"=>$data["regAmenities"]["recreacion_espeleologia"],
                "recreacion_kayac_paddle_balsas"=>$data["regAmenities"]["recreacion_kayac_paddle_balsas"],
                "recreacion_cocina"=>$data["regAmenities"]["recreacion_cocina"],
                "recreacion_pajaros"=>$data["regAmenities"]["recreacion_pajaros"],
                "recreacion_alpinismo"=>$data["regAmenities"]["recreacion_alpinismo"],
                "recreacion_zipline"=>$data["regAmenities"]["recreacion_zipline"],
                "paracaidas"=>$data["regAmenities"]["paracaidas"],
                "recreacion_areas"=>$data["regAmenities"]["recreacion_areas"],
                "recreacion_animales"=>$data["regAmenities"]["recreacion_animales"],
                "equipos_mesas"=>$data["regAmenities"]["equipos_mesas"],
                "equipos_sillas"=>$data["regAmenities"]["equipos_sillas"],
                "equipos_estufas"=>$data["regAmenities"]["equipos_estufas"],
                "rowid"=> $nuevaForenKey
            );

            $resultado = ModelsAds::mdlCreateAd("anuncios",$datos);

            //Busco el ultimo ID para las imagenes
            if($resultado == "ok"){
                //$idInsertado = ModelsAds::mdlGetLastId("anuncios");
                $idUltimoAnuncio = ModelsAds::mdlShowAdsId("anuncios","rowid",$nuevaForenKey);

                //Enviar el registro en algolia

                $algolia= ControllerAlgolia::ctrCreateAdsAlgolia($idUltimoAnuncio);

                echo json_encode(array(
                    "statusCode" => 200,
                    "adsInfo"=>$idUltimoAnuncio["id"],
                    "error" => false,
                    "algolia"=>$algolia,
                    "mensaje" =>"Genial orden # ".$idUltimoAnuncio["id"]." creada con exito"
                ));
            }else{
                echo json_encode(array(
                    "statusCode" => 400,
                    "adsInfo"=>"",
                    "error" => true,
                    "mensaje" =>"Error al crear el anuncio, contacte con el administrador",
                ));
            }
        }
    }

    static public function ctrShowAdsId($datos){

        $data = ModelsAds::mdlShowAdsId("anuncios","id",$datos["conId"]);

        if($data){
            $resultado = array(
                "id"=>$data["id"],
                "id_user"=>$data["id_user"],
                "title"=>$data["title"],
                "price"=>$data["price"],
                "price_offer"=>$data["price_offer"],
                "description"=>$data["description"],
                "half"=>$data["half"],
                "people"=>$data["people"],
                "offer"=>$data["offer"],
                "discount_amount"=>$data["discount_amount"],
                "id_category"=>$data["id_category"],
                "nombre_categoria"=>$data["nombre_categoria"],
                "completeAddress" => array(
                    "address"=>$data["address"],
                    "country"=>$data["country"],
                    "country_code"=>$data["country_code"],
                    "county"=>$data["county"],
                    "city"=>$data["city"],
                    "municipality"=>$data["municipality"],
                    "state"=>$data["state"],
                    "lat"=>$data["lat"],
                    "lng"=>$data["lng"],
                    "address_reference"=>$data["address_reference"],
                ),
                "phone"=>$data["phone"],
                "picture" => array(
                    "picture_url"=>json_decode($data["picture_url"] , true),
                    "picture_url_offer"=>json_decode($data["picture_url_offer"] , true),
                    "picture_galery"=>json_decode($data["picture_galery"], true)
                ),
                "calificacion"=>$data["calificacion"],
                "estado"=>$data["estado"],
                "fecha_creacion"=>$data["fecha_creacion"],
                "vistas"=>$data["vistas"],
                "reservaciones"=>$data["reservaciones"],
                "fin_oferta"=>$data["fin_oferta"],
                "amenidades"=> array(
                    "camping_mochila"=>$data["camping_mochila"],
                    "camping_baul"=>$data["camping_baul"],
                    "agua"=>$data["agua"],
                    "luz"=>$data["luz"],
                    "tocador"=>$data["tocador"],
                    "cocinas"=>$data["cocinas"],
                    "bbq"=>$data["bbq"],
                    "fogata"=>$data["fogata"],
                    "historico"=>$data["historico"],
                    "ecologia"=>$data["ecologia"],
                    "agricola"=>$data["agricola"],
                    "reactivo_pasivo"=>$data["reactivo_pasivo"],
                    "reactivo_activo"=>$data["reactivo_activo"],
                    "recreacion_piscinas"=>$data["recreacion_piscinas"],
                    "recreacion_acuaticas"=>$data["recreacion_acuaticas"],
                    "recreacion_veredas"=>$data["recreacion_veredas"],
                    "recreacion_espeleologia"=>$data["recreacion_espeleologia"],
                    "recreacion_kayac_paddle_balsas"=>$data["recreacion_kayac_paddle_balsas"],
                    "recreacion_cocina"=>$data["recreacion_cocina"],
                    "recreacion_pajaros"=>$data["recreacion_pajaros"],
                    "recreacion_alpinismo"=>$data["recreacion_alpinismo"],
                    "recreacion_zipline"=>$data["recreacion_zipline"],
                    "paracaidas"=>$data["paracaidas"],
                    "recreacion_areas"=>$data["recreacion_areas"],
                    "recreacion_animales"=>$data["recreacion_animales"],
                    "equipos_mesas"=>$data["equipos_mesas"],
                    "equipos_sillas"=>$data["equipos_sillas"],
                    "equipos_estufas"=>$data["equipos_estufas"],
                )

            );

            echo json_encode(array(
                "statusCode" => 200,
                "cantidad"  =>count($resultado),
                "adsInfo"=>$resultado,
                "error" => false,
                "mensaje" =>"",
            ));
        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "adsInfo"=>"no existe el anuncio",
                "error" => true,
                "mensaje" =>"",
            ));
        }


    }

    static public function ctrShowAllAds(){

        $respuesta = ModelsAds::mdlShowAllAds("anuncios");


        $resultado = self::ctrPrepararMatrizJson($respuesta);


        echo json_encode(array(
            "statusCode" => 200,
            "cantidad"  =>count($resultado),
            "adsInfo"=>$resultado,
            "error" => false,
            "mensaje" =>"",
        ));

    }

    static public function ctrIncreaseQuantity($obj){

        ModelsAds::mdlIncreaseQuantity($obj["tabla"],$obj["item"],$obj["valor"],$obj["id"]);

        echo json_encode(array(
            "statusCode" => 200,
            "error" => false,
            "mensaje" =>"Se incremento la cantidad correctamente",
        ));

    }

    //MOSTRAR LOS ANUNCIOS QUE VAN EN LA PAGINA PRINCIPAL

    static public function ctrShowFeaturedAds(){

        $base = 0;
        $tope = 4;
        $modo = "DESC";

        //PROMOCIONES
        $promociones = ModelsAds::mdlShowAllAdsOferts("anuncios",$base,$tope, $modo);

        $resultado = self::ctrPrepararMatrizJson($promociones);

        //LOS MAS VISTOS
        $vistos = ModelsAds::mdlShowAllAdsFront("anuncios","vistas","estado","1",$base,$tope, $modo);

        $resultado1 = self::ctrPrepararMatrizJson($vistos);

        //LO MAS RESERVADO O VENDIDO
        $reservaciones = ModelsAds::mdlShowAllAdsFront("anuncios","reservaciones","estado","1",$base,$tope, $modo);

        $resultado2 = self::ctrPrepararMatrizJson($reservaciones);

        echo json_encode(array(
            "statusCode" => 200,
            "fecha_actual" => date("Y-m-d"),
            "adsInfo"=> array(
                "promociones" =>$promociones,
                "vistos" =>$resultado1,
                "reservados" =>$resultado2,
            ),
            "error" => false,
            "mensaje" =>"",
        ));

    }

    static public function ctrPrepararMatrizJson($valores){

        foreach ($valores as $key => $data){

            $resultado[$key] = array(
                "id"=>$data["id"],
                "id_user"=>$data["id_user"],
                "title"=>$data["title"],
                "price"=>$data["price"],
                "price_offer"=>$data["price_offer"],
                "description"=>$data["description"],
                "half"=>$data["half"],
                "people"=>$data["people"],
                "offer"=>$data["offer"],
                "discount_amount"=>$data["discount_amount"],
                "id_category"=>$data["id_category"],
                "nombre_categoria"=>$data["nombre_categoria"],
                "completeAddress" => array(
                    "address"=>$data["address"],
                    "country"=>$data["country"],
                    "country_code"=>$data["country_code"],
                    "county"=>$data["county"],
                    "city"=>$data["city"],
                    "municipality"=>$data["municipality"],
                    "state"=>$data["state"],
                    "lat"=>$data["lat"],
                    "lng"=>$data["lng"],
                    "address_reference"=>$data["address_reference"],
                ),
                "phone"=>$data["phone"],
                "picture" => array(
                    "picture_url"=>json_decode($data["picture_url"] , true),
                    "picture_url_offer"=>json_decode($data["picture_url_offer"] , true),
                    "picture_galery"=>json_decode($data["picture_galery"], true)
                ),
                "calificacion"=>$data["calificacion"],
                "estado"=>$data["estado"],
                "fecha_creacion"=>$data["fecha_creacion"],
                "vistas"=>$data["vistas"],
                "reservaciones"=>$data["reservaciones"],
                "fin_oferta"=>$data["fin_oferta"],
                "amenidades"=> array(
                    "camping_mochila"=>$data["camping_mochila"],
                    "camping_baul"=>$data["camping_baul"],
                    "agua"=>$data["agua"],
                    "luz"=>$data["luz"],
                    "tocador"=>$data["tocador"],
                    "cocinas"=>$data["cocinas"],
                    "bbq"=>$data["bbq"],
                    "fogata"=>$data["fogata"],
                    "historico"=>$data["historico"],
                    "ecologia"=>$data["ecologia"],
                    "agricola"=>$data["agricola"],
                    "reactivo_pasivo"=>$data["reactivo_pasivo"],
                    "reactivo_activo"=>$data["reactivo_activo"],
                    "recreacion_piscinas"=>$data["recreacion_piscinas"],
                    "recreacion_acuaticas"=>$data["recreacion_acuaticas"],
                    "recreacion_veredas"=>$data["recreacion_veredas"],
                    "recreacion_espeleologia"=>$data["recreacion_espeleologia"],
                    "recreacion_kayac_paddle_balsas"=>$data["recreacion_kayac_paddle_balsas"],
                    "recreacion_cocina"=>$data["recreacion_cocina"],
                    "recreacion_pajaros"=>$data["recreacion_pajaros"],
                    "recreacion_alpinismo"=>$data["recreacion_alpinismo"],
                    "recreacion_zipline"=>$data["recreacion_zipline"],
                    "paracaidas"=>$data["paracaidas"],
                    "recreacion_areas"=>$data["recreacion_areas"],
                    "recreacion_animales"=>$data["recreacion_animales"],
                    "equipos_mesas"=>$data["equipos_mesas"],
                    "equipos_sillas"=>$data["equipos_sillas"],
                    "equipos_estufas"=>$data["equipos_estufas"],
                ),

            );
        }

        return $resultado;
    }

    /*============================================
    BUSCAR ANUNCIOS DEL HOME
    ==============================================*/
    static public function ctrShowSearchAds($obj){

        $tabla  = "anuncios";
        $valor  = $obj["conLocalidad"];
        //$valor2 = $obj["conFechaDesde"];
        //$valor3 = $obj["conFechaHast"];
        //$valor2 = $obj["conCategoria"];

        $respuesta = ModelsAds::mdlShowSearchAds($tabla,$valor);

        if($respuesta){

            $result = self::ctrPrepararMatrizJson($respuesta);

            echo json_encode(array(
                "statusCode" => 200,
                "cantidad"  =>count($result),
                "adsInfo"=>$result,
                "error" => false,
                "mensaje" =>""
            ));
        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "cantidad"  =>0,
                "adsInfo"=>"no se encontraron registros",
                "error" => true,
                "mensaje" =>"",
            ));
        }
    }

    static public function ctrUpdateAd($data){

        if(isset($data["updId"])){

            $datos = array(
                "id" =>$data["updId"],
                "id_user"=>$data["updIdUser"],
                "title"=>$data["updTitle"],
                "price"=>$data["updPrice"],
                "price_offer"=>$data["updPriceOffer"],
                "description"=>$data["updDescription"],
                "half"=>$data["updHalf"],
                "people"=>$data["updPeople"],
                "offer"=>$data["updOffer"],
                "discount_amount"=>$data["updDiscountAmount"],
                "id_category"=>$data["updIdCategory"],
                "address"=>$data["updAddress"]["completeAddress"],
                "country"=>$data["updAddress"]["country"],
                "country_code"=>$data["updAddress"]["countryCode"],
                "county"=>$data["updAddress"]["county"],
                "city"=>$data["updAddress"]["city"],
                "municipality"=>$data["updAddress"]["municipality"],
                "state"=>$data["updAddress"]["state"],
                "lat"=>$data["updAddress"]["lat"],
                "lng"=>$data["updAddress"]["lng"],
                "address_reference"=>$data["updAddressDescription"],
                "phone"=>$data["updPhone"],
                "picture_url"=>json_encode($data["updMainImage"]),
                "picture_url_offer"=>json_encode($data["updDealImage"]),
                "picture_galery"=>json_encode($data["updImageGallery"]),
                "camping_mochila"=>$data["updAmenities"]["camping_mochila"],
                "camping_baul"=>$data["updAmenities"]["camping_baul"],
                "agua"=>$data["updAmenities"]["agua"],
                "luz"=>$data["updAmenities"]["luz"],
                "tocador"=>$data["updAmenities"]["tocador"],
                "cocinas"=>$data["updAmenities"]["cocinas"],
                "bbq"=>$data["updAmenities"]["bbq"],
                "fogata"=>$data["updAmenities"]["fogata"],
                "historico"=>$data["updAmenities"]["historico"],
                "ecologia"=>$data["updAmenities"]["ecologia"],
                "agricola"=>$data["updAmenities"]["agricola"],
                "reactivo_pasivo"=>$data["updAmenities"]["reactivo_pasivo"],
                "reactivo_activo"=>$data["updAmenities"]["reactivo_activo"],
                "recreacion_piscinas"=>$data["updAmenities"]["recreacion_piscinas"],
                "recreacion_acuaticas"=>$data["updAmenities"]["recreacion_acuaticas"],
                "recreacion_veredas"=>$data["updAmenities"]["recreacion_veredas"],
                "recreacion_espeleologia"=>$data["updAmenities"]["recreacion_espeleologia"],
                "recreacion_kayac_paddle_balsas"=>$data["updAmenities"]["recreacion_kayac_paddle_balsas"],
                "recreacion_cocina"=>$data["updAmenities"]["recreacion_cocina"],
                "recreacion_pajaros"=>$data["updAmenities"]["recreacion_pajaros"],
                "recreacion_alpinismo"=>$data["updAmenities"]["recreacion_alpinismo"],
                "recreacion_zipline"=>$data["updAmenities"]["recreacion_zipline"],
                "paracaidas"=>$data["updAmenities"]["paracaidas"],
                "recreacion_areas"=>$data["updAmenities"]["recreacion_areas"],
                "recreacion_animales"=>$data["updAmenities"]["recreacion_animales"],
                "equipos_mesas"=>$data["updAmenities"]["equipos_mesas"],
                "equipos_sillas"=>$data["updAmenities"]["equipos_sillas"],
                "equipos_estufas"=>$data["updAmenities"]["equipos_estufas"]
            );

            $resultado = ModelsAds::mdlUpdateAd("anuncios",$datos);


            if($resultado == "ok"){
                $idInsertado = ModelsAds::mdlGetLastId("anuncios");

                //Enviar el registro en algolia
                echo json_encode(array(
                    "statusCode" => 200,
                    "adsInfo"=>"",
                    "error" => false,
                    "mensaje" =>"Genial orden # ".$idInsertado["id"]." actualizada con exito"
                ));
            }else{
                echo json_encode(array(
                    "statusCode" => 400,
                    "adsInfo"=>"",
                    "error" => true,
                    "mensaje" =>"Error al crear el anuncio, contacte con el administrador",
                ));
            }
        }
    }

    static public function ctrUserPublications($data){

        $tabla = "anuncios";

        $item  ="id_user";

        $valor = $data["conIdUser"];

        $respuesta = ModelsAds::mdlUserPublications($tabla,$item,$valor);

        //$resultado2 = self::ctrPrepararMatrizJson($respuesta);

        if($respuesta){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "userPublic" =>$respuesta,
                "mensaje" =>""
            ));
        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "error" => true,
                "userPublic" =>"",
                "mensaje" =>"No se encontraron registros"
            ));
        }
    }
}