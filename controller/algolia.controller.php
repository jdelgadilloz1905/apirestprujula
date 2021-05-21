<?php
class ControllerAlgolia{

    static public function ctrGetAllPublications(){

        $respuesta = ModelsAlgolia::mdlGetAllPublications();
        if($respuesta){
            $resultado = self::ctrPrepararMatrizJson($respuesta);


            $client = Ruta::apiAlgolia();
            $index = $client->initIndex('publications');
            $index->saveObjects($resultado, ['autoGenerateObjectIDIfNotExist' => true]);

            //CREAR UNA FUNCION QUE MARQUE LOS ANUNCIOS QUE FUERON EVNIADOS AL ALGOLIA Y DENTRO DE LA CONSULTA SELECT VALIDAR CONTRA ESE CAMPO DE SINCRONIZADO
            //OPTIMIZAR TIEMPO Y REGISTROS DE CONSULTA

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
                "cantidad"  =>0,
                "adsInfo"=>"",
                "error" => true,
                "mensaje" =>"No s encontraron registros",
            ));
        }



    }

    static public function ctrPrepararMatrizJson($valores){

        foreach ($valores as $key => $data){

            $picture_url = json_decode($data["picture_url"] , true);
            $picture_url_offer = json_decode($data["picture_url_offer"] , true);
            $picture_galery = json_decode($data["picture_galery"], true);

            foreach ($picture_galery as $key1 => $image){

                $result[$key1] = array(
                    "image" =>$image["image"]
                );
            }
            $amenidades = array();

            $data["camping_mochila"] ? array_push($amenidades, "Camping Mochila"): "";
            $data["camping_baul"] ? array_push($amenidades, "Camping Baul"): "";
            $data["agua"] ? array_push($amenidades, "Agua"): "";
            $data["luz"] ? array_push($amenidades, "Luz"): "";
            $data["tocador"] ? array_push($amenidades, "Tocador"): "";
            $data["cocinas"] ? array_push($amenidades, "Cocinas"): "";
            $data["bbq"] ? array_push($amenidades, "Bbq"): "";
            $data["fogata"] ? array_push($amenidades, "Fogata"): "";
            $data["historico"] ? array_push($amenidades, "Historico"): "";
            $data["ecologia"] ? array_push($amenidades, "Ecologia"): "";
            $data["agricola"] ? array_push($amenidades, "Agricola"): "";
            $data["reactivo_pasivo"] ? array_push($amenidades, "Reactivo Pasivo"): "";
            $data["reactivo_activo"] ? array_push($amenidades, "Reactivo Activo"): "";
            $data["recreacion_piscinas"] ? array_push($amenidades, "Recreacion de piscinas"): "";
            $data["recreacion_acuaticas"] ? array_push($amenidades, "Recreacion Acuaticas"): "";
            $data["recreacion_veredas"] ? array_push($amenidades, "Recreacion de veredas"): "";
            $data["recreacion_espeleologia"] ? array_push($amenidades, "Recreacion de espeleologia"): "";
            $data["recreacion_kayac_paddle_balsas"] ? array_push($amenidades, "Recreacion kayac paddle balsas"): "";
            $data["recreacion_cocina"] ? array_push($amenidades, "Recreacion de cocina"): "";
            $data["recreacion_pajaros"] ? array_push($amenidades, "Recreacion de pajaros"): "";
            $data["recreacion_alpinismo"] ? array_push($amenidades, "Recreacion de alpinismo"): "";
            $data["recreacion_zipline"] ? array_push($amenidades, "Recreacion de zipline"): "";
            $data["paracaidas"] ? array_push($amenidades, "Paracaidas"): "";
            $data["recreacion_areas"] ? array_push($amenidades, "Recreacion de areas"): "";
            $data["recreacion_animales"] ? array_push($amenidades, "Recreacion de animales"): "";
            $data["equipos_mesas"] ? array_push($amenidades, "Equipos de mesas"): "";
            $data["equipos_sillas"] ? array_push($amenidades, "Equipos de sillas"): "";
            $data["equipos_estufas"] ? array_push($amenidades, "Equipos de estufas"): "";

            $categoria = ModelsCategory::mdlShowCategory("categorias","id",$data["id_category"]);

            $resultado[$key] = array(
                "objectID"=>$data["id"],
                "user"=>ControllerUsers::ctrShowUsers("id", $data["id_user"]),
                "picture_url"=>$picture_url["file"],
                "picture_url_offer"=>$picture_url_offer !=NULL ? $picture_url_offer["file"] : "",
                "picture_galery"=>$result,
                "title"=>$data["title"],
                "price"=>floatval($data["price"]),
                "description"=>$data["description"],
                "half"=>$data["half"],
                "people"=>intval($data["people"]) . " Personas",
                "offer"=>intval($data["offer"]) == 1 ? "Si" : "No",
                "discount_amount"=>floatval($data["discount_amount"]),
                "category"=>$categoria["nombre"],
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
                "lat"=>floatval($data["lat"]),
                "lng"=>floatval($data["lng"]),
                "_geoloc" => array(
                    "lat"=>floatval($data["lat"]),
                    "lng"=>floatval($data["lng"]),
                ),
                "phone"=>$data["phone"],
                "calificacion"=>floatval($data["calificacion"]),
                "estado"=>intval($data["estado"]),
                "fecha_creacion"=>$data["fecha_creacion"],
                "vistas"=>intval($data["vistas"]),
                "reservaciones"=>intval($data["reservaciones"]),
                "fin_oferta"=>$data["fin_oferta"],
                "amenidades"=> $amenidades
            );

            //actualizo el anuncio

            $returnResponse = ModelsAlgolia::mdlUpdateSincronizadoAlgolia("anuncios","algolia",1,$data["id"]);


        }

        return $resultado;
    }


}