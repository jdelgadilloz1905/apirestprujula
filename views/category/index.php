<?php
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
//busco las consultas segun el metodo de l URL

$answer = ModelsConfig::mdlConfig();

$rutas = explode("/", $_GET["ruta"]);
$method = str_replace("-","",$rutas[2]);

switch ($method){

    case  "all":
        $item = null;
        $valor = null;

        $respuesta = ControllerCategory::ctrShowCategory($item, $valor);
        echo $respuesta;

        break;

    default:
        echo json_encode(
            array(
                "error11" => true,
                "statusCode"=>"400",
                "metodo" =>$method
            ));
}