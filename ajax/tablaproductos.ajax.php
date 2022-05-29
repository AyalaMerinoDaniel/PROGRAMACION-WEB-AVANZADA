<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categoria.controlador.php";
require_once "../modelos/categoria.modelo.php";

class TablaProductos
{
    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
    public function mostrarTablaProductos()
    {
        $item  = null;
        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);
        // var_dump($productos);
        if (count($productos)) {
            $datosJson = '{
                "data":[';
            for ($i = 0; $i < count($productos); $i++) {
                /*=============================================
                TRAER LAS CATEGORÍAS
                =============================================*/
                $item       = "id";
                $valor      = $productos[$i]["id_categoria"];
                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                if ($categorias["categoria"] == "") {
                    $categoria = "SIN CATEGORÍA";
                } else {
                    $categoria = $categorias["categoria"];
                }

                /*=============================================
                AGREGAR ETIQUETAS DE ESTADO
                =============================================*/
                if ($productos[$i]["estado"] == 0) {
                    $colorEstado    = "btn-danger";
                    $textoEstado    = "Desactivado";
                    $estadoProducto = 1;
                } else {
                    $colorEstado    = "btn-success";
                    $textoEstado    = "Activado";
                    $estadoProducto = 0;
                }

                $estado = "<button class='btn btn-xs btnActivar " . $colorEstado . "' idProducto='" . $productos[$i]["id"] . "' estadoProducto='" . $estadoProducto . "'>" . $textoEstado . "</button>";

                $imagen = "<img src='" . $productos[$i]["foto"] . "' class='img-thumbnail imgTablaPrincipal' width='100px'>";

                if ($productos[$i]["precio"] == 0) {
                    $precio = "0";
                } else {
                    $precio = "$ " . number_format($productos[$i]["precio"], 2);
                }

                /*=============================================
                TRAER LAS ACCIONES
                =============================================*/
                $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='" . $productos[$i]["id"] . "'><i class='fa fa-times'></i></button></div>";
                /*=============================================
                CONSTRUIR LOS DATOS JSON
                =============================================*/
                $datosJson .= '[
                        "' . ($i + 1) . '",
                        "' . $productos[$i]["titulo"] . '",
                        "' . $estado . '",
                        "' . $categoria . '",
                        "' . $productos[$i]["detalle"] . '",
                        "' . $productos[$i]["descripcion"] . '",
                        "' . $precio . '",
                        "' . $imagen . '",
                        "' . $productos[$i]["fecha"] . '",
                        "' . $acciones . '"
                    ],';
            }
            $datosJson = substr($datosJson, 0, -1);
            $datosJson .= ']
            }';
            echo $datosJson;} else {
            echo '{"data":[]}';
            return;}
    }
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();
