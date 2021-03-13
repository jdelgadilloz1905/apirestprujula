<?php
//selecciono la carpeta donde se va consultar la API
if(isset($_GET["ruta"])){

    $rutas = explode("/", $_GET["ruta"]);

    if($rutas[0] == "users" ){

        include "".$rutas[0]."/index.php";
    }else{
        //No existe el metodo
        echo json_encode(array(
            "statusCode" => "400",
            "message" =>"Acceso denegado."
        ));
    }
}


