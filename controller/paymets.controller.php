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
                "mensaje" =>"Genial Pago insertado con exito"
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
}