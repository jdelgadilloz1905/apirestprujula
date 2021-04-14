<?php
class ControllerBanner{

    static public function ctrShowBanner(){

        $tabla = "banner";

        $respuesta = ModelsBanner::mdlShowBanner($tabla);

        echo json_encode(array(
            "statusCode" => 200,
            "bannerInfo"=>$respuesta,
            "error" => false,
            "mensaje" =>"",
        ));
    }
}