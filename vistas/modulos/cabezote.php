
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="inicio"><img src="vistas/img/plantilla/cha.png" alt="Logo" width="40"></a>
                    <a class="navbar-brand hidden" href="./"><img src="vistas/img/plantilla/chapulin.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">

                   <div  class="dropdown">
                     	<span><?php echo $_SESSION["nombre"]; ?></span>
                     </div>

                    <div class="user-area dropdown float-right">

                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
if ($_SESSION["foto"] == "") {
    echo '<img class="user-avatar rounded-circle" src="vistas/img/perfil/default/anonymous.png" alt="User Avatar">';
} else {
    echo '<img class="user-avatar rounded-circle" src="' . $_SESSION["foto"] . '" alt="User Avatar">';
}

?>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="perfil"><i class="fa fa- user"></i>Perfil</a>

                            <a class="nav-link" href="salir"><i class="fa fa-power -off"></i>Salir</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
