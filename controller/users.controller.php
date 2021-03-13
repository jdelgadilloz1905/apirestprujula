<?php
class ControllerUsers{
    /*=============================================
    INGRESAR USUARIO
    =============================================*/
    static public function ctrLoginUser($data){

        if(isset($data["ingUser"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $data["ingUser"]) &&
                preg_match('/^[a-zA-Z0-9.,]+$/', $data["ingPassword"])){

                $encrypt = crypt($data["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $table = "users";

                $item = "usuario";

                $value = $data["ingUser"];

                $answer = ModelUsers::mdlShowUsers($table,$item,$value);

                if($answer["usuario"] == $value && $answer["password"] == $encrypt){

                    if($answer["estado"] == 1){

                        $resultado = array(
                            "isLogged" => true,
                            "id" =>$answer["id"],
                            "nombre" =>$answer["nombre"],
                            "usuario" =>$answer["usuario"],
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
                            "statusCode" => "400",
                            "error" => true,
                            "isLogged" => false,
                            "mensaje" =>"El usuario aún no está activado"
                        ));


                    }

                }else{

                    echo json_encode(array(
                        "statusCode" => "400",
                        "error" => true,
                        "isLogged" => false,
                        "mensaje" =>"Error al ingresar, vuelve a intentarlo"
                    ));

                }

            }
        }
    }
}