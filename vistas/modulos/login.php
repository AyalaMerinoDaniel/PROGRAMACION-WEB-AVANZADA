  <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="vistas/img/plantilla/cha.png" alt="">
                        <h2>Tienda Chapulines</h2>
                    </a>
                </div>
                <div class="login-form">
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="ingemail" name="ingemail" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="ingpassword" name="ingpassword" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Recordar 
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Ingresar</button>
                       <?php $login = new ControladorAdministrador();
                        $login->ctrAdministrador();
                       ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
