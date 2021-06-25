<?php

require_once "conexion.php";

class ModelsPayments{

    static public function mdlInsertarpago($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO pagos (id_reservacion,id_user,id_anuncio, id_pago,precio,impuesto,descuento,comision,total)
                                                                    VALUES (:id_reservacion,:id_user,:id_anuncio, :id_pago,:precio,:impuesto,:descuento,:comision,:total)");

        $stmt->bindParam(":id_reservacion", $datos["id_reservacion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_anuncio", $datos["id_anuncio"], PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_STR);
        $stmt->bindParam(":id_pago", $datos["id_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
        $stmt->bindParam(":comision", $datos["comision"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlUpdateConfirmarPagoReservacion($tabla,$data){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pagado = :pagado WHERE id = :id");

        $stmt->bindParam(":pagado", $data["pagado"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $data["id_reservacion"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }
}
