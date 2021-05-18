<?php
class ControllerAds{

    static public function ctrCreateAd($data){

        if(isset($data["regTitulo"])){
            //insertar los registros y posteriormente insertar las imagenes
            $datos = array(
                "titulo"=>$data["regTitulo"],
                "precio"=>$data["regPrecio"],
                "descripcion"=>$data["regDescripcion"],
                "media"=>$data["regMedia"],
                "personas"=>$data["regPersonas"],
                "oferta"=>$data["regOferta"],
                "monto_descuento"=>$data["regMontoDescuento"],
                "id_categoria"=>$data["regIdCategoria"],
                "direccion"=>$data["regAddress"]["completeAddress"],
                "ciudad"=>$data["regAddress"]["country"],
                "lat"=>$data["regAddress"]["lat"],
                "lng"=>$data["regAddress"]["lng"],
                "direccion_referencia"=>$data["regAddressDescription"],
                "telefono"=>$data["regPhone"],
                "imagen_principal"=>json_encode($data["regMainImage"]),
                "imagen_oferta"=>json_encode($data["regDealImage"]),
                "imagen_galeria"=>json_encode($data["regImageGallery"]),
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
                "equipos_estufas"=>$data["equipos_estufas"]
            );

            $resultado = ModelsAds::mdlCreateAd("anuncios",$datos);

            //Busco el ultimo ID para las imagenes
            if($resultado == "ok"){
                $idInsertado = ModelsAds::mdlGetLastId("anuncios");

                echo json_encode(array(
                    "statusCode" => 200,
                    "adsInfo"=>$idInsertado["id"],
                    "error" => false,
                    "mensaje" =>"Genial orden # ".$idInsertado["id"]." creada con exito"
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
                "titulo"=>$data["titulo"],
                "precio"=>$data["precio"],
                "descripcion"=>$data["descripcion"],
                "media"=>$data["media"],
                "personas"=>$data["personas"],
                "oferta"=>$data["oferta"],
                "monto_descuento"=>$data["monto_descuento"],
                "id_categoria"=>$data["id_categoria"],
                "nombre_categoria"=>$data["nombre_categoria"],
                "direccion"=>$data["direccion"],
                "ciudad"=>$data["ciudad"],
                "lat"=>$data["lat"],
                "lng"=>$data["lng"],
                "direccion_referencia"=>$data["direccion_referencia"],
                "telefono"=>$data["telefono"],
                "imagen_principal"=>json_decode($data["imagen_principal"] , true),
                "imagen_oferta"=>json_decode($data["imagen_oferta"] , true),
                "imagen_galeria"=>json_decode($data["imagen_galeria"], true),
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
                "titulo"=>$data["titulo"],
                "precio"=>$data["precio"],
                "descripcion"=>$data["descripcion"],
                "media"=>$data["media"],
                "personas"=>$data["personas"],
                "oferta"=>$data["oferta"],
                "monto_descuento"=>$data["monto_descuento"],
                "id_categoria"=>$data["id_categoria"],
                "nombre_categoria"=>$data["nombre_categoria"],
                "direccion"=>$data["direccion"],
                "ciudad"=>$data["ciudad"],
                "lat"=>$data["lat"],
                "lng"=>$data["lng"],
                "direccion_referencia"=>$data["direccion_referencia"],
                "telefono"=>$data["telefono"],
                "imagen_principal"=>json_decode($data["imagen_principal"] , true),
                "imagen_oferta"=>json_decode($data["imagen_oferta"] , true),
                "imagen_galeria"=>json_decode($data["imagen_galeria"], true),
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
                    "equipos_estufas"=>$data["equipos_estufas"]
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
}