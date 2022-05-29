/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/
$('.tablaProductos').DataTable({
    "ajax": "ajax/tablaproductos.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});
var imagen = null;
$("#foto").change(function() {
    imagen = this.files[0];
    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $("#foto").val("");
        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
    } else if (imagen["size"] > 2000000) {
        $(".nuevaFoto").val("");
        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event) {
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
        })
    }
})
/*=============================================
ACTIVAR PRODUCTO
=============================================*/
//$("#datepickeroferta").datepicker();
$('.tablaProductos tbody').on("click", ".btnActivar", function() {
    var idProducto = $(this).attr("idProducto");
    var estadoProducto = $(this).attr("estadoProducto");
    var datos = new FormData();
    datos.append("activarId", idProducto);
    datos.append("activarProducto", estadoProducto);
    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            // console.log("respuesta", respuesta);
        }
    })
    if (estadoProducto == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoProducto', 1);
    } else {
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoProducto', 0);
    }
})
$("#guardarProducto").click(function() {
    /*=============================================
    ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
    =============================================*/
    var titulo = $("#titulo").val();
    var ruta = $("#titulo").val();
    var categoria = $("#categoria").val();
    var descripcion = $("#descripcion").val();
    var detalle = $("#detalle").val();
    var precio = $("#precio").val();
    //var foto = $("#foto").val();
    var datosProducto = new FormData();
    datosProducto.append("titulo", titulo);
    datosProducto.append("ruta", ruta);
    datosProducto.append("detalle", detalle);
    datosProducto.append("categoria", categoria);
    datosProducto.append("descripcion", descripcion);
    datosProducto.append("precio", precio);
    datosProducto.append("foto", imagen);
    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datosProducto,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            alert(respuesta);
            if (respuesta == "ok") {
                swal({
                    type: "success",
                    title: "El producto ha sido guardado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result) {
                    if (result.value) {
                        window.location = "productos";
                    }
                })
            }
        }
    })
})
$('.tablaProductos tbody').on("click", ".btnEditarProducto", function() {
    var idProducto = $(this).attr("idProducto");
    var datos = new FormData();
    datos.append("idProducto", idProducto);
    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#modalEditarProducto .editaridProducto").val(respuesta[0]["id"]);
            $("#modalEditarProducto .editartitulo").val(respuesta[0]["titulo"]);
            $("#modalEditarProducto .editarruta").val(respuesta[0]["ruta"]);
            $("#modalEditarProducto .editardescripcion").val(respuesta[0]["descripcion"]);
            $("#modalEditarProducto .editardetalle").val(respuesta[0]["detalle"]);
            $("#modalEditarProducto .editarprecio").val(respuesta[0]["precio"]);
            $("#modalEditarProducto .editarfoto").val(respuesta[0]["foto"]);
            if (respuesta[0]["foto"] != "") {
                $("#modalEditarProducto .previsualizar").attr("src", respuesta[0]["foto"]);
            }
            if (respuesta[0]["categoria"] != 0) {
                var datosCategoria = new FormData();
                datosCategoria.append("idCategoria", respuesta[0]["categoria"]);
                $.ajax({
                    url: "ajax/categorias.ajax.php",
                    method: "POST",
                    data: datosCategoria,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta) {
                        $("#modalEditarProducto .seleccionarCategoria").val(respuesta["id"]);
                        $("#modalEditarProducto .optionEditarCategoria").html(respuesta["categoria"]);
                    }
                })
            } else {
                $("#modalEditarProducto .optionEditarCategoria").html("SIN CATEGORÍA");
            }
            $("#guardarCambiosProducto").click(function() {
                var idProducto = $("#modalEditarProducto .editaridProducto").val();
                var titulo = $("#modalEditarProducto .editartitulo").val();
                var ruta = $("#modalEditarProducto .editarruta").val();
                var categoria = $("#modalEditarProducto .editarcategoria").val();
                var detalle = $("#modalEditarProducto .editardetalle").val();
                var precio = $("#modalEditarProducto .editarprecio").val();
                var descripcion = $("#modalEditarProducto .editardescripcion").val();
                var antiguaFoto = $("#modalEditarProducto .editarantiguaFoto").val();
                var datosProducto = new FormData();
                datosProducto.append("id", idProducto);
                datosProducto.append("categoria", categoria);
                datosProducto.append("ruta", ruta);
                datosProducto.append("titulo", titulo);
                datosProducto.append("detalle", detalle);
                datosProducto.append("descripcion", descripcion);
                datosProducto.append("precio", precio);
                datosProducto.append("antiguaFoto", antiguaFoto);
                $.ajax({
                    url: "ajax/productos.ajax.php",
                    method: "POST",
                    data: datosProducto,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta) {
                        if (respuesta == "ok") {
                            swal({
                                type: "success",
                                title: "El producto ha sido cambiado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result) {
                                if (result.value) {
                                    localStorage.removeItem("multimediaFisica");
                                    localStorage.clear();
                                    window.location = "productos";
                                }
                            })
                        }
                    }
                })
            })
        }
    })
})
/*=============================================
ELIMINAR PRODUCTO
=============================================*/
$('.tablaProductos tbody').on("click", ".btnEliminarProducto", function() {
    var idProducto = $(this).attr("idProducto");
    var imgfoto = $(this).attr("foto");
    swal({
        title: '¿Está seguro de borrar el producto?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=productos&idProducto=" + idProducto + "&foto=" + imgfoto;
        }
    })
})