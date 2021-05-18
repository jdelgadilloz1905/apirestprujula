<?php
//header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');    // cache for 1 day
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('content-type: application/json; charset=utf-8');

// Allow from any origin
//if (isset($_SERVER['HTTP_ORIGIN'])) {
//    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
//    // you want to allow, and if so:
//    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//    header('Access-Control-Allow-Credentials: true');
//    header('Access-Control-Max-Age: 86400');    // cache for 1 day
//    header('content-type: application/json; charset=utf-8');
//
//}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    if(isset($_GET["ruta"])){

        $rutas = explode("/", $_GET["ruta"]);

        if(isset($rutas[1])){

            include "".$rutas[1]."/index.php";

        }else{
            //No existe el metodo
            echo json_encode(array(
                "statusCode" => 400,
                "message" =>"Acceso denegado.",
                "error" =>"true"
            ));

        }

    }
}




