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

    case  "login":
        $respuesta = ControllerUsers::ctrLoginUser($obj);
        echo $respuesta;

        break;

    case  "sociallogin":
        $respuesta = ControllerUsers::ctrSocialLoginUser($obj);
        echo $respuesta;

        break;

    case "restorepassword":

        $respuesta = ControllerUsers::ctrRecoverPassword($obj);
        echo $respuesta;

        break;

    case "userregister":

        $respuesta = ControllerUsers::ctrUserRegister($obj);

        echo $respuesta;

        break;

    case "registersucess":

        $respuesta = ControllerUsers::ctrVerifyUser($obj);

       echo $respuesta;
        
        break;

    case "verifyemail":

        $respuesta = ControllerUsers::ctrVerifyUser($obj);

        echo $respuesta;

        break;

    case "datosuser":

        $respuesta = ControllerUsers::ctrGetShowUser("id",$obj["conId"]);

        echo $respuesta;

        break;

    case "updateuser":

        $respuesta = ControllerUsers::ctrUpdateUser($obj);

        echo $respuesta;

        break;


    default:
        echo json_encode(
            array(
                "error" => true,
                "statusCode"=>"400",
                "metodo" =>$method
            ));
}

