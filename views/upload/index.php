<?php
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
//busco las consultas segun el metodo de l URL

//$answer = ModelsConfig::mdlConfig();
//echo $answer["API_KEY"];

$rutas = explode("/", $_GET["ruta"]);
$method = str_replace("-","",$rutas[2]);
//$_SERVER['REQUEST_METHOD'] == 'POST' validar el metodo de envio dependiendo del tipo de consulta

switch ($method){

    case "uploadimage":

        $respuesta = ControllerConfig::ctrUploadImage();
        //move_uploaded_file($_FILES['imagen']['tmp_name'],  "views/img/anuncios/" . $_FILES['imagen']['name']);
        echo $respuesta;
        break;


    default:
        echo json_encode(
            array(
                "error" => true,
                "statusCode"=>400,
                "metodo" =>$method
            ));
}
