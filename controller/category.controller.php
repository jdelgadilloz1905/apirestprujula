<?php
class ControllerCategory{

    static public function ctrShowCategory($item, $valor){

        $tabla = "categorias";

        $respuesta = ModelsCategory::mdlShowCategory($tabla,$item, $valor);

        echo json_encode(array(
            "statusCode" => 200,
            "cateInfo"=>$respuesta,
            "error" => false,
            "mensaje" =>"",
        ));
    }

    /*=============================================
      INSERTAR CATEGORIA
      =============================================*/

    /*=============================================
    ACTUALIZAR NOMBRE O ESTADO DE LA CATEGORIA
    =============================================*/

    /*=============================================
    ELIMINAR CATEGORIA QUE NO ESTAN ASOCIADO A UN ANUNCIO
    =============================================*/
}