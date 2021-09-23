<?php
class ControllerAds{

    static public function ctrCreateAd($data){

        if(isset($data["regTitle"])){
            //insertar los registros y posteriormente insertar las imagenes

            $nuevaForenKey = self::generarPassword(30);

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
                "id_category"=>implode(",",$data["regIdCategory"]),
                "id_category2"=>implode(",",$data["regIdCategory2"]),
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
                "casetas_acampar"=>$data["regAmenities"]["casetas_acampar"],
                "toldos"=>$data["regAmenities"]["toldos"],
                "estufas_gas"=>$data["regAmenities"]["estufas_gas"],
                "tanques_gas"=>$data["regAmenities"]["tanques_gas"],
                "lena"=>$data["regAmenities"]["lena"],
                "carbon"=>$data["regAmenities"]["carbon"],
                "se_admiten_mascotas"=>$data["regAmenities"]["se_admiten_mascotas"],
                "perros_servicios"=>$data["regAmenities"]["perros_servicios"],
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
                    "rowid"=> $nuevaForenKey,
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

        $fechasArray = ModelsAds::mdlDateReservadas("reservaciones","id_anuncio",$data["id"]);


        //BUSCO LAS CALIFICACIONES DETALLADAS CON SU INFO DE CLIENTES

        $comentarios = ModelsAds::mdlShowReservationUser($datos["conId"]);

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
                "id_category"=>explode(",",$data["id_category"]),
                "id_category2"=>explode(",",$data["id_category2"]),
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
                "calification"=>$data["calificacion"],
                "detailCalification"=> $comentarios,
                "estado"=>$data["estado"],
                "fecha_creacion"=>$data["fecha_creacion"],
                "vistas"=>$data["vistas"],
                "reservaciones"=>$data["reservaciones"],
                "fin_oferta"=>$data["fin_oferta"],
                "amenidades"=> array(
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
                    "casetas_acampar"=>$data["casetas_acampar"],
                    "toldos"=>$data["toldos"],
                    "estufas_gas"=>$data["estufas_gas"],
                    "tanques_gas"=>$data["tanques_gas"],
                    "lena"=>$data["lena"],
                    "carbon"=>$data["carbon"],
                    "se_admiten_mascotas"=>$data["se_admiten_mascotas"],
                    "perros_servicios"=>$data["perros_servicios"],
                ),
                "disable_dates"=> ""        //self::ctrPreparaDisabledDates($fechasArray)

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

            //busco las fchas reservadas de cada anuncio si las tiene y creo un objeto y aqui las agrego

            //$fechasArray = ModelsAds::mdlDateReservadas("reservaciones","id_anuncio",$data["id"]);


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
                "id_category2"=>$data["id_category2"],
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
                    "casetas_acampar"=>$data["casetas_acampar"],
                    "toldos"=>$data["toldos"],
                    "estufas_gas"=>$data["estufas_gas"],
                    "tanques_gas"=>$data["tanques_gas"],
                    "lena"=>$data["lena"],
                    "carbon"=>$data["carbon"],
                    "se_admiten_mascotas"=>$data["se_admiten_mascotas"],
                    "perros_servicios"=>$data["perros_servicios"],

                ),
                "disable_dates"=> ""        //self::ctrPreparaDisabledDates($fechasArray)

            );
        }

        return $resultado;
    }

    static public function ctrPreparaDisabledDates($valores){

        foreach ($valores as $key => $data){
            $resultado[$key] = array(
                "start"=>$data["fecha_desde"],
                "end"=>$data["fecha_hasta"]
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
                "id_category"=>implode(",",$data["updIdCategory"]),
                "id_category2"=>implode(",",$data["updIdCategory2"]),
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
                "equipos_estufas"=>$data["updAmenities"]["equipos_estufas"],
                "casetas_acampar"=>$data["updAmenities"]["casetas_acampar"],
                "toldos"=>$data["updAmenities"]["toldos"],
                "estufas_gas"=>$data["updAmenities"]["estufas_gas"],
                "tanques_gas"=>$data["updAmenities"]["tanques_gas"],
                "lena"=>$data["updAmenities"]["lena"],
                "carbon"=>$data["updAmenities"]["carbon"],
                "se_admiten_mascotas"=>$data["updAmenities"]["se_admiten_mascotas"],
                "perros_servicios"=>$data["updAmenities"]["perros_servicios"],
            );

            $resultado = ModelsAds::mdlUpdateAd("anuncios",$datos);


            if($resultado == "ok"){
                //$idInsertado = ModelsAds::mdlGetLastId("anuncios");

                $idUltimoAnuncio = ModelsAds::mdlShowAdsId("anuncios","id",$data["updId"]);

                //Enviar el registro en algolia

                //$algolia= ControllerAlgolia::ctrUpdateAdsAlgolia($idUltimoAnuncio);

                $algolia= ControllerAlgolia::ctrCreateAdsAlgolia($idUltimoAnuncio);
                //Enviar el registro en algolia


                echo json_encode(array(
                    "statusCode" => 200,
                    "adsInfo"=>"",
                    "algolia"=>$algolia,
                    "error" => false,
                    "mensaje" =>"Genial orden # ".$data["updId"]." actualizada con exito"
                ));
            }else{
                echo json_encode(array(
                    "statusCode" => 400,
                    "adsInfo"=>"",
                    "error" => true,
                    "mensaje" =>"Error actualizando el anuncio, contacte con el administrador",
                ));
            }
        }else{

            echo json_encode(array(
                "statusCode" => 400,
                "adsInfo"=>"",
                "error" => true,
                "mensaje" =>"NO se estan recibiendo los datos adecuados, verifique las variables del JSON",
            ));
        }
    }

    static public function ctrUserPublications($data){

        //SON LAS PUBLICACIONES QUE ESTAN CREADAS POR EL PUBLICADOR, SOLO EL VERA LOS USUARIOS QUE HAN OFERTADO A SUS ANUNCIOS

        $tabla = "anuncios";

        $item  ="id_user";

        $valor = $data["conIdUser"];

        $respuesta = ModelsAds::mdlUserPublications($tabla,$item,$valor);

        $resultado2 = self::ctrPrepararMatrizUserPublicationJson($respuesta);

        if($respuesta){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "userPublic" =>$resultado2,
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

    static public function ctrUserReservations($data){

        //SON LAS RESERVACIONES QUE ESTAN OFERTADAS POR LOS USUARIOS QUE DISFRUTAN DE LOS SERVICIOS

        $tabla = "reservaciones";

        $item  ="id_user";

        $valor = $data["conIdUser"];

        $pending = ModelsAds::mdlShowReservation($tabla,$item,$valor,0);

        $approved = ModelsAds::mdlShowReservation($tabla,$item,$valor,1);

        $cancel = ModelsAds::mdlShowReservation($tabla,$item,$valor,2);


        echo json_encode(array(
            "statusCode" => 200,
            "error" => false,
            "userReservationPending" =>$pending,
            "userReservationApproved" =>$approved,
            "userReservationCancel" =>$cancel,
            "mensaje" =>""
        ));
    }

    static public function ctrPrepararMatrizUserPublicationJson($valores){

        foreach ($valores as $key => $data){

            //BUSCAR POR ESTATUS LAS RESERVACIONES

            $resultado[$key] = array(
                "id_anuncio"=>$data["id"],
                "idUser"=>$data["idUser"],
                "title"=>$data["title"],
                "price"=>$data["price"],
                "price_offer"=>$data["price_offer"],
                "description"=>$data["description"],
                "half"=>$data["half"],
                "people"=>$data["people"],
                "offer"=>$data["offer"],
                "discount_amount"=>$data["discount_amount"],
                "categorias"=>explode(",",$data["id_category"]),
                "vistas"=>explode(",",$data["id_category2"]),
                "pending"=>ModelsAds::mdlShowReservation("reservaciones","id_anuncio",$data["id"],0),
                "approved"=>ModelsAds::mdlShowReservation("reservaciones","id_anuncio",$data["id"],1),
                "canceled"=>ModelsAds::mdlShowReservation("reservaciones","id_anuncio",$data["id"],2),

            );
        }

        return $resultado;
    }

    static public function crtDeletePublication($data){


        $resultado = ModelsAds::mdlDeletePublication("anuncios","id",$data);

        if($resultado == "ok"){

            //elimino del aloglia
            ControllerAlgolia::ctrDeletePublications($data);

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Orden # ".$data["id"]." eliminada con exito"
            ));

        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "adsInfo"=>"",
                "error" => true,
                "mensaje" =>"Error eliminado publicacion, contacte con el administrador",
            ));

        }
    }

    static public function ctrOfferxPublication($data){

        $resultado = ModelsAds::mdlOfferxPublication("reservaciones", "id_anuncio", $data["conIdAnuncio"]);

        if($resultado == "ok"){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "infoOfferPublic" =>$resultado,
                "mensaje" =>""
            ));

        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "infoOfferPublic"=>$resultado,
                "error" => true,
                "mensaje" =>"No se encontraron registros",
            ));

        }
    }


    static public function ctrBookPublications($data){

        if(isset($data["idAnuncio"])){

            $nuevaForenKey = self::generarPassword(30);

            $cantDias = ModelsConfig::mdlConfig();

            $fecha_actual = date("Y-m-d");

            $fechaCaducidad = date("Y-m-d",strtotime($fecha_actual."+ ".$cantDias["dias_vencimiento"]." days"));

            $datos = array(
                "id_anuncio"=>$data["idAnuncio"],
                "id_user"=>$data["idUser"],
                "cantidad_personas"=>$data["cantPersonas"],
                "cantidad_dias"=>$data["cantDias"],
                "fecha_desde"=>$data["fechaInicio"],
                "fecha_hasta"=>$data["fechaFin"],
                "precio"=>$data["precioXNoche"],
                "impuesto"=>$data["impuesto"],
                "descuento"=>$data["descuento"],
                "comision"=>$data["comision"],
                "total"=>$data["total"],
                "fecha_vencimiento" =>$fechaCaducidad,
                "rowid" =>$nuevaForenKey
            );

            $resultado = ModelsAds::mdlBookPublications("reservaciones",$datos);

            if($resultado == "ok"){

                echo json_encode(array(
                    "statusCode" => 200,
                    "error" => false,
                    "mensaje" =>"Reservacion creada con exito"
                ));

            }else{
                echo json_encode(array(
                    "statusCode" => 400,
                    "adsInfo"=>"",
                    "error" => true,
                    "mensaje" =>"Error reservando el anuncio, contacte con el administrador",
                ));

            }
        }
    }

    /*=============================================
        GENERAR CONTRASEÑA ALEATORIA
    =============================================*/

    static public function generarPassword($longitud){

        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

        $max = strlen($pattern)-1;

        for($i = 0; $i < $longitud; $i++){

            $key .= $pattern[mt_rand(0,$max)];

        }

        return $key;

    }

    static public function ctrUpdateReservation($data){

        $resultado = ModelsAds::mdlUpdateReservation("reservaciones",$data);

        if($resultado == "ok"){

            //busco los datos del usuario

            $datos = ModelsAds::mdlShowAdsReservation("reservaciones","id",$data["updId"]);

            ///enviar email dependiendo del estatus


            $url = Ruta::ctrRutaEnvioEmailConfirm();

            date_default_timezone_set("America/Bogota");

            $mail = new PHPMailer;

            $mail->CharSet = 'UTF-8';

            $mail->isMail();

            $mail->setFrom('hola@prujula.com', 'PRUJULA');

            $mail->addReplyTo('hola@prujula.com', 'PRUJULA');


            if($data["updEstatus"]==1){


                $mail->Subject = "Felicidades ha sido aprobado tu oferta";

                $mail->addAddress($datos["email"]);

                $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

								<center>

									<img style="padding:20px; width:10%" src="">

								</center>

								<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

									<center>

									<img style="padding:20px; width:15%" src="https://prujula.com/static/media/main-logo.4bb1f751.png">

									<h3 style="font-weight:100; color:#999">TU SOLICITUD HA SIDO APROBADA</h3>

									<hr style="border:1px solid #ccc; width:80%">


									<a href="'.$url.$data["updId"].'" target="_blank" style="text-decoration:none">

									<div style="line-height:60px; background:#336722; width:60%; color:white">Ingrese nuevamente al sitio para realizar el pago </div>
									
									<div style="line-height:60px; background:#336722; width:60%; color:white">Posee 5 dias para realizar el pago, de lo contrario su reservación sera liberada </div>

									</a>

									<br>

									<hr style="border:1px solid #ccc; width:80%">

									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

									</center>

								</div>

							</div>');

                $mail->Send();


            }elseif($data["updEstatus"]==2){

                $mail->Subject = "Tu solicitud ha sido rechada";

                $mail->addAddress($datos["email"]);

                $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

								<center>

									<img style="padding:20px; width:10%" src="">

								</center>

								<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

									<center>

									<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">

									<h3 style="font-weight:100; color:#999">TU SOLICITUD HA SIDO RECHAZADA</h3>

									<hr style="border:1px solid #ccc; width:80%">

									<br>

									<hr style="border:1px solid #ccc; width:80%">

									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

									</center>

								</div>

							</div>');

                $mail->Send();
            }

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Genial se ha actualizado la publicacion "
            ));
        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "error" => true,
                "mensaje" =>"Error actualizando estatus del anuncio, contacte con el administrador",
            ));
        }
    }

    static public function ctrConfirmReservation($data){

        $respuesta = ModelsAds::mdlConfirmReservation("reservaciones","rowid",$data["conRowid"]);

        if($respuesta){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "infoReser" => $respuesta,
                "mensaje" =>" "
            ));
        }else{

            echo json_encode(array(
                "statusCode" => 400,
                "error" => true,
                "mensaje" =>"NO existe reservacion "
            ));
        }

    }

    static public function ctrCalificationUser($data){

        //primero valido que no se haya registrado una calificacion con el anuncio y reservacion

        $resultado = ModelsAds::mdlBuscarAnuncioReservacion($data);

        if(!$resultado){

            $respuesta = ModelsAds::mdlCalificationUser("calificacion",$data);

            if($respuesta){

                //si la calificacion es correcta actualizo la calificacion general en el anuncio y despues en algolia

                $calificacion  = self::ctrPrepararCalificacion($data["idAnuncio"]);

                //actualizo la calificacion general

                $datosCalificacion = array(
                    "idAnuncio" =>  $data["idAnuncio"],
                    "calificacion" => $calificacion
                );

                ModelsAds::mdlUpdateCalificacion($datosCalificacion);

                //busco el anuncio completo para actualizar

                $data = ModelsAds::mdlShowAdsId("anuncios","id",$data["idAnuncio"]);


                ControllerAlgolia::ctrCreateAdsAlgolia($data);

                echo json_encode(array(
                    "statusCode" => 200,
                    "error" => false,
                    "mensaje" =>"Buen trabajo, calificacion registrada con exito."
                ));

            }else{

                echo json_encode(array(
                    "statusCode" => 400,
                    "error" => true,
                    "mensaje" =>"Problema para insertar la calificacion, contacte con el administrador"
                ));
            }


        }else{

            echo json_encode(array(
                "statusCode" => 400,
                "error" => true,
                "mensaje" =>"Ya existe una calificacion para la reservacion # ".$data["idReservacion"]." y anuncio # ".$data["idAnuncio"]
            ));
        }
    }

    static public function ctrShowCalification($data){

        $respuesta = ModelsAds::mdlShowCalification("calificacion",$data);

        if($respuesta){

            //PREPARO LA MATRIZ

            foreach ($respuesta as $key => $data){

                //BUSCAR POR ESTATUS LAS RESERVACIONES

                $resultado[$key] = array(
                    "id"=>$data["id"],
                    "idAnuncio"=>$data["id_anuncio"],
                    "idUser"=>$data["id_user"],
                    "idReservacion"=>$data["id_reservacion"],
                    "commentary"=>$data["comentario"],
                    "answers"=>json_decode($data["encuesta"]),
                    "calification"=>$data["calificacion"],
                );
            }

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "infoCalif" => $resultado,
                "mensaje" =>" "
            ));
        }else{

            echo json_encode(array(
                "statusCode" => 400,
                "error" => true,
                "mensaje" =>"No se encontraron registros "
            ));
        }
    }

    static public function ctrPrepararCalificacion($id_anuncio){

        $idAnuncio = array(
            "idAnuncio"=>$id_anuncio
        );

        $respuesta = ModelsAds::mdlShowCalification("calificacion",$idAnuncio);

        if($respuesta){

            $acumulado = 0;
            foreach ($respuesta as $key => $data1){

                //BUSCAR POR ESTATUS LAS RESERVACIONES
                $acumulado = $acumulado + $data1["calificacion"];
            }

            $promedio = round($acumulado / count($respuesta),1);

            if($promedio >= 0 && $promedio < 0.5){

                $calificacion = 0;

            }else if($promedio >= 0.5 && $promedio < 1){

                $calificacion = 0.5;

            }else if($promedio >= 1 && $promedio < 1.5){

                $calificacion = 1;

            }else if($promedio >= 1.5 && $promedio < 2){

                $calificacion = 1.5;

            }else if($promedio >= 2 && $promedio < 2.5){

                $calificacion = 2;

            }else if($promedio >= 2.5 && $promedio < 3){

                $calificacion = 2.5;

            }else if($promedio >= 3 && $promedio < 3.5){

                $calificacion = 3;

            }else if($promedio >= 3.5 && $promedio < 4){

                $calificacion = 3.5;

            }else if($promedio >= 4 && $promedio < 4.5){

                $calificacion = 4;

            }else if($promedio >= 4.5 && $promedio < 5){

                $calificacion = 4.5;

            }else{

                $calificacion = 5;
            }

        }else{

            $calificacion = 0.5;
        }

        return $calificacion;

    }

    static public function ctrSendEmailRatePost($data){

        //Busco el rowid de la reservacion a traves del ID_RESERVACION

        $respuesta = ModelsAds::mdlBuscarAnuncioReservacionUser($data);

        //prepara el email para enviar al cliente

        $url = Ruta::ctrRutaEnvioEmailCalificar();

        date_default_timezone_set("America/Bogota");

        $mail = new PHPMailer;

        $mail->CharSet = 'UTF-8';

        $mail->isMail();

        $mail->setFrom('hola@prujula.com', 'PRUJULA');

        $mail->addReplyTo('hola@prujula.com', 'PRUJULA');


        $mail->Subject = "Encuesta de satisfacción de Prujula";

        $mail->addAddress($respuesta["email"]);

        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

                <center>

                    <img style="padding:20px; width:10%" src="">

                </center>

                <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

                    <center>

                    <img style="padding:20px; width:15%" src="https://prujula.com/static/media/main-logo.4bb1f751.png">

                    <h3 style="font-weight:100; color:#999">ENCUESTA DE SATISFACCION </h3>

                    <hr style="border:1px solid #ccc; width:80%">


                    

                    <div style="line-height:20px; background:#fff; width:60%; color:black">aprovechamos la oportunidad de hacerle una breve encuesta, la cual no tomará más de 2 minutos, 
                    que nos ayudará a mejorar la atención a nuestros clientes así como la calidad de nuestro servicio, para ello agradecemos pueda hacer clic en 
                    <a href="'.$url.$respuesta["rowid"].'" target="_blank" style="text-decoration:none"> Encuesta de Satisfacción </a>
                    </div>
                    
                    

                    <br>

                    <hr style="border:1px solid #ccc; width:80%">

                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

                    </center>

                </div>

            </div>');

        $mail->Send();

        echo json_encode(array(
            "statusCode" => 200,
            "error" => false,
            "mensaje" =>"Se envio el correo exitosamente "
        ));
    }

    static public function ctrShowReservation($data){


        $respuesta = ModelsAds::mdlShowAdsReservation("reservaciones","rowid",$data["conRowid"]);

        if($respuesta){

            echo json_encode(array(
                "statusCode" => 200,
                "calificado" => 1,
                "error" => false,
                "infoReserv" => $respuesta,
                "mensaje" =>" "
            ));
        }else{

            echo json_encode(array(
                "statusCode" => 400,
                "calificado" => 0,
                "error" => true,
                "mensaje" =>"No se encontraron registros "
            ));
        }

    }

    static public function ctrAllReservation(){


        $respuesta = ModelsAds::mdlAllReservation("reservaciones");

        if($respuesta){

            echo json_encode(array(
                "statusCode" => 200,
                "calificado" => 1,
                "error" => false,
                "infoReserv" => $respuesta,
                "cantTotal"  =>count($respuesta),
                "mensaje" =>" "
            ));
        }else{

            echo json_encode(array(
                "statusCode" => 400,
                "calificado" => 0,
                "error" => true,
                "mensaje" =>"No se encontraron registros "
            ));
        }

    }

    /*============================================
    ELIMINAR O INACTIVAR ANUNCIOS
    ==============================================*/
    static public function ctrDeleteAnuncio($data){

        if($data["allDelete"] == "si"){

            //elimino reservaciones, anuncios, pagos, calificaciones

            ModelsAds::mdlDeleteRecord("reservaciones","id_anuncio",$data["idAnuncio"]);

            ModelsAds::mdlDeleteRecord("pagos","id_anuncio",$data["idAnuncio"]);

            ModelsAds::mdlDeleteRecord("calificacion","id_anuncio",$data["idAnuncio"]);

            ModelsAds::mdlDeleteRecord("anuncios","id",$data["idAnuncio"]);


            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Anuncio eliminada"
            ));

        }else{
            $datos = array(
                "id" => $data["idAnuncio"],
                "estado" => $data["estado"]
            );
            ModelsAds::mdlActualizarAnuncio("anuncios",$datos);

            $respuesta = $data["estado"]== 1 ? "Activada": "Desactivada";

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Anuncio ".$respuesta
            ));
        }
    }

    static public function ctrUpdateRecordReservation($data){

        $cantDias = ModelsConfig::mdlConfig();

        $fecha_actual = date("Y-m-d");

        $fechaCaducidad = date("Y-m-d",strtotime($fecha_actual."+ ".$cantDias["dias_vencimiento"]." days"));

        $datos = array(
            "id"=>$data["id"],
            "id_anuncio"=>$data["idAnuncio"],
            "id_user"=>$data["idUser"],
            "cantidad_personas"=>$data["cantPersonas"],
            "cantidad_dias"=>$data["cantDias"],
            "fecha_desde"=>$data["fechaInicio"],
            "fecha_hasta"=>$data["fechaFin"],
            "precio"=>$data["precioXNoche"],
            "impuesto"=>$data["impuesto"],
            "descuento"=>$data["descuento"],
            "comision"=>$data["comision"],
            "total"=>$data["total"],
            "fecha_vencimiento" =>$fechaCaducidad
        );

        $resultado = ModelsAds::mdlUpdateRecordReservation("reservaciones",$datos);

        if($resultado == "ok"){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Reservacion editada con exito"
            ));

        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "adsInfo"=>"",
                "error" => true,
                "mensaje" =>"Error editando la reservcaion, contacte con el administrador",
            ));

        }
    }

    static public function ctrDeleteReservation($data){

        $resultado = ModelsAds::mdlDeletePublication("reservaciones","id",$data);

        if($resultado == "ok"){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Reservacion # ".$data["id"]." eliminada con exito"
            ));

        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "adsInfo"=>"",
                "error" => true,
                "mensaje" =>"Error eliminado reservacion, contacte con el administrador",
            ));

        }
    }
}