<?php
    require_once "../Models/usuario.php";

    class UsersController{
        static public function conecta(){
            if($_POST){
                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUser"])){
                    $tabla = "usuarios";
                    $e = "usuario";
                    $val = $_POST["ingUser"];
                    $r = UserModel::pregunta($tabla, $e, $val);
    
                    if($r["contraseña"] == $_POST["ingContra"]){
                        $_SESSION["iniciaSesion"] = "Ok";
                          echo '<script>
                               window.location = "../Views/inicial.php";
                        </script>';
                         echo '<br><div class= "alert alert-success">
                         Bienvenido </div>';
                    }else{
                     echo '<script>
                               window.location = "../Views/404.html";
                        </script>';
                    }
                }
            }
        }
    }

?>