<?php
class ControllerCategory{

    static public function ctrShowCategory($item, $valor){

        $tabla = "categorias";

        $respuesta = ModelsCategory::mdlShowCategory($tabla,$item, $valor,1);
        $respuesta2 = ModelsCategory::mdlShowCategory($tabla,$item, $valor,2);

        echo json_encode(array(
            "statusCode" => 200,
            "cateInfo"=>$respuesta,
            "cateInfo2"=>$respuesta2,
            "error" => false,
            "mensaje" =>"",
        ));
    }

    /*=============================================
      INSERTAR CATEGORIA
      =============================================*/
    static public function ctrCreateCategory($data){


    }
    /*=============================================
    ACTUALIZAR NOMBRE O ESTADO DE LA CATEGORIA
    =============================================*/

    static public function ctrEditCategory($obj){


    }



    /*=============================================
    ELIMINAR CATEGORIA QUE NO ESTAN ASOCIADO A UN ANUNCIO
    =============================================*/
}