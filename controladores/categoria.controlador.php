<?php

class ControladorCategorias
{

    /*=============================================
    MOSTRAR CATEGORIAS
    =============================================*/

    public static function ctrMostrarCategorias($item, $valor)
    {

        $tabla = "categorias";

        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

        return $respuesta;

    }

}
