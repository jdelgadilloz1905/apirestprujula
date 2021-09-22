<?php
class ControllerUsers{
    /*=============================================
    INGRESAR USUARIO
    =============================================*/
    static public function ctrLoginUser($data){

        if(isset($data["conEmail"])){
            if($data["conModo"] == "directo"){
                if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $data["conEmail"]) &&
                    preg_match('/^[a-zA-Z0-9.,]+$/', $data["conPassword"])){

                    $encrypt = crypt($data["conPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $table = "usuarios";

                    $item = "email";

                    $value = $data["conEmail"];

                    $answer = ModelUsers::mdlShowUsers($table,$item,$value);

                    if($answer["email"] == $value && $answer["password"] == $encrypt){

                        if($answer["verificacion"] == 0){
                            if($answer["estado"] == 1){

                                /*=============================================
                                REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
                                =============================================*/

                                self::ctrUpdateLastLogin($table,$answer["id"]);

                                echo json_encode(array(
                                    "statusCode" => 200,
                                    "error" => false,
                                    "userInfo" =>$answer,
                                    "mensaje" =>""
                                ));


                            }else{

                                echo json_encode(array(
                                    "statusCode" => 400,
                                    "error" => true,
                                    "mensaje" =>"La cuenta se encuentra desactivada, contacte con el administrador"
                                ));

                            }
                        }else{
                            echo json_encode(array(
                                "statusCode" => 400,
                                "error" => true,
                                "mensaje" =>"La cuenta no ha sido verificada"
                            ));
                        }



                    }else{

                        echo json_encode(array(
                            "statusCode" => 400,
                            "error" => true,
                            "mensaje" =>"Error al ingresar, vuelve a intentarlo"
                        ));

                    }

                }
            }

        }
    }

