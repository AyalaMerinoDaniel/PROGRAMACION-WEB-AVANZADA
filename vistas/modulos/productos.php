
<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Inicio</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="inicio">Inicio</a></li>
                                    <!--<li><a href="#">Table</a></li>-->
                                    <li class="active">Producto</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

<div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">

                              <div class="row">
                                <div class="col-md-9">
                                  <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregarProducto">
                                          Nuevo Producto
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="vistas/modulos/reportes.php?reporte=productos">
                                          <button class="btn btn-success">Reporte en Excel</button></a>
                                </div>
                            </div>



                              <div class="col-md-10">
                                <center><strong class="card-title">Tabla Productos</strong></center>
                              </div>
                            </div>
                            <div class="card-body">
                                <table  class="table table-striped table-bordered tablaProductos" id="tablaProductos">
                                    <thead>
                                        <tr>
                                           <th style="width:10px">#</th>
					               <th>Titulo</th>
					               <th>Estado</th>
					               <th>Categoria</th>
					               <th>Descripcion</th>
					               <th>Detalles</th>
					               <th>Precio</th>
					               <th>Foto</th>
					               <th>Fecha</th>
					               <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
</div><!-- .content -->

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->


<!-- Modal  CREAR PRODUCTO-->
<div class="modal fade" id="ModalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <center><h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5></center>
      </div>
      <div class="modal-body">
       <form method="post">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Titulo</span>
          </div>
          <input type="text" class="form-control" placeholder="titulo" id="titulo" name="titulo" aria-label="Username" aria-describedby="basic-addon1" id="titulo">
        </div>

        <div class="input-group mb-3">
          <select class="custom-select categoria " id="categoria" name="categoria">
            <option selected>Escoger...</option>
                    <?php

$item  = null;
$valor = null;

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

foreach ($categorias as $key => $value) {

    echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
}

?>

          </select>
          <div class="input-group-append">
            <label class="input-group-text" for="inputGroupSelect02">Seleccionar</label>
          </div>
        </div>

         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Descripcion</span>
          </div>
          <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" aria-label="Username" aria-describedby="basic-addon1">
        </div>

         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Detalles</span>
          </div>
          <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Detalles" aria-label="Username" aria-describedby="basic-addon1">
        </div>


        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">precio</span>
          </div>
          <input type="number" class="form-control" name="precio" id="precio" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Imagen</span>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input foto" id="foto" name="foto">
            <label class="custom-file-label" for="inputGroupFile01" id="imagen" name="imagen" >Choose file</label>
          </div>

           <input type="hidden" class="antiguaFoto">
        </div>
         <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizar" width="200px">

       </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary guardarProducto" id="guardarProducto">Guardar</button>
      </div>
    </div>
  </div>
</div>



<!-- MODAL EDIATAR PRODUCTO-->
<div class="modal fade modalEditarProducto" id="modalEditarProducto" name="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <center><h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5></center>
      </div>
      <div class="modal-body">
       <form method="post">


         <input type="hidden" class="editaridProducto"  id="editaridProducto" name="editaridProducto">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Titulo</span>
          </div>
          <input type="text" class="form-control editartitulo" placeholder="titulo" aria-label="Username" aria-describedby="basic-addon1" id="editartitulo">
        </div>

        <div class="input-group mb-3">
          <select class="custom-select editarcategoria" id="iditarcategoria" name="editarcategoria">
            <option class="optioncategoria" id="optioncategoria">Seleccionar...</option>

                    <?php

$item  = null;
$valor = null;

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

foreach ($categorias as $key => $value) {

    echo '<option  value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
}

?>

          </select>
          <div class="input-group-append">
            <label class="input-group-text" for="inputGroupSelect02">Seleccionar</label>
          </div>
        </div>

         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Descripcion</span>
          </div>
          <input type="text" class="form-control editardescripcion" id="editardescripcion" name="descripcion" placeholder="Descripcion" aria-label="Username" aria-describedby="basic-addon1">
        </div>

         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Detalles</span>
          </div>
          <input type="text" class="form-control editardetalle" id="editardetalle" name="editardetalle" placeholder="Detalles" aria-label="Username" aria-describedby="basic-addon1">
        </div>


        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text precio" id="basic-addon3">precio</span>
          </div>
          <input type="number" class="form-control editarprecio" name="editarprecio" id="editarprecio" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Imagen</span>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input iditarfoto" id="editarfoto" name="editarfoto">
            <label class="custom-file-label" for="inputGroupFile01" id="imagen" name="imagen" >Choose file</label>
          </div>
           <input type="hidden" class="antiguaFoto">
        </div>
          <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizareditar" width="200px">

       </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary guardarCambiosProducto" id="guardarCambiosProducto">Guardar</button>
      </div>
    </div>
  </div>
</div>

<?php

$eliminarProducto = new ControladorProductos();
$eliminarProducto->ctrEliminarProducto();

?>

