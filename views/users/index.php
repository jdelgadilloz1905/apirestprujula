<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

//busco las consultas segun el metodo de l URL

$answer = ModelsConfig::mdlConfig();
//echo $answer["API_KEY"];

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$rutas = explode("/", $_GET["ruta"]);
$method = str_replace("-","",$rutas[1]);

if( $method == "login"){

    $respuesta = ControllerUsers::ctrLoginUser($obj);
//$db = new DbHandler();

    /* Array de autos para ejemplo response
     * Puesdes usar el resultado de un query a la base de datos mediante un metodo en DBHandler
     **/
//    $autos = array(
//        array('make'=>'Toyota', 'model'=>'Corolla', 'year'=>'2006', 'MSRP'=>'18,000'),
//        array('make'=>'Nissan', 'model'=>'Sentra', 'year'=>'2010', 'MSRP'=>'22,000')
//    );
//
//    $response["error"] = false;
//    $response["message"] = "Autos cargados: " . count($autos); //podemos usar count() para conocer el total de valores de un array
//    $response["REQUEST_METHOD"] = $_SERVER['REQUEST_METHOD'];
//    $response["autos"] = $autos;
//    $response["headers"] = apache_request_headers();

    echo json_encode($respuesta);
}
