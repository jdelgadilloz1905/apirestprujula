<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

//selecciono la carpeta donde se va consultar la API
if(isset($_GET["ruta"])){

    $rutas = explode("/", $_GET["ruta"]);

    if($rutas[2] == "users" ){
        //se llama la carpeta y funcion
        include "".$rutas[1]."/".$rutas[2]."/index.php";
    }else{
        //No existe el metodo
        echo json_encode(array(
            "statusCode" => "400",
            "message" =>"Acceso denegado."
        ));
    }
}


