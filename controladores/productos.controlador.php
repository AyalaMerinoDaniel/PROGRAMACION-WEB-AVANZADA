<?php

class ControladorProductos
{

    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/

    public static function ctrMostrarProductos($item, $valor)
    {

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    MOSTRAR TOTAL PRODUCTOS
    =============================================*/

    public static function ctrMostrarTotalProductos($orden)
    {

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarTotalProductos($tabla, $orden);

        return $respuesta;

    }

    public static function ctrCrearProducto($datos)
    {

        if (isset($datos["titulo"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["titulo"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])) {

                $rutaFotoPrincipal = "vistas/img/productos/default/default.jpg";

                if (isset($datos["foto"]["tmp_name"]) && !empty($datos["fotoPrincipal"]["tmp_name"])) {

                    /*=============================================
                    DEFINIMOS LAS MEDIDAS
                    =============================================*/

                    list($ancho, $alto) = getimagesize($datos["foto"]["tmp_name"]);

                    $nuevoAncho = 400;
                    $nuevoAlto  = 450;

                    /*=============================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    =============================================*/

                    if ($datos["foto"]["type"] == "image/jpeg") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $rutaFotoPrincipal = "vistas/img/productos/" . $datos["ruta"] . ".jpg";

                        $origen = imagecreatefromjpeg($datos["foto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $rutaFotoPrincipal);

                    }

                    if ($datos["foto"]["type"] == "image/png") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $rutaFotoPrincipal = "vistas/img/productos/" . $datos["ruta"] . ".png";

                        $origen = imagecreatefrompng($datos["foto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagealphablending($destino, false);

                        imagesavealpha($destino, true);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $rutaFotoPrincipal);

                    }

                }

                $datosProducto = array(
                    "titulo"      => $datos["titulo"],
                    "categoria"   => $datos["categoria"],
                    "detalle"     => $datos["detalle"],
                    "estado"      => 1,
                    "descripcion" => $datos["descripcion"],
                    "precio"      => $datos["precio"],
                    "foto"        => $rutaFotoPrincipal,
                    "ruta"        => $datos["ruta"],

                );

                $respuesta = ModeloProductos::mdlIngresarProducto("productos", $datosProducto);

                return $respuesta;

            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "¡El nombre del producto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';

            }

        }

    }

    public static function ctrEditarProducto($datos)
    {

        if (isset($datos["idProducto"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["titulo"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])) {

                $rutaFoto = "../" . $datos["antiguaFoto"];

                if (isset($datos["foto"]["tmp_name"]) && !empty($datos["foto"]["tmp_name"])) {

                    /*=============================================
                    BORRAMOS ANTIGUA FOTO PRINCIPAL
                    =============================================*/

                    unlink("../" . $datos["antiguaFoto"]);

                    /*=============================================
                    DEFINIMOS LAS MEDIDAS
                    =============================================*/

                    list($ancho, $alto) = getimagesize($datos["foto"]["tmp_name"]);

                    $nuevoAncho = 400;
                    $nuevoAlto  = 450;

                    /*=============================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    =============================================*/

                    if ($datos["foto"]["type"] == "image/jpeg") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $rutaFoto = "vistas/img/productos/" . $datos["ruta"] . ".jpg";

                        $origen = imagecreatefromjpeg($datos["foto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $rutaFoto);

                    }

                    if ($datos["foto"]["type"] == "image/png") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $rutaFoto = "vistas/img/productos/" . $datos["ruta"] . ".png";

                        $origen = imagecreatefrompng($datos["foto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagealphablending($destino, false);

                        imagesavealpha($destino, true);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $rutaFoto);

                    }

                }

                $datosProducto = array(
                    "id"          => $datos["idProducto"],
                    "ruta"        => $datos["editarruta"],
                    "titulo"      => $datos["editartitulo"],
                    "categoria"   => $datos["editarcategoria"],
                    "detalle"     => $datos["editardetalle"],
                    "foto"        => $datos["editarfoto"],
                    "descripcion" => $datos["editardescripcion"],
                );

                $respuesta = ModeloProductos::mdlEditarProducto("productos", $datosProducto);

                return $respuesta;

            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "¡El nombre del producto no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';

            }

        }

    }

    /*=============================================
    ELIMINAR PRODUCTO
    =============================================*/

    public static function ctrEliminarProducto()
    {

        if (isset($_GET["idProducto"])) {

            $datos = $_GET["idProducto"];

            /*=============================================
            ELIMINAR FOTO PRINCIPAL
            =============================================*/

            if ($_GET["foto"] != "" && $_GET["foto"] != "vistas/img/productos/default/default.jpg") {

                unlink($_GET["foto"]);

            }

            $respuesta = ModeloProductos::mdlEliminarProducto("productos", $datos);

            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

            }

        }

    }

}
