<?php
header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
//header('Content-Type: text/html; charset=utf-8');
//header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
//header("Content-Type: application/json");
//selecciono la carpeta donde se va consultar la API
//EVALUAR SI TIENE API_KEY_ID PARA LLAMAR INTERFACE ESO ES PARA CUANDO ESTE LOGUEADO
if(isset($_GET["ruta"])){

    $rutas = explode("/", $_GET["ruta"]);

    if(isset($rutas[1])){

        include "".$rutas[1]."/index.php";

    }else{
        //No existe el metodo
        echo json_encode(array(
            "statusCode" => "400",
            "message" =>"Acceso denegado.",
            "error" =>"true"
        ));

    }


//    if($rutas[2] == "users" ){
//        //estructura CARPETA / FUNCION O METODO / PARAMETRO O ID
//        include "".$rutas[1]."/".$rutas[2]."/index.php";
//    }else{
//        //No existe el metodo
//        echo json_encode(array(
//            "statusCode" => "400",
//            "message" =>"Acceso denegado."
//        ));
//    }
}


