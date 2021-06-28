<?php


class ControllerPayments{

    static public function ctrConfirmarPago($data){

        //inserto el regitro de pago y actualizo la reservacion a estatus pagado
        /*====================================
        BUSCO LOS DATOS DE LA RESERVACION
        ======================================*/
        $datosReserv = ModelsAds::mdlShowAdsReservation("reservaciones","id",$data["id_reservacion"]);

        /*====================================
        PREPARO EL JSON PARA INSERTAR EL REGISTRO
        ======================================*/

        $datos = array(
            "id_reservacion" =>$data["id_reservacion"],
            "id_user" =>$datosReserv["id_user"],
            "id_anuncio"=>$datosReserv["id_anuncio"],
            "id_pago"=>$data["confirmation_number"],
            "precio"=>$datosReserv["precio"],
            "impuesto"=>$datosReserv["impuesto"],
            "descuento"=>$datosReserv["descuento"],
            "comision"=>$datosReserv["comision"],
            "total"=>$datosReserv["total"],
            "pagado"=>1
        );

        $respuesta = ModelsPayments::mdlInsertarpago($datos);

        if($respuesta == "ok"){

            //actualizo la reservacion a pagado
            ModelsPayments::mdlUpdateConfirmarPagoReservacion("reservaciones",$datos);

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "confirmation_number"=>$data["confirmation_number"],
                "mensaje" =>"Genial Pago realizado con exito"
            ));

        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "adsInfo"=>"",
                "error" => true,
                "mensaje" =>"Error al insertar el pago, contacte con el administrador",
            ));

        }
    }

    static public function ctrPay($data){


        //url contra la que atacamos
        $ch = curl_init("https://api.ezpaycenters.net/api/cc");
        //a true, obtendremos una respuesta de la url, en otro caso,
        //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //establecemos el verbo http que queremos utilizar para la petición
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //enviamos el array data
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        //obtenemos la respuesta
        $response = curl_exec($ch);
        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);
        if($response) {
            $bmstatusArray = json_decode($response,true);
            //echo $bmstatusArray["Code"];
            //echo $response;
            if($bmstatusArray["ReturnCode"] == 1){
                $data = array(
                    "id_reservacion"=>$data["id_reservacion"],
                    "confirmation_number"=>$bmstatusArray["ConfirmationNumber"]
                );
                $resultado = self::ctrConfirmarPago($data);

                echo $resultado;

            }else{

                echo json_encode(array(
                    "statusCode" => 400,
                    "respuesta"=>json_decode($response),
                    "error" => true,
                    "mensaje" =>"Error procesando la pasarela de pago. Contacte con el administrador",
                ));
            }

        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "adsInfo"=>"",
                "error" => true,
                "mensaje" =>"Error procesando la pasarela de pago. Contacte con el administrador",
            ));
        }

        /*echo json_encode(array(
            "statusCode" => 200,
            "resultado"=>json_decode($response),
            "error" => false,
            "mensaje" =>"Genial Pago insertado con exito"
        ));*/
    }
}