<?php

require_once "conexion.php";

class ModeloProductos
{

    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/

    public static function mdlMostrarProductos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    MOSTRAR EL TOTAL DE VENTAS
    =============================================*/

    public static function mdlMostrarTotalProductos($tabla, $orden)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    public static function mdlIngresarProducto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, ruta, estado,  titulo, detalle, precio, foto, descripcion ) VALUES (:id_categoria, :ruta, :estado, :titulo, :detalle, :precio, :foto,  :descripcion)");

        $stmt->bindParam(":id_categoria", $datos["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    EDITAR PRODUCTO
    =============================================*/

    public static function mdlEditarProducto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, , ruta = :ruta, estado = :estado, titulo = :titulo, detalle = :detalle , precio = :precio, :detalles, , foto = :foto,  descripcion = :descripcion  WHERE id = :id");

        $stmt->bindParam(":id_categoria", $datos["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    ELIMINAR PRODUCTO
    =============================================*/

    public static function mdlEliminarProducto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    ACTUALIZAR PRODUCTOS
    =============================================*/

    public static function mdlActualizarProductos($tabla, $item1, $valor1, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }
}