    static public function ctrSocialLoginUser($data){

        if(isset($data["conEmail"])){

            $table = "usuarios";

            $item = "email";

            $value = $data["conEmail"];

            $encriptarEmail = md5($data["conEmail"]);

            $answer = ModelUsers::mdlShowUsers($table,$item,$value);

            if($answer){

                if($answer["estado"] == 1){

                    /*=============================================
                    REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
                    =============================================*/
                    self::ctrUpdateLastLogin($table,$answer["id"]);

                    echo json_encode(array(
                        "statusCode" => 200,
                        "error" => false,
                        "userInfo" =>$answer,
                        "mensaje" =>"Bienvenido ".$answer["nombre"]
                    ));
                }else{
                    echo json_encode(array(
                        "statusCode" => 400,
                        "error" => true,
                        "mensaje" =>"La cuenta se encuentra desactivada, contacte con el administrador"
                    ));

                }

            }else{

                $datos = array(
                    "nombre" => $data["conNombre"],
                    "apellido" => $data["conApellido"],
                    "password" => "",
                    "email" => $data["conEmail"],
                    "foto" => $data["conFoto"],
                    "modo" => $data["conModo"],
                    "verificacion"=> 0,
                    "emailEncriptado" => $encriptarEmail);

                $respuesta1 = ModelUsers::mdlUserRegister($table, $datos);

                if($respuesta1 == "ok"){

                    $answer = ModelUsers::mdlShowUsers($table, $item, $value);

                    /*=============================================
                        VERIFICACIÓN CORREO ELECTRÓNICO
                        =============================================*/

                    date_default_timezone_set("America/Bogota");


                    $mail = new PHPMailer;

                    $mail->CharSet = 'UTF-8';

                    $mail->isMail();

                    $mail->setFrom('hola@prujula.com', 'PRUJULA');

                    $mail->addReplyTo('hola@prujula.com', 'PRUJULA');

                    $mail->Subject = "Bienvenido a Prujula";

                    $mail->addAddress($data["conEmail"]);

                    $mail->msgHTML('
                                    <div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

                                        <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                
                                            <center>
                
                                                <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
                    
                                                <h3 style="font-weight:100; color:#999">BIENVENIDO A PRUJULA</h3>
                    
                                                <hr style="border:1px solid #ccc; width:80%">
                    
                                                <h4 style="font-weight:100; color:#999; padding:0 20px">Ahora podras disfrutar de nuestras ofertas</h4>
                    
                    
                                                <br>
                    
                                                <hr style="border:1px solid #ccc; width:80%">
                    
                                                <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
                
                                            </center>
                
                                        </div>
                                    </div>'
                    );

                    $envio = $mail->Send();

                    if ($envio) {

                        echo json_encode(array(
                            "statusCode" => 200,
                            "error" => false,
                            "userInfo" =>$answer,
                            "mensaje" =>"¡Excelente trabajo " . $answer["email"] . ", ahora podras disfrutar de nuestras promociones!"
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

        if(isset($data["conEmail"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $data["conEmail"])){

                /*=============================================
                GENERAR CONTRASEÑA ALEATORIA
                =============================================*/

                function generarPassword($longitud){

                    $key = "";
                    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

                    $max = strlen($pattern)-1;

                    for($i = 0; $i < $longitud; $i++){

                        $key .= $pattern[mt_rand(0,$max)];

                    }

                    return $key;

                }

                $nuevaPassword = generarPassword(11);

                $encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";

                $item1 = "email";
                $valor1 = $data["conEmail"];

                $respuesta1 = ModelUsers::mdlShowUsers($tabla,$item1,$valor1);

                if($respuesta1){

                    $valor = $respuesta1["id"];
                    $item2 = "password";
                    $valor2 = $encriptar;

                    $respuesta2 = ModelUsers::mdlUpdateUser($tabla, $item2, $valor2, "id", $valor );

                    if($respuesta2  == "ok"){

                        /*=============================================
                        CAMBIO DE CONTRASEÑA
                        =============================================*/

                        $url = Ruta::ctrRutaFront();

                        date_default_timezone_set("America/Bogota");

                        $mail = new PHPMailer;

                        $mail->CharSet = 'UTF-8';

                        $mail->isMail();

                        $mail->setFrom('hola@prujula.com', 'PRUJULA');

                        $mail->addReplyTo('hola@prujula.com', 'PRUJULA');

                        $mail->Subject = "¿Olvidaste tu contraseña?";

                        $mail->addAddress($data["conEmail"]);

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
                                "statusCode" => 400,
                                "error" => true,
                                "NuevoPassword"=>$nuevaPassword,
                                "mensaje" =>"¡Ha ocurrido un problema enviando cambio de contraseña a ".$data["conEmail"].$mail->ErrorInfo."!",
                            ));

                        }else{

                            echo json_encode(array(
                                "statusCode" => 200,
                                "NuevoPassword"=>$nuevaPassword,
                                "error" => false,
                                "mensaje" =>"",
                            ));

                        }

                    }

                }else{

                    echo json_encode(array(
                        "statusCode" => 400,
                        "error" => true,
                        "mensaje" =>"¡El correo electrónico no existe en el sistema!",
                    ));
                }

            }else{

                echo json_encode(array(
                    "statusCode" => 400,
                    "error" => true,
                    "mensaje" =>"¡Error al enviar el correo electrónico, está mal escrito!",
                ));


            }

        }


    }
    /*=============================================
    CAMBIAR CLAVE
    =============================================*/

    static public function ctrUpdatePassword($data){

        if(isset($data["actEmailEncriptado"])){

            if( preg_match('/^[a-zA-Z0-9]+$/.,*', $_POST["actPassClave"]) &&  preg_match('/^[a-zA-Z0-9]+$/.,*', $_POST["actPassClave"])){

                $passwordNuevo = crypt($_POST["actPassClave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $emailEncriptado= $_POST["actEmailEncriptado"];

                $tabla = "usuarios";
                $item = "emailEncriptado";
                $valor = $emailEncriptado;

                $respuesta = ModelUsers::mdlShowUsers($tabla, $item, $valor);

                if($respuesta["emailEncriptado"] == $emailEncriptado ){

                    $datos = array(
                        "id"=>$respuesta["id"],
                        "password"=>$passwordNuevo
                    );
                    $resp = ModelUsers::mdlUpdatePassword($tabla, $datos);

                    if($resp == "ok"){

                        echo json_encode(array(
                            "statusCode" => 200,
                            "error" => false,
                            "mensaje" =>"Tu contraseña ha sido cambiada exitosamente."
                        ));

                    }else{

                        echo json_encode(array(
                            "statusCode" => "500",
                            "error" => true,
                            "mensaje" =>"¡Error al cambiar su contraseña, contacte con el administrador!"
                        ));

                    }

                }else{

                    echo json_encode(array(
                        "statusCode" => "500",
                        "error" => true,
                        "mensaje" =>"¡Error al cambiar su contraseña, contacte con el administrador!"
                    ));

                }

            }else{

                echo json_encode(array(
                    "statusCode" => "500",
                    "error" => true,
                    "mensaje" =>"¡Error al cambiar la contraseña, no se permiten caracteres especiales!"
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

                $encriptar = crypt($data["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $encriptarEmail = md5($data["regEmail"]);

                $datos = array(
                    "nombre" => $data["regName"],
                    "apellido" => $data["regLast"],
                    "password" => $encriptar,
                    "email" => $data["regEmail"],
                    "foto" => "",
                    "modo" => "directo",
                    "verificacion"=> $data["regVerificacion"],
                    "perfil"=> $data["regPerfil"],
                    "emailEncriptado" => $encriptarEmail);

                //ANTES REALIZO UNA VALIDACION SI EL USUARIO EXISTE NUEVAMENTE PARA EVITAR DUPLICIDAD
                $result = self::ctrShowUsers("email",trim($data["regEmail"])) ;

                if(isset($result["email"])){

                    echo json_encode(array(
                        "statusCode" => 400,
                        "error" => true,
                        "mensaje" =>"¡El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente!",
                    ));

                }else{

                    $tabla = "usuarios";

                    $respuesta = ModelUsers::mdlUserRegister($tabla, $datos);


                    if ($respuesta == "ok") {

                        /*=============================================
                        VERIFICACIÓN CORREO ELECTRÓNICO
                        =============================================*/

                        date_default_timezone_set("America/Bogota");

                        $url = Ruta::ctrRutaEnvioEmailAuth();

                        $mail = new PHPMailer;

                        $mail->CharSet = 'UTF-8';

                        $mail->isMail();

                        $mail->setFrom('hola@prujula.com', 'PRUJULA');

                        $mail->addReplyTo('hola@prujula.com', 'PRUJULA');

                        $mail->Subject = "Por favor verifique su dirección de correo electrónico";

                        $mail->addAddress($data["regEmail"]);

                        $mail->msgHTML('
                                <div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

                                    <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
            
                                        <center>
            
                                            <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
                
                                            <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
                
                                            <hr style="border:1px solid #ccc; width:80%">
                
                                            <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Prujula, debe confirmar su dirección de correo electrónico</h4>
                
                                            <a href="' . $url . 'register-sucess/' . $encriptarEmail . '" target="_blank" style="text-decoration:none">
                
                                            <div style="line-height:60px; background:#450E10; width:60%; color:white">Verifique su dirección de correo electrónico</div>
                
                                            </a>
                
                                            <br>
                
                                            <hr style="border:1px solid #ccc; width:80%">
                
                                            <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
            
                                        </center>
            
                                    </div>
                                </div>'
                        );

                        $envio = $mail->Send();

                        if (!$envio) {

                            echo json_encode(array(
                                "statusCode" => 400,
                                "error" => false,
                                "mensaje" =>"¡Ha ocurrido un problema enviando verificación de correo electrónico a " . $data["regEmail"] . $mail->ErrorInfo . "!"
                            ));

                        } else {

                            echo json_encode(array(
                                "statusCode" => 200,
                                "error" => false,
                                "mensaje" =>"¡Excelente trabajo " . $data["regName"] . ", ahora podras disfrutar de nuestras promociones!",
                            ));


                        }

                    }

                }

            }

        }


    }

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/
    static public function ctrShowUsers($item,$valor){

        $tabla = "usuarios";

        $respuesta = ModelUsers::mdlShowUsers($tabla,$item,$valor);

        return $respuesta;

    }

    static public function ctrGetShowUser($item,$valor){

        $tabla = "usuarios";

        $respuesta = ModelUsers::mdlShowUsers($tabla,$item,$valor);

        if($respuesta){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "userInfo" =>$respuesta,
                "mensaje" =>""
            ));
        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "error" => true,
                "userInfo" =>"",
                "mensaje" =>"No se encontraron registros"
            ));
        }


    }

    /*=============================================
    VERIFICACION DE EMAIL DE CUENTA DIRECTA
    =============================================*/

    static public function ctrVerifyUser($data){


        $item = "email_encriptado";

        $valor = $data["conVerifyUser"];
        //$valor = $data;

        $respuesta = self::ctrShowUsers($item, $valor);

        if(isset($respuesta["email_encriptado"])){

            $tabla = "usuarios";

            $item2 = "id";

            $valor2 = $respuesta["id"];

            $item1 = "verificacion";

            $valor1 = 0;

            $respuesta2 = ModelUsers::mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2);

            if($respuesta2 == "ok"){

                echo json_encode(array(
                    "statusCode" => 200,
                    "error" => false,
                    "mensaje" =>"Usuario verificado"
                ));

            }

        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "error" => true,
                "mensaje" =>"¡Error verificando el usuario, contacte con el administrador!"
            ));
        }
    }

    static public function ctrUpdateUser($data){

        if (isset($data["updId"])) {

            //$encriptar = crypt($data["updPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $encriptarEmail = md5($data["updEmail"]);

            //ANTES REALIZO UNA VALIDACION SI EL USUARIO EXISTE NUEVAMENTE PARA EVITAR DUPLICIDAD
            $result = self::ctrShowUsers("email",trim($data["updEmail"])) ;

            if($result["id"] == $data["updId"]){
                $datos = array(
                    "id" => $data["updId"],
                    "nombre" => $data["updName"],
                    "apellido" => $data["updLast"],
                    "email" => $data["updEmail"],
                    "telefono" => $data["updPhone"],
                    "foto" => $data["updFoto"],
                    "perfil" => $data["updPerfil"],
                    "idioma" => isset($data["updIdioma"]) ? $data["updIdioma"] : 'en',
                    "email_encriptado" => $encriptarEmail);

                $tabla = "usuarios";

                $respuesta = ModelUsers::mdlUpdateUser2($tabla, $datos);
                if($respuesta){

                    echo json_encode(array(
                        "statusCode" => 200,
                        "error" => false,
                        "mensaje" =>"Datos actualizados",
                        "datos" =>$datos
                    ));
                }else{
                    echo json_encode(array(
                        "statusCode" => 400,
                        "error" => true,
                        "mensaje" =>"¡Error actualizando los datos del usuario, contacte con el administrador!",
                    ));
                }

            }else{

                echo json_encode(array(
                    "statusCode" => 400,
                    "error" => true,
                    "mensaje" =>"El email ingresado, se encuentra en uso",
                ));
            }

        }
    }

    /*=============================================
    ENVIO DE EMAIL DE CONTACTO Y SE REGISTRA
    ===============================================*/

    static public function ctrSendEmailContact($data){

       if (isset($data["regEmail"])) {

            if (preg_match('/^[^0-9][a-zA-Z0-9_.*-]+([.][a-zA-Z0-9_.*-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $data["regEmail"])
            ) {


                $datos = array(
                    "nombre" => $data["regName"],
                    "email" => $data["regEmail"],
                    "mensaje" => $data["regMessage"]
                );

                //INSERTO EL REGISTRO EN LA TABLA CONTACTOS Y POSTERIORMENTE ENVIO EL CORREO
                $resultado = ModelUsers::mdlRegisterContacto($datos);


                if($resultado == 'ok'){

                    /*=============================================
                        VERIFICACIÓN CORREO ELECTRÓNICO
                        =============================================*/

                    date_default_timezone_set("America/Bogota");

                    $url = Ruta::ctrRutaEnvioEmailAuth();

                    $mail = new PHPMailer;

                    $mail->CharSet = 'UTF-8';

                    $mail->isMail();

                    $mail->setFrom($data["regEmail"], $data["regName"]);

                    $mail->addReplyTo('hola@prujula.com', 'PRUJULA');

                    $mail->Subject = "Email del contacto ".$data["regName"];

                    $mail->addAddress($data["regEmail"]);

                    $mail->msgHTML('
                                <div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

                                    <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
            
                                        <center>
            
                                            <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
                
                                            <h3 style="font-weight:100; color:#999">CLIENTE '.$data["regName"].' DESEA CONTACTARSE CON USTEDES</h3>
                    
                                            <hr style="border:1px solid #ccc; width:80%">
                
                                            <h4 style="font-weight:100; color:#999; padding:0 20px">'.$data["regMessage"].'</h4>
                
                                            
                
                                            <br>
                
                                            <hr style="border:1px solid #ccc; width:80%">
                
                                            <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
            
                                        </center>
            
                                    </div>
                                </div>'
                    );

                    $envio = $mail->Send();

                    if (!$envio) {

                        echo json_encode(array(
                            "statusCode" => 400,
                            "error" => false,
                            "mensaje" =>"¡Ha ocurrido un problema enviando el correo electrónico a " . $data["regEmail"] . $mail->ErrorInfo . "!"
                        ));

                    } else {

                        echo json_encode(array(
                            "statusCode" => 200,
                            "error" => false,
                            "mensaje" =>"¡Excelente trabajo " . $data["regName"] . ", pronto nos pondremos en contacto con usted!",
                        ));


                    }

                }else{

                    echo json_encode(array(
                        "statusCode" => 400,
                        "error" => true,
                        "mensaje" =>"¡Error enviando el correo, intente mas tarde!",
                    ));

                }
            } else {

                echo json_encode(array(
                    "statusCode" => 400,
                    "error" => true,
                    "mensaje" =>"¡Error al enviar el email, no se permiten caracteres especiales, verifique e intente de nuevo!",
                ));


            }

       }

    }

    /*=============================================
        FUNCIONES
    =============================================*/

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

    /*=============================================
	ACTUALIZA PASSWORD
	=============================================*/

    static public function ctrActualizarPassword($data){

        if(isset($data["updEmailEncriptado"])){

            $passwordNuevo = crypt($data["updNewPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $tabla = "usuarios";
            $item = "email_encriptado";
            $valor = $data["updEmailEncriptado"];

            $respuesta =  ModelUsers::mdlShowUsers($tabla,$item,$valor);

            if($respuesta["email_encriptado"] == $data["updEmailEncriptado"] ){

                $datos = array(
                       "id"=>$respuesta["id"],
                       "password"=>$passwordNuevo
                );
                $resp = ModelUsers::mdlActualizarPassword($tabla, $datos);

                if($resp == "ok"){

                    echo json_encode(array(
                        "statusCode" => 200,
                        "error" => false,
                        "mensaje" =>"Excelente trabajo, Tu contraseña ha sido cambiada exitosamente.",
                    ));

                }else{

                    echo json_encode(array(
                        "statusCode" => 400,
                        "error" => true,
                        "mensaje" =>"¡Error al cambiar su contraseña, contacte con el administrador!",
                    ));

                }

            }else{

                echo json_encode(array(
                    "statusCode" => 400,
                    "error" => true,
                    "mensaje" =>"¡Si tiene problema para recuperar su contraseña, contacte con el administrador!",
                ));

            }
        }

    }


    /*============================================
    ELIMINAR O INACTIVAR USUARIOS
    ==============================================*/

    static public function ctrDeleteUser($data){

        if($data["allDelete"] == "si"){

            //elimino reservaciones, anuncios, pagos, calificaciones, usuarios

            ModelUsers::mdlDeleteRecord("reservaciones","id_user",$data["idUser"]);

            ModelUsers::mdlDeleteRecord("pagos","id_user",$data["idUser"]);

            ModelUsers::mdlDeleteRecord("calificacion","id_user",$data["idUser"]);

            ModelUsers::mdlDeleteRecord("anuncios","id_user",$data["idUser"]);

            ModelUsers::mdlDeleteRecord("usuarios","id",$data["idUser"]);

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Cuenta eliminada"
            ));

        }else{
            $datos = array(
                "id" => $data["idUser"],
                "estado" => $data["estado"]
            );
            ModelUsers::mdlActualizarPerfil("usuarios",$datos);

            $respuesta = $data["estado"]== 1 ? "Activada": "Desactivada";

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Cuenta ".$respuesta
            ));
        }


    }


    /*============================================
    MOSTRAR REGISTROS EN BLOG
    ==============================================*/

    static public function ctrGetShowBlog($item,$valor){

        $tabla = "blog";

        $respuesta = ModelUsers::mdlShowBlog($tabla,$item,$valor);

        if($respuesta){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "blogInfo" =>$respuesta,
                "mensaje" =>""
            ));
        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "error" => true,
                "blogInfo" =>"",
                "mensaje" =>"No se encontraron registros"
            ));
        }


    }

    /*============================================
    ELIMINAR REGISTRO BLOG
    ==============================================*/

    static public function ctrDeleteBlog($data){

           $respuesta = ModelUsers::mdlDeleteRecordBlog("blog","id",$data["id"]);

        if($respuesta){

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"registro eliminado exitosamente"
            ));
        }else{

            echo json_encode(array(
                "statusCode" => 400,
                "error" => false,
                "mensaje" =>"Error, consulte con el administrador del sistema"
            ));
        }


    }

    /*===========================================
    EDITAR BLOG
    =============================================*/

     static public function ctrEditBlog($data){

         $respuesta = ModelUsers::mdlUpdateRecordBlog("blog",$data);

         if($respuesta == "ok"){

             echo json_encode(array(
                 "statusCode" => 200,
                 "error" => false,
                 "mensaje" =>"registro editado exitosamente"
             ));
         }else{

             echo json_encode(array(
                 "statusCode" => 400,
                 "error" => false,
                 "mensaje" =>"Error, consulte con el administrador del sistema"
             ));
         }
     }

     static public function ctrCreateBlog($data){

         $respuesta = ModelUsers::mdlCreateRecordBlog("blog",$data);

         if($respuesta == "ok"){

             echo json_encode(array(
                 "statusCode" => 200,
                 "error" => false,
                 "mensaje" =>"registro creado exitosamente"
             ));
         }else{

             echo json_encode(array(
                 "statusCode" => 400,
                 "error" => false,
                 "mensaje" =>"Error, consulte con el administrador del sistema"
             ));
         }

     }

}