<?php
class ControllerAds{

    static public function ctrCreateAd($data){

            if(isset($data["regNombre"])){

                $datos = array(
                    "nombre"=>$data["regNombre"],
                    "descripcion"=>$data["regDescripcion"],
                    "id_categoria"=>$data["regIdCategoria"],
                    "image_url"=>$data["regImageUrl"],
                    "latitud"=>$data["regLatitud"],
                    "longitud"=>$data["regLongitud"],
                    "habitaciones"=>$data["regHabitaciones"],
                    "precio"=>$data["regPrecio"],
                    "oferta"=>$data["regOferta"],
                    "descuento"=>$data["regDescuento"],
                );

                $resultado = ModelsAds::mdlCreateAd("anuncios",$datos);

                //valido la imagen
                //if(isset())
//                $tipo = $_FILES["archivo"]["type"];
//
//                $archivo = $_FILES["archivo"]["tmp_name"];
//
//                $ruta = "../../img/cita_imagen/";
//
//                $nombre_foto = $id_cita_imagen;
            }
    }
}