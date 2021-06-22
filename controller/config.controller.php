<?php

class ControllerConfig{

    static public function ctrUploadImage(){

        $FileUploader = new FileUploader('imagen',array(

            'limit' => 5,
            'maxSize' => null,
            'fileMaxSize' => 5,
            'extensions' => null,
            'required' => false,
            'uploadDir' => "views/img/anuncios/",
            'title' => 'auto',
            'replace' => false,
            'listInput' => true,
            'files' => null,
            'editor' => true
        ));

        // desvincular los archivos
        // !importante solo para archivos precargados
        // you will need to give the array with appendend files in 'files' option of the fileUploader
        //deberá proporcionar la matriz con los archivos adjuntos en la opción 'archivos' del archivo Cargador

        /*foreach($FileUploader->getRemovedFiles('file') as $key=>$value) {
            unlink('views/img/anuncios/' . $value['name']);
        }*/

        // llama para subir los archivos
        $data = $FileUploader->upload();

        // SI CARGO LOS ARCHIVOS, MENSAJE DE EXITO
        if($data['isSuccess'] && count($data['files']) > 0) {
            // obtener archivos cargados
            $uploadedFiles = $data['files'];
        }

        // obtener la lista de archivos
        $fileList = $FileUploader->getFileList();

        //debe haber un return para mandar el json donde lo pidan
        return json_encode(array(
            "statusCode" => 200,
            "cantidadImagen"=>count($_FILES['imagen']['tmp_name']),
            "imageInfo"=> $fileList,
            "error" => false,

        ));
    }

    static public function ctrGetConfig(){

        $respuesta = ModelsConfig::mdlConfig();

        echo $respuesta;
    }
}