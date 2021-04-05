<?php

/*=============================
    CONTROLLER
===============================*/
require_once "controller/users.controller.php";
require_once "controller/ads.controller.php";
require_once "controller/category.controller.php";


/*=============================
    MODELS
===============================*/
require_once "models/users.model.php";
require_once "models/ads.models.php";
require_once "models/category.model.php";
require_once "models/config.php";
require_once "models/rutas.php";

/*=============================
    EXTENSIONS
===============================*/

require_once "extensions/PHPMailer/PHPMailerAutoload.php";

require __DIR__ . '/vendor/autoload.php';

$client = \Algolia\AlgoliaSearch\SearchClient::create('RK5WGMMT2Y', '5faaffff77e964237ab79653cb5057ba');

//$index = $client->initIndex('T02_push');
//
//$records = [
//    ['objectID'=>'001','name' => 'Tom Cruise Luis','categoria'=>'cine para la calle ','genero'=>'hombre'],
//    ['objectID'=>'002','name' => 'Scarlett Johansson','categoria'=>'deporte','genero'=>'indefinido']
//];
//$index->saveObjects($records, ['autoGenerateObjectIDIfNotExist' => true]);

//$index = $client->initIndex('contacts');
//$batch = json_decode(file_get_contents('contact.json'), true);
//$index->saveObjects($batch, ['autoGenerateObjectIDIfNotExist' => true]);


$plantilla = new ControllerTemplate();
$plantilla-> ctrTemplate();
