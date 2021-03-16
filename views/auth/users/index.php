<?php
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
//busco las consultas segun el metodo de l URL

$answer = ModelsConfig::mdlConfig();
//echo $answer["API_KEY"];

$rutas = explode("/", $_GET["ruta"]);
$method = str_replace("-","",$rutas[3]);


switch ($method){

    case  "login":
        $respuesta = ControllerUsers::ctrLoginUser($obj);
        echo $respuesta;

        break;

    case "restorepassword":

        $respuesta = ControllerUsers::ctrRecoverPassword($obj);
        echo $respuesta;

        break;

    default:
        echo json_encode(
            array(
                "error" => true,
                "statusCode"=>"400"
            ));
}

