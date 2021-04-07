<?php

/*=============================
    CONTROLLER
===============================*/
require_once "controller/template.controller.php";
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
require_once "extensions/vendor/autoload.php";

$plantilla = new ControllerTemplate();
$plantilla-> ctrTemplate();
