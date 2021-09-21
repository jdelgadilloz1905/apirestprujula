<?php

require_once "conexion.php";

class ModelUsers{

    /*=============================================
        MOSTRAR USUARIOS
        =============================================*/

    static public function mdlShowUsers($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch(PDO::FETCH_ASSOC);

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id");

            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }


        $stmt -> close();

        $stmt = null;

    }

    /*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

    static public function mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);


        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;

    }

    static public function mdlUpdateUser2($tabla, $data){

        $stmt = Conexion::conectar()->prepare(

            "UPDATE $tabla SET email = :email, nombre = :nombre, apellido = :apellido, foto = :foto, telefono = :telefono,email_encriptado = :email_encriptado, perfil = :perfil  WHERE id = :id");

        $stmt -> bindParam(":id", $data["id"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellido", $data["apellido"], PDO::PARAM_STR);
        $stmt -> bindParam(":foto", $data["foto"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $data["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":email_encriptado", $data["email_encriptado"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $data["perfil"], PDO::PARAM_INT);


        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;

    }

    /*=============================================
	REGISTRAR USUARIOS
	=============================================*/

    static public function mdlUserRegister($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(email, nombre, apellido, password, foto, modo, email_encriptado, verificacion) VALUES (:email, :nombre, :apellido, :password, :foto, :modo, :email_encriptado, :verificacion)");


        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

        $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);

        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

        $stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);

        $stmt->bindParam(":email_encriptado", $datos["emailEncriptado"], PDO::PARAM_STR);

        $stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    /*============================================
		ACTUALIZAR PASSWORD
	==============================================*/

    static public function mdlUpdatePassword($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET password = :password WHERE id = :id");

        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt-> close();

        $stmt = null;

    }

    static public function mdlRegisterContacto($datos){


        $stmt = Conexion::conectar()->prepare("INSERT INTO contactos (email, nombre, mensaje) 
                                                                    VALUES (:email, :nombre, :mensaje)");


        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

        $stmt->bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);



        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    /*============================================
		ACTUALIZAR PASSWORD
	==============================================*/

    static public function mdlActualizarPassword($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET password = :password WHERE id = :id");

        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt-> close();

        $stmt = null;

    }

    /*=============================================
	ELIMINAR REGISTROS DE TABLAS
	=============================================*/

    static public function mdlDeleteRecord($tabla, $item,  $valor){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;


    }

    static public function mdlActualizarPerfil($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt-> close();

        $stmt = null;

    }


    /*=============================================
        MOSTRAR REGISTROS BLOG
        =============================================*/

    static public function mdlShowBlog($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT b.*, u.nombre name, u.apellido last_name , u.foto photo FROM $tabla b LEFT JOIN usuarios u 
                                                              on b.id_user = u.id WHERE $item = :$item ");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch(PDO::FETCH_ASSOC);

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT b.*, u.nombre name, u.apellido last_name , u.foto photo FROM $tabla b LEFT JOIN usuarios u 
                                                              on b.id_user = u.id ORDER BY b.id");

            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }


        $stmt -> close();

        $stmt = null;

    }

    /*=============================================
	ELIMINAR REGISTROS DEL BLOG
	=============================================*/

    static public function mdlDeleteRecordBlog($tabla, $item,  $valor){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;


    }

    /*=================================================
    CREAR REGISTRO BLOG
    ===================================================*/

    static public function mdlCreateRecordBlog($tabla,$data){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (title, id_user, tags, content) 
                                                                    VALUES (:title, :id_user, :tags, :content)");


        $stmt->bindParam(":title", $data["title"], PDO::PARAM_STR);

        $stmt->bindParam(":id_user", $data["id_user"], PDO::PARAM_STR);

        $stmt->bindParam(":tags", $data["tags"], PDO::PARAM_STR);

        $stmt->bindParam(":content", $data["content"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    /*=================================================
    EDITAR REGISTRO BLOG
    ===================================================*/

    static public function mdlUpdateRecordBlog($tabla, $data){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET title = :title, id_user = :id_user, tags = :tags, content = :content  WHERE id = :id");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);

        $stmt->bindParam(":title", $data["title"], PDO::PARAM_STR);

        $stmt->bindParam(":id_user", $data["id_user"], PDO::PARAM_STR);

        $stmt->bindParam(":tags", $data["tags"], PDO::PARAM_STR);

        $stmt->bindParam(":content", $data["content"], PDO::PARAM_STR);


        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt-> close();

        $stmt = null;
    }

}