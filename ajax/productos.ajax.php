<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos
{

    /*=============================================
    ACTIVAR PRODUCTOS
    =============================================*/

    public $activarProducto;
    public $activarId;

    public function ajaxActivarProducto()
    {

        $tabla = "productos";

        $item1  = "estado";
        $valor1 = $this->activarProducto;

        $item2  = "id";
        $valor2 = $this->activarId;

        $respuesta = ModeloProductos::mdlActualizarProductos($tabla, $item1, $valor1, $item2, $valor2);

        echo $respuesta;

    }

    /*=============================================
    VALIDAR NO REPETIR PRODUCTO
    =============================================*/

    public $validarProducto;

    public function ajaxValidarProducto()
    {

        $item  = "titulo";
        $valor = $this->validarProducto;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);

    }

    public $titulo;
    public $ruta;
    public $detalle;
    public $categoria;
    public $precio;
    public $peso;
    public $entrega;
    public $descripcion;
    public $foto;
    public $estado;
    public $antiguaFoto;
    public $idCategoria;

    public function ajaxCrearProducto()
    {

        $datos = array(
            "titulo"      => $this->titulo,
            "ruta"        => $this->ruta,
            "detalle"     => $this->detalle,
            "categoria"   => $this->categoria,
            "precio"      => $this->precio,
            "descripcion" => $this->descripcion,
            "foto"        => $this->foto,
        );

        $respuesta = ControladorProductos::ctrCrearProducto($datos);

        echo $respuesta;

    }

    /*=============================================
    TRAER PRODUCTOS
    =============================================*/

    public $idProducto;

    public function ajaxTraerProducto()
    {

        $item  = "id";
        $valor = $this->idProducto;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================================
    EDITAR PRODUCTOS
    =============================================*/

    public function ajaxEditarProducto()
    {

        $datos = array(
            "titulo"      => $this->titulo,
            "ruta"        => $this->ruta,
            "detalle"     => $this->detalle,
            "categoria"   => $this->categoria,
            "precio"      => $this->precio,
            "descripcion" => $this->descripcion,
            "foto"        => $this->foto,
        );

        $respuesta = ControladorProductos::ctrEditarProducto($datos);

        echo $respuesta;

    }

}

/*=============================================
ACTIVAR PRODUCTOS
=============================================*/

if (isset($_POST["activarProducto"])) {

    $activarProducto                  = new AjaxProductos();
    $activarProducto->activarProducto = $_POST["activarProducto"];
    $activarProducto->activarId       = $_POST["activarId"];
    $activarProducto->ajaxActivarProducto();

}

/*=============================================
VALIDAR NO REPETIR PRODUCTO
=============================================*/

if (isset($_POST["validarProducto"])) {

    $valProducto                  = new AjaxProductos();
    $valProducto->validarProducto = $_POST["validarProducto"];
    $valProducto->ajaxValidarProducto();

}

#CREAR PRODUCTO

if (isset($_POST["titulo"])) {

    $producto              = new AjaxProductos();
    $producto->titulo      = $_POST["titulo"];
    $producto->ruta        = $_POST["ruta"];
    $producto->detalle     = $_POST["detalle"];
    $producto->categoria   = $_POST["categoria"];
    $producto->descripcion = $_POST["descripcion"];
    $producto->precio      = $_POST["precio"];

    if (isset($_FILES["foto"])) {

        $producto->foto = $_FILES["foto"];

    } else {

        $producto->foto = null;

    }

    $producto->descripcion = $_POST["descripcion"];

    $producto->ajaxCrearProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/
if (isset($_POST["idProducto"])) {

    $traerProducto             = new AjaxProductos();
    $traerProducto->idProducto = $_POST["idProducto"];
    $traerProducto->ajaxTraerProducto();

}

/*=============================================
EDITAR PRODUCTO
=============================================*/
if (isset($_POST["id"])) {

    $editarProducto     = new AjaxProductos();
    $editarProducto->id = $_POST["id"];

    $editarProducto->titulo      = $_POST["titulo"];
    $editarProducto->ruta        = $_POST["ruta"];
    $editarProducto->detalle     = $_POST["detalle"];
    $editarProducto->categoria   = $_POST["categoria"];
    $editarProducto->descripcion = $_POST["descripcion"];
    $editarProducto->precio      = $_POST["precio"];

    if (isset($_FILES["foto"])) {

        $editarProducto->foto = $_FILES["foto"];

    } else {

        $editarProducto->foto = null;

    }

    $editarProducto->antiguaFoto = $_POST["antiguaFoto"];

    $editarProducto->ajaxEditarProducto();

}
