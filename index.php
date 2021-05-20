<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');

/*=============================
    CONTROLLER
===============================*/
require_once "controller/template.controller.php";
require_once "controller/users.controller.php";
require_once "controller/ads.controller.php";
require_once "controller/category.controller.php";
require_once "controller/banner.controller.php";
require_once "controller/class.fileuploader.php";

require_once "controller/config.controller.php";
require_once "controller/algolia.controller.php";



/*=============================
    MODELS
===============================*/
require_once "models/users.model.php";
require_once "models/ads.model.php";
require_once "models/category.model.php";
require_once "models/banner.model.php";
require_once "models/algolia.model.php";

require_once "models/config.php";
require_once "models/rutas.php";

/*=============================
    EXTENSIONS
===============================*/

require_once "extensions/PHPMailer/PHPMailerAutoload.php";
require_once "extensions/vendor/autoload.php";

require __DIR__ . '/vendor/autoload.php';

$plantilla = new ControllerTemplate();
$plantilla-> ctrTemplate();
