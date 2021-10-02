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



                "mensaje" =>"subieron ",



            ));



        }else{



            echo json_encode(array(



                "statusCode" => 400,



                "cantidad"  =>0,



                "adsInfo"=>"",



                "error" => true,



                "mensaje" =>"No se encontraron registros",



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





            $data["agua"] ? array_push($amenidades, "Agua"): "";



            $data["luz"] ? array_push($amenidades, "Luz"): "";



            $data["tocador"] ? array_push($amenidades, "Tocador"): "";



            $data["cocinas"] ? array_push($amenidades, "Cocinas"): "";



            $data["bbq"] ? array_push($amenidades, "Bbq"): "";



            $data["fogata"] ? array_push($amenidades, "Sitio para fogatas"): "";



            $data["historico"] ? array_push($amenidades, "Historico"): "";



            $data["ecologia"] ? array_push($amenidades, "Reserva ecológica"): "";



            $data["agricola"] ? array_push($amenidades, "Agrícola (Hidropónicos)"): "";



            $data["reactivo_pasivo"] ? array_push($amenidades, "Recreo Pasivo"): "";



            $data["reactivo_activo"] ? array_push($amenidades, "Recreo Activo"): "";



            $data["recreacion_piscinas"] ? array_push($amenidades, "Piscinas"): "";



            $data["recreacion_acuaticas"] ? array_push($amenidades, "Acuáticas"): "";



            $data["recreacion_veredas"] ? array_push($amenidades, "Veredas, senderos"): "";



            $data["recreacion_espeleologia"] ? array_push($amenidades, "Espeleología"): "";



            $data["recreacion_kayac_paddle_balsas"] ? array_push($amenidades, "Kayac paddle balsas"): "";



            $data["recreacion_cocina"] ? array_push($amenidades, "Cocina (estufa y fregadero)"): "";



            $data["recreacion_pajaros"] ? array_push($amenidades, "Avistamiento de pájaros"): "";



            $data["recreacion_alpinismo"] ? array_push($amenidades, "Alpinismo"): "";



            $data["recreacion_zipline"] ? array_push($amenidades, "Zip-line"): "";



            $data["paracaidas"] ? array_push($amenidades, "Paracaídas"): "";



            $data["recreacion_areas"] ? array_push($amenidades, "Áreas de reunión, talleres o conferencias"): "";



            $data["recreacion_animales"] ? array_push($amenidades, "Avistamiento de especies endémicas"): "";



            $data["equipos_mesas"] ? array_push($amenidades, "Mesas"): "";



            $data["equipos_sillas"] ? array_push($amenidades, "Sillas"): "";



            $data["equipos_estufas"] ? array_push($amenidades, "Estufas"): "";



            $data["casetas_acampar"] ? array_push($amenidades, "Casetas de acampar"): "";



            $data["toldos"] ? array_push($amenidades, "Toldos"): "";



            $data["estufas_gas"] ? array_push($amenidades, "Estufas de gas"): "";



            $data["tanques_gas"] ? array_push($amenidades, "tanques de gas"): "";



            $data["lena"] ? array_push($amenidades, "Leña"): "";



            $data["carbon"] ? array_push($amenidades, "Carbón"): "";



            $data["se_admiten_mascotas"] ? array_push($amenidades, "Se admiten mascotas"): "";



            $data["perros_servicios"] ? array_push($amenidades, "Perros de servicios"): "";



            //$categoria = ModelsCategory::mdlShowCategory("categorias","id",$data["id_category"], null);



            //$categoria2 = ModelsCategory::mdlShowCategory("categorias","id",$data["id_category2"], null);



            $resultado[$key] = array(



                "objectID"=>$data["id"],



                "user"=>ControllerUsers::ctrShowUsers("id", $data["id_user"]),



                "picture_url"=>$picture_url["file"],



                "picture_url_offer"=>$picture_url_offer !=NULL ? $picture_url_offer["file"] : "",



                "picture_galery"=>$result,



                "title"=>$data["title"],



                "price"=>floatval($data["price"]),



                "price_offer"=>floatval($data["price_offer"]),



                "description"=>$data["description"],



                "half"=>$data["half"],



                "people"=>intval($data["people"]) . " Personas",



                "offer"=>intval($data["offer"]) == 1 ? "Si" : "No",



                "discount_amount"=>floatval($data["discount_amount"]),



                "categorias"=>explode(",",$data["id_category"]),



                "vistas"=>explode(",",$data["id_category2"]),



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



                "cant_vistas"=>intval($data["vistas"]),



                "reservaciones"=>intval($data["reservaciones"]),



                "fin_oferta"=>$data["fin_oferta"],



                "amenidades"=> $amenidades



            );







            //actualizo el anuncio







            ModelsAlgolia::mdlUpdateSincronizadoAlgolia("anuncios","algolia",1,$data["id"]);











        }







        return $resultado;



    }

    static public function ctrCreateAdsAlgolia($data){


        $picture_url = json_decode($data["picture_url"] , true);



        $picture_url_offer = json_decode($data["picture_url_offer"] , true);



        $picture_galery = json_decode($data["picture_galery"], true);


        foreach ($picture_galery as $key1 => $image){


            $result[$key1] = array(


                "image" =>$image["image"]


            );


        }


        $amenidades = array();


        $data["agua"] ? array_push($amenidades, "Agua"): "";



        $data["luz"] ? array_push($amenidades, "Luz"): "";



        $data["tocador"] ? array_push($amenidades, "Tocador"): "";



        $data["cocinas"] ? array_push($amenidades, "Cocinas"): "";



        $data["bbq"] ? array_push($amenidades, "Bbq"): "";



        $data["fogata"] ? array_push($amenidades, "Sitio para fogatas"): "";



        $data["historico"] ? array_push($amenidades, "Historico"): "";



        $data["ecologia"] ? array_push($amenidades, "Reserva ecológica"): "";



        $data["agricola"] ? array_push($amenidades, "Agrícola (Hidropónicos)"): "";



        $data["reactivo_pasivo"] ? array_push($amenidades, "Recreo Pasivo"): "";



        $data["reactivo_activo"] ? array_push($amenidades, "Recreo Activo"): "";



        $data["recreacion_piscinas"] ? array_push($amenidades, "Piscinas"): "";



        $data["recreacion_acuaticas"] ? array_push($amenidades, "Acuáticas"): "";



        $data["recreacion_veredas"] ? array_push($amenidades, "Veredas, senderos"): "";



        $data["recreacion_espeleologia"] ? array_push($amenidades, "Espeleología"): "";



        $data["recreacion_kayac_paddle_balsas"] ? array_push($amenidades, "Kayac paddle balsas"): "";



        $data["recreacion_cocina"] ? array_push($amenidades, "Cocina (estufa y fregadero)"): "";



        $data["recreacion_pajaros"] ? array_push($amenidades, "Avistamiento de pájaros"): "";



        $data["recreacion_alpinismo"] ? array_push($amenidades, "Alpinismo"): "";



        $data["recreacion_zipline"] ? array_push($amenidades, "Zip-line"): "";



        $data["paracaidas"] ? array_push($amenidades, "Paracaídas"): "";



        $data["recreacion_areas"] ? array_push($amenidades, "Áreas de reunión, talleres o conferencias"): "";



        $data["recreacion_animales"] ? array_push($amenidades, "Avistamiento de especies endémicas"): "";



        $data["equipos_mesas"] ? array_push($amenidades, "Mesas"): "";



        $data["equipos_sillas"] ? array_push($amenidades, "Sillas"): "";



        $data["equipos_estufas"] ? array_push($amenidades, "Estufas"): "";



        $data["casetas_acampar"] ? array_push($amenidades, "Casetas de acampar"): "";



        $data["toldos"] ? array_push($amenidades, "Toldos"): "";



        $data["estufas_gas"] ? array_push($amenidades, "Estufas de gas"): "";



        $data["tanques_gas"] ? array_push($amenidades, "tanques de gas"): "";



        $data["lena"] ? array_push($amenidades, "Leña"): "";



        $data["carbon"] ? array_push($amenidades, "Carbón"): "";



        $data["se_admiten_mascotas"] ? array_push($amenidades, "Se admiten mascotas"): "";



        $data["perros_servicios"] ? array_push($amenidades, "Perros de servicios"): "";


        //$categoria = ModelsCategory::mdlShowCategory("categorias","id",$data["id_category"]);



        //$categoria2 = ModelsCategory::mdlShowCategory("categorias","id",$data["id_category2"]);


        $resultado[0]  = array(



            "objectID"=>$data["id"],



            "user"=>ControllerUsers::ctrShowUsers("id", $data["id_user"]),



            "picture_url"=>$picture_url["file"],



            "picture_url_offer"=>$picture_url_offer !=NULL ? $picture_url_offer["file"] : "",



            "picture_galery"=>$result,



            "title"=>$data["title"],



            "price"=>floatval($data["price"]),



            "price_offer"=>floatval($data["price_offer"]),



            "description"=>$data["description"],



            "half"=>$data["half"],



            "people"=>intval($data["people"]) . " Personas",



            "offer"=>intval($data["offer"]) == 1 ? "Si" : "No",



            "discount_amount"=>floatval($data["discount_amount"]),



            "categorias"=>explode(",",$data["id_category"]),



            "vistas"=>explode(",",$data["id_category2"]),



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



            "cant_vistas"=>intval($data["vistas"]),



            "reservaciones"=>intval($data["reservaciones"]),



            "fin_oferta"=>$data["fin_oferta"],



            "amenidades"=> $amenidades



        );



        $client = Ruta::apiAlgolia();



        $index = $client->initIndex('publications');



        $index->saveObjects($resultado, ['autoGenerateObjectIDIfNotExist' => true]);



        //actualizo el anuncio


        ModelsAlgolia::mdlUpdateSincronizadoAlgolia("anuncios","algolia",1,$data["id"]);


        return $index;

    }

    static public function ctrUpdateCalificacionAlgolia($data){

//        $resultado[0]  = array(
//
//            "objectID"=>$data["idAnuncio"],
//            "calificacion"=>$data["calificacion"]
//        );

        $client = Ruta::apiAlgolia();

        $index = $client->initIndex('publications');

        $index->saveObjects($data, ['autoGenerateObjectIDIfNotExist' => true]);
    }

    static  public function ctrDeletePublications($data){


        $client = Ruta::apiAlgolia();



        $index = $client->initIndex('publications');



        $index->deleteObject($data["id"]);


//        echo json_encode(array(
//
//
//
//            "statusCode" => 200,
//
//
//
//            "resultado" =>$index,
//
//
//
//            "error" => false,
//
//
//        ));



    }

    static public function ctrInsertarLicencia($data){

        if(isset($data["rif"])){

            $key = "";
            $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

            $max = strlen($pattern)-1;

            for($i = 0; $i < 24; $i++){

                $key .= $pattern[mt_rand(0,$max)];

            }

            $fecha_actual = date("d-m-Y");
            //sumo 1 año
            $fecha_fin= date("d-m-Y",strtotime($fecha_actual."+ 1 year"));

            $datos = array(
                "email" => $data["email"],
                "nombre" => $data["nombre"],
                "direccion" => $data["direccion"],
                "rif" => $data["rif"],
                "telefono" => $data["telefono"],
                "fecha_ini" => date("Y-m-d"),
                "fecha_fin" => $fecha_fin,
                "serial" => $key,
                "estatus" => $data["estatus"]
            );

            $respuesta = ModelsAlgolia::mdlInsertarLicencia($datos);

            if($respuesta == 'ok'){

                echo json_encode(array(
                    "statusCode" => 200,
                    "info"=> array(
                        "Fecha inicio" => date("Y-m-d"),
                        "Fecha vencimiento" => $fecha_fin,
                        "serial" => $key
                    ),
                    "error" => false,
                ));


            }else{
                echo json_encode(array(
                    "statusCode" => 400,
                    "info"=> "",
                    "error" => true,
                ));

            }



        }


    }

    static public function ctrVerificarLicencia($data){

        $respuesta = ModelsAlgolia::mdlVerificarLicencia($data["keySerial"]);

        if($respuesta == 'ok'){

            echo json_encode(array(
                "statusCode" => 200,
                "info"=> $respuesta,
                "error" => false,
            ));


        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "info"=> "No existe licencia, contacte con el administrador",
                "error" => true,
            ));

        }
    }


}