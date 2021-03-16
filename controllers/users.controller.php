<?php
class ControllerUsers{
    /*=============================================
    INGRESAR USUARIO
    =============================================*/
    static public function ctrLoginUser($data){

        if(isset($data["ingUser"])){
            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
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
                            "email" =>$answer["email"],
                            "foto" =>$answer["foto"],
                            "perfil" =>$answer["perfil"],
                            "error" => false,
                            "statusCode" => "200",
                        );

                        /*=============================================
                        REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
                        =============================================*/

                        date_default_timezone_set('America/Bogota');

                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');

                        $fechaActual = $fecha.' '.$hora;

                        $item1 = "ultimo_login";
                        $valor1 = $fechaActual;

                        $item2 = "id";
                        $valor2 = $answer["id"];

                        ModelUsers::mdlUpdateUser($table, $item1, $valor1, $item2, $valor2,"WEB");

                        echo json_encode($resultado);

                    }else{

                        echo json_encode(array(
                            "statusCode" => "200",
                            "error" => true,
                            "isLogged" => false,
                            "mensaje" =>"El email aún no está activado"
                        ));


                    }

                }else{

                    echo json_encode(array(
                        "statusCode" => "200",
                        "error" => true,
                        "isLogged" => false,
                        "mensaje" =>"Error al ingresar, vuelve a intentarlo"
                    ));

                }

            }
        }
    }

    /*=============================================
    RECUPERAR LA CLAVE
    =============================================*/

    static public function ctrRecoverPassword($data){

        if(isset($_POST["passEmail"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])){

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
                $valor1 = $_POST["passEmail"];

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

                        date_default_timezone_set("America/Argentina/Buenos_Aires");

                        $url = Ruta::ctrRuta();

                        $mail = new PHPMailer;

                        $mail->CharSet = 'UTF-8';

                        $mail->isMail();

                        $mail->setFrom('soporte@Prujula.pr', 'PRUJULA');

                        $mail->addReplyTo('soporte@Prujula.pr', 'PRUJULA');

                        $mail->Subject = "¿Olvidaste tu contraseña? ";

                        $mail->addAddress($_POST["passEmail"]);

                        $urlLink = Ruta::ctrRutaEnvioEmail();

                        $formUrl = $urlLink . "olvidaste-clave";

//                        //Los datos a enviar cómo parámetros
//                        $datosUrl = array(
//                            'nombre' => $respuesta1["nombre"] ,
//                            'encriptarEmail' =>$respuesta1['emailEncriptado'],
//                            'url' => $url
//                        );
//                        //Indicamos que utilizamos el protocolo http, método post, cabecera de formulario, y los parámetros de la consulta.
//                        $opciones = array('http' => array(
//                            'method'  => 'POST',
//                            'header'  => 'Content-type: application/x-www-form-urlencoded',
//                            'content' => http_build_query($datosUrl)
//                        ));
//
//                        //flujo de opciones.
//                        $contexto  = stream_context_create($opciones);
                        $template = file_get_contents($formUrl);


                        $sustituir_email = "%encriptarEmail%";
                        $por_email = trim(utf8_decode($respuesta1[emailEncriptado]));
                        $template = str_replace($sustituir_email, $por_email, $template);

                        $sustituir_nombre = "%nombreConductor%";
                        $por_nombre = trim(utf8_decode($respuesta1[nombre]));
                        $template = str_replace($sustituir_nombre, ucwords($por_nombre), $template);

                        //Solicitar el contenido
                        //$template = file_get_contents($formUrl, false, $contexto);


                        $mail->msgHTML($template);

                        $envio = $mail->Send();

                        if(!$envio){

                            echo '<script>

                                swal({
                                      title: "¡ERROR!",
                                      text: "¡Ha ocurrido un problema enviando cambio de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'!",
                                      type: "error",
                                      showCancelButton: false,
                                      confirmButtonColor: "#3085d6",
                                      cancelButtonColor: "#d33",
                                      confirmButtonText: "Cerrar"
                                    }).then((result) => {
                                        if (result.value) {
                                            history.back();
                                        }
                                    })

							</script>';

                        }else{

                            echo '<script>
                                swal({
                                      title: "Hola '. ucwords($respuesta1["nombre"]) .'",
                                      text: "Por favor, revisá tu bandeja de entrada para recuperar tu contraseña.",
                                      type: "success",
                                      showCancelButton: false,
                                      confirmButtonColor: "#3085d6",
                                      cancelButtonColor: "#d33",
                                      confirmButtonText: "Cerrar"
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location = "publicador";
                                        }
                                    })

							</script>';

                        }

                    }

                }else{

                    echo '<script>
                        swal({
                              title: "¡ERROR!",
                              text: "¡El correo electrónico no existe en el sistema!",
                              type: "error",
                              showCancelButton: false,
                              confirmButtonColor: "#3085d6",
                              cancelButtonColor: "#d33",
                              confirmButtonText: "Cerrar"
                            }).then((result) => {
                                if (result.value) {
                                    history.back();
                                }
                            })

					</script>';


                }

            }else{

                echo '<script>
                        swal({
                              title: "¡ERROR!",
                              text: "¡Error al enviar el correo electrónico, está mal escrito!",
                              type: "error",
                              showCancelButton: false,
                              confirmButtonColor: "#3085d6",
                              cancelButtonColor: "#d33",
                              confirmButtonText: "Cerrar"
                            }).then((result) => {
                                if (result.value) {
                                    history.back();
                                }
                            })

				</script>';

            }

        }


    }
}