    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Usuarios</h3>
          <div class="card-tools">
            <button href="usuario.php" type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
  <div class="card-header">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
    Agregar Usuario
    </button>
         </div>
<div class="card-body">
  <table class="table table-bordered table-striped dt-responsive tabla">
    <thead>
     <tr>
				<th>
					Id
				</th>
				<th>
					Nombre
				</th>
				<th>
					Usuario
				</th>
				<th>
					Foto
				</th>
				<th>
					Perfil
				</th>
				<th>
					Estado
				</th>
				<th>
					Última conexión
				</th>
				<th>
				</th>
			</tr>
    </thead>
<tbody> 
<tbody>
<?php

	$u = Usuarios::ctrUsuarios(null, null);
	$i = 0;
	foreach($u as $key => $v) {
		$i = $i + 1;
			echo '
			<tr>
				<td>';
					echo $i;
				echo '
				</td>
				<td>  ';
					echo $v["nombre"];
				echo '
				</td>
				<td> ';
					echo $v["usuario"];
				echo '
				</td>
				<td> ';
				if($v["foto"] != "")
					echo '
						<img src="' . $v["foto"] . '" class="img-thumbnail" width="40px">';
				else
					echo '<img src="Views/imgs/anonimo.jpg" class="img-thumbnail" width="40px">';
				echo '
				</td>
				<td> ';
					echo $v["rol"];
				echo '
				</td>
				<td>';
				if(is_null($v["fecha_baja"]))
					echo '<button class="btn btn-success btn-xs">Activo</button>';
				else
					echo '<button class="btn btn-danger btn-xs">Baja</button>';

				echo '
				</td>
				<td>  
					2022-03-22 10:00
				</td>
				<td>
					<div class="btn-group">
						<button class="btn btn-warning"><i class="fa fa-pencil-alt"></i></button>
		<button class="btn btn-danger"><i class="fa fa-times"></i></button>
					</div>

				</td>';
				}
?>		
			
    </tbody>
</table>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
<!-- -------------------------------------------------
  Agregar usuario

----------------------------------------------------- -->

<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUsuario" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
  <form role="form" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <!-- nombre -->
      <div class="form-group">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-user"></i></span>
        </div>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre" aria-="" label="usuario" aria-describedby="basic-addon1">
      </div></div>
      <!-- nombre usuario -->
      <div class="form-group">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-user"></i></span>
        </div>
        <input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario" aria-="" label="usuario" aria-describedby="basic-addon1">
      </div></div>
      <!-- contraseña -->
      <div class="form-group">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-user"></i></span>
        </div>
        <input type="password" class="form-control" autocomplete="off" name="contra" placeholder="Escribe la contraseña" aria-="" label="usuario" aria-describedby="basic-addon1">
      </div></div>
      <!-- rol -->
      <div class="form-group">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-user"></i></span>
        </div>
        <select class="form-control-lg" name="rol">
          <option value="">Selecciona el perfil</option>
          <option value="Administrador">Administrador</option>
          <option value="Usuario">Usuario</option>
  
        </select>
      </div></div>
      <!-- foto -->
      <div class="form-group">
        <div class="panel">Subir foto</div>
        <input type="file" class="nuevaFoto" id="foto" name="foto">
        <p class="help-block">Peso maximo 2 MB</p>
        <img src="imgs/anonimo.jpg" class="img-thumbnail preview" width="100px">
      </div>
    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
	<?php
           
            $l = new Usuarios();
            $l->ctrUsuario();
     ?>
     </form>
     
     </div>
 
    </div>
  </div>
</div>
