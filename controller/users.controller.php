<?php
class ControllerUsers{
    /*=============================================
    INGRESAR USUARIO
    =============================================*/
    static public function ctrLoginUser($data){

        if(isset($data["ingEmail"])){
            if($data["ingModo"] == "directo"){
                if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $data["ingEmail"]) &&
                    preg_match('/^[a-zA-Z0-9.,]+$/', $data["ingPassword"])){

                    $encrypt = crypt($data["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $table = "users";

                    $item = "email";

                    $value = $data["ingEmail"];

                    $answer = ModelUsers::mdlShowUsers($table,$item,$value);

                    if($answer["email"] == $value && $answer["password"] == $encrypt){

                        if($answer["estado"] == 1){

                            $resultado = array(
                                "isLogged" => true,
                                "id" =>$answer["id"],
                                "nombre" =>$answer["nombre"],
                                "modo" =>"directo",
                                "email" =>$answer["email"],
                                "foto" =>$answer["foto"]
                            );

                            /*=============================================
                            REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
                            =============================================*/

                            self::ctrUpdateLastLogin($table,$answer["id"]);

                            echo json_encode(array(
                                "statusCode" => "200",
                                "error" => false,
                                "data" =>$resultado,
                                "mensaje" =>""
                            ));

                        }else{

                            echo json_encode(array(
                                "statusCode" => "400",
                                "error" => true,
                                "isLogged" => false,
                                "mensaje" =>"El email aún no está activado"
                            ));

                        }

                    }else{

                        echo json_encode(array(
                            "statusCode" => "400",
                            "error" => true,
                            "mensaje" =>"Error al ingresar, vuelve a intentarlo"
                        ));

                    }

                }
            }else{
                if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $data["ingEmail"])){

                    $table = "users";

                    $item = "email";

                    $value = $data["ingEmail"];

                    $answer = ModelUsers::mdlShowUsers($table,$item,$value);

                    if($answer["email"] == $value){

                        $resultado = array(
                            "isLogged" => true,
                            "id" =>$answer["id"],
                            "nombre" =>$answer["nombre"],
                            "modo" =>"directo",
                            "email" =>$answer["email"],
                            "foto" =>$answer["foto"],
                            "perfil" =>$answer["perfil"],
                            "error" => false,
                            "statusCode" => "200",
                        );

                        echo json_encode(array(
                            "statusCode" => "200",
                            "error" => false,
                            "data" =>$resultado
                        ));

                    }


                }
            }

        }
    }

    /*=============================================
    RECUPERAR LA CLAVE
    =============================================*/

    static public function ctrRecoverPassword($data){

        if(isset($data["passEmail"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $data["passEmail"])){

                /*=============================================
                GENERAR CONTRASEÑA ALEATORIA
                =============================================*/

                function generarPassword($longitud){

                    $key = "";
                    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

                    $max = strlen($pattern)-1;

                    for($i = 0; $i < $longitud; $i++){

                        $key .= $pattern{mt_rand(0,$max)};

                    }

                    return $key;

                }

                $nuevaPassword = generarPassword(11);

                $encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "users";

                $item1 = "email";
                $valor1 = $data["passEmail"];

                $respuesta1 = ModelUsers::mdlShowUsers($tabla,$item1,$valor1);

                if($respuesta1){

                    $id = $respuesta1["id"];
                    $item2 = "password";
                    $valor2 = $encriptar;

                    $respuesta2 = ModelUsers::mdlUpdateUser($tabla, $id, $item2, $valor2);

                    if($respuesta2  == "ok"){

                        /*=============================================
                        CAMBIO DE CONTRASEÑA
                        =============================================*/

                        date_default_timezone_set("America/Bogota");

                        $url = Ruta::ctrRutaEnvioEmail();

                        $mail = new PHPMailer;

                        $mail->CharSet = 'UTF-8';

                        $mail->isMail();

                        $mail->setFrom('hola@prujula.com', 'PRUJULA');

                        $mail->addReplyTo('hola@prujula.com', 'PRUJULA');

                        $mail->Subject = "¿Olvidaste tu contraseña?";

                        $mail->addAddress($data["passEmail"]);

                        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

								<center>

									<img style="padding:20px; width:10%" src="">

								</center>

								<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

									<center>

									<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">

									<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

									<hr style="border:1px solid #ccc; width:80%">

									<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>

									<a href="'.$url.'" target="_blank" style="text-decoration:none">

									<div style="line-height:60px; background:#450E10; width:60%; color:white">Ingrese nuevamente al sitio</div>

									</a>

									<br>

									<hr style="border:1px solid #ccc; width:80%">

									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

									</center>

								</div>

							</div>');

                        $envio = $mail->Send();

                        if(!$envio){

                            echo json_encode(array(
                                "statusCode" => "400",
                                "error" => true,
                                "mensaje" =>"¡Ha ocurrido un problema enviando cambio de contraseña a ".$data["passEmail"].$mail->ErrorInfo."!",
                            ));

                        }else{

                            echo json_encode(array(
                                "statusCode" => "200",
                                "error" => false,
                                "mensaje" =>"",
                            ));

                        }

                    }

                }else{

                    echo json_encode(array(
                        "statusCode" => "400",
                        "error" => true,
                        "mensaje" =>"¡El correo electrónico no existe en el sistema!",
                    ));
                }

            }else{

                echo json_encode(array(
                    "statusCode" => "400",
                    "error" => true,
                    "mensaje" =>"¡Error al enviar el correo electrónico, está mal escrito!",
                ));


            }

        }


    }

    /*=============================================
    REGISTRO DE CUENTA DIRECTA
    =============================================*/

    static public function ctrUserRegister($data){

        if(isset($data["regModo"]) == "directo"){

            if (isset($data["regEmail"])) {

                if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $data["regUser"]) &&
                    preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $data["regEmail"]) &&
                    preg_match('/^[a-zA-Z0-9.,*]+$/', $data["regPassword"])
                ) {

                    $encriptar = crypt($data["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $encriptarEmail = md5($data["regEmail"]);

                    $datos = array(
                        "nombre" => $data["regName"],
                        "apellido" => $data["regLast"],
                        "password" => $encriptar,
                        "email" => $data["regEmail"],
                        "foto" => "",
                        "modo" => "directo",
                        "verificacion" => 0,
                        "emailEncriptado" => $encriptarEmail);

                    //ANTES REALIZO UNA VALIDACION SI EL USUARIO EXISTE NUEVAMENTE PARA EVITAR DUPLICIDAD
                    $result = self::ctrShowUsers("email",trim($data["regEmail"])) ;

                    if(isset($result["email"])){

                        echo json_encode(array(
                            "statusCode" => "400",
                            "error" => true,
                            "mensaje" =>"¡El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente!",
                        ));

                    }else{

                        $tabla = "users";

                        $respuesta = ModelUsers::mdlUserRegister($tabla, $datos);

                        if ($respuesta == "ok") {

                            /*=============================================
                            VERIFICACIÓN CORREO ELECTRÓNICO
                            =============================================*/

                            date_default_timezone_set("America/Bogota");

                            $url = Ruta::ctrRuta();

                            $mail = new PHPMailer;

                            $mail->CharSet = 'UTF-8';

                            $mail->isMail();

                            $mail->setFrom('hola@prujula.com', 'PRUJULA');

                            $mail->addReplyTo('hola@prujula.com', 'PRUJULA');

                            $mail->Subject = "Por favor verifique su dirección de correo electrónico";

                            $mail->addAddress($data["regEmail"]);

                            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

						<center>

							<img style="padding:20px; width:10%" src="">

						</center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

							<center>

							<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">

							<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

							<hr style="border:1px solid #ccc; width:80%">

							<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Prujula, debe confirmar su dirección de correo electrónico</h4>

							<a href="' . $url . 'check/' . $encriptarEmail . '" target="_blank" style="text-decoration:none">

							<div style="line-height:60px; background:#450E10; width:60%; color:white">Verifique su dirección de correo electrónico</div>

							</a>

							<br>

							<hr style="border:1px solid #ccc; width:80%">

							<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

							</center>

						</div>

					</div>');

                            $envio = $mail->Send();

                            if (!$envio) {

                                echo json_encode(array(
                                    "statusCode" => "400",
                                    "error" => false,
                                    "mensaje" =>"¡Ha ocurrido un problema enviando verificación de correo electrónico a " . $data["regEmail"] . $mail->ErrorInfo . "!"
                                ));

                            } else {

                                echo json_encode(array(
                                    "statusCode" => "200",
                                    "error" => true,
                                    "isLogged" => false,
                                    "mensaje" =>"¡Excelente trabajo " . $data["regName"] . ", ahora podras disfrutar de nuestras promociones!",
                                ));


                            }

                        }

                    }
                } else {

                    echo json_encode(array(
                        "statusCode" => "400",
                        "error" => true,
                        "mensaje" =>"¡Error al registrar el usuario, no se permiten caracteres especiales!",
                    ));


                }

            }

        }else{
            //REGISTRO DE GOOGLE O FACEBOOK

            $tabla = "users";
            $item = "email";
            $valor = $data["regEmail"];
            $emailRepetido = false;

            $respuesta0 = ModelUsers::mdlShowUsers($tabla, $item, $valor);

            if($respuesta0){

                if($respuesta0["modo"] != $data["modo"]){

                    echo json_encode(array(
                        "statusCode" => "400",
                        "error" => true,
                        "mensaje" =>"¡El correo electrónico ".$data["regEmail"].", ya está registrado en el sistema!"
                    ));

                    $emailRepetido = false;

                }

                $emailRepetido = true;

            }else{

                $respuesta1 = ModelUsers::mdlUserRegister($tabla, $data);

            }

            if($emailRepetido || $respuesta1 == "ok"){

                $respuesta2 = ModelUsers::mdlShowUsers($tabla, $item, $valor);

                $answer = array(
                    "isLogged" => true,
                    "id" =>$respuesta2["id"],
                    "nombre" =>$respuesta2["nombre"],
                    "email" =>$respuesta2["email"],
                    "foto" =>$respuesta2["foto"],
                    "perfil" =>$respuesta2["perfil"],
                    "error" => false,
                    "statusCode" => "200",
                );

                echo json_encode(array(
                    "statusCode" => "200",
                    "error" => false,
                    "data" =>$answer,
                    "mensaje" =>""
                ));

            }
        }


    }

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/
    static public function ctrShowUsers($item,$valor){

        $tabla = "users";

        $respuesta = ModelUsers::mdlShowUsers($tabla,$item,$valor);

        return $respuesta;
    }

    /*=============================================
        REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
    =============================================*/
    static public function ctrUpdateLastLogin($tabla,$id){

        date_default_timezone_set('America/Bogota');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;

        $item1 = "ultimo_login";
        $valor1 = $fechaActual;

        $item2 = "id";
        $valor2 = $id;

        ModelUsers::mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2);
    }
}