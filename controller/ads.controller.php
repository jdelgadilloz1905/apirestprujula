<?php
class ControllerAds{

    static public function ctrCreateAd($data){

        if(isset($data["regTitulo"])){
            //insertar los registros y posteriormente insertar las imagenes
            $datos = array(
                "id_user"=>$data["regIdUser"],
                "titulo"=>$data["regTitulo"],
                "descripcion"=>$data["regDescripcion"],
                "id_categoria"=>$data["regIdCategoria"],
                "image_portada"=>$data["regImagePortada"],
                "image_portada_oferta"=>$data["regImagePortadaOferta"],
                "latitud"=>$data["regLatitud"],
                "longitud"=>$data["regLongitud"],
                "habitaciones"=>$data["regHabitaciones"],
                "precio"=>$data["regPrecio"],
                "precio_oferta"=>$data["regPrecioOferta"],
                "descuento"=>$data["regDescuento"],
                "fechas_desactivada"=>$data["regFechaDesactivada"],
            );

            $resultado = ModelsAds::mdlCreateAd("anuncios",$datos);

            //Busco el ultimo ID para las imagenes
            if($resultado == "ok"){
                $idInsertado = ModelsAds::mdlGetLastId("anuncios");

                echo json_encode(array(
                    "statusCode" => 200,
                    "adsInfo"=>$idInsertado["id"],
                    "error" => false,
                    "mensaje" =>"Genial orden # ".$idInsertado["id"]." creada con exito",
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

    static public function ctrShowAllAds(){

        $respuesta = ModelsAds::mdlShowAllAds("anuncios");


        foreach ($respuesta as $key => $value){

            $resultado[$key] = array(
                "id"=> $value["id"],
                "titulo" => $value["titulo"],
                "descripcion" => $value["descripcion"],
                "id_categoria" => $value["id_categoria"],
                "image_url" =>json_decode($value["image_url"], true),
                "image_url_oferta" =>json_decode($value["image_url_oferta"], true),
                "calificacion" => $value["calificacion"],
                "latitud" => $value["latitud"],
                "longitud" => $value["longitud"],
                "habitaciones" => $value["habitaciones"],
                "precio" => $value["precio"],
                "oferta" => $value["oferta"],
                "descuento" => $value["descuento"],
                "estado" => $value["estado"],
                "fecha_creacion" => $value["fecha_creacion"],
                "vistas" => $value["vistas"],
                "reservaciones" => $value["reservaciones"],
                "image_portada" => $value["image_portada"],
                "image_portada_oferta" => $value["image_portada_oferta"],
                "fin_oferta" => $value["fin_oferta"],
                "fechas_desactivada" => $value["fechas_desactivada"]

            );
        }


        echo json_encode(array(
            "statusCode" => 200,
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

        foreach ($valores as $key => $value){

            $resultado[$key] = array(
                "id"=> $value["id"],
                "titulo" => $value["titulo"],
                "descripcion" => $value["descripcion"],
                "id_categoria" => $value["id_categoria"],
                "image_url" =>json_decode($value["image_url"], true),
                "image_url_oferta" =>json_decode($value["image_url_oferta"], true),
                "calificacion" => $value["calificacion"],
                "latitud" => $value["latitud"],
                "longitud" => $value["longitud"],
                "habitaciones" => $value["habitaciones"],
                "precio" => $value["precio"],
                "precio_oferta" => $value["precio_oferta"],
                "descuento" => $value["descuento"],
                "estado" => $value["estado"],
                "fecha_creacion" => $value["fecha_creacion"],
                "vistas" => $value["vistas"],
                "reservaciones" => $value["reservaciones"],
                "image_portada" => $value["image_portada"],
                "image_portada_oferta" => $value["image_portada_oferta"],
                "fin_oferta" => $value["fin_oferta"],
                "oferta" => $value["oferta"],
                "fechas_desactivada" => $value["fechas_desactivada"],
                "categoria"=>ControllerCategory::ctrShowCategory("id",$value["id_categoria"])
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

        $respuesta = ModelsAds::mdlShowSearchAds("anuncios",$valor);

        $result = self::ctrPrepararMatrizJson($respuesta);

        echo json_encode(array(
            "statusCode" => 200,
            "adsInfo"=>$result,
            "error" => false,
            "mensaje" =>""
        ));
    }
}