<?php
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
//busco las consultas segun el metodo de l URL

$answer = ModelsConfig::mdlConfig();
//echo $answer["API_KEY"];

$rutas = explode("/", $_GET["ruta"]);
$method = str_replace("-","",$rutas[2]);
//$_SERVER['REQUEST_METHOD'] == 'POST' validar el metodo de envio dependiendo del tipo de consulta

switch ($method){

    case  "createad":
        $respuesta = ControllerAds::ctrCreateAd($obj);
        echo $respuesta;

        break;

    case  "all":
        $respuesta = ControllerAds::ctrshowAllAds($obj);
        echo $respuesta;

        break;

    case "changestatus": //cambiar el estado del anuncio de activo o inactivo

        $respuesta = "";
        echo $respuesta;

        break;

    case "updatead":

        $respuesta = ControllerAds::ctrUpdateAd($obj);

        echo $respuesta;

        break;

    case "deletead": //el anuncio se eliminara si no tiene algun movimiento historico

        $respuesta = ControllerAds::ctrDeleteAnuncio($obj);

        echo $respuesta;

        break;

    case "Increasequantity":

        $respuesta = ControllerAds::ctrIncreaseQuantity($obj);

        echo $respuesta;

        break;

    case "allShowFeaturedAds":

        $respuesta = ControllerAds::ctrShowFeaturedAds();

        echo $respuesta;

        break;

    case "detailid":

        $respuesta = ControllerAds::ctrShowAdsId($obj);

        echo $respuesta;

        break;

    case "allShowSearchAds":

        $respuesta = ControllerAds::ctrShowSearchAds($obj);

        echo $respuesta;

        break;

    case "userpublications":

        $respuesta = ControllerAds::ctrUserPublications($obj);

        echo $respuesta;

        break;

    case "userreservations":

        $respuesta = ControllerAds::ctrUserReservations($obj);

        echo $respuesta;

        break;

    case "bookpublications":

        $respuesta = ControllerAds::ctrBookPublications($obj);

        echo $respuesta;

        break;

    case "offerpublication":

        $respuesta = ControllerAds::ctrOfferxPublication($obj);

        echo $respuesta;

        break;

    case "updatepublication":

        $respuesta = ControllerAds::ctrUpdateReservation($obj);

        echo $respuesta;

        break;

    case "confirmreservation":

        $respuesta = ControllerAds::ctrConfirmReservation($obj);

        echo $respuesta;

        break;

    case "calificationuser":

        $respuesta = ControllerAds::ctrCalificationUser($obj);

        echo $respuesta;

        break;

    case "showcalification":

        $respuesta = ControllerAds::ctrShowCalification($obj);

        echo $respuesta;

        break;

    case "ratepost":

        $respuesta = ControllerAds::ctrSendEmailRatePost($obj);

        echo $respuesta;

        break;

    case "showreservation":

        $respuesta = ControllerAds::ctrShowReservation($obj);

        echo $respuesta;

        break;

    case "allreservation":

        $respuesta = ControllerAds::ctrAllReservation();

        echo $respuesta;

        break;

    case "editreservation":

        $respuesta = ControllerAds::ctrShowReservation($obj);

        echo $respuesta;

        break;

    case "deletereservation":

        $respuesta = ControllerAds::ctrDeleteReservation($obj);

        echo $respuesta;

        break;

    default:
        echo json_encode(
            array(
                "error" => true,
                "statusCode"=>400,
                "metodo" =>$method,
                "variables" =>$obj,
                "tipo" => gettype($obj)
            ));
}
