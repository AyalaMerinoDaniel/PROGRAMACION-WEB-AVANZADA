<?php



class ControladorAdministrador{

public function ctrAdministrador(){
    if(isset($_POST['ingemail'])){
        if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[a-zA-Z]{2,4}$/', $_POST ["ingemail"]) &&
           preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingpassword"])){


        	$encriptar = crypt($_POST["ingpassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        
            $tabla = "administrador";
            $item = "email";
            $valor = $_POST['ingemail'];


            $respuesta = ModeloAdministrador::mdlMostrarAdministrador($tabla,$item,$valor);

            if($respuesta["email"] == $_POST["ingemail"] && $respuesta["password"] == $encriptar){
                if($respuesta["estado"]==1){

                	$_SESSION["ValidarSesion"] = "ok";
                	$_SESSION["id"] =$respuesta["id"];
                	$_SESSION["nombre"] =$respuesta["nombre"];
                	$_SESSION["foto"] = $respuesta["foto"];
                	$_SESSION["email"] = $respuesta["email"];
                	$_SESSION["password"] = $respuesta["password"];
                	$_SESSION["perfil"] = $respuesta["perfil"];

                	echo '<script>
                      window.location = "inicio";
                      </script>
                	';
                
            }else{
                echo '<br>
                <div class="alert alert danger">Este usuarios no esta activado</div>
                ';
            }
          }else {
          	echo '<br>
                <div class="alert alert danger">Error al ingresar vuelva a insertar</div>
                ';
          
            }
        }
      }

    }
  
}