<?php

/*=============================
    CONTROLLER
===============================*/
require_once "controller/users.controller.php";
require_once "controller/template.controller.php";


/*=============================
    MODELS
===============================*/
require_once "models/users.model.php";
require_once "models/config.php";
require_once "models/rutas.php";

/*=============================
    EXTENSIONS
===============================*/

require_once "extensions/PHPMailer/PHPMailerAutoload.php";

$plantilla = new ControllerTemplate();
$plantilla-> ctrTemplate();
